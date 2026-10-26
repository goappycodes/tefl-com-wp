<?php
/**
 * Black Friday Landing Page 2026 — functions & ACF helpers
 *
 * Loaded from functions.php. Goes with:
 *   black-friday-landing-page-2026.php               (the page template, theme root)
 *   assets/css/black-friday-landing-page-2026.css
 *   assets/js/black-friday-landing-page-2026.js
 *   assets/img/black-friday-2026/                    (hero cut-out, world map)
 *
 * The ACF field group "Black Friday 2026" (key group_6adc86c0a1f16) is managed
 * in the ACF plugin (Custom Fields > Field Groups) and synced to acf-json. Each
 * page section is a top-level tab + a "group" field:
 *   - banner_section  — the hero
 *   - accred_strip    — the "Accredited & regulated" strip
 * bf26_data() merges those group values into one flat array keyed by sub-field
 * name, so templates read any field with bf26_get()/bf26_rows() regardless of
 * which section group it lives in. Every field falls back to bf26_defaults(),
 * so the page renders in full before anything is saved. Prefixed bf26_.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'BF26_TEMPLATE', 'black-friday-landing-page-2026.php' );
define( 'BF26_GROUP_KEY', 'group_6adc86c0a1f16' );   // the "Black Friday 2026" field group

/** The section "group" fields whose sub-values are merged for the template. */
function bf26_section_groups() {
	return array( 'banner_section', 'accred_strip', 'sale_countdown', 'course_section' );
}

/* =========================================================================
 * Default content — the page renders fully before any field is saved.
 * ====================================================================== */
