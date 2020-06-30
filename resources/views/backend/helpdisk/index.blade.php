@extends('backend.layouts.backend')

@section('title', 'Newsletter')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <h2 class="content-heading">
        <i class="fa fa-question-circle"></i> Helpdesk
        {{--        @can('helpDisk.create')--}}
        <a class="btn btn-alt-primary pull-right" href="{{route('helpDisk.create')}}">
            +
            Neuer Helpdesk
        </a>
        {{--        @endcan--}}
    </h2>

    <!-- Dynamic Table Full -->
    <div class="block table">
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table dataTable scannel-datatable">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Seite für diesen Helpdesk</th>
                        <th>Text</th>
                        {{--                        @canany(['helpDisk.edit', 'helpDisk.delete'])--}}
                        <th class="d-none d-sm-table-cell"></th>
                        {{--                        @endcanany--}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $item)
                        <tr>
                            <td class="text-center">{{$item->id}}</td>
                            <td>{{$item->page->displayed_name}}</td>
                            <td>{{\Str::limit(strip_tags($item->details))}}</td>
                            @canany(['helpDisk.edit', 'helpDisk.delete'])
                                <td class="text-right">
                                    @can('helpDisk.edit')
                                        <a class="edit-link"
                                           href="{{route('helpDisk.edit',$item)}}"><i
                                                    class="scannel-icons icon-edit"></i>
                                            Bearbeiten
                                        </a>
                                    @endcan

                                    @can('helpDisk.delete')
                                        <a class="edit-link delete-helpDisk" href="javascript:void(0)"
                                           data-delurl="{{route('helpDisk.destroy',$item->id)}}">
                                            <i class="fa fa-trash"></i>
                                            Löschen
                                        </a>
                                    @endcan
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
        $('a.delete-helpDisk').on('click', function () {

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
