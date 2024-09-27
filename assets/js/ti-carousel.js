jQuery(document).ready(function($){

  var myCarousel = document.querySelector('#carouselExampleCaptions')
  var carousel = new bootstrap.Carousel(myCarousel, {
    interval: 5000,
    // wrap: false
  })
  
  //$('.homepage-hero-section .carousel-item:nth-child(2)').addClass('active');
  
    // var home_carousel = document.getElementById('carouselExampleCaptions')
    // home_carousel.addEventListener('slide.bs.carousel', function () {
    //   // do something...
    //   from: 1
    // })

    // $('#carousel').carousel({
    //     interval: 10000
    // })
      
    // $('.carousel .item').each(function(){
    //     var next = $(this).next();
    //     if (!next.length) {
    //       next = $(this).siblings(':first');
    //     }
    //     next.children(':first-child').clone().appendTo($(this));
        
    //     if (next.next().length>0) {
    //       next.next().children(':first-child').clone().appendTo($(this));
    //     }
    //     else {
    //         $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
    //     }
    // });
  
});