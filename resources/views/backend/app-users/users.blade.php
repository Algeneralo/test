@extends('backend.layouts.backend')

@section('title', 'App Nutzer')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <h2 class="content-heading">
        <i class="scannel-icons icon-users"></i> App-Nutzer
        <a class="btn btn-alt-primary pull-right" href="{{route('get.app-user-create')}}">+ Neuer App-Nutzer</a>
    </h2>

    <!-- Dynamic Table Full -->
    <div class="block table">
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table dataTable scannel-datatable">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th>Name</th>
                    <th class="d-none d-sm-table-cell">E-Mail</th>
                    <th class="d-none d-sm-table-cell">Status</th>
                    <th class="d-none d-sm-table-cell">Anzahl Profile</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->scannelid}}</td>
                            <td>
                                <a class="edit-link" href="{{route('get.app-user', ['user' => $user->id])}}">
                                @if($user->profiles()->where('main', true)->first())
                                    {{$user->profiles()->where('main', 1)->first()->firstname}} {{$user->profiles()->where('main', 1)->first()->lastname}}
                                @else
                                    <span class="text-gray-dark">Kein Profil gefunden.</span>
                                @endif
                                </a>
                            </td>
                            <td>{{$user->email}}</td>
                            <td>
                                <!-- TODO: Active Toggle -->
                                @if($user->email_verified_at != null)
                                    <span class="badge badge-success">Aktiv</span>
                                @else
                                    <span class="badge badge-warning">Inaktiv</span>
                                @endif
                            </td>
                            <td>{{$user->profiles()->count()}}</td>
                            <td>
                                <a class="edit-link" href="{{route('get.app-user', ['user' => $user->id])}}"><i class="scannel-icons icon-edit"></i> Bearbeiten</a>
                                <a class="edit-link delete-user" href="javascript:void(0)" data-deleteurl="{{route('get.delete-app-user', ['user' => $user->id])}}"><i class="fa fa-trash"></i> Löschen</a>
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

    @if($errors->any())
        <script>
            $(document).ready(function () {
                $('#createappuser').modal('show');
            });
        </script>
    @endif



    <script>

        $('a.delete-user').on('click', function() {

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
