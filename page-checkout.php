<?php /* Template Name: Checkout Template */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header(); ?>
<div id="primary" <?php astra_primary_class(); ?>>
    <?php echo do_shortcode('[woocommerce_checkout]'); ?>
</div><!-- #primary -->
<?php get_footer(); ?>
