<?php
/**
* Template Name: Webinars
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// $webinar_args = array(
// 	'numberposts'     => -1,
// 	'post_type'       => 'webinar',
// 	'status' 		  => 'published',
// 	'tax_query'       => array(
// 		array(
// 			'taxonomy'       => 'webinar_category',
// 			'field'          => 'slug',
// 			'terms'          => array( 'upcoming' ),
// 		),
// 	),
// 	'orderby' 	=> 'meta_value',
// 	'order'		=> 'ASC',
// 	'meta_query' => array(
//         array(
//             'key' => 'webinar_date',
//             'value' => date('Ymd'),
//             'compare' => '>='
//         )
//     )
// );

$webinars = get_latest_webinars(-1);


get_header(); ?>


<!--Interactive Webinars Section-->

<section class="interactive-webinars-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-lg-12">
		        <h1 class="font-600">COMPLIMENTARY INTERACTIVE WEBINARS</h1>
		        <p>Join us for live interactive career boosting webinars</p>
			</div>
		</div>
	</div>
</section>

<!--/Interactive Webinars Section-->

<!--Upcoming Events Section-->

<section class="upcoming-webinars-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-12">
		        <h3 class="section-title">UPCOMING EVENTS</h3>
			</div>
			<?php 
			foreach ($webinars as $webinar){
				$webinar_id         = $webinar->ID;
				$webinar_title      = $webinar->post_title;
				$webinar_location   = get_field('webinar_location', $webinar_id);
				$webinar_date       = get_field('webinar_date', $webinar_id);
				$webinar_time       = get_field('webinar_time', $webinar_id);
				// $webinar_image      = get_field('webinar_banner_image', $webinar_id);
				$webinar_image      = get_the_post_thumbnail_url($webinar_id, 'full');
				$webinar_link       = get_post_permalink($webinar_id);

				$local_webinar_time = get_local_time($webinar_time);
				$timeZoneIdentifier = get_user_timezone();
				
				?>
				<div class="live-webinar ast-col-md-4">
					<div class="live-webinar-image" style="background-image: url('<?php echo $webinar_image; ?>');">
						<!-- <img src="<?php echo $webinar_image; ?>"> -->
					</div>
					<div class="live-webinar-details">
						<div class="webinar-title">
							<h3><?php echo $webinar_title; ?></h3>
						</div>
						<div class="location">
							<h4>Location</h4>
							<p><?php echo $webinar_location; ?></p>
						</div>
						<div class="date">
							<h4>Date</h4>
							<p><?php echo $webinar_date; ?></p>
						</div>
						<div class="time">
							<h4>Time</h4>
							<p><?php echo $webinar_time; ?> (<?php echo ' '.DAY_LIGHT_SAVINGS?'BST':'GMT'?>)</p>
						</div>
						<?php if($local_webinar_time):?>
						<div class="local-time time">
							<h4>Local Time</h4>
							<p><?php echo $local_webinar_time.' ('.$timeZoneIdentifier.')'; ?></p>
						</div>
						<?php endif;?>
						<div class="register">
							<p><a href="javascript:showpopupbox('3092', '<?php echo $webinar_title." - ".$webinar_date." - ".$webinar_time; ?>', '<?php echo $webinar_id; ?>')" data-href="#boxzilla-3092" data-webinar="<?php echo $webinar_title." - ".$webinar_date." - ".$webinar_time; ?>">Register Now</a></p>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</section>
<script>
// function showpopupbox(boxid, webinarname){
//     Boxzilla.show(boxid);
//     jQuery('input.wpcf7-form-control[name="webinar"]').val(webinarname);
//     console.log("webinarname"+webinarname);
// }
</script>

<!--/Upcoming Events Section-->


<?php get_footer(); ?>