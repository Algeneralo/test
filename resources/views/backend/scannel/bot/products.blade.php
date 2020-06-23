@extends('backend.layouts.backend')

@section('title', 'Bot Produkte')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')

    @error('message')
        <p class="form-text text-danger">{{$message}}</p>
    @enderror

    <h2 class="content-heading">
        <i class="scannel-icons icon-product"></i> Bot Produkte
    </h2>

    <!-- Dynamic Table Full -->
    <div class="block table">
        <div class="block-content block-content-full">
            <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table dataTable scannel-datatable" data-order="[[ 7, &quot;desc&quot; ]]">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">EAN</th>
                    <th>Name</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Scan Quelle</th>
                    <th class="d-none d-sm-table-cell">Hersteller</th>
                    <th class="text-center" style="width: 15%;">Status</th>
                    <th>Type</th>
                    <th>Eintragsdatum</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->ean}}</td>
                        <td><a href="{{ url('scannel/bot/product',$product->id) }}">{{$product->display_name}}</a></td>
                        <td>{{$product->source}}</td>
                        <td>{{$product->company}}</td>

                        <td class="text-center">
                            <!-- TODO: Active Toggle -->
                            @if($product->status == '')
                                <span class="badge badge-success">transferiert</span>
                            @else
                                <span class="badge badge-warning">nicht transferiert</span>
                            @endif
                        </td>
                        <td>{{$product->productType}}</td>
                        <td>{{\Carbon\Carbon::parse($product->creation_date)->format('d.m.Y H:i')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js_after')


@endsection
