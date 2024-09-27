jQuery(document).ready(function ($) {
    let quizContainer = $('.multistep-elt');
    let currentStep = 0;

    if (matchMedia('(min-width: 768px)').matches) {
        let questionContainer = $('.step-question-container');
        questionContainer.each(function () {
            let image = $(this).parent().prev().find('.step-image');
            image.height($(this).height());
        });
    }

    $('.start-quiz').click(function (e) {
        e.preventDefault();
        let formFieldsContainer = $('.form-fields-container');
        let inputs = formFieldsContainer.find('.wpcf7-form-control').not('.wpcf7-dynamichidden,.wpcf7-acceptance,.wpcf7-checkbox,.wpcf7-hidden');
        let allInputsFilled = true;
        console.log(inputs);
        inputs.each(function () {
            console.log('VAL-',$(this).val());
            if ($(this).val() == '') {
                allInputsFilled = false;
                return false;
            }
        });
        if (allInputsFilled) {
            formFieldsContainer.slideUp();
            $('#stepZero').removeClass('is-hidden');
        } else {
            if (!$('.required-message').length) {
                $('#startQuiz').after('<p class="required-message">Please fill out all the fields before continuing</p>');
            }
        }
    });

    // remove error message when any of the inputs are filled
    $('.form-fields-container').on('input', '.wpcf7-form-control', function () {
        if ($('.required-message').length && $(this).val() != '') {
            $('.required-message').remove();
        }
    });



    function fillInBlanks(optionValues, questionElementBlanks) {
        questionElementBlanks.each(function (index) {
            $(this).addClass('filled');
            if (optionValues[index].trim() === '-') {
                $(this).text('');
            } else {
                $(this).text(optionValues[index].trim());
            }
        });
    }

    $('.option-control').click(function () {
        let questionElement = $(this).closest('.step-question');
        let questionElementBlanks = questionElement.find('.selected-option');
        questionElement.find('.required-message').remove();
        if ($(this).data('type') == 'fill-in-the-blanks') {
            let optionValue = $(this).val().replace(/-/g, ' ');
            fillInBlanks([optionValue], questionElementBlanks);
        }
        else if ($(this).data('type') == 'double-fill-in-the-blanks') {
            let optionValues = $(this).data('value').split(',');
            fillInBlanks(optionValues, questionElementBlanks);
        }
    });


    // Handling navigation

    function navigate(direction) {
        quizContainer.find('.step-' + currentStep).addClass('is-hidden');
        if (direction === 'next') {
            currentStep++;
        } else if (direction === 'prev') {
            currentStep--;
        }
        else if (direction === 'submit') {
            // $('.callback_submit').removeClass('is-hidden');
            currentStep++;
            calculateScore(quizContainer, currentStep);
            $('.quiz-submit').click();
        }
        quizContainer.find('.step-' + currentStep).removeClass('is-hidden');
    }


    function calculateScore(quizContainer, currentStep) {
        let questions = quizContainer.find('.step-question__options');
        let score = 0;
        let correctAnswers = [1, 3, 4, 4, 3, 2, 3, 2, 4, 4, 1]; // array of correct answers
        questions.each(function (index) {
            let options = $(this).find('.option-control');
            options.each(function (optionIndex) {
                if ($(this).prop('checked') && optionIndex + 1 === correctAnswers[index]) {
                    score += 1;
                }
            });
        });
        quizContainer.find('.step-' + currentStep).removeClass('is-hidden');
        $('#quizScore').val(score);
        showResults(score);
    }



    function showResults(score) {
        let resultsTitle = '';
        let coursesSuggestions = '';
        if (score >= 8) {
            resultsTitle = `Congratulations, you have scored proficiently on this test.</br>Well done! You scored: ${score}/11`;
            coursesSuggestions = `You have excellent English language abilities, which is why we believe the best course for your core TEFL training is our government-regulated <a href="https://teflinstitute.com/course/ofqual-level-5-tefl-course-government-regulated/">180 Hour Level 5 TEFL Diploma</a>.<div class="separator"></div>
            If you want to earn the best salary then upgrade your training and be the best that you can be with our <a href="https://teflinstitute.com/course/tefl-diploma-ofqual-government-regulated-tefl-institute/">300 Hour Level 5 TEFL Diploma</a>.<div class="separator"></div>
            Enroll in our new <a href="https://teflinstitute.com/course/310-hour-level-5-hybrid-tefl-course/">310 Hour Hybrid Level 5 TEFL Diploma</a> that includes teaching practice done via our virtual classroom! This is the most comprehensive government-regulated TEFL course on the market. By completing all modules within our 310-hour TEFL Course you will stand out in your future career as a TEFL teacher.
            <div class="separator"></div>
            Now is the time to take the course and plan a career change to get the job of your dreams. Our courses are self-study, meaning you can get it done as quickly as you like with 24/7 access to your online course. You can now request a <a href="https://teflinstitute.com/callback/">free callback</a> to chat with one of our course enrolment advisors.`
        }
        else if (score >= 5 && score <= 7) {
            resultsTitle = `Congratulations, you have scored well on this test.</br>You scored: ${score}/11`;
            coursesSuggestions = `You have a good level of English language. We believe the best course for your primary TEFL training is <a href="https://teflinstitute.com/course/120-hour-advanced-tefl-course/">our 120 Hour Advanced TEFL Course</a>.<div class="separator"></div>
            Upgrade your training and be the best that you can be with <a href="https://teflinstitute.com/course/240-hour-master-tefl-course/">our 240 Hour Master TEFL Course</a>.<div class="separator"></div> 
            Now is the time to take the course and plan a career change to get the job of your dreams. Our courses are self-study, meaning you can get it done as quickly as you like with 24/7 access to your online course. You can now request a <a href="https://teflinstitute.com/callback/">free callback</a> to chat with one of our course enrolment advisors.`;
        }
        else {
            resultsTitle = `You've got room for improvement!</br>You scored: ${score}/11`;
            coursesSuggestions = `You have solid English language competency, with room for improvements.<div class="separator"></div>
            Boost your English level by finding ways to use your English skills, such as in social groups, through work, music or Netflix shows in English. In no time you’ll feel confident to enroll on the <a href="https://teflinstitute.com/course/120-hour-advanced-tefl-course/">our 120 Hour Advanced TEFL Course</a>, from our accredited fast-track range.
            <div class="separator"></div>
            Now is the time to take the course and plan a career change to get the job of your dreams. Our courses are self-study, meaning you can get it done as quickly as you like with 24/7 access to your online course. You can now request a <a href="https://teflinstitute.com/callback/">free callback</a> to chat with one of our course enrolment advisors.`;
        }
        $('.result-title').html(resultsTitle);
        $('.courses-suggestions').html(coursesSuggestions);
    }


    function optionIsSelected(questionElement, direction) {
        if (questionElement.length === 0 || direction === 'prev') {
            return true;
        }
        let options = questionElement.find('.option-control');
        let optionSelected = false;
        options.each(function () {
            if ($(this).is(':checked')) {
                optionSelected = true;
                return false;
            }
        });
        return optionSelected;
    }

    $('.step-navigation__btn').click(function (e) {
        e.preventDefault();
        let direction = $(this).data('direction');
        let questionElement = $(this).parent().siblings('.step-question');
        if (optionIsSelected(questionElement, direction)) {
            navigate(direction);
        } else {
            if (!questionElement.find('.required-message').length) {
                questionElement.append('<p class="required-message">Please select an option before proceeding</p>');
            }
        }
    });



    $('.elt-content_btn').click(function () {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $(".woocommerce-checkout").offset().top - 200
        }, 500);

    });

    $('.english-test-btn').click(function (e) {
        e.preventDefault();
        $('#eltQuiz').removeClass('hidden');
        let target = this.hash;
        let $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top - 100
        }, 900, 'swing', function () {
            // window.location.hash = target;
        });
    })

    // Not used anymore
    $('.english-test-btn--').click(function (event) {
        event.preventDefault();
        $('.english-test-btn').addClass('tefl-hide');
        $('.english-message-wrapper').removeClass('tefl-hide');

        var curr_country = $('body').attr('data-geo_country_code');
        console.log(curr_country);

        const productID = 1788;

        var data = {
            'action': 'pt_add_product_elt',
            'product_id': productID,
        };


        $.post(pt_obj.pt_ajax, data, function (response) {

            var res = JSON.parse(response);

            if (res.status === true) {
                console.log(res.content);

                // window.location.href = "https://tefl.ie/checkout";
                $('body').addClass('elt-product-added');
                $('body').trigger('update_checkout');
                $('input[name=_mc4wp_subscribe_woocommerce]').trigger('click');
                $('.english-message-wrapper').addClass('tefl-hide');
                $('.elt-button').addClass('tefl-hide');
                $('.checkout-container').removeClass('tefl-hide');

                $('select#billing_country option[value="' + curr_country + '"]').prop('selected', true);

                // $('html, body').animate({
                //     scrollTop: $(window).scrollTop() + 50
                // }, 500, 'linear');

                $('input#date_of_birth').val('1900-01-01');

            } else if (res.status === false) {
                console.log(res.content);
            }
        });

    });

});


