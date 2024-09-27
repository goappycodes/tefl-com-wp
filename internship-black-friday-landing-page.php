<?php

/**
 * Template Name: Internship Black Friday Landing Page
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
    
    <!-- Internship sales Section -->

    <?php
        $sales_internships = get_field('sale_internships');
        if(!empty($sales_internships)):
    ?>
        <section class="sales-internship-section py-50">
            <?php
                foreach($sales_internships as $si):
                    $internship = $si['internship'];
                    $internship_title = $si['internship_title'];
                    $internship_link = get_post_permalink($internship);
                    $internship_duration_text = $si['internship_duration_text'];
                    $intership_start_date_text = $si['internship_start_date_text'];
                    $internship_image = $si['internship_image'];
                    $internship_logo = $si['internship_logo'];
                    $internship_features = $si['internship_features'];
                    $buy_now_btn_txt = $si['buy_now_button_text'];
                    $learn_more_btn_text = $si['learn_more_button_text'];
                    $guide = $si['select_guide'];
                    $internship_product_id = get_field('internship_product',$internship);
                    if($internship_product_id):
                        $internship_product = wc_get_product($internship_product_id);
                        
                        if ($internship_product):
                            $internship_price = $internship_product->get_price_html();
                            $simple_regular_price = $internship_product->get_regular_price();
                            $simple_sale_price = $internship_product->get_sale_price();
                            $stock_quantity = get_total_combined_stock_quantity($internship_product);
                            if($internship_product->is_type('variable')):
                                $simple_regular_price = $internship_product->get_variation_regular_price();
                                $simple_sale_price = $internship_product->get_variation_sale_price();
                            endif;
                            $percentage = round((($simple_regular_price - $simple_sale_price) / $simple_regular_price) * 100);
                        endif;
                    endif;
                    if($guide):
                        $guide_link = get_post_permalink($guide);
                    endif;
            ?>
                <div class="ast-container internship-container">
                    <div class="ast-row internship-header-row">
                        <div class="ast-col-md-12">
                            <h2 class="internship__header text-center"><?php echo $internship_title?></h2>
                            <span class="d-block internship__subheader text-center"><?php echo $internship_duration_text.' | '.$intership_start_date_text ?></span>
                        </div>
                    </div>
                    <div class="ast-row internship-details-row">
                        <div class="ast-col-md-6">
                            <div class="internship-details-row__left">
                                <?php if($percentage>0):?>
                                <div class="internship-discount discount">
                                    <span><?php echo $percentage.'%'?></span>
                                    Discount
                                </div>
                                <?php endif;?>
                                <img src="<?php echo $internship_image ?>" alt="" class="internship__image">
                                <div class="internship__price text-center">
                                    <?php echo $internship_price?>
                                </div>
                            </div>   
                        </div>
                        <div class="ast-col-md-6">
                            <div class="internship-details-row__right text-center">
                                <img src="<?php echo $internship_logo?>" alt="" class="internship__logo">
                                <h6 class="internship__title"><?php echo $internship_title?></h6>
                                <ul class="internhsip_features">
                                    <?php 
                                        foreach($internship_features as $feature):
                                            $feature_text = $feature['feature'];
                                    ?>
                                        <li class="internship-feature"><?php echo $feature_text?></li>
                                    <?php
                                        endforeach;
                                    ?>
                                </ul>
                                
                            </div>
                            <?php if($stock_quantity>0):?>
                                <div class="internship_slots text-center">
                                    <?php echo $stock_quantity ?> Spaces available 
                                </div>
                            <?php endif?>
                        </div>
                    </div>
                    <div class="ast-row internships-button-row">
                        <div class="ast-col-md-4">
                            <a href="<?php echo $internship_link?>" class="btn btn-red">
                                <span><?php echo $buy_now_btn_txt?></span><i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                        <div class="ast-col-md-4">
                            <a href="<?php echo $internship_link?>" class="btn btn-white">
                                <span><?php echo $learn_more_btn_text?></span><i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                        <div class="ast-col-md-4">
                            <a target="_blank" href="<?php echo $guide_link?>" class="btn btn-white">
                                <span>get the guide</span><i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
                endforeach;
            ?>
        </section>
    <?php
        endif;
    ?>

    <!-- End Internship sales Section -->

    <!-- Testimonials Section   -->
    
    <?php
        $video_testimoials_section = get_field('video_testimonials_section');
        if(!empty($video_testimoials_section)):
            $section_title = $video_testimoials_section['section_title'];
            $section_stitle = $video_testimoials_section['section_subtitle'];
            $video_testimoials = $video_testimoials_section['testimonial_videos'];
            $play_icon = $video_testimoials_section['play_button_icon'];
    ?>
        <section class="video-testimoials-section py-50">
            <div class="ast-container testimonials-container">
                <div class="ast-row testimoials-section-header-row mb-2">
                    <div class="ast-col-md-12">
                        <h2 class="testimoials-section__header text-center "><?php echo $section_title?></h2>
                        <span class="d-block testimoials-section__subheader text-center"><?php echo $section_stitle ?></span>
                    </div>
                </div>
                <div class="ast-row testimonials-section-content-row">
                    <?php
                        foreach($video_testimoials as $testimonial):
                            $link = $testimonial['video_link'];
                            $thumbnail = $testimonial['video_thumnail'];
                            $title = $testimonial['video_title'];
                            $stitle = $testimonial['video_subtitle'];
                    ?>
                        <div class="ast-col-md-4">
                            <div class="testimonial">
                                <a href="<?php echo $link ?>" class="testimonial-link-wrapper clickbox" data-lity></a>
                                <div class="testimonial__thumbnail-container">
                                    <img src="<?php echo $thumbnail?>" alt="" class="testimonial__thumbnail"/>
                                    <img src="<?php echo $play_icon?>" alt="" class="testimonial-play-btn"/>
                                </div>
                                <div class="testimonial__body">
                                    <h4 class="testimonial__title"><?php echo $title?></h4>
                                    <h6 class="testimonial__subtitle"><?php echo $stitle?></h6>
                                </div>
                            </div>
                        </div>
                    
                    <?php endforeach?>
                </div>
            </div>
        </section>
    <?php
        endif;
    ?>
    <!-- Testimonials Section -->

    <!-- Reviews Section -->

    <section class="reviews-section py-50">
        <div class="ast-container student-reviews-container">
            <div class="ast-row student-reviews-section-header-row mb-2">
                <div class="ast-col-md-12">
                    <h2 class="student-reviews__header text-center ">Verified student reviews</h2>
                </div>
            </div>
            <div class="ast-row">
                <div class="ast-col-md-12 student-reviews-section-content-row">
                    <?php 
                        echo do_shortcode('[brb_collection id="1150"]'); 
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- End Reviews Section -->

    <!-- CTA Section -->
    
    <?php
        $cta_section = get_field('cta_section');
        if(!empty($cta_section)):
    ?>
    <section class="cta-section py-50">
        <div class="ast-container cta-section-containter">
            <?php
                $salary_calculator_cta = $cta_section['salary_calculator_cta'];
                $cta_image = $salary_calculator_cta['cta_image'];
                $cta_title = $salary_calculator_cta['cta_title'];
                $cta_stitle = $salary_calculator_cta['cta_subtitle'];
                $cta_btn_text = $salary_calculator_cta['cta_button_text'];
                $cta_btn_link =$salary_calculator_cta['cta_button_link'];
            ?>
            <div class="ast-row salary-calculator-cta-row">
                <div class="ast-col-md-6 ">
                    <img src="<?php echo $cta_image?>" alt="salary-calculator-cta__image" class="salary-calculator-cta__image"/>
                </div>
                <div class="ast-col-md-6">
                    <div class="salary-calculator-cta__content">
                        <a class="clickbox" href="<?php echo $cta_btn_link?>"></a>
                        <h2 class="salary-calculator-cta__header"><?php echo $cta_title?></h2>
                        <span class="d-block salary-calculator-cta__subheader"><?php echo $cta_stitle?></span>
                        <a href="<?php echo $cta_btn_link?>" class="btn salary-calculator-cta__btn">
                            <span><?php echo $cta_btn_text?></span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php
                $elt_cta = $cta_section['english_level_test_cta'];
                $cta_image = $elt_cta['cta_image'];
                $cta_title = $elt_cta['cta_title'];
                $cta_stitle = $elt_cta['cta_subtitle'];
                $cta_btn_text = $elt_cta['cta_button_text'];
                $cta_btn_link = $elt_cta['cta_button_link'];
            ?>
            <div class="ast-row elt-cta-row">
                <div class="ast-col-md-6">
                    <div class="elt-cta__content">
                        <a class="clickbox" href="<?php echo $cta_btn_link?>"></a>
                        <h2 class="elt-cta__header"><?php echo $cta_title?></h2>
                        <span class="d-block elt-cta__subheader"><?php echo $cta_stitle?></span>
                        <a href="<?php echo $cta_btn_link?>" class="btn elt-cta__btn">
                            <span><?php echo $cta_btn_text?></span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <div class=" ast-col-md-6">
                    <img src="<?php echo $cta_image?>" alt="elt-cta__image" class="elt-cta__image"/>
                </div>
            </div>
        </div>
    </section>
    
    <?php endif?>

    <!-- End CTA Section -->

</div><!-- #primary -->
<script>
    jQuery(document).ready(function ($) {
        $('.internship-details-row__right').each(function () {
            let height = $(this).outerHeight();
            let adjImage = $(this).parent().parent().find('.internship__image');
            adjImage.css('height', `${height}px`);
        })
    });
</script>
<?php get_footer(); ?>