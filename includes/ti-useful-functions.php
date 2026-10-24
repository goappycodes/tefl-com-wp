<?php

function astra_get_sidebar( $sidebar_id ) {
    if ( is_active_sidebar( $sidebar_id ) ) {
        
        ob_start();
        dynamic_sidebar( $sidebar_id );
        $html = ob_get_clean();
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
        echo $html;
    }
}

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

/**
 * Checks if an array is empty, including nested arrays.
 *
 * @param mixed $array The variable to check (should be an array).
 * @return bool Returns true if the array is empty or contains only empty values, otherwise false.
 */
function is_array_empty($array) {
    if (!is_array($array) || empty($array)) {
        return true; // Not an array or is an empty array
    }
    
    foreach ($array as $value) {
        if (is_array($value)) {
            // Recursively check nested arrays
            if (!is_array_empty($value)) {
                return false;
            }
        } else {
            // Check if non-array values are not empty
            if (!empty($value)) {
                return false;
            }
        }
    }
    // If all values are empty or recursively contain only empty arrays
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

add_action('wp_enqueue_scripts', 'enqueue_callback_scripts');

function enqueue_callback_scripts() {
    if (is_page_template('page-callback.php')) {
        wp_enqueue_script('jquery');
        
        wp_localize_script('jquery', 'callback_data', [
            'detected_timezone' => get_user_timezone(),
            'user_ip' => get_user_ip()
        ]);
    }
}

// Time Zone related function end

function load_custom_translations(){
    
    global $folder_translations;
    if ($folder_translations) return $folder_translations;

    $text_translations = get_field('text_translations') ?: [];

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

// Custom mail tag to fetch product price

add_filter( 'wpcf7_special_mail_tags', 'custom_product_price_mail_tag', 99, 3 );
function custom_product_price_mail_tag( $output, $name, $html ) {
    if ( $name === 'product_price' ) {
        $product_id  = isset($_POST['course-id']) ? $_POST['course-id'] : false;

        if ( ! empty( $product_id ) ) {
            $product = wc_get_product( $product_id );
            if ( $product ) {
                $regular_price = $product->get_regular_price();
                $sale_price    = $product->get_sale_price();

                ob_start();
                echo '<span class="price-wrapper">';
                if ( ! empty( $regular_price ) ) {
                    echo '<del>Was: ' . geo_price( $regular_price ) . '</del> ';
                }

                if ( ! empty( $sale_price ) ) {
                    echo '<ins>Now: ' . geo_price( $sale_price ) . '</ins>';
                }
                echo '</span>';
                $output = ob_get_clean();
            }
        }
    }

    return $output;
}

// Custom mail tag for email banner image

add_filter( 'wpcf7_special_mail_tags', 'custom_banner_image_url_mail_tag', 99, 3 );

function custom_banner_image_url_mail_tag( $output, $name, $html ) {
    if ( $name === 'banner_image_url' ) {
        $media_id = isset($_POST['banner-image-id']) ? $_POST['banner-image-id'] : false;
        if ( ! empty( $media_id ) ) {
            $media_url = wp_get_attachment_url( $media_id );
            if ( ! empty( $media_url ) ) {
                $output = esc_url( $media_url );
            }
        }
    }

    return $output;
}

// Custom mail tag for phone based on geo location

add_filter( 'wpcf7_special_mail_tags', 'custom_geo_phone_mail_tag', 99, 3 );

function custom_geo_phone_mail_tag( $output, $name, $html ) {
    if ( $name === 'geo-phone' ) {
        $country_code = get_user_geo_country_code();
        $site_call_details = get_call_details($country_code);
        if(!empty($site_call_details)){
            $output = $site_call_details;
        }
    }

    return $output;
}

// Custom mail tag for course guide link

add_filter( 'wpcf7_special_mail_tags', 'custom_course_guide_link_mail_tag', 99, 3 );

function custom_course_guide_link_mail_tag( $output, $name, $html ) {
    if ( $name === 'guide-link' ) {
        $guide_link = isset($_POST['course-guide-link']) ? $_POST['course-guide-link'] : '';

        if ( ! empty( $guide_link ) ) {
            $site_url = home_url(); 
            if ( strpos( $guide_link, $site_url ) === false ) {
                $guide_link = $site_url . '/' . ltrim( $guide_link, '/' );
            }
            
            $output = $guide_link;
        }
    }

    return $output;
}


// Function to return number of specific product sold in x days or since a specific date

function get_orders_with_product($product_id, $date_condition) {
    global $wpdb;

    if (empty($product_id) || !is_numeric($product_id)) {
        return array('count' => 0, 'order_ids' => array(), 'message' => 'Invalid product ID');
    }

    $query = "
        SELECT DISTINCT p.ID
        FROM {$wpdb->prefix}posts p
        INNER JOIN {$wpdb->prefix}woocommerce_order_items oi ON p.ID = oi.order_id
        INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta oim ON oi.order_item_id = oim.order_item_id
        LEFT JOIN {$wpdb->prefix}postmeta pm ON p.ID = pm.post_id AND pm.meta_key = '_parent_order_id'
        WHERE p.post_type = 'shop_order'
        AND p.post_status IN ('wc-completed')
        AND $date_condition
        AND oim.meta_key = '_product_id'
        AND oim.meta_value = %d
        AND pm.meta_id IS NULL
    ";

    $order_ids = $wpdb->get_col($wpdb->prepare($query, $product_id));

    // Return the result with count and order IDs
    return array('count' => count($order_ids), 'order_ids' => $order_ids);
}

function count_orders_with_product($product_id, $days_ago = 7) {
    global $wpdb;

    if (empty($product_id) || !is_numeric($product_id)) {
        return array('count' => 0, 'order_ids' => array(), 'message' => 'Invalid product ID');
    }

    $current_page_url = $_SERVER['REQUEST_URI'];
    $cookie_name = 'orders_count_' . $product_id . '_' . $days_ago;

    if (isset($_COOKIE[$cookie_name])) {
        $cached_data = json_decode(stripslashes($_COOKIE[$cookie_name]), true);
        if ($cached_data) {
            return $cached_data;
        }
    }

    $date_days_ago = date('Y-m-d H:i:s', strtotime("-$days_ago days"));
    $date_condition = "p.post_date >= '$date_days_ago'";

    $result = get_orders_with_product($product_id, $date_condition);

    setcookie($cookie_name, json_encode($result), time() + 12 * 3600, $current_page_url, 'tefl.ie');

    return $result;
}

function count_orders_with_product_since_date($product_id, $start_date) {
    if (empty($start_date) || !strtotime($start_date)) {
        return array('count' => 0, 'order_ids' => array(), 'message' => 'Invalid start date');
    }


    $formatted_start_date = date('Y-m-d H:i:s', strtotime($start_date));
    $date_condition = "p.post_date >= '$formatted_start_date'";

    return get_orders_with_product($product_id, $date_condition);
}


add_shortcode ('sale_counter_popup', 'sale_counter_popup_fn');
function sale_counter_popup_fn(){
    $number_of_sale_courses_offered = get_field('number_of_sale_courses_offered',822);
    $number_of_sale_courses_sold = count_orders_with_product_since_date(1103,'2024-10-21');
    $number_of_sale_courses_sold_count = $number_of_sale_courses_sold['count'] ?? 0;
    $number_of_sale_courses_remaining = (int)$number_of_sale_courses_offered - (int)$number_of_sale_courses_sold_count;
    if($number_of_sale_courses_remaining>0):
    ob_start();
    ?>
    <style>
        .boxzilla.boxzilla-30-hour-sale-campaign {
            width: auto;
            background:transparent;
        }
        .sale-popup-container>br {
            display: none;
        }
        .offer-sale-counter-popup {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-70%);
            background: #DA1A35;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        .offer-sale-counter-popup>span {
            display: block;
            text-align: center;
        }

        .offer-sale-counter-popup .courses-remaining {
            font-size: 30px;
        }
        @media screen and (max-width:768px) {
            .offer-sale-counter-popup .courses-remaining {
                font-size: 25px;
            }
            .boxzilla.boxzilla-30-hour-sale-campaign {
                width: 85%;
                overflow:inherit;
            }
        }
    </style>
    <div class="offer-sale-counter-popup">
        <span class="courses-remaining">
            <?php echo $number_of_sale_courses_remaining?>
        </span>
        <span>courses left</span>
    </div>
    <script>
        jQuery(document).ready(function($) {
            
        });
    </script>
    <?php
    return ob_get_clean();
    endif;
}


add_shortcode ('sale_price_popup', 'sale_price_popup_fn');
function sale_price_popup_fn(){
    ob_start();
    ?>
    <style>
        .ajax-loaded-sale-price {
            display:none;
            position: absolute;
            top: 150px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 30px;
            color: #fff;
            font-weight: 800;
            line-height: 1;
            text-transform: uppercase;
        }
        @media screen and (max-width:768px) {
            .ajax-loaded-sale-price {
                top: 100px;
                font-size: 25px;
            }
        }
    </style>
    <div class="ajax-loaded-sale-price">
        <span class="price"></span>
        <span> Course</span>
    </div>
    <script>
        jQuery(document).ready(function($) {
            let productId =1103;
            $.ajax({
                url: pt_obj.pt_ajax,
                type: 'POST',
                data: {
                    action: 'get_product_price', 
                    product_id: productId
                },
                success: function(response) {
                    if (response.success) {
                        var salePrice = response.data.sale_price;
                        $('.ajax-loaded-sale-price').fadeIn();
                        $('.ajax-loaded-sale-price .price').html(salePrice);
                    } else {
                        console.log('Error: ' + response.data);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX error:', error);
                }
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

// Truncate long strings

function truncate_string($string, $wordLimit) {
    $words = explode(' ', $string);
    if (count($words) > $wordLimit) {
        $string = implode(' ', array_slice($words, 0, $wordLimit)) . '...';
    }
    return $string;
}

//Reset password email text edit

add_filter( 'retrieve_password_message', 'custom_reset_password_email', 10, 4 );
add_filter( 'wp_mail_content_type', 'set_html_content_type' );

function custom_reset_password_email( $message, $key, $user_login, $user_data ) {
    $site_name = get_bloginfo( 'name' );
    $reset_link = network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login' );
    $ip_address = $_SERVER['REMOTE_ADDR'];

    ob_start();
    ?>
    <p>Someone has requested a password reset for the following account:</p>
    <p>
        <strong>Site Name:</strong> <?php echo $site_name; ?><br>
        <strong>Username:</strong> <?php echo $user_login; ?>
    </p>
    <p>If this was a mistake, ignore this email and nothing will happen.</p>
    <p>To reset your password, visit the following address:<br>
        <strong>Note: This will also reset your Moodle account password.</strong><br>
        <a href="<?php echo $reset_link; ?>"><?php echo $reset_link; ?></a>
    </p>
    
    <p>This password reset request originated from the IP address <?php echo $ip_address; ?>.</p>
    <?php
    $custom_message = ob_get_clean();

    return $custom_message;
}

function set_html_content_type() {
    return 'text/html';
}


/**
 * Function to check if global timer has expired
 *
 * @return bool Returns true if the timer has expired
 */
function is_global_timer_expired() {
    $expiry_date = get_field('timer_expiry', 'option');
    
    if (!$expiry_date || strtotime($expiry_date) === false) {
        return false; 
    }

    $expiry_date_unix = strtotime($expiry_date);
    return $expiry_date_unix < time();
}

add_filter('woocommerce_dropdown_variation_attribute_options_args', function($args) {
    global $product;
    
    if (is_object($product)) {
        $target_product_ids = [76824];
        
        if (in_array($product->get_id(), $target_product_ids)) {
            $args['show_option_none'] = 'Choose Delivery Method';
        }
    }
    
    return $args;
}, 10, 1);


remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);


// Add export button to products admin page
add_action('manage_posts_extra_tablenav', 'tefl_add_export_button');
function tefl_add_export_button($which) {
    global $typenow;
    
    if ($typenow == 'product' && $which == 'top') {
        ?>
        <div class="alignleft actions">
            <button type="button" id="tefl-export-products" class="button button-primary">
                Export Products
            </button>
            <div id="tefl-export-modal" style="display:none;">
                <div class="tefl-modal-content">
                    <h3>Export Products to CSV</h3>
                    <p>This will export all products with their permalinks and associated courses/internships permalinks.</p>
                    <p>
                        <button type="button" id="tefl-start-export" class="button button-primary">
                            Export CSV
                        </button>
                        <button type="button" id="tefl-cancel-export" class="button">
                            Cancel
                        </button>
                    </p>
                </div>
            </div>
        </div>
        
        <style>
        #tefl-export-products{
            margin:.5rem auto;
        }
        #tefl-export-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
        }
        .tefl-modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 5px;
            min-width: 300px;
        }
        </style>
        
        <script>
        jQuery(document).ready(function($) {
            $('#tefl-export-products').click(function() {
                $('#tefl-export-modal').show();
            });
            
            $('#tefl-cancel-export').click(function() {
                $('#tefl-export-modal').hide();
            });
            
            $('#tefl-start-export').click(function() {
                $(this).text('Exporting...').prop('disabled', true);
                
                window.location.href = ajaxurl + '?action=tefl_export_products&nonce=' + '<?php echo wp_create_nonce("tefl_export_nonce"); ?>';
                
                setTimeout(function() {
                    $('#tefl-export-modal').hide();
                    $('#tefl-start-export').text('Export CSV').prop('disabled', false);
                }, 1000);
            });
        });
        </script>
        <?php
    }
}

add_action('wp_ajax_tefl_export_products', 'tefl_handle_export_request');
function tefl_handle_export_request() {
    if (!wp_verify_nonce($_GET['nonce'], 'tefl_export_nonce')) {
        wp_die('Security check failed');
    }
    
    if (!current_user_can('manage_woocommerce')) {
        wp_die('Insufficient permissions');
    }
    
    $export_data = tefl_get_export_data();
    tefl_export_csv_direct($export_data);
    exit;
}

function tefl_get_export_data() {
    $products = get_posts(array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    ));
    
    $export_data = array();
    
    foreach ($products as $product) {
        $product_data = array(
            'id' => $product->ID,
            'title' => $product->post_title,
            'permalink' => get_permalink($product->ID),
            'courses' => array(),
            'internships' => array()
        );
        
        $courses = get_posts(array(
            'post_type' => 'course', 
            'meta_query' => array(
                array(
                    'key' => 'course_product', 
                    'value' => $product->ID,
                    'compare' => '='
                )
            ),
            'numberposts' => -1
        ));
        
        foreach ($courses as $course) {
            $course_permalink = get_permalink($course->ID);
            $product_data['courses'][] = $course_permalink;
        }
        
        $internships = get_posts(array(
            'post_type' => 'internship', 
            'meta_query' => array(
                array(
                    'key' => 'internship_product',
                    'value' => $product->ID,
                    'compare' => '='
                )
            ),
            'numberposts' => -1
        ));
        
        foreach ($internships as $internship) {
            $internship_permalink = get_permalink($internship->ID);
            $product_data['internships'][] = $internship_permalink;
        }
        
        $export_data[] = $product_data;
    }
    
    return $export_data;
}

// Export as CSV - direct download
function tefl_export_csv_direct($data) {
    $filename = 'ti-products-export-' . date('Y-m-d-H-i-s') . '.csv';
    
    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    
    // Open output stream
    $output = fopen('php://output', 'w');
    
    // Add CSV headers
    fputcsv($output, array(
        'Product ID',
        'Product Title',
        'Permalink',
        'Courses',
        'Internships'
    ));
    
    // Add data rows
    foreach ($data as $row) {
        fputcsv($output, array(
            $row['id'],
            $row['title'],
            $row['permalink'],
            implode(', ', $row['courses']),
            implode(', ', $row['internships'])
        ));
    }
    
    fclose($output);
}

/**
 * Add parent order ID as meta data to WooCommerce deposit child orders
 */


function tefl_add_parent_id_meta($new_order, $original_order) {
    // Check if parent order ID meta already exists
    $existing_parent_id = $new_order->get_meta('_parent_order_id');
    
    if (empty($existing_parent_id)) {
        $new_order->update_meta_data('_parent_order_id', $original_order->get_id());
        
        $new_order->add_order_note(
            sprintf(__('Linked to parent order #%d', 'tefl'), $original_order->get_id())
        );
    }
}

add_action('woocommerce_deposits_after_scheduled_order_props_set', 'tefl_add_parent_id_meta', 10, 2);


add_shortcode('tefl_institute_trial_popup', 'tefl_institute_trial_popup_fn');

function tefl_institute_trial_popup_fn($attr) {
    $atts = shortcode_atts(array(
        'expiry' => '', 
        'button_url' => '#',
        'button_text' => 'Access Free Trial',
    ), $attr);
    
    // Get expiry from attribute or ACF option
    if (!empty($atts['expiry'])) {
        $timer_expiry = $atts['expiry'];
    } else {
        $timer_expiry = get_field('timer_expiry', 'option');
    }
    
    // Calculate days remaining
    $days_remaining = '';
    if (!empty($timer_expiry)) {
        $now_ts = strtotime("now");
        $timer_exp_ts = strtotime($timer_expiry);
        if ($timer_exp_ts !== false && $timer_exp_ts > $now_ts) {
            $diff = $timer_exp_ts - $now_ts;
            $days_remaining = ceil($diff / (60 * 60 * 24));
        } else {
            $days_remaining = '0';
        }
    }
    
    $has_expired = (!empty($timer_expiry) && strtotime($timer_expiry) <= strtotime("now"));
    $unique_id = uniqid('ti-popup-');
    
    ob_start();
    ?>
    <style>

        div#boxzilla-101096 {
            width: auto !important;
            border-radius: 30px;
            padding: 010px;
            border: 5px solid #1a4a4a;
        }

        .ti-trial-popup-wrapper {
            background: #1a4a4a;
            border-radius: 24px;
            padding: 4px;
            margin: 0 auto;
        }
        
        .ti-trial-popup {
            display: flex;
            align-items: stretch;
            background: #f8f9fa;
            border-radius: 20px;
            overflow: hidden;
            border: 3px solid #d1e0e0;
        }
        
        .ti-trial-popup__content {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        
        .ti-trial-popup__title {
            font-size: 28px;
            font-weight: 700;
            color: #134559;
            margin: 0 0 12px 0;
            line-height: 1.25;
        }
        
        .ti-trial-popup__subtitle {
            font-size: 18px;
            color: #4a5e6a;
            margin: 0 0 24px 0;
            line-height: 1.5;
            font-weight: 500;
        }
        
        .ti-trial-popup__button {
            display: inline-block;
            background: #1a4a4a;
            color: #fff !important;
            font-size: 22px;
            font-weight: 700;
            padding: 14px 44px;
            border-radius: 50px;
            text-decoration: none !important;
            margin-bottom: 20px;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 15px rgba(26, 74, 74, 0.3);
        }
        
        .ti-trial-popup__button:hover {
            background: #0d3535;
            color: #fff !important;
            transform: translateY(-2px);
        }
        
        .ti-trial-popup__expires {
            font-size: 18px;
            font-weight: 700;
            color: #134559;
            margin-bottom: 10px;
        }
        
        .ti-trial-popup__image-wrapper {
            flex: 0 0 380px;
            padding: 20px 20px 20px 0;
            display: flex;
            align-items: center;
        }
        
        .ti-trial-popup__image {
            width: 100%;
            height: 100%;
            min-height: 340px;
            background-size: cover;
            background-position: center;
            border-radius: 16px;
        }
        
        /* Timer styling for TI popup */
        .ti-trial-popup .ti-countdown-timer {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        
        .ti-trial-popup .ti-countdown-timer > div {
            text-align: center;
        }
        
        .ti-trial-popup .ti-clock-inner {
            display: flex;
            background: #d9e5e5;
            border-radius: 10px;
            padding: 8px;
        }
        
        .ti-trial-popup .ti-digit {
            /* background: #eef3f3; */
            border-radius: 6px;
            width: 30px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: 700;
            color: #1a4a4a;
        }
        
        .ti-trial-popup .ti-digit-label {
            display: block;
            font-size: 14px;
            margin-top: 8px;
            font-weight: 500;
            color: #1a4a4a;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .ti-trial-popup {
                flex-direction: column;
            }
            
            .ti-trial-popup__image-wrapper {
                flex: none;
                order: -1;
                padding: 15px 15px 0 15px;
            }
            
            .ti-trial-popup__image {
                min-height: 200px;
                border-radius: 12px;
            }
            
            .ti-trial-popup__content {
                padding: 24px 20px 30px;
            }
            
            .ti-trial-popup__title {
                font-size: 22px;
            }
            
            .ti-trial-popup__subtitle {
                font-size: 15px;
            }
            
            .ti-trial-popup__button {
                font-size: 18px;
                padding: 12px 32px;
            }
            
            .ti-trial-popup .ti-countdown-timer {
                gap: 6px;
            }
            
            .ti-trial-popup .ti-clock-inner {
                padding: 6px 4px;
                gap: 2px;
            }
            
            .ti-trial-popup .ti-digit {
                width: 28px;
                height: 42px;
                font-size: 28px;
            }
            
            .ti-trial-popup .ti-digit-label {
                font-size: 12px;
            }
        }
    </style>
    
    <div class="ti-trial-popup-wrapper">
        <div class="ti-trial-popup" id="<?php echo esc_attr($unique_id); ?>">
            <div class="ti-trial-popup__content">
                <h2 class="ti-trial-popup__title">Try TEFL risk-free –<br>grab your 3-day access pass today!</h2>
                <p class="ti-trial-popup__subtitle">Access real Level 5 modules, videos and<br>quizzes - see if TEFL is for you.</p>
                <a href="<?php echo esc_url($atts['button_url']); ?>" class="ti-trial-popup__button"><?php echo esc_html($atts['button_text']); ?></a>
                <div class="ti-trial-popup__expires">Expires in <?php echo esc_html($days_remaining); ?> Days:</div>
                
                <!-- Timer -->
                <input type="hidden" class="ti-timer-expiry" value="<?php echo esc_attr($timer_expiry); ?>">
                <div class="ti-countdown-timer">
                    <div class="ti-clock-days">
                        <div class="ti-clock-inner">
                            <div class="ti-digit ti-ten-day"><?php echo $has_expired ? '0' : ''; ?></div>
                            <div class="ti-digit ti-day"><?php echo $has_expired ? '0' : ''; ?></div>
                        </div>
                        <span class="ti-digit-label">Days</span>
                    </div>
                    <div class="ti-clock-hours">
                        <div class="ti-clock-inner">
                            <div class="ti-digit ti-ten-hour"><?php echo $has_expired ? '0' : ''; ?></div>
                            <div class="ti-digit ti-hour"><?php echo $has_expired ? '0' : ''; ?></div>
                        </div>
                        <span class="ti-digit-label">Hours</span>
                    </div>
                    <div class="ti-clock-mins">
                        <div class="ti-clock-inner">
                            <div class="ti-digit ti-ten-min"><?php echo $has_expired ? '0' : ''; ?></div>
                            <div class="ti-digit ti-min"><?php echo $has_expired ? '0' : ''; ?></div>
                        </div>
                        <span class="ti-digit-label">Minutes</span>
                    </div>
                    <div class="ti-clock-secs">
                        <div class="ti-clock-inner">
                            <div class="ti-digit ti-ten-sec"><?php echo $has_expired ? '0' : ''; ?></div>
                            <div class="ti-digit ti-sec"><?php echo $has_expired ? '0' : ''; ?></div>
                        </div>
                        <span class="ti-digit-label">Seconds</span>
                    </div>
                </div>
                <!-- /Timer -->
                
            </div>
            <div class="ti-trial-popup__image-wrapper">
                <div class="ti-trial-popup__image" style="background-image: url('/wp-content/uploads/2026/02/tefl-institute.jpg');"></div>
            </div>
        </div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        var $container = $('#<?php echo esc_js($unique_id); ?>');
        if (!$container.length) return;
        
        var $expiryInput = $container.find('.ti-timer-expiry');
        if (!$expiryInput.length) return;
        
        var expiryDate = new Date($expiryInput.val()).getTime();
        
        function padZero(num) {
            return num.toString().padStart(2, '0');
        }
        
        function updateTimer() {
            var now = new Date().getTime();
            var distance = expiryDate - now;
            
            if (distance < 0) {
                $container.find('.ti-ten-day').text('0');
                $container.find('.ti-day').text('0');
                $container.find('.ti-ten-hour').text('0');
                $container.find('.ti-hour').text('0');
                $container.find('.ti-ten-min').text('0');
                $container.find('.ti-min').text('0');
                $container.find('.ti-ten-sec').text('0');
                $container.find('.ti-sec').text('0');
                return;
            }
            
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            var daysStr = padZero(days);
            var hoursStr = padZero(hours);
            var minsStr = padZero(minutes);
            var secsStr = padZero(seconds);
            
            $container.find('.ti-ten-day').text(daysStr[0]);
            $container.find('.ti-day').text(daysStr[1]);
            $container.find('.ti-ten-hour').text(hoursStr[0]);
            $container.find('.ti-hour').text(hoursStr[1]);
            $container.find('.ti-ten-min').text(minsStr[0]);
            $container.find('.ti-min').text(minsStr[1]);
            $container.find('.ti-ten-sec').text(secsStr[0]);
            $container.find('.ti-sec').text(secsStr[1]);
        }
        
        // Initial update
        updateTimer();
        
        // Update every second
        setInterval(updateTimer, 1000);
    });
    </script>
    
    <?php
    return ob_get_clean();
}

