<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('client/css/layout_client.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/common_client.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/common_custom.css')}}">
@yield('css')
<!-- Google Tag Manager -->
    {{--<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PVT4T55');</script>--}}
    <!-- End Google Tag Manager -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{asset('client/js/fitie.js')}}"></script>
    <script src="{{asset('client/js/common.js')}}"></script>
    <script src="{{asset('client/js/common_custom.js')}}"></script>

    <script>window.Promise || document.write('<script src="{{ asset('client/js/promise-7.0.4.min.js') }}"><\/script>');</script>
</head>

<body>
<div id="container" class="client">
    <main id="main">
        @yield('content')
    </main>
</div>

{{--js--}}
{{--<script src="{{ asset('client/js/jquery.min.js') }}"></script>--}}
<script src="{{ asset('client/js/slick/slick.min.js') }}"></script>
{{--<script src="{{ asset('client/js/main.js') }}"></script>--}}
@yield('js')

</body>
<!-- Google Tag Manager (noscript) -->
{{--<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PVT4T55"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>--}}
<!-- End Google Tag Manager (noscript) -->
</html>
