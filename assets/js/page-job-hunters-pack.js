
$(document).ready(function () {
  
    let jobSlider = $('.jobs-slider');
        jobSlider.lightSlider({
        item: 3, 
        loop: true, 
        slideMargin: 40,
        easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
        auto: true,
        pause: 10000, 
        pager: false,
        mode:'slide',
        adaptiveHeight:true,
        keyPress:true,
        prevHtml:'<i class="fa fa-chevron-left"></i>',
        nextHtml:'<i class="fa fa-chevron-right"></i>',
        onSliderLoad:()=>{
            jobSlider.css('opacity','1');
        },
        responsive : [
            {
                breakpoint:768,
                settings: {
                    item:1
                    }
            }
        ]
    });
    
    $('.show-more-faqs').on('click', function () {
        let expandable = $(this).prev();
        expandable.toggleClass('expanded');
        isExpanded = expandable.hasClass('expanded');
        $(this).find('span').text(isExpanded ? 'Show Less Faqs' : 'Show More Faqs');
    });

    let isFirstClick = true;
        $('.faqs-accordion__item input').change(function () {
        if ($(this).prop('checked')) {
            $('.faqs-accordion__item').removeClass('active');
            $('.faqs-accordion__content').removeClass('active');

            $(this).parent('.faqs-accordion__item').addClass('active');
            $(this).parent('.faqs-accordion__item').find('.faqs-accordion__content').addClass('active');
            if (isFirstClick || $('.show-more-faqs').find('span').text() === 'Show More Faqs') {
            $('.show-more-faqs').trigger('click');
            isFirstClick = false;
            }
        } else {
            $(this).parent('.faqs-accordion__item').removeClass('active');
            $(this).parent('.faqs-accordion__item').find('.faqs-accordion__content').removeClass('active');
        }
    });

    setInterval(function () {
        $('.logo-container .logo-group:first').fadeOut(1000, function () {
            $(this).next('.logo-group').css('display', 'flex').fadeIn(1000).end().appendTo('.logo-container');
        });
    }, 5000);

});