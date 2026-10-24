// Single Course JS

//Timer Expiry Countdown
const displayCountdown = () => {
	const timerElement = document.querySelector('.countdown-timer');
	if (!timerElement) {
		console.error('Countdown timer element not found');
		return;
	}

	const expiryDate = timerElement.dataset.expiry;
	if (!expiryDate) {
		console.error('Expiry date not found in dataset');
		return;
	}

	const countDownDate = new Date(expiryDate).getTime();

	const update = setInterval(() => {
		const now = new Date().getTime();
		const diff = countDownDate - now;

		if (diff > 0) {
			const days = Math.floor(diff / (1000 * 60 * 60 * 24));
			const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
			const seconds = Math.floor((diff % (1000 * 60)) / 1000);

			document.querySelector('#dayCount').innerHTML = days;
			document.querySelector('#hourCount').innerHTML = hours;
			document.querySelector('#minuteCount').innerHTML = minutes;
			document.querySelector('#secondCount').innerHTML = seconds;
		} else {
			timerElement.style.display = 'none';
			clearInterval(update);
		}
	}, 1000);
};


jQuery(document).ready(function ($) {

	// TEFL PLUS AJAX loaded price
	updateEnrollButtonState();

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

	// Custom Dropdown

	function updateEnrollBtnHref(selectedPid, shouldAdd) {
		$(".enroll-now-btn, .enroll-now-btn a,.enroll_btn a").each(function () {
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

	function updateEnrollButtonState() {
		const selectMenu = $(".select-two-required");
		if (selectMenu.length) {
			let selectedCount = selectMenu.find(".option.selected").length;
			const enrollBtns = $(".enroll-now-btn, .enroll-now-btn a, .enroll_btn a,.flexible-booking-btn a");

			if (selectedCount !== 2) {
				enrollBtns.each(function () {
					const btn = $(this);

					btn.addClass('disabled')
						.attr('disabled', true)
						.attr('title', `Please select exactly 2 courses to enroll. Currently selected: ${selectedCount}`)
						.css({
							'opacity': '0.5',
							'cursor': 'not-allowed'
						});

					btn.off('click.disabled').on('click.disabled', function (e) {
						e.preventDefault();
						e.stopPropagation();
						showSelectionMessage(selectedCount);
						return false;
					});

					btn.off('mouseenter.disabled mouseleave.disabled')
						.on('mouseenter.disabled', function () {
							showTooltipMessage(this, selectedCount);
						})
						.on('mouseleave.disabled', function () {
							hideTooltipMessage();
						});
				});
			} else {
				enrollBtns.each(function () {
					const btn = $(this);

					btn.removeClass('disabled')
						.removeAttr('disabled')
						.removeAttr('title')
						.css({
							'pointer-events': 'auto',
							'opacity': '1',
							'cursor': 'pointer'
						});
					btn.off('click.disabled mouseenter.disabled mouseleave.disabled');
				});
			}
		}
	}

	function showSelectionMessage(selectedCount) {
		const message = selectedCount === 0
			? "Please select 2 courses before enrolling."
			: selectedCount === 1
				? "Please select 1 more course to enroll."
				: `Please select exactly 2 courses. You have ${selectedCount} selected.`;

		$('.selection-message').remove();

		const messageEl = $(`
            <div class="selection-message" style="
                position: fixed;
                top: 100px;
                left: 20px;
                background: #f44336;
                color: white;
                padding: 12px 20px;
                border-radius: 4px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.2);
                z-index: 9999;
                font-size: 14px;
                max-width: 300px;
            ">
                <i class="fa fa-exclamation-triangle" style="margin-right: 8px;"></i>
                ${message}
            </div>
        `);

		$('body').append(messageEl);

		setTimeout(() => {
			messageEl.fadeOut(300, function () {
				$(this).remove();
			});
		}, 3000);
	}

	function showTooltipMessage(element, selectedCount) {
		const message = selectedCount === 0
			? "Select 2 courses to enable enrollment"
			: selectedCount === 1
				? "Select 1 more course"
				: `Select exactly 2 courses (${selectedCount} selected)`;

		$('.hover-tooltip').remove();

		const tooltip = $(`
            <div class="hover-tooltip" style="
                position: absolute;
                background: #333;
                color: white;
                padding: 8px 12px;
                border-radius: 4px;
                font-size: 12px;
                white-space: nowrap;
                z-index: 10000;
                box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            ">
                ${message}
            </div>
        `);

		$('body').append(tooltip);

		const btn = $(element);
		const btnOffset = btn.offset();
		const btnHeight = btn.outerHeight();

		tooltip.css({
			top: btnOffset.top - tooltip.outerHeight() - 8,
			left: btnOffset.left + (btn.outerWidth() / 2) - (tooltip.outerWidth() / 2)
		});
	}

	function hideTooltipMessage() {
		$('.hover-tooltip').remove();
	}

	function updateSelectedCoursesField() {
		const selectMenu = $(".select-two-required");
		if (selectMenu.length) {
			let selectedPids = [];
			let defaultPids = selectMenu.data("defaults").toString().split(",");

			selectMenu.find(".option.selected").each(function () {
				selectedPids.push($(this).data("pid").toString());
			});

			if (selectedPids.length < 2) {
				for (let i = 0; i < defaultPids.length && selectedPids.length < 2; i++) {
					if (!selectedPids.includes(defaultPids[i])) {
						selectedPids.push(defaultPids[i]);
					}
				}
			}

			$("#selected_courses_field").val(selectedPids.join(','));

			const enrollBtns = $(".enroll-now-btn, .enroll-now-btn a,.enroll_btn a,.flexible-booking-btn a");
			if (enrollBtns.length) {
				enrollBtns.each(function () {
					let btn = $(this);
					let url = new URL(btn.attr("href"), window.location.origin);
					url.searchParams.set("selected_courses", selectedPids.join(','));
					btn.attr("href", url.toString());
				});
			}

			updateEnrollButtonState();
		}
	}

	function updateSelectedCoursesTooltip() {
		const selectMenu = $(".select-two-required");

		if (selectMenu.length) {
			let selectedCourses = [];

			selectMenu.find(".option.selected").each(function () {
				selectedCourses.push($(this).find(".option-text b").text());
			});

			const tooltipContent = selectedCourses.length > 0 ?
				`<b>Selected Courses:</b></br> ${selectedCourses.join(' & ')}` :
				`No courses selected`;

			selectMenu.attr('data-tooltip', tooltipContent);
		}
	}

	function initializeSelectMenu(optionMenu) {
		const selectBtn = optionMenu.find(".select-btn"),
			options = optionMenu.find(".option"),
			sBtnText = optionMenu.find(".sBtn-text"),
			originalText = sBtnText.text(),
			isResourcesSelect = optionMenu.hasClass("resources-select"),
			isSelectTwo = optionMenu.hasClass("select-two-required"),
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
						lastSelectedOption = { name: selectedOption, desc: productDesc, pLink: productPageLink };
					}

					sBtnText.text(selectedNames.length > 0 ? selectedNames.join(", ") : originalText);

					if (lastSelectedOption) {
						var content = `
                            <h6>${lastSelectedOption.name}</h6>
                            <div class="resource-info">${lastSelectedOption.desc}</div>
                            ${lastSelectedOption.pLink
								? `<a href="${lastSelectedOption.pLink}" target="_blank" class="btn btn-red btn-centered">Learn More</a>`
								: ''
							}
                        `;
						$(".resource-info-container").html(content);
					}

					// infoIcon.fadeIn();
				}
				else if (isSelectTwo) {
					let selectedOption = $(this).find(".option-text b").text();
					let selectedPid = $(this).data("pid");

					if ($(this).hasClass("selected")) {
						$(this).removeClass("selected");
						selectedNames = selectedNames.filter(name => name !== selectedOption);
					} else {
						if (selectedNames.length >= 2) {
							const firstSelectedOption = options.filter(".selected").first();
							const firstSelectedName = firstSelectedOption.find(".option-text b").text();

							firstSelectedOption.removeClass("selected");
							selectedNames = selectedNames.filter(name => name !== firstSelectedName);
						}

						$(this).addClass("selected");
						selectedNames.push(selectedOption);
					}

					sBtnText.text(selectedNames.length > 0 ? selectedNames.join(", ") : originalText);

					updateSelectedCoursesField();
					updateSelectedCoursesTooltip();

					if (selectedNames.length === 2) {
						optionMenu.removeClass("active");
					} else {
						optionMenu.addClass("active");
					}

					return false;
				}
				else {
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

		if (optionMenu.hasClass("select-two-required")) {
			updateSelectedCoursesField();
			updateSelectedCoursesTooltip();

			selectBtn.hover(
				function () {
					const tooltipContent = optionMenu.attr('data-tooltip');
					if (tooltipContent) {
						let tooltip = optionMenu.find('.custom-tooltip');
						if (tooltip.length === 0) {
							tooltip = $('<div class="custom-tooltip"></div>');
							optionMenu.append(tooltip);
						}
						tooltip.html(tooltipContent).addClass('active');
					}
				},
				function () {
					optionMenu.find('.custom-tooltip').removeClass('active');
				}
			);
		}
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
			perView: 3,
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

