jQuery(document).ready(function ($) {

    adjustContactMap();
    adjustRightImage();
    $(window).resize(function () {
        adjustContactMap();
        adjustRightImage();
    });

    function adjustContactMap() {
        if ($(window).width() >= 1366) {
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

    function adjustRightImage() {
        if ($(window).width() >= 1366) {
            var diff = $(window).width() - 1366;
            $('.content-row.active .col-right').css('right', diff / -2 + 'px');
            $('.content-row.active .col-right').css('width', 'calc(37% + ' + diff / 2 + 'px)');
            $('.content-row.active .col-right .triangle').css(
                'border-right-width',
                $('.content-row.active .col-right').width() * 0.3 + 'px'
            );
            $('.content-row.active .col-right .triangle').css(
                'border-top-width',
                $('.content-row.active .col-right').height() + 'px'
            );
        }
    }

    $('.left-menu .menu-items a').click(function (e){
        e.preventDefault();
        var link=$(this).attr('href');
        $('.left-menu .menu-items .left-menu-item').removeClass('active');
        $('.left-menu .menu-items .left-menu-item[data-target="'
            + link + '"]').addClass('active');
        $('.feature-item-content').removeClass('active');
        $(link).addClass('active');
        adjustRightImage();
    });

    $('.gallery-menu .gallery-menu-item').click(function () {
        var group = $(this).data('group');
        $('.gallery-menu .gallery-menu-item').removeClass('active');
        $('.gallery-images .gallery-images-items').removeClass('active');
        $(this).addClass('active');
        $('.gallery-images .gallery-images-items[data-group="' + group + '"]').addClass('active');
    });

    $('.gallery-images .image').click(function (){
        initModalImage($(this).find('.scheme'))
    });

    function initModalImage(el){
        var modal = $('#modal');
        var modalImg = $('#modal-image');
        $(modal).show();
        $(modalImg).attr('src', $(el).attr('src'));
        var span = $('#modal .close');
        // $(span).click(function (){
        //     $(modal).hide();
        // });
        $(modal).click(function(e) {
            if( e.target.id != 'modal-image') {
                $(modal).hide();
            }
        });
    }
});

//=require ./forms.js