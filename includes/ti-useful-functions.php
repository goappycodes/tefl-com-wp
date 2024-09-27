<?php

function ticom_custom_log( $entry, $file = 'ptcustom', $mode = 'a' ) { 
    
    if ( is_wp_error($entry) ) {
        return ;
    }

    $upload_dir = wp_upload_dir();
    $upload_dir = $upload_dir['basedir'];
    if ( is_array( $entry ) ) { 
        $entry = json_encode( $entry ); 
    } 

    $file  = $upload_dir . '/' . $file . '.log';
    $file  = fopen( $file, $mode );
	if (!$file) return '';
    $bytes = fwrite( $file, current_time( 'mysql' ) . "::" . $entry . "\n" ); 
    fclose( $file ); 
    return $bytes;
}

add_filter('upload_mimes','remove_mime_types');
function remove_mime_types($mimes){
    unset( $mimes['zip'] );
    unset( $mimes['php'] );
    unset( $mimes['svg'] );
    return $mimes;
}

add_action('wp_login', 'affwp_login_redirect_ti', 1);

function affwp_login_redirect_ti($redirect){
    if ( stripos($_SERVER['HTTP_REFERER'], 'affiliate-area') !== FALSE  ){
        wp_redirect('/affiliate-area/');
        exit();
    }
}

function ti_remove_spaces_special_chars($tab_title, $attr)
{
    $tab_title_lc = strtolower($tab_title);
    $tab_attr_val = '';
    if ($attr == 'id') {
        $tab_attr_val = preg_replace('/\s+/', '_', $tab_title_lc);
        $tab_attr_val = preg_replace('/[^A-Za-z_\-]/', '', $tab_attr_val);
        $tab_attr_val = trim($tab_attr_val, "_");
    } else if ($attr == 'class') {
        $tab_attr_val = preg_replace('/\s+/', '-', $tab_title_lc);
        $tab_attr_val = preg_replace('/[^A-Za-z_\-]/', '', $tab_attr_val);
        $tab_attr_val = trim($tab_attr_val, "-");
    }

    return $tab_attr_val;
}


add_filter('woocommerce_dropdown_variation_attribute_options_args', 'ti_filter_dropdown_args', 10);

function ti_filter_dropdown_args($args)
{
    if (is_page('4786')) {
        $args['show_option_none'] = 'Select a Quantity';
        return $args;
    } else {
        $args['show_option_none'] = 'choose your date';
        return $args;
    }
    return $args;
}


function ti_woocommerce_order_event_log($entry, $mode = 'a', $file = 'plugin')
{
    // Get WordPress uploads directory.
    $upload_dir = wp_upload_dir();
    $upload_dir = $upload_dir['basedir'];
    // If the entry is array, json_encode.
    if (is_array($entry)) {
        $entry = json_encode($entry);
    }
    // Write the log file.
    $file  = $upload_dir . '/woocommerce-order-logs/' . $file . '.log';
    $file  = fopen($file, $mode);

	if (!$file) return '';

    $bytes = fwrite($file, current_time('mysql') . "::" . $entry . "\n");
    fclose($file);
    return $bytes;
}


function custom_ti_log( $entry, $mode = 'a', $file = 'leads' ) { 

    $upload_dir = wp_upload_dir();
    $upload_dir = $upload_dir['basedir'];

    if ( is_array( $entry ) ) { 
      $entry = json_encode( $entry ); 
    } 

    $file  = $upload_dir . '/' . $file . '.log';
    $file  = fopen( $file, $mode );
	if (!$file) return '';
    $bytes = fwrite( $file, current_time( 'mysql' ) . "::" . $entry . "\n" ); 
    fclose( $file ); 
    return $bytes;
}


function get_ti_jobs($count, $is_featured)
{
    $transient_meta = "get_ti_jobs_$count_$featured";
    $output = get_transient($transient_meta);
    if ($output) return $output;

    $job_api = 'https://jobs.teflinstitute.com/getjobs.php?count=' . $count . '&is_featured=' . $is_featured;
    $response = wp_remote_get($job_api);

    if (is_array($response) && !is_wp_error($response)) :
        $response_body = $response['body'];
        $response_body_decoded = json_decode($response_body);
    endif;

    set_transient($transient_meta, $response_body_decoded, DAY_IN_SECONDS);

    return $response_body_decoded;
}


