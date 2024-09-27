<?php

/**
 * Template Name: Black Friday Landing Page
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header(); 
$page_accent_color = get_field('page_accent_color');
?>


<div id="primary" <?php astra_primary_class(); ?>>
    

    <?php $page_heading = get_field('page_heading');
    $page_subheading = get_field('page_subheading'); ?>

    <?php if ($page_heading || $page_subheading) : ?>
    <div class="page-header">
        <div class="ast-container">
            <div class="ast-row">
                <?php if ($page_heading) : ?>
                <h1 class="large-heading font-700 page-header__title"><?php echo $page_heading; ?></h1>
                <?php endif; ?>
                <?php if ($page_subheading) : ?>
                <h3 class="small-heading page-header__subtitle"><?php echo $page_subheading; ?></h3>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
    <?php endif; ?>

    <?php $timer_section = get_field('timer_section');
    $timer_section_title = $timer_section['title'];
    $timer_section_content = $timer_section['content']; 
    $has_hero_image = $timer_section['has_hero_image'];
    if($has_hero_image){
        $hero_image = $timer_section['hero_image'];
    }
    $show_bonus_info = $timer_section['show_bonus_info'];
    if($show_bonus_info){
        $bonus_info  = $timer_section['bonus_info'];
        $bonus_info_icon = $bonus_info['icon'];
        $bonus_info_title = $bonus_info['title'];
        $bonus_info_content = $bonus_info['content'];
    }

    ?>

    <div class="section tefl-section timer-section">
        <div class="ast-container">
            <div class="ast-row timer-row ast-flex">
                <div class="ast-col ast-col-md-5 timer-content-col">
                    <div class="timer-content-inner">
                        <h3 class="section-title text-center"><?php echo $timer_section_title; ?></h3>
                        <div class="section-content"><?php echo $timer_section_content; ?></div>
                    </div>
                    <?php if(!empty($bonus_info)):?>
                        <div class="offer-bonus-info">
                            <div class="offer-bonus-info-title text-center">
                                <h2 style="background:<?php echo $page_accent_color?>"><?php echo $bonus_info_title?></h2>
                            </div>
                            <div class="bonus-info-content">
                                <div class="bonus-info-content__left">
                                    <img src="<?php echo $bonus_info_icon?>" alt="">
                                </div>
                                <div class="bonus-info-content__right">
                                    <?php echo $bonus_info_content?>
                                </div>
                            </div>
                        </div>
                    <?php endif?>
                </div>
                <div class="ast-col ast-col-md-5 timer-value-col">
                    <?php if(!empty($hero_image)):?>
                        <div class="offer-hero-image">
                            <img src="<?php echo $hero_image?>" alt="" class="">
                        </div>
                    <?php endif?>
                    <div class="timer-value-inner">
                        <?php echo do_shortcode('[tefl_timer_shortcode timer="sale"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $common_heading = get_field('common_heading');
    $sale_courses = get_field('sale_courses');

    foreach ($sale_courses as $sc) :
        $toggle = $sc['toggle'];
        $course_image = $sc['course_image'];
        $course_logo = $sc['course_logo'];
        $course_title = $sc['course_title'];
        $course = $sc['course'];
        $course_link = get_post_permalink($course);
        $course_product_id = get_field('course_product', $course);
        $course_price = '';
        $add_to_cart_link = '';
        if ($course_product_id) {
            $course_product = wc_get_product($course_product_id);
            if ($course_product) {
                $course_price = $course_product->get_price_html();
            }
            $add_to_cart_link = site_url() . '/cart/?add-to-cart=' . $course_product_id;
        }
        $includes = $sc['includes'];
        $excludes = $sc['excludes'];
        $freebie_courses = $sc['freebie_courses'];
        $other_freebie = $sc['other_freebie']; ?>

    <?php if($toggle === true) { ?>
    <div class="section tefl-section sale-courses-section">
        <div class="ast-container">
            <div class="sale-courses-section__wrapper">
                <div class="ast-row sale-courses-header-row">
                    <div class="ast-col ast-col-md-12 section-header-col">
                        <div class="section-header"><?php echo $common_heading; ?></div>
                        <?php if ($course_product_id == 430) {  ?>
                            <img class="teachers-choice" src="/wp-content/uploads/2020/11/Teachers-choice.png" />
                        <?php } ?>
                    </div>
                </div>
                <div class="ast-row sale-courses-content-row">
                    <div class="ast-col ast-col-md-4 course-detail-col">
                        <div class="course-detail-col-inner">
                            <?php if ($course_image) : ?>
                            <div class="course-img">
                                <img src="<?php echo $course_image; ?>">
                            </div>
                            <?php endif; ?>
                            <?php if ($course_logo) : ?>
                            <div class="course-logo">
                                <img src="<?php echo $course_logo; ?>">
                            </div>
                            <?php endif; ?>
                            <?php if ($course_title) : ?>
                            <h4 class="course-title"><?php echo $course_title; ?></h4>
                            <?php endif; ?>
                            <?php if ($course_price) : ?>
                            <div class="course-price"><?php echo $course_price; ?></div>
                            <?php endif; ?>
                            <?php if ($add_to_cart_link) : ?>
                            <div class="enroll-now-btn">
                                <a class="btn btn-primary dark-btn" rel="nofollow" href="<?php echo $add_to_cart_link; ?>">Enrol Now</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="ast-col ast-col-md-4 course-inc-exc-col">
                        <?php if ($includes || $excludes) : ?>
                        <div class="inc-exc-inner">
                            <p class="inc-exc-title">What’s Included</p>
                            <div class="inc-exc-div">
                                <?php if ($includes) : ?>
                                <?php foreach ($includes as $inc) :
                                                $inc_item = $inc['content']; ?>
                                <div class="item inc-item"><img
                                        src="/wp-content/uploads/2021/11/Group-22.svg"><?php echo $inc_item; ?></div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if ($excludes) : ?>
                                <?php foreach ($excludes as $exc) :
                                                $exc_item = $exc['content']; ?>
                                <div class="item exc-item"><img
                                        src="/wp-content/uploads/2021/11/Group-21-1.png"><?php echo $exc_item; ?></div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="ast-col ast-col-md-4 freebie-col">
                        <?php if ($freebie_courses || $other_freebie || $course_link) : ?>
                        <div class="freebie-col-inner">
                            <p class="freebie-title">Free Resources</p>
                            <?php if ($freebie_courses) : ?>
                            <?php foreach ($freebie_courses as $fc) :
                                            $free_course_icon = $fc['icon'];
                                            $free_course_title = $fc['title'];
                                            $free_course_product_id = $fc['product'];
                                            $free_course_price = '';
                                            if ($free_course_product_id) {
                                                $free_course_product = wc_get_product($free_course_product_id);
                                                if ($free_course_product) {
                                                    $free_course_price = $free_course_product->get_price_html();
                                                }
                                            } ?>
                            <div class="freebie-course">
                                <?php if ($free_course_icon) : ?>
                                <div class="free-course-icon"><img src="<?php echo $free_course_icon; ?>"></div>
                                <?php endif; ?>
                                <?php if ($free_course_title) : ?>
                                <p class="free-course-title"><?php echo $free_course_title; ?></p>
                                <?php endif; ?>
                                <?php if ($free_course_price) : ?>
                                <div class="free-course-price" style="background:<?php echo $page_accent_color?>"><?php echo $free_course_price; ?></div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if ($other_freebie) : ?>
                            <div class="other-freebie-div">
                                <?php foreach ($other_freebie as $of) :
                                                $other_freebie_icon = $of['icon'];
                                                $other_freebie_title = $of['title']; ?>
                                <div class="other-freebie-div-inner">
                                    <?php if ($other_freebie_icon) : ?>
                                    <div class="other-freebie-icon">
                                        <img src="<?php echo $other_freebie_icon; ?>">
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($other_freebie_title) : ?>
                                    <p class="other-freebie-title"><?php echo $other_freebie_title; ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <?php if ($course_link) : ?>
                            <div class="learn-more-btn">
                                <a class="btn btn-primary dark-btn" href="<?php echo $course_link; ?>">Learn More</a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php endforeach; ?>

    <?php
    $cyber_monday = get_field('cyber_monday');
    $show = $cyber_monday['show'];
    $jobs = $cyber_monday['jobs'];
    $deal = $cyber_monday['deal'];
    $code = $cyber_monday['code'];
    ?>
    <?php if ($show) { ?>
    <div class="section tefl-section cyber-monday-section">
        <div class="ast-container">
            <h3 class="cyber-monday-header">Cyber Monday Deal</h3>
            <div class="ast-row">
                <?php foreach ($jobs as $element) {
                        $background = $element['image'];

                        $title = $element['title'];
                        $info = $element['info'];
                        $link = $element['learn_more']; ?>
                <div class="ast-col-md-4 ast-col-sm-12 ast-col-xs-12 job-col">
                    <div class="job">
                        <div class="deal-text">Black Friday Deal</div>
                        <div class="background" style="background-image:url('<?php echo $background; ?>');">

                        </div>
                        <div class="title"><?php echo $title; ?></div>

                        <?php foreach ($info as $e) {
                                    $icon = $e['icon'];
                                    $content = $e['content']; ?>
                        <p class="info">
                            <span class="icon" style="background-image: url('<?php echo $icon; ?>')"></span>
                            <?php echo $content; ?>
                        </p>
                        <?php } ?>

                        <a href="<?php echo $link; ?>">Learn More <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="bottom-container">
                <?php echo $deal; ?>
                <div class="code">Code: <span><?php echo $code; ?></span>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php $add_ons_title = get_field('add_ons_title'); ?>
    <?php $add_ons = get_field('add_ons'); ?>

    <?php if ($add_ons) : ?>
    <div class="section tefl-section addons-section">
        <div class="ast-container">
            <div class="ast-row addons-header-row">
                <div class="ast-col ast-col-md-12 addons-header-col">
                    <h3 class=" addons-header"><?php echo $add_ons_title; ?></h3>
                </div>
            </div>
            <div class="ast-row addons-row">
                <?php foreach ($add_ons as $aon) :
                        $course_image = $aon['image'];
                        $course_logo = $aon['icon'];
                        $course_title = $aon['title'];
                        $course = $aon['course'];
                        $course_link = get_post_permalink($course);
                        $course_product_id = get_field('course_product', $course);
                        $course_price = '';
                        $add_to_cart_link = '';
                        if ($course_product_id) {
                            $course_product = wc_get_product($course_product_id);
                            if ($course_product) {
                                $course_price = $course_product->get_price_html();
                            }
                            $add_to_cart_link = site_url() . '/cart/?add-to-cart=' . $course_product_id;
                        }
                        $includes = $aon['includes']; ?>
                <div class="ast-col ast-col-md-4 addons-col">
                    <div class="section-header"><?php echo $common_heading; ?></div>
                    <div class="addons-col-inner">
                        <?php if ($course_image) : ?>
                        <div class="course-img">
                            <img src="<?php echo $course_image; ?>">
                        </div>
                        <?php endif; ?>
                        <?php if ($course_logo) : ?>
                        <div class="course-logo">
                            <img src="<?php echo $course_logo; ?>">
                        </div>
                        <?php endif; ?>
                        <?php if ($course_title) : ?>
                        <h4 class="course-title"><?php echo $course_title; ?></h4>
                        <?php endif; ?>
                        <?php if ($includes) : ?>
                        <div class="inc-div">
                            <?php foreach ($includes as $inc) :
                                            $inc_item = $inc['content']; ?>
                            <div class="item inc-item"><img
                                    src="/wp-content/uploads/2021/11/Group-22.svg"><?php echo $inc_item; ?></div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($course_price) : ?>
                        <div class="course-price"><?php echo $course_price; ?></div>
                        <?php endif; ?>
                        <?php if ($course_link || $add_to_cart_link) : ?>
                        <div class="addons-btn-div">
                            <?php if ($course_link) : ?>
                            <div class="learn-more-btn">
                                <a class="btn btn-primary light-btn" href="<?php echo $course_link; ?>">Learn More</a>
                            </div>
                            <?php endif; ?>
                            <?php if ($add_to_cart_link) : ?>
                            <div class="enroll-now-btn">
                                <a class="btn btn-primary dark-btn" rel="nofollow" href="<?php echo $add_to_cart_link; ?>">Enrol Now</a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php $teaching_resources = get_field('teaching_resources'); ?>
    <?php if ($teaching_resources) : ?>
    <div class="section tefl-section teaching-resources-section" style="display: none;">
        <div class="ast-row teaching-resources-header-row">
            <div class="ast-col ast-col-md-12 teaching-resources-header-col">
                <h3 class="teaching-resources-header">TEFL EXCLUSIVE TEACHING RESOURCES</h3>
            </div>
        </div>
        <div class="ast-row teaching-resources-row">
            <?php foreach ($teaching_resources as $tr) :
                    $resource_product_id = $tr['product'];
                    $resource_link = $tr['guide_pdf_link'];
                    $resource_title = $tr['title'];
                    $resource_price = '';
                    $resource_img = $tr['image'];;
                    if ($resource_product_id) {
                        $resource_product = wc_get_product($resource_product_id);
                        if ($resource_product) {
                            $resource_price = $resource_product->get_price_html();
                        }
                        //$resource_img = get_the_post_thumbnail_url($resource_product_id);
                    } ?>
            <div class="ast-col ast-col-md-4 teaching-resources-col">
                <div class="section-header"><?php echo $common_heading; ?></div>
                <div class="teaching-resources-col-inner">
                    <?php if ($resource_img) : ?>
                    <div class="resource-img">
                        <img src="<?php echo $resource_img; ?>">
                    </div>
                    <?php endif; ?>
                    <?php if ($resource_price) : ?>
                    <div class="resource-price"><?php echo $resource_price; ?></div>
                    <?php endif; ?>
                    <?php if ($resource_title) : ?>
                    <h4 class="resource-title"><?php echo $resource_title; ?></h4>
                    <?php endif; ?>
                    <?php if ($resource_link) : ?>
                    <div class="download-btn">
                        <a class="btn btn-primary dark-btn" href="<?php echo $resource_link; ?>">Purchase Guide</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php $guide_bundle = get_field('guide_bundle');
    $view_more_guides_link = get_field('view_more_guides_link'); ?>
    <?php if ($guide_bundle) : ?>
    <div class="section tefl-section guide-bundle-section">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <div class="section-header"><?php echo $common_heading; ?></div>
                </div>
            </div>
            <div class="ast-row guide-bundle-row">
                <?php 
                $guide_img = $guide_bundle['image'];
                $guide_link = $guide_bundle['guide_pdf_link'];
                $guide_title = $guide_bundle['title'];
                $guide_subtitle = $guide_bundle['subtitle'];
                $guide_product_id = $guide_bundle['product'];
                $guide_price = '';
                if ($guide_product_id) :
                    $guide_product = wc_get_product($guide_product_id);
                    if ($guide_product) :
                        $guide_price = $guide_product->get_price_html();
                    endif;
                endif; ?>
                
                <div class="ast-col ast-col-md-4 guide-bundle-content-col">
                    <div class="guide-bundle-content-col-inner">
                        <?php if ($guide_title) : ?>
                        <h4 class="guide-title"><?php echo $guide_title; ?></h4>
                        <?php endif; ?>
                        <?php if ($guide_subtitle) : ?>
                        <p class="guide-subtitle"><?php echo $guide_subtitle; ?></p>
                        <?php endif; ?>
                        <?php if ($guide_price) : ?>
                        <div class="guide-price"><?php echo $guide_price; ?></div>
                        <?php endif; ?>
                        <?php if ($guide_link) : ?>
                        <div class="download-btn">
                            <a class="btn btn-primary dark-btn" href="<?php echo $guide_link; ?>">Purchase
                                Bundle</a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="ast-col ast-col-md-8 guide-bundle-img-col">
                    <?php if ($guide_img) : ?>
                    <div class="guide-bundle-img-col-inner">
                        <img src="<?php echo $guide_img; ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php if ($view_more_guides_link) : ?>
    <div class="section tefl-section view-more-guides-section">
        <div class="ast-container">
            <div class="ast-row view-more-guides-row">
                <div class="ast-col ast-col-md-12 view-more-guides-col">
                    <div class="view-more-guides-div">
                        <a class="" href="<?php echo $view_more_guides_link; ?>">View More Guides</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <?php //echo do_shortcode('[tefl_on_demand_webinar_shortcode]'); 
    ?>

    <!--TEFL Video Section Start-->

    <?php $tefl_video_section = get_field('tefl_video_section');
    if ($tefl_video_section) :
        $video1             =  $tefl_video_section['tefl_video1'];
        $video2             =  $tefl_video_section['tefl_video2'];

        $video_play_btn     = $tefl_video_section['tefl_video_play_button'];

        $video1_img         =  $video1['tefl_video1_thumbnail'];
        $video1_txt         =  $video1['tefl_video1_caption'];
        $tefl_video1_url    =  $video1['tefl_video1_url'];

        $video2_img         =  $video2['tefl_video2_thumbnail'];
        $video2_txt         =  $video2['tefl_video2_caption'];
        $tefl_video2_url    =  $video2['tefl_video2_url']; ?>

    <section class="section tefl-section tefl-video-section">
        <div class="ast-container">
            <div class="ast-row tefl-video-row">
                <div class="ast-col-lg-6 ast-col-md-6 ast-col-sm-12 ast-col-xs-12 tefl-video-col tefl-video-col-1"
                    style="background-image:url('<?php echo $video1_img ?>')">
                    <a href="<?php echo $tefl_video1_url ?>" data-lity class="video-caption-link lity-video">
                        <div class="video-caption-box">
                            <span class="video-caption-text"><?php echo $video1_txt ?></span>
                            <span class="video-icon <?php //if($show_banner) { echo $color; } 
                                                        ?>"><img
                                    src="/wp-content/uploads/2021/10/Play-button.svg"></span>
                        </div>
                    </a>
                </div>
                <div class="ast-col-lg-6 ast-col-md-6 ast-col-sm-12 ast-col-xs-12 tefl-video-col tefl-video-col-2"
                    style="background-image:url('<?php echo $video2_img ?>')">
                    <a href="<?php echo $tefl_video2_url ?>" data-lity class="video-caption-link lity-video">
                        <div class="video-caption-box">
                            <span class="video-caption-text"><?php echo $video2_txt ?></span>
                            <span class="video-icon <?php //if($show_banner) { echo $color; } 
                                                        ?>"><img
                                    src="/wp-content/uploads/2021/10/Play-button.svg"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!--TEFL Video Section End-->

    <?php $why_choose_us = get_field('why_choose_us'); ?>

    <?php if ($why_choose_us) : ?>
    <section class="section tefl-section why-choose-us-section">
        <div class="ast-container">
            <div class="ast-row why-choose-us-heading-row">
                <div class="ast-col ast-col-md-12 why-choose-us-heading-col">
                    <h3 class="section-heading">WHY CHOOSE US</h3>
                </div>
            </div>
            <div class="ast-row ast-flex why-choose-us-row">
                <?php foreach ($why_choose_us as $wcu) :
                        $image = $wcu['image'];
                        $title = $wcu['title'];
                        $description = $wcu['description']; ?>
                <div class="ast-col-lg-2 ast-col-md-4 ast-col-xs-6 why-choose-us-col">
                    <div class="why-choose-us-content">
                        <?php if ($image) : ?>
                        <div class="why-choose-us-img-div"><img src="<?php echo $image ?>"></div>
                        <?php endif; ?>
                        <?php if ($title || $description) : ?>
                        <div class="why-choose-us-text">
                            <?php if ($title) : ?>
                            <h4><?php echo $title; ?></h4>
                            <?php endif; ?>
                            <?php if ($description) : ?>
                            <p><?php echo $description; ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>


</div><!-- #primary -->

<?php get_footer(); ?>