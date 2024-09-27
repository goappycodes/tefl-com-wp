<?php

// Add Extra field to extension products
add_action('woocommerce_product_options_general_product_data', 'ti_create_product_custom_field');
function ti_create_product_custom_field()
{
    global $product;
    // Only display the custom field for products in the "extension" category
    if (has_term('extension', 'product_cat', $product->ID)) {
        $args = array(
            'id' => 'extension_length',
            'label' => __('Extension Length (in days)', 'ti'),
            'class' => 'ti-custom-product-field',
            'desc_tip' => true,
            'description' => __('Extension length in days', 'ti'),
            'type' => 'number'
        );

        woocommerce_wp_text_input($args);
    }
}


// Save the custom field value

add_action('woocommerce_admin_process_product_object', 'ti_save_product_custom_field');
function ti_save_product_custom_field($product_id)
{
    $product = wc_get_product($product_id);

    // Check if the custom field is set and not empty
    if (isset($_POST['extension_length']) && !empty($_POST['extension_length'])) {
        $product->update_meta_data('extension_length', sanitize_text_field($_POST['extension_length']));
    } else {
        $product->delete_meta_data('extension_length');
    }

    $product->save();
}


// Arrays of moodle course IDs
function get_moodle_course_ids()
{
    $moodle_course_ids = [5, 7, 8, 9, 10, 11, 12, 16, 17, 18, 19, 20];
    return $moodle_course_ids;
}

function get_extension_product_ids()
{
    //GET ALL EXTENSION PRODUCTS
    $tax_query = array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => 'extension',
        ),
    );
    $args = array(
        'post_type'   => 'product',
        'numberposts' => -1,
        'tax_query'   => $tax_query,
    );

    $products = get_posts($args);
    $extension_product_ids = array();
    foreach ($products as $product) {
        $extension_product_ids[] = $product->ID;
    }
    return $extension_product_ids;
}


// Add extra field for checking if email is registered as student above add to cart
add_action('woocommerce_before_add_to_cart_button', 'course_extension_cart_item_field', 10);
function course_extension_cart_item_field()
{
    global $product;
    $product_id = $product->get_id();
    if (has_term('extension', 'product_cat', $product_id)) :
        $extension_days = get_post_meta($product_id, 'extension_length', true);
?>
        <div class="extension-fields-wrapper">
            <div class="extension-field extension-field__email">
                <label for="moodle_username"><?php _e('Enter your Username (or email address) used on your student platform', 'ti'); ?></label>
                <div class="input-container">
                    <input type="text" id="moodle_username" name="moodle_username" required="required">
                    <span class="verify-btn hidden">
                        <span class="verify-btn__text">Verify</span> <img src="/wp-content/uploads/2022/11/loading-yellow.gif" class="loader-gif hidden" /></span>
                </div>
                <div class="verification-message-wrapper hidden">
                    <i class="fa verification-icon"></i>
                    <span class="verification-message"></span>
                </div>
            </div>
        </div>
        <div class="extension-fields-wrapper extension-fields-wrapper__select hidden ">
            <div class="extension-field extension-field__courses-list"><?php
                                                                        $moodle_ids = get_moodle_course_ids(); ?>
                <input type="hidden" id="moodleCoursesList" value="<?php echo htmlentities(json_encode($moodle_ids)); ?>">
                <label for="coursesList">Select the course/courses you'd like to extend</label>
                <!-- <select name="moodle_course" id="coursesList" multiple>
                    <option value="-1">Select Courses to Extend</option>
                </select> -->
                <select name="moodle_course_new" id="coursesListNew" multiple="multiple">
                </select>
            </div>
        </div>
        <input type="hidden" id="moodleCourseID" name="moodle_course_id" />
        <input type="hidden" id="moodleCourseName" name="moodle_course_name" />
        <input type="hidden" id="moodleExtensionDays" name="moodle_extension_days" value="<?php echo $extension_days; ?>" />
        <style>
            .select2-container {
                font-size: 16px !important;
            }

            .extension-fields-wrapper {
                margin: 20px 0;
            }

            .extension-fields {
                margin-bottom: 20px;
            }

            .extension-fields>label {
                width: 100%;
            }

            .input-container {
                position: relative;
            }

            input#moodle_username {
                width: 100%;
                border-radius: none;
            }

            #coursesList {
                width: 100%;
            }

            .verify-btn {
                cursor: pointer;
                display: flex;
                align-items: center;
                background: var(--black);
                color: var(--gold);
                padding: .5rem 1rem;
                position: absolute;
                right: .5rem;
                top: 50%;
                transform: translateY(-50%);
                opacity: 1;
                transition: all .4s ease-in-out;
            }

            .verify-btn.hidden {
                opacity: 0;
                z-index: -1;
            }

            .extension-fields-wrapper__select,
            .verification-message-wrapper {
                opacity: 1;
                height: auto;
                transition: all .4s ease;
            }

            .extension-fields-wrapper__select.hidden,
            .verification-message-wrapper.hidden {
                opacity: 0;
                height: 0;
                overflow: hidden;
                margin: 0;
            }

            .loader-gif {
                display: block;
                width: 1.5rem;
                margin-left: .5rem;
            }

            .loader-gif.hidden {
                display: none;
            }

            .verification-message-wrapper {
                opacity: 1;
                transition: all .4s ease-in-out;
            }

            .verification-message-wrapper {
                color: green;
            }

            .verification-message-wrapper.has-error {
                color: var(--red);
            }

            .extension-fields>input,
            .extension-fields>select {
                width: 100% !important;
                font-size: 14px;
                background: #fff;
                color: #333;
                line-height: normal;
                border-radius: 5px;
                border: 1px solid #d9d9d9;
                padding: .82em;
            }

            #courseSelect {
                cursor: pointer;
            }

            .single_add_to_cart_button:disabled[disabled] {
                background-color: var(--black) !important;
            }

            label[for="moodle_course"] {
                margin-bottom: 0px !important;
            }
        </style>
    <?php

    endif;
}