function bf26_defaults() {
	static $d = null;
	if ( null !== $d ) {
		return $d;
	}

	$d = array(

		/* ---------- Hero: departures board ---------- */
		'hero_board_status' => 'DEPARTURES',
		'hero_board_gate'   => 'TEFL GATE · NOW BOARDING',
		'hero_board_text'   => 'BLACK FRIDAY IS LIVE',

		/* ---------- Hero: headline ---------- */
		'hero_title_line1'  => 'Black',
		'hero_title_line2'  => 'Friday.',
		'hero_off_pre'      => "TEFL courses\nup to",
		'hero_off_big'      => '82%',
		'hero_off_post'     => 'off',
		'hero_lead'         => 'Fully accredited, Ofqual-regulated TEFL courses at the lowest prices of the year. Teach abroad, online, or add a qualification to your CV. <strong>No teaching experience needed.</strong>',

		/* ---------- Hero: free gifts pill ---------- */
		'hero_gift_title'    => '+ 6 Free Gifts with every course',
		'hero_gift_subtitle' => 'AI module, Travel Influencer course and 4 teaching guides',
		'hero_gift_link'     => '#free-gifts',

		/* ---------- Hero: CTAs ---------- */
		'hero_cta_primary_label'   => 'Shop the sale',
		'hero_cta_primary_url'     => '#',
		'hero_cta_secondary_label' => 'Take the English test',
		'hero_cta_secondary_url'   => '#',

		/* ---------- Hero: art ---------- */
		'hero_image'       => '', // falls back to the theme asset below
		'hero_badge_pre'   => 'UP TO',
		'hero_badge_num'   => '82%',
		'hero_badge_post'  => 'OFF',
		'hero_floats'      => array(
			array( 'icon' => 'globe',        'label' => 'Teach Worldwide' ),
			array( 'icon' => 'shield-check', 'label' => 'Ofqual Level 5' ),
			array( 'icon' => 'laptop',       'label' => 'Teach Online' ),
		),
		'hero_bundle_label' => 'ULTIMATE BUNDLE',
		'hero_bundle_price' => '€287',
		'hero_bundle_was'   => '€1,595',

		/* ---------- Accredited & regulated strip ---------- */
		'accred_label' => 'ACCREDITED & REGULATED BY',
		'accred_items' => array(
			array( 'name' => 'Highfield', 'sub' => 'Approved Centre' ),
			array( 'name' => 'Ofqual',    'sub' => 'Regulated' ),
			array( 'name' => 'OTCAC',     'sub' => 'Accredited' ),
			array( 'name' => 'DEAC',      'sub' => 'Approved' ),
			array( 'name' => 'AQC',       'sub' => 'Quality Curriculum' ),
		),

		/* ---------- Sale countdown ---------- */
		'sale_show'          => true,
		'sale_label'         => 'SALE ENDS IN',
		'sale_end'           => '2026-11-30 23:59:59', // parsed with strtotime(); counts down to this moment
		'sale_end_note'      => '30 November, midnight',
		'sale_places_strong' => '59 places',
		'sale_places_text'   => 'left at this price',

		/* ---------- Course cards ---------- */
		'course_eyebrow'    => 'CHOOSE YOUR COURSE',
		'course_title_pre'  => 'Four ways to ',
		'course_title_em'   => 'SAVE',
		'course_title_post' => ' this Black Friday.',
		'course_note'       => 'All prices include certificate, tutor support and app access.',
		'course_cards'      => array(
			array(
				'variant'  => 'standard',
				'save'     => '63%',
				'category' => 'ENTRY LEVEL',
				'cat_icon' => 'book-open',
				'image'    => 'course-120-online-teacher.png',
				'title'    => '120 Hour Advanced TEFL Course',
				'price'    => '€145',
				'was'      => '€395',
				'klarna'   => true,
				'features' => array(
					array( 'icon' => 'clock',  'text' => 'Certified in 2–4 weeks' ),
					array( 'icon' => 'plane',  'text' => 'For first-time teachers and travellers' ),
					array( 'icon' => 'globe',  'text' => 'Accepted by employers worldwide' ),
					array( 'icon' => 'users',  'text' => 'Tutor support and live mentorship' ),
				),
				'cta_label' => 'Enrol now',
				'cta_url'   => '#',
			),
			array(
				'variant'  => 'standard',
				'save'     => '72%',
				'category' => 'MOST POPULAR',
				'cat_icon' => 'award',
				'image'    => 'course-180-kids-classroom.png',
				'title'    => '180-Hour Level 5 TEFL Course',
				'price'    => '€195',
				'was'      => '€695',
				'klarna'   => true,
				'features' => array(
					array( 'icon' => 'shield-check', 'text' => 'Ofqual-regulated, awarded by Highfield' ),
					array( 'icon' => 'star',         'text' => 'CELTA-equivalent qualification' ),
					array( 'icon' => 'users',        'text' => 'Personal tutor and live mentorship' ),
					array( 'icon' => 'briefcase',    'text' => 'Jobs board access' ),
				),
				'cta_label' => 'Enrol now',
				'cta_url'   => '#',
			),
			array(
				'variant'  => 'standard',
				'save'     => '73%',
				'category' => 'PROFESSIONAL',
				'cat_icon' => 'graduation-cap',
				'image'    => 'course-300-class-group.png',
				'title'    => '300-Hour Level 5 TEFL Diploma',
				'price'    => '€245',
				'was'      => '€895',
				'klarna'   => true,
				'features' => array(
					array( 'icon' => 'file-badge', 'text' => 'Our most comprehensive diploma' ),
					array( 'icon' => 'book-open',  'text' => 'Specialist modules built in' ),
					array( 'icon' => 'briefcase',  'text' => 'For higher-paying roles' ),
					array( 'icon' => 'life-buoy',  'text' => 'Lifetime tutor support' ),
				),
				'cta_label' => 'Enrol now',
				'cta_url'   => '#',
			),
			array(
				'variant'  => 'bundle',
				'save'     => '82%',
				'category' => 'BEST DEAL',
				'cat_icon' => 'gift',
				'image'    => 'course-bundle-selfie.png',
				'title'    => 'Ultimate Black Friday Bundle',
				'price'    => '€287',
				'was'      => '€1,595',
				'klarna'   => true,
				'features' => array(
					array( 'icon' => 'award',     'text' => '180-Hour Level 5 TEFL Course' ),
					array( 'icon' => 'laptop',    'text' => 'Teaching Online + Business English' ),
					array( 'icon' => 'book-open', 'text' => 'Advanced Grammar, IELTS, Young Learners, Yoga for Children' ),
					array( 'icon' => 'clock',     'text' => 'Express marking' ),
				),
				'cta_label' => 'Get the bundle',
				'cta_url'   => '#',
			),
		),
		'course_free_title_pre' => 'Still not sure? ',
		'course_free_title_em'  => 'Try these for free.',
		'course_free_tiles'     => array(
			array( 'icon' => 'briefcase', 'label' => 'Calculate Your Salary', 'url' => '#' ),
			array( 'icon' => 'book-open', 'label' => 'Free English Level Test', 'url' => '#' ),
			array( 'icon' => 'file-badge', 'label' => 'Download Brochure', 'url' => '#' ),
		),
	);

	return $d;
}

