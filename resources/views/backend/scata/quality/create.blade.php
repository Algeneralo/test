@extends('backend.layouts.backend')

@section('title', 'Gütesiegel hinzufügen')

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
        <i class="scannel-icons icon-product"></i> Gütesiegel hinzufügen
    </h2>



    <!-- Dynamic Table Full -->
    <form class="row" action="{{route('post.scata.quality-create')}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Produkt -->
        <div class="col-md-9">
            <div class="block block-form">
                @csrf
                <div class="block-header">
                    <h3 class="block-title">Gütesiegel</h3>
                </div>
                <div class="block-content block-content-full quality-info">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name">
                                @error('name')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Beschreibung</label>
                                <textarea type="text" class="form-control" name="description"></textarea>
                                @error('description')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="block block-form">
                <div class="block-footer">
                    <a class="btn btn-alt-primary-outline" href="{{route('get.scata.qualities')}}">Abbrechen</a>
                    <button class="btn btn-alt-primary" type="submit">Speichern</button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="block block-form">
                <div class="block-header">
                    <h3 class="block-title">Bild</h3>
                </div>
                <div class="block-content block-content-full quality-logo text-center">
                    <i class="fa fa-times" style="font-size: 96px"></i>
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

        $(document).ready(function() {

            var height = $('.quality-info').height();

            $('.quality-logo').height(height);

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
