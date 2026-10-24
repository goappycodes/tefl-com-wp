jQuery('document').ready(function ($) {

    //Accordion

    $(document).on('click', '.accordion', function (e) {
        let isActive = $(this).hasClass('active');
        $('.accordion').removeClass('active');
        
        if (!isActive) {
            $(this).addClass('active');
        } else if (!$('.accordion.active').length) {
            $(this).addClass('active');
        }
    
        let activeItem = $('.accordion.active');
        if (activeItem.length) {
            $('html, body').animate({
                scrollTop: activeItem.offset().top - 150
            }, 500);
        }
    });

    // Photo Gallery
    if ($('.photo-gallery').length) {
      let photoGallery = new Splide( '.photo-gallery',{
        type   : 'loop',
        perPage: 3,
        arrows: false,
        pagination: false,
        height: 250,
        drag: 'free',
        snap: true,
        autoScroll: {
          speed: 1,
        },
        breakpoints: {
          768: {
            perPage: 2,
            arrows: false,
            pagination: false,
          }
        }
      });
      photoGallery.mount(window.splide.Extensions);
    }

    // Course Details Tab

    const tabContainer = $('#tabs-section .tab-head');
  const tabWrapper = $('.tab-wrapper');
  const tabContentContainer = $('#tabs-section .course-details-tab-content');
  const tabLink = $('.course-details-section .tab-link');
  const tabBody = $('.course-details-section .tab-body');
  let timerOpacity;
  let readMore = $('.read-more-btn-container');
  const tabInit = () => {
    if (matchMedia('(max-width: 768px)').matches) {
      readMore.slideDown();
    }
    readMore.find('span').text('read more');
    tabLink.off('click').on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      if (!$(this).hasClass('active')) {
        window.clearTimeout(timerOpacity);

        tabLink.removeClass('active');
        tabBody.removeClass('active');
        tabBody.removeClass('active-content');
        $(this).addClass('active');
        $($(this).attr('href')).addClass('active');

        timerOpacity = setTimeout(() => {
          $($(this).attr('href')).addClass('active-content');
        }, 50);
      }
    });

    readMore.off('click').on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).find('i').toggleClass('rotate180');
      if ($(this).find('span').text() === 'read more') {
        tabContentContainer.css({ height: 'auto' });
        $(this).find('span').text('show less');
      } else {
        tabContentContainer.css({ height: '400px' });
        $(this).find('span').text('read more');
      }
    });
  };

  tabInit();

  if ($('.tabs section').length) {
    $('.tabs section').each(function () {
      let childNodes = $(this).children();
      childNodes.each(function (index) {
        $(this).css({
          'transition-delay': (index * 0.1) + 's'
        });
      })

    });
  }
  if (matchMedia('(min-width: 769px)').matches) {
    tabContentContainer.css('max-height', tabContainer.height() + 'px');
  }

  // Instructors Slider

	let glideElement = $('.instructors-glide');
	if (glideElement.length) {
		let glideSlider = new Glide('.instructors-glide', {
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

		glideSlider.mount();
	}

	// Video Slider

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

})
