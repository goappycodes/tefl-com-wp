jQuery(document).ready(function ($) {

	let showMore = $('.show-schedule,.show-schedule-icon,.radio-custom-label-pay-deposit');
	let infoBlock = $('.installments-breakdown');
	showMore.hover(
		(e) => {
			e.preventDefault();
			infoBlock.addClass('animate-slide-down');
		},
		(e) => {
			e.preventDefault();
			infoBlock.removeClass('animate-slide-down');
		},
	);

	

	// ti_change_product_price_for_payin2();

	function ti_change_product_price_for_payin2() {
		$(".deposit-full-price ins bdi, #timetable .price ins bdi").each(function (index) {
			var price_html = $(this).html();
			var price_val = price_html.replace(/[^0-9.]/g, '');

			var depositPercent = $('.deposit-full-price').data('depositpercent');

			let isFixed99 = $('.deposit-full-price').data('isfixed99');
            let isFixed3995 = $('.deposit-full-price').data('isfixed3995');
			if (isFixed99) {
				var discount_price_val = split_deposit;
			}
			else if (isFixed3995) {
				var discount_price_val = split_deposit_new;
			} else {
				var discount_price_val = parseFloat(price_val) * depositPercent;
			}
			discount_price_val = parseFloat(discount_price_val).toFixed(2);
			$(this).parent().append('<bdi class="discount-price price-now">' + price_html + '</bdi>');
			var discount_price_html = $(this).parent().find('.discount-price');
			var elem = discount_price_html.children('span').html();
			discount_price_html.html(elem + '' + discount_price_val);
			$(this).wrap("<strike>");
			//$('strike').hide();
			$('.deposit-full-price del').attr('style', 'display:none');
		});
	}
	$(document.body).on('wc_price_based_country_after_ajax_geolocation', function () {
		$('.deposit-full-price del').css('display','inherit');
		//ti_change_product_price_for_payin2();
		let priceHtm = $('.deposit-full-price ins bdi').html();
		var price = priceHtm.replace(/[^0-9.]/g, '');
		let priceContainer = $('.deposit-full-price');
		console.log(priceContainer);
		priceContainer.attr("data-price", price);
	});

	$(document).on('click', 'input[name="wc_deposit_option"]', function (e) {
		if (!$(this).parent().hasClass('active')) {
		  $('input[name="wc_deposit_option"]').parent().removeClass('active');
		  $(this).parent().addClass('active');
	  
		  let showScheduleIcon = $('.show-schedule-icon');
	  
		  var input_id = $('input[name="wc_deposit_option"]:checked').attr('id');
	  
		  if (input_id === 'wc-option-pay-full') {
			$(".deposit-full-price ins bdi, #timetable .price ins bdi").each(function (index) {
			  $(".deposit-full-price ins .discount-price, #timetable .price ins .discount-price").remove();
			  $('.deposit-full-price ins strike bdi, #timetable .price ins strike bdi').unwrap();
			  $('.deposit-full-price del').attr('style', 'display:inherit');
			});
			showScheduleIcon.fadeOut(300);
		  } else if (input_id === 'wc-option-pay-deposit') {
			ti_change_product_price_for_payin2();
			showScheduleIcon.fadeIn(300);
		  }
		}
	  });
	  

	var stored_id;

	// var input_id = $('input[name="wc_deposit_option"]:checked').attr('id');
	// var href_val = $('.enroll-now-btn').attr('href');
	// if (href_val !== 'undefined') {
	// 	href_val = ti_enroll_btn_href(input_id, href_val, "");
	// 	console.log('here',href_val);
	// 	$('.enroll-now-btn').attr('href', href_val);
	// }

	function ti_enroll_btn_href(input_id, href_val, onclick_event) {
		if (input_id === 'wc-option-pay-full' || $(`#${input_id}`).hasClass('wc-option-pay-full')) {
			if (href_val.indexOf('&deposit') !== -1) {
				href_val = href_val.replace('&deposit', '');
			}
		} else if (input_id === 'wc-option-pay-deposit' || $(`#${input_id}`).hasClass('wc-option-pay-deposit')) {
			if (onclick_event === '') {
				href_val = href_val + '&deposit';
			} else {
				if (input_id == stored_id) {
					onclick_event.stopPropagation();
				} else {
					href_val = href_val + '&deposit';
				}
			}
		}
		return href_val;
	}

	function ti_table_enroll_btn_url_change() {
		$(".flexible-booking-btn a, .enroll_btn a").each(function (index) {
			var input_id = $('input[name="wc_deposit_option"]:checked').attr('id');
			var href_val = $(this).attr('href');
			href_val = ti_enroll_btn_href(input_id, href_val, "");
			$(this).attr('href', href_val);
		});
	}

	ti_table_enroll_btn_url_change();

	$(document).on('click', 'input[name="wc_deposit_option"]', function (event) {
		var input_id = $(this).attr('id');
		console.log('ID',input_id);
		if ($(".ti-enroll-btn").hasClass("enroll-now-btn")) {
			var href_val = $('.enroll-now-btn').attr('href');
			if (href_val !== 'undefined') {
				href_val = ti_enroll_btn_href(input_id, href_val, event);
				stored_id = input_id;
				$('.enroll-now-btn').attr('href', href_val);
			}
		}
		ti_table_enroll_btn_url_change();
	});
	//Black Friday Sales Courses
	$(document).on('click', '.pay-option', function (event) {
		let input_id = $(this).attr('id');
		let priceDiv = $(this).parent().parent().siblings('.course-price');
		let enrolBtnDiv = $(this).parent().parent().siblings('.enrol-now');
		let enrolBtn = enrolBtnDiv.find('.enrol-cta-btn');
		let totalDeposits = priceDiv.data('deposits');
		console.log(totalDeposits);
		if ($(this).hasClass('wc-option-pay-full')) {
			enrolBtn.html('pay in full');
		} else if ($(this).hasClass('wc-option-pay-deposit')) {
			enrolBtn.html(`pay in ${totalDeposits}`);
		}
		if (enrolBtnDiv.hasClass("enroll-now-btn")) {
			var href_val = enrolBtn.attr('href')
			if (href_val !== 'undefined') {
				href_val = ti_enroll_btn_href(input_id, href_val, event);
				stored_id = input_id;
				enrolBtn.attr('href', href_val);
			}
		}
	});
})