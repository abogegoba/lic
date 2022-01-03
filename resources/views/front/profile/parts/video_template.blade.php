<div class="video pr-video">
    <video controlsList="nodownload" controls="controls" muted="muted" poster="" class="js-video" style="display: none;">
        <source class="js-video-pre">
        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
    </video>
    <button type="button" class="button remove js-btn-delete-video" style="display: none;">削除する</button>
    <div class="width100">
        <input type="file" id='video' class="js-video-file">
        <label for='video' class="js-btn-choice float-left">ファイルを選択する</label>
    </div>
    <div class="width100">
        <div class="invalid-message js-video-error" style="display: none;">
            <p class="invalid-message js-video-error-message">
            </p>
        </div>
    </div>
    <div class="width100">
        <input type="text" id='video-title' class="js-video-title width100" placeholder="タイトル" maxlength=24>
        <div class="invalid-message js-video-title-error" style="display: none;">
            <p class="invalid-message js-video-title-error-message">
            </p>
        </div>
    </div>
    <div class="width100">
        <textarea id='video-description' class="js-video-description width100" placeholder="説明文" rows="10" maxlength=400></textarea>
        <div class="invalid-message js-video-description-error" style="display: none;">
            <p class="invalid-message js-video-description-error-message">
            </p>
        </div>
    </div>
</div>