function get_ti_jobs_location($location)
{
    $transient_meta = "get_ti_jobs_$location";
    $output = get_transient($transient_meta);
    if ($output) return $output;

    $job_api = 'https://jobs.teflinstitute.com/jobsapi.php?job_location='.$location;
    $response = wp_remote_get($job_api);

    if (is_array($response) && !is_wp_error($response)) :
        $response_body = $response['body'];
        $response_body_decoded = json_decode($response_body);
    endif;

    set_transient($transient_meta, $response_body_decoded, DAY_IN_SECONDS);
    
    return $response_body_decoded;
}


// Get product stock quantity

function get_total_combined_stock_quantity($product)
{
    if (!$product->is_type('variable')) {
        return $product->get_stock_quantity();
    }

    //Stock management is enabled at product level
    if ($product->managing_stock()) {
        return $product->get_stock_quantity();
    }

    $total = 0;

    if ($product->is_type('variable')) {
        foreach ($product->get_visible_children() as $variationId) {
            $variation = wc_get_product($variationId);
            $total += $variation->get_stock_quantity();
        }
    }

    return $total;
}


add_filter( 'mc4wp_integration_contact-form-7_subscriber_data', function(MC4WP_MailChimp_Subscriber $subscriber, $cf7_form_id) {
    if ( $cf7_form_id == 58212 ) {
        $subscriber->tags[] = 'Newsletter Discount';
    }
    return $subscriber;
 }, 10, 2);

 // Show stocks details

 add_filter( 'woocommerce_get_availability_text', 'ti_custom_availability_text', 1, 2);

 function ti_custom_availability_text( $availability, $_product ) {
     if ( ! is_product() ) {
         if ( $_product->is_in_stock() ) {
             $stock_qty = $_product->get_stock_quantity();
             if($stock_qty===1){
                 $availability = sprintf( __( 'Only <span class="stock-quantity">%s</span> place left', 'woocommerce' ), $stock_qty );
             }
             else{
                 $availability = sprintf( __( '<span class="stock-quantity">%s</span> places left', 'woocommerce' ), $stock_qty );
             }
         } else {
             $availability = __( 'No spots left', 'woocommerce' );
         }
     }
     return $availability;
 }

 
// Get latest webinars
function get_latest_webinars( $num_posts ) {
    $webinar_args = array(
        'numberposts' => $num_posts,
        'post_type'   => 'webinar',
        'status'      => 'published',
        'orderby'     => 'meta_value',
        'order'       => 'ASC',
        'meta_query'  => array(
            'relation' => 'AND',
            array(
                'key'     => 'webinar_date',
                'value'   => date('Ymd'),
                'compare' => '>=',
                'type'    => 'DATE',
            ),
            array(
                'key'     => 'webinar_date',
                'compare' => 'EXISTS',
            ),
        ),
    );

    $webinars = get_posts( $webinar_args );

    if ( $num_posts === 1 ) {
        return reset( $webinars );
    }

    return $webinars;
}


function format_phone_to_send($billing_phone, $billing_country){
    
    if (!$billing_country) return $billing_phone;

    $billing_phone = ltrim($billing_phone, "0");
    if (strpos($billing_phone, "+")=== false) {
        $calling_code = WC()->countries->get_country_calling_code( $billing_country );
        $calling_code = is_array( $calling_code ) ? $calling_code[0] : $calling_code;
        return $calling_code.$billing_phone;
    }
    return $billing_phone;
}


function send_twilio_sms($to, $body){

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.twilio.com/2010-04-01/Accounts/AC1b1e915483423925e3ab041f702ca66b/Messages.json',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => 'To='.urlencode($to).'&Body='.urlencode($body).'&From=%2B12018176556',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic QUMxYjFlOTE1NDgzNDIzOTI1ZTNhYjA0MWY3MDJjYTY2YjpjZDE2ODc0ZTdhYWUyNTM2ZjQ4YWE1Y2RmNDgxNWI4Mw==',
        'Content-Type: application/x-www-form-urlencoded'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    
}

