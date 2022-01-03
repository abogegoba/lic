<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="shortcut icon" href="favicon2.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo e(asset('css/layout_client.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/common_client.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/common_custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/modalwindow.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/device_capability.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
    <?php echo $__env->yieldContent('css'); ?>
    <!-- Google Tag Manager -->
    
    <!-- End Google Tag Manager -->
    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo e(asset('js/fitie.js')); ?>"></script>
    <script src="<?php echo e(asset('js/common.js')); ?>"></script>
    <script src="<?php echo e(asset('js/common_custom.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
    <script>window.Promise || document.write('<script src="<?php echo e(asset('js/promise-7.0.4.min.js')); ?>"><\/script>');</script>
    <script src="<?php echo e(asset('js/modalwindow.js')); ?>"></script>
    <style>
        [v-cloak] {
            display: none;
        }
    </style>

</head>

<body>
<div id="container" class="client">

    <?php echo $__env->make('client.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('breadcrumbs'); ?>
    <?php if(!empty($clientAuthentication)): ?>
        <?php echo $__env->make('client.common.device_capability', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('client.common.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <main id="main">
        <div id="app">
            <?php echo $__env->yieldContent('content'); ?>
            <?php if(!empty($clientAuthentication)): ?>
                <?php echo $__env->make('client.common.device_capability_modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            
            <exception></exception>
        </div>
    </main>

    <?php echo $__env->make('client.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>

<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php $__env->startSection('vue'); ?>
    <script src="<?php echo e(asset('js/vue.js')); ?>"></script>
<?php echo $__env->yieldSection(); ?>


<script src="<?php echo e(asset('js/slick/slick.min.js')); ?>"></script>
<script>
    moment.locale('ja');
    <?php if(!empty($clientAuthentication)): ?>
    // Enable pusher logging - don't include this in production
    //Pusher.logToConsole = true;

    var pusher = new Pusher('<?php echo e(env('PUSHER_APP_KEY')); ?>', {
        cluster: '<?php echo e(env('PUSHER_APP_CLUSTER')); ?>',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-client-channel');
    channel.bind('my-client-event', function(data) {
        if(data.to == '<?php echo e($clientAuthentication->userAccountId); ?>'){
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
                var url = "<?php echo e(route('client.message.detail','###')); ?>";
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
    <?php endif; ?>

    function myFunction(id_name){
        $('#'+id_name).toggle();
    }

    $(document).ready(function(){
        <?php if(!empty($clientAuthentication)): ?>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: '<?php echo route('client.message.unread_message_list'); ?>',
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
                            var url = "<?php echo e(route('client.message.detail','###')); ?>";
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
        <?php endif; ?>

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
<?php echo $__env->yieldContent('js'); ?>

</body>
<!-- Google Tag Manager (noscript) -->

<!-- End Google Tag Manager (noscript) -->
</html>
