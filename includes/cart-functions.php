<?php

function get_first_payment_amount(){
    $currency = get_woocommerce_currency();
    if ($currency == 'ZAR'){
        return 199; 
    } else {
        return 9.99;
    }
}

function get_first_payment_amount_new(){
    $currency = get_woocommerce_currency();
    if ($currency == 'ZAR'){
        return 799; 
    } else {
        return 39.95;
    }
}



add_action( 'woocommerce_proceed_to_checkout', 'bbloomer_display_coupon_form_below_proceed_checkout', 1 );
 
function bbloomer_display_coupon_form_below_proceed_checkout() {
    ?>
      <form class="woocommerce-coupon-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
         <?php if ( wc_coupons_enabled() ) { ?>
            <h4>Have a Coupon code?</h4>
            <div class="coupon under-proceed">
               <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>"/> 
               <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>" style="width: 100%"><?php esc_attr_e( 'Apply', 'woocommerce' ); ?></button>
            </div>
         <?php } ?>
      </form>
      <a style="display:none" target="_blank" href="/discount-tefl-coupon-codes" class="coupon-page-link">View available coupons</a>
    <?php
}


add_action( 'woocommerce_after_cart_table', 'custom_woocommerce_empty_cart_button' );
function custom_woocommerce_empty_cart_button() {
	echo '<a href="' . esc_url( add_query_arg( 'empty_cart', 'yes' ) ) . '" class="button empty-cart-btn" title="' . esc_attr( 'Empty Cart', 'woocommerce' ) . '">' . esc_html( 'Empty Cart', 'woocommerce' ) . '</a>';
}

add_action( 'wp_loaded', 'custom_woocommerce_empty_cart_action', 20 );
function custom_woocommerce_empty_cart_action() {
	if ( isset( $_GET['empty_cart'] ) && 'yes' === esc_html( $_GET['empty_cart'] ) ) {
		WC()->cart->empty_cart();

		$referer  = wp_get_referer() ? esc_url( remove_query_arg( 'empty_cart' ) ) : wc_get_cart_url();
		wp_safe_redirect( $referer );
	}
}

add_action('woocommerce_cart_is_empty', 'ti_custom_wc_empty_cart_text', 999 );
/* Create custom WooCommerce empty cart page */
function ti_custom_wc_empty_cart_text() { 
    ?>
    <div class="empty-cart">
        <h2>Your Cart is empty.</h2>
        <a class="btn btn-primary" href="/tefl-courses"><p>Shop Now</p></a>
        <img src="/wp-content/uploads/2021/11/open.png">
    </div> 
   <?php
}



add_action( 'woocommerce_cart_loaded_from_session', 'prefix_cart_order_prod_cat' );
/**
 * WooCommerce - sort cart order by price
 * @link https://stackoverflow.com/questions/17194899/woocommerce-cart-page-display-products-order-by-product-price/57136404#57136404
 */
function prefix_cart_order_prod_cat() {

    $products_in_cart = array();
    // Assign each product's price to its cart item key (to be used again later)
    foreach ( WC()->cart->cart_contents as $key => $item ) {
        $product = wc_get_product( $item['product_id'] );
        $products_in_cart[ $key ] = $product->get_price();
    }

    // SORTING - use one or the other two following lines:
    //asort( $products_in_cart ); // sort low to high
   arsort( $products_in_cart ); // sort high to low

    // Put sorted items back in cart
    $cart_contents = array();
    foreach ( $products_in_cart as $cart_key => $price ) {
       $cart_contents[ $cart_key ] = WC()->cart->cart_contents[ $cart_key ];
    }

    WC()->cart->cart_contents = $cart_contents;

}

// Add a settings page to the admin menu
function custom_coupon_settings_page() {
    add_submenu_page(
        'woocommerce',
        'Custom Coupon Settings',
        'Custom Coupon Settings',
        'manage_options',
        'custom-coupon-settings',
        'render_custom_coupon_settings_page'
    );
}
add_action( 'admin_menu', 'custom_coupon_settings_page' );

// Render the settings page
function render_custom_coupon_settings_page() {
    ?>
    <div class="wrap">
        <h1>Custom Coupon Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'custom-coupon-settings-group' ); ?>
            <?php do_settings_sections( 'custom-coupon-settings-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Target Coupon Code (Coupon for full payment discount)</th>
                    <td><input type="text" name="target_coupon_code" value="<?php echo esc_attr( get_option( 'target_coupon_code' ) ); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register and save the settings
function custom_register_settings() {
    register_setting( 'custom-coupon-settings-group', 'target_coupon_code' );
}
add_action( 'admin_init', 'custom_register_settings' );

// Check for duplicate variations and replace the previous item with the new item
add_filter('woocommerce_add_cart_item_data', 'check_and_replace_duplicate_variation', 10, 2);
function check_and_replace_duplicate_variation($cart_item_data, $product_id) {
   foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
       if ( $cart_item['product_id'] === $product_id ) {
           $product = wc_get_product( $product_id );
           $product_name = $product->get_name(); 
           
           WC()->cart->remove_cart_item( $cart_item_key );
           break; 
       }
   }

   return $cart_item_data; 
}


//Custom coupon validity check
add_filter('woocommerce_coupon_is_valid', 'custom_coupon_validity', 10, 2);

function custom_coupon_validity($valid, $coupon) {
    global $woocommerce;

    // Check if the cart is empty
    if ($woocommerce->cart->is_empty()) {
        return $valid;
    }

    $all_products_disabled = true;
    $target_coupon_code = get_option( 'target_coupon_code' );
    $is_target_coupon = $coupon->get_code() === $target_coupon_code;
    $valid_product_ids = $coupon->get_product_ids();
    $valid_product_ids = $valid_product_ids ?? [];

    foreach ($woocommerce->cart->get_cart() as $cart_item) {
        $product_id = $cart_item['product_id'];
        $disable_coupon_code = get_field('disable_coupon_code', $product_id);
        $exception_coupon = get_field('exception', $product_id);

        if ($exception_coupon && in_array(strtolower($coupon->get_code()), explode(',', strtolower($exception_coupon)))) {
            return $valid;
        }

        if (!$disable_coupon_code) {
            $all_products_disabled = false;
        }

        // Check if the coupon being processed is the target coupon
        //coupon code to be only be valid if full payment is selected
        if ($is_target_coupon) {
            $is_deposit = isset( $cart_item['is_deposit'] ) ? $cart_item['is_deposit'] : '';

            if (empty($is_deposit) && in_array($cart_item['product_id'], $valid_product_ids)) {
                return $valid;
            }
        }
    }

    if ($is_target_coupon || $all_products_disabled) {
        return false;
    }

    return $valid;
}

// Add payment method to order notes
function add_payment_method_to_order_notes( $order_id ) {
    $order = wc_get_order( $order_id );
    $payment_method = $order->get_payment_method();

    $order_notes = wc_get_order_notes( array(
        'order_id' => $order_id,
    ) );

    $note_exists = false;
    foreach ( $order_notes as $note ) {
        if ( strpos( $note->content, 'Payment Method:' ) !== false ) {
            $note_exists = true;
            break;
        }
    }

    if ( ! empty( $payment_method ) && ! $note_exists ) {
        $order->add_order_note( 'Payment Method: ' . $payment_method );
        $order->save();
    }
}
add_action( 'woocommerce_order_status_completed', 'add_payment_method_to_order_notes', 10, 1 );




