<?php

/**
 * Template Name: Courses Black Friday Landing Page
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header(); ?>

<div id="primary" <?php astra_primary_class(); ?>>
    <!-- Hero Banner -->
    <?php
        $hero_banner = get_field('hero_banner');
        if(!empty($hero_banner)):
            $banner_bg          = $hero_banner['banner_background_image'];
            $banner_content     = $hero_banner['banner_content'];
            $banner_image       = $banner_content['image'];
            $banner_header      = $banner_content['header'];
            $header_highlighted = $banner_header['highlighted_text'];
            $header_main        = $banner_header['main_text'];
            $subheader          = $banner_content['sub_header'];
    ?>
    <section class="py-50 hero-section" style="background:url('<?php echo $banner_bg?>')">
        <div class="ast-container">
            <div class="ast-row ast-flex ast-align-items-center hero-banner">
                <div class="hero-banner__left ast-col-md-6">
                    <img class="hero-banner__image" src="<?php echo $banner_image?>" alt="">
                </div>
                <div class="hero-banner__right ast-col-md-6">
                    <h1 class="hero-banner__header text-center mb-1">
                        <span class="hero-banner__header--higlighted"><?php echo $header_highlighted?></span>
                        <?php echo $header_main?>
                    </h1>
                    <div class="hero-banner__subheader text-center">
                        <?php echo $subheader?>
                    </div>
                </div>
            </div>
        </div> 
    </section>
    <?php
        endif;
    ?>
    <!-- Hero Banner Ends -->

    <!-- Countdown Timer Section -->
    <?php
        $timer_section = get_field('clockdown_section');
        if(!empty($timer_section)):
            $section_title   = $timer_section['section_title'];
            $section_content = $timer_section['section_content'];
    ?>
    <section class="py-50 timer-section">
        <div class="ast-container">
            <div class="ast-row clockdown-timer">
                <div class="ast-col-md-6 clockdown-timer__content">
                    <h3 class="clockdown-timer__content--title mb-1">
                        <?php echo $section_title?>
                    </h3>
                    <div class="clockdown-time__content--details">
                        <?php echo $section_content?>
                    </div>
                </div>
                <div class="ast-col-md-6 clockdown-timer__clockdown">
                    <div class="countdown-container text-center">
                        <?php echo do_shortcode('[tefl_timer_shortcode timer="black-friday-sales"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        endif;
    ?>
    <!-- Countdown Timer Section Ends -->

    <!-- Gifts Section -->

    <?php 
        $gifts_section = get_field('free_gifts_section');
        if(!empty($gifts_section)):
            $section_title  = $gifts_section['section_title'];
            $free_gift      = $gifts_section['free_gift'];
    ?>
    <section class="free-gifts-section">
        <div class="ast-container ">
            <div class="ast-row free-gifts-row">
                <img src="/wp-content/uploads/2022/11/gold_ribbon.png" alt="" class="ribbon">
                <h3 class="mb-1 text-center free-gifts-row__title">
                    <span>A perfect start to teach English online</span>
                    <?php echo $section_title?></h3>
                <?php 
                    foreach($free_gift as $fg):
                        $icon     = $fg['icon'];
                        $title    = $fg['title'];
                        $subtitle = $fg['subtitle'];
                ?>
                    <div class="ast-col-md-2 free-gift-col">
                        <img class="mb-1 free-gift-col__icon" src="<?php echo $icon ?>" alt="">
                        <div class="free-gift-col__title text-center"><?php echo $title?>:</div>
                        <div class="free-gift-col__subtitle text-center"><?php echo $subtitle?></div>
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
    <!-- Gifts Section Ends -->

    <!-- Courses Sales Section-->

    <?php
        $sales_courses = get_field('sale_courses');
        if(!empty($sales_courses)):
    ?>

    <section class="sales-courses-section py-50">
        <?php 
            $count = 1;
            foreach($sales_courses as $sc):
                $course_image = $sc['course_image'];
                $course_logo = $sc['course_logo'];
                $course_title = $sc['course_title'];
                $course = $sc['course'];
                $course_link = get_post_permalink($course);
                $course_product_id = get_field('course_product', $course);
                $course_price = '';
                $add_to_cart_link = '';
                $percentage='';
                $enrol_btn_txt = $sc['enroll_button_text'];
                if ($course_product_id) {
                    $course_product = wc_get_product($course_product_id);
                    if ($course_product) {
                        $course_price = $course_product->get_price_html();
                        $simple_regular_price = $course_product->get_regular_price();
                        $simple_sale_price = $course_product->get_sale_price();
                        $percentage = round((($simple_regular_price - $simple_sale_price) / $simple_regular_price) * 100);
                    }
                    // Deposit Info
                    $full_price = $course_product->get_price();
                    $deposit_enabled = get_post_meta($course_product_id, '_wc_deposit_enabled', true);
                    $deposit_payment_plan = '';
                    $add_to_cart_link = site_url() . '/cart/?addtimetocart&prid='.$course_product_id;

                    if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional') {
                        $deposit_payment_plan = get_post_meta($course_product_id, '_wc_deposit_payment_plans', true);
                        $deposit_payment_plan = $deposit_payment_plan[0];
                    	
                    }
                    include(get_stylesheet_directory()."/template-parts/deposit-info.php"); 
                }
                $courses_features = $sc['course_features'];
                $includes = $courses_features['includes'];
                $excludes = $courses_features['excludes'];
                $extra_features = $sc['extra_course_features'];
                $extra_features_main_text = $extra_features['extra_feature_main'];
                $extra_features_main_icon = $extra_features['extra_features_main_icon'];
                $extra_features_other = $extra_features['other_features'];
                $read_more_btn_txt = $sc['read_more_button_text'];
                if($deposit_payment_plan){
                    $add_to_cart_link = site_url() . '/cart/?addtimetocart&prid='.$course_product_id.'&deposit';
                    $enrol_btn_txt = 'Pay in '.$total_deposits;
                }
        ?>
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <div class="sales-courses-section__header red-header-block">Black Friday TEFL Offers</div>
                    </div>
                </div>
                <div <?php echo $deposit_payment_plan?> class="ast-row ast-flex sale-courses-content-row">
                    <div style="background:linear-gradient(90deg, rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url('<?php echo $course_image?>')" class="ast-col-md-4 course-detail-col" >
                        <div class="discount">
                            <span><?php echo $percentage.'%'?></span>
                            Discount
                        </div>
                        <div class="text-center course-detail-col-inner">
                            <?php if ($course_logo) : ?>
                                <div class="course-logo">
                                    <img src="<?php echo $course_logo; ?>">
                                </div>
                            <?php endif; ?>
                            <?php if ($course_title) : ?>
                                <h4 class="course-title"><?php echo $course_title; ?></h4>
                            <?php endif; ?>
                            <?php if ($course_price) : ?>
                                <div data-deposits=<?php echo $total_deposits?> <?php if($first_payment){echo 'data-first-deposit='.$first_payment;}?> data-depostit-percent=<?php echo $deposit_percent?> class="course-price"><?php echo $course_price; ?></div>
                            <?php endif; ?>
                            <?php if ($add_to_cart_link) : ?>
                                <div class="enrol-now enroll-now-btn">
                                    <?php if ($is_virtual_couse) : ?>
                                        <a class="enrol-cta-btn btn btn-red" href="<?php echo $course_link?>"><?php echo $enrol_btn_txt?></a>
                                        <?php else: ?>
                                        <a class="enrol-cta-btn btn btn-red" rel="nofollow" href="<?php echo $add_to_cart_link; ?>"><?php echo $enrol_btn_txt?></a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php if($deposit_payment_plan):?>
                                <div class="d-none radio-group ast-row">
                                    <div class="radio-installments ast-col-md-6">
                                        <input class="pay-option wc-option-pay-deposit" checked type="radio" name="payment-type-<?php echo $count?>" id="payInstallments<?php echo $count?>">
                                        <label for="payInstallments<?php echo $count?>">
                                        Pay in installments
                                        </label>
                                    </div>
                                    <div class="radio-full ast-col-md-6">
                                        <input class="pay-option wc-option-pay-full" type="radio" name="payment-type-<?php echo $count?>" id="payFull<?php echo $count?>">
                                        <label for="payFull<?php echo $count?>">
                                        Pay in full
                                        </label> 
                                    </div>    
                                </div>
                            <?php 
                                $count+=1;
                                endif?>   
                        </div>
                    </div>
                    <div class="ast-col-md-4 course-inc-exc-col">
                        <?php if (!empty($includes) || !empty($excludes)) : ?>
                            <div class="inc-exc-inner">
                                <p class="inc-exc-title">What’s Included</p>
                                <div class="inc-exc-div">
                                    <?php if ($includes) : ?>
                                        <?php foreach ($includes as $inc) :
                                            $inc_item = $inc['content']; ?>
                                            <div class="item inc-item"><img src="/wp-content/uploads/2021/11/Group-22.svg"><?php echo $inc_item; ?></div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php if ($excludes) : ?>
                                        <?php foreach ($excludes as $exc) :
                                            $exc_item = $exc['content']; ?>
                                            <div class="item exc-item"><img src="/wp-content/uploads/2021/11/Group-21-1.png"><?php echo $exc_item; ?></div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="ast-col-md-4 extra-features-col">
                        <?php if (!empty($extra_features)) : ?>
                            <div class="extra-features-col-inner">
                                <p class="extra-features-title">Ideal For</p>
                                <div class="extra-features-main">
                                    <div class="extra-features-main__text text-center">
                                        <?php echo $extra_features_main_text?>
                                    </div>
                                    <div class="extra-features-main__icon">
                                        <img src="<?php echo $extra_features_main_icon?>"/>
                                    </div>
                                </div>
                                <?php if (!empty($extra_features_other)) : ?>
                                    <div class="other-features-div ast-flex">
                                        <?php foreach ($extra_features_other as $of) :
                                            $other_feature_icon = $of['icon'];
                                            $other_feature_title = $of['title']; ?>
                                            <div class="other-features-div__inner">
                                                <?php if ($other_feature_icon) : ?>
                                                    <div class="other-features__icon">
                                                        <img src="<?php echo $other_feature_icon; ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($other_feature_title) : ?>
                                                    <p class="other-features__title text-center"><?php echo $other_feature_title ?></p>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ( !empty($add_to_cart_link)) : ?>
                                    <div class="learn-more-btn">
                                        <a class="btn btn-black" href="<?php echo $course_link; ?>"><?php echo $read_more_btn_txt?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php 
            endforeach;
        ?>
    </section>

    <?php endif?>

    <!-- End Courses Sales Section -->

    <!-- Add Ons Section -->

    <?php 
        $add_ons_section  = get_field('add_on_section');
        if (!empty($add_ons_section)) : 
            $section_title = $add_ons_section['section_title'];
            $add_ons = $add_ons_section['add_ons'];
    ?>
        <section class="addons-section py-50">
            <div class="ast-container">
                <div class="ast-row addons-header-row">
                    <div class="ast-col ast-col-md-12 addons-header-col">
                        <h3 class="text-center addons-header"><?php echo $section_title; ?></h3>
                    </div>
                </div>
            </div>
            <div class="ast-container">
                <div class="ast-row addons-row">
                    <?php foreach($add_ons as $add_on):
                        $ribbon_text = $add_on['offer_ribbon_text'];
                        $course_image = $add_on['image'];
                        $course_logo = $add_on['icon'];
                        $course_title = $add_on['title'];
                        $course = $add_on['course'];
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
                        $features = $add_on['features'];
                    ?>
                        <div class="ast-col ast-col-md-4 addons-col">
                            <div class="addons-col__header text-center"><?php echo $ribbon_text; ?></div>
                            <div class="addons-col__content">
                                <?php if ($course_image) : ?>
                                <div class="course-img">
                                    <img class="course-img__main" src="<?php echo $course_image; ?>">
                                    <?php if ($course_logo) : ?>
                                        <img class="course-img__logo" src="<?php echo $course_logo; ?>">
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                
                                <?php if ($course_title) : ?>
                                <h4 class="course-title text-center"><?php echo $course_title; ?></h4>
                                <?php endif; ?>
                                <?php if ($features) : ?>
                                <div class="inc-div">
                                    <?php foreach ($features as $feature) :
                                                    $feature_item = $feature['feature']; ?>
                                    <div class="item inc-item"><img
                                            src="/wp-content/uploads/2021/11/Group-22.svg"><?php echo $feature_item; ?></div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                                <?php if ($course_price) : ?>
                                <div class="course-price text-center"><?php echo $course_price; ?></div>
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
                    <?php endforeach;?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- End Add Ons Section -->

    <!-- Gudie Bundles Section -->

    <?php
        $guide_bundle_section = get_field('guide_bundle_section');
        if(!empty($guide_bundle_section)):
            $section_title = $guide_bundle_section['section_title'];
            $guide_title = $guide_bundle_section['guide_title'];
            $guide_img  = $guide_bundle_section['product_image'];
            $guide_subtitle = $guide_bundle_section['offer_description'];
            $guide_product_id = $guide_bundle_section['product'];
            $view_more_link = $guide_bundle_section['show_more_guides_link'];
            $guide_price = '';
            if ($guide_product_id) :
                $guide_product = wc_get_product($guide_product_id);
                $guide_link = site_url() . '/cart/?add-to-cart=' . $guide_product_id;
                if ($guide_product) :
                    $guide_price = $guide_product->get_price_html();
                endif;
            endif; 
        ?>
        <section class="guide_bundle_section py-50">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <div class="guide-bundle-section__header red-header-block"><?php echo $section_title?></div>
                    </div>
                </div>
                <div class="ast-row guide-bundle-section__content">
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
                            <div class="download-btn text-center">
                                <a class="btn btn-red" href="<?php echo $guide_link; ?>">Purchase
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
            <?php if ($view_more_link) : ?>
                <div class="ast-row view-more-guides-row py-50">
                    <div class="view-more-guides-div text-center">
                        <a class="" href="<?php echo $view_more_link; ?>">View More Guides</a>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    <?php
        endif;
    ?>

    <!-- End Guide Section -->
    

</div><!-- #primary -->

<?php get_footer(); ?>