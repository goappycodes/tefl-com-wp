<?php

/**
 * Template Name: Testing-Banner
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<section class="hero-banner-section">
    <?php
        $banner_settings = get_field('banner_settings','option');
        $slider_transition_type = $banner_settings['slider_transition_type'];
        $slide_duration = $banner_settings['slide_duration'];
    ?>
    <div class="glide hero-slider-container">
        <div class="glide__track" data-glide-el="track" data-glide-interval="<?php echo empty($slide_duration)?6000:$slide_duration*1000?>">
            <div class="glide__slides glide__slides--<?php echo $slider_transition_type ?>">
                <?php
                    $hero_banner = get_field('hero_banner','option');
                    $banner_buttons = get_field('banner_buttons','options');
                    $btn_count = count($banner_buttons);
                    foreach($hero_banner as $key => $hb):
                        $banner_title = $hb['banner_content_heading'];
                        $banner_content = $hb['banner_content'];
                        $banner_bg = $hb['banner_background_image'];
                        $banner_bg_mobile = $hb['banner_background_image_mobile'];
                        $show_banner_buttons = $hb['show_banner_buttons'];
                        $banner_has_overlay = $hb['banner_has_overlay?'];
                        $show_banner_logo = $hb['show_banner_logo'];
                        if($show_banner_logo){
                            $banner_logo = $hb['banner_logo'];
                        }
                        $banner_link = $hb['banner_link'];
                        $is_promotional_banner = $hb['is_promotional_banner'];
                        if($is_promotional_banner){
                            $promo_banner_cta = $hb['promo_banner_cta'];
                        }
                ?>
                <div data-mobile-bg="<?php echo $banner_bg_mobile?>" class="<?php echo $banner_has_overlay?'has-overlay':''?> ast-container glide__slide glide__slide-<?php echo $key?>" style="background:url('<?php echo $banner_bg?>')">
                    <!-- <div class="ast-container">tewt -->
                    <?php if(!empty($banner_link) && !$is_promotional_banner):?>
                        <a href="<?php echo $banner_link?>" class="clickbox"></a>
                    <?php endif?>
                    <?php if(!$is_promotional_banner){ ?>
                        <div class="ast-row banner-content-row">
                            <div class="ast-col-md-8 banner-row__left">
                                <h2 class="hero-slide__title">
                                    <?php echo $banner_title?>
                                </h2>
                                <div class="hero-slide__content">
                                    <?php echo $banner_content?>
                                </div>
                            </div>
                            <div class="ast-col-md-4 banner-row__right">
                                <?php if($show_banner_logo):?>
                                    <img class="banner-logo" src="<?php echo $banner_logo?>" alt="">
                                <?php endif?>
                            </div>
                        </div>
                    <?php
                    }
                        else{
                    ?>
                    <div class="ast-row promotional-banner-content-row banner-content-row">
                            <div class="ast-col-md-4 promotional-banner-row__left banner-row__left">
                                <h2 class="hero-slide__title">
                                    <?php echo $banner_title?>
                                </h2>
                                <svg id="svg-circle-border" width="150" height="150" viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="45"></circle></svg>
                            </div>
                            <div class="ast-col-md-4 promotional-banner-row__right banner-row__right">
                                <?php echo $banner_content?>
                            </div>
                        </div>
                    <?php }?>
                    <?php if($show_banner_buttons && !$is_promotional_banner):?>
                        <div class="ast-row banner-cta-buttons-row">
                        <?php foreach($banner_buttons as $banner_btn):  
                            $button_text = $banner_btn['button_text'];
                            $button_link = $banner_btn['button_link'];
                        ?>
                            <div class="ast-col-md-<?php echo 12/$btn_count?> banner-cta-button-col">
                                <a href="<?php echo $button_link ?>" class="banner-cta-button">
                                    <span class="banner-cta-button__text"><?php echo $button_text ?></span>
                                    <span class="banner-cta-button__icon"><i class="fa fa-angle-right"></i></span>
                                </a>
                            </div>
                        <?php endforeach?>
                        </div>
                    <?php endif;?>
                    <?php 
                        if($is_promotional_banner):
                            $expiry_date = $promo_banner_cta['cta_timer_expiry_date'];
                            if(empty($expiry_date)){
                                $expiry_date = get_field('timer_expiry', 'option');
                            }
                            $expiry_date_unix = strtotime($expiry_date);
                            $promo_offer_end_date = date("l jS F", $expiry_date_unix);
                            $cta_title = $promo_banner_cta['cta_title'];
                            $cta_stitle = $promo_banner_cta['cta_subtitle'];
                            $cta_buttons = $promo_banner_cta['cta_buttons'];
                    ?>
                        <div class="ast-row promotional-banner-cta">
                            <div class="ast-col-md-4">
                                <div class="promotional-banner-cta__title">
                                    <h2 class="cta-title__main">
                                        <?php echo $cta_title?>
                                    </h2>
                                    <h2 class="cta-title__sub">
                                        <?php echo $cta_stitle?>
                                    </h2>
                                </div>
                            </div>
                            <div class="ast-col-md-4">
                                <div class="promotional-banner-cta__buttons">
                                    <?php 
                                        foreach($cta_buttons as $key => $cta_button):
                                            $btn_text = $cta_button['cta_button_text'];
                                            $btn_link = $cta_button['cta_button_link'];
                                    ?>
                                        <a href="<?php echo $btn_link?>" class="btn btn-<?php echo $key?>">
                                            <?php echo $btn_text?>
                                        </a>
                                    <?php endforeach?>
                                </div>
                            </div>
                            <div class="ast-col-md-4">
                                <div class="promotional-banner-cta__timer">
                                    <h4 class="promotional-banner-cta__timer-end">
                                        Offer Ends <?php echo $promo_offer_end_date?>
                                        </h4>
                                    <?php echo clockdown_function($expiry_date)?>
                                    <h4 class="promotional-banner-cta__timer-text">
                                        left to save
                                    </h4>
                                </div>
                            </div>
                        </div>
                    <?php endif?>
                    <!-- </div>tewt -->
                </div>
                <?php endforeach?>
            </div>
        </div>
        <div class="glide__bullets" data-glide-el="controls[nav]">
            <?php foreach($hero_banner as $key => $hb):;    
            ?>
                <button class="glide__bullet" data-glide-dir="=<?php echo $key?>"></button>
            <?php endforeach?>
        </div>
    </div>
    <div class="ast-row">
        <div class="ast-col-md-6"></div>
        <div class="ast-col-md-6">
            <?php echo do_shortcode('[brb_collection id="76302"]');?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
