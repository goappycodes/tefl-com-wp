jQuery(document).ready(function($) {
     $('.read-more').on('click', function () {
        const $btn = $(this);
        const $summary = $btn.prev('.course-summary');

        $summary.toggleClass('expanded');

        $btn.text(
            $summary.hasClass('expanded')
                ? 'Read less'
                : 'Read more'
        );
    });


    // Internship slider

    if ($('#general-slider').length > 0) {
        console.log('Initializing internships slider...');
        
        const internshipsSlider = new Splide('#general-slider', {
            type: 'slide',
            rewind: true,
            rewindByDrag: true,
            perPage: 4,
            perMove: 1,
            gap:'30px',
            arrows: false,
            pagination: true,
            padding: { left: 0, right: '10px' },
            drag: true,
            speed: 600,
            breakpoints: {
                768: { 
                    perPage: 1.5, 
                    gap: '16px',
                    padding: { left: 0 ,right: '0px' },
                    pagination: false,
                    arrows :true,
                    focus  : 'center',
                }
            }
        });
        
        internshipsSlider.mount();
    }

    const container = $('.slider-container');
    const section = $('.custom-slider');
    const nav = $('.slider-nav');

    if (!container.length || $(window).width() > 768) return;

    const cards = container.find('.course-card');
    const numCards = cards.length;
    const prevBtn = nav.find('.slider-prev');
    const nextBtn = nav.find('.slider-next');

    nav.show();

    let currentIndex = 0;

    function updateNavButtons() {
        if (currentIndex === 0) {
            prevBtn.addClass('disabled').prop('disabled', true);
        } else {
            prevBtn.removeClass('disabled').prop('disabled', false);
        }
        
        if (currentIndex === numCards - 1) {
            nextBtn.addClass('disabled').prop('disabled', true);
        } else {
            nextBtn.removeClass('disabled').prop('disabled', false);
        }
    }

    function scrollToCard(index) {
        if (index >= 0 && index < numCards) {
            currentIndex = index;
            cards[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            updateNavButtons();
        }
    }

    prevBtn.on('click', function(e) {
        e.preventDefault();
        if (currentIndex > 0) {
            scrollToCard(currentIndex - 1);
        }
    });

    nextBtn.on('click', function(e) {
        e.preventDefault();
        if (currentIndex < numCards - 1) {
            scrollToCard(currentIndex + 1);
        }
    });

    let scrollTimeout;
    container.on('scroll', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            const containerRect = container[0].getBoundingClientRect();
            const containerCenter = containerRect.left + containerRect.width / 2;
            
            let closestIndex = 0;
            let closestDistance = Infinity;
            
            cards.each(function(index) {
                const cardRect = this.getBoundingClientRect();
                const cardCenter = cardRect.left + cardRect.width / 2;
                const distance = Math.abs(cardCenter - containerCenter);
                
                if (distance < closestDistance) {
                    closestDistance = distance;
                    closestIndex = index;
                }
            });
            
            currentIndex = closestIndex;
            updateNavButtons();
        }, 100);
    });

    updateNavButtons();


});
/* ===== Student Stories: hover/click active card + prev/next nav ===== */
jQuery(document).ready(function ($) {
    var $cards = $('.student-stories-section .story-card');
    if (!$cards.length) return;
    var isTouch = window.matchMedia('(pointer: coarse)').matches;
    var hoverTimer, HOVER_DELAY = 200;

    function activate($card) {
        if (!$card.length) return;
        $cards.removeClass('active');
        $card.addClass('active');
    }

    $cards.on('click', function () {
        if (!isTouch) return;
        activate($(this));
    });

    if (!isTouch) {
        $cards.on('mouseenter', function () {
            var $c = $(this);
            clearTimeout(hoverTimer);
            hoverTimer = setTimeout(function () { activate($c); }, HOVER_DELAY);
        });
        $cards.on('mouseleave', function () { clearTimeout(hoverTimer); });
    }

    $('.student-stories-nav .nav-prev').on('click', function () {
        var i = $cards.index($cards.filter('.active'));
        if (i < 0) i = 0;
        activate($cards.eq(Math.max(0, i - 1)));
    });
    $('.student-stories-nav .nav-next').on('click', function () {
        var i = $cards.index($cards.filter('.active'));
        if (i < 0) i = 0;
        activate($cards.eq(Math.min($cards.length - 1, i + 1)));
    });
});

/* ===== Course features: Read More / Read Less toggle ===== */
jQuery(document).ready(function ($) {
    $(document).on('click', '.course-features-toggle', function () {
        var $box = $(this).closest('.course-features');
        var on = $box.toggleClass('is-expanded').hasClass('is-expanded');
        $(this).text(on ? 'Read Less' : 'Read More').attr('aria-expanded', on ? 'true' : 'false');
    });
});
