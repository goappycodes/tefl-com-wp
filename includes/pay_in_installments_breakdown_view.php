<?php

function cart_has_multiple_items_with_deposit()
{
    $cart_items = WC()->cart->get_cart();
    $has_multiple_deposit_items = false;
    $count = 0;
    foreach ($cart_items as $cart_item) {
        $is_deposit = $cart_item['is_deposit'];
        if (isset($is_deposit) && $is_deposit) {
            $count++;
        }
    }
    if ($count > 1) {
        $has_multiple_deposit_items = true;
    }
    return $has_multiple_deposit_items;
}
function get_product_name_with_deposit()
{
    $cart_items = WC()->cart->get_cart();
    $product_name = '';
    foreach ($cart_items as $cart_item) {
        $is_deposit = $cart_item['is_deposit'];
        if (isset($is_deposit) && $is_deposit) {
            $product_name = $cart_item['data']->get_name();
        }
    }
    return $product_name;
}


function display_split_payment_breakdown_html($cart_item)
{

    $product_id             = $cart_item['product_id'];
    $is_deposit             = $cart_item['is_deposit'] ?? '';
    $deposit_payment_plan   = get_post_meta($product_id, '_wc_deposit_payment_plans', true);
    $deposit_payment_plan   = $deposit_payment_plan[0] ?? '';
    $full_price             = $cart_item['full_amount'] ?? '';
    $currency               = get_woocommerce_currency_symbol();

    ob_start();

    if ($is_deposit && $deposit_payment_plan) {
        ?>
        <div class="payment-breakdown-container <?php echo is_cart() ? 'mr-2' : '' ?><?php echo is_checkout() ? 'checkout-page' : '' ?>">
            <?php
            global $wpdb;
            
            $query = "SELECT amount FROM `wp_wc_deposits_payment_plans_schedule` WHERE `schedule_index` = 0 AND `plan_id` = ".$deposit_payment_plan;
            $deposit_percent = $wpdb->get_var($query);
            $deposit_percent = round((float)$deposit_percent / 100, 5);

            $query = "SELECT amount FROM `wp_wc_deposits_payment_plans_schedule` WHERE `schedule_index` = 1 AND `plan_id` = ".$deposit_payment_plan;
            $recurring_percent = $wpdb->get_var($query);
            $recurring_percent = round((float)$recurring_percent / 100, 5);

            $query = "SELECT count(schedule_id) FROM `wp_wc_deposits_payment_plans_schedule` WHERE `plan_id` = ".$deposit_payment_plan;
            $total_deposits = $wpdb->get_var($query);
            
            if($deposit_payment_plan === 1 || $deposit_payment_plan === 3){
                $first_payment = $full_price * $deposit_percent;
                $second_payment = $full_price - $first_payment;
                $first_due_date = date('jS M Y', strtotime("+30 days"));
                $first_instalment_days = 30;
                $deposit_class = 'two-deposits';
                $deposit_description = 'Pay half today. Pay the rest after 30 days.';
            }
            elseif($deposit_payment_plan === 4){
                $first_payment = $full_price * $deposit_percent;
                $second_payment = $full_price * $recurring_percent;
                $third_payment = $full_price * $recurring_percent;
                $first_instalment_days = 30;
                $second_instalment_days = 60;
                $deposit_class = 'three-deposits';
                $deposit_description = 'Pay 20% today then 40% after 30 days and rest 40% after 60 days.';
            }
            elseif($deposit_payment_plan === 6){
                $first_payment = $full_price * $deposit_percent;
                // Fixed99
                if (ENABLE_99){
                    $first_payment = get_first_payment_amount();
                }
                // Fixed99
                $other_payments = round((float)($full_price - $first_payment) / 6, 2);
                $deposit_class = 'seven-deposits';
                $deposit_description = 'Enrol today with a small deposit + pay  the rest of the balance in 6 interest free monthly payments.';
            } 
            elseif($deposit_payment_plan === 7){
                $first_payment = $full_price * $deposit_percent;
                // Fixed99
                if (ENABLE_99){
                    $first_payment = get_first_payment_amount_new();
                }
                // Fixed99
                $other_payments = round((float)($full_price - $first_payment) / 5, 2);
                $deposit_class = 'six-deposits';
                $deposit_description = 'Enrol today with a small deposit + pay  the rest of the balance in 5 interest free monthly payments.';
            } 
            elseif($deposit_payment_plan === 8){
                $first_payment = $full_price * $deposit_percent;
                $second_payment = $full_price * $recurring_percent;
                $third_payment = $full_price * $recurring_percent;
                $first_instalment_days = 30;
                $second_instalment_days = 60;
                $deposit_class = 'three-deposits';
                $deposit_description = 'Spread the purchase of this TEFL course over three EQUAL interest-free payments. Pay 33.4% today then 33.3% after 30 days and remaining 33.33% after 60 days.';
            }
            ?>
                <h6 class="payment-breakdown-title"><?php echo $total_deposits?> interest-free payments</h6>
                <div class="payment-breakdown-body">
                    <div class="payment-breakdown-row <?php echo $deposit_class?>">
                        <div class="payment-breakdown-column">
                            <span class="payment-breakdown-value"><?php echo geo_price($first_payment);?></span>
                            <span class="payment-breakdown-label">Today</span>
                        </div>
                        <?php if($deposit_payment_plan === 6):?>
                            <div class="payment-breakdown-column">
                                <span class="payment-breakdown-value"><?php echo geo_price($other_payments);?></span>
                                <span class="payment-breakdown-label">For next 6 months</span>
                            </div>
                        <?php elseif($deposit_payment_plan === 7):?>
                            <div class="payment-breakdown-column">
                                <span class="payment-breakdown-value"><?php echo geo_price($other_payments);?></span>
                                <span class="payment-breakdown-label">For next 5 months</span>
                            </div>
                        <?php else:?>
                            <div class="payment-breakdown-column">
                                <span class="payment-breakdown-value"><?php echo geo_price($second_payment);?></span>
                                <span class="payment-breakdown-label">In <?php echo $first_instalment_days ?> days</span>
                            </div>
                            <?php if ($second_instalment_days): ?>
                                <div class="payment-breakdown-column">
                                    <span class="payment-breakdown-value"><?php echo geo_price($second_payment);?></span>
                                    <span class="payment-breakdown-label">In <?php echo $second_instalment_days ?> days</span>
                                </div>
                            <?php endif ?>
                        <?php endif?>
                    </div>
                </div>
                <div class="payment-breakdown-footer">
                    <h6 class="payment-breakdown-footer__title">No interest. Pay by card</h6>
                    <div class="payment-breakdown-footer__body">
                        <?php echo $deposit_description?>
                    </div>
                </div>
 				<div class="payment-partners">
                	<img src="/wp-content/uploads/2022/07/Payment-options.svg" alt="" />
                </div>
        </div>
    <?php
    }
    return ob_get_clean();
}