/* ADD EXTENSION FIELDS VALUE TO CART ITEM DATA */
add_filter('woocommerce_add_cart_item_data', 'course_extension_add_cart_item_data', 10, 3);
function course_extension_add_cart_item_data($cart_item_data, $product_id, $variation_id)
{

    $moodle_username       = filter_input(INPUT_POST, 'moodle_username');
    $moodle_course_id      = filter_input(INPUT_POST, 'moodle_course_id');
    $moodle_course_name    = filter_input(INPUT_POST, 'moodle_course_name');
    $moodle_extension_days = filter_input(INPUT_POST, 'moodle_extension_days');


    //EXTENSION USERNAME
    if (!empty($moodle_username)) {
        $cart_item_data['moodle_username'] = $moodle_username;
    }

    //EXTENSION COURSE ID
    if (!empty($moodle_course_id)) {
        //$moodle_course = str_replace("|",",", $moodle_course);
        $cart_item_data['moodle_course_id'] = $moodle_course_id;
    }

    //EXTENSION COURSE NAME
    if (!empty($moodle_course_name)) {
        $cart_item_data['moodle_course_name'] = $moodle_course_name;
    }

    //EXTENSION DAYS
    if (!empty($moodle_extension_days)) {
        $cart_item_data['moodle_extension_days'] = $moodle_extension_days;
    }

    return $cart_item_data;
}


/* DISPLAY EXTENSION FIELDS VALUE FROM CART ITEM DATA */
add_filter('woocommerce_get_item_data', 'course_extension_get_cart_item_data', 10, 2);
function course_extension_get_cart_item_data($item_data, $cart_item)
{

    //EXTENSION USERNAME
    if (isset($cart_item['moodle_username']) && !empty($cart_item['moodle_username'])) {
        $item_data[] = array(
            'key'     => __('Username', 'ti'),
            'value'   => wc_clean($cart_item['moodle_username']),
        );
    }

    //EXTENSION COURSE
    // if( isset($cart_item['moodle_course_id']) && !empty($cart_item['moodle_course_id']) ) {
    //     $item_data[] = array(
    //         'key'     => __( 'Course ID', 'ti' ),
    //         'value'   => wc_clean( $cart_item['moodle_course_id'] ),
    //     );
    // }

    //EXTENSION COURSE NAME

    if (isset($cart_item['moodle_course_name']) && !empty($cart_item['moodle_course_name'])) {
        $item_data[] = array(
            'key'     => __('Course to be extended', 'ti'),
            'value'   => wc_clean($cart_item['moodle_course_name']),
        );
    }


    //EXTENSION DAYS
    if (isset($cart_item['moodle_extension_days']) && !empty($cart_item['moodle_extension_days'])) {
        $item_data[] = array(
            'key'     => __('Course to be extended by', 'ti'),
            'value'   => wc_clean($cart_item['moodle_extension_days'] . ' Days'),
        );
    }

    return $item_data;
}
/* /DISPLAY EXTENSION FIELDS VALUE FROM CART ITEM DATA */


