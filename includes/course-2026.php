<?php
/**
 * Course Page 2026
 *
 * Loads templates/course-page-2026.php for any course (or course_location)
 * that has the ACF toggle "Use the 2026 course design" (c26_enabled) switched on.
 * Every other course keeps rendering exactly as before.
 *
 * Install: add this line to the child theme's functions.php
 *     require_once get_stylesheet_directory() . '/includes/course-2026.php';
 *
 * Files:  includes/course-2026.php            (this file)
 *         course-page-2026.php              (template, theme root)
 *         assets/css/course-2026.css
 *         assets/js/course-2026.js
 *         acf-json/group_ti_course_2026.json  (fields; ACF loads it automatically)
 *
 * @package teflinstitute
 */

defined( 'ABSPATH' ) || exit;

define( 'TI_C26_VERSION', '1.0.0' );
define( 'TI_C26_URL', get_stylesheet_directory_uri() . '/assets' );

/* -------------------------------------------------------------------------
 * 1. Is the current request a 2026 course page?
 * ---------------------------------------------------------------------- */
function ti_c26_is_active( $post_id = null ) {
	if ( ! function_exists( 'get_field' ) ) {
		return false;
	}
	if ( null === $post_id ) {
		if ( ! is_singular( array( 'course', 'course_location' ) ) ) {
			return false;
		}
		$post_id = get_queried_object_id();
	}
	if ( post_password_required( $post_id ) ) {
		return false; // Let the normal template show the password form.
	}
	return (bool) get_field( 'c26_enabled', $post_id );
}

/* -------------------------------------------------------------------------
 * 2. Template switch
 * ---------------------------------------------------------------------- */
add_filter( 'template_include', function ( $template ) {
	if ( ti_c26_is_active() ) {
		$t = locate_template( 'course-page-2026.php' );
		if ( $t ) {
			return $t;
		}
	}
	return $template;
}, 99 );

// Full-width, no sidebar, no Astra title on these pages.
add_filter( 'astra_page_layout', function ( $layout ) {
	return ti_c26_is_active() ? 'no-sidebar' : $layout;
}, 99 );
add_filter( 'astra_get_content_layout', function ( $layout ) {
	return ti_c26_is_active() ? 'page-builder' : $layout;
}, 99 );
add_filter( 'astra_the_title_enabled', function ( $on ) {
	return ti_c26_is_active() ? false : $on;
}, 99 );
add_filter( 'body_class', function ( $classes ) {
	if ( ti_c26_is_active() ) {
		$classes[] = 'ti-c26-page';
	}
	return $classes;
} );

/* -------------------------------------------------------------------------
 * 3. Assets (only on 2026 pages)
 * ---------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', function () {
	if ( ! ti_c26_is_active() ) {
		return;
	}
	wp_enqueue_style(
		'ti-c26-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;1,8..60,400&display=swap',
		array(),
		null
	);
	// Unload the older course-page assets that child_enqueue_styles() adds to every course (priority 15).
	foreach ( array( 'ti-single-course-css', 'ti-review-css', 'ti-deposit-form-css', 'ti-single-course-new', 'ti-single-course-location-css' ) as $h ) {
		wp_dequeue_style( $h );
	}
	foreach ( array( 'ti-single-course-js', 'ti-new-review-js', 'ti-deposit-form-js' ) as $h ) {
		wp_dequeue_script( $h );
	}

	$dir = get_stylesheet_directory() . '/assets';
	$ver = function ( $rel ) use ( $dir ) {
		return file_exists( $dir . $rel ) ? (string) filemtime( $dir . $rel ) : TI_C26_VERSION;
	};
	wp_enqueue_style( 'ti-c26', TI_C26_URL . '/css/course-2026.css', array( 'ti-c26-fonts' ), $ver( '/css/course-2026.css' ) );
	wp_enqueue_script( 'ti-c26', TI_C26_URL . '/js/course-2026.js', array(), $ver( '/js/course-2026.js' ), true );
	wp_localize_script( 'ti-c26', 'tiC26', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'postId'  => get_queried_object_id(),
	) );
}, 99 );

/* -------------------------------------------------------------------------
 * 4. Template helpers
 * ---------------------------------------------------------------------- */

