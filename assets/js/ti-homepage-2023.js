
$(document).ready(function () {
  // $(".verified-student-reviews-section__slider .rplg-grid").appendTo(".verified-student-reviews-section__row .rplg-insert");
  let productId = 1103;

  $.ajax({
      url: ti_obj.ti_ajax,
      type: 'POST',
      data: {
          action: 'get_product_price',
          product_id: productId
      },
      success: function(response) {
          if (response.success) {
              var salePrice = response.data.sale_price;
              $('.teo-logo-container').fadeIn().find('.geo-price').html(salePrice);
          } else {
              console.log('Error: ' + response.data);
          }
      },
      error: function(xhr, status, error) {
          console.log('AJAX error:', error);
      }
  });

  window.onload = function () {
    $(".verified-student-reviews-section__slider .rplg-grid").appendTo(".verified-student-reviews-section__row .rplg-insert");
  };

  let duration = 70000;
  $('.full-width-slider').lightSlider({
    item: 1,
    loop: true,
    slideMargin: 0,
    auto: true,
    pause: 8000,
    // pauseOnHover:true,
    controls: false,
    pager: true,
    mode: 'fade',
    adaptiveHeight: true,
    keyPress: true,
    onSliderLoad: () => {
      $('.full-width-slider').css('opacity', '1');
      $('.free-gifts-logo-container').css('opacity', '1');
      $('.installment-logo-container').css('opacity', '1')
    }
  });

  // New Hero Slider
  let slideCount = $('.full-width-slider-new').children().length;
  $('.full-width-slider-new').lightSlider({
    onSliderLoad: function (el) {
      $('.full-width-slider-new').css('opacity', '1');
    },
    item: 1,
    loop: true,
    slideMargin: 0,
    controls:false,
    easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
    auto: true,
    pause: 30000,
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


  function setInitialHeight(expandable, height) {
    let isExpanded = expandable.hasClass('expanded');
    let initialHeight = isExpanded ? expandable[0].scrollHeight : height;
    expandable.css('height', initialHeight + 'px');
  }

  function toggleExpandable(expandable, duration, height, expandText, collapseText) {
    let isExpanded = expandable.hasClass('expanded');

    if (isExpanded) {
      expandable.animate({
        height: height + 'px'
      }, duration, function () {
        expandable.removeClass('expanded');
        expandable.next().find('span').text(expandText);
      });
    } else {
      expandable.addClass('expanded');
      expandable.animate({
        height: expandable[0].scrollHeight + 'px'
      }, duration, function () {
        expandable.next().find('span').text(collapseText);
      });
    }
  }

  let initialCtaHeight = 100;
  let expandableCTA = $('.exp-cta-card__body-content-expandable');
  setInitialHeight(expandableCTA, initialCtaHeight);

  $('.exp-cta-card__body-expand').on('click', function () {
    let expandable = $(this).prev();
    let duration = 500;
    let expandText = 'Learn More';
    let collapseText = 'Show Less';

    toggleExpandable(expandable, duration, initialCtaHeight, expandText, collapseText);
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


  if (matchMedia('(min-width: 768px)').matches) {
    $('.course-card .course-card__title').equalizeHeights();
    $('.course-card .course-card__summary').equalizeHeights();
    $('.course-card').equalizeHeights();
    $('.exp-cta-card__body-title').equalizeHeights();
  }

  setInterval(function () {
    $('.logo-container .logo-group:first').fadeOut(1000, function () {
      $(this).next('.logo-group').css('display', 'flex').fadeIn(1000).end().appendTo('.logo-container');
    });
  }, 5000);


  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        // Only animate when the target element is in view
        animateProgressBars();
      }
    });
  });

  // Observe the target element
  var targetElement = $('.verified-student-reviews-section')[0];
  observer.observe(targetElement);

  // Function to animate the progress bars
  function animateProgressBars() {
    $('.progress-bar').each(function () {
      var $this = $(this);
      var percent = $this.attr('percent');
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

  // video glider js


  let glideElementVideo = $('.video-testimoinials__glide');
  if (glideElementVideo.length) {
    let glideSliderVideo = new Glide('.video-testimoinials__glide', {
      type: "carousel",
      startAt: 0,
      perView: 4,
      autoplay: 8000,
      gap: 24,
      animationTimingFunc: 'ease-in-out',
      animationDuration: 400,
      breakpoints: {
        768: {
          perView: 1
        }
      }
    });

    glideSliderVideo.mount();
  }

  if ($('.popup-video-review').length) {
    $('.popup-video-review').magnificPopup({
      type: 'iframe',
      iframe: {
        markup: '<div class="mfp-iframe-scaler">' +
          '<div class="mfp-close"></div>' +
          '<iframe class="mfp-iframe" frameborder="0" allowfullscreen muted></iframe>' +
          '</div>',
        patterns: {
          youtube: {
            index: 'youtube.com/',
            id: 'v=',
            src: '//www.youtube.com/embed/%id%?autoplay=1'
          },
          youtu: {
            index: 'youtu.be/',
            id: '/',
            src: '//www.youtube.com/embed/%id%?autoplay=1'
          }
        },
        srcAction: 'iframe_src'
      }
    });
  }

  // Jobs Slider

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

  //Read more section

  jQuery('.read-more-btn').on('click', function() {
      const btn = jQuery(this);
      const targetId = btn.attr('data-target');
      const desc = jQuery('#' + targetId);
      const content = desc.find('.description-content');
      const shortContent = content.find('.description-short');
      const fullContent = content.find('.description-full');
      
      if (content.hasClass('truncated')) {
          shortContent.fadeOut(300, function() {
              fullContent.fadeIn(300);
              content.removeClass('truncated');
              desc.removeClass('has-fade');
              btn.html('Read Less <span class="arrow">▲</span>');
          });
      } else {
          fullContent.fadeOut(300, function() {
              shortContent.fadeIn(300);
              content.addClass('truncated');
              desc.addClass('has-fade');
              btn.html('Read More <span class="arrow">▼</span>');
              
              jQuery('html, body').animate({
                  scrollTop: desc.offset().top - 100
              }, 400);
          });
      }
  });
    
    
  
});