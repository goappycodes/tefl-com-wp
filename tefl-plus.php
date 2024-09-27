<?php

/**
 * Template Name: TEFL Plus Landing Page
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram Rana <bikram@appycodes.com>
 * @date August 2024
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
            $banner_logo = $hero_banner['banner_logo'];
            $banner_content = $hero_banner['banner_content'];
            $banner_content_icon = $banner_content['content_icon'];
            $banner_content_title = $banner_content['title'];
            $product_id = $banner_content['product'];
            $product_info = $banner_content['product_info'];
            $product_obj = wc_get_product($product_id);
            if ($product_obj){ 
                $product_price = $product_obj->get_price_html();
                $full_price = $product_obj->get_price();
                $simple_regular_price = $product_obj->get_regular_price();
                $simple_sale_price = $product_obj->get_sale_price();
                if (is_numeric($simple_regular_price) && is_numeric($simple_sale_price) && $simple_regular_price != 0) {
                    $save_percentage = round((($simple_regular_price - $simple_sale_price) / $simple_regular_price) * 100);
                }
            }
    ?>
        <section class="section-padding hero-banner-section" style="background-image:url('<?php echo $banner_image?>')">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-6">
                        <div class="hero-banner-content">
                            <h1 class="banner-content__title large-heading">
                                <?php echo $banner_content_title?>
                            </h1>
                            <div class="hero-banner-content__body">
                                <div class="hero-banner-content__left">
                                    <img src="<?php echo $banner_content_icon ?>" alt="">
                                </div>
                                <div class="hero-banner-content__right">
                                    <div class="product-price">
                                        <?php echo $product_price?>
                                        <div class="savings"><?php echo 'Save '.$save_percentage.'%'?></div>
                                    </div>
                                    <div class="product-summary">
                                        <?php echo $product_info?>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo site_url();?>/cart/?addtimetocart&prid=<?php echo $product_id; ?>" class="btn btn-primary-blue btn-centered">
                                add to cart
                            </a>
                        </div>
                    </div>
                    <div class="ast-col-md-6">
                        <?php
                            if(!empty($banner_logo)):
                        ?>
                        <div class="banner-logo-container">
                            <img src="<?php echo $banner_logo ?>" class="banner-slide__content-logo" alt="">
                        </div>
                        <?php 
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
        endif;
    ?>

    <section class="main-section section-padding">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-7">
                    <?php
                        $features_section = get_field('features_section');
                        if(!is_array_empty($features_section)):
                            $section_title = $features_section['section_title'];
                            $features = $features_section['features'];
                    ?>
                        <div class="features">
                            <h2 class="large-heading uppercase font-600 feature-section-heading">
                                <?php echo $section_title?>
                            </h2>
                            <?php
                                foreach($features as $key => $feature):
                                    $feature_icon = $feature['icon'];
                                    $feature_title = $feature['title'];
                                    $feature_desc = $feature['descrption'];
                            ?>
                                <div class="feature">
                                    <h5 class="feature-title font-700">
                                        <?php echo $key+1 . '. ' . $feature_title ?>
                                    </h5>
                                    <div class="feature-body">
                                        <div class="feature-body__icon">
                                            <img src="<?php echo $feature_icon?>" alt="">
                                        </div>
                                        <div class="feature-body__description">
                                            <?php echo $feature_desc?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                endforeach;
                            ?>
                        </div>
                    <?php
                        endif;
                    ?>
                </div>
                <div class="ast-col-md-5">
                    <?php
                        $whats_included_section = get_field('whats_included_section');
                        if(!is_array_empty($whats_included_section)):
                            $section_title = $whats_included_section['section_title'];
                            $section_content = $whats_included_section['content'];
                    ?>
                        <div class="whats-included">
                            <h2 class="large-heading uppercase font-600 whats-included-heading">
                                <?php echo $section_title?>
                            </h2>
                            <div class="whats-included-content">
                                <?php echo $section_content?>
                            </div>
                            <div class="product-price text-center">
                                <?php echo $product_price?>
                                <div class="savings"><?php echo 'Save '.$save_percentage.'%'?></div>
                            </div>
                            <a href="<?php echo site_url();?>/cart/?addtimetocart&prid=<?php echo $product_id; ?>" class="btn btn-red btn-centered">
                                add to cart
                            </a>
                        </div>
                    <?php
                        endif;
                    ?>
                    <?php
                        $cta_boxes = get_field('cta_boxes');
                        if(!is_array_empty($cta_boxes)):
                    ?>
                        <div class="cta-boxes">
                            <?php
                                foreach($cta_boxes as $key => $cta_box):
                                    $cta_image = $cta_box['cta_image'];
                                    $cta_title = $cta_box['cta_title'];
                                    $cta_desc = $cta_box['cta_description'];
                                    $cta_button_text = $cta_box['cta_button_text'];
                                    $cta_button_link = $cta_box['cta_button_link'];
                            ?>
                                <div class="cta-box">
                                    <div class="cta-box__left">
                                        <img src="<?php echo $cta_image?>" class="cta-image" alt="">
                                    </div>
                                    <div class="cta-box__right">
                                        <h5 class="cta-title"><?php echo $cta_title?></h5>
                                        <div class="cta-desc"><?php echo $cta_desc?></div>
                                        <a href="<?php echo $cta_button_link?>" target="_blank" class="btn btn-small btn-primary-blue btn-centered cta-btn">
                                            <?php echo $cta_button_text?>
                                        </a>
                                    </div>
                                </div>
                            <?php
                                endforeach;
                            ?>
                        </div>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </section>
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
    <section class="icon-banner-section section-padding-bottom">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12 logo-container">
                    <div class="logo-group">
                        <?php
                        $first_gallery = get_field('first_gallery', 'options');
                        if ($first_gallery) : ?>
                            <?php foreach ($first_gallery as $image) : ?>
                                <div class="image"><img src="<?php echo $image; ?>"></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="logo-group">
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
</div>

<?php get_footer(); ?>