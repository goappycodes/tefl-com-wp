<?php

require('wp-load.php');
global $wpdb;

// Scan wp_options table for <script> tags
$options = $wpdb->get_results("SELECT option_name, option_value FROM {$wpdb->options}");

$findings = [];

foreach ($options as $option) {
    if (strpos($option->option_value, '<script>') !== false) {
        $findings[] = $option->option_name;
    }
}

$recipients = ['ranabikram49@gmail.com'];
$headers = ['Content-Type: text/html; charset=UTF-8'];

if (!empty($findings)) {
    $subject = '⚠️ Script Tags Detected in wp_options ⚠️';

    $message = '<h1>Scan Report for wp_options Table</h1>';
    $message .= '<p>The following option names contain &lt;script&gt; tags:</p>';
    $message .= '<ul>';

    foreach ($findings as $finding) {
        $message .= '<li>' . esc_html($finding) . '</li>';
    }

    $message .= '</ul>';

    $sent = wp_mail($recipients, $subject, $message, $headers);

    if ($sent) {
        echo 'Scan complete. Report sent.';
    } else {
        echo 'Failed to send the email. Please check your email configuration.';
    }
} else {
    echo 'No script tags found in wp_options. ';
}

// Check home page source for specific strings
$url = home_url();

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$page_source = curl_exec($ch);

if ($page_source === false) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    curl_close($ch);
    // Exclude the content inside <script id="perfmatters-delayed-scripts-js"></script>
    $page_source = preg_replace('/<script id="perfmatters-delayed-scripts-js"[^>]*>.*?<\/script>/is', '', $page_source);
    
    $subject = '⚠️Potential Issue Found⚠️';
    
    $message = 'The following string(s) were found in ' . $url . ':<br>';
    $found_atob = false;
    $found_appendChild = false;
    
    if (preg_match("/atob\(/i", $page_source)) {
        $found_atob = true;
        $message .= '- "atob("<br>';
    }

    // if (preg_match("/\bbody\s*\.appendChild\s*\(/i", $page_source)) {
    //     $found_appendChild = true;
    //     $message .= '- "body.appendChild"<br>';
    // }

    if ($found_atob || $found_appendChild) {
        echo 'Potential issue found in home page source. ';
        wp_mail($recipients, $subject, $message, $headers);
    } else {
        echo 'No issues found in home page source.';
    }
}

?>