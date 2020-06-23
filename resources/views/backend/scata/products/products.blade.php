@extends('backend.layouts.backend')

@section('title', 'Produkte')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <h2 class="content-heading">
        <i class="scannel-icons icon-product"></i> Produkte
    </h2>

    <!-- Dynamic Table Full -->
    <div class="block table">
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table dataTable scannel-datatable" data-order="[[ 6, &quot;desc&quot; ]]">
                <thead>
                <tr>
                    <th class="text-center">EAN</th>
                    <th>Name</th>
                    <th class="d-none d-sm-table-cell">Zutaten</th>
                    <th class="d-none d-sm-table-cell">Bilder</th>
                    <th class="text-center" style="width: 15%;">Status</th>
                    <th class="text-center">Hinzugefügt von</th>
                    <th>Eintragsdatum</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->eans()->first()['ean']}}</td>
                        <td><a class="edit-link"
                               href="{{route('get.scata.product', ['product' => $product->product_id])}}">
                                @if($product->product_name)
                                    {{$product->product_name}}
                                @else
                                    <span class="text-gray-dark">Kein Name gefunden</span>
                                @endif
                            </a>
                        </td>
                        <td>{{$product->ingredients()->count()}}</td>
                        <td>{{$product->images()->count()}}</td>
                        <td>
                            <!-- TODO: Active Toggle -->
                            @if($product->status == 'active')
                                <span class="badge badge-success">Aktiv</span>
                            @else
                                <span class="badge badge-warning">Inaktiv</span>
                            @endif
                        </td>
                        <td>@if($product->createdBy){{$product->createdBy->name}}@endif</td>
                        <td data-type="date">{{\Carbon\Carbon::parse($product->created_at)->format('d.m.Y H:i')}}</td>
                        <td>
                            <a class="edit-link"
                               href="{{route('get.scata.product', ['product' => $product->product_id])}}"><i
                                    class="scannel-icons icon-edit"></i> Bearbeiten</a>
                        </td>
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

        $('button.delete-product').on('click', function () {

            var delurl = $(this).data('deleteurl');
            console.log(delurl);

            Swal.fire({
                title: 'Bist du sicher?',
                text: "Wenn du den Nutzer löscht, kann er sich nicht mehr anmelden.",
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