// Ajax live blog search

add_filter('posts_search_orderby', function($orderby, $query) {
    global $wpdb;
    $search_term = $query->get('s');

    if (!empty($search_term) && (defined('DOING_AJAX') && DOING_AJAX)) {
        $orderby = "
            (CASE 
                WHEN {$wpdb->posts}.post_title LIKE '" . esc_sql($search_term) . "%' THEN 1 
                WHEN {$wpdb->posts}.post_title LIKE '%" . esc_sql($search_term) . "%' THEN 2 
                ELSE 3 
            END), {$wpdb->posts}.post_date DESC";
    }
    return $orderby;
}, 10, 2);

add_action('wp_ajax_blog_live_search', 'blog_live_search_handler');
add_action('wp_ajax_nopriv_blog_live_search', 'blog_live_search_handler');

function blog_live_search_handler() {
    $query  = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $limit  = 3;

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $limit,
        'offset'         => $offset,
        'orderby'        => 'date',
        'order'          => 'DESC',
        's'              => $query,
        'suppress_filters' => true 
    );

    // Ian 2026-08-18: keep the blog grid/live-search posts-only. The global
    // pre_get_posts hook searchfilter() adds pages/courses to front-end searches;
    // shield THIS query from it (global site search is unchanged).
    remove_filter( "pre_get_posts", "searchfilter" );
    $search_query = new WP_Query($args);
    add_filter( "pre_get_posts", "searchfilter" );

    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
            ?>
            <div class="ast-col-md-4" style="margin-bottom: 30px;">
                <div class="blog-item" style="background: url('<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>')">
                    <a href="<?php the_permalink(); ?>" class="clickbox"></a>
                    <div class="bolg-content">
                        <h3><?php the_title(); ?></h3>
                        <a class="blog-link" href="<?php the_permalink(); ?>">READ MORE <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <?php
        }
        
        if ($search_query->found_posts > ($offset + $limit)) {
            echo '<div id="has-more-posts" style="display:none;"></div>';
        }
    } else {
        if ($offset == 0) {
            echo '<div class="ast-col-md-12"><p style="text-align:center;">No results found.</p></div>';
        }
    }

    wp_reset_postdata();
    if (defined('DOING_AJAX') && DOING_AJAX) { die(); }
}

