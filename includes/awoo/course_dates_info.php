<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @class AW_Variable_Order_Course_Dates_Info
 */
class My_AutomateWoo_Variable_Order_Course_Dates_Info extends AutomateWoo\Variable {

	/** @var bool - whether to allow setting a fallback value for this variable  */
	public $use_fallback = false;

	
	public function load_admin_details() {
		$this->description = __( "Display course dates info based on dates", 'automatewoo');
	}

	/**
	 * @param $order WC_Order
	 * @param $parameters array
	 * @return string
	 */
	public function get_value( $order, $parameters ) {
		$course_date = get_course_date_from_order($order);
		if ($course_date){
			return get_merge_value_from_course_date($course_date, 'course_date__info');
		}
        return '-';
	}

}

return new My_AutomateWoo_Variable_Order_Course_Dates_Info();