<?php

use \app\wisdmlabs\edwiserBridge\EdwiserBridge;

// add_action( 'woocommerce_api_create_customer', 'teflInstitutemanualUserEnrolment', 99, 2);

function teflInstitutemanualUserEnrolment($customer_id, $data ){
    
    $new_user = get_userdata( $customer_id );
    $first_name = $new_user->first_name;
    $last_name = $new_user->last_name;
    
    $user_data = array(
        'firstname' => $first_name,
        'lastname'  => $last_name,
        'password'  => $data['password'],
        'username'  => $data['email'],
        'email'     => $data['email'],
        'auth'      => 'manual',
    );
    
    $edwiser_bridge = new EdwiserBridge();
	$moodle_user = $edwiser_bridge->userManager()->createMoodleUser($user_data);
	if (isset($moodle_user['user_created']) && $moodle_user['user_created'] == 1 && is_object($moodle_user['user_data'])) {
        update_user_meta($customer_id, 'moodle_user_id', $moodle_user['user_data']->id);
    }
    

}

add_action('woocommerce_api_create_order', 'teflInstitutemanualOrderEnrolment', 99, 1);

function teflInstitutemanualOrderEnrolment($order_id, $data){

    $posted_data = [];
    
    if ($order_id){
        
        $order = wc_get_order($order_id);
        
        update_post_meta($order_id, '_billing_address_1',   isset($data['address'])     ? $data['address']      : "" );
        update_post_meta($order_id, '_billing_phone',       isset($data['phone'])       ? $data['phone']        : "" );
        update_post_meta($order_id, '_billing_firstname',   isset($data['first_name'])  ? $data['first_name']   : "" );
        update_post_meta($order_id, '_billing_lastname',    isset($data['last_name'])   ? $data['last_name']    : "" );
        
        if ($order){
            
            delete_post_meta($order_id, '_is_processed');        
            
            $ordermanager = new NmBridgeWoocommerce\BridgeWoocommerceOrderManager("woocommerce-integration", "1.0.0");
    
            $order->update_status('completed');
            
            // $ordermanager->createMoodleUserForCreatedCustomer($order_id, $posted_data);
            $ordermanager->handleOrderComplete($order_id);
            
            return true;
        }
    }    
    
    return false;
}

// add_filter( 'woocommerce_default_address_fields', 'customising_checkout_fields', 1000, 1 );
// function customising_checkout_fields( $address_fields ) {
//     $address_fields['first_name']['required'] = true;
//     $address_fields['last_name']['required'] = true;
//     $address_fields['country']['required'] = true;
//     $address_fields['city']['required'] = true;
//     $address_fields['state']['required'] = true;
//     $address_fields['postcode']['required'] = true;

//     return $address_fields;
// }

add_filter( 'woocommerce_checkout_fields' , 'misha_not_required_fields', 9999 );

function misha_not_required_fields( $f ) {
	
	unset( $f['billing']['billing_address_1']['required'] ); // that's it
	unset( $f['billing']['billing_address_2']['required'] );

	// the same way you can make any field required, example:
	// $f['billing']['billing_company']['required'] = true;
	
	return $f;
}


function sshow_sale_price_at_checkout( $subtotal, $cart_item, $cart_item_key ) {
    
    $product = $cart_item['data'];
    $quantity = $cart_item['quantity'];
    if ( ! $product ) {
        return $subtotal;
    }
    $regular_price = $sale_price = $suffix = '';
    
    // $regular_price    = $product->get_price() * $quantity;
    // $sale_price       = $product->get_sale_price() * $quantity;
    
    if ( $product->is_on_sale() && ! empty( $sale_price ) ) {
        $price = wc_format_sale_price(
                     wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price(), 'qty' => $quantity ) ),
                     wc_get_price_to_display( $product, array( 'qty' => $quantity ) )
                 ) . $product->get_price_suffix();
    } else {
        $price = wc_price( $regular_price ) . $product->get_price_suffix();
    }
    
    $percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
   
    $price = sprintf( __(' Save %s', 'woocommerce' ), $percentage . '%' ) . $price . $suffix;
    return $price;
}
//add_filter( 'woocommerce_cart_item_price', 'sshow_sale_price_at_checkout', 10, 3 );


