<?php

/**
 * teflinstitute Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package teflinstitute
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_TEFLINSTITUTE_VERSION', '1.0.0');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{

    // wp_dequeue_style( 'astra-theme-css');
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wc-block-vendors-style');
    wp_dequeue_style('wc-block-style');
    wp_enqueue_script('ti-themeservices', get_stylesheet_directory_uri() . '/assets/js/ThemeService.js', array('jquery'), time(), true);
    wp_enqueue_script('ti-cookieservices', get_stylesheet_directory_uri() . '/assets/js/CookieServices.js', array('jquery'), time(), true);
    wp_enqueue_script('ti-exitintent', get_stylesheet_directory_uri() . '/assets/js/ti-exit-intent-popup.js', array('jquery'), time(), true);
    wp_register_style('ti-timer-css', get_stylesheet_directory_uri() . '/assets/css/ti-timer.css', array(), time(), 'all');
    wp_register_script('ti-timer-js', get_stylesheet_directory_uri() . '/assets/js/ti-timer.js', array(), time(), true);
    wp_register_style('ti-header-timer-css', get_stylesheet_directory_uri() . '/assets/css/ti-header-timer.css', array(), time(), 'all');
    wp_enqueue_style('ti-header-timer-css');
    wp_enqueue_script('ti-telInput', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js', array('jquery'), time(), true);
    wp_enqueue_style('ti-telInput', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css', array('astra-theme-css'), time(), 'all');

    wp_enqueue_script('ti-cookie-js', 'https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js', array('jquery'), time(), true);

    wp_enqueue_style('teflinstitute-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_TEFLINSTITUTE_VERSION, 'all');

    wp_enqueue_style('ProximaNova-css', 'https://use.typekit.net/lig2diy.css');
    wp_enqueue_style('fontawesome-css', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    /*if (!is_woocommerce() && !is_checkout() && !is_cart() && !is_account_page()):
    	wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'); 
    	wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js');
    endif;*/
    wp_enqueue_style('ti-color', get_stylesheet_directory_uri() . '/assets/css/ti-color.css', array(), time(), 'all');
    wp_enqueue_style('ti-fonts-css', get_stylesheet_directory_uri() . '/assets/css/ti-font.css', array(), time(), null);
    wp_enqueue_style('ti-global-css', get_stylesheet_directory_uri() . '/assets/css/ti-global.css', array(), time(), null);
    wp_enqueue_style('ti-header-css', get_stylesheet_directory_uri() . '/assets/css/header.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/header.css'), 'all');
    wp_enqueue_script('ti-global-js', get_stylesheet_directory_uri() . '/assets/js/ti-global.js', array('jquery'), time(), true);

    /*Light Slider*/
    wp_enqueue_style('lightslider-css', get_stylesheet_directory_uri() . '/assets/css/lightslider.css', array(), time(), null);
    wp_enqueue_script('lightslider-js', get_stylesheet_directory_uri() . '/assets/js/lightslider.js', array('jquery'), time(), true);
    wp_enqueue_script('glide-js', 'https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/glide.min.js', array('jquery'), time(), true);
    wp_enqueue_style('glide-core', 'https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/css/glide.core.min.css', array(), time(), null);
    wp_enqueue_style('glide-theme', 'https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/css/glide.theme.min.css', array(), time(), null);
    // Lity Lightbox
    wp_enqueue_style('lity-css', 'https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css', array(), time(), null);
    wp_enqueue_script('lity-js', 'https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js', array('jquery'), time(), true);


    wp_register_style('ti-deposit-form-css', get_stylesheet_directory_uri() . '/assets/css/ti-deposit-form.css', array(), time(), null);
    wp_register_script('ti-deposit-form-js', get_stylesheet_directory_uri() . '/assets/js/ti-deposit-form.js', array('jquery'), time(), true);

    // New Homepage

    if (is_page_template('ti-homepage-template-2023.php') || is_front_page()) {
        wp_enqueue_style('magnefic-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css', array(), time(), null);
        wp_enqueue_script('magnefic-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js', array('jquery'), time(), true);
        // wp_register_script('ti-new-review-js', get_stylesheet_directory_uri() . '/assets/js/ti-new-review.js', array('jquery'), time(), true);
        // wp_enqueue_script('ti-new-review-js');
        wp_enqueue_script('ti-search-courses-js', get_stylesheet_directory_uri() . '/assets/js/ti-search-courses.js', array('jquery'), time(), true);
        wp_enqueue_style('ti-homepage-2023', get_stylesheet_directory_uri() . '/assets/css/ti-homepage-2023.css', array(), time(), null);
        wp_enqueue_script('ti-webinars', get_stylesheet_directory_uri() . '/assets/js/ti-webinars.js', array('jquery'), time(), true);
        wp_enqueue_script('ti-homepage-2023', get_stylesheet_directory_uri() . '/assets/js/ti-homepage-2023.js', array('jquery'), time(), true);
        wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), time(),true);
        wp_enqueue_script('splide-autoscroll', 'https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js', array(), time(),true);
        wp_enqueue_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), time(),'all');
    }

    if (is_page('63891')) {
        wp_enqueue_style('ti-search-courses-css', get_stylesheet_directory_uri() . '/assets/css/ti-search-courses.css', array(), time(), 'all');
        wp_enqueue_script('ti-search-courses-js', get_stylesheet_directory_uri() . '/assets/js/ti-search-courses.js', array('jquery'), time(), true);
        wp_enqueue_style('ti-new-homepage', get_stylesheet_directory_uri() . '/assets/css/ti-new-homepage.css', array(), time(), null);
        wp_enqueue_script('ti-new-homepage', get_stylesheet_directory_uri() . '/assets/js/ti-home-new.js', array('jquery'), time(), true);
    }

    if (is_page_template('homepage.php') || is_page_template('homepage_copy.php') || is_page_template('homepage-seo.php')) {
        wp_enqueue_style('ti-home-css', get_stylesheet_directory_uri() . '/assets/css/ti-home.css', array(), time(), null);
        wp_enqueue_script('ti-progressbar', get_stylesheet_directory_uri() . '/assets/js/circularprogressbar.js', array(), time(), true);
        wp_enqueue_script('ti-home-js', get_stylesheet_directory_uri() . '/assets/js/ti-home.js', array('jquery'), time(), true);

        wp_enqueue_script('ti-carousel-js', get_stylesheet_directory_uri() . '/assets/js/ti-carousel.js', array('jquery'), time(), true);

        wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css');
        wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js');
    }

    if (is_page('389') || is_post_type_archive('course')) {
        wp_enqueue_style('ti-archive-course-css', get_stylesheet_directory_uri() . '/assets/css/ti-archive-course.css', array(), time(), null);
        wp_enqueue_script('ti-archive-course-js', get_stylesheet_directory_uri() . '/assets/js/ti-archive-course.js', array('jquery'), time(), true);
    }

    if (is_page('59815')) {
        wp_enqueue_style('ti-tefl-internships-css', get_stylesheet_directory_uri() . '/assets/css/ti-tefl-internships.css', array(), time(), null);
    }

    if (is_singular('ppc')) {
        wp_enqueue_style('ti-single-ppc-css', get_stylesheet_directory_uri() . '/assets/css/ti-single-ppc.css', array(), time());
    }

    if (is_page_template('where-to-tefl.php')) {
		wp_enqueue_style('where-to-tefl-css', get_stylesheet_directory_uri() . '/assets/css/where-to-tefl.css', array(), time());
	}

    if (is_page_template('teach-english-abroad.php')) {
        wp_enqueue_script('teach-english-online', get_stylesheet_directory_uri() . '/assets/js/teach-english-abroad.js', array('jquery'), time(), true);
		wp_enqueue_style('teach-english-abroad-css', get_stylesheet_directory_uri() . '/assets/css/teach-english-abroad.css', array(), time());
	}

    if (is_page_template('teach-english-online.php')) {
        wp_enqueue_script('teach-english-online', get_stylesheet_directory_uri() . '/assets/js/teach-english-online.js', array('jquery'), time(), true);
		wp_enqueue_style('teach-english-online-css', get_stylesheet_directory_uri() . '/assets/css/teach-english-online.css', array(), time());
	}

    // TEFL Promotional Courses
    if (is_page('6839')) {
        wp_enqueue_style('ti-promotional-course-css', get_stylesheet_directory_uri() . '/assets/css/ti-promotional-course.css', array(), time(), null);
        wp_enqueue_script('ti-archive-course-js', get_stylesheet_directory_uri() . '/assets/js/ti-archive-course.js', array('jquery'), time(), true);
    }

    if (is_page_template('ti-courses-overview-template.php')) {
        wp_enqueue_style('ti-courses-overview-template', get_stylesheet_directory_uri() . '/assets/css/courses-overview-template.css', array(), time(), null);
        wp_enqueue_script('ti-courses-overview-template', get_stylesheet_directory_uri() . '/assets/js/courses-overview-template.js', array('jquery'), time(), true);
    }

    if (is_page_template('ti-secondary-overview-template.php')) {
        wp_enqueue_style('ti-secondary-overview-landing', get_stylesheet_directory_uri() . '/assets/css/ti-secondary-overview-landing.css', array(), time(), null);
        wp_enqueue_script('ti-secondary-overview-landing', get_stylesheet_directory_uri() . '/assets/js/ti-secondary-overview-landing.js', array('jquery'), time(), true);
    }

    if (is_page_template('ti-internships-overview-template.php')) {
        wp_enqueue_style('ti-internships-overview', get_stylesheet_directory_uri() . '/assets/css/internships-overview.css', array(), time(), null);
        wp_enqueue_script('ti-internships-overview', get_stylesheet_directory_uri() . '/assets/js/ti-internships.js', array('jquery'), time(), true);
    }

    if ((is_singular('course') || is_singular('course_location')) && !get_field('is_2024_design')) {
        wp_enqueue_style('ti-deposit-form-css', get_stylesheet_directory_uri() . '/assets/css/ti-deposit-form.css', array(), time(), null);
        wp_enqueue_style('ti-single-course-css', get_stylesheet_directory_uri() . '/assets/css/ti-single-course.css', array(), time(), null);
        wp_enqueue_script('ti-single-course-js', get_stylesheet_directory_uri() . '/assets/js/ti-single-course.js', array('jquery'), time(), true);
    }
    if (get_field('is_new_design')) {
        // Magnefic Popup
        wp_enqueue_style('magnefic-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css', array(), time(), null);
        wp_enqueue_script('magnefic-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js', array('jquery'), time(), true);
        //    wp_enqueue_style('ti-review-css', get_stylesheet_directory_uri() . '/assets/css/ti-review.css', array(), time(), null);
        wp_register_script('ti-new-review-js', get_stylesheet_directory_uri() . '/assets/js/ti-new-review.js', array('jquery'), time(), true);
        wp_enqueue_script('ti-new-review-js');
        wp_enqueue_style('ti-single-course-new', get_stylesheet_directory_uri() . '/assets/css/ti-single-course-new.css', array(), time(), 'all');
        // wp_enqueue_script('ti-single-course-js', get_stylesheet_directory_uri() . '/assets/js/ti-single-course.js', array('jquery'), time(), true);
    }

    if (get_field('is_2024_design')) {
        wp_enqueue_script('ti-deposit-form-js');
        wp_enqueue_style('ti-deposit-form-css', get_stylesheet_directory_uri() . '/assets/css/ti-deposit-form.css', array(), time(), null);
        wp_enqueue_style('ti-single-course-2024', get_stylesheet_directory_uri() . '/assets/css/ti-single-course-2024.css', array(), time(), 'all');
        wp_enqueue_script('ti-single-course-2024', get_stylesheet_directory_uri() . '/assets/js/ti-single-course-2024.js', array('jquery'), time(), true);
        wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), time(),true);
        wp_enqueue_script('splide-autoscroll', 'https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js', array(), time(),true);
        wp_enqueue_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), time(),'all');
        wp_enqueue_style('ti-search-courses-css', get_stylesheet_directory_uri() . '/assets/css/ti-search-courses.css', array(), time(), 'all');
        wp_enqueue_script('ti-search-courses-js', get_stylesheet_directory_uri() . '/assets/js/ti-search-courses.js', array('jquery'), time(), true);
    }

    if (get_field('is_internship_new_design') && is_singular('internship')) {
        // Magnefic Popup
        wp_enqueue_style('magnefic-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css', array(), time(), null);
        wp_enqueue_script('magnefic-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js', array('jquery'), time(), true);
        wp_enqueue_style('ti-single-internship-new', get_stylesheet_directory_uri() . '/assets/css/ti-single-itnernship-new.css', array(), time(), null);
        wp_register_script('ti-new-review-js', get_stylesheet_directory_uri() . '/assets/js/ti-new-review.js', array('jquery'), time(), true);
        wp_enqueue_script('ti-new-review-js');
        wp_enqueue_script('ti-single-internship-new', get_stylesheet_directory_uri() . '/assets/js/ti-single-internship-new.js', array('jquery'), time(), true);
        wp_enqueue_style('ti-deposit-form-css');
    }

    if (is_singular('screening_form')) {
        wp_enqueue_style('ti-single-screening-form.css', get_stylesheet_directory_uri() . '/assets/css/ti-single-screening-form.css', array(), time(), null);
    }

    if (is_singular('placement')) {
        wp_enqueue_style('ti-single-placement-css', get_stylesheet_directory_uri() . '/assets/css/ti-single-placement.css', array(), time(), null);
        wp_enqueue_script('ti-single-course-js', get_stylesheet_directory_uri() . '/assets/js/ti-single-course.js', array('jquery'), time(), true);
    }

    if (is_page_template('trial.php')) {
        wp_enqueue_style('trial-style', get_stylesheet_directory_uri() . '/assets/css/trial.css', array(), time());
    }

    if ((is_singular('course') || is_page_template('homepage.php') || is_singular('course_location')) && !(get_field('is_2024_design'))) {
        wp_enqueue_style('ti-review-css', get_stylesheet_directory_uri() . '/assets/css/ti-review.css', array(), time(), null);
    }

    // TEO Checker
    if (is_page(80918)) {
        wp_enqueue_style('teo-checker-css', get_stylesheet_directory_uri() . '/assets/css/teo-checker.css', array(), time(), null);
        wp_enqueue_script('teo-checker-js', get_stylesheet_directory_uri() . '/assets/js/teo-checker.js', array('jquery'), time(), true);
    }

    // FAQ Page
    if (is_page_template('page-faq.php') || is_page_template('certification.php') || is_page_template('homepage.php') || is_singular('post') || is_page_template('homepage_new.php') || is_page_template('homepage-seo.php') || is_page_template('page-school.php')) {
        wp_enqueue_style('ti-faq-css', get_stylesheet_directory_uri() . '/assets/css/ti-faq.css', array(), time(), null);
    }

    // About Page
    if (is_page('161') || is_page_template('about.php') || is_page_template('certification.php') || is_page_template('page-contact.php') || is_page_template('page-elt.php')) {
        wp_enqueue_style('ti-about-css', get_stylesheet_directory_uri() . '/assets/css/ti-about.css', array(), time(), null);
    }

    // Blog Page
    if (is_page('122') || is_category() || is_page_template('page-supportcenter.php')) {
        wp_enqueue_style('ti-blog-css', get_stylesheet_directory_uri() . '/assets/css/ti-blog.css', array(), time(), null);
        wp_enqueue_script('ti-blog', get_stylesheet_directory_uri() . '/assets/js/ti-blog.js', array('jquery'), time(), true);
    }

    if (is_singular('post')) {
        wp_enqueue_style('ti-single-post-css', get_stylesheet_directory_uri() . '/assets/css/ti-single-post.css', array(), time(), null);
        wp_enqueue_script('ti-single-post-js', get_stylesheet_directory_uri() . '/assets/js/ti-single-post.js', array('jquery'), time(), true);
    }

    // Callback Page
    if (is_page(1126) || is_page_template('page-contact.php') || is_page_template('page-callback.php')) {
          
        wp_enqueue_script('ti-datetime-picker','https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js',array('jquery'),time(),true);
        wp_enqueue_style('ti-datetime-picker','https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css',array(),time(),'all');
        wp_enqueue_style('ti-callback-css', get_stylesheet_directory_uri() . '/assets/css/ti-callback.css', array(), time(), null);
    }

    // Callback Page
    if (is_page(6459)) {
        wp_enqueue_style('ti-school-css', get_stylesheet_directory_uri() . '/assets/css/ti-school.css', array(), time(), null);
    }

    if (is_page_template('page-elt.php')) {
        wp_enqueue_style('ti-elt-css', get_stylesheet_directory_uri() . '/assets/css/ti-elt.css', array(), time(), null);
        wp_enqueue_script('ti-elt-js', get_stylesheet_directory_uri() . '/assets/js/ti-elt.js', array('jquery'), time(), true);
    }

    if (is_page_template('page-supportcenter.php')) {
        wp_enqueue_style('ti-support-center-css', get_stylesheet_directory_uri() . '/assets/css/ti-support-center.css', array(), time(), null);
        wp_enqueue_script('ti-support-center-js', get_stylesheet_directory_uri() . '/assets/js/ti-support-center.js', array(), time(), null);
    }

    if (is_page_template('tesol-tefl-courses.php') || is_page_template('tesol-tefl-courses-v2.php')) {
        wp_enqueue_style('tesol-tefl-courses-css', get_stylesheet_directory_uri() . '/assets/css/tesol-tefl-courses.css', array(), time(), null);
        wp_enqueue_script('ti-courses-overview-template', get_stylesheet_directory_uri() . '/assets/js/courses-overview-template.js', array('jquery'), time(), true);
         wp_enqueue_script('tesol-tefl-courses', get_stylesheet_directory_uri() . '/assets/js/tesol-tefl-courses.js', array('jquery'), time(), true);
    }

    // Teach English Abroad Template
    if (is_singular('teach_english_abroad')) {
        wp_enqueue_style('single-teach-english-abroad-css', get_stylesheet_directory_uri() . '/assets/css/ti-single-teach-english-abroad.css', array(), time(), 'all');
        wp_enqueue_script('single-teach-english-abroad-js', get_stylesheet_directory_uri() . '/assets/js/ti-single-teach-english-abroad.js', array('jquery'), time(), true);
    }

    // Terms and Conditions Page
    if (is_page(911)) {
        wp_enqueue_script('ti-tandc-js', get_stylesheet_directory_uri() . '/assets/js/ti-tandc.js', array('jquery'), time(), true);
    }

    // Account Login Page
    if (is_page('15')) {
        wp_enqueue_style('ti-my-account-css', get_stylesheet_directory_uri() . '/assets/css/ti-my-account.css', array(), time(), null);
        wp_enqueue_script('ti-my-account-js', get_stylesheet_directory_uri() . '/assets/js/ti-my-account.js', array('jquery'), time(), true);
    }

    // Meet The Team Page
    if (is_page('903')) {
        wp_enqueue_style('ti-meet-the-team-css', get_stylesheet_directory_uri() . '/assets/css/ti-meet-the-team.css', array(), time(), null);
        wp_enqueue_script('ti-meet-the-team-js', get_stylesheet_directory_uri() . '/assets/js/ti-meet-the-team.js', array('jquery'), time(), true);
    }

    // Webinars Page
    if (is_page('948')) {
        wp_enqueue_style('ti-webinars-css', get_stylesheet_directory_uri() . '/assets/css/ti-webinars.css', array(), time(), null);
        wp_enqueue_script('ti-webinars-js', get_stylesheet_directory_uri() . '/assets/js/ti-webinars.js', array('jquery'), time(), true);
    }

    // Free TEFL Jobs Service Page
    if (is_page('3905') || is_page('4024')) {
        wp_enqueue_style('ti-job-service-css', get_stylesheet_directory_uri() . '/assets/css/ti-job-service.css', array(), time(), null);
        wp_enqueue_script('ti-job-service-js', get_stylesheet_directory_uri() . '/assets/js/ti-job-service.js', array('jquery'), time(), true);
    }

    //All TEFL Jobs Page
    if (is_page('4024')) {
        wp_enqueue_style('ti-all-jobs-css', get_stylesheet_directory_uri() . '/assets/css/ti-all-jobs.css', array(), time(), null);
        wp_enqueue_script('ti-all-jobs-js', get_stylesheet_directory_uri() . '/assets/js/ti-all-jobs.js', array('jquery'), time(), true);
    }

    // Single Support Center Page
    if (is_singular('support_centre')) {
        wp_enqueue_style('ti-single-support-center-css', get_stylesheet_directory_uri() . '/assets/css/ti-single-support-center.css', array(), time(), null);
    }

    if (is_singular('guide')) {
        wp_enqueue_style('single-guide-css', get_stylesheet_directory_uri() . '/assets/css/ti-single-guide.css', array(), time(), 'all');
    }

    // Cart and Checkout Page
    if (is_cart() || is_checkout()) {
        wp_enqueue_style('ti-cartcheckout-css', get_stylesheet_directory_uri() . '/assets/css/ti-cartcheckout.css', array(), time(), null);
    }

    // Checkout Page
    if (is_checkout()) {
        wp_enqueue_script('ti-checkout-js', get_stylesheet_directory_uri() . '/assets/js/ti-checkout.js', array('jquery'), time(), true);
        wp_enqueue_style('se-checkout-css');
        wp_enqueue_script('se-checkout-js');
    }

    //Cart page 
    $curr_user_id = get_current_user_id();
    if (isset($_GET['debug'])) {
        $debug = $_GET['debug'];
    }
    //if(is_cart() && current_user_can('administrator') && ($curr_user_id == 1) && ($debug == 'yes')){
    if (is_cart()) {
        wp_enqueue_style('ti-cart-css', get_stylesheet_directory_uri() . '/assets/css/ti-cart.css', array(), time(), 'all');
    }

    if (is_checkout()) {
        wp_enqueue_style('ti-checkout-css', get_stylesheet_directory_uri() . '/assets/css/ti-checkout.css', array(), time(), 'all');
    }

    // Single Support Center Page
    if (is_search()) {
        wp_enqueue_style('ti-search-css', get_stylesheet_directory_uri() . '/assets/css/ti-search.css', array(), time(), null);
    }

    // TEFL Shop Page
    if (is_page('4786')) {
        wp_enqueue_style('ti-tefl-shop-css', get_stylesheet_directory_uri() . '/assets/css/ti-tefl-shop.css', array(), time(), null);
    }

    // Teach English Online
    if (is_page('901')) {
        wp_enqueue_style('ti-teo-css', get_stylesheet_directory_uri() . '/assets/css/ti-teo.css', array(), time(), null);
    }

    // Teach English Online New
    if (is_page('68184')) {
        wp_enqueue_style('ti-teo-new-css', get_stylesheet_directory_uri() . '/assets/css/ti-teo-new.css', array(), time(), null);
        wp_enqueue_script('ti-teo-new-js', get_stylesheet_directory_uri() . '/assets/js/ti-teo-new.js', array('jquery'), time(), true);
    }

    // Salary Calculator Page
    if (is_page(3885)) {
        wp_enqueue_style('ti-salary-calculator-css', get_stylesheet_directory_uri() . '/assets/css/ti-salary-calculator.css', array(), time(), null);
        wp_enqueue_script('ti-salary-calculator-js', get_stylesheet_directory_uri() . '/assets/js/ti-salary-calculator.js', array('jquery'), time(), true);

        // wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
        // wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js');
    }

    // Become an Affiliate Page
    if (is_page_template('page-affiliate.php')) {
        wp_enqueue_style('ti-affiliate-css', get_stylesheet_directory_uri() . '/assets/css/ti-affiliate.css', array(), time(), null);
    }
    if (is_page_template('page-affiliate-v2.php')) {
        wp_enqueue_style('ti-affiliate-v2-css', get_stylesheet_directory_uri() . '/assets/css/ti-affiliate-v2.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/ti-affiliate-v2.css'), null);
    }
    // Affiliate Area (1081) is styled by ti-affiliate-v2.css via page-affiliate-simple.php; the 2023 ti-affiliate-area.css broke the creatives grid.

    // TEFL Scholarships Page
    if (is_page('9316')) {
        wp_enqueue_style('ti-scholarships-css', get_stylesheet_directory_uri() . '/assets/css/ti-scholarships.css', array(), time(), null);
    }
    if (is_page_template('black-friday-landing-page.php')) {
        wp_enqueue_style('black-friday-landing-css', get_stylesheet_directory_uri() . '/assets/css/black-friday-landing.css', array(), time(), null);
    }
    if (is_page_template('black-friday-landing-page-2023.php')) {
        wp_enqueue_style('black-friday-landing-page-css', get_stylesheet_directory_uri() . '/assets/css/black-friday-landing-page.css', array(), time(), null);
        wp_enqueue_script('black-friday-landing-page-js', get_stylesheet_directory_uri() . '/assets/js/black-friday-sale-2023.js', array('jquery'), time(), true);
    }

    if (is_page_template('black-friday-landing-page-2026.php')) {
        wp_enqueue_style('black-friday-landing-page-css', get_stylesheet_directory_uri() . '/assets/css/black-friday-landing-page-2026.css', array(), time(), null);
        wp_enqueue_script('black-friday-landing-page-js', get_stylesheet_directory_uri() . '/assets/js/black-friday-landing-page-2026.js', array('jquery'), time(), true);
    }

    if (is_page_template('hope-page.php')) {
        wp_enqueue_style('hope-page', get_stylesheet_directory_uri() . '/assets/css/hope-page.css', array(), time(), null);
    }

    if (is_singular('course_location')) {
        wp_enqueue_style('ti-single-course-location-css', get_stylesheet_directory_uri() . '/assets/css/ti-single-course-location.css', array(), time(), null);
    }

    if (is_singular('internship') && get_field('is_internship_new_design') != 1) {

        wp_enqueue_style('ti-deposit-form-css', get_stylesheet_directory_uri() . '/assets/css/ti-deposit-form.css', array(), time(), 'all');

        wp_register_style('ti-slick-carousel-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), time(), null);
        wp_enqueue_style('ti-slick-carousel-css');

        wp_register_script('ti-slick-carousel-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), time(), true);
        wp_enqueue_script('ti-slick-carousel-js');

        wp_enqueue_style('ti-single-internship-css', get_stylesheet_directory_uri() . '/assets/css/ti-single-internship.css', array(), time(), null);
        wp_enqueue_script('ti-single-internship-js', get_stylesheet_directory_uri() . '/assets/js/ti-single-internship.js', array('jquery'), time(), true);

        wp_register_style('ti-popup-css', get_stylesheet_directory_uri() . '/assets/css/ti-popup.css', array(), time(), 'all');
        wp_register_script('ti-popup-js', get_stylesheet_directory_uri() . '/assets/js/ti-popup.js', array('jquery'), time(), true);

        wp_enqueue_style('ti-popup-css');
        wp_enqueue_script('ti-popup-js');
    }

    if (get_field('is_new_design') || is_page_template('homepage.php') || is_page_template('search-courses-template.php') || is_page_template('homepage-seo.php')) {
        wp_enqueue_style('ti-search-courses-css', get_stylesheet_directory_uri() . '/assets/css/ti-search-courses.css', array(), time(), 'all');
        wp_enqueue_script('ti-search-courses-js', get_stylesheet_directory_uri() . '/assets/js/ti-search-courses.js', array('jquery'), time(), true);
    }

    if (is_page_template('page-teach-english-jobs.php')) {
        wp_enqueue_style('ti-teach-english-jobs-css', get_stylesheet_directory_uri() . '/assets/css/ti-teach-english-jobs.css', array(), time(), null);
    }

    // Black Friday Mega Sale
    if (is_page('72123') || is_page('72314') || is_page('73603') || is_page('73592')) {
        wp_enqueue_script('ti-deposit-form-js');
        wp_enqueue_style('ti-review-css', get_stylesheet_directory_uri() . '/assets/css/ti-review.css', array(), time(), null);
        wp_enqueue_style('ti-black-friday-megasales', get_stylesheet_directory_uri() . '/assets/css/ti-black-friday-mega-sales.css', array(), time(), 'all');
    }

    // Gift Vouchers
    if (is_page('73264')) {
        wp_enqueue_style('ti-gift-vouchers', get_stylesheet_directory_uri() . '/assets/css/ti-gift-vouchers.css', array(), time(), null);
    }

    // Course Extensions
    if (is_page('74991')) {
        wp_enqueue_style('ti-course-extensions', get_stylesheet_directory_uri() . '/assets/css/ti-course-extensions.css', array(), time(), null);
    }

    if (is_page_template('ti-tashkent-template.php')) {

        wp_enqueue_style('ti-tashkent-template-css', get_stylesheet_directory_uri() . '/assets/css/ti-tashkent-template.css', array(), time(), null);
        
    }

    wp_enqueue_style('ti-select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), time(), 'all');
    wp_enqueue_script('ti-select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), time(), true);

    /**
     * Black Friday Sale
     * https://tefl.ie/black-friday-sale
     * 
     * @author Przemysław Solan
     * @date 4th November 2024
     */
    if(is_page_template('black-friday-sale-prz.php')) {
        wp_enqueue_style('black-friday-sale-prz', get_stylesheet_directory_uri() . '/assets/css/black-friday-sale-prz.css', array(), time());
        wp_enqueue_style('tefl-lity-css', 'https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css', array(), time(), null);
        wp_enqueue_script('tefl-lity-js', 'https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js', array('jquery'), time(), true);
    }

    if(is_page_template('tefl-january-sale.php')) {
        wp_enqueue_style('tefl-january-sale', get_stylesheet_directory_uri() . '/assets/css/tefl-january-sale.css', array(), time());
        wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), time(),true);
        wp_enqueue_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), time(),'all');
    }
    
    /**
     * Alerts
     * https://teflinstitute.com/alerts/:country
     * 
     * @author Przemyslaw Solan <przemek.solan@teflinstitute.com>
     * @date 16th January 2023
     */
    if (is_singular('alerts')) {
        wp_enqueue_style('ti-alerts-style', get_stylesheet_directory_uri() . '/assets/css/ti-single-alerts.css', array(), time(), 'all');
    }

    wp_register_style('ti-new-review-css', get_stylesheet_directory_uri() . '/assets/css/ti-new-review.css', array(), time(), 'all');
    wp_register_script('ti-new-review-js', get_stylesheet_directory_uri() . '/assets/js/ti-new-review.js', array('jquery'), time(), true);

    wp_register_style('ti-form-brochure-css', get_stylesheet_directory_uri() . '/assets/css/ti-form-brochure.css', array(), time(), 'all');

    wp_register_style('se-checkout-css', get_stylesheet_directory_uri() . '/assets/css/se-checkout.css', array(), time(), 'all');
    wp_register_script('se-checkout-js', get_stylesheet_directory_uri() . '/assets/js/se-checkout.js', array('jquery'), time(), true);

    /* 
     * @author: Przemysław Solan
     * @date: 20/01/2023
     */
    // Spain Screening Form
    if (is_page(74100)) {
        wp_enqueue_style('ti-eligibility-screening.css', get_stylesheet_directory_uri() . '/assets/css/ti-eligibility-screening.css', array(), time(), 'all');
        wp_enqueue_script('ti-spain-screening-form-js', get_stylesheet_directory_uri() . '/assets/js/ti-spain-screening-form.js', array('jquery'), time(), true);
    }

    // Thailand Screening Form
    if (is_page(74145)) {
        wp_enqueue_style('ti-eligibility-screening.css', get_stylesheet_directory_uri() . '/assets/css/ti-eligibility-screening.css', array(), time(), 'all');
        wp_enqueue_script('ti-thailand-screening-form-js', get_stylesheet_directory_uri() . '/assets/js/ti-thailand-screening-form.js', array('jquery'), time(), true);
    }

    // South Korea Screening Form
    if (is_page(74161)) {
        wp_enqueue_style('ti-eligibility-screening.css', get_stylesheet_directory_uri() . '/assets/css/ti-eligibility-screening.css', array(), time(), 'all');
        wp_enqueue_script('ti-south-korea-screening-form-js', get_stylesheet_directory_uri() . '/assets/js/ti-south-korea-screening-form.js', array('jquery'), time(), true);
    }

    // Vietnam Screening Form
    if (is_page(74171)) {
        wp_enqueue_style('ti-eligibility-screening.css', get_stylesheet_directory_uri() . '/assets/css/ti-eligibility-screening.css', array(), time(), 'all');
        wp_enqueue_script('ti-vietnam-screening-form-js', get_stylesheet_directory_uri() . '/assets/js/ti-vietnam-screening-form.js', array('jquery'), time(), true);
    }

    if(is_page_template('tefl-plus.php')){
        wp_enqueue_style('tefl-lity-css', 'https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css', array(), time(), null);
        wp_enqueue_script('tefl-lity-js', 'https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js', array('jquery'), time(), true);
        wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), time(),true);
        wp_enqueue_script('splide-autoscroll', 'https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js', array(), time(),true);
        wp_enqueue_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), time(),'all');
        wp_enqueue_style('tefl-plus', get_stylesheet_directory_uri() . '/assets/css/tefl-plus.css', array(), time(),'all');
        wp_enqueue_script('tefl-plus', get_stylesheet_directory_uri() . '/assets/js/tefl-plus.js', array(), time(),true);
    }

    if(is_page_template('ti-homepage-template-2024.php') ){
        wp_enqueue_style('ti-search-courses-css', get_stylesheet_directory_uri() . '/assets/css/ti-search-courses.css', array(), time(), 'all');
        wp_enqueue_script('ti-search-courses-js', get_stylesheet_directory_uri() . '/assets/js/ti-search-courses.js', array('jquery'), time(), true);
        wp_enqueue_style('tefl-home-2024', get_stylesheet_directory_uri() . '/assets/css/tefl-home-2024.css', array(), time(),'all');
        wp_enqueue_script('tefl-home-2024', get_stylesheet_directory_uri() . '/assets/js/tefl-home-2024.js', array(), time(),true);
        
    }

    if( is_page_template('ti-homepage-template-2024.php') ){
        wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), time(),true);
        wp_enqueue_script('splide-autoscroll', 'https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js', array(), time(),true);
        wp_enqueue_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), time(),'all');
        wp_enqueue_style('klarna', get_stylesheet_directory_uri() . '/assets/css/klarna.css', array(), time());
        wp_enqueue_script('klarna', get_stylesheet_directory_uri() . '/assets/js/klarna.js', array('jquery'), time(), true);
    }

    // Myanmar Screening Form
    if (is_page(74178)) {
        wp_enqueue_style('ti-eligibility-screening.css', get_stylesheet_directory_uri() . '/assets/css/ti-eligibility-screening.css', array(), time(), 'all');
        wp_enqueue_script('ti-myanmar-screening-form-js', get_stylesheet_directory_uri() . '/assets/js/ti-myanmar-screening-form.js', array('jquery'), time(), true);
    }

    

    // Cooupon page

    if(is_page_template('discount-tefl-coupon-codes.php')){
        wp_enqueue_style('discount-tefl-coupon-codes', get_stylesheet_directory_uri() . '/assets/css/discount-tefl-coupon-codes.css', array(), time(), 'all');
        wp_enqueue_script('discount-tefl-coupon-codes', get_stylesheet_directory_uri() . '/assets/js/discount-tefl-coupon-codes.js', array('jquery'), time(), true);
    }

    if(is_page_template('ti-esl-franchise.php')){
        wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), time(),true);
        wp_enqueue_script('splide-autoscroll', 'https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js', array(), time(),true);
        wp_enqueue_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), time(),'all');
        wp_enqueue_style('ti-esl-franchise', get_stylesheet_directory_uri() . '/assets/css/ti-esl-franchise.css', array(), time(), 'all');
        wp_enqueue_script('ti-esl-franchise', get_stylesheet_directory_uri() . '/assets/js/ti-esl-franchise.js', array('jquery'), time(), true);
    }

    if(is_page_template('ti-founder-page.php')){
        wp_enqueue_style('ti-founder-page', get_stylesheet_directory_uri() . '/assets/css/ti-founder-page.css', array(), time(), 'all');
        wp_enqueue_script('ti-founder-page', get_stylesheet_directory_uri() . '/assets/js/ti-founder-page.js', array('jquery'), time(), true);
    }

    if(is_page_template('ti-tefl-for-schools.php')){
        wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), time(),true);
        wp_enqueue_script('splide-autoscroll', 'https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js', array(), time(),true);
        wp_enqueue_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), time(),'all');
        wp_enqueue_style('ti-tefl-for-schools', get_stylesheet_directory_uri() . '/assets/css/ti-tefl-for-schools.css', array(), time(), 'all');
        wp_enqueue_script('ti-tefl-for-schools', get_stylesheet_directory_uri() . '/assets/js/ti-tefl-for-schools.js', array('jquery'), time(), true);
    }

    if (is_page_template('ti-tefl-for-schools-v3.php')) {
        wp_enqueue_style('ti-tefl-for-schools-v3', get_stylesheet_directory_uri() . '/assets/css/ti-tefl-for-schools-v3.css', array(), time(), 'all');
        wp_enqueue_script('ti-tefl-for-schools-v3', get_stylesheet_directory_uri() . '/assets/js/ti-tefl-for-schools-v3.js', array(), time(), true);
        wp_add_inline_script('ti-tefl-for-schools-v3', tfs2_js_config(), 'before');
        wp_enqueue_script('dlopo-embed', 'https://dlopo.com/embed.js', array(), null, true);
        wp_add_inline_script('dlopo-embed', 'window.dlopoEmbed = { mode: "element" };', 'before');
    }

    // WELCOME exit-intent popup (5% off first order).
    if (function_exists('ti_wx_should_show') && ti_wx_should_show()) {
        wp_enqueue_style('ti-welcome-exit-popup', get_stylesheet_directory_uri() . '/assets/css/ti-welcome-exit-popup.css', array(), time(), 'all');
        wp_enqueue_script('ti-welcome-exit-popup', get_stylesheet_directory_uri() . '/assets/js/ti-welcome-exit-popup.js', array(), time(), true);
        wp_localize_script('ti-welcome-exit-popup', 'ti_wx', array('ajax' => admin_url('admin-ajax.php')));
    }

    if(is_page_template('page-job-hunters-pack.php')){
        wp_enqueue_style('page-job-hunters-pack', get_stylesheet_directory_uri() . '/assets/css/page-job-hunters-pack.css', array(), time(), 'all');
        wp_enqueue_script('page-job-hunters-pack', get_stylesheet_directory_uri() . '/assets/js/page-job-hunters-pack.js', array('jquery'), time(), true);
    }

    if(is_page_template('ti-page-country-course-template.php')){
        wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), time(),true);
        wp_enqueue_script('splide-autoscroll', 'https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js', array(), time(),true);
        wp_enqueue_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), time(),'all');
        wp_enqueue_style('ti-page-country-course-template', get_stylesheet_directory_uri() . '/assets/css/ti-page-country-course-template.css', array(), time(), 'all');
        wp_enqueue_script('ti-page-country-course-template', get_stylesheet_directory_uri() . '/assets/js/ti-page-country-course-template.js', array('jquery'), time(), true);
    }


    if(is_page_template('single-country-page.php')){
        wp_enqueue_style('single-country-page', get_stylesheet_directory_uri() . '/assets/css/page/single-country-page.css', array(), time(), 'all');
        // wp_enqueue_style('global-css', get_stylesheet_directory_uri() . '/assets/css/global.css', array(), time(), 'all');
        wp_enqueue_style('slick-slider',get_stylesheet_directory_uri() . '/assets/css/element/slick-slider.css', array(), time(), 'all');
        wp_enqueue_script('slick-slider-js', get_stylesheet_directory_uri() . '/assets/js/element/slick-slider.js', array('jquery'), time(), true);
        wp_enqueue_style('ti-homepage-2023', get_stylesheet_directory_uri() . '/assets/css/ti-homepage-2023.css', array(), time(), null);
        wp_enqueue_script('ti-homepage-2023', get_stylesheet_directory_uri() . '/assets/js/ti-homepage-2023.js', array('jquery'), time(), true);
    }

    // Partners Template
    if ( is_page_template('prz-partners.php') ) {
        wp_enqueue_style(
            'partners-css',
            get_stylesheet_directory_uri() . '/assets/css/prz-partners.css',
            array(),
            time(),
            'all'
        );
    }

    // Podcast template
    if(is_page_template('tefl-podcast.php')){
        wp_enqueue_style('podcast-css', get_stylesheet_directory_uri() . '/assets/css/page/tefl-podcast.css',
            array(),
            time(),
            'all');

    }

    
    // Japan Page Template
    if (is_page_template('page-japan-template.php')) {
        wp_enqueue_style('page-japan-template-css', get_stylesheet_directory_uri() . '/assets/css/page-japan-template.css', array(), time(), 'all');
        wp_enqueue_script('page-japan-template-js', get_stylesheet_directory_uri() . '/assets/js/page-japan-template.js', array('jquery'), time(), true);
    }

    if (is_page_template('page-sale-new.php')) {
        wp_enqueue_style('page-sale-new-css', get_stylesheet_directory_uri() . '/assets/css/page-sale-new.css', array(), time(), 'all');
        wp_enqueue_script('page-sale-new-js', get_stylesheet_directory_uri() . '/assets/js/page-sale-new.js', array('jquery'), time(), true);
        wp_enqueue_style('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css');
        wp_enqueue_script('splide', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), null, true);
        wp_enqueue_style('tefl-lity-css', 'https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css', array(), time(), null);
        wp_enqueue_script('tefl-lity-js', 'https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js', array('jquery'), time(), true);
    }


    $carr = [];
    $geo_logo  = get_field('geo_logos', 'options');
    foreach ($geo_logo as $gl) {
        $cc = $gl['country_code'];
        $cc = strtolower($cc);
        array_push($carr, $cc);
    }

    $ti_local_array = array(
        'ti_ajax' =>  admin_url('admin-ajax.php'),
        'ti_curr_post_id' => get_the_ID(),
        'ti_country_code' => get_user_geo_country_code(),
        'ti_show_country' => $carr,
        'nonce' => wp_create_nonce('google_reviews_nonce')
    );

    wp_localize_script('ti-global-js', 'ti_obj', $ti_local_array);
}


