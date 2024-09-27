jQuery(document).ready(function ($) {
    // Image Gallery Slider

	$('.open-gallery-btn').on('click', function(e) {
        e.preventDefault();
        $('.image-gallery_container').magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true
            },
			zoom: {
                enabled: true,
                duration: 400,
                easing: 'ease-in-out',
                opener: function(openerElement) {
                    return openerElement.find('img');
                }
            }
        }).magnificPopup('open');
    });
    // Content Navigation

    let sections = $('.internship-content-container section');
    let navLinks = $('.content-nav-menu__link');
    let stickySection = $('.content-nav-menu-section');
    let stickySectionTop = stickySection.offset().top;
    let isMenuClicked = false;
    let scrollTimeout;

    function handleScroll() {
    stickySection.toggleClass('animate', $(window).scrollTop() >= stickySectionTop);

    let currentPos = $(this).scrollTop();
    let navHeight = stickySection.outerHeight();
    
    sections.each(function() {
        let top = $(this).offset().top - navHeight - 20;
        let bottom = top + $(this).outerHeight();
        
        if (currentPos >= top && currentPos <= bottom) {
        if (!isMenuClicked) {
            navLinks.removeClass('active');
            $('.content-nav-menu__link[href="#' + $(this).attr('id') + '"]').addClass('active');
        }
        }
    });
    }

    $(window).on('scroll', function() {
    if (scrollTimeout) {
        clearTimeout(scrollTimeout);
    }
    
    scrollTimeout = setTimeout(handleScroll, 200); 
    });

    $('.content-nav-menu__link').on('click', function() {
        isMenuClicked = true;
        navLinks.removeClass('active');
        $(this).addClass('active');

        setTimeout(function() {
        isMenuClicked = false;
        }, 1000);
    });

    function toggleButton(enabled) {
        var $button = $('.variable-book-now-btn');
        
        if (enabled) {
            $button.removeClass('atc-disabled');
            $button.removeAttr('disabled');
        } else {
            $button.addClass('atc-disabled');
            $button.attr('disabled', 'disabled');
        }
    }
    $(document).on('change', '#dates', function() {
        if ($(this).val() === '') {
            toggleButton(false);
        } else {
            toggleButton(true);
        }
    });
    $('form.variations_form').on('show_variation', function(event, data) {
        var variation_id = data.variation_id;
        var deposit_val = $('input[name="wc_deposit_option"]:checked').val();
        var href_val = $('.variable-book-now-btn').attr('href');
        
        href_val = href_val + '&variation_id=' + variation_id;
        if (deposit_val === 'yes') {
            href_val = href_val + '&deposit';
        }
        
        $('.variable-book-now-btn').attr('href', href_val);
        toggleButton(true);
    });

    $(document).on('click', '.reset_variations', function(event) {
        toggleButton(false);
    });

    

    // Event handler for wc_deposit_option radio input click
    $(document).on('click', 'input[name="wc_deposit_option"]', function(event) {
        var input_id = $(this).attr('id');
        var href_val = $('.variable-book-now-btn').attr('href');
        
        if (input_id === 'wc-option-pay-full') {
            if (href_val.indexOf('&deposit') !== -1) {
                href_val = href_val.replace(/&deposit/g, '');
            }
        } else if (input_id === 'wc-option-pay-deposit') {
            href_val = href_val + '&deposit';
        }
        
        $('.variable-book-now-btn').attr('href', href_val);
    });


    // CF7 SCRIPT

    $(document).on('wpcf7invalid', function(event) {
    setTimeout(function() {
        $('html, body').stop().animate({
        scrollTop: jQuery('#' + event.detail.unitTag + ' .wpcf7-not-valid').eq(0).offset().top - 140,
        }, 500, 'swing');
        $('#' + event.detail.unitTag + ' .wpcf7-not-valid').eq(0).focus();
    }, 100);
    });  

    // Popup Script

    if ($('#guide[data-guide-popup="yes"]').length && !CookieService.getCookie('guidePopupShown')) {
        console.log('yes',$('#guide[data-guide-popup="yes"]'));
        setTimeout(function() {
          Boxzilla.show(75296);
          CookieService.setCookie('guidePopupShown', true, 2); 
        }, 5000);
    }

});