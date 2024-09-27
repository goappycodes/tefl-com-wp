<?php
wp_enqueue_style('ti-deposit-form-css');
wp_enqueue_script('wc-deposits-frontend');
$curr_post_type = get_post_type();
$curr_post_id = get_the_ID();
if($curr_post_type == 'internship'){
    $internship_product_id = get_field('internship_product');
    //$internship_product = wc_get_product($internship_product_id);
    $curr_post_id = $internship_product_id;
}else if($curr_post_type == 'course'){
	$course_product_id = get_field('course_product');
    //$course_product = wc_get_product($course_product_id);
    $curr_post_id = $course_product_id;
}
else{
	$curr_post_id = $course_product_id;
}

$deposit_payment_plan = get_post_meta($curr_post_id, '_wc_deposit_payment_plans', true);
$deposit_payment_plan = $deposit_payment_plan[0];
if($deposit_payment_plan === 1 || $deposit_payment_plan === 3){
	$deposit_description = 'Spread the purchase of this TEFL '.$curr_post_type.' over two interest-free payments. The second intallment is due after 30 days.';
}
elseif($deposit_payment_plan === 4){
	$deposit_description = 'Spread the purchase of this TEFL '.$curr_post_type.' over three interest-free payments. Pay 20% today then 40% after 30 days and rest 40% after 60 days.';
}
elseif($deposit_payment_plan === 6){
	$deposit_description = 'Enrol today with a small deposit + pay  the rest of the balance in 6 interest free monthly payments.';
}
elseif($deposit_payment_plan === 7){
	$deposit_description = 'Enrol today with a small deposit + pay  the rest of the balance in 5 interest free monthly payments.';
}
elseif($deposit_payment_plan === 8){
	$deposit_description = 'Spread the purchase of this TEFL '.$curr_post_type.' over three EQUAL interest-free payments. Pay 33.4% today then 33.3% after 30 days and remaining 33.33% after 60 days.';
}
global $wpdb;
$query = "SELECT count(schedule_id) FROM `wp_wc_deposits_payment_plans_schedule` WHERE `plan_id` = ".$deposit_payment_plan;
$total_deposits = $wpdb->get_var($query);

$default_selected_type = WC_Deposits_Product_Manager::get_deposit_selected_type( $curr_post_id );
$style                 = 'deposit' === $default_selected_type ? 'style="display:block;"' : 'style="display:none;"';
if ( $deposit_enabled == 'optional' || $deposit_enabled == 'required' ){ 
?>
<div class="wc-deposits-wrapper <?php echo WC_Deposits_Product_Manager::deposits_forced( $curr_post_id ) ? 'wc-deposits-forced' : 'wc-deposits-optional'; ?>">
	<?php if ( ! WC_Deposits_Product_Manager::deposits_forced( $curr_post_id ) ) : ?>
		<?php 
		if( $deposit_enabled == 'forced' || $deposit_enabled == 'optional' ):
		?>
			<div class="installments-breakdown">
				<div
					class="ajax-snippet" 
					data-snippet="installment_breakdown"
					data-objectid="<?php echo $curr_post_id; ?>"
				>
				</div>
				<div id="loader" class="loader">
				Fetching installment breakdown details <img src="/wp-content/uploads/2022/11/loading-yellow.gif" alt="fetching deposit details">
				</div>
			</div>
		<?php
		endif;
		?>
		<i class="show-schedule-icon fa fa-info"></i>
		<ul class="wc-deposits-option <?php echo $total_deposits?>">
			<li class="active ">
				<input type="radio" name="wc_deposit_option" value="no" class="radio-custom wc-option-pay-full" id="wc-option-pay-full" <?php checked( $default_selected_type, 'full' ); ?> />
				<label for="wc-option-pay-full" class="radio-custom-label">
					<?php esc_html_e( 'Pay in Full', 'woocommerce-deposits' ); ?>
				</label>
			</li>
			<li >
				<input type="radio" name="wc_deposit_option" value="yes" class="wc-option-pay-deposit radio-custom " id="wc-option-pay-deposit" <?php checked( $default_selected_type, 'deposit' ); ?> />
				<label for="wc-option-pay-deposit" class="radio-custom-label radio-custom-label-pay-deposit">
				    <?php 
    				   
						esc_html_e('Pay in '.$total_deposits.'','woocommerce-deposits');
				    ?>
				</label>
			</li>
			
		</ul>
			
		
	<?php endif; ?>
	<?php if ( 'plan' === WC_Deposits_Product_Manager::get_deposit_type( $curr_post_id ) ) : ?>
		<div class="show-breakdown  wc-deposits-payment-plans" <?php echo $style; ?>>
			<?php foreach( WC_Deposits_Plans_Manager::get_plans_for_product( $curr_post_id ) as $key => $plan ) : ?>
				<!-- <span class="wc-deposits-payment-plan-description"><?php echo wp_kses_post( $plan->get_description() ); ?></span> -->
				<span class="wc-deposits-payment-plan-description"><?php echo $deposit_description?></span>
			<?php endforeach; ?>
			<!-- <div class="show-schedule">View interest-free payment schedule</div> -->
		</div>
	<?php else : ?>
		<div class="wc-deposits-payment-description" <?php echo $style; ?>>
			<?php echo WC_Deposits_Product_Manager::get_formatted_deposit_amount( $curr_post_id ); ?>
		</div>
	<?php endif; ?>
</div>
<?php }