jQuery(document).ready(function ($) {
    filterInputs();

    (function () {
        $('#trial-version-form button[type="submit"]').bind('click', function (e) {
            e.preventDefault();
            if($(window).width()<=768 && !($('.info-message').isInViewport())){
                $('html, body').animate({
                    scrollTop: $("html").offset().top
                }, 500);
            }
            var formData = getSerializedFormData("#trial-version-form");
            var task = $('#trial-version-form input[name="task"]').val();
            request = jQuery.ajax({
                type: 'POST',
                url: '/index.php?option=com_form&task=' + task,
                data: formData,
                dataType: 'html',
                success: function (html) {
                    request = null;
                    if (html.indexOf('true') + 1) {
                        $('.info-message')
                            .removeClass('error')
                            .removeClass('success')
                            .addClass('success')
                            .html('Спасибо за Ваш запрос! С Вами свяжутся в ближайшее время.');
                        $('.form-body input').val('');
                        reloadCaptcha();
                    } else {
                        $('.info-message')
                            .removeClass('error')
                            .removeClass('success')
                            .addClass('error')
                            .html(html);
                    }
                },
                error: function () {
                    var message = "";
                    if (grecaptcha.getResponse().length == 0) {
                        message = "\nПожалуйста заполните CAPTCHA";
                    }
                    if (message) {
                        alert(message);
                    }
                    reloadCaptcha();
                    request = null;
                }
            });
        });
    }());

    function reloadCaptcha() {
        if (grecaptcha) {
            $('#trial-version-form').find('#g-recaptcha-response').remove();
            grecaptcha.reset()
        }
    }

    function getSerializedFormData(formSelector) {
        var form = jQuery(formSelector),
            disabled = form.find(':input:disabled').removeAttr('disabled'),
            data = form.serializeArray();
        disabled.attr('disabled', 'disabled');
        return data;
    }

    function filterInputs() {
        $('#trial-version-form #inn').mask('N').attr('maxlength', 10);
        $('#trial-version-form #contact_person').mask('&');
        $('#trial-version-form #phone').mask('P');
        $('#trial-version-form #email').mask('E', {reverse: true});
    }

    $.fn.isInViewport = function() {
        var elementTop = $(this).offset().top;
        var viewportTop = $(window).scrollTop()+54;
        var viewportBottom = viewportTop + $(window).height();
        console.log(elementTop);
        console.log(viewportTop);
        console.log(viewportBottom);
        return elementTop > viewportTop && elementTop < viewportBottom;
    };
});