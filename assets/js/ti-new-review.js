jQuery(document).ready(function($){
    
    var review_widget_elementOffset = $('.review-widget-views,.reviews-summary,.verified-student-reviews-section__header').offset().top;
    $(window).scroll(function(){
        if(($(window).scrollTop() + $(window).height()) >= review_widget_elementOffset){
            $('.progress-bar').each(function(){
                var $this = $(this);
                var percent = $this.attr('percent');
                $this.css("width",percent+'%');
                $({animatedValue: 0}).animate({animatedValue: percent},{
                    duration: 3000,
                    step: function(){
                        $this.attr('percent', Math.floor(this.animatedValue) + '%');
                    },
                    complete: function(){
                        $this.attr('percent', Math.floor(this.animatedValue) + '%');
                    }
                });
            });
        }
    })

    
})
        