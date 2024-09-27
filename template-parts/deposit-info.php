<?php
if ($deposit_payment_plan) {
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
      $deposit_icon = "/wp-content/uploads/2022/11/pay-in-two.png";
      $deposit_description = 'Split the cost of your purchase into 2 interest-free payments';
   }
   elseif($deposit_payment_plan === 4){
      $deposit_icon = "/wp-content/uploads/2022/11/pay-in-three.png";
      $deposit_description = 'Split the cost of your purchase into 3 interest-free payments';
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
      $deposit_description = 'Plus 6 interest-free monthly payments of '.geo_price($other_payments).'';
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
      $deposit_description = 'Plus 5 interest-free monthly payments of '.geo_price($other_payments).'';
   }
}
