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

    $(document).on('click','#js-video-play',function () {
        var video = $('#video').get(0);
        video.play();
        if(navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)){
            video.requestFullscreen = this.requestFullscreen || this.mozRequestFullScreen || this.webkitRequestFullscreen || this.msRequestFullscreen;
            video.requestFullscreen();
        }
    });
});