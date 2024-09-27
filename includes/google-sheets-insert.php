<?php

require $_SERVER["DOCUMENT_ROOT"] . '/google-sheets/vendor/autoload.php';

add_action('wpcf7_mail_sent', 'ti_mail_sent' );
 
function ti_mail_sent( $contact_form ){

    // to get form id
    $form_id = $contact_form->id();
    $form_title = get_the_title($form_id);

    $submission = WPCF7_Submission::get_instance(); 
    $posted_data = $submission->get_posted_data();
    
    $data = array();
    $data["Title"] = $form_title;
    $data["Date (UTC)"] = date("Y-m-d h:i:s A");
    $data["URL"] = strpos($_SERVER['REQUEST_URI'], "wp-json") === false ? "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] : $_SERVER['HTTP_REFERER'];

    $dataset = array();

  
    foreach ($posted_data as $key => $value){
        if(!empty($value)){

            if(is_array($value)) {
                foreach ($value as $inner_key => $val){
                    $data[$inner_key] = $val; 
                }
            }else{
                $data[$key] = $value;
            }
        }
    }
    addRowToSpreadsheet($data);

}

function addRowToSpreadsheet($rawdata = array()) {

    custom_ti_log( $rawdata );
    
    $first_name = $name = $last_name = $email = $phone = '';

    foreach ($rawdata as $key => $value) {
        if(strpos($key, "phone-cf7it-country") !== false){
            continue;
        }
        $key = preg_replace('/[^A-Za-z0-9\-]/', '', $key);
        $key = str_replace('_', '', $key);
        
        if (stripos($key, "name") !== false && stripos($key, "last") === false) {
            $name = $value;
        }
        if (stripos($key, "first") !== false || stripos($key, "fname") !== false) {
            $first_name = $value;
        }
        if (stripos($key, "last") !== false || stripos($key, "lname") !== false) {
            $last_name = $value;
        }
        if ((stripos($key, "email") !== false || stripos($key, "mail") !== false) && stripos($key, "mailchimp") === false) {
            $email = $value;
        }
        if ( ( stripos($key, "phone") !== false || stripos($key, "contactno") !== false || stripos($key, "your-number") !== false ) && (stripos($key, "code") === false)) {
            $phone = $value;
        }

    }
    
    $data[] = $rawdata["Title"];
    $data[] = $rawdata["Date (UTC)"];
    $data[] = $rawdata["URL"];
    $data[] = $first_name ? $first_name : $name;
    $data[] = $last_name;
    $data[] = $email;
    $data[] = $phone;
    $location = WC_Geolocation::geolocate_ip();
    $data[] = isset($location['country']) ? $location['country'] : "";    

    $spreadsheetId = "1Ub8yJfwDw6VbfZ3qSIo4YPePL4-nn6zfPUph1eoHWqU";
    $tabName = "Common";

    $credentials_file = $_SERVER["DOCUMENT_ROOT"] . '/google-sheets/credentials.json';
	// Set up the API
    $client = new Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
    $client->setAuthConfig($credentials_file);
	$sheet_service = new Google_Service_Sheets($client);

    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');


    $tokenPath = $_SERVER["DOCUMENT_ROOT"] . '/google-sheets/token.json';

    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = $_GET['code'];

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            error_log("Access Token: ".print_r($accessToken,true));
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }

    // If there is no previous token or it's expired.
    if (!$client->isAccessTokenExpired()) {

        $rows = [$data]; // you can append several rows at once
        $valueRange = new \Google_Service_Sheets_ValueRange();
        $valueRange->setValues($rows);
        $range = $tabName; // the service will detect the last row of this sheet
        $options = ['valueInputOption' => 'USER_ENTERED'];

        //error_log("Tab Name: ".print_r($range, true));
    	
    	try {
    		// Execute the request
    		$response = $sheet_service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $options);
            //error_log("Response: ".print_r($response, true));
    		return true;
    	} catch (Exception $e) {
    		// Something went wrong
    		wp_mail("ritesh@appycodes.com", "G-Sheets Insert Error for ".get_home_url(), "G-Sheets Insert Error for ".get_home_url()."<br/>".print_r($e, true));
    		error_log($e->getMessage());
    	}

        
    } else {
        wp_mail("ritesh@appycodes.com", "G-Sheets Token Expired for ".get_home_url(), "G-Sheets Token Expired for ".get_home_url());
        return false;
    }

	
	return false;
}