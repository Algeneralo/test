@extends('backend.layouts.backend')

@section('title', 'Rolle bearbeiten')

@section('css_before')
    <style>
        .block-permission-group {
            height: calc(100% - 24px);
        }
    </style>
@endsection

@section('content')
    <h2 class="content-heading">
        <i class="scannel-icons icon-businessman"></i> Rolle bearbeiten
    </h2>

    <form method="post" action="{{route('post.update-admin-role', ['role' => $role->id])}}">
        <div class="block block-form">
            @csrf
            <div class="block-header">
                <h3 class="block-title">Rolleninformation</h3>
            </div>
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name <sup>*</sup></label>
                                    <input type="text" class="form-control" name="name" value="{{ (old('name')) ? old('name') : $role->name }}">
                                    @error('name')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gruppe</label>
                                    <select class="js-select2 form-control" name="group_id">
                                        @foreach($groups as $group)
                                            <option value="{{$group->group_id}}"
                                                    @if($group->group_id == $role->group_id) selected @endif>{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('group')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            @foreach($permissionGroups as $permissionGroup)
                <div class="col col-md-3">
                    <div class="block block-form block-permission-group">
                        <div class="block-header">
                            <h3 class="block-title">{{$permissionGroup->name}}</h3>
                        </div>
                        <div class="block-content block-content-full">
                            @foreach($permissionGroup->permissions as $permission)
                                @canany(['admins.role.manager', $permission->name])
                                <div class="form-group">
                                    <label class="css-control css-control-primary css-checkbox">
                                        <input type="checkbox" class="css-control-input" value="{{$permission->id}}"
                                               name="permissions[]" @if($role->hasPermissionTo($permission->id)) checked @endif >
                                        <span class="css-control-indicator"></span> {{$permission->displayName}}
                                    </label>
                                </div>
                                @endcan
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="block-footer">
            <a class="btn btn-alt-primary-outline" href="{{route('get.admin-roles')}}">Abbrechen</a>
            <button class="btn btn-alt-primary" type="submit">Speichern</button>
        </div>
    </form>
@endsection
