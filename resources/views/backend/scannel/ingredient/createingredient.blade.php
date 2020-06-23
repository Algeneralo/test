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
        <i class="scannel-icons icon-product"></i> Scannel Zutat erstellen
    </h2>
    <form class="row" action="{{route('post.saveingredient')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div style="padding-right:10%;padding-left:2%;z-index: 10;position: relative;min-height: 1100px; width: 100%;"><!-- Haupt div-->
        
        <div style="display:flex;">
            <div style="padding:1px; width: 70%;"><!-- Table div-->
                <table><tbody>
                
                <tr><td>Name: </td><td><input name="name" size="90" value="{{ old('name') }}" type="text" value=""></td></tr>
                <tr><td>Art: </td><td>

                    <input  name="type[]" value="food" type="checkbox" > Lebensmittel 
                    <input  name="type[]" value="cosmetics" type="checkbox" > Kosmetika 
                    <input  name="type[]" value="cleanser" type="checkbox" > Reinigungsmittel 
                    <input  name="type[]" value="feed" type="checkbox" > Futtermittel 
                </td></tr>
                <tr><td>Beschreibung: </td><td><textarea style="width:100%"  name="description" rows="3" type="text" value=""></textarea></td></tr>
                </td></tr></tbody></table>
                <div style="display:flex;padding:10px; width: 100%;"><!-- text buttons -->
                    <div style="margin-left: auto;	margin-right: auto;">
                        <a class="btn btn-alt-primary-outline" href="{{route('get.scannel.ingredients','food')}}">Abbrechen</a>
                        <button class="btn btn-alt-primary save-btn" type="submit">Speichern</button>
                    </div>
                </div>
            </div>

        </div>


    </div>

    </form>




@endsection

@section('js_after')



@endsection
