<?php

add_filter( 'automatewoo/variables', 'my_automatewoo_variables' );

/**
 * @param $variables array
 * @return array
 */
function my_automatewoo_variables( $variables ) {
	// variable's string form is set here, it will be order.pluralize
	$variables['order']['joining_info'] 			= dirname(__FILE__) . '/awoo/joining_info.php';
	$variables['order']['course_dates_info'] 		= dirname(__FILE__) . '/awoo/course_dates_info.php';
	$variables['order']['instructor_bio'] 			= dirname(__FILE__) . '/awoo/instructor_bio.php';
	$variables['order']['internship_application_form_url'] = dirname(__FILE__) . '/awoo/internship_application_form_url.php';
	$variables['order']['internship_display_name'] 	= dirname(__FILE__) . '/awoo/internship_display_name.php';

	$variables['order']['instructor_name'] 	= dirname(__FILE__) . '/awoo/instructor_name.php';
	$variables['order']['course_date_text'] = dirname(__FILE__) . '/awoo/course_date_text.php';
	$variables['order']['course_time_text'] = dirname(__FILE__) . '/awoo/course_time_text.php';

	return $variables;
}


function get_merge_value_from_course_date($course_date, $data_key){
	$class_course_dates = get_field('course_dates', 'option');
	
	foreach ($class_course_dates as $key => $class_course_date){
		unset($class_course_dates[$key]);
		$start_date = $class_course_date['start_date'];
		$class_course_dates[$start_date] = $class_course_date;
	}
		
	$selected_course_info = $class_course_dates[$course_date];
	return isset($selected_course_info[$data_key]) ? $selected_course_info[$data_key] : '';

}

function get_course_date_from_order($order){
	foreach ( $order->get_items() as $item_id => $item ) {
		$course_date = wc_get_order_item_meta( $item_id, 'Start Date', true );
		if ($course_date) {
			return $course_date;
		} 
	}		
	return false;
}