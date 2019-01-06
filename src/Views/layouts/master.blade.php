<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title','پنل مدیریت')</title>

    <!-- global stylesheets -->
    <link href="{{url('vendor/laravel_basicdata_manager/build/backend/css/init_core.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('vendor/laravel_basicdata_manager/build/fonts/IranSans/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('vendor/laravel_basicdata_manager/build/backend/css/init_custom_style.min.css')}}" rel="stylesheet" type="text/css">
@yield('custom_plugin_style')
<!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset('vendor/laravel_basicdata_manager/build/backend/js/init_core.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
@yield('theme_plugin_js')
    <script type="text/javascript" src="{{url('vendor/laravel_basicdata_manager/build/backend/js/init_plugin.min.js')}}"></script>
@yield('custom_plugin_js')
    <script src="{{asset('vendor/laravel_basicdata_manager/build/common/js/init_data.min.js')}}"></script>
<!-- /theme JS files -->
    @yield('inline_style')
    <style>
        div.dataTables_wrapper {
            direction: rtl;
        }
    </style>
</head>

<body class="navbar-top">
<!-- Page container -->
<div class="container-fluid">
    <!-- Page content -->
    <!-- Content area -->
    <div class="content">
        <div id="form_message_box" class="form_message_area"></div>
        <div class="row">
            @yield('content')
        </div>
    </div>
    <!-- /content area -->
</div>
<div id="all_modals"></div>
@yield('inline_js')
</body>
</html>