/** Inline SVG icon (Lucide; stroke uses currentColor). */
function ti_c26_icon( $name, $class = 'c26-icon' ) {
	static $icons = array(
		'arrow-right' => '<svg class="lucide lucide-arrow-right" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>',
		'award' => '<svg class="lucide lucide-award" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path><circle cx="12" cy="8" r="6"></circle></svg>',
		'briefcase' => '<svg class="lucide lucide-briefcase" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path><rect width="20" height="14" x="2" y="6" rx="2"></rect></svg>',
		'check' => '<svg class="lucide lucide-check" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"></path></svg>',
		'chevron-down' => '<svg class="lucide lucide-chevron-down" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"></path></svg>',
		'clock' => '<svg class="lucide lucide-clock" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
		'download' => '<svg class="lucide lucide-download" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>',
		'file-badge' => '<svg class="lucide lucide-file-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22h6a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M5 17a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path><path d="M7 16.5 8 22l-3-1-3 1 1-5.5"></path></svg>',
		'globe' => '<svg class="lucide lucide-globe" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path><path d="M2 12h20"></path></svg>',
		'laptop' => '<svg class="lucide lucide-laptop" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16"></path></svg>',
		'life-buoy' => '<svg class="lucide lucide-life-buoy" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="m4.93 4.93 4.24 4.24"></path><path d="m14.83 9.17 4.24-4.24"></path><path d="m14.83 14.83 4.24 4.24"></path><path d="m9.17 14.83-4.24 4.24"></path><circle cx="12" cy="12" r="4"></circle></svg>',
		'play' => '<svg class="lucide lucide-play" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="6 3 20 12 6 21 6 3"></polygon></svg>',
		'search' => '<svg class="lucide lucide-search" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>',
		'shield-check' => '<svg class="lucide lucide-shield-check" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path><path d="m9 12 2 2 4-4"></path></svg>',
		'star' => '<svg class="lucide lucide-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>',
		'user' => '<svg class="lucide lucide-user" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
		'users' => '<svg class="lucide lucide-users" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
	);
	if ( empty( $icons[ $name ] ) ) {
		return '';
	}
	$svg = preg_replace( '/\sclass="[^"]*"/', '', $icons[ $name ], 1 );
	return str_replace( '<svg', '<svg class="' . esc_attr( $class ) . '" aria-hidden="true" focusable="false"', $svg );
}

/** ACF link array -> <a>. Returns '' when the link is empty. */
function ti_c26_link( $link, $class = '', $inner_after = '' ) {
	if ( empty( $link['url'] ) ) {
		return '';
	}
	$target = ! empty( $link['target'] ) ? ' target="' . esc_attr( $link['target'] ) . '" rel="noopener"' : '';
	return sprintf(
		'<a href="%s" class="%s"%s>%s%s</a>',
		esc_url( $link['url'] ),
		esc_attr( $class ),
		$target,
		esc_html( $link['title'] ? $link['title'] : $link['url'] ),
		$inner_after
	);
}

