<?php

/**
 * Add fields to the checkout
 */
add_action( 'woocommerce_after_order_notes', 'tefl_add_someone_else_checkout_fields' );

function tefl_add_someone_else_checkout_fields( $checkout ) {
	//if(is_user_logged_in()): ?>
        <div class="someone-else-checkout-div">
            <?php add_buying_course_checkout_radio_field($checkout);
		    add_someone_else_field($checkout); ?>
        </div>
	<?php //endif;
}

/**
 * Add Buying Course Checkout radio button field to the checkout.
 */
function add_buying_course_checkout_radio_field( $checkout ) {

	$chosen = WC()->session->get( 'radio_chosen' );
   	$chosen = empty( $chosen ) ? WC()->checkout->get_value( 'radio_choice' ) : $chosen;
   	$chosen = empty( $chosen ) ? 'myself' : $chosen;
        
   	$args = array(
		'type' => 'radio',
		'class' => array( 'form-row-wide', 'buying_course_checkout' ),
		'options' => array(
			'myself' => 'I am buying the course for myself',
			'someone_else' => 'I am buying the course for someone else',
		),
		'default' => $chosen
	);
     
   echo '<div id="buying_course_checkout_radio">';
   woocommerce_form_field( 'radio_choice', $args, $chosen );
   echo '</div>';
}


/**
 * Add Someone Else field to the checkout.
 */
function add_someone_else_field( $checkout ) {

	echo '<div id="someone_else_checkout_field">';
	echo '<p class="se-fields-note">' . esc_html__( 'Please tell us about the person you\'re purchasing the course for. N.B. the details you enter here MUST match their passport exactly as they are used for their certificate.' ) . '</p>';
	woocommerce_form_field(
		'se_first_name',
		array(
			'type'        => 'text',
			'class'       => array(
				'se_first_name form-row-first',
			),
			'label'       => __( 'First and Middle Names' ),
		),
		$checkout->get_value( 'se_first_name' )
	);
	woocommerce_form_field(
		'se_last_name',
		array(
			'type'        => 'text',
			'class'       => array(
				'se_last_name form-row-last',
			),
			'label'       => __( 'Last Name' ),
		),
		$checkout->get_value( 'se_last_name' )
	);
	woocommerce_form_field(
		'se_email',
		array(
			'type'        => 'email',
			'class'       => array(
				'se_email form-row-first',
			),
			'label'       => __( 'Email' ),
		),
		$checkout->get_value( 'se_email' )
	);
	woocommerce_form_field(
		'se_password',
		array(
			'type'        => 'password',
			'class'       => array(
				'se_password form-row-last',
			),
			'label'       => __( 'Password' ),
		),
		$checkout->get_value( 'se_password' )
	);
	woocommerce_form_field(
		'se_phone',
		array(
			'type'        => 'tel',
			'class'       => array(
				'se_phone form-row-first',
			),
			'label'       => __( 'Phone' ),
		),
		$checkout->get_value( 'se_phone' )
	);
	woocommerce_form_field(
		'se_date_of_birth',
		array(
			'type'        => 'date',
			'class'       => array(
				'se_date_of_birth form-row-last',
			),
			'label'       => __( 'Date Of Birth' ),
			'placeholder' => __( 'Select Date' ),
		),
		$checkout->get_value( 'se_date_of_birth' )
	);
	echo '</div>';
}




/**
 * Check that the Someone Else field is filled.
 *
 */
add_action( 'woocommerce_checkout_process', 'check_se_checkout_field' );

function check_se_checkout_field() {
	
	if ( $_POST['radio_choice'] == 'someone_else' ) {
		if ( ! $_POST['se_first_name'] ) {
			wc_add_notice( __( 'Please enter First name of Another User.' ), 'error' );
		}
		if ( ! $_POST['se_last_name'] ) {
			wc_add_notice( __( 'Please enter Last name of Another User.' ), 'error' );
		}
		if ( ! $_POST['se_email'] ) {
			wc_add_notice( __( 'Please enter Email of Another User.' ), 'error' );
		}
		if ( ! $_POST['se_password'] ) {
			wc_add_notice( __( 'Please enter Password of Another User.' ), 'error' );
		}
		if ( ! $_POST['se_phone'] ) {
			wc_add_notice( __( 'Please enter Phone of Another User.' ), 'error' );
		}
		if ( ! $_POST['se_date_of_birth'] ) {
			wc_add_notice( __( 'Please enter Date of Birth of Another User.' ), 'error' );
		}
	}

}


/**
 * Add Someone Else data to Order Meta.
 *
 * @param Integer $order_id User ID.
 * @return void
 */
add_action( 'woocommerce_checkout_update_order_meta', 'tefl_add_se_data_to_order_meta' );

function tefl_add_se_data_to_order_meta( $order_id ) {

	if ( $_POST['radio_choice'] ) {
		update_post_meta( $order_id, 'se_radio_choice', sanitize_text_field( $_POST['radio_choice'] ) );
	}
	if ( $_POST['se_first_name'] ) {
		update_post_meta( $order_id, 'se_first_name', sanitize_text_field( $_POST['se_first_name'] ) );
	}
	if ( $_POST['se_last_name'] ) {
		update_post_meta( $order_id, 'se_last_name', sanitize_text_field( $_POST['se_last_name'] ) );
	}
	if ( $_POST['se_email'] ) {
		update_post_meta( $order_id, 'se_email', sanitize_text_field( $_POST['se_email'] ) );
	}
	if ( $_POST['se_password'] ) {
		update_post_meta( $order_id, 'se_password', sanitize_text_field( $_POST['se_password'] ) );
	}
	if ( $_POST['se_phone'] ) {
		update_post_meta( $order_id, 'se_phone', sanitize_text_field( $_POST['se_phone'] ) );
	}
	if ( $_POST['se_date_of_birth'] ) {
		update_post_meta( $order_id, 'se_date_of_birth', sanitize_text_field( $_POST['se_date_of_birth'] ) );
	}
}

