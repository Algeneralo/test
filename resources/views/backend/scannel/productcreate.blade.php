@extends('backend.layouts.backend')

@section('title', 'Produkte')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
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
            <i class="scannel-icons icon-product"></i> Neues Produkt erstellen
    </h2>

    <form class="row" action="{{route('post.saveproduct')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div style="z-index: 10;position: relative;min-height: 1100px; width: 100%;"><!-- Haupt div-->
        

        <div style="display:flex;">
            <div style="padding:1px; width: 70%;"><!-- Table div-->
                <table><tbody>

                <tr><td>Name: </td><td><input name="name" size="50" type="text" value=""></td></tr>
                <tr><td>Verkehrsname: </td><td><input name="regulated_name" size="50" type="text" value="{{@$product->regulated_name}}"></td></tr>
                <tr><td>EAN: </td><td><input name="ean" size="50" type="text" value="{{@$product->ean}}"></td></tr>

                <tr><td>Produkturl: </td><td><input name="url" size="50" type="text" value="{{@$product->name}}"></td></tr>
                <tr><td>Quelle: </td><td><input name="source" size="50" type="text" value="{{@$product->src_type}}"></td></tr>
                <tr><td>PZN: </td><td><input name="pzn" size="50" type="text" value="{{@$product->pzn}}"></td></tr>
                <tr><td>Hersteller: </td><td><input name="producer" size="50" type="text" value="{{@$product->name}}"></td></tr>
                <tr><td>Art: </td><td>
                    <input name="type[]" value="food" type="checkbox" > Lebensmittel </input>
                    <input name="type[]" value="cosmetics" type="checkbox" > Kosmetika </input>
                    <input name="type[]" value="cleanser" type="checkbox" > Reinigungsmittel </input>
                    <input  name="type[]" value="feed" type="checkbox" > Futtermittel 
                </td></tr>
                </tbody></table>
            </div>
            <div style="padding:1px; width: 30%;"><!-- Bild div-->
                <div style="height: 85%; border: 1px solid #ddd;">Produkt Bild</div>
                <div style="padding-top:2px;margin-left: auto;	margin-right: auto;"></div>
            </div>
        </div>

        <div style="display:flex; padding:1px; width: 100%;"><!-- text origi -->
            <textarea style="width:100%" placeholder="keine Informationen vorhanden" style="font-size: medium;" name="ingredienz_text_orig" id="oriText" rows="4">{{$product->ingredienz_text_orig}}</textarea>
        </div>
        
        <div style="display:flex;padding:10px; width: 100%;"><!-- text buttons -->
            <div style="margin-left: auto;	margin-right: auto;">
                <a class="btn btn-alt-primary-outline" href="{{route('get.scannel.products')}}">Abbrechen</a>
                <button class="btn btn-alt-primary save-btn" type="submit">Speichern</button>
            </div>
        </div>

        
    </div>

    </form>




@endsection

@section('js_after')



@endsection