// Geo replace currency symbol in content

function geo_replace_currency($content) {
    $currency_pattern = '[€$£¥₹₽₩¢₪₦₨₱฿₫₡₲₴₸₵₺₼₾₿]';
    
    if (!preg_match("/$currency_pattern/", $content)) {
        return $content;
    }

    $geo = WC_Geolocation::geolocate_ip();
    $country = $geo['country'] ?? '';

    $locale = WC()->countries->get_country_locale();

    if (isset($locale[$country]['currency_code'])) {
        $currency_code = $locale[$country]['currency_code'];
    } else {
        $currency_code = get_woocommerce_currency();
    }
    
    $symbol = get_woocommerce_currency_symbol($currency_code);

    return preg_replace_callback(
        "/(<[^>]+>)|($currency_pattern+\s*([\d,]+(?:\.\d{2})?))/u",
        function($match) use ($symbol) {
            if (!empty($match[1])) {
                return $match[1];
            }
            return $symbol . $match[3];
        },
        $content
    );
}

function geo_replace_currency_default($content) {
    $currency_pattern = '[€$£¥₹₽₩¢₪₦₨₱฿₫₡₲₴₸₵₺₼₾₿]';
    if (!preg_match("/$currency_pattern/", $content)) {
        return $content;
    }

    return preg_replace_callback(
        "/(<[^>]+>)|($currency_pattern)(\s*)([\d,]+(?:\.\d{2})?)/u",
        function ($match) {
            if (!empty($match[1])) {
                return $match[1];
            }
            return '<span class="geo-currency" data-amount="' . esc_attr($match[4]) . '">'
                 . $match[2] . $match[3] . $match[4]
                 . '</span>';
        },
        $content
    );
}

