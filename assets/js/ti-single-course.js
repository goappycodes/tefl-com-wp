// Single Course JS

//Timer Expiry Countdown
const displayCountdown = () => {
	//get data-expiry from .countdown-timer
	const expiryDate = document.querySelector('.countdown-timer').dataset.expiry;
	const countDownDate = new Date(expiryDate).getTime();
	let countdownTimer = document.getElementsByClassName('countdown-timer');

	//update time each second

	const update = setInterval(() => {
		//get time now and find differnce from countdown time

		var now = new Date().getTime();
		const diff = countDownDate - now;

		//calculate time as days, hours months and second

		if (diff > 0) {
			const days = Math.floor(diff / (1000 * 60 * 60 * 24));
			const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
			const seconds = Math.floor((diff % (1000 * 60)) / 1000);

			//display timer
			document.querySelector('#dayCount').innerHTML = days;
			document.querySelector('#hourCount').innerHTML = hours;
			document.querySelector('#minuteCount').innerHTML = minutes;
			document.querySelector('#secondCount').innerHTML = seconds;
		} else {

			document.querySelector('.countdown-timer').style.display = 'none';

		}
	}, 1000);
}
jQuery(document).ready(function ($) {

	 // TEFL PLUS AJAX loaded price

	 $('.resources-select .option').each(function() {
        var productId = $(this).data('pid'); 


        $.ajax({
            url: ti_obj.ti_ajax,
            type: 'POST',
            data: {
                action: 'get_product_price', 
                product_id: productId
            },
            success: function(response) {
                if (response.success) {
                    var salePrice = response.data.sale_price;
                    var savePercentage = response.data.save_percentage;
                    
                    $('.ajax-loaded-price').html('(+' + salePrice + ', Save ' + savePercentage + '%)');
                } else {
                    console.log('Error: ' + response.data);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX error:', error);
            }
        });
    });

	// Custom Dropdown

	function updateEnrollBtnHref(selectedPid, shouldAdd) {
        $(".enroll-now-btn, .enroll-now-btn a,.enroll_btn a").each(function () {
            let enrollBtn = $(this);
            let currentHref = enrollBtn.attr("href");
            let url = new URL(currentHref, window.location.origin);
            let pridParam = url.searchParams.get("prid");
            if (!pridParam) {
                return;
            }
            let pridArray = pridParam ? pridParam.split(",") : [];
            let pidIndex = pridArray.indexOf(String(selectedPid));
    
            if (shouldAdd && pidIndex === -1) {
                pridArray.push(String(selectedPid));
            } else if (!shouldAdd && pidIndex !== -1) {
                pridArray.splice(pidIndex, 1);
            }
    
            if (pridArray.length > 0) {
                url.searchParams.set("prid", pridArray.join(","));
            } else {
                url.searchParams.delete("prid");
            }
    
            enrollBtn.attr("href", url.toString());
        });
    }


	function initializeSelectMenu(optionMenu) {
        const selectBtn = optionMenu.find(".select-btn"),
            options = optionMenu.find(".option"),
            sBtnText = optionMenu.find(".sBtn-text"),
            originalText = sBtnText.text();

        const menuWidth = optionMenu.outerWidth();
        optionMenu.find('.options').outerWidth(menuWidth);

        selectBtn.on("click", () => {
            optionMenu.toggleClass("active");
        });

        options.each(function () {
            $(this).on("click", function () {
                let selectedOption = $(this).find(".option-text").text();
                let selectedPid = $(this).data('pid');

                if (sBtnText.text() === selectedOption && !$(this).data('target')) {
                    sBtnText.text(originalText);  
                    updateEnrollBtnHref(selectedPid, false);
                } else {
                    sBtnText.text(selectedOption); 
                    updateEnrollBtnHref(selectedPid, true);
                }

                optionMenu.removeClass("active");
                var targetId = $(this).data('target');
                var targetElement = $(`#${targetId}`);

                if (targetElement.length) {
                    $('html, body').animate({
                        scrollTop: targetElement.offset().top - 150
                    }, {
                        duration: 500,
                        specialEasing: {
                            width: "linear",
                            height: "easeOutBounce"
                        }
                    });
                }
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

	

	// Gifts Section

	var giftSectionWrapper = $('.course-gifts-wrapper');

	var observer = new IntersectionObserver(function (entries, observer) {
		entries.forEach(function (entry) {
			if (entry.isIntersecting) {
				console.log('Course gifts section is in the viewport!');

				$('.gift-images > div', entry.target).each(function (index) {
					var currentElement = $(this);
					var delay = index * 200;
					currentElement.find('img').delay(delay).animate({ opacity: 1 }, 800);
					currentElement.find('span').delay(delay + 200).animate({ opacity: 1 }, 800);

					setTimeout(function () {
						currentElement.find('img, span').css({
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

	// Klarna Modal

	let klarnaModal = $("#klarnaModal");
	let closeButton = $(".close");

	$(".klarna-learn-more").click(function () {
		klarnaModal.css("display", "block");
		klarnaModal.animate({ opacity: "1" }, 500);
	});


	closeButton.click(function (e) {
		e.preventDefault();
		klarnaModal.animate({ opacity: "0" }, 500, function () {
			klarnaModal.css("display", "none");
		});
	});

	$(window).click(function (event) {
		if (event.target == klarnaModal[0]) {
			klarnaModal.animate({ opacity: "0" }, 500, function () {
				klarnaModal.css("display", "none");
			});
		}
	});

	var stored_id;

	var tab1_details_height = $('.tab1-details').outerHeight();
	var tab1_card_height = $('#summary .tab-content__card').outerHeight();

	if (tab1_details_height > tab1_card_height) {
		$('.tab1-details').attr('style', 'height: ' + tab1_card_height + 'px;');
		$('#summary .view-more').show();
	}


	$(document).on('click', '.tab-button', function (e) {
		var for_attr = $(this).attr('for');
		console.log(for_attr);
		if (for_attr == 'accred') {
			setTimeout(function () {
				var tab3_logo_height = $('.accreditation-tab-content .section-logos').outerHeight();
				var tab3_details_height = $('.tab3-details').outerHeight();
				console.log(tab3_logo_height);
				console.log(tab3_details_height);
				if (tab3_details_height > tab3_logo_height) {
					$('.tab3-details').attr('style', 'height: ' + tab3_logo_height + 'px;');
					$('.accreditation-tab-content .view-more').show();
				}
			}, 500);
		}

	})

	var reg_ref = $('.content-block h3 a').text();
	$(".content-block h3 a").replaceWith(reg_ref);

	$(document).on('click', '.dates-more', function (e) {
		e.preventDefault();
		$(this).parent().addClass('showall');
	});

	$('.download-guide-col').click(function (e) {
		e.preventDefault();
		var guidename = $(this).find('a').attr('data-guide');
		$('.selected-guide input').attr('value', guidename);
	});

	var course_id = ti_obj.ti_curr_post_id;

	Cookies.set('course_id', course_id);

	var normalNav = function () {
		var scrollTop = $(window).scrollTop();
		if (scrollTop > 700) {
			$('.footer-course-banner').addClass('show');
		} else {
			$('.footer-course-banner').removeClass('show');
		}
	};

	$(window).scroll(function () {
		normalNav();
	});

	var window_width = $(window).width();
	if (window_width <= 768) {
		var side_col1 = $('.side-col.side-col1').outerHeight();
		console.log(side_col1);
		var side_col2 = $('.side-col.side-col2').outerHeight();
		console.log(side_col2);
		var side_col = Math.max(side_col1, side_col2);
		console.log(side_col);
		$('.side-col').attr('style', 'height:' + side_col + 'px;');
		$('.placement-sidebar-col').removeClass('sticky');
	}

	$(document).on('click', 'ul.nav.nav-tabs li', function (e) {
		$('ul.nav.nav-tabs li a').removeClass('active');
		$(this).find('a').addClass('active');
		$('.tab-pane').removeClass('active show');
		var curr_tab = $(this).find('a').attr('data-title');
		$('.' + curr_tab).addClass('active show');
	})

	$(document).on('click', '.view-more', function (e) {
		$(this).parent().find('.tab1-details').addClass('viewall');
		$(this).parent().find('.tab3-details').addClass('viewall');
		$(this).hide();
		$(this).parent().find('.view-less').show();
	})

	var scroll_height = $('.banner-strip').outerHeight();
	scroll_height += $('header').outerHeight();
	scroll_height += $('.banner-section').outerHeight();
	scroll_height += $('.tab-head-container').outerHeight();

	$(document).on('click', '.view-less', function (e) {
		$(this).parent().find('.tab1-details').removeClass('viewall');
		$(this).parent().find('.tab3-details').removeClass('viewall');
		$(this).hide();
		$(this).parent().find('.view-more').show();
		$("html, body").animate({ scrollTop: scroll_height }, "fast", 'linear');
	})

	/*display hunter guide brochure*/
	$('.hunter-button, .hunter-guide-image').click(function () {
		$(".hunter_brochure").css("display", "flex");
		var guidename = $('.hunter-button').attr('data-guide');
		console.log('gn', guidename);
		$('input[name="selected-guide"]').val(guidename);
	});

	$(".hunter_brochure").on('click', '.cross', function () {

		$(".hunter_brochure").animate({ 'opacity': '0.2' }, 500, function () {
			$(".hunter_brochure").css("display", "none");
			$(".hunter_brochure").css('opacity', '1');
		});

	});

	if ($(".countdown-timer") != undefined) {
		displayCountdown();
	}

	// Instructors Slider

	let glideElement = $('.instructors-glide');
	if (glideElement.length) {
		let glideSlider = new Glide('.instructors-glide', {
			type: "carousel",
			startAt: 0,
			perView: 4,
			autoplay: 8000,
			gap: 24,
			animationTimingFunc: 'ease-in-out',
			animationDuration: 400,
			breakpoints: {
				768: {
					perView: 1
				}
			}
		});

		glideSlider.mount();
	}

	// Video Slider

	let glideElementVideo = $('.video-testimoinials__glide');
	if (glideElementVideo.length) {
		let glideSliderVideo = new Glide('.video-testimoinials__glide', {
			type: "carousel",
			startAt: 0,
			perView: 4,
			autoplay: 8000,
			gap: 24,
			animationTimingFunc: 'ease-in-out',
			animationDuration: 400,
			breakpoints: {
				768: {
					perView: 1
				}
			}
		});

		glideSliderVideo.mount();
	}

	if ($('.popup-video-review').length) {
		$('.popup-video-review').magnificPopup({
			type: 'iframe',
			iframe: {
				markup: '<div class="mfp-iframe-scaler">' +
					'<div class="mfp-close"></div>' +
					'<iframe class="mfp-iframe" frameborder="0" allowfullscreen muted></iframe>' +
					'</div>',
				patterns: {
					youtube: {
						index: 'youtube.com/',
						id: 'v=',
						src: '//www.youtube.com/embed/%id%?autoplay=1'
					},
					youtu: {
						index: 'youtu.be/',
						id: '/',
						src: '//www.youtube.com/embed/%id%?autoplay=1'
					}
				},
				srcAction: 'iframe_src'
			}
		});
	}


	let resourcesCard = $('.resources-card');
	if (resourcesCard.length) {
		resourcesCard.find('.resources-card__summary').equalizeHeights();
	}
});



const tabbedContent = () => {
	const tabs = document.querySelectorAll("[data-tab-target]")
	const tabContents = document.querySelectorAll("[data-tab-content]")
	//console.log(tabs);
	tabs.forEach(tab => {
		tab.addEventListener('click', () => {
			const target = document.querySelector(tab.dataset.tabTarget);
			tabContents.forEach(tabContent => {
				tabContent.classList.remove('active');
			})
			target.classList.add('active');
		})
	})
}

// function for new tabbed content

const tabContainer = $('#tabs-section .tab-head');
const tabWrapper = $('.tab-wrapper');
const tabContentContainer = $('#tabs-section .course-details-tab-content');
const tabLink = $('.course-details-section .tab-link');
const tabBody = $('.course-details-section .tab-body');
let timerOpacity;
let readMore = $('.read-more-btn-container');
const tabInit = () => {
	if (matchMedia('(max-width: 768px)').matches) {
		readMore.slideDown();
	}
	readMore.find('span').text('read more');
	tabLink.off('click').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		if (!$(this).hasClass('active')) {
			window.clearTimeout(timerOpacity);

			tabLink.removeClass('active');
			tabBody.removeClass('active');
			tabBody.removeClass('active-content');
			$(this).addClass('active');
			$($(this).attr('href')).addClass('active');

			timerOpacity = setTimeout(() => {
				$($(this).attr('href')).addClass('active-content');
			}, 50);
		}
	});

	readMore.off('click').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).find('i').toggleClass('rotate180');
		if ($(this).find('span').text() === 'read more') {
			tabContentContainer.css({ height: 'auto' });
			$(this).find('span').text('show less');
		} else {
			tabContentContainer.css({ height: '400px' });
			$(this).find('span').text('read more');
		}
	});
};

tabInit();

if ($('.tabs section').length) {
	$('.tabs section').each(function () {
		let childNodes = $(this).children();
		childNodes.each(function (index) {
			$(this).css({
				'transition-delay': (index * 0.1) + 's'
			});
		})

	});
}
if (matchMedia('(min-width: 769px)').matches) {
	tabContentContainer.css('max-height', tabContainer.height() + 'px');
}


//function for carousel slider

const carouselSlider = () => {
	//getting browsers width
	let sliderTrack = document.querySelector('.slider-track');
	const browserWidth = sliderTrack.getBoundingClientRect().width;


	// adding all the slide into an array
	const slider = document.querySelector('.review-slider');
	const slides = Array.from(slider.children);
	slides[0].classList.add('current-slide');
	//setting width of slides

	if (browserWidth <= 768) {
		const setWidth = browserWidth + 'px'
		slides.forEach(slide => {
			slide.style.width = setWidth;
		})
	}
	else {
		const setWidth = (browserWidth) / 2 - 16 + 'px';
		slides.forEach(slide => {
			slide.style.width = setWidth;
		})
	}


	//getting slider buttons
	const nextBtn = document.querySelector('.review-slider-next');
	const prevBtn = document.querySelector('.review-slider-prev');

	//calculating width of a slide
	const slideWidth = slides[0].getBoundingClientRect().width;

	//positioning each slide next to each other
	const setSlidePosition = (slide, index) => {
		slide.style.left = (slideWidth + 32) * index + 'px';
	}
	slides.forEach(setSlidePosition);

	const move = (slider, currentSlide, targetSlide) => {
		slider.style.transform = 'translateX(-' + targetSlide.style.left + ')';
		currentSlide.classList.remove('current-slide');
		targetSlide.classList.add('current-slide');
	}
	//move slide when slide button is clicked

	prevBtn.addEventListener('click', e => {
		const currentSlide = slider.querySelector('.current-slide');
		const prevSlide = currentSlide.previousElementSibling;
		nextBtn.style.display = 'block';
		move(slider, currentSlide, prevSlide)
	})

	nextBtn.addEventListener('click', e => {
		const currentSlide = slider.querySelector('.current-slide');
		const nextSlide = currentSlide.nextElementSibling;
		prevBtn.style.display = 'block';

		if (browserWidth <= 768) {
			if (currentSlide.nextElementSibling !== null) {
				move(slider, currentSlide, nextSlide)
			}
			else {
				nextBtn.style.display = 'none';
			}
		}
		else {
			if (nextSlide.nextElementSibling !== null) {
				move(slider, currentSlide, nextSlide)
			}
			else {
				nextBtn.style.display = 'none';
			}
		}

	});


}


window.onload = function () {
	tabbedContent();
}

if (document.querySelector('.slider-track')) {
	window.oneresize = carouselSlider();
}

