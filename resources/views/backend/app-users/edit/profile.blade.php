<form class="row" action="{{route('post.update-app-user-profile', ['user' => $user->id, 'profile' => $profile->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-md-9">
        <div class="block block-form">
            @csrf
            <div class="block-header">
                <h3 class="block-title">{{$profile->scannelid}} - {{$profile->name}}</h3>
            </div>
            <div class="block-content block-content-full profile-info">
                <div class="row">
                    <div class="col col-md-4 border-right">
                        <div class="row">
                            <div class="col-md-12">

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Vorname <sup>*</sup></label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-username" name="scannelid" value="{{$profile->firstname}}">
                                    @error('firstname')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nachname <sup>*</sup></label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-name" name="email" value="{{$profile->lastname}}">
                                    @error('lastname')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-4 border-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Geburtsdatum <sup>*</sup></label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-name" name="email" value="{{$profile->date_of_birth}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mobilfunknummer</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-name" name="email" value="{{$profile->phone}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Körpergröße</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-name" name="email" value="{{$profile->height}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Gewicht</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-name" name="email" value="{{$profile->wight}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-footer">
                <button class="btn btn-alt-primary" type="submit">Speichern</button>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="block block-form">
            <div class="block-header">
                <h3 class="block-title">Profilbild</h3>
            </div>
            <div class="block-content block-content-full profile-avatar text-center">
                <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{URL::signedRoute('profile-avatar', ['profile' => $profile->id])}}" alt="">
                <p class="filename">Keine Datei ausgewählt</p>
            </div>
            <div class="block-footer">
                <label class="btn btn-alt-primary-outline">
                    Hochladen <input type="file" hidden name="file">
                </label>
            </div>
        </div>
    </div>
</form>

