<?php

/**
 * Template Name: Courses Overview Template 2023
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram Rana <bikram@appycodes.com>
 * @date June 2023
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();
?>
<div id="primary" <?php astra_primary_class(); ?>>
    <?php
    $hero_banner = get_field('hero_banner');
    if (!empty($hero_banner)) :
        $hero_banner_bg = $hero_banner['banner_background'];
        $hero_banner_cta = $hero_banner['banner_cta'];
        $cta_title = $hero_banner_cta['cta_title'];
        $cta_summary = $hero_banner_cta['cta_summary'];
        $cta_btn_text = $hero_banner_cta['cta_button_text'];
        $cta_btn_link = $hero_banner_cta['cta_button_link'];
        $banner_has_logo = $hero_banner['banner_has_logo'];
        if($banner_has_logo){
            $banner_logo = $hero_banner['banner_logo'];
        }
        
    ?>
        <!-- Hero Banner Section -->
        <section class="hero-banner-section section-padding" style="background:url(<?php echo $hero_banner_bg ?>)">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-6">
                        <?php
                        if (is_array($hero_banner_cta) && !empty(array_filter($hero_banner_cta))) :
                        ?>
                            <div class="hero-banner-section__content">
                                <h1 class="large-heading common-section-heading">
                                    <?php echo $cta_title ?>
                                </h1>
                                <div class="hero-banner-section__content-summary">
                                    <?php echo $cta_summary ?>
                                </div>
                                <a href="<?php echo $cta_btn_link ?>" class="btn btn-primary btn-centered">
                                    <?php echo $cta_btn_text ?>
                                </a>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
                    <?php if($banner_has_logo): ?>
                        <div class="ast-col-md-6">
                            <div class="hero-banner-section__logo-container">
                                <img src="<?php echo $banner_logo?>" alt="" class="hero-banner-section-logo">
                            </div>
                        </div>
                    <?php endif?>
                </div>
            </div>
        </section>
        <!-- Hero Banner Section End -->
    <?php
    endif;
    // include('template-parts/offer-banner.php');
    ?>

    <?php
    $offer_section = get_field('offer_section');
    $course_gifts_section = get_field('course_gifts_section','option');
    $show_gifts_section = $course_gifts_section['show_gifts_section'];
    if (!empty($offer_section) && $show_gifts_section) :
        $offer_section_title = $offer_section['offer_section_title'];
        $offer_expiry_timer_header = $offer_section['offer_expiry_timer_header'];
        $cta_btn_text = $offer_section['cta_button_text'];
        $cta_btn_link = $offer_section['cta_button_link'];
        $offer_details = $offer_section['offer_details'];
        $course_gifts_section = get_field('course_gifts_section','option');
        $show_gifts_section     = $course_gifts_section['show_gifts_section'];
        $gifts                = $course_gifts_section['gifts'];
        $selected_courses     = $course_gifts_section['selected_courses'];
        $selected_courses     = !empty($selected_courses) ? $selected_courses : [];
        $courses_gift_expires = get_field('timer_expiry', 'option');
        $current_time         = current_time('timestamp');
        $expiration_time      = strtotime($courses_gift_expires);
        $page_id = get_queried_object_id();
    ?>
        <!-- Offer Section -->
        <?php if($offer_section_title) { ?>
            <section class="offer-section d-none" data-id="<?php echo $page_id;?>">
                <div class="ast-container">
                    <div class="offer-section-row">
                        <div class=" ast-row">
                            <div class="ast-col-md-12">
                                <h2 class="large-heading offer-section-heading common-section-heading font-500 text-center">
                                    <?php echo $offer_section_title ?>
                                </h2>
                            </div>
                            <div class="flex-wrapper">
                                <div class="ast-col-md-6">
                                    <div class="offer-section-row__timer">
                                        <h2 class="text-center large-heading common-section-heading">
                                            <?php echo $offer_expiry_timer_header ?>
                                        </h2>
                                        <div class="offer-section-row__timer-countdown">
                                            <?php echo do_shortcode('[tefl_timer_shortcode_new timer="course_overview"]') ?>
                                        </div>
                                        <a href="<?php echo $cta_btn_link ?>" class="btn btn-primary w-75 btn-centered">
                                            <?php echo $cta_btn_text ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="ast-col-md-6">
                                    <div class="offer-section-row__content">
                                    <?php 
                                    // if(in_array($page_id,$selected_courses)):
                                        foreach ($gifts as $g) : ?>
                                        <div class="gift">
                                            <span><?php echo $g['gift_title']?></span>
                                        </div>
                                    <?php 
                                        endforeach; 
                                    // endif;
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
        <!-- Offer Section End -->
    <?php
    endif;
    ?>
<!-- acred logo section start-->
    <section class="acred-logo">
        <div class="ast-container">
                <div class="ast-row">
                    <div class="acred-section">
                    <div class="col-md-4">
                        <img class="acred-img" src="/wp-content/uploads/2024/03/deac-aqc.png" alt="">
                    <div class="acred-text">
                        <img src="/wp-content/uploads/2024/03/usa-flag-logo.png" alt="">
                        <h5>DEAC | AQC</h5>
                        </div>
                        <p class="sec-title">Curriculum Approved Centre</p>
                    </div>

                    <div class="col-md-4 mid-col">
                        <img class="acred-img" src="/wp-content/uploads/2020/11/highfield-logo.png" alt="">
                    <div class="acred-text">
                        <img src="/wp-content/uploads/2024/03/UK-flag.png" alt="">
                        <h5>Highfield(Ofqual Regulated)</h5>
                        </div>
                        <p class="sec-title">Center Number:21335</p>
                    </div>

                    <div class="col-md-4">
                        <img class="acred-img" src="/wp-content/uploads/2026/09/OTCAC-logo.png" alt="">
                    <div class="acred-text">
                        <img src="/wp-content/uploads/2024/03/UK-flag.png" alt="">
                        <h5>OTCAC</h5>
                        </div>
                        <p class="sec-title">OTCAC Online Teaching Course Accreditation</p>
                    </div>

                </div>
                </div>
        </div>
    </section>

<!-- acred logo section end -->

    <?php
    $courses_section = get_field('courses_section');
    if (!empty($courses_section)) :
        $section_title = $courses_section['section_title'];
        $courses_tab_menu = $courses_section['courses_tab_menu'];
        $cta_section = $courses_section['cta_section'];
    ?>
        <!-- Courses Group Section -->
        <?php if($section_title) { ?>
            <section class="courses-section section-paddiing">
                <div class="ast-container">
                    <div class="ast-row">
                        <div class="ast-col-md-12">
                            <h2 class="large-heading text-center common-section-heading">
                                <?php echo $section_title ?>
                            </h2>
                            <div class="course-section-tabs">
                                <?php
                                foreach ($courses_tab_menu as $index => $tab) :
                                    $tab_title = $tab['tab_title'];
                                ?>
                                    <a href="#<?php echo str_replace(' ', '_', $tab_title) ?>" class="course-tab-menu-item <?php echo $index === 0 ? 'active' : '' ?>">
                                        <?php echo $tab_title ?>
                                    </a>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <section class="full-width has-bg section-padding">
            <!-- CTA SECTION -->
            <div class="cta-section">
                <div class="ast-container">
                    <div class="ast-row">
                        <div class="cta-card-wrapper">
                            <?php
                            $cta_card = $cta_section['cta_card'];
                            foreach ($cta_card as $index => $card) :
                                $card_title = $card['cta_title'];
                                $card_icon = $card['cta_icon'];
                                $card_summary = $card['cta_summary'];
                                $card_link = $card['cta_link'];
                                $card_link_text = $card['cta_link_text'];

                            ?>
                                <div class="ast-col-md-4">
                                    <div class="cta-card">
                                        <img src="<?php echo $card_icon ?>" alt="" class="cta-card__icon">
                                        <h4 class="cta-card__title font-600"><?php echo $card_title ?></h4>
                                        <div class="cta-card__summary">
                                            <?php echo $card_summary ?>
                                        </div>
                                        <a href="<?php echo $card_link ?>" class="cta-card__link">
                                            <?php echo $card_link_text ?>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CTA SECTION -->

            <div id="<?php echo str_replace(' ', '_', $courses_tab_menu[0]['tab_title']) ?>" class="accredited-section section-padding-top">
                <div class="ast-container">
                    <div class="ast-row">
                        <?php
                        $accredited_tefl_courses = $courses_section['accredited_tefl_courses'];
                        $section_title = $accredited_tefl_courses['section_title'];
                        $section_summary = $accredited_tefl_courses['section_summary'];
                        $courses = $accredited_tefl_courses['courses'];
                        ?>
                        <?php if($section_title) { ?>
                            <div class="accredited-section__row">
                                <div class="ast-col-md-12 accredited-section__header">
                                    <h2 class="large-heading common-section-heading text-center">
                                        <?php echo $section_title ?>
                                    </h2>
                                    <div class="accredited-section__header-summary courses-section__header-summary text-center">
                                        <?php echo $section_summary ?>
                                    </div>
                                </div>
                                <div class="ast-col-md-12  spacer-column"></div>
                                <div class="accredited-section__body">
                                    <?php
                                    foreach ($courses as $index => $course) :
                                        $course_id = $course['course'];
                                        $course_bg_image = $course['background_image'];
                                        $course_icon = $course['course_icon'];
                                        $course_title = $course['course_title'];
                                        $course_completion_time = $course['course_completion_time'];
                                        $course_link = get_post_permalink($course_id);
                                        $course_guide_link = $course['guide_link'];
                                        $course_product_id = get_field('course_product', $course_id);
                                        $course_product = wc_get_product($course_product_id);
                                        $course_price_html = $course_product->get_price_html();

                                        $features = $course['features'];
                                        $feature_title = $features['feature_title'];
                                        $includes = $features['includes'];
                                        $excludes = $features['excludes'];
                                    ?>
                                        <div class="ast-col-md-6">
                                            <div class="course-card">
                                                <div class="course-card__top" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $course_bg_image ?>')">
                                                    <div class="course-card__top-icon text-center">
                                                        <img src="<?php echo $course_icon ?>" alt="">
                                                    </div>
                                                    <div class="fast-track-course deposit-info ast-flex ast-align-items-center">
                                                        <div class="depoist-info__icon">
                                                            <img src="/wp-content/uploads/2023/07/fasttrack.svg" alt="">
                                                        </div>
                                                        <div class="ast-flex flex-direction-column deposit-info__details">
                                                            <h5 class="deposit-info_title">Fast Track</h5>
                                                            <div class="deposit-info_description">
                                                                Get access to entry-level jobs. Qualify to teach at home & abroad.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="course-card__top-content">
                                                        <h4 class="course-title text-center font-600"><?php echo $course_title ?></h4>
                                                        <div class="course-price-html">
                                                            <?php echo $course_price_html ?>
                                                        </div>
                                                        <div class="text-center course-completion-time">
                                                            <span class="font-600">Completion Time</span>
                                                            <span><?php echo $course_completion_time ?>
                                                        </div>
                                                        <a target="_blank" href="<?php echo $course_guide_link ?>" class="course-cta-btn btn btn-primary btn-centered ">
                                                            download guide
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="course_card__bottom" style="<?php if(is_page('82988')) { ?>display: none;<?php } ?>">
                                                    <h3 class="course-card__bottom-title text-center font-600">
                                                        <?php echo $feature_title ?>
                                                    </h3>
                                                    <div class="course-card__bottom-content features">
                                                        <?php
                                                        if (!empty($includes)) :
                                                            foreach ($includes as $include) :
                                                                $feature = $include['feature'];
                                                        ?>
                                                                <div class="feature-include"><img src="/wp-content/uploads/2023/07/check.svg" alt="" class="check-icon"><?php echo $feature ?></div>
                                                            <?php
                                                            endforeach;
                                                        endif;
                                                        if (!empty($excludes)) :
                                                            foreach ($excludes as $exclude) :
                                                                $feature = $exclude['feature'];
                                                            ?>
                                                                <div class="feature-exclude"><img src="/wp-content/uploads/2023/07/cross_muted.svg" alt="" class="cross-icon"><?php echo $feature ?></div>
                                                        <?php
                                                            endforeach;
                                                        endif ?>
                                                    </div>
                                                    <a href="<?php echo $course_link ?>" class="course-cta-btn btn btn-primary btn-centered">learn more</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="accredited-section more-accredited-section section-padding-top" style="display:none">
                <div class="ast-container">
                    <div class="ast-row">
                        <?php
                        $accredited_tefl_courses = $courses_section['more_accredited_tefl_courses'];
                        $section_title = $accredited_tefl_courses['section_title'];
                        $section_summary = $accredited_tefl_courses['section_summary'];
                        $courses = $accredited_tefl_courses['courses'];
                        ?>
                        <div class="accredited-section__row">
                            <div class="ast-col-md-12 accredited-section__header">
                                <h2 class="large-heading common-section-heading text-center">
                                    <?php echo $section_title ?>
                                </h2>
                                <div class="accredited-section__header-summary courses-section__header-summary text-center">
                                    <?php echo $section_summary ?>
                                </div>
                            </div>
                            <div class="ast-col-md-12  spacer-column"></div>
                            <div class="accredited-section__body">
                                <?php
                                foreach ($courses as $index => $course) :
                                    $course_id = $course['course'];
                                    $course_bg_image = $course['background_image'];
                                    $course_icon = $course['course_icon'];
                                    $course_title = $course['course_title'];
                                    $course_completion_time = $course['course_completion_time'];
                                    $course_link = get_post_permalink($course_id);
                                    $course_guide_link = $course['guide_link'];
                                    $course_product_id = get_field('course_product', $course_id);
                                    $course_product = wc_get_product($course_product_id);
                                    $course_price_html = $course_product->get_price_html();

                                    $features = $course['features'];
                                    $feature_title = $features['feature_title'];
                                    $includes = $features['includes'];
                                    $excludes = $features['excludes'];
                                ?>
                                    <div class="ast-col-md-6">
                                        <div class="course-card">
                                            <div class="course-card__top" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $course_bg_image ?>')">
                                                <div class="course-card__top-icon text-center">
                                                    <img src="<?php echo $course_icon ?>" alt="">
                                                </div>
                                                <div class="fast-track-course deposit-info ast-flex ast-align-items-center">
                                                    <div class="depoist-info__icon">
                                                        <img src="/wp-content/uploads/2023/07/fasttrack.svg" alt="">
                                                    </div>
                                                    <div class="ast-flex flex-direction-column deposit-info__details">
                                                        <h5 class="deposit-info_title">Fast Track</h5>
                                                        <div class="deposit-info_description">
                                                            Get access to entry-level jobs. Qualify to teach at home & abroad.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="course-card__top-content">
                                                    <h4 class="course-title text-center font-600"><?php echo $course_title ?></h4>
                                                    <div class="course-price-html">
                                                        <?php echo $course_price_html ?>
                                                    </div>
                                                    <div class="text-center course-completion-time">
                                                        <span class="font-600">Completion Time</span>
                                                        <span><?php echo $course_completion_time ?>
                                                    </div>
                                                    <a target="_blank" href="<?php echo $course_guide_link ?>" class="course-cta-btn btn btn-primary btn-centered ">
                                                        download guide
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="course_card__bottom" style="<?php if(is_page('82988')) { ?>display: none;<?php } ?>">
                                                <h3 class="course-card__bottom-title text-center font-600">
                                                    <?php echo $feature_title ?>
                                                </h3>
                                                <div class="course-card__bottom-content features">
                                                    <?php
                                                    if (!empty($includes)) :
                                                        foreach ($includes as $include) :
                                                            $feature = $include['feature'];
                                                    ?>
                                                            <div class="feature-include"><img src="/wp-content/uploads/2023/07/check.svg" alt="" class="check-icon"><?php echo $feature ?></div>
                                                        <?php
                                                        endforeach;
                                                    endif;
                                                    if (!empty($excludes)) :
                                                        foreach ($excludes as $exclude) :
                                                            $feature = $exclude['feature'];
                                                        ?>
                                                            <div class="feature-exclude"><img src="/wp-content/uploads/2023/07/cross_muted.svg" alt="" class="cross-icon"><?php echo $feature ?></div>
                                                    <?php
                                                        endforeach;
                                                    endif ?>
                                                </div>
                                                <a href="<?php echo $course_link ?>" class="course-cta-btn btn btn-primary btn-centered">learn more</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="<?php echo str_replace(' ', '_', $courses_tab_menu[1]['tab_title']) ?>" class="level-5-diploma-courses-section section-padding-top">
                <div class="ast-container">
                    <div class="ast-row">
                        <?php
                        $level_5_diploma_courses = $courses_section['level_5_diploma_course'];
                        $section_title = $level_5_diploma_courses['section_title'];
                        $section_summary = $level_5_diploma_courses['section_summary'];
                        $courses = $level_5_diploma_courses['courses'];
                        ?>
                        <div class="level-5-diploma-courses-section__row">
                            <div class="ast-col-md-12 level_5_diploma_courses-section__header">
                                <h2 class="large-heading common-section-heading text-center">
                                    <?php echo $section_title ?>
                                </h2>
                                <div class="level_5_diploma_courses__header-summary courses-section__header-summary text-center">
                                    <?php echo $section_summary ?>
                                </div>
                            </div>
                            <div class="ast-col-md-12  spacer-column"></div>
                            <div class="level_5_diploma_courses-section__body">
                                <?php
                                foreach ($courses as $index => $course) :
                                    $course_id = $course['course'];
                                    $course_bg_image = $course['background_image'];
                                    $course_icon = $course['course_icon'];
                                    $course_title = $course['course_title'];
                                    $course_completion_time = $course['course_completion_time'];
                                    $course_guide_link = $course['course_guide_link'];
                                    $course_link = get_post_permalink($course_id);
                                    $course_product_id = get_field('course_product', $course_id);
                                    $course_product = wc_get_product($course_product_id);
                                    $course_price_html = $course_product->get_price_html();

                                    $features = $course['features'];
                                    $feature_title = $features['feature_title'];
                                    $includes = $features['includes'];
                                    $excludes = $features['excludes'];

                                    $has_depoist = $course['has_depoist'];
                                    if ($has_depoist) {
                                        $deposit_info = $course['deposit_info'];
                                        $deposit_icon = $deposit_info['deposit_icon'];
                                        $deposit_title = $deposit_info['deposit_title'];
                                        $deposit_description = $deposit_info['deposit_description'];
                                    }

                                    $has_freebies = $course['has_freebies'];
                                    if ($has_freebies) {
                                        $freebies = $course['freebies'];
                                    }
                                ?>
                                    <div class="ast-col-md-6">
                                        <div class="course-card">
                                            <div class="course-card__top" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $course_bg_image ?>')">
                                                <div class="course-card__top-icon text-center">
                                                    <img src="<?php echo $course_icon ?>" alt="">
                                                </div>
                                                <?php
                                                if ($has_depoist) :
                                                ?>
                                                    <div class="fast-track-course deposit-info ast-flex ast-align-items-center">
                                                        <div class="depoist-info__icon">
                                                            <img src="<?php echo $deposit_icon ?>" alt="">
                                                        </div>
                                                        <div class="ast-flex flex-direction-column deposit-info__details">
                                                            <h5 class="deposit-info_title"><?php echo $deposit_title ?></h5>
                                                            <div class="deposit-info_description">
                                                                <?php echo $deposit_description ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                endif;
                                                ?>
                                                <div class="course-card__top-content">
                                                    <h4 class="course-title text-center font-600"><?php echo $course_title ?></h4>
                                                    <div class="course-price-html">
                                                        <?php echo $course_price_html ?>
                                                    </div>
                                                    <div class="text-center course-completion-time">
                                                        <span class="font-600">Completion Time</span>
                                                        <span><?php echo $course_completion_time ?>
                                                    </div>

                                                    <?php if(is_page('82988')) { ?>
                                                        <a href="<?php echo $course_link ?>" class="course-cta-btn btn btn-primary btn-centered">learn more</a>
                                                    <?php } ?>

                                                    <a target="_blank" href="<?php echo $course_guide_link ?>" class="course-cta-btn btn btn-primary btn-centered"  style="<?php if(is_page('82988')) { ?>background-color: #daab37;<?php } ?>">
                                                        download guide
                                                    </a>
                                                        
                                                </div>
                                            </div>
                                            <div class="course_card__bottom" style="<?php if(is_page('82988')) { ?>display: none;<?php } ?>">
                                                <h3 class="course-card__bottom-title text-center font-600">
                                                    <?php echo $feature_title ?>
                                                </h3>
                                                <div class="course-card__bottom-content features">
                                                    <?php
                                                    if (!empty($includes)) :
                                                        foreach ($includes as $include) :
                                                            $feature = $include['feature'];
                                                    ?>
                                                            <div class="feature-include"><img src="/wp-content/uploads/2023/07/check.svg" alt="" class="check-icon"><?php echo $feature ?></div>
                                                        <?php
                                                        endforeach;
                                                    endif;
                                                    if (!empty($excludes)) :
                                                        foreach ($excludes as $exclude) :
                                                            $feature = $exclude['feature'];
                                                        ?>
                                                            <div class="feature-exclude"><img src="/wp-content/uploads/2023/07/cross_muted.svg" alt="" class="cross-icon"><?php echo $feature ?></div>
                                                    <?php
                                                        endforeach;
                                                    endif ?>
                                                </div>
                                                <?php if ($has_freebies && !empty($freebies)) : ?>
                                                    <div class="course-card-freebies">
                                                        <?php
                                                        foreach ($freebies as $freebie) :
                                                            $freebie_icon = $freebie['freebie_icon'];
                                                            $freebie_text = $freebie['freebie_text'];
                                                        ?>
                                                            <div class="course-freebie">
                                                                <img src="<?php echo $freebie_icon ?>" class="course-freebie__icon" />
                                                                <span class="course-freebie__text font-500">
                                                                    <?php echo $freebie_text ?>
                                                                </span>
                                                            </div>
                                                        <?php
                                                        endforeach
                                                        ?>
                                                    </div>
                                                <?php endif ?>
                                                <a href="<?php echo $course_link ?>" class="course-cta-btn btn btn-primary btn-centered">learn more</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $english_level_cta_box = $courses_section['english_level_cta_box'];
            if (!empty($english_level_cta_box)) :
                $cta_box_bg = $english_level_cta_box['cta_box_background'];
                $cta_title = $english_level_cta_box['cta_title'];
                $cta_summary = $english_level_cta_box['cta_summary'];
                $cta_link_text = $english_level_cta_box['cta_link_text'];
                $cta_link_url = $english_level_cta_box['cta_link_url'];
            ?>
                <?php if($cta_title) { ?>
                    <div class="elt-cta-box section-padding-top">
                        <div class="ast-container">
                            <div class="ast-row">
                                <div class="ast-col-md-12">
                                    <div class="elt-cta-box-wrapper" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.75)), url('<?php echo $cta_box_bg ?>')">
                                        <h2 class="font-400 text-center large-heading elt-cta-box__title">
                                            <?php echo $cta_title ?>
                                        </h2>
                                        <div class="font-300 elt-cta-box__summary">
                                            <?php echo $cta_summary ?>
                                        </div>
                                        <a href="<?php echo $cta_link_url ?>" class="btn btn-white-small elt-cta-box-btn">
                                            <span><?php echo $cta_link_text ?></span>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php
            endif;
            ?>

            <?php
            $virtual_course_cta_box = $courses_section['virtual_course_cta_box'];
            if (!empty($virtual_course_cta_box)) :
                $cta_box_bg = $virtual_course_cta_box['cta_box_background'];
                $cta_title = $virtual_course_cta_box['cta_title'];
                $cta_summary = $virtual_course_cta_box['cta_summary'];
                $cta_link_text = $virtual_course_cta_box['cta_link_text'];
                $cta_link_url = $virtual_course_cta_box['cta_link_url'];
            ?>
                <?php if($cta_title) { ?>
                    <div class="virtual-course-cta-box section-padding-top">
                        <div class="ast-container">
                            <div class="ast-row">
                                <div class="ast-col-md-12">
                                    <div class="virtual-course-cta-box-wrapper" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.75)), url('<?php echo $cta_box_bg ?>')">
                                        <h2 class="font-400 text-center large-heading virtual-course-cta-box__title">
                                            <?php echo $cta_title ?>
                                        </h2>
                                        <div class="font-300 virtual-course-cta-box__summary">
                                            <?php echo $cta_summary ?>
                                        </div>
                                        <a href="<?php echo $cta_link_url ?>" class="btn btn-white-small virtual-course-cta-box-btn">
                                            <span><?php echo $cta_link_text ?></span>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php
            endif;
            ?>

            <div id="<?php echo str_replace(' ', '_', $courses_tab_menu[2]['tab_title']) ?>" class="hybrid-diploma-courses-section section-padding-top">
                <div class="ast-container">
                    <div class="ast-row">
                        <?php
                        $hybrid_diploma_courses = $courses_section['hybrid_diploma_courses'];
                        $section_title = $hybrid_diploma_courses['section_title'];
                        $section_summary = $hybrid_diploma_courses['section_summary'];
                        $courses = $hybrid_diploma_courses['courses'];
                        ?>
                        <div class="hybrid-diploma-courses-section__row">
                            <div class="ast-col-md-12 hybrid-diploma-courses-section__header">
                                <h2 class="large-heading common-section-heading text-center">
                                    <?php echo $section_title ?>
                                </h2>
                                <div class="hybrid-diploma-courses-section__header-summary courses-section__header-summary text-center">
                                    <?php echo $section_summary ?>
                                </div>
                            </div>
                            <div class="ast-col-md-12 spacer-column"></div>
                            <div class="hybrid-diploma-courses-section__body">
                                <?php
                                foreach ($courses as $index => $course) :
                                    $course_id = $course['course'];
                                    $course_bg_image = $course['background_image'];
                                    $course_icon = $course['course_icon'];
                                    $course_title = $course['course_title'];
                                    $course_completion_time = $course['course_completion_time'];
                                    $course_guide_link = $course['course_guide_link'];
                                    $course_link = get_post_permalink($course_id);
                                    $course_product_id = get_field('course_product', $course_id);
                                    $course_product = wc_get_product($course_product_id);
                                    $course_price_html = $course_product->get_price_html();

                                    $features = $course['features'];
                                    $feature_title = $features['feature_title'];
                                    $includes = $features['includes'];
                                    $excludes = $features['excludes'];

                                    $has_depoist = $course['has_depoist'];
                                    if ($has_depoist) {
                                        $deposit_info = $course['deposit_info'];
                                        $deposit_icon = $deposit_info['deposit_icon'];
                                        $deposit_title = $deposit_info['deposit_title'];
                                        $deposit_description = $deposit_info['deposit_description'];
                                    }

                                    $has_freebies = $course['has_freebies'];
                                    if ($has_freebies) {
                                        $freebies = $course['freebies'];
                                    }
                                ?>
                                    <div class="<?php if(is_page('82988')) { ?>ast-col-md-6<?php } else { ?>ast-col-md-6<?php } ?>">
                                        <div class="course-card">
                                            <div class="course-card__top" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $course_bg_image ?>')">
                                                <div class="course-card__top-icon text-center">
                                                    <img src="<?php echo $course_icon ?>" alt="">
                                                </div>
                                                <?php
                                                if ($has_depoist) :
                                                ?>
                                                    <div class="fast-track-course deposit-info ast-flex ast-align-items-center">
                                                        <div class="depoist-info__icon">
                                                            <img src="<?php echo $deposit_icon ?>" alt="">
                                                        </div>
                                                        <div class="ast-flex flex-direction-column deposit-info__details">
                                                            <h5 class="deposit-info_title"><?php echo $deposit_title ?></h5>
                                                            <div class="deposit-info_description">
                                                                <?php echo $deposit_description ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                else :
                                                ?>

                                                    <div class="fast-track-course deposit-info ast-flex ast-align-items-center">
                                                        <div class="depoist-info__icon">
                                                            <img src="/wp-content/uploads/2023/07/fasttrack.svg" alt="">
                                                        </div>
                                                        <div class="ast-flex flex-direction-column deposit-info__details">
                                                            <h5 class="deposit-info_title">Fast Track</h5>
                                                            <div class="deposit-info_description">
                                                                Get access to entry-level jobs. Qualify to teach at home & abroad.
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php endif ?>

                                                <div class="course-card__top-content">
                                                    <h4 class="course-title text-center font-600"><?php echo $course_title ?></h4>
                                                    <div class="course-price-html">
                                                        <?php echo $course_price_html ?>
                                                    </div>
                                                    <div class="text-center course-completion-time">
                                                        <span class="font-600">Completion Time</span>
                                                        <span><?php echo $course_completion_time ?>
                                                    </div>

                                                    <?php if(is_page('82988')) { ?>
                                                            
                                                        <a href="<?php echo $course_link ?>" class="course-cta-btn btn btn-primary btn-centered">learn more</a>

                                                    <?php } ?>

                                                    <a target="_blank" href="<?php echo $course_guide_link ?>" class="course-cta-btn btn btn-primary btn-centered" style="<?php if(is_page('82988')) { ?>background-color: #daab37;<?php } ?>">
                                                            download guide
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="course_card__bottom" style="<?php if(is_page('82988')) { ?>display: none;<?php } ?>">
                                                <h3 class="course-card__bottom-title text-center font-600">
                                                    <?php echo $feature_title ?>
                                                </h3>
                                                <div class="course-card__bottom-content features">
                                                    <?php
                                                    if (!empty($includes)) :
                                                        foreach ($includes as $include) :
                                                            $feature = $include['feature'];
                                                    ?>
                                                            <div class="feature-include"><img src="/wp-content/uploads/2023/07/check.svg" alt="" class="check-icon"><?php echo $feature ?></div>
                                                        <?php
                                                        endforeach;
                                                    endif;
                                                    if (!empty($excludes)) :
                                                        foreach ($excludes as $exclude) :
                                                            $feature = $exclude['feature'];
                                                        ?>
                                                            <div class="feature-exclude"><img src="/wp-content/uploads/2023/07/cross_muted.svg" alt="" class="cross-icon"><?php echo $feature ?></div>
                                                    <?php
                                                        endforeach;
                                                    endif ?>
                                                </div>
                                                <?php if ($has_freebies && !empty($freebies)) : ?>
                                                    <div class="course-card-freebies">
                                                        <?php
                                                        foreach ($freebies as $freebie) :
                                                            $freebie_icon = $freebie['freebie_icon'];
                                                            $freebie_text = $freebie['freebie_text'];
                                                        ?>
                                                            <div class="course-freebie">
                                                                <img src="<?php echo $freebie_icon ?>" class="course-freebie__icon" />
                                                                <span class="course-freebie__text font-500">
                                                                    <?php echo $freebie_text ?>
                                                                </span>
                                                            </div>
                                                        <?php
                                                        endforeach
                                                        ?>
                                                    </div>
                                                <?php endif ?>
                                                <a href="<?php echo $course_link ?>" class="course-cta-btn btn btn-primary btn-centered">learn more</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $academic_director_note = $courses_section['academic_director_note'];
            if (!empty($academic_director_note)) :
                $cta_image = $academic_director_note['image'];
                $cta_title = $academic_director_note['title'];
                $cta_content = $academic_director_note['content'];
                $cta_link_text = $academic_director_note['cta_text'];
                $cta_link_url = $academic_director_note['cta_link'];
            ?>

                <div class="academic-director-note-section section-padding-top">
                    <div class="ast-container">
                        <div class="ast-row">
                            <div class="ast-col-md-12">
                                <div class="academic-director-note-section__row">
                                    <div class="academic-director-note-section__row-left">
                                        <h2 class="font-700 academic-director-note-section-heading ">
                                            <?php echo $cta_title ?>
                                        </h2>
                                        <div class="academic-director-note-section-content">
                                            <?php echo $cta_content ?>
                                        </div>
                                        <a href="<?php $cta_link_url ?>" class="btn btn-small btn-centered btn-secondary">
                                            <?php echo $cta_link_text ?>
                                        </a>
                                    </div>
                                    <div class="academic-director-note-section__row-right">
                                        <img src="<?php echo $cta_image ?>" alt="" class="academic-director-note-section-image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            endif;
            ?>

            <?php
                $specialist_courses = $courses_section['specialist_courses'];
                $section_title = $specialist_courses['section_title'];
                $section_summary = $specialist_courses['section_summary'];
                $courses = $specialist_courses['courses'];
            ?>

            <?php if($section_title) { ?>
            <div id="<?php echo str_replace(' ', '_', $courses_tab_menu[3]['tab_title']) ?>" class="specialist-courses-section section-padding-top">
                <div class="ast-container">
                    <div class="ast-row">
                        
                        <div class="specialist-courses-section__row">
                            <div class="ast-col-md-12 hybrid-diploma-courses-section__header">
                                <h2 class="large-heading common-section-heading text-center">
                                    <?php echo $section_title ?>
                                </h2>
                                <div class="specialist-courses-section__header-summary courses-section__header-summary text-center">
                                    <?php echo $section_summary ?>
                                </div>
                            </div>
                            <div class="ast-col-md-12  spacer-column"></div>
                            <div class="specialist-courses-section__body">
                                <?php
                                foreach ($courses as $index => $course) :
                                    $course_id = $course['course'];
                                    $course_bg_image = $course['background_image'];
                                    $course_icon = $course['course_icon'];
                                    $course_title = $course['course_title'];
                                    $course_completion_time = $course['course_completion_time'];
                                    $course_link = get_post_permalink($course_id);
                                    $course_product_id = get_field('course_product', $course_id);
                                    $course_product = wc_get_product($course_product_id);
                                    $course_price_html = $course_product->get_price_html();
                                    $features = $course['features'];
                                    $feature_title = $features['feature_title'];
                                    $includes = $features['includes'];
                                    $excludes = $features['excludes'];

                                ?>
                                    <div class="ast-col-md-6">
                                        <div class="course-card">
                                            <div class="course-card--specialist">
                                                <div class="course-card--specialist__header" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $course_bg_image ?>')">
                                                    <img src="<?php echo $course_icon ?>" alt="">
                                                </div>
                                                <div class="coursec-card--specialist__body">
                                                    <h4 class="course-title font-600"><?php echo $course_title ?></h4>
                                                    <div class="course-price-html">
                                                        <?php echo $course_price_html ?>
                                                    </div>
                                                    <div class="course-completion-time">
                                                        <span class="font-600">Completion Time</span>
                                                        <span><?php echo $course_completion_time ?>
                                                    </div>
                                                    <a href="<?php echo $course_link ?>" class="course-cta-btn btn btn-primary btn-centered ">
                                                        learn more
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                            if (is_array($features) && !empty(array_filter($features))) :
                                            ?>
                                                <div class="course_card__bottom">
                                                    <h3 class="course-card__bottom-title text-center font-600">
                                                        <?php echo $feature_title ?>
                                                    </h3>
                                                    <div class="course-card__bottom-content features">
                                                        <?php
                                                        if (!empty($includes)) :
                                                            foreach ($includes as $include) :
                                                                $feature = $include['feature'];
                                                        ?>
                                                                <div class="feature-include"><img src="/wp-content/uploads/2023/07/check.svg" alt="" class="check-icon"><?php echo $feature ?></div>
                                                            <?php
                                                            endforeach;
                                                        endif;
                                                        if (!empty($excludes)) :
                                                            foreach ($excludes as $exclude) :
                                                                $feature = $exclude['feature'];
                                                            ?>
                                                                <div class="feature-exclude"><img src="/wp-content/uploads/2023/07/cross_muted.svg" alt="" class="cross-icon"><?php echo $feature ?></div>
                                                        <?php
                                                            endforeach;
                                                        endif ?>
                                                    </div>
                                                    <a href="<?php echo $course_link ?>" class="course-cta-btn btn btn-primary btn-centered">learn more</a>
                                                </div>
                                            <?php
                                            endif;
                                            ?>
                                        </div>

                                    </div>
                                    <?php
                                    if ($index === 1) :
                                    ?>
                                        <div class="ast-col-md-12 spacer-column"></div>
                                    <?php
                                    endif;
                                    ?>
                                <?php
                                endforeach
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php
                $specialist_courses = $courses_section['level_5_specialist_courses'];
                $section_title = $specialist_courses['section_title'];
                $section_summary = $specialist_courses['section_summary'];
                $courses = $specialist_courses['courses'];
            ?>
            <?php if($section_title) { ?>
            <div class="specialist-courses-section l5-specialist-courses-section section-padding-top">
                <div class="ast-container">
                    <div class="ast-row">
                        
                        <div class="specialist-courses-section__row">
                            <div class="ast-col-md-12 hybrid-diploma-courses-section__header">
                                <h2 class="large-heading common-section-heading text-center">
                                    <?php echo $section_title ?>
                                </h2>
                                <div class="specialist-courses-section__header-summary courses-section__header-summary text-center">
                                    <?php echo $section_summary ?>
                                </div>
                            </div>
                            <div class="ast-col-md-12  spacer-column"></div>
                            <div class="specialist-courses-section__body">
                                <?php
                                foreach ($courses as $index => $course) :
                                    $course_id = $course['course'];
                                    $course_bg_image = $course['background_image'];
                                    $course_icon = $course['course_icon'];
                                    $course_title = $course['course_title'];
                                    $course_completion_time = $course['course_completion_time'];
                                    $course_link = get_post_permalink($course_id);
                                    $course_product_id = get_field('course_product', $course_id);
                                    $course_product = wc_get_product($course_product_id);
                                    $course_price_html = $course_product->get_price_html();

                                ?>
                                    <div class="ast-col-md-4">
                                        <div class="course-card--specialist">
                                            <div class="course-card--specialist__header" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $course_bg_image ?>')">
                                                <img src="<?php echo $course_icon ?>" alt="">
                                            </div>
                                            <div class="coursec-card--specialist__body">
                                                <h4 class="course-title font-600"><?php echo $course_title ?></h4>
                                                <div class="course-price-html">
                                                    <?php echo $course_price_html ?>
                                                </div>
                                                <div class="course-completion-time">
                                                    <span class="font-600">Completion Time</span>
                                                    <span><?php echo $course_completion_time ?>
                                                </div>
                                                <a href="<?php echo $course_link ?>" class="course-cta-btn btn btn-primary btn-centered ">
                                                    learn more
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                    if ($index === 2) :
                                    ?>
                                        <div class="ast-col-md-12 spacer-column"></div>
                                    <?php
                                    endif;
                                    ?>
                                <?php
                                endforeach
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

        </section>

        <!-- Courses Group Section -->
    <?php
    endif;
    ?>
    <?php
        $frequently_asked_questions = get_cfvalue_by_country('frequently_asked_questions');
        if(!is_array_empty($frequently_asked_questions)):
    ?>
    <section class="faqs-section full-width has-bg section-padding-bottom">
        
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
                <div class="ast-col-md-12">
                    <div class="faqs-section__row">
                        <h2 class="large-heading common-section-heading">FAQS</h2>
                        <div class="faqs-section__row-body">
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
        </div>
    </section>
    <?php
        endif;
    ?>
</div>

<?php get_footer(); ?>