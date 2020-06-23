@extends('backend.layouts.backend')

@section('title', 'Mitarbeiter Gruppen')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')

    @php

        $canAdminsGroupCreate = Auth::user()->can('admins.group.create');
        $canAdminsGroupEdit = Auth::user()->can('admins.group.edit');
        $canAdminsGroupDelete = Auth::user()->can('admins.group.delete');

    @endphp

    <h2 class="content-heading">
        <i class="scannel-icons icon-group"></i> Gruppen
        @if($canAdminsGroupCreate)<a class="btn btn-alt-primary pull-right" href="{{route('get.admin-group-create')}}">+
            Neuer Gruppe</a>@endif
    </h2>

    <!-- Dynamic Table Full -->
    <div class="block table">
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table dataTable scannel-datatable">
                <thead>
                <tr>
                    <th class="text-center"></th>
                    <th>Name</th>
                    <th>Gruppen Admin</th>
                    <th class="d-none d-sm-table-cell" style="width: 20%;">Nutzer in dieser Gruppe</th>
                    @if($canAdminsGroupEdit || $canAdminsGroupDelete)
                        <th class="d-none d-sm-table-cell" style="width: 15%;"></th>@endif
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td class="text-center">
                            @if($group->logo)
                                <img src="{{route('get.admin-group-logo', ['group' => $group->group_id])}}" height="40">
                            @endif
                        </td>
                        <td>{{$group->name}}</td>
                        <td>
                            @if($group->supervisor()->first())
                                {{$group->supervisor()->first()->name}}
                            @endif
                        </td>
                        <td>{{\App\Models\Admins\Admin::where('group_id', $group->group_id)->count()}}</td>
                        @if($canAdminsGroupEdit || $canAdminsGroupDelete)
                            <td>
                                @if($canAdminsGroupEdit)<a class="edit-link"
                                                            href="{{route('get.admin-group', ['group' => $group->group_id])}}"><i
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