jQuery(document).ready(function ($) {

    /* $('html, body').animate({
         scrollTop: $(".woocommerce-checkout").offset().top - 200
     }, 500);*/

    //$('.english-test-btn').trigger('click');


    $("p#account_username_field").hide();

    $(document).on('keyup blur change', 'input#billing_email', function () {
        var emailid = $(this).val();
        console.log(emailid);
        $("input#account_username").val(emailid);

    });

    $(".checkout-disable .elt-button").click(function () {
        $(this).text("Processing..").attr("disabled", "disabled");
    });


    setInterval(function () {
        if ($(".tefl-error-msg").length) {

            $(".checkout-disable .elt-button").text("Get my Free English Test").removeAttr("disabled");
        };
    }, 1000);


    if (!$('body').hasClass('logged-in')) {
        $('#account_username_field label').html('Username <span style="color:red">(lowercase only, no spaces)</span>&nbsp;<abbr class="required" title="required">*</abbr>');

    }

    $('#account_username').after('<p class="uname-error-div"></p>');

    $(document).on('keyup', '#account_username', function (e) {
        e.preventDefault();
        var uname = $(this).val();
        uname = uname.toLowerCase();
        $(this).val(uname);
        var white_space = uname.indexOf(' ') >= 0;
        //console.log(white_space);
        if (white_space === true) {
            $('.uname-error-div').text('Whitespace not allowed');
        } else {
            $('.uname-error-div').text('');
        }
        if ($.trim($('.uname-error-div').text()).length !== 0) {
            $('.checkout-container button.elt-button').attr("disabled", "disabled");
        } else {
            $('.checkout-container button.elt-button').removeAttr("disabled");
        }

    });



    /* EMAIL VALIDATION */
    function validateEmail(emailAddress) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(emailAddress)) {
            return true;
        } else {
            return false;
        }
    }
    /* /EMAIL VALIDATION */


    /* PHONE NUMBER VALIDATION */
    function validatePhone(phoneNumber) {
        var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        if (filter.test(phoneNumber)) {
            return true;
        } else {
            return false;
        }
    }
    /* /PHONE NUMBER VALIDATION */


    /* CHECK IF ALL REQUIRED FIELDS ARE FILLED IN ELT PAGE */
    $(".elt-button").on("click", function () {

        let valFirstName = valLastName = valCountry = valPhone = valEmail = valUsername = valPassword = valUsernameFound = valEmailFound = false;

        //Resetting values
        $(".checkout-tefl-error").addClass("tefl-hide");
        $(".checkout-tefl-error").find(".tefl-error-msg").remove();
        $("form.woocommerce-checkout").find("input").removeClass("tefl-field-error");
        $("form.woocommerce-checkout").find("select").removeClass("tefl-field-error");
        $('<div class="tefl-loader"></div>').insertAfter($('.elt-button'));


        const billing_first_name = $("#billing_first_name").val();
        const billing_last_name = $("#billing_last_name").val();
        const billing_country = $("#billing_country").val();
        const billing_phone = $("#billing_phone").val();
        const billing_email = $("#billing_email").val();
        const account_username = $("#account_username").val();
        const account_password = $("#account_password").val();

        // First Name Validation
        if ($.trim(billing_first_name).length !== 0) {
            valFirstName = true;
        }

        if (!valFirstName) {
            $("#billing_first_name").addClass('tefl-field-error');
        }

        // Last Name Validation
        if ($.trim(billing_last_name).length !== 0) {
            valLastName = true;
        }

        if (!valLastName) {
            $("#billing_last_name").addClass('tefl-field-error');
        }

        // Country Validation
        if ($.trim(billing_country).length !== 0) {
            valCountry = true;
        }

        if (!valCountry) {
            $("#billing_country").addClass('tefl-field-error');
        }

        // Phone Validation
        if (($.trim(billing_phone).length !== 0) && (validatePhone(billing_phone))) {
            valPhone = true;
        }

        if (!valPhone) {
            $("#billing_phone").addClass('tefl-field-error');
        }

        // Email Validation
        if (($.trim(billing_email).length !== 0) && (validateEmail(billing_email))) {
            valEmail = true;
        }

        if (!valEmail) {
            $("#billing_email").addClass('tefl-field-error');
        }

        // Username Validation
        /*if ($.trim(account_username).length !== 0) {
            valUsername = true;
        }

        if (!valUsername && (!$("body").hasClass("logged-in"))) {
            $("#account_username").addClass('tefl-field-error');
        }*/

        // Password Validation
        if ($.trim(account_password).length !== 0) {
            valPassword = true;
        }

        if (!valPassword && (!$("body").hasClass("logged-in"))) {
            $("#account_password").addClass('tefl-field-error');
        }

        if ($("body").hasClass("logged-in")) {
            //valUsername = valPassword = true;
            valPassword = true;
        }

        var data = {
            'action': 'tefl_user_exists',
            'billingEmail': billing_email,
            'accountUsername': account_username
        };

        $.post(pt_obj.pt_ajax, data, function (response) {

            var res = JSON.parse(response);

            if (res.status === true) {
                valUsernameFound = true;
                valEmailFound = true;
                const errorMsg = res.content;
                $(".checkout-tefl-error").append("<div class='tefl-error-msg'>" + errorMsg + "</div>");
            }

            //if (!valFirstName || !valLastName || !valCountry || !valPhone || !valEmail || !valUsername || !valPassword) {
            if (!valFirstName || !valLastName || !valCountry || !valPhone || !valEmail || !valPassword) {

                $(".tefl-loader").remove();

                $(".checkout-tefl-error").append("<div class='tefl-error-msg'>Some fields are missing or invalid.</div>");
                $(".checkout-tefl-error").removeClass("tefl-hide");

                const topBarHeight = $(".top-bar").height();
                const siteHeaderHeight = $(".site-header").height();
                const headerHeight = topBarHeight + siteHeaderHeight + 30;

                $('html,body').animate({
                    scrollTop: $(".checkout-tefl-error").offset().top - headerHeight
                }, 'slow');

                console.log("validation Error");

            } else {

                //if (valUsernameFound && valEmailFound) {
                if (valEmailFound) {

                    $(".tefl-loader").remove();
                    $(".checkout-tefl-error").removeClass("tefl-hide");

                    const topBarHeight = $(".top-bar").height();
                    const siteHeaderHeight = $(".site-header").height();
                    const headerHeight = topBarHeight + siteHeaderHeight + 30;

                    $('html,body').animate({
                        scrollTop: $(".checkout-tefl-error").offset().top - headerHeight
                    }, 'slow');
                    console.log("email already exist");
                } else {
                    console.log("clicked place order button");
                    $(".tefl-loader").remove();
                    $("button#place_order").trigger("click");
                    $(".checkout-container").removeClass("checkout-disable");
                }

            }

        });

    });

    /* /CHECK IF ALL REQUIRED FIELDS ARE FILLED IN ELT PAGE */


});

document.getElementById('acceptance').addEventListener('change', function() {
    var startQuizLink = document.getElementById('startQuiz');
    if (this.checked) {
        startQuizLink.style.display = 'block';
    } else {
        startQuizLink.style.display = 'none';
    }
});