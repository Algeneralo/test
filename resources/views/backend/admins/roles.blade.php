@extends('backend.layouts.backend')

@section('title', 'Mitarbeiter Rollen')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')

    @php

        $canAdminsRoleCreate = Auth::user()->can('admins.role.create');
        $canAdminsRoleEdit = Auth::user()->can('admins.role.edit');
        $canAdminsRoleDelete = Auth::user()->can('admins.role.delete');

    @endphp

    <h2 class="content-heading">
        <i class="scannel-icons icon-businessman"></i> Rollen
        @if($canAdminsRoleCreate)<a class="btn btn-alt-primary pull-right" href="{{route('get.admin-role-create')}}">+
            Rolle hinzufügen</a>@endif
    </h2>

    <!-- Dynamic Table Full -->
    <div class="block table">
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="tables dataTable scannel-datatable">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th>Name</th>
                    <th class="d-none d-sm-table-cell" style="width: 20%;">Gruppe</th>
                    <th class="d-none d-sm-table-cell" style="width: 20%;">Nutzer mit dieser Rolle</th>
                    @if($canAdminsRoleEdit || $canAdminsRoleDelete)
                        <th class="d-none d-sm-table-cell" style="width: 15%;"></th>@endif
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>@if($role->group){{$role->group->name}}@endif</td>
                        <td>{{\App\Models\Admins\Admin::role($role->id)->count()}}</td>
                        @if($canAdminsRoleEdit || $canAdminsRoleDelete)
                            <td>
                                @if($canAdminsRoleEdit)<a class="edit-link"
                                                           href="{{route('get.admin-role', ['role' => $role->id])}}"><i
                                        class="scannel-icons icon-edit"></i> Bearbeiten</a>@endif
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
