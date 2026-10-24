<?php

/**
 * Template Name: TEFL For Schools 2024
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram Rana <bikram@appycodes.com>
 * @date December 2024
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();
?>

<div id="primary" <?php astra_primary_class(); ?>>

    <?php
        $hero_banner = get_field('hero_banner');
        if(!is_array_empty($hero_banner)):
            $banner_image = $hero_banner['banner_image'];
            $banner_title = $hero_banner['banner_title'];
            $banner_text = $hero_banner['banner_text'];
            $banner_cta_text = $hero_banner['banner_cta_text'];
            $partner_logos = $hero_banner['partner_logos'];
    ?>
        <section class="hero-section py-3" style="background:#E4E3DD url('/wp-content/uploads/2024/12/esl_partner_hero_bg.png')">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-6">
                        <div class="banner-section__image equal-height">
                            <img src="<?php echo $banner_image?>" alt="">
                        </div>
                    </div>
                    <div class="ast-col-md-6">
                        <div class="banner-section__content equal-height">
                            <h1 class="large-heading common-section-heading">
                                <?php echo $banner_title?>
                            </h1>
                            <div class="banner-section__content-summary ">
                                <?php echo $banner_text?>
                            </div>
                            <a href="#quoteForm" class="btn btn-primary btn-centered hero-banner-btn">
                                <?php echo $banner_cta_text?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if(!is_array_empty($partner_logos)):
            ?>
            <div class="partner-logos">
                <div class="splide partner-logos-slider" aria-label="photo-gallery">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php
                                foreach($partner_logos as $logo):
                            ?>
                                <li class="splide__slide">
                                    <img class="slide-image no-lazy" src="<?php echo $logo?>" alt="">
                                </li>
                            <?php
                                endforeach
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
                endif;
            ?>
        </section>
    <?php
        endif;
    ?>

    <?php
        $student_benefits = get_field('student_benefits');
        if(!is_array_empty($student_benefits)):
            $section_title = $student_benefits['section_title'];
            $benefits = $student_benefits['benefits'];
    ?>

        <section class="student-benefits-section py-3">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="common-section-heading text-center">
                            <?php echo $section_title?>
                        </h2>
                    </div>
                </div>
                <?php
                if(!is_array_empty($benefits)):
                ?>
                <div class="student-benefits-slider-wrapper">
                    <div class="splide student-benefits-slider" aria-label="benefits-slider">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php
                                foreach ($benefits as $benefit):
                                    $image = $benefit['image'];
                                    $description = $benefit['description'];
                                    $link = $benefit['link'] ?? null; 
                                ?>
                                    <li class="splide__slide">
                                        <<?php echo $link ? 'a href="' . $link . '"' : 'div'; ?> class="benefits-card">
                                            <div class="benefits-image">
                                                <img class="no-lazy" src="<?php echo $image ?>" alt="">
                                            </div>
                                            <div class="benefits-text text-center">
                                                <?php echo $description ?>
                                            </div>
                                        </<?php echo $link ? 'a' : 'div'; ?>>
                                    </li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                    endif;
                ?>
            </div>
        </section>

    <?php
        endif;
    ?>

    <?php 
        $course_info_section = get_field('course_info_section');
        if(!is_array_empty($course_info_section)):
            $course_title = $course_info_section['course_title'];
            $course_subtitle = $course_info_section['course_subtitle'];
            $course_summary = $course_info_section['course_summary'];
            $course_logo = $course_info_section['course_logo'];
            $course_info_accordion = $course_info_section['course_info_accordion'];
            $course_cta_text = $course_info_section['course_cta_text'];
            $course_cta_link = $course_info_section['course_cta_link'];
    ?>

        <section class="course-info-section">
            <div class="ast-container">
                <div class="course-info-section-row">
                    <div class="ast-row">
                        <div class="ast-col-md-12">
                            <div class="course-info-section-row__header">
                                <div class="course-info-section-row__header-left">
                                    <img src="<?php echo $course_logo?>" alt="">
                                </div>
                                <div class="course-info-section-row__header-right">
                                    <h2>
                                        <?php echo $course_title?>
                                    </h2>
                                    <span><?php echo $course_subtitle?></span>
                                </div>
                            </div>
                            <div class="course-info-section-row__description">
                                <?php echo $course_summary?>
                            </div>
                        </div>
                    </div>
                    <div class="ast-row mt-2">
                        <div class="ast-col-md-12">
                            <?php
                            foreach($course_info_accordion as $index => $outline):
                                $outline_title = $outline['title'];
                                $outline_content  = $outline['description'];
                            ?>
                                <div class="course-outline-accordion">
                                    <div class="course-outline-heading">
                                        <h4 class="course-outline-title"><?php echo $outline_title; ?></h4>
                                        <i class="fa fa-plus"></i>
                                    </div>
                                    <div class="course-outline-content">
                                        <div class="course-outline-body"><?php echo $outline_content; ?></div>
                                    </div>
                                </div>
                            <?php 
                            endforeach; 
                            ?>

                            <a href="<?php echo $course_cta_link?>" class="btn mt-2 btn-centered btn-primary">
                                <?php echo $course_cta_text?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>
   
    <?php
        $teachers_review = get_field('teachers_review');
        if(!is_array_empty($teachers_review)):
            $section_title = $teachers_review['section_title'];
            $reviews = $teachers_review['reviews']
    ?>

        <section class="mt-2 py-5 teachers-review-section">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="common-section-heading">
                            <?php echo $section_title?>
                        </h2>
                    </div>
                </div>
                <div class="teachers-review-slider-wrapper">
                    <?php
                        if(!is_array_empty($reviews)):
                    ?>
                    <div class="splide teachers-review-slider" aria-label="teachers-review-slider">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php
                                foreach ($reviews as $key => $review):
                                    $image = $review['image'];
                                    $title = $review['title'];
                                    $subtitle = $review['subtitle'];
                                    $review_text = $review['review_text'];
                                ?>
                                    <li class="splide__slide">
                                        <div class="review">
                                            <div class="review-header">
                                                <div class="review-header__left">
                                                    <span class="review-title"><?php echo $title?></span>
                                                    <span class="review-subtitle"><?php echo $subtitle?></span>
                                                </div>
                                                <div class="review-header__right">
                                                    <img src="<?php echo $image?>" alt="" class="review-icon">
                                                </div>
                                            </div>
                                            <div class="review-star">
                                                <img src="/wp-content/uploads/2024/12/five-star-gold.png" alt="">
                                            </div>
                                            <div class="review-body">
                                                <?php echo $review_text?>
                                            </div>
                                        </div>
                                    </li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php 
                        endif;
                    ?>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>

    <?php
        $how_it_works_section = get_field('how_it_works_section');
        if(!is_array_empty($how_it_works_section)):
            $section_title = $how_it_works_section['section_title'];
            $section_summary = $how_it_works_section['section_summary'];
            $steps = $how_it_works_section['steps'];
            $how_it_works_cta_text = $how_it_works_section['how_it_works_cta_text'];
            $how_it_works_cta_link = $how_it_works_cta_link['how_it_works_cta_link'];
    ?>

        <section class="py-3 how-it-works-section">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="common-section-heading">
                            <?php echo $section_title?>
                        </h2>
                        <div class="how-it-works-section__summary">
                            <?php echo $section_summary?>
                        </div>
                    </div>
                </div>
                <div class="ast-row">
                    <div class="how-it-works-steps">
                        <?php
                            foreach($steps as $key => $step):
                                $image = $step['image'];
                                $title = $step['title'];
                                $subtitle = $step['subtitle'];
                        ?>
                            <div class="ast-col-md-3">
                                <div class="step">
                                    <img src="<?php echo $image?>" alt="" class="step-image">
                                    <h3 class="step-title"><?php echo $title?></h3>
                                    <span class="step-subtitle">
                                        <?php echo $subtitle?>
                                    </span>
                                </div>
                            </div>
                        <?php
                            endforeach
                        ?>
                    </div>
                    <div class="ast-col-md-12">
                    <a href="<?php echo empty($how_it_works_cta_link) ? '#quoteForm' : $how_it_works_cta_link; ?>" class="btn btn-centered how-it-works-cta mt-2">
                        <?php echo $how_it_works_cta_text; ?>
                    </a>
                    </div>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>

    <?php
        $request_quote_section = get_field('request_quote_section');
        if(!is_array_empty($request_quote_section)):
            $section_title = $request_quote_section['section_heading'];
            $contact_form_shortcode = $request_quote_section['contact_form_shortcode'];
    ?>
        <section id="quoteForm" class="py-3 request-quote-section">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="common-section-heading text-center">
                            <?php echo $section_title?>
                        </h2>
                    </div>
                </div>
                <div class="ast-row">
                    <div class="quote-form-wrapper">
                        <?php echo do_shortcode($contact_form_shortcode); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
        endif;
    ?>

    <?php
        $brochure_section = get_field('brochure_section');
        if(!is_array_empty($brochure_section)):
            $section_title = $brochure_section['section_title'];
            $brochure_image = $brochure_section['brochure_image'];
            $contact_form_shortcode = $brochure_section['contact_form_shortcode'];
    ?>

        <section class="brochure-download-section py-2">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-6">
                        <div class="brochure-form-wrapper">
                            <h2 class="common-section-heading">
                                <?php echo $section_title?>
                            </h2>
                            <?php echo do_shortcode($contact_form_shortcode); ?>
                        </div>
                    </div>
                    <div class="ast-col-md-6">
                        <img src="<?php echo $brochure_image?>" alt="" class="brochure-image">
                    </div>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>

    <?php
        $contact_section = get_field('contact_section');
        if(!is_array_empty($contact_section)):
            $section_title = $contact_section['section_title'];
            $contact_information = $contact_section['contact_information'];
    ?>
        <section class="py-3 contact-section">
            <div class="ast-container">
                <div class="contact-section-row">
                    <div class="ast-row">
                        <h2 class="common-section-heading text-center">
                            <?php echo $section_title?>
                        </h2>
                        <div class="common-section-content text-center">
                            <?php echo $contact_information?>
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