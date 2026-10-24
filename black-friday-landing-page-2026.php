<?php

/**
 * Template Name: Black Friday Landing Page 2026
 *
 * Content and images are editable from the page edit screen via the
 * "Black Friday 2026 — Hero" ACF field group (registered in
 * includes/black-friday-2026.php). Every field falls back to bf26_defaults().
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

get_header();

$bf26_img = bf26_hero_image();
?>

<div id="primary" <?php astra_primary_class(); ?>>

  <div class="bf26">

    <!-- ===================== HERO ===================== -->
    <section class="bf26-hero bf26-fullbleed">
      <div class="bf26-hero__inner">

        <!-- Copy column -->
        <div class="bf26-hero__copy">

          <!-- Departures board -->
          <div class="bf26-board">
            <div class="bf26-board__top">
              <span class="bf26-board__status"><span class="bf26-dot"></span><?php bf26_e('hero_board_status'); ?></span>
              <span class="bf26-board__gate"><?php bf26_e('hero_board_gate'); ?></span>
            </div>
            <div class="bf26-board__flaps">
              <?php
              $board_text = bf26_get('hero_board_text');
              $words = preg_split('/\s+/', trim($board_text));
              $i = 0;
              foreach ($words as $word) {
                if ('' === $word) { continue; }
                echo '<span class="bf26-flapword">';
                $chars = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($chars as $ch) {
                  $delay = number_format($i * 0.08, 2, '.', '');
                  echo '<span class="bf26-flap" style="animation-delay:' . $delay . 's">' . esc_html($ch) . '<i></i></span>';
                  $i++;
                }
                echo '</span>';
              }
              ?>
            </div>
          </div>

          <!-- Headline -->
          <h1 class="bf26-hero__title">
            <span class="bf26-hero__title-thin"><?php bf26_e('hero_title_line1'); ?></span>
            <span class="bf26-hero__title-bold"><?php bf26_e('hero_title_line2'); ?></span>
          </h1>

          <div class="bf26-hero__off">
            <span class="bf26-hero__off-pre"><?php echo nl2br(esc_html(bf26_get('hero_off_pre'))); ?></span>
            <span class="bf26-hero__off-big"><?php bf26_e('hero_off_big'); ?></span>
            <span class="bf26-hero__off-post"><?php bf26_e('hero_off_post'); ?></span>
          </div>

          <div class="bf26-hero__rule"></div>

          <p class="bf26-hero__lead"><?php echo wp_kses_post(bf26_get('hero_lead')); ?></p>

          <!-- Free gifts pill -->
          <a class="bf26-giftpill" href="<?php echo esc_url(bf26_get('hero_gift_link')); ?>">
            <span class="bf26-giftpill__ic"><?php echo bf26_icon('gift', 22, '#fff'); ?></span>
            <span class="bf26-giftpill__txt">
              <strong><?php bf26_e('hero_gift_title'); ?></strong>
              <span><?php bf26_e('hero_gift_subtitle'); ?></span>
            </span>
            <span class="bf26-giftpill__arrow">&darr;</span>
          </a>

          <!-- CTAs -->
          <div class="bf26-hero__cta">
            <a class="bf26-btn bf26-btn--primary" href="<?php echo esc_url(bf26_get('hero_cta_primary_url')); ?>"><?php bf26_e('hero_cta_primary_label'); ?> &rarr;</a>
            <a class="bf26-btn bf26-btn--ghost" href="<?php echo esc_url(bf26_get('hero_cta_secondary_url')); ?>"><?php bf26_e('hero_cta_secondary_label'); ?></a>
          </div>

        </div>

        <!-- Art column -->
        <div class="bf26-hero__art">
          <svg class="bf26-hero__pin" viewBox="0 0 680 640" aria-hidden="true">
            <path d="M450 610 C 370 500, 260 420, 260 270 A 190 190 0 1 1 640 270 C 640 420, 530 500, 450 610 Z" fill="#D7263D"></path>
            <circle cx="450" cy="270" r="88" fill="#0A0A0A"></circle>

            <g transform="translate(40,40)">
              <g class="bf26-cloud" style="animation-duration:10s;animation-delay:0s" stroke="#3A3A3A" stroke-width="3" stroke-linecap="round">
                <line x1="22" y1="0" x2="58" y2="0"></line>
                <line x1="10" y1="9" x2="76" y2="9"></line>
                <line x1="0" y1="18" x2="96" y2="18"></line>
                <line x1="14" y1="27" x2="84" y2="27"></line>
              </g>
            </g>
            <g transform="translate(560,40)">
              <g class="bf26-cloud" style="animation-duration:9s;animation-delay:1s" stroke="#3A3A3A" stroke-width="3" stroke-linecap="round">
                <line x1="22" y1="0" x2="58" y2="0"></line>
                <line x1="10" y1="9" x2="76" y2="9"></line>
                <line x1="0" y1="18" x2="96" y2="18"></line>
                <line x1="14" y1="27" x2="84" y2="27"></line>
              </g>
            </g>
            <g transform="translate(10,300)">
              <g class="bf26-cloud" style="animation-duration:11s;animation-delay:0.5s" stroke="#3A3A3A" stroke-width="3" stroke-linecap="round">
                <line x1="22" y1="0" x2="58" y2="0"></line>
                <line x1="10" y1="9" x2="76" y2="9"></line>
                <line x1="0" y1="18" x2="96" y2="18"></line>
                <line x1="14" y1="27" x2="84" y2="27"></line>
              </g>
            </g>

            <path id="bf26flight" class="bf26-flight" d="M 40 120 C 140 20, 360 10, 520 60 S 690 220, 650 360 S 560 600, 380 610 S 40 560, 30 400 S 0 200, 40 120" fill="none" stroke="#E3B341" stroke-width="2.5" stroke-dasharray="7 10" stroke-linecap="round"></path>

            <g>
              <circle r="26" fill="#E3B341"></circle>
              <g transform="rotate(45) translate(-14,-14) scale(1.17)" fill="none" stroke="#0A0A0A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"></path>
              </g>
              <animateMotion dur="18s" repeatCount="indefinite" rotate="auto"><mpath href="#bf26flight"></mpath></animateMotion>
            </g>
          </svg>

          <img class="bf26-hero__photo" src="<?php echo esc_url($bf26_img['url']); ?>" alt="<?php echo esc_attr($bf26_img['alt']); ?>">

          <?php
          $floats = bf26_rows('hero_floats');
          $pos = 1;
          foreach ($floats as $f) {
            if ($pos > 3) { break; }
            $icon  = isset($f['icon']) && $f['icon'] ? $f['icon'] : 'globe';
            $label = isset($f['label']) ? $f['label'] : '';
            echo '<div class="bf26-float bf26-float--p' . $pos . '">';
            echo '<span class="bf26-float__ic">' . bf26_icon($icon, 18, '#111111') . '</span>';
            echo '<span>' . esc_html($label) . '</span>';
            echo '</div>';
            $pos++;
          }
          ?>

          <div class="bf26-badge82">
            <span class="bf26-badge82__pre"><?php bf26_e('hero_badge_pre'); ?></span>
            <span class="bf26-badge82__num"><?php bf26_e('hero_badge_num'); ?></span>
            <span class="bf26-badge82__post"><?php bf26_e('hero_badge_post'); ?></span>
          </div>

          <div class="bf26-bundlechip">
            <span class="bf26-bundlechip__label"><?php bf26_e('hero_bundle_label'); ?></span>
            <span class="bf26-bundlechip__price"><strong><?php bf26_e('hero_bundle_price'); ?></strong><span class="bf26-bundlechip__was"><?php bf26_e('hero_bundle_was'); ?></span></span>
          </div>
        </div>

      </div>
    </section>
    <!-- =================== END HERO =================== -->

    <!-- ============== ACCREDITED & REGULATED ============== -->
    <section class="bf26-accred bf26-fullbleed">
      <div class="bf26-accred__inner">
        <span class="bf26-accred__label"><?php bf26_e('accred_label'); ?></span>
        <div class="bf26-accred__list">
          <?php foreach (bf26_rows('accred_items') as $a) :
            $name = isset($a['name']) ? $a['name'] : '';
            $sub  = isset($a['sub']) ? $a['sub'] : '';
            if ('' === $name && '' === $sub) { continue; }
          ?>
            <div class="bf26-accred__item">
              <span class="bf26-accred__name"><?php echo esc_html($name); ?></span>
              <span class="bf26-accred__sub"><?php echo esc_html($sub); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <!-- ============ END ACCREDITED & REGULATED ============ -->

  </div>

</div>

<?php get_footer(); ?>
