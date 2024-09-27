$(document).ready(function () {
  $(document).on('click', '.course-tab-menu-item', function () {
    $('.course-tab-menu-item').removeClass('active');
    $(this).addClass('active');

    let target = $($(this).attr('href'));
    console.log(target);
    $('html, body').animate({
      scrollTop: target.offset().top
    }, 800);

    return false;
  });

  function equalizeHeightsForDesktop() {
    if (window.matchMedia("(min-width: 769px)").matches) {
      $('.cta-card .cta-card__title').equalizeHeights();
      $('.cta-card .cta-card__summary').equalizeHeights();
      // $('.level_5_diploma_courses-section__body .course-card__bottom-content,.hybrid-diploma-courses-section__body .course-card__bottom-content').equalizeHeights();
      $('#Accredited_TEFL_Courses .course-card__bottom-content').equalizeHeights();
      $('#Government_Regulated .course-card__bottom-content').equalizeHeights();
      $('#Hybrid_TEFL_Courses .course-card__bottom-content').equalizeHeights();
      $('.hybrid-diploma-courses-section .course-card .deposit-info').equalizeHeights();
    }
  }


  equalizeHeightsForDesktop();

  window.addEventListener('resize', equalizeHeightsForDesktop);

  // FAQs Script

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


})