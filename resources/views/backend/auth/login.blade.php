@extends('backend.layouts.simple')

@section('title', 'Login')


@section('content')
<div class="bg-body-dark bg-pattern" style="background-image: url('assets/media/various/bg-pattern-inverse.png');">
    <div class="row mx-0 justify-content-center">
        <div class="hero-static">
            <div class="content content-full overflow-hidden auth align-self-center">
                <form class="js-validation-signin" action="{{route('post.login')}}" method="post">
                                        @csrf
                    <div class="block block-themed block-rounded block-shadow">
                        <div class="block-content">
                            <h2>
                                Herzlich Willkommen!
                            </h2>
                            <p class="info-text">
                                Melden Sie sich hier mit Ihrer E-Mail-Adresse und Ihrem Passwort an
                            </p>
                            @if(session()->has('success'))
                                <div class="alert alert-success text-center">
                                    {{session()->get('success')}}
                                </div>
                            @endif
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="login-email" name="email">
                                        <label for="login-email">E-Mail Adresse</label>
                                    </div>
                                    @error('email')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-material floating">
                                        <input type="password" class="form-control" id="login-password" name="password">
                                        <label for="login-password">Passwort</label>
                                    </div>
                                    @error('password')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-alt-primary">
                                        Anmelden
                                    </button><br>
                                    <a class="reset-password" href="{{route('get.request-reset-password')}}">Passwort vergessen</a>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <a class="pull-right">Datenschutz</a>
                            <a class="pull-left">Impressum</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
