jQuery(document).ready(function ($) {
    var show_common_style = 'display:flex;';
    var hide_common_style = 'display:none;';
  
    $('.salary-calculator-form .wpcf7-submit').attr('disabled', 'disabled');
    $(document).on('click', '.get-started-btn', function (e) {
        e.preventDefault();
        $('.name-div').attr('style', show_common_style);
        $('.info-text').attr('style', hide_common_style);
    })

    $(document).on('click', '.name-ok-btn', function (e) {
        e.preventDefault();
        $('.email-div').attr('style', show_common_style);
        $('.name-div').attr('style', hide_common_style);
    })

    $(document).on('click', '.email-ok-btn', function (e) {
        e.preventDefault();
        $('.phone-div').attr('style', show_common_style);
        $('.email-div').attr('style', hide_common_style);
    })

    $(document).on('click', '.phone-ok-btn', function (e) {
        e.preventDefault();
        $('.education-div').attr('style', show_common_style);
        $('.phone-div').attr('style', hide_common_style);
    })

    $(document).on('click', 'input[name="education"]', function (e) {
        if ($('input[name="education"]').is(':checked')) {
            //var tefl_qualification = $('input[name="tefl-qualification"]:checked').val();
            $('.education .wpcf7-list-item').removeClass('checked');
            $(this).parent().parent().addClass('checked');
            setTimeout(function () {
                $('.passport-div').attr('style', show_common_style);
                $('.education-div').attr('style', hide_common_style);
            }, 1000);
        }
    })

    $(document).on('click', 'input[name="passport"]', function (e) {
        if ($('input[name="passport"]').is(':checked')) {
            //var level_of_education = $('input[name="level-of-education"]:checked').val();
            $('.passport .wpcf7-list-item').removeClass('checked');
            $(this).parent().parent().addClass('checked');
            setTimeout(function () {
                $('.age-div').attr('style', show_common_style);
                $('.passport-div').attr('style', hide_common_style);
            }, 1000);
        }
    })

    $(document).on('click', 'input[name="age"]', function (e) {
        if ($('input[name="age"]').is(':checked')) {
            //var passport_country = $('input[name="passport-country]:checked').val();
            $('.age .wpcf7-list-item').removeClass('checked');
            $(this).parent().parent().addClass('checked');
            setTimeout(function () {
                $('.experience-div').attr('style', show_common_style);
                $('.age-div').attr('style', hide_common_style);
            }, 1000);
        }
    })

    $(document).on('click', 'input[name="experience"]', function (e) {
        if ($('input[name="experience"]').is(':checked')) {
            //var tefl_experience = $('input[name="tefl-experience]:checked').val();
            $('.experience .wpcf7-list-item').removeClass('checked');
            $(this).parent().parent().addClass('checked');
            $('.final-submit-div').attr('style', show_common_style);
            $('.wpcf7-submit').removeAttr('disabled');
        }
    })

    document.addEventListener('wpcf7mailsent', function (event) {
        if ('80920' == event.detail.contactFormId) {

            var inputs = event.detail.inputs;
            console.log(inputs);

            for (var i = 0; i < inputs.length; i++) {
                if ('education' == inputs[i].name) {
                    if (inputs[i].value === 'Masters\'s Degree') {
                        var tefl_education = 'A';
                    } else if (inputs[i].value === 'Bachelor\'s Degree') {
                        var tefl_education = 'A';
                    } else if (inputs[i].value === 'High school equivalent') {
                        var tefl_education = 'B';
                    }
                }
                if ('passport' == inputs[i].name) {
                    if (inputs[i].value === 'Ireland, Canada, USA, United Kingdom, South Africa, Australia or New Zealand') {
                        var tefl_passport = 'C';
                    } else if (inputs[i].value === 'Other (where English is the primary language)') {
                        var tefl_passport = 'D';
                    } else if (inputs[i].value === 'Other (Where English is not the primary language)') {
                        var tefl_passport = 'D';
                    }
                }
                if ('age' == inputs[i].name) {
                    if (inputs[i].value === 'Adults') {
                        var tefl_age = 'E';
                    } else if (inputs[i].value === 'Teenagers') {
                        var tefl_age = 'E';
                    } else if (inputs[i].value === 'Children') {
                        var tefl_age = 'F';
                    } else if (inputs[i].value === 'None Yet') {
                        var tefl_age = 'E';
                    }
                }
                if ('experience' == inputs[i].name) {
                    if (inputs[i].value === 'Over 2 years') {
                        var tefl_experience = 'G';
                    } else if (inputs[i].value === '1-2 years') {
                        var tefl_experience = 'G';
                    } else if (inputs[i].value === 'Under 1 year') {
                        var tefl_experience = 'H';
                    }
                }
            }

            var total = tefl_education + tefl_passport + tefl_age + tefl_experience;
            //console.log(total);
            $('.salary-calculator-form .wpcf7-response-output').attr('total', total);
            $('.salary-calculator-form .wpcf7-response-output').addClass('ast-row');
            $('.experience-div, .final-submit-div').attr('style', 'display:none;');
            var html_prev_text = '<div class="ast-col-md-6 ast-col-sm-12 img-col"><img src="https://tefl.ie/wp-content/uploads/2023/08/1.png" alt="Salary Calculator Image"></div>';
            
          	var html_top = '<div class="html_top">From what you have selected, here are your results. Here are the perfect teaching English online platforms for you.</div>';
          	var html_bottom = '<div class="html_bottom">Check your email inbox for your free Study Prospectus; our 24-page TEFL brochure has everything you need to know to get started as an English teacher.</div>';
          	var html_small = '<div class="html_small">* This is only from what we have found in our own research of some of the most popular online teaching platforms. There might be even more platforms that we haven’t listed above.</div>';

            setTimeout(function () {
                if (total === 'ACEG') {
                  	var html_middle = '<ul><li>Amazingtalker</li><li>Preply</li><li>iTalki</li></ul>';
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col">' + html_top + html_middle + html_bottom + html_small + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                } else if (total === 'ACFG') {
                  	var html_middle = '<ul><li>Lingoda</li><li>Preply</li><li>iTalki</li></ul>';
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col">' + html_top + html_middle + html_bottom + html_small + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                } else if (total === 'ACFG') {
                  	var html_middle = '<ul><li>LingAce</li><li>Cambly Kids</li><li>Novakid</li></ul>';
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col">' + html_top + html_middle + html_bottom + html_small + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                } else if (total === 'ADEG') {
                  	var html_middle = '<ul><li>Fluentbe</li><li>Italki</li><li>Engoo</li></ul>';
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col">' + html_top + html_middle + html_bottom + html_small + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                } else if (total === 'ADEH') {
                  	var html_middle = '<ul><li>Preply</li><li>Italki</li></ul>';
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col">' + html_top + html_middle + html_bottom + html_small + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                } else if (total === 'ADEH') {
                  	var html_middle = '<ul><li>Preply</li><li>Preply</li></ul>';
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col">' + html_top + html_middle + html_bottom + html_small + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                } else if (total === 'BCEG' || total === 'BCEH') {
                  	var html_middle = '<ul><li>Preply</li><li>Cambly</li><li>Palfish</li></ul>';
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col">' + html_top + html_middle + html_bottom + html_small + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                } else if (total === 'BCFG') {
                  	var html_middle = '<ul><li>Cambly</li></ul>';
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col">' + html_top + html_middle + html_bottom + html_small + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                } else if (total === 'BDEG') {
                  	var html_middle = '<ul><li>Learnlight</li><li>Preply</li></ul>';
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col">' + html_top + html_middle + html_bottom + html_small + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                } else if (total === 'ACFH' || total === 'ADFG' || total === 'ADFH' || total === 'BCFH' || total === 'BDEH' || total === 'BDFG' || total === 'BDFH') {
                  	var html_middle = '<div class="html_unfortunately">Unfortunately, there are no Online teaching platforms that are perfect for you. That just means you can start your own Teaching English online business. Watch the video below to find out how.</div>';
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col">' + html_top + html_middle + html_bottom + html_small + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                }
            }, 200);
        }
    }, false);


    $(document).on('keyup change', 'input[name="first-name"], input[name="last-name"]', function (e) {
        if (($('input[name="first-name"]').val().length !== 0) && ($('input[name="last-name"]').val().length !== 0)) {
            $('.name-ok-btn').attr('style', 'display:inline-block;');
            if (e.keyCode === 13) {
                $(".name-ok-btn").click();
            }
        } else {
            $('.name-ok-btn').attr('style', hide_common_style);
        }
    })

    $(document).on('keyup change', 'input[name="your-email"]', function (e) {
        if ($('input[name="your-email"]').val().length !== 0) {
            $('.email-ok-btn').attr('style', 'display:inline-block;');
            if (e.keyCode === 13) {
                $(".email-ok-btn").click();
            }
        } else {
            $('.email-ok-btn').attr('style', hide_common_style);
        }
    })

    $(document).on('keyup change', 'input[name="phone"]', function (e) {
        //if ($('input[name="phone"]').val().length >= 10 && $('input[name="phone"]').val().length <= 15) {
        if ($(this.length)) {
            $('.phone-ok-btn').attr('style', 'display:inline-block;');
            if (e.keyCode === 13) {
                $(".phone-ok-btn").click();
            }
        } else {
            $('.phone-ok-btn').attr('style', hide_common_style);
        }
    })

})