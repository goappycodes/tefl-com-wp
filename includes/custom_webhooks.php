<?php

function flow_woocommerce_order_placed( $workflow ) {

	$order	= $workflow->data_layer()->get_order();
	// The data layer will return a valid data item or false
	if ( ! $order ) {
		return;
	}
	
    $order_id   = $order->get_id();
    $workflow_id = $workflow->id;

    $default_zap_id = 'bvcc6xv';
	ticom_custom_log( "workflow ID: ".$workflow_id, 'autowebhook' );
    prepare_and_deliver_webhook($order_id, $default_zap_id, false, $workflow_id);
		
}

function prepare_and_deliver_webhook($order_id, $default_zap_id, $debug = false, $workflow_id = false ){

    $order      = wc_get_order($order_id);
    if ( !$order_id || !$order || !$default_zap_id ) {
        die('No order or flow or zap ID specified');
    }

  	$zap_id = get_field('workflow_zapier_id', $workflow_id);
    $zap_id = $zap_id ? $zap_id : $default_zap_id;
    $url = "https://hooks.zapier.com/hooks/catch/799242/$zap_id/";

    $response = zoho_deliver_webhook($order_id, $url, $debug);
    ticom_custom_log( $response, 'autowebhook' );

    return $response;    
}

function zoho_deliver_webhook($order_id, $webhook_url, $debug = false){

    $WC_Session_Handler = new WC_Session_Handler();
    $WC_Session_Handler->init_session_cookie();
    
    $order = wc_get_order($order_id);

    if (!$order_id || !$webhook_url) {
        return;
    }

    $order = wc_get_order($order_id);
    if (!$order) {
        return;
    }

    $customer_id = 5;
    // This is Prz user ID
    
    wp_set_current_user( $customer_id );
    wp_set_auth_cookie( $customer_id, true );
  

    $order_data = [
        'id'               => $order->get_id(),
        'parent_id'        => $order->get_parent_id(),
        'status'           => $order->get_status(),
        'currency'         => $order->get_currency(),
        'version'          => $order->get_version(),
        'prices_include_tax' => $order->get_prices_include_tax(),
        'date_created'     => $order->get_date_created()->date('Y-m-d H:i:s'),
        'date_modified'    => $order->get_date_modified()->date('Y-m-d H:i:s'),
        'discount_total'   => $order->get_discount_total(),
        'discount_tax'     => $order->get_discount_tax(),
        'shipping_total'   => $order->get_shipping_total(),
        'shipping_tax'     => $order->get_shipping_tax(),
        'cart_tax'         => $order->get_cart_tax(),
        'total'            => $order->get_total(),
        'total_tax'        => $order->get_total_tax(),
        'customer_id'      => $order->get_customer_id(),
        'order_key'        => $order->get_order_key(),
        'billing'          => $order->get_address('billing'),
        'shipping'         => $order->get_address('shipping'),
        'payment_method'   => $order->get_payment_method(),
        'payment_method_title' => $order->get_payment_method_title(),
        'transaction_id'   => $order->get_transaction_id(),
        'customer_ip_address' => $order->get_customer_ip_address(),
        'customer_user_agent' => $order->get_customer_user_agent(),
        'created_via'      => $order->get_created_via(),
        'customer_note'    => $order->get_customer_note(),
        'date_completed'   => $order->get_date_completed() ? $order->get_date_completed()->date('Y-m-d H:i:s') : null,
        'date_paid'        => $order->get_date_paid() ? $order->get_date_paid()->date('Y-m-d H:i:s') : null,
        'line_items'       => $order->get_items(),
        'product_ids'      => '',
        'product_names'    => '',
        'product_quantities' => '',
        'product_subtotals' => '',
        'variation_ids'    => '',
        'is_flexible'      => '0'
    ];

    $line_items = $order->get_items();
    $product_ids = $product_names = $product_quantities = $product_subtotals = $variation_ids = [];
    $is_flexible = false;

    foreach ($line_items as $item_id => $item) {
        $product_ids[]        = $item->get_product_id();
        $product_names[]      = $item->get_name();
        $product_quantities[] = $item->get_quantity();
        $product_subtotals[]  = $item->get_subtotal();
        $variation_ids[]      = $item->get_variation_id();
        $is_flexible = (stripos($item->get_name(), "Flexible") !== false) ? true : false;
    }

    $order_data['product_ids']       = implode(",", $product_ids);
    $order_data['product_names']     = implode(",", $product_names);
    $order_data['product_quantities'] = implode(",", $product_quantities);
    $order_data['product_subtotals']  = implode(",", $product_subtotals);
    $order_data['variation_ids']     = implode(",", $variation_ids);
    $order_data['is_flexible']       = $is_flexible ? "1" : "0";

    ticom_custom_log("Processed Order Data: " . print_r($order_data, true), 'autowebhook');

    $course_date = get_course_date_from_order($order);
    if ($course_date){
        $order_data['course_start_date']    = $course_date;

        $order_data['joining__info']        = get_merge_value_from_course_date($course_date, 'joining__info');
        $order_data['instructor_bio']       = get_merge_value_from_course_date($course_date, 'instructor_bio');
        $order_data['course_date__info']    = get_merge_value_from_course_date($course_date, 'course_date__info');

        $order_data['instructor_name']      = get_merge_value_from_course_date($course_date, 'instructor_name');
        $order_data['course_date_text']     = get_merge_value_from_course_date($course_date, 'course_date_text');
        $order_data['course_time_text']     = get_merge_value_from_course_date($course_date, 'course_time_text');
    }


    // unset($order_data['_links']);

    $response = [];
    if ($debug) {
        print_r(json_encode($order_data));
        die();
    } else {
        $response = wp_remote_post($webhook_url, array(
            'body'    => json_encode($order_data),
            'headers' => array('Content-Type' => 'application/json'),
        ));

        if (is_wp_error($response)) {
            tie_custom_log("Error sending request: " . $response->get_error_message(), 'autowebhook');
        } else {
            tie_custom_log("Request sent successfully: " . print_r($response, true), 'autowebhook');
        }
    }


    return $response;
}


