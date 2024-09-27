<?php

/**
 * Template Name: TI Extensions
 * 
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram Rana <bikramrana@appycodes.com>
 * @date 17th February 2023
 */

 if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" class="content-area primary">
    <section class="extension-products">
        <h1 class="section-heading">
        TEFL INSTITUTE <strong>COURSE EXTENSIONS</strong>
        </h1>
        <h4 class="section-subheadig">
        Sometimes things out of your control can delay studying.</br>We can extend your course – you choose how long for!
        </h4>
        <div class="ast-row">
            <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => 'extension',
                        )
                    )
                );
                
                $products = get_posts( $args );
                $products = array_reverse( $products );
                foreach($products as $product):
                    $product_id = $product->ID;
                    $wc_product = wc_get_product($product_id);
                    $product_title = $product->post_title;
                    if (strpos($product_title, 'Bonus') !== false) {
                        continue; 
                    }
                    $product_image = get_the_post_thumbnail_url($product_id, 'full');
                    $product_permalink = get_permalink($product_id);
                    $product_price = $wc_product->get_price_html();
                ?>
                <div class="ast-col-md-4 product-card__wrapper">
                    <div class="product-card">
                        <a href="<?php echo $product_permalink?>" class="clickbox"></a>
                        <div class="product-card__image">
                            <img src="<?php echo $product_image?>" alt=""/>
                        </div>
                        <div class="product-card__details">
                            <h3 class="product-card__title">
                                <?php echo $product_title?>
                            </h3>
                            <span class="product-card__price">
                                <?php echo $product_price?>
                            </span>
                        </div>
                    </div>
                    <a href="<?php echo $product_permalink?>" class="btn btn-black">Add to cart</a>
                </div>
                <?php
                    endforeach;
                ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>