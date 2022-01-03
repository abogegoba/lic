$(function () {
    $(document).on('click', '.scroll-save', function () {
        var scrtop = $(window).scrollTop();
        sessionStorage.setItem('client', scrtop);
    });

    var key = sessionStorage.getItem('key_client');
    if( key === "1"){
        $(document).ready(function(){
            var pos = sessionStorage.getItem('client');
            $('html,body').animate({ scrollTop: pos });
            sessionStorage.clear()
        });
    }

});