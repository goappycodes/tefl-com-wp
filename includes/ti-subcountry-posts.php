<?php


// add_action('pre_get_posts', 'tefl_exclude_posts');
// Removed as its causing performance issues

function tefl_exclude_posts( $query ) {
    $country      = get_current_country();
    $gb_posts     = get_all_gb_only_posts();
    $za_posts     = get_all_za_only_posts();
    $hide_posts   = array_merge($gb_posts, $za_posts);
    $subcountries = [ 'GB', 'ZA' ];
    
    if(!current_user_can('administrator')) {
        if( !in_array($country, $subcountries) ) {
        	$query->set('post__not_in', $hide_posts);
    	} elseif( $country != 'GB' ) {
    	    $query->set('post__not_in', $gb_posts);
    	} elseif( $country != 'ZA' ) {
    	    $query->set('post__not_in', $za_posts);
    	}
    }
}


function get_all_gb_only_posts() {
    global $wpdb;
    $sql = "SELECT post_id FROM  $wpdb->postmeta WHERE meta_key = 'gb_post' AND meta_value = '1'";
    $posts = $wpdb->get_col($sql);
    return $posts;
}


function get_all_za_only_posts() {
    global $wpdb;
    $sql = "SELECT post_id FROM  $wpdb->postmeta WHERE meta_key = 'za_post' AND meta_value = '1' ";
    $posts = $wpdb->get_col($sql);    
    return $posts;
}