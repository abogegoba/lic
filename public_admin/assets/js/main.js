$(function () {

// スマートフォンのみ電話番号リンク有効
    var ua = navigator.userAgent;
    if (ua.indexOf('iPhone') > 0 && ua.indexOf('iPod') == -1 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0 && ua.indexOf('SC-01C') == -1 && ua.indexOf('A1_07') == -1) {
        $('.tel_link').each(function () {
            var str = $(this).text();
            $(this).html($('<a>').attr('href', 'tel:' + str.replace(/-/g, '')).append(str + '</a>'));
        });
    }

    // IEコンテンツの高さ設定
    var userAgent = window.navigator.userAgent.toLowerCase();
    var mainContentHeigh = $('.main-content > form').outerHeight();

    if (userAgent.indexOf('msie') !== -1 || userAgent.indexOf('trident') !== -1) {
        $('.wrapper').css({
            "min-height": mainContentHeigh + 30
        });
    }
});