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

    <!-- ================== SALE COUNTDOWN ================== -->
    <?php if ( bf26_sale_show() ) : ?>
    <section class="bf26-countdown bf26-fullbleed">
      <div class="bf26-countdown__inner" data-sale-end="<?php echo esc_attr( bf26_sale_end_iso() ); ?>">
        <div class="bf26-countdown__head">
          <span class="bf26-countdown__label"><?php bf26_e('sale_label'); ?></span>
          <span class="bf26-countdown__note"><?php bf26_e('sale_end_note'); ?></span>
        </div>
        <div class="bf26-countdown__clock">
          <div class="bf26-ct"><div class="bf26-ct__num" data-ct="days">00</div><div class="bf26-ct__lbl">DAYS</div></div>
          <div class="bf26-ct"><div class="bf26-ct__num" data-ct="hrs">00</div><div class="bf26-ct__lbl">HRS</div></div>
          <div class="bf26-ct"><div class="bf26-ct__num" data-ct="mins">00</div><div class="bf26-ct__lbl">MIN</div></div>
          <div class="bf26-ct bf26-ct--sec"><div class="bf26-ct__num" data-ct="secs">00</div><div class="bf26-ct__lbl">SEC</div></div>
        </div>
        <span class="bf26-countdown__places"><strong><?php bf26_e('sale_places_strong'); ?></strong> <?php bf26_e('sale_places_text'); ?></span>
      </div>
    </section>
    <?php endif; ?>
    <!-- ================ END SALE COUNTDOWN ================ -->

    <!-- ===================== COURSE CARDS ===================== -->
    <?php $bf26_worldmap = get_stylesheet_directory_uri() . '/assets/img/black-friday-2026/world-map-dotted-plane.png'; ?>
    <section class="bf26-courses bf26-fullbleed">
      <img class="bf26-courses__bg" src="<?php echo esc_url( $bf26_worldmap ); ?>" alt="" aria-hidden="true">
      <div class="bf26-courses__inner">
        <div class="bf26-courses__head">
          <div>
            <div class="bf26-courses__eyebrow"><?php bf26_e('course_eyebrow'); ?></div>
            <h2 class="bf26-courses__title"><?php bf26_e('course_title_pre'); ?><strong><?php bf26_e('course_title_em'); ?></strong><?php bf26_e('course_title_post'); ?></h2>
          </div>
          <span class="bf26-courses__note"><?php bf26_e('course_note'); ?></span>
        </div>

        <div class="bf26-courses__grid">
          <?php
          $bf26_ci = 0;
          foreach ( bf26_rows('course_cards') as $c ) :
            $variant = ( isset($c['variant']) && 'bundle' === $c['variant'] ) ? 'bundle' : 'standard';
            $pr      = bf26_card_pricing( $c );
            $img     = bf26_card_image( $c );
            $strike_delay = 0.8 + $bf26_ci * 0.1;
          ?>
          <div class="bf26-card bf26-card--<?php echo esc_attr($variant); ?>" style="--d:<?php echo ($bf26_ci * 0.1); ?>s">
            <?php if ( ! empty($pr['save']) ) : ?>
              <div class="bf26-card__save"><span>SAVE</span><strong><?php echo esc_html($pr['save']); ?></strong></div>
            <?php endif; ?>
            <div class="bf26-card__media">
              <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr( isset($c['title']) ? $c['title'] : '' ); ?>">
            </div>
            <?php if ( ! empty($c['category']) ) : ?>
              <div class="bf26-card__cat">
                <span class="bf26-card__cat-ic"><?php echo bf26_icon( isset($c['cat_icon']) ? $c['cat_icon'] : 'book-open', 14 ); ?></span>
                <?php echo esc_html($c['category']); ?>
              </div>
            <?php endif; ?>
            <div class="bf26-card__body">
              <div class="bf26-card__title"><?php echo esc_html( isset($c['title']) ? $c['title'] : '' ); ?></div>
              <div class="bf26-card__price">
                <span class="bf26-card__price-now"><?php echo wp_kses_post($pr['price']); ?></span>
                <?php if ( ! empty($pr['was']) ) : ?>
                  <span class="bf26-card__price-was"><?php echo wp_kses_post($pr['was']); ?><span class="bf26-card__strike" style="animation-delay:<?php echo $strike_delay; ?>s"></span></span>
                <?php endif; ?>
              </div>
              <?php if ( ! empty($c['klarna']) ) : ?>
                <div class="bf26-card__klarna"><span class="bf26-card__klarna-badge">Klarna</span>Pay in 2 interest-free</div>
              <?php endif; ?>
              <div class="bf26-card__divider"></div>
              <ul class="bf26-card__features">
                <?php foreach ( ( isset($c['features']) && is_array($c['features']) ? $c['features'] : array() ) as $f ) : ?>
                  <li>
                    <span class="bf26-card__feat-ic"><?php echo bf26_icon( isset($f['icon']) ? $f['icon'] : 'book-open', 13 ); ?></span>
                    <span><?php echo esc_html( isset($f['text']) ? $f['text'] : '' ); ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
              <div class="bf26-card__cta">
                <?php $cta = bf26_card_cta( $c ); ?>
                <a href="<?php echo esc_url( $cta['url'] ); ?>" class="bf26-btn <?php echo 'bundle' === $variant ? 'bf26-btn--dark' : 'bf26-btn--primary'; ?> bf26-btn--block"><?php echo esc_html( $cta['label'] ); ?></a>
              </div>
            </div>
          </div>
          <?php $bf26_ci++; endforeach; ?>
        </div>

        <div class="bf26-courses__free">
          <span class="bf26-courses__free-title"><?php bf26_e('course_free_title_pre'); ?><strong><?php bf26_e('course_free_title_em'); ?></strong></span>
          <div class="bf26-courses__free-grid">
            <?php foreach ( bf26_rows('course_free_tiles') as $t ) : ?>
              <a href="<?php echo esc_url( isset($t['url']) ? $t['url'] : '#' ); ?>" class="bf26-freetile">
                <span class="bf26-freetile__ic"><?php echo bf26_icon( isset($t['icon']) ? $t['icon'] : 'book-open', 22, '#E3B341' ); ?></span>
                <span class="bf26-freetile__label"><?php echo esc_html( isset($t['label']) ? $t['label'] : '' ); ?></span>
                <span class="bf26-freetile__arrow">&rarr;</span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>
    <!-- =================== END COURSE CARDS =================== -->

    <!-- ===================== FREE GIFTS ===================== -->
    <section id="free-gifts" class="bf26-gifts bf26-fullbleed">
      <img class="bf26-gifts__bg" src="<?php echo esc_url( $bf26_worldmap ); ?>" alt="" aria-hidden="true">
      <div class="bf26-gifts__inner">
        <div class="bf26-gifts__head">
          <div class="bf26-gifts__intro">
            <div class="bf26-board">
              <div class="bf26-board__top">
                <span class="bf26-board__status"><span class="bf26-dot"></span><?php bf26_e('gifts_board_status'); ?></span>
                <span class="bf26-board__gate"><?php bf26_e('gifts_board_gate'); ?></span>
              </div>
              <div class="bf26-board__flaps">
                <?php
                $gwords = preg_split('/\s+/', trim( bf26_get('gifts_board_text') ));
                foreach ( $gwords as $gw ) {
                  if ( '' === $gw ) { continue; }
                  echo '<span class="bf26-flapword">';
                  foreach ( preg_split('//u', $gw, -1, PREG_SPLIT_NO_EMPTY) as $gc ) {
                    echo '<span class="bf26-flap">' . esc_html($gc) . '<i></i></span>';
                  }
                  echo '</span>';
                }
                ?>
              </div>
            </div>
            <h2 class="bf26-gifts__title"><?php bf26_e('gifts_title_pre'); ?><strong><?php bf26_e('gifts_title_em'); ?></strong></h2>
            <p class="bf26-gifts__lead"><?php bf26_e('gifts_intro'); ?></p>
          </div>
          <div class="bf26-gifts__progress">
            <div class="bf26-gifts__progress-top">
              <span><?php bf26_e('gifts_opened_label'); ?></span>
              <span class="bf26-gifts__count"><span data-gift-count>0</span> / <?php echo count( bf26_rows('gifts') ); ?></span>
            </div>
            <div class="bf26-gifts__bar"><div class="bf26-gifts__bar-fill" data-gift-bar></div></div>
            <div class="bf26-gifts__actions">
              <button type="button" class="bf26-gifts__btn bf26-gifts__btn--all" data-gift-openall><?php bf26_e('gifts_open_all'); ?></button>
              <button type="button" class="bf26-gifts__btn bf26-gifts__btn--rewrap" data-gift-rewrap><?php bf26_e('gifts_rewrap'); ?></button>
            </div>
          </div>
        </div>

        <div class="bf26-gifts__grid" data-gift-grid>
          <?php
          $bf26_gi = 0;
          foreach ( bf26_rows('gifts') as $g ) :
            $gnum  = str_pad( $bf26_gi + 1, 2, '0', STR_PAD_LEFT );
            $gimg  = isset($g['image']) ? $g['image'] : '';
            if ( is_array($gimg) ) { $gimg = isset($gimg['url']) ? $gimg['url'] : ''; }
            $gc1   = isset($g['c1']) ? $g['c1'] : '#D7263D';
            $gc2   = isset($g['c2']) ? $g['c2'] : '#8E1626';
            $gname = isset($g['name']) ? $g['name'] : '';
          ?>
          <button type="button" class="bf26-gift" data-gift aria-label="Open gift <?php echo $bf26_gi + 1; ?>" style="--c1:<?php echo esc_attr($gc1); ?>;--c2:<?php echo esc_attr($gc2); ?>;--wd:<?php echo ($bf26_gi * 1.4); ?>s">
            <span class="bf26-gift__card">
              <span class="bf26-gift__badge">GIFT <?php echo $bf26_gi + 1; ?> · FREE</span>
              <?php if ( $gimg ) : ?><img class="bf26-gift__img" src="<?php echo esc_url($gimg); ?>" alt="<?php echo esc_attr($gname); ?>" loading="lazy"><?php endif; ?>
              <span class="bf26-gift__name"><?php echo esc_html($gname); ?></span>
            </span>
            <span class="bf26-gift__case">
              <span class="bf26-gift__body">
                <span class="bf26-gift__seam bf26-gift__seam--l"></span>
                <span class="bf26-gift__seam bf26-gift__seam--r"></span>
                <span class="bf26-gift__num"><?php echo esc_html($gnum); ?></span>
                <span class="bf26-gift__tag">&#9992; TEFL</span>
              </span>
              <span class="bf26-gift__lid">
                <span class="bf26-gift__handle"></span>
                <span class="bf26-gift__seam bf26-gift__seam--l"></span>
                <span class="bf26-gift__seam bf26-gift__seam--r"></span>
                <span class="bf26-gift__globe"><?php echo bf26_icon('globe', 22, '#0A0A0A'); ?></span>
                <span class="bf26-gift__sticker">GIFT <?php echo $bf26_gi + 1; ?></span>
              </span>
              <span class="bf26-gift__zip"><span class="bf26-gift__zip-pull"></span></span>
            </span>
            <span class="bf26-gift__tap">TAP TO UNZIP</span>
            <span class="bf26-gift__bits" aria-hidden="true"></span>
          </button>
          <?php $bf26_gi++; endforeach; ?>
        </div>

        <div class="bf26-gifts__banner" data-gift-banner hidden>
          <span class="bf26-gifts__banner-text"><strong><?php bf26_e('gifts_banner_strong'); ?></strong> <?php bf26_e('gifts_banner_text'); ?></span>
          <a href="<?php echo esc_url( bf26_get('gifts_banner_url') ); ?>" class="bf26-gifts__banner-cta"><span class="bf26-shine" aria-hidden="true"></span><span class="bf26-gifts__banner-cta-txt"><?php bf26_e('gifts_banner_cta'); ?> &rarr;</span></a>
        </div>
      </div>
    </section>
    <!-- =================== END FREE GIFTS =================== -->

    <!-- ===================== REVIEWS & STATS ===================== -->
    <section class="bf26-social bf26-fullbleed">

      <!-- Stats strip -->
      <div class="bf26-stats">
        <div class="bf26-stats__inner">
          <?php $bf26_tp = bf26_live_trustpilot(); ?>
          <div class="bf26-stat">
            <span class="bf26-stat__num"><?php echo esc_html($bf26_tp['rating']); ?></span>
            <span class="bf26-stat__label">Trustpilot, from <?php echo esc_html($bf26_tp['count']); ?> reviews</span>
          </div>
          <?php foreach ( bf26_rows('stats') as $st ) :
            $snum = isset($st['num']) ? $st['num'] : '';
            $slab = isset($st['label']) ? $st['label'] : '';
            if ( '' === $snum && '' === $slab ) { continue; }
          ?>
          <div class="bf26-stat">
            <span class="bf26-stat__num"><?php echo esc_html($snum); ?></span>
            <span class="bf26-stat__label"><?php echo esc_html($slab); ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Featured review + CTA -->
      <div class="bf26-review">
        <div class="bf26-review__inner">

          <?php $bf26_reviews = bf26_live_reviews( 10 ); ?>
          <div class="bf26-review__scroll" tabindex="0" role="group" aria-label="Student reviews">
            <?php foreach ( $bf26_reviews as $rv ) : ?>
            <figure class="bf26-review__card">
              <span class="bf26-review__mark" aria-hidden="true">
                <svg width="30" height="30" viewBox="0 0 512 512" fill="#D7263D" aria-hidden="true"><path d="M464 32H336c-26.5 0-48 21.5-48 48v128c0 26.5 21.5 48 48 48h80v64c0 35.3-28.7 64-64 64h-8c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24h8c88.4 0 160-71.6 160-160V80c0-26.5-21.5-48-48-48zm-288 0H48C21.5 32 0 53.5 0 80v128c0 26.5 21.5 48 48 48h80v64c0 35.3-28.7 64-64 64h-8c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24h8c88.4 0 160-71.6 160-160V80c0-26.5-21.5-48-48-48z"/></svg>
              </span>
              <blockquote class="bf26-review__text"><?php echo esc_html( $rv['text'] ); ?></blockquote>
              <figcaption class="bf26-review__cite"><strong><?php echo esc_html( $rv['author'] ); ?></strong> &middot; <?php echo esc_html( $rv['role'] ); ?></figcaption>
            </figure>
            <?php endforeach; ?>
          </div>

          <div class="bf26-review__cta-col">
            <h2 class="bf26-review__title"><?php bf26_e('review_title_pre'); ?><strong><?php bf26_e('review_title_em'); ?></strong><?php bf26_e('review_title_post'); ?></h2>
            <a href="<?php echo esc_url( bf26_get('review_cta_url') ); ?>" class="bf26-review__cta">
              <span class="bf26-shine" aria-hidden="true"></span>
              <span class="bf26-review__cta-txt"><?php bf26_e('review_cta_label'); ?> &rarr;</span>
            </a>
          </div>

        </div>
      </div>
    </section>
    <!-- =================== END REVIEWS & STATS =================== -->

    <!-- ===================== WHY CHOOSE US ===================== -->
    <section class="bf26-whyus bf26-fullbleed">
      <div class="bf26-whyus__inner">

        <div class="bf26-whyus__head">
          <div class="bf26-whyus__head-left">
            <div class="bf26-whyus__eyebrow"><?php bf26_e('whyus_eyebrow'); ?></div>
            <h2 class="bf26-whyus__title"><?php bf26_e('whyus_title_pre'); ?><strong><?php bf26_e('whyus_title_em'); ?></strong><?php bf26_e('whyus_title_post'); ?></h2>
            <div class="bf26-whyus__rule" aria-hidden="true"></div>
          </div>
          <p class="bf26-whyus__intro"><?php bf26_e('whyus_intro'); ?></p>
        </div>

        <div class="bf26-whyus__grid">
          <?php foreach ( bf26_rows('whyus_cards') as $wc ) :
            $wicon  = isset($wc['icon']) ? $wc['icon'] : 'shield-check';
            $wtitle = isset($wc['title']) ? $wc['title'] : '';
            $wtext  = isset($wc['text']) ? $wc['text'] : '';
            if ( '' === $wtitle && '' === $wtext ) { continue; }
          ?>
          <div class="bf26-whyus__card">
            <span class="bf26-whyus__icon"><?php echo bf26_icon($wicon, 24, '#fff'); ?></span>
            <span class="bf26-whyus__card-title"><?php echo esc_html($wtitle); ?></span>
            <p class="bf26-whyus__card-text"><?php echo esc_html($wtext); ?></p>
          </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section>
    <!-- =================== END WHY CHOOSE US =================== -->

  </div>

</div>

<?php get_footer(); ?>
