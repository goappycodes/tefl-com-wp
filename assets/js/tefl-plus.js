jQuery('document').ready(function ($) {

    setInterval(function() {
      $('.logo-container .logo-group:first').fadeOut(1000, function() {
        $(this).next('.logo-group').css('display', 'flex').fadeIn(1000).end().appendTo('.logo-container');
      });
    }, 5000);
    if ($('.photo-gallery').length) {
      let photoGallery = new Splide( '.photo-gallery',{
        type   : 'loop',
        perPage: 6,
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
  
})