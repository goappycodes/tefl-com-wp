<?php

remove_filter( 'wp_robots', 'wp_robots_max_image_preview_large' );

add_action( 'wp_head', 'insert_custom_schema_output', 99);

function insert_custom_schema_output(){
	the_field('custom_schema');
}