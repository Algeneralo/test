@extends('backend.layouts.backend')

@section('title', 'Zutat: ' . $ingredient->currentName)

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .grpdiv {
            padding-left: 15px;
            width: 99%;
        }
        .labeldiv{
            width: 32%;
        }
        .input-group{
            width: 68% ! important;
            float: right;
        }
        .select-container .select2-container {
            width: 100%;
            flex: 1 1 0%;
        }

    </style>

@endsection
<?php
function in_array_r($needle, $haystack, $strict = false)
{
    foreach ($haystack as $item) {
        if ($item->id === $needle) {
            return true;
        }
    }
    return false;
}
function getgroupforid($arr, $parent, $arrsaved)
{
    $re = "";
    foreach ($arr as $one) {
        $isChecked = "";
        $isHidden = "";
        if (in_array_r($one->id, $arrsaved))
            $isChecked = "checked";
        if ($isChecked == "")
            $isHidden = "style='display:none;'";
        if ($one->parentid == $parent && $one->id != $parent) {
            $re .= "<div class='grpdiv'><input " . $isChecked . " name='groups[]' value='" . $one->id . "' onclick=clickGrp('" . $one->id . "') type='checkbox' id='" . $one->id . "' name='" . $one->slug . "' > ";
            $re .= " <label for='" . $one->id . "'>" . $one->slug . " ";
            if ($one->chieldGroups()->get()->count() > 0)
                $re .= "( " . $one->chieldGroups()->get()->count() . " )";
            $re .= "</label></div>";
            $re .= "<div id='childdiv" . $one->id . "' " . $isHidden . " class='grpdiv'>";
            $re .= getgroupforid($arr, $one->id, $arrsaved) . "</div>";
        }
    }
    return $re;
}
?>
@section('content')
    <h2 class="content-heading">
        <i class="scannel-icons icon-product"></i> Scannel Zutat: {{$ingredient->currentName}}
    </h2>


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

    <!-- Dynamic Table Full -->
    <form class="row" action="{{route('post.saveingredient')}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Produkt -->
        <div class="col-md-12">
            <div class="block block-form">
                @csrf
                <div class="block-content block-content-full profile-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="labeldiv">ID</label>    
                                <div class="input-group">
                                    <input type="text" class="form-control" name="id" value="{{$ingredient->id}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="labeldiv">Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" name="name" value="{{$ingredient->name[app()->getLocale()]}}" readonly>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-alt-primary" id="btn_rename" data-toggle="modal" data-target="#myModal">Umbennen</button>
                                        <div class="modal" id="myModal" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">Zutat Umbennen</div>
                                                    <div class="modal-body">
                                                        <label class="labeldiv">Neuer Name</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="name" value="{{$ingredient->name[app()->getLocale()]}}" >
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-alt-primary" data-dismiss="modal">Abbrechen</button>
                                                        <button class="btn btn-alt-primary" type="submit">Speichern</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-alt-primary" style="margin-left:7px;" href="{{ url('scannel/ingredient/split',$ingredient->id) }}">Split</a>
                                    </div>
                                </div>
                                @error('name')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div style="height:80px;" class="form-group">

                                <label class="labeldiv">Beschreibung</label>
                                <div class="input-group">
                                    <textarea rows=3 class="form-control" name="description">@if($ingredient->description['de']){{$ingredient->description['de']}}@endif</textarea>
                                    @error('description')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                
                            </div>
                            
                            <div class="form-group"><hr></div>
                            <div class="form-group">

                                <label class="labeldiv">Art</label>
                                <div class="input-group">
                                <label class="css-control css-control-primary css-checkbox">
                                    <input type="checkbox" class="css-control-input" value="food"
                                           @if($ingredient->type == 'food') checked @endif>
                                    <span class="css-control-indicator"></span> Lebensmittel
                                </label>
                                <label class="css-control css-control-primary css-checkbox"
                                       @if($ingredient->type == 'cosmetics') checked @endif>
                                    <input type="checkbox" class="css-control-input" value="cosmetics">
                                    <span class="css-control-indicator"></span> Kosmetika
                                </label>
                                <label class="css-control css-control-primary css-checkbox"
                                       @if($ingredient->type == 'feed') checked @endif>
                                    <input type="checkbox" class="css-control-input" value="food">
                                    <span class="css-control-indicator"></span> Futtermittel
                                </label>
                                <label class="css-control css-control-primary css-checkbox"
                                       @if($ingredient->type == 'cleanser') checked @endif>
                                    <input type="checkbox" class="css-control-input" value="food">
                                    <span class="css-control-indicator"></span> Reinigungsmittel
                                </label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="labeldiv">Diese Zutat <b>ersetzen</b> durch</label>
                                <div class="input-group">
                                    <select class="form-control js-select2 ingredients" name="replacewith"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="labeldiv">Diese Zutat <b>ersetzt</b> folgenden Zutat</label>
                                <div class="input-group">
                                    <select class="form-control js-select2 ingredients" name="replacethis"></select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group" style="display:flow-root">
                                <label class="labeldiv">Aliase</label>
                                <div class="input-group">
                                    <button class="btn btn-sm btn-primary add-aliase" type="button" >neuen Alias hinzufügen</button>
                                </div>
                                <div class="select-container aliases">
                                    <div class="input-group aliase-select-template" style="display: none; margin-top: 8px;">
                                        <select class="form-control " name="aliase[]"></select>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary delete-aliase" type="button" ><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @foreach($ingredient->aliase as $aliase)
                                    <div class="input-group " style="margin-top: 8px;">
                                        <select class="form-control js-select2 ingredients" name="aliase[]">
                                            <option value="{{$aliase->id}}">{{$aliase->name[app()->getLocale()]}}</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary delete-aliase" type="button" ><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="labeldiv">Wechselwirkung mit</label>
                                <div class="input-group">                            
                                    <button class="btn btn-sm btn-primary add-interaction" type="button" >Wirkstoff hinzufügen</button>
                                </div>
                                <div class="select-container">
                                    <div class="input-group interaction-select-template" style="display: none; margin-top: 8px;">
                                        <select class="form-control " name="interaction[]"></select>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary delete-interaction" type="button" ><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="labeldiv">In Inhaltsstoffgruppen</label>
                                <div class="input-group"> 
                                    {!! getgroupforid($ingredientGroups,'',$ingredient->ingredientGroups()->get()) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 offset-1">
                            <div class="form-group">
                                <label>Produkte ({{$ingredient->products->count()}})</label>
                                <ul>
                                    @foreach($ingredient->products as $product)
                                        <li>
                                            <a href="{{ url('scannel/openproduct',$product->product_id) }}">{{$product->product_name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="block block-form">
                <div class="block-footer">
                    <a class="btn btn-alt-primary-outline" href="{{route('get.scannel.ingredients',$ingredient->type)}}">Abbrechen</a>
                    @can('ingredients.delete')
                        <a class="btn btn-alt-primary delete-ingredient" href="javascript:void(0)" data-delurl="{{route('get.scannelingredientdelete', ['del' => $ingredient->id])}}">Löschen</a>
                    @endcan
                    <button class="btn btn-alt-primary" type="submit">Speichern</button>
                </div>
            </div>
        </div>
    </form>


@endsection



@section('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script>
    // helper for Inhaltsstoffgruppen 'Tree'
        function deak_groupforid(deak_id) {
            if ($("#" + deak_id).prop("checked")) return;

            var panel = $("#childdiv" + deak_id);
            var inputs = panel.find("input");
            $.each(inputs, function (index, value) {
                $("#" + value.id).prop("checked", false);
            });
        }

        function clickGrp(id) {
            deak_groupforid(id);
            hideshow("childdiv" + id);
        }

        function hideshow(id) {
            var x = document.getElementById(id);
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        /**
         * Select 2 options for Ingredient
         **/

        var select2options = {
            minimumInputLength: 3,
            ajax: {
                url: '/scannel/ingredient/ingredients/ajax/search/{{$ingredient->type}}',
                dataType: 'json',
                ignore: $('#name').val(),
                data: function (params) {
                    var query = {
                        q: params.term
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    var ignore = this.ajaxOptions.ignore;
                    var formatted = $.map(data.data, function (obj) {
                        if(ignore == obj.name)
                            return;

                        var format = {
                            id: obj.id,
                            text: obj.name
                        };

                        return format;

                    });

                    return {
                        results: formatted
                    };
                }
            }
        };

        $(".js-select2.ingredients").select2(select2options);

        /**
         * Select 2 for Groups
         **/
        $('.js-select2-multiple').select2();

        /**
         * Aliase
         *
         * Add new Aliase using select2options for ajax search request against the server.
         * Delete Aliase
         *
         **/

        $('.add-aliase').on('click', function() {

            var template = $('.aliase-select-template').clone();

            template.removeClass('aliase-select-template');
            template.find('select').select2({
                minimumInputLength: 3,
                ajax: {
                    url: '/scannel/ingredient/ingredients/ajax/search/{{$ingredient->type}}',
                    dataType: 'json',
                    ignore: $('#name').val(),
                    data: function (params) {
                        var query = {
                            q: params.term
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function (data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        var ignore = this.ajaxOptions.ignore;
                        var formatted = $.map(data.data, function (obj) {
                            
                            if(ignore == obj.name)
                                return;
                            var format = {
                                id: obj.id,
                                text: obj.name
                            };

                            return format;

                        });

                        return {
                            results: formatted
                        };
                    }
                }
            });
            template.show();
            template.appendTo('.select-container.aliases');

        });

        $(document).on('click','.delete-aliase',  function() {

            $(this).closest('.input-group').hide();

        });

        /**
         * Interaction / Wechselwirkung
         *
         * Waiting for implementation
         *
         **/

        $('.add-interaction').on('click', function() {

            Swal.fire({
                icon: 'info',
                title: 'Funktion nocht nicht umgesetzt!',
                text: 'Die Funktion Wirkstoff hinzufügen ist noch nicht implementiert. Sie wird in einer weiteren Version folgen.',
            })

        });



        /**
         * Rename Button
         */

        $('.edit-name').on('click', function() {

            $('input[name="name"]').removeAttr('readonly');

        });


    </script>

@endsection
