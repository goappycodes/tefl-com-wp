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

				// Webinars run on UK time. Same UK clock rule as DAY_LIGHT_SAVINGS in
				// wp-config (Europe/London), applied to the webinar's own date so a
				// webinar after a clock change shows the right BST/GMT. The visitor's
				// local time is rendered client-side below, because this page is
				// cached (WPFC + Cloudflare) and a server-side IP lookup would show
				// the first visitor's timezone to everyone.
				$webinar_start_iso  = '';
				$webinar_uk_zone    = DAY_LIGHT_SAVINGS ? 'BST' : 'GMT';
				$raw_date           = get_post_meta($webinar_id, 'webinar_date', true);
				$raw_time           = get_post_meta($webinar_id, 'webinar_time', true);
				if ($raw_date && $raw_time) {
					try {
						$start = new DateTime($raw_date . ' ' . $raw_time, new DateTimeZone('Europe/London'));
						$webinar_uk_zone   = $start->format('T');
						$webinar_start_iso = $start->format(DATE_ATOM);
					} catch (Exception $e) {}
				}

				$webinar_label = $webinar_title . ' - ' . $webinar_date . ' - ' . $webinar_time;
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
							<p><?php echo $webinar_time; ?> (<?php echo esc_html($webinar_uk_zone); ?>)</p>
						</div>
						<?php if($webinar_start_iso):?>
						<div class="local-time time" style="display:none;">
							<h4>Your Time</h4>
							<p class="ti-webinar-local-time" data-start="<?php echo esc_attr($webinar_start_iso); ?>" data-uk-tz="Europe/London"></p>
						</div>
						<?php endif;?>
						<div class="register">
							<p><a href="#" class="ti-webinar-register" data-box="3092" data-webinar="<?php echo esc_attr($webinar_label); ?>" data-webinar-id="<?php echo esc_attr($webinar_id); ?>">Register Now</a></p>
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
(function () {
	// Register Now: values come from data attributes, so titles containing
	// quotes/apostrophes can't break the call (was an inline javascript: href).
	document.addEventListener('click', function (e) {
		var link = e.target.closest ? e.target.closest('a.ti-webinar-register') : null;
		if (!link) return;
		e.preventDefault();
		var box = link.getAttribute('data-box');
		var name = link.getAttribute('data-webinar');
		var id = link.getAttribute('data-webinar-id');
		if (typeof window.showpopupbox === 'function') {
			window.showpopupbox(box, name, id);
		} else if (window.Boxzilla) {
			window.Boxzilla.show(box);
			if (window.jQuery) {
				jQuery('input.wpcf7-form-control[name="webinar"]').val(name);
				jQuery('input.wpcf7-form-control[name="webinar-id"]').val(id);
			}
		}
	});

	// Local Time: convert the UK start time to the visitor's own timezone.
	function renderLocalTimes() {
		var zone;
		try { zone = Intl.DateTimeFormat().resolvedOptions().timeZone; } catch (err) { return; }
		if (!zone) return;
		var nodes = document.querySelectorAll('.ti-webinar-local-time[data-start]');
		for (var i = 0; i < nodes.length; i++) {
			var start = new Date(nodes[i].getAttribute('data-start'));
			if (isNaN(start.getTime())) continue;
			try {
				var time = start.toLocaleTimeString(undefined, { hour: 'numeric', minute: '2-digit' });
				var dateOpts = { weekday: 'short', day: 'numeric', month: 'short' };
				var localDate = start.toLocaleDateString(undefined, dateOpts);
				var ukDate = start.toLocaleDateString(undefined, Object.assign({ timeZone: nodes[i].getAttribute('data-uk-tz') || 'UTC' }, dateOpts));
				// Prefer the zone's full name ("India Standard Time"); an offset like
				// "GMT+5:30" reads as UK time next to the BST/GMT row, so fall back
				// to the city name instead.
				var zoneName = '';
				if (Intl.DateTimeFormat.prototype.formatToParts) {
					var parts = new Intl.DateTimeFormat(undefined, { timeZoneName: 'long' }).formatToParts(start);
					for (var p = 0; p < parts.length; p++) {
						if (parts[p].type === 'timeZoneName') zoneName = parts[p].value;
					}
				}
				if (!zoneName || /^(GMT|UTC)[+\-−]/.test(zoneName)) {
					var city = zone.split('/').pop().replace(/_/g, ' ');
					var legacy = { 'Calcutta': 'Kolkata', 'Saigon': 'Ho Chi Minh', 'Rangoon': 'Yangon', 'Katmandu': 'Kathmandu', 'Kiev': 'Kyiv' };
					zoneName = (legacy[city] || city) + ' time';
				}
				nodes[i].textContent = time + (localDate !== ukDate ? ', ' + localDate : '') + ' ' + zoneName;
				nodes[i].parentNode.style.display = '';
			} catch (err) {}
		}
	}
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', renderLocalTimes);
	} else {
		renderLocalTimes();
	}
})();
</script>

<!--/Upcoming Events Section-->


<?php get_footer(); ?>