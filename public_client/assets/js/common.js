$(function() {
/* Toggle Global navigation
--------------------------------------------- */
    $('#gnav').hide();
    $(document).on('click touchend', function(e) {
        if (!$(e.target).closest('#gnav').length && !$(e.target).closest('#hdr__button').length){
            $('#gnav').fadeOut(600, function(){});
        } else if($(e.target).closest('#hdr__button').length){
            if ($('#gnav').is(':hidden')){
                $('#gnav').fadeIn(600, function(){});
            }
        }
    });
    $('#gnav .gnav__close').on('click', function() {
        $('#gnav').fadeOut(600, function(){});
    });

/* セレクトボックス初期カラー変更
--------------------------------------------- */
    $('select').on('change',function(){
        $(this).css('color', "#000");
    })

/* ツールチップ表示
--------------------------------------------- */
    $('.tooltip__open').on('click', function() {
        $(this).parent('.tooltip').toggleClass('is-active');
        return false;
    });
    $('.tooltip__close').on('click', function() {
        $(this).parents('.tooltip').removeClass('is-active');
    });
    $(document).on('click touchstart', function (e) {
        if ($('.tooltip__inner').css('display') != 'none') {
            if (!$(e.target).closest('.tooltip').length) {
                $('.tooltip').removeClass('is-active');
            }
        }
    });
});
