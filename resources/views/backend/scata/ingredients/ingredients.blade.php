@extends('backend.layouts.backend')

@section('title', 'Inhaltsstoffe')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <h2 class="content-heading">
        <i class="scannel-icons icon-product"></i> Inhaltsstoffe
    </h2>

    <!-- Dynamic Table Full -->
    <div class="block table">
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table dataTable scannel-datatable" data-order="[[ 1, &quot;desc&quot; ]]">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Eintragsdatum</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($ingredients as $ingredient)
                    <tr>
                        <td>
                            <a class="edit-link" href="{{route('get.scata.ingredient', ['ingredient' => $ingredient->id])}}">
                            {{$ingredient->name[app()->getLocale()]}}
                            </a>
                        </td>
                        <td>{{\Carbon\Carbon::parse($ingredient->created)->format('d.m.Y H:i')}}</td>
                        <td>
                            <a class="edit-link" href="{{route('get.scata.ingredient', ['ingredient' => $ingredient->id])}}"><i class="scannel-icons icon-edit"></i> Bearbeiten</a>
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

        $('button.delete-ingredient').on('click', function() {

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
