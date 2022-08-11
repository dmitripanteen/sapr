//=require ../../node_modules/jquery/dist/jquery.min.js

jQuery(document).ready(function ($) {

    adjustContactMap();
    adjustRightImage();
    $('.footer-menu a.popup-opener, a.popup-opener').click(function (e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $(target).show();
    });
    $(document).click(function (e) {
        var target = $(e.target);
        if (
            !target.hasClass('popup-opener')
            && !target.parent().hasClass('popup-opener')
            && !target.closest('.footer-menu').length
            && !target.closest('.popup-module').length
            && $('.popup-module').is(":visible")
        ) {
            $('.popup-module').hide();
        }
    });
    $('.popup-module .close-btn').click(function () {
        $('.popup-module').hide();
    });
    window.onscroll = function () {
        stickyHeader();
    };

    $(window).resize(function () {
        adjustContactMap();
        adjustRightImage();
        menuProgressBar();
        stickyHeader();
    });
    if ($(window).width() <= 767.9) {

        menuProgressBar();
        $('.btn-prev').click(function () {
            menuNavClick('prev');
        });
        $('.btn-next').click(function () {
            menuNavClick('next');
        });
    }

    function menuProgressBar(position = 0) {
        if ($(window).width() <= 767.9) {
            var menuItems = $('.main-body.sapr .left-menu .left-menu-item').size();
            var menuItemWidth = $('.main-body.sapr .left-menu .left-menu-item.active').width();
            var barWidth = 1 / menuItems * menuItemWidth;
            var barPosition = 15 + 27 + 30 + barWidth * position;
            $('.main-body.sapr .left-menu .progress-bar').css({
                'width': barWidth + 'px',
                'left': barPosition + 'px'
            });
        }
    }

    function menuNavClick(direction) {
        if (direction === 'next' && !$('.btn-next').hasClass('inactive')) {
            $('.btn-prev').removeClass('inactive');
            var activeMenu = $('.main-body.sapr .left-menu .left-menu-item.active');
            activeMenu.removeClass('active');
            var nextMenu = activeMenu.next();
            nextMenu.addClass('active');
            var prevItems = nextMenu.prevAll('.left-menu-item').size();
            menuProgressBar(prevItems);
            if (!nextMenu.next().is('.left-menu-item')) {
                $('.btn-next').addClass('inactive');
            }
            var link = $(nextMenu).attr('data-target');
            $('.feature-item-content').removeClass('active');
            $(link).addClass('active');
        }
        if (direction === 'prev' && !$('.btn-prev').hasClass('inactive')) {
            $('.btn-next').removeClass('inactive');
            var activeMenu = $('.main-body.sapr .left-menu .left-menu-item.active');
            activeMenu.removeClass('active');
            var prevMenu = activeMenu.prev();
            prevMenu.addClass('active');
            var prevItems = prevMenu.prevAll('.left-menu-item').size();
            menuProgressBar(prevItems);
            if (!prevMenu.prev().is('.left-menu-item')) {
                $('.btn-prev').addClass('inactive');
            }
            var link = $(prevMenu).attr('data-target');
            $('.feature-item-content').removeClass('active');
            $(link).addClass('active');
        }
    }

    function stickyHeader() {
        var header = document.getElementById("header");
        var sticky = header.offsetTop;
        if ($(window).width() <= 767.9) {
            if (window.scrollY > sticky) {
                header.classList.add("sticky");
                $('.main-body').addClass('sticky');
            } else {
                header.classList.remove("sticky");
                $('.main-body').removeClass('sticky');
            }
        }
    }


    function adjustContactMap() {
        var diff = 0;
        if ($(window).width() >= 1349) {
            diff = $(window).width() - 1349;
            $('.contacts .map').css('right', diff / -2 + 'px');
        } else if ($(window).width() >= 1007) {
            diff = $(window).width() - 1007;
        }
        if (diff > 0) {
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
        var diff = 0;
        if ($(window).width() >= 1349) {
            diff = $(window).width() - 1349;
            $('.content-row.active .col-right').css('right', diff / -2 + 'px');
        } else if ($(window).width() >= 1007) {
            diff = $(window).width() - 1007;
        }
        if (diff > 0) {
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

    $('.left-menu .menu-items a').click(function (e) {
        e.preventDefault();
        var link = $(this).attr('href');
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

    $('.gallery-images .image').click(function () {
        initModalImage($(this).find('.scheme'))
    });

    function initModalImage(el) {
        var modal = $('#modal');
        var modalImg = $('#modal-image');
        $(modal).show();
        $(modalImg).attr('src', $(el).attr('src'));
        var closeBtn = $('#modal .close');
        var zoomInBtn = $('#modal .zoom-in');
        var zoomOutBtn = $('#modal .zoom-out');
        $(zoomOutBtn).attr('data-zoom', '1').removeClass('inactive');
        $(zoomInBtn).attr('data-zoom', '1').removeClass('inactive');
        $(modalImg).css('width', '100%');
        $(modal).click(function (e) {
            if (
                e.target.id != 'modal-image'
                && e.target.id != 'controls'
                && !e.target.classList.contains('zoom-in')
                && !e.target.classList.contains('zoom-out')
                && !e.target.classList.contains('close')
            ) {
                $(modal).hide();
            }
        });
        $(closeBtn).click(function () {
            $(modal).hide();
        });
        $(zoomInBtn).unbind('click').bind('click', function () {
            if (!$(this).hasClass('inactive')) {
                $(zoomOutBtn).removeClass('inactive');
                var scale = $(this).attr('data-zoom');
                switch (scale) {
                    case '0.5':
                        $(modalImg).animate({width: '100%'}, 300);
                        $(zoomOutBtn).attr('data-zoom', '1');
                        $(zoomInBtn).attr('data-zoom', '1');
                        break;
                    case '2':
                        break;
                    case '1':
                    default:
                        $(modalImg).animate({width: '200%'}, 300);
                        $(this).addClass('inactive');
                        $(zoomOutBtn).attr('data-zoom', '2');
                        $(zoomInBtn).attr('data-zoom', '2');
                        break;
                }
            }
        });
        $(zoomOutBtn).unbind('click').bind('click', function () {
            if (!$(this).hasClass('inactive')) {
                $(zoomInBtn).removeClass('inactive');
                var scale = $(this).attr('data-zoom');
                switch (scale) {
                    case '2':
                        $(modalImg).animate({width: '100%'}, 300);
                        $(zoomOutBtn).attr('data-zoom', '1');
                        $(zoomInBtn).attr('data-zoom', '1');
                        break;
                    case '0.5':
                        break;
                    case '1':
                    default:
                        $(modalImg).animate({width: '50%'}, 300);
                        $(this).addClass('inactive');
                        $(zoomOutBtn).attr('data-zoom', '0.5');
                        $(zoomInBtn).attr('data-zoom', '0.5');
                        break;
                }
            }
        });
    }
});

//=require ./forms.js
//=require ./jquery.mask.min.js
//=require ./jquery.mask.custom.js