<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 

?>

	<div id="primary" <?php astra_primary_class(); ?>>
        <?php
            $heading = get_field('heading');
            $subheading = get_field('sub-heading');
            $details = get_field('details');
            // $support_center_posts = get_field('support_center_posts');
        ?>
		<section class="header-section">
            <div calss="ast-container">
                <div class="ast-row">
                    <div class="ast-col-lg-8">
                    <h1 class="section-heading"><?php echo $heading; ?></h1>
                
                    <p><?php echo $subheading; ?></p>
                    </div>
                </div>
           </div>
        </section>
        
        <section class="content-area">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-lg-12">
                        <p>
                            <?php echo $details; ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="nav-btns">
            <span class="nav-btn-prev"><a href="#"><i class="fa fa-angle-left"></i>previous</a></span>
            <span class="nav-btn-next"><a href="#">next<i class="fa fa-angle-right"></i></a></span>
        </div>

	</div>

<?php get_footer(); ?>
