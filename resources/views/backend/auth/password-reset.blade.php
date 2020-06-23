@extends('backend.layouts.simple')

@section('title', 'Neues Passwort setzen')

@section('content')
<div class="bg-body-dark bg-pattern" style="background-image: url('assets/media/various/bg-pattern-inverse.png');">
    <div class="row mx-0 justify-content-center">
        <div class="hero-static">
            <div class="content content-full overflow-hidden auth align-self-center">

                <!-- Sign In Form -->
                <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                <form class="js-validation-signin" action="{{route('post.reset-password')}}" method="post">
                    @csrf
                    <input name="adminid" value="{{request()->query('adminid')}}" hidden>
                    <input name="token" value="{{request()->query('token')}}" hidden>
                    <div class="block block-themed block-rounded block-shadow">
                        <h2>
                            Neues Passwort setzten
                        </h2>
                        <div class="block-content">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material floating">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <label for="password">Passwort</label>
                                    </div>
                                    @error('password')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material floating">
                                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
                                        <label for="password-confirm">Passwort bestätigen</label>
                                    </div>
                                    @error('password_confirmation')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-alt-primary">
                                        Passwort ändern
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <a class="pull-right">Datenschutz</a>
                            <a class="pull-left">Impressum</a>
                        </div>
                    </div>
                </form>
                <!-- END Sign In Form -->
            </div>
        </div>
    </div>
</div>
@endsection
