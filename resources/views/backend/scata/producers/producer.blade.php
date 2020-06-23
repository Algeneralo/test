@extends('backend.layouts.backend')

@section('title', 'Hersteller')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <style>
        img {
            padding: 4px;
            border-radius: 10px;
            margin-bottom: 25px;
            border: thin solid #707070;
        }

        button.edit {
            background-color: #3E9DE8;
            color: #fff;
        }

        button.delete {
            background-color: #676B70;
            color: #fff;
        }

        .btn-group {
            margin-bottom: 5px;
        }

    </style>
@endsection

@section('content')
    <h2 class="content-heading">
        <i class="scannel-icons icon-product"></i> Hersteller: {{$producer->name}}
    </h2>



    <!-- Dynamic Table Full -->
    <form class="row" action="{{route('post.scata.producer-update', ['producer' => $producer->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Produkt -->
        <div class="col-md-12">
            <div class="block block-form">
                @csrf
                <div class="block-header">
                    <h3 class="block-title">Hersteller</h3>
                </div>
                <div class="block-content block-content-full profile-info">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name"
                                       value="{{$producer->name}}">
                                @error('name')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>GLN</label>
                                <input type="text" class="form-control" name="gln"
                                       value="{{$producer->gln}}">
                                @error('name')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Straße und Hausnummer</label>
                                <input type="text" class="form-control" name="street" value="{{$producer->street}}">
                                @error('street')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Postleitzahlt</label>
                                <input type="text" class="form-control" name="zipcode" value="{{$producer->zipcode}}">
                                @error('zipcode')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ort</label>
                                <input type="text" class="form-control" name="city" value="{{$producer->city}}">
                                @error('city')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telefon</label>
                                <input type="text" class="form-control" name="phone" value="{{$producer->phone}}">
                                @error('street')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Fax</label>
                                <input type="text" class="form-control" name="fax" value="{{$producer->fax}}">
                                @error('zipcode')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>E-Mail</label>
                                <input type="text" class="form-control" name="email" value="{{$producer->email}}">
                                @error('city')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Webseite</label>
                                <input type="text" class="form-control" name="website" value="{{$producer->website}}">
                                @error('city')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="block block-form">
                <div class="block-footer">
                    <a class="btn btn-alt-primary-outline" href="{{route('get.scata.producers')}}">Abbrechen</a>
                    <button class="btn btn-alt-primary" type="submit">Speichern</button>
                </div>
            </div>
    </form>


@endsection

@section('js_after')
    <!-- SweetAlert2 -->
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>


    <script>

        $(".js-select2").select2();
        $(".js-select2-allow-create").select2({
            tags: true
        });

    </script>


@endsection
