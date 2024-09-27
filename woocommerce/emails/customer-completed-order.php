<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email );  ?>

<?php /* translators: %s: Customer first name */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>

<?php

// Categories
define("COURSES", 48);
define("SPECIALIST_COURSES", 141);
define("INTERNSHIPS", 124);
define("ADDONS", 57);
define("FREE", 142);
define("TRIAL", 227);

// Internships
define("SOUTH_KOREA", 58063);
define("VIETNAM", 58069);
define("JAPAN", 63951);
define("THAILAND", 9688);
define("THAILAND_VOLUNTEER", 73769);
define("MYANMAR", 62084);
define("SPAIN", 66153);
define("CAMBODIA", 75260);
define("ELT", 1788);

$items = $order->get_items();

$has_courses_in_cart = False;
$has_trial_in_cart = False;
$has_specialist_courses_in_cart = False;
$has_internships_in_cart = False;
$has_addons_in_cart = False;
$has_free_in_cart = False;

$has_south_korea_internship = False;
$has_vietnam_internship = False;
$has_japan_internship = False;
$has_thailand_internship = False;
$has_thailand_volunteer_internship = False;
$has_myanmar_internship = False;
$has_spain_internship = False;
$has_cambodia_internship = False;

$has_elt = False;

$list_of_courses = array();
$trial_text = "
<p>You now have instant access to the TEFL Diploma 3-Day Trial, using your unique email and password.</p>
<p>During your trial you have unlimited access to course modules one, two and three of the Level 5 TEFL Diploma / Advanced Diploma.</p>
<p>If you wish to enrol on a <a href='https://teflinstitute.com/tefl-courses/'>TEFL Diploma</a> course after your trial you will use the same username and password that you created today to log into our website to complete your booking quickly, with just a few clicks. Your full course access will instantly appear on your Learner Dashboard.</p>
";

$courses = "<p>The TEFL Institute team has made every effort to put together all the information you’ll need to live and work around the world. If you have any other queries at any stage of your course, then please get in touch - our friendly team is more than happy to help.</p>
<strong>Your study style</strong>
<p>Our courses are filled with valuable content, videos, podcasts, reflective tasks, and tests. The best part is it’s all online and can be completed in your own time and from home.</p>
<p>You have six months to complete your course. You’ve seen from our average completion times that it won’t take you this long, but it leaves enough time to suit any lifestyle and situation. If you need more time, thats ok! We have extension options too.</p>
<strong>Getting started</strong>
<p>To begin your course, please follow these simple steps:</p> 
<ul style='list-style-type: none;'>
	<li>1. Click <a href='https://courses.teflinstitute.com/login/index.php'>THIS LINK</a> or click the student portal link on our website.</li>
	<li>2. Log in using your username and password created at the checkout</li>
	<li>3. Watch our dashboard explainer video to help you navigate through your course(s)</li>
	<li>4. Start learning!</li>
</ul>
<p>You’ll receive an email shortly introducing your personal tutor who is here to help you during your course. Youll also receive instructions for your 10 Hour Classroom Methodologies Course if you enrolled. </p>
<strong>Your TEFL certificate</strong>
<p>All our accredited courses include a PDF version of the TEFL certificate. This is perfect for easily applying for jobs online or abroad. If you do need a hard copy, we have options available at an extra cost.</p>
<p>For our Level 5 TEFL courses, your digital and harcopy Ofqual certificates are included for free!</p>
<p>From all of us at the TEFL Institute, we wish you the best of luck with your course. Youll also receive a call from us soon to check you’re settling into your course okay.</p>
";

$internships = "<p>This unique paid internship offers you the once-in-a-lifetime chance to get TEFL certified and teach English abroad in an immersive, practical setting with full orientation programs and 24/7 in-country support.</p>
<p>Regarding your paid internship, your details will be given to our fantastic in-country coordinator and you’ll hear from them shortly. They’ll help you complete the application documents and will prepare everything for your arrival.</p>
<p>You then have 3 months to fully complete your TEFL training before embarking on your paid internship.</p>";

$korea_text = "<p><strong>What's next?</strong> Complete <a href='https://tally.so/r/31rOog'>your internship application form</a> and submit it within 3 working days.</p>";

$cambodia_text = "<p><span style='color:#b90e0a;'><strong>What's next?</strong></span> Complete <a href='https://tally.so/r/31rOog'>your internship application form</a> and submit it within 3 working days.</p>";

$vietnam_text = "<p><strong>What's next?</strong> Complete <a href='https://tally.so/r/31rOog'>your internship application form</a> and submit it within 3 working days.</p>";

