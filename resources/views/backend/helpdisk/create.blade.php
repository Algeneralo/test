@extends('backend.layouts.backend')

@section('title', 'Helpdesk hinzufügen')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.css" rel="stylesheet">
@endsection

@section('content')
    <h2 class="content-heading">
        <i class="fa fa-question-circle"></i>
        Helpdesk hinzufügen
    </h2>

    <form class="block block-form" method="post" action="{{route('helpDisk.store')}}">
        @csrf
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="cp">Seite für diesen Helpdesk<sup>*</sup></label>
                        <select name="page_id" id="" class="form-control js-select2" required>
                            @foreach($pages as $item)
                                <option value="{{$item->id}}">{{$item->displayed_name}}</option>
                            @endforeach

                        </select>
                        @error('page_id')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label class="cp">Text<sup>*</sup></label>
                    <textarea id="summernote" name="details" required></textarea>
                    @error('details')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="block-footer">
            <a class="btn btn-alt-primary-outline" href="{{route('helpDisk.index')}}">Abbrechen</a>
            <button class="btn btn-alt-primary" type="submit">Speichern</button>
        </div>
    </form>
@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-de-DE.min.js"></script>
    <script>

        $(".js-select2").select2();
        $(document).ready(function () {
            $('#summernote').summernote({
                lang: 'de-DE',
            });
        });
    </script>
@endsection
