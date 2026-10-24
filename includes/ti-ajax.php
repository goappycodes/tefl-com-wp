<?php

/* Job Search Function */
add_action( 'wp_ajax_ti_job_search', 'ti_job_search_fn' );
add_action( 'wp_ajax_nopriv_ti_job_search', 'ti_job_search_fn' );

function ti_job_search_fn(){
	
	$searchVal = $_POST['searchVal'];
    $search_arr = explode(" ",$searchVal);

    $gocambio_jobs = ti_jobs_feed();
    $found_arr = [];

    foreach($gocambio_jobs as $gj) {
    	foreach($gj as $key => $value){
    		if(($key == 'title') || ($key == 'job_location') || ($key == 'company_name')){
    			foreach($search_arr as $skey){
	                if(stripos($value, $skey) !== false){
	                    $job_id = $gj->id;
	                    array_push($found_arr, $job_id);
	                    break;
	                }
	            }
    		}
    	}
    }
  
    $html = '';
    $count=1;
    if (!empty($found_arr)) {
    	$found_arr = array_unique($found_arr);
    	foreach($found_arr as $fa){
    		foreach($gocambio_jobs as $gj) {
    			if($gj->id == $fa){
    				$job_title = $gj->title;
					$job_title = wp_trim_words( $job_title, 7, '...' );
					$job_link = $gj->link;
					$job_logo = $gj->company_logo;
					$job_type = $gj->type;
					$job_type = $job_type[0]->name;
					$job_comp_name = $gj->company_name;
					$job_location = $gj->job_location;
					$job_location = wp_trim_words( $job_location, 4, '...' );
					$rate_min = $gj->rate_min;
					$rate_min = preg_replace('/[^0-9]/', '', $rate_min);
					$rate_max = $gj->rate_max;
					$rate_max = preg_replace('/[^0-9]/', '', $rate_max);
					$job_content = $gj->content;
					$job_currency_code = $gj->job_currency_code;

					if(empty($job_logo)){
						$job_logo = 'https://teflinstitute.com/wp-content/uploads/2021/02/wordpress-581849_640.jpg';
					}

					if(!empty($rate_min) && !empty($rate_max)){
						$rate = $rate_min.' - '.$rate_max.' '.$job_currency_code.'/hour';
					}elseif(!empty($rate_min) && empty($rate_max)){
						$rate = $rate_min.' '.$job_currency_code.'/hour';
					}elseif(empty($rate_min) && !empty($rate_max)){
						$rate = $rate_max.' '.$job_currency_code.'/hour';
					}

					$html .= '<div class="ast-col-lg-3 ast-col-md-4 ast-col-sm-12 ast-col-xs-12 job-col job-'.$count.' job-'.$fa.'">';
					$html .= '<div class="job inner-div">';
					$html .= '<div class="job__img" style="background-image: url('.$job_logo.')"></div>';
					if(!empty($job_type) || !empty($job_title) || !empty($job_comp_name) || !empty($job_location)):
						$html .= '<div class="job__info">';
						if(!empty($job_type)):
							$html .= '<p class="job-type"><span>'.$job_type.'</span></p>';
						endif;
						if(!empty($job_title)):
							$html .= '<h6 class="job-title">'.$job_title.'</h6>';
						endif;
						if(!empty($job_comp_name)):
							$html .= '<p class="comp-name"><i class="fa fa-briefcase"></i> '.$job_comp_name.'</p>';
						endif;
						if(!empty($job_location)):
							$html .= '<p class="job-location"><i class="fa fa-map-marker"></i> '.$job_location.'</p>';
						endif;
						if(!empty($rate)):
							$html .= '<p class="job-rate"><i class="fa fa-money"></i> '.$rate.'</p>';
						endif;
						$html .= '</div>';
					endif;
					if(!empty($job_link)):
						$html .= '<div class="job__cta">';
						$html .= '<a class="btn" target="_blank" href="'.$job_link.'">learn more <i class="fa fa-angle-right"></i></a>';
						$html .= '</div>';
					endif;
					$html .= '</div>';
					$html .= '</div>';
    			}
    		}
    		$count++;
    	}
    }

    if (!empty($html)) {
        echo json_encode(array("status" => true , "content" => $html));        
	} else {
        echo json_encode(array("status" => false , "content" => "No url found"));
    }

    wp_die();
}
/* /Job Search Function */

add_action( 'wp_ajax_ti_geo_targetted_banner', 'ti_geo_targetted_banner_fn' );
add_action( 'wp_ajax_nopriv_ti_geo_targetted_banner', 'ti_geo_targetted_banner_fn' );

function ti_geo_targetted_banner_fn(){

	$country = array_key_exists('country_code', $_COOKIE) ? $_COOKIE['country_code'] : get_user_geo_country_code();
	$geo_banner_content = get_geo_banner_content($country);

	if (!empty($geo_banner_content)) {
        echo json_encode(array("status" => true , "content" => $geo_banner_content));        
	} else {
        echo json_encode(array("status" => false , "content" => "Not found"));
    }

    wp_die();
}

add_action( 'wp_ajax_ti_change_geo_tel', 'ti_change_geo_tel_fn' );
add_action( 'wp_ajax_nopriv_ti_change_geo_tel', 'ti_change_geo_tel_fn' );

