<?php

add_shortcode('tefl_affiliate_area', 'tefl_affiliate_area');
function tefl_affiliate_area()
{
    if (is_admin()) return;

    if (!is_user_logged_in() || affwp_is_affiliate()) {
        return do_shortcode('[affiliate_area]');
    } else {
        wp_enqueue_style('become-an-affiliate-style');
        ob_start();
?>
        <style>
            .post-4 #affwp-register-form {
                display: block !important;
            }
        </style>
        <div class="ast-row">
            <div class="ast-col-md-12 affiliate-login">
                <h3 class="section-heading">CONVERT YOUR EXISTING ACCOUNT TO AN AFFILIATE ACCOUNT</h3>
                <p>Why not make the most of your traffic or network of travel-lovers by promoting one of the strongest brands in the TEFL industry? <br><br>Use any online marketing channel (any place where you have an online voice) to refer customers or students, such as Facebook, Twitter, Instagram, email, blogs, video, student news, eLearning platform. <br><br>Anything you want!</p>
            </div>
        </div>
        <?php echo do_shortcode('[affiliate_registration]'); ?>
    <?php return ob_get_clean();
    }
}


/*TEFL BROCHURE SHORTCODE*/
add_shortcode('tefl_brochure_sc', 'tefl_brochure_sc_fn');
function tefl_brochure_sc_fn()
{
    wp_enqueue_style('ti-form-brochure-css'); ?>
    <section class="tefl-brochure">
        <div class="ast-row tefl-brochure__container">
            <div class="ast-col-md-6 tefl-brochure__image__div">
                <h6 class="tefl-brochure__image__heading">Your First Steps to becoming a Fully Accredited, Internationally Recognised EFL/ESL Teacher within 4 weeks!</h6>
                <div class="tefl-brochure__image">
                    <img src="/wp-content/uploads/2022/03/TEFL-Institute-Brochure-Download-Image-1_No-Shadow-1-min-1.png" alt="">
                </div>
            </div>
            <div class="ast-col-md-6 tef-brochure__content">
                <h6 class="section-heading">WHAT'S INSIDE</h6>
                <p>This comprehensive Study Prospectus will tell you everything you need to know about teaching English as a foreign language – including the full range of training options, TEFL Jobs, and TEFL scholarships available.</p>
                <ul class="tefl-brochure__list">
                    <li class="list-item">Which TEFL Course</li>
                    <li class="list-item">Why a TEFL Internships</li>
                    <li class="list-item">TEFL Scholarships Available</li>
                    <li class="list-item">Best countries for TEFL Jobs</li>
                    <li class="list-item">Career Guidance Centre</li>
                </ul>
                <div class="tefl-brochure__form">
                    <?php echo do_shortcode('[contact-form-7 id="1723" title="TEFL Course Brochure Form"]'); ?>
                </div>
            </div>
        </div>
    </section>
<?php
}

add_shortcode('elt_block', 'elt_block_fn');

function elt_block_fn()
{
    ob_start(); ?>

    <div class="elt-div-outer">
        <a href="/tefl-courses" class="browse-course-btn">Browse tefl courses</a>
        <div class="elt-cta-container">
            <div class="elt-img-div">
                <img src="/wp-content/uploads/2023/01/christin-hume-hBuwVLcYTnA-unsplash.jpg">
            </div>
            <div class="elt-content-div">
                <p class="elt-content-div-title">English Level Test</p>
                <p>Want to find out which online TEFL course is best for you? Take our test today and we’ll match your abilities and goals to your ideal TEFL course. </p>
            </div>
            <div class="elt-btn-div">
                <a class="btn-black" href="/english-level-test/">Take The Test</a>
            </div>
        </div>
    </div>

<?php return ob_get_clean();
}


add_shortcode('salary_calculator_block', 'salary_calculator_block_fn');

function salary_calculator_block_fn()
{
    ob_start(); ?>

    <div class="elt-div-outer">
        <div class="elt-cta-container">
            <div class="elt-img-div">
                <img src="/wp-content/uploads/2021/02/salary-calc-0-min.png">
            </div>
            <div class="elt-content-div">
                <p class="elt-content-div-title">Salary Calculator</p>
                <p>Have you been thinking about teaching English online? Is it worth it? Calculate your potential earnings and discover how much money you can make teaching online</p>
            </div>
            <div class="elt-btn-div">
                <a class="btn-black" href="/teaching-english-online-salary-calculator/">Calculate now </a>
            </div>
        </div>
    </div>

<?php return ob_get_clean();
}


