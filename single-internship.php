<?php

/**
 * The template for displaying all single internship.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-internship
 *
 * @package Astra
 * @since 1.0.0
 */



if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
$clockdown = get_field('clockdown', 'option');
$internship_product_id = get_field('internship_product');
$internship_product = wc_get_product($internship_product_id);
$internship_price_html = '';
if ($internship_product) :
    $internship_price_html = $internship_product->get_price_html();
    $full_price = $internship_product->get_price(); 

    $deposit_enabled = get_post_meta($internship_product_id, '_wc_deposit_enabled', true);

    $deposit_payment_plan = '';

    if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional') {
        $deposit_payment_plan = get_post_meta($internship_product_id, '_wc_deposit_payment_plans', true);
        $deposit_payment_plan = $deposit_payment_plan[0];
    }
    $deposit_class = '';
    if($deposit_payment_plan): 
        $deposit_class = "deposit-full-price payment-plan-".$deposit_payment_plan;
    endif; 
    $query = "SELECT amount FROM `wp_wc_deposits_payment_plans_schedule` WHERE `schedule_index` = 0 AND `plan_id` = ".$deposit_payment_plan;
    $deposit_percent = $wpdb->get_var($query);
    $deposit_percent = round((float)$deposit_percent / 100, 5);
endif; 
$get_the_brochure = get_field('get_the_brochure');
$overview = get_field('overview');
$video = get_field('video');
$itinerary = get_field('itinerary');
$essential_information = get_field('essential_information');
$fully_inclusive_programme = get_field('fully_inclusive_programme');
$location = get_field('location'); 

$show_alerts = get_field('show_alerts');
$register_for_alerts_link = get_field('register_for_alerts_link');

$show_eligibility_checker = get_field('show_eligibility_checker');
$eligibility_checker = get_field('eligibility_checker');

?>

<?php

if (get_field('is_internship_new_design')) {
    include('ti-single-internship-template-new2023.php');
} else {
    include('ti-single-internship-template.php');
}

?>


<?php get_footer(); ?>
