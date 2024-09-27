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
    }
    elseif($deposit_payment_plan === 4 || $deposit_payment_plan === 8){
        $first_payment = $full_price * $deposit_percent;
        $second_payment = $full_price * $recurring_percent;
        $third_payment = $full_price * $recurring_percent;
        $first_instalment_days = 30;
        $second_instalment_days = 60;
        $first_due_date = date('jS M Y', strtotime("+30 days"));
        $last_due_date = date('jS M Y', strtotime("+60 days"));
    }
    elseif($deposit_payment_plan === 6){

        $first_payment = $full_price * $deposit_percent;
        $other_payments = $full_price * $recurring_percent;
        // Fixed99
        if (ENABLE_99){
            $first_payment = get_first_payment_amount();
            $other_payments = round((float)($full_price - $first_payment) / 6, 2);
        }
        // Fixed99
    }
    elseif($deposit_payment_plan === 7){

        $first_payment = $full_price * $deposit_percent;
        $other_payments = $full_price * $recurring_percent;
        // Fixed99
        if (ENABLE_99){
            $first_payment = get_first_payment_amount_new();
            $other_payments = round((float)($full_price - $first_payment) / 5, 2);
        }
        // Fixed99
    }
?>

<div class="installments-breakdown">
    <h6>Payment breakdown:</h6>
    <hr>
    <span>Full Price: <b><?php echo geo_price($full_price); ?></b></span>
    <span>Pay Today: <b><?php echo geo_price($first_payment); ?></b></span>
    <?php if($deposit_payment_plan === 6 || $deposit_payment_plan === 7 ):
        $count = 30;    
    ?>
        <span>Pay later:</span>
        <?php for($i=1;$i<$total_deposits;$i++){
            $due_date = date('jS M Y', strtotime("+".$count." days"));    
        ?>
            <span data-due-date="<?php echo $due_date?>"><b><?php echo geo_price($other_payments)?></b> on <?php echo $due_date?></span>
        <?php 
            $count+=30;
        }
        ?>
    <?php else:?>
        <span>Pay after <?php echo $first_instalment_days; ?>days: <b><?php echo geo_price($second_payment)?></b> on <?php echo $first_due_date?></b></span>
        <?php if ($second_instalment_days): ?>
        <span>Pay after <?php echo $second_instalment_days; ?>days: <b><?php echo geo_price($third_payment)?></b> on <?php echo $last_due_date?></span>
        <?php endif;?>
    <?php endif?>
</div>