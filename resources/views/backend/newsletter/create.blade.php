@extends('backend.layouts.backend')

@section('title', 'Newsletter erstellen')

@section('css_before')
    <link rel="stylesheet" href="{{asset('js/plugins/summernote/summernote-bs4.css')}}">
    <style>
    </style>
@endsection

@section('content')
    <h2 class="content-heading">
        <i class="fa fa-envelope"></i> Newsletter erstellen
    </h2>

    <form class="block block-form" method="post" action="{{route('post.newsletter-create')}}">
        @csrf
        <div class="block-header">
            <h3 class="block-title">Newsletter</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Empfänger <sup>*</sup></label>
                        <select class="form-control" name="receiver">
                            <option value="app-users">Scannel App-Nutzer</option>
                            <option value="employee">Alle Mitarbeiter</option>
                            @foreach($groups as $group)
                                <option value="{{$group->group_id}}">Gruppe: {{$group->name}}</option>
                            @endforeach
                        </select>
                        @error('receiver')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Betreff <sup>*</sup></label>
                        <input type="text" class="form-control" name="subject">
                        @error('subject')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nachricht <sup>*</sup></label>
                        <textarea name="message" class="summernote">

                        </textarea>
                    </div>
                </div>
                @can('newsletter.send')
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Jetzt verschicken?</label><br>
                            <label class="css-control css-control-primary css-checkbox" style="margin-top: 24px;">
                                <input type="checkbox" class="css-control-input" name="send_now">
                                <span class="css-control-indicator"></span> Ja, jetzt verschicken!
                            </label>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
        <div class="block-footer">
            <a class="btn btn-alt-primary-outline" href="{{route('get.newsletters')}}">Abbrechen</a>
            <button class="btn btn-alt-primary save-btn" type="submit">Speichern</button>
        </div>
    </form>
@endsection

@section('js_after')
    <script src="{{asset('js/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            });
        });

        $('input[name="send_now"]').change(function () {

            console.log("Changed");

            if ($(this).is(':checked')) {
                $('.save-btn').html('Speichern und Verschicken');
            } else {
                $('.save-btn').html('Speichern')
            }

        });
    </script>
@endsection
