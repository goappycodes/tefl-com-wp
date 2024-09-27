<?php

//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-editor' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
    wp_deregister_style( 'wp-block-editor' );
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

   
/**
 * Disable WooCommerce block styles (back-end).
 */
function themesharbor_disable_woocommerce_block_editor_styles() {
  wp_deregister_style( 'wc-block-editor' );
  wp_deregister_style( 'wc-blocks-style' );
}
add_action( 'enqueue_block_assets', 'themesharbor_disable_woocommerce_block_editor_styles', 1, 1 );

add_action( 'wp_enqueue_scripts', 'dequeue_unused_scripts', 99 );

function dequeue_unused_scripts() {
    
    wp_dequeue_style('edwiserbridge_font_awesome');
    wp_deregister_style('edwiserbridge_font_awesome');
    wp_dequeue_style('wp-block-library');
    wp_deregister_style('wp-block-library');
    wp_dequeue_style('wc-block-style');
    wp_deregister_style('wc-block-style');
    wp_dequeue_style('wc-block-vendors-style');
    wp_deregister_style('wc-block-vendors-style');
    wp_dequeue_style('edwiserbridge');
    wp_deregister_style('edwiserbridge');
    wp_dequeue_style( 'pw-gift-slider-style');
    wp_deregister_style('pw-gift-slider-style');
    
    wp_dequeue_script( 'edwiserbridge');
    wp_dequeue_script( 'edwiserbridge-ui-block');
    wp_dequeue_script( 'wdmdatatablejs');
    wp_dequeue_script( 'pw-gift-slider-jquery');
    wp_dequeue_script( 'pw-gift-add-jquery');
    wp_dequeue_script( 'flash_sale_shortcodes_js');
    wp_dequeue_script( 'woocommerce_integration');
    wp_dequeue_script( 'pw-gift-add-jquery');
    wp_dequeue_script( 'pw-gift-add-jquery');
    
    
    wp_dequeue_style( 'wc-price-based-country-frontend' );
    wp_dequeue_style( 'affwp-forms' );

    if (is_front_page()){
        wp_dequeue_style( 'astra-contact-form-7' );        
    }
    
    if (!is_woocommerce() && !is_cart() && !is_checkout()){
        wp_dequeue_style( 'woocommerce-layout' );
        wp_dequeue_style( 'woocommerce-general' );
        wp_dequeue_style( 'woocommerce-smallscreen' );
        wp_dequeue_script( 'wc-add-to-cart');
        wp_dequeue_script( 'wc-cart-fragments');
    }
    
    
    
    
    
    
    
    if ( class_exists( 'woocommerce' ) ) {
        if (is_checkout()){
            wp_dequeue_style( 'select2' );
            wp_deregister_style( 'select2' );
            wp_dequeue_script( 'select2');
            wp_deregister_script('select2');
            wp_dequeue_script( 'selectWoo');
            wp_deregister_script('selectWoo');
            wp_dequeue_script( 'selectwoo');
            wp_deregister_script('selectwoo');
        }
    }
}
