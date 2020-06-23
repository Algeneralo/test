@extends('backend.layouts.backend')

@section('title', 'Produkte')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
    .mySlides {display: none}
    img {vertical-align: middle;}

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
        background-color: rgba(0,0,0,0.8);
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
        .prev, .next,.text {font-size: 11px}
        }

        .ingred_div {
            padding: 2px 2px 2px 4px;
            color: #000;
            width: 99% !important;
        }
        .ingred_div:hover {background: #bbb; color: #000;TEXT-DECORATION: none}

            .custom-file-input {
                opacity:1 !important;
                width:70%  !important;
                float: right;
            }
            .custom-file-input::-webkit-file-upload-button {
                visibility: hidden;
            }
            .custom-file-input::before {
                content: 'auswählen...';
                color: #3E9DE8;
                display: inline-block;
                background: -webkit-linear-gradient(top, white, white);
                border: 1px solid #3E9DE8;
                border-radius: 3px;
                padding: 5px 8px;
                outline: none;
                white-space: nowrap;
                -webkit-user-select: none;
                cursor: pointer;
                text-shadow: 1px 1px #fff;
                font-weight: 700;
                font-size: 10pt;
            }
            .custom-file-input:hover::before {
                color: #4faef9;
            }
            .custom-file-input:active {
                outline: 0;
            }
            .custom-file-input:active::before {
                background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9); 
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
        <i class="scannel-icons icon-product"></i> Bearbeiten: {{@$product->product_name}}
        <div class=" pull-right"> Status:                             
                            @if($product->status == 'active')
                                <span class="badge badge-success">Aktiv</span>
                            @else
                                <span class="badge badge-warning">Inaktiv</span>
                            @endif
        </div>
    </h2>

    <form class="row" action="{{route('post.saveproduct')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div style="padding-right:10%;padding-left:2%;position: relative;min-height: 1100px; width: 100%;"><!-- Haupt div-->
        
        <!-- first div-->
        <div style="display:flex;">
            <div style="padding:1px; width: 70%;"><!-- Table div-->
                <table><tbody>

                    <tr><td>ID: </td><td><input name="id"   readonly type="text" value="{{@$product->product_id}}"> | <a href="{{@$product->product_url}}" target="_blank"> Produkturl</a></td></tr>
                    <tr><td>Name: </td><td><input name="name" size="50" type="text" value="{{@$product->product_name}}"></td></tr>
                    <tr><td>Verkehrsname: </td><td><input name="regulated_name" size="50" type="text" value="{{@$product->regulated_name}}"></td></tr>
                    <tr><td>EAN: </td><td><input name="ean" size="50" type="text" value="{{@$product->eans()->first()->ean}}"></td></tr>

                    <tr><td>Quellentype: </td><td><input name="src_type" size="50" type="text" value="{{@$product->src_type}}"></td></tr>
                    <tr><td>Quelle: </td><td><input name="source" size="50" type="text" value="{{@$product->bot_scan_source}}"></td></tr>
                    <tr><td>PZN: </td><td><input name="pzn" size="50" type="text" value="{{@$product->pzn}}"></td></tr>
                    <tr><td>Hersteller: </td><td><input name="producer" size="50" type="text" value="{{@$product->name}}"></td></tr>
                    <tr><td>Art: </td><td>

                    <input  name="type[]" value="food" type="checkbox" <?php  if(strpos( $product->type,'food') !== false  ) echo 'checked'; ?>> Lebensmittel 
                    <input  name="type[]" value="cosmetics" type="checkbox" <?php  if(strpos( $product->type,'cosmetics')  !== false) echo 'checked'; ?>> Kosmetika 
                    <input  name="type[]" value="cleanser" type="checkbox" <?php  if(strpos( $product->type,'cleanser') !== false ) echo 'checked'; ?>> Reinigungsmittel 
                    <input  name="type[]" value="feed" type="checkbox" <?php  if(strpos( $product->type,'feed')  !== false ) echo 'checked'; ?>> Futtermittel 
                  </td></tr>

                    <tr><td>Gütesiegel: </td>
                    <td><br><input size="6" id="newGueteSiegel" type="text">
                 <button class="btn btn-alt-primary" onclick="addGueteSiegel();">add</button>
                
                </td></tr></tbody>
                </table>
            </div>
            <div style="padding:1px; width: 40%;display:table">
                <div style="display:table;width: 100%;"> <!-- Buttons div-->
                    <button class="btn btn-alt-primary" onclick="">APP Anischt</button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-alt-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Bilder Hochladen
                            </button>

                            <div style="min-width:500px;"class="dropdown-menu dropdown-menu-right">
                                <label style="width:100%;margin-top:4px;" class="btn btn-alt-primary-outline">
                                    Produktbild <input type="file"  name="file_main" class="custom-file-input">
                                </label>
                                <label style="width:100%;margin-top:4px;" class="btn btn-alt-primary-outline">
                                    EAN-Bild <input type="file"  name="file_ean" class = "custom-file-input">
                                </label>   
                                <label style="width:100%;margin-top:4px;" class="btn btn-alt-primary-outline">
                                    Ingredients 1 <input type="file"  name="file_ingredients_1"  class="custom-file-input">
                                </label>   
                                <label style="width:100%;margin-top:4px;" class="btn btn-alt-primary-outline">
                                    Ingredients 2 <input type="file"  name="file_ingredients_2"  class="custom-file-input">
                                </label>   
                                <label style="width:100%;margin-top:4px;" class="btn btn-alt-primary-outline">
                                    Ingredients 3 <input type="file"  name="file_ingredients_3"  class="custom-file-input">
                                </label>   

                                <label style="width:100%;margin-top:4px;" class="btn btn-alt-primary-outline">
                                    Nutrients 1<input type="file"  name="file_nutrients_1"  class="custom-file-input">
                                </label>   
                                <label style="width:100%;margin-top:4px;" class="btn btn-alt-primary-outline">
                                    Nutrients 2<input type="file"  name="file_nutrients_2"  class="custom-file-input">
                                </label>   
                                <label style="width:100%;margin-top:4px;" class="btn btn-alt-primary-outline">
                                    Nutrients 3<input type="file"  name="file_nutrients_3"  class="custom-file-input">
                                </label>   


                            </div>
                        </div>

                </div>
                <div style="margin-top:10px;width: 100%; border: 1px solid #ddd;"> <!-- Bild div-->
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
            <textarea style="width:100%" placeholder="keine Informationen vorhanden" style="font-size: medium;" name="ingredienz_text_orig" id="oriText" rows="4">{{$product->ingredienz_text_orig}}</textarea>
        </div>



        <!-- text erkannt -->
        <div style="display:flex; padding:1px; width: 100%; ">
            <div id="ausgabeNew" style="min-height: 100px;">
            text erkannt #todo
            </div>
                    <div class="modal" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header"></div>
                                <div class="modal-body">
                                    <div style='display: block;' id='editIngredienzDiv' style='font-size: larger;'></div>
                                </div>
                                <div class="modal-footer">
                                    <input type='button' value='Ändern für dieses Produkt' class='btn btn-alt-primary' onclick='contexteditchange()'>
                                    <input type='button' value='Jetzt und in Zukunft ändern' class='btn btn-alt-primary' onclick='contexteditchange()'>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>

        <!-- text trenner -->
        <div style="display:flex; padding:1px; width: 100%;border: 1px solid;">
        <table style="width: 70%">
            <tbody><tr>
                <td>Trennzeichen: </td>
                <td><div id="Splitter"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value=";" onclick="deleteSplitter('Splitter',';');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="," onclick="deleteSplitter('Splitter',',');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value=":" onclick="deleteSplitter('Splitter',':');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="." onclick="deleteSplitter('Splitter','.');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="(" onclick="deleteSplitter('Splitter','(');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value=")" onclick="deleteSplitter('Splitter',')');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="[" onclick="deleteSplitter('Splitter','[');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="]" onclick="deleteSplitter('Splitter',']');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="/" onclick="deleteSplitter('Splitter','/');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="{" onclick="deleteSplitter('Splitter','{');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="}" onclick="deleteSplitter('Splitter','}');"></div></td>
                <td> <input size="3" id="SplitterInput" type="text"><input type="button" value="add" onclick="addnewSpitt('Splitter');"> </td>
            </tr>
            <tr>
                <td>Startzeichen: </td>
                <td><div id="SplitterStart"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value=":" onclick="deleteSplitter('SplitterStart',':');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="(" onclick="deleteSplitter('SplitterStart','(');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="[" onclick="deleteSplitter('SplitterStart','[');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="{" onclick="deleteSplitter('SplitterStart','{');"></div></td>
                <td> <input size="3" id="SplitterStartInput" type="text"><input type="button" value="add" onclick="addnewSpitt('SplitterStart');"> </td>
            </tr>
            <tr>
                <td>Endzeichen: </td>
                <td><div id="SplitterEnd"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="." onclick="deleteSplitter('SplitterEnd','.');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value=")" onclick="deleteSplitter('SplitterEnd',')');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="]" onclick="deleteSplitter('SplitterEnd',']');"><input type="button" style="margin:2px;height:23px;font-size:larger;background: #91bb9e;border: 1px solid #91bb9e;border-radius: 3px;" value="}" onclick="deleteSplitter('SplitterEnd','}');"></div></td>
                <td> <input size="3" id="SplitterEndInput" type="text"><input type="button" value="add" onclick="addnewSpitt('SplitterEnd');"> </td>
            </tr>
            </tbody>
        </table>
            
            <div style="margin:3px;top:0px;right:0px;width:30%;"><input type="checkbox" onclick="toggleMitHeader();"> mit Headerelemente<br><input type="checkbox" onclick="toggleMitDoppelte();"> mit Doppelten<br><input type="checkbox" onclick="toggleMitChields(); " checked=""> alle Sub-Elemente
            </div>
        </div>

        <!-- text buttons -->
        <div style="display:flex;padding:10px; width: 100%;">
            <div style="margin-left: auto;	margin-right: auto;">
                <a class="btn btn-alt-primary-outline" href="{{route('get.scannel.openproducts',$product->type)}}">Abbrechen</a>

                <button class="btn btn-alt-primary pull-right" onclick="">Löschen</button>
                <button class="btn btn-alt-primary pull-right" onclick="">Melden!</button>
                <button class="btn btn-alt-primary save-btn" type="submit">Speichern</button>
                
                <div style="display:inline;padding-left:40px;">
                    <a class="btn btn-alt-primary" href="{{route('get.scannel.product',['release'=>$product->product_id])}}">Freigeben</a></div>

            </div>
        </div>

        <!-- div dreimal-->
        <div style="display:flex;">
            <div style="padding:1px; width: 40%;">
                <div style="text-align:center;font-weight:bold;">Analysiert/Erkannt : </div>
                <div id="act_ingrdients" style="margin-left:3px;border: 1px solid;overflow:scroll; overflow-x: hidden;position:relative;height: 300px; width: 99%;float: left;">
                </div>
            </div>
            <div hidden style="padding:1px; width: 33%;">
            <div style="text-align:center;font-weight:bold;">Neu : </div>
                <div id="new_ingrdients" style="margin-left:3px;border: 1px solid;overflow:scroll; overflow-x: hidden;position:relative;height: 300px; width: 99%;float: left;">
                </div>
            </div>
            <div style="padding:1px; width: 40%;">
            <div style="text-align:center;font-weight:bold;">Gespeichert/DB : </div>
                <div id="old_ingrdients" style="margin-left:3px;border: 1px solid;overflow:scroll; overflow-x: hidden;position:relative;height: 300px; width: 99%;float: left;">

                    @foreach($product->ingredients()->get() as $ingre)
                        <div class="ingred_div" >{{$ingre->currentName}}</div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- div Nährwerttabelle -->
        <div style="padding:1px; width: 100%;font-weight:bold;text-align:center;margin-left: auto;	margin-right: auto;">
            Nährwerttabelle
            <div id='idNaehrwetTabelle' style='margin-top:3px;position:absolute; width: 100%;'></div>
        </div>

        <!-- div nährwerte-->
        <div style="display:flex;">
            <div style="padding:1px; width: 60%;">
                <div id="act_ingrdients" style="margin-left:3px; position:relative;height: 300px; width: 99%;float: left;">
                    <div style="">Nährwertangaben: 
                    <input type="text" name="naehrwertGrp_val" id="" value="100" size="4">
                    <select name="naehrwertGrp_unit" id="">
                    <option value="0" selected="selected"></option>
                    @foreach($allunits as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach

                    </select>
                    <select name="naehrwertGrp_state" id="">
                        .PREPARED.<option value="PREPARED">zubereitet</option>
                        .UNPREPARED.<option value="UNPREPARED" selected="selected">unzubereitet</option>
                    </select>
                    </div>
                </div>
            </div>
            <div style="padding:1px; width: 40%;">
                <div id="act_ingrdients" style="margin-left:3px; position:relative;height: 300px; width: 99%;float: left;">
                    <div style="background:#dfdfdf;margin-top:3px;position:absolute; ">
                        <div style="font-size: larger;">
                            <span style="">
                            <select name="" id="new_type">
                            0<option value="0" selected="selected">neuen Nährwert auswählen...</option>
                            @foreach($allnutrients as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                            </select></span><br>
                            <table>

                                <tbody><tr><td>Genauigkeit:</td>
                                <td><select name="" id="new_precision">
                                <option value="0" selected="selected"></option>
                                @foreach($allprecision as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach

                                </select></td>
                                </tr>
                                <tr><td>Wert:</td><td> <input type="text" name="" id="new_val" value="0.00" size="5"></td></tr><tr><td>Einheit:</td><td>
                                <select name="" id="new_unit">
                                <option value="0" selected="selected"></option>
                                @foreach($allunits as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                                </select>
                                </td></tr></tbody>
                            </table>

                          <span style="float: right;">
                            <input type="button" name="" id="" class="btn btn-alt-primary"value="Nährwert hinzufügen" onclick="addNewNaehrwert();">
                          </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- hiden helper fields -->
    <div id='naehrwertereihenfolge' hidden ></div>
    <textarea name='naehrwertedb' id='naehrwertedb' hidden ></textarea>
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
        if (n > slides.length) {slideIndex = 1}    
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }

        slides[slideIndex-1].style.display = "block";  
    }
</script>
@endsection
