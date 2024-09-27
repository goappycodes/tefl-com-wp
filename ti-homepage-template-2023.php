<?php

/**
 * Template Name: Homepage Template 2023
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram Rana <bikram@appycodes.com>
 * @date April 2023
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();
?>
<div id="primary" <?php astra_primary_class(); ?>>

    <!-- Hero Banner Section -->
    <div class="full-width-slider">
        <?php
        $reviews_widget = get_field('reviews_widget','option');
        $hero_banner = get_field('hero_banner');
        $banner = $hero_banner['banner'];
        foreach ($banner as $key => $hb) :
            $banner_bg = $hb['background_image'] . "?w=1400";
            $banner_bg_mobile = $hb['background_image_mobile'] . "?w=600";
            $has_overlay = $hb['banner_overlay'];
            $show_banner_logo = $hb['show_banner_logo'];
            if ($show_banner_logo) {
                $banner_logo = $hb['banner_logo'];
                $banner_logo_link = $hb['banner_logo_link'];
            }
            $content_box = $hb['content_box'];
            $show_offer_bubble = $hb['show_offer_bubble'];
            if($show_offer_bubble){
                $offer_bubble = $hb['offer_bubble'];
                $bubble_content = $offer_bubble['bubble_content'];
                $bubble_color = $offer_bubble['bubble_color'];
            }
        ?>

            <section class="<?php echo $has_overlay ? 'has-overlay' : '' ?> banner-slide banner-slide-<?php echo $key ?>" style="max-height: 80vh; background:url('<?php echo $banner_bg ?>')">
                <style>
                    <?php
                    if(!empty($hb['background_image_mobile'])):
                    ?>
                    @media (max-width: 768px) {
                        .full-width-slider .banner-slide-<?php echo $key; ?> {
                            background: url('<?php echo $banner_bg_mobile; ?>') !important;
                            background-size: cover !important;
                            background-position: center;
                        }
                    }
                    <?php
                    endif;
                    ?>
                </style>
                <div class="ast-container">
                    <div class="ast-row banner-slider-row">
                        <div class="ast-col-md-6">
                            <?php
                            $is_offer = $content_box['is_offer'];
                            $title = $content_box['title'];
                            if($is_offer){
                                $title_box_bg_color = $content_box['title_box_bg_color'];
                                $title_text_color = $content_box['title_text_color'];
                            }
                            $summary = $content_box['summary'];
                            $cta_buttons = $content_box['cta_buttons'];
                            $show_clockdown = $content_box['show_clockdown'];
                            $content_has_badge_logo = $content_box['content_has_badge_logo'];
                            if ($content_has_badge_logo) {
                                $badge_logo = $content_box['badge_logo'];
                            }
                            ?>
                            <div class="banner-slide__content <?php echo $is_offer?'offer-content':''?>">
                                <?php
                                if ($content_has_badge_logo && !empty($badge_logo)) {
                                ?>
                                    <img src="<?php echo $badge_logo ?>" alt="content-badge-logo" class="content-badge-logo">
                                <?php
                                }
                                ?>
                                <?php if ($is_offer): ?>
                                    <h1 style="background:<?php echo $title_box_bg_color?>; color:<?php echo $title_text_color ?>" class="large-heading banner-slide__content-title common-section-heading">
                                        <?php echo $title ?>
                                    </h1>
                                <?php else: ?>
                                    <h1 class="large-heading banner-slide__content-title common-section-heading">
                                        <?php echo $title ?>
                                    </h1>
                                <?php endif; ?>

                                <div class="banner-slide__content-wrapper">
                                    <div class="banner-slide__content-summary">
                                        <?php echo $summary?>
                                    </div>
                                    
                                </div>
                                <div class="banner-slide__content-links">
                                    <?php
                                    foreach ($cta_buttons as $cta_btn) :
                                    ?>
                                        <a href="<?php echo $cta_btn['cta_link'] ?>" class="btn btn-centered btn-primary">
                                            <?php echo $cta_btn['cta_text'] ?>
                                        </a>
                                    <?php
                                    endforeach
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="ast-col-md-6 pos-abs">
                            <div class="banner-slide__content-logo-container <?php echo (!$show_offer_bubble && !$show_banner_logo)?'no-banner-logo':'' ?>">
                                
                            <?php if ($show_banner_logo) : ?>
                                <?php if (empty($banner_logo_link)) : ?>
                                    <img src="<?php echo $banner_logo ?>" class="banner-slide__content-logo" alt="">
                                <?php else : ?>
                                    <a href="<?php echo $banner_logo_link ?>">
                                        <img src="<?php echo $banner_logo ?>" class="banner-slide__content-logo" alt="">
                                    </a>
                                <?php endif; ?>
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
                            <?php if ($show_clockdown):
                                $date_today       = date('l, F d y h:i:s');
                                $date_today_unix  = strtotime($date_today);
                                $expiry_date      = get_field('timer_expiry', 'option');
                                $expiry_date_unix = strtotime($expiry_date);
                                $promo_offer_end_date = date("l jS F", $expiry_date_unix);
                                $offer_text = $content_box['offer_text'];
                                 if($date_today_unix < $expiry_date_unix):
                            ?>
                                <div class="banner-slide-content__timer__outer" style="border-color:<?php echo $bubble_color?>">
                                    <div class="banner-slide-content__timer" style="border-color:<?php echo $bubble_color?>">
                                        <span class="discount-label">
                                            <?php echo $offer_text ?>
                                        </span>
                                        <p class="banner-slide-content__timer-end">
                                            Offer ends <?php echo $promo_offer_end_date?>
                                        </p>
                                        <?php echo clockdown_function($expiry_date) ?>
                                    </div>
                                </div>                              
                            <?php 
                              endif;
                                endif ?>

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



    <?php //include('template-parts/offer-banner.php'); ?>


    <?php
    $cta_section = get_field('cta_section');
    if (!empty($cta_section)) :
        $cta_buttons = $cta_section['cta_buttons'];
        $cta_blocks_with_full_image_background = $cta_section['cta_blocks_with_full_image_background'];
        $expandable_cta_blocks = $cta_section['expandable_cta_blocks'];
    ?>
        <!-- CTA Section -->

        <section class="cta-section pt-2">

            <div class="ast-container">
                <div class="ast-row">
                    <div class="cta-section__buttons-row">
                        <?php
                        if (is_array($cta_buttons) && !empty(array_filter($cta_buttons))) :
                            foreach ($cta_buttons as $cta_button) :
                                $button_text = $cta_button['button_text'];
                                $button_link = $cta_button['button_link'];
                        ?>
                                <div class="ast-col-md-4">
                                    <a href="<?php echo $button_link ?>" class="cta-buttons btn btn-primary">
                                        <span>
                                            <?php echo $button_text ?>
                                        </span>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>

                <!-- Search Courses Section -->

                <section class="search-courses-section pt-3">
                    <div class="ast-container">
                        <div class="ast-row">
                            <h2 class="search-courses-section__heading text-center common-section-heading">
                                Find The Perfect TEFL Course
                            </h2>
                            <div class="search-courses-section__body">
                                <?php echo do_shortcode('[tefl_course_search]'); ?>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Search Courses Section End -->

                <div class="ast-row">
                    <div class="cta-image-card-row ast-flex">
                        <?php
                        if (is_array($cta_blocks_with_full_image_background) && !empty(array_filter($cta_blocks_with_full_image_background))) :
                            foreach ($cta_blocks_with_full_image_background as $cta_image_card) :
                                $card_bg = $cta_image_card['cta_bg_image'];
                                $card_title = $cta_image_card['cta_title'];
                                $card_summary = $cta_image_card['cta_summary'];
                                $card_cta_btn_text = $cta_image_card['cta_button_text'];
                                $card_cta_btn_link = $cta_image_card['cta_button_link'];
                        ?>
                                <div class="ast-col-md-6">
                                    <div class="cta-image-card" style="background:url('<?php echo $card_bg ?>')">
                                        <div class="cta-image-card__content">
                                            <h2 class="cta-image-card__content-title font-600 small-heading">
                                                <?php echo $card_title ?>
                                            </h2>
                                            <div class="cta-image-card__content-summary font-300 my-1">
                                                <?php echo $card_summary ?>
                                            </div>
                                            <a href="<?php echo $card_cta_btn_link ?>" class="cta-image-card__button font-400 btn btn-small-centered btn-bordered-white">
                                                <?php echo $card_cta_btn_text ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            endforeach;
                        endif
                        ?>
                    </div>
                </div>
                <div class="ast-row">
                    <div class="expanable-cta-card-row ast-flex">
                        <?php
                        if (is_array($expandable_cta_blocks) && !empty(array_filter($expandable_cta_blocks))) :
                            foreach ($expandable_cta_blocks as $key => $exp_cta_block) :
                                $card_bg = $exp_cta_block['cta_bg_image'];
                                $card_title = $exp_cta_block['cta_title'];
                                $card_summary = $exp_cta_block['cta_summary'];
                                $card_cta_btn_text = $exp_cta_block['cta_button_text'];
                        ?>
                                <div class="ast-col-md-6">
                                    <div class="exp-cta-card">
                                        <div class="exp-cta-card__image-header exp-cta-card__image-header-<?php echo $key ?>">
                                            <img src="<?php echo $card_bg ?>" alt="" />
                                        </div>
                                        <div class="exp-cta-card__body">
                                            <h2 class="exp-cta-card__body-title font-600 large-heading text-center text-dark">
                                                <?php echo $card_title ?>
                                            </h2>
                                            <div class="exp-cta-card__body-content">
                                                <div class="exp-cta-card__body-content-expandable">
                                                    <?php echo $card_summary ?>
                                                </div>
                                                <div class="exp-cta-card__body-expand font-500">
                                                    <span><?php echo $card_cta_btn_text ?></span>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            endforeach;
                        endif
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section END-->
    <?php
    endif;
    ?>

    <?php
    $course_cta_section = get_field('course_cta_section');
    if ($course_cta_section) :
        $section_title  = $course_cta_section['section_title'];
        $section_stitle = $course_cta_section['section_subtitle'];
        $banner_section = $course_cta_section['banner_section'];
        $banner_section_title = $banner_section['title'];
        $banner_section_content = $banner_section['content'];
        $courses = $course_cta_section['courses'];
    ?>
        <!-- Course CTA Section -->
        <section class="course-cta-section pt-5">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-6">
                        <h2 class="large-heading common-section-heading course-cta-section__title">
                            <?php echo $section_title ?>
                        </h2>
                        <span class="course-cta-section__subtitle font-500">
                            <?php echo $section_stitle ?>
                        </span>
                    </div>
                    <div class="ast-col-md-6">
                        <div class="flex-box app-download-cta-box">
                            <div class="app-download-cta">
                                <h2 class="large-heading common-section-heading">
                                    study on the go
                                </h2>
                                <span class="course-cta-section__subtitle font-500">
                                    Download the app
                                </span>
                                <div class="app-download-cta__icons flex-box">
                                    <a href="https://play.google.com/store/apps/details?id=com.teflinstitute.teflinstitute">
                                        <img src="/wp-content/uploads/2021/08/google-play-logo-1.svg">
                                    </a>
                                    <a href="https://apps.apple.com/app/id1568312366">
                                        <img src="/wp-content/uploads/2021/08/apple-logo-1.svg">
                                    </a>
                                </div>
                            </div>
                            <div class="app-download-image">
                                <img src="/wp-content/uploads/2021/07/laptop_mobile-1.png" alt="">
                            </div>
                        </div>
                    </div>
                    <?php if(!is_array_empty($banner_section)):?>

                        <div class="ast-col-md-12 mt-2">
                            <div class="courses-cta-section-banner">
                                <h2 class="large-heading common-section-heading text-center">
                                    <?php echo $banner_section_title?>
                                </h2>
                                <div class="courses-cta-section-banner-content text-center">
                                    <?php echo $banner_section_content?>
                                </div>
                            </div>
                        </div>

                    <?php endif;?>
                    <div class="ast-col-md-12 spacer-column"></div>
                    <?php
                    foreach ($courses as $course) :
                        $hide_in_mobile = $course['hide_in_mobile'];
                        $post_ID     = $course['course_product'];
                        $course_cta_link = get_permalink($post_ID);
                        $product_ID = get_post_meta($post_ID, 'course_product', true);
                        $product = wc_get_product($product_ID);
                        if($product){
                            $simple_regular_price = $product->get_regular_price();
                            $simple_sale_price = $product->get_sale_price();
                            if (is_numeric($simple_regular_price) && is_numeric($simple_sale_price) && $simple_regular_price != 0) {
                                $save_percentage = round((($simple_regular_price - $simple_sale_price) / $simple_regular_price) * 100);
                            }
                        }
                        $discount_text_color = $course['discount_text_color'];
                        $discount_background_color = $course['discount_background_color'];
                        $course_title = $course['course_title'];
                        $deposit_info = $course['deposit_info'];
                        $deposit_info_icon = $deposit_info['deposit_icon'];
                        $deposit_info_title = $deposit_info['deposit_title'];
                        $deposit_info_description = $deposit_info['deposit_description'];
                        $course_summary = $course['course_summary'];
                        $course_features = $course['course_features'];
                        $course_cta_button_text = $course['cta_button_text']; // Deposit
                        $deposit_enabled        = get_post_meta($product_ID, '_wc_deposit_enabled', true);
                        $deposit_payment_plan   = $deposit_class = $deposit_description = $deposit_icon = '';

                        if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional') {
                            $deposit_payment_plan = get_post_meta($product_ID, '_wc_deposit_payment_plans', true);
                            $deposit_payment_plan = $deposit_payment_plan[0];
                        }

                        if ($deposit_payment_plan) {
                            global $wpdb;
                            $query = "SELECT amount FROM `wp_wc_deposits_payment_plans_schedule` WHERE `schedule_index` = 0 AND `plan_id` = " . $deposit_payment_plan;
                            $deposit_percent = $wpdb->get_var($query);
                            $deposit_percent = round((float)$deposit_percent / 100, 5);

                            $query = "SELECT amount FROM `wp_wc_deposits_payment_plans_schedule` WHERE `schedule_index` = 1 AND `plan_id` = " . $deposit_payment_plan;
                            $recurring_percent = $wpdb->get_var($query);
                            $recurring_percent = round((float)$recurring_percent / 100, 5);

                            $query = "SELECT count(schedule_id) FROM `wp_wc_deposits_payment_plans_schedule` WHERE `plan_id` = " . $deposit_payment_plan;
                            $total_deposits = $wpdb->get_var($query);
                            if ($deposit_payment_plan === 1 || $deposit_payment_plan === 3) {
                                $deposit_icon = "/wp-content/uploads/2023/07/payin2.svg";
                                $deposit_description = 'Split the cost of your purchase into ' . $total_deposits . ' interest-free payments';
                            } elseif ($deposit_payment_plan === 4) {
                                $deposit_icon = "/wp-content/uploads/2023/07/payin2.svg";
                                $deposit_description = 'Split the cost of your purchase into ' . $total_deposits . ' interest-free payments';
                            } elseif ($deposit_payment_plan === 6) {
                                $deposit_icon = '/wp-content/uploads/2023/07/payin6.svg';
                                $deposit_description = 'Split the cost of your purchase into ' . $total_deposits . ' interest-free payments.';
                            } elseif ($deposit_payment_plan === 7) {
                                $deposit_icon = '/wp-content/uploads/2023/07/payin6.svg';
                                $deposit_description = 'Split the cost of your purchase into ' . $total_deposits . ' interest-free payments.';
                            }
                        }
                        // Deposit
                    ?>
                        <div class="<?php echo $hide_in_mobile?'hide-in-mobile':'' ?> ast-col-md-4 <?php echo $deposit_payment_plan ?>">
                            <div class="course-card course-id-<?php echo $product_ID ?>">
                                <a href="<?php echo $course_cta_link ?>" class="clickbox"></a>
                                <div class="course-card-body">
                                    <h2 class="course-card__title font-600 small-heading">
                                        <?php echo $course_title ?>
                                    </h2>
                                    <div class="course-card__price">
                                        <?php echo $product->get_price_html(); ?>
                                        <span class="course-card__price-discount" style="color:<?php echo $discount_text_color?>; background:<?php echo $discount_background_color?>;border-color:<?php echo $discount_text_color?>">
                                            <?php echo $save_percentage.'% off'?>
                                        </span>
                                    </div>
                                    <div class="deposit-info ast-flex ast-align-items-center">
                                        <div class="depoist-info__icon">
                                            <img src="<?php echo $deposit_info_icon ?>" alt="">
                                        </div>
                                        <div class="ast-flex flex-direction-column deposit-info__details">
                                            <h5 class="deposit-info_title"><?php echo $deposit_info_title ?></h5>
                                            <div class="deposit-info_description">
                                                <?php echo $deposit_info_description ?>
                                            </div>
                                        </div>  
                                    </div>
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
                                    if (!empty('course_features')) :
                                    ?>
                                        <ul class="course-card__features">
                                            <?php
                                            foreach ($course_features as $course_feature) :
                                            ?>
                                                <li><?php echo $course_feature['feature_text'] ?></li>
                                            <?php
                                            endforeach;
                                            ?>
                                        </ul>
                                    <?php
                                    endif;
                                    ?>
                                </div>
                                <div class="course-card-foter">
                                    <a href="<?php echo $course_cta_link ?>" class="btn btn-primary course-card__btn">
                                        <?php echo $course_cta_button_text ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach
                    ?>
                </div>
            </div>
        </section>
        <!-- Course CTA Section End-->
    <?php
    endif
    ?>

    <?php
    $webinar_cta_section = get_field('webinar_cta_section');
    if ($webinar_cta_section) :
        $section_title  = $webinar_cta_section['section_title'];
        $section_stitle = $webinar_cta_section['section_subtitle'];
        $guide_download_cta = $webinar_cta_section['guide_download_cta'];
    ?>
        <!-- webinar CTA section -->
        <section class="webinar-cta-section pt-5">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="large-heading common-section-heading webinar-cta-section__title">
                            <?php echo $section_title ?>
                        </h2>
                        <span class="webinar-cta-section__subtitle common-subheading">
                            <?php echo $section_stitle ?>
                        </span>
                    </div>
                </div>
                <div class="ast-row ast-flex cta-card-container">
                    <div class="ast-col-md-12 spacer-column"></div>
                    <?php
                    $latest_webinar = get_latest_webinars(1);
                    if ($latest_webinar) :
                        $webinar_id         = $latest_webinar->ID;
                        $webinar_title      = $latest_webinar->post_title;
                        $webinar_location   = get_field('webinar_location', $webinar_id);
                        $webinar_date       = get_field('webinar_date', $webinar_id);
                        $webinar_time       = get_field('webinar_time', $webinar_id);
                        $webinar_image      = get_the_post_thumbnail_url($webinar_id, 'full');
                        $webinar_link       = get_post_permalink($webinar_id);
                    ?>
                        <div class="ast-col-md-6">
                            <div class="webinbar-cta-card" style="background:url('<?php echo $webinar_image  ?>')">
                                <div class="webinar-cta-card__content">
                                    <h2 class="small-heading webinar-cta-card__content-title font-600">
                                        <?php echo $webinar_title ?>
                                    </h2>
                                    <div class="webinar-cta-card__content-summary my-2">
                                        <div class="webinar-location">
                                            <h4 class="font-500">Location</h4>
                                            <span class="font-300"><?php echo $webinar_location ?></span>
                                        </div>
                                        <div class="webinar-date">
                                            <h4 class="font-500">Date</h4>
                                            <span class="font-300"><?php echo $webinar_date ?></span>
                                        </div>
                                        <div class="webinar-time">
                                            <h4 class="font-500">Time</h4>
                                            <span class="font-300"><?php echo $webinar_time ?></span>
                                        </div>
                                    </div>
                                    <a href="/upcoming-tefl-webinars/" class="webinar-cta-card-btn btn btn-small-centered btn-secondary" target="_blank">register now</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>
                    <?php
                    if ($guide_download_cta) :
                        $background_image = $guide_download_cta['background_image'];
                        $guide_image = $guide_download_cta['guide_image'];
                        $cta_title = $guide_download_cta['cta_title'];
                        $cta_summary = $guide_download_cta['cta_summary'];
                        $cta_btn_text = $guide_download_cta['cta_button_text'];
                        $cta_btn_link = $guide_download_cta['cta_button_link'];
                    ?>
                        <div class="ast-col-md-6">
                            <div class="guide-download-cta-card" style="background:url('<?php echo $background_image ?>')">
                                <div class="guide-download-cta-card__header">
                                    <img src="<?php echo $guide_image ?>" alt="">
                                </div>
                                <div class="guide-download-cta-card__content">
                                    <h2 class="small-heading font-600 guide-download-cta-card__content-title">
                                        <?php echo $cta_title ?>
                                    </h2>
                                    <div class="guide-download-cta-card__content-summary font-300 my-2">
                                        <?php echo $cta_summary ?>
                                    </div>
                                    <a href="<?php echo $cta_btn_link ?>" class="guide-download-cta-card-btn btn btn-small-centered btn-secondary">
                                        <?php echo $cta_btn_text ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </section>
        <!-- webinar CTA section End-->
    <?php
    endif;
    ?>

<!-- new video slider -->

    <?php
    $video_testimonials_section = get_field('video_testimonials_section');
    if ($video_testimonials_section) :
        $section_stitle = $video_testimonials_section['section_subtitle'];
        $section_title = $video_testimonials_section['section_title'];
        $testimonials = $video_testimonials_section['testimonials'];
    ?>
       
       <section class="video-testimoinials-section pt-3">
            <div class="ast-container">
                <div class="ast-row">          
                    <div class="ast-col-md-12">
                        <h2 class="large-heading common-section-heading video-testimonials-section__title">
                            <?php echo $section_title ?>
                        </h2>
                        <span class="video-testimonials-section__subtitle common-subheading ">
                            <?php echo $section_stitle ?>
                        </span>
                    </div>
                    <div class="ast-col-md-12 video-testimonials-section__slider pt-2">
                        <div class="glide video-testimoinials__glide">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">
                                    <?php
                                     foreach ($testimonials as $testimonial) :
                                        $thumbnail = $testimonial['thumbnail'];
                                        $name = $testimonial['name'];
                                        $designation = $testimonial['designation']; 
                                        $video_link = $testimonial['video_link'];
                                    ?>

                                <li class="glide__slide">
                                    <div class="video-testimonial-card">
                                        <a  href="<?php echo $video_link?>"     class="popup-video-review">
                                            <div class="video-testimonial-card_image-container">
                                                <img src="<?php echo $thumbnail?>" alt="" class="video-testimonial-card__image no-lazy">
                                                <img class="play-btn no-lazy" src="/wp-content/uploads/2020/11/play-btn.svg">
                                            </div>
                                            
                                            <h3 class="video-testimonial-card__title">
                                                <?php echo $name?>
                                            </h3>
                                            <h4 class="video-testimonial__subtitle">
                                                <?php echo  $designation?>
                                            </h4>
                                        </a>
                                    </div>
                                </li>
                                    <?php
                                        endforeach
                                    ?>
                                </ul>
                            </div>
                            <div class="glide__arrows" data-glide-el="controls">
                                <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fa fa-angle-left"></i></button>
                                <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fa fa-angle-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    

    <?php endif; ?>





<!-- review section -->
    <?php
    $verified_reviews_section = get_field('verified_reviews_section');
    if ($verified_reviews_section) :
        $section_stitle = $verified_reviews_section['section_subtitle'];
        $section_title = $verified_reviews_section['section_title'];
        // $reviews_widget = $verified_reviews_section['reviews_widget'];
        $total_reviews_count    = isset($reviews_widget['total_reviews']) ? $reviews_widget['total_reviews'] : 1570;
        $five_star_percentage   = isset($reviews_widget['star_percentage_5']) ? (float)$reviews_widget['star_percentage_5'] : 0;
        $four_star_percentage   = isset($reviews_widget['star_percentage_4']) ? (float)$reviews_widget['star_percentage_4'] : 0;
        $three_star_percentage  = isset($reviews_widget['star_percentage_3']) ? (float)$reviews_widget['star_percentage_3'] : 0;
        $two_star_percentage    = isset($reviews_widget['star_percentage_2']) ? (float)$reviews_widget['star_percentage_2'] : 0;
        $one_star_percentage    = isset($reviews_widget['star_percentage_1']) ? (float)$reviews_widget['star_percentage_1'] : 0;

        $reviews_average = (($five_star_percentage * 5) + ($four_star_percentage * 4) + ($three_star_percentage * 3) + ($two_star_percentage * 2) + ($one_star_percentage * 1)) / 100;
    ?>
        <!-- Verified Student Reviews -->
        <section class="verified-student-reviews-section pt-5">
            <div class="ast-container">
                <div class="ast-row ">
                    <div class="verified-student-reviews-section__header">
                        <div class="ast-col-md-6">
                            <h2 class="large-heading common-section-heading verified-student-reviews-section__title">
                                <?php echo $section_title ?>
                            </h2>
                            <span class="verified-student-reviews-section__subtitle">
                                <?php echo $section_stitle ?>
                            </span>
                        </div>
                        <div class="ast-col-md-6">
                            <div class="reviews-average">
                                <div class="rating-div">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-empty"></i>

                                </div>
                                <div class="total-count-text font-600"><span class="course-review-count">(<?php echo $reviews_average; ?>)</span> Out of <?php echo $total_reviews_count ?> global reviews</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="spacer-column"></div>
                <div class="ast-row verified-student-reviews-section__row">
                    <div class="verified-student-reviews-section__row">
                        <div class="equal-height ast-col-md-5">
                            <div class="verified-student-reviews-section__review-summary">
                                <?php for ($i = 5; $i >= 1; $i--) :
                                    $star_percentage = $reviews_widget['star_percentage_' . $i];
                                    if (empty($star_percentage)) :
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
                            <div class="rplg rplg-insert" data-id="77247">

                            </div>
                        </div>
                        <div class="equal-height ast-col-md-7 verified-student-reviews-section__slider">
                            <?php echo do_shortcode('[brb_collection id="77247"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Verified Student Reviews End -->
    <?php
    endif
    ?>
    <!-- Partner Logos-->

    <section class="partner-logos-section pt-3">
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

    <!-- FAQS Section -->
    <section class="faqs-section faqs-section-redesigned py-5">
        <?php
        $frequently_asked_questions = get_cfvalue_by_country('frequently_asked_questions');
        ?>
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "FAQPage",
                "mainEntity": [
                    <?php
                    $faqcount = count($frequently_asked_questions);
                    $counter = 0;
                    foreach ($frequently_asked_questions as $item) {
                        $counter++;
                    ?> {
                            "@type": "Question",
                            "name": <?php echo json_encode($item['question']); ?>,
                            "acceptedAnswer": {
                                "@type": "Answer",
                                "text": <?php echo json_encode($item['answer']); ?>
                            }
                        }
                    <?php
                        if ($faqcount != $counter) echo ",";
                    }
                    ?>
                ]
            }
        </script>
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-6 contact-form-container">
                    <h2 class="large-heading common-section-heading">Question? <u>get in touch</u></h2>
                    <div class="contact-form equal-height">
                        <img src="/wp-content/uploads/2023/04/get-in-touch.png" alt="">
                        <?php echo do_shortcode('[contact-form-7 id="77295" title="Home Contact Form"]') ?>
                    </div>
                </div>
                <div class="ast-col-md-6 faqs">
                    <h2 class="large-heading faqs-heading common-section-heading">
                        faqs
                    </h2>
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
            </div>
        </div>
    </section>
    <!-- FAQS Section End -->
    <?php include('template-parts/offer-banner.php'); ?>



</div>

<?php get_footer(); ?>