/**
 * Resolve a course card's price / was-price / save-% .
 * Follows the site convention (see black-friday-landing-page-2023.php): when a
 * WooCommerce product is linked, pull the live regular/sale price and compute
 * the discount; otherwise fall back to the manually-entered card values.
 * Returns [ 'price' => html, 'was' => html, 'save' => '63%' ].
 */
function bf26_card_pricing( $card ) {
	$price = isset( $card['price'] ) ? $card['price'] : '';
	$was   = isset( $card['was'] ) ? $card['was'] : '';
	$save  = isset( $card['save'] ) ? $card['save'] : '';

	$product_id = 0;
	if ( ! empty( $card['product'] ) ) {
		$product_id = is_array( $card['product'] ) ? ( $card['product']['ID'] ?? 0 ) : $card['product'];
	}

	if ( $product_id && function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( $product_id );
		if ( $product ) {
			$reg  = (float) $product->get_regular_price();
			$sale = (float) $product->get_sale_price();
			$cur  = $sale ? $sale : (float) $product->get_price();
			if ( $cur ) {
				$price = function_exists( 'wc_price' ) ? wc_price( $cur ) : $cur;
			}
			if ( $reg && $reg > $cur ) {
				$was  = function_exists( 'wc_price' ) ? wc_price( $reg ) : $reg;
				$save = round( ( ( $reg - $cur ) / $reg ) * 100 ) . '%';
			}
		}
	}

	return array( 'price' => $price, 'was' => $was, 'save' => $save );
}

/**
 * Resolve a course card image to a URL. Accepts an ACF image (array or id),
 * a full URL, or a bare filename that lives in the theme's BF-2026 image dir.
 */
function bf26_card_image( $card ) {
	$img = isset( $card['image'] ) ? $card['image'] : '';
	if ( is_array( $img ) && ! empty( $img['url'] ) ) {
		return $img['url'];
	}
	if ( is_numeric( $img ) ) {
		$url = wp_get_attachment_image_url( (int) $img, 'large' );
		if ( $url ) {
			return $url;
		}
	}
	if ( is_string( $img ) && '' !== $img ) {
		if ( 0 === strpos( $img, 'http' ) || false !== strpos( $img, '/' ) ) {
			return $img;
		}
		return get_stylesheet_directory_uri() . '/assets/img/black-friday-2026/' . $img;
	}
	return '';
}

/** First "<n> hour" figure found in a string (e.g. "180-Hour Level 5" -> 180). */
function bf26_course_hours( $text ) {
	if ( preg_match( '/(\d{2,4})\s*[- ]?\s*hour/i', (string) $text, $m ) ) {
		return (int) $m[1];
	}
	return 0;
}

/**
 * Work out a course card's button link + label. No manual link is used for the
 * standard "Enrol now" cards — the link is derived from the linked product:
 *   - 180-hour and 300-hour courses  -> the course (product) page
 *   - every other course             -> add the product to the WooCommerce cart
 * The bundle card keeps a manually-entered link (cta_url).
 * Returns [ 'url' => ..., 'label' => ... ].
 */
