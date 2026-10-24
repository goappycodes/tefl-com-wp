<?php

/**
 * Template Name: Job Hunter's Pack & Recruit Me Kit
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram Rana <bikram@appycodes.com>
 * @date March 2025
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
            $banner_bg_image = $hero_banner['banner_bg_image'];
            $banner_content = $hero_banner['banner_content'];
            $title = $banner_content['title'];
            $summary = $banner_content['summary'];
    ?>
    <section class="hero-banner section-padding" style="background: url('<?php echo $banner_bg_image?>')">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-5">
                    <div class="hero-banner__content">
                        <h1 class="hero-banner__content-title large-heading">
                            <?php echo $title?>
                        </h1>
                        <div class="hero-banner__content-title-body">
                            <?php echo $summary?>
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
        $resources_cta_section = get_field('resources_cta_section');
        if(!is_array_empty($resources_cta_section)):
            $section_title = $resources_cta_section['section_title'];
            $resources_cta = $resources_cta_section['resources_cta'];
    ?>

        <section class="section-padding-top resources-cta-section">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="text-center large-heading resources-cta-scetion__heading">
                            <?php echo $section_title; ?>
                        </h2>
                    </div>
                </div>
                <div class="ast-row cta-card-row">
                    <?php
                        foreach($resources_cta as $key => $rcta):
                            $title = $rcta['title'];
                            $image = $rcta['image'];
                            $summary = $rcta['summary'];
                            $link = $rcta['link'];
                    ?>
                        <div class="ast-col-md-4">
                            <div class="resources-cta-card">
                                <h2 class="large-heading text-center font-500 resources-cta-card__title">
                                    <?php echo $title; ?>
                                </h2>
                                <div class="resources-cta__image">
                                    <img src="<?php echo $image?>" alt="<?php echo esc_html($title); ?>">
                                </div>
                                <div class="resource-cta__summary text-center">
                                    <?php echo $summary?>
                                </div>
                                <a target="_blank" href="<?php echo $link?>" class="btn btn-primary resources-cta-btn btn-centered">
                                    Download
                                </a>
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

    <?php
        $cta_banner = get_field('cta_banner');
        if(false):
            $title = $cta_banner['title'];
            $image = $cta_banner['image'];
            $stitle = $cta_banner['subtitle'];
            $cta_link = $cta_banner['cta_link'];
            $cta_text = $cta_banner['cta_text'];
    ?>

        <section class="cta-banner-section">
            <div class="ast-container">
                <div class="cta-banner-section_row">
                    <div class="cta-banner__image">
                        <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
                    </div>
                    <div class="cta-banner__content text-center">
                        <h2 class="large-heading cta-banner__title">
                            <?php echo $title?>
                        </h2>
                        <div class="cta-banner__subtitle">
                            <?php echo $stitle?>
                        </div>
                    </div>
                    <div class="cta-banner-btn">
                        <a href="<?php echo $cta_link?>" target="_blank" class="btn btn-primary btn-centered">
                            <?php echo $cta_text?>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>

    <?php
        $jobs_section = get_field('jobs_section');
        if(!is_array_empty($jobs_section)):
            $section_title = $jobs_section['section_title'];
            $section_stitle = $jobs_section['section_summary'];
            $jobs = $jobs_section['jobs'];
    ?>
        <section class="jobs-section section-padding-top">
            <div class="ast-container">
                <div class="ast-row ast-flex ast-align-items-center">
                    <div class="ast-col-md-8">
                        <div class="header-wrapper">
                            <h2 class="large-heading double-underline common-section-heading jobs-section__title">
                                <?php echo $section_title?>
                                <a href="https://jobs.teflinstitute.com/?ref=com" 
                                   target = "_blank"
                                   class = "jobs-link"
                                   style="--btn-text-color:#fff; --btn-bg-color:#1c1c1b"
                                >
                                    <svg width="20" height="20" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="8.5" cy="8.5" r="8" stroke="white"></circle>
                                        <path d="M5 8.5H11.5" stroke="white" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M9.5 11L12 8.5L9.5 6" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </h2>
                            
                        </div>
                        <span class="jobs-section__subtitle common-subheading">
                            <?php echo $section_stitle?>
                        </span>
                       
                    </div>
                    <div class="ast-col-md-4">
                        <div class="pdf-download-area ">
                            <h3>Comparative employment guide for TEFL teachers</h3>
                            <a target="_blank" href = "/wp-content/uploads/2024/07/TEFL-Insitute-Job-Comparison-Guide.pdf" class="btn btn-primary btn-centered">Download your copy</a>
                        </div>
                    </div>
                </div>
                <div class="jobs-slider ast-flex">
                    <?php
                        foreach($jobs as $key => $job):
                            $hero_image = $job['featured_image'];
                            $job_location = $job['job_location'];
                            $job_title = $job['job_title'];
                            $posted_on = $job['posted'];
                            $salary_text = $job['salary_text'];
                            $job_link = $job['job_link'];
                    ?>
                        <div class="slide-item">
                            <div class="job-card">
                                <div class="job-card__header">
                                    <img src="<?php echo $hero_image?>" class="no-lazy" alt="">
                                    <span><?php echo $job_location?></span>
                                </div>
                                <div class="job-card__body">
                                    <h6 class="job-title"><?php echo truncate_string($job_title,6) ?></h6>
                                    <span class="job-posted d-none">Posted: <?php echo $posted_on?> hours ago</span>
                                    <span class="job-salary"><?php echo $salary_text?></span>
                                </div>
                                <div class="job-card__link">
                                    <a href="<?php echo $job_link?>" target = "_blank">
                                        <span>View Job</span>
                                        <i class="fa fa-arrow-right"></i>
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
    <?php 
        endif;
    ?>

    <section class="partner-logos-section section-padding-top">
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

    <!-- FAQS Section -->
    <section class="faqs-section faqs-section-redesigned section-padding-top">
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
                    <h2 class="large-heading common-section-heading double-underline">Question? get in touch</h2>
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
     
    

</div>

<?php get_footer(); ?>