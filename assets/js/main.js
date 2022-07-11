jQuery(document).ready(function ($) {

    adjustContactMap();
    $(window).resize(function () {
        adjustContactMap();
    });

    function adjustContactMap() {
        if ($(window).width() > 1366) {
            var diff = $(window).width() - 1366;
            $('.contacts .map').css('right', diff / -2 + 'px');
            $('.contacts .map').css('width', 'calc(50% + ' + diff / 2 + 'px)');
            $('.contacts .map .triangle').css(
                'border-right-width',
                $('.contacts .map').width() * 0.3 + 'px'
            );
            $('.contacts .map .triangle').css(
                'border-top-width',
                $('.contacts .map').height() + 'px'
            );
        }
    }
});