if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
    acf_add_options_page(array(
        'page_title'    => 'Course Date Settings',
        'menu_title'    => 'Course Date Settings',
        'menu_slug'     => 'course-date-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    acf_add_options_page(array(
        'page_title'    => 'Menu Settings',
        'menu_title'    => 'Menu Settings',
        'menu_slug'     => 'menu-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    acf_add_options_page(array(
        'page_title'    => 'Banner Settings',
        'menu_title'    => 'Banner Settings',
        'menu_slug'     => 'banner-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    acf_add_options_page(array(
        'page_title'    => 'Color Settings',
        'menu_title'    => 'Color Settings',
        'menu_slug'     => 'color-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    // Auto-purge caches when an ACF Options page (Menu/Banner/Color/Course Date Settings) is saved,
    // so client edits appear immediately without a manual cache clear.
    add_action('acf/save_post', function( $post_id ) {
        if ( 'options' !== $post_id ) { return; } // ACF options pages save with post_id 'options'
        if ( function_exists('wpfc_clear_all_cache') ) {
            wpfc_clear_all_cache( true );           // WP Fastest Cache + the static cache dir nginx serves
        } else {
            do_action('wpfc_clear_all_cache', true);
        }
        wp_cache_flush();                           // Redis object cache
    }, 20);
    // acf_add_options_page(array(
    //     'page_title'    => 'Home Hero Banners Settings',
    //     'menu_title'    => 'Home Hero Banners Settings',
    //     'menu_slug'     => 'home-hero-banner-settings',
    //     'capability'    => 'edit_posts',
    //     'redirect'      => false
    // ));

    acf_add_options_page(array(
        'page_title'    => 'Single Course Page Common Content',
        'menu_title'    => 'Single Course Page Common Content',
        'menu_slug'     => 'single_course_page_common_content',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_page(array(
        'page_title'    => 'Single Internship Page Common Content',
        'menu_title'    => 'Single Internship Page Common Content',
        'menu_slug'     => 'single_internship_page_common_content',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_page(array(
        'page_title'    => 'TESOL/TEFL Courses',
        'menu_title'    => 'TESOL/TEFL Courses',
        'menu_slug'     => 'tesol_tefl_courses',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    // acf_add_options_page(array(
    //     'page_title'    => 'Coupon Page Settings',
    //     'menu_title'    => 'Coupon Page Settings',
    //     'menu_slug'     => 'coupon_page_settings',
    //     'capability'    => 'edit_posts',
    //     'redirect'      => false
    // ));
}
//Get Products for App
function get_products($data)
{
    $product =  wc_get_product(6648);
    $productImage = array("myProductImage" => wp_get_attachment_url($product->get_image_id()));
    $customArry = array_merge($productImage, $product->get_data());
    $productone =  wc_get_product(6646);
    $productoneImage = array("myProductImage" => wp_get_attachment_url($productone->get_image_id()));
    $customArryone = array_merge($productoneImage, $productone->get_data());

    $producttwo =  wc_get_product(4888);
    $producttwoImage = array("myProductImage" => wp_get_attachment_url($producttwo->get_image_id()));
    $customArrytwo = array_merge($producttwoImage, $producttwo->get_data());


    $productthree =  wc_get_product(4880);
    $productthreeImage = array("myProductImage" => wp_get_attachment_url($productthree->get_image_id()));
    $customArrythree = array_merge($productthreeImage, $productthree->get_data());
    $myArray[] = [$customArry, $customArryone, $customArrytwo, $customArrythree];
    return $myArray[0];
}

add_action('rest_api_init', function () {
    register_rest_route('wc/v3', 'get-app-products', array(
        'methods' => 'GET',
        'callback' => 'get_products',
        'permission_callback' => '__return_true'
    ));
});

add_action('rest_api_init', function () {
    add_action('rest_pre_serve_request', function () {
        header('Access-Control-Allow-Headers: Authorization, Content-Type, X-WP-Wpml-Language', true);
        header("Access-Control-Allow-Origin: *");
    });
}, 15);


add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);


add_filter('use_block_editor_for_post', '__return_false');

require_once 'includes/performance.php';
require_once 'includes/template_functions.php';
require_once 'includes/tefl-course-variation-date.php';
require_once 'includes/elt.php';
require_once 'includes/checkout.php';
require_once 'includes/salary-calculator.php';
require_once 'includes/ti-ajax.php';
require_once 'includes/go-cambio-jobs-functions.php';
require_once 'includes/ti-footer-functions.php';
require_once 'includes/ti-email-functions.php';
require_once 'includes/tefl-timer-functions.php';
require_once 'includes/cart-functions.php';
require_once 'includes/ti-header-functions.php';
require_once 'includes/ti-useful-functions.php';
require_once 'includes/course-search-functions.php';
require_once 'includes/ti-shortcode-functions.php';
require_once 'includes/ti-subcountry-functions.php';
// require_once 'includes/ti-subcountry-posts.php';
require_once 'includes/seo_functions.php';
require_once 'includes/custom_login_endpoint.php';
require_once 'includes/black-friday-2026.php';
require_once 'includes/ti-blog-redesign.php';
require_once 'includes/ti-mobile-menu.php';
require_once 'includes/google-sheets-insert.php';
require_once 'includes/sso_functions.php';
require_once 'includes/download-brochure-functions.php';
require_once 'includes/pay_in_installments_breakdown_view.php';
require_once 'includes/custom_order_action.php';
require_once 'includes/order-functions.php';
require_once 'includes/validate_newsletter_email.php';

require_once 'includes/hope-foundation-donation-integration.php';


require_once 'includes/buying-for-someone-else-feature.php';
require_once 'includes/elt-custom-email.php';
require_once 'includes/ti-course-extension-functions.php';
require_once 'includes/awoo-merge-variables.php';
require_once 'includes/custom_webhooks.php';
require_once 'includes/widgets.php';
require_once 'includes/tracking-scripts.php';

require_once 'includes/spin-the-wheel.php';

// Code moved out of the Code Snippets plugin into the child theme.
require_once 'includes/migrated-code-snippets.php';

// Course Page 2026 (new course design, opt-in per course).
require_once 'includes/course-2026.php';

require_once 'includes/tefl-for-schools-v3.php';
require_once 'includes/welcome-exit-popup.php';
require_once 'includes/ti-affiliate-signup.php';
require_once 'includes/ti-sidecart-guard.php';
add_filter('ti_wx_should_show', '__return_false'); // WELCOME popup switched off for now

function wpse245372_admin_user_css()
{
    $user = wp_get_current_user();
    if (in_array('author', (array) $user->roles)) {
        echo '<style> div#dashboard-widgets-wrap, li#wp-admin-bar-new-content, ul#adminmenu>li:not(#menu-posts) { display: none; } </style>';
    }
}

add_action('admin_head', 'wpse245372_admin_user_css');

// add_action('wp_head', 'ti_defining_global_styles');

function ti_defining_global_styles()
{
    $theme_accent_color = get_field('theme_accent_color', 'options');
    $accent_text_color = get_field('accent_text_color', 'options');
?>
    <style>
        :root {
            --global-theme-accent-color: <?php echo $theme_accent_color; ?>;
            --global-accent-text-color: <?php echo $accent_text_color; ?>;
        }
    </style>
<?php
}


// if (is_single(88511)) { 

//     add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'custom_dropdown_variation_attribute_options_text', 10, 1 );

//     function custom_dropdown_variation_attribute_options_text( $args ) {
//         if( 'attribute_package' == $args['attribute'] )
//             $args['show_option_none'] = __( 'Choose an Option', 'woocommerce' );

//         if( 'attribute_dates' == $args['attribute'] )
//             $args['show_option_none'] = __( 'Choose an Option', 'woocommerce' );

//         return $args;
//     }
// }



// disable double add to cart of a product
add_filter('woocommerce_is_sold_individually', 'ti_default_no_quantities', 10, 2);

function ti_default_no_quantities($individually, $product)
{
    $individually = true;
    return $individually;
}

function example_theme_support()
{
    remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'example_theme_support');

add_action('woocommerce_admin_order_data_after_shipping_address', 'add_revolut_link');

function add_revolut_link()
{
    $is_revolut = get_post_meta(get_the_ID(), 'revolut_capture', true);
    $transaction_id = get_post_meta(get_the_ID(), '_transaction_id', true);
    $revolut_link   = 'https://business.revolut.com/requests/all/details/' . $transaction_id . '?from=/merchant';
    if ((!empty($is_revolut) && $is_revolut === 'yes') || ($payment_method === 'revolut_cc' || $payment_method === 'revolut_pay' )) :
        echo '<a target="_blank" class="button save_order button-primary" href="' . $revolut_link . '">Go to Revolut</a>';
    endif;
}
function wp_get_current_url()
{
    return home_url($_SERVER['REQUEST_URI']);
}



function custom_choose_an_option_script() {
    if (is_single(88511)) { // Replace 88511 with your specific post ID
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var selectElement = document.getElementById('package');
                if (selectElement) {
                    var firstOption = selectElement.querySelector('option:first-child');
                    if (firstOption && firstOption.text === 'Choose an option') {
                        firstOption.text = 'Choose an Option'; // Change "Choose an Option" to your desired text.
                    }
                }
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'custom_choose_an_option_script');


add_filter('wpcf7_form_elements', 'do_shortcode');

function wpb_modify_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js', false, time());
        wp_enqueue_script('jquery');
    }
}

// Execute the action when WordPress is initialized
add_action('init', 'wpb_modify_jquery');


function add_svg_to_upload_mimes($upload_mimes)
{
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}
add_filter('upload_mimes', 'add_svg_to_upload_mimes', 10, 1);


// Get geo targetted gifs

function get_geo_banner_gifs($country, $post_id)
{
    $gift_section = get_field('free_gift_info_section', $post_id);
    $geo_targeted_gif_title = $gift_section['geo_targeted_gif_title'];
    $default_gif = $geo_targeted_gif_title['default_gif'];
    $geo_targeted_gifs = $geo_targeted_gif_title['geo_targeted_gif'];
    foreach ($geo_targeted_gifs as $geo_targeted_gif) {
        $country_codes = explode(',', $geo_targeted_gif['country_code']);
        $country_codes = array_map('trim', $country_codes);
        if ($country_codes && is_array($country_codes) && in_array($country, $country_codes)) {
            return $geo_targeted_gif['gif_title'];
        }
    }
    return $default_gif;
}

function enqueue_slick_slider_scripts() {
    // Ensure jQuery is loaded (WordPress includes it by default, just enqueue it)
    wp_enqueue_script('jquery');

    // Slick CSS
    
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
    // Slick JS (depends on jQuery)
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);;
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider_scripts');

/**
 * Royal MCP — allow the AI (MCP user) to write the homepage "Search Courses"
 * ACF Options fields. Added 2026-08-17 per Ian's request.
 * Scoped to three option keys only; does NOT open options generally.
 */
add_filter( 'royal_mcp_writable_options', function ( $allowed ) {
	$allowed[] = 'options_search_page_about_text'; // founder note
	$allowed[] = 'options_course_search_text';     // first description block
	$allowed[] = 'options_course_search_title';    // H1 above both
	return $allowed;
} );

/**
 * Hire Wire — "For Careers Services" page (106518).
 * Styles were moved out of the page body into this stylesheet so editors using the
 * Visual tab can't strip them. All rules are scoped to .hwcs / .hwcs-* .
 */
add_action( 'wp_enqueue_scripts', function () {
	if ( is_page( 106518 ) ) {
		$rel  = '/assets/css/hire-wire-careers.css';
		$path = get_stylesheet_directory() . $rel;
		wp_enqueue_style(
			'ti-hire-wire-careers',
			get_stylesheet_directory_uri() . $rel,
			array(),
			file_exists( $path ) ? filemtime( $path ) : '1.0'
		);
	}
} );


// Former Customizer "Additional CSS", moved into /assets/css/custom/ on 26 Oct 2026.
// Printed at the same point WordPress prints Additional CSS (wp_head, priority 101,
// after every other stylesheet), so it still overrides theme and plugin styles exactly
// as before. Files load in filename order: the number prefixes keep the original order
// of the rules, so keep them when adding or splitting files. Add new CSS to these
// files (or a new numbered file), not to Appearance > Customize > Additional CSS.
add_action( 'wp_head', function () {
	$dir = get_stylesheet_directory() . '/assets/css/custom/';
	$uri = get_stylesheet_directory_uri() . '/assets/css/custom/';
	foreach ( (array) glob( $dir . '*.css' ) as $file ) {
		$name = basename( $file );
		printf(
			"<link rel='stylesheet' id='ti-custom-%s-css' href='%s?ver=%d' media='all' />\n",
			esc_attr( basename( $name, '.css' ) ),
			esc_url( $uri . $name ),
			filemtime( $file )
		);
	}
}, 101 );


// Headless layer for the Next.js front-end (render/routes/CORS endpoints).
// Fully self-contained in /headless — this is the ONLY line outside that folder.
// Turn it off with zero side effects: delete the /headless folder, remove this
// block, or define('TEFL_HEADLESS_DISABLE', true) in wp-config.php.
if ( ! defined( 'TEFL_HEADLESS_DISABLE' )
    && file_exists( get_stylesheet_directory() . '/headless/bootstrap.php' ) ) {
    include_once get_stylesheet_directory() . '/headless/bootstrap.php';
}