/* SHOW EXTENSION FIELDS VALUE IN ORDER ITEMS */
add_action('woocommerce_checkout_create_order_line_item', 'course_extension_to_order_items', 10, 4);
function course_extension_to_order_items($item, $cart_item_key, $values, $order)
{

    //EXTENSION USERNAME
    if (!empty($values['moodle_username'])) {
        $item->add_meta_data(__('Username', 'ti'), $values['moodle_username']);
    }

    //EXTENSION COURSE
    if (!empty($values['moodle_course_id'])) {
        $item->add_meta_data(__('Course ID', 'ti'), $values['moodle_course_id']);
    }

    //EXTENSION COURSE NAME
    if (!empty($values['moodle_course_name'])) {
        $item->add_meta_data(__('Course extended', 'ti'), $values['moodle_course_name']);
    }

    //EXTENSION DAYS
    if (!empty($values['moodle_extension_days'])) {
        $item->add_meta_data(__('Course extended by', 'ti'), $values['moodle_extension_days'] . ' days');
    }
}
/* /SHOW EXTENSION FIELDS VALUE IN ORDER ITEMS */


function tefl_update_wp_moodle_enrolment_expire_date($user_id, $moodle_course_id, $enrolment_end_date)
{
    $course_id = tefl_get_course_id_from_moodle_course_id($moodle_course_id);
    global $wpdb;
    $data = ['expire_time' => $enrolment_end_date];
    $where = ['user_id' => $user_id, 'course_id' => $course_id];
    $update_result = $wpdb->update($wpdb->prefix . 'moodle_enrollment', $data, $where);
    //echo $update_result;
}

function tefl_get_course_id_from_moodle_course_id($moodle_course_id)
{
    global $wpdb;
    $query = " SELECT post_id FROM  `" . $wpdb->prefix . "postmeta` WHERE `meta_key` LIKE  'moodle_course_id' AND `meta_value` LIKE " . $moodle_course_id;
    $moodle_course_id_arr = $wpdb->get_row($query);
    return $moodle_course_id_arr->post_id;
}

