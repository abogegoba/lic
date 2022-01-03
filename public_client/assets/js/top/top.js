$(function () {

    //video要素の取得
    var video = document.getElementById('video');
    //videoボタンの取得
    var video_btn = document.getElementById('video-btn');

    $(document).ready(function () {
        if(navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)){
            $("#video-btn").addClass("video-btn");
            $("#video-wrap").addClass("video-wrap");
        }
    });

    //画面クリックで再生・ポーズ
    video_btn.addEventListener('click', function () {
        if(video.paused) {
            video.play();
            if(navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)){
                video.requestFullscreen = this.requestFullscreen || this.mozRequestFullScreen || this.webkitRequestFullscreen || this.msRequestFullscreen;
                video.requestFullscreen();
            }
        }else {
            video.pause();
        }
    });
});