// Utility function to get country name from country code

function get_country_name_by_code( $country_code ) {
	$countries = array(
		'AX' => 'Åland Islands',
		'AF' => 'Afghanistan',
		'AL' => 'Albania',
		'DZ' => 'Algeria',
		'AD' => 'Andorra',
		'AO' => 'Angola',
		'AI' => 'Anguilla',
		'AQ' => 'Antarctica',
		'AG' => 'Antigua and Barbuda',
		'AR' => 'Argentina',
		'AM' => 'Armenia',
		'AW' => 'Aruba',
		'AU' => 'Australia',
		'AT' => 'Austria',
		'AZ' => 'Azerbaijan',
		'BS' => 'Bahamas',
		'BH' => 'Bahrain',
		'BD' => 'Bangladesh',
		'BB' => 'Barbados',
		'BY' => 'Belarus',
		'PW' => 'Belau',
		'BE' => 'Belgium',
		'BZ' => 'Belize',
		'BJ' => 'Benin',
		'BM' => 'Bermuda',
		'BT' => 'Bhutan',
		'BO' => 'Bolivia',
		'BQ' => 'Bonaire, Saint Eustatius and Saba',
		'BA' => 'Bosnia and Herzegovina',
		'BW' => 'Botswana',
		'BV' => 'Bouvet Island',
		'BR' => 'Brazil',
		'IO' => 'British Indian Ocean Territory',
		'VG' => 'British Virgin Islands',
		'BN' => 'Brunei',
		'BG' => 'Bulgaria',
		'BF' => 'Burkina Faso',
		'BI' => 'Burundi',
		'KH' => 'Cambodia',
		'CM' => 'Cameroon',
		'CA' => 'Canada',
		'CV' => 'Cape Verde',
		'KY' => 'Cayman Islands',
		'CF' => 'Central African Republic',
		'TD' => 'Chad',
		'CL' => 'Chile',
		'CN' => 'China',
		'CX' => 'Christmas Island',
		'CC' => 'Cocos (Keeling) Islands',
		'CO' => 'Colombia',
		'KM' => 'Comoros',
		'CG' => 'Congo (Brazzaville)',
		'CD' => 'Congo (Kinshasa)',
		'CK' => 'Cook Islands',
		'CR' => 'Costa Rica',
		'HR' => 'Croatia',
		'CU' => 'Cuba',
		'CW' => 'CuraÇao',
		'CY' => 'Cyprus',
		'CZ' => 'Czech Republic',
		'DK' => 'Denmark',
		'DJ' => 'Djibouti',
		'DM' => 'Dominica',
		'DO' => 'Dominican Republic',
		'EC' => 'Ecuador',
		'EG' => 'Egypt',
		'SV' => 'El Salvador',
		'GQ' => 'Equatorial Guinea',
		'ER' => 'Eritrea',
		'EE' => 'Estonia',
		'ET' => 'Ethiopia',
		'FK' => 'Falkland Islands',
		'FO' => 'Faroe Islands',
		'FJ' => 'Fiji',
		'FI' => 'Finland',
		'FR' => 'France',
		'GF' => 'French Guiana',
		'PF' => 'French Polynesia',
		'TF' => 'French Southern Territories',
		'GA' => 'Gabon',
		'GM' => 'Gambia',
		'GE' => 'Georgia',
		'DE' => 'Germany',
		'GH' => 'Ghana',
		'GI' => 'Gibraltar',
		'GR' => 'Greece',
		'GL' => 'Greenland',
		'GD' => 'Grenada',
		'GP' => 'Guadeloupe',
		'GT' => 'Guatemala',
		'GG' => 'Guernsey',
		'GN' => 'Guinea',
		'GW' => 'Guinea-Bissau',
		'GY' => 'Guyana',
		'HT' => 'Haiti',
		'HM' => 'Heard Island and McDonald Islands',
		'HN' => 'Honduras',
		'HK' => 'Hong Kong',
		'HU' => 'Hungary',
		'IS' => 'Iceland',
		'IN' => 'India',
		'ID' => 'Indonesia',
		'IR' => 'Iran',
		'IQ' => 'Iraq',
		'IM' => 'Isle of Man',
		'IL' => 'Israel',
		'IT' => 'Italy',
		'CI' => 'Ivory Coast',
		'JM' => 'Jamaica',
		'JP' => 'Japan',
		'JE' => 'Jersey',
		'JO' => 'Jordan',
		'KZ' => 'Kazakhstan',
		'KE' => 'Kenya',
		'KI' => 'Kiribati',
		'KW' => 'Kuwait',
		'KG' => 'Kyrgyzstan',
		'LA' => 'Laos',
		'LV' => 'Latvia',
		'LB' => 'Lebanon',
		'LS' => 'Lesotho',
		'LR' => 'Liberia',
		'LY' => 'Libya',
		'LI' => 'Liechtenstein',
		'LT' => 'Lithuania',
		'LU' => 'Luxembourg',
		'MO' => 'Macao S.A.R., China',
		'MK' => 'Macedonia',
		'MG' => 'Madagascar',
		'MW' => 'Malawi',
		'MY' => 'Malaysia',
		'MV' => 'Maldives',
		'ML' => 'Mali',
		'MT' => 'Malta',
		'MH' => 'Marshall Islands',
		'MQ' => 'Martinique',
		'MR' => 'Mauritania',
		'MU' => 'Mauritius',
		'YT' => 'Mayotte',
		'MX' => 'Mexico',
		'FM' => 'Micronesia',
		'MD' => 'Moldova',
		'MC' => 'Monaco',
		'MN' => 'Mongolia',
		'ME' => 'Montenegro',
		'MS' => 'Montserrat',
		'MA' => 'Morocco',
		'MZ' => 'Mozambique',
		'MM' => 'Myanmar',
		'NA' => 'Namibia',
		'NR' => 'Nauru',
		'NP' => 'Nepal',
		'NL' => 'Netherlands',
		'AN' => 'Netherlands Antilles',
		'NC' => 'New Caledonia',
		'NZ' => 'New Zealand',
		'NI' => 'Nicaragua',
		'NE' => 'Niger',
		'NG' => 'Nigeria',
		'NU' => 'Niue',
		'NF' => 'Norfolk Island',
		'KP' => 'North Korea',
		'NO' => 'Norway',
		'OM' => 'Oman',
		'PK' => 'Pakistan',
		'PS' => 'Palestinian Territory',
		'PA' => 'Panama',
		'PG' => 'Papua New Guinea',
		'PY' => 'Paraguay',
		'PE' => 'Peru',
		'PH' => 'Philippines',
		'PN' => 'Pitcairn',
		'PL' => 'Poland',
		'PT' => 'Portugal',
		'QA' => 'Qatar',
		'IE' => 'Ireland',
		'RE' => 'Reunion',
		'RO' => 'Romania',
		'RU' => 'Russia',
		'RW' => 'Rwanda',
		'ST' => 'São Tomé and Príncipe',
		'BL' => 'Saint Barthélemy',
		'SH' => 'Saint Helena',
		'KN' => 'Saint Kitts and Nevis',
		'LC' => 'Saint Lucia',
		'SX' => 'Saint Martin (Dutch part)',
		'MF' => 'Saint Martin (French part)',
		'PM' => 'Saint Pierre and Miquelon',
		'VC' => 'Saint Vincent and the Grenadines',
		'SM' => 'San Marino',
		'SA' => 'Saudi Arabia',
		'SN' => 'Senegal',
		'RS' => 'Serbia',
		'SC' => 'Seychelles',
		'SL' => 'Sierra Leone',
		'SG' => 'Singapore',
		'SK' => 'Slovakia',
		'SI' => 'Slovenia',
		'SB' => 'Solomon Islands',
		'SO' => 'Somalia',
		'ZA' => 'South Africa',
		'GS' => 'South Georgia/Sandwich Islands',
		'KR' => 'South Korea',
		'SS' => 'South Sudan',
		'ES' => 'Spain',
		'LK' => 'Sri Lanka',
		'SD' => 'Sudan',
		'SR' => 'Suriname',
		'SJ' => 'Svalbard and Jan Mayen',
		'SZ' => 'Swaziland',
		'SE' => 'Sweden',
		'CH' => 'Switzerland',
		'SY' => 'Syria',
		'TW' => 'Taiwan',
		'TJ' => 'Tajikistan',
		'TZ' => 'Tanzania',
		'TH' => 'Thailand',
		'TL' => 'Timor-Leste',
		'TG' => 'Togo',
		'TK' => 'Tokelau',
		'TO' => 'Tonga',
		'TT' => 'Trinidad and Tobago',
		'TN' => 'Tunisia',
		'TR' => 'Turkey',
		'TM' => 'Turkmenistan',
		'TC' => 'Turks and Caicos Islands',
		'TV' => 'Tuvalu',
		'UG' => 'Uganda',
		'UA' => 'Ukraine',
		'AE' => 'United Arab Emirates',
		'GB' => 'United Kingdom',
		'US' => 'United States',
		'UY' => 'Uruguay',
		'UZ' => 'Uzbekistan',
		'VU' => 'Vanuatu',
		'VA' => 'Vatican',
		'VE' => 'Venezuela',
		'VN' => 'Vietnam',
		'WF' => 'Wallis and Futuna',
		'EH' => 'Western Sahara',
		'WS' => 'Western Samoa',
		'YE' => 'Yemen',
		'ZM' => 'Zambia',
		'ZW' => 'Zimbabwe',
	);
	return ( isset( $countries[ $country_code ] ) ? $countries[ $country_code ] : false );
}

