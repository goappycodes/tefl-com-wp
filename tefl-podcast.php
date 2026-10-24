<?php
    // Template Name: TEFL Podcast

    if ( ! defined( 'ABSPATH' ) ) {
	    exit; // Exit if accessed directly.
    }

    get_header();
?>

    <div id="primary" <?php astra_primary_class(); ?>> 

        <?php get_template_part('template-parts/podcast/section','hero'); ?>

        <?php get_template_part('template-parts/podcast/section','podcast'); ?>

        <?php 
        get_template_part('template-parts/podcast/section','banner');
        ?>
        
    </div>
    
<?php
    get_footer();
?>