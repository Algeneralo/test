<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title') | Scannel Backend</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Fonts and Styles -->
    @yield('css_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ mix('/css/codebase.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('/css/scannel.css') }}">
    <style>
        #mySidebar {
            background-color: white;
        }

        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 10px;
        }

        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }

        .openbtn:hover {
            background-color: #444;
        }

        @media (min-width: 992px) {
            #side-overlay {
                width: 35%;
            }

            #page-container.side-scroll #side-overlay .content-header, #page-container.side-scroll #side-overlay .content-side {
                width: 100% !important;
            }
        }
    </style>
    <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
<!-- <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/corporate.css') }}"> -->
@yield('css_after')

<!-- Scripts -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Page Container -->
    <!--
        Available classes for #page-container:

    GENERIC

        'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

    SIDEBAR & SIDE OVERLAY

        'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
        'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
        'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
        'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
        'sidebar-inverse'                           Dark themed sidebar

        'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
        'side-overlay-o'                            Visible Side Overlay by default

        'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

        'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

    HEADER

        ''                                          Static Header if no class is added
        'page-header-fixed'                         Fixed Header

    HEADER STYLE

        ''                                          Classic Header style if no class is added
        'page-header-modern'                        Modern Header style
        'page-header-inverse'                       Dark themed Header (works only with classic Header style)
        'page-header-glass'                         Light themed Header with transparency by default
                                                    (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
        'page-header-glass page-header-inverse'     Dark themed Header with transparency by default
                                                    (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

    MAIN CONTENT LAYOUT

        ''                                          Full width Main Content if no class is added
        'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
        'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
    -->
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">
        <!-- Side Overlay-->
        @if(isset($helpDiskData))

            <div id="mySidebar" class="sidebar">
                <div class="content-header content-header-fullrow">
                    <div class="content-header-section align-parent">
                        <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" onclick="closeNav()">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                    </div>
                </div>
                <div class="content-side">
                    <p>
                        {!! $helpDiskData->details !!}
                    </p>
                </div>
            </div>
    @endif
    <!-- END Side Overlay -->

        <!-- Sidebar -->
        <!--
            Helper classes

            Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
            Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

            Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
            Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
                - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
        -->
        <nav id="sidebar">
            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow px-15 sidebar-header">
                    <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r"
                                data-toggle="layout" data-action="sidebar_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Sidebar -->

                        <!-- Logo -->
                        <div class="content-header-item">
                            <a class="" href="{{route('get.dashboard')}}">
                                <img src="{{route('get.admin-group-logo', ['group' => Auth::user()->group_id])}}">
                            </a>
                        </div>
                        <!-- END Logo -->
                    </div>
                    <!-- END Normal Mode -->
                </div>
                <!-- END Side Header -->

                <!-- Side User -->
                <div class="content-side content-side-full content-side-user px-10 align-parent">
                    <!-- Visible only in mini mode -->
                    <div class="sidebar-mini-visible-b align-v animated fadeIn">
                        <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
                    </div>
                    <!-- END Visible only in mini mode -->

                    <!-- Visible only in normal mode -->
                    <div class="sidebar-mini-hidden-b text-center">
                        <a class="img-link" href="javascript:void(0)">
                            <i class="scannel-icons icon-user-circle avatar-icon"></i>
                        </a>
                        <ul class="list-inline mt-10">
                            <li class="list-inline-item">
                                <a class="font-size-sm font-w600 text-uppercase name"
                                   href="javascript:void(0)">{{Auth::user()->name}}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Visible only in normal mode -->
                </div>
                <!-- END Side User -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li>
                            <a class="{{ request()->is('/') ? ' active' : '' }}" href="{{route('get.dashboard')}}">
                                <i class="scannel-icons icon-speedometer"></i>
                                <span class="sidebar-mini-hide">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-main-heading">
                            <span class="sidebar-mini-visible"></span>
                            <span class="sidebar-mini-hidden">Benutzer</span>
                        </li>
                        @canany(['admins.user.read', 'admins.role.read', 'admins.group.read'])
                            <li class="{{ (request()->is('admins/*') || request()->is('admins')) ? ' open' : '' }}">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                    <i class="scannel-icons icon-partner"></i>
                                    <span class="sidebar-mini-hide">Mitarbeiter</span>
                                </a>
                                <ul>
                                    @can('admins.user.read')
                                        <li>
                                            <a class="{{ (request()->is('admins/users') ||  request()->is('admin/users/*')) ? ' active' : '' }}"
                                               href="{{route('get.admin-users')}}">Mitarbeiter
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admins.group.read')
                                        <li>
                                            <a class="{{ (request()->is('admins/groups') ||  request()->is('admin/groups/*'))  ? ' active' : '' }}"
                                               href="{{route('get.admin-groups')}}">Gruppen
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admins.role.read')
                                        <li>
                                            <a class="{{ (request()->is('admins/roles') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                               href="{{route('get.admin-roles')}}">Rollen
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        @canany(['app-user.read', 'app-user.edit', 'app-user.delete', 'app-user.create'])
                            <li class="{{ request()->is('app-users/*') ? ' open' : '' }}">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                    <i class="scannel-icons icon-users"></i>
                                    <span class="sidebar-mini-hide">App-Verwaltung</span>
                                </a>
                                <ul>
                                    <li>
                                        <a class="{{ request()->is('app-users/*') ? ' active' : '' }}"
                                           href="{{route('get.app-users')}}">Nutzer
                                        </a>
                                    </li>
                                <!--<li>
                                        <a class="{{ request()->is('app-users/subscriptions') ? ' active' : '' }}" href="/pages/slick">Abonements</a>
                                    </li>-->
                                </ul>
                            </li>
                        @endcanany

                        @can("helpDisk.read")
                            <li>
                                <a class="{{ (request()->is('helpdisk') ||  request()->is('helpdisk/*')) ? ' active' : '' }}"
                                   href="{{route('helpDisk.index')}}">
                                    <i class="fa fa-question"></i>
                                    <span class="sidebar-mini-hide">Helpdesk</span>
                                </a>
                            </li>
                        @endcan
                        @can('newsletter.read')
                            <li>
                                <a class="{{ (request()->is('newsletter') ||  request()->is('newsletter/*')) ? ' active' : '' }}"
                                   href="{{route('get.newsletters')}}">
                                    <i class="si si-envelope"></i>
                                    <span class="sidebar-mini-hide">Newsletter</span>
                                </a>
                            </li>
                        @endcan

                    <!-- Scannel sub navi-->
                        @canany(['scannel-products.read', 'ingredients.read'])
                            <li class="nav-main-heading">
                                <span class="sidebar-mini-visible"></span>
                                <span class="sidebar-mini-hidden">Scannel</span>
                            </li>
                            @can(['scannel-products.read'])
                                <li class="{{ (request()->is('scannel/products/*') || request()->is('scannel/products')) ? ' open' : '' }}">
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                        <i class="icon-product icon-product"></i>
                                        <span class="sidebar-mini-hide">Produkte</span>
                                    </a>
                                    <ul>
                                        @can('products.food')
                                            <li>
                                                <a class="{{ (request()->is('scannel/products/food') ||  request()->is('admin/users/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.products', ['category' => 'food'])}}">
                                                    Lebensmittel
                                                </a>
                                            </li>
                                        @endcan
                                        @can('products.cosmetics')
                                            <li>
                                                <a class="{{ (request()->is('scannel/products/cosmetics') ||  request()->is('admin/groups/*'))  ? ' active' : '' }}"
                                                   href="{{route('get.scannel.products', ['category' => 'cosmetics'])}}">
                                                    Kosmetika
                                                </a>
                                            </li>
                                        @endcan
                                        @can('products.cleanser')
                                            <li>
                                                <a class="{{ (request()->is('scannel/products/feed') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.products', ['category' => 'feed'])}}">
                                                    Futtermittel
                                                </a>
                                            </li>
                                        @endcan
                                        @can('products.feed')
                                            <li>
                                                <a class="{{ (request()->is('scannel/products/cleanser') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.products', ['category' => 'cleanser'])}}">
                                                    Reinigungsmittel
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('ingredients.read')
                                <li class="{{ (request()->is('scannel/ingredient/ingredients/*') || request()->is('scannel/ingredient/ingredients')) ? ' open' : '' }}">
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                        <i class="icon-product icon-product"></i>
                                        <span class="sidebar-mini-hide">Ingredienz</span>
                                    </a>
                                    <ul>
                                        @can('ingredients.food')
                                            <li>
                                                <a class="{{ (request()->is('scannel/ingredient/ingredients/food') ||  request()->is('admin/users/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.ingredients', ['category' => 'food'])}}">
                                                    Lebensmittel
                                                </a>
                                            </li>
                                        @endcan
                                        @can('ingredients.cosmetics')
                                            <li>
                                                <a class="{{ (request()->is('scannel/ingredient/ingredients/cosmetics') ||  request()->is('admin/groups/*'))  ? ' active' : '' }}"
                                                   href="{{route('get.scannel.ingredients', ['category' => 'cosmetics'])}}">
                                                    Kosmetika
                                                </a>
                                            </li>
                                        @endcan
                                        @can('ingredients.feed')
                                            <li>
                                                <a class="{{ (request()->is('scannel/ingredient/ingredients/feed') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.ingredients', ['category' => 'feed'])}}">
                                                    Futtermittel
                                                </a>
                                            </li>
                                        @endcan
                                        @can('ingredients.cleanser')
                                            <li>
                                                <a class="{{ (request()->is('scannel/ingredient/ingredients/cleanser') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.ingredients', ['category' => 'cleanser'])}}">
                                                    Reinigungsmittel
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @canany(['ingredients.read', 'ingredients.edit', 'ingredients.delete', 'ingredients.create'])
                                <li class="{{ (request()->is('scannel/ingredient/ingredientgroups/*') || request()->is('scannel/ingredient/ingredientgroups')) ? ' open' : '' }}">
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                        <i class="icon-product icon-product"></i>
                                        <span class="sidebar-mini-hide">Ingredienz-Gruppen</span>
                                    </a>
                                    <ul>
                                        @can('ingredients.food')
                                            <li>
                                                <a class="{{ (request()->is('scannel/ingredient/ingredientgroups/food') ||  request()->is('admin/users/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.ingredientgroups', ['category' => 'food'])}}">
                                                    Lebensmittel
                                                </a>
                                            </li>
                                        @endcan
                                        @can('ingredients.cosmetics')
                                            <li>
                                                <a class="{{ (request()->is('scannel/ingredient/ingredientgroups/cosmetics') ||  request()->is('admin/groups/*'))  ? ' active' : '' }}"
                                                   href="{{route('get.scannel.ingredientgroups', ['category' => 'cosmetics'])}}">
                                                    Kosmetika
                                                </a>
                                            </li>
                                        @endcan
                                        @can('ingredients.feed')
                                            <li>
                                                <a class="{{ (request()->is('scannel/ingredient/ingredientgroups/feed') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.ingredientgroups', ['category' => 'feed'])}}">
                                                    Futtermittel
                                                </a>
                                            </li>
                                        @endcan
                                        @can('ingredients.cleanser')
                                            <li>
                                                <a class="{{ (request()->is('scannel/ingredient/ingredientgroups/cleanser') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.ingredientgroups', ['category' => 'cleanser'])}}">
                                                    Reinigungsmittel
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcanany
                            @canany(['producer.read', 'producer.edit', 'producer.delete', 'producer.create'])
                                <li>
                                    <a href="{{route('get.scata.producers')}}"
                                       class="{{ (request()->is('scata/producers') ||  request()->is('scata/producers/*') || request()->is('scata/create-producer')) ? ' active' : '' }}">
                                        <i class="icon-product"></i>
                                        <span class="sidebar-mini-hide">Hersteller</span>
                                    </a>
                                </li>
                            @endcanany
                            @canany(['qualityseals.read', 'qualityseals.edit', 'qualityseals.delete', 'qualityseals.create'])
                                <li>
                                    <a href="{{route('get.scata.qualities')}}"
                                       class="{{ (request()->is('scata/qualities') ||  request()->is('scata/quality/*') || request()->is('scata/create-quality')) ? ' active' : '' }}">
                                        <i class="icon-product"></i>
                                        <span class="sidebar-mini-hide">Gütesiegel</span>
                                    </a>
                                </li>
                            @endcanany
                        @endcanany


                        @canany(['scata-products.read', 'scata-products.edit', 'scata-products.delete', 'open-products.read', 'open-products.edit', 'open-products.delete', 'bot-products.read', 'bot-products.edit', 'bot-products.delete'])
                            <li class="nav-main-heading">
                                <span class="sidebar-mini-visible"></span>
                                <span
                                        class="sidebar-mini-hidden"> IN PROCESSING
                                </span>
                            </li>
                            @canany(['open-products.read', 'open-products.edit', 'open-products.delete'])
                                <li class="{{ (request()->is('scannel/openproducts/*') || request()->is('scannel/openproducts')) ? ' open' : '' }}">
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                        <i class="icon-product icon-product"></i>
                                        <span class="sidebar-mini-hide">Offene Produkte</span>
                                    </a>
                                    <ul>
                                        @can('products.food')
                                            <li>
                                                <a class="{{ (request()->is('scannel/openproducts/food') ||  request()->is('admin/users/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.openproducts', ['category' => 'food'])}}">
                                                    Lebensmittel
                                                </a>
                                            </li>
                                        @endcan
                                        @can('products.cosmetics')
                                            <li>
                                                <a class="{{ (request()->is('scannel/openproducts/cosmetics') ||  request()->is('admin/groups/*'))  ? ' active' : '' }}"
                                                   href="{{route('get.scannel.openproducts', ['category' => 'cosmetics'])}}">
                                                    Kosmetika
                                                </a>
                                            </li>
                                        @endcan
                                        @can('products.feed')
                                            <li>
                                                <a class="{{ (request()->is('scannel/openproducts/feed') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.openproducts', ['category' => 'feed'])}}">
                                                    Futtermittel
                                                </a>
                                            </li>
                                        @endcan
                                        @can('products.cleanser')
                                            <li>
                                                <a class="{{ (request()->is('scannel/openproducts/cleanser') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.openproducts', ['category' => 'cleanser'])}}">
                                                    Reinigungsmittel
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcanany
                            @canany(['scata-products.read', 'scata-products.edit', 'scata-products.delete'])
                                <li class="{{ (request()->is('scata/products/*') || request()->is('scata/products') || request()->is('scata/product/*')) ? ' open' : '' }}">
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                        <i class="icon-product icon-product"></i>
                                        <span class="sidebar-mini-hide">Scata-Produkte</span>
                                    </a>
                                    <ul>
                                        @can('products.food')
                                            <li>
                                                <a class="{{ (request()->is('scata/products/food') ||  request()->is('admin/users/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scata.products', ['category' => 'food'])}}">
                                                    Lebensmittel
                                                </a>
                                            </li>
                                        @endcan
                                        @can('products.cosmetics')
                                            <li>
                                                <a class="{{ (request()->is('scata/products/cosmetics') ||  request()->is('admin/groups/*'))  ? ' active' : '' }}"
                                                   href="{{route('get.scata.products', ['category' => 'cosmetics'])}}">
                                                    Kosmetika
                                                </a>
                                            </li>
                                        @endcan
                                        @can('products.feed')
                                            <li>
                                                <a class="{{ (request()->is('scata/products/feed') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scata.products', ['category' => 'feed'])}}">
                                                    Futtermittel
                                                </a>
                                            </li>
                                        @endcan
                                        @can('products.cleanser')
                                            <li>
                                                <a class="{{ (request()->is('scata/products/cleanser') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scata.products', ['category' => 'cleanser'])}}">
                                                    Reinigungsmittel
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcanany
                            @canany(['bot-products.read', 'bot-products.edit', 'bot-products.delete'])
                                <li class="{{ (request()->is('scannel/bot/products/*') || request()->is('scannel/bot/products')) ? ' open' : '' }}">
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                        <i class="icon-product icon-product"></i>
                                        <span class="sidebar-mini-hide">Bot-Produkte</span>
                                    </a>
                                    <ul>
                                        @can('products.food')
                                            <li>
                                                <a class="{{ (request()->is('scannel/bot/products/food') ||  request()->is('admin/users/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.bot.products', ['category' => 'food'])}}">
                                                    Lebensmittel
                                                </a>
                                            </li>
                                        @endcan
                                        @can('products.cosmetics')
                                            <li>
                                                <a class="{{ (request()->is('scannel/bot/products/cosmetics') ||  request()->is('admin/groups/*'))  ? ' active' : '' }}"
                                                   href="{{route('get.scannel.bot.products', ['category' => 'cosmetics'])}}">
                                                    Kosmetika
                                                </a>
                                            </li>
                                        @endcan
                                        @can('products.feed')
                                            <li>
                                                <a class="{{ (request()->is('scannel/bot/products/feed') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.bot.products', ['category' => 'feed'])}}">
                                                    Futtermittel
                                                </a>
                                            </li>
                                        @endcan
                                        @can('products.cleanser')
                                            <li>
                                                <a class="{{ (request()->is('scannel/bot/products/cleanser') ||  request()->is('admin/roles/*')) ? ' active' : '' }}"
                                                   href="{{route('get.scannel.bot.products', ['category' => 'cleanser'])}}">
                                                    Reinigungsmittel
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcanany
                        @endcanany

                        @if(Gate::allows('viewTelescope'))
                            <li class="nav-main-heading">
                                <span class="sidebar-mini-visible"></span>
                                <span
                                        class="sidebar-mini-hidden">Sonstiges
                                </span>
                            </li>
                        @endif

                        @if(Gate::allows('viewTelescope'))
                            <li>
                                <a href="{{route('telescope')}}">
                                    <i class="si si-rocket"></i>
                                    <span class="sidebar-mini-hide">Logs</span>
                                </a>
                            </li>
                    @endif
                    <!--<li>
           <a href="/">
               <i class="si si-user"></i><span class="sidebar-mini-hide">Mitarbeiter</span>
           </a>
       </li>
       <li>
           <a href="/">
               <i class="si si-users"></i><span class="sidebar-mini-hide">Gruppen</span>
           </a>
       </li>
       <li>
           <a href="/">
               <i class="si si-key"></i><span class="sidebar-mini-hide">Rollen</span>
           </a>
       </li>-->
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </div>
            <!-- Sidebar Content -->
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="content-header-section">
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout"
                            data-action="sidebar_toggle">
                        <i class="fa fa-navicon"></i>
                    </button>
                    <!-- END Toggle Sidebar -->

                    <!-- Open Search Section -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout"
                            data-action="header_search_on">
                        <i class="fa fa-search"></i>
                    </button>

                    @if(isset($helpDiskData))
                        <button type="button" class="btn btn-circle btn-dual-secondary d-none d-md-inline-block"
                                onclick="openNav()">
                            <i class="fa fa-question"></i>
                            Hilfe anzeigen
                        </button>
                @endif
                <!-- END Open Search Section -->

                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="content-header-section">
                    <!-- User Dropdown -->
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user d-sm-none"></i>
                            <span class="d-none d-sm-inline-block">{{Auth::user()->name}}</span>
                            <i class="fa fa-angle-down ml-5"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-200"
                             aria-labelledby="page-header-user-dropdown">
                            <!--<h5 class="h6 text-center py-10 mb-5 border-b text-uppercase">User</h5>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="si si-user mr-5"></i> Profile
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                <span><i class="si si-envelope-open mr-5"></i> Inbox</span>
                                <span class="badge badge-primary">3</span>
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <i class="si si-note mr-5"></i> Invoices
                            </a>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_toggle">
                                <i class="si si-wrench mr-5"></i> Settings
                            </a>

                            <div class="dropdown-divider"></div>
                            -->

                            <a class="dropdown-item" href="{{route('get.logout')}}">
                                <i class="si si-logout mr-5"></i> Sign Out
                            </a>
                        </div>
                    </div>
                    <!-- END User Dropdown -->

                    <!-- Notifications
                    <div class="btn-group" role="group">
                    <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="fa fa-flag"></i>
                       <span class="badge badge-primary badge-pill">5</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right min-width-300" aria-labelledby="page-header-notifications">
                       <h5 class="h6 text-center py-10 mb-0 border-b text-uppercase">Notifications</h5>
                       <ul class="list-unstyled my-20">
                           <li>
                               <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                   <div class="ml-5 mr-15">
                                       <i class="fa fa-fw fa-check text-success"></i>
                                   </div>
                                   <div class="media-body pr-10">
                                       <p class="mb-0">You’ve upgraded to a VIP account successfully!</p>
                                       <div class="text-muted font-size-sm font-italic">15 min ago</div>
                                   </div>
                               </a>
                           </li>
                           <li>
                               <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                   <div class="ml-5 mr-15">
                                       <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                   </div>
                                   <div class="media-body pr-10">
                                       <p class="mb-0">Please check your payment info since we can’t validate them!</p>
                                       <div class="text-muted font-size-sm font-italic">50 min ago</div>
                                   </div>
                               </a>
                           </li>
                           <li>
                               <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                   <div class="ml-5 mr-15">
                                       <i class="fa fa-fw fa-times text-danger"></i>
                                   </div>
                                   <div class="media-body pr-10">
                                       <p class="mb-0">Web server stopped responding and it was automatically restarted!</p>
                                       <div class="text-muted font-size-sm font-italic">4 hours ago</div>
                                   </div>
                               </a>
                           </li>
                           <li>
                               <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                   <div class="ml-5 mr-15">
                                       <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                   </div>
                                   <div class="media-body pr-10">
                                       <p class="mb-0">Please consider upgrading your plan. You are running out of space.</p>
                                       <div class="text-muted font-size-sm font-italic">16 hours ago</div>
                                   </div>
                               </a>
                           </li>
                           <li>
                               <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                   <div class="ml-5 mr-15">
                                       <i class="fa fa-fw fa-plus text-primary"></i>
                                   </div>
                                   <div class="media-body pr-10">
                                       <p class="mb-0">New purchases! +$250</p>
                                       <div class="text-muted font-size-sm font-italic">1 day ago</div>
                                   </div>
                               </a>
                           </li>
                       </ul>
                       <div class="dropdown-divider"></div>
                       <a class="dropdown-item text-center mb-0" href="javascript:void(0)">
                           <i class="fa fa-flag mr-5"></i> View All
                       </a>
                    </div>
                    </div>
                    END Notifications -->


                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header">
                <div class="content-header content-header-fullrow">
                    <form action="/dashboard" method="POST">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <!-- Close Search Section -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <button type="button" class="btn btn-secondary" data-toggle="layout"
                                        data-action="header_search_off">
                                    <i class="fa fa-times"></i>
                                </button>
                                <!-- END Close Search Section -->
                            </div>
                            <input type="text" class="form-control" placeholder="Search or hit ESC.."
                                   id="page-header-search-input" name="page-header-search-input">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Header Search -->

            <!-- Header Loader -->
            <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-primary">
                <div class="content-header content-header-fullrow text-center">
                    <div class="content-header-item">
                        <i class="fa fa-sun-o fa-spin text-white"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">

            @yield('content-header')

            <div class="content">
                @yield('content')
            </div>
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="opacity-0">
            <div class="content py-20 font-size-sm clearfix">
                <div class="float-left">
                    <a class="font-w600" href="#" target="_blank">Scannel</a> &copy;
                    <span class="js-year-copy"></span>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <!-- Codebase Core JS -->
    <script src="{{ mix('js/codebase.app.js') }}"></script>

    <!-- Laravel Scaffolding JS -->
<!-- <script src="{{ mix('js/laravel.app.js') }}"></script> -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/plug-ins/1.10.21/sorting/datetime-moment.js') }}"></script>
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.fn.dataTable.moment('DD.MM.YYYY HH:mm');

            $('.scannel-datatable').dataTable({
                'language': {
                    'info': '<span>_TOTAL_/_MAX_</span> Einträge',
                    'infoFiltered': '',
                    'paginate': {
                        'next': '<i class="scannel-icons icon-arrow-right"></i>',
                        'previous': '<i class="scannel-icons icon-arrow-left"></i>',
                    },
                    'search': '<i class="fa fa-search"></i>',
                    'searchPlaceholder': 'Hier Suchtext eingeben...',
                    'lengthMenu': '_MENU_'
                }
            })

        });


    </script>
    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "300px";
            document.getElementById("main-container").style.marginRight = "300px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main-container").style.marginRight = "0";
        }
    </script>
    @yield('js_after')
</body>
</html>