/* COURSE EXTENSION RESPONSE ON THANK YOU PAGE */
add_action('ti_before_order_details', 'tefl_woocommerce_thankyou_course_extension');
function tefl_woocommerce_thankyou_course_extension($order)
{
    if (!$order) {
        return;
    }

    $order_id = $order->get_id();

    $debug_mode = isset($_GET['debug']) ? true : false;

    $items = $order->get_items();
    $course_extension_products = get_extension_product_ids();
    $course_extension_array = get_moodle_course_ids();
    $order_email = $order->get_billing_email();

    $is_course_extended = get_post_meta($order_id, 'is_course_extended', true);

    if (empty($is_course_extended) || ($is_course_extended == '') || $debug_mode) {

        foreach ($items as $item_id => $item) {
            $product_id = $item['product_id'];
            $product = new WC_Product($product_id);
            $product_name = $item->get_name();

            

            if ((in_array($product_id, $course_extension_products) && !isset($_COOKIE["course-" . $order_id . "-extended"])) || $debug_mode) {

                $username = $item->get_meta('Username', true);
                if($username===''){
                    $verify_url_response = wp_remote_get("https://courses.teflinstitute.com/verifyemailorusername.php?query={$order_email}");
    
                    if (is_wp_error($verify_url_response)) {
                        wp_die(json_encode(array("status" => false, "content" => "Unable to verify Email/Username")));
                    }
                
                    $verify_body = json_decode($verify_url_response['body']);
                    if (!$verify_body->output->username || !$verify_body->output->id) {
                        wp_die(json_encode(array("status" => false, "content" => "Email/Username does not exist")));
                    }
            
                    $username = $verify_body->output->username;
                }
                $username = trim($username);

                $extension_days = $item->get_meta('Course extended by', true);
                $extension_days = str_replace(" days", "", $extension_days);
                if ($debug_mode) {
                    print_r($username);
                    die();
                }


                $url = "https://courses.teflinstitute.com/api_course_bulk_extension.php?uname=" . $username . "&extend=" . $extension_days;

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                $responses = json_decode(curl_exec($ch), true);
                curl_close($ch);

                if ($debug_mode) {
                    print_r($responses);
                    die();
                }

                $print_count = 0;

                foreach ($responses as $response) {

                    $res_succ = $response['success'];
                    $res_msg = $response['message'];
                    $res_val = $response['value'];

                    $user_email = $res_val['user_email'];

                    if ($res_succ == true) {
                        $enrolment_end_ts = $res_val['end_date'];

                        $customer_user = get_user_by('email', $user_email);
                        $customer_user_id = $customer_user->ID;
                        $enrolment_end_date = date("Y-m-d H:i:s", $enrolment_end_ts);
                        $course     = isset($response['course_id']) ? $response['course_id'] : false;
                        if ($customer_user_id && $course && $enrolment_end_date) {
                            tefl_update_wp_moodle_enrolment_expire_date($customer_user_id, $course, $enrolment_end_date);
                        }

                        // if($key == 0) {
                        //     echo '<div class="course-extension-msg">';
                        //     echo '<p>Congratulations! Your '.$product_name.' for '.$course_name.' with Course ID '.$course_ids.' is successful. '.$response['message'].'.</p>';
                        //     echo '</div>';
                        // }

                        $print_count++;

                        if (!$debug && $print_count == 1) {
                            echo '<div class="course-extension-msg">';
                            echo '<p>Congratulations! Your ' . $product_name . ' is successful for all of your enrolled courses</p>';
                            echo '</div>';
                            update_post_meta($order_id, 'is_course_extended', 'yes');
                        }

                        update_post_meta($order_id, 'is_course_extended', 'yes');
                        update_post_meta($order_id, 'res_success_msg', $res_msg);
                    } else {
                        echo 'HERE';
                        echo '<div class="course-extension-msg extension-error">';
                        echo '<p>Sorry! Your ' . $product_name . ' is unsuccessful. Our support team has been notified and they will get in touch with you.</p>';
                        echo '</div>';

                        /****************** EMAIL ******************/
                        // $current_user = wp_get_current_user();
                        // $user_email   = $current_user->user_email;

                        $to           = 'hello@teflinstitute.com';
                        $subject      = 'Course extension failed!';

                        $message      = 'Course extension for an user with email address ' . $user_email . ' has failed!<br/><br/>';
                        $message     .= 'Please check Order ID #' . $order->get_id();
                        $headers[]    = 'Reply-To: ' . $user_email;
                        add_filter('wp_mail_content_type', 'tefl_set_content_type');
                        wp_mail($to, $subject, $message, $headers);
                        // For Testing purpose start
                        $multiple_recipients = array(
                            'bikram@appycodes.com'
                        );
                        wp_mail($multiple_recipients, $subject, $message, $headers);
                        // For Testing purpose end
                        remove_filter('wp_mail_content_type', 'tefl_set_content_type');
                        /****************** EMAIL ******************/
                    }
                }

                $cookie_name = "course-" . $order_id . "-extended";
                setcookie($cookie_name, "1", time() + (10 * 365 * 24 * 60 * 60), "/");
            }
        }
    }
    $current_user = wp_get_current_user();
    $username = $current_user->user_login;
    echo '<div class="course-extension-msg"><h3>Your Course Access</h3>';
    echo '<div>Click <a target="_blank" href="https://courses.teflinstitute.com/login/index.php">here</a> to login to your student portal.<br/>Your username is <b style="text-decoration:underline">' . $username . '</b> and password is the one you have entered during checkout</div>';
    echo '</div>'; ?>

    <style>
        body.woocommerce-order-received .course-extension-msg {
            font-weight: 500;
            border: none;
            padding: 1em;
            background: var(--black-jet);
            color: var(--white);
            margin:1rem auto;
        }

        body.woocommerce-order-received .course-extension-msg h3 {
            font-size: 2rem !important;
            color: var(--white);
            margin-bottom: 1rem;
        }

        body.woocommerce-order-received .course-extension-msg a {
            background: var(--white);
            min-width: 100px;
            display: inline-block;
            margin: auto 10px;
            border-radius: 10px;
        }

        body.woocommerce-order-received .course-extension-msg:last-of-type {
            margin-bottom: 2rem;
        }

        body.woocommerce-order-received .course-extension-msg.extension-error {
            border-color: red;
        }

        body.woocommerce-order-received .course-extension-msg p {
            margin-bottom: 0;
        }

        ul.wc-item-meta {
            margin: 8px 0 0 0;
        }
    </style><?php

}

