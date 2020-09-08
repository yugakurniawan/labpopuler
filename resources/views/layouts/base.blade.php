<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="@yield('meta-description', 'This is an example dashboard created using build-in elements and components.')">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="{{ asset('architectui-html-free/main.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow bg-grow-early header-text-light">
            @include('layouts.components.header')
        </div>
        @include('layouts.components.ui-theme-settings')
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                @include('layouts.components.sidebar')
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                @yield('page-title-heading')
                            </div>
                            <div class="page-title-actions">
                                @yield('page-title-actions')
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
                @include('layouts.components.footer')
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('architectui-html-free/assets/scripts/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
