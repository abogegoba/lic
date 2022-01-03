<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="@yield('description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="favicon2.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/layout_client.css')}}">
    <link rel="stylesheet" href="{{asset('css/common_client.css')}}">
    <link rel="stylesheet" href="{{asset('css/common_custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/modalwindow.css')}}">
    <link rel="stylesheet" href="{{asset('css/device_capability.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
    @yield('css')
    <!-- Google Tag Manager -->
    {{--<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PVT4T55');</script>--}}
    <!-- End Google Tag Manager -->
    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{asset('js/fitie.js')}}"></script>
    <script src="{{asset('js/common.js')}}"></script>
    <script src="{{asset('js/common_custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
    <script>window.Promise || document.write('<script src="{{ asset('js/promise-7.0.4.min.js') }}"><\/script>');</script>
    <script src="{{asset('js/modalwindow.js')}}"></script>
    <style>
        [v-cloak] {
            display: none;
        }
    </style>

</head>

<body>
<div id="container" class="client">

    @include('client.common.header')
    @yield('breadcrumbs')
    @if(!empty($clientAuthentication))
        @include('client.common.device_capability')
    @endif

    @include('client.common.sidebar')
    <main id="main">
        <div id="app">
            @yield('content')
            @if(!empty($clientAuthentication))
                @include('client.common.device_capability_modal')
            @endif
            {{--vue.jsで使用--}}
            <exception></exception>
        </div>
    </main>

    @include('client.common.footer')
</div>

<script src="{{ asset('js/app.js') }}"></script>
@section('vue')
    <script src="{{ asset('js/vue.js') }}"></script>
@show

{{--js--}}
<script src="{{ asset('js/slick/slick.min.js') }}"></script>
<script>
    moment.locale('ja');
    @if(!empty($clientAuthentication))
    // Enable pusher logging - don't include this in production
    //Pusher.logToConsole = true;

    var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
        cluster: '{{env('PUSHER_APP_CLUSTER')}}',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-client-channel');
    channel.bind('my-client-event', function(data) {
        if(data.to == '{{$clientAuthentication->userAccountId}}'){
            var name = data.name;
            var time_calculation = moment(data.sending_date, "YYYY-MM-DD h:mm:ss").fromNow();
            if(data.notification_type == 'message'){
                $('#empty_msg_notice').hide();
                var count_msg = $('#msg_ntfy').data('msg_count');
                var new_msg_count = parseInt(count_msg)+1;
                $('#msg_ntfy').data('msg_count',new_msg_count);
                $('#msg_ntfy').text(new_msg_count);
                if ($('#msg_ntfy').css('display') == 'none') {
                    $('#msg_ntfy').show();
                }
                var url = "{{ route('client.message.detail','###') }}";
                url = url.replace("###", data.from);
                var notification = '<li class="msg_list" id="#">\n' +
                    '                                <div class="cursor-pointer js-link-area" data-href="'+url+'">\n' +
                    '                                    <picture>\n' +
                    '                                        <img src="'+data.user_photo+'" alt="'+data.name+'">\n' +
                    '                                    </picture>\n' +
                    '                                    <div>\n' +
                    '                                        <p class="msg_form"><b>'+data.name+'</b>からメッセージがあります。</p>\n' +
                    '                                        <p class="msg_time">'+time_calculation+'</p>\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    '                            </li>';

                $('#notification_msg_list').prepend(notification);
            }
        }
    });
    @endif

    function myFunction(id_name){
        $('#'+id_name).toggle();
    }

    $(document).ready(function(){
        @if(!empty($clientAuthentication))
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: '{!! route('client.message.unread_message_list') !!}',
            cache: false,
            success: (data) => {
                if(data.res ==1){
                    var count_ex_msg = data.message.length;
                    if(count_ex_msg != 0){
                        $('#empty_msg_notice').hide();
                        $('#msg_ntfy').data('msg_count',count_ex_msg);
                        $('#msg_ntfy').text(count_ex_msg);
                        if ($('#msg_ntfy').css('display') == 'none') {
                            $('#msg_ntfy').show();
                        }
                        $.each(data.message, function(index, value) {
                            var url = "{{ route('client.message.detail','###') }}";
                            url = url.replace("###", value.sending_user_account_id);
                            var time_calculation = moment(value.created_at, "YYYY-MM-DD h:mm:ss").fromNow();
                            var logo = data.memberPhotos[value.memberId];

                            var notification = '<li class="msg_list" id="#">\n' +
                                '                                <div class="cursor-pointer js-link-area" data-href="'+url+'">\n' +
                                '                                    <picture>\n' +
                                '                                        <img src="'+logo+'" alt="'+value.memberName+'">\n' +
                                '                                    </picture>\n' +
                                '                                    <div>\n' +
                                '                                        <p class="msg_form"><b>'+value.memberName+'</b>からメッセージがあります。</p>\n' +
                                '                                        <p class="msg_time">'+time_calculation+'</p>\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '                            </li>';

                            $('#notification_msg_list').append(notification);
                        });
                    }else{
                        $('#empty_msg_notice').show();
                    }
                }

            }
        });
        @endif

        if ($('#mypageMenuNew').length > 0)
        {
            var mypageMenuHeight = Math.round($('#mypageMenuNew').outerHeight());
            var fixed_short_into_position = $('.fixed_short_into').css('top');
            if($('#message__hdr').length > 0) {
                var message__hdr_margin_top = $('#message__hdr').css("marginTop");
            }
            if($('.message-detail').length > 0) {
                var message_detail_padding_top = $('.message-detail').css("paddingTop");
            }
            if($('.main__content').length > 0) {
                var main__content_margin_top = $('.main__content').css("marginTop");
            }

            $('#drawer').click(function(){
                var drawer_position = $('#drawer').position();

                if($("#mypageMenuNew").is(":visible")){
                    $("#mypageMenuNew").hide();
                    $(this).css('top',(drawer_position.top-mypageMenuHeight));
                    $('.up_down').empty();
                    $('.up_down').html( "<i class=\"fa fa-angle-down\" aria-hidden=\"true\"></i>" );
                    if($('.contents').length > 0){
                        var contents_margin_top = $('.contents').css("marginTop");
                        $('.contents').css('margin-top',((parseInt(contents_margin_top)-mypageMenuHeight)+'px'));
                    }

                    if($('.fixed_short_into').is(":visible")){
                        $('.fixed_short_into').css('top',((parseInt(fixed_short_into_position)-mypageMenuHeight)+'px'));
                    }

                    if($('#message__hdr').length > 0){
                        $('#message__hdr').css('margin-top',((parseInt(message__hdr_margin_top)-mypageMenuHeight)+'px'));
                        message__hdr_margin_top = (parseInt(message__hdr_margin_top)-mypageMenuHeight)+'px';
                    }
                    if($('.message-detail').length > 0){
                        $('.message-detail').css('padding-top',((parseInt(message_detail_padding_top)-mypageMenuHeight)+'px'));
                        message_detail_padding_top = (parseInt(message_detail_padding_top)-mypageMenuHeight)+'px';
                    }

                    if($('.main__content').length > 0){
                        $('.main__content').css('margin-top',((parseInt(main__content_margin_top)-mypageMenuHeight)+'px'));
                        main__content_margin_top = (parseInt(main__content_margin_top)-mypageMenuHeight)+'px';
                    }
                }else{
                    $("#mypageMenuNew").show();
                    $(this).css('top',(drawer_position.top+mypageMenuHeight));
                    $('.up_down').empty();
                    $('.up_down').html( "<i class=\"fa fa-angle-up\" aria-hidden=\"true\"></i>" );
                    if($('.contents').length > 0){
                        var contents_margin_top = $('.contents').css("marginTop");
                        $('.contents').css('margin-top',((parseInt(contents_margin_top)+mypageMenuHeight)+'px'));
                    }

                    if($('.fixed_short_into').is(":visible")){
                        $('.fixed_short_into').css('top',fixed_short_into_position);
                    }

                    if($('#message__hdr').length > 0){
                        $('#message__hdr').css('margin-top',((parseInt(message__hdr_margin_top)+mypageMenuHeight)+'px'));
                        message__hdr_margin_top = (parseInt(message__hdr_margin_top)+mypageMenuHeight)+'px';
                    }
                    if($('.message-detail').length > 0){
                        $('.message-detail').css('padding-top',((parseInt(message_detail_padding_top)+mypageMenuHeight)+'px'));
                        message_detail_padding_top = (parseInt(message_detail_padding_top)+mypageMenuHeight)+'px';
                    }

                    if($('.main__content').length > 0){
                        $('.main__content').css('margin-top',((parseInt(main__content_margin_top)+mypageMenuHeight)+'px'));
                        main__content_margin_top = (parseInt(main__content_margin_top)+mypageMenuHeight)+'px';
                    }
                }
            })
        }
    });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha256-AFAYEOkzB6iIKnTYZOdUf9FFje6lOTYdwRJKwTN5mks=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/ja.min.js" integrity="sha256-WbJEbkRW+x/FGFR+Q7SeqMh5OxfjbPyEZfBCXSiTq08=" crossorigin="anonymous"></script>
@yield('js')

</body>
<!-- Google Tag Manager (noscript) -->
{{--<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PVT4T55"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>--}}
<!-- End Google Tag Manager (noscript) -->
</html>
