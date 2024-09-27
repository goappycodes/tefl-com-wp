<?php

add_action( 'wpcf7_mail_sent', 'ti_send_email_after_3days' ); 

function ti_send_email_after_3days( $contact_form ) {
	
    $form_id = $contact_form->id();

    if( $form_id == 3901 ) {
	    
	    $submission = WPCF7_Submission::get_instance();

	    if ( $submission ) {
	        $formdata = $submission->get_posted_data();
        	$email = $formdata['your-email'];
        	wp_schedule_single_event( time() + 259200, 'ti_send_salary_calculator_email_after_3days', array( $email ) );
	    }
	}
}


function ti_send_salary_calculator_email_after_3days_fn( $email ) {
	
	$to = $email;
	$subject = 'Have you completed your task yet?';
	$body = get_field( '3days_after_email_template', 3885 );
	$headers = array('Content-Type: text/html; charset=UTF-8','From: TEFL Institute <hello@teflinstitute.com>');
	 
	wp_mail( $to, $subject, $body, $headers );
}
add_action( 'ti_send_salary_calculator_email_after_3days', 'ti_send_salary_calculator_email_after_3days_fn', 10, 1 );



 
