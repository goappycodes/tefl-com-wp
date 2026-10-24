<?php
// add_filter('wpcf7_autop_or_not', '__return_false');
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

/**
 * TEFL Salary Calculator OpenAI Integration
 */

// Add AJAX handlers for both logged in and non-logged in users


add_action('wp_ajax_generate_tefl_salary_estimate', 'handle_tefl_salary_estimate');
add_action('wp_ajax_nopriv_generate_tefl_salary_estimate', 'handle_tefl_salary_estimate');

function handle_tefl_salary_estimate() {
    $prompt = sanitize_textarea_field($_POST['prompt']);
    $form_data_raw = sanitize_text_field($_POST['form_data']);
    $form_data = json_decode(stripslashes($form_data_raw), true);

    // Validate required data
    if (empty($prompt) || empty($form_data)) {
        wp_send_json_error('Invalid data provided');
        return;
    }

    try {
        $estimate = generate_enhanced_tefl_salary_estimate($prompt, $form_data);
        
        if ($estimate) {
            wp_send_json_success(array(
                'estimate' => $estimate,
                'timestamp' => current_time('mysql')
            ));
        } else {
            wp_send_json_error('AI estimation failed, using fallback');
        }
    } catch (Exception $e) {
        // Log error and return fallback
        error_log('TEFL Calculator OpenAI Error: ' . $e->getMessage());
        wp_send_json_error('AI service unavailable');
    }
}


function generate_enhanced_tefl_salary_estimate($prompt, $form_data) {
    $api_key = defined('OPENAI_API_KEY') ? OPENAI_API_KEY : '';
    
    if (empty($api_key)) {
        error_log('TEFL Calculator: OpenAI API key not found in wp-config.php');
        return false;
    }

    $api_url = 'https://api.openai.com/v1/chat/completions';
    
    $headers = array(
        'Authorization' => 'Bearer ' . $api_key,
        'Content-Type' => 'application/json',
    );

    $system_message = create_enhanced_system_message($form_data);

    $body = json_encode(array(
        'model' => 'gpt-4o-mini', 
        'messages' => array(
            array(
                'role' => 'system',
                'content' => $system_message
            ),
            array(
                'role' => 'user',
                'content' => $prompt
            )
        ),
        'max_tokens' => 1200,
        'temperature' => 0.3, 
        'top_p' => 0.9,
        'frequency_penalty' => 0.1,
        'presence_penalty' => 0.1
    ));

    $response = wp_remote_post($api_url, array(
        'timeout' => 45, 
        'headers' => $headers,
        'body' => $body,
        'sslverify' => true
    ));

    if (is_wp_error($response)) {
        error_log('TEFL Calculator OpenAI Request Error: ' . $response->get_error_message());
        return false;
    }

    $response_code = wp_remote_retrieve_response_code($response);
    $response_body = wp_remote_retrieve_body($response);

    if ($response_code !== 200) {
        error_log('TEFL Calculator OpenAI API Error: HTTP ' . $response_code . ' - ' . $response_body);
        return false;
    }

    $data = json_decode($response_body, true);

    if (!isset($data['choices'][0]['message']['content'])) {
        error_log('TEFL Calculator: Invalid OpenAI response structure');
        return false;
    }

    $ai_response = trim($data['choices'][0]['message']['content']);
    
    $processed_response = process_enhanced_ai_response($ai_response, $form_data);

    return $processed_response;
}

function create_enhanced_system_message($form_data) {
    $teaching_type = $form_data['teaching-type'] ?? 'Unknown';
    $country = $form_data['country-text'] ?? 'Not specified';
    
    $system_message = "You are a TEFL industry expert. Provide salary estimates and career advice.

            CRITICAL: Respond with ONLY a clean JSON object with these exact keys:
            - salary_display: Simple salary range with currency
            - market_analysis: 2-3 sentences about market conditions
            - strategic_tip: 1-2 sentences of actionable career advice

            Do NOT include nested JSON, explanations outside the JSON, or formatting markers.";

    if ($teaching_type === 'Teaching Abroad' && $country !== 'Not specified') {
        $system_message .= "\n\nFocus on teaching opportunities in {$country}. Provide monthly salary ranges in local currency.";
    } else {
        $system_message .= "\n\nFocus on online teaching opportunities. Provide hourly rates in EUR (€).";
    }
    
    $system_message .= "\n\nExample format:\n";
    $system_message .= '{"salary_display":"€15-25 per hour","market_analysis":"Strong demand for qualified teachers. Your qualifications position you well in the current market.","strategic_tip":"Focus on obtaining TEFL certification and building a strong online presence to attract students."}';

    return $system_message;
}

