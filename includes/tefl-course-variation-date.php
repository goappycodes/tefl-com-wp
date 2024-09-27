<?php


/**
 * @snippet       Add Course Date and Time to Product Variations - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=73545
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.6
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
// -----------------------------------------
// 1. Add Course Date and Time input @ Product Data > Variations > Single Variation
 
// add_action('template_redirect', 'add_course_date_to_cart');
// function add_course_date_to_cart(){
// 	if (isset($_GET['addtimetocart'])){
// 		$product = $_GET['prid'];
// 		$date = isset($_GET['date']) ? $_GET['date'] : "";
//         $location = isset($_GET['location']) ? $_GET['location'] : "" ;
// 		$address = isset($_GET['address']) ? $_GET['address'] : "" ;
// 		$deposit = (isset($_GET['deposit']) ? true : false);
//         $var_id = (isset($_GET['variation_id']) ? $_GET['variation_id'] : '');
//         $deposit_payment_plan = get_post_meta($product, '_wc_deposit_payment_plans', true);
//         $payment_plan = $deposit_payment_plan[0];
        
//         if($deposit == true){
//             $cart_item_meta = array(
//                 'start_date' => array('Start Date'=> $date),
//                 'location'   => $location,
//                 'address'    => $address,
//                 'is_deposit' => true,
//                 'payment_plan' => $payment_plan
//             );
//         }else{
//             $cart_item_meta = array(
//                 'start_date' => array('Start Date' => $date),
//                 'location'   => array('Location' => $location),
//                 'address'    => array('Address' => $address)
//             );
//         }

//         if($var_id){
//             WC()->cart->add_to_cart( $product, 1, $var_id, array(), $cart_item_meta);
//         }else{
//             WC()->cart->add_to_cart( $product, 1, 0, array(), $cart_item_meta);
//         }
        
// 		//WC()->cart->add_to_cart( $product, 1, 0, array(), array('start_date' => array('Start Date'=> $date))  );
// 		wp_safe_redirect( wc_get_cart_url() );
// 		exit();		
// 	}
// }

add_action('template_redirect', 'add_course_date_to_cart', 1);
function add_course_date_to_cart() {

    if (isset($_GET['addtimetocart'])) {
        $product_ids = isset($_GET['prid']) ? explode(',', $_GET['prid']) : [];
        $date = isset($_GET['date']) ? sanitize_text_field($_GET['date']) : "";
        $location = isset($_GET['location']) ? sanitize_text_field($_GET['location']) : "";
        $address = isset($_GET['address']) ? sanitize_text_field($_GET['address']) : "";
        $deposit = isset($_GET['deposit']) ? true : false;
        $var_id = isset($_GET['variation_id']) ? intval($_GET['variation_id']) : '';
        

        foreach ($product_ids as $product_id) {
            $product_id = intval(trim($product_id)); 
            // if (!$product_id) continue; 

            $deposit_payment_plan = get_post_meta($product_id, '_wc_deposit_payment_plans', true);
            $payment_plan = is_array($deposit_payment_plan) && !empty($deposit_payment_plan) ? $deposit_payment_plan[0] : '';

    
            $cart_item_meta = array();

            if (!empty($date)) {
                $cart_item_meta['start_date'] = array('Start Date' => $date);
            }
            if (!empty($location)) {
                $cart_item_meta['location'] = array('Location' => $location);
            }
            if (!empty($address)) {
                $cart_item_meta['address'] = array('Address' => $address);
            }
            if ($deposit) {
                $cart_item_meta['is_deposit'] = true;
                if (!empty($payment_plan)) {
                    $cart_item_meta['payment_plan'] = $payment_plan;
                }
            }

            if ($var_id) {
                WC()->cart->add_to_cart($product_id, 1, $var_id, array(), $cart_item_meta);
            } else {
                WC()->cart->add_to_cart($product_id, 1, 0, array(), $cart_item_meta);
            }

        }

        wp_safe_redirect(wc_get_cart_url());
        exit();
    }
}




// Display custom cart item meta data (in cart and checkout)
add_filter( 'woocommerce_get_item_data', 'display_cart_item_custom_meta_data', 10, 2 );
function display_cart_item_custom_meta_data( $item_data, $cart_item ) {

    $meta_key_arr = ["start_date" => "Start Date", "location" => "Location", "address" => "Address"];

    foreach($meta_key_arr as $meta_key => $meta_text){
        if ( isset($cart_item[$meta_key]) && isset($cart_item[$meta_key][$meta_text]) ) {
            $item_data[] = array(
                'key'       => $meta_text,
                'value'     => $cart_item[$meta_key][$meta_text],
            );
        }
    }
    
    // $meta_key = 'Start Date';
    // if ( isset($cart_item['start_date']) && isset($cart_item['start_date'][$meta_key]) ) {
    //     $item_data[] = array(
    //         'key'       => $meta_key,
    //         'value'     => $cart_item['start_date'][$meta_key],
    //     );
    // }
    return $item_data;
}


// Save cart item custom meta as order item meta data and display it everywhere on orders and email notifications.
add_action( 'woocommerce_checkout_create_order_line_item', 'save_cart_item_custom_meta_as_order_item_meta', 10, 4 );
function save_cart_item_custom_meta_as_order_item_meta( $item, $cart_item_key, $values, $order ) {
    $meta_key_arr = ["start_date" => "Start Date", "location" => "Location", "address" => "Address"];
    foreach($meta_key_arr as $meta_key => $meta_text){
        if ( isset($values[$meta_key]) && isset($values[$meta_key][$meta_text]) ) {
            $item->update_meta_data( $meta_text, $values[$meta_key][$meta_text] );
        }
    }
    // $meta_key = 'Start Date';
    // if ( isset($values['start_date']) && isset($values['start_date'][$meta_key]) ) {
    //     $item->update_meta_data( $meta_key, $values['start_date'][$meta_key] );
    // }
}


add_action( 'woocommerce_variation_options_pricing', 'bbloomer_tefl_add_course_date_to_variations', 10, 3 );
 
function bbloomer_tefl_add_course_date_to_variations( $loop, $variation_data, $variation ) {
    woocommerce_wp_text_input( 
        array(
            'id' => 'course_date[' . $loop . ']',
            'class' => 'short',
            'type' => 'date',
            'label' => __( 'Course Start Date', 'woocommerce' ),
            'value' => get_post_meta( $variation->ID, 'course_date', true )
        )
    );
    woocommerce_wp_text_input( 
        array(
            'id' => 'course_end_date[' . $loop . ']',
            'class' => 'short',
            'type' => 'date',
            'label' => __( 'Course End Date', 'woocommerce' ),
            'value' => get_post_meta( $variation->ID, 'course_end_date', true )
        )
    );
    woocommerce_wp_text_input( 
        array(
            'id' => 'course_start_time[' . $loop . ']',
            'class' => 'short',
            'type' => 'time',
            'label' => __( 'Course Start Time', 'woocommerce' ),
            'value' => get_post_meta( $variation->ID, 'course_start_time', true )
        )
    );
    woocommerce_wp_text_input( 
        array(
            'id' => 'course_end_time[' . $loop . ']',
            'class' => 'short',
            'type' => 'time',
            'label' => __( 'Course End Time', 'woocommerce' ),
            'value' => get_post_meta( $variation->ID, 'course_end_time', true )
        )
    );
}
 
// -----------------------------------------
// 2. Save Course Date and Time on product variation save
 
add_action( 'woocommerce_save_product_variation', 'bbloomer_tefl_save_course_date_variations', 10, 2 );
 
function bbloomer_tefl_save_course_date_variations( $variation_id, $i ) {
    $course_date = $_POST['course_date'][$i];
    if ( isset( $course_date ) ) update_post_meta( $variation_id, 'course_date', esc_attr( $course_date ) );

    $course_end_date = $_POST['course_end_date'][$i];
    if ( isset( $course_end_date ) ) update_post_meta( $variation_id, 'course_end_date', esc_attr( $course_end_date ) );
    
    $course_start_time = $_POST['course_start_time'][$i];
    if ( isset( $course_start_time ) ) update_post_meta( $variation_id, 'course_start_time', esc_attr( $course_start_time ) );
    
    $course_end_time = $_POST['course_end_time'][$i];
    if ( isset( $course_end_time ) ) update_post_meta( $variation_id, 'course_end_time', esc_attr( $course_end_time ) );
    
}
 
// -----------------------------------------
// 3. Store Course Date and Time value into variation data
 
add_filter( 'woocommerce_available_variation', 'bbloomer_tefl_add_course_date_variation_data' );
 
function bbloomer_tefl_add_course_date_variation_data( $variations ) {
    $variations['course_date'] = '<div class="woocommerce_course_date">Course Start Date: <span>' . get_post_meta( $variations[ 'variation_id' ], 'course_date', true ) . '</span></div>';
    $variations['course_end_date'] = '<div class="woocommerce_course_end_date">Course End Date: <span>' . get_post_meta( $variations[ 'variation_id' ], 'course_end_date', true ) . '</span></div>';
    $variations['course_start_time'] = '<div class="woocommerce_course_start_time">Course Start Time: <span>' . get_post_meta( $variations[ 'variation_id' ], 'course_start_time', true ) . '</span></div>';
    $variations['course_end_time'] = '<div class="woocommerce_course_end_time">Course End Time: <span>' . get_post_meta( $variations[ 'variation_id' ], 'course_end_time', true ) . '</span></div>';
    return $variations;
}


add_action( 'woocommerce_before_calculate_totals', 'custom_cart_items_prices', 10, 1 );
function custom_cart_items_prices( $cart ) {

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

    // Loop through cart items
    foreach ( $cart->get_cart() as $cart_item ) {

        $start_date = $cart_item['start_date']['Start Date'] ?? '';

        if($start_date){
            // Get an instance of the WC_Product object
            $product = $cart_item['data'];

            // Get the product name (Added Woocommerce 3+ compatibility)
            $original_name = method_exists( $product, 'get_name' ) ? $product->get_name() : $product->post->post_title;

            // SET THE NEW NAME
            $new_name = $original_name.' - Start Date: '.$start_date;

            // Set the new name (WooCommerce versions 2.5.x to 3+)
            if( method_exists( $product, 'set_name' ) )
                $product->set_name( $new_name );
            else
                $product->post->post_title = $new_name;
        }

        
    }
}