$japan_text = "<p><strong>What's next?</strong> Complete <a href='https://tally.so/r/31rOog'>your internship application form</a> and submit it within 3 working days.</p>";

$thailand_text = "<p><strong>What's next?</strong> Complete <a href='https://tally.so/r/31rOog'>your internship application form</a> and submit it within 3 working days.</p>";

$thailand_volunteer_text = "<p><strong>What's next?</strong> Complete <a href='https://tally.so/r/31rOog'>your internship application form</a> and submit it within 3 working days.</p>";

$myanmar_text = "<p><strong>What's next?</strong> Complete <a href='https://tally.so/r/31rOog'>your internship application form</a> and submit it within 3 working days.</p>";

$spain_text = "<p><strong>What's next?</strong> Complete <a href='https://tally.so/r/31rOog'>your internship application form</a> and submit it within 3 working days.</p>";

$elt_text = "<p>Here is confirmation that you have taken our English test, we hope you enjoyed it!</p>
<p>Please note you have now created an account on our system. <br>
If in the future you wish to purchase a TEFL course or any other product, you will need to login as a returning customer. </p>";

foreach ($items as $item) {
	$terms = get_the_terms($item['product_id'], 'product_cat');
	$product_cat_ids = array();

	foreach ($terms as $term) {
		$product_cat_ids[] = $term->term_id;
	}
	
	if (in_array(COURSES, (array) $product_cat_ids)) {
		$has_courses_in_cart = True;
		$list_of_courses[] =  $item['name'];
	}
	
	if (in_array(SPECIALIST_COURSES, (array) $product_cat_ids)) {
		$has_specialist_courses_in_cart = True;
		$list_of_courses[] =  $item['name'];
	}

	// if (in_array(INTERNSHIPS, (array) $product_cat_ids)) {
	// 	$has_internships_in_cart = True;
	// 	$list_of_courses[] =  $item['name'];
	// }
	
	if (in_array(ADDONS, (array) $product_cat_ids)) {
		$has_addons_in_cart = True;
		$list_of_courses[] =  $item['name'];
	}
	
	if (in_array(FREE, (array) $product_cat_ids)) {
		$has_free_in_cart = True;
		$list_of_courses[] =  $item['name'];
	}
  
  	if (in_array(TRIAL, (array) $product_cat_ids)) {
		$has_trial_in_cart = True;
		$list_of_courses[] =  $item['name'];
	}

    $has_south_korea_internship = ($item['product_id'] == SOUTH_KOREA);
    $has_vietnam_internship = ($item['product_id'] == VIETNAM);
    $has_japan_internship = ($item['product_id'] == JAPAN);
    $has_thailand_internship = ($item['product_id'] == THAILAND);
    $has_thailand_volunteer_internship = ($item['product_id'] == THAILAND_VOLUNTEER);
    $has_myanmar_internship = ($item['product_id'] == MYANMAR);
	$has_spain_internship = ($item['product_id'] == SPAIN);
  	$has_cambodia_internship = ($item['product_id'] == CAMBODIA);
    $has_elt = ($item['product_id'] == ELT);

}

if ($has_courses_in_cart || $has_specialist_courses_in_cart || $has_addons_in_cart || $has_free_in_cart || $has_trial_in_cart ) {
	$nb_of_courses = count($list_of_courses);

	echo "Thank you for enrolling onto our ";
	
	if ($nb_of_courses > 1) {
		foreach ($list_of_courses as $key => $name) {
			if ($key == $nb_of_courses - 1) {
				echo "and " . $name . " ";
			} else {
				echo " " . $name . ", ";
			}
		}
	} else {
		echo " " . $list_of_courses[0];
	}

	echo " and welcome to the TEFL Institute! <br><br></p>";
}

	if ($has_courses_in_cart || $has_specialist_courses_in_cart) {
        echo $courses;
    }

    if($has_trial_in_cart){
      	echo $trial_text;
    }

    if ($has_internships_in_cart) {
        echo $internships;
    }

    if ($has_elt) {
        echo $elt_text;
    }

    if ($has_south_korea_internship) {
        echo $korea_text;
    }

    if ($has_cambodia_internship) {
        echo $cambodia_text;
    }

    if ($has_vietnam_internship) {
        echo $vietnam_text;
    }

    if ($has_japan_internship) {
        echo $japan_text;
    }

    if ($has_thailand_internship) {
        echo $thailand_text;
    }

    if ($has_thailand_volunteer_internship) {
        echo $thailand_volunteer_text;
    }

    if ($has_myanmar_internship) {
        echo $myanmar_text;
    }

    if ($has_spain_internship) {
        echo $spain_text;
    }

?>

<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
