@extends('backend.layouts.backend')

@section('title', 'Produkte')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/cropperjs/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
    <style>
        img {
            padding: 4px;
            border-radius: 10px;
            margin-bottom: 25px;
            border: thin solid #707070;
        }

        button.edit-image {
            background-color: #3E9DE8;
            color: #fff;
        }

        button.delete-image, button.rotate-left, button.rotate-right {
            background-color: #676B70;
            color: #fff;
        }

        .range-input {
            width: 100px;
            text-align: center;
            display: inline-block;
            padding-left: 10px;
        }

        .range-input input {
            width: 100px;
        }

        .rotate-container {
            display: inline-block;
        }

        .rotate-container button {
            margin-bottom: 15px;
        }

        .btn-group {
            margin-bottom: 5px;
        }

        .nutrient-list {
            margin-top: 30px;
            padding-left: 0;
        }

        .nutrient-list li {
            list-style: none;
        }

        .nutrient-list li .input-group {
            padding: 5px;
            background-color: rgba(62, 157, 232, 0.3);
        }

        .nutrient-list li .input-group label {
            width: 30%;
            line-height: 34px;
            margin-bottom: 0;
        }

        .nutrient-list li ul {
            padding-left: 0;
        }

        .nutrient-list li ul li .input-group {
            background-color: transparent;
        }

        .nutrient-list li ul li .input-group label {
            width: 30%;
            padding-left: 20px;
            font-size: 12px;
        }
    </style>
@endsection

@php

    $nutrients = [
        'fat' => [
            'fatat',
            'famscis',
            'fapucis'
        ],
        'choavl' => [
            'sugar-'
        ],
        'pro-' => null,
        'salteq' => null,
        'fibtg' => null,
        'polyl' => null,
        'starch' => null,
        'biot' => null,
        'ca' => null,
        'cld' => null,
        'cr' => null,
        'cu' => null,
        'fd' => null,
        'fe' => null,
        'foldfe' => null,
        'id' => null,
        'k' => null,
        'mg' => null,
        'mn' => null,
        'mo' => null,
        'na' => null,
        'nia' => null,
        'p' => null,
        'pantac' => null,
        'ribf' => null,
        'se' => null,
        'thia' => null,
        'vita-' => null,
        'vitb12' => null,
        'vitb6-' => null,
        'vitc-' => null,
        'vitd-' => null,
        'vite-' => null,
        'vitk' => null,
        'zn' => null,
        'fructose' => null,
        'lactose' => null,
        'glc' => null,
        'maltose' => null,
        'sucrose' => null,
        'carnitin' => null,
        'chlorid' => null,
        'fluorid' => null,
        'inositol' => null,
        'lcp' => null,
        'cholin' => null,
        'ala' => null,
        'aa' => null,
        'dha' => null,
        'linoleidacid' => null,
        'taurin' => null,
        'omega-3' => null,
        'omega-6' => null,
        'beta-carotin' => null,
        'glucomannan' => null,
        'epa' => null,
        'g_hc' => null,
        's4+' => null,
        'nacl' => null,
        'edta' => null,
    ]

@endphp

