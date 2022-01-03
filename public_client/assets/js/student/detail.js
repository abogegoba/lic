$(function () {
    $(document).on('click', '.js-key-save', function () {
        sessionStorage.setItem('key_client', 1);
    });
});