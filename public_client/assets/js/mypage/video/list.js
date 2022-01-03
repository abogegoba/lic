$(function () {

    var reservationSelect = $('.js-reservation-select');
    var historySelect = $('.js-history-select');

    var reservationArea = $('.js-reservation');
    var historyArea = $('.js-history');
    var headLine = $('.js-headline');

    var choiceSelected = function () {
        if (historySelect.hasClass('active')) {
            // 面接履歴選択時
            reservationSelect.removeClass('active');
            reservationArea.hide();
            historyArea.show();
        } else {
            // 面接予約を選択
            reservationSelect.addClass('active');
            historySelect.removeClass('active');
            reservationArea.show();
            historyArea.hide();
        }
    };

    $(document).on('click', '.js-reservation-select', function () {
        document.title = "Web面接予約カレンダー│マイページ｜LinkT(リンクト) ";
        headLine.text("Web面接予約カレンダー");
        reservationSelect.addClass('active');
        historySelect.removeClass('active');
        choiceSelected();
    });

    $(document).on('click', '.js-history-select', function () {
        document.title = "Web面接履歴一覧│マイページ｜LinkT(リンクト) ";
        headLine.text("Web面接履歴");
        historySelect.addClass('active');
        reservationSelect.removeClass('active');
        choiceSelected();
    });

    choiceSelected();

});