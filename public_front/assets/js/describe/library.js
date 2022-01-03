$(document).on("click", ".video-btn", function(){
    var video = $(this).prev(".video").get(0);

    if(video.paused) {
        video.play();
    } else {
        video.pause();
    }

});



$(function(){
    $(document).on('click', '.lity-close, .lity-wrap', function() {
        var video = $('#video').get(0);
        video.pause();
        video.currentTime = 0;
    });
});
