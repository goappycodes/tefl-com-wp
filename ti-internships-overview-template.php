<?php

/**
 * Template Name: Internships Overview Template 2023
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram Rana <bikram@appycodes.com>
 * @date August 2023
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();
?>
<div id="primary" <?php astra_primary_class(); ?>>
    <?php
        $hero_banner = get_field('hero_banner');
        if(!empty($hero_banner)):
            $hero_banner_bg = $hero_banner['banner_background'];
            $hero_banner_cta = $hero_banner['banner_cta'];
            $cta_title = $hero_banner_cta['cta_title'];
            $cta_summary = $hero_banner_cta['cta_summary'];
            $cta_btn_text = $hero_banner_cta['cta_button_text'];
            $cta_btn_link = $hero_banner_cta['cta_button_link'];
    ?>
    <!-- Hero Banner Section -->
        <section class="hero-banner-section section-padding" style="background:url(<?php echo $hero_banner_bg?>)">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-6">
                        <?php
                            if(is_array($hero_banner_cta) && !empty(array_filter($hero_banner_cta))):
                        ?>
                            <div class="hero-banner-section__content">
                                <h1 class="large-heading common-section-heading">
                                    <?php echo $cta_title?>
                                </h1>
                                <div class="hero-banner-section__content-summary">
                                    <?php echo $cta_summary?>
                                </div>
                                <a href="<?php echo $cta_btn_link?>" class="btn btn-primary btn-centered">
                                    <?php echo $cta_btn_text?>
                                </a>
                            </div>
                        <?php
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <!-- Hero Banner Section End -->
    <?php
        endif;
    ?>

    <?php
        $quote_box = get_field('quote_box');
        if(!empty($quote_box)):
            $quote_text = $quote_box['quote_text'];
            $quote_author = $quote_box['quote_author'];
    ?>

    <!-- Quote Box -->

    <section class="section-padding-top quote-box-section">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <div class="quote-box">
                        <h2 class="quote-box__text large-heading text-center">
                            <?php echo $quote_text?>
                        </h2>
                        <h2 class="font-600 quote-box__author text-center">
                            <?php echo $quote_author?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quote Box End -->

    <?php
        endif;
    ?>

    <?php
        $about_section = get_field('about_section');
        if(!empty($about_section)):
            $section_image = $about_section['section_image'];
            $section_content = $about_section['section_content'];
            $content_header = $section_content['content_header'];
            $content_subheader = $section_content['content_subheader'];
            $content_text_top = $section_content['content_text_top'];
            $content_text_bottom = $section_content['content_text_bottom'];
            $features = $section_content['features'];
    ?>

    <!-- About Section -->

    <section class="about-section section-padding-top">
        <div class="ast-container">
            <div class="ast-row">
                <div class="about-section-row">
                    <div class="ast-col-md-6">
                        <div class="about-section-row__image">
                            <img src="<?php echo $section_image?>" alt="" />
                        </div>
                    </div>
                    <div class="ast-col-md-6">
                        <div class="about-section-row__content">
                            <h2 class="large-heading about-section__subheader"><?php echo $content_subheader?></h2>
                            <h2 class="large-heading font-700 about-section__header"><?php echo $content_header?></h2>
                            <div class="about-section-row__content-top">
                                <?php echo $content_text_top?>
                            </div>
                            
                            <div class="about-section-row__content-features">
                                A paid TEFL internship with us includes:
                                <div class="feature-wrapper">
                                    <?php
                                        
                                        foreach($features as $feature):
                                            $feature_icon = $feature['feature_icon'];
                                            $feature_text = $feature['feature_text'];
                                    ?>
                                        <div class="feature">
                                            <img src="<?php echo $feature_icon?>" alt="" class="feature__icon"/>
                                            <span class="feature__text"><?php echo $feature_text?></span>
                                        </div>
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                            </div>
                            <div class="about-section-row__content-bottom">
                                <?php echo $content_text_bottom?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section End -->

    <?php
        endif;
    ?>

    <?php
        $short_term_internships_section = get_field('short_term_internships_section');
        if(!empty($short_term_internships_section)):
            $section_heading = $short_term_internships_section['section_title'];
            $internships = $short_term_internships_section['internships'];
    ?>
    <!-- Short Term Internships Section -->

    <section id="#internships" class="short-term-internships section-padding-top">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12 short-term-internships__header">
                    <h2 class="large-heading common-section-heading font-400 text-center">
                        <?php echo $section_heading?>
                    </h2>
                </div>
                <div class="short-term-internships__body">
                    <?php
                        foreach($internships as $index => $internship):
                            $internship_ID = $internship['internship'];
                            $internship_link = get_post_permalink($internship_ID);
                            $is_featured_internship = $internship['is_featured_internship'];
                            if($is_featured_internship){
                                $featured_internship_icon = $internship['featured_internship_icon'];
                                $featured_internship_text = $internship['featured_internship_text'];
                            }
                            $internship_country = $internship['internship_country'];
                            $internship_image = $internship['internship_image'];
                            $internship_features = $internship['internship_features'];
                            $product_ID = get_post_meta($internship_ID, 'internship_product');
                            $internship_product = wc_get_product($product_ID[0]);
                            $internship_price_html = $internship_product->get_price_html();
                            $internship_guide_image = $internship['internship_guide_image'];
                            $internship_guide_link = $internship['internship_guide_link'];
                    ?>
                        <div class="ast-col-md-4">
                            <div class="internship-card <?php echo $index > 2 ? 'has-margin-top' : '' ?>">
                                <div class="internship-card__top">
                                    <div class="internship-card__top-header">
                                        <img src="<?php echo $internship_image?>" alt="">
                                        <?php if($is_featured_internship):?>
                                            <div class="internship-feautured-label">
                                                <img src="<?php echo $featured_internship_icon?>" alt=""/>
                                                <span><?php echo $featured_internship_text?></span>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <div class="internship-card__top-content">
                                        <div class="internship-price">
                                            <?php echo $internship_price_html?>
                                        </div>
                                        <h3 class="internship-country font-700">
                                            <?php echo $internship_country?>
                                        </h3>
                                        <div class="internship-features">
                                            <?php
                                                foreach($internship_features as $key => $feature):
                                                    if(!empty($feature)):
                                                        $key = str_replace('_',' ',$key);
                                            ?>
                                            <div class="internship-feature">
                                                <span class="font-700"><?php echo $key?></span>
                                                <span class="font-400"><?php echo $feature?></span>
                                            </div>
                                            <?php
                                                    endif;
                                                endforeach
                                            ?>
                                        </div>
                                        <a href="<?php echo $internship_link?>" class="btn btn-centered btn-small internship-link">
                                            learn more
                                        </a>
                                    </div>
                                    
                                </div>
                                <div class="internship-card__bottom">
                                    <div class="internship-guide-image text-center">
                                        <h6 class="font-500 text-center">Learn more about the <?php echo $internship_country?> Internship</h6>
                                        <img src="<?php echo $internship_guide_image?>" alt="" />
                                    </div>
                                    <a target="_blank" href="<?php echo $internship_guide_link?>" class="btn-centered btn btn-small internship-guide-link">
                                        download guide
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                        endforeach
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Short Term Internships Section End-->

    <?php
        endif;
    ?>

    <?php
        $long_term_internships_section = get_field('long_term_internships_section');
        if(!empty($long_term_internships_section)):
            $section_heading = $long_term_internships_section['section_title'];
            $internships = $long_term_internships_section['internships'];
    ?>
    <!-- Longterm Internship Section  -->

    <section class="long-term-internships section-padding-top">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12 long-term-internships__header">
                    <h2 class="large-heading common-section-heading font-400 text-center">
                        <?php echo $section_heading?>
                    </h2>
                </div>
                <div class="long-term-internships__body">
                    <?php
                        foreach($internships as $index => $internship):
                            $internship_ID = $internship['internship'];
                            $internship_link = get_post_permalink($internship_ID);
                            $is_featured_internship = $internship['is_featured_internship'];
                            if($is_featured_internship){
                                $featured_internship_icon = $internship['featured_internship_icon'];
                                $featured_internship_text = $internship['featured_internship_text'];
                            }
                            $internship_country = $internship['internship_country'];
                            $internship_image = $internship['internship_image'];
                            $internship_features = $internship['internship_features'];
                            $product_ID = get_post_meta($internship_ID, 'internship_product');
                            $internship_product = wc_get_product($product_ID[0]);
                            $internship_price_html = $internship_product->get_price_html();
                            $internship_guide_image = $internship['internship_guide_image'];
                            $internship_guide_link = $internship['internship_guide_link'];
                    ?>
                        <div class="ast-col-md-4">
                            <div class="internship-card  <?php echo $index > 2 ? 'has-margin-top' : '' ?>">
                                <div class="internship-card__top">
                                    <div class="internship-card__top-header">
                                        <img src="<?php echo $internship_image?>" alt="">
                                        <?php if($is_featured_internship):?>
                                            <div class="internship-feautured-label">
                                                <img src="<?php echo $featured_internship_icon?>" alt=""/>
                                                <span><?php echo $featured_internship_text?></span>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <div class="internship-card__top-content">
                                        <div class="internship-price">
                                            <?php echo $internship_price_html?>
                                        </div>
                                        <h3 class="internship-country font-700">
                                            <?php echo $internship_country?>
                                        </h3>
                                        <div class="internship-features">
                                            <?php
                                                foreach($internship_features as $key => $feature):
                                                    if(!empty($feature)):
                                                        $key = str_replace('_',' ',$key);
                                            ?>
                                            <div class="internship-feature">
                                                <span class="font-700"><?php echo $key?></span>
                                                <span class="font-400"><?php echo $feature?></span>
                                            </div>
                                            <?php
                                                    endif;
                                                endforeach
                                            ?>
                                        </div>
                                        <a href="<?php echo $internship_link?>" class="btn btn-centered btn-small internship-link">
                                            learn more
                                        </a>
                                    </div>
                                    
                                </div>
                                <div class="internship-card__bottom">
                                    <div class="internship-guide-image text-center">
                                        <h6 class="font-500 text-center">Learn more about the <?php echo $internship_country?> Internship</h6>
                                        <img src="<?php echo $internship_guide_image?>" alt="" />
                                    </div>
                                    <a target="_blank" href="<?php echo $internship_guide_link?>" class="btn-centered btn btn-small internship-guide-link">
                                        download guide
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                        endforeach
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Long Term Internships Section End-->

    <?php
        endif;
    ?>


    <?php
        $volunteer_programmes_section = get_field('volunteer_programmes_section');
        if(!empty($volunteer_programmes_section)):
            $section_heading = $volunteer_programmes_section['section_title'];
            $internships = $volunteer_programmes_section['internships'];
    ?>
    <!-- Volunteer Programmes Section  -->

    <section class="volunteer-programmes-section section-padding-top">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12 volunteer-programmes-section__header">
                    <h2 class="large-heading common-section-heading font-400 text-center">
                        <?php echo $section_heading?>
                    </h2>
                </div>
                <div class="volunteer-programmes-section__body">
                    <?php
                        foreach($internships as $index => $internship):
                            $internship_ID = $internship['internship'];
                            $internship_link = get_post_permalink($internship_ID);
                            $is_featured_internship = $internship['is_featured_internship'];
                            if($is_featured_internship){
                                $featured_internship_icon = $internship['featured_internship_icon'];
                                $featured_internship_text = $internship['featured_internship_text'];
                            }
                            $internship_country = $internship['internship_country'];
                            $internship_image = $internship['internship_image'];
                            $internship_features = $internship['internship_features'];
                            $product_ID = get_post_meta($internship_ID, 'internship_product');
                            $internship_product = wc_get_product($product_ID[0]);
                            $internship_price_html = $internship_product->get_price_html();
                            $internship_guide_image = $internship['internship_guide_image'];
                            $internship_guide_link = $internship['internship_guide_link'];
                    ?>
                        <div class="ast-col-md-4">
                            <div class="internship-card <?php echo $index > 2 ? 'has-margin-top' : '' ?>">
                                <div class="internship-card__top">
                                    <div class="internship-card__top-header">
                                        <img src="<?php echo $internship_image?>" alt="">
                                        <?php if($is_featured_internship):?>
                                            <div class="internship-feautured-label">
                                                <img src="<?php echo $featured_internship_icon?>" alt=""/>
                                                <span><?php echo $featured_internship_text?></span>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <div class="internship-card__top-content">
                                        <div class="internship-price">
                                            <?php echo $internship_price_html?>
                                        </div>
                                        <h3 class="internship-country font-700">
                                            <?php echo $internship_country?>
                                        </h3>
                                        <div class="internship-features">
                                            <?php
                                                foreach($internship_features as $key => $feature):
                                                    if(!empty($feature)):
                                                        $key = str_replace('_',' ',$key);
                                            ?>
                                            <div class="internship-feature">
                                                <span class="font-700"><?php echo $key?></span>
                                                <span class="font-400"><?php echo $feature?></span>
                                            </div>
                                            <?php
                                                    endif;
                                                endforeach
                                            ?>
                                        </div>
                                        <a href="<?php echo $internship_link?>" class="btn btn-centered btn-small internship-link">
                                            learn more
                                        </a>
                                    </div>
                                    
                                </div>
                                <div class="internship-card__bottom">
                                    <div class="internship-guide-image text-center">
                                        <h6 class="font-500 text-center">Learn more about the <?php echo $internship_country?> Internship</h6>
                                        <img src="<?php echo $internship_guide_image?>" alt="" />
                                    </div>
                                    <a target="_blank" href="<?php echo $internship_guide_link?>" class="btn-centered btn btn-small internship-guide-link">
                                        download guide
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                        endforeach
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Volunteer Programmes Section End  -->

    <?php
        endif;
    ?>

    <?php
        $eligibility_forms_slider = get_field('eligibility_forms_slider');
        if(!empty($eligibility_forms_slider)):
    ?>
    <!-- Eligibility Forms slider Section -->
    <section class="eligibility-forms-slider section-padding-top">
        <div class="ast-container">
            <div class="ast-row">
                <div class="eligibility-forms-slider-wrapper">
                    <?php
                        foreach($eligibility_forms_slider as $key => $slider):
                            $slider_image = $slider['slider_image'];
                            $slider_title = $slider['slider_title'];
                            $slider_sumamry = $slider['slider_sumamry'];
                            $slider_cta_link = $slider['slider_cta_link'];
                            $slider_cta_text = $slider['slider_cta_text'];
                    ?>
                        <div class="eligibility-forms-slide" style="background: linear-gradient(-270deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)), url('<?php echo $slider_image?>');">
                            <div class="ast-col-md-6"></div>
                            <div class="ast-col-md-6">
                                <div class="eligibility-forms-slide__content">
                                    <h2 class="font-600 large-heading eligibility-forms-slide__heading">
                                        <?php echo $slider_title?>
                                    </h2>
                                    <div class="font-400 eligibility-forms-slide__summary">
                                        <?php echo $slider_sumamry?>
                                    </div>
                                    <a target="_blank" href="<?php echo $slider_cta_link?>" class="eligibility-forms-slide__btn btn btn-centered btn-small">
                                        <?php echo $slider_cta_text?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Eligibility Forms slider Section End  -->
    <?php
        endif;
    ?>

    <?php
        $videos_interviews = get_field('videos_interviews');
        if(!empty($videos_interviews)):
    ?>
    <!-- Video Interviews Section -->

    <section class="videos-interview-section section-padding-top">
        <div class="ast-container">
            <div class="ast-row">
                <?php
                    foreach($videos_interviews as $key => $video):
                        $video_image = $video['video_thumbnail'];
                        $video_title = $video['video_title'];
                        $video_subtitle = $video['video_subtitle'];
                        $video_link = $video['video_link'];
                ?>
                    <div class="ast-col-md-4">
                        <div class="video-interview-card">
                            <div class="video-interview-card__header">
                                <img src="<?php echo $video_image?>" alt="">
                                <a href="<?php echo $video_link?>" data-lity class="video-interview-card__link">
                                    <img src="/wp-content/uploads/2023/08/Play-icon-accent.svg" alt="">
                                </a>
                            </div>
                            <div class="video-interview-card__content">
                                <h3 class="font-800 small-heading video-interview-card__content-title">
                                    <?php echo $video_title?>
                                </h3>
                                <div class="font-600 video-interview-card__content-subtitle">
                                    <?php echo $video_subtitle?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    endforeach;
                ?>
            </div>
        </div>
    </section>

    <!-- Video Interviews Section End-->

    <?php
        endif;
    ?>

    <?php
        $why_us_section = get_field('why_us_section');
        if(!empty($why_us_section)):
            $section_title = $why_us_section['section_title'];
            $section_content = $why_us_section['section_content'];
            $video_thumbnail = $why_us_section['video_thumbnail'];
            $video_link = $why_us_section['video_link'];
    ?>  
    <!-- Why Us Section -->

    <section class="why-us-section section-padding-top">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <h2 class="large-heading text-center font-400 common-section-heading">
                        <?php echo $section_title?>
                    </h2>
                </div>
                <div class="flex-wrapper">
                    <div class="ast-col-md-6">
                        <div class="why-us-section__content equalize-height">
                            <?php echo $section_content?>
                        </div>
                    </div>
                    <div class="ast-col-md-6">
                        <div class="why-us-section__video ">
                            <img class="equalize-height" src="<?php echo $video_thumbnail?>" alt=""/>
                            <a href="<?php echo $video_link?>" data-lity class="why-us-section__video-link">
                                <img src="/wp-content/uploads/2023/08/Play-icon-accent.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Us Section End -->

    <?php
        endif
    ?>

    <?php
        $featured_blogs_section = get_field('featured_blogs_section');
        if(!empty($featured_blogs_section)):
            $section_title = $featured_blogs_section['section_title'];
            $featured_blogs = $featured_blogs_section['blogs'];
    ?>
    <!-- Featured Blogs Section -->

    <section class="featured-blogs-section section-padding">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <h2 class="large-heading text-center common-section-heading font-400">
                        <?php echo $section_title?>
                    </h2>
                </div>
                <?php
                    foreach($featured_blogs as $key => $blog):
                        $blog_ID = $blog['blog_post'];
                ?>
                    <div class="ast-col-md-4">
                        <div class="blog">
                            <div class="blog__header">
                                <img src="<?php echo get_the_post_thumbnail_url($blog_ID)?>" alt="">
                            </div>
                            <div class="blog__content">
                                <h3 class="equal-height-header font-500 small-heading">
                                    <?php echo get_the_title($blog_ID)?>
                                </h3>
                                <a href="<?php echo get_the_permalink($blog_ID)?>" class="btn btn-small btn-centered">
                                    read more
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                    endforeach;
                ?>
            </div>
        </div>
    </section>

    <!-- Featured Blogs Section End -->
    
    <?php
        endif;
    ?>
</div>

<?php get_footer(); ?>