$(function () {

    /**
     * 業種ボタンからの検索
     */
    $(document).on("click", ".js_business_type_button", function (e) {
        // クリックされた業種
        var selectedJobType = $(this).data("job-type-id");

        // 他の検索項目をリセット
        $('[name=companyNameCondition]').val('');
        $('[name=industryCondition]').val(selectedJobType);
        $('[name=jobTypeCondition]').val('');
        $('[name=areaCondition]').val('');

        // 検索実行
        $('form').submit();
    });


    //video要素の取得
    var video = document.getElementById('video');
    //videoボタンの取得
    var video_btn = document.getElementById('video-btn');

    //画面クリックで再生・ポーズ
    video_btn.addEventListener('click', function () {
        if(video.paused) {
            video.play();
        }else {
            video.pause();
        }
    });

});
