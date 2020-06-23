@extends('backend.layouts.backend')

@section('title', 'Dashboard')

@section('content')
    <div class="row invisible stats-blocks" data-toggle="appear">
        <!-- Row #1 -->
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="{{\App\Models\ScataOld\Product::count()}}">0</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">
                        <i class="scannel-icons icon-product"></i>
                        Produkte
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000" data-to="{{\App\Models\ScataOld\ProductImage::count()}}">0</span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">
                        <i class="scannel-icons icon-image-2"></i>
                        Produkt Bilder
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="261">0</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">
                        <i class="scannel-icons icon-barcode"></i>
                        Produkt Scans
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="{{\App\Models\Scannel\AppUser::count()}}">0</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">
                        <i class="scannel-icons icon-users"></i>
                        App Nutzer
                    </div>
                </div>
            </a>
        </div>
        <!-- END Row #1 -->
    </div>
@endsection
