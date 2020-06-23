@extends('backend.layouts.backend')

@section('title', 'Mitarbeiter bearbeiten')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <style>
        .block-header {
            border-bottom: thin solid rgba(108, 117, 125, 0.1);
        }

        .block-header h3 {
            text-transform: uppercase;
        }

        .block-form .col.border-right {
            border-right: thin solid rgba(108, 117, 125, 0.1);
        }

        .block-footer {
            padding: 20px 36px;
            border-top: thin solid rgba(108, 117, 125, 0.1);
            text-align: right;
        }
    </style>
@endsection

@section('content')
    <h2 class="content-heading">
        <i class="scannel-icons icon-employee"></i> Mitarbeiter bearbeiten
    </h2>

    <form class="block block-form" method="post" action="{{route('post.update-admin', ['admin' => $user->admin_id])}}">
        @csrf
        <div class="block-header">
            <h3 class="block-title">Mitarbeiterinformationen</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col col-md-3 border-right">
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Vorname <sup>*</sup></label>
                                <input type="text" class="form-control" name="firstname"
                                       value="{{ (old('firstname')) ? old('firstname') : $user->firstname }}">
                                @error('firstname')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nachname <sup>*</sup></label>
                                <input type="text" class="form-control" name="lastname"
                                       value="{{ (old('lastname')) ? old('lastname') : $user->lastname }}">
                                @error('lastname')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
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
                <div class="col col-md-3 border-right">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Firma</label>
                                <input type="text" class="form-control" name="company"
                                       value="{{ (old('company')) ? old('company') : $user->company }}">
                                @error('company')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>E-Mail <sup>*</sup></label>
                                <input type="email" class="form-control" name="email"
                                       value="{{ (old('email')) ? old('email') : $user->email }}">
                                @error('email')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Sprache <sup>*</sup></label>
                                <select class="js-select2 form-control" name="lang"
                                        value="{{ (old('lang')) ? old('lang') : $user->lang }}">
                                    <option value="AF">Afrikaans</option>
                                    <option value="SQ">Albanian</option>
                                    <option value="AR">Arabic</option>
                                    <option value="HY">Armenian</option>
                                    <option value="EU">Basque</option>
                                    <option value="BN">Bengali</option>
                                    <option value="BG">Bulgarian</option>
                                    <option value="CA">Catalan</option>
                                    <option value="KM">Cambodian</option>
                                    <option value="ZH">Chinese (Mandarin)</option>
                                    <option value="HR">Croatian</option>
                                    <option value="CS">Czech</option>
                                    <option value="DA">Danish</option>
                                    <option value="NL">Dutch</option>
                                    <option value="EN">English</option>
                                    <option value="ET">Estonian</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FI">Finnish</option>
                                    <option value="FR">French</option>
                                    <option value="KA">Georgian</option>
                                    <option value="DE" selected>German</option>
                                    <option value="EL">Greek</option>
                                    <option value="GU">Gujarati</option>
                                    <option value="HE">Hebrew</option>
                                    <option value="HI">Hindi</option>
                                    <option value="HU">Hungarian</option>
                                    <option value="IS">Icelandic</option>
                                    <option value="ID">Indonesian</option>
                                    <option value="GA">Irish</option>
                                    <option value="IT">Italian</option>
                                    <option value="JA">Japanese</option>
                                    <option value="JW">Javanese</option>
                                    <option value="KO">Korean</option>
                                    <option value="LA">Latin</option>
                                    <option value="LV">Latvian</option>
                                    <option value="LT">Lithuanian</option>
                                    <option value="MK">Macedonian</option>
                                    <option value="MS">Malay</option>
                                    <option value="ML">Malayalam</option>
                                    <option value="MT">Maltese</option>
                                    <option value="MI">Maori</option>
                                    <option value="MR">Marathi</option>
                                    <option value="MN">Mongolian</option>
                                    <option value="NE">Nepali</option>
                                    <option value="NO">Norwegian</option>
                                    <option value="FA">Persian</option>
                                    <option value="PL">Polish</option>
                                    <option value="PT">Portuguese</option>
                                    <option value="PA">Punjabi</option>
                                    <option value="QU">Quechua</option>
                                    <option value="RO">Romanian</option>
                                    <option value="RU">Russian</option>
                                    <option value="SM">Samoan</option>
                                    <option value="SR">Serbian</option>
                                    <option value="SK">Slovak</option>
                                    <option value="SL">Slovenian</option>
                                    <option value="ES">Spanish</option>
                                    <option value="SW">Swahili</option>
                                    <option value="SV">Swedish</option>
                                    <option value="TA">Tamil</option>
                                    <option value="TT">Tatar</option>
                                    <option value="TE">Telugu</option>
                                    <option value="TH">Thai</option>
                                    <option value="BO">Tibetan</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TR">Turkish</option>
                                    <option value="UK">Ukrainian</option>
                                    <option value="UR">Urdu</option>
                                    <option value="UZ">Uzbek</option>
                                    <option value="VI">Vietnamese</option>
                                    <option value="CY">Welsh</option>
                                    <option value="XH">Xhosa</option>
                                </select>
                                @error('lang')
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
                                <label>Telefonnummer (Privat)</label>
                                <input type="tel" class="form-control" name="phone_private"
                                       value="{{ (old('phone_private')) ? old('phone_private') : $user->phone_private }}">
                                @error('phone_private')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Telefonnummer (Mobil)</label>
                                <input type="tel" class="form-control" name="phone_mobile"
                                       value="{{ (old('phone_mobile')) ? old('phone_mobile') : $user->phone_mobile }}">
                                @error('phone_mobile')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Telefonnummer (SIP)</label>
                                <input type="tel" class="form-control" name="sip"
                                       value="{{ (old('sip')) ? old('sip') : $user->sip }}">
                                @error('sip')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Gruppe</label>
                                <select class="js-select2 form-control" name="group_id"
                                        value="{{ (old('group_id')) ? old('group_id') : $user->group_id }}">
                                    @foreach($groups as $group)
                                        <option value="{{$group->group_id}}"
                                                @if($group->group_id == $user->group_id) selected @endif>{{$group->name}}</option>
                                    @endforeach
                                </select>
                                @error('group')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Rolle</label>
                                <select class="js-select2 form-control" name="roles[]" multiple
                                        value="{{ (old('role')) ? old('role') : $user->role }}">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" @if($user->hasRole($role->name)) selected @endif>
                                            {{$role->name}}</option>
                                       @endforeach
                                </select>
                                @error('roles')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-footer">
            <a class="btn btn-alt-primary-outline" href="{{route('get.admin-users')}}">Abbrechen</a>
            <button class="btn btn-alt-primary" type="submit">Speichern</button>
        </div>
    </form>
@endsection

@section('js_after')

    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>

        $(".js-select2").select2();
        $(".js-select2-allow-create").select2({
            tags: true
        });

    </script>
@endsection
