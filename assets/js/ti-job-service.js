jQuery(document).ready(function($){

    /*display hunter guide brochure*/
    $('.hunter-button, .hunter-guide-image').click(function() {
        $(".hunter_brochure").css("display", "flex");
        var guidename = $('.hunter-button').attr('data-guide');
        console.log(guidename);
        $('input[name="selected-guide"]').val(guidename);
    });

    $(".hunter_brochure").on('click', '.cross', function() {

        $(".hunter_brochure").animate({ 'opacity': '0.2' }, 500, function() {
            $(".hunter_brochure").css("display", "none");
            $(".hunter_brochure").css('opacity', '1');
        });

    });

    
})
