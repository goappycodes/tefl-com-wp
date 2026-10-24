jQuery('document').ready(function ($) {

    // TEFL PLUS AJAX loaded price

    $('.resources-select .option').each(function () {
        var $option = $(this);
        var productId = $option.data('pid');
    
        $.ajax({
            url: ti_obj.ti_ajax,
            type: 'POST',
            data: {
                action: 'get_product_price',
                product_id: productId
            },
            success: function (response) {
                if (response.success) {
                    var salePrice = response.data.sale_price;
                    var savePercentage = response.data.save_percentage;
    
                    $option.find('.ajax-loaded-price').html(
                        '(+' + salePrice + ', Save ' + savePercentage + '%)'
                    );
                } else {
                    console.log('Error: ' + response.data);
                }
            },
            error: function (xhr, status, error) {
                console.log('AJAX error:', error);
            }
        });
    });

    if (matchMedia('(min-width: 768px)').matches) {
        $('.benefits-details__desc').equalizeHeights();
        $('.equal-height-cta').equalizeHeights();
        let faqsContainerHeight = $('.faqs-wrapper.equal-height').height();
        $('.app-download-container').height(faqsContainerHeight);
    }

    $('.course-details').on('click', function(event) {
        event.preventDefault();
        var targetId = $(this).attr('href');
        $('html, body').animate({
          scrollTop: $(targetId).offset().top - 150
        }, 1000);
    });

    // Quck links dropdown

    function updateEnrollBtnHref(selectedPid, shouldAdd) {
        $(".enroll_btn a,.enroll-now-link-btn.enroll-now a").each(function () {
            let enrollBtn = $(this);
            let currentHref = enrollBtn.attr("href");
            let url = new URL(currentHref, window.location.origin);
            let pridParam = url.searchParams.get("prid");
    
            let pridArray = pridParam ? pridParam.split(",") : [];
            let originalPrid = pridArray[0]; 
    
            url.searchParams.delete("prid");

            if (shouldAdd) {
                if (selectedPid && !pridArray.includes(String(selectedPid))) {
                    pridArray.push(String(selectedPid));
                }
            } else {
                pridArray = pridArray.filter(pid => pid !== String(selectedPid));
            }
    
            if (!pridArray.includes(originalPrid)) {
                pridArray.unshift(originalPrid);
            }
    
            if (pridArray.length > 0) {
                url.searchParams.set("prid", pridArray.join(","));
            }
    
            enrollBtn.attr("href", url.toString());
        });
    }

    function initializeSelectMenu(optionMenu) {
        const selectBtn = optionMenu.find(".select-btn"),
            options = optionMenu.find(".option"),
            sBtnText = optionMenu.find(".sBtn-text"),
            originalText = sBtnText.text(),
            isResourcesSelect = optionMenu.hasClass("resources-select"),
            infoIcon = $(".resources-select-wrapper__header .fa");
    
        const menuWidth = optionMenu.outerWidth();
        optionMenu.find(".options").outerWidth(menuWidth);
    
        let selectedNames = [];
        let lastSelectedOption = null;
    
        selectBtn.on("click", () => {
            optionMenu.toggleClass("active");
        });
    
        options.each(function () {
            $(this).on("click", function () {
                if (isResourcesSelect) {
                    let selectedOption = $(this).find(".option-text b").text(); 
                    let selectedPid = $(this).data("pid");
                    let productDesc = $(this).data("desc");
                    let productPageLink = $(this).data("pagelink");
    
                    if ($(this).hasClass("selected")) {
                        $(this).removeClass("selected");
                        selectedNames = selectedNames.filter(name => name !== selectedOption);
                        updateEnrollBtnHref(selectedPid, false); 
                    } else {
                        $(this).addClass("selected");
                        selectedNames.push(selectedOption);
                        updateEnrollBtnHref(selectedPid, true); 
                        lastSelectedOption = { name: selectedOption, desc: productDesc , pLink : productPageLink }; 
                    }
    
                    sBtnText.text(selectedNames.length > 0 ? selectedNames.join(", ") : originalText);
    
                    if (lastSelectedOption) {
                        var content = `
                            <h6>${lastSelectedOption.name}</h6>
                            <div class="resource-info">${lastSelectedOption.desc}</div>
                            ${
                                lastSelectedOption.pLink 
                                ? `<a href="${lastSelectedOption.pLink}" target="_blank" class="btn btn-red btn-centered">Learn More</a>` 
                                : ''
                            }
                        `;
                        $(".resource-info-container").html(content);
                    }                    
    
                    infoIcon.fadeIn();
                } else {
                    let selectedOption = $(this).find(".option-text").text(); 
                    let targetId = $(this).data("target");
                    let targetElement = $(`#${targetId}`);
    
                    sBtnText.text(selectedOption);
    
                    if (targetElement.length) {
                        $("html, body").animate(
                            {
                                scrollTop: targetElement.offset().top - 150,
                            },
                            {
                                duration: 500,
                                specialEasing: {
                                    width: "linear",
                                    height: "easeOutBounce",
                                },
                            }
                        );
                    }
                }
    
                optionMenu.removeClass("active");
            });
        });
    
        $(document).on("click", function (e) {
            if (!optionMenu.is(e.target) && optionMenu.has(e.target).length === 0) {
                optionMenu.removeClass("active");
            }
        });
    }
    
    $(".select-menu").each(function () {
        initializeSelectMenu($(this));
    });


    // Course Outlines Accordion

    $(document).on('click', '.course-outline-accordion', function (e) {
        let isActive = $(this).hasClass('active');
        $('.course-outline-accordion').removeClass('active');
        
        if (!isActive) {
            $(this).addClass('active');
        } else if (!$('.course-outline-accordion.active').length) {
            $(this).addClass('active');
        }
    
        let activeItem = $('.course-outline-accordion.active');
        if (activeItem.length) {
            $('html, body').animate({
                scrollTop: activeItem.offset().top - 150
            }, 500);
        }
    });

    // course modules

    if (matchMedia('(max-width: 768px)').matches){
        $('.course-modules-tab .course-time').appendTo('.course-modules-tab__content');
        $('.course-intro-video').appendTo('.verified-student-reviews-section__row .video-insert-div')
    }

    const tabLink = $('.course-modules-tab__menu-link');
    const tabBody = $('.course-module-tab-body');
    let timerOpacity;
    const tabInit = () => {
        tabLink.off('click').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if (!$(this).hasClass('active')) {
                window.clearTimeout(timerOpacity);

                tabLink.removeClass('active');
                tabBody.removeClass('active');
                $(this).addClass('active');
                $($(this).attr('href')).addClass('active');
            }
        });
    };

    tabInit();

    let slider = $(".course-modules-tab__menu");

    if (slider.length) {
        let currentSlide;
        let slidesCount;

        slider.lightSlider({
            item: 1,
            loop: true,
            pager:false,
            slideMargin: 0,
            easing: 'linear',
            mode: 'fade',
            controls: true,
            prevHtml: '<img src="/wp-content/uploads/2024/11/arrow-prev.svg">',
            nextHtml: '<img src="/wp-content/uploads/2024/11/arrow-next.svg">',
            onSliderLoad: function(el) {
                var progressBar = slider.parentsUntil(".variable_slider_row").find(".progress");
                var tabContentContainer = $('.course-modules-tab__content');
                progressBar.css("display", "block");
                tabContentContainer.css("display", "block");
                slider.css("opacity",1);
                $('.course-time').css("opacity",1);
                var calc = ((el.getCurrentSlideCount() / el.getTotalSlideCount()) * 100);
                progressBar.css("background-size", calc + "% 100%");
            },
            onBeforeSlide: function(el, current) {
                var calc = ((current + 1) / el.getTotalSlideCount()) * 100;
                var progressBar = slider.parentsUntil(".variable_slider_row").find(".progress");
                progressBar.css("background-size", calc + "% 100%");
            }
        });
    }

    // Team Members Slider

    if ($('#team-members-slider').length) {
        let teamMembersSlider = new Splide('#team-members-slider', {
            type: 'slide',
            rewind: true,
            gap: '3rem',
            perPage: 3,
            perMove: 2,
            arrows: false,
            pagination: true,
            breakpoints: {
                800: {
                    perPage: 1,
                    perMove: 1,
                }
            }
        });

        teamMembersSlider.on('mounted', function() {
            $('#team-members-slider').css('opacity', 1);
        });

        teamMembersSlider.on('mounted move', function() {
            $('#team-members-slider .splide__slide').removeClass('is-out-of-view');

            let index = teamMembersSlider.index;
            let visibleSlides = teamMembersSlider.options.perPage;

            $('#team-members-slider .splide__slide').each(function (i) {
                if (i < index || i >= index + visibleSlides) {
                $(this).addClass('is-out-of-view');
                }
            });
        });
        
        teamMembersSlider.mount();
    }

    // Create an Intersection Observer instance
    var observer = new IntersectionObserver(function(entries) {
        console.log(entries);
        entries.forEach(function(entry) {
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
        $(".verified-student-reviews-section__slider .rplg-grid").appendTo(".verified-student-reviews-section__row .rplg-insert");
    
        $('.progress-bar').each(function() {
        var $this = $(this);
        var percent = $this.attr('percent');
        $this.css("width", percent + '%');
        $({animatedValue: 0}).animate({animatedValue: percent}, {
            duration: 3000,
            step: function() {
            $this.attr('percent', Math.floor(this.animatedValue) + '%');
            },
            complete: function() {
            $this.attr('percent', Math.floor(this.animatedValue) + '%');
            }
        });
        });
    }

    // Video testimonials

    // Testimonial Slider

    if ($('.video-testimonials__slider').length) {
        let testimonialsSlider = new Splide('.video-testimonials__slider', {
        type: 'slide',
        rewind: true,
        gap: '2rem',
        perPage: 2,
        perMove: 1,
        arrows: true,
        pagination: false,
        breakpoints: {
            768: {
            perPage: 1,
            perMove: 1,
            pagination: false,
            }
        }
        });


        function applyBlur() {
            $('.video-testimonials__slider .splide__slide').removeClass('is-out-of-view');

            let index = testimonialsSlider.index;
            let visibleSlides = testimonialsSlider.options.perPage;

            $('.video-testimonials__slider .splide__slide').each(function (i) {
                if (i < index || i >= index + visibleSlides) {
                $(this).addClass('is-out-of-view');
                }
            });
        }

        testimonialsSlider.on('move', applyBlur);
        testimonialsSlider.mount();
        applyBlur();
    }

    // FAQs section

    $('.show-more-faqs').on('click', function() {
        let expandable = $(this).prev();
        expandable.toggleClass('expanded');
        isExpanded = expandable.hasClass('expanded');
        $(this).find('span').text(isExpanded ? "Read Less FAQ's" : "Read More FAQ's");
      });
    let isFirstClick = true;
    $('.faqs-accordion__item input').change(function() {
        if ($(this).prop('checked')) {
            $('.faqs-accordion__item').removeClass('active');
            $('.faqs-accordion__content').removeClass('active');
        
            $(this).parent('.faqs-accordion__item').addClass('active');
            $(this).parent('.faqs-accordion__item').find('.faqs-accordion__content').addClass('active');
            if (isFirstClick || $('.show-more-faqs').find('span').text()==="Read More FAQ's") {
            $('.show-more-faqs').trigger('click');
            isFirstClick = false;
            }
        } else {
            $(this).parent('.faqs-accordion__item').removeClass('active');
            $(this).parent('.faqs-accordion__item').find('.faqs-accordion__content').removeClass('active');
        }
    });

})
