jQuery('document').ready(function($) {
    var show_common_style = 'display:flex;';
    var hide_common_style = 'display:none;';

    $('.salary-calculator-form .wpcf7-submit').attr('disabled', 'disabled');

    $(document).on('click', '.get-started-btn', function(e) {
        e.preventDefault();
        $('.name-div').attr('style', show_common_style);
        $('.info-text').attr('style', hide_common_style);
    })

    $(document).on('click', '.name-ok-btn', function(e) {
        e.preventDefault();
        $('.tefl-passport-div').attr('style', show_common_style);
        $('.name-div').attr('style', hide_common_style);
    })

    // $(document).on('click', '.email-ok-btn', function(e) {
    //     e.preventDefault();
    //     $('.phone-div').attr('style', show_common_style);
    //     $('.email-div').attr('style', hide_common_style);
    // })

    // $(document).on('click', '.phone-ok-btn', function(e) {
    //     e.preventDefault();
    //     $('.tefl-passport-div').attr('style', show_common_style);
    //     $('.phone-div').attr('style', hide_common_style);
    // })

    $(document).on('click', 'input[name="passport"]', function(e) {
        if ($('input[name="passport"]').is(':checked')) {
            $('.tefl-passport .wpcf7-list-item').removeClass('checked');
            $(this).parent().parent().addClass('checked');
            setTimeout(function() {
                $('.tefl-english-level-div').attr('style', show_common_style);
                $('.tefl-passport-div').attr('style', hide_common_style);
            }, 1000);
        }
    })
    
    $(document).on('click', 'input[name="english-level"]', function(e) {
        if ($('input[name="english-level"]').is(':checked')) {
            $('.tefl-english-level .wpcf7-list-item').removeClass('checked');
            $(this).parent().parent().addClass('checked');
            setTimeout(function() {
                $('.tefl-degree-div').attr('style', show_common_style);
                $('.tefl-english-level-div').attr('style', hide_common_style);
            }, 1000);
        }
    })
    
    $(document).on('click', 'input[name="degree"]', function(e) {
        if ($('input[name="degree"]').is(':checked')) {
            $('.tefl-degree .wpcf7-list-item').removeClass('checked');
            $(this).parent().parent().addClass('checked');
            setTimeout(function() {
                $('.tefl-age-div').attr('style', show_common_style);
                $('.tefl-degree-div').attr('style', hide_common_style);
            }, 1000);
        }
    })
    
    $(document).on('click', 'input[name="age"]', function(e) {
        if ($('input[name="age"]').is(':checked')) {
            $('.tefl-age .wpcf7-list-item').removeClass('checked');
            $(this).parent().parent().addClass('checked');
            setTimeout(function() {
                $('.tefl-criminal-record-div').attr('style', show_common_style);
                $('.tefl-age-div').attr('style', hide_common_style);
            }, 1000);
        }
    })
    
    $(document).on('click', 'input[name="criminal-record"]', function(e) {
        if ($('input[name="criminal-record"]').is(':checked')) {
            $('.tefl-criminal-record .wpcf7-list-item').removeClass('checked');
            $(this).parent().parent().addClass('checked');
            setTimeout(function() {
                $('.tefl-health-div').attr('style', show_common_style);
                $('.tefl-criminal-record-div').attr('style', hide_common_style);
            }, 1000);
        }
    })
    
    $(document).on('click', 'input[name="health"]', function(e) {
        if ($('input[name="health"]').is(':checked')) {
            $('.tefl-health .wpcf7-list-item').removeClass('checked');
            $(this).parent().parent().addClass('checked');
            setTimeout(function() {
                $('.tefl-open-mind-div').attr('style', show_common_style);
                $('.tefl-health-div').attr('style', hide_common_style);
            }, 1000);
        }
    })
    
    $(document).on('click', 'input[name="open-mind"]', function(e) {
        if ($('input[name="open-mind"]').is(':checked')) {
            $('.open-mind .wpcf7-list-item').removeClass('checked');
            $(this).parent().parent().addClass('checked');
            $('.final-submit-div').attr('style', show_common_style);
            $('.wpcf7-submit').removeAttr('disabled');
        }
    })
    
    document.addEventListener('wpcf7submit', function(event) {
        if ('74144' == event.detail.contactFormId) {

            var inputs = event.detail.inputs;
            console.log(inputs);

            for (var i = 0; i < inputs.length; i++) {
                if ('passport' == inputs[i].name) {
                    if (inputs[i].value === 'USA, Canada, UK, Ireland, Australia, New Zealand or South Africa') {
                        var tefl_passport = 1;
                    } else if (inputs[i].value === 'Other (where English is the official language)') {
                        var tefl_passport = 0;
                    } else if (inputs[i].value === 'Other (non-native English speaking Country)') {
                        var tefl_passport = 0;
                    }
                    //break;
                }
              	if ('english-level' == inputs[i].name) {
                    if (inputs[i].value === 'Native') {
                        var tefl_english_level = 1;
                    } else if (inputs[i].value === 'Fluent') {
                        var tefl_english_level = 0;
                    }
                    //break;
                }
                if ('degree' == inputs[i].name) {
                    if (inputs[i].value === 'Yes') {
                        var tefl_degree = 1;
                    } else if (inputs[i].value === 'No') {
                        var tefl_degree = 0;
                    }
                    //break;
                }
                if ('age' == inputs[i].name) {
                    if (inputs[i].value === '21-45') {
                        var tefl_age = 1;
                    } else if (inputs[i].value === '45+') {
                        var tefl_age = 0;
                    }
                    //break;
                }
                if ('criminal-record' == inputs[i].name) {
                    if (inputs[i].value === 'Yes') {
                        var tefl_criminal_record = 0;
                    } else if (inputs[i].value === 'No') {
                        var tefl_criminal_record = 1;
                    }
                    //break;
                }
                if ('open-mind' == inputs[i].name) {
                    if (inputs[i].value === 'Yes') {
                        var tefl_open_mind = 1;
                    } else if (inputs[i].value === 'No') {
                        var tefl_open_mind = 0;
                    }
                    //break;
                }
            }

            var total = parseInt(tefl_passport) + parseInt(tefl_english_level) + parseInt(tefl_degree) + parseInt(tefl_age) + parseInt(tefl_criminal_record) + parseInt(tefl_open_mind);
            //console.log(total);
            $('.salary-calculator-form .wpcf7-response-output').attr('total', total);
            $('.salary-calculator-form .wpcf7-response-output').addClass('ast-row');
            $('.tefl-open-mind-div, .final-submit-div').attr('style', 'display:none;');
            var html_prev_text = '<div class="ast-col-md-6 ast-col-sm-12 img-col"><div style="background-image: url(https://teflinstitute.com/wp-content/uploads/2023/01/evan-krause-BU6lABNbTpA-unsplash.jpg);"></div></div>';
            var html_txt = '<p class="small-note"><small>* Please note that this form provides an initial screening only and does not guarantee you a position.</small>';
			var html_callback_internships = '<div style="display:flex;justify-content: center;gap: 20px;"><a style="background-color: #09487B;border-radius: 5px;color: white;margin-bottom: 20px !important;font-size: 1rem;padding: 10px 20px;letter-spacing: 0.3px;text-transform: uppercase;" href="/callback">Get a Callback</a><a style="background-color: #000;border-radius: 5px;color: white;margin-bottom: 20px !important;font-size: 1rem;padding: 10px 20px;letter-spacing: 0.3px;text-transform: uppercase;" href="/tefl-internships/">See all Internships</a></div>';
          
            setTimeout(function() {
                if (total >= 0 && total <= 5) {
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col"><p>Unfortunately, you do not meet the criteria needed for the Thailand Internship. We are sorry about this! Please feel free to get in touch with us if you feel that this is a mistake or you\'d like to look at other options.</p>' + html_callback_internships + html_txt + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                } else if (total >= 6) {
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col"><p>Congratulations it looks like you meet all of the requirements for our teaching in Thailand Internship. A member of our sales team will give you a call within the next two working days to go through the program in more depth.</p>' + html_txt + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                }
            }, 200);
        }
    }, false);

    $(document).on('keyup change', 'input[name="your-name"], input[name="last-name"], input[name="your-email"], input[name="phone"]', function(e) {
        if (($('input[name="your-name"]').val().length !== 0) && ($('input[name="last-name"]').val().length !== 0) && ($('input[name="your-email"]').val().length !== 0) && ($('input[name="phone"]').val().length !== 0) ) {
            $('.name-ok-btn').attr('style', 'display:inline-block;');
            if (e.keyCode === 13) {
                $(".name-ok-btn").click();
            }
        } else {
            $('.name-ok-btn').attr('style', hide_common_style);
        }
    })

    // $(document).on('keyup change', 'input[name="your-email"]', function(e) {
    //     if ($('input[name="your-email"]').val().length !== 0) {
    //         $('.email-ok-btn').attr('style', 'display:inline-block;');
    //         if (e.keyCode === 13) {
    //             $(".email-ok-btn").click();
    //         }
    //     } else {
    //         $('.email-ok-btn').attr('style', hide_common_style);
    //     }
    // })

    /*$(document).on('keyup', 'input[name="phone-cf7it-national"]', function(e){
    	if (event.keyCode === 13) {
	        $(".phone-ok-btn").click();
	    }
	})*/

    // $(document).on('keyup change', 'input[name="phoneNumber"]', function(e) {
    //     if ($('input[name="phoneNumber"]').val().length >= 10 && $('input[name="phone"]').val().length <= 15) {
    //         $('.phone-ok-btn').attr('style', 'display:inline-block;');
    //         if (e.keyCode === 13) {
    //             $(".phone-ok-btn").click();
    //         }
    //     } else {
    //         $('.phone-ok-btn').attr('style', hide_common_style);
    //     }
    // })
    $(document).on('keyup change', 'input[name="phoneNumber"]', function(e){
	    if ($(this).val().length !== 0) {
	    	$('.phone-ok-btn').attr('style', 'display:inline-block;');
	    	if (event.keyCode === 13) {
		        $(".phone-ok-btn").click();
		    }
	    }else{
	    	$('.phone-ok-btn').attr('style', hide_common_style);
	    }
	})

    // var cc = tefl_obj.ti_country_code;
    // cc = cc.toLowerCase();
    // console.log(cc);

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

})