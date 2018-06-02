<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title','KaraSun - backend')</title>

    <!-- Bootstrap CSS -->
    @include('LBDM::layouts.helpers.css.core_css')

    <!-- Optional CSS -->
    @yield('plugin_css')
    @yield('inline_css')

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('LBDM::layouts.helpers.js.core_js')

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
