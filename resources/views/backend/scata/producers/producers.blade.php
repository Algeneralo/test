@extends('backend.layouts.backend')

@section('title', 'Hersteller')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <h2 class="content-heading">
        <i class="scannel-icons icon-product"></i> Hersteller
        <a class="btn btn-alt-primary pull-right" href="{{route('post.scata.producer-create')}}">+ Neuen Hersteller</a>
    </h2>

    <!-- Dynamic Table Full -->
    <div class="block table">
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table dataTable scannel-datatable" data-order="[[ 2, &quot;desc&quot; ]]">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>GLN</th>
                    <th>Eintragsdatum</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($producers as $producer)
                    <tr>
                        <td>
                            <a class="edit-link" href="{{route('get.scata.producer', ['producer' => $producer->id])}}">
                            {{$producer->name}}
                            </a>
                        </td>
                        <td>{{$producer->gln}}</td>
                        <td>{{\Carbon\Carbon::parse($producer->created)->format('d.m.Y H:i')}}</td>
                        <td>
                            <a class="edit-link" href="{{route('get.scata.producer', ['producer' => $producer->id])}}"><i class="scannel-icons icon-edit"></i> Bearbeiten</a>
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

        $('button.delete-producer').on('click', function() {

            var delurl = $(this).data('deleteurl');
            console.log(delurl);

            Swal.fire({
                title: 'Bist du sicher?',
                text: "Wenn du den Nutzer löscht, kann er sich nicht mehr anmelden.",
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
