$(document).ready(function () {
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

    // $('.post-wrapper .equal-height').equalizePairHeights();
    // $('.post-wrapper-2 .equal-height').equalizeHeights();
    // $('.post-wrapper-3 .equal-height').equalizeHeights();
})

