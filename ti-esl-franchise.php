<?php

/**
 * Template Name: TEFL Institute Partner
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
        <section class="hero-section py-5" style="background:#E4E3DD url('/wp-content/uploads/2024/12/esl_partner_hero_bg.png')">
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
                            <a href="#partnerForm" class="btn btn-primary btn-centered hero-banner-btn">
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
        $about_section = get_field('about_section');
        if(!is_array_empty($about_section)):
            $section_title = $about_section['section_title'];
            $section_summary = $about_section['section_summary'];
    ?>
        <section class="about-section py-5">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="common-section-heading text-center large-heading about-section__title">
                            <?php echo $section_title?>
                        </h2>
                        <div class="about-section__summary">
                            <?php echo $section_summary?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
        endif
    ?>

    <?php
        $partnership_pathways = get_field('partnership_pathways');
        if(!is_array_empty($partnership_pathways)):
            $section_title = $partnership_pathways['section_title'];
            $courses_card = $partnership_pathways['courses_card'];
            $how_it_works_card = $partnership_pathways['how_it_works_card'];
            $partner_benefits_card = $partnership_pathways['partner_benefits_card'];
    ?>

        <section class="partnership-pathways-section">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="large-heading common-section-heading text-center">
                            <?php echo $section_title?>
                        </h2>
                    </div>
                </div>
                <div class="ast-row ast-flex">
                    
                    <?php 
                        foreach($courses_card as $key => $course_card): 
                            $card_title = $course_card['card_title'];
                            $card_logo = $course_card['card_logo'];
                            $card_description = $course_card['card_description'];
                            $card_link = $course_card['course_link'];
                    ?>
                        <div class="ast-col-md-6">
                            <div class="card course-card">
                                <img src="<?php echo $card_logo?>" alt="" class="card-logo">
                                <h3 class="large-heading card-title">
                                    <?php echo $card_title?>
                                </h3>
                                <div class="card-description">
                                    <?php echo $card_description?>
                                </div>
                                <a href="<?php echo $card_link?>" class="mt-1 course-card-btn btn btn-primary btn-centered">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    <?php
                        endforeach
                    ?>
                </div>
                <div class="ast-row pt-2 ast-flex">
                    <?php
                        if(!is_array_empty($how_it_works_card)):
                            $card_title = $how_it_works_card['card_title'];
                            $card_description = $how_it_works_card['card_description'];
                    ?>
                        <div class="ast-col-md-6">
                            <div class="card how-it-works-card">
                                <h3 class="large-heading card-title">
                                    <?php echo $card_title?>
                                </h3>
                                <div class="card-description">
                                    <?php echo $card_description?>
                                </div>
                            </div>
                        </div>
                    <?php
                        endif
                    ?>

                    <?php
                        if(!is_array_empty($partner_benefits_card)):
                            $card_title = $partner_benefits_card['card_title'];
                            $card_description = $partner_benefits_card['card_description'];
                    ?>
                        <div class="ast-col-md-6">
                            <div class="card partner-benefits-card">
                                <h3 class="large-heading card-title">
                                    <?php echo $card_title?>
                                </h3>
                                <div class="card-description">
                                    <?php echo $card_description?>
                                </div>
                            </div>
                        </div>
                    <?php
                        endif
                    ?>

                </div>
            </div>
        </section>

    <?php
        endif
    ?>

    <?php
        $contact_section = get_field('contact_section');
        if(!is_array_empty($contact_section)):
            $contact_section_left = $contact_section['contact_section_left'];
            $contact_section_right = $contact_section['contact_section_right'];
    ?>
        <section class="py-3 contact-section">
            <div class="ast-container">
                <div class="contact-section-row">
                    <div class="ast-row ast-flex">
                        <div class="ast-col-md-6">
                            <div class="contact-section-left">
                                <?php
                                    $section_title = $contact_section_left['section_title'];
                                    $section_summary = $contact_section_left['section_summary'];
                                    $contact_email = $contact_section_left['contact_email'];
                                ?>
                                <h2 class="common-section-heading">
                                    <?php echo $section_title?>
                                </h2>
                                <div class="contact-section-left-content">
                                    <?php echo $section_summary?>
                                </div>
                                <a target="_blank" href="mailto: <?php $contact_email?>">
                                    <?php echo 'Email: '.$contact_email?>
                                </a>
                            </div>
                        </div>
                        <div class="ast-col-md-6">
                            <div class="contact-section-right">
                                <?php
                                    $section_title = $contact_section_right['section_title'];
                                    $contact = $contact_section_right['contact'];
                                    $contact_description = $contact_section_right['contact_description'];
                                ?>
                                <h2 class="common-section-heading">
                                    <?php echo $section_title?>
                                </h2>
                                <div class="contact-details">
                                    <?php
                                        foreach($contact as $key => $cd):
                                            $contact_image = $cd['contact_image'];
                                            $contact_name = $cd['contact_name'];
                                            $contact_designation = $cd['contact_designation'];
                                    ?>
                                        <div class="contact-detail">
                                            <img src="<?php echo $contact_image?>" alt="">
                                            <span class="font-700 text-center"><?php echo $contact_name?></span>
                                            <span class="font-500 text-center"><?php echo $contact_designation?></span>
                                        </div>
                                    <?php
                                        endforeach
                                    ?>
                                </div>
                                <div class="contact-section-right-content">
                                    <?php echo $contact_description?>
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

    <section id = "partnerForm" class="pb-3 partner-contact-form-section">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <h2 class="common-section-heading text-center">Partner with the TEFL Institute</h2>
                    <div class="partner-contact-form">
                    <?php echo do_shortcode('[contact-form-7 id="67369" title="Become a partner school form"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
</div>

<?php get_footer(); ?>