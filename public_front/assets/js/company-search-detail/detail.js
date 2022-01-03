$(function () {

    var showingVideoId = null;
    var shortLengthVideosArea = $('.js_short_length_videos');
    var Video5sThumbnail = $('.thumb__5sec');
    var Video10sThumbnail = $('.thumb__10sec');
    var Video15sThumbnail = $('.thumb__15sec');

    // スライドショー処理
    $(document).ready(function () {
        var dot_status = true;
        if($('.js_company_images img').length < 2){
            dot_status = false;
        }
        $('.js_company_images').slick({
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: false,
            dots: dot_status,
        });
    });

    $(document).on('click', '.js_thumbnail_img', function () {
        var imgKey = $(this).attr('id').replace('js_video_', '');
        var js_video_auto = document.getElementById("js_video_auto");
        if(js_video_auto !== null){
            js_video_auto.pause();
        }
        $('#js_video_auto').hide();
        $('.js_company_images').remove();
        if (showingVideoId !== null) {
            $(showingVideoId)[0].pause();
            shortLengthVideosArea.find(showingVideoId).hide();
        }
        shortLengthVideosArea.find('#js_video_' + imgKey).show();
        showingVideoId = '#js_video_' + imgKey;
        if (imgKey === "five") {
            var videoTimeFive = document.getElementById("js_video_five");
            playVideo(videoTimeFive);
            reloadVideo(videoTimeFive, 5);
            Video5sThumbnail.addClass("is-active");
            Video10sThumbnail.removeClass("is-active");
            Video15sThumbnail.removeClass("is-active");
        } else if (imgKey === "ten") {
            var videoTimeTen = document.getElementById("js_video_ten");
            playVideo(videoTimeTen);
            reloadVideo(videoTimeTen, 10);
            Video10sThumbnail.addClass("is-active");
            Video5sThumbnail.removeClass("is-active");
            Video15sThumbnail.removeClass("is-active");
        } else if (imgKey === "fifteen") {
            var videoTimeFifteen = document.getElementById("js_video_fifteen");
            playVideo(videoTimeFifteen);
            reloadVideo(videoTimeFifteen, 15);
            Video15sThumbnail.addClass("is-active");
            Video5sThumbnail.removeClass("is-active");
            Video10sThumbnail.removeClass("is-active");
        }
    });

    $(function () {
        $('shortLengthVideos').hide();
    });

   function playVideo(video) {
        video.play();
    }

    function reloadVideo(video, time) {
        video.addEventListener("timeupdate", function(){
            if (video.currentTime >= time) {
                video.load();
            }
        }, false);
    }

    $(document).on('click', '.js-key-save', function () {
        sessionStorage.setItem('key_front', 1);
    });
});
