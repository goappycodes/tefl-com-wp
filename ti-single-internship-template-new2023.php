<?php

/**
 * The template for displaying all single internship.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-internship
 *
 * @package Astra
 * @since 1.0.0
 */



if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
global $post;
$internship_id = $post->ID;
$clockdown = get_field('clockdown', 'option');
$internship_product_id = get_field('internship_product');
$internship_product = wc_get_product($internship_product_id);
$internship_price_html = '';
if ($internship_product) :
    $internship_price_html = $internship_product->get_price_html();
    $full_price = $internship_product->get_price(); 

    $deposit_enabled = get_post_meta($internship_product_id, '_wc_deposit_enabled', true);

    $deposit_payment_plan = '';

    if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional') {
        $deposit_payment_plan = get_post_meta($internship_product_id, '_wc_deposit_payment_plans', true);
        $deposit_payment_plan = $deposit_payment_plan[0];
    }
    $deposit_class = '';
    if($deposit_payment_plan): 
        $deposit_class = "deposit-full-price payment-plan-".$deposit_payment_plan;
    endif; 
    $query = "SELECT amount FROM `wp_wc_deposits_payment_plans_schedule` WHERE `schedule_index` = 0 AND `plan_id` = ".$deposit_payment_plan;
    $deposit_percent = $wpdb->get_var($query);
    $deposit_percent = round((float)$deposit_percent / 100, 5);
endif; 
$get_the_brochure = get_field('get_the_brochure');
$overview = get_field('overview');
$video = get_field('video');
$itinerary = get_field('itinerary');
$essential_informations = get_field('essential_information');
$fully_inclusive_programme = get_field('fully_inclusive_programme');
$location = get_field('location'); 
$cultural_excursions = get_field('cultural_excursions');

$show_alerts = get_field('show_alerts');
$register_for_alerts_link = get_field('register_for_alerts_link');

$show_eligibility_checker = get_field('show_eligibility_checker');
$eligibility_checker = get_field('eligibility_checker');
$country_name = get_field('country_name');
// $reviews_widget = get_field('reviews_widget');
$reviews_widget = get_field('reviews_widget','option');
$reviews_widget = array_filter($reviews_widget);
$total_reviews_count    = isset($reviews_widget['total_reviews']) ? $reviews_widget['total_reviews']: 1570;
$five_star_percentage   = isset($reviews_widget['star_percentage_5']) ? (float)$reviews_widget['star_percentage_5'] : 0;
$four_star_percentage   = isset($reviews_widget['star_percentage_4']) ? (float)$reviews_widget['star_percentage_4'] : 0;
$three_star_percentage  = isset($reviews_widget['star_percentage_3']) ? (float)$reviews_widget['star_percentage_3'] : 0;
$two_star_percentage    = isset($reviews_widget['star_percentage_2']) ? (float)$reviews_widget['star_percentage_2'] : 0;
$one_star_percentage    = isset($reviews_widget['star_percentage_1']) ? (float)$reviews_widget['star_percentage_1'] : 0;

$reviews_average = (($five_star_percentage * 5) + ($four_star_percentage * 4 ) + ($three_star_percentage * 3) + ($two_star_percentage * 2) + ($one_star_percentage * 1 ))/100;

?>

<div id="primary" <?php astra_primary_class(); ?>>

<?php
$hero_banner_section = get_field('hero_banner_section');
if(!empty($hero_banner_section)):
    $hero_image = $hero_banner_section['banner_image'];
    $hero_title = $hero_banner_section['hero_title'];
    $hero_subtitle = $hero_banner_section['hero_subtitle'];
    $hero_cta_text = $hero_banner_section['hero_cta_text'];
    $hero_cta_icon = $hero_banner_section['hero_cta_icon'];