function geo_price($price)
{
    return wc_price($price);
}

// Newsletter popup

add_shortcode('newsletter_popup', 'newsletter_popup_fn');

function newsletter_popup_fn()
{
    if (is_admin()) return;
    ob_start();
?>

    <div class="ast-container">
        <div class="ast-row newsletter-popup-row">
            <div style="background: url(/wp-content/uploads/2022/10/com-course-pages-images.png);background-size: cover;background-position: center;" class="ast-col-md-6 newsletter-popup__image">
                <span>&nbsp;</span>
            </div>
            <div class="ast-col-md-6 newsletter-popup__content">
                <div class="outer-container">
                    <?php echo do_shortcode('[contact-form-7 id="72610" title="Newsletter popup"]'); ?>
                </div>
            </div>
        </div>
    </div>

<?php
    return ob_get_clean();
}


add_shortcode('newsletter_popup_temp', 'newsletter_popup_temp_fn');

function newsletter_popup_temp_fn()
{
    if (is_admin()) return;
    ob_start();
?>

    <div class="ast-container">
        <div class="ast-row newsletter-popup-row">
            <div class="newsletter-popup__content" style="padding:0;border-radius:1.5rem">
                <div class="outer-container">
                    <a href="/online-tefl-course-sale/">
                        <img src="/wp-content/uploads/2023/07/com-4th-july-sale-ending-1080-×-1080-px-1080-×-726-px-2-1.png" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php
    return ob_get_clean();
}
// ELT Custom Quiz

add_shortcode('custom_quiz', 'custom_quiz_shortcode');