function get_new_user_details_from_order_id($order_id){
	$se_first_name = get_post_meta($order_id, 'se_first_name', true);
	$se_last_name = get_post_meta($order_id, 'se_last_name', true);
	$se_email = get_post_meta($order_id, 'se_email', true);
	$se_phone = get_post_meta($order_id, 'se_phone', true);
	$se_password = get_post_meta($order_id, 'se_password', true);
	$se_date_of_birth = get_post_meta($order_id, 'se_date_of_birth', true);

	$user_details = [
		"se_first_name" 	=> $se_first_name,
		"se_last_name" 		=> $se_last_name,
		"se_email" 			=> $se_email,
		"se_phone" 			=> $se_phone,
		"se_password" 		=> $se_password,
		"se_date_of_birth" 	=> $se_date_of_birth
	];

	return $user_details;
}

function tefl_get_moodle_course( $order_id ) {
	$order = wc_get_order( $order_id );
    $moodle_course_title_array = array();
    foreach ( $order->get_items() as $item_id => $item ) {
        $product_id = $item->get_product_id();
        $product_options = get_post_meta($product_id, 'product_options', true);
        $moodle_post_course_id = $product_options['moodle_post_course_id'];

        foreach($moodle_post_course_id as $mcid) {
            $moodle_course_title = get_the_title($mcid);
            array_push($moodle_course_title_array, $moodle_course_title);
        }
    }
    $moodle_courses_title = implode(", ", $moodle_course_title_array);
    return $moodle_courses_title;
}

function tefl_email_to_new_user($order_id){

	$user_details = get_new_user_details_from_order_id($order_id);

	$se_first_name 		= $user_details["se_first_name"];
	$se_last_name 		= $user_details["se_last_name"];
	$se_email 			= $user_details["se_email"];
	$se_password 		= $user_details["se_password"];

	$moodle_course_name = tefl_get_moodle_course($order_id);
	$to = $se_email;
	$admin_email = get_option('admin_email');
	$site_url = get_site_url();
	$subject = 'TEFL Institute Enrolled Course Details';
	$body = 'Hi '.$se_first_name.' '.$se_last_name.',<br/><br/> You are enrolled to the following courses in the TEFL Institute site: '.$moodle_course_name.'. <br/><br/><a href="'.$site_url.'/my-account/">Click Here</a> to Login. The Login Details are given below: <br/> Username/Email: '.$se_email.'<br/>Password: '.$se_password.'<br/><br/><a href="https://courses.teflinstitute.com/">Click Here</a> to access to the Student Portal.<br/><br/>';
	$headers = array('Content-Type: text/html; charset=UTF-8','From: TEFL Institute <'.$admin_email.'>');
	
	wp_mail( $to, $subject, $body, $headers );
}

function tefl_update_user_details($order_id, $user_id){
    
    $user_details = get_new_user_details_from_order_id($order_id);

	$se_first_name 		= $user_details["se_first_name"];
	$se_last_name 		= $user_details["se_last_name"];
	$se_phone 			= $user_details["se_phone"];
	$se_date_of_birth 	= $user_details["se_date_of_birth"];
	
	update_user_meta($user_id, 'first_name', $se_first_name);
	update_user_meta($user_id, 'last_name', $se_last_name);
	update_user_meta($user_id, 'billing_phone', $se_phone);
	update_user_meta($user_id, 'date_of_birth', $se_date_of_birth);
}


add_action( 'woocommerce_checkout_update_order_meta', 'tefl_create_update_new_user', 12, 2 );
function tefl_create_update_new_user( $order_id, $posted_data ) {
	$user_details = get_new_user_details_from_order_id($order_id);
    
	$se_first_name 		= $user_details["se_first_name"];
	$se_last_name 		= $user_details["se_last_name"];
	$se_email 			= $user_details["se_email"];
	$se_phone 			= $user_details["se_phone"];
	$se_password 		= $user_details["se_password"];
	$se_date_of_birth 	= $user_details["se_date_of_birth"];

	if($se_first_name && $se_last_name && $se_email && $se_phone && $se_password && $se_date_of_birth) {
		if (email_exists($se_email) == false) {

			// Create the new user
			$user_id = wp_create_user( $se_email, $se_password, $se_email );
			$_POST['account_password'] = $se_password;

			error_log("post details pass: ".print_r($_POST, true));

			// Get current user object
			$user = get_user_by('id', $user_id);
			// Add role
			$user->add_role('customer');
			// Remove role
			$user->remove_role( 'subscriber' );

			update_post_meta($order_id, '_customer_user', $user_id);

			tefl_update_user_details($order_id, $user_id);

			tefl_email_to_new_user($order_id);

			
		}else{
			$user = get_user_by( 'email', $se_email );
			$user_id = $user->ID;

			update_post_meta($order_id, '_customer_user', $user_id);

			tefl_update_user_details($order_id, $user_id);

			tefl_email_to_new_user($order_id);
		}
	}
	
}

