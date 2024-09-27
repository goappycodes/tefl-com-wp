<?php

/**
 * Template Name: TEFL Coupon Codes
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}
get_header(); ?>

<div id="primary" <?php astra_primary_class();  ?>>
  
  <?php 
    $current_date = new DateTime();
    $page_header = get_field('page_header');
    if(!is_array_empty($page_header)):
      $page_title = $page_header['page_title'];
      $page_desc  = $page_header['page_description'];
  ?>
    <section class="page-header section-padding">
      <div class="ast-container">
        <div class="ast-row">
          <div class="ast-col-md-12">
            <h1 class="text-center font-600 page-header__title large-heading mb-1">
              <?php echo $page_title ?>
            </h1>
            <div class="text-center page-header__description">
              <?php echo $page_desc ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php
    endif;
  ?>

  <?php
    // $coupons_section = get_field('coupon_page_coupons','option');
    // $coupons = $coupons_section['coupons'];
    $coupons = get_field('coupons');
    $coupon_expiry_date = get_field('coupons_page_coupons_expiry_date','option');
    $used_coupon_codes = array();
    if(!empty($coupons)):
  ?>

      <section class="section-padding-bottom coupons-section">
        <div class="ast-container">
          <div class="ast-row">

            <?php foreach ($coupons as $coupon):
                $coupon_code = $coupon['coupon_code'];
                if (in_array($coupon_code, $used_coupon_codes)) {
                    continue;
                }
                $used_coupon_codes[] = $coupon_code;
                // $coupon_ID = wc_get_coupon_id_by_code($coupon_code);
                $coupon_desc = $coupon['tefl_course_type'];
                $coupon_icon = $coupon['coupon_icon'];
                $discount_percent = $coupon['tefl_discount'];
                // if ($coupon_ID && class_exists('WC_Coupon')) {
                //     $coupon_object = new WC_Coupon($coupon_ID);
                //     if ($coupon_object->get_id()) {
                //         $coupon_expiry_date = $coupon_object->get_date_expires();
                //     }
                // }
                if($coupon_expiry_date){
                  $date = new DateTime($coupon_expiry_date);
                  $formatted_expiry_date = $date->format('jS M Y');
                }
                $is_live_coupon = $coupon['is_live']; 
                if($coupon_code):
                ?>
                <div class="ast-col-md-12">
                    <div class="coupon-card <?php echo $is_live_coupon ? 'live-coupon' : 'expired-coupon' ?>">
                        <div class="coupon-card__content">
                            <div class="coupon-card__content-left">
                                <div class="coupon-amount">
                                    <span>Extra <?php echo $discount_percent.'%' ?></span>
                                    <span>OFF</span>   
                                </div>
                                <div class="coupon-description">
                                    <span>Coupon Code:</span>
                                    <span class="coupon-description__title"><?php echo $coupon_desc ?></span>
                                    <?php if ($is_live_coupon && $coupon_expiry_date): ?>
                                        <span class="coupon-description__expiry">Valid until <?php echo $formatted_expiry_date ?></span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="coupon-card__content-right">
                                <div class="coupon-icon">
                                    <img class="no-lazy" src="<?php echo $coupon_icon ?>" alt="Coupon Icon">
                                </div>
                                <?php if($is_live_coupon):?>
                                  <button class="reveal-code-button">
                                    See Code
                                    <span class="reveal" data-coupon-code="<?php echo $coupon_code ?>" title="Click to copy">
                                    <i class="fa-regular fa-copy"></i>
                                    <?php echo $coupon_code?>
                                    </span>
                                  </button>
                                <?php else:?>
                                  <button class="expired-code-button">
                                    code expired
                                  </button>
                                <?php endif?>
                            </div>
                        </div>
                        <div class="coupon-card__footer">
                          <a href="/terms-and-conditions" class="view-terms">view terms</a>
                        </div>
                    </div>
                </div>
                <?php endif?>
            <?php endforeach; ?>
          <div id="copy-popup" class="copy-popup">Coupon code <strong></strong> copied to clipboard!</div>
          </div>
        </div>
      </section>

  <?php
    endif;
  ?>
</div>

<?php get_footer(); ?>