// Append country info to contact for submission data
add_filter('wpcf7_posted_data', 'append_country_brand_to_contact_form_data', 20, 1);
add_filter('ctz_get_data_from_contact_form','append_country_brand_to_contact_form_data',25,1);

function append_country_brand_to_contact_form_data($posted_data) {
   
    $user_cc = get_user_geo_country_code();
	$brand = 'TEFL Institute';
    $posted_data['brand'] = $brand;
    if($user_cc){
        $user_cn = get_country_name_by_code($user_cc);

        if ($user_cn) {
            $posted_data['detected_user_country'] = $user_cn;
        }
    }
    // wp_mail('ranabikram49@gmail.com', 'Test', print_r($posted_data, true));
    return $posted_data;
}

//Function to check if an associative array is empty

function is_array_empty($array) {
    if (!is_array($array) || empty($array)) {
        return true; // Not an array or is an empty array
    }
    
    foreach ($array as $value) {
        if (is_array($value)) {
            // If it's an array, check recursively
            if (!is_array_empty($value)) {
                return false;
            }
        } else {
            // For non-array values, check if they are not empty
            if (!empty($value)) {
                return false;
            }
        }
    }
    // If all values are empty or recursively contain empty arrays
    return true;
}


// Contact form 'Undefined value was submitted through this field' bug fix
remove_action( 'wpcf7_swv_create_schema', 'wpcf7_swv_add_checkbox_enum_rules', 20, 2 );

