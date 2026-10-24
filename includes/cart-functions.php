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

        if ($exception_coupon) {
            $exception_coupons = array_map('trim', explode(',', strtolower($exception_coupon)));
            if (in_array(strtolower($coupon->get_code()), $exception_coupons)) {
                return $valid;
            }
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

// Apply 12% dicount on cart total 

// add_action('woocommerce_cart_calculate_fees', 'apply_custom_discount');
function apply_custom_discount() {
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    if (!WC()->cart || WC()->cart->get_cart_contents_count() == 0) {
        return;
    }

    // List of product IDs to exclude from discount
    $excluded_product_ids = array(9306,9305,7898,82737,10050,70826,70827,70833,70835,76863,4524,4522,4521,4515,56708,63558,84816,76824,83372,83375,7110);

    foreach (WC()->cart->get_cart() as $cart_item) {
        if (in_array($cart_item['product_id'], $excluded_product_ids)) {
            return; 
        }
    }

    $discount = WC()->cart->subtotal * 0.12;
    if ($discount > 0) {
        WC()->cart->add_fee(__('12% Discount', 'teflinstitute'), -$discount);
    }
}

// Add slected courses to order meta
add_filter('woocommerce_add_cart_item_data', 'save_selected_courses_to_cart', 10, 3);
function save_selected_courses_to_cart($cart_item_data, $product_id, $variation_id) {
    if (isset($_GET['selected_courses']) && !empty($_GET['selected_courses'])) {
        $cart_item_data['selected_courses'] = sanitize_text_field($_GET['selected_courses']);
    } else {
        // Fallback: select-two diploma products must always enrol at least the default 60-hour pair,
        // even when the front-end selection param is missing (e.g. the flexible-booking add-to-cart path).
        $select_two_parent_products = array(1099, 2706, 71000);
        if (in_array((int) $product_id, $select_two_parent_products, true)) {
            $cart_item_data['selected_courses'] = '62238,70828';
        }
    }
    return $cart_item_data;
}

add_action('woocommerce_checkout_order_created', 'save_selected_courses_to_order_meta', 10, 1);
function save_selected_courses_to_order_meta($order) {
    $all_selected_courses = [];
    
    foreach ($order->get_items() as $item) {
        $item_courses = '';
        
        $cart_item_data = $item->get_meta('_cart_item_data');
        if ($cart_item_data && isset($cart_item_data['selected_courses'])) {
            $item_courses = $cart_item_data['selected_courses'];
        }
        
        
        if (!empty($item_courses)) {
            $course_array = array_map('trim', explode(',', $item_courses));
            $all_selected_courses = array_merge($all_selected_courses, $course_array);
        }
    }
    
    if (!empty($all_selected_courses)) {
        $unique_courses = array_unique(array_filter($all_selected_courses));
        $order->update_meta_data('_selected_courses', implode(',', $unique_courses));
        $order->save();
        error_log('Saved selected courses to order meta: ' . implode(',', $unique_courses));
    } else {
        error_log('No selected courses found in cart items');
    }
}

add_action('woocommerce_checkout_create_order_line_item', 'preserve_cart_data_in_order_item', 10, 4);
function preserve_cart_data_in_order_item($item, $cart_item_key, $values, $order) {
    if (isset($values['selected_courses'])) {
        $item->update_meta_data('_cart_item_data', $values);
    }
}

// Auto-enroll user in selected courses after purchase
add_action('woocommerce_order_status_completed', 'auto_enroll_selected_courses', 20);
function auto_enroll_selected_courses($order_id) {
    error_log("Starting enrolment for order ID: $order_id");

    $order = wc_get_order($order_id);
    if (!$order) {
        error_log("Order not found: $order_id");
        return;
    }

    $selected_courses_meta = $order->get_meta('_selected_courses');

    if (empty($selected_courses_meta)) {
        error_log("No selected course data found in order meta");
        return;
    }
    error_log("Selected courses meta: " . print_r($selected_courses_meta, true));

    $product_ids = [];
    if (is_array($selected_courses_meta)) {
        if (isset($selected_courses_meta[0])) {
            $product_ids = array_map('intval', explode(',', $selected_courses_meta[0]));
        } else {
            error_log("Selected courses meta is array but doesn't have expected structure");
            return;
        }
    } else {
        $product_ids = array_map('intval', explode(',', sanitize_text_field($selected_courses_meta)));
    }

    error_log("Extracted product IDs: " . implode(', ', $product_ids));

    if (empty($product_ids)) {
        error_log("No valid product IDs extracted");
        return;
    }

    $course_ids = [];
    foreach ($product_ids as $product_id) {
        if (empty($product_id)) continue;
        
        $product_options = get_post_meta($product_id, 'product_options', true);
        error_log("Product $product_id options: " . print_r($product_options, true));

        if (!empty($product_options) && is_array($product_options) && !empty($product_options['moodle_course_id'])) {
            $moodle_course_id = $product_options['moodle_course_id'];
            
            if (is_array($moodle_course_id)) {
                foreach ($moodle_course_id as $course_id) {
                    if (!empty($course_id) && is_numeric($course_id)) {
                        $course_ids[] = (int) $course_id;
                    }
                }
            } elseif (is_string($moodle_course_id) && strpos($moodle_course_id, ',') !== false) {
                $course_array = array_map('trim', explode(',', $moodle_course_id));
                foreach ($course_array as $course_id) {
                    if (!empty($course_id) && is_numeric($course_id)) {
                        $course_ids[] = (int) $course_id;
                    }
                }
            } else {
                $course_ids[] = (int) $moodle_course_id;
            }
        } else {
            error_log("Missing or invalid product options for product ID: $product_id");
        }
    }

    $course_ids = array_unique($course_ids);
    error_log("Resolved Moodle course IDs: " . implode(', ', $course_ids));

    if (empty($course_ids)) {
        error_log("No Moodle course IDs resolved from product metadata");
        return;
    }

    $user_id = $order->get_user_id();
    if (empty($user_id)) {
        error_log("No user ID found for order");
        return;
    }

    $moodle_user_id = get_user_meta($user_id, 'moodle_user_id', true);
    error_log("Mapped WP user ID $user_id to Moodle user ID $moodle_user_id");

    if (empty($moodle_user_id)) {
        error_log("Moodle user ID not found in user meta for user ID $user_id");
        return;
    }

    $token = 'e6ce05fbc91ffda8b70ac55a1ee526b4';
    $url = 'https://courses.teflinstitute.com/webservice/rest/server.php';
    $function = 'enrol_manual_enrol_users';

    foreach ($course_ids as $course_id) {
        // Prepare API parameters - base parameters
        $params = array(
            'wstoken' => $token,
            'wsfunction' => $function,
            'moodlewsrestformat' => 'json'
        );
        
        $enrolment = array(
            'roleid' => 5,
            'userid' => intval($moodle_user_id),
            'courseid' => intval($course_id),
        );
        
        $request_data = $params;
        foreach ($enrolment as $key => $value) {
            $request_data["enrolments[0][$key]"] = $value;
        }

        error_log("Sending enrolment request: " . print_r($request_data, true));
        $response = wp_remote_post($url, array(
            'body' => $request_data,
            'timeout' => 45
        ));

        if (is_wp_error($response)) {
            error_log("Enrollment API error for course $course_id: " . $response->get_error_message());
        } else {
            $http_code = wp_remote_retrieve_response_code($response);
            $response_body = wp_remote_retrieve_body($response);
            
            if ($http_code == 200) {
                if (empty($response_body)) {
                    error_log("Successfully enrolled user $moodle_user_id in course $course_id (empty response indicates success)");
                } else {
                    error_log("Enrollment API response for course $course_id: $response_body");
                    
                    if (strpos($response_body, 'exception') !== false) {
                        error_log("API returned an error for course $course_id: $response_body");
                    } else {
                        error_log("Successfully enrolled user $moodle_user_id in course $course_id");
                    }
                }
            } else {
                error_log("Enrollment API returned non-200 status code ($http_code) for course $course_id: $response_body");
            }
        }
    }

    if (!session_id() && !headers_sent()) {
        session_start();
    }

    if (isset($_SESSION['selected_courses'])) {
        unset($_SESSION['selected_courses']);
    }

    error_log("Cleared session data for selected courses");

    error_log("Finished enrolment for order ID: $order_id");
}

add_action('woocommerce_before_calculate_totals', 'apply_cart_item_addon_price', 10, 1);
function apply_cart_item_addon_price($cart) {
    if (is_admin() && !defined('DOING_AJAX')) return;
    if (empty($cart->cart_contents)) return;

    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        if (isset($cart_item['addon_price']) && $cart_item['addon_price'] > 0) {
            $cart_item['data']->set_price($cart_item['addon_price']);
        }
    }
}

add_filter('woocommerce_add_cart_item_data', 'add_addon_price_to_cart_item', 10, 3);
function add_addon_price_to_cart_item($cart_item_data, $product_id, $variation_id) {
    if (isset($_GET['addon_price'])) {
        $cart_item_data['addon_price'] = floatval($_GET['addon_price']);
    }
    return $cart_item_data;
}

add_filter('woocommerce_cart_item_price', 'display_cart_item_addon_price', 20, 3);
function display_cart_item_addon_price($price_html, $cart_item, $cart_item_key) {
    if (isset($cart_item['addon_price'])) {
        return wc_price($cart_item['addon_price']);
    }
    return $price_html;
}

add_filter('woocommerce_checkout_cart_item_quantity', 'display_checkout_item_addon_price', 20, 3);
function display_checkout_item_addon_price($item_quantity, $cart_item, $cart_item_key) {
    if (isset($cart_item['addon_price'])) {
        return wc_price($cart_item['addon_price']);
    }
    return $item_quantity;
}

