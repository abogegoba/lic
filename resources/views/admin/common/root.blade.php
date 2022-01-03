<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="favicon2.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skin/skin-blue.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
    @yield('css')
    <script>window.Promise || document.write('<script src="{{ asset('js/promise-7.0.4.min.js') }}"><\/script>');</script>
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
</head>
<body>

<div id="app">
    <div class="wrapper container-fluid">
        <!-- ヘッダー読み込み-->
        @include('admin.common.header')
        <div class="row content-sidebar sidebar-md-left">
            <!-- サイドメニュー読み込み-->
            @include('admin.common.sidebar')
            <main class="col-12 col-md-9 col-xl-10 main-content">
                @yield('content')
            </main>
        </div>
    </div>
    <indicator v-cloak>
        <div slot="field" slot-scope="component">
            <div class="loading-overlay">
                <div class="loading">
                    <div class="loading-icon mb-5">
                        <img src="{{ asset('img/common/icon_loading.png') }}" alt="">
                    </div>
                    <span>@{{ component.label }}</span>
                </div>
            </div>
        </div>
    </indicator>
    <exception></exception>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/jquery.ui.datepicker-ja.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('js/Sortable.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha256-AFAYEOkzB6iIKnTYZOdUf9FFje6lOTYdwRJKwTN5mks=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/ja.min.js" integrity="sha256-WbJEbkRW+x/FGFR+Q7SeqMh5OxfjbPyEZfBCXSiTq08=" crossorigin="anonymous"></script>
@section('vue')
    <script src="{{ asset('js/vue.js') }}"></script>
@show
@yield('js')
</body>
</html>
