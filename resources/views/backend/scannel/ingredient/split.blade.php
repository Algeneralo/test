@extends('backend.layouts.backend')

@section('title', 'Produkte')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>    
        .newsplitInput{
            width:90% ! important;
            display : flex !important;
        }
        .blinking{
            background: white;
            padding-top         : 10px;
            padding-right       : 15px;
            padding-bottom      : 10px;
            padding-left        : 15px;
            margin: 15px;
            border-radius; 10px;
            width:100%;
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
        <i class="scannel-icons icon-product"></i> Splitten : 
        <span id="ori_slug" style="background-color: #BEF56E;">{{@$ingredient->currentName}}</span>
        <span id="ori_type" hidden >{{@$ingredient->type}}</span>
    </h2>
    
    <form id="splitForm" class="row" action="{{route('get.scannel.split',$ingredient->id)}}" method="post" enctype="multipart/form-data">
    @csrf

    <div id="divSplit" style="display:block;padding-right:10%;padding-left:5%;z-index: 10;position: relative;min-height: 1100px; width: 100%;"><!-- Haupt div-->
        <div style="display:flex;">
            <div style="padding-left:5%; width: 80%;"><!-- Table div-->
                <table><tbody>

                <tr><td style="width:30%">ID: </td><td>{{$ingredient->id}}</td></tr>
                <tr><td>In Produkten: </td><td>{{$ingredient->products()->get()->count()}}</td></tr>
                <tr><td>In aktiven Produkten: </td><td>{{$ingredient->products()->select('status','active')->count()}}</td></tr>

                <tr><td colspan='2'><hr></td></tr>
                <tr><td colspan='2'>
                    @if($ingredient->products()->select('status','active')->count()> 0)
                        <div class="blinking">
                            <div class="swal2-icon swal2-warning swal2-icon-show" style="margin-left:20px;display: flex;float:left;"><div class="swal2-icon-content">!</div></div>
                            <div style="text-align: center; color: red; font-size: 30px; margin: 20px;" >ACHTUNG!!<br> Inhaltsstoff ist in aktiven Produkten!</div>
                        </div>
                    @endif

                </td></tr>

                <tr><td>Splitten in: </td><td>
                    <button class="btn btn-sm btn-primary split-ingredient" href="javascript:void(0)" type="button" >neuen Split hinzufügen</button>
                </td></tr>
                <tr ><td colspan=2> 
                    <div style="max-width:500px;" id='newAliase'></div>
                </td></tr>
                <tr><td colspan='2'>
                    <div id="wurdenangelegt" style="display:none;text-align: center; color: blue; font-size: 25px; margin: 20px;" >Die fehlenden Inhaltsstoffe wurden angelegt. Sie können nun splitten!</div>
                </td></tr>

                <tr><td colspan='2'>
                   <div style="display:flex;padding-top:10px; width: 100%;"><!-- text buttons -->
                        <div style="margin-left: auto;	margin-right: auto;">
                            <a class="btn btn-alt-primary-outline" href="{{ URL::previous() }}">Abbrechen</a>
                            <a class="btn btn-alt-primary" onclick=autosplit()>Auto splitten</a>
                            <button class="btn btn-alt-primary save-btn" type="button">Jetzt splitten</button>
                            
                        </div>
                    </div>
                </td></tr>

                <tr><td>Produkte: </td><td>
                    @foreach($ingredient->products()->get() as $prod)
                        <br><a href="{{ url('scannel/openproduct',$prod->product_id) }}">{{$prod->product_name}}</a>
                    @endforeach
                </td></tr>
                </td></tr></tbody></table>

            </div>
        </div>
    </div>

        <div id="divAddNew" style="display:none;padding-right:10%;padding-left:5%;z-index: 10;position: relative;min-height: 1100px; width: 100%;"><!-- Haupt div-->
            
        </div>

    </form>


@endsection

@section('js_after')
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>

<script>

    var i = 1;
    function deldiv(id){
        $("#"+id).remove();
    }
    var allIngredientsArray = [];

    $.ajax( {
                url: '/scannel/ingredient/ingredients/ajax/search/{{$ingredient->type}}',
                dataType: 'json', 
                success: function (response) {
                allIngredientsArray = [];
                $.each(response.data, function (index, value) {
                    allIngredientsArray.push(value.name);
                });
            },
            error: function (data) {
                alert('ERROR:' + data.responseJSON.message);
            }
             
       });

    function addnewSplitInput(startval = ''){
        i++;
        var _tmp =  "<div id='newsplitid_div"+i+"' style='display:flex;padding:3px;'>";
            _tmp += "<input id='newsplitid"+i+"' name='newsplit[]' class='form-control newsplitInput' value='"+startval+"' type='text'>";
            _tmp += "<a class='edit-link' onclick=deldiv('newsplitid_div"+i+"') >";
            _tmp += "<button class='btn btn-outline-primary' type='button' ><i  class='fa fa-trash'></i></button></a></div>";
        $( "#newAliase" ).append( _tmp );

        $( "#newsplitid"+i ).autocomplete({
            source: allIngredientsArray,
            search: function(oEvent, oUi) {
                var sValue = $(oEvent.target).val();
                var ignore = $('#ori_slug').text();
                var aSearch = [];
                $(allIngredientsArray).each(function(iIndex, sElement) {
                    if (sElement.substr(0, sValue.length) == sValue && sElement != ignore) {
                        aSearch.push(sElement);
                    }
                });
                $(this).autocomplete('option', 'source', aSearch);
            },
            minLength:3
        });
        $( "#newsplitid"+i ).focus();
    }
    $('.split-ingredient').on('click', function() {
        addnewSplitInput();
    });

    $('.save-btn').on('click', function() {

        var anzSplit = 0;
        var notFound = 0;

        $( "#divAddNew" ).append('<div style= "width:60%;" class="blinking"><div class="swal2-icon swal2-warning swal2-icon-show" style="margin-left:20px;display: flex;float:left;"><div class="swal2-icon-content">!</div></div><div style="text-align: center; color: red; font-size: 30px; margin: 20px;" >Bevor sie splitten können müssen zuerst die nicht vorhandenen Inhaltsstoffe angelegt werden!</div></div>');
        jQuery("input[name='newsplit[]']").each(function() {
            anzSplit++;
            if(allIngredientsArray.indexOf(this.value) < 0 && this.value != ''){
                notFound++;
                $typ_food = "";
                $typ_cosmetic = "";
                $typ_cleanser = "";
                $typ_feed = "";
                $ori_type = $("#ori_type").text();

                if($ori_type == "food")
                    $typ_food = "checked";
                if($ori_type == "cosmetics")
                    $typ_cosmetic = "checked";
                if($ori_type == "cleanser")
                    $typ_cleanser = "checked";
                if($ori_type == "feed")
                    $typ_feed = "checked";

                //add new ingredeinz
                var newhtml = '<hr><table><tbody><tr><td>Name: </td><td><input name="name[]" size="90" value="'+this.value+'" type="text"></td></tr>';
                newhtml += '<tr><td>Art: </td><td>';
                
                newhtml += '<input '+$typ_food+' name="type'+notFound+'[]" value="food" type="checkbox"> Lebensmittel ';
                newhtml += '<input '+$typ_cosmetic+' name="type'+notFound+'[]" value="cosmetics" type="checkbox"> Kosmetika ';
                newhtml += '<input '+$typ_cleanser+' name="type'+notFound+'[]" value="cleanser" type="checkbox"> Reinigungsmittel ';
                newhtml += '<input '+$typ_feed+' name="type'+notFound+'[]" value="feed" type="checkbox"> Futtermittel ';
                newhtml += '</td></tr><tr><td>Beschreibung: </td><td><textarea style="width:100%" id="description'+notFound+'" rows="3" type="text" value=""></textarea></td></tr>';
                newhtml += '</tbody></table>';
                $( "#divAddNew" ).append(newhtml);
            }
        });

        var warningtext = "";
        jQuery("input[name='newsplit[]']").each(function() {
            if( this.value != ''){
                warningtext += this.value + " - <br>";
            }
        });


        if(notFound <= 0 ){
            if(anzSplit <= 0){
                return false;
            }
                Swal.fire({
                    title: 'Bist du sicher?',
                    text: "Zutat wird durch folgende Zutaten ersetzt:" + warningtext,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ja, ich bin sicher!',
                    cancelButtonText: 'Nein',
                }).then(function (result) {
                    if (result.value) {
                        $("#splitForm").submit();
                        return true;
                    }
                    
                });
        }
        else{
            $('#divAddNew').show();
            $('#divSplit').hide();

            var newhtml =  '<div style="display:flex;padding-top:10px; width: 100%;">';
                newhtml += '<div style="margin-left: auto;	margin-right: auto;">';
                newhtml += '<a class="btn btn-alt-primary-outline" onclick=splitabbr()>Abbrechen</a>';
                newhtml += '<a class="btn btn-alt-primary" onclick=jetztsplitten()>Jetzt Anlegen</a>';
                    $( "#divAddNew" ).append(newhtml);

            return false;
        }

    });

    function jetztsplitten(){
        var notFound = 0;
        jQuery("input[name='newsplit[]']").each(function() {

            if(allIngredientsArray.indexOf(this.value) < 0 && this.value != ''){
                notFound++;
                var tt = "";
                jQuery("input[name='type"+notFound+"[]']").each(function() {
                    if(this.checked)
                        tt += this.value ;
                });
                var desc = $("#description"+notFound);
                var slug = this.value;
                $.ajax({
                    type:'POST',
                    data:{tab:'createingredient',name:slug, 'type[]': tt , description: desc.val() },
                    url:"{{ route('ajaxRequest.post') }}",
                    dataType: "json",
                    success: function( response ) {
                        allIngredientsArray.push(slug);
                    },
                    error:function(data){
                        alert('ERROR:' + data.responseJSON.message);
                        return false;
                    },
                });
                
            }
        });
        $('#divSplit').show();
        $('#wurdenangelegt').show();
        $('#divAddNew').hide();
    }

    function autosplit(){
        var ori = $("#ori_slug").text();

        //find trennzeichen
        ori = ori.replace(/;/g, "##;##");
        ori = ori.replace(/ /g, "##;##");
        ori = ori.replace(/,/g, "##;##");
        ori = ori.replace(/und/g, "##;##");
        //ori = ori.replace(/|/g, "##;##");
        ori = ori.replace(/-/g, "##;##");

        var arr = ori.split('##;##');

        arr = (function(arr){           //entferne doppelte
                    var m = {}, newarr = [] 
                    for (var i=0; i<arr.length; i++) { 
                        var v = arr[i]; 
                        if (!m[v]) { 
                            newarr.push(v); 
                            m[v]=true; 
                        } 
                    } 
                    return newarr; 
                })(arr); 

        $.each( arr, function( index, value ) {
            if(value != '')
                addnewSplitInput(value);
        });
    }

    function splitabbr(){
        $('#wurdenangelegt').hide();
        $('#divAddNew').hide();
        $('#divSplit').show();
    }
</script>

@endsection

