jQuery(document).ready(function ($) {

    window.onload = function () {
        // if (window.matchMedia("(min-width: 769px)").matches) {
        //     $('.course-card__bottom-content.features').equalizeHeights();
        // }
        $(".verified-student-reviews-section__slider .rplg-grid").appendTo(".verified-student-reviews-section__row .rplg-insert");
    };

    $(document).on('click', '.ques-ans-accordion', function (e) {
        let isActive = $(this).hasClass('active');
        $('.ques-ans-accordion').removeClass('active');
        if (!isActive) {
            $(this).addClass('active');
        }
        let activeItem = $('.ques-ans-accordion.active');
        if (activeItem.length) {
            $('html, body').animate({
                scrollTop: activeItem.offset().top - 100
            }, 500);
        }
    });

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
    // ------------------------

    // Gifts Section


    var giftSectionWrapper = $('.gifts-info-container');

    var observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                console.log('Course gifts section is in the viewport!');

                $('.course-badge-body > div', entry.target).each(function (index) {
                    var currentElement = $(this);
                    var delay = index * 200;
                    currentElement.find('img').delay(delay).animate({ opacity: 1 }, 800);
                    currentElement.find('p').delay(delay + 200).animate({ opacity: 1 }, 800);

                    setTimeout(function () {
                        currentElement.find('img, p').css({
                            transform: 'translateY(0)',
                        });
                    }, delay);
                });

                observer.unobserve(entry.target);
            } else {
                console.log('Course gifts section is NOT in the viewport.');
            }
        });
    }, { threshold: 0.5 });

    if (giftSectionWrapper.length) {
        observer.observe(giftSectionWrapper[0]);
    }
});