function custom_quiz_shortcode()
{
    ob_start();
?>
    <div class="multistep-elt">
        <div id="stepZero" class="ast-row step-0 step is-hidden">
            <div class="ast-col-md-12 text-center">
                <h2 class="quiz-title text-bold">
                    Do you think your English is good enough for a job in TEFL?
                </h2>
                <div class="quiz-details">
                    <p>Let’s help you find out!</p>
                    <p>This test consists of 11 questions, with only one correct answer to each question.</p>
                    <p>When you finish you’ll receive a personal recommendation describing which TEFL course suits your language level and ability.</p>
                    <p>PS. The only requirement to take a TEFL Institute course is a good level of English and a desire to teach it.</p>
                    <p>Ready?</p>
                </div>
                <div class="start-quiz-cta">
                    <a href="#" data-direction="next" class="step-navigation__btn start-quiz-btn">Start Test</a>
                </div>
            </div>
        </div>
        <div id="stepOne" class="ast-row step-1 step is-hidden">
            <div class="ast-col-md-6">
                <img src="/wp-content/uploads/2023/01/1.png" alt="" class="step-image">
            </div>
            <div class="ast-col-md-6">
                <div class="step-question-container">
                    <h2 class="step-question-header">
                        Choose the answer that correctly completes the sentence*
                    </h2>
                    <div class="step-question">
                        <h4 class="step-question__question">
                            When we arrived at the cinema, the movie <span class="selected-option">______</span>
                        </h4>
                        <div class="step-question__options">
                            <div class="radio-button option">
                                <input type="radio" id="question-one-option-1" name="question-one" data-option="option 1" value="had-already-started" data-type="fill-in-the-blanks" class="option-control">
                                <label for="question-one-option-1"><span class="label-number">A</span>Had already started</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-one-option-2" name="question-one" data-option="option 2" value="already-starting" data-type="fill-in-the-blanks" class="option-control">
                                <label for="question-one-option-2"><span class="label-number">B</span>Already starting</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-one-option-3" name="question-one" data-option="option 3" value="starts-already" data-type="fill-in-the-blanks" class="option-control">
                                <label for="question-one-option-3"><span class="label-number">C</span>Starts already</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-one-option-4" name="question-one" data-option="option 4" value="have-already-started" data-type="fill-in-the-blanks" class="option-control">
                                <label for="question-one-option-4"><span class="label-number">D</span>Have already started</label>
                            </div>
                        </div>
                    </div>
                    <div class="step-navigation">
                        <a href="#" data-direction="next" class="next-step step-navigation__btn">
                            Next
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div id="stepTwo" class="ast-row step-2 step is-hidden">
            <div class="ast-col-md-6">
                <img src="/wp-content/uploads/2023/01/2.png" alt="" class="step-image">
            </div>
            <div class="ast-col-md-6">
                <div class="step-question-container">
                    <h2 class="step-question-header">
                        Choose the answer that correctly completes the sentence*
                    </h2>
                    <div class="step-question">
                        <h4 class="step-question__question">
                            I eat <span class="selected-option">_______ </span> breakfast every day before I go to <span class="selected-option">_______ </span> school.
                        </h4>
                        <div class="step-question__options">
                            <div class="radio-button option">
                                <input type="radio" id="question-two-option-1" name="question-two" data-option="option 1" data-value="the,-" value="the/-" data-type="double-fill-in-the-blanks" class="option-control ">
                                <label for="question-two-option-1"><span class="label-number">A</span>the / -</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-two-option-2" name="question-two" data-option="option 2" data-value="-,the" value="-/the" data-type="double-fill-in-the-blanks" class="option-control ">
                                <label for="question-two-option-2"><span class="label-number">B</span>- / the</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-two-option-3" name="question-two" data-option="option 3" data-value="-,-" value="-/-" data-type="double-fill-in-the-blanks" class="option-control  ">
                                <label for="question-two-option-3"><span class="label-number">C</span>- / -</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-two-option-4" name="question-two" data-option="option 4" data-value="a,the" value="a/the" data-type="double-fill-in-the-blanks" class="option-control ">
                                <label for="question-two-option-4"><span class="label-number">D</span>a / the</label>
                            </div>
                        </div>
                    </div>
                    <div class="step-navigation">
                        <a href="#" data-direction="prev" class="prev-step step-navigation__btn">
                            Previous
                        </a>
                        <a href="#" data-direction="next" class="next-step step-navigation__btn">
                            Next
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="stepThree" class="ast-row step-3 step is-hidden">
            <div class="ast-col-md-6">
                <img src="/wp-content/uploads/2023/01/3.png" alt="" class="step-image">
            </div>
            <div class="ast-col-md-6">
                <div class="step-question-container">
                    <h2 class="step-question-header">
                        Choose the answer which represents a correct sentence*
                    </h2>
                    <div class="step-question">
                        <div class="step-question__options">
                            <div class="radio-button option">
                                <input type="radio" id="question-three-option-1" name="question-three" data-option="option 1" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-three-option-1">
                                    <span class="label-number">A</span>English increases the chance of unemployed people to find a job or people to be able to study a specific Course at University.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-three-option-2" name="question-three" data-option="option 2" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-three-option-2">
                                    <span class="label-number">B</span>English increases the chance of unemployed people to find job or people to be able to study a specific courses at University.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-three-option-3" name="question-three" data-option="option 3" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-three-option-3">
                                    <span class="label-number">C</span>English increase chance for unemployed people to find job, or for people to be able to study specific course at university.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-three-option-4" name="question-three" data-option="option 4" data-type="choose-correct-answer" class="option-control   ">
                                <label for="question-three-option-4">
                                    <span class="label-number">D</span>English increases the chances for unemployed people to find a job, or for people to be able to study a specific course at university.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="step-navigation">
                        <a href="#" data-direction="prev" class="prev-step step-navigation__btn">
                            Previous
                        </a>
                        <a href="#" data-direction="next" class="next-step step-navigation__btn">
                            Next
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="stepFour" class="ast-row step-4 step is-hidden">
            <div class="ast-col-md-6">
                <img src="/wp-content/uploads/2023/01/4.png" alt="" class="step-image">
            </div>
            <div class="ast-col-md-6">
                <div class="step-question-container">
                    <h2 class="step-question-header">
                        Choose the most comprehensive answer which has no errors.*
                    </h2>
                    <div class="step-question">
                        <div class="step-question__options">
                            <div class="radio-button option">
                                <input type="radio" id="question-four-option-1" name="question-four" data-option="option 1" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-four-option-1">
                                    <span class="label-number">A</span>I go to the supermarket at the weekend.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-four-option-2" name="question-four" data-option="option 2" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-four-option-2">
                                    <span class="label-number">B</span>I go to the supermarket on the weekend.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-four-option-3" name="question-four" data-option="option 3" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-four-option-3">
                                    <span class="label-number">C</span>I go to supermarket at the weekend. (British English) I go to supermarket on the weekend. (American English)
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-four-option-4" name="question-four" data-option="option 4" data-type="choose-correct-answer" class="option-control  ">
                                <label for="question-four-option-4">
                                    <span class="label-number">D</span>I go to the supermarket at the weekend. (British English) I go to the supermarket on the weekend. (American English).
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="step-navigation">
                        <a href="#" data-direction="prev" class="prev-step step-navigation__btn">
                            Previous
                        </a>
                        <a href="#" data-direction="next" class="next-step step-navigation__btn">
                            Next
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="stepFive" class="ast-row step-5 step is-hidden">
            <div class="ast-col-md-6">
                <img src="/wp-content/uploads/2023/01/5.png" alt="" class="step-image">
            </div>
            <div class="ast-col-md-6">
                <div class="step-question-container">
                    <h2 class="step-question-header">
                        Choose the answer that correctly completes the sentence*
                    </h2>
                    <div class="step-question">
                        <h4 class="step-question__question">
                            Not only had they never been to the USA before, they <span class="selected-option">______ ______</span> even left their home country.
                        </h4>
                        <div class="step-question__options">
                            <div class="radio-button option">
                                <input type="radio" id="question-five-option-1" name="question-five" value="have-never" data-option="option 1" data-type="fill-in-the-blanks" class="option-control ">
                                <label for="question-five-option-1"><span class="label-number">A</span>have never</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-five-option-2" name="question-five" value="will-not" data-option="option 2" data-type="fill-in-the-blanks" class="option-control ">
                                <label for="question-five-option-2"><span class="label-number">B</span>will not</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-five-option-3" name="question-five" value="had-never" data-option="option 3" data-type="fill-in-the-blanks" class="option-control  ">
                                <label for="question-five-option-3"><span class="label-number">C</span>had never</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-five-option-4" name="question-five" value="did-not" data-option="option 4" data-type="fill-in-the-blanks" class="option-control ">
                                <label for="question-five-option-4"><span class="label-number">D</span>did not</label>
                            </div>
                        </div>
                    </div>
                    <div class="step-navigation">
                        <a href="#" data-direction="prev" class="prev-step step-navigation__btn">
                            Previous
                        </a>
                        <a href="#" data-direction="next" class="next-step step-navigation__btn">
                            Next
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="stepSix" class="ast-row step-6 step is-hidden">
            <div class="ast-col-md-6">
                <img src="/wp-content/uploads/2023/01/6.png" alt="" class="step-image">
            </div>
            <div class="ast-col-md-6">
                <div class="step-question-container">
                    <h2 class="step-question-header">
                        Choose the answer that correctly completes the sentence*
                    </h2>
                    <div class="step-question">
                        <h4 class="step-question__question">
                            If I could travel anywhere in the world, I <span class="selected-option">______</span> travel to Thailand.
                        </h4>
                        <div class="step-question__options">
                            <div class="radio-button option">
                                <input type="radio" id="question-six-option-1" name="question-six" value="could" data-option="option 1" data-type="fill-in-the-blanks" class="option-control ">
                                <label for="question-six-option-1"><span class="label-number">A</span>could</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-six-option-2" name="question-six" value="would" data-option="option 2" data-type="fill-in-the-blanks" class="option-control  ">
                                <label for="question-six-option-2"><span class="label-number">B</span>would</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-six-option-3" name="question-six" value="should" data-option="option 3" data-type="fill-in-the-blanks" class="option-control ">
                                <label for="question-six-option-3"><span class="label-number">C</span>should</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-six-option-4" name="question-six" value="might" data-option="option 4" data-type="fill-in-the-blanks" class="option-control ">
                                <label for="question-six-option-4"><span class="label-number">D</span>might</label>
                            </div>
                        </div>
                    </div>
                    <div class="step-navigation">
                        <a href="#" data-direction="prev" class="prev-step step-navigation__btn">
                            Previous
                        </a>
                        <a href="#" data-direction="next" class="next-step step-navigation__btn">
                            Next
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="stepSeven" class="ast-row step-7 step is-hidden">
            <div class="ast-col-md-6">
                <img src="/wp-content/uploads/2023/01/7.png" alt="" class="step-image">
            </div>
            <div class="ast-col-md-6">
                <div class="step-question-container">
                    <h2 class="step-question-header">
                        Choose the correct answer.*
                    </h2>
                    <div class="step-question">
                        <div class="step-question__options">
                            <div class="radio-button option">
                                <input type="radio" id="question-seven-option-1" name="question-seven" data-option="option 1" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-seven-option-1">
                                    <span class="label-number">A</span>Establishing for each student a profile with their learning style (auditory, visual or kinaesthetic) to determine how to focus according to style the lessons which might help the students most.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-seven-option-2" name="question-seven" data-option="option 2" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-seven-option-2">
                                    <span class="label-number">B</span>Establish for each student a profile with their learning style auditory, visual or kinaesthetic to determine how to focus according to style the lessons which might help the students most.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-seven-option-3" name="question-seven" data-option="option 3" data-type="choose-correct-answer" class="option-control  ">
                                <label for="question-seven-option-3">
                                    <span class="label-number">C</span>Establish a profile of learning styles for each student (auditory, visual or kinaesthetic) to determine how to focus your lessons according to which style might help the students most.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-seven-option-4" name="question-seven" data-option="option 4" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-seven-option-4">
                                    <span class="label-number">D</span>Establishing a profile of learning styles for each student (auditory, visual or kinaesthetic) to determine how to focusing your lessons according to which style might help the students most.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="step-navigation">
                        <a href="#" data-direction="prev" class="prev-step step-navigation__btn">
                            Previous
                        </a>
                        <a href="#" data-direction="next" class="next-step step-navigation__btn">
                            Next
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="stepEight" class="ast-row step-8 step is-hidden">
            <div class="ast-col-md-6">
                <img src="/wp-content/uploads/2023/01/8.png" alt="" class="step-image">
            </div>
            <div class="ast-col-md-6">
                <div class="step-question-container">
                    <h2 class="step-question-header">
                        Choose the correct missing word.*
                    </h2>
                    <div class="step-question">
                        <h4 class="step-question__question">
                            I <span class="selected-option">_______</span> you that the work will be submitted by Friday.
                        </h4>
                        <div class="step-question__options">
                            <div class="radio-button option">
                                <input type="radio" id="question-eight-option-1" name="question-eight" value="confirm" data-option="option 1" data-type="fill-in-the-blanks" class="option-control ">
                                <label for="question-eight-option-1"><span class="label-number">A</span>confirm</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-eight-option-2" name="question-eight" value="assure" data-option="option 2" data-type="fill-in-the-blanks" class="option-control  ">
                                <label for="question-eight-option-2"><span class="label-number">B</span>assure</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-eight-option-3" name="question-eight" value="insist" data-option="option 3" data-type="fill-in-the-blanks" class="option-control ">
                                <label for="question-eight-option-3"><span class="label-number">C</span>insist</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-eight-option-4" name="question-eight" value="sure" data-option="option 4" data-type="fill-in-the-blanks" class="option-control ">
                                <label for="question-eight-option-4"><span class="label-number">D</span>sure</label>
                            </div>
                        </div>
                    </div>
                    <div class="step-navigation">
                        <a href="#" data-direction="prev" class="prev-step step-navigation__btn">
                            Previous
                        </a>
                        <a href="#" data-direction="next" class="next-step step-navigation__btn">
                            Next
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="stepNine" class="ast-row step-9 step is-hidden">
            <div class="ast-col-md-6">
                <img src="/wp-content/uploads/2023/01/9.png" alt="" class="step-image">
            </div>
            <div class="ast-col-md-6">
                <div class="step-question-container">
                    <h2 class="step-question-header">
                        Choose the correct missing word.*
                    </h2>
                    <div class="step-question">
                        <h4 class="step-question__question">
                            I am hoping to finish my course <span class="selected-option">_______</span> next week
                        </h4>
                        <div class="step-question__options">
                            <div class="radio-button option">
                                <input type="radio" id="question-nine-option-1" name="question-nine" value="on" data-option="option 1" data-type="fill-in-the-blanks" class="option-control ">
                                <label for="question-nine-option-1"><span class="label-number">A</span>on</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-nine-option-2" name="question-nine" value="since" data-option="option 2" data-type="fill-in-the-blanks" class="option-control  ">
                                <label for="question-nine-option-2"><span class="label-number">B</span>since</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-nine-option-3" name="question-nine" value="under" data-option="option 3" data-type="fill-in-the-blanks" class="option-control ">
                                <label for="question-nine-option-3"><span class="label-number">C</span>under</label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-nine-option-4" name="question-nine" value="before" data-option="option 4" data-type="fill-in-the-blanks" class="option-control  ">
                                <label for="question-nine-option-4"><span class="label-number">D</span>before</label>
                            </div>
                        </div>
                    </div>
                    <div class="step-navigation">
                        <a href="#" data-direction="prev" class="prev-step step-navigation__btn">
                            Previous
                        </a>
                        <a href="#" data-direction="next" class="next-step step-navigation__btn">
                            Next
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="stepTen" class="ast-row step-10 step is-hidden">
            <div class="ast-col-md-6">
                <img src="/wp-content/uploads/2023/01/10.png" alt="" class="step-image">
            </div>
            <div class="ast-col-md-6">
                <div class="step-question-container">
                    <h2 class="step-question-header">
                        Which of the following is correct?*
                    </h2>
                    <div class="step-question">
                        <div class="step-question__options">
                            <div class="radio-button option">
                                <input type="radio" id="question-ten-option-1" name="question-ten" data-option="option 1" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-ten-option-1">
                                    <span class="label-number">A</span>The music is too loud. Please it turn down.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-ten-option-2" name="question-ten" data-option="option 2" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-ten-option-2">
                                    <span class="label-number">B</span>The music is too loud. Please turn it up.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-ten-option-3" name="question-ten" data-option="option 3" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-ten-option-3">
                                    <span class="label-number">C</span>The music is too loud. Please turn down it.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-ten-option-4" name="question-ten" data-option="option 4" data-type="choose-correct-answer" class="option-control  ">
                                <label for="question-ten-option-4">
                                    <span class="label-number">D</span>The music is too loud. Please turn it down.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="step-navigation">
                        <a href="#" data-direction="prev" class="prev-step step-navigation__btn">
                            Previous
                        </a>
                        <a href="#" data-direction="next" class="next-step step-navigation__btn">
                            Next
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="stepEleven" class="ast-row step-11 step is-hidden">
            <div class="ast-col-md-6">
                <img src="/wp-content/uploads/2023/01/11.png" alt="" class="step-image">
            </div>
            <div class="ast-col-md-6">
                <div class="step-question-container">
                    <h2 class="step-question-header">
                        Choose the option that best describes the requirements of the following question:*
                    </h2>
                    <div class="step-question">
                        <h4 class="step-question__question">
                            Explain the use of standard English punctuation. Explain and describe the purpose of four commonly used punctuation marks.
                        </h4>
                        <div class="step-question__options">
                            <div class="radio-button option">
                                <input type="radio" id="question-eleven-option-1" name="question-eleven" data-option="option 1" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-eleven-option-1">
                                    <span class="label-number">A</span>Speak about the overall use of punctuation then name four types of punctuation and briefly explain their functions.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-eleven-option-2" name="question-eleven" data-option="option 2" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-eleven-option-2">
                                    <span class="label-number">B</span>Name four types of punctuation and briefly explain their functions.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-eleven-option-3" name="question-eleven" data-option="option 3" data-type="choose-correct-answer" class="option-control ">
                                <label for="question-eleven-option-3">
                                    <span class="label-number">C</span>Speak about the overall use of punctuation with no examples.
                                </label>
                            </div>
                            <div class="radio-button option">
                                <input type="radio" id="question-eleven-option-4" name="question-eleven" data-option="option 4" data-type="choose-correct-answer" class="option-control  ">
                                <label for="question-eleven-option-4">
                                    <span class="label-number">D</span>Write an example phrase with perfect punctuation.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="step-navigation">
                        <a href="#" data-direction="prev" class="prev-step step-navigation__btn">
                            Previous
                        </a>
                        <a href="#" data-direction="submit" class="submit-step step-navigation__btn">
                            Finish Quiz
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="stepTwelve" class="ast-row step-12 step is-hidden">
            <div class="ast-col-md-12 text-center">
                <h2 class="result-title text-bold">

                </h2>
                <div class="courses-suggestions">

                </div>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}

