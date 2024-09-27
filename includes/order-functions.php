<?php

namespace NmBridgeWoocommerce;

use \app\wisdmlabs\edwiserBridge\EdwiserBridge;

function manual_order_moodle_sync($order_id){

    $order = wc_get_order($order_id);

    if (!$order){
        wp_die("No order found");
    }

    $edwiser_bridge = new EdwiserBridge();
    $order_manager = new BridgeWoocommerceOrderManager( 'woocommerce_integration', '2.1.9');    
    $user_id = get_post_meta($order_id, '_customer_user', true);
    
    $user = get_userdata(intval($user_id));
    
    $userLink = $edwiser_bridge->userManager()->linkMoodleUser($user);
    $response = $order_manager->handleOrderComplete($order_id);

    return $response;

}

