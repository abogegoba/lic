$(function () {

    $(document).on("click","#js_model_sentence_button",function (e) {
        // 選択した例文名に紐づく例文本文をテキストエリアに表示する。
        var modelSentenceName = document.getElementById("modelSentenceName").value;
        var modelSentenceContent = document.getElementById("modelSentenceContent_"+modelSentenceName).value;
        document.getElementById("messageToSend").value = modelSentenceContent;
    });
});