add_action('wp_head', 'add_pagesense_homepage_only');
function add_pagesense_homepage_only() {
    if (is_front_page()) {
?>
<script src="https://cdn-eu.pagesense.io/js/stjrymja/b77dafd5bf3545f3833201e886e6ca12.js"></script>
<?php
    }
}

/**
 * Renders the post meta stamp: author, published date, optional updated date, reading time.
 */

if (!function_exists('render_post_meta_stamp')) {
    function render_post_meta_stamp($args = []) {
        global $post;
        if (!$post) {
            return '';
        }

        $defaults = [
            'show_author'       => false,
            'show_published'    => true,
            'show_updated'      => true,
            'show_reading_time' => true,
            'date_format'       => 'jS F Y',
            'updated_buffer'    => 86400,
            'wrapper_class'     => 'post-meta-stamp',
            'separator'         => ' · ',
            'fallback_author'   => 'Tara Bourke, TEFL Advisor' ,
        ];
        $args = array_merge($defaults, $args);

        $published_ts = get_the_time('U', $post);
        $modified_ts  = get_the_modified_time('U', $post);
        $is_updated   = ($modified_ts > $published_ts + $args['updated_buffer']);

        $author_name = trim(get_the_author());
        if ($author_name === '' || _is_junk_author_name($author_name)) {
            $author_name = $args['fallback_author'];
        }

        $parts = [];

        if ($args['show_author']) {
            $parts[] = '<span class="blog-author">By ' . esc_html($author_name) . '</span>';
        }

        if ($args['show_published']) {
            $date_html = '<span class="blog-date">Published: ' . esc_html(date($args['date_format'], $published_ts));
            if ($args['show_updated'] && $is_updated) {
                $date_html .= ' <span class="blog-updated">(Updated: '
                            . esc_html(date($args['date_format'], $modified_ts))
                            . ')</span>';
            }
            $date_html .= '</span>';
            $parts[] = $date_html;
        }

        if ($args['show_reading_time'] && function_exists('get_reading_time')) {
            $parts[] = '<span class="blog-reading-time">'
                     . intval(get_reading_time($post->post_content))
                     . ' min read</span>';
        }

        return '<div class="' . esc_attr($args['wrapper_class']) . '">'
             . implode(esc_html($args['separator']), $parts)
             . '</div>';
    }
}