/* REMOVING DOB FIELD FROM CHECKOUT */
// add_filter( 'woocommerce_checkout_fields' , 'ti_custom_override_checkout_fields_checkout', 99);
// function ti_custom_override_checkout_fields_checkout( $fields ) {
//     $fields['date_of_birth']['priority'] = 41;
//     return $fields;
// }


/*CHECKOUT FORM DOB START*/
add_action('woocommerce_after_order_notes', 'tefl_dob_checkout_field');
function tefl_dob_checkout_field($checkout) {
    foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
        $_product = $values['data'];
        $_product_id = $_product->id;       
    }

    $reqd = true;

    if ($_product_id == 1788) {
        $reqd = false;
    }

    $dob_value = $checkout->get_value('date_of_birth');
    
    $field_class = "";

    echo '<div id="customise_checkout_field">';
    woocommerce_form_field('date_of_birth', array(
        'type' => 'date',
        'class' => array('date_of_birth form-row-wide', $field_class), 
        'label' => __( 'Date Of Birth (We\'re required to collect so that we can verify your identity.)' ),
        'placeholder' => __('Select Date'),
        'required' => $reqd,
    ), $dob_value);
    echo '</div>';
}


 add_action('woocommerce_checkout_process', 'tefl_checkout_dob_validate');
function tefl_checkout_dob_validate() {
  if (!$_POST['date_of_birth']) 
  	wc_add_notice(__('<strong>Billing Date of Birth</strong> is a required field.') , 'error');
} 

/*Save DOB into User Meta*/
add_action( 'woocommerce_checkout_update_user_meta', 'tefl_checkout_dob_update_usermeta' );
function tefl_checkout_dob_update_usermeta( $user_id ) { 
	if ( $user_id && $_POST['date_of_birth'] ) 
		update_user_meta( $user_id, 'date_of_birth', sanitize_text_field($_POST['date_of_birth']) );
}

/*Update order meta with field value*/
add_action( 'woocommerce_checkout_update_order_meta', 'tefl_checkout_dob_update_order_meta' );
function tefl_checkout_dob_update_order_meta( $order_id ) { 
	if ( $_POST['date_of_birth'] )
		update_post_meta( $order_id, 'date_of_birth', sanitize_text_field($_POST['date_of_birth']) );
}

/*Display DOB at Order Meta*/
add_action( 'woocommerce_admin_order_data_after_billing_address', 'tefl_checkout_dob_display_admin_order_meta', 10, 1 );
function tefl_checkout_dob_display_admin_order_meta( $order ) {    
	echo '<p><strong>'.__('Date Of Birth').':</strong> </br>' . get_post_meta( $order->id, 'date_of_birth', true ) . '</p>';
}
/*CHECKOUT FORM DOB END*/


/*TEFL OVERRIDE CHECKOUT FIELDS*/
// add_filter( 'woocommerce_checkout_fields' , 'tefl_override_checkout_fields' );
function tefl_override_checkout_fields( $fields ) {
	$fields['account']['account_username']['label'] = 'Username (lowercase only, no spaces)';
  	return $fields;
}

add_filter( 'woocommerce_thankyou_order_received_text', 'ti_thank_you_order_received_text', 10, 2 );
function ti_thank_you_order_received_text($var, $order) {
    $debug_mode = isset($_GET['debug']) ? true : false;
    $order_id = $order->id;
    $is_course_extended = get_post_meta($order_id, 'is_course_extended', true);
    if('yes' != $is_course_extended){
        $var = 'Thank you. Your order has been received and you’ll receive a confirmation email shortly.';
        return $var ;
    }
    return $var;
}


add_action( 'woocommerce_email_heading_customer_completed_order', 'prz_edit_elt_heading_text', 10, 2);
function prz_edit_elt_heading_text( $email_heading, $order_id ){
    # Get an instance of WC_Order object
    $order = wc_get_order( $order_id );

    # Iterating through each order items (WC_Order_Item_Product objects in WC 3+)
    foreach ( $order->get_items() as $item_id => $item_values ) {

        // Product_id
        $product_id = $item_values->get_product_id(); 

        # Targeting a defined product ID
        if ( $product_id === 1788 ) {
            $email_heading = 'Thanks for trying out our English Level Test';
        }
    }
    
    return $email_heading;
}


