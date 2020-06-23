@extends('backend.layouts.backend')

@section('title', 'Produkte')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>

        .mySlides {
            display: none
        }

        img {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        .active {
            background-color: #717171;
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
            .prev, .next, .text {
                font-size: 11px
            }
        }
    </style>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif


    <h2 class="content-heading">
        <i class="scannel-icons icon-product"></i> Scannel Produkt: {{@$product->product_name}}
        <div class=" pull-right"> Status:
            @if($product->status == 'active')
                <span class="badge badge-success">Aktiv</span>
            @else
                <span class="badge badge-warning">Inaktiv</span>
            @endif
        </div>
    </h2>

    <form class="row" action="{{route('get.scannel.product')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div style="padding-right:10%;padding-left:2%;z-index: 10;position: relative;min-height: 1100px; width: 100%;">
            <!-- Haupt div-->

            <!-- first div-->
            <div style="display:flex;">
                <div style="padding:1px; width: 70%;"><!-- Table div-->
                    <table>
                        <tbody>

                        <tr>
                            <td>ID:</td>
                            <td><input name="id" readonly type="text" value="{{@$product->product_id}}"> | <a
                                    href="{{@$product->product_url}}" target="_blank"> Produkturl</a></td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td><input readonly name="name" size="50" type="text" value="{{@$product->product_name}}">
                            </td>
                        </tr>
                        <tr>
                            <td>Verkehrsname:</td>
                            <td><input readonly name="regulated_name" size="50" type="text"
                                       value="{{@$product->regulated_name}}"></td>
                        </tr>
                        <tr>
                            <td>EAN:</td>
                            <td><input readonly name="ean" size="50" type="text"
                                       value="{{@$product->eans()->first()->ean}}"></td>
                        </tr>

                        <tr>
                            <td>Quellentype:</td>
                            <td><input readonly name="src_type" size="50" type="text" value="{{@$product->src_type}}">
                            </td>
                        </tr>
                        <tr>
                            <td>Quelle:</td>
                            <td><input readonly name="source" size="50" type="text"
                                       value="{{@$product->bot_scan_source}}"></td>
                        </tr>
                        <tr>
                            <td>PZN:</td>
                            <td><input readonly name="pzn" size="50" type="text" value="{{@$product->pzn}}"></td>
                        </tr>
                        <tr>
                            <td>Hersteller:</td>
                            <td><input readonly name="producer" size="50" type="text" value="{{@$product->name}}"></td>
                        </tr>
                        <tr>
                            <td>Art:</td>
                            <td>

                                <input disabled name="type[]" value="food"
                                       type="checkbox" <?php  if (strpos($product->type, 'food') !== false) echo 'checked'; ?>>
                                Lebensmittel
                                <input disabled name="type[]" value="cosmetics"
                                       type="checkbox" <?php  if (strpos($product->type, 'cosmetics') !== false) echo 'checked'; ?>>
                                Kosmetika
                                <input disabled name="type[]" value="cleanser"
                                       type="checkbox" <?php  if (strpos($product->type, 'cleanser') !== false) echo 'checked'; ?>>
                                Reinigungsmittel
                                <input disabled name="type[]" value="feed"
                                       type="checkbox" <?php  if (strpos($product->type, 'feed') !== false) echo 'checked'; ?>>
                                Futtermittel
                            </td>
                        </tr>

                        <tr>
                            <td>Gütesiegel:</td>
                            <td><br>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div style="padding:1px; width: 40%;display:table">
                    <div style="display:table;width: 100%;"> <!-- Buttons div-->
                        <button class="btn btn-alt-primary" onclick="">APP Anischt</button>
                    </div>
                    <div style="width: 100%; border: 1px solid #ddd;"> <!-- Bild div-->
                        <div class="slideshow-container">
                            @if($product->images()->count() > 0)
                                @foreach($product->images()->get() as $pic)
                                    <div class="mySlides">
                                        <img src="{{$pic->getImageUrlAttribute()}}" style="width:100%">
                                        <div class="text">{{$pic->type}}</div>
                                    </div>

                                @endforeach
                            @else
                                kein Produktbild vorhanden
                            @endif
                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>
                        </div>
                    </div>

                </div>

            </div>

            <!-- text origi -->
            <div style="display:flex; padding:1px; width: 100%;">
                <textarea style="width:100%" readonly placeholder="keine Informationen vorhanden"
                          style="font-size: medium;" name="ingredienz_text_orig" id="oriText"
                          rows="4">{{$product->ingredienz_text_orig}}</textarea>
            </div>

            <!-- text buttons -->
            <div style="display:flex;padding:10px; width: 100%;">
                <div style="margin-left: auto;	margin-right: auto;">
                    <a class="btn btn-alt-primary-outline" href="{{route('get.scannel.products',$product->type)}}">Abbrechen</a>

                    @can('scannel-products.edit')
                        <a class="btn btn-alt-primary" href="{{route('get.scannel.openproduct',['edit' => $product->product_id])}}">Bearbeiten</a>
                    @endcan
                    <button class="btn btn-alt-primary pull-right" onclick="">Melden!</button>
                </div>
            </div>

            <!-- div dreimal-->
            <div style="display:flex;">

                <div hidden style="padding:1px; width: 33%;">
                    <div style="text-align:center;font-weight:bold;">Neu :</div>
                    <div id="new_ingrdients"
                         style="margin-left:3px;border: 1px solid;overflow:scroll; overflow-x: hidden;position:relative;height: 300px; width: 99%;float: left;">
                    </div>
                </div>
                <div style="padding:1px; width: 40%;">
                    <div style="text-align:center;font-weight:bold;">Zutaten :</div>
                    <div id="old_ingrdients"
                         style="margin-left:3px;border: 1px solid;overflow:scroll; overflow-x: hidden;position:relative;height: 300px; width: 99%;float: left;">

                        @foreach($product->ingredients()->get() as $ingre)
                            <div style="width: 95% !important;">{{$ingre->slug}}</div>
                        @endforeach
                    </div>
                </div>
                <div style="padding:1px; width: 55%;">

                    <!-- div Nährwerttabelle -->
                    <div
                        style="padding:1px; width: 100%;font-weight:bold;text-align:center;margin-left: auto;	margin-right: auto;">
                        Nährwerttabelle
                    </div>
                    <!-- div nährwerte-->
                    <div id="" style="margin-left:30px; position:relative;height: 300px; width: 99%;float: left;">
                        Nährwertangaben:
                        <input readonly type="text" name="naehrwertGrp_val" id="" value="100" size="4">
                        <select disabled name="naehrwertGrp_unit" id="">
                            <option value="0" selected="selected"></option>
                            @foreach($allunits as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>

                        <select disabled name="naehrwertGrp_state" id="">
                            .PREPARED.
                            <option value="PREPARED">zubereitet</option>
                            .UNPREPARED.
                            <option value="UNPREPARED" selected="selected">unzubereitet</option>
                        </select>
                        <div style="padding:1px; width: 40%;">
                            <div id="act_ingrdients"
                                 style="margin-left:3px; position:relative;height: 300px; width: 99%;float: left;">
                                <div style="background:#dfdfdf;margin-top:3px;position:absolute; ">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <!-- hiden helper fields -->
        <div id='naehrwertereihenfolge' hidden></div>
        <textarea name='naehrwertedb' id='naehrwertedb' hidden></textarea>
        <textarea hidden id='allIngredienzNames'></textarea>
        <textarea hidden id='allIgnoreAllways'></textarea>
        <textarea hidden id='allAutoEdit'></textarea>
        <textarea hidden id='ProductIngredientsDB'></textarea>
        <textarea hidden id='allergene_db'></textarea>

        <textarea hidden name='tosaveindb' id='tosaveindb'></textarea>
        <textarea hidden name='tosaveindb_IgnoreAllways' id='tosaveindb_IgnoreAllways'></textarea>
        <textarea hidden name='tosaveindb_allAutoEdit' id='tosaveindb_allAutoEdit'></textarea>

    </form>




@endsection

@section('js_after')

    <script src="{{ asset('js/pages/autocorrection.js') }}"></script>

    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            slides[slideIndex - 1].style.display = "block";
        }
    </script>

@endsection