/** Pick the FAQ repeater for the visitor's market (matches existing GB/ZA/NL/CA/FR fields). */
function ti_c26_faq_rows( $post_id ) {
	$country = '';
	if ( function_exists( 'get_user_geo_country_code' ) ) {
		$country = strtoupper( (string) get_user_geo_country_code() ); // Theme's own geo detection.
	}
	if ( ! $country && function_exists( 'wcpbc_get_woocommerce_country' ) ) {
		$country = wcpbc_get_woocommerce_country();
	} elseif ( ! $country && function_exists( 'WC' ) && WC()->customer ) {
		$country = WC()->customer->get_billing_country();
	}
	$map   = array( 'GB' => 'gb', 'ZA' => 'za', 'NL' => 'nl', 'CA' => 'ca', 'FR' => 'fr' );
	$field = isset( $map[ $country ] ) ? 'frequently_asked_questions_' . $map[ $country ] : 'frequently_asked_questions';
	$field = apply_filters( 'ti_c26_faq_field', $field, $country, $post_id );

	$rows = get_field( $field, $post_id );
	if ( empty( $rows ) && 'frequently_asked_questions' !== $field ) {
		$rows = get_field( 'frequently_asked_questions', $post_id );
	}
	return is_array( $rows ) ? array_filter( $rows, function ( $r ) {
		return ! empty( $r['question'] );
	} ) : array();
}

/** Countdown end as a UNIX timestamp in ms, or 0 when off / expired. */
function ti_c26_countdown_end( $post_id ) {
	if ( ! get_field( 'c26_countdown_enabled', $post_id ) ) {
		return 0;
	}
	$raw = get_field( 'c26_countdown_end', $post_id );
	if ( ! $raw ) {
		return 0;
	}
	try {
		$dt = new DateTimeImmutable( $raw, wp_timezone() );
	} catch ( Exception $e ) {
		return 0;
	}
	$ts = $dt->getTimestamp();
	return $ts > time() ? $ts * 1000 : 0;
}

/* -------------------------------------------------------------------------
 * 5. Pricing (country-aware, cache-safe)
 *
 * The page is rendered with prices for whoever filled the page cache; the JS
 * then calls ti_c26_quote, which runs uncached for this visitor, so
 * Price Based on Country always shows the right currency and amount.
 * ---------------------------------------------------------------------- */

/** Product IDs allowed on a given course page: [ main, [addons] ]. */
function ti_c26_products_for( $post_id ) {
	$main = get_field( 'course_product', $post_id, false ); // raw ID
	if ( is_array( $main ) ) {
		$main = reset( $main );
	}
	$main   = absint( $main );
	$addons = get_field( 'c26_addons', $post_id );
	$addons = is_array( $addons ) ? array_map( 'absint', $addons ) : array();
	return array( $main, array_values( array_filter( $addons ) ) );
}

/** Plain-text price ("€332.49"), with currency entities decoded so it displays correctly in HTML and JS. */
function ti_c26_money( $amount ) {
	return html_entity_decode( wp_strip_all_tags( wc_price( $amount ) ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
}

/** Display price + regular price for one product, as numbers. */
function ti_c26_product_prices( $product ) {
	$now = (float) wc_get_price_to_display( $product );
	$was = (float) wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) );
	return array( $now, max( $now, $was ) );
}

/** Build the full price payload used by both the template and the AJAX endpoint. */
function ti_c26_quote( $post_id, $selected = array() ) {
	list( $main_id, $addon_ids ) = ti_c26_products_for( $post_id );
	$out = array( 'ok' => false );
	if ( ! function_exists( 'wc_get_product' ) || ! $main_id ) {
		return $out;
	}
	$main = wc_get_product( $main_id );
	if ( ! $main || ! $main->is_purchasable() ) {
		return $out;
	}
	list( $now, $was ) = ti_c26_product_prices( $main );
	$total = $now;

	$addons = array();
	foreach ( $addon_ids as $id ) {
		$p = wc_get_product( $id );
		if ( ! $p || ! $p->is_purchasable() ) {
			continue;
		}
		list( $a_now, $a_was ) = ti_c26_product_prices( $p );
		$on = in_array( $id, $selected, true );
		if ( $on ) {
			$total += $a_now;
		}
		$addons[ $id ] = array(
			'name'  => $p->get_name(),
			'price' => ti_c26_money( ( $a_now ) ),
			'save'  => $a_was > $a_now ? ti_c26_money( ( $a_was - $a_now ) ) : '',
		);
	}

	return array(
		'ok'     => true,
		'now'    => ti_c26_money( ( $now ) ),
		'was'    => $was > $now ? ti_c26_money( ( $was ) ) : '',
		'saving' => $was > $now ? sprintf( 'Save %d%%', round( ( 1 - $now / $was ) * 100 ) ) : '',
		'total'  => ti_c26_money( ( $total ) ),
		'addons' => $addons,
	);
}

