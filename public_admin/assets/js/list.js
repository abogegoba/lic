/**
 * 共通一覧JS
 */
$(function () {
    /**
     * 削除確認
     */
    $(document).on('click', '.js-delete-confirm', function () {
        var formId = $(this).data('delete-form-id');
        var route = $(this).data('delete-route');
        $('#' + formId).attr('action', route);
    });

    /**
     * 削除実行
     */
    $(document).on('click', '#js-remove-contents-block', function () {
        var btn = $(this);
        var formId = btn.data('form-id');
        if (formId) {
            $("#" + formId).submit();
        } else {
            $("form").submit();
        }
        btn.prop("disabled", true);
        setTimeout(function () {
            btn.prop("disabled", false);
        }, 2000);
    });
});