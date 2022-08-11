jQuery(document).ready(function ($) {
    filterInputs();

    (function () {
        $('#trial-version-form button[type="submit"]').bind('click', function (e) {
            e.preventDefault();
            if ($(window).width() <= 768 && !($('.info-message').isInViewport())) {
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

    const fileUploaders = [
        {
            "actualBtn": document.getElementById('file1'),
            "fileChosen": document.getElementById('file-chosen1')
        },
        {
            "actualBtn": document.getElementById('file2'),
            "fileChosen": document.getElementById('file-chosen2')
        },
        {
            "actualBtn": document.getElementById('file3'),
            "fileChosen": document.getElementById('file-chosen3')
        },
        {
            "actualBtn": document.getElementById('file4'),
            "fileChosen": document.getElementById('file-chosen4')
        }

    ];
    fileUploaders.forEach(showFileName);

    function showFileName(file) {
        file.actualBtn.addEventListener('change', function () {
            file.fileChosen.textContent = this.files[0].name;
            document.getElementById(file.actualBtn.id + '-label').style.display = "none";
            file.fileChosen.classList.add("active");
            file.fileChosen.style.display = "block";
        })
    }

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
        $('#popup-support-form #contact_person').mask('&');
        $('#popup-support-form #phone').mask('P');
        $('#popup-support-form #email').mask('E', {reverse: true});
    }

    $.fn.isInViewport = function () {
        var elementTop = $(this).offset().top;
        var viewportTop = $(window).scrollTop() + 54;
        var viewportBottom = viewportTop + $(window).height();
        return elementTop > viewportTop && elementTop < viewportBottom;
    };

    $.fn.serializeObject = function () {
        var data = {};
        $.each(this.serializeArray(), function (key, obj) {
            var a = obj.name.match(/(.*?)\[(.*?)\]/);
            if (a !== null) {
                var subName = new String(a[1]);
                var subKey = new String(a[2]);
                if (!data[subName]) {
                    data[subName] = {};
                    data[subName].length = 0;
                }
                ;
                if (!subKey.length) {
                    subKey = data[subName].length;
                }
                if (data[subName][subKey]) {
                    if ($.isArray(data[subName][subKey])) {
                        data[subName][subKey].push(obj.value);
                    } else {
                        data[subName][subKey] = {};
                        data[subName][subKey].push(obj.value);
                    }
                    ;
                } else {
                    data[subName][subKey] = obj.value;
                }
                ;
                data[subName].length++;
            } else {
                var keyName = new String(obj.name);
                if (data[keyName]) {
                    if ($.isArray(data[keyName])) {
                        data[keyName].push(obj.value);
                    } else {
                        data[keyName] = {};
                        data[keyName].push(obj.value);
                    }
                    ;
                } else {
                    data[keyName] = obj.value;
                }
                ;
            }
            ;
        });
        return data;
    };

    $("#user-support-form").on("submit", function (e) {
        e.preventDefault();
        var formData = $(this).serializeObject();
        var files = {};
        files.file1 = $('#user-support-form #file1').prop('files')[0];
        files.file2 = $('#user-support-form #file2').prop('files')[0];
        files.file3 = $('#user-support-form #file3').prop('files')[0];
        files.file4 = $('#user-support-form #file4').prop('files')[0];
        var inputData = {...formData, ...files}
        var f = new FormData($('#user-support-form')[0]);
        console.log(f);
        $.ajax({
            type: 'POST',
            url: 'index.php?option=' + formData.option + '&task=' + formData.task,
            data: f,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success === true) {
                    $("#user-support-form").hide();
                    $("#popup-support-form").addClass('success-send');
                    $("#popup-support-form .success-msg").show();
                } else {
                    $("#user-support-form .error-msg").html(response.error);
                    $("#user-support-form .error-msg").css('display', 'flex');
                }
                return false;
            }
        });
        return false;
    });

});