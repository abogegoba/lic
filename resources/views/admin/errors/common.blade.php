<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="format-detection" content="telephone=no">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skin/skin-blue.css') }}">
    @yield('css')
</head>

<body>
<div class="wrapper">
    <div class="error-screen">
        <div class="error-screen-title">
            @yield('screen.title')
        </div>

        <div class="error-screen-body py-5">
            @yield('screen.body')
        </div>

        <div class="btn-row">
            @yield('btn.row')
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('js')

</body>
</html>