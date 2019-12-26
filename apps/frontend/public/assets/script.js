$(document).ready(function () {

    var $statusSuccessBlock = $('.status-block');
    var $statusBlockErrorText = $('.status-block-error .status-block-text');
    var $statusSuccessBlockUrl = $('.status-block .status-block-url');
    var $inputUrl = $('input.url');

    $('.shortener-form').submit(function (event) {

        $statusBlockErrorText.text('');

        isShowStatusBlock(false);

        event.preventDefault();

        $.post('/index/getShortUrl', {url: $inputUrl.val()}, 'json')
            .done(function (data) {
                $statusSuccessBlockUrl.text(data.response);
                isShowStatusBlock(true);
            })
            .fail(function (data) {
                console.log(data);
                if (data.responseJSON.error.code === 2) {
                    $statusBlockErrorText.text('Неверный URL!');
                } else {
                    $statusBlockErrorText.text('Что-то пошло не так!');
                }
            });
    });

    function isShowStatusBlock(is) {
        $statusSuccessBlock.animate({opacity: is ? 1 : 0}, 150);
    }
});