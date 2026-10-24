<?php

/**
 * Template Name: Country TEFL Course Page
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram Rana <bikram@appycodes.com>
 * @date May 2025
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();

?>
<div id="primary" <?php astra_primary_class(); ?>>

    <?php
        $hero_banner = get_field('hero_banner');

        $banner_img =  $hero_banner['banner_image'];
        $banner_CTA =  $hero_banner['banner_cta'];


        $CTA_btns = $banner_CTA['banner_cta_buttons'];
        $btn1 = $CTA_btns['button1'];
        $btn2 = $CTA_btns['button2'];
        $btn1_txt = $btn1['button1_text'];
        $btn2_txt = $btn2['button2_text'];
        $btn1_link = $btn1['button1_link'];
        $btn2_link = $btn2['button2_link'];
        $CTA_title = $banner_CTA['banner_cta_title'];
        $CTA_txt =  $banner_CTA['banner_cta_text'];
    ?>
    <!-- Hero banner section -->
    <section class="hero-banner-section section-padding" style="background-image:url('<?php echo $banner_img ?>')">
        
        <div class="ast-container">
            <div class="ast-row ast-flex">
                <div class="ast-col-md-6">
                    <div class="hero-banner__content">
                        <div class="hero-banner__heading">
                            <h1 class="page-title__main large-heading">
                                <?php echo $CTA_title; ?>
                            </h1>
                        </div>
                        <div class="hero-banner__summary">
                        <?php echo $CTA_txt ?>
                        </div>
                        <div class="banner-cta-buttons">
                           <a href="<?php echo $btn1_link?>" class="banner-btn enrol-btn">
                                <?php echo $btn1_txt?>
                           </a>
                           <a href="<?php echo $btn2_link?>" class="banner-btn learn-more-btn">
                                <?php echo $btn2_txt?>
                           </a>
                        </div>
                    </div>
                </div>
                <div  class="ast-col-md-6">
                </div>
            </div>
        </div>
    </section>

    <!-- Hero banner section End-->

    <?php
        $accreditation_section = get_field('accreditation_section');
        $common_accreditation = get_field('level_5_common_accreditation','option');
        if(!is_array_empty($accreditation_section)):
            $section_title = $accreditation_section['section_title'];
            $section_summary = $accreditation_section['section_summary'];
            $accreditation_logos = $accreditation_section['accreditation_logos'];
    ?>

        <section class="accreditation-section section-padding-top">
            <div class="ast-container">
                <div class="ast-row ">
                   <div class="ast-col-md-12">
                        <p class="section-title text-center">
                            <?php echo $section_title?>
                        </p>
                        <div class="accreditation-section__summary text-center">
                            <?php echo $section_summary?>
                        </div>
                        
                        <div class="accreditation-section__body">
                        <?php if (true) {
                            $ofqual_section = get_field('ofqual_accreditation_section', 'options');
                            $ofqual_img = $ofqual_section['image'];
                            $ofqual_content = $ofqual_section['content']; ?>
                            <div class="ofqual-section">
                                <?php if ($ofqual_img) : ?>
                                    <img src="<?php echo $ofqual_img; ?>">
                                <?php endif; ?>
                                <?php if ($ofqual_content) : ?>
                                    <div><?php echo $ofqual_content; ?></div>
                                <?php endif; ?>
                            </div>
                        <?php } ?>
                        <div class="accreditation-section__logos">
                            <?php
                            if ($accred_img && $accred_title) : ?>
                                <div class="item">
                                    <div class="image-box">
                                        <img src="<?php echo $accred_img; ?>">
                                    </div>
                                    <div>
                                        <h5><?php echo $accred_title; ?></h5>
                                        <h6><?php echo $accred_subtitle; ?></h6>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php 
                                if(have_rows('common_accreditation','option')):
                                    foreach($common_accreditation as $comm_acc):
                                        $accred_img = $comm_acc['logo'];
                                        $accred_title = $comm_acc['title'];
                                        $accred_subtitle = $comm_acc['subtitle'];
                                        $accred_link = $comm_acc['link'];
                            ?>
                                <div class="item">
                                    <div class="image-box">
                                        <a href="<?php echo $accred_link?>" target="_blank">
                                            <img src="<?php echo $accred_img; ?>">
                                        </a>
                                    </div>
                                    <div class="image-text">
                                        <h5><?php echo $accred_title; ?></h5>
                                        <h6><?php echo $accred_subtitle; ?></h6>
                                    </div>
                                </div>
                            <?php 
                                    endforeach;
                                endif
                            ?>
                        </div>
                   </div>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>

    <?php
        $why_take_this_course = get_field('why_take_this_course');
        if(!is_array_empty($why_take_this_course)):
            $section_title = $why_take_this_course['section_title'];
            $section_summary = $why_take_this_course['section_summary'];
            $faqs = $why_take_this_course['faqs'];
            $cta_button = $why_take_this_course['cta_button'];
    ?>

    <!-- Why Choose Section -->
    <section class="why-choose-section section-padding">
        <div class="ast-container">
            <div class="why-choose-section__row">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="section-title">
                            <?php echo $section_title?>
                        </h2>
                        <div class="section-summary">
                            <?php echo $section_summary?>
                        </div>
                        <div class ="accordion-container">
                            <?php
                            foreach($faqs as $index => $faq):
                                $faq_title = $faq['question'];
                                $faq_content  = $faq['answer'];
                            ?>
                                <div class="accordion">
                                    <div class="accordion-heading">
                                        <p class="accordion-title"><?php echo $faq_title; ?></p>
                                        <i class="fa fa-plus"></i>
                                    </div>
                                    <div class="accordion-content">
                                        <div class="accordion-body"><?php echo $faq_content; ?></div>
                                    </div>
                                </div>
                            <?php 
                            endforeach; 
                            ?>
                        </div>
                        <a href="<?php echo $cta_button['button_link']?>" class="cta-btn">
                            <?php echo $cta_button['button_text']?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Choose Section End -->
    
    <?php
        endif;
    ?>
    <?php
        $course_details_tabs = get_field('course_details_tabs');
        if(!is_array_empty($course_details_tabs)):
    ?>
    <!-- Course Details Section -->

    <section class="course-details-section section-padding-bottom">
        <div class="ast-container">
            
            <div id="tabs-section" class="tabs ast-row">
                <div class="ast-col-md-6 tab-wrapper">
                    <ul class="tab-head">
                        <?php 
                        foreach($course_details_tabs as $key => $course_details_tab):
                            $tab_title = $course_details_tab['tab_title'];
                        ?>
                        
                        <li>
                            <a href="#tab-<?php echo $key+1?>" class="tab-link <?php echo $key === 0?'active':''?>"><span class="tab-label"><?php echo $tab_title ?></span><i class="fa fa-arrow-right"></i></a>
                        </li>
                        <?php endforeach?>
                        
                    </ul>
                </div>
                <div class="ast-col-md-6">
                    <div class="course-details-tab-content">
                        <?php 
                        foreach($course_details_tabs as $key => $course_details_tab):
                            $tab_title = $course_details_tab['tab_title'];
                            $tab_content_title = $course_details_tab['tab_content_title'];
                            $extra_tab_content = $course_details_tab['extra_tab_content'];
                            $tab_content       = $course_details_tab['tab_content'];
                            $tab_faq_content   = $course_details_tab['tab_faq_content'];
                            $tab_accordian_content = $course_details_tab['tab_accordian_content'];
                        ?>
                            <section data-extra-content="<?php echo $extra_tab_content?>" id="tab-<?php echo $key+1?>" class="tab-body <?php echo $key === 0?'active active-content':''?>">
                                <p class="tab-body__title large-heading"><?php echo $tab_content_title?$tab_content_title:$tab_title?></p>
                                    <?php if(!empty($tab_faq_content) && $extra_tab_content === 'faq-content'):
                                        
                                        $faq_questions = get_cfvalue_by_country('frequently_asked_questions');
                                        if(is_array_empty($faq_questions)){
                                            $faq_questions = $tab_faq_content['faq_questions']; 
                                        }
                                        $faq_questions = (array)$faq_questions;
                                    ?>
                                        <div class="tab-body__content--faq">
                                            <script type="application/ld+json">
                                                {
                                                    "@context": "https://schema.org",
                                                    "@type": "FAQPage",
                                                    "mainEntity": [
                                                        <?php
                                                        $faqcount = count($faq_questions);
                                                        $counter = 0;
                                                        foreach($faq_questions as $faq) {
                                                            $counter++;
                                                        ?> {
                                                                "@type": "Question",
                                                                "name": <?php echo json_encode($faq['question']); ?>,
                                                                "acceptedAnswer": {
                                                                    "@type": "Answer",
                                                                    "text": <?php echo json_encode($faq['answer']); ?>
                                                                }
                                                            }
                                                        <?php
                                                            if ($faqcount != $counter) echo ",";
                                                        }
                                                        ?>
                                                    ]
                                                }
                                            </script>
                                            <?php foreach($faq_questions as $faq):
                                                $question = $faq['question'];
                                                $answer   = $faq['answer'];    
                                            ?>
                                            <div class="tab-faq">
                                                <p class="tab-faq__question">
                                                    <?php echo $question?>
                                            </p>
                                                <div class="tab-faq__answer">
                                                    <?php echo $answer?>
                                                </div>
                                            </div>
                                            <?php endforeach?>
                                        </div>
                                    <?php endif?>
                                    <div class="tab-body__content--main">
                                        <?php echo $tab_content?>
                                    </div>
                                    <?php if($extra_tab_content != 'faq-content'):?>
                                        <div class="tab-body__content--extra">
                                            <?php if($extra_tab_content === 'accordion-content'):?>
                                                <ul class="tab-body__content--accordion">
                                                    <?php 
                                                    $accordion = $tab_accordian_content['accordion'];
                                                    foreach($accordion as $key => $acc):
                                                        $accordion_title = $acc['accordion_title'];
                                                        $accordion_stitle = $acc['accordion_subtitle'];
                                                        $accordion_content = $acc['accordion_content'];
                                                        if(!empty($accordion_content)):
                                                    ?>
                                                        <li>
                                                            <input type="checkbox" name="faq-trigger-<?php echo $key?>" <?php echo $key===0?'checked':''?>>
                                                            <i></i>
                                                            <p class="faq-drawer__title">
                                                                <span class="faq-drawer__title--sub"><?php echo $accordion_stitle?></span>
                                                                <span class="faq-drawer__title--main"><?php echo $accordion_title?></span>
                                                            </p>
                                                            <div class="faq-drawer__content-wrapper">
                                                                <div class="faq-drawer__content">
                                                                    <?php echo $accordion_content?>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php
                                                        else:
                                                    ?>
                                                        <p class="accordion-header">
                                                            <?php echo $accordion_title?>
                                                        </p>
                                                    <?php
                                                        endif;
                                                    endforeach
                                                    ?>
                                                </ul>
                                            <?php endif?>
                                        </div>
                                    <?php endif?>
                            </section>
                        <?php endforeach?>
                        <div class="read-more-btn-container">
                            <div>
                                <span>read more</span>
                                <i class="fa fa-angle-down"></i>
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

    <!-- Course Details Section End-->

    <?php
        $about_section = get_field('about_section');
        if(!is_array_empty($about_section)):
            $section_title = $about_section['section_title'];
            $section_summary = $about_section['section_summary'];
            $section_cta = $about_section['section_cta'];
            $cta_img = $section_cta['cta_image'];
            $cta_text = $section_cta['cta_text'];
            $cta_link = $section_cta['cta_link'];
    ?>

    <!-- About Section -->
    <section class="about-section section-padding-bottom">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-6">
                    <div class="about-section__left">
                        <p class="section-title">
                            <?php echo $section_title?>
                        </p>
                        <div class="about-section__summary">
                            <?php echo $section_summary?>
                        </div>
                    </div>
                </div>
                <div class="ast-col-md-6">
                    <div class="about-section-right">
                        <img src="<?php echo $cta_img?>" alt="">
                        <a href="<?php echo $cta_link?>" target = "_blank" class="cta-btn">
                            <?php echo $cta_text?>
                        </a>
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
        $employer_verification = get_field('employer_verification');
        if(!is_array_empty($employer_verification)):
            $section_title = $employer_verification['section_title'];
            $section_summary = $employer_verification['section_summary'];
    ?>

    <!-- Employer Verification Section -->
    <section class="employer-verification-section section-padding-bottom">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <div class="employer-verification-section__body">
                        <p class="section-title">
                            <?php echo $section_title?>
                        </p>
                        <div class="employer-verification-section__summary">
                            <?php echo $section_summary?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Employer Verification Section End -->
    
    <?php
        endif;
    ?>

    <?php
        $photo_gallery = get_field('photo_gallery');
        if(!is_array_empty($photo_gallery)):
    ?>
        <section class="gallery-section section-padding-bottom">
            <div class="splide photo-gallery" aria-label="photo-gallery">
                <div class="splide__track">
                        <ul class="splide__list">
                            <?php
                                foreach($photo_gallery as $key => $pg):
                                    $image = $pg['image'];
                            ?>
                                <li class="splide__slide">
                                    <img data-lity class="slide-imag no-lazy" src="<?php echo $image?>" alt="">
                                </li>
                            <?php
                                endforeach
                            ?>
                        </ul>
                </div>
            </div>
        </section>
    <?php
        endif;
    ?>

    <?php
        $work_as_a_teacher = get_field('work_as_a_teacher');
        if(!is_array_empty($work_as_a_teacher)):
            $section_title = $work_as_a_teacher['section_title'];
            $section_summary = $work_as_a_teacher['section_summary'];
    ?>

    <!-- Teacher Section -->
    <section class="teacher-section section-padding-bottom">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <div class="teacher-section__left">
                        <p class="section-title">
                            <?php echo $section_title?>
                        </p>
                        <div class="teacher-section__summary">
                            <?php echo $section_summary?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Teacher  Section End -->
    
    <?php
        endif;
    ?>

    <?php
        $full_width_banner = get_field('full_width_banner');
        if(!is_array_empty($full_width_banner)):
            $banner_text = $full_width_banner['banner_text'];
            $banner_image = $full_width_banner['banner_image'];
    ?>
        <section class="full-width-banner-section section-padding" style="background:url('<?php echo $banner_image?>')">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <div class="full-width-banner-section__text">
                            <?php echo $banner_text?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
        endif;
    ?>

    <?php
        $course_overview = get_field('course_overview');
        if(!is_array_empty($course_overview)):
            $section_title = $course_overview['section_title'];
            $section_summary = $course_overview['section_summary'];
            $cta_card = $course_overview['cta_card'];
    ?>

        <section class="course-overview-section section-padding">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-4">
                        <?php
                            $cta_image = $cta_card['cta_image'];
                            $features = $cta_card['features'];
                            $cta_button_text = $cta_card['cta_button_text'];
                            $cta_button_link = $cta_card['cta_button_link'];
                        ?>
                        <div class="course-overview__cta">
                            <img src="<?php echo $cta_image?>" alt="" class="course-overview__cta-image">
                            <div class="course-overview__cta-content">
                                <div class="cta-features">
                                    <?php
                                        foreach($features as $key => $feature):
                                            $icon = $feature['icon'];
                                            $title = $feature['title'];
                                    ?>
                                        <div class="cta-feature">
                                            <img src="<?php echo $icon?>" alt="">
                                            <span><?php echo $title?></span>
                                        </div>
                                    <?php
                                        endforeach
                                    ?>
                                </div>
                                <img src="/wp-content/uploads/2025/05/Group-3.svg" alt="" class="cta-rating-image">
                                <a href="<?php echo $cta_button_link?>" class="cta-btn">
                                    <?php echo $cta_button_text?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="ast-col-md-8">
                        <div class="course-overview__content">
                            <p class="section-title">
                                <?php echo $section_title?>
                            </p>
                            <div class="course-overview__summary">
                                <?php echo $section_summary?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>

    <?php
        $team_section = get_field('team_section');
        if(!is_array_empty($team_section)):
            $section_title = $team_section['section_title'];
            $section_summary = $team_section['section_summary'];
            $sectiom_image = $team_section['section_image'];
    ?>

        <section class="team-section section-padding-bottom">
            <div class="ast-container">
                <div class="ast-row ast-flex">
                    <div class="ast-col-md-6">
                        <div class="team-section__content">
                            <p class="section-title">
                                <?php echo $section_title?>
                            </p>
                            <div class="team-section__summary">
                                <?php echo $section_summary?>
                            </div>
                        </div>
                    </div>
                    <div class="ast-col-md-6">
                        <div class="team-section__image">
                            <img src="<?php echo $sectiom_image?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>

    <!-- Instructors Info Section -->

    <?php
        $instructors_info_section = get_field('instructors_info_section','option');
        if(!empty($instructors_info_section)):
    ?>
        <section class="instructors-info-section section-padding-bottom">
            <?php
                $instructors = $instructors_info_section['instructors'];
            ?>
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <div class="instructors-info-section__instructors">
                            <div class="glide instructors-glide">
                                <div class="glide__track" data-glide-el="track">
                                    <ul class="glide__slides">
                                        <?php 
                                            foreach($instructors as $key => $instructor):
                                                $ins_image = $instructor['image'];
                                                $ins_name = $instructor['name'];
                                                $ins_desg = $instructor['designation'];
                                        ?>
                                            <li class="glide__slide">
                                                <div class="instructor-card">
                                                    <img src="<?php echo $ins_image?>" alt="" class="instructor-card__image no-lazy">
                                                    <h4 class="instructor-card__name"><?php echo $ins_name?></h4>
                                                    <span class="instructor-card__designation">
                                                        <?php echo $ins_desg?>
                                                    </span>
                                                </div>
                                            </li>
                                        <?php
                                            endforeach;
                                        ?>
                                    </ul>
                                </div>
                                <div class="glide__arrows" data-glide-el="controls">
                                    <a class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fa fa-angle-left"></i></a>
                                    <a class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    <?php
        endif
    ?>
    <!-- Instructors Info Section -->

    

</div>


<?php get_footer(); ?>