/**
 * Detect junk / spam author names (e.g., 'qtxWwRqcuT').
 */
if (!function_exists('_is_junk_author_name')) {
    function _is_junk_author_name($name) {
        if (strlen($name) < 8 || strpos($name, ' ') !== false) {
            return false;
        }

        $vowel_count = preg_match_all('/[aeiouAEIOU]/', $name);
        $length = strlen($name);
        return ($vowel_count / $length) < 0.2;
    }
}

if (!function_exists('the_post_meta_stamp')) {
    function the_post_meta_stamp($args = []) {
        echo render_post_meta_stamp($args);
    }
}

/**
 * return Reading time for a post 
 */
if (!function_exists('get_reading_time')) {
    function get_reading_time($content, $words_per_minute = 225, $post_id = null) {
        $all_content = $content;
        
        // If content is empty or too short, try ACF fields
        if (empty(trim(wp_strip_all_tags($content)))) {
            if (!$post_id) {
                $post_id = get_the_ID();
            }
            
            $blog_main_content = get_field('blog_main_content', $post_id);
            if (!empty($blog_main_content['blog_content'])) {
                foreach ($blog_main_content['blog_content'] as $section) {
                    $all_content .= ' ' . ($section['section_title'] ?? '');
                    $all_content .= ' ' . ($section['section_content'] ?? '');
                }
            }
        }
        
        $text = wp_strip_all_tags(strip_shortcodes($all_content));
        $word_count = str_word_count($text);
        $minutes = ceil($word_count / $words_per_minute);
        
        return max(1, $minutes);
    }
}

