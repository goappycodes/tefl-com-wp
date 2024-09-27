<?php

/**
 * Template Name: Gift Vouchers
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
<?php
    $hero_banner  = get_field('hero_banner');
    if(isset($hero_banner)):
?>
    <section class="hero-banner-section">
        <?php
            $banner_image = $hero_banner['image'];
            $banner_text  = $hero_banner['text'];
        ?>
        <div class="ast-container">
            <div class="ast-row">
                <div class="hero-banner-content" style="background:linear-gradient(90deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.25)), url('<?php echo $banner_image?>')">
                    <?php echo $banner_text?>
                </div>
            </div>
        </div>
    </section>
<?php
    endif;
?>
<?php
    $gift_vouchers = get_field('gift_vouchers');
    if( isset( $gift_vouchers ) && is_array( $gift_vouchers )):
?>
    <section class="vouchers-grid">
        <div class="ast-container">
            <div class="ast-row">
                <?php
                    foreach($gift_vouchers as $key => $gift_voucher):
                        $gift_voucher_title         = $gift_voucher['voucher_title'];
                        $gift_voucher_product_ID    = $gift_voucher['voucher_product'];
                        $gift_voucher_image         = get_the_post_thumbnail_url($gift_voucher_product_ID);
                        $gift_voucher_link          = get_the_permalink($gift_voucher_product_ID);
                        $gift_voucher_product_obj   = wc_get_product($gift_voucher_product_ID);
                        $gift_voucher_product_price = $gift_voucher_product_obj->get_price_html(); 
                        $has_free_voucher           = $gift_voucher['has_free_voucher'];
                        if($has_free_voucher){
                            $voucher_price      = $gift_voucher_product_obj->get_price();
                            $free_voucher_price = $voucher_price*.25; 
                        }
                ?>
                    <div class="ast-col-md-4">
                        <div class="gift-voucher-card <?php echo $has_free_voucher?'has-free-voucher':''?>">
                            <a href="<?php echo $gift_voucher_link ?>" class="clickbox"></a>
                            <?php if($has_free_voucher):?>
                                <span class="free-voucher-text">
                                    receive an extra <?php echo geo_price($free_voucher_price)?>
                                </span>
                            <?php endif?>
                            <div class="gift-voucher-card__image">
                                <img src="<?php echo $gift_voucher_image?>" alt="">
                            </div>
                            <div class="gift-voucher-card__body">
                                <h6 class="gift-voucher-card__title">
                                    <?php echo $gift_voucher_title?>
                                </h6>
                                <div class="gift-voucher-card__price ">
                                    <?php echo $gift_voucher_product_price?>
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
<?php
    endif;
?>

<?php get_footer(); ?>