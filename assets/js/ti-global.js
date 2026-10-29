// Global JS

$.fn.displayCountdown = function () {
	//get data-expiry from .countdown-timer
	const expiryDate = $('.countdown-timer').data('expiry');
	const countDownDate = new Date(expiryDate).getTime();

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
			$('#dayCount').html(days);
			$('#hourCount').html(hours);
			$('#minuteCount').html(minutes);
			$('#secondCount').html(seconds);
		} else {
			$('.countdown-timer').css('display', 'none');
		}
	}, 1000);
}

$.fn.equalizeHeights = function () {
	var maxHeight = 0;
	this.each(function () {
		if ($(this).height() > maxHeight) {
			maxHeight = $(this).height();
		}
	});
	this.height(maxHeight);
	return this;
};

$.fn.equalizePairHeights = function () {
	let elements = this;
	for (let i = 0; i < elements.length; i += 2) {
		let firstElement = $(elements[i]);
		let secondElement = i + 1 < elements.length ? $(elements[i + 1]) : null;
		if (secondElement) {
			let maxHeight = Math.max(firstElement.height(), secondElement.height());
			firstElement.height(maxHeight);
			secondElement.height(maxHeight);
		} else {
			firstElement.height('auto');
		}
	}
	return this;
};


function ti_cf7_open_brochure() {
	var current_page = window.location.pathname;
	document.addEventListener('wpcf7mailsent', function (event) {

		if ('1723' == event.detail.contactFormId) { // Redirects Online Courses Brochure form to the brochure page

			var inputs = event.detail.inputs;
			//location = '/tefl-form-brochure';
			location = '/wp-content/uploads/2021/04/TEFL-Institute-Study-Prospectus-Interactive.pdf';

			for (var i = 0; i < inputs.length; i++) {
				if ('selected-guide' == inputs[i].name) {
					if (inputs[i].value == "teoguide") {
						location = '/wp-content/uploads/2020/12/tefl.ie-teach-english-online-guide-copy-6.pdf';
					}
					if (inputs[i].value == "thailandguide") {
						location = '/thailand-interactive-guide/';
					}
					break;
				}
			}

		}

	}, false);
}


var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = window.location.search.substring(1),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
		}
	}
	return false;
};



