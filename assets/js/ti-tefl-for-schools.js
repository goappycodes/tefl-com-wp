jQuery('document').ready(function ($) {

    if (matchMedia('(min-width: 768px)').matches) {
      $('.equal-height').equalizeHeights();
    }

    if ($('.partner-logos-slider').length) {
      let partnerLogos = new Splide( '.partner-logos-slider',{
        type   : 'loop',
        perPage: 9,
        arrows: false,
        pagination: false,
        drag: 'free',
        snap: true,
        autoScroll: {
          speed: 0.5,
        },
        breakpoints: {
          768: {
            perPage: 3,
            arrows: false,
            pagination: false,
          }
        }
      });
      partnerLogos.mount(window.splide.Extensions);
    }

    if ($('.student-benefits-slider').length) {
        let studentBenefits = new Splide('.student-benefits-slider', {
            type: 'loop',
            perPage: 3,
            arrows: true,
            pagination: false,
            gap: '2rem',
            breakpoints: {
                768: {
                    perPage: 1,
                    arrows: true,
                    pagination: false,
                },
            },
        });
        studentBenefits.mount();
    }

    $(document).on('click', '.course-outline-accordion', function (e) {
        let isActive = $(this).hasClass('active');
        $('.course-outline-accordion').removeClass('active');
        
        if (!isActive) {
            $(this).addClass('active');
        } else if (!$('.course-outline-accordion.active').length) {
            $(this).addClass('active');
        }
    
        let activeItem = $('.course-outline-accordion.active');
    });

    if ($('.teachers-review-slider').length) {
      let totalSlides = $('.teachers-review-slider .splide__slide').length;
      let perPageSetting = window.innerWidth < 768 ? 1 : 3;
  
      let teachersReview = new Splide('.teachers-review-slider', {
          type: 'slide',
          perPage: perPageSetting,
          arrows: totalSlides > perPageSetting,
          pagination: false,
          gap: '2rem',
          breakpoints: {
              768: {
                  perPage: 1,
                  arrows: false, 
                  pagination:true
              },
          },
      });
  
      teachersReview.mount();
    }
  
});
  
  