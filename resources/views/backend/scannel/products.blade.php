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
        <i class="scannel-icons icon-product"></i> Scannel Produkte
    </h2>

    <!-- Dynamic Table Full -->
    <div class="block table">
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table dataTable scannel-datatable" data-order="[[ 8, &quot;desc&quot; ]]">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">EAN</th>
                    <th>Name</th>
                    <th class="d-none d-sm-table-cell">Zutaten</th>
                    <th class="d-none d-sm-table-cell">Bilder</th>
                    <th class="text-center" style="width: 15%;">Status</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Quelle</th>
                    <th>Type</th>
                    <th>Eintragsdatum</th>
                    @canany(['scannel-products.delete'])
                        <th></th>
                    @endcanany
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->product_id}}</td>
                        <td>
                            @if($product->eans()->first())
                                {{$product->eans()->first()->ean}}
                            @Endif
                        </td>
                        <td>
                            <a href="{{ url('scannel/product',$product->product_id) }}">{{$product->product_name}}</a>
                        </td>
                        <td>{{$product->ingredients()->get()->count()}}</td>
                        <td>{{$product->images()->count()}}</td>

                        <td class="text-center">
                            <!-- TODO: Active Toggle -->
                            @if($product->status == 'active')
                                <span class="badge badge-success">Aktiv</span>
                            @else
                                <span class="badge badge-warning">Inaktiv</span>
                            @endif
                        </td>
                        <td>{{$product->src_type}}</td>
                        <td>{{$product->type}}</td>
                        <td>{{\Carbon\Carbon::parse($product->created)->format('d.m.Y H:i')}}</td>
                        @canany(['scannel-products.delete'])
                            <td>
                                @can('scannel-products.delete')
                                    <a class="edit-link delete-product" href="javascript:void(0)"
                                       data-delurl="{{route('get.scannelproductdelete', ['del' => $product->product_id])}}">
                                        <i class="fa fa-trash"></i>
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

        $('a.delete-product').on('click', function () {

            var delurl = $(this).data('delurl');
            Swal.fire({
                title: 'Bist du sicher?',
                text: "Wenn du ein Produkt löscht, kann dieses nicht wieder hergestellt werden.",
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
