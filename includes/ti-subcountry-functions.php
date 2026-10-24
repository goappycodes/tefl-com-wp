<?php

// add_filter( 'wpseo_opengraph_title', 'override_title_to_yoast_title', 99, 1 );
function override_title_to_yoast_title($title) {
    $post_id = get_the_ID();
    if ( !is_singular( 'post' ) && !is_singular( 'guide' ) ) {
        $yoast_title = get_post_meta($post_id, '_yoast_wpseo_title', true);
    }
    return $yoast_title ? $yoast_title : $title;
}


add_filter( 'wpseo_canonical', '__return_false' );


// add_action('wp_head', 'insert_canonical_tag', 1);

function insert_canonical_tag(){
    ?>  
    <!-- custom canonical -->
	<link rel="canonical" href="<?php echo get_current_canonical() ; ?>" />
    <?php
}

function get_current_canonical(){
    $current_url = explode("?", $_SERVER['REQUEST_URI']);
    return SEO_BASE_URL.$current_url[0];
}

/**
 * HTML <head> hooks
 *
 * Before 'wp_head';
 */
function tefl_lang_translation() {
	do_action( 'tefl_lang_translation' );
}


add_filter('language_attributes', 'ptefl_language_attributes');
function ptefl_language_attributes( $lang ){
    $country  = get_current_country();
    $language = 'en-'.$country;
    return 'lang="'.$language.'"';
}


add_filter( 'wpseo_locale', 'ptefl_redefine_locale' );
add_filter( 'locale', 'ptefl_redefine_locale', 10 );
function ptefl_redefine_locale( $locale ) {
    $country = get_current_country();
    $locale  = 'en_'.$country;
    return $locale;
}


add_action('tefl_lang_translation', 'tefl_lang_translation_meta');
function tefl_lang_translation_meta() {
    echo get_country_link_attribute();
}


function get_country_link_attribute() {
    $site_url        = site_url_without_cc();
    
    $request_url_cc  = $_SERVER['REQUEST_URI'];
    $request_url     = request_url_without_cc();

    $request_url_cc  = strtok($request_url_cc, "?");
    $request_url     = strtok($request_url, "?");


    $link            = get_country_link_html($site_url, $request_url);
    $link           .= get_current_country_link_html($site_url, $request_url_cc, $request_url);
    $link           .= get_default_link_html($site_url, $request_url);
    
    return $link;
}


function get_country_link_html( $site_url, $request_url ) {

    $link                   = '';
    $current_country        = get_current_country();
    $restrict_seo_folder    = get_field('restrict_seo_folder');
    // Treat an empty / never-saved field the same as 'none' (show in all folders).
    if ( empty( $restrict_seo_folder ) ) {
        $restrict_seo_folder = 'none';
    }
    
    if($restrict_seo_folder != 'none' ){
        if($restrict_seo_folder === 'all'){
            return $link;
        }
        $link .= sprintf( '<link rel="alternate" href="%s/%s%s" hreflang="en-%s" />' . "\n", $site_url, $restrict_seo_folder, $request_url, strtoupper($restrict_seo_folder) );
        return $link;
    }

    $subcountries    = TRANSLATED_COUNTRIES;
    
    if( is_subcountry_folder() ) {
        $link .= sprintf( '<link rel="alternate" href="%s%s" hreflang="en-US" />' . "\n", $site_url, $request_url );
    }
    
    if( $subcountries ) {
        foreach($subcountries as $country) {
            $country_code = strtoupper($country);
            if( $country_code != $current_country ) {
                $link .= sprintf( '<link rel="alternate" href="%s/%s%s" hreflang="en-%s" />' . "\n", $site_url, $country, $request_url, $country_code );
            }
        }
    }
    
    // $link .= sprintf( '<link rel="alternate" href="%s%s" hreflang="en" />' . "\n", $site_url, $request_url );

    return $link;
}


function get_current_country_link_html( $site_url, $request_url_cc, $request_url ) {
    $country = get_current_country();
    
    if( is_subcountry_folder() ) {
        $request_url = $request_url_cc;
    }
    
    $link = sprintf( '<link rel="alternate" href="%s%s" hreflang="en-%s" />' . "\n", $site_url, $request_url, $country );

    return $link;
}


function get_default_link_html( $site_url, $request_url ) {
    $link = sprintf( '<link rel="alternate" href="%s%s" hreflang="x-default" />' . "\n", $site_url, $request_url );
    return $link;
}


