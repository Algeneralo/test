@extends('backend.layouts.backend')

@section('title', 'Mitarbeiter')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')

    @php

        $canAdminsUserCreate = Auth::user()->can('admins.user.create');
        $canAdminsUserEdit = Auth::user()->can('admins.user.edit');
        $canAdminsUserDelete = Auth::user()->can('admins.user.delete');

    @endphp

    <h2 class="content-heading">
        <i class="scannel-icons icon-employee"></i> Mitarbeiter
        @if($canAdminsUserCreate)<a class="btn btn-alt-primary pull-right" href="{{route('get.admin-user-create')}}">+
            Neuer Mitarbeiter</a>@endif
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
                    <th class="d-none d-sm-table-cell">Firma</th>
                    <th class="text-center" style="width: 15%;">Gruppe</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Rolle</th>
                    <th class="text-center" style="width: 15%;">Hochgeladene Produkte</th>
                    @if($canAdminsUserEdit || $canAdminsUserDelete)
                        <th></th>@endif
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->admin_id}}</td>
                        <td><a class="edit-link"
                               href="{{route('get.admin-user', ['admin' => $user->admin_id])}}">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->company}}</td>
                        <td>@if($user->group){{$user->group->name}}@endif</td>
                        <td>
                            @if($user->roles()->first())
                                {{$user->roles()->first()->name}}
                            @endif
                        </td>
                        <td>
                            {{$user->products()->count()}}
                        </td>
                        @if($canAdminsUserDelete || $canAdminsUserEdit)
                            <td>
                                @if($canAdminsUserEdit)
                                    <a class="edit-link"
                                       href="{{route('get.admin-user', ['admin' => $user->admin_id])}}"><i
                                            class="scannel-icons icon-edit"></i> Bearbeiten</a>
                                @endif
                                @if($canAdminsUserDelete)
                                    <a class="edit-link delete-admin" href="javascript:void(0)"
                                       data-deleteurl="{{route('get.delete-admin', ['admin' => $user->admin_id])}}">
                                        <i class="fa fa-trash"></i> Löschen
                                    </a>
                                @endif
                            </td>
                        @endif
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

        $('a.delete-admin').on('click', function () {

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