function process_enhanced_ai_response($ai_response, $form_data) {
    // First try to parse as JSON
    $parsed_response = json_decode($ai_response, true);
    
    // If JSON parsing fails or we get nested JSON, extract properly
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($parsed_response)) {
        $parsed_response = extract_structured_data_from_text($ai_response, $form_data);
    } else {
        // Check if any values are JSON strings that need parsing
        foreach ($parsed_response as $key => $value) {
            if (is_string($value) && (strpos($value, '{"') === 0 || strpos($value, '{ "') === 0)) {
                $nested_data = json_decode($value, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($nested_data)) {
                    // Replace with the properly parsed nested data
                    $parsed_response = $nested_data;
                    break;
                }
            }
        }
    }
    
    $validated_response = validate_and_clean_ai_response($parsed_response);
    
    return json_encode($validated_response);
}

function validate_and_clean_ai_response($response) {
    $cleaned = array();
    
    // Clean salary display
    $salary = $response['salary_display'] ?? 'Contact us for estimate';
    $cleaned['salary_display'] = sanitize_text_field(strip_tags($salary));
    
    // Clean market analysis
    $market = $response['market_analysis'] ?? 'Based on your qualifications and current market conditions, this estimate reflects realistic earning potential.';
    $cleaned['market_analysis'] = sanitize_textarea_field(strip_tags($market));
    
    // Clean strategic tip
    $tip = $response['strategic_tip'] ?? 'Consider gaining additional qualifications to increase your earning potential.';
    $cleaned['strategic_tip'] = sanitize_textarea_field(strip_tags($tip));
    
    if (strlen($cleaned['market_analysis']) < 50) {
        $cleaned['market_analysis'] = get_fallback_content('market_analysis');
    }
    
    if (strlen($cleaned['strategic_tip']) < 30) {
        $cleaned['strategic_tip'] = get_fallback_content('strategic_tip');
    }
    
    return $cleaned;
}

function extract_structured_data_from_text($text_response, $form_data) {
    $teaching_type = $form_data['teaching-type'] ?? 'Unknown';
    
    // Extract salary information with flexible currency detection
    $salary_patterns = array(
        '/([€$£¥₹₽¢₩₡₪₫₾₵₴₸₺₼＄￠￡￥]|[A-Z]{3})\s*(\d{1,3}(?:[,.]?\d{3})*(?:\.\d{2})?)\s*[-–—]\s*([€$£¥₹₽¢₩₡₪₫₾₵₴₸₺₼＄￠￡￥]|[A-Z]{3})?\s*(\d{1,3}(?:[,.]?\d{3})*(?:\.\d{2})?)/u',
        '/(\d{1,3}(?:[,.]?\d{3})*(?:\.\d{2})?)\s*[-–—]\s*(\d{1,3}(?:[,.]?\d{3})*(?:\.\d{2})?)\s*([€$£¥₹₽¢₩₡₪₫₾₵₴₸₺₼＄￠￡￥]|[A-Z]{3})/u'
    );
    
    $salary_display = 'Contact us for personalized estimate';
    
    foreach ($salary_patterns as $pattern) {
        if (preg_match($pattern, $text_response, $matches)) {
            if (count($matches) >= 3) {
                $currency = $matches[1] ?? ($matches[3] ?? '€');
                $min_amount = $matches[2] ?? $matches[1];
                $max_amount = $matches[4] ?? $matches[2];
                
                $salary_display = "{$currency}{$min_amount}-{$currency}{$max_amount}";
                
                // Add context based on teaching type
                if ($teaching_type === 'Teaching Abroad') {
                    $salary_display .= ' per month';
                } else {
                    $salary_display .= ' per hour';
                }
                break;
            }
        }
    }
    
    $sections = split_response_into_sections($text_response);
    
    return array(
        'salary_display' => $salary_display,
        'market_analysis' => extract_market_analysis($sections, $text_response),
        'strategic_tip' => extract_strategic_tip($sections, $text_response)
    );
}

function split_response_into_sections($text) {
    // Split by common section indicators
    $section_markers = array(
        'market analysis', 'salary estimate', 'strategic', 'career', 'tips', 
        'advice', 'practical', 'insights', 'considerations', 'recommendations'
    );
    
    $sections = array();
    $current_section = '';
    $lines = explode("\n", $text);
    
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;
        
        $is_header = false;
        foreach ($section_markers as $marker) {
            if (stripos($line, $marker) !== false && strlen($line) < 100) {
                if (!empty($current_section)) {
                    $sections[] = $current_section;
                }
                $current_section = $line . "\n";
                $is_header = true;
                break;
            }
        }
        
        if (!$is_header) {
            $current_section .= $line . "\n";
        }
    }
    
    if (!empty($current_section)) {
        $sections[] = $current_section;
    }
    
    return $sections;
}

