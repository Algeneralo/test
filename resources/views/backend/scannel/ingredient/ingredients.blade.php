@extends('backend.layouts.backend')

@section('title', 'Zutaten')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')

    @php

        $canEdit = Auth::user()->can('ingredients.edit');
        $canDelete = Auth::user()->can('ingredients.delete');

    @endphp

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
            {!! session()->get('message') !!}
        </div>
    @endif

    <h2 class="content-heading">
        <i class="scannel-icons icon-product"></i> Scannel Ingredienz
        @if($canEdit)
            <button class="btn btn-alt-primary pull-right"
                    onclick="location.href='{{ url('scannel/ingredient/ingredient') }}'">+ Ingredienz hinzufügen
            </button>@endif
    </h2>

    <!-- Dynamic Table Full -->
    <div class="block table">
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table dataTable scannel-datatable-ajax" data-order="[[ 4, &quot;desc&quot; ]]">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th>Name</th>
                    @if($canEdit || $canDelete)
                        <th></th>@endif
                    <th>Type</th>
                    <th>Letzte Aktualisierung</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js_after')
    <!-- SweetAlert2 -->
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>

    <script>

        var canDelete = '{{$canDelete}}';
        var canEdit = '{{$canEdit}}';

        var table = $('.scannel-datatable-ajax').DataTable({
            language: {
                'info': '<span>_TOTAL_/_MAX_</span> Einträge',
                'infoFiltered': '',
                'paginate': {
                    'next': '<i class="scannel-icons icon-arrow-right"></i>',
                    'previous': '<i class="scannel-icons icon-arrow-left"></i>',
                },
                'search': '<i class="fa fa-search"></i>',
                'searchPlaceholder': 'Hier Suchtext eingeben...',
                'lengthMenu': '_MENU_'
            },
            ajax: {
                url: '/scannel/ingredient/ingredients/ajax/{{$category}}',
                dataSrc: 'data'
            },
            columns: [
                {
                    data: 'id'
                },
                {
                    data: 'name',
                    render: function (data, type, row) {
                        return '<a href="/scannel/ingredient/ingredient/' + row.id + '">' + data + '</a>';
                    }
                },
                {
                    data: 'id',
                    render: function (data) {

                        var returnHTML = '';

                        if(canDelete) {
                            returnHTML += '<a class="edit-link delete-ingredient" href="/scannel/ingredient/ingredients/delete/' + data + '" style="margin-right: 10px"><i class="fa fa-trash"></i> Löschen</a>';
                        }

                        if (canEdit) {
                            returnHTML += '<a class="edit-link split-ingredient" href="/scannel/ingredient/split/' + data + '">Split</a>';
                        }

                        return returnHTML;

                    }
                },
                {
                    data: 'type'
                },
                {
                    data: 'updated_at'
                },
            ],
            search: {
                "regex": true,
                "smart": false
            }

        });

        $('.dataTables_filter input').off();

        $('.dataTables_filter input').on('keyup', function() {

            table.search('\\b' + this.value, true, false).draw();

        });


        $('a.delete-ingredient').on('click', function () {

            var delurl = $(this).data('delurl');
            Swal.fire({
                title: 'Bist du sicher?',
                text: "Wenn du eine Zutat löscht, kann dieses nicht wieder hergestellt werden.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ja, ich bin sicher!',
                cancelButtonText: 'Nein',
            }).then((result) => {
                if (result.value) {
                    window.location = delurl;
                }
            })

        });


    </script>

@endsection
