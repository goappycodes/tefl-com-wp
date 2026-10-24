jQuery('document').ready(function ($) {

  let slideCount = $('.full-width-slider').children().length;
  $('.full-width-slider').lightSlider({
    onSliderLoad: function (el) {
      $('.full-width-slider').css('opacity', '1');
    },
    item: 1,
    loop: true,
    slideMargin: 0,
    easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
    auto: true,
    pause: 7000,
    pager: slideCount > 1,
    mode: 'fade',
    adaptiveHeight: true,
    keyPress: true,
    prevHtml: '<i class="fa fa-chevron-left"></i>',
    nextHtml: '<i class="fa fa-chevron-right"></i>',
    responsive: [
      {
        breakpoint: 768,
        settings: {
          controls: false
        }
      }
    ]
  });

  if (matchMedia('(min-width: 768px)').matches) {
    $('.course-card .course-card__summary').equalizeHeights();
    $('.course-card .course-card__features').equalizeHeights();
    $('.exp-cta-card__body-title').equalizeHeights();
    $('.webinar-cta-section .cta-equal-height').equalizeHeights();
    $('.course-card .label-equal-height').equalizeHeights();
    $('.quick-link_description').equalizeHeights();
    let faqsContainerHeight = $('.faqs-wrapper.equal-height').height();
    $('.app-download-container').height(faqsContainerHeight)
    $('.accreditations-card.course-card').height($('.course.course-card').height());
  }


  $(".verified-student-reviews-section__slider .rplg-grid").appendTo(".verified-student-reviews-section__row .rplg-insert");


  // Function to animate the progress bars

  let observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        // Only animate when the target element is in view
        animateProgressBars();
      }
    });
  });


  let targetElement = $('.verified-student-reviews-section')[0];
  observer.observe(targetElement);


  function animateProgressBars() {
    $('.progress-bar').each(function () {
      let $this = $(this);
      let percent = $this.attr('percent');
      $this.css("width", percent + '%');
      $({ animatedValue: 0 }).animate({ animatedValue: percent }, {
        duration: 3000,
        step: function () {
          $this.attr('percent', Math.floor(this.animatedValue) + '%');
        },
        complete: function () {
          $this.attr('percent', Math.floor(this.animatedValue) + '%');
        }
      });
    });
  }


  // Testimonial Slider

  if ($('.video-testimonials__slider').length) {
    let testimonialsSlider = new Splide('.video-testimonials__slider', {
      type: 'slide',
      rewind: true,
      gap: '2rem',
      perPage: 2,
      perMove: 1,
      arrows: true,
      pagination: false,
      breakpoints: {
        768: {
          perPage: 1,
          perMove: 1,
          pagination: false,
        }
      }
    });


    function applyBlur() {
      $('.splide__slide').removeClass('is-out-of-view');

      let index = testimonialsSlider.index;
      let visibleSlides = testimonialsSlider.options.perPage;

      $('.splide__slide').each(function (i) {
        if (i < index || i >= index + visibleSlides) {
          $(this).addClass('is-out-of-view');
        }
      });
    }

    testimonialsSlider.on('move', applyBlur);
    testimonialsSlider.mount();
    applyBlur();
  }

  // FAQs Section

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

