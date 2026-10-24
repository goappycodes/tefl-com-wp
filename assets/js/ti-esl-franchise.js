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
});
  
  