function tefl_set_content_type()
{
    return "text/html";
}
/* /COURSE EXTENSION RESPONSE ON THANK YOU PAGE */

// Ajax for email verification

add_action('wp_ajax_ti_verify_email_uname', 'ti_verify_email_uname_fn');
add_action('wp_ajax_nopriv_ti_verify_email_uname', 'ti_verify_email_uname_fn');

function ti_verify_email_uname_fn()
{
    $email_uname = $_POST['email_uname'] ?? '';
    if (empty($email_uname)) {
        wp_die(json_encode(array("status" => false, "content" => "Please Enter Email or Username")));
    }

    $verify_url_response = wp_remote_get("https://courses.teflinstitute.com/verifyemailorusername.php?query={$email_uname}");

    if (is_wp_error($verify_url_response)) {
        wp_die(json_encode(array("status" => false, "content" => "Unable to verify Email/Username")));
    }

    $verify_body = json_decode($verify_url_response['body']);
    if (!$verify_body->output->username || !$verify_body->output->id) {
        wp_die(json_encode(array("status" => false, "content" => "Email/Username does not exist")));
    }

    // $retrieve_course_url_response = wp_remote_get("https://courses.teflinstitute.com/api_moodleusercourselist.php?user_id={$verify_body->output->id}");

    // $course_list = array();
    // if (!is_wp_error($retrieve_course_url_response)) {
    //     $retrieve_body = json_decode($retrieve_course_url_response['body']);
    //     $course_list = $retrieve_body;
    // }

    $retrieve_course_url_response = wp_remote_get("https://courses.teflinstitute.com/api_get_all_courses.php?user_id={$verify_body->output->id}");

    $course_list = array();
    if (!is_wp_error($retrieve_course_url_response)) {
        $retrieve_body = json_decode($retrieve_course_url_response['body']);
        $course_list = $retrieve_body;
    }



    $response = array(
        "status" => true,
        "value" => $verify_body,
        "uname" => $verify_body->output->username,
        "course_list" => $course_list,
        "content" => "Email/Username verified"
    );
    wp_die(json_encode($response));
}

// Hide Extensions products from shop page
add_action('pre_get_posts', 'hide_products_by_category');
function hide_products_by_category($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    $category_to_hide = 'extension';

    $tax_query = array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $category_to_hide,
            'operator' => 'NOT IN',
        ),
    );

    $query->set('tax_query', $tax_query);
}



// add_action('pre_get_posts','shop_filter_cat');
// function shop_filter_cat($query) {
//     if(!is_admin() && is_post_type_archive( 'product' ) && $query->is_main_query()) {
//         $query->set('tax_query', array(
//         array ('taxonomy' => 'product_cat',
//                 'field' => 'slug',
//                 'terms' => 'extension',
//                 'operator' => 'NOT IN'
//             )
//         )
//        );   
//     }
//  }

remove_action('woocommerce_order_details_after_order_table', 'woocommerce_order_again_button');
