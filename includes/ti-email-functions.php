<?php
/**
 * Add another email recipient for admin New Order emails if a shippable product is ordered
 *
 * @param string $recipient a comma-separated string of email recipients (will turn into an array after this filter!)
 * @param \WC_Order $order the order object for which the email is sent
 * @return string $recipient the updated list of email recipients
 */
function ti_conditional_email_recipient( $recipient, $order ) {

	// Bail on WC settings pages since the order object isn't yet set yet
	// Not sure why this is even a thing, but shikata ga nai
	$page = $_GET['page'] = isset( $_GET['page'] ) ? $_GET['page'] : '';
	if ( 'wc-settings' === $page ) {
		return $recipient; 
	}
	
	// just in case
	if ( ! $order instanceof WC_Order ) {
		return $recipient; 
	}

	$items = $order->get_items();
	
	// check if a shipped product is in the order	
	foreach ( $items as $item ) {
		//$product = $order->get_product_from_item( $item );
		$product_id = $item->get_product_id();
		
		if ( $product_id !== 92814 || $product_id !== 92815  || $product_id !== 101542 || $product_id !== 101539) {
			$recipient .= ', hello@teflinstitute.com';
		}
      
        if ( $product_id == 9688 || $product_id == 58069  || $product_id == 58063 || $product_id == 66153 ) {
			$recipient .= ', recruitment@teflinstitute.com';
		}

        if ( $product_id == 943 ) {
			$recipient .= ', marketingteam@tefl.ie';
		}

        // New: Chloe + recruitment
        if ( in_array( $product_id, array( 110823, 6514, 70951 ), true ) ) {
			$recipient .= ', chloe@teflinstitute.com, recruitment@teflinstitute.com';
		}
		
		if ( $product_id == 84816 || $product_id == 70835 || $product_id == 70833 || $product_id == 70827 || $product_id == 70826 || $product_id == 63558 || $product_id == 4514 || $product_id == 7110 || $product_id == 9615 || $product_id == 5608 || $product_id == 9305 || $product_id == 9306 || $product_id == 7898 || $product_id == 10050) {
			$recipient .= ', academic@teflinstitute.com';
			return $recipient;
		}
	}
	
	return $recipient;
}
add_filter( 'woocommerce_email_recipient_new_order', 'ti_conditional_email_recipient', 10, 2 );





function webinar_zoom_details( $output, $name, $html ) {

    $webinar_id             = isset($_POST['webinar-id']) ? $_POST['webinar-id'] : false;
    $webinar_name           = get_the_title($webinar_id);
    $webinar_date           = get_field('webinar_date', $webinar_id);
    $webinar_time           = get_field('webinar_time', $webinar_id);
    $webinar_zoom_url       = get_field('event_zoom_url', $webinar_id);
    $webinar_zoom_id        = get_field('event_zoom_id', $webinar_id);
    $webinar_zoom_passcode  = get_field('event_zoom_passcode', $webinar_id);

	$user_timezone          = get_user_timezone();
	// Same UK clock rule as DAY_LIGHT_SAVINGS in wp-config (Europe/London),
	// applied to the webinar's own date.
	$webinar_datetime = DateTime::createFromFormat('d.m.Y h:i A', $webinar_date . ' ' . $webinar_time, new DateTimeZone('Europe/London'));
    $base_timezone          = $webinar_datetime ? $webinar_datetime->format('T') : (DAY_LIGHT_SAVINGS ? 'BST' : 'GMT');
    $webinar_time_local     = false;
    $webinar_date_local     = '';

	if ($webinar_datetime && $user_timezone) {
        try {
            $webinar_datetime->setTimezone(new DateTimeZone($user_timezone));
            $webinar_date_local = $webinar_datetime->format('l, j F Y');
            $webinar_time_local = $webinar_datetime->format('g:i a');
        } catch (Exception $e) {
            $webinar_time_local = false;
        }
    }

    if ( 'webinar_zoom_details' == $name ) {
        if ( $webinar_zoom_url && $webinar_zoom_id && $webinar_zoom_passcode ) {
            ob_start(); 
            ?>
            <p><?php echo $webinar_name; ?></p>
            <p>Below are all the details you need to join our webinar.</p>
            <p>Join Zoom Webinar with the following details:<br/>Time: <?php echo $webinar_time; ?> at <?php echo $webinar_date; ?> - London Time (<?php echo $base_timezone?>)</p>
            <?php if($webinar_time_local): ?>
            <br/>
            Local Time: <?php echo $webinar_time_local; ?> at <?php echo $webinar_date_local; ?> - <?php echo $user_timezone ?></p>
            <?php endif ?>
			<br/><a href="<?php echo $webinar_zoom_url; ?>"><?php echo $webinar_zoom_url; ?></a>
            <br/>
            <p>Meeting ID: <?php echo $webinar_zoom_id; ?><br/>Passcode: <?php echo $webinar_zoom_passcode; ?></p>
            <?php
            $output = ob_get_clean();
        } else {
            $output = "<p>Your webinar details will be emailed to you shortly!</p>";
        }
    }
    
    return $output;
}

add_filter( 'wpcf7_special_mail_tags', 'webinar_zoom_details', 99, 3 );