function bf26_card_cta( $card ) {
	$variant = ( isset( $card['variant'] ) && 'bundle' === $card['variant'] ) ? 'bundle' : 'standard';
	$label   = ! empty( $card['cta_label'] ) ? $card['cta_label'] : ( 'bundle' === $variant ? 'Get the bundle' : 'Enrol now' );

	// Bundle: manual link field.
	if ( 'bundle' === $variant ) {
		return array( 'url' => ! empty( $card['cta_url'] ) ? $card['cta_url'] : '#', 'label' => $label );
	}

	// Standard: derive from the linked WooCommerce product.
	$product_id = 0;
	if ( ! empty( $card['product'] ) ) {
		$product_id = is_array( $card['product'] ) ? ( $card['product']['ID'] ?? 0 ) : $card['product'];
	}
	if ( $product_id && function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( $product_id );
		if ( $product ) {
			$hours = bf26_course_hours( $product->get_title() . ' ' . ( isset( $card['title'] ) ? $card['title'] : '' ) );
			// 180-hour and 300-hour courses go to their course page.
			if ( in_array( $hours, array( 180, 300 ), true ) ) {
				return array( 'url' => get_permalink( $product_id ), 'label' => $label );
			}
			// Variable / external / non-purchasable products can't be direct-added,
			// so send them to the course page too.
			if ( $product->is_type( 'variable' ) || $product->is_type( 'external' ) || ! $product->is_purchasable() ) {
				return array( 'url' => get_permalink( $product_id ), 'label' => $label );
			}
			// Everything else: add to the cart via the site's own cart handler
			// (see includes/tefl-course-variation-date.php), e.g. /?addtimetocart&prid=430
			return array( 'url' => '/?addtimetocart&prid=' . (int) $product_id, 'label' => $label );
		}
	}

	// No product linked yet: fall back to the manual link (defaults to '#').
	return array( 'url' => ! empty( $card['cta_url'] ) ? $card['cta_url'] : '#', 'label' => $label );
}

/**
 * Sale end as an ISO-8601 string the browser's Date() can parse reliably.
 * Mirrors the site timer convention (ti-timer.js reads an expiry string),
 * but keyed to this page's own sale_end field.
 */
function bf26_sale_end_iso() {
	$raw = bf26_get( 'sale_end' );
	$ts  = strtotime( $raw );
	if ( ! $ts ) {
		$ts = strtotime( '2026-11-30 23:59:59' );
	}
	return date( 'c', $ts ); // e.g. 2026-11-30T23:59:59+00:00
}

/** Whether to render the countdown (unset defaults to on). */
function bf26_sale_show() {
	$v = bf26_get( 'sale_show' );
	return ! ( '0' === (string) $v || false === $v || 0 === $v );
}

/* =========================================================================
 * Helpers
 * ====================================================================== */

/** Is the current request a page using this template? */
function bf26_is_active() {
	return is_page_template( BF26_TEMPLATE );
}

/** All section group values merged into one flat array (cached per post). */
function bf26_data( $post_id = null ) {
	static $cache = array();
	$post_id = $post_id ? $post_id : get_queried_object_id();
	if ( ! array_key_exists( $post_id, $cache ) ) {
		$merged = array();
		if ( function_exists( 'get_field' ) ) {
			foreach ( bf26_section_groups() as $group ) {
				$val = get_field( $group, $post_id );
				if ( is_array( $val ) ) {
					$merged = array_merge( $merged, $val );
				}
			}
		}
		$cache[ $post_id ] = $merged;
	}
	return $cache[ $post_id ];
}

/** A single field, falling back to the default when empty. */
function bf26_get( $name, $post_id = null ) {
	$data  = bf26_data( $post_id );
	$value = isset( $data[ $name ] ) ? $data[ $name ] : null;
	if ( null === $value || false === $value || '' === $value || array() === $value ) {
		$d     = bf26_defaults();
		$value = isset( $d[ $name ] ) ? $d[ $name ] : '';
	}
	return $value;
}

