@extends('backend.layouts.backend')

@section('title', 'Produkte')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success">
            {!! session()->get('message') !!}
        </div>
    @endif

    <h2 class="content-heading">
        <i class="scannel-icons icon-product"></i> Scannel Ingredienz-Gruppen
        <button class="btn btn-alt-primary pull-right" onclick="location.href='{{ url('scannel/ingredient/ingredientgroup') }}'">+ Gruppe hinzufügen</button>
    </h2>

    <!-- Dynamic Table Full -->
    <div class="block table">
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table id="tabGrps" class="table dataTable scannel-datatable" data-order="[[ 5, &quot;desc&quot; ]]">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Name</th>
                        <th></th>
                        <th>Parent</th>
                        <th>Zutaten</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($groups as $grp)
                    <tr>
                        <td>{{$grp->id}}</td>
                        <td><a href="{{ url('scannel/ingredient/ingredientgroup',$grp->id) }}">{{$grp->slug}}</a></td>
                        <td><div style="display: flex;">
                            <a class="edit-link delete-ingredient" href="javascript:void(0)" data-delurl="{{route('get.scannelingredientdelete', ['del' => $grp->id])}}"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                        <td>
                            @if($grp->parentid !== '' && $grp->parentid != 0)
                                <a href="{{ url('scannel/ingredient/ingredientgroup',$grp->parentid) }}">{{$grp->getParentSlug()}}</a>
                            @endif
                        </td>
                        <td>{{$grp->ingredients()->get()->count()}}</td>
                        <td data-value="{{$grp->chieldGroups()->get()}}" class="details-control" >
                                <a style="border:0;" class="btn btn-alt-primary " onclick="hideshow({{$grp->id}})">Untergruppen anzeigen</a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js_after')
    <!-- SweetAlert2 -->
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>

    <script>

     $('#tabGrps tbody').on('click', 'td.details-control', function () {
         var data = $(this).data("value")
        var table = $('#tabGrps').DataTable();
        var tr = $(this).parents('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row

            var nT  = '<table cellpadding="5" cellspacing="0" border="0" style="margin-left:80px;">';
                    $.each( data, function( index, value ) {
//                        $("#"+value.id). prop("checked", false);
                            nT +='<tr  style="border:0;">';
                            nT +='<td>'+value.id+'</td>';
                            nT +='<td><a onClick="window.open("//ingredientgroup//'+value.id+'")" >'+value.slug+'</a></td>';


                            nT +='</tr>';
                    });
                nT +='</table>';
            row.child( nT ).show();
            tr.addClass('shown');
        }
    } );
        function hideshow(id) {
                return;
            var x = document.getElementById(id);
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        $('a.delete-ingredient').on('click', function() {

            var delurl = $(this).data('delurl');
            Swal.fire({
                title: 'Bist du sicher?',
                text: "Wenn du eine Zutat löscht, kann dieses nicht wieder hergestellt werden.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ja, ich bin sicher!',
                cancelButtonText: 'Nein',
            }).then((result) => {
                if (result.value) {
                    window.location = delurl;
                }
            })

        });


    </script>

@endsection
