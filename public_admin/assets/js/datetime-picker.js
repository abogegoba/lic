$(function () {
    // カレンダー初期化
    $(document).find('.js-datepicker').datepicker({
        format: 'yy/mm/dd',
        weekStart: 1,
        autoclose: true,
        language: 'ja',
        showOtherMonths: true
    });

    // 日付初期値入力
    $(document).find('.js-datepicker').each(function() {
        if(!$(this).val() && $(this).data("default-blank") !== true){
            $(this).datepicker("setDate", new Date());
        }
    });

    // カレンダー表示
    $(document).on('click', '.js-datepicker', function () {
        $(this).datepicker('show');
    });

    // カレンダーの値変更
    $(document).on('change', '.js-datepicker', function () {
        var targetId = $(this).data("target-id");
        if (typeof targetId !== "undefined") {
            $("#" + targetId).val($(this).val());
        }
        var result = checkInputData($(this).val());
        $(this).datepicker().datepicker("setDate", result).datepicker('hide');
    });

    // 右クリックのコピペに対応
    $(document).on('paste', '.js-datepicker', function () {
        var currentFiled = $(this);
        setTimeout(function () {
            if (currentFiled.val() != '') {
                var result = checkInputData(currentFiled.val());
                currentFiled.val(result);
                currentFiled.datepicker().datepicker("setDate", currentFiled.val());
                pasteDate = currentFiled.val();
            }
        }, 10)
    });

    // エンター押したらcloseする
    $(document).on('keydown', '.js-datepicker', function (event) {
        if (event.which == 13) {
            var e = jQuery.Event("keydown")
                , result;
            e.which = 9;//tab
            e.keyCode = 9;

            $(this).trigger(e);
            if ($(this).val().match(/(\d{4})\/(\d{1,2})\/(\d{1,2})$/)) {
                result = checkInputData($(this).val());
            } else if ($(this).val()) {
                var now = new Date();
                var year = now.getFullYear()
                    , month = now.getMonth() + 1
                    , day = now.getDate();
                result = checkInputData(year + '/' + month + '/' + day);
            }
            $(this).val(result);
            $(this).datepicker().datepicker("setDate", $(this).val()).datepicker('hide');
            return false;
        }
    });

    // アイコンから日付入力
    $(document).on('click', '.js-datepicker-focus', function () {
        if ($(this).closest("label").length > 0) {
            $(this).prev(".datepicker").datepicker().focus();
        } else {
            $(this).closest(".input-group").find("input.js-datepicker").datepicker().focus();
        }
    });

    // disabled時等、該当の箇所のdatepickerを削除
    $(".js-disabled-datepicker").each(function () {
        $("*").removeClass("js-datepicker");
    });

    // 日付のフォーマットチェック
    function checkInputData(date) {
        var result;
        if (date.match(/(\d{4})\/(\d{1,2})\/(\d{1,2})$/)) {
            result = date.match(/(\d{4})\/(\d{1,2})\/(\d{1,2})/);
            var year = result[1]
                , month = result[2]
                , day = result[3];
            if (month.length === 1) {
                month = "0" + month;
            }
            if (day.length === 1) {
                day = "0" + day;
            }
            return year + '/' + month + '/' + day;
        }
        return date;
    }

    // 時間選択初期化
    $(document).find('.js-timepicker').timepicker({
        showInputs: false,
        minuteStep: 15,
        showMeridian: false
    });


    // 初期値空設定
    var timePickers = $(document).find('.js-timepicker');
    timePickers.each(function() {
        if($(this).data("is-blank") === true){
            $(this).val(null);
        }
    });

    // アイコンから時間選択
    $(document).on('click', '.js-timepicker-focus', function () {
        if ($(this).closest("label").length > 0) {
            $(this).prev(".js-timepicker").timepicker().focus();
        } else {
            $(this).closest(".input-group").find("input.js-timepicker").timepicker().focus();
        }
    });

    // disabled時等、該当の箇所のtimepickerクラスを削除
    $(".js-disabled-timepicker").each(function () {
        $("*").removeClass("js-timepicker");
    });

});