function has_lang_translation() {
    if( is_home() || is_front_page() || is_page('blog') || is_singular('post') || is_page('courses') || is_singular('courses') || is_page('internships') || is_singular('internships') || is_post_type_archive('guide') || is_singular('guide') ) {
        return true;
    }
    
    return false;
}


function is_subcountry_folder() {
    if ( SEO_LANG != 'us' ) {
        return true;
    }
    
    return false;
}

function get_current_country() {
    if( is_subcountry_folder() ) {
        $language        = SEO_LANG;
        $current_country = strtoupper($language);
        return $current_country;
    }
    return 'US';
}


function site_url_without_cc() {
    $country  = "/".strtolower(get_current_country());
    
    $site_url = site_url();
    $site_url = str_replace($country, "", $site_url);
    
    return $site_url;
}


function request_url_without_cc() {
    $country         = "/".strtolower(get_current_country());
    
    $request_url_cc  = $_SERVER['REQUEST_URI'];
    $request_url     = (strpos($request_url_cc, $country . "/") === 0 ? substr($request_url_cc, strlen($country)) : ($request_url_cc === $country ? "/" : $request_url_cc));
    
    return $request_url;
}


// add_filter( 'wpseo_canonical', 'ptefl_redefine_wpseo_canonical', 20 );
function ptefl_redefine_wpseo_canonical( $canonical ) {
    
    $site_url      = site_url();
    $request_url   = request_url_without_cc();
    
    if( is_subcountry_folder() ) {
        $canonical = $site_url.$request_url;
    }
    
    return $canonical;
}


add_filter( 'wpseo_opengraph_url', 'ptefl_redefine_wpseo_url', 20 );
function ptefl_redefine_wpseo_url( $url ) {
    
    $site_url      = site_url();
    $request_url   = request_url_without_cc();
    
    if( is_subcountry_folder() ) {
        $url = $site_url.$request_url;
    }
    
    return $url;
}


add_filter( 'wpseo_title','ptefl_change_wpseo_title' );
add_filter( 'wpseo_opengraph_title', 'ptefl_change_wpseo_title' );
function ptefl_change_wpseo_title( $title ) {

    global $post;
    
    if( is_subcountry_folder() && isset($post->ID) ) {
        $post_id = $post->ID;
        $cc      = strtolower(get_current_country());
        
        $page_title = get_field( 'page_title_'.$cc, $post_id );
      
        if( is_subcountry_folder() && !empty( $page_title ) ) {
            $title = __( $page_title, 'teflinstitute');
        }
    }
    
    return $title;
}


add_filter( 'wpseo_metadesc','ptefl_change_wpseo_desc' );
add_filter( 'wpseo_opengraph_desc', 'ptefl_change_wpseo_desc' );
function ptefl_change_wpseo_desc( $desc ) {
    
    global $post;
    
    if( is_subcountry_folder() && isset($post->ID) ) {
        $post_id = $post->ID;
        $cc      = strtolower(get_current_country());
        
        $page_desc = get_field( 'page_description_'.$cc, $post_id );
      
        if( is_subcountry_folder() && !empty( $page_desc ) ) {
            $desc = __( $page_desc, 'teflinstitute');
        }
    }
    
    return $desc;
}


function get_cfvalue_by_country($key) {
    if( is_subcountry_folder() ) {
        $cc = strtolower(get_current_country());
        $value = get_field($key.'_'.$cc);
        if(!$value) {
            $value = get_field($key);
        }
    } else {
        $value = get_field($key);    
    }
    
    return $value;
}

function get_repeater_cfvalue_by_country($repeater, $key) {
    $repeater_val = get_field($repeater);
    if( is_subcountry_folder() ) {
        $cc = strtolower(get_current_country());
        $value = $repeater_val[$key.'_'.$cc];
        if(!$value) {
            $value = $repeater_val[$key];
        }
    } else {
        $value = $repeater_val[$key];
    }
    
    return $value;
}


function get_group_cfvalue_by_country($group1, $group2, $key) {
    $main_group = get_field($group1);
    if( is_subcountry_folder() ) {
        $cc = strtolower(get_current_country());
        $value = $main_group[$group2][$key.'_'.$cc];
        if(!$value) {
            $value = $main_group[$group2][$key];
        }
    } else {
        $value = $main_group[$group2][$key];
    }
    
    return $value;
}

// add_filter( 'wpseo_schema_graph', 'change_image_urls_to_cdn', 10, 2 );
function change_image_urls_to_cdn( $data, $context ) {
    if ($_GET['asdsad']) {
        print_r($data); die();
    }
    foreach ( $data as $key => $value ) {
        // change to correct base url
        // use get_current_canonical()
    }
    return $data;
}