function ti_c26_read_request() {
	$post_id  = isset( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification
	$selected = isset( $_POST['addons'] ) ? array_map( 'absint', (array) wp_unslash( $_POST['addons'] ) ) : array(); // phpcs:ignore
	$viewable = 'publish' === get_post_status( $post_id ) || current_user_can( 'edit_post', $post_id );
	if ( ! $post_id || ! $viewable || ! ti_c26_is_active( $post_id ) ) {
		wp_send_json_error( array( 'message' => 'Unavailable' ), 400 );
	}
	list( , $allowed ) = ti_c26_products_for( $post_id );
	return array( $post_id, array_values( array_intersect( $selected, $allowed ) ) );
}

// No nonce on purpose: pages are cached, and these only read prices / add public products to the visitor's own cart
// (same as WooCommerce's own ?add-to-cart=).
add_action( 'wp_ajax_ti_c26_quote', 'ti_c26_ajax_quote' );
add_action( 'wp_ajax_nopriv_ti_c26_quote', 'ti_c26_ajax_quote' );
function ti_c26_ajax_quote() {
	nocache_headers();
	list( $post_id, $selected ) = ti_c26_read_request();
	wp_send_json_success( ti_c26_quote( $post_id, $selected ) );
}

add_action( 'wp_ajax_ti_c26_enrol', 'ti_c26_ajax_enrol' );
add_action( 'wp_ajax_nopriv_ti_c26_enrol', 'ti_c26_ajax_enrol' );
function ti_c26_ajax_enrol() {
	nocache_headers();
	list( $post_id, $selected ) = ti_c26_read_request();
	list( $main_id ) = ti_c26_products_for( $post_id );
	if ( ! $main_id || ! function_exists( 'WC' ) || ! WC()->cart ) {
		wp_send_json_error( array( 'message' => 'Cart unavailable' ), 500 );
	}
	// Standard WooCommerce add_to_cart: fires all hooks (Edwiser, gift rules, tracking, deposits).
	if ( ! ti_c26_in_cart( $main_id ) && false === WC()->cart->add_to_cart( $main_id, 1 ) ) {
		wp_send_json_error( array( 'message' => wp_strip_all_tags( implode( ' ', wp_list_pluck( wc_get_notices( 'error' ), 'notice' ) ) ) ), 400 );
	}
	foreach ( $selected as $id ) {
		if ( ! ti_c26_in_cart( $id ) ) {
			WC()->cart->add_to_cart( $id, 1 );
		}
	}
	$dest = 'cart' === get_field( 'c26_after_enrol', $post_id ) ? wc_get_cart_url() : wc_get_checkout_url();
	wp_send_json_success( array( 'redirect' => $dest ) );
}

function ti_c26_in_cart( $product_id ) {
	foreach ( WC()->cart->get_cart() as $item ) {
		if ( (int) $item['product_id'] === (int) $product_id ) {
			return true;
		}
	}
	return false;
}

/** Site logo for the sample certificate (Customizer logo, falling back to the brand SVG). */
function ti_c26_site_logo_img() {
	$id = (int) get_theme_mod( 'custom_logo' );
	if ( $id ) {
		return wp_get_attachment_image( $id, 'medium', false, array( 'alt' => 'The TEFL Institute' ) );
	}
	$src = apply_filters( 'ti_c26_logo_url', content_url( '/uploads/2023/06/TEFL-Logo_Institute.svg' ) );
	return '<img src="' . esc_url( $src ) . '" alt="The TEFL Institute" width="72">';
}