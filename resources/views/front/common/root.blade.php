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
    <link rel="stylesheet" href="{{asset('css/layout.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/common_custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/describe/modalwindow.css')}}">
    <link rel="stylesheet" href="{{asset('css/device_capability.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <script src="{{asset('js/describe/modalwindow.js')}}"></script>
    @yield('script')
    <style>
        [v-cloak] {
            display: none;
        }
    </style>

</head>

<body>
@include('front.common.header')
<div id="container">    
    @yield('breadcrumbs')
    @if(!empty($memberAuthentication))
        @include('front.common.device_capability')
    @endif

    @include('front.common.sidebar')
    <main id="main">
        <div id="app">
            @yield('content')
            @if(!empty($memberAuthentication))
                @include('front.common.device_capability_modal')
            @endif
            {{--例外処理（vue.js)--}}
            <exception></exception>
        </div>
    </main>

    @include('front.common.footer')
</div>

{{--vue.js用--}}
<script src="{{ asset('js/app.js') }}"></script>
@section('vue')
    <script src="{{ asset('js/vue.js') }}"></script>
@show

{{--js--}}
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/slick/slick.min.js') }}"></script>
<script>
    moment.locale('ja');
    @if(!empty($memberAuthentication))

    // Enable pusher logging - don't include this in production
    //Pusher.logToConsole = true;

    var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
        cluster: '{{env('PUSHER_APP_CLUSTER')}}',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-front-channel');
    channel.bind('my-front-event', function(data) {
        if(data.to == '{{$memberAuthentication->userAccountId}}'){
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
                var url = "{{ route('front.message.detail','###') }}";
                url = url.replace("###", data.from);
                var notification = '<li class="msg_list" id="#">\n' +
                    '                                <div class="cursor-pointer js-link-area" data-href="'+url+'">\n' +
                    '                                    <picture>\n' +
                    '                                        <img src="'+data.company_logo+'" alt="'+data.name+'">\n' +
                    '                                    </picture>\n' +
                    '                                    <div>\n' +
                    '                                        <p class="msg_form"><b>'+data.name+'</b>からメッセージがあります。</p>\n' +
                    '                                        <p class="msg_time">'+time_calculation+'</p>\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    '                            </li>';

                $('#notification_msg_list').prepend(notification);
            }else if(data.notification_type == 'like'){
                if(data.like_type == 20){
                    $('#empty_like_notice').hide();
                    var count_like = $('#like_ntfy').data('like_count');
                    var new_like_count = parseInt(count_like)+1;
                    $('#like_ntfy').data('like_count',new_like_count);
                    $('#like_ntfy').text(new_like_count);
                    if ($('#like_ntfy').css('display') == 'none') {
                        $('#like_ntfy').show();
                    }
                    var notification = '<li class="like_list" id="#">\n' +
                        '                                <div class="cursor-pointer js-link-area" data-href="#">\n' +
                        '                                    <picture>\n' +
                        '                                        <img src="'+data.company_logo+'" alt="'+data.name+'">\n' +
                        '                                    </picture>\n' +
                        '                                    <div>\n' +
                        '                                        <p class="msg_form"><b>'+data.name+'</b>がイイネしました。</p>\n' +
                        '                                        <p class="msg_time">'+time_calculation+'</p>\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </li>';

                    $('#notification_like_list').prepend(notification);
                }
            }
        }
    });
    @endif

    function myFunction(id_name){
        if(id_name == 'like_dropdown'){
            $('#'+id_name).toggle();
            $('#msg_dropdown').hide();
        }else if(id_name == 'msg_dropdown'){
            $('#'+id_name).toggle();
            $('#like_dropdown').hide();
        }
    }

    $(document).ready(function(){
        @if(!empty($memberAuthentication))
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: '{!! route('front.message.unread_message_list') !!}',
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
                            var url = "{{ route('front.message.detail','###') }}";
                            url = url.replace("###", value.sending_user_account_id);
                            var time_calculation = moment(value.created_at, "YYYY-MM-DD h:mm:ss").fromNow();
                            var logo = data.companies[value.companyId];

                            var notification = '<li class="msg_list" id="#">\n' +
                                '                                <div class="cursor-pointer js-link-area" data-href="'+url+'">\n' +
                                '                                    <picture>\n' +
                                '                                        <img src="'+logo.file_path+'" alt="'+value.name+'">\n' +
                                '                                    </picture>\n' +
                                '                                    <div>\n' +
                                '                                        <p class="msg_form"><b>'+value.name+'</b>からメッセージがあります。</p>\n' +
                                '                                        <p class="msg_time">'+time_calculation+'</p>\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '                            </li>';

                            $('#notification_msg_list').append(notification);
                        });
                    }else{
                        $('#empty_msg_notice').show();
                    }

                    var count_ex_like = data.like.length;
                    if(count_ex_like != 0){
                        $('#empty_like_notice').hide();
                        $('#like_ntfy').data('like_count',count_ex_like);
                        $('#like_ntfy').text(count_ex_like);
                        if ($('#like_ntfy').css('display') == 'none') {
                            $('#like_ntfy').show();
                        }
                        $.each(data.like, function(l_index, l_value) {
                            var l_url = "{{ route('front.company.detail','###') }}";
                            l_url = l_url.replace("###", l_value.company_id);
                            var l_time_calculation = moment(l_value.updated_at, "YYYY-MM-DD h:mm:ss").fromNow();
                            var l_logo = data.companies[l_value.company_id];

                            var l_notification = '<li class="like_list" id="#">\n' +
                                '                                <div class="cursor-pointer js-link-area" data-href="'+l_url+'">\n' +
                                '                                    <picture>\n' +
                                '                                        <img src="'+l_logo.file_path+'" alt="'+l_value.name+'">\n' +
                                '                                    </picture>\n' +
                                '                                    <div>\n' +
                                '                                        <p class="msg_form"><b>'+l_value.name+'</b>が気になるしました</p>\n' +
                                '                                        <p class="msg_time">'+l_time_calculation+'</p>\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '                            </li>';

                            $('#notification_like_list').append(l_notification);
                        });
                    }else{
                        $('#empty_like_notice').show();
                    }
                }

            }
        });
        @endif

        //
        if ($('#mypageMenuNew').length > 0)
        {
            var mypageMenuHeight = Math.round($('#mypageMenuNew').innerHeight());
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
@yield('js')

</body>
<!-- Google Tag Manager (noscript) -->
{{--<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PVT4T55"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>--}}
<!-- End Google Tag Manager (noscript) -->
</html>
