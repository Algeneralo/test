@extends('backend.layouts.backend')

@section('title', 'Nutzer bearbeiten')

@section('content')
    <h2 class="content-heading">
        {{$user->profiles()->where('main', 1)->first()->firstname}} {{$user->profiles()->where('main', 1)->first()->lastname}}
    </h2>

    <form class="row" action="{{route('post.create-admin-group')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <div class="block block-form">
                @csrf
                <div class="block-header">
                    <h3 class="block-title">Nutzerinformationen</h3>
                </div>
                <div class="block-content block-content-full user-info">
                    <div class="row">
                        <div class="col col-md-3 border-right">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-muted">
                                        Allgemeine Informationen des Accounts, die bei der Registrierung erhoben werden.
                                    </p>
                                    <div class="form-group">
                                        <label>Account Status</label><br>
                                        <label class="css-control css-control-primary css-checkbox"
                                               style="margin-top: 24px;">
                                            <input type="checkbox" class="css-control-input" name="active" value="true" @if($user->email_verified_at != null) checked @endif>
                                            <span class="css-control-indicator"></span> Aktive
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-3 border-right">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Scannel-ID</label>
                                        <input type="text" class="form-control form-control-lg" name="scannelid" value="{{$user->scannelid}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>E-Mail Adresse</label>
                                        <input type="text" class="form-control form-control-lg" name="email" value="{{$user->email}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-footer">
                    <a class="btn btn-alt-primary-outline" href="{{route('get.app-users')}}">Abbrechen</a>
                    <button class="btn btn-alt-primary" type="submit">Speichern</button>
                </div>
            </div>
        </div>
    </form>

    @if($user->profiles()->count() > 0)
        <h2 class="content-heading">
            <i class="scannel-icons icon-user"></i> Profile
        </h2>
    @endif


    @php
        $i = 1;
    @endphp
    @foreach($user->profiles as $profile)
        @include('backend.app-users.edit.profile', ['i' => $i, 'profile' => $profile])
        @php
            $i++;
        @endphp
    @endforeach
@endsection

@section('js_after')

    <script>

        $(document).ready(function() {

            var height = $('.profile-info').height();

            $('.profile-avatar').height(height);

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
