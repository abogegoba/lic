$(function () {

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

    /**
     * ファイルアップロード ドラック&ドロップ
     */
    $(document).on('dragover', '.js-file-upload-area', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).addClass('dragover');
    });
    $(document).on('dragleave', '.js-file-upload-area', function (e) {
        e.preventDefault();
        $(this).removeClass('dragover');
    });
    $(document).on('drop', '.js-file-upload-area', function (e) {
        e.preventDefault();
        $(this).removeClass('dragenter');
        e.preventDefault();
        var files = e.originalEvent.dataTransfer.files;
        $(this).find('input:file').each( function () {
            $(this).prop("files",files);
        });
    });
});
