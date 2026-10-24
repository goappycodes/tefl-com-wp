jQuery(document).ready(function($) {

    // Main content: full body shown by default — "Read more" cut-off removed per client request (2026-10-02).
    // Previous behaviour clamped .read-more-section to 550px:
    // if($('.read-more-section').outerHeight() > 550){
    //     $('.read-more-section').attr('style', 'max-height: 550px; overflow: hidden;');
    //     $('.read-more-section .read-more-btn').show();
    // }

    if($('.key-facts-section').outerHeight() > 450){
        $('.key-facts-section').attr('style', 'max-height: 450px; overflow: hidden;');
        $('.key-facts-section .read-more-btn').show();
    }

    $('body').on('click', '.read-more-btn', function() {
        const parent = $(this).closest('.read-more-section, .key-facts-section');

        parent.attr('style', 'max-height:100%;');
        $(this).attr('style', 'display:none;');

        $(this).parent().find('.read-less-btn').attr('style', 'display:block;');

    });

    $('body').on('click', '.read-less-btn', function() {
        const parent = $(this).closest('.read-more-section, .key-facts-section');

        parent.attr('style', 'max-height:550px; overflow:hidden;');

        $('html, body').animate({
            scrollTop: parent.offset().top - 50
        }, 50);
        parent.find('.read-more-btn').attr('style', 'display:block;');
        $(this).attr('style', 'display:none;');
    });

    $('body').on('click', '.faqs-section .panel-heading-wrapper', function(e) {
        $('.faqs-section .panel-heading-wrapper').attr('aria-expanded', false);
        $(this).attr('aria-expanded', true);
        $('.faqs-section .panel .panel-collapse').removeClass('show');
        $(this).next('.panel-collapse').addClass('show');
    });
})
