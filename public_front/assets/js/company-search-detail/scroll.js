$(function () {
    $(document).on('click', '.scroll-save', function () {
        var scrtop = $(window).scrollTop();
        sessionStorage.setItem('front', scrtop);
    });

    var key = sessionStorage.getItem('key_front');
    if( key === "1"){
        $(document).ready(function(){
            var pos = sessionStorage.getItem('front');
            $('html,body').animate({ scrollTop: pos });
            sessionStorage.clear()
        });
    }

});