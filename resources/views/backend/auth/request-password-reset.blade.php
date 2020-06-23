@extends('backend.layouts.simple')

@section('title', 'Passwort vergessen?')

@section('content')
    <div class="bg-body-dark bg-pattern" style="background-image: url('assets/media/various/bg-pattern-inverse.png');">
        <div class="row mx-0 justify-content-center">
            <div class="hero-static">
                <div class="content content-full overflow-hidden auth align-self-center">

                    <!-- Sign In Form -->
                    <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                    <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                    @if(session()->has('success'))
                        <p class="block block-themed block-rounded block-shadow">
                            <h2>
                                Passwort vergessen?
                            </h2>
                            <p class="info-text">
                                Wenn zu der angegeben E-Mail Adresse ein Nutzer gefunden wurde, erhalten Sie in kürze
                                eine E-Mail mit der Sie ihr Passwort zurücksetzen können. Sollte diese E-Mail nicht bei
                                Ihnen ankommen, bitten Wir sie uns zu kontaktieren,
                            </p>
                        </div>
                    @else
                        <form class="js-validation-signin" action="{{route('post.request-reset-password')}}"
                              method="post">
                            @csrf
                            <div class="block block-themed block-rounded block-shadow">
                                <h2>
                                    Passwort vergessen?
                                </h2>
                                <div class="block-content">
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
                                    <div class="form-group row mb-0">
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-alt-primary">
                                                Passwort zurücksetzen
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
                    @endif
                <!-- END Sign In Form -->
                </div>
            </div>
        </div>
    </div>
@endsection
