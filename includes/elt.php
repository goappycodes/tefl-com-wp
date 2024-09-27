<?php

/* ELT CHECK IF USER EXISTS */
add_action( 'wp_ajax_tefl_user_exists', 'tefl_user_exists_fn' );
add_action( 'wp_ajax_nopriv_tefl_user_exists', 'tefl_user_exists_fn' );

function tefl_user_exists_fn(){

    $billingEmail = $_POST['billingEmail'];
    //$accountUsername = sanitize_text_field($_POST['accountUsername']);
    $user_exists = 0;

	if( !is_user_logged_in() ) {
	    
	    /*if( email_exists($billingEmail) && username_exists($accountUsername) ) {
    	    $user_exists = 1;
    	    $error_msg = "An account is already registered with your email address and username. Please log in.";
    	}*/
    	
    	if( email_exists($billingEmail) ) {
    	    $user_exists = 1;
    	    $error_msg = "An account is already registered with your email address. Please log in.";
    	}
    	
    	/*else if( username_exists($accountUsername) ) {
    	    $user_exists = 1;
    	    $error_msg = "An account is already registered with that username. Please choose another.";
    	}*/
	}
    
    if( $user_exists == 1 ) {
    	echo json_encode(array("status" => true ,  "content" => $error_msg));        
    	
	} else {
        echo json_encode(array("status" => false , "content" => 'User not found.'));
    }

    wp_die();
}
/* ELT CHECK IF USER EXISTS */



add_action( 'woocommerce_thankyou', 'wc_custom_redirect_after_purchase' );
function wc_custom_redirect_after_purchase($order_id) {
    // if ( ! is_wc_endpoint_url( 'order-received' ) ) return;

    $product_ids = array( 1788,77294); // or an empty array if not used
    $redirection = false;

    global $wp;
    // $order_id =  intval( str_replace( 'checkout/order-received/', '', $wp->request ) ); // Order ID
    $order = wc_get_order( $order_id ); // Get an instance of the WC_Order Object

    // Iterating through order items and finding targeted products
    foreach( $order->get_items() as $item ){
        if ( in_array( $item->get_product_id(), $product_ids )  ) {
            
            $data["Title"]      = $item->get_name();
            $data["Date (UTC)"] = date("Y-m-d h:i:s A");
            if($item->get_product_id() === 1788){
                $data["URL"]        = "https://teflinstitute.com/test-your-english-level-free-online-tefl-test-tefl-institute/";
            }
            elseif($item->get_product_id() === 77294){
                $data["URL"]        = "https://teflinstitute.com/test-tefl-course-free/";
            }
            $data["First Name"] = $order->get_billing_first_name(); 
            $data["Last Name"]  = $order->get_billing_last_name(); 
            $data["EMail"]     = $order->get_billing_email(); 
            $data["Phone"]      = $order->get_billing_phone(); 
            addRowToSpreadsheet($data);
            
            $redirection = true;
            break;
        }
    }
    
    // Make the custom redirection when a targeted product has been found in the order
    if( $redirection ){
        // $redirect_url = "https://teflinstitute.com/lms-sso/";
        $redirect_url = "https://courses.teflinstitute.com/";
        wp_redirect( $redirect_url );
        exit;
    }
}




/* ADDING PRODUCT ON PAGE LOAD ON ENGLISH LEVEL TEST PAGE */
add_action('wp_head', function() {
	//if( is_page('english-level-test') ){
	if( is_page(928) ){
		WC()->cart->empty_cart();
		WC()->cart->add_to_cart( 1788 );
	}
});


/* MAKING ADDRESS FIELDS OPTIONAL DURING CHECKOUT */
add_filter( 'woocommerce_default_address_fields' , 'ti_override_default_address_fields' );

function ti_override_default_address_fields( $address_fields ) {
    
    if (is_admin())
        return $address_fields;
    
    $product_id = 1788;
  
    if (WC()->cart){
        $product_cart_id = WC()->cart->generate_cart_id( $product_id );
        $in_cart = WC()->cart->find_product_in_cart( $product_cart_id );
        
        $address_fields['first_name']['required'] = true;
        $address_fields['last_name']['required'] = true;
        $address_fields['country']['required'] = true;
      
        if ( $in_cart ) {
        
            $address_fields['company']['required'] = false;
            $address_fields['state']['required'] = false;
            $address_fields['city']['required'] = false;
            $address_fields['address_1']['required'] = false;
            $address_fields['postcode']['required'] = false;
            
        }
    }
    
    return $address_fields;
}


/* REMOVING ADDRESS AND DOB FIELD FROM CHECKOUT FORM FOR ENGLISH LEVEL TEST PAGE */
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields_ti' ,99,1);
function custom_override_checkout_fields_ti( $fields ) {
    
    if ( is_page(928) ) {
        unset($fields['billing']['billing_company']);
        unset($fields['billing']['billing_state']);
        unset($fields['billing']['billing_city']);
        unset($fields['billing']['billing_address_1']);
        unset($fields['billing']['billing_address_2']);
        unset($fields['billing']['billing_postcode']);
        unset($fields['order']['date_of_birth']);
        unset($fields['billing']['date_of_birth']);
        unset($fields['date_of_birth']);
    }

    return $fields;
}


/* ENGLISH LEVEL TEST AJAX FUNCTION */
add_action( 'wp_ajax_pt_add_product_elt', 'pt_add_product_elt_fn' );
add_action( 'wp_ajax_nopriv_pt_add_product_elt', 'pt_add_product_elt_fn' );

function pt_add_product_elt_fn(){
	global $woocommerce;
	$product_id = $_POST['product_id'];

	if( !empty($product_id) ){
	
    	$quantity = 1;
    	$variation_id = 0;
    	$variation = array();
    	$cart_item_data = array();
    
    	$woocommerce->cart->empty_cart();
    	$woocommerce->cart->add_to_cart($product_id, $quantity, $variation_id, $variation, $cart_item_data );
    
    	echo json_encode(array("status" => true ,  "content" => "Product added to cart"));        
    	
	} else {
        echo json_encode(array("status" => false , "content" => 'Error Generated.'));
    }

    wp_die();
}
/* /ENGLISH LEVEL TEST AJAX FUNCTION */