/** Repeater rows, falling back to the defaults until rows are saved. */
function bf26_rows( $name, $post_id = null ) {
	$data = bf26_data( $post_id );
	$rows = isset( $data[ $name ] ) ? $data[ $name ] : null;
	if ( is_array( $rows ) && $rows ) {
		return array_values( $rows );
	}
	$d = bf26_defaults();
	return isset( $d[ $name ] ) ? $d[ $name ] : array();
}

/** Echo escaped text from a field. */
function bf26_e( $name ) {
	echo esc_html( bf26_get( $name ) );
}

/** Resolve the hero image to a usable [url, alt] pair, with a theme fallback. */
function bf26_hero_image() {
	$img = bf26_get( 'hero_image' );
	$fallback_url = get_stylesheet_directory_uri() . '/assets/img/black-friday-2026/hero-victory-pose.png';
	$fallback_alt = 'Excited student with headphones celebrating at her laptop';

	if ( is_array( $img ) && ! empty( $img['url'] ) ) {
		return array(
			'url' => $img['url'],
			'alt' => ! empty( $img['alt'] ) ? $img['alt'] : $fallback_alt,
		);
	}
	if ( is_numeric( $img ) ) {
		$url = wp_get_attachment_image_url( (int) $img, 'full' );
		if ( $url ) {
			$alt = get_post_meta( (int) $img, '_wp_attachment_image_alt', true );
			return array( 'url' => $url, 'alt' => $alt ? $alt : $fallback_alt );
		}
	}
	if ( is_string( $img ) && $img ) {
		return array( 'url' => $img, 'alt' => $fallback_alt );
	}
	return array( 'url' => $fallback_url, 'alt' => $fallback_alt );
}

/** Lucide icons, inline, 1.5px stroke. Coloured via the stroke argument. */
if ( ! function_exists( 'bf26_icon' ) ) {
	function bf26_icon( $name, $size = 22, $color = 'currentColor', $stroke = 1.5 ) {
		static $paths = array(
			'gift'           => '<rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/>',
			'globe'          => '<circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>',
			'shield-check'   => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
			'laptop'         => '<path d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16"/>',
			'plane'          => '<path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>',
			'award'          => '<path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/><circle cx="12" cy="8" r="6"/>',
			'book-open'      => '<path d="M12 7v14"/><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"/>',
			'briefcase'      => '<path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><rect width="20" height="14" x="2" y="6" rx="2"/>',
			'graduation-cap' => '<path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>',
			'clock'          => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
			'users'          => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
			'star'           => '<path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/>',
			'file-badge'     => '<path d="M12 22h6a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M5 17a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M7 16.5 8 22l-3-1-3 1 1-5.5"/>',
			'life-buoy'      => '<circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/><circle cx="12" cy="12" r="4"/>',
			'calendar-days'  => '<path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/>',
		);
		$d = isset( $paths[ $name ] ) ? $paths[ $name ] : '';
		return '<svg class="bf26-ic" width="' . intval( $size ) . '" height="' . intval( $size ) . '" viewBox="0 0 24 24" fill="none" stroke="' . esc_attr( $color ) . '" stroke-width="' . floatval( $stroke ) . '" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $d . '</svg>';
	}
}

/* =========================================================================
 * ACF: add a section's fields to the existing DB field group by APPENDING
 * them with acf_update_field(). This never replaces the group, so — unlike
 * acf_import_field_group() — it cannot create duplicate field-group posts.
 * Run once from WP-CLI, e.g.:  wp eval 'echo bf26_add_countdown_fields();'
 * ====================================================================== */

