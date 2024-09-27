<?php
/**
* Template Name: Teach English Abroad
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php $hero = get_field('hero'); ?>
<section class="hero-section" style="background-image: url('<?php echo $hero['image']; ?>');">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col">
		        <div class="hero-inner">
    		        <h1><?php echo $hero['title']; ?></h1>
    		        <h2><?php echo $hero['subtitle']; ?></h2>
    		    </div>
		    </div>
		</div>
	</div>
</section>

<?php 


// $args = array(
// 	'posts_per_page'	=> -1,
// 	'post_type'		=> 'teach_english_abroad',
// 	'post_status'   => 'publish',
// 	'meta_key'			=> 'region_continent',
// 	'orderby'			=> 'meta_value',
// 	'order' 			=> ASC,	
// );

$continents = array('Europe','Southeast Asia','East Asia','South America','North America','Australia','Africa','Other Countries','Middle East','South Asia','Central Asia','Western Asia');
sort($continents);
foreach($continents as $continent):
	$args = array(
		'post_type'			=> 'teach_english_abroad',
		'posts_per_page'	=> -1, 
		'post_status'   => 'publish',
		'meta_query'		=> array(
			'relation'	=> 'AND',
			'continent' => array( 
				'key'		=> 'region_continent',
				'value'     =>	$continent,
			),
			'country' => array(
				'key'		=> 'country_name',
			),
		),
		'orderby'			=> array(
			'country'	=> 'ASC',
		),
	);

	$the_query = new WP_Query($args);
	?>
	<?php if($the_query->have_posts()): ?>
					<section class="jobs-section">
						<div class="ast-container">
							<div class="ast-row">
								<div class="ast-col-md-12">
									<h3 classs = "continent"><?php echo $continent?></h3>
								</div>
								<?php while($the_query->have_posts()) : $the_query->the_post(); ?>
									<div class="ast-col-md-4">
										<div class="job-inner">
											<div class="thumbnail" style="background-image: url('<?php the_post_thumbnail_url(); ?>');"></div>
											<div class="info">
												<div>
											<div class="country"><?php the_field('country_name');?></div>
											<div class="description">
												
												<?php 
												if (!empty(get_field('overview_description'))) {
													echo get_field('overview_description');
												} else {
													echo 'Read more about the fantastic TEFL job opportunity ' . get_field('country_name') . ' has to offer. We have explained everything in our ultimate guide to help you make the final decision if ' . get_field('country_name') . ' is a TEFL destination for you.';
												}												
												?>
											</div>
												<a href="<?php the_permalink(); ?>" class="link">Read <?php the_field('country_name'); ?> Guide</a>
											</div>
											<a href="" class="guide"></a>
											</div>	
										</div>
									</div>
								<?php endwhile; ?>
							</div>
						</div>
					</section>
		<?php endif; ?>
	<?php wp_reset_query(); ?>
<?php endforeach?>
<?php get_footer(); ?>