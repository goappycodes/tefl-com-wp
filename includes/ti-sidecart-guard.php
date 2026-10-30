<?php
/**
 * Side Cart (side-cart-woocommerce) guard.
 *
 * WooCommerce doesn't load a cart when the URL contains "wp-json/" (it treats the request as a REST call),
 * but a malformed URL such as /cart/wp-json/wc/store/v1/products still renders the 404 page, and Side Cart's
 * footer markup then calls WC()->cart->get_cart() on null, a fatal error. Skip the markup when there is no cart.
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_footer', function () {
    if (function_exists('WC') && null === WC()->cart && function_exists('xoo_wsc_frontend')) {
        remove_action('wp_footer', array(xoo_wsc_frontend(), 'cart_markup'));
    }
}, 1);