function show_geo_price_fn($args)
{
    $price = $args['price'];
    return geo_price($price);
}
add_shortcode('show_geo_price', 'show_geo_price_fn');


/*
Shortcode for retrievng internship country
*/

add_shortcode('internship_country', 'internship_country_fn');

// Define the shortcode handler function
function internship_country_fn($atts)
{
    global $post;
    $postID = $post->ID;

    $internship_country = get_post_meta($postID, 'country_name');
?>
    <input style="display:none" name="country-name" type="text" value="<?php echo $internship_country[0] ?>"></span>
<?php
}

/*
Shortcode for internship guide popups
*/

add_shortcode('internship_guide_popup', 'internship_guide_popup_fn');

function internship_guide_popup_fn()
{
    ob_start();
    $guide_popup = get_field('guide_popup');
    if (!$guide_popup) return '';
    $guide_popup_image = $guide_popup['popup_image'];
    $guide_popup_url = $guide_popup['popup_url'];
?>
    <div class="guide-popup__container">
        <a href="<?php echo $guide_popup_url ?>" target="_blank" class="clickbox"></a>
        <img src="<?php echo $guide_popup_image ?>" alt="">
    </div>
    <style>
        .boxzilla-center-container .boxzilla-internship-guide-popup {
            padding: 0 !important;
            width: auto !important;
            height: auto !important;
            border: none !important;
        }

        @media screen and (min-width:768px) {
            .guide-popup__container {
                width: 400px;
            }
        }

        .guide-popup__container img {
            height: 400px;
            object-fit: contain;
        }

        .boxzilla-internship-guide-popup .boxzilla-close-icon {
            z-index: 2;
        }
    </style>
<?php
    return ob_get_clean();
}


