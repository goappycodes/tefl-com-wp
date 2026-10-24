<?php
/**
 * WELCOME exit-intent popup — 5% off a customer's first order.
 *
 * Loaded from functions.php. Goes with:
 *   assets/css/ti-welcome-exit-popup.css
 *   assets/js/ti-welcome-exit-popup.js
 *
 * The coupon itself is WooCommerce coupon "welcome" (5%, individual use,
 * one use per customer). This file adds the popup, applies the code to the
 * cart when the visitor claims it, and enforces "first order only".
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TI_WX_CODE', 'welcome' );

/** Paid order statuses that count as "has ordered before". */
function ti_wx_paid_statuses() {
	return array( 'wc-processing', 'wc-completed', 'wc-on-hold' );
}

/** Has this customer (by user ID or billing email) ordered before? */
function ti_wx_has_ordered( $user_id = 0, $email = '' ) {
	if ( ! function_exists( 'wc_get_orders' ) ) {
		return false;
	}
	if ( $user_id ) {
		$by_user = wc_get_orders( array( 'customer_id' => (int) $user_id, 'status' => ti_wx_paid_statuses(), 'limit' => 1, 'return' => 'ids' ) );
		if ( $by_user ) {
			return true;
		}
	}
	if ( $email && is_email( $email ) ) {
		$by_email = wc_get_orders( array( 'billing_email' => sanitize_email( $email ), 'status' => ti_wx_paid_statuses(), 'limit' => 1, 'return' => 'ids' ) );
		if ( $by_email ) {
			return true;
		}
	}
	return false;
}

/** Where the popup may appear. Used by functions.php to enqueue the assets. */
function ti_wx_should_show() {
	if ( is_admin() || ! function_exists( 'WC' ) ) {
		return false;
	}
	if ( is_checkout() || is_account_page() || is_wc_endpoint_url( 'order-received' ) ) {
		return false;
	}
	if ( is_user_logged_in() && ti_wx_has_ordered( get_current_user_id() ) ) {
		return false; // Not a first order any more.
	}
	return (bool) apply_filters( 'ti_wx_should_show', true );
}

/* ---------------------------------------------------------------------------
 * Popup markup
 * ------------------------------------------------------------------------ */
add_action( 'wp_footer', function () {
	if ( ! ti_wx_should_show() ) {
		return;
	}
	?>
	<div class="ti-wx" id="ti-wx" hidden>
		<div class="ti-wx__box" role="dialog" aria-modal="true" aria-labelledby="ti-wx-title" aria-describedby="ti-wx-text">
			<button type="button" class="ti-wx__x" data-ti-wx-close aria-label="Close">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg>
			</button>

			<div class="ti-wx__view" data-ti-wx-view="offer">
				<p class="ti-wx__eyebrow">Before you go</p>
				<h2 class="ti-wx__title" id="ti-wx-title">Take 5% off your first course</h2>
				<p class="ti-wx__text" id="ti-wx-text">Use this code at checkout on your first order with The TEFL Institute.</p>
				<div class="ti-wx__code">
					<span class="ti-wx__codeval">WELCOME</span>
					<button type="button" class="ti-wx__copy" data-ti-wx-copy>Copy</button>
				</div>
				<button type="button" class="ti-wx__btn" data-ti-wx-claim>Claim my 5% off</button>
				<button type="button" class="ti-wx__no" data-ti-wx-close>No thanks</button>
				<p class="ti-wx__fine">First order only. One use per customer. Cannot be combined with other codes.</p>
			</div>

			<div class="ti-wx__view" data-ti-wx-view="done" hidden>
				<p class="ti-wx__eyebrow">Code saved</p>
				<h2 class="ti-wx__title">5% off is on its way to your basket</h2>
				<p class="ti-wx__text">WELCOME will be applied when you add a course. You will see the discount at checkout.</p>
				<a class="ti-wx__btn" href="<?php echo esc_url( home_url( '/tefl-courses-overview/' ) ); ?>">Browse courses</a>
				<button type="button" class="ti-wx__no" data-ti-wx-close>Keep reading</button>
			</div>
		</div>
	</div>
	<?php
}, 50 );

/* ---------------------------------------------------------------------------
 * Claim: remember the code in the WooCommerce session and apply it now if
 * the cart already has something in it, otherwise when a course is added.
 * ------------------------------------------------------------------------ */
add_action( 'wp_ajax_ti_wx_claim', 'ti_wx_claim' );
add_action( 'wp_ajax_nopriv_ti_wx_claim', 'ti_wx_claim' );

function ti_wx_claim() {
	if ( ! function_exists( 'WC' ) || ! WC()->session ) {
		wp_send_json_error( array( 'applied' => false ) );
	}
	if ( ! WC()->session->has_session() ) {
		WC()->session->set_customer_session_cookie( true );
	}
	WC()->session->set( 'ti_wx_pending', 1 );

	$applied = false;
	if ( WC()->cart && ! WC()->cart->is_empty() ) {
		$applied = ti_wx_apply();
	}
	wp_send_json_success( array( 'applied' => $applied, 'cart' => wc_get_cart_url() ) );
}

function ti_wx_apply() {
	if ( ! WC()->cart || WC()->cart->has_discount( TI_WX_CODE ) ) {
		return true;
	}
	$ok = WC()->cart->apply_coupon( TI_WX_CODE );
	if ( $ok && WC()->session ) {
		WC()->session->set( 'ti_wx_pending', 0 );
	}
	return (bool) $ok;
}

add_action( 'woocommerce_add_to_cart', function () {
	if ( WC()->session && WC()->session->get( 'ti_wx_pending' ) ) {
		ti_wx_apply();
	}
}, 20 );

/* ---------------------------------------------------------------------------
 * First order only.
 * ------------------------------------------------------------------------ */

/* Logged-in customers with a previous paid order cannot use the code. */
add_filter( 'woocommerce_coupon_is_valid', function ( $valid, $coupon ) {
	if ( ! $valid || TI_WX_CODE !== strtolower( $coupon->get_code() ) ) {
		return $valid;
	}
	if ( is_user_logged_in() && ti_wx_has_ordered( get_current_user_id() ) ) {
		throw new Exception( __( 'The WELCOME code is for your first order only.', 'teflinstitute' ) );
	}
	return $valid;
}, 10, 2 );

/* Guests: check the billing email when they place the order. */
add_action( 'woocommerce_after_checkout_validation', function ( $data, $errors ) {
	if ( ! WC()->cart || ! WC()->cart->has_discount( TI_WX_CODE ) ) {
		return;
	}
	$email = isset( $data['billing_email'] ) ? $data['billing_email'] : '';
	if ( ti_wx_has_ordered( get_current_user_id(), $email ) ) {
		WC()->cart->remove_coupon( TI_WX_CODE );
		$errors->add( 'ti_wx_first_order', __( 'The WELCOME code is for your first order only, so it has been removed. Please review your total and place the order again.', 'teflinstitute' ) );
	}
}, 10, 2 );