@section('content')
    <h2 class="content-heading">
        <i class="scannel-icons icon-product"></i> Produkt: {{$product->product_name}}
    </h2>

    <!-- Dynamic Table Full -->
    <form class="row" action="{{route('post.scata.product-update', ['product' => $product->product_id])}}" method="post"
          enctype="multipart/form-data">
    @csrf
    <!-- Produkt -->
        <div class="col-md-12">
            <div class="block block-form">
                @csrf
                <div class="block-header">
                    <h3 class="block-title">Produkt</h3>
                </div>
                <div class="block-content block-content-full profile-info">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Produktbezeichnung</label>
                                <input type="text" class="form-control" name="productname"
                                       value="{{$product->product_name}}">
                                @error('productname')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4 text-center">
                            @foreach($product->images->where('type', 'product') as $image)
                                <img src="{{$image->imageUrl}}" class="img-fluid image mx-auto d-block"
                                     data-type="product">
                                <button type="button" class="btn btn-sm edit-image" data-type="product">Bearbeiten
                                </button>
                                <button type="button" class="btn btn-sm delete-image" data-type="product">Löschen
                                </button>
                                <!--<button type="button" class="btn btn-alt-primary-outline">OCR</button>-->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="block block-form">
                @csrf
                <div class="block-header">
                    <h3 class="block-title">EAN</h3>
                </div>
                <div class="block-content block-content-full profile-info">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>EAN</label>
                                <input type="text" class="form-control" name="ean"
                                       value="{{$product->eans()->first()['ean']}}">
                                @error('ean')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4 text-center">
                            @foreach($product->images->where('type', 'ean') as $image)
                                <img src="{{$image->imageUrl}}" class="img-fluid image mx-auto d-block" data-type="ean">
                                <button type="button" class="btn btn-sm edit-image" data-type="ean">Bearbeiten</button>
                                <button type="button" class="btn btn-sm delete-image" data-type="ean">Löschen</button>
                                <!--<button type="button" class="btn btn-alt-primary-outline">OCR</button>-->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="block block-form">
                @csrf
                <div class="block-header">
                    <h3 class="block-title">Inhaltsstoffe</h3>
                </div>
                <div class="block-content block-content-full profile-info">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Verkehrsbezeichnung</label>
                                <input type="text" class="form-control" name="regulated_name"
                                       value="{{$product->regulated_name}}">
                                @error('label')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Inhaltsstoffe</label>
                                <textarea type="text" class="form-control" name="ingredients">
                                    @foreach($product->ingredients as $ingredient){{$ingredient->name[app()->getLocale()]}}
                                    , @endforeach
                                </textarea>
                                @error('label')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            @foreach($product->images->where('type', 'like', 'ingredients_1') as $image)
                                <img src="{{$image->imageUrl}}" class="img-fluid image mx-auto d-block"
                                     data-type="ingredients_1">
                                <button type="button" class="btn btn-sm edit-image" data-type="ingredients_1">
                                    Bearbeiten
                                </button>
                                <button type="button" class="btn btn-sm delete-image" data-type="ingredients_1">
                                    Löschen
                                </button>
                            @endforeach
                        </div>
                        <div class="col-md-4 text-center">
                            @foreach($product->images->where('type', 'like', 'ingredients_2') as $image)
                                <img src="{{$image->imageUrl}}" class="img-fluid image mx-auto d-block"
                                     data-type="ingredients_2">
                                <button type="button" class="btn btn-sm edit-image" data-type="ingredients_2">
                                    Bearbeiten
                                </button>
                                <button type="button" class="btn btn-sm delete-image" data-type="ingredients_2">
                                    Löschen
                                </button>
                            @endforeach
                        </div>
                        <div class="col-md-4 offset-md-4 text-center" style="margin-top: 20px;">
                            @foreach($product->images->where('type', 'like', 'ingredients_3') as $image)
                                <img src="{{$image->imageUrl}}" class="img-fluid image mx-auto d-block"
                                     data-type="ingredients_3">
                                <button type="button" class="btn btn-sm edit-image" data-type="ingredients_3">
                                    Bearbeiten
                                </button>
                                <button type="button" class="btn btn-sm delete-image" data-type="ingredients_3">
                                    Löschen
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="block block-form">
                @csrf
                <div class="block-header">
                    <h3 class="block-title">Nähstoffe</h3>
                </div>
                <div class="block-content block-content-full profile-info">
                    <div class="row">
                        <div class="col-md-8">

                            @php

                                if($nutrientgroup = $product->nutrients->first()) {
                                    $value = $nutrientgroup->servingsizeVal;
                                    $state = $nutrientgroup->preparationstate;
                                    $dbunit = $nutrientgroup->servingsizeUnit;
                                } else {
                                    $value = '0';
                                    $state = '';
                                    $dbunit = '';
                                }

                            @endphp

                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" type="number" value="{{$value}}" step="0.01" name="nutrientgroup[value]">
                                    <select class="js-select2 form-control" name="nutrientgroup[unit]">
                                        @foreach(config('scannel.general.units') as $unit) {
                                            <option value="{{$unit}}" @if($dbunit == $unit) selected="selected" @endif>@lang('units.' . $unit)</option>
                                        @endforeach
                                    </select>
                                    <select class="js-select2 form-control"name=" nutrientgroup[state]">
                                        <option value="prepared" @if($state == 'prepared') selected="selected" @endif>Zubereitet</option>
                                        <option value="unprepared" @if($state == 'unprepared') selected="selected" @endif>unzubereitet</option>
                                    </select>
                                </div>

                                <ul class="nutrient-list">
                                    <li>

                                        @php

                                            if($product->nutrients->first() && $nutrient = $product->nutrients->first()->nutrients->where('nutrient', 'ener-')->first()) {
                                                $value = $nutrient->val;
                                                $dbprecision = $nutrient->precision;
                                                $dbunit = $nutrient->unit;
                                            } else {
                                                $value = '';
                                                $dbprecision = '';
                                                $dbunit = '';
                                            }

                                        @endphp

                                        <div class="input-group">
                                            <label>@lang('nutrients.ener-')</label>
                                            <select class="js-select2 form-control" name="nutrients[ener-][precision]">
                                                @foreach(config('scannel.general.precision') as $precision) {
                                                <option value="{{$precision}}" @if($dbprecision == $precision) selected="selected" @endif>@lang('precision.' . $precision)</option>
                                                @endforeach
                                            </select>
                                            <input class="form-control" type="number" step="0.01" name="nutrients[ener-][value]" value="{{$value}}">
                                            <select class="js-select2 form-control" name="nutrients[ener-][unit]">
                                                <option value="e14" @if($dbunit == 'e14') selected="selected" @endif>Kilokalorien</option>
                                                <option value="kj0" @if($dbunit == 'kj0') selected="selected" @endif>Kilojoule</option>
                                            </select>
                                        </div>
                                    @foreach($nutrients as $key => $subkeys)
                                        <li>

                                            @php

                                                if($product->nutrients->first() && $nutrient = $product->nutrients->first()->nutrients->where('nutrient', $key)->first()) {
                                                    $value = $nutrient->val;
                                                    $dbprecision = $nutrient->precision;
                                                    $dbunit = $nutrient->unit;
                                                } else {
                                                    $value = '';
                                                    $dbprecision = '';
                                                    $dbunit = '';
                                                }

                                            @endphp

                                            <div class="input-group">
                                                <label>@lang('nutrients.' . $key)</label>
                                                <select class="js-select2 form-control" name="nutrients[{{$key}}][precision]">
                                                    @foreach(config('scannel.general.precision') as $precision) {
                                                    <option value="{{$precision}}" @if($dbprecision == $precision) selected="selected" @endif>@lang('precision.' . $precision)</option>
                                                    @endforeach
                                                </select>
                                                <input class="form-control" type="number" step="0.01" name="nutrients[{{$key}}][value]" value="{{$value}}">
                                                <select class="js-select2 form-control" name="nutrients[{{$key}}][unit]">
                                                    @foreach(config('scannel.general.units') as $unit) {
                                                        <option value="{{$unit}}" @if($dbunit == $unit) selected="selected" @endif>@lang('units.' . $unit)</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <ul>
                                                @if($subkeys != null)
                                                    @foreach($subkeys as $subkey)

                                                        @php

                                                            if($product->nutrients->first() && $nutrient = $product->nutrients->first()->nutrients->where('nutrient', $subkey)->first()) {
                                                                $value = $nutrient->val;
                                                                $dbprecision = $nutrient->precision;
                                                                $dbunit = $nutrient->unit;
                                                            } else {
                                                                $value = '';
                                                                $dbprecision = '';
                                                                $dbunit = '';
                                                            }

                                                        @endphp

                                                        <li>
                                                            <div class="input-group">
                                                                <label>@lang('nutrients.' . $subkey)</label>
                                                                <select class="js-select2 form-control" name="nutrients[{{$subkey}}][precision]">
                                                                    @foreach(config('scannel.general.precision') as $precision) {
                                                                    <option value="{{$precision}}" @if($dbprecision == $precision) selected="selected" @endif>@lang('precision.' . $precision)</option>
                                                                    @endforeach
                                                                </select>
                                                                <input class="form-control" type="number" step="0.01" name="nutrients[{{$subkey}}][value]" value="{{$value}}">
                                                                <select class="js-select2 form-control" name="nutrients[{{$subkey}}][unit]">
                                                                    @foreach(config('scannel.general.units') as $unit) {
                                                                    <option value="{{$unit}}" @if($dbunit == $unit) selected="selected" @endif>@lang('units.' . $unit)</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            @foreach($product->images->where('type', 'nutrients_1') as $image)
                                <img src="{{$image->imageUrl}}" class="img-fluid image mx-auto d-block"
                                     data-type="nutrients_1">
                                <button type="button" class="btn btn-sm edit-image" data-type="nutrients_1">Bearbeiten
                                </button>
                                <button type="button" class="btn btn-sm delete-image" data-type="nutrients_1">Löschen
                                </button>
                                <!--<button type="button" class="btn btn-alt-primary-outline">OCR</button>-->
                            @endforeach
                            <div style="height: 30px; width: 100px">
                            </div>
                            @foreach($product->images->where('type', 'nutrients_2') as $image)
                                <img src="{{$image->imageUrl}}" class="img-fluid image mx-auto d-block"
                                     data-type="nutrients_2">
                                <button type="button" class="btn btn-sm edit-image" data-type="nutrients_2">Bearbeiten
                                </button>
                                <button type="button" class="btn btn-sm delete-image" data-type="nutrients_2">Löschen
                                </button>
                                <!--<button type="button" class="btn btn-alt-primary-outline">OCR</button>-->
                                <div style="height: 30px; width: 100px"></div>
                            @endforeach
                            <div style="height: 30px; width: 100px">
                            </div>
                            @foreach($product->images->where('type', 'nutrients_3') as $image)
                                <img src="{{$image->imageUrl}}" class="img-fluid image mx-auto d-block"
                                     data-type="nutrients_3">
                                <button type="button" class="btn btn-sm edit-image" data-type="nutrients_3">Bearbeiten
                                </button>
                                <button type="button" class="btn btn-sm delete-image" data-type="nutrients_3">Löschen
                                </button>
                                <!--<button type="button" class="btn btn-alt-primary-outline">OCR</button>-->
                                <div style="height: 30px; width: 100px"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="block block-form">
                @csrf
                <div class="block-header">
                    <h3 class="block-title">Hersteller</h3>
                </div>
                <div class="block-content block-content-full profile-info">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hersteller</label>
                                <select class="js-select2-allow-create form-control" style="width: 100%;"
                                        name="producer">
                                    @foreach($producers as $producer)
                                        <option value="{{$producer->id}}"
                                                @if($product->producer()->find($producer->id)) selected @endif>{{$producer->name}}</option>
                                    @endforeach
                                </select>
                                @error('producer')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4 text-center">
                            @foreach($product->images->where('type', 'company') as $image)
                                <img src="{{$image->imageUrl}}" class="img-fluid image mx-auto d-block"
                                     data-type="company">
                                <button type="button" class="btn btn-sm edit-image" data-type="company">Bearbeiten
                                </button>
                                <button type="button" class="btn btn-sm delete-image" data-type="company">Löschen
                                </button>
                                <!--<button type="button" class="btn btn-alt-primary-outline">OCR</button>-->
                                <div style="height: 30px; width: 100px"></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="block block-form">
                @csrf
                <div class="block-header">
                    <h3 class="block-title">Gütesiegel</h3>
                </div>
                <div class="block-content block-content-full profile-info">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gütesiegel</label>
                                <select class="js-select2 form-control" name="quality[]" style="width: 100%;" multiple>
                                    @foreach($qualityseals as $qualityseal)
                                        <option value="{{$qualityseal->id}}"
                                                @if($product->qualityseals()->find($qualityseal->id)) selected @endif>{{$qualityseal->name}}</option>
                                    @endforeach
                                </select>
                                @error('quality')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            @foreach($product->images->where('type', 'qualitySealer_1') as $image)
                                <img src="{{$image->imageUrl}}" class="img-fluid image mx-auto d-block"
                                     data-type="qualitySealer_1">
                                <button type="button" class="btn btn-sm edit-image" data-type="qualitySealer_1">
                                    Bearbeiten
                                </button>
                                <button type="button" class="btn btn-sm delete-image" data-type="qualitySealer_1">
                                    Löschen
                                </button>
                                <!--<button type="button" class="btn btn-alt-primary-outline">OCR</button>-->
                            @endforeach
                        </div>
                        <div class="col-md-4 text-center">
                            @foreach($product->images->where('type', 'qualitySealer_2') as $image)
                                <img src="{{$image->imageUrl}}" class="img-fluid image mx-auto d-block"
                                     data-type="qualitySealer_2">
                                <button type="button" class="btn btn-sm edit-image" data-type="qualitySealer_2">
                                    Bearbeiten
                                </button>
                                <button type="button" class="btn btn-sm delete-image" data-type="qualitySealer_2">
                                    Löschen
                                </button>
                                <!--<button type="button" class="btn btn-alt-primary-outline">OCR</button>-->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="block block-form">
                <div class="block-footer">
                    <a class="btn btn-alt-primary-outline" href="{{route('get.scata.products')}}">Abbrechen</a>
                    <button class="btn btn-alt-primary" type="submit">Speichern</button>
                </div>
            </div>
        </div>
    </form>


    <!-- Image Editor -->
    <div class="modal" tabindex="-1" role="dialog" id="edit-image">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Bild bearbeiten</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="">
                        <img style="max-height: 500px">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="mr-auto">
                        <div class="rotate-container">
                            <button type="button" class="btn rotate-left"><i class="fa fa-rotate-left"></i></button>
                            <button type="button" class="btn rotate-right"><i class="fa fa-rotate-right"></i></button>
                        </div>
                        <div class="range-input">
                            <input type="range" name="brightness" min="0" max="200" step="1" value="100">
                            <label>Helligkeit</label>
                        </div>
                        <div class="range-input">
                            <input type="range" name="contrast" min="0" max="200" step="1" value="100">
                            <label>Kontrast</label>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-alt-primary-outline" data-dismiss="modal">Abbrechen
                        </button>
                        <button type="button" class="btn btn-alt-primary save" data-dismiss="modal">Speichern</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js_after')
    <!-- SweetAlert2 -->
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins/cropperjs/cropper.js') }}"></script>
    <script src="{{ asset('js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>

    <script>

        var cropper;
        var contrast;
        var brightness;
        var product = {!! $product->product_id !!};
        var imagetype;

        $('.js-rangeslider').ionRangeSlider({
            type: 'single',
            min: 0,
            max: 200,
        });

        $(".js-select2").select2();
        $(".js-select2-allow-create").select2({
            tags: true
        });

        $('button.start-ocr').on('click', function () {

            var ocrurl = $(this).data('ocrurl');
            console.log(ocrurl);

            Swal.fire({
                title: 'Möchtest du OCR starten?',
                text: "Die aktion wird im Hintergrund ausgeführt. Beim nächsten Besuch dieser Seite solltest du das Ergebnis sehen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ja',
                cancelButtonText: 'Nein',
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        method: 'GET',
                        url: ocrurl
                    });

                }
            })

        });

        $('button.edit-image').on('click', function () {


            imagetype = $(this).data('type');
            var image = $('img.image[data-type="' + imagetype + '"]').attr('src');

            contrast = 100;
            brightness = 100;

            $('#edit-image img').attr('src', image);
            $('#edit-image').modal('show');


        });

        $('#edit-image').on('shown.bs.modal', function () {
            cropper = new Cropper($('#edit-image img')[0], {
                autoCropArea: 0.95,
                viewMode: 0,
                strict: true
            });

        });

        $('#edit-image input[name="contrast"]').on('change', function () {

            contrast = $(this).val();

            var cssContrast = 'contrast(' + $(this).val() + '%)';

            $('#edit-image img').css('filter', cssContrast);

        });

        $('#edit-image input[name="brightness"]').on('change', function () {

            brightness = $(this).val();

            var cssBrightness = 'brightness(' + $(this).val() + '%)';

            $('#edit-image img').css('filter', cssBrightness);

        });

        $('#edit-image button.rotate-right').on('click', function () {

            cropper.rotate(90);

        });

        $('#edit-image button.rotate-left').on('click', function () {

            cropper.rotate(-90);

        });

        $('#edit-image button.save').on('click', function () {

            console.log({
                crop: cropper.cropBoxData,
                brightness: brightness,
                contrast: contrast,
                product: product,
                type: imagetype
            });

            var data = {
                contrast: contrast,
                crop: cropper.getData(),
                brightness: brightness
            };

            /*data.append('image', $('img.imageToEdit[target-id="' + targetid + '"]').attr('src'));
            data.append('contrast', contrast[targetid]);*/


            console.log(data);

            $.ajax({
                url: '/scata/product/image/' + product + '/' + imagetype + '/edit',
                type: 'POST',
                data: JSON.stringify(data),
                processData: false,
                contentType: 'application/json',
                success: function () {

                    $('img.image[data-type="' + imagetype + '"]').attr('src', cropper.getCroppedCanvas().toDataURL('image/jpeg'));


                },
                error: function () {

                    Swal.fire({
                        icon: 'error',
                        title: 'Da ging etwas schief...',
                        text: 'Leider konnten deine Änderungen nicht gespeichert werden. Versuche es erneut.',
                    })

                },
                complete: function () {

                    cropper.destroy();

                }
            });


        });

    </script>


@endsection
