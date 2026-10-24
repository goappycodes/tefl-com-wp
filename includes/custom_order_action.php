<?php

// This ensures that Moodle is not triggered on order complete
add_action('woocommerce_order_status_changed', 'no_processing_for_child_orders', 1, 3);
function no_processing_for_child_orders($order_id, $old_status, $new_status)
{
    if (has_post_parent($order_id)) {
        update_post_meta($order_id, '_is_processed', true);
    }
}


function sv_wc_add_order_meta_box_action($actions)
{
    global $theorder;
    if (!$theorder->is_paid()) {
        return $actions;
    }

    $actions['wc_order_link_moodle'] = 'Link to Moodle';
    return $actions;
}


add_action('woocommerce_order_actions', 'sv_wc_add_order_meta_box_action');


add_action('woocommerce_order_action_wc_order_link_moodle', 'sv_wc_process_order_meta_box_action', 99, 1);


function sv_wc_process_order_meta_box_action($order)
{

    $message = sprintf('Order manually linked to moodle by %s.', wp_get_current_user()->display_name);
    $order->add_order_note($message);
    \NmBridgeWoocommerce\manual_order_moodle_sync($order->get_id());
}


add_action('woocommerce_thankyou', 'number_of_seat_booking', 99, 1);
function number_of_seat_booking($order_id)
{

    if (!$order_id)
        return;

    // Allow code execution only once 
    if (!get_post_meta($order_id, '_thankyou_action_done', true)) {

        $order                 = wc_get_order($order_id);
        $items                 = $order->get_items();
        $order_status          = $order->get_status();

        foreach ($items as $item) {
            $product_id     = $item['product_id'];
            $is_course      = get_post_meta($product_id, 'is_product_a_moodle_course', true);
            $order_item_id     = $item->get_id();
            $start_date     = $item->get_meta('Start Date');
            if ($is_course     == 'yes' && $start_date) {
                pt_update_settings_course_order_id($order_id, $product_id, $order_item_id, $start_date, $order_status);
            }
        }
        // Flag the action as done (to avoid repetitions on reload)
        $order->update_meta_data('_thankyou_action_done', true);
        $order->save();
    }
}

function pt_update_settings_course_order_id($order_id, $product_id, $order_item_id, $start_date, $order_status)
{
    global $wpdb;
    $course_bookings     = "course_bookings";
    $start_date         = str_replace('/', '-', $start_date);
    $order_start_date     = date('Y-m-d', strtotime($start_date));

    $wpdb->insert($course_bookings, array(
        'order_id'         => $order_id,
        'product_id'    => $product_id,
        'order_item_id' => $order_item_id,
        'start_date'    => $order_start_date,
        'order_status'    => $order_status,

    ), array('%d', '%d', '%d',  '%s', '%s'));
}

function get_all_order_count_with_start_date()
{
    global $wpdb;
    $sql_query = "SELECT start_date , product_id , COUNT(*) as total FROM `course_bookings` GROUP BY start_date , product_id";
    $total = $wpdb->get_results($sql_query, ARRAY_A);
    return !empty($total) ? $total : [];
}


function get_total_count_by_start_date($data_array, $start_date, $product_id)
{

    if (empty($data_array)) {
        return false;
    }

    $start_date = date('Y-m-d', strtotime($start_date));
    foreach ($data_array as $data) {
        $data_start_date = $data['start_date'];
        $data_product_id = $data['product_id'];
        if (($start_date == $data_start_date) && ($data_product_id == $product_id)) {
            return $data['total'];
        }
    }
    return false;
}

// This is for late payment order date change
add_action('woocommerce_payment_complete', 'tefl_change_order_date_on_payment_complete');
function tefl_change_order_date_on_payment_complete($order_id)
{
    $order              = wc_get_order($order_id);
    $user_id = $order->get_user_id();
    $order_created_via  = get_post_meta($order_id, '_created_via', true);
    if ($order_created_via == "wc_deposits" || $order_created_via == "checkout") {
        tefl_chnage_order_created_date($order_id);
        tefl_reactivate_account_on_failed_payment($user_id);
        // tefl_reactive_course_on_payment($user_id,$order_id);
    }
}
function tefl_chnage_order_created_date($order_id)
{

    $date       = date('Y-m-d H:i:s');
    $args       = [
        'ID'             => $order_id,
        'post_date'      => $date,
        'post_date_gmt'  => $date
    ];

    wp_update_post($args);
}

function tefl_reactivate_account_on_failed_payment($user_id)
{

    $url                = "https://courses.teflinstitute.com/api_reactivate_account.php";
    $user               = get_user_by('ID', $user_id);
    if (!$user) {
        return;
    }
    $user_name          = $user->user_login;
    $post['username']   = $user_name;
    $curlSession        = curl_init();

    curl_setopt($curlSession, CURLOPT_URL, $url);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_POST, true);
    curl_setopt($curlSession, CURLOPT_POSTFIELDS, $post);
    $response  = curl_exec($curlSession);

    if (curl_errno($curlSession)) {
        echo 'cURL error: ' . curl_error($curlSession);
    }
    curl_close($curlSession);
    // pt_custom_log("This user account $user_name is reactive and curl_response : $response", "instalment_moodle_reactive");
}

function tefl_reactive_course_on_payment($user_id, $order_id)
{

    $url                = "https://courses.teflinstitute.com/api_unblock_course_enrolment.php";
    $user               = get_user_by('ID', $user_id);
    if (!$user) {
        return;
    }
    $user_name          = $user->user_login;
    $course_id          = tefl_get_purchased_course_id_from_order_for_reactivate($order_id);
    $post['username']   = $user_name;
    $post['course_id']  = $course_id;
    $curlSession        = curl_init();

    curl_setopt($curlSession, CURLOPT_URL, $url);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_POST, true);
    curl_setopt($curlSession, CURLOPT_POSTFIELDS, $post);
    $response  = curl_exec($curlSession);
    if (curl_errno($curlSession)) {
        echo 'cURL error: ' . curl_error($curlSession);
    }
    curl_close($curlSession);
    // pt_custom_log("This user's( $user_name ) course -  $course_id is suspended and curl_response : $response", "instalment_moodle_reactive");
}

function tefl_get_purchased_course_id_from_order_for_reactivate($order_id)
{

    $order          = wc_get_order($order_id);

    foreach ($order->get_items() as $item_id => $item) {
        $product_id     = $item->get_product_id();
        $is_gift        = false;
        foreach ($item->get_meta_data() as $meta) {
            if ($meta->key === '_free_gift' && $meta->value === 'yes') {
                $is_gift = true;
            }
        }
        if (!$is_gift) {
            return $product_id;
        }
    }
}