// Custom FB event
add_action('wp_footer', 'track_custom_fb_events');
function track_custom_fb_events(){
    if (get_field('custom_tracking_event')){
        ?>
        <script>
            if (typeof fbq === 'function') {
                fbq('trackCustom', '<?php the_field('custom_tracking_event'); ?>');
            }            
        </script>
        <?php
    }
}


//Time Zone related function

function get_user_ip() {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function get_user_timezone() {
    $ip_address = get_user_ip();
    $cookie_name = 'user_timezone';


    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name];
    }

    $url = "http://ip-api.com/json/{$ip_address}?fields=status,message,timezone";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data['status'] === 'success') {
        setcookie($cookie_name, $data['timezone'], time() + 7*86400, '/', '', true, true);
        return $data['timezone'];
    } else {
        return false;
    }
}


function get_local_time($gmt_time) {
    $timeZoneIdentifier = get_user_timezone();
    if (!$timeZoneIdentifier) {
        return false; 
    }

    try {
        $gmtDateTime = new DateTime($gmt_time, new DateTimeZone(DAY_LIGHT_SAVINGS?'BST':'GMT'));
        $localDateTime = clone $gmtDateTime; 
        $localDateTime->setTimezone(new DateTimeZone($timeZoneIdentifier));

    
        $format = 'g:i a';

        return $localDateTime->format($format);
    } catch (Exception $e) {
        return false;
    }
}
// Time Zone related function end

