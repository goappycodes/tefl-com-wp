jQuery(document).ready(function($){

    var stored_id;
    
    $('form.variations_form').on('show_variation', function(event, data) {
        var variation_id = data.variation_id;
        var deposit_val = $('input[name="wc_deposit_option"]:checked').val();
        var href_val = $('.variable-book-now-btn').attr('href');
        href_val = href_val + '&variation_id=' + variation_id;
        if (deposit_val == 'yes') {
            href_val = href_val + '&deposit';
        }
        $('.variable-book-now-btn').attr('href', href_val);
        $('.variable-book-now-btn').removeClass('atc-disabled');
    });
    
    $(document).on('click', '.reset_variations', function(event){
        $('.variable-book-now-btn').addClass('atc-disabled');
    })
    $(document).on('change','#dates',function(){
        if($(this).val() === ''){
            $('.variable-book-now-btn').addClass('atc-disabled');
        }
    })

    $(document).on('click', 'input[name="wc_deposit_option"]', function(event) {
       
        var input_id = $(this).attr('id');
        stored_id = input_id;
        var href_val = $('.variable-book-now-btn').attr('href');
        if(input_id == 'wc-option-pay-full') {
            if (href_val.indexOf('&deposit') != -1) {
                href_val = href_val.replace(/&deposit/g, '');
            }

        } else if (input_id == 'wc-option-pay-deposit') {
            if (input_id == stored_id) {
                event.stopPropagation();
            }else{
                href_val = href_val + '&deposit';
            } 
        }
        
        $('.variable-book-now-btn').attr('href', href_val);
    });

    $('#internship_tabs li:first-child, #essential_info_tabs li:first-child').addClass('active');
    $('#internship_tabs li:first-child a, #essential_info_tabs li:first-child a').addClass('active show');
    $('#internship_tabs_content .tab-pane:first-child, #essential_info_tabs_content .tab-pane:first-child').addClass('active');

    $(document).on('click', 'ul#internship_tabs li', function(e){
        $('ul#internship_tabs li').removeClass('active');
        $(this).addClass('active');
        $('ul#internship_tabs li a').removeClass('active show');
        $(this).find('a').addClass('active show');
        $('#internship_tabs_content .tab-pane').removeClass('active');
        var href = $(this).find('a').attr('aria-controls');
        $('#internship_tabs_content #'+ href).addClass('active');
    })


    $(document).on('click', 'ul#essential_info_tabs li', function(e){
        $('ul#essential_info_tabs li').removeClass('active');
        $(this).addClass('active');
        $('ul#essential_info_tabs li a').removeClass('active show');
        $(this).find('a').addClass('active show');
        $('#essential_info_tabs_content .tab-pane').removeClass('active');
        var href = $(this).find('a').attr('aria-controls');
        $('#essential_info_tabs_content #'+ href).addClass('active');
    })


    $('.itinerary-section .panel:first-child .panel-title').attr('aria-expanded', true);
    $('.itinerary-section .panel:first-child .panel-collapse').addClass('show');

    $(document).on('click', 'div#itinerary .panel-heading', function(e){
        $('div#itinerary .panel-heading h4').attr('aria-expanded', false);
        $(this).find('h4').attr('aria-expanded', true);
        $('.itinerary-section .panel .panel-collapse').removeClass('show');
        $(this).next('.panel-collapse').addClass('show');
    })

    $('.previous-interns-row').slick({
        infinite: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
              breakpoint: 767,
              settings: "unslick", // destroys slick
            //   settings: {
            //     infinite: false,
            //     slidesToShow: 1,
            //   }
            },
        ]
    });


    // $(document).on('mouseleave', leaveFromTop);

    // function leaveFromTop(e){
    //     if( e.clientY < 0 ) // less than 60px is close enough to the top
    //     console.log('y u leave from the top?');
    // }

    if ($('#guide[data-guide-popup="yes"]').length && !CookieService.getCookie('guidePopupShown')) {
        setTimeout(function() {
          Boxzilla.show(75296);
          CookieService.setCookie('guidePopupShown', true, 2); 
        }, 5000);
    }
      

})