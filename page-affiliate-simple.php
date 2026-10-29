<?php
/*
Template Name: Affiliate page (simple)
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Login, Affiliate Area, thank-you and terms pages: navy title band + content card, matching page-affiliate-v2.php.
wp_enqueue_style( 'ti-affiliate-v2-css', get_stylesheet_directory_uri() . '/assets/css/ti-affiliate-v2.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/ti-affiliate-v2.css' ), null );
add_filter( 'body_class', function ( $classes ) {
	$classes[] = 'ti-affiliate-simple';
	return $classes;
} );

get_header();

$page_id      = get_the_ID();
$is_affiliate = function_exists( 'affwp_is_affiliate' ) && affwp_is_affiliate();
$title        = get_the_title();
$lead         = '';
$layout       = 'prose';

if ( defined( 'TI_AFFILIATE_LOGIN_PAGE' ) && TI_AFFILIATE_LOGIN_PAGE === $page_id ) {
	$lead   = 'Log in to see your affiliate link, coupon code, creatives and earnings.';
	$layout = 'narrow';
} elseif ( defined( 'TI_AFFILIATE_AREA_PAGE' ) && TI_AFFILIATE_AREA_PAGE === $page_id ) {
	if ( $is_affiliate ) {
		$name   = wp_get_current_user()->first_name;
		$lead   = $name ? sprintf( 'Welcome back, %s. Your links, creatives and earnings are all here.', $name ) : 'Your links, creatives and earnings are all here.';
		$layout = 'wide';
	} else {
		$lead   = 'Log in to see your affiliate link, coupon code, creatives and earnings.';
		$layout = 'narrow';
	}
}
?>

<div class="tiav2 tiav2-simple tiav2-simple--<?php echo esc_attr( $layout ); ?>">

	<section class="tiav2-band">
		<div class="tiav2-wrap">
			<p class="tiav2-eyebrow">The TEFL Institute affiliate programme</p>
			<h1 class="tiav2-band__title"><?php echo esc_html( $title ); ?></h1>
			<?php if ( $lead ) : ?>
				<p class="tiav2-band__lead"><?php echo esc_html( $lead ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<section class="tiav2-simple__body">
		<div class="tiav2-wrap">
			<div class="tiav2-card tiav2-prose">
				<?php
				while ( have_posts() ) {
					the_post();
					the_content();
				}
				?>
			</div>
		</div>
	</section>

</div>

<?php
get_footer();
