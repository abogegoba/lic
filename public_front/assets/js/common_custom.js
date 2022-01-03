$(function () {
    /**
     * ボタンリンク（別タブ表示）
     */
    $(document).on('click', '.js-btn-target-blank', function () {
        var href = $(this).data('href');
        window.open(href);
    });

    /**
     * ボタンサブミット
     */
    $(document).on('click', '.js-btn-submit', function () {
        var btn = $(this);
        var formId = btn.data('form-id');
        if (formId) {
            $("#" + formId).submit();
        } else {
            $("form").submit();
        }
        btn.prop("disabled", true);
        $('a.js-link').click(function () {
            return false;
        })
    });

    /**
     * リンクサブミット
     */
    $(document).on('click', '.js-btn-link', function () {
        var btn = $(this);
        location.href = btn.data('href');
        btn.prop("disabled", true);
        setTimeout(function () {
            btn.prop("disabled", false);
        }, 2000);
    });

    $(document).on('click', '.js-link-area', function () {
        var area = $(this);
        location.href = area.data('href');
    });
    // データ存在チェック
     isData = function (data) {
        return !(data === "" || data === null || data === undefined || (Array.isArray(data) && data.length <= 0) || ($.isPlainObject(data) && $.isEmptyObject(data)));
    };
});