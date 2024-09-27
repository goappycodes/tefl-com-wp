jQuery(document).ready(function ($) {
    $('.eligibility-forms-slider-wrapper').lightSlider({
        item: 1, 
        loop: true, 
        slideMargin: 20, 
        auto: true,
        pause: 6000, 
        controls: true, 
        pager: false,
        mode:'fade',
        // adaptiveHeight:true,
        keyPress:true,
        prevHtml:'<i class="fa fa-chevron-left"></i>',
        nextHtml:'<i class="fa fa-chevron-right"></i>',
        onSliderLoad:()=>{
          $('.eligibility-forms-slider-wrapper').css('opacity','1');
        }
      });

      if (matchMedia('(min-width: 768px)').matches) {
        $('.equalize-height').equalizeHeights();
        $('.blog .equal-height-header').equalizeHeights();
      }
    
});