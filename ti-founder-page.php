<?php

/**
 * Template Name: TEFL Institute Founder Page
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram Rana <bikram@appycodes.com>
 * @date April 2026
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();
?>

<div id="primary" <?php astra_primary_class(); ?>>

    <?php
        $hero_section = get_field('hero_section');
        if ($hero_section) :
            $section_title = $hero_section['section_title'];
            $section_description = $hero_section['section_summary'];
            $section_image = $hero_section['section_bg_image'];
    ?>

    <section class="hero-section" style="background-image: url('<?php echo esc_url($section_image); ?>');">
        <div class="ast-container">
            <div class="ast-row ast-flex">
                <div class="ast-col-md-6 ">
                    <div class="hero-section-content">
                        <h1 class="hero-title">
                            <?php echo $section_title; ?>
                        </h1>
                        <div class="hero-description">
                            <?php echo $section_description; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        endif;
    ?>

    <section class="intro-section">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-6">
                    <?php
                        $about_section = get_field('about_section');
                        if(!empty($about_section)):
                            $section_title = $about_section['section_title'];
                            $section_summary = $about_section['section_summary'];
                    ?>
                    <div class="intro-section-left about-column">
                        <h2 class="section-title">
                            <?php echo $section_title; ?>
                        </h2>
                        <div class="section-summary">
                            <?php echo $section_summary; ?>
                        </div>
                    </div>
                    <?php
                        endif;
                    ?>
                </div>
                <div class="ast-col-md-6">
                    <div class="into-section-right story-column">
                        <?php
                        $story_section = get_field('story_section');
                        if(!empty($story_section)):
                            $section_title = $story_section['section_title'];
                            $section_summary = $story_section['section_summary'];
                        ?>
                        <div class="intro-section-left about-column">
                            <h2 class="section-title">
                                <?php echo $section_title; ?>
                            </h2>
                            <div class="section-summary">
                                <?php echo $section_summary; ?>
                            </div>
                        </div>
                        <?php
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        $feature_section = get_field('feature_section');
        if(!empty($feature_section)):
            $section_title = $feature_section['section_title'];
            $features = $feature_section['features'];
    ?>

    <section class="feature-section">
        <div class="ast-container">
            <div class="ast-row">
                <h2 class="section-title-large">
                    <?php echo $section_title; ?>
                </h2>
                <div class="feature-row">
                    <?php
                        foreach($features as $key => $feature):
                            $icon = $feature['icon'];
                            $title = $feature['title'];
                            $subtitle = $feature['subtitle'];
                    ?>
                    <div class="ast-col-md-4">
                        <div class="feature-col">
                            <div class="feature-icon">
                                <img src="<?php echo $icon; ?>" alt="">
                            </div>
                            <h3 class="feature-title"><?php echo $title; ?></h3>
                            <p class="feature-subtitle"><?php echo $subtitle; ?></p>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php
        endif;
    ?>

    <?php
        $quotes_section = get_field('quotes_section');
        if(!empty($quotes_section)):
            $quote_text = $quotes_section['quote_text'];
            $quote_author = $quotes_section['quote_author'];
    ?>

        <section class="quotes-section">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <div class="quote-area">
                            <img src="/wp-content/uploads/2026/04/quote-open.svg" class="quote-open" alt="quote-open">
                            <div class="quote-text">
                                <?php echo $quote_text; ?>
                            </div>
                            <div class="quote-author">
                                <?php echo $quote_author; ?>
                            </div>
                            <img src="/wp-content/uploads/2026/04/quote-close.svg" class="quote-close" alt="quote-close">
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>

    <?php
        $milestones = get_field('milestones');
        if(!empty($milestones)):
    ?>

        <section class="milestones">
            <div class="ast-container">
                <div class="ast-row">
                    <?php
                        foreach($milestones as $key => $milestone):
                            $icon = $milestone['icon'];
                            $title = $milestone['title'];
                            $subtitle = $milestone['subtitle'];
                    ?>
                        <div class="ast-col-md-3">
                            <div class="milestone">
                                <img src="<?php echo $icon; ?>" alt="" class="milestone-icon">
                                <span class="milestone-title"><?php echo $title; ?></span>
                                <span class="milestone-subtitle"><?php echo $subtitle; ?></span>
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
        $info_section = get_field('info_section');
        if(!empty($info_section)):
            $section_image = $info_section['section_image'];
            $section_details = $info_section['section_details'];
    ?>
        <section class="info-section">
            <div class="ast-container">
                <div class="ast-row ast-flex ast-align-items-center">
                    <div class="ast-col-md-6">
                        <div class="info-section-image">
                            <img src="<?php echo $section_image; ?>" alt="">
                        </div>
                    </div>
                    <div class="ast-col-md-6">
                        <div class="info-section-details">
                            <?php
                                foreach($section_details as $key => $detail):
                            ?>
                                <div class="info-block">
                                    <h2 class="section-title">
                                        <?php echo $detail['title']; ?>
                                    </h2>
                                    <div class="section-summary">
                                        <?php echo $detail['summary']; ?>
                                    </div>
                                </div>
                            <?php
                                endforeach;
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
        $social_section = get_field('social_section');
        if(!empty($social_section)):
            $section_title = $social_section['section_title'];
            $social_links = $social_section['social_links'];
    ?>
        <section class="social-section">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="section-title">
                            <?php
                                echo $section_title;
                            ?>
                        </h2>
                        <div class="social-links">
                            <?php
                                foreach($social_links as $link):
                            ?>
                            <a target="_blank" href="<?php echo $link['link'];?>" class="social-link">
                                <img src="<?php echo $link['icon']; ?>" alt="" >
                            </a>
                            <?php
                                endforeach;
                            ?>
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