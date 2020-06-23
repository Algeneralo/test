@extends('backend.layouts.backend')

@section('title', 'Newsletter')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <h2 class="content-heading">
        <i class="fa fa-envelope"></i> Newsletter
        @can('newsletter.create')<a class="btn btn-alt-primary pull-right" href="{{route('get.newsletter-create')}}">+
            Neuer Newsletter</a>@endcan
    </h2>

    <!-- Dynamic Table Full -->
    <div class="block table">
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table dataTable scannel-datatable">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th>Betreff</th>
                    <th>Verfasser</th>
                    <th class="d-none d-sm-table-cell">Empfänger</th>
                    <th class="d-none d-sm-table-cell">Datum</th>
                    <th class="d-none d-sm-table-cell">Status</th>
                    @canany(['newsletter.edit', 'newsletter.send', 'newsletter.delete'])
                        <th class="d-none d-sm-table-cell"></th>@endcanany
                </tr>
                </thead>
                <tbody>
                @foreach($newsletters as $newsletter)
                    <tr>
                        <td class="text-center">{{$newsletter->id}}</td>
                        <td>{{$newsletter->subject}}</td>
                        <td>{{$newsletter->admin->name}}</td>
                        <td>
                            @if($newsletter->receiver == '')
                                Scannel App-Nutzer
                            @elseif($newsletter->receiver == '')
                                Alle Mitarbeiter
                            @else
                                Gruppe: {{\App\Models\Admins\Group::find($newsletter->receiver)->name}}
                            @endif
                        </td>
                        <td>{{Carbon\Carbon::parse($newsletter->updated_at)->format('d.m.Y H:i')}}</td>
                        <td>
                            @if($newsletter->sent)
                                <span class="badge badge-success">Versendet</span>
                            @else
                                <span class="badge badge-warning">Entwurf</span>
                            @endif
                        </td>
                        @canany(['newsletter.edit', 'newsletter.send', 'newsletter.delete'])
                            <td class="text-right">
                                @if(!$newsletter->sent)
                                    @can('newsletter.edit')<a class="edit-link"
                                       href="{{route('get.newsletter', ['newsletter' => $newsletter->id])}}"><i
                                            class="scannel-icons icon-edit"></i> Bearbeiten</a>@endcan
                                    @can('newsletter.send')<a class="edit-link send-newsletter" href="javascript:void(0)"
                                       data-sendurl="{{route('get.newsletter-send', ['newsletter' => $newsletter->id])}}"><i
                                            class="fa fa-send"></i> Senden</a>@endcan
                                @endif
                                @can('newsletter.delete')<a class="edit-link delete-newsletter" href="javascript:void(0)"
                                   data-delurl="{{route('get.newsletter-delete', ['newsletter' => $newsletter->id])}}"><i
                                        class="fa fa-trash"></i> Löschen</a>@endcan
                            </td>
                        @endcanany
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js_after')
    <!-- SweetAlert2 -->
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>

    <script>

        $('a.send-newsletter').on('click', function () {

            var sendurl = $(this).data('sendurl');

            Swal.fire({
                title: 'Bist du sicher?',
                text: "Wenn du eine Newsletter verschickst, kannst du dies nicht mehr Rückgängig machen.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ja, ich bin sicher!',
                cancelButtonText: 'Nein',
            }).then((result) => {
                if (result.value) {

                    window.location = sendurl;

                }
            })

        });

        $('a.delete-newsletter').on('click', function () {

            var delurl = $(this).data('delurl');

            Swal.fire({
                title: 'Bist du sicher?',
                text: "Wenn du eine Newsletter löscht, kann diese nicht wieder hergestellt werden.",
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
