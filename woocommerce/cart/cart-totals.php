<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

<div class="cart_addon">

    <div class="cart_addon_image"><img src="https://teflinstitute.com/wp-content/uploads/2020/12/TEFL-Institute-Course-Badges_10-Virtual_10-Virtual-1.svg"></div>
    
    <div class="cart_addon_content">
        <?php 
            $product = wc_get_product('943');
            $product->get_regular_price();
            $product->get_sale_price();
            $product->get_price();
            $percentage = ( (float)$product->regular_price - (float)$product->sale_price ) / $product->regular_price * 100 ;
            $percentage = round($percentage);
        ?>
        <h4>10 HOUR VIRTUAL TEFL COURSE</h4>
        <p>Add to your enrolment now before our <?php echo $percentage; ?>% off offer ends.</p>
        <div>Was <?php echo get_woocommerce_currency_symbol().$product->get_regular_price(); ?>, NOW ONLY <?php echo get_woocommerce_currency_symbol().$product->get_sale_price(); ?>!</div>
        
        <select id="dates" onChange="update()">
            <option>Select webinar dates...</option>
            <?php
    		    $class_course_dates = get_field('course_dates', 'option');
    	
                $timezone = ptefl_utc_timezone_name();
        
    			$date_count = 0;
    			
    			foreach ($class_course_dates as $class_course_date){
                    $course_start_time = $class_course_date['start_time'];
                                
                    if($course_start_time):
                        $course_start_time_str  = date("g:ia", strtotime($course_start_time));
                        $course_start_time_new = ptefl_convert_utc_time($course_start_time_str);
                    endif;
                                
                    $course_end_time = $class_course_date['end_time'];
                                
                    if($course_end_time):
                        $course_end_time_str  = date("g:ia", strtotime($course_end_time));
                        $course_end_time_new = ptefl_convert_utc_time($course_end_time_str);
                    endif;
                                
                    if($course_start_time && $course_end_time):
                        $course_time = $course_start_time_new." - ".$course_end_time_new;
                    else:
                        $course_time = "";
                    endif;
    
    			$date_count++;
    		?>
    					
                <option value="<?php echo $class_course_date['start_date']; ?>"><?php echo $class_course_date['start_date']." - ".$class_course_date['end_date']; ?> - <?php echo $course_time; ?></option>
            <?php } ?>
        </select>
        
        <div class="cart_addon_content_btn">
            <a id="dates_book_now" class="add_to_enrolment" style="display:none;">Add to enrolment</a>
        </div>

		<script type="text/javascript">
			function update() {
				var select = document.getElementById('dates');
				var option = select.options[select.selectedIndex];

			    document.getElementById('dates_book_now').href = "/?addtimetocart&prid=943&date="+ option.value;
			    document.getElementById('dates_book_now').style.display = "block";
			}
		</script>
		
    </div>

</div>


	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<h2><?php esc_html_e( 'Cart totals', 'woocommerce' ); ?></h2>

	<table cellspacing="0" class="shop_table shop_table_responsive">

		<tr class="cart-subtotal">
			<th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
			<td data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<tr class="shipping">
				<th><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
				<td data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
			</tr>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
				/* translators: %s location. */
				$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
			}

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
						<td data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
					<?php
				}
			} else {
				?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
					<td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
				<?php
			}
		}
		?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<tr class="order-total">
			<th><?php esc_html_e( 'Order Total', 'woocommerce' ); ?></th>
			<td data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
	</table>

	<div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>


<img class="no-lazy d-none discount-icon" src="/wp-content/uploads/2025/03/back-of-the-net-ti.png" alt="">


<?php
// Option to add TEFL resource in cart if it does not exist
$teaching_resources = get_field('teaching_resources', 'option'); // Now a repeater field

if (is_array_empty($teaching_resources)) {
    return; // Exit if no resources are available
}

foreach ($teaching_resources as $index => $resource) {
    $product_id = $resource['product'];
    $product_name = $resource['product_name'];
    $product_desc = $resource['resources_description'];
    $cart_page_info = $resource['cart_page_info'];
    $resource_page_link = $resource['resource_page_link'];

    if (is_array_empty($cart_page_info)) {
        continue;
    }

    $icon = $cart_page_info['icon'];
    $title = $cart_page_info['title'];
    $desc = $cart_page_info['description'];

    $product_obj = wc_get_product($product_id);
    if ($product_obj) {
        $product_price = $product_obj->get_price_html();
    }

    $product_in_cart = false;
    foreach (WC()->cart->get_cart() as $cart_item) {
        if ($cart_item['product_id'] == $product_id) {
            $product_in_cart = true;
            break;
        }
    }

    if (!$product_in_cart) {
        ?>
        <div class="resource-container">
            <div class="resource-container__top">
                <div class="resource-icon">
                    <img src="<?php echo esc_url($icon); ?>" alt="">
                </div>
                <div class="resource-description">
                    <div class="resource-description-header">
                        <h3><?php echo $title; ?></h3>
                        <i class="fa fa-info" data-target="info-<?php echo $index; ?>"></i>
                        <div id="info-<?php echo $index; ?>" class="resource-info-container">
                            <h6><?php echo esc_html($product_name); ?></h6>
                            <div class="resource-info">
                                <?php echo wp_kses_post($product_desc); ?>
                            </div>
                            <a href="<?php echo $resource_page_link?>" target="_blank" class="btn btn-red btn-centered">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <span><?php echo esc_html($desc); ?></span>
                </div>
            </div>
            <div class="resource-container__bottom">
                <div class="resource-price">
                    <?php echo $product_price; ?>
                </div>
                <div class="resource-add-to-cart">
                    <a href="<?php echo esc_url($product_obj->add_to_cart_url()); ?>" value="<?php echo esc_attr($product_obj->get_id()); ?>" class="add-resource-btn button ajax_add_to_cart add_to_cart_button" data-product_id="<?php echo esc_attr($product_obj->get_id()); ?>" data-product_sku="<?php echo esc_attr($product_obj->get_sku()); ?>" aria-label="Add '<?php echo esc_attr($product_name); ?>' to your cart">
                        Add To Cart 
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
<?php
    }
}
?>


<div class="guarantee-div">
    <span class="guarantee-txt">14 Day Money Back Guarantee</span>
</div>

<div class="payment-logo-div">
    <p class="pay-text">Pay By</p>
    <div class="logo-div">
        <img src="/wp-content/uploads/2021/11/Payment-options.svg">
    </div>
</div>

    
    
    
    
    