function load_custom_translations(){
    
    global $folder_translations;
    if ($folder_translations) return $folder_translations;

    $text_translations = get_field('text_translations');

    foreach ($text_translations as $text_translation) {
        $country = strtolower($text_translation['country']);
        $folder_translations[$text_translation['acf_key']][$country] = remove_top_level_p_tags($text_translation['translated_value']);
    }
    return $folder_translations;
}
function remove_top_level_p_tags($content) {
  
    $content = trim($content);
    
    if (substr($content, 0, 3) == '<p>' && substr($content, -4) == '</p>') {
        $content = substr($content, 3);
        $content = substr($content, 0, -4);
    }
    return $content;
}

function custom_acf_load_value($value, $post_id, $field) {

    $repeater = TRANSLATION_ACF_KEY;
    $text_translations = get_post_meta($post_id, '_text_translations', true);
    if (!$text_translations) {
        return $value; 
    }
    if (is_admin()) return $value;
    if (!is_subcountry_folder()) return $value;


    $field_name = $field['name'] ?? '';
    $field_parent = $field['parent'] ?? '';
    $field_key = $field['key'] ?? '';
    $field_parent_repeater = $field['parent_repeater'] ?? '';
    
    if (!$field_name 
        || $field_key == $repeater
        || $field_parent == $repeater
        || $field_parent_repeater == $repeater
    ) return $value;

    $custom_translations = load_custom_translations();

    return $custom_translations[$field_name][SEO_LANG] ?? $value;

}

add_filter('acf/load_value', 'custom_acf_load_value', 10, 3);

// Get Coupon Details 

function get_coupon_details($coupon_id) {
    if (!class_exists('WC_Coupon')) {
        return false;
    }

    // Initialize the coupon object
    $coupon = new WC_Coupon($coupon_id);

 
    if (!$coupon->get_id()) {
        return false;
    }

    // Get coupon details
    $coupon_data = array(
        'id'                => $coupon->get_id(),
        'code'              => $coupon->get_code(),
        'description'       => $coupon->get_description(),
        'discount_type'     => $coupon->get_discount_type(),
        'amount'            => $coupon->get_amount(),
        'individual_use'    => $coupon->get_individual_use(),
        'product_ids'       => $coupon->get_product_ids(),
        'exclude_product_ids' => $coupon->get_excluded_product_ids(),
        'usage_limit'       => $coupon->get_usage_limit(),
        'usage_limit_per_user' => $coupon->get_usage_limit_per_user(),
        'usage_count'       => $coupon->get_usage_count(),
        'expiry_date'       => $coupon->get_date_expires(),
        'free_shipping'     => $coupon->get_free_shipping(),
        'minimum_amount'    => $coupon->get_minimum_amount(),
        'maximum_amount'    => $coupon->get_maximum_amount(),
    );

    return $coupon_data;
}



// Add the custom form to the ACF options page(not used currently)
// add_action('all_admin_notices', 'custom_coupon_form');
function custom_coupon_form() {
    if (isset($_GET['page']) && $_GET['page'] == 'coupon_page_settings') {
        ?>
        <div class="custom-expiry-form-wrapper">
            <h2>Update Expiry Date for Live Coupons</h2>
            <form id="custom-expiry-form" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                <label for="new_expiry_date">New Expiry Date:</label>
                <input type="date" id="new_expiry_date" name="new_expiry_date" required>
                <input type="hidden" name="custom_form_submission" value="1">
                <?php wp_nonce_field('custom_form_nonce', 'custom_form_nonce_field'); ?>
                <input type="hidden" name="action" value="update_expiry_dates">
                <input type="submit" class="button button-primary button-large" name="submit" value="Update Expiry Date">
            </form>
        </div>
        <?php
    }
}


