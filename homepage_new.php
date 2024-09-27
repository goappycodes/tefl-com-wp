<?php

/**
 * Template Name: Homepage New
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();
?>
<div id="primary" <?php astra_primary_class(); ?>>
    <!-- Banner Section -->
    <section class="banner-section full-width">
        <?php
        $banner = get_field('banner');

        $banner_header = $banner['banner_header'];
        $banner_main = $banner['banner_main'];

        $banner_header_text = $banner_header['banner_header_text'];
        $banner_menu = $banner_header['banner_menu'];
        $banner_menu_items = $banner_menu['banner_menu_item'];

        $banner_main_text = $banner_main['banner_main_text'];
        $banner_main_text_heading = $banner_main_text['header'];
        $banner_main_text_subheading = $banner_main_text['sub_header'];
        $banner_main_image = $banner_main['banner_main_image'];
        $banner_main_image_background = $banner_main_image['background_image'];
        $banner_main_image_floating = $banner_main_image['floating_image'];

        $banner_video = $banner_main['banner_video'];
        $banner_video_link = $banner_video['video_link'];
        $banner_video_icon = $banner_video['video_play_icon'];
        ?>

        <div class="banner-header">
            <div class="ast-container" style="display:none">
                <div class="banner-header__top">
                    <div class="ast-row button-group">
                        <?php
                        foreach ($banner_menu_items as $menu_item) :
                            $menu_link = $menu_item['menu_link'];
                            $menu_link_text = $menu_item['menu_text'];
                        ?>
                            <div class="ast-col-md-4 banner-button">
                                <a href="<?php echo $menu_link; ?>" class="banner-header__top-link">
                                    <span><?php echo $menu_link_text; ?></span>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="banner-header__bottom">
                <div class="ast-container">
                    <span class="banner-header__text"><?php echo $banner_header_text; ?></span>
                </div>
            </div>
        </div>
        <div class="ast-container">
            <div class="banner-main ast-row ast-flex">
                <div class="ast-col-md-6 banner-main__left">
                    <h1 class="banner-main__left__heading">
                        <?php echo $banner_main_text_heading; ?>
                    </h1>
                    <h2 class="banner-main__left__subheading">
                        <?php echo $banner_main_text_subheading; ?>
                    </h2>
                </div>
                <div class="ast-col-md-6 banner-main__right" style="background-image: url('<?php echo $banner_main_image_background; ?>');">
                    <img class="floating-image" src="<?php echo $banner_main_image_floating?>" />
                </div>
                <a href="<?php echo $banner_video_link ?>" data-lity="" class="video-caption-link play-button lity-video">
                    <div class="vide-caption-box">
                        <span class="video-caption-text"><?php echo $govt_regulated_course_media_banner_title; ?></span>
                        <span class="video-icon"><img src="<?php echo $banner_video_icon ?>"></span>
                    </div>
                </a>
                <div class="search-course-form ast-col-md-12">
                    <h4 class="search-course-form-title">
                        Find the perfect TEFL course
                    </h4>
                    <?php echo do_shortcode('[tefl_course_search]'); ?>
                </div>
            </div>
        </div>
    </section>


    <!-- Banner Section End -->

    <!--Partners Section-->

    <section class="partners-section">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12 logo-group-container">
                    <div class="logo-group">
                        <?php
                        $first_gallery = get_field('partners_gallery_1', 'options');
                        if ($first_gallery) : ?>
                            <?php foreach ($first_gallery as $image) : ?>
                                <img class="image" src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" />
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="logo-group logo-group-2">
                        <?php
                        $second_gallery = get_field('partners_gallery_2', 'options');
                        if ($second_gallery) : ?>
                            <?php foreach ($second_gallery as $image) : ?>
                                <img class="image" src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" />
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Partners Section End-->

    <!--Tabbed Content-->
    <?php
    $tabs_section = get_field('tabs_section');
    if ($tabs_section) :
    ?>
        <section class="tabbed-content-section">
            <?php
            $tabs_section_header = $tabs_section['tabs_section_header'];
            $tabs_section_title = $tabs_section_header['title'];
            $tabs_section_stitle = $tabs_section_header['subtitle'];

            $tabs_section_body = $tabs_section['tabs_section_body'];
            $tabs = $tabs_section_body['tabs'];
            // print_r($tabs);
            ?>
            <div class="ast-container">
                <h2 class="section-title"><?php echo $tabs_section_title ?></h2>
                <h3 class="section-subtitle"><?php echo $tabs_section_stitle ?></h3>
                <div class="ast-row tabs-container">
                    <div class="ast-col-md-12 tabs-menu">
                        <div class="tabs-menu-wrapper">
                            <?php
                            $count = 0;
                            foreach ($tabs as $tab) :
                                $tab_menu_title = $tab['tab_menu_title'];
                                $tab_menu_title_id = str_replace(' ', '', $tab_menu_title);
                                $checked = $count == 0 ? 'checked' : '';
                            ?>

                                <input class="tab-input" name="tab-menu" data-tab-target="<?php echo '#' . $tab_menu_title_id ?>" type="radio" id="<?php echo $tab_menu_title_id . '-tab'; ?>" <?php echo $checked ?> />
                                <label class="tab-input-label" for="<?php echo $tab_menu_title_id . '-tab'; ?>"><?php echo $tab_menu_title; ?></label>
                            <?php
                                $count += 1;
                            endforeach; ?>
                        </div>
                    </div>
                    <div class="ast-col-md-12 tabs-content">
                        <?php
                        $count = 0;
                        foreach ($tabs as $key => $tab) :
                            $tab_menu_title = $tab['tab_menu_title'];
                            $tab_content = $tab['tab_content'];
                            $tab_content_title = $tab_content['tab_content_title'];
                            $tab_content_text = $tab_content['tab_content_summary'];
                            $button_text = $tab_content['see_more_button_text'];
                            $button_link = $tab_content['see_more_button_link'];
                            $posts = isset($tab_content['posts']) ? $tab_content['posts'] : array();
                        ?>
                            <div class="tab-content-container <?php echo $count == 0 ? 'active' : '' ?>" data-tab-content id="<?php echo str_replace(' ', '', $tab_menu_title); ?>">
                                <h3 class="tab-content-title"><?php echo $tab_content_title; ?></h3>
                                <div class="ast-row row-top">
                                    <div class="ast-col-md-8">
                                        <p class="tab-content-text"><?php echo $tab_content_text; ?></p>
                                    </div>
                                    <div class="ast-col-md-4">
                                        <a href="<?php echo $button_link ?>" target="_blank" class="button-link">
                                            <?php echo $button_text; ?>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ast-row row-bottom">
                                    <?php
                                    $id_array = [];
                                    foreach ($posts as $p) :
                                        if (!empty($p['post'])) :
                                            $id_array[] = $p['post'];
                                        endif;
                                    endforeach;
                                    if (count($id_array) === 0) :
                                        $jobs = get_ti_jobs(3, false);
                                        foreach ($jobs as $job) :
                                            $job_title = $job->job_title;
                                            $job_link = $job->job_link;
                                            $job_image = $job->job_image;
                                            $job_location = $job->job_location;
                                            $job_salary = $job->job_salary;
                                            $start_date = $job->start_date;
                                    ?>
                                            <div class="ast-col-md-4 job">
                                                <div class="job-card">
                                                    <a href="<?php echo $job_link?>" class="post-card-clickbox"></a>
                                                    <div class="job-image">
                                                        <img src="<?php echo $job_image; ?>" />
                                                    </div>
                                                    <div class="job-content">
                                                        <h4 class="job-title"><?php echo strtolower($job_title); ?></h4>
                                                        <div class="job-content__meta">
                                                            <div class="meta-item ast-flex">
                                                                <span class="meta-item__key">Location:</span>
                                                                <span class="meta-item__value"><?php echo $job_location; ?></span>
                                                            </div>
                                                            <div class="meta-item ast-flex">
                                                                <span class="meta-item__key">Salary:</span>
                                                                <span class="meta-item__value"><?php echo $job_salary; ?></span>
                                                            </div>
                                                            <div class="meta-item ast-flex">
                                                                <span class="meta-item__key">Open Dates:</span>
                                                                <span class="meta-item__value"><?php echo $start_date; ?></span>
                                                            </div>
                                                        </div>
                                                        <a href="<?php echo $job_link; ?>" class="button-link">
                                                            Learn More
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        endforeach;
                                    else :
                                        foreach ($posts as $post) :
                                            $post_ID    = $post['post'];
                                            $post_type  = get_post_type($post_ID);
                                            $post_title = get_the_title($post_ID);
                                            $post_image = get_the_post_thumbnail_url($post_ID);
                                            $post_icons = $post['post_bottom_icons'];
                                            $post_info  = $post['post_info'];
 
                                            if ($post_type == 'course') :
                                                $hero_banner = get_field('hero_banner', $post_ID);
                                                $post_image = $hero_banner['banner_image'];
                                                $banner_cta = $hero_banner['banner_cta'];
                                                $post_description = strip_tags($banner_cta['banner_cta_text']);
                                                if (strlen($post_description) > 150) :
                                                    $post_description = substr($post_description, 0, 150) . '...';
                                                endif;
                                                $post_description  = substr($post_description, 0, 200);
                                                $product_ID = get_post_meta($post_ID, 'course_product');
                                                $product = wc_get_product($product_ID[0]);
                                                $deposit_plan = get_post_meta($product_ID[0], '_wc_deposit_payment_plans', true);
                                                $deposit_plan = $deposit_plan[0];   
                                                $deposit_enabled = get_post_meta($product_ID[0], '_wc_deposit_enabled', true);
                                            elseif ($post_type == 'internship' && empty($post_image)) :
                                                $post_image = get_field('banner', $post_ID);
                                                $post_image = $post_image['image'];
                                                $product_ID = get_post_meta($post_ID, 'internship_product');
                                                $product = wc_get_product($product_ID[0]);
                                            endif;
                                            if ($post_type === 'internship') :
                                                $product_ID = get_post_meta($post_ID, 'internship_product');
                                                $product = wc_get_product($product_ID[0]);
                                                $deposit_plan = get_post_meta($product_ID[0], '_wc_deposit_payment_plans', true);
                                                $deposit_plan = $deposit_plan[0];
                                                $deposit_enabled = get_post_meta($product_ID[0], '_wc_deposit_enabled', true);
                                                $post_description = $post['post_short_description'];
                                                if (strlen($post_description) > 150) :
                                                    $post_description = substr($post_description, 0, 150) . '...';
                                                endif;
                                            endif;
                                            $post_link = get_permalink($post_ID);
                                            $webinar_link = 'https://teflinstitute.com/upcoming-tefl-webinars/';
                                            if($deposit_plan === 4):
                                                $total_deposits = 3;
                                            endif;
                                            if($deposit_plan === 1 || $deposit_plan === 3){
                                                $total_deposits = 2;
                                            }
                                            if(!empty($post_title)):
                                        ?>
                                            <div class="ast-col-md-4 <?php echo !empty($post_type)?$post_type:'' ?>">
                                                <div class="post-container">
                                                    <a href="<?php echo $post_type != 'webinar'?$post_link:$webinar_link?>" class="post-card-clickbox"></a>
                                                    <div class="post-image">
                                                        <img class="post-image-fit" src="<?php echo $post_image; ?>" />
                                                    </div>

                                                    <?php if ($post_type == 'course') : ?>
                                                        <div class="post-icons-wrapper ast-flex">
                                                            <?php foreach ($post_icons as $post_icon) : ?>
                                                                <div class="post-icons">
                                                                    <img class="bottom-icons" src="<?php echo $post_icon['icon']; ?>" <?php if ($post_icon['inactive']) { ?>style="opacity:50%;" <?php } ?>>
                                                                </div>
                                                            <?php endforeach ?>
                                                        </div>
                                                    <?php endif ?>

                                                    <div class="post-content">
                                                        <h3 class="post-title"><?php echo $post_title; ?></h3>
                                                        <?php if ($post_type === 'course' || $post_type === 'internship') : ?>
                                                            <div class="post-description"><?php echo $post_description ?></div>
                                                        <?php endif; ?>
                                                        <?php if ($post_type === 'internship' || $post_type === 'webinar') : ?>
                                                            <div class="post-content__meta">
                                                                <?php foreach ($post_info as $post_info_item) : ?>
                                                                    <div class="meta-item ast-flex">
                                                                        <span class="meta-item__key"><?php echo $post_info_item['info_title']; ?>:</span>
                                                                        <span class="meta-item__value"><?php echo $post_info_item['info_value']; ?></span>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if ($product && $post_type != 'webinar') : ?>
                                                            <span class="product-price <?php echo $deposit_plan?>">
                                                                <?php echo $product->get_price_html(); ?>
                                                                <?php if(!empty($deposit_plan && !empty($deposit_enabled))):?>
                                                                    <span class="payment-plan">
                                                                    Pay in <?php echo $total_deposits?> interest free installments
                                                                    </span>
                                                                <?php endif?>
                                                                </span>
                                                        <?php endif ?>
                                                        <?php if ($post_type != 'webinar') : ?>
                                                            <a href="<?php echo $post_link; ?>" class="button-link">
                                                                Learn More
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                        <?php else : ?>
                                                            <a href="<?php echo $webinar_link?>" class="button-link">
                                                                Sign Up
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php 
                                            endif;
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        <?php
                            $count += 1;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
    endif;
    ?>

    <!--Tabbed Content End-->

    <!--Benefits-->

    <?php
    $benefits_section = get_field('benefits_section');
    if ($benefits_section) :
    ?>
        <section class="benefits-section">
            <div class="ast-container">
                <div class="ast-row">
                    <?php
                    $benefits = $benefits_section['benefits'];
                    foreach ($benefits as $benefit) :
                        $benefits_image_url = $benefit['icon'];
                        $benefits_title = $benefit['title'];
                        $benefits_subtitle = $benefit['subtitle'];
                    ?>
                        <div class="benefit-wrapper ast-col-md-3">
                            <div class="ast-flex">
                                <div class="benefit-image">
                                    <img src="<?php echo $benefits_image_url ?>" />
                                </div>
                                <div class="benefit-content ast-flex">
                                    <span class="benefit-title"><?php echo $benefits_title?></span>
                                    <span class="benefit-subtitle"><?php echo $benefits_subtitle?></span>
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
    <!--end benefits-->

    <!--Accredited Tefl Courses-->
    <?php
    $regulated_tefl_courses = get_field("regulated_tefl_courses");
    if ($regulated_tefl_courses) :
    ?>
        <section class="regulated-tefl-courses">
            <div class="ast-container">
                <div class="ast-row">
                    <?php
                    $regulated_tefl_course_image = $regulated_tefl_courses['regulated_course_image'];
                    $regulated_tefl_course_heading = $regulated_tefl_courses['regulated_course_heading'];
                    $regulated_tefl_course_subheading = $regulated_tefl_courses['regulated_course_subheading'];
                    $regulated_tefl_course_text = $regulated_tefl_courses['regulated_course_text'];
                    ?>
                    <div class="ast-flex">
                        <div class="ast-col-md-6 ">
                            <img src="<?php echo $regulated_tefl_course_image ?>" class="side-image" />
                        </div>
                        <div class="regulated-text-wrapper ast-col-md-6 ast-flex">
                            <span class="regulated-heading"><?php echo $regulated_tefl_course_heading ?></span>
                            <h2 class="regulated-subheading"><?php echo $regulated_tefl_course_subheading ?></h2>
                            <span class="regulated-text"><?php echo $regulated_tefl_course_text ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
    endif;
    ?>
    <!--Accredited Tefl Courses-->

    <!--get certified section-->
    <?php
    $get_certified_section = get_field("get_certified_section");
    if ($get_certified_section) :
    ?>
        <section class="get_certified_section">
            <div class="ast-container">
                <div class="ast-row">
                    <?php
                    $count = 0;
                    $get_certified = $get_certified_section['get_certified'];
                    foreach ($get_certified as $certified) :
                        $certified_heading = $certified['get_certified_heading'];
                        $certified_subheading = $certified['get_certified_sub-heading'];
                        $certified_text = $certified['get_certified_text'];
                        $certified_link = $certified['get_certified_link'];
                        $certified_button_text = $certified['get_certified_button_text'];
                        $certified_link_icon = $certified['get_certified_link_icon'];
                        $certified_image = $certified['get_certified_image'];
                        $count++;
                    ?>
                        <?php if ($count % 2 == 0) : ?>
                            <div class="ast-flex certified-wrapper">
                                <div class="ast-col-md-6">
                                    <div class="image-block" style="background: url('<?php echo $certified_image ?>')"></div>
                                </div>
                                <div class="regulated-text-wrapper ast-col-md-6 ast-flex">
                                    <span class="regulated-heading"><?php echo $certified_heading ?></span>
                                    <h2 class="regulated-subheading"><?php echo $certified_subheading ?></h2>
                                    <span class="regulated-text"><?php echo $certified_text ?></span>
                                    <a href="<?php echo $certified_link ?>">
                                        <img class="certified-icon" src="<?php echo $certified_link_icon ?>"></img>
                                        <span class="certified-link-text"><?php echo $certified_button_text ?></span>
                                    </a>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="ast-flex certified-wrapper">
                                <div class="regulated-text-wrapper ast-col-md-6 ast-flex">
                                    <span class="regulated-heading"><?php echo $certified_heading ?></span>
                                    <h2 class="regulated-subheading"><?php echo $certified_subheading ?></h2>
                                    <span class="regulated-text"><?php echo $certified_text ?></span>
                                    <a href="<?php echo $certified_link ?>">
                                        <img class="certified-icon" src="<?php echo $certified_link_icon ?>"></img>
                                        <span class="certified-link-text"><?php echo $certified_button_text ?></span>
                                    </a>
                                </div>
                                <div class="ast-col-md-6">
                                    <div class="image-block" style="background: url('<?php echo $certified_image ?>')"></div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </section>
    <?php
    endif;
    ?>
    <!--get certified section -->

    <!--home center banner-->
    <?php
    $home_center_banner = get_field('home_center_banner');
    if ($home_center_banner) : ?>
        <section class="home-center-banner">
            <?php
            $home_center_image = $home_center_banner['home_center_banner_image'];
            $home_center_text = $home_center_banner['home_center_banner_text'];
            ?>
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <div class="home-center" style="background:url(<?php echo $home_center_image ?>); background-repeat:no-repeat;">
                            <span class="home-center-text ast-col-md-6"><?php echo $home_center_text ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!--home center banner-->

    <!--tefl video section -->
    <?php
    $tefl_video_section = get_field('tefl_video_section');
    if (false && $tefl_video_section) : ?>
        <section class="tefl-video-section">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <div class="video-block">
                            <?php
                            $tefl_videos = $tefl_video_section['tefl_video'];
                            $tefl_video_button = $tefl_video_section['tefl_video_button'];
                            foreach ($tefl_videos as $tefl_video) :
                                $tefl_video_thumbnail = $tefl_video['tefl_video_thumbnail'];
                                $tefl_video_caption = $tefl_video['tefl_video_caption'];
                                $tefl_video_url = $tefl_video['tefl_video_url'];
                            ?>

                                <div class="video-block-item" style="background-image:url('<?php echo $tefl_video_thumbnail ?>');">
                                    <div class="vide-caption-box">
                                        <p><?php echo $tefl_video_caption ?></p>
                                    </div>
                                    <div class="play-icon">
                                        <a href="<?php echo $tefl_video_url ?>" data-lity class="video-caption-link lity-video">
                                            <img src="<?php echo $tefl_video_button ?>">
                                        </a>
                                    </div>
                                </div>

                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
    endif
    ?>
    <!--tefl video section-->

    <!--tefl reviews section -->
    <?php
    $reviews_section = get_field('reviews_section');
    if ($reviews_section) :
    ?>
        <section class="reviews">
            <?php
            $heading = $reviews_section['heading'];
            $subheading = $reviews_section['subheading'];
            $summary = $reviews_section['summary'];
            $button_text = $reviews_section['button_text'];
            $button_link = $reviews_section['button_link'];
            $section_banner = $reviews_section['section_banner'];
            ?>
            <div class="ast-container">
                <div class="ast-row heading-section">
                    <div class="ast-col-md-12">
                        <h4 class="regulated-heading"><?php echo $heading ?></h4>
                    </div>
                    <div class="ast-col-md-8">
                        <h3 class="regulated-subheading"><?php echo $subheading ?></h3>
                        <p><?php echo $summary ?></p>
                    </div>
                    <div class="ast-col-md-4">
                        <a class="btn btn-black ast-button" href="<?php echo $button_link ?>" target="_blank">
                            <?php echo $button_text ?>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="ast-row review-banner-section">
                    <div class="ast-col-md-12">
                        <div class="review-banner" style="background-image:url('<?php echo $section_banner ?>')"></div>
                        <?php echo do_shortcode('[brb_collection id="1150"]'); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!--tefl reviews section-->

    

    <?php
    $about_section = get_field('about_section');
    if ($about_section) :
    ?>
        <section class="about-section">
            <?php
            $heading = $about_section['heading'];
            $subheading = $about_section['subheading'];
            $details = $about_section['details'];
            $image = $about_section['image'];
            ?>
            <div class="ast-container">
                <div class="ast-row ast-flex about-section-row">
                    <div class="ast-col-md-6">
                        <div class="image-block" style="background:url('<?php echo $image ?>')"></div>
                    </div>
                    <div class="ast-col-md-6 about-section__body">
                        <h3 class="regulated-heading"><?php echo $heading ?></h3>
                        <h4 class="regulated-subheading"><?php echo $subheading ?></h4>
                        <div class="about-section__details"><?php echo $details ?></div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!--About Section-->

    <!--TEFL On The Go Section-->
    <?php
    $app_download_section = get_field('app_download_section');
    if ($app_download_section) :
    ?>
        <section class="app-download-section">
            <?php
            $heading = $app_download_section['heading'];
            $subheading = $app_download_section['subheading'];
            $summary = $app_download_section['summary'];
            $image = $app_download_section['section_image'];
            $play_store_link = $app_download_section['play_store_link'];
            $app_store_link = $app_download_section['app_store_link'];
            ?>
            <div class="ast-container">
                <div class="gray-bg">
                    <div class="ast-row">
                        <div class="ast-col-md-6">
                            <div class="padded-container">
                                <h2 class="section-heading"><?php echo $heading; ?></h2>
                                <h2 class="section-subheading"><?php echo $subheading; ?></h2>
                                <div class="section-body"><?php echo $summary; ?></div>
                                <div class="download-links">
                                    <h2 class="section-heading">Download the app</h2>
                                    <?php if ($app_store_link) : ?>
                                        <a href="<?php echo $app_store_link; ?>"><img src="/wp-content/uploads/2021/08/apple-logo-1.svg"></a>
                                    <?php endif; ?>
                                    <?php if ($play_store_link) : ?>
                                        <a href="<?php echo $play_store_link; ?>"><img src="/wp-content/uploads/2021/08/google-play-logo-1.svg"></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="ast-col-md-6">
                            <img class="mock-mobile" src="<?php echo $image; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>
    <!--TEFL On The Go Section End-->

    <!--FAQs Section-->

    <?php
    $faqs_section = get_field('faqs_section');
    if ($faqs_section) :
    ?>
        <section class="faqs-section">
            <?php
            $heading = $faqs_section['heading'];
            $subheading = $faqs_section['subheading'];
            $summary = $faqs_section['summary'];
            $button_text = $faqs_section['button_text'];
            $button_link = $faqs_section['button_link'];
            $section_banner = $faqs_section['section_banner'];
            ?>
            <div class="ast-container">
                <div class="ast-row faqs-section__header">
                    <div class="ast-col-md-12">
                        <h3 class="regulated-heading"><?php echo $heading ?></h3>
                    </div>
                    <div class="ast-col-md-8">
                        <h4 class="regulated-subheading"><?php echo $subheading ?></h4>
                        <p><?php echo $summary ?></p>
                    </div>
                    <div class="ast-col-md-4">
                        <a class="btn btn-black ast-button" href="<?php echo $button_link ?>" target="_blank">
                            <?php echo $button_text ?>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="ast-row faqs-section__body">
                    <div class="ast-col-md-12">
                        <?php $i = 0; ?>
                        <?php
                        $frequently_asked_questions = get_cfvalue_by_country('frequently_asked_questions');
                        foreach ($frequently_asked_questions as $item) : ?>

                            <?php $question = $item['question']; ?>
                            <?php $answer = $item['answer']; ?>

                            <section class="accordion-container">
                                <input id="accordion-<?php echo $i ?>" name="accordion-1" type="radio" <?php if ($i === 0) { ?>checked<?php } ?>>
                                <label for="accordion-<?php echo $i ?>"><?php echo $question ?></label>
                                <article>
                                    <?php echo $answer ?>
                                </article>
                            </section>
                        <?php $i++;
                        endforeach; ?>
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
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!--FAQs Section End-->

</div>

<?php get_footer(); ?>