jQuery(document).ready(function ($) {

	var lastScrollPosition = 0;
	var scrollThreshold = 200;
	var banner = jQuery('.header-offer-banner');

	

	jQuery(window).on('scroll', function() {
		var currentScroll = jQuery(window).scrollTop();

		if (currentScroll > scrollThreshold) {
			banner.addClass('visible');
		} else if (currentScroll < scrollThreshold) {
			banner.removeClass('visible');
		}

		lastScrollPosition = currentScroll;
	});


	// Teaching resoureces dropdown

	let showMore = $('.resource-description-header .fa, .resources-select-wrapper__header .fa');
    let hideTimeout;

    showMore.on('mouseenter', function (e) {
        e.preventDefault();
        clearTimeout(hideTimeout);

        let infoBlock = $(this).siblings('.resource-info-container');

        $('.resource-info-container').not(infoBlock).removeClass('animate-slide-down');

        infoBlock.addClass('animate-slide-down');
    });

    showMore.on('mouseleave', function (e) {
        e.preventDefault();
        
        let infoBlock = $(this).siblings('.resource-info-container');
        hideTimeout = setTimeout(() => {
            infoBlock.removeClass('animate-slide-down');
        }, 2000);
    });

    let infoBlock = $('.resource-info-container');

    infoBlock.on('mouseenter', function (e) {
        e.preventDefault();
        clearTimeout(hideTimeout);
    });

    infoBlock.on('mouseleave', function (e) {
        e.preventDefault();
        let block = $(this);
        hideTimeout = setTimeout(() => {
            block.removeClass('animate-slide-down');
        }, 500);
    });

	function update_geo_banner_image() {
		var geo_currency_code = $("span.woocommerce-Price-amount.amount span.woocommerce-Price-currencySymbol").text();
		console.log("geo_currency_code", geo_currency_code);
		if (geo_currency_code.includes("$")) { image_extension = "dollars" };
		if (geo_currency_code.includes("€")) { image_extension = "euros" };
		if (geo_currency_code.includes("£")) { image_extension = "pounds" };
		console.log("Changing second slide to Geo targeted banner " + image_extension + " -  REMOVE THIS ONCE BLACK FRIDAY IS OVER");
		var geo_image_url = "https://i0.wp.com/teflinstitute.com/wp-content/uploads/2023/11/" + image_extension + "_TI.jpg";

		jQuery("section.banner-slide.banner-slide-2").attr("data-bg", geo_image_url);
		jQuery("section.banner-slide.banner-slide-2").css("background-image", "url('" + geo_image_url + "')");
	}

	// intl-tel init removed 2026-09-18: single widget now via mu-plugin ti-intl-phone-unify (backup ti-global.js.bak-intlphone-20260918)

	let glideElement = $('.hero-slider-container');
	if (glideElement.length) {
		let glideDuration = $('.glide__track').data('glide-interval');
		let glideSlider = new Glide('.hero-slider-container', {
			type: 'carousel',
			startAt: 0,
			perView: 1,
			// autoplay: glideDuration,
			animationTimingFunc: 'ease-in-out',
			animationDuration: 400,
		});

		glideSlider.mount();
	}
	if (matchMedia('(max-width: 768px)').matches) {
		let sliderElements = $('.glide__slide');
		sliderElements.each(function () {
			let mobileBg = $(this).data('mobile-bg');
			$(this).css({ 'background': `url(${mobileBg})` });
		});
	}

	// Dyanamic Color theming

	// let colors = $("body").data("colors");
	// accentColor = colors.accent_color;
	// coursePageAccentColor = colors.course_internship_page_accent_color;

	// document.documentElement.style.setProperty('--accent', accentColor);
	// document.documentElement.style.setProperty('--blue-turquoise', coursePageAccentColor);


	//AJAX snippets
	$('.ajax-snippet').each(function () {
		var snippetDiv = $(this);
		var snippet = $(this).attr('data-snippet');
		var objectid = $(this).attr('data-objectid');
		if (snippet) {
			var data = {
				'action': 'load_ajax_snippet',
				'objectid': objectid,
				'snippet': snippet
			};

			$.ajax({
				url: pt_obj.pt_ajax,
				type: "POST",
				data: data,
				beforeSend: function () {
					$(".loader").show();
				},
				success: function (response) {
					$(snippetDiv).html(response);
				},
				complete: function () {
					$(".loader").hide();
				},
			});
		}
	});


	//JavaScript for mega menu
	(function($) {
		let menuTimeout;
		let menuDebounce;
		let debounceDelay = 100; 
		
		$('.ti-menu-item.has-children').on('mouseenter', function(e) {
			e.preventDefault();
			
			clearTimeout(menuTimeout);
			clearTimeout(menuDebounce);
			
			const $menuItem = $(this);
			
			menuDebounce = setTimeout(function() {
				$('.ti-menu-item.has-children').removeClass('openmenu');
				$menuItem.addClass('openmenu');
			}, debounceDelay);
			
		}).on('mouseleave', function(e) {
			e.preventDefault();
			
			clearTimeout(menuDebounce);
			
			const $menuItem = $(this);
			
			menuTimeout = setTimeout(function() {
				$menuItem.removeClass('openmenu');
			}, 300); 
		});
		
		$(document).on('click', function(e) {
			if (!$(e.target).closest('.ti-mega-menu-new').length) {
				$('.ti-menu-item.has-children').removeClass('openmenu');
			}
		});
		
	})(jQuery);


	/* Course Extension Scripts*/
	let verifyEmailButton = $('.verify-btn');
	let inputField = $('#moodle_username');
	let loaderGif = $('.loader-gif');
	let verificationMessageWrapper = $('.verification-message-wrapper');
	let verificationIcon = $('.verification-icon');
	let verificationMessage = $('.verification-message');
	let addToCartBtn = $('.product_cat-extension .single_add_to_cart_button');
	let coursesSelect = $('#coursesList');
	let coursesSelectNew = $('#coursesListNew');
	let coursesSelectWrapper = $('.extension-fields-wrapper__select');
	let selectedCourse = $('#moodleCourseName');
	let selectedCourseID = $('#moodleCourseID');




	addToCartBtn.attr('disabled', 'disabled');
	addToCartBtn.addClass('disabled');

	coursesSelectNew.select2({
		placeholder: 'Select course/courses to Extend',
		allowClear: true,
		// multiple:true,
		closeOnSelect: false,
		width: '100%'
	});

	coursesSelectNew.on('select2:select select2:unselect', function () {
		var selectedValues = coursesSelectNew.val(); // Get an array of selected values

		if (selectedValues === null || selectedValues.length === 0) {
			addToCartBtn.addClass('disabled');
			addToCartBtn.attr('disabled', 'disabled');
			selectedCourse.val('');
			selectedCourseID.val('');
		} else {
			var selectedTexts = coursesSelectNew.find('option:selected').map(function () {
				return $(this).text();
			}).get().join(', ');

			selectedCourse.val(selectedTexts);

			var selectedIDs = selectedValues.join(',');
			selectedCourseID.val(selectedIDs);

			addToCartBtn.removeClass('disabled');
			addToCartBtn.removeAttr('disabled');
		}
	});

	if (coursesSelect.val() === '-1') {
		addToCartBtn.attr('disabled', 'disabled');
		addToCartBtn.addClass('disabled');
	}

	coursesSelect.on('change', function () {
		var selectedVal = $(this).val();
		if (selectedVal === '-1') {
			addToCartBtn.addClass('disabled');
			addToCartBtn.attr('disabled', 'disabled');
		} else {
			var selectedText = $(this).find('option:selected').map(function () {
				return $(this).text();
			}).get().join(', ');
			selectedCourse.val(selectedText);

			var selectedID = $(this).find('option:selected').map(function () {
				return $(this).val();
			}).get().join(',');
			selectedCourseID.val(selectedID);

			addToCartBtn.removeClass('disabled');
			addToCartBtn.removeAttr('disabled');
		}
	});

	inputField.on('input', function () {
		let inputValue = $(this).val().trim();
		if (inputValue.length === 0) {
			verificationMessageWrapper.addClass('hidden');
			// coursesSelectWrapper.addClass('hidden');
			// $('#coursesList option:not([value="-1"])').remove();
			addToCartBtn.addClass('disabled');
			addToCartBtn.attr('disabled', 'disabled');

		}
		verifyEmailButton.toggleClass('hidden', !inputValue.length);
	});

	if (verifyEmailButton.length) {
		verifyEmailButton.on('click', function () {
			verifyMailAjax(inputField.val(), $(this));
		});
	}

	function verifyMailAjax(email_uname, verifyBtn) {
		let verifyBtnText = verifyBtn.find('.verify-btn__text');
		let ajaxData = {
			'action': 'ti_verify_email_uname',
			'email_uname': email_uname,
		};

		$.ajax({
			url: pt_obj.pt_ajax,
			type: "POST",
			data: ajaxData,
			beforeSend: function () {
				loaderGif.removeClass('hidden');
				verifyBtnText.text('verifying..')
			},
			success: function (response) {
				result = JSON.parse(response);
				let status = result.status;
				let uname = result.uname;
				let coursesList = result.course_list;
				let moodleIds = JSON.parse($('#moodleCoursesList').val());
				verificationMessageWrapper.removeClass('hidden');
				if (status) {
					verificationIcon.removeClass('fa-warning');
					// coursesSelectWrapper.removeClass('hidden');
					addToCartBtn.removeClass('disabled');
					addToCartBtn.removeAttr('disabled');
					verificationIcon.addClass('fa-check-circle');
					verificationMessage.html(`Verified. We have found an user <strong>${uname}</strong> associated with <strong>${inputField.val()}</strong>`);
					verificationMessageWrapper.removeClass('has-error');
					$('#coursesList option:not([value="-1"])').remove();
					$('#coursesListNew option:not([value="-1"])').remove();
					$.each(coursesList, function (key, value) {
						if (moodleIds.includes(parseInt(key))) {
							$('<option>').val(key).text(value).appendTo('#coursesList');
							$('<option>').val(key).text(value).appendTo('#coursesListNew');
						}
					});
					result.value.type === "email" ? inputField.val(uname) : null;
				}
				else {
					verificationIcon.removeClass('fa-check-circle');
					verificationIcon.addClass('fa-warning');
					// coursesSelectWrapper.addClass('hidden');
					addToCartBtn.addClass('disabled');
					addToCartBtn.attr('disabled', 'disabled')
					verificationMessage.html(`Error! No user associated with <strong>${inputField.val()}</strong> found. Check your input and try again`);
					verificationMessageWrapper.addClass('has-error');
					$('#coursesList option:not([value="-1"])').remove();
					$('#coursesListNew option:not([value="-1"])').remove();
				}
			},
			complete: function () {
				loaderGif.addClass('hidden');
				verifyBtnText.text('verify');
				verifyBtn.addClass('hidden');
			},
		});
	}
	/* End Course Extension Scripts*/


	if ($('.ti-mega-menu-container').length) {
		var left_dist = $('.ti-mega-menu-container').offset().left;
		left_dist = left_dist - 20;
	}

	var window_width = $(window).width();
	$('.ti-sub-menu-item').attr('style', 'width: ' + window_width + 'px !important; left: -' + left_dist + 'px');
	$('.ti-sub-menu-item.5').attr('style', 'width: auto; left: auto;');
	$('.ti-sub-menu-item.6').attr('style', 'width: auto; left: auto;');

	// Mega menu JS end

	var slider_slide_count = $(".banner-strip-slider").find(".slider-content-div").length;
	if (slider_slide_count > 1) {
		$(".banner-strip-slider").lightSlider({
			item: 1,
			loop: true,
			slideMove: 1,
			auto: true,
			pager: false,
		});
	}


	/*Country Selector dropdown start*/

	$(document).on('click', '.choose-country', function (e) {

		e.preventDefault();
		$('#ti_country_selector').toggleClass('show');
	})

	$(document).on('click', 'body', function (e) {
		if ($(e.target).is(".choose-country, .choose-country i, .choose-country img") === false) {
			$('#ti_country_selector').removeClass('show');
		}

	})

	$(document).on('click', '#ti_country_selector li', function (e) {
		var countycode = $(this).attr('value');
		Cookies.set('user_country_code', countycode);
	})

	var cookie_country = Cookies.get('user_country_code');
	if (cookie_country) {
		var cookie_country_l = cookie_country.toLowerCase();
		var country_name = $('#ti_country_selector li[value="' + cookie_country + '"]').attr('title');
		$('#ti_country_selector li[value="' + cookie_country + '"]').addClass("active");
		$('.choose-country').html('<img src="https://flagcdn.com/h20/' + cookie_country_l + '.png">');
	}

	/*Country Selector dropdown end*/

	// $("input#billing_dob").mask('99/99/9999',{placeholder:"mm/dd/yyyy"});;

	/*setTimeout(ptefl_timezone, 3000);*/

	var WindowWidth = $(window).width();
	ti_cf7_open_brochure();

	$(document).on('click', '.boxzilla-close-icon', function (e) {
		var site_url = window.location.hostname
		var current_path = window.location.pathname;
		var current_protocol = window.location.protocol
		var reload_url = current_protocol + "//" + site_url + '' + current_path;
		window.location.assign(reload_url);
	})


	// Only for mobile
	if (WindowWidth < 769) {
		$('.top-bar').hide();
		$('.top-bar-links').insertBefore('#primary-menu');
		$('.top-bar-search').insertAfter('#primary-menu');
		$('.top-bar-search').show();
		$('.location-contact').insertAfter('#primary-menu');
		$('.header-cta-icons').insertBefore('.top-bar-links');
		$('.bf-menu-link').insertBefore(['.header-cta-icons']);
		// $('.location-contact').show();
	}
	else {
		// $('.left').insertBefore('.right');
	}



	//Mobile Footer collapse 

	if (WindowWidth < 768) {

		$('.footer-adv-widget .widget-title').click(function (e) {
			e.preventDefault();
			$(this).next().toggleClass('open');
		})
	}


	// Mega Menu

	if (WindowWidth > 768) {
		$(".has-mega-menu").hover(function () {
			$(".mega-menu").show();
		}, function () {
			$(".mega-menu").hide();
		});

		$(".mega-menu").hover(function () {
			$(".mega-menu").show();
		}, function () {
			$(".mega-menu").hide();
		});
	}



	document.addEventListener('wpcf7mailsent', function (event) {
		if ('4297' == event.detail.contactFormId) {
			ga('send', 'event', 'Study Prospectus', 'submit');
			location = 'https://teflinstitute.com/wp-content/uploads/2021/04/TEFL-Institute-Study-Prospectus-Interactive.pdf';
		}
	}, false);

	document.addEventListener('wpcf7mailsent', function (event) {
		if ('66694' == event.detail.contactFormId) {
			ga('send', 'event', 'Free Guide from Internship Page', 'submit');
			console.log("location", location);
			location = $("input[name='guide-download-link']").val();
		}
	}, false);

	document.addEventListener('wpcf7mailsent', function (event) {
		if ('5736' == event.detail.contactFormId) {
			ga('send', 'event', 'Study Prospectus', 'submit');
			location = 'https://teflinstitute.com/wp-content/uploads/2021/05/TEFL-Institute-Job-Hunters-Guide-Landscape-compressed.pdf';
		}
	}, false);

	// Job Hunter's Guide on Courses Template
	document.addEventListener('wpcf7mailsent', function (event) {
		if ('7170' == event.detail.contactFormId) {
			ga('send', 'event', 'Job Hunter\'s Guide', 'submit');
			location = 'https://teflinstitute.com/wp-content/uploads/2021/08/TEFL-Institute-Job-Hunters-Guide-Landscape-compressed-1.pdf';
		}
	}, false);

	document.addEventListener('wpcf7mailsent', function (event) {
		if ('5736' == event.detail.contactFormId) {
			ga('send', 'event', 'Study Prospectus', 'submit');
			location = 'https://teflinstitute.com/wp-content/uploads/2021/06/TEFL-Elective-Program-Brochure-1.pdf';
		}
	}, false);


	const timerExpiry = $('.tefl_countdown_timer_value').val();

	if (timerExpiry != 'null') {
		const countDownDate = new Date(timerExpiry).getTime();

		// Update the count down every 1 second
		const x = setInterval(function () {

			// Get todays date and time
			const now = new Date().getTime();

			// Find the distance between now and the count down date
			const distance = countDownDate - now;

			// Time calculations for days, hours, minutes and seconds
			const days = Math.floor(distance / (1000 * 60 * 60 * 24));
			const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			const seconds = Math.floor((distance % (1000 * 60)) / 1000);

			if (distance > 0) {

				function setTime(flip) {
					updateGroup('day', days, flip);
					updateGroup('hour', hours, flip);
					updateGroup('min', minutes, flip);
					updateGroup('sec', seconds, flip);
				}

				setTime(true);
			}
		}, 1000);
	}

	function flipTo(digit, n) {
		var current = digit.attr('data-num');
		digit.attr('data-num', n);
		digit.find('.front').attr('data-content', current);
		digit.find('.back, .under').attr('data-content', n);
		digit.find('.flap').css('display', 'block');
		setTimeout(function () {
			digit.find('.base').text(n);
			digit.find('.flap').css('display', 'none');
		}, 350);
	}

	function jumpTo(digit, n) {
		digit.attr('data-num', n);
		digit.find('.base').text(n);
	}

	function updateGroup(group, n, flip) {
		var digit1 = $('.ten' + group);
		var digit2 = $('.' + group);
		n = String(n);
		if (n.length == 1) n = '0' + n;
		var num1 = n.substr(0, 1);
		var num2 = n.substr(1, 1);
		if (digit1.attr('data-num') != num1) {
			if (flip) flipTo(digit1, num1);
			else jumpTo(digit1, num1);
		}
		if (digit2.attr('data-num') != num2) {
			if (flip) flipTo(digit2, num2);
			else jumpTo(digit2, num2);
		}
	}



	/*GDPR COOKIE*/
	$('#tefl_cookie_close').click(function () {
		$("#tefl_cookie_bar").animate({ 'opacity': '0' }, 500, function () {
			$("#tefl_cookie_bar").css("display", "none");
			$("#tefl_cookie_bar").css("opacity", "1");
		});
	});


	/*SHOW GDPR COOKIE BAR IF COOKIE NOT SET*/
	window.setTimeout(function () {
		var is_cookie = getCookie('viewed_cookie_policy');
		if (is_cookie != "yes")
			showCookie();
	});

	function showCookie() {
		$("#tefl_cookie_bar").fadeIn(1000).css({ "display": "block" });
	};


	/*GDPR SET COOKIE*/
	$("#tefl_cookie_close").click(function () {
		var d = new Date();
		var setdays = 1000 * 60 * 60 * 24 * 365;
		var expires = new Date((new Date()).valueOf() + setdays);
		document.cookie = "viewed_cookie_policy=yes; expires=" + expires.toUTCString();
	});


	/*GDPR COOKIE FUNCTION*/
	function getCookie(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}


	// Combined geo related ajax call

	function getSizeInBytes(str) {
		return new Blob([str]).size;
	}
	function handleCombinedGeoRelatedAjaxRequest() {
		const combinedDataCookie = CookieService.getCookie('ti_combined_data');
		if (combinedDataCookie) {
			const resContent = JSON.parse(decodeURIComponent(combinedDataCookie));
			updateLogo(resContent.ti_change_logo);
			updateGeoTel(resContent.ti_change_geo_tel);
			updateGeoCountryCode(resContent.ti_get_geo_country_code);
			updateGeoBanner(resContent.ti_geo_targetted_banner);
			console.log("Using cached data");
		} else {
			// If the cookie does not exist, make the AJAX request
			const action = 'ti_combined_ajax_geo_actions'; 
			$.post(ti_obj.ti_ajax, { action }, function (response) {
				const res = JSON.parse(response);
				console.log('test res',res);
				if (res.status === true) {
					const dataSize = getSizeInBytes(JSON.stringify(res.content));
					console.log(`Data size: ${dataSize} bytes`);
					
					CookieService.setCookie('ti_combined_data', encodeURIComponent(JSON.stringify(res.content)), 30);
					updateLogo(res.content.ti_change_logo);
					updateGeoTel(res.content.ti_change_geo_tel);
					updateGeoCountryCode(res.content.ti_get_geo_country_code);
					updateGeoBanner(res.content.ti_geo_targetted_banner);
				} else {
					console.log("Combined request failed");
				}
			});
		}
	}

	function updateLogo(data) {
		if (data.status === true) {
			$('.primary-menu-wrapper .ti-logo img, .site-header .site-logo-img img, .footer-new .site-social-logo-container .site-logo')
				.attr('src', data.content)
				.attr('data-lazy-src', data.content);
		}
	}
	
	function updateGeoTel(data) {
		if (data.status === true) {
			$('.footer-geo-contact').html(data.content);
			$('.call-info .call-label').html("Call: " + data.content);
		}
	}
	
	function updateGeoCountryCode(data) {
		if (data.status === true) {
			$('body').attr('data-geo_country_code', data.content);
		}
	}
	
	function updateGeoBanner(data) {
		if (data.status === true) {
			$('.geo_banner').html(data.content);
		}
	}

	handleCombinedGeoRelatedAjaxRequest();

	// Combined geo related ajax call

	var showFooterBanner = function () {
		var scrollTop = $(window).scrollTop();
		if (scrollTop > 400) {
			$('.footer-course-banner').addClass('show')
		}
		else {
			$('.footer-course-banner').removeClass('show')
		}
	};

	var makeTopBannerSticky = function () {
		var scrollTop = $(window).scrollTop();
		if (scrollTop > 400) {
			$('body').addClass('top-banner-is-sticky')
		}
		else {
			$('body').removeClass('top-banner-is-sticky');
		}
	}

	$(window).scroll(function () {
		showFooterBanner();
	});
	$(window).scroll(function () {
		makeTopBannerSticky();
	});

	// Login forms land on the Affiliate Area; the sign-up block form keeps its own redirect (the thank-you page).
	$("form:not(.affwp-register-form) input[name='affwp_redirect']").val("/affiliate-area/");

	// Boxzilla.on('box.show', function(box) {
	// 	console.log("Showing box " + box.id);
	// 	ga('send', 'event', 'Boxzilla'+box.id);
	// 	gtag('event', 'Boxzilla'+box.id);		
	// });


	$('.search-input-container .search-icon').click(function (e) {
		e.preventDefault();
		$('.search-input-field-wrapper').toggleClass('hidden');
	});
	$(document).click(function (e) {
		var container = $('.search-input-container');
		if (!container.is(e.target) && container.has(e.target).length === 0) {
			$('.search-input-field-wrapper').addClass('hidden');
		}
	});

	$('.search-submit-icon').click(function () {
		$('.search-input-container form').submit();
	});



	// footer-mobile-bar

	$('#closeButton').click(function () {
		$('.mobile-bar').slideUp();
		$('#showButton').fadeIn();
		$('.zsiq_custommain.siq_bR').fadeOut();
		$('.site-footer').css('margin-bottom', '0');
	});

	$('#showButton').click(function () {
		$('.mobile-bar').slideDown();
		$('.zsiq_custommain.siq_bR').fadeIn();
		$('#showButton').fadeOut();
		$('.site-footer').css('margin-bottom', '75px');
	});


	let resourceContainer = $('.resource-container');
    let productId = resourceContainer.data('product-id');

	// GEO Targetted Banner content

	var eurozone = ['AT','BE','CY','DE','EE','ES','FI','FR','GR','HR','IE','IT',
                    'LT','LU','LV','MT','NL','PT','SI','SK'];

    function symbolForCountry(countryCode) {
        if (countryCode === 'GB') return '£';
        if (eurozone.indexOf(countryCode) !== -1) return '€';
        return '$';
    }

    function swapCurrencies(symbol) {
        $('.geo-currency').each(function () {
            var amount = $(this).data('amount');
            $(this).text(symbol + amount);
        });
    }

    var cachedCountry = $('body').attr('data-geo_country_code');

    if (cachedCountry) {
        swapCurrencies(symbolForCountry(cachedCountry));
    } else {
        $.get('https://ipinfo.io/json', function (resp) {
            var country = (resp && resp.country) ? resp.country : '';
            swapCurrencies(symbolForCountry(country));
        }, 'jsonp');
    }
});


