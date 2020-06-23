@extends('backend.layouts.backend')

@section('title', 'Gruppe bearbeiten')


@section('content')
    <h2 class="content-heading">
        <i class="scannel-icons icon-group"></i> Gruppe bearbeiten
    </h2>

    <form class="row" action="{{route('post.update-admin-group', ['group' => $group->group_id])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-9">
            <div class="block block-form">
                <div class="block-header">
                    <h3 class="block-title">Gruppeninformationen</h3>
                </div>
                <div class="block-content block-content-full group-info">
                    <div class="row">
                        <div class="col col-md-4 border-right">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name <sup>*</sup></label>
                                        <input type="text" class="form-control" name="name"  value="{{ (old('name')) ? old('name') : $group->name }}">
                                        @error('name')
                                        <small class="form-text text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Gruppen Admin <sup>*</sup></label>
                                        <select class="form-control" name="supervisor_id" value="{{ old('supervisor_id') }}">
                                            @foreach($users as $user)
                                                <option value="{{$user->admin_id}}" @if($user->admin_id == $group->supervisor_id) selected @endif>{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('supervisor_id')
                                        <small class="form-text text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-footer">
                    <a class="btn btn-alt-primary-outline" href="{{route('get.admin-groups')}}">Abbrechen</a>
                    <button class="btn btn-alt-primary" type="submit">Speichern</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="block block-form">
                <div class="block-header">
                    <h3 class="block-title">Logo</h3>
                </div>
                <div class="block-content block-content-full group-logo text-center">
                    @if($group->logo)
                    <img src="{{route('get.admin-group-logo', ['group' => $group->group_id])}}" height="60">
                        <p class="filename">{{$group->logo}}</p>
                    @else
                        <i class="scannel-icons icon-image scannel-text-color" style="font-size: 50px"></i>
                        <p class="filename">Keine Datei ausgewählt</p>
                    @endif

                </div>
                <div class="block-footer">
                    <label class="btn btn-alt-primary-outline">
                        Hochladen <input type="file" hidden name="logo">
                    </label>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js_after')

    <script>

        $(document).ready(function() {

            var height = $('.group-info').height();

            $('.group-logo').height(height);

        });

        $('input[type="file"]').on('change', function() {

            var files = $(this).prop('files');

            if(files.length === 0) {
                $('.filename').html('Keine Datei ausgewählt');
            } else {

                $('.filename').html(files[0].name);

            }

        });

    </script>

@endsection
