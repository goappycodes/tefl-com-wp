

jQuery(document).ready(function ($) {
    function addEvent(obj, evt, fn) {
        if (obj.addEventListener) {
            obj.addEventListener(evt, fn, false);
        } else if (obj.attachEvent) {
            obj.attachEvent("on" + evt, fn);
        }
    }

    if (!CookieService.getCookie('exitIntentShown')) {
        addEvent(document, 'mouseout', function (evt) {
            if (evt.toElement == null && evt.relatedTarget == null) {
                $('.exit-intent-popup').slideDown();
            };
        });
    }

    $('.popup-content .close').click(function () {
        $('.exit-intent-popup').slideUp();
        CookieService.setCookie('exitIntentShown', true, 30);
        location.reload();
    });

    $(document).on('click', '.view-form', function (e) {
        $('#brochure_form_div').attr('style', 'display:block;');
        $('.popup-content-inner').attr('style', 'display:none;');
    });

    $(document).on('click', '.guide-popup', function (e) {
        e.preventDefault();
        $('.exit-intent-popup').slideDown();
    })
})