// ===== Unified intl-tel phone widget (added 2026-09-18, replaces removed block above) =====
(function(){
  var COOKIE='countryCode', UTILS='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.min.js';
  // Widget targets: intl-phone / #intlPhone / bare tel, but NOT phonetext (country-phone plugin owns those).
  var SEL_INIT='input.intl-phone, input#intlPhone, input[type="tel"]:not(.wpcf7-phonetext)';
  // Harvest targets on submit: every phone field, incl. phonetext.
  var SEL_ALL='input.intl-phone, input#intlPhone, input.wpcf7-phonetext, input[type="tel"]';

  function getCookie(n){var m=document.cookie.match('(^|;)\\s*'+n+'\\s*=\\s*([^;]+)');return m?m.pop():'';}
  function setCookie(n,v,d){var e=new Date();e.setTime(e.getTime()+d*864e5);document.cookie=n+'='+v+';expires='+e.toUTCString()+';path=/';}
  // ti-global stored this cookie JSON-quoted+uppercase (e.g. %22IN%22); normalise to a clean lowercase iso2.
  function readCountry(){var raw=getCookie(COOKIE);if(!raw)return '';try{raw=decodeURIComponent(raw);}catch(e){}raw=raw.replace(/^["']+|["']+$/g,'').trim().toLowerCase();return /^[a-z]{2}$/.test(raw)?raw:'';}

  function initInput(input){
    if(input.getAttribute('data-ti-phone')==='1' || input.closest('.iti')) return;
    var cc=readCountry(), opts={separateDialCode:true, autoPlaceholder:'aggressive', utilsScript:UTILS};
    if(cc){ opts.initialCountry=cc; }
    else{
      opts.initialCountry='auto';
      opts.geoIpLookup=function(cb){
        function done(r){ var c=((r&&r.country)?r.country:'us').toLowerCase(); setCookie(COOKIE,c,365); cb(c); }
        if(window.jQuery){ jQuery.get('https://ipinfo.io',function(){},'jsonp').always(done); }
        else{ fetch('https://ipinfo.io/json').then(function(r){return r.json();}).then(done).catch(function(){ cb('us'); }); }
      };
    }
    try{ input.__iti=window.intlTelInput(input, opts); input.setAttribute('data-ti-phone','1'); }catch(e){}
  }
  function e164From(inp, form){
    try{ var iti=inp.__iti || (window.intlTelInputGlobals && window.intlTelInputGlobals.getInstance(inp)); if(iti){ var n=(iti.getNumber()||'').replace(/\s+/g,''); if(/^\+\d{7,15}$/.test(n)) return n; } }catch(e){}
    var ks=['full_phone','full_number']; for(var i=0;i<ks.length;i++){ var h=form.querySelector('input[name="'+ks[i]+'"]'); if(h){ var v=(h.value||'').replace(/\s+/g,''); if(/^\+\d{7,15}$/.test(v)) return v; } }
    if(window.jQuery && jQuery.fn.intlTelInput){ try{ if(jQuery(inp).data('intl-tel-input-id')!=null){ var n2=(jQuery(inp).intlTelInput('getNumber')||'').replace(/\s+/g,''); if(/^\+\d{7,15}$/.test(n2)) return n2; } }catch(e){} }
    return '';
  }
  function initForm(form){
    form.querySelectorAll(SEL_INIT).forEach(initInput);
    if(form.getAttribute('data-ti-phone-submit')==='1') return;
    form.addEventListener('submit', function(){
      form.querySelectorAll(SEL_ALL).forEach(function(inp){
        var e=e164From(inp, form);
        if(e && String(inp.value).indexOf('+')===-1) inp.value=e;
      });
    }, true);
    form.setAttribute('data-ti-phone-submit','1');
  }
  function scan(){ document.querySelectorAll('form.wpcf7-form').forEach(initForm); }
  function boot(){
    setTimeout(scan,300);
    window.addEventListener('load',scan);
    document.addEventListener('wpcf7init',function(e){ var f=e&&e.target&&e.target.matches&&e.target.matches('form.wpcf7-form')?e.target:null; if(f){initForm(f);}else{scan();} });
    document.addEventListener('focusin',function(e){ var t=e.target; if(t&&t.matches&&t.matches(SEL_INIT)&&t.getAttribute('data-ti-phone')!=='1'&&t.closest('form.wpcf7-form')){ initInput(t); initForm(t.closest('form.wpcf7-form')); } });
  }
  if(document.readyState!=='loading') boot(); else document.addEventListener('DOMContentLoaded',boot);
})();
