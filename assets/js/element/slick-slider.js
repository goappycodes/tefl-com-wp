jQuery(document).ready(function($) {

  const windowWidth = $(window).width();

  if(windowWidth < 768) {
    $('.element-scroll-mobile').slick({
      slidesToShow: 2.5,
      slidesToScroll: 1,
      dots: false,
      arrows: true,
      infinite: false,
      responsive: [
        {
          breakpoint: 544,
          settings: {
            slidesToShow: 1.2,
            slidesToScroll: 1
          }
        },
      ]
    });
  }

  $('.tefl-slider').slick({
    slidesToShow: 3,
    slidesToScroll: 2,
    infinite: false,
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,
    arrows: true,
    
    responsive: [
        {
          breakpoint: 921,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 544,
          settings: {
            slidesToShow: 1.2,
            slidesToScroll: 1
          }
        },
    ]
  });  
    
  $('.tefl-slider-review').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: false,
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,
    arrows: true,
    appendDots: $('.tefl-dots'),
    prevArrow: $('.tefl-prev-review'),
    nextArrow: $('.tefl-next-review')
  });  

  $('.gallery-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
  });

  $('.slider-nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    vertical: true,
    asNavFor: '.gallery-slider',
    dots: false,
    arrows: false,
    focusOnSelect: true,
    verticalSwiping: true,
    responsive: [
    {
      breakpoint: 851,
      settings: {
        slidesToShow: 3,
      }
    },
    {
      breakpoint: 651,
      settings: {
        slidesToShow: 2,
      }
    },
    {
      breakpoint: 545,
      settings: {
        vertical: false,
        slidesToShow: 3,
      }
    }
    ]
  });

});