/* 
 * @author: Przemysław Solan
 * @date: 07/10/2021
 */
// shows the product price on sale (if any) in the checkout table

add_filter( 'woocommerce_cart_item_price', 'show_sale_price_at_checkout', 10, 3 );
function show_sale_price_at_checkout( $subtotal, $cart_item, $cart_item_key ) {
    
    // gets the product object
    $product = $cart_item['data'];
    // get the quantity of the product in the cart
    $quantity = $cart_item['quantity'];

    // check if the object exists
    if ( ! $product ) {
        return $subtotal;
    }

    // check if the product is on sale
    if ( $product->is_on_sale() && ! empty( $product->get_sale_price() ) ) {
        // shows sale price and regular price       
        $price = wc_format_sale_price (
            // regular price
            wc_get_price_to_display(
                $product, array(
                    'price' => $product->get_regular_price(),
                    'qty' => $quantity
                    )
                ),
            // sale price
            wc_get_price_to_display( $product, array (
                'price' => $product->get_sale_price(),
                'qty' => $quantity
                )
            )
        ) . $product->get_price_suffix() . __('<span class="percentage test">Save ' . round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 ) . '%</span>');
    } else {
        // shows regular price
        $price = wc_price (
            // regular price
            wc_get_price_to_display(
                $product, array (
                    'price' => $product->get_regular_price(),
                    'qty' => $quantity
                )
            )
        ) . $product->get_price_suffix();
    }
   
    return $price;
}

/* EMPTY CART BUTTON */
add_action( 'woocommerce_cart_actions', 'tefl_woocommerce_empty_cart_button' );
function tefl_woocommerce_empty_cart_button() {
	echo '<a href="' . esc_url( add_query_arg( 'empty_cart', 'yes' ) ) . '" class="button empty-cart-button" title="' . esc_attr( 'Empty Cart', 'woocommerce' ) . '">' . esc_html( 'Empty Cart', 'woocommerce' ) . '</a>';
}

add_action( 'wp_loaded', 'tefl_woocommerce_empty_cart_action', 20 );
function tefl_woocommerce_empty_cart_action() {
	if ( isset( $_GET['empty_cart'] ) && 'yes' === esc_html( $_GET['empty_cart'] ) ) {
		WC()->cart->empty_cart();

		$referer  = wp_get_referer() ? esc_url( remove_query_arg( 'empty_cart' ) ) : wc_get_cart_url();
		wp_safe_redirect( $referer );
	}
}
/* /EMPTY CART BUTTON */

/*Filter Related Products start*/


add_action('wp_head', 'ti_enable_save_card_details');
function ti_enable_save_card_details(){

    if ( !is_checkout() || is_null( WC()->cart ) ) return;
    $items = WC()->cart->get_cart();
    
    foreach($items as $item => $values) { 
    
        if($values['is_deposit'] == 1){ ?>
            <script>
                jQuery(document).ready(function($){
                    
                    setTimeout(function(){ 
                        $('input#wc-stripe-new-payment-method').prop('checked', true);
                    }, 1000);
                    
                })
            </script>
        <?php }
    } 
}


function ptefl_filter_woocommerce_email_enabled_customer_new_account( $enabled, $user, $email ) { 
    // Only run in the Cart or Checkout pages
    if ( is_cart() || is_checkout() ) {
        $enabled = false;
    }
    
    return $enabled;
}
add_filter( 'woocommerce_email_enabled_customer_new_account', 'ptefl_filter_woocommerce_email_enabled_customer_new_account' , 10, 3 );



// add_filter( 'woocommerce_cart_product_price', 'filter_woocommerce_cart_product_price', 10, 2 ); 