// Shortcode for popup with clockdown

add_shortcode('popup_with_clockdown', 'popup_with_clockdown_fn');
function popup_with_clockdown_fn()
{
    ob_start();
    $expiry_date = get_field('black_friday_sale_discount_timer', 'option');
?>
    <div class="roadrunner-popup-container">
        <a href="/" target="_blank" class="clickbox"></a>
        <img src="/wp-content/uploads/2023/11/10_off_TI_2_Cyber_3.gif" alt="">
        <div class="tefl_countdown_timer  tefl_countdown_timer-wrapper">
            <?php echo clockdown_function($expiry_date); ?>
        </div>
    </div>
    <style>
        .boxzilla-center-container .boxzilla-black-friday-popup-with-clockdown {
            padding: 0 !important;
            width: auto !important;
            height: auto !important;
            border: none !important;
        }

        @media screen and (min-width:768px) {
            .roadrunner-popup-container {
                width: 600px;
            }
        }

        .roadrunner-popup-container img {
            height: 600px;
            object-fit: contain;
        }

        .boxzilla-black-friday-popup-with-clockdown .clock>div {
            position: relative;
        }

        .boxzilla-black-friday-popup-with-clockdown .clock>div:before {
            color: var(--white);
            position: absolute;
            bottom: -20px;
            z-index: 9;
            left: 50%;
            transform: translateX(-50%);
            font-size: 12px;
            font-weight: 500;
        }

        .tefl_countdown_timer.tefl_countdown_timer-wrapper::after {
            content: "remaining";
            color: var(--white);
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translate(-60%, 0);
        }

        .boxzilla-black-friday-popup-with-clockdown .clock-day:before {
            content: "days";
        }

        .boxzilla-black-friday-popup-with-clockdown .clock-hour:before {
            content: "hrs";
        }

        .boxzilla-black-friday-popup-with-clockdown .clock-min:before {
            content: "mins";
        }

        .boxzilla-black-friday-popup-with-clockdown .clock-sec:before {
            content: "secs";
        }

        .boxzilla-black-friday-popup-with-clockdown .boxzilla-close-icon {
            z-index: 2;
        }

        .tefl_countdown_timer {
            display: none;
            position: absolute;
            bottom: 35%;
            left: 50%;
            transform: translateX(-65%);
        }
    </style>
    <script>
        jQuery(document).ready(function($) {
            Boxzilla.on('box.show', function(box) {
                setTimeout(function() {
                    $(".tefl_countdown_timer").fadeIn();
                }, 2000);
            });
        });
    </script>
<?php
    return ob_get_clean();
}
