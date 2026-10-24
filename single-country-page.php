<?php
/**
 * Template Name: country-page
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram Rana <bikram@appycodes.com>
 * @date August 2023
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();
?>

<div id="primary" <?php astra_primary_class(); ?>>

    <?php get_template_part('template-parts/country-page/section', 'hero'); ?>

    <?php get_template_part('template-parts/country-page/section', 'about'); ?>


    <?php 
    if(!is_page(102137)): 
    get_template_part('template-parts/country-page/section', 'review'); 
    endif;
    ?>
 
    <?php get_template_part('template-parts/country-page/section', 'details'); ?>

    <?php get_template_part('template-parts/country-page/section', 'after-course'); ?>
    
    <?php get_template_part('template-parts/country-page/section', 'explore-course'); ?>

    <?php 
    if(!is_page(102137)):
    get_template_part('template-parts/country-page/section', 'accredatation'); 
    endif;
    ?>

    <?php get_template_part('template-parts/country-page/section', 'faq'); ?>
    
</div>

<?php get_footer(); ?>