function filter_woocommerce_cart_product_price( $wc_price, $product ) { 
    
    foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
        $price_html = ''; 
        $remaining_amount = '';
        $deposit_enabled = get_post_meta($cart_item['product_id'], '_wc_deposit_enabled', true);
        $deposit_payment_plan = '';

        if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional') {
            $deposit_payment_plan = get_post_meta($cart_item['product_id'], '_wc_deposit_payment_plans', true);
            $deposit_payment_plan = $deposit_payment_plan[0];
        }
        if ( ! empty( $cart_item['is_deposit']  ) ) {
            //$quantity       = $cart_item['quantity'];
            $full_amount    = $cart_item['full_amount'];
            $deposit_amount = apply_filters( 'woocommerce_deposits_get_deposit_amount', $cart_item['deposit_amount'], $cart_item['data'] );
            $remaining_amount = $full_amount - $deposit_amount;
            $remaining_amount = wc_price( $remaining_amount );

            if(($remaining_amount)&&($product->get_id() == $cart_item['product_id'])){
                $price_html .= '<span class="now-txt '.$deposit_payment_plan.'"> Now</span><div class="remaining-amt"><small>'.$remaining_amount.' <span class="remaining-days">Payable in 30days</span></small></div>';
                return $wc_price.$price_html; 
            }
        }
        
    }
    return $wc_price;
}
         

//add_filter( 'woocommerce_order_formatted_line_subtotal', 'ti_display_item_total_payable', 999, 3 );

function ti_display_item_total_payable( $subtotal, $item, $order ) {
    if ( ! isset( $item['deposit_full_amount'] ) ) {
        return $subtotal;
    }

    if ( ! empty( $item['is_deposit'] ) ) {
        $_product    = wc_get_product( $item['product_id'] );
        $quantity    = $item['qty'];
        $full_amount = 'excl' === get_option( 'woocommerce_tax_display_cart' ) ? $item['deposit_full_amount_ex_tax'] : $item['deposit_full_amount'];
        //$deposit_amount = apply_filters( 'woocommerce_deposits_get_deposit_amount', $item['deposit_amount'], $item['data'] );
        $deposit_amount = $item['deposit_amount'];
        $remaining_amount = $full_amount - $deposit_amount;
        //$remaining_amount = wc_price( $remaining_amount );
        if ( ! empty( $item['payment_plan'] ) ) {
            $plan = new WC_Deposits_Plan( $item['payment_plan'] );
            $subtotal .= '<br/><small>' . $plan->get_formatted_schedule( $remaining_amount ) . '</small>';
        } else {
            $subtotal .= '<br/><small>' . sprintf( __( '%s payable in total', 'woocommerce-deposits' ), wc_price( $remaining_amount ) ) . '</small>';
        }
    }

    return $subtotal;
}

function ti_change_partially_paid_order_status_to_completed( $order_id ) {  
    if ( ! $order_id ) {return;}            
    $order = wc_get_order( $order_id );
    $message = 'Order id: ' . $order_id . " and Order Status: " . $order->get_status();
    ti_woocommerce_order_event_log($message, 'a', 'woo-order-log');
    if( 'partial-payment'== $order->get_status() ) {
        $order->update_status( 'wc-completed' );
    }
}

//add_action('woocommerce_thankyou','ti_change_partially_paid_order_status_to_completed');

add_action( 'woocommerce_payment_complete', 'ti_change_partially_paid_order_status_to_completed' );



function tefl_remove_class_action($action,$class,$method) { 
    global $wp_filter ;
    if (isset($wp_filter[$action])) {
        $len = strlen($method) ;
        foreach ($wp_filter[$action] as $pri => $actions) {
            
            foreach ($actions as $name => $def) {
                if (substr($name,-$len) == $method) {
                    if (is_array($def['function'])) {
                        if (get_class($def['function'][0]) == $class) {

                            if (is_object($wp_filter[$action]) && isset($wp_filter[$action]->callbacks)) {
                                unset($wp_filter[$action]->callbacks[$pri][$name]) ;
                            } else {
                                unset($wp_filter[$action][$pri][$name]) ;
                            }
                        }
                    }
                }
            }
        }
    }
}


add_action('init' , 'tefl_remove_stripe_action' , 9999);

function tefl_remove_stripe_action(){

    tefl_remove_class_action('woocommerce_checkout_before_customer_details' , 'WC_Stripe_Payment_Request' , 'display_payment_request_button_html');

}


// add_action('woocommerce_review_order_after_submit', 'tefl_gpay_btn_display_before_submit_function');
// function tefl_gpay_btn_display_before_submit_function(){
//     if (class_exists('WC_Stripe_Payment_Request')) {
//         $wc_stripe_payment_request = new WC_Stripe_Payment_Request();
//         $wc_stripe_payment_request->display_payment_request_button_separator_html();
//         $wc_stripe_payment_request->display_payment_request_button_html();
//     }
// }

 
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );





/**
 * @snippet       Pay for Order if Logged Out - WooCommerce Checkout
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.6.2
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
add_filter( 'user_has_cap', 'bbloomer_order_pay_without_login', 9999, 3 );
 
function bbloomer_order_pay_without_login( $allcaps, $caps, $args ) {
   if ( isset( $caps[0], $_GET['key'] ) ) {
      if ( $caps[0] == 'pay_for_order' ) {
         $order_id = isset( $args[2] ) ? $args[2] : null;
         $order = wc_get_order( $order_id );
         if ( $order ) {
            $allcaps['pay_for_order'] = true;
         }
      }
   }
   return $allcaps;
}



add_filter( 'woocommerce_available_payment_gateways', 'filter_available_payment_gateways' );
function filter_available_payment_gateways( $available_gateways ) {

    if ( ! function_exists( 'WC' ) || is_admin() || ! WC()->cart ) {
        return $available_gateways;
    }
    $payment_ids    = array('stripe'); // Here define the allowed payment methods ids to keep
    $admin_only     = array('revolut', 'revolut_cc');
    $found          = false; // Initializing

    if ( is_checkout() && ! is_wc_endpoint_url() ) {
        // Loop through cart items
        foreach ( WC()->cart->get_cart() as $item ) {
            if (  $item['is_deposit'] == 1 ) {
                $found = true;
                break;
            }
        }
    }

    // Disable PayPal if the billing country or the user's country is South Africa
    $billing_country = ""; 
    if ( WC()->customer ) {
        $billing_country = WC()->customer->get_billing_country();
    }
    $user_country = get_user_geo_country_code();

    if ( $billing_country === 'ZA' || $user_country === 'ZA' ) {
        unset( $available_gateways['ppcp'] );
    }

    foreach ( $available_gateways as $payment_id => $available_gateway ) {
        if ( $found && !in_array($payment_id, $payment_ids) ) {
            unset($available_gateways[$payment_id]);
        }
        if ( !$found && in_array($payment_id, $payment_ids) ) {
            unset($available_gateways[$payment_id]); //This enables stripe only for split payments
        }
        if ( !current_user_can('administrator') && in_array($payment_id, $admin_only) ){
            // unset($available_gateways[$payment_id]);
        }
    }

    return $available_gateways;
}

add_filter( 'woocommerce_available_payment_gateways', 'hide_klarna_when_not_supported' );
function hide_klarna_when_not_supported( $available_gateways ) {

    // get user country
    // if country is not in klarna supported countries
    // unset($available_gateways['stripe_klarna']);
    $current_cc = get_user_geo_country_code();
    $klarna_enabled_cc = array('AT', 'BE', 'CZ', 'DK', 'FI', 'FR', 'DE', 'GR', 'IE', 'IT', 'NL', 'NO', 'PL', 'PT', 'SE', 'CH', 'GB');

    if(!in_array($current_cc, $klarna_enabled_cc)){
        unset($available_gateways['stripe_klarna']);
    }
    
    return $available_gateways;
}



add_action( 'woocommerce_new_order', 'set_woo_order_fields_for_automation',  1, 2  );
function set_woo_order_fields_for_automation( $order_id, $order = false ) {
    
    $order = $order ? $order : wc_get_order($order_id);

    $line_items = $order->get_items();
    $is_flexible    = false;

    foreach ($line_items as $line_item){
        $is_flexible        = ( stripos($line_item['name'], "Flexible") !== false ) ? 1 : 0 ;
        if ($is_flexible) break;
    }

    update_post_meta($order_id, 'is_flexible', $is_flexible);
    
}

// Enable stripe test mode for admin users
add_filter( 'option_woocommerce_stripe_settings', 'ti_modify_test_mode_for_admins', 99, 1 );
function ti_modify_test_mode_for_admins( $settings ) {
    if ( !is_checkout() ) return $settings;
    if ( current_user_can('administrator') ){
        $settings['testmode'] = 'yes';
    }

	return $settings;
}


add_filter( 'wc_stripe_generate_create_intent_request', 'tefl_always_capture', 99, 1);
function tefl_always_capture($request){
    $request['capture_method'] = 'automatic';
    return $request;
}