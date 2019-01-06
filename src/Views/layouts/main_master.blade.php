<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title','KaraSun - backend')</title>

    <!-- All CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/laravel_basicdata_manager/build/css/init_core_LBDM.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/laravel_basicdata_manager/build/css/style.css')}}">

    <!-- Optional CSS -->
    @yield('plugin_css')
    @yield('inline_css')

    <!-- All JS -->
    <script type="text/javascript" src="{{asset('vendor/laravel_basicdata_manager/build/js/init_core_LBDM.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/laravel_basicdata_manager/build/js/init_data_LBDM.min.js')}}"></script>

    <!-- Optional JavaScript -->
    @yield('plugin_js')
    @yield('inline_js')
</head>
<body>

@yield('content')

<!-- Optional JavaScript -->
@yield('footer_plugin_js')
@yield('footer_inline_js')

</body>
</html>
