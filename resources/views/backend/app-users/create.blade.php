@extends('backend.layouts.backend')

@section('title', 'App-Nutzer hinzufügen')


@section('content')
    <h2 class="content-heading">
        <i class="scannel-icons icon-users"></i> App-Nutzer hinzufügen
    </h2>

    <form class="block block-form" action="{{route('post.create-app-user')}}" method="post"
          enctype="multipart/form-data">
        @csrf
        <div class="block-header">
            <h3 class="block-title">Nutzerinformationen</h3>
        </div>
        <div class="block-content block-content-full group-info">
            <div class="row">
                <div class="col col-md-3 border-right">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>E-Mail Adresse <sup>*</sup></label>
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                @error('email')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-md-3 border-right">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Land <sup>*</sup></label>
                                <select name="country" class="form-control">
                                    <option value="DE ">Deutschland</option>
                                    <option value="AT">Österreich</option>
                                    <option value="NL">Niederlande</option>
                                    <option value="CH">Schweiz</option>
                                </select>
                                @error('country')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="css-control css-control-primary css-checkbox" style="margin-top: 24px;">
                                <input type="checkbox" class="css-control-input" name="send-credentials" checked>
                                <span class="css-control-indicator"></span> Zugangsdaten Zuschicken
                            </label>
                        </div>
                        <div id="passwordContainer" style="display: none; width: 100%">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Passwort <sup>*</sup></label>
                                    <input type="password" class="form-control" name="password">
                                    @error('password')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Passwort Bestätigen <sup>*</sup></label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                    @error('password_confirmation')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
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
    </form>
@endsection
@section('js_after')
    <script>

        $('input[name="send-credentials"]').change(function () {

            console.log("Changed");

            if ($(this).is(':checked')) {
                $('#passwordContainer').hide();
            } else {
                $('#passwordContainer').show();
            }

        });

    </script>
@endsection
