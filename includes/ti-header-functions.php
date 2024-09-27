<?php

// add_shortcode( 'custom-techno-mini-cart', 'custom_mini_cart' );

// function custom_mini_cart() { 
//     echo '<a href="#" class="dropdown-back" data-toggle="dropdown"> ';
//     echo '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
//     echo '<div class="basket-item-count" style="display: inline;">';
//         echo '<span class="cart-items-count count">';
//             echo WC()->cart->get_cart_contents_count();
//         echo '</span>';
//     echo '</div>';
//     echo '</a>';
//     echo '<ul class="dropdown-menu dropdown-menu-mini-cart">';
//     echo '<li> <div class="widget_shopping_cart_content">';
//             woocommerce_mini_cart();
//     echo '</div></li></ul>';

// }
       



add_action('astra_masthead_toggle_buttons_before', 'ti_mobile_header_insert_cart_btn_fn');

function ti_mobile_header_insert_cart_btn_fn(){
    //echo do_shortcode('[custom-techno-mini-cart]');
    echo '<div class="mobile-cart-btn-div"><a href="/cart"><img src="https://teflinstitute.com/wp-content/uploads/2021/12/cart-1.png"></a></div>';
}