function ti_change_geo_tel_fn(){

	$country = get_user_geo_country_code();
	$site_call_details = get_call_details($country);

	if (!empty($site_call_details)) {
        echo json_encode(array("status" => true , "content" => $site_call_details));        
	} else {
        echo json_encode(array("status" => false , "content" => "Not found"));
    }

    wp_die();
}

add_action( 'wp_ajax_ti_get_geo_country_code', 'ti_get_geo_country_code_fn' );
add_action( 'wp_ajax_nopriv_ti_get_geo_country_code', 'ti_get_geo_country_code_fn' );

function ti_get_geo_country_code_fn(){

	$country_code = get_user_geo_country_code();

	if (!empty($country_code)) {
        echo json_encode(array("status" => true , "content" => $country_code));        
	} else {
        echo json_encode(array("status" => false , "content" => "Country Code Not found"));
    }

    wp_die();
}


add_action( 'wp_ajax_ti_change_logo', 'ti_change_logo_fn' );
add_action( 'wp_ajax_nopriv_ti_change_logo', 'ti_change_logo_fn' );

function ti_change_logo_fn(){

	$country   = get_user_geo_country_code();
	$site_logo = get_geo_logo($country);

	if (!empty($site_logo)) {
        echo json_encode(array("status" => true , "content" => $site_logo));        
	} else {
        echo json_encode(array("status" => false , "content" => "Not found"));
    }

    wp_die();
}


// add_action('wp_ajax_update_last_visit', 'update_last_visit');
// add_action('wp_ajax_nopriv_update_last_visit', 'update_last_visit'); 

// function update_last_visit() {
//     $post_id = intval($_POST['post_id']);
//     $current_time = current_time('timestamp', 1);

//     update_post_meta($post_id, '_last_visit_date', $current_time);

//     die(); 
// }


// Combined Geo related AJAX call


add_action( 'wp_ajax_ti_combined_ajax_geo_actions', 'handle_ti_combined_ajax_geo_actions' );
add_action( 'wp_ajax_nopriv_ti_combined_ajax_geo_actions', 'handle_ti_combined_ajax_geo_actions' );

function handle_ti_combined_ajax_geo_actions() {
    $response_data = array(
        'status' => true, 
        'content' => array(
            'ti_change_logo' => array(),
            'ti_change_geo_tel' => array(),
            'ti_get_geo_country_code' => array(),
            'ti_geo_targetted_banner' => array(),
        ),
    );

    $country_code = get_user_geo_country_code();

    // Handle ti_change_logo logic
    $site_logo = get_geo_logo($country_code);
    $response_data['content']['ti_change_logo'] = array(
        'status' => !empty($site_logo),
        'content' => !empty($site_logo) ? $site_logo : 'Not found',
    );

    // Handle ti_change_geo_tel logic
    $site_call_details = get_call_details($country_code);
    $response_data['content']['ti_change_geo_tel'] = array(
        'status' => !empty($site_call_details),
        'content' => !empty($site_call_details) ? $site_call_details : 'Not found',
    );

    // Handle ti_get_geo_country_code logic
    $response_data['content']['ti_get_geo_country_code'] = array(
        'status' => !empty($country_code),
        'content' => !empty($country_code) ? $country_code : 'Country Code Not found',
    );

    // Handle ti_geo_targetted_banner logic
    $geo_banner_content = get_geo_banner_content($country_code);
    $response_data['content']['ti_geo_targetted_banner'] = array(
        'status' => !empty($geo_banner_content),
        'content' => !empty($geo_banner_content) ? $geo_banner_content : 'Not found',
    );

    echo json_encode($response_data);
    wp_die();
}


// Ajax to fetch Google reviews rating and count
// add_action('wp_ajax_get_google_reviews', 'get_google_place_reviews');
// add_action('wp_ajax_nopriv_get_google_reviews', 'get_google_place_reviews');
function get_google_place_reviews() {
    
    $api_key = '1bfhAD_0o3K52UyeGYnXKNQgQW6Tny8d1KIMuDsiPQw';
    $place_id = 'ChIJaeBYjIqxe0gR8IEtXkiDSWo';
    
    // Validate credentials
    if (empty($api_key)) {
        wp_send_json_error('API key not configured');
        return;
    }
    
    if (empty($place_id)) {
        wp_send_json_error('Place ID not configured');
        return;
    }
    
    $url = "https://maps.googleapis.com/maps/api/place/details/json?place_id={$place_id}&fields=name,rating,user_ratings_total&key={$api_key}";
    
    $response = wp_remote_get($url, array(
        'timeout' => 15,
        'sslverify' => true
    ));
    
    if (is_wp_error($response)) {
        wp_send_json_error('Failed to fetch data from Google Places API');
        return;
    }
    
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);
    
    if (!isset($data['status']) || $data['status'] !== 'OK') {
        $error_message = isset($data['error_message']) ? $data['error_message'] : 'Unknown API error';
        wp_send_json_error('Google Places API Error: ' . $error_message);
        return;
    }
    
    wp_send_json_success($data['result']);
}