function extract_market_analysis($sections, $full_text) {
    $keywords = array('market', 'demand', 'industry', 'competition', 'trends', 'outlook');
    
    foreach ($sections as $section) {
        foreach ($keywords as $keyword) {
            if (stripos($section, $keyword) !== false) {
                $clean_text = clean_and_limit_text($section, 200);
                if (strlen($clean_text) > 50) {
                    return $clean_text;
                }
            }
        }
    }
    
    $paragraphs = explode("\n\n", $full_text);
    foreach ($paragraphs as $paragraph) {
        $clean_paragraph = clean_and_limit_text($paragraph, 200);
        if (strlen($clean_paragraph) > 100) {
            return $clean_paragraph;
        }
    }
    
    return 'Based on current market conditions and your qualifications, this estimate reflects realistic earning potential in your chosen field.';
}


function extract_strategic_tip($sections, $full_text) {
    $keywords = array('tip', 'advice', 'recommend', 'suggest', 'should', 'consider', 'focus', 'improve');
    
    foreach ($sections as $section) {
        foreach ($keywords as $keyword) {
            if (stripos($section, $keyword) !== false) {
                $clean_text = clean_and_limit_text($section, 120);
                if (strlen($clean_text) > 40) {
                    return $clean_text;
                }
            }
        }
    }
    
    return 'Focus on building your qualifications and gaining practical teaching experience to increase your market value and earning potential.';
}

function clean_and_limit_text($text, $max_length) {
    // Remove section headers and formatting
    $text = preg_replace('/^\d+\.\s*/', '', $text);
    $text = preg_replace('/^[A-Z\s]+:/', '', $text);
    $text = preg_replace('/\*+/', '', $text);
    $text = preg_replace('/#+\s*/', '', $text);
    
    // Clean whitespace
    $text = preg_replace('/\s+/', ' ', $text);
    $text = trim($text);
    
    // Limit length while preserving complete sentences
    if (strlen($text) > $max_length) {
        $text = substr($text, 0, $max_length);
        $last_period = strrpos($text, '.');
        if ($last_period !== false && $last_period > $max_length * 0.7) {
            $text = substr($text, 0, $last_period + 1);
        } else {
            $text = rtrim($text, ' .,!?') . '...';
        }
    }
    
    return $text;
}


function validate_ai_response_fields($response) {
    $validated = array(
        'salary_display' => sanitize_text_field($response['salary_display'] ?? 'Contact us for estimate'),
        'market_analysis' => sanitize_textarea_field($response['market_analysis'] ?? 'Market analysis not available'),
        'strategic_tip' => sanitize_textarea_field($response['strategic_tip'] ?? 'Consider additional qualifications'),
        'long_term_strategy' => sanitize_textarea_field($response['long_term_strategy'] ?? 'Focus on continuous development'),
        'practical_insights' => sanitize_textarea_field($response['practical_insights'] ?? 'Research market requirements')
    );
    
    foreach ($validated as $key => $value) {
        if (strlen($value) < 20 && $key !== 'salary_display') {
            $validated[$key] = get_fallback_content($key);
        }
    }
    
    return $validated;
}

function get_fallback_content($section_type) {
    $fallbacks = array(
        'market_analysis' => 'The current TEFL market shows strong demand for qualified teachers. Your profile indicates good potential for competitive compensation based on industry standards.',
        'strategic_tip' => 'Focus on obtaining recognized certifications and building practical teaching experience. Consider specializing in high-demand areas like business English or exam preparation.',
        'long_term_strategy' => 'Develop a career progression plan that includes advanced certifications, specialized skills, and leadership experience. Consider transitions to teacher training or curriculum development roles.',
        'practical_insights' => 'Network with experienced teachers, join professional associations, and stay informed about market trends. Timing your job search with peak hiring seasons can significantly impact opportunities.'
    );
    
    return $fallbacks[$section_type] ?? 'Additional insights are available through our detailed consultation process.';
}

function get_client_ip() {
    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR');
    
    foreach ($ip_keys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}


function check_tefl_calculator_rate_limit() {
    $user_ip = get_client_ip();
    $rate_limit_key = 'tefl_calc_rate_limit_' . md5($user_ip);
    $current_requests = get_transient($rate_limit_key);
    
    if ($current_requests === false) {
        set_transient($rate_limit_key, 1, HOUR_IN_SECONDS);
        return true;
    }
    
    if ($current_requests >= 15) { 
        return false;
    }
    
    set_transient($rate_limit_key, $current_requests + 1, HOUR_IN_SECONDS);
    return true;
}

add_action('wp_ajax_generate_tefl_salary_estimate', 'check_rate_limit_before_processing', 5);
add_action('wp_ajax_nopriv_generate_tefl_salary_estimate', 'check_rate_limit_before_processing', 5);

function check_rate_limit_before_processing() {
    if (!check_tefl_calculator_rate_limit()) {
        wp_send_json_error('Rate limit exceeded. Please try again later.');
        wp_die();
    }
}


 
