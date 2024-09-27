<?php

// add_action('template_redirect', 'lms_sso_redirect');

function lms_sso_redirect(){

    if ( is_page('lms-sso') ) {
        wp_redirect('https://courses.teflinstitute.com/');
        exit();
    }
    
}