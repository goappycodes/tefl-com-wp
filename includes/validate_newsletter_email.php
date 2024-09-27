<?php
/*  Disable multiple newsletter signup for a single mail
*/

function email_exists_in_cfdb7($email,$form_id) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'db7_forms';

    // Check if the table exists
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") === $table_name) {
        $email_exists = $wpdb->get_var("SELECT EXISTS(SELECT 1 FROM $table_name WHERE form_post_id = $form_id AND form_value LIKE '%$email%')");
        if ($email_exists) {
            return true; // Email exists
        } else {
            return false; // Email does not exist
        }
    } else {
        return false; // Table does not exist
    }
}


add_filter( 'wpcf7_validate_email*', 'check_email_before_submission', 10, 2 );

function check_email_before_submission ( $result, $tags ) {
    $form_ids = array(58212, 72610);
    $form = WPCF7_Submission::get_instance(); 
    $wpcf7 = WPCF7_ContactForm::get_current();
    $form_id = $wpcf7->id;
    if(in_array($form_id, $form_ids)){
        foreach ($form->get_posted_data() as $name => $value) {
            if (strpos($name, 'email') !== false) {
                $email = $value;
                $email_exists = email_exists_in_cfdb7($email,$form_id);
                if ($email_exists) {
                    $result->invalidate($name, 'Email already used.');
                }
                break; 
            }
        }
    }
    return $result;
}