/**
 * Update post_modified date when ACF fields are saved on blog posts.
 */
add_action('acf/save_post', function($post_id) {
    if (get_post_type($post_id) !== 'post') {
        return;
    }
    wp_update_post([
        'ID'                => $post_id,
        'post_modified'     => current_time('mysql'),
        'post_modified_gmt' => current_time('mysql', 1),
    ]);
}, 20);


add_filter('wpcf7_autop_or_not', function ($enabled) {
    $form = WPCF7_ContactForm::get_current();
    if ($form && $form->title() === 'Partner Apply Form') {
        return false;
    }
    return $enabled;
});

//Exposes the three Yoast SEO post-meta fields to the WordPress REST API so the automated draft workflow can write them. 
// Read/write restricted to users who can edit the post in question.

add_action( 'init', function () {
	$post_types = [ 'post' ];
 
	$fields = [
		'_yoast_wpseo_focuskw'  => 'sanitize_text_field',
		'_yoast_wpseo_title'    => 'sanitize_text_field',
		'_yoast_wpseo_metadesc' => 'sanitize_textarea_field',
	];
 
	foreach ( $post_types as $post_type ) {
		foreach ( $fields as $key => $sanitize ) {
 
			register_post_meta( $post_type, $key, [
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'sanitize_callback' => $sanitize,
 
				
				'auth_callback'     => function ( $allowed, $meta_key, $post_id, $user_id ) {
					return user_can( $user_id, 'edit_post', $post_id );
				},
			] );
		}
	}
 
}, 20 ); 
