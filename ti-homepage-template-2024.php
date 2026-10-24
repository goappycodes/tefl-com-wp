<?php

/**
 * Template Name: Homepage Template 2024
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram Rana <bikram@appycodes.com>
 * @date October 2024
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();
$reviews_widget = get_field('reviews_widget','option');
$total_reviews_count    = isset($reviews_widget['total_reviews']) ? $reviews_widget['total_reviews']: 1570;
$five_star_percentage   = isset($reviews_widget['star_percentage_5']) ? (float)$reviews_widget['star_percentage_5'] : 0;
$four_star_percentage   = isset($reviews_widget['star_percentage_4']) ? (float)$reviews_widget['star_percentage_4'] : 0;
$three_star_percentage  = isset($reviews_widget['star_percentage_3']) ? (float)$reviews_widget['star_percentage_3'] : 0;
$two_star_percentage    = isset($reviews_widget['star_percentage_2']) ? (float)$reviews_widget['star_percentage_2'] : 0;
$one_star_percentage    = isset($reviews_widget['star_percentage_1']) ? (float)$reviews_widget['star_percentage_1'] : 0;

$reviews_average = (($five_star_percentage * 5) + ($four_star_percentage * 4 ) + ($three_star_percentage * 3) + ($two_star_percentage * 2) + ($one_star_percentage * 1 ))/100;
?>
<div id="primary" <?php astra_primary_class(); ?>>
    <!-- Hero Banner Section -->
    <div class="full-width-slider" >
        <?php
            echo "test";
            $hero_banner = get_field('hero_banner');
            $banner = $hero_banner['banner'];
            foreach($banner as $key=>$hb):
                $banner_bg = $hb['background_image'];
                $banner_bg_mobile = $hb['background_image_mobile'];
                $has_overlay = $hb['banner_overlay'];
                $show_banner_logo = $hb['show_banner_logo'];
                if($show_banner_logo){
                    $banner_logo = $hb['banner_logo'];
                    $banner_logo_link = $hb['banner_logo_link'];
                    $show_logo_clockdown = $hb['show_clockdown'];
                }
                $content_box = $hb['content_box'];
                $show_offer_bubble = $hb['show_offer_bubble'];
                if($show_offer_bubble){
                    $offer_bubble = $hb['offer_bubble'];
                    $bubble_content = $offer_bubble['bubble_content'];
                    $bubble_color = $offer_bubble['bubble_color'];
                }
        ?>
            
            <section class="<?php echo $has_overlay?'has-overlay':''?> banner-slide banner-slide-<?php echo $key?>" style="background:url('<?php echo $banner_bg?>')">
                <div class="ast-container">
                    <div class="ast-row banner-slide-row">
                        <div class="ast-col-md-7">
                            <?php
                                $is_offer = $content_box['is_offer'];
                                $title = $content_box['title'];
                                $subtitle = $content_box['subtitle'];
                                if($is_offer){
                                    $title_box_bg_color = $content_box['title_box_bg_color'];
                                    $title_text_color = $content_box['title_text_color'];
                                }
                                $summary = $content_box['summary'];
                                $cta_buttons = $content_box['cta_buttons'];
                                $show_clockdown = $content_box['show_clockdown'];
                                $show_accreditation = $content_box['show_accreditation'];
                                if($show_accreditation){
                                    $accreditations = $content_box['accreditations'];
                                }
                            ?>
                            <div class="banner-slide__content <?php echo $is_offer?'offer-content':''?>">
                                <?php if(!empty($title)):?>
                                    <?php if ($is_offer): ?>
                                        <h1 style="background:<?php echo $title_box_bg_color?>; color:<?php echo $title_text_color ?>" class=" banner-slide__content-title common-section-heading">
                                            <?php echo $title ?>
                                        </h1>
                                    <?php else: ?>
                                        <h1 class=" banner-slide__content-title common-section-heading">
                                            <?php echo $title ?>
                                        </h1>
                                    <?php endif; ?>
                                        <h2 class=" font-300 banner-slide__content-subtitle">
                                            <?php echo $subtitle?>
                                        </h2>
                                <?php endif?>
                                <div class="banner-slide__content-summary">
                                    <?php echo $summary?>
                                </div>
                                
                                <div class="banner-slide__content-links">
                                    <?php
                                        foreach($cta_buttons as $cta_btn):
                                    ?>
                                    <a href="<?php echo $cta_btn['cta_link']?>" class="btn btn-white">
                                        <span><?php echo $cta_btn['cta_text']?></span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    <?php
                                        endforeach
                                    ?>
                                </div>
                                <?php if($show_accreditation && !is_array_empty($accreditations)):?>
                                    <div class="accreditations-container">
                                        <?php
                                            foreach($accreditations as $key => $accreditation):
                                                $accred_title = $accreditation['title'];
                                                $accred_logo = $accreditation['logo'];
                                                $accred_desc = $accreditation['description'];
                                                $country_icon = $accreditation['country_icon'];
                                        ?>
                                            <div class="accreditation">
                                                <span class="accreditation-title">
                                                    <img src="<?php echo $country_icon?>" alt="" class="no-lazy">
                                                    <?php echo $accred_title?>
                                                </span>
                                                <img src="<?php echo $accred_logo?>" alt="" class="no-lazy accreditation-logo">
                                                <span class="accreditation-description">
                                                    <?php echo $accred_desc?>
                                                </span>
                                            </div>
                                        <?php 
                                            endforeach;
                                        ?>
                                    </div>
                                <?php endif?>
                                <div class="google-reviews">
                                    <div>
                                        Our customer say <b>Excellent</b> 
                                        <img class="no-lazy" src="/wp-content/uploads/2024/10/banner_reviews_stars.png" alt="">
                                    </div>
                                    <div>
                                        <span class="course-review-count font-700">
                                            <?php echo $reviews_average; ?>
                                        </span> 
                                        out of 5 based on <b class="font-700"><?php echo $total_reviews_count ?></b> global reviews 
                                        <img class = "no-lazy" src="/wp-content/uploads/2024/10/google_white.png" alt="">
                                    </div>
                                </div>
                                <a target="_blank" href="https://search.google.com/local/reviews?placeid=ChIJaeBYjIqxe0gR8IEtXkiDSWo" class="view-reviews-btn btn">
                                    <span>VIEW ALL REVIEWS</span>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ast-col-md-5">
                            <div class="banner-slide__content-logo-container">
                                <?php if ($show_banner_logo && !empty($banner_logo)): ?>
                                    <div class="logo-clock-container">
                                        <?php if (empty($banner_logo_link)): ?>
                                            <img src="<?php echo $banner_logo ?>" class="no-lazy banner-slide__content-logo" alt="">
                                        <?php else: ?>
                                            <a href="<?php echo $banner_logo_link ?>">
                                                <img src="<?php echo $banner_logo ?>" class="no-lazy banner-slide__content-logo" alt="">
                                            </a>
                                        <?php endif; ?>
                                        <?php 
                                            if($show_logo_clockdown){
                                                echo do_shortcode('[flip_countdown_timer]');
                                            }
                                        ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                    if($show_offer_bubble):
                                ?>
                                    <div class="offer-bubble" style="background:<?php echo $bubble_color?>;box-shadow: <?php echo $bubble_color?> 0px 22px 70px 4px;">
                                        <?php echo $bubble_content?>
                                    </div>
                                <?php
                                    endif;
                                ?>
                                <?php if($show_clockdown):
                                    // $expiry_date = $content_box['offer_end_date'];
                                    $expiry_date = get_field('timer_expiry', 'option');
                                    $expiry_date_unix = strtotime($expiry_date);
                                    $date_today       = date('l, F d y h:i:s');
                                    $date_today_unix  = strtotime($date_today);
                                    $promo_offer_end_date = date("l jS F", $expiry_date_unix); 
                                     if($date_today_unix < $expiry_date_unix):   
                                ?>
                                    <div class="d-none banner-slide-content__timer__outer">
                                        <div class="banner-slide-content__timer">
                                            <span>Offer ends <?php echo $promo_offer_end_date?></span>
                                            <?php echo do_shortcode('[tefl_timer_shortcode]');?>
                                            <h6 class="d-none text-center banner-slide-content__timer-end-text font-600">
                                                left to save
                                            </h6>
                                        </div>
                                    </div>
                                <?php endif;
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
            endforeach;
        ?>
    </div>
    <!-- Hero Banner Section End -->

    <!-- Brand Features -->

    <?php
        $brand_features = get_field('brand_features');
        $features = $brand_features['features'];
        if(!is_array_empty($features)):      
    ?>
        <section class="brand-features-section">
            <div class="ast-container">
                <div class="brand-features-row">
                    <div class="ast-row">
                        <?php foreach($features as $key => $feature):
                            $feature_icon = $feature['icon'];
                            $feature_tite = $feature['title'];
                            $feature_desc = $feature['description'];     
                        ?>
                            <div class="ast-col-md-4">
                                <div class="brand-feature">
                                    <div class="brand-feature__left">
                                        <img src="<?php echo $feature_icon?>" class="no-lazy" alt="">
                                    </div>
                                    <div class="brand-feature__right">
                                        <h3 class="font-700"><?php echo $feature_tite?></h3>
                                        <h4 class="font-200"><?php echo $feature_desc?></h4>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach?>
                    </div>
                </div>
            </div>
        </section>
    <?php
        endif;
    ?>

    <!-- Brand Features End -->

    <!-- Search Courses -->

    <section class="tefl-search-section pt-3">
        <div class="ast-container">
            <div class="tefl-search">
                <h2 class=" common-section-heading tefl-search-section__title text-center">
                    Find The Perfect TEFL Course
                </h2>
                <?php echo do_shortcode('[tefl_course_search]'); ?>
            </div>
        </div>
    </section>

    <!-- Search Courses End -->

    <!-- CTA Buttons -->

    <?php
        $cta_buttons = get_field('cta_buttons');
        if(!is_array_empty($cta_buttons)):
    ?>

        <section class="py-3 cta-buttons-section">
            <div class="ast-container">
                <div class="ast-row">
                    <?php
                        foreach($cta_buttons as $key => $cta_button):
                            $button_text = $cta_button['button_text'];
                            $button_link = $cta_button['button_link'];
                    ?>
                        <div class="ast-col-md-4 cta-button">
                            <a href="<?php echo $button_link ?>" class="btn btn-primary">
                                <span><?php echo $button_text ?></span>
                                <i class="fa fa-angle-right"></i>
                            </a>
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
    <!-- CTA Buttons end -->

    <!-- Who Can Take the course -->

    <?php
        $who_can_take_the_course = get_field('who_can_take_the_course');
        if(!is_array_empty($who_can_take_the_course));
            $section_title = $who_can_take_the_course['section_title'];
            $who_can_take = $who_can_take_the_course['who_can_take'];
            
    ?>

        <section class="ast-container">
            <div class="who-can-the-course-row">
                <div class="ast-row">
                    <h2 class=" common-section-heading text-center">
                        <?php echo $section_title?>
                    </h2>
                    <?php
                        foreach($who_can_take as $key => $wct):
                            $wct_icon = $wct['icon'];
                            $wct_desc = $wct['description'];
                    ?>
                        <div class="ast-col-md-4">
                            <div class="wct-wrapper text-center">
                                <img src="<?php echo $wct_icon?>" alt="" class="no-lazy wct-icon">
                                <div class="wct-desc">
                                    <?php echo $wct_desc?>
                                </div>
                            </div>
                        </div>
                    <?php
                        endforeach
                    ?>
                </div>
            </div>
        </section>

    <?php?>

    <!-- Who can take the course End -->

    <!-- CTA Boxes -->

    <?php
        $cta_boxes = get_field('cta_boxes');
        if(!is_array_empty($cta_boxes) ):
    ?>

        <section class="py-3 cta-boxes-section">
            <div class="ast-container">
                <div class="ast-row">
                    <?php
                        foreach($cta_boxes as $key => $cta_box):
                            $cta_title = $cta_box['cta_title'];
                            $cta_summary = $cta_box['cta_description'];
                            $cta_button_text = $cta_box['cta_button_text'];
                            $cta_button_link = $cta_box['cta_button_link'];
                    ?>
                        <div class="ast-col-md-6">
                            <div class="cta-box">
                                <h3 class="cta-box__title text-center">
                                    <?php echo $cta_title?>
                                </h3>
                                <div class="cta-box__summary">
                                    <?php echo $cta_summary?>
                                </div>
                                <a href="<?php echo $cta_button_link?>" class="btn btn-centered btn-primary">
                                    <?php echo $cta_button_text?>
                                </a>
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
    <!-- CTA Boxes End -->

    <!-- Course CTA Section -->

    <?php
        $course_cta_section = get_field('course_cta_section');
        if(!is_array_empty($course_cta_section)):
            $section_title = $course_cta_section['section_title'];
            $section_summary = $course_cta_section['section_subtitle'];
            $courses = $course_cta_section['courses'];
            $accreditations_links = $course_cta_section['accreditations_links'];
            $accreditations_cta_link = $course_cta_section['accreditations_cta_link'];
    ?>

        <section class="courses-cta-section">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="common-section-heading text-center ">
                            <?php echo $section_title?>
                        </h2>
                        <div class="section-summmary font-500 text-center">
                            <?php echo $section_summary?>
                        </div>
                        <div class="tefl-global-reviews">
                            <span class="course-review-count font-700">
                                <?php echo $reviews_average; ?>
                                <img src="/wp-content/uploads/2024/10/reviews-star-black.svg" class="no-lazy" alt="">
                            </span>
                            <span>out of <b class="font-700"><?php echo $total_reviews_count ?></b> global reviews </span>
                        </div>
                    </div>
                </div>
                <div class="ast-row py-3">
                    <?php
                        foreach($courses as $course):
                            $post_ID         = $course['course_product'];
                            $course_cta_link = get_permalink($post_ID);
                            $product_ID      = get_post_meta($post_ID, 'course_product',true);
                            $product         = wc_get_product($product_ID);
                            if($product){
                                $simple_regular_price = $product->get_regular_price();
                                $simple_sale_price = $product->get_sale_price();
                                if (is_numeric($simple_regular_price) && is_numeric($simple_sale_price) && $simple_regular_price != 0) {
                                    $save_percentage = round((($simple_regular_price - $simple_sale_price) / $simple_regular_price) * 100);
                                }
                            }
                            $discount_text_color = $course['discount_text_color'];
                            $discount_background_color = $course['discount_background_color'];
                            $course_title    = $course['course_title'];
                            $course_icon     = $course['course_icon'];
                            $course_summary  = $course['course_summary'];
                            $course_features = $course['course_features'];
                            $course_cta_button_text = $course['cta_button_text'];
                            
                            $has_deposit = $course['has_deposit'];
                            if($has_deposit){
                                $deposit_title = $course['deposit_title'];
                                $deposit_description = $course['deposit_description'];
                            }
                    ?>
                        <div class="ast-col-md-4">
                            <div class="course course-card <?php echo $deposit_payment_plan?>">
                                <div class="course-card-body">
                                    <h2 class="course-card__title font-500">
                                        <img src="<?php echo $course_icon?>" alt="">
                                        <span><?php echo $course_title?></span>
                                    </h2>
                                    <div class="course-card__price">
                                        <?php echo $product->get_price_html();?>
                                        <span class="course-card__price-discount" style="color:<?php echo $discount_text_color?>;">
                                            <?php echo 'Save '.$save_percentage.'%'?>
                                        </span>
                                    </div>
                                    <?php
                                        $full_price = $product->get_price();
                                        $price_per_installment = geo_price($full_price/3);
                                    ?>
                                    
                                    <?php
                                        if ($has_deposit):
                                    ?>
                                        <div class="deposit-info label-equal-height ast-align-items-center">
                                            <span class="deposit-info_title"><?php echo $deposit_title?></span>
                                            <div class="deposit-info_description">
                                                <?php echo $deposit_description?>
                                            </div>
                                        </div>
                                    <?php 
                                        else:
                                            include('includes/klarna_label.php');
                                        endif
                                    ?>
                                    <div class="course-card__summary">
                                        <?php 
                                            $plain_text_summary = strip_tags($course_summary); 
                                            $words = str_word_count($plain_text_summary, 1); 
                                            if (count($words) > 50) {
                                                $limited_summary = implode(' ', array_slice($words, 0, 50));
                                                echo $limited_summary . '...'; 
                                            } else {
                                                echo $plain_text_summary;
                                            }
                                        ?>
                                    </div>
                                    <?php
                                        if(!empty('course_features')):
                                    ?>
                                        <ul class="course-card__features">
                                            <?php
                                                foreach($course_features as $course_feature):
                                            ?>
                                                <li><?php echo $course_feature['feature_text']?></li>
                                            <?php
                                                endforeach;
                                            ?>
                                        </ul>
                                    <?php
                                        endif;
                                    ?>
                                </div>
                                <div class="course-card-foter">
                                    <a href="<?php echo $course_cta_link?>" class="btn btn-centered btn-primary course-card__btn">
                                        <?php echo $course_cta_button_text?>
                                    </a>
                                </div>
                            </div>
                            <?php
                                if(!$deposit_enabled){
                                    include('includes/klarna_modal.php');
                                }
                            ?>
                        </div>
                    <?php
                        endforeach
                    ?>
                    <div class="ast-col-md-4">
                        <div class="accreditations-card course-card">
                            <div class="accreditaions-card__header">
                                Our Accreditations
                            </div>
                            <div class="accreditations-card__body">
                                <?php
                                    foreach($accreditations_links as $key => $accreditation):
                                        $accred_icon = $accreditation['icon'];
                                        $accred_link = $accreditation['link'];
                                ?>
                                    <div class="accreditation">
                                        <a href="<?php echo $accred_link?>" target="_blank">
                                            <img src="<?php echo $accred_icon?>" alt="">
                                        </a>
                                    </div>
                                <?php
                                    endforeach
                                ?>
                            </div>
                            <div class="course-card-foter">
                                <a href="<?php echo $accreditations_cta_link?>" class="btn btn-centered btn-primary course-card__btn">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>

    <!-- Course CTA Section End -->

    <!-- Full Width Banner -->

    <?php
        $full_width_banner = get_field('full_width_banner');
        if(!is_array_empty($full_width_banner)):
            $banner_image = $full_width_banner['banner_image'];
            $banner_title = $full_width_banner['banner_title'];
            $banner_content = $full_width_banner['banner_content'];
    ?>

        <section class="full-width-banner-section" style="background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.5)), url('<?php echo esc_url($banner_image); ?>');">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="common-section-heading text-center">
                            <?php echo $banner_title?>
                        </h2>
                        <div class="full-width-banner-section-body">
                            <?php echo $banner_content?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>

    <!-- Full Width Banner End -->

    <!-- Quick Links Section -->

    <?php
        $quick_links_section = get_field('quick_links_section');
        if(!is_array_empty($quick_links_section)):
            $section_title = $quick_links_section['section_title'];
            $section_stitle = $quick_links_section['section_subtitle'];
            $quick_links = $quick_links_section['quick_links'];
    ?>

        <section class="quick-links-section py-3">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="common-section-heading text-center">
                            <?php echo $section_title?>
                        </h2>
                        <div class="quick-links-section__subtitle font-500 text-center">
                            <?php echo $section_stitle?>
                        </div>
                    </div>
                </div>
                <div class="ast-row ast-flex pt-3">
                    <div class="quick-links-row">
                        <?php foreach($quick_links as $key => $quick_link):
                            $quick_link_icon = $quick_link['link_image'];
                            $quick_link_heading = $quick_link['link_heading'];
                            $quick_link_description = $quick_link['link_description'];
                            $quick_link_cta_text = $quick_link['link_text'];
                            $quick_link_cta_link = $quick_link['link_url'];
                        ?>
                            <div class="ast-col-md-4">
                                <div class="quink-link quick-link-<?php echo $key+1?>">
                                    <img src="<?php echo $quick_link_icon?>" alt="quick-link-icon" class="quick-link__icon">
                                    <h3 class="quick-link__heading">
                                        <?php echo $quick_link_heading?>
                                    </h3>
                                    <div class="quick-link_description">
                                        <?php echo $quick_link_description?>
                                    </div>
                                    <a href="<?php echo $quick_link_cta_link?>" class="btn btn-primary quick-link__cta-btn">
                                        <span><?php echo $quick_link_cta_text?></span>
                                        <img class="no-lazy" src="/wp-content/uploads/2024/10/arrow-right-white.svg" alt="arrow-icon">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach?>
                    </div>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>

    <!-- Quick Links Section End -->

    <!-- Verified Student Reviews -->
    <?php
        $verified_reviews_section = get_field('verified_reviews_section');
        if(!is_array_empty($verified_reviews_section)):
            $section_stitle = $verified_reviews_section['section_subtitle'];
            $section_title = $verified_reviews_section['section_title'];
    ?>
    
        <section class="verified-student-reviews-section">
            <div class="ast-container">
                <div class="ast-row ">
                    <div class="verified-student-reviews-section__header">
                        <div class="ast-col-md-6">
                            <div class="header-wrapper">
                                <h2 class=" common-section-heading">
                                    <?php echo $section_title?>
                                </h2>
                            </div>
                            <span class="verified-student-reviews-section__subtitle">
                                <?php echo $section_stitle?>
                            </span>
                        </div>
                        <div class="ast-col-md-6">
                            <div class="verified-student-reviews-section__header-right">
                                <a target="_blank" href="https://search.google.com/local/reviews?placeid=ChIJaeBYjIqxe0gR8IEtXkiDSWo" class="btn-primary btn">
                                    <span>View All Reviews</span>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                                <div class="reviews-average">
                                    <div class="rating-div">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-empty"></i>
                                        
                                    </div>
                                    <div class="total-count-text"><span class="course-review-count">(<?php echo $reviews_average; ?>)</span> Out of <?php echo $total_reviews_count ?> global reviews</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="spacer-column"></div>
                <div class="ast-row verified-student-reviews-section__row">
                    <div class="verified-student-reviews-section__row">
                        <div class="ast-col-md-5">
                            <div class="verified-student-reviews-section__review-summary">
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
                            <div class="rplg rplg-insert" data-id="77247"></div>
                        </div>
                        <div class="ast-col-md-7 verified-student-reviews-section__slider">
                            <?php echo do_shortcode('[brb_collection id="77247"]'); ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    <?php
        endif
    ?>
    <!-- Verified Student Reviews End -->

    <!-- Video Testimonials Section -->
    <?php
        $video_testimonials_section = get_field('video_testimonials_section');
        if(!is_array_empty($video_testimonials_section)):
            $section_stitle = $video_testimonials_section['section_subtitle'];
            $section_title = $video_testimonials_section['section_title'];
            $testimonials = $video_testimonials_section['testimonials'];
    ?>
    

    <section class="video-testimonials-section py-3">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <h2 class="common-section-heading video-testimonials-section__title text-center">
                        <?php echo $section_title?>
                    </h2>
                    <div class="video-testimonials-section__subtitle font-500 common-subheading text-center">
                        <?php echo $section_stitle?>
                    </div>
                </div>
            </div>
            <div class="spacer-column"></div>
            <div class="video-testimonials__slider splide">
                <div class="splide__arrows">
                    <button class="splide__arrow splide__arrow--prev">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    <button class="splide__arrow splide__arrow--next">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php
                            foreach($testimonials as $testimonial):
                                $thumbnail = $testimonial['thumbnail'];
                                $name = $testimonial['name'];
                                $designation = $testimonial['designation'];
                                $video_link = $testimonial['video_link'];
                                $title = $testimonial['title'];
                        ?>
                            <li class="splide__slide">
                                <div class="video-testimonial-card">
                                    <div class="video-testimonial-card_image-container">
                                        <img src="<?php echo $thumbnail?>" alt="" class="video-testimonial-card__image">
                                    </div>
                                    <div class="video-testimonial-card_content">
                                        <span class="video-testimonial-card__title">
                                            <?php echo $title?>
                                        </span>
                                        <h3 class="video-testimonial-card__name font-600 small-heading">
                                            <?php echo $name?>
                                        </h3>
                                        <span class="video-testimonial__subtitle font-400">
                                            <?php echo $designation?>
                                        </span>
                                        <a href="<?php echo $video_link?>" data-lity class="btn btn-primary">
                                            <span>Watch Now</span>
                                            <img src="/wp-content/uploads/2024/10/play-btn-white.svg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </li>
                            
                        <?php
                            endforeach
                        ?>
                    </ul>
                </div>
            
            </div>
        </div>
    </section>

    
    <?php
        endif;
    ?>
    <!-- Video Testimonials Section End -->

    <!-- Quick Links CTA Boxes -->

    <?php
    $quick_links_cta_boxes = get_field('quick_links_cta_boxes');
    if(!is_array_empty($quick_links_cta_boxes)):
        $callback_cta = get_field('callback_cta');
        $callback_cta_title = $callback_cta['title'];
        $callback_cta_link = $callback_cta['cta_link'];
        $callback_cta_text = $callback_cta['cta_text'];
    ?>

        <section class="quick-link-cta-boxes-section">
            <div class="ast-container"> 
                <div class="quick-link-cta-boxes-row">
                    <div class="ast-row">
                        <?php
                            foreach($quick_links_cta_boxes as $key => $qlcta):
                                $cta_image = $qlcta['cta_image'];
                                $cta_text = $qlcta['cta_text'];
                                $cta_link = $qlcta['cta_link'];
                            if($key == 3):
                        ?>
                            <div class="ast-col-md-12 spacer-column-small">
                            </div>
                        <?php  
                            endif; 
                        ?>
                            <div class="ast-col-md-4">
                                <div class="quick-link-box" style="background:url('<?php echo $cta_image?>')">
                                    <?php
                                        if(empty($cta_link)):
                                    ?>
                                    <span class="quick-link-cta-link text-center">
                                        <?php echo $cta_text?>
                                    </span>
                                    <?php
                                        else:
                                    ?>
                                    <a href="<?php echo $cta_link?>" class="quick-link-cta-link text-center" target="_blank">
                                        <?php echo $cta_text?>
                                    </a>
                                    <?php
                                        endif;
                                    ?>
                                </div>
                            </div>
                        <?php
                            endforeach;
                        ?>
                        <div class="ast-col-md-4">
                            <div class="callback-cta">
                                <h5><?php echo $callback_cta_title?></h5>
                                <a href="<?php echo $callback_cta_link?>">
                                    <?php echo $callback_cta_text?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
    endif;
    ?>
    <!-- Quick Links CTA Boxes End-->

    <!-- FAQS Section -->
    <section class="faqs-section faqs-section-redesigned py-3">
        <?php
        $frequently_asked_questions = get_cfvalue_by_country('frequently_asked_questions');
        ?>
        
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <h2 class=" faqs-heading common-section-heading">
                        faqs
                    </h2>
                </div>
                <div class="ast-col-md-8 faqs">
                    
                    <div class="faqs-wrapper equal-height">
                        <div class="faqs-accordion">
                            <?php
                            foreach ($frequently_asked_questions as $key => $faq) :
                                $faq_answer = $faq['answer'];
                                $faq_question = $faq['question'];
                            ?>
                                <div class="faqs-accordion__item <?php echo $key === 0 ? 'active' : '' ?>">
                                    <input type="radio" id="acc-<?php echo $key ?>" name="faq-accordion" <?php echo $key === 0 ? 'checked' : '' ?> hidden>
                                    <label class="font-700" for="acc-<?php echo $key ?>">
                                        <span><?php echo $faq_question ?></span>
                                        <i class="fa fa-plus"></i>
                                    </label>
                                    <div class="font-500 faqs-accordion__content <?php echo $key === 0 ? 'active' : '' ?>">
                                        <?php echo $faq_answer ?>
                                    </div>
                                </div>
                            <?php
                            endforeach
                            ?>

                        </div>
                        <div class="show-more-faqs">
                            <span>Show More Faqs</span>
                        </div>
                    </div>
                </div>
                <div class="ast-col-md-4">
                    <div class="app-download-container" style="background:url('/wp-content/uploads/2024/10/app_download.png')">
                        <h4>STUDY ON THE GO</h4>
                        <span>Download the app</span>
                        <div class="app-download-cta__icons flex-box">
                            <a href="https://play.google.com/store/apps/details?id=com.teflinstitute.teflinstitute">
                                <img src="/wp-content/uploads/2021/08/google-play-logo-1.svg">
                            </a>
                            <a href="https://apps.apple.com/app/id1568312366">
                                <img src="/wp-content/uploads/2021/08/apple-logo-1.svg">
                            </a>
                        </div>
                        <div class="donwload-icon text-center font-600">
                            <span>Download App</span>
                            <img src="/wp-content/uploads/2024/10/donwload_icon.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQS Section End -->

     <!-- Partner Logos-->

     <section class="partner-logos-section py-3">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12 logo-container">
                    <div class="logo-group first">
                        <?php
                        $first_gallery = get_field('first_gallery', 'options');
                        if ($first_gallery) : ?>
                            <?php foreach ($first_gallery as $image) : ?>
                                <div class="image"><img src="<?php echo $image; ?>"></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="logo-group second">
                        <?php
                        $second_gallery = get_field('second_gallery', 'options');
                        if ($second_gallery) : ?>
                            <?php foreach ($second_gallery as $image) : ?>
                                <div class="image"><img src="<?php echo $image; ?>"></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Partner Logos End -->

     
</div>

<?php get_footer(); ?>