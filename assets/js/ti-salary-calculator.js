jQuery(document).ready(function($){
	var show_common_style = 'display:flex;';
	var hide_common_style = 'display:none;';

	// $('.wpcf7-submit').attr('disabled', 'disabled');
	$('.agree-terms input').change(function () {
        $('.get-started-btn').css('display', 'inline-flex')
    });

	$(document).on('click', '.get-started-btn', function(e){
		e.preventDefault();
		$('.name-div').attr('style', show_common_style);
		$('.info-text').attr('style', hide_common_style);
	})

	$(document).on('click', '.name-ok-btn', function(e){
		e.preventDefault();
		$('.email-div').attr('style', show_common_style);
		$('.name-div').attr('style', hide_common_style);
	})

	$(document).on('click', '.email-ok-btn', function(e){
		e.preventDefault();
		if (!isEmailInvalid()) {
			$('.phone-div').attr('style', show_common_style);
			$('.email-div').attr('style', hide_common_style);
		}
	})
	function isEmailInvalid() {
		return $('input[name="your-email"]').hasClass('wpcf7-not-valid');
	}

	$(document).on('click', '.phone-ok-btn', function(e){
		e.preventDefault();
		if (!isPhoneNumberInvalid()) {
			$('.tefl-qualification-div').attr('style', show_common_style);
			$('.phone-div').attr('style', hide_common_style);
		}
	})

	function isPhoneNumberInvalid() {
		return $('input[name="phoneNumber"]').hasClass('wpcf7-not-valid');
	}

	$(document).on('click', 'input[name="tefl-qualification"]', function(e){
		if($('input[name="tefl-qualification"]').is(':checked')) { 
			//var tefl_qualification = $('input[name="tefl-qualification"]:checked').val();
			$('.tefl-qualification .wpcf7-list-item').removeClass('checked');
			$(this).parent().parent().addClass('checked');
			setTimeout(function(){
				$('.tefl-loe-div').attr('style', show_common_style);
				$('.tefl-qualification-div').attr('style', hide_common_style);
			}, 1000);
		}
	})

	$(document).on('click', 'input[name="level-of-education"]', function(e){
		if($('input[name="level-of-education"]').is(':checked')) { 
			//var level_of_education = $('input[name="level-of-education"]:checked').val();
			$('.level-of-education .wpcf7-list-item').removeClass('checked');
			$(this).parent().parent().addClass('checked');
			setTimeout(function(){
				$('.tefl-passport-div').attr('style', show_common_style);
				$('.tefl-loe-div').attr('style', hide_common_style);
			}, 1000);
		}
	})

	$(document).on('click', 'input[name="passport-country"]', function(e){
		if($('input[name="passport-country"]').is(':checked')) { 
			//var passport_country = $('input[name="passport-country]:checked').val();
			$('.passport-country .wpcf7-list-item').removeClass('checked');
			$(this).parent().parent().addClass('checked');
			setTimeout(function(){
				$('.tefl-experience-div').attr('style', show_common_style);
				$('.tefl-passport-div').attr('style', hide_common_style);
			}, 1000);
		}
	})

	$(document).on('click', 'input[name="tefl-experience"]', function(e){
		if($('input[name="tefl-experience"]').is(':checked')) { 
			//var tefl_experience = $('input[name="tefl-experience]:checked').val();
			$('.tefl-experience .wpcf7-list-item').removeClass('checked');
			$(this).parent().parent().addClass('checked');
			$('.final-submit-div').attr('style', show_common_style);
			$('.wpcf7-submit').removeAttr('disabled');
		}
	})

	document.addEventListener( 'wpcf7mailsent', function( event ) {
	    if ( '3901' == event.detail.contactFormId ) {

	        var inputs = event.detail.inputs;
	        console.log(inputs);
 
		  	for (var i = 0; i < inputs.length; i++) {
		    	if ('tefl-qualification' == inputs[i].name) {
		      		if(inputs[i].value === '120 hour TEFL Certificate') {
		      			var tefl_qual = 1;
		      		} else if(inputs[i].value === 'Level 5/CELTA Certificate') {
						var tefl_qual = 2;
		      		}
		    	}
		    	if ('level-of-education' == inputs[i].name) {
		      		if(inputs[i].value === 'High school diploma, A-levels, or equivalent') {
		      			var tefl_loe = 0;
		      		} else if(inputs[i].value === 'Associates or Bachelor\'s degree') {
						var tefl_loe = 2;
		      		} else if(inputs[i].value === 'Master\'s degree or above') {
		      			var tefl_loe = 2;
		      		}
		    	}
		    	if ('passport-country' == inputs[i].name) {
		      		if(inputs[i].value === 'UK/Ireland/Australia/New Zealand/US/Canada/South Africa') {
		      			var tefl_pass = 2;
		      		} else if(inputs[i].value === 'Other (where English is the official language)') {
						var tefl_pass = 1;
		      		} else if(inputs[i].value === 'Other (non-native English speaking Country)') {
		      			var tefl_pass = 0;
		      		}
		    	}
		    	if ('tefl-experience' == inputs[i].name) {
		      		if(inputs[i].value === 'Over 2 years') {
		      			var tefl_exp = 2;
		      		} else if(inputs[i].value === '1-2 years') {
						var tefl_exp = 1;
		      		} else if(inputs[i].value === 'Under 1 year') {
		      			var tefl_exp = 0;
		      		}
		    	}
		  	}

		  	var total = parseInt(tefl_qual) + parseInt(tefl_loe) + parseInt(tefl_pass) + parseInt(tefl_exp);
		  	console.log(total);
		  	$('.wpcf7-response-output').attr('total', total);
		  	$('.wpcf7-response-output').addClass('ast-row');
		  	$('.tefl-experience-div, .final-submit-div').attr('style', 'display:none;');
		  	var html_prev_text = '<div class="ast-col-md-6 ast-col-sm-12 img-col"><img src="https://teflinstitute.com/wp-content/uploads/2021/02/salary-calc-1-min.png" alt="Salary Calculator Image"></div>';
		  	var html_txt = '<p>Check your email inbox now for your free Video Masterclass in creating a demo lesson that will impress future employers.</p><p class="small-note"><small>* Please note that this calculator provides a rough estimate of your potential maximum monthly salary teaching English online and is intended as a guide only.</small></p>';

		  	setTimeout(function(){ 
				if( total >= 0 && total <= 3 ){
					var response = html_prev_text+'<div class="ast-col-md-6 ast-col-sm-12 content-col"><p>Teaching online is a great way to make extra cash! However, you may want to think about upskilling first. You are looking at around <b>€8-€12 per hour</b>. <br/>With experience, it will get better!</p>'+html_txt+'</div>';
					$('.wpcf7-response-output').html(response);
				}else if( total >= 4 && total <= 6 ){
					var response = html_prev_text+'<div class="ast-col-md-6 ast-col-sm-12 content-col"><p>Teaching English online could be your dream career. Currently, you are looking at <b>€13-€18 per hour</b>. <br/>Make sure you have everything needed to earn that bit more!</p>'+html_txt+'</div>';
					$('.wpcf7-response-output').html(response);
				}else if( total >= 7 && total <= 9 ){
					var response = html_prev_text+'<div class="ast-col-md-6 ast-col-sm-12 content-col"><p>Great news! You\'re on the higher end of the pay scale. You might expect to earn between <b>€19-€30 per hour</b>.</p>'+html_txt+'</div>';
					$('.wpcf7-response-output').html(response);
				}
			}, 200);
	    }
	}, false );


	$(document).on('keyup', 'input[name="your-name"], input[name="last-name"]', function(e){
		if (($('input[name="your-name"]').val().length !== 0) && ($('input[name="last-name"]').val().length !== 0)) {
	    	$('.name-ok-btn').attr('style', 'display:inline-block;');
	    	if (event.keyCode === 13) {
		        $(".name-ok-btn").click();
		    }
	    }else{
	    	$('.name-ok-btn').attr('style', hide_common_style);
	    }
	})

	$(document).on('keyup', 'input[name="your-email"]', function(e){
		if ($('input[name="your-email"]').val().length !== 0) {
	    	$('.email-ok-btn').attr('style', 'display:inline-block;');
	    	if (event.keyCode === 13) {
		        $(".email-ok-btn").click();
		    }
	    }else{
	    	$('.email-ok-btn').attr('style', hide_common_style);
	    }
	})
	
	/*$(document).on('keyup', 'input[name="phone-cf7it-national"]', function(e){
    	if (event.keyCode === 13) {
	        $(".phone-ok-btn").click();
	    }
	})*/

	$(document).on('keyup', 'input[name="phoneNumber"]', function(e){
	    if ($(this).val().length !== 0) {
	    	$('.phone-ok-btn').attr('style', 'display:inline-block;');
	    	if (event.keyCode === 13) {
		        $(".phone-ok-btn").click();
		    }
	    }else{
	    	$('.phone-ok-btn').attr('style', hide_common_style);
	    }
	})

	var cc = ti_obj.ti_country_code;
	cc = cc.toLowerCase();
	console.log(cc);

	/*$('ul.country-list li.country[data-country-code="'+cc+'"]').trigger("click");

	$(document).on('click','li.country[data-country-code="in"]'', function(event){
	    event.preventDefault();
	    console.log(event.currentTarget);
	});*/
	
	/*$('ul.country-list li.country').removeClass('active');
	$('ul.country-list li.country[data-country-code="'+cc+'"]').addClass('preferred highlight active');
	var country_name = $('ul.country-list li.country.highlight[data-country-code="'+cc+'"] .country-name').text();
	var dial_code = $('ul.country-list li.country.highlight[data-country-code="'+cc+'"] .dial-code').text();
	var title = country_name+': '+dial_code;
	$('.flag-container .selected-flag').attr('title', title);
	$('.flag-container .selected-flag').html('<div class="iti-flag '+cc+'"></div><div class="iti-arrow"></div>');*/
	
});