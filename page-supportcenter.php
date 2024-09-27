<?php
/*
    Template Name: Support Center Archive Template
    */

get_header();


$current_page_id = get_the_ID();
?>


<!--Heading Section-->

<?php

$heading = get_field('heading');

$title = $heading['header_title'];
$stitle = $heading['header_subtitle'];


?>
<section class="header-section">

	<div calss="ast-container">
		<div class="ast-row">
			<div class="ast-col-lg-6">
				<h1 class="section-heading"><?php echo $title ?></h1>

				<p><?php echo $stitle ?></p>
			</div>

		</div>
	</div>

</section>



<!--/Heading Section-->

<!--Upcoming Webinar Section-->
<?php


$webinar_args = array(
	'numberposts'     => 1,
	'post_type'       => 'webinar',
	'status' => 'published',
	'tax_query'       => array(
		array(
			'taxonomy'       => 'webinar_category',
			'field'          => 'slug',
			'terms'          => array( 'upcoming' ),
		),
	),
	'orderby' 	=> 'meta_value',
	'order'		=> 'ASC',
	'meta_query' => array(
        array(
            'key' => 'webinar_date',
            'value' => date('Ymd'),
            'compare' => '>='
        )
    )
);

					$webinars = get_posts( $webinar_args );

					foreach ($webinars as $webinar){
						$webinar_id         = $webinar->ID;
						$webinar_title      = $webinar->post_title;
						$webinar_location   = get_field('webinar_location', $webinar_id);
						$webinar_date       = get_field('webinar_date', $webinar_id);
						$webinar_time       = get_field('webinar_time', $webinar_id);
						$webinar_image      = get_field('webinar_banner_image', $webinar_id);
						$webinar_link       = get_post_permalink($webinar_id);
					}


	
/* $eventSection = get_field('upcoming_webinar_section');

$sectionHeading = $eventSection['section_heading'];
$eventBanner =  $eventSection['banner_image'];
$eventTitle =  $eventSection['event_title'];
$eventLocation =  $eventSection['event_location'];
$eventDay =  $eventSection['event_day'];
$eventTime =  $eventSection['event_time'];
$eventCTA = $eventSection['event_cta']; */


$sectionHeading = $webinar_title;
$eventBanner =  $webinar_image;
$eventTitle =  $webinar_title;
$eventLocation =  $webinar_location;
$eventDay =  $webinar_date;
$eventTime =  $webinar_time;
$eventCTA = 'REGISTER';

					
?>
<section class="upcoming-webinar">
	<div class="ast-container">
		<div class="ast-row">
			<h2 class="section-heading"><?php echo $sectionHeading ?></h2>
			<div class="ast-col-md-12">
				<div class="live-webinar">
					<div class="live-webinar-image">
						<img src="<?php echo $eventBanner ?>">
					</div>
					<div class="live-webinar-details">
						<div class="webinar-title">
							<h3><?php echo $eventTitle ?></h3>
						</div>
						<div class="location">
							<h4>Location</h4>
							<p><?php echo $eventLocation ?></p>
						</div>
						<div class="date">
							<h4>Date</h4>
							<p><?php echo $eventDay ?></p>
						</div>
						<div class="time">
							<h4>Time</h4>
							<p><?php echo $eventTime ?></p>
						</div>
						<div class="register">
							<h4>Register</h4>
							<p><a href="#"><?php echo $eventCTA ?><i class="fa fa-angle-right"></i></a></p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>

<!--?Upcoming Webinar Section-->
<div class="ast-container">
	<a href="https://teflinstitute.com/webinars/" class="btn-block-black">view more upcoming dates</a>
</div>

<!--Blogs Section-->

<section class="blogs-section">
	<div class="ast-container">
		<h2 class="section-heading"><!-- Filter --></h2>
		<div class="ast-row">
			<div class="ast-col-lg-12">
				<!-- <div class="filter-tabs">
					<div class="tabs">
						<a class="tablinks active" data-tab-target="#f1" href="#">Filter 1</a>
						<a class="tablinks" data-tab-target="#f2" href="#">Filter 2</a>
						<a class="tablinks" data-tab-target="#f3" href="#">Filter 3</a>
						<a class="tablinks" data-tab-target="#f4" href="#">Filter 4</a>
					</div>
				</div> -->

			</div>
		</div>
		<div class="ast-row">
			<?php

			$support_center_posts = get_field('support_center_posts');
			$images = get_field('support_center_card_images');
			$size = sizeof($support_center_posts);
			$img_idx = 0;
			$count = 1;
			$image1 = $images[0]['image'];
			foreach ($support_center_posts as $scposts) :

				$post_title         = get_the_title($scposts);
				$post_link          = get_the_permalink($scposts);
				$content_post       = get_post($scposts);
				$content_excerpt = strip_shortcodes($content_post->post_content);
				$content_excerpt = apply_filters('the_content', $content_excerpt);
				$content_excerpt = str_replace(']]>', ']]&gt;', $content_excerpt);
				$content_excerpt = strip_tags($content_excerpt);
				$content_excerpt = substr($content_excerpt, 0,250);
				//$excerpt_length = apply_filters( 'excerpt_length', 55 );
				//$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
				//$content_excerpt = wp_trim_words( $content_excerpt, $excerpt_length );
			?>
				<div class="ast-col-lg-4 ast-col-md-6 ast-col-sm-12">
					<div class="blog-item <?php if ($count == 3 || $count == 5 || $count == 7) {
														echo 'white-bg';
													} ?>" style="<?php if ($count % 2 == 0 and $count != 4) {
														$image = $images[$img_idx]['image'];
														echo "background-image: url($image)";
														$img_idx++;
													};
													if ($count == 3 || $count == 5 || $count == 7) {
														echo "background-color:#EDEDED";
													}

													?>">
						<div class="bolg-content">
							<h3 style="<?php if ($count == 3 || $count == 5 || $count == 7) {
											echo "color:#000";
										} ?>"><?php echo $post_title; ?></h3>
							<div class="support-excerpt" style="<?php if ($count == 3 || $count == 5 || $count == 7) {
																	echo "color:#000";
																} ?>"><?php echo $content_excerpt . "..."; ?></div>


						</div>
						<a class="card-link" style="<?php if ($count == 3 || $count == 5 || $count == 7) {
														echo "color:#000";
													} ?>" href="<?php echo $post_link; ?>">READ MORE <i class="fa fa-angle-right"></i></a>
						<?php $count++; ?>
					</div>
				</div>
			<?php
			endforeach; ?>
		</div>
	</div>
</section>

<!--/Blogs Section-->


<!--Test Section-->

<?php

$english_level_test = get_field('english_level_test');

$background_image   = $english_level_test['background_image'];
$title              = $english_level_test['title'];
$content_text       = $english_level_test['content_text'];
$button_text        = $english_level_test['button_text'];
$button_link        = $english_level_test['button_link'];

?>

<section class="test-section english-test-div">
	<div class="ast-container">
		<div class="ast-row">
			<div class="ast-col-md-12">
				<div class="take-the-test" style="background: url('<?php echo $background_image; ?>');">
					<div class="take-the-test-content">
						<h3><?php echo $title; ?></h3>
						<p><?php echo $content_text; ?></p>
						<a class="blog-link" href="<?php echo $button_link; ?>"><?php echo $button_text; ?> <i class="fa fa-angle-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--/Test Section-->


<?php
get_footer();