/** Append a tab + a "group" field (with sub-fields) to the group. Idempotent. */
function bf26_append_group_section( $tab_key, $tab_label, $group_key, $group_name, $group_label, $sub_fields ) {
	if ( ! function_exists( 'acf_update_field' ) || ! function_exists( 'acf_get_field_group' ) ) {
		return 'ACF not available';
	}
	$g = acf_get_field_group( BF26_GROUP_KEY );
	if ( ! $g || empty( $g['ID'] ) ) {
		return 'group ' . BF26_GROUP_KEY . ' not found';
	}
	$gid = (int) $g['ID'];

	if ( function_exists( 'acf_get_field' ) && acf_get_field( $group_key ) ) {
		return $group_name . ' already present — nothing to do';
	}

	$existing = acf_get_fields( $gid );
	$order    = is_array( $existing ) ? count( $existing ) : 0;

	acf_update_field( array(
		'key'        => $tab_key,
		'label'      => $tab_label,
		'name'       => '',
		'type'       => 'tab',
		'placement'  => 'left',
		'parent'     => $gid,
		'menu_order' => $order,
	) );

	$grp = acf_update_field( array(
		'key'        => $group_key,
		'label'      => $group_label,
		'name'       => $group_name,
		'type'       => 'group',
		'layout'     => 'block',
		'parent'     => $gid,
		'menu_order' => $order + 1,
	) );
	$pid = (int) $grp['ID'];

	bf26_create_fields( $sub_fields, $pid );

	return 'added ' . $group_name . ' with ' . count( $sub_fields ) . ' fields';
}

/** Recursively create fields under a parent (group ID or parent field ID). */
function bf26_create_fields( $fields, $parent_id ) {
	$o = 0;
	foreach ( $fields as $f ) {
		$children = isset( $f['sub_fields'] ) ? $f['sub_fields'] : null;
		unset( $f['sub_fields'] );
		$f['parent']     = $parent_id;
		$f['menu_order'] = $o++;
		$saved = acf_update_field( $f );
		if ( $children && ! empty( $saved['ID'] ) ) {
			bf26_create_fields( $children, (int) $saved['ID'] );
		}
	}
}