// Handle the form submission
// add_action('admin_post_update_expiry_dates', 'handle_custom_form_submission');
function handle_custom_form_submission() {
    if (isset($_POST['custom_form_submission']) && $_POST['custom_form_submission'] == 1) {
        
        if (!isset($_POST['custom_form_nonce_field']) || !wp_verify_nonce($_POST['custom_form_nonce_field'], 'custom_form_nonce')) {
            return;
        }

        $new_expiry_date = sanitize_text_field($_POST['new_expiry_date']);
        
        if ($new_expiry_date) {
            $new_expiry_date = date('Y-m-d', strtotime($new_expiry_date));
            $coupons_section = get_field('coupon_page_coupons','option');
            $coupons = $coupons_section['coupons'];
        
            if ($coupons) {
                foreach ($coupons as $coupon) {
                    if ($coupon['is_live']) {
                        $coupon_code = $coupon['coupon_code'];

                        $coupon_ID = wc_get_coupon_id_by_code($coupon_code);
                        if ($coupon_ID && class_exists('WC_Coupon')) {
                            $coupon_object = new WC_Coupon($coupon_ID);
                            if ($coupon_object) {
                                update_post_meta($coupon_ID, 'date_expires', $new_expiry_date);
                            }
                        }
                    }
                }

                add_action('admin_notices', function() {
                    echo '<div class="notice notice-success is-dismissible"><p>Expiry dates updated successfully!</p></div>';
                });

                wp_redirect(add_query_arg('updated', 'true', wp_get_referer()));
                exit;
            }
        }
    }
}


// add_action('admin_notices', 'custom_form_success_message');
function custom_form_success_message() {
    if (isset($_GET['updated']) && $_GET['updated'] == 'true') {
        echo '<div class="notice notice-success is-dismissible"><p>Expiry dates updated successfully!</p></div>';
    }
}


add_filter( 'woocommerce_thankyou_order_received_text', 'ti_thank_you_title', 20, 2 );

function ti_thank_you_title( $thank_you_title, $order ) {
    $home_url = home_url(); // Get the home URL
    $img = '<span class="tefl-order-logo"><a href="' . $home_url . '">
    <img src="/wp-content/uploads/2023/06/TEFL-Logo_Institute.svg" alt="Logo">
    </a></span>';
    return $img . '<br/>' . $thank_you_title;
}


add_action('wp_ajax_get_product_price', 'get_product_price_ajax');
add_action('wp_ajax_nopriv_get_product_price', 'get_product_price_ajax');

function get_product_price_ajax() {
    if (isset($_POST['product_id'])) {
        $product_id = intval($_POST['product_id']); 
        $product_obj = wc_get_product($product_id);

        if ($product_obj) {
            $product_price_html = $product_obj->get_price_html();
            $full_price = $product_obj->get_price();
            $simple_regular_price = $product_obj->get_regular_price();
            $simple_sale_price = $product_obj->get_sale_price();
            $save_percentage = 0;
			$currency_symbol = get_woocommerce_currency_symbol();

            if (is_numeric($simple_regular_price) && is_numeric($simple_sale_price) && $simple_regular_price != 0) {
                $save_percentage = round((($simple_regular_price - $simple_sale_price) / $simple_regular_price) * 100);
            }

            wp_send_json_success(array(
                'price_html' => $product_price_html,
                'sale_price' => $currency_symbol.''.$full_price,
                'save_percentage' => $save_percentage
            ));
        } else {
            wp_send_json_error('Invalid product ID.');
        }
    } else {
        wp_send_json_error('Product ID not provided.');
    }

    wp_die(); 
}