?>
    <!-- Hero Banner Section -->
    <section class="hero-banner-section" style="background:url('<?php echo $hero_image?>')" >
        <?php
            $internship_common_hero_banner_logo = get_field('internship_common_hero_banner_logo', 'option');
            $banner_logo                        = $internship_common_hero_banner_logo['banner_logo'];
            $selected_internships               = $internship_common_hero_banner_logo['selected_internships'] ? $internship_common_hero_banner_logo['selected_internships'] : [];
            $show_internship_alternate_logo     = $internship_common_hero_banner_logo['show_internship_alternate_logo'];
            if($show_internship_alternate_logo){
                $alternate_internship_banner_logo  = $internship_common_hero_banner_logo['alternate_internship_banner_logo'];
                $alternate_selected_internships    = $internship_common_hero_banner_logo['alternate_selected_internship'] ? $internship_common_hero_banner_logo['alternate_selected_internship']:[];
                foreach($alternate_selected_internships as $internship){
                    $key  = array_search($internship, $selected_internships);
                    
                    if ($key !== false) {
                        unset($selected_internships[$key]);
                    }
                }
                $selected_internships = array_values($selected_internships);
            }
            if(in_array($internship_id,$selected_internships) && !empty($banner_logo)):
        ?>
            <img data-test="<?php echo $internship_id?>" src="<?php echo $banner_logo?>" class="internship-banner-logo" alt="">
        <?php
            endif;
            if($show_internship_alternate_logo && in_array($internship_id,$alternate_selected_internships) && !empty($alternate_internship_banner_logo)):
        ?>
             <img data-test="<?php echo $internship_id?>" src="<?php echo $alternate_internship_banner_logo?>" class="alt-internship-banner-logo internship-banner-logo" alt="">
        <?php
            endif;
        ?>
        <div class="float-bottom">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="hero-banner-section__content">
                        <div class="ast-col-md-8">
                            <h2 class="hero-banner-section__subtitle">
                                <?php echo $hero_subtitle?>
                            </h2>
                            <h1 class="hero-banner-section__title">
                                <?php echo $hero_title?>
                            </h1>
                        </div>
                        <div class="ast-col-md-4">
                            <?php 
                                if(have_rows('image_gallery')):
                            ?>
                                <div class="hero-banner-section__cta">
                                    <a href="#" class="open-gallery-btn">
                                        <img src="<?php echo $hero_cta_icon?>" alt="">
                                        <span><?php echo $hero_cta_text?></span>
                                    </a>
                                </div>
                            <?php
                                endif
                            ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div> 
    </section>
    <?php
        if(have_rows('image_gallery')):
    ?>
    <section class="image-gallery" style="display:none">
        <div class="image-gallery-overlay"></div>
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                <div class="image-gallery_container">

                    <?php 
                        $gallery_images = get_field('image_gallery');
                        foreach ( $gallery_images as $image ): 
                    ?>
                        <a href="<?php echo $image ?>">
                            <img src="<?php echo $image?>">
                        </a>
                    <?php 
                        endforeach 
                    ?>
                </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        endif
    ?>
    <!-- Hero Banner Section End -->

    <!-- Content Navigation -->
    <section class="content-nav-menu-section content-nav-menu-section-desktop <?php echo current_user_can('administrator')?'is-admin':''?>">
        <div class="nav-wrapper">
            <div class="ast-container">
                <div class="ast-row ">
                    <ul class="content-nav-menu">
                        <?php 
                        $overview = array_filter($overview);
                        if(!empty($overview)):?>
                            <li class="content-nav-menu__item">
                                <a href="#overview" class="content-nav-menu__link">
                                    overview
                                </a>
                            </li>
                        <?php endif?>
                        <?php if(have_rows('essential_information')):?>
                            <li class="content-nav-menu__item">
                                <a href="#tripInfo" class="content-nav-menu__link">
                                Trip Information
                                </a>
                            </li>
                        <?php endif?>
                        <?php if(have_rows('itinerary')):?>
                            <li class="content-nav-menu__item">
                                <a href="#itinerary" class="content-nav-menu__link">
                                    Itinerary
                                </a>
                            </li>
                        <?php endif?>
                        <?php if(have_rows('interns')):?>
                            <li class="content-nav-menu__item">
                                <a href="#testimonials" class="content-nav-menu__link">
                                    Testimonials
                                </a>
                            </li>
                        <?php endif?>
                        <?php 
                        $location = array_filter($location);
                        if(!empty($location)):?>
                            <li class="content-nav-menu__item">
                                <a href="#locations" class="content-nav-menu__link">
                                    Locations
                                </a>
                            </li>
                        <?php endif?>
                        <?php
                            $how_it_works = get_field('how_it_works');
                            $how_it_works = array_filter($how_it_works);
                            if(!empty($how_it_works)):
                        ?>
                            <li class="content-nav-menu__item">
                                <a href="#howItWorks" class="content-nav-menu__link">
                                    How It Works
                                </a>
                            </li>
                        <?php
                            endif
                        ?>
                        <?php
                            $cultural_excursions = array_filter($cultural_excursions);
                            if(!empty($cultural_excursions)):
                        ?>
                            <li class="content-nav-menu__item">
                                <a href="#excursions" class="content-nav-menu__link">
                                    Excursions
                                </a>
                            </li>
                        <?php
                            endif
                        ?>
                        
                    </ul>
                </div>
            </div>
        </div>
        
    </section>
    <?php if(current_user_can('administrator')):?>
        <div class="content-nav-menu-section content-nav-menu-section-mobile" style="display:none">
            <div class="nav-wrapper">
                <div class="glide nav-menu-glide">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <?php 
                            $overview = array_filter($overview);
                            if(!empty($overview)):?>
                                <li class=" glide__slide">
                                    <a href="#overview" class="glide-nav-link">
                                        overview
                                    </a>
                                </li>
                            <?php endif?>
                            <?php if(have_rows('essential_information')):?>
                                <li class="glide__slide">
                                    <a href="#tripInfo" class="glide-nav-link">
                                    Trip Information
                                    </a>
                                </li>
                            <?php endif?>
                            <?php if(have_rows('itinerary')):?>
                                <li class="glide__slide">
                                    <a href="#itinerary" class="glide-nav-link">
                                        Itinerary
                                    </a>
                                </li>
                            <?php endif?>
                            <?php if(have_rows('interns')):?>
                                <li class="glide__slide">
                                    <a href="#testimonials" class="glide-nav-link">
                                        Testimonials
                                    </a>
                                </li>
                            <?php endif?>
                            <?php 
                            $location = array_filter($location);
                            if(!empty($location)):?>
                                <li class="glide__slide">
                                    <a href="#locations" class="glide-nav-link">
                                        Locations
                                    </a>
                                </li>
                            <?php endif?>
                            <?php
                                $how_it_works = get_field('how_it_works');
                                $how_it_works = array_filter($how_it_works);
                                if(!empty($how_it_works)):
                            ?>
                                <li class="glide__slide">
                                    <a href="#howItWorks" class="glide-nav-link">
                                        How It Works
                                    </a>
                                </li>
                            <?php
                                endif
                            ?>
                            <?php
                                $cultural_excursions = array_filter($cultural_excursions);
                                if(!empty($cultural_excursions)):
                            ?>
                                <li class="glide__slide">
                                    <a href="#excursions" class="glide-nav-link">
                                        Excursions
                                    </a>
                                </li>
                            <?php
                                endif
                            ?>
                            
                        </ul>
                    </div>
                </div>                         
            </div>
        </div>

    <?php endif?>
    
    <div class="internship-content-container">
        <div class="ast-container">
            <div class="ast-row ast-flex sticky-sidebar__container ">
                <div class="ast-col-md-4">
                    <div class="sticky-sidebar <?php echo current_user_can('administrator')?'is-admin':''?>">
                        <div class="sticky-sidebar__top">          
                            <?php if($show_alerts) { ?>
                                <?php $country_name = get_field('country_name'); ?>
                                <h3 class="content-section__heading">Paid Internship in <?php echo $country_name; ?></h3>
                                <p>This internship is unavailable at the moment. If you wish to stay updated, sign up to the alert below and we will notify you when it is available.</p>
                                
                                <a href="<?php echo $register_for_alerts_link ?>" class="btn btn-primary">Register for Alerts</a>
                        
                            <?php } else 
                            { 
                                if(!is_global_timer_expired()):
                            ?>
                            <div class="internship-timer-new">
                                <?php 
                                    echo do_shortcode('[tefl_timer_shortcode_new timer="global"]'); 
                                ?>
                            </div>
                            <?php endif?>
                            <?php $ri_mode = ( function_exists("get_field") && get_field("register_interest_mode", get_queried_object_id()) ); if ( $ri_mode ) : ?>
                            <div class="sidebar-title">Interested in this programme?</div>
                            <div class="sidebar-menu-book-now">
                                <a href="#ri-form-modal" data-lity class="button book-now-btn ri-register-btn"><span>Register Your Interest</span><i class="fa fa-angle-right"></i></a>
                            </div>
                            <div id="ri-form-modal" class="lity-hide ri-form-popup" aria-hidden="true">
                                <h3 class="ri-form-popup__title">Register Your Interest</h3>
                                <p class="ri-intro">Tell us a little about yourself and we'll be in touch about this programme.</p>
                                <?php echo do_shortcode('[contact-form-7 id="110973" title="Internship - Register Your Interest"]'); ?>
                            </div>
                            <style>
                            .lity-container .ri-form-popup{background:#fff;max-width:560px;width:92vw;max-height:80vh;overflow-y:auto;-webkit-overflow-scrolling:touch;margin:4vh auto;padding:26px 30px 30px;border-radius:12px;text-align:left;box-shadow:0 24px 70px rgba(0,0,0,.28);}
                            .ri-form-popup__title{margin:0 0 4px;font-size:23px;line-height:1.2;color:#1c2b39;font-weight:700;}
                            .ri-form-popup .ri-intro{margin:0 0 18px;color:#6b7785;font-size:14px;line-height:1.4;}
                            .ri-form-popup .register-interest-form p{margin:0;}
                            .ri-form-popup .register-interest-form p.ri-field{margin:0 0 15px;}
                            .ri-form-popup .register-interest-form label{font-weight:600;display:block;font-size:14px;color:#2b3a4a;margin-bottom:5px;}
                            .ri-form-popup .register-interest-form input:not([type=submit]):not([type=checkbox]):not([type=radio]),.ri-form-popup .register-interest-form select{width:100%;padding:10px 12px;border:1px solid #d4dae0;border-radius:7px;font-size:15px;background:#fff;box-sizing:border-box;}
                            .ri-form-popup .register-interest-form .intl-tel-input,.ri-form-popup .register-interest-form .iti{width:100%;}
                            .ri-form-popup .register-interest-form input:focus,.ri-form-popup .register-interest-form select:focus{border-color:#14a098;outline:none;box-shadow:0 0 0 3px rgba(20,160,152,.15);}
                            .ri-form-popup .wpcf7-list-item{display:inline-flex;align-items:center;gap:6px;margin:0 14px 7px 0;font-weight:400;}
                            .ri-form-popup .wpcf7-list-item-label{font-weight:400;}
                            .ri-form-popup .ri-consent{font-size:13px;color:#51606e;line-height:1.45;}
                            .ri-form-popup .ri-consent .wpcf7-list-item{display:inline;margin:0 6px 0 0;}
                            .ri-form-popup .ri-req{color:#e2363a;}
                            .ri-form-popup .ri-hint{color:#8893a0;font-size:12px;display:block;margin-top:4px;}
                            .ri-form-popup input[type=file]{font-size:14px;padding:6px 0;}
                            .ri-form-popup .wpcf7-submit{display:block;width:100%;margin-top:8px;padding:13px 18px;background:#14a098;color:#fff;border:0;border-radius:8px;font-size:16px;font-weight:700;cursor:pointer;transition:background .15s;}
                            .ri-form-popup .wpcf7-submit:hover{background:#0f827b;}
                            .ri-form-popup .wpcf7-not-valid-tip{color:#e2363a;font-size:12px;margin-top:3px;}
                            .ri-form-popup .wpcf7-response-output{border-radius:7px;font-size:14px;margin:14px 0 0;padding:12px 14px;}
                            .lity-container .ri-form-popup::-webkit-scrollbar{width:8px;}
                            .lity-container .ri-form-popup::-webkit-scrollbar-thumb{background:#cdd4da;border-radius:4px;}
                            .ri-form-popup .ri-thankyou{text-align:center;padding:14px 6px 8px;}
                            .ri-form-popup .ri-thankyou__tick{width:64px;height:64px;line-height:64px;margin:0 auto 16px;border-radius:50%;background:#14a098;color:#fff;font-size:34px;font-weight:700;}
                            .ri-form-popup .ri-thankyou h3{margin:0 0 10px;font-size:23px;color:#1c2b39;font-weight:700;}
                            .ri-form-popup .ri-thankyou p{margin:0 auto;max-width:420px;color:#51606e;font-size:15px;line-height:1.55;}
                            </style>
                            <script>
                            (function(){
                              var FORM_ID = 110973;
                              function closeLity(){
                                var popup = document.querySelector('.lity-container .ri-form-popup');
                                var root  = popup ? popup.closest('.lity') : null;
                                var btn   = root ? root.querySelector('.lity-close') : document.querySelector('.lity-close');
                                if (btn) { btn.click(); }
                              }
                              document.addEventListener('wpcf7mailsent', function(e){
                                if (parseInt(e.detail.contactFormId,10) !== FORM_ID) return;
                                var popup = document.querySelector('.lity-container .ri-form-popup') || document.getElementById('ri-form-modal');
                                if (popup) {
                                  var m = (e.detail.apiResponse && e.detail.apiResponse.message) ? e.detail.apiResponse.message : 'Thank you! Your interest has been registered — we’ll be in touch shortly.';
                                  popup.innerHTML = '<div class="ri-thankyou"><div class="ri-thankyou__tick">✓</div><h3>Thank you!</h3><p>' + m + '</p></div>';
                                  popup.scrollTop = 0;
                                }
                                setTimeout(closeLity, 6000);
                              }, false);
                              ['wpcf7invalid','wpcf7spam','wpcf7mailfailed'].forEach(function(ev){
                                document.addEventListener(ev, function(e){
                                  if (parseInt(e.detail.contactFormId,10) !== FORM_ID) return;
                                  setTimeout(function(){
                                    var out = document.querySelector('.lity-container .ri-form-popup .wpcf7-response-output');
                                    if (out) { out.scrollIntoView({behavior:'smooth', block:'center'}); }
                                  }, 60);
                                }, false);
                              });
                            })();
                            </script>
                            <?php else : ?>
                            <div class="sidebar-title">Upcoming Start Dates</div>
                                <?php if ($internship_price_html) : ?>
                                    <div class="sidebar-menu-book-now">
                                        <?php if(get_post_type($internship_product_id) == 'product') : ?>
                                            <?php if(!$internship_product->is_in_stock()) : ?>
                                                <small style="display:block;line-height: 1.25;font-size: 100%;text-align: center;" class="text-secondary">Please <a href="/contact/">contact</a> our team if you would like your name to be added to our waiting list for when the programme re-opens again.</small>
                                            <?php else : ?>

                                                <?php if($internship_product->is_type('simple')) : ?>
                                                    <a href="<?php echo '/?addtimetocart&prid='.$internship_product_id.'&date='; ?>" class="button book-now-btn"><span>Book Now</span><i class="fa fa-angle-right"></i></a>
                                                <?php elseif($internship_product->is_type('variable')) :
                                                    $course_product_post = get_post($internship_product_id);
                                                    setup_postdata( $course_product_post );    		      
                                                    woocommerce_variable_add_to_cart();
                                                    wp_reset_postdata(); ?>
                                                    <div id="priceWrapper" data-depositpercent = "<?php echo $deposit_percent?>" class="internship-price <?php echo $deposit_class;?>">
                                                        <?php echo $internship_price_html; ?>
                                                    </div>
                                                    <div class="deposit-breakdown">
                                                        <?php if ($deposit_payment_plan) : ?>
                                                            <?php //include('includes/ti-deposit-form.php'); ?>
                                                            <?php wp_enqueue_script('ti-deposit-form-js'); ?>
                                                        <?php endif; ?>
                                                        <?php 
                                                            if( $deposit_enabled == 'forced' || $deposit_enabled == 'optional' ):
                                                        ?>
                                                            <!-- <div class="installments-breakdown">
                                                                <div
                                                                    class="ajax-snippet" 
                                                                    data-snippet="installment_breakdown"
                                                                    data-objectid="<?php echo $internship_product_id; ?>"
                                                                >
                                                                </div>
                                                                <div id="loader" class="loader">
                                                                    Fetching installment breakdown details <img src="/wp-content/uploads/2022/11/loading-yellow.gif" alt="fetching deposit details">
                                                                </div>
                                                            </div> -->
                                                        <?php 
                                                            endif;
                                                        ?>
                                                    </div>
                                                    <a disabled="disabled" rel="nofollow" href="/?addtimetocart&prid=<?php echo $internship_product_id; ?>" class="button book-now-btn variable-book-now-btn atc-disabled">Book Now</a>                                
                                                <?php endif; ?> 
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; // register_interest_mode ?>
                                        
                            <?php } 
                            ?>
                            <?php if ( empty($ri_mode) ) : ?>
                            <a href="<?php echo $eligibility_checker['button']['button_link']; ?>" class=" screening-btn "><?php echo $eligibility_checker['button']['button_value']; ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="sticky-sidebar__bottom">
                            <h4 class="sticky-sidebar__bottom-heading">
                                verified student reviews
                            </h4>
                            <div class="rating-div">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-empty"></i>
                                <span class="course-review-count">(<?php echo $reviews_average; ?>)</span>
                            </div>
                            <div class="total-count-text">Out of <?php echo $total_reviews_count ?> global reviews</div>
                            <div class="reviews-summary">
                                <?php for($i=5; $i>=1; $i--) :
                                    $star_percentage = $reviews_widget['star_percentage_'.$i]; 
                                    if(empty($star_percentage)): 
                                        $star_percentage = 0;
                                    endif; ?>
                                    <div class="review-status">
                                        <div class="progress-text"><?php echo $i; ?> Star</div>
                                        <div class="progress">
                                            <div class="progress-bar" percent="<?php echo $star_percentage; ?>">
                                            </div>
                                        </div>
                                        <div class="progress-value"><?php echo $star_percentage; ?>%</div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ast-col-md-8">
                    <?php
                        $internship_summary = get_field('internship_summary');
                        if(!empty($internship_summary)):
                            $title = $internship_summary['title'];
                            $subtitle = $internship_summary['subtitle'];
                            $details = $internship_summary['details'];
                            $video = $internship_summary['video'];
                    ?>
                    <div class="internship-summary">
                        <h2 class="internship-summary__title">
                            <?php echo $title?>
                        </h2>
                        <h3 class="internship-summary__subtitle">
                            <?php echo $subtitle?>
                        </h3>
                        <div class="internship-summary__details">
                            <?php echo $details?>
                        </div>
                        <?php if ($video) : 
                            $video_thumbnail = $video['thumbnail'];
                            $video_id = $video['link'];
                            if ($video_id) : ?>
                                <div class="internship-summary__video" style="background: url('<?php echo $video_thumbnail; ?>');">
                    				<a href="https://youtu.be/<?php echo $video_id; ?>" data-lity="" class="video-caption-link clickbox lity-video">
                    		            
                        		    </a>		
                                    <span class="video-icon "><img src="/wp-content/uploads/2021/10/Play-button.svg"></span>		
        			            </div>
    			            <?php endif; ?>
			            <?php endif; ?>
                    </div>
                    <?php
                        endif
                    ?>
                    <?php 
                        if(!empty($overview)):
                            $overview_title = $overview['section_title'];
                            $overview_summary = $overview['section_summary'];
                    ?>
                        <section id="<?php echo strtolower($overview_title)?>" class="content-section section-padding-top">
                            <h2 class="content-section__heading">
                                <?php echo $overview_title?>
                            </h2>
                            <div class="content-section__body">
                                <?php echo $overview_summary?>
                            </div>
                        </section>
                    <?php
                        endif
                    ?>
                    <?php
                        if(have_rows('essential_information')):
                    ?>
                        <section id="tripInfo" class="essential-informations section-margin-top">
                            <h3 class="essential-informations__heading">
                                Essential information 
                                <?php echo !empty($country_name)?' about your trip to '.$country_name:''?>
                            </h3>
                            <?php 
                                foreach($essential_informations as $key => $essential_information):
                                    $title = $essential_information['title'];
                                    $info_items = $essential_information['list'];
                            ?>
                            <details class="essential_information__accordion" <?php echo $key === 0?'open':''?>>
                                <summary > 
                                    <?php echo $title?>
                                    <i class="fa fa-angle-down"></i>
                                </summary>
                                <div class="content">
                                    <ul class="essential_information__list">
                                        <?php
                                            foreach($info_items as $item):
                                                $list_item = $item['item'];
                                        ?>
                                            <li>
                                                <?php echo $list_item?>
                                            </li>
                                        <?php
                                            endforeach
                                        ?>
                                    </ul>
                                </div>
                            </details>
                            <?php
                                endforeach
                            ?>
                        </section>
                    <?php
                        endif
                    ?>
                </div>
            </div>
        </div>
        <?php 
            if($show_eligibility_checker): ?>
            <div class="section-margin-top full-section eligibility-checker-section" style="background-image: url('<?php echo $eligibility_checker['background_image']; ?>');">
                <div class="ast-container">
                    <div class="ast-row">
                        <div class="ast-col-md-8 ast-col-md-offset-4">
                            <div class="eligibility-checker">
                            <h3 class="eligibility-checker__title">
                                <?php echo $eligibility_checker['title']; ?>
                            </h3>
                            <div class="eligibility-checker__summary"><?php echo $eligibility_checker['content']; ?></div>
                            <a href="<?php echo $eligibility_checker['button']['button_link']; ?>" class="button"><?php echo $eligibility_checker['button']['button_value']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            endif;
        ?>
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-4 empty-row">
                            
                </div>
                <div class="ast-col-md-8 ast-col-md-offset-4">
                    <?php
                        if(have_rows('itinerary')):
                            $itinerary__title = $itinerary['section_title'];
                            $itinerary__timeline = $itinerary['timeline'];
                    ?>
                        <section id="itinerary" class="content-section section-padding-top">
                            <h3 class="content-section__heading">
                                <?php echo $itinerary__title?>
                            </h3>
                            <div class="content-secton__body">
                                <div class="content-section__body-wrapper">
                                    <?php 
                                        foreach($itinerary__timeline as $key => $timeline):
                                            $timeline_day = $timeline['day'];
                                            $timeline_title = $timeline['title'];
                                            $timeline_desc = $timeline['description'];
                                    ?>
                                        <div class="accordion itinerary-accordion">
                                            <input class="accordion__trigger" id="accordion-drawer-<?php echo $key?>" type="checkbox" <?php echo $key === 0?'checked':'' ?>/>
                                            <label class="accordion__title" for="accordion-drawer-<?php echo $key?>">
                                                <span class="accordion__title-day">
                                                    <?php echo $timeline_day?>
                                                </span>
                                                <span class="accordion__title-text">
                                                    <?php echo $timeline_title?>
                                                </span>
                                            </label>
                                            <div class="accordion__content-wrapper">
                                                <div class="accordion__content">
                                                    <?php echo $timeline_desc?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                        endforeach;
                                    ?>
                                </div>
                            </div>
                        </section>
                    <?php
                        endif;
                    ?>
                    <?php 
                        $interns = get_field('interns');
                        $intern_section_header = get_field('interns_section_header'); 
                        if(have_rows('interns')) :
                    ?>
                        <section id="testimonials" class="content-section section-padding-top">
                            <h3 class="content-section__heading">
                                <?php echo $intern_section_header?>
                            </h3>
                            <div class="content-section_body testimonials">
                                <?php 
                                    foreach($interns as $key => $intern):
                                        $image = $intern['image'];
                                        $name = $intern['name'];
                                        $content = $intern['content'];
                                        $link = $intern['link'];
                                ?>
                                <div class="testimonial-card">
                                    <a href="<?php echo $link?>" class="clickbox"></a>
                                    <div class="testimonia-card__left">
                                        <img src="<?php echo $image?>" alt="" class="testimonial-card__image">
                                        <h4 class="testimonial-card__title">
                                            <?php echo $name?>
                                        </h4>
                                    </div>
                                    <div class="testimonial-card__right">
                                        <div class="testimonial-card__content">
                                            <?php echo $content?>
                                        </div>
                                        <a href="<?php echo $link?>" class="testimonial-card__link">Read More</a>
                                    </div>
                                </div>
                                <?php
                                    endforeach
                                ?>
                            </div>
                        </section>
                    <?php
                        endif
                    ?>
                </div>
            </div>
        </div>
        <?php 
            if(!empty(get_field('full_width_banner_image'))): 
        ?>
            <div class="section-margin-top full-section full-image-banner" style="background-image: url('<?php echo get_field('full_width_banner_image'); ?>'); height: 500px;background-size: cover;background-repeat: no-repeat;background-position: center;">
            </div>
        <?php
            endif;
        ?>
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-4 empty-row">

                </div>
                <div class="ast-col-md-8">
                    <?php 
                        if(!empty($location)):
                            $section_summary = $location['content'];
                            $location_map = $location['map'];
                            $group_size = $location['group_size'];
                            $availability = $location['availability'];
                            $form_header_image = get_field('form_header_image','options');
                    ?>
                        <section id="locations" class="location-section content-section section-padding-top">
                            <h3 class="content-section__heading">
                                Locations
                            </h3>
                            <div class="content-section__body">
                                <div class="location-section__summary">
                                    <?php echo $section_summary?>
                                </div>
                                <div class="location-section__map">
                                    <img src="<?php echo $location_map?>" alt="">
                                </div>
                                <div class="location-section__size-availability">
                                    <div class="location-section__size">
                                        <span>
                                            Group size
                                        </span>
                                        <span>
                                            <?php echo $group_size?>
                                        </span>
                                    </div>
                                    <div class="location-section__availability">
                                        <span>
                                            availability
                                        </span>
                                        <span>
                                            <?php echo $availability?>
                                        </span>
                                    </div>
                                </div>
                                <div class="location-section__form">
                                    <h3 class="content-section__heading">
                                        <?php echo get_field('form_title','option')?>
                                    </h3>
                                    <div class="location-section__form-summary">
                                    If you are interested in teaching English in <?php echo $country_name?> and would like to learn more, request a call with one of our experienced travel advisors about this opportunity.
                                    
                                    </div>
                                    <img class="location-section__form-image" src="<?php echo $form_header_image?>"/>
                                    <?php echo do_shortcode('[contact-form-7 id="57896" title="Want to Learn More?"]'); ?>
                                </div>
                            </div>
                        </section>    
                    <?php endif?>
                </div>
            </div>
        </div>

        <script>
            var page_url = "<?php echo get_permalink(); ?>";
            var page_title = "<?php single_post_title(); ?>";

            jQuery(document).ready(function($) {
                $("#page_url").val(page_url);
                $("#page_title").val(page_title);
            });
        </script>

        <?php 
            if(!empty(get_field('full_width_banner_2'))): 
        ?>
            <div class="section-margin-top full-section full-image-banner" style="background-image: url('<?php echo get_field('full_width_banner_2'); ?>'); height: 500px;background-size: cover;background-repeat: no-repeat;background-position: bottom;">
            </div>
        <?php
            endif;
        ?>
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-4 empty-row">

                </div>
                <div class="ast-col-md-8">
                    <?php
                       if(!empty($how_it_works)):
                        $section_title = (!isset($section_title) || empty($section_title)) ? "how it works" : $how_it_works['title'];
                        $section_summary = $how_it_works['description'];
                    ?>
                        <section id="howItWorks" class="how-it-works-section content-section section-padding-top">
                            <h3 class="content-section__heading">
                                <?php echo $section_title?>
                            </h3>
                            <div class="content-section__body">
                                <div class="how-it-works-section__summary">
                                    <?php echo $section_summary?>
                                </div>
                                <div class="straigh-line"></div>
                                <div class="how-it-works-section__steps">
                                    <div class="step">
                                        <span class="step__number">1</span>
                                        <div class="step__text">Apply</div>
                                    </div>
                                    <div class="step">
                                        <span class="step__number">2</span>
                                        <div class="step__text">Interview</div>
                                    </div>
                                    <div class="step">
                                        <span class="step__number">3</span>
                                        <div class="step__text">Documents</div>
                                    </div>
                                    <div class="step">
                                        <span class="step__number">4</span>
                                        <div class="step__text">Teach</div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            $guide = get_field('guide');
                            $guide_popup = get_field('guide_popup');
                            $guide = array_filter($guide);
                            $guide_popup = array_filter($guide_popup);
                            if(!empty($guide)):
                                $guide_title = $guide['title'];
                                $guide_image = $guide['preview_image'];
                                $guide_content = $guide['content'];
                                $guide_button_text = $guide['guide_button_text'];
                                $guide_button_url = $guide['guide_button_url'];
                                if(!empty($guide_popup)){
                                    $popup_image = $guide_popup['popup_image'];
                                    $popup_title = $guide_popup['popup_title'];
                                }
                                ?>
                                <div id="guide" class="internship-guide" data-guide-popup=<?php echo (!empty($guide_popup['popup_image']) && !empty($guide_popup['popup_url']))?'yes':'no'?>>
                                    <h3 class="content-section__heading">
                                        <?php echo $guide_title?>
                                    </h3>
                                    <div class="internship-guide__summary">
                                        <?php echo $guide_content?>
                                    </div>
                                    <img src="<?php echo $guide_image?>" alt="" class="internship-guide__image">
                                    <a href="<?php echo $guide_button_url; ?>" class="guide-link button">
                                        <?php echo $guide_button_text; ?>
                                    </a>
                                </div>
                            <?php
                                endif;
                            ?>
                        </section>
                    <?php
                        endif;
                    ?>
                    <?php
                        if(!empty($cultural_excursions)):
                            $section_title = (!isset($section_title) || empty($section_title)) ? "Cultural Excursions" : $cultural_excursions['section_title'];
                            $section_summary = $cultural_excursions['content'];
                            $excursions = $cultural_excursions['cultural'];
                    ?>
                        <section id="excursions" class="excursions-section content-section section-padding-top">
                            <h3 class="excursions-section__heading content-section__heading">
                                <?php echo $section_title?>
                            </h3>
                            <div class="content-section__body">
                                <div class="excursions-section__summary">
                                    <?php echo $section_summary?>
                                </div>
                                <div class="excursions-section__excursions">
                                    <?php
                                        foreach($excursions as $key => $excursion):
                                            $image = $excursion['image'];
                                            $image_title = $excursion['image_title'];
                                            $title = $excursion['title'];
                                            $content = $excursion['content'];
                                    ?>
                                        <div class="excursion-card">
                                            <div class="excursion-card__left">
                                                <img src="<?php echo $image?>" alt="" class="excursion-card__image">
                                                <h4 class="excursion-card__image-title">
                                                    <?php echo $image_title?>
                                                </h4>
                                            </div>
                                            <div class="excursion-card__right">
                                                <h4 class="excursion-card__title">
                                                    <?php echo $title?>
                                                </h4>
                                                <div class="excursion-card__details">
                                                    <?php echo $content?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        endforeach
                                    ?>
                                </div>
                            </div>
                        </section>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
        </div>
        <!-- Student Reviews Function -->
            <?php
            if(!empty($reviews_widget)):
            ?>
            <section class="students-review section-margin-top">
                <div class="ast-container">
                    <div class="ast-row ast-flex students-review-row">
                        <div class="ast-col-md-12">
                            <div class="students-review__content">
                                <h3 class="students-review__content-heading content-section__heading">
                                    verified student reviews
                                </h3>
                                <div class="rating-div">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span class="course-review-count">(<?php echo $reviews_average; ?>)</span>
                                </div>
                                <div class="total-count-text">Out of <?php echo $total_reviews_count ?> global reviews</div>
                                <div class="students-review__content-slider">
                                    <?php echo do_shortcode('[brb_collection id="76915"]'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="button-container text-center">
                            <a target="_blank" href="https://search.google.com/local/reviews?placeid=ChIJR8_41hsMZ0gR2i2CJcrWIf8" class="read-more-reviews">
                                read all reviews
                            </a>
                        </div>
                    </div>
                </div>
            
                
            </section>
            <?php endif?>

        <!-- Student Reviews Function End -->

        <!-- Learn More Section -->

        <?php
            $learn_more_section = get_field('learn_more_section','option');
            if(!empty($learn_more_section)):
                $section_heading = $learn_more_section['section_heading'];
                $section_summary = $learn_more_section['section_summary'];
                $CTA_btn_text = $learn_more_section['section_cta_button_text'];
                $CTA_btn_link = $learn_more_section['section_cta_button_link'];
        ?>
            <section class="learn-more-section">
                <div class="ast-container">
                    <div class="ast-row ">
                        <div class="ast-col-md-7">
                            <h2 class="learn-more-section__heading">
                                <?php echo $section_heading?>
                            </h2>
                            <div class="learn-more-section__summary">
                                <?php echo $section_summary?>
                            </div>
                        </div>
                        <div class="ast-col-md-5">
                            <a class="learn-more-section__btn btn-black btn" href="<?php echo $CTA_btn_link?>">
                                <?php echo $CTA_btn_text?>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        <?php
            endif;
        ?>                                       

        <!-- Learn More Section End -->
    </div>

    <!-- Content Navigation End -->

    
<?php 
endif?>
</div><!-- #primary -->



<?php get_footer(); ?>