/** The sale-countdown sub-fields (source of truth for the append). */
function bf26_countdown_subfields() {
	$d = bf26_defaults();
	return array(
		array( 'key' => 'field_bf26_sale_show', 'label' => 'Show countdown', 'name' => 'sale_show', 'type' => 'true_false', 'ui' => 1, 'default_value' => 1, 'message' => 'Show the sale countdown band' ),
		array( 'key' => 'field_bf26_sale_label', 'label' => 'Label', 'name' => 'sale_label', 'type' => 'text', 'default_value' => $d['sale_label'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_sale_end_note', 'label' => 'End note', 'name' => 'sale_end_note', 'type' => 'text', 'default_value' => $d['sale_end_note'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_sale_end', 'label' => 'Sale end date & time', 'name' => 'sale_end', 'type' => 'date_time_picker', 'display_format' => 'd/m/Y g:i a', 'return_format' => 'Y-m-d H:i:s', 'first_day' => 1, 'instructions' => 'Leave empty to use the default (' . $d['sale_end'] . ').' ),
		array( 'key' => 'field_bf26_sale_places_strong', 'label' => 'Places left — bold text', 'name' => 'sale_places_strong', 'type' => 'text', 'default_value' => $d['sale_places_strong'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_sale_places_text', 'label' => 'Places left — rest', 'name' => 'sale_places_text', 'type' => 'text', 'default_value' => $d['sale_places_text'], 'wrapper' => array( 'width' => 50 ) ),
	);
}

/** One-shot: add the "Sale countdown" tab + group to the DB field group. */
function bf26_add_countdown_fields() {
	return bf26_append_group_section(
		'field_bf26_tab_sale',
		'Sale countdown',
		'field_bf26_sale_countdown',
		'sale_countdown',
		'Sale countdown',
		bf26_countdown_subfields()
	);
}

/** Icon choices shared by the course-section selects. */
function bf26_course_icon_choices() {
	return array(
		'book-open' => 'Book', 'award' => 'Award', 'graduation-cap' => 'Graduation cap', 'gift' => 'Gift',
		'clock' => 'Clock', 'plane' => 'Plane', 'globe' => 'Globe', 'users' => 'Users', 'shield-check' => 'Shield check',
		'star' => 'Star', 'file-badge' => 'File badge', 'life-buoy' => 'Life buoy', 'laptop' => 'Laptop',
		'briefcase' => 'Briefcase', 'calendar-days' => 'Calendar',
	);
}

/** The course-section sub-fields (source of truth for the append). */
function bf26_course_subfields() {
	$d     = bf26_defaults();
	$icons = bf26_course_icon_choices();
	return array(
		array( 'key' => 'field_bf26_course_eyebrow', 'name' => 'course_eyebrow', 'label' => 'Eyebrow', 'type' => 'text', 'default_value' => $d['course_eyebrow'] ),
		array( 'key' => 'field_bf26_course_title_pre', 'name' => 'course_title_pre', 'label' => 'Title — before highlight', 'type' => 'text', 'default_value' => $d['course_title_pre'], 'wrapper' => array( 'width' => 34 ) ),
		array( 'key' => 'field_bf26_course_title_em', 'name' => 'course_title_em', 'label' => 'Title — highlight', 'type' => 'text', 'default_value' => $d['course_title_em'], 'wrapper' => array( 'width' => 33 ) ),
		array( 'key' => 'field_bf26_course_title_post', 'name' => 'course_title_post', 'label' => 'Title — after highlight', 'type' => 'text', 'default_value' => $d['course_title_post'], 'wrapper' => array( 'width' => 33 ) ),
		array( 'key' => 'field_bf26_course_note', 'name' => 'course_note', 'label' => 'Note (right of heading)', 'type' => 'text', 'default_value' => $d['course_note'] ),
		array(
			'key' => 'field_bf26_course_cards', 'name' => 'course_cards', 'label' => 'Course cards', 'type' => 'repeater',
			'instructions' => 'Leave empty to show the built-in four cards. Link a product for live price & discount; otherwise set them manually.',
			'min' => 0, 'layout' => 'block', 'button_label' => 'Add card',
			'sub_fields' => array(
				array( 'key' => 'field_bf26_card_variant', 'name' => 'variant', 'label' => 'Style', 'type' => 'select', 'choices' => array( 'standard' => 'Standard (cream)', 'bundle' => 'Bundle (red)' ), 'default_value' => 'standard', 'wrapper' => array( 'width' => 34 ) ),
				array( 'key' => 'field_bf26_card_save', 'name' => 'save', 'label' => 'Save % (manual)', 'type' => 'text', 'instructions' => 'e.g. 63% — ignored when a product is linked.', 'wrapper' => array( 'width' => 33 ) ),
				array( 'key' => 'field_bf26_card_klarna', 'name' => 'klarna', 'label' => 'Show Klarna', 'type' => 'true_false', 'ui' => 1, 'default_value' => 1, 'wrapper' => array( 'width' => 33 ) ),
				array( 'key' => 'field_bf26_card_product', 'name' => 'product', 'label' => 'WooCommerce product (live price)', 'type' => 'post_object', 'post_type' => array( 'product' ), 'return_format' => 'id', 'ui' => 1, 'allow_null' => 1, 'instructions' => 'Optional. Pulls regular/sale price and computes the % off.' ),
				array( 'key' => 'field_bf26_card_price', 'name' => 'price', 'label' => 'Price (manual)', 'type' => 'text', 'wrapper' => array( 'width' => 50 ) ),
				array( 'key' => 'field_bf26_card_was', 'name' => 'was', 'label' => 'Was price (manual)', 'type' => 'text', 'wrapper' => array( 'width' => 50 ) ),
				array( 'key' => 'field_bf26_card_category', 'name' => 'category', 'label' => 'Category pill', 'type' => 'text', 'wrapper' => array( 'width' => 60 ) ),
				array( 'key' => 'field_bf26_card_cat_icon', 'name' => 'cat_icon', 'label' => 'Pill icon', 'type' => 'select', 'choices' => $icons, 'default_value' => 'book-open', 'wrapper' => array( 'width' => 40 ) ),
				array( 'key' => 'field_bf26_card_image', 'name' => 'image', 'label' => 'Image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium' ),
				array( 'key' => 'field_bf26_card_title', 'name' => 'title', 'label' => 'Title', 'type' => 'text' ),
				array(
					'key' => 'field_bf26_card_features', 'name' => 'features', 'label' => 'Features', 'type' => 'repeater',
					'min' => 0, 'layout' => 'table', 'button_label' => 'Add feature',
					'sub_fields' => array(
						array( 'key' => 'field_bf26_feat_icon', 'name' => 'icon', 'label' => 'Icon', 'type' => 'select', 'choices' => $icons, 'default_value' => 'book-open', 'wrapper' => array( 'width' => 30 ) ),
						array( 'key' => 'field_bf26_feat_text', 'name' => 'text', 'label' => 'Text', 'type' => 'text', 'wrapper' => array( 'width' => 70 ) ),
					),
				),
				array( 'key' => 'field_bf26_card_cta_label', 'name' => 'cta_label', 'label' => 'Button label', 'type' => 'text', 'default_value' => 'Enrol now', 'wrapper' => array( 'width' => 50 ) ),
				array( 'key' => 'field_bf26_card_cta_url', 'name' => 'cta_url', 'label' => 'Button link (bundle only)', 'type' => 'text', 'instructions' => 'Only used by the bundle card. Standard cards link automatically from the product (cart, or course page for 180/300-hour).', 'wrapper' => array( 'width' => 50 ), 'conditional_logic' => array( array( array( 'field' => 'field_bf26_card_variant', 'operator' => '==', 'value' => 'bundle' ) ) ) ),
			),
		),
		array( 'key' => 'field_bf26_course_free_title_pre', 'name' => 'course_free_title_pre', 'label' => 'Free tiles — title before', 'type' => 'text', 'default_value' => $d['course_free_title_pre'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_course_free_title_em', 'name' => 'course_free_title_em', 'label' => 'Free tiles — title highlight', 'type' => 'text', 'default_value' => $d['course_free_title_em'], 'wrapper' => array( 'width' => 50 ) ),
		array(
			'key' => 'field_bf26_course_free_tiles', 'name' => 'course_free_tiles', 'label' => 'Free tiles', 'type' => 'repeater',
			'min' => 0, 'max' => 3, 'layout' => 'table', 'button_label' => 'Add tile',
			'sub_fields' => array(
				array( 'key' => 'field_bf26_free_icon', 'name' => 'icon', 'label' => 'Icon', 'type' => 'select', 'choices' => $icons, 'default_value' => 'book-open', 'wrapper' => array( 'width' => 25 ) ),
				array( 'key' => 'field_bf26_free_label', 'name' => 'label', 'label' => 'Label', 'type' => 'text', 'wrapper' => array( 'width' => 45 ) ),
				array( 'key' => 'field_bf26_free_url', 'name' => 'url', 'label' => 'Link', 'type' => 'text', 'wrapper' => array( 'width' => 30 ) ),
			),
		),
	);
}

/** One-shot: add the "Course cards" tab + group to the DB field group. */
function bf26_add_course_fields() {
	return bf26_append_group_section(
		'field_bf26_tab_course',
		'Course cards',
		'field_bf26_course_section',
		'course_section',
		'Course cards',
		bf26_course_subfields()
	);
}

/** One-shot: make the card button link field show for the bundle card only. */
function bf26_make_cta_bundle_only() {
	if ( ! function_exists( 'acf_get_field' ) || ! function_exists( 'acf_update_field' ) ) {
		return 'ACF not available';
	}
	$f = acf_get_field( 'field_bf26_card_cta_url' );
	if ( ! $f ) {
		return 'cta_url field not found';
	}
	$f['label']             = 'Button link (bundle only)';
	$f['instructions']      = 'Only used by the bundle card. Standard cards link automatically from the product (cart, or course page for 180/300-hour).';
	$f['conditional_logic'] = array( array( array( 'field' => 'field_bf26_card_variant', 'operator' => '==', 'value' => 'bundle' ) ) );
	acf_update_field( $f );
	return 'cta_url is now bundle-only';
}
