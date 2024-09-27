<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @class AW_Variable_Order_Internship_Application_Form_Url
 */
class My_AutomateWoo_Variable_Order_Internship_Application_Form_Url extends AutomateWoo\Variable {

	/** @var bool - whether to allow setting a fallback value for this variable  */
	public $use_fallback = false;

	
	public function load_admin_details() {
		$this->description = __( "Display internship application form URL", 'automatewoo');
	}

	/**
	 * @param $order WC_Order
	 * @param $parameters array
	 * @return string
	 */
	public function get_value( $order, $parameters ) {
		$items = $order->get_items();
		foreach ( $items as $item ) {
			$product_id = $item->get_product_id();
			if ( get_field('internship_application_form_url', $product_id) )  {
				return get_field('internship_application_form_url', $product_id);
			}
		}
        return '-';
	}

}

return new My_AutomateWoo_Variable_Order_Internship_Application_Form_Url();