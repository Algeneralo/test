@extends('backend.layouts.backend')

@section('title', 'Produkte')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')


    <h2 class="content-heading">
        <i class="scannel-icons icon-product"></i>Bot Produkt: {{@$product->display_name}}
    </h2>

    <form class="row" action="{{route('post.savebotproduct')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div style="z-index: 10;position: relative;min-height: 1100px; width: 100%;"><!-- Haupt div-->
        
        <div style="display:flex;">
            <div style="padding:0px; width: 70%;"><!-- Table div-->
                <table><tbody>

                <tr><td>ID: </td><td><input name="id"   readonly type="text" value="{{@$product->id}}"> | <a href="{{@$product->product_url}}" target="_blank"> Produkturl</a></td></tr>
                <tr><td>Name: </td><td><input name="name" size="50" type="text" value="{{@$product->display_name}}"></td></tr>
                <tr><td>Verkehrsname: </td><td><input name="regulated_name" size="50" type="text" value="{{@$product->regulated_name}}"></td></tr>

                <tr><td>EAN: </td><td><input name="ean" size="50" type="text" value="{{@$product->ean}}"></td></tr>
                <tr><td>PZN: </td><td><input name="pzn" size="50" type="text" value="{{@$product->pzn}}"></td></tr>

                <tr><td>Quelle: </td><td><input name="source" size="50" type="text" value="{{@$product->source}}"></td></tr>
                
                <tr><td>Hersteller: </td><td><input name="company" size="50" type="text" value="{{@$product->company}}"></td></tr>
                <tr><td>Art: </td><td>
                    <input  name="productType[]" value="food" type="checkbox" <?php  if(strpos( $product->productType,'food') !== false  ) echo 'checked'; ?>> Lebensmittel 
                    <input  name="productType[]" value="cosmetics" type="checkbox" <?php  if(strpos( $product->productType,'cosmetics')  !== false) echo 'checked'; ?>> Kosmetika 
                    <input  name="productType[]" value="cleanser" type="checkbox" <?php  if(strpos( $product->productType,'cleanser') !== false ) echo 'checked'; ?>> Reinigungsmittel 
                    <input  name="productType[]" value="drugs" type="checkbox" <?php  if(strpos( $product->productType,'drugs')  !== false ) echo 'checked'; ?>> Medikamente 
                </td></tr>


                <tr><td>Gütesiegel: </td>
                
                <td>                
                    @foreach($seals as $oneseal)
                    {{$oneseal->name}};
                    @endforeach
                </td></tr>

                <tr><td></td>
                <td><input size="6" id="newGueteSiegel" type="text">
                <button class="btn btn-alt-primary" onclick="addGueteSiegel();">add Gütesiegel</button>
                </td></tr>
                </tbody></table>
            </div>
            <div style="padding:0px; width: 30%;"><!-- Bild div-->
                <div style="height: 80%; border: 0px solid #ddd;">
                    <img style="max-height:300px;heigh:100%;" src="{{@$product->img_url}}" alt="Produktbild nicht vorhanden">
                </div>
                <div style="padding-top:0px;margin-left: auto;	margin-right: auto;"> 
                    <button class="btn btn-alt-primary" onclick="">APP Anischt</button>
                </div>
            </div>
        </div>

        <div style="display:flex; padding:1px; width: 100%;"><!-- text origi -->
            <textarea style="width:100%" placeholder="keine Informationen vorhanden" style="font-size: medium;" name="ingredients" id="oriText" rows="4">{{$product->ingredients}}</textarea>
        </div>
        <div style="display:flex; padding:1px; width: 100%;"><!-- text erkannt -->
            text erkannt #todo
        </div>

        <div style="display:flex; padding:1px; width: 100%;border: 1px solid;"><!-- text trenner -->
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
        </tbody></table>
            <div style="margin:3px;top:0px;right:0px;width:30%;"><input type="checkbox" onclick="toggleMitHeader();"> mit Headerelemente<br><input type="checkbox" onclick="toggleMitDoppelte();"> mit Doppelten<br><input type="checkbox" onclick="toggleMitChields(); " checked=""> alle Sub-Elemente
            </div>
        </div>
        

        <div style="display:flex;padding:10px; width: 100%;"><!-- text buttons -->
            <div style="margin-left: auto;	margin-right: auto;">
                <a class="btn btn-alt-primary-outline" href="{{route('get.scannel.bot.products')}}">Abbrechen</a>
                <button class="btn btn-alt-primary pull-right" onclick="">Löschen</button>
                <button class="btn btn-alt-primary pull-right" onclick="">Überspringen</button>
                <button class="btn btn-alt-primary pull-right" onclick="">Melden!</button>
                <button class="btn btn-alt-primary save-btn" type="submit">Speichern</button>
                <button class="btn btn-alt-primary save-btn" type="submit">Transfer</button>
            </div>
        </div>

        <div style="display:flex;"><!-- div dreimal-->
            <div style="padding:1px; width: 33%;">
                <div style="text-align:center;font-weight:bold;">Analysiert/Erkannt : </div>
                <div id="act_ingrdients" style="margin-left:3px;border: 1px solid;overflow:scroll; overflow-x: hidden;position:relative;height: 300px; width: 99%;float: left;">
                </div>
            </div>
            <div style="padding:1px; width: 33%;">
            <div style="text-align:center;font-weight:bold;">Neu : </div>
                <div id="act_ingrdients" style="margin-left:3px;border: 1px solid;overflow:scroll; overflow-x: hidden;position:relative;height: 300px; width: 99%;float: left;">
                </div>
            </div>
            <div style="padding:1px; width: 33%;">
            <div style="text-align:center;font-weight:bold;">Gespeichert/DB : </div>
                <div id="act_ingrdients" style="margin-left:3px;border: 1px solid;overflow:scroll; overflow-x: hidden;position:relative;height: 300px; width: 99%;float: left;">
                </div>
            </div>
        </div>

        <div style="padding:1px; width: 100%;font-weight:bold;text-align:center;margin-left: auto;	margin-right: auto;"><!-- div Nährwerttabelle -->
            Nährwerttabelle
        </div>
        <div style="display:flex;"><!-- div nährwerte-->
            <div style="padding:1px; width: 60%;">
                <div id="act_ingrdients" style="margin-left:3px; position:relative;height: 300px; width: 99%;float: left;">
                    <div style="">Nährwertangaben: 
                    <input type="text" name="naehrwertGrp_val" id="" value="100" size="4">
                    <select name="naehrwertGrp_unit" id="">
                    <option value="0" selected="selected"></option>


                    </select>

                    </div>
                </div>
            </div>
            <div style="padding:1px; width: 40%;">
                <div id="act_ingrdients" style="margin-left:3px; position:relative;height: 300px; width: 99%;float: left;">
                <div style="background:#dfdfdf;margin-top:3px;position:absolute; "><div style="font-size: larger;">
                <span style="">
                <select name="" id="new_type">
                    0<option value="0" selected="selected">neuen Nährwert auswählen...</option>
  
                    </select></span><br><table>
                    
                    <tbody><tr><td>Genauigkeit:</td>
                    <td><select name="" id="new_precision">
                    <option value="0" selected="selected"></option>
          

                    </select></td>
        </tr>
        <tr><td>Wert:</td><td> <input type="text" name="" id="new_val" value="0.00" size="5"></td></tr><tr><td>Einheit:</td><td><select name="" id="new_unit">
            <option value="0" selected="selected"></option>
h
          
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
    </form>




@endsection

@section('js_after')
<script src="{{ asset('js/pages/autocorrection.js') }}"></script>


@endsection
