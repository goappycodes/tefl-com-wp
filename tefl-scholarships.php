<?php

/**
 * Template Name: TEFL Scholarships
 * 
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Przemysław Solan <przemek.solan@tefl.ie>
 * @date 21/10/2021
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" class="content-area primary">
    
    <?php $hero = get_field('hero'); ?>
    
    <section class="hero" style="background-image: url('<?php echo $hero['background']; ?>');">
        
        <div class="ast-row">
            
            <div class="ast-col-md-12">
                
                <h1 class="hero__heading"><?php echo $hero['title']; ?></h1>
                
            </div>
            
        </div>
        
    </section>

    <?php $main = get_field('main'); ?>
    
    <section class="main">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-12">
                    <h3 class="main__heading"><?php echo $main['title']; ?></h3>
                    <h2 class="main__subheading"><?php echo $main['subtitle']; ?></h2>
                    <div class="main__course" style="background-image: url('<?php echo $main['course']['background']; ?>');">
                        <h4><?php echo $main['course']['title']; ?></h4>
                        <?php
                            $product_id = $main['course']['product'];
                            $product = wc_get_product($product_id);
                        ?>
                        <p>Worth <?php echo get_woocommerce_currency_symbol().$product->get_regular_price(); ?></p>
                        <a href="<?php echo $main['course']['link']; ?>">View Course</a>
                    </div>
                    <div class="main__description"><?php echo $main['description']; ?></div>
                    <div class="main__apply">
                        <h4>How to Apply for a TEFL Scholarship</h4>
                        <div class="box" style="background-image: url('<?php echo $main['apply']['image']; ?>');">
                            <div class="content"><?php echo $main['apply']['content']; ?></div>
                        </div>
                        <div class="description"><?php echo $main['apply']['description']; ?></div>
                    </div>
                    <div class="main__deadline">
                        <h4>Application Deadline: <?php echo $main['deadline']['date']; ?></h4>
                        <div class="container">
                            <div class="left">
                                <?php echo $main['deadline']['left_content']; ?>
                            </div>
                            <div class="right">
                                <?php echo $main['deadline']['right_content']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="main__legal">
                        <h4>Terms & Conditions</h4>
                        <div class="container">
                            <div class="">
                                <?php echo $main['legal']['terms']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="main__legal">
                        <h4>Privacy Policy</h4>
                        <div class="container">
                            <div class="">
                                <?php echo $main['legal']['privacy']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>