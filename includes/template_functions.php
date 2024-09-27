<?php

function astra_get_footer_widget( $sidebar_id ) {

    if ( is_active_sidebar( $sidebar_id ) ) {
        ob_start();
        dynamic_sidebar( $sidebar_id );
        $output = ob_get_clean();
        echo preg_replace('#<script(.*?)>(.*?)</script>#is', '', $output);
    } elseif ( current_user_can( 'edit_theme_options' ) ) {

        global $wp_registered_sidebars;
        $sidebar_name = '';
        if ( isset( $wp_registered_sidebars[ $sidebar_id ] ) ) {
            $sidebar_name = $wp_registered_sidebars[ $sidebar_id ]['name'];
        }
        ?>
        <div class="widget ast-no-widget-row">
            <h2 class='widget-title'><?php echo esc_html( $sidebar_name ); ?></h2>
            <?php if ( is_customize_preview() ) { ?>
                <div class="customizer-navigate-on-focus" data-section="widgets" data-type="panel">
                    <?php Astra_Builder_UI_Controller::render_customizer_edit_button(); ?>
            <?php } ?>
                    <p class='no-widget-text'>
                        <a href='<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>'>
                            <?php esc_html_e( 'Click here to assign a widget for this area.', 'astra' ); ?>
                        </a>
                    </p>
            <?php if ( is_customize_preview() ) { ?>
                </div>
            <?php } ?>
        </div>
        <?php
    }
}


function astra_get_small_footer( $section = '' ) {

    $small_footer_type = astra_get_option( $section );
    $output            = null;

    switch ( $small_footer_type ) {
        case 'menu':
                $output = astra_get_small_footer_menu();
            break;

        case 'custom':
                $output = astra_get_small_footer_custom_text( $section . '-credit' );
            break;

        case 'widget':
                $output = astra_get_custom_widget( $section );
            break;
    }

    $output = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $output);
    return $output;
}


/* Template functions */
function get_user_geo_country_code()
{
    $cookie_name = 'user_country_code';
    $location = WC_Geolocation::geolocate_ip();
    return $location['country'];
}


function get_geo_logo($country)
{
    $logos = get_field('geo_logos', 'option');
    foreach ($logos as $logo) {
        if ($logo['country_code'] == $country) {
            return $logo['logo'];
        }
    }
    return "/wp-content/uploads/2023/06/TEFL-Logo_Institute.svg";
}

function get_call_details($country)
{
    $details = get_field('geo_logos', 'option');
    foreach ($details as $detail) {
        if (strcasecmp($detail['country_code'], $country) == 0) {
            return $detail['call_details'];
        }
    }
    return '<a href="tel:00442033185366">UK +44 203 318 5366</span></a>';
}

function get_lp_details($country)
{
    $details = get_field('geo_logos', 'option');
    foreach ($details as $detail) {
        if ($detail['country_code'] == $country) {
            return $detail['landing_page'];
        }
    }
}

add_action('wp_ajax_load_ajax_snippet', 'load_ajax_snippet_fn');
add_action('wp_ajax_nopriv_load_ajax_snippet', 'load_ajax_snippet_fn');

function load_ajax_snippet_fn()
{
    $snippet = $_POST['snippet'];
    include(get_stylesheet_directory() . "/ajax-snippets/$snippet.php");
    wp_die();
}


/**
 * WordPress function for redirecting users on login based on user role
 */

function affiliate_area_login_redirect($url, $request, $user)
{

    if (isset($_SERVER['HTTP_REFERER'])) {
        if (stripos($_SERVER['HTTP_REFERER'], 'affiliate') !== FALSE || is_page('affiliate-area')) {
            return 'https://teflinstitute.com/affiliate-area/';
        }
    }

    return $url;
}
add_filter('login_redirect', 'affiliate_area_login_redirect', 99, 3);


/**
 * Trim zeros in price decimals
 **/
add_filter('woocommerce_price_trim_zeros', '__return_true');

function get_current_url()
{
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "۸۰") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

// add_action('template_redirect', 'redirect_blog_path_if_missing');
function redirect_blog_path_if_missing()
{
    global $wp_rewrite;
    $url = get_current_url();

    if (is_singular('post') && strpos($url, '/blog/') === false) {
        $blog_url = get_the_permalink();
        wp_redirect($blog_url, 301);
        exit();
    }
}

function ti_posts_add_rewrite_rules($wp_rewrite)
{
    $new_rules = [
        'blog/page/([0-9]{1,})/?$' => 'index.php?post_type=post&paged=' . $wp_rewrite->preg_index(1),
        'blog/(.+?)/?$' => 'index.php?post_type=post&name=' . $wp_rewrite->preg_index(1),
    ];
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
    return $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'ti_posts_add_rewrite_rules');

function ti_posts_change_blog_links($post_link, $id = 0)
{
    $post = get_post($id);
    if (is_object($post) && $post->post_type == 'post') {
        return home_url('/blog/' . $post->post_name . '/');
    }
    return $post_link;
}
add_filter('post_link', 'ti_posts_change_blog_links', 1, 3);

add_filter('eb_register_post_type_courses', 'eb_register_post_type_courses_change_slug');

function eb_register_post_type_courses_change_slug($args)
{

    $args['rewrite']['slug'] = 'eb_courses';
    $args['public'] = false;

    return $args;
}

add_filter('Yoast\WP\SEO\post_redirect_slug_change', '__return_true');

add_filter('Yoast\WP\SEO\term_redirect_slug_change', '__return_true');


function woocommerce_button_proceed_to_checkout()
{ ?>
    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button button alt wc-forward">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="width: 20px;margin-right: 5px;">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
        </svg>
        <?php esc_html_e('Checkout Securely', 'woocommerce'); ?>
    </a>
    <?php
}



add_action('wp_footer', 'add_google_tag_thankyou_script', 10);

function add_google_tag_thankyou_script()
{

    if (is_checkout() && !empty(is_wc_endpoint_url('order-received'))) {
        $orderKey = isset($_GET['key']) ? sanitize_text_field($_GET['key']) : false;
        if ($orderKey) {
            $order = wc_get_order(wc_get_order_id_by_order_key($orderKey));
            if (!$order) {
                return false;
            }
        } else {
            return;
        }

        $order_id = $order->get_id();
        $order_total = $order->get_total();
        $order_currency = $order->get_currency();
        $current_user_id = get_current_user_id();

    ?>

        <script>
            var g_order_total = '<?php echo $order_total; ?>';
            var g_order_currency = '<?php echo $order_currency; ?>';
            var g_user_id = '<?php echo $current_user_id; ?>';
            var g_transaction_id = '<?php echo $order_id; ?>';

            gtag('event', 'conversion', {
                'send_to': 'AW-456043344/20eeCLyG9_oBENDWutkB',
                'value': g_order_total,
                'currency': g_order_currency,
                'transaction_id': g_transaction_id,
                'user_id': g_user_id
            });
        </script>

        <!-- new SA ads account by Ritesh -->
        <!-- Event snippet for Website sale conversion page -->
        <script>
            gtag('event', 'conversion', {
                'send_to': 'AW-11116325429/iFwpCMyFtJEYELXU1rQp',
                'transaction_id': g_transaction_id
            });
        </script>


    <?php
    }
}

function ahrefs()
{
    echo '<meta name="ahrefs-site-verification" content="77efc6782eae7f5fe34bd238cdde2d2ef56dc9bf666dc1a388adcc584449da1f">';
}
add_action('wp_head', 'ahrefs');

function clockdown_function($time)
{
    $timediff = strtotime($time) - time();
    // wp_enqueue_style('ti-header-timer-css');
    ob_start();
    if ($timediff > 0) :
    ?>

        <div class="tefl_countdown_timer">
            <input type="hidden" class="tefl_countdown_timer_value" value="<?php echo $time; ?>">
            <div class="clock">
                <div class="clock-day">
                    <div class="digit tenday">
                        <span class="base"></span>
                        <div class="flap over front"></div>
                        <div class="flap over back"></div>
                        <div class="flap under"></div>
                    </div>
                    <div class="digit day">
                        <span class="base"></span>
                        <div class="flap over front"></div>
                        <div class="flap over back"></div>
                        <div class="flap under"></div>
                    </div>
                </div>
                <div class="clock-hour">
                    <div class="digit tenhour">
                        <span class="base"></span>
                        <div class="flap over front"></div>
                        <div class="flap over back"></div>
                        <div class="flap under"></div>
                    </div>
                    <div class="digit hour">
                        <span class="base"></span>
                        <div class="flap over front"></div>
                        <div class="flap over back"></div>
                        <div class="flap under"></div>
                    </div>
                </div>
                <div class="clock-min">
                    <div class="digit tenmin">
                        <span class="base"></span>
                        <div class="flap over front"></div>
                        <div class="flap over back"></div>
                        <div class="flap under"></div>
                    </div>
                    <div class="digit min">
                        <span class="base"></span>
                        <div class="flap over front"></div>
                        <div class="flap over back"></div>
                        <div class="flap under"></div>
                    </div>
                </div>
                <div class="clock-sec">
                    <div class="digit tensec">
                        <span class="base"></span>
                        <div class="flap over front"></div>
                        <div class="flap over back"></div>
                        <div class="flap under"></div>
                    </div>
                    <div class="digit sec">
                        <span class="base"></span>
                        <div class="flap over front"></div>
                        <div class="flap over back"></div>
                        <div class="flap under"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    else :
    ?>
        <div class="tefl_countdown_timer">
            <input type="hidden" class="tefl_countdown_timer_value" value="<?php echo $time; ?>">
            <div class="clock">
                <div class="clock-day">
                    <div class="digit tenday">
                        <span class="base">0</span>
                    </div>
                    <div class="digit day">
                        <span class="base">0</span>
                    </div>
                </div>
                <div class="clock-hour">
                    <div class="digit tenhour">
                        <span class="base">0</span>
                    </div>
                    <div class="digit hour">
                        <span class="base">0</span>
                    </div>
                </div>
                <div class="clock-min">
                    <div class="digit tenmin">
                        <span class="base">0</span>
                    </div>
                    <div class="digit min">
                        <span class="base">0</span>
                    </div>
                </div>
                <div class="clock-sec">
                    <div class="digit tensec">
                        <span class="base">0</span>
                    </div>
                    <div class="digit sec">
                        <span class="base">0</span>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endif;
    return ob_get_clean();
}


/*Custom Banner Content*/

add_shortcode('geo_targetted_banner_content', 'geo_targetted_banner_content_fn');
function geo_targetted_banner_content_fn()
{
    $country = get_user_geo_country_code();
    $banner_content = get_geo_banner_content($country);
    $default_banner = get_field('geo-targeted_banner_content_default', 'option');
    ob_start();
    ?>
    <div class="geo_banner <?php echo $country ?>">
        <?php echo $default_banner; ?>
    </div>
    <?php
    return ob_get_clean();
}


function get_geo_banner_content($country)
{
    $geo_banners = get_field('geo-targeted_banner', 'option');
    $default_banner = get_field('geo-targeted_banner_content_default', 'option');
    foreach ($geo_banners as $geo_banner) {
        $country_codes = explode(',', $geo_banner['country_code']);
        $country_codes = array_map('trim', $country_codes);
        if ($country_codes && is_array($country_codes) && in_array($country, $country_codes)) {
            return $geo_banner['custom_banner_content'];
        }
    }
    return $default_banner;
}
/*Custom Banner Content*/


add_action('astra_main_header_bar_top', 'ti_header_fn');
function ti_header_fn()
{
    $country = array_key_exists('user_country_code', $_COOKIE) ? $_COOKIE['user_country_code'] : get_user_geo_country_code();
    $site_logo = get_geo_logo($country);
    $site_call_details = get_call_details($country);

    global $post;
    $current_post_id = get_the_ID();
    $hide_header_banner = get_field('hide_header_banner', 'option');
    $expiry_date = get_field('timer_expiry', 'option');
    $header_banner = get_field('banner', 'option');

    foreach ($header_banner as $hb) :

        $banner_text            = $hb['content'];
        $banner_styling         = $hb['banner_styling'];
        $banner_bg_color        = $banner_styling['banner_background_color'];
        $banner_text_color      = $banner_styling['banner_text_color'];
        $banner_text_font_size  = $banner_styling['banner_text_font_size'];

        $where_to_show          = $hb['where_to_show'] ? $hb['where_to_show'] : [];

        $show_clockdown         = $hb['show_clockdown'];

        $banner_logo            = $hb['banner_logo'];
        $banner_logo_link       = $hb['banner_logo_link'];

        $show_button            = $hb['show_button'];
        $banner_btn             = $hb['button'];
        $banner_btn_link        = $banner_btn['link'];
        $banner_btn_text        = $banner_btn['text'];
        $banner_btn_styling     = $hb['button_styling'];
        
        $btn_bg_color           = $banner_btn_styling['button_background_color'];
        $btn_text_color         = $banner_btn_styling['button_text_color'];
        $btn_text_size          = $banner_btn_styling['button_text_font_size'];

        if (in_array($current_post_id, $where_to_show) && !$hide_header_banner && !is_front_page() && !is_singular('course') && !is_page('79087')) : ?>
            <div style="background:<?php echo $banner_bg_color ?>" class="sales-offer-banner-mobile header-offer-banner">
                <div class="ast-container ast-flex ast-align-items-center">
                    <div class="ast-col-md-3 logo-timer-container">
                        <?php if ($show_clockdown) : ?>
                            <div class="banner-clock-text">Offer ends in:</div>
                            <div class="tefl_countdown_timer">
                                <?php echo clockdown_function($expiry_date); ?>
                            </div>
                        <?php else : ?>
                            <div class="promo-logo-container">
                                <a href="<?php echo $banner_logo_link ?>">
                                    <img src="<?php echo $banner_logo ?>" alt="">
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="<?php echo ($show_clockdown && $show_button) ? 'ast-col-md-6' : 'ast-col-md-6' ?> banner-content-container">
                        <div style="color:<?php echo $banner_text_color ?>; font-size:<?php echo $banner_text_font_size ?>px" class="mobile-offer-banner-text">
                            <?php echo $banner_text ?>
                        </div>
                    </div>
                    <div class="ast-col-md-3 cta-container">
                        <?php if ($show_button) : ?>
                            <a style="background:<?php echo $btn_bg_color ?>; color:<?php echo $btn_text_color ?> !important; font-size:<?php echo $btn_text_size ?>px" href="<?php echo $banner_btn_link ?>" class="cta-btn-white"><?php echo  $banner_btn_text ?></a>
                        <?php endif ?>
                    </div>

                    <a href="<?php echo $banner_btn_link ?>" class="banner-offer-overlay-link"></a>
                </div>
            </div><?php
                endif;
            endforeach; ?>

    <!-- Header Offer Banner -->
    <?php
    $clockdown = get_field('clockdown', 'option');
    $show_countdown_clock = get_field('show_countdown_clock', 'option');

    $clockdown_timestamp = strtotime($clockdown);
    $date_today = date('l, F d y h:i:s');
    $date_today_timestamp = strtotime($date_today);

    $banner_show = get_field('show_banner', 'options');
    $banner_content = get_field('banner_content', 'options');

    $color = get_field('banner_background_color', 'options');
    // $banner_content_url = get_field('banner_content_url', 'options'); 
    ?>

    <?php if (is_page_template('homepage.php') || is_single(array('47', '745', '838', '836', '743', '898', '58', '832', '825', '2704', '2816', '822', '820', '814', '812', '816', '809')) || is_page(array('6839', '901', '3905', '4786'))) {

        if ($banner_show && !isset($_GET['debug'])) {
            echo '<div class="banner-strip" style="background-color: ' . $color . ';">';
            echo '<div class="banner-strip-slider">';
            foreach ($banner_content as $ban_cont) :
                $banner_content_text = $ban_cont['content'];
                $banner_content_url = $ban_cont['content_url'];
                echo '<div class="slider-content-div"> ';
                if ($banner_content_url) {
                    echo '<a href="' . $banner_content_url . '">';
                }
                echo $banner_content_text;
                if ($banner_content_url) {
                    echo '</a>';
                }
                echo '</div>';
                if ($show_countdown_clock) {
                    echo clockdown_function($clockdown);
                }
            endforeach;
            echo '</div>';
            echo '</div>';
        }

        if ($banner_show && current_user_can('administrator') && isset($_GET['debug'])) {
            echo '<div class="banner-strip" style="background-color: ' . $color . ';">';
            echo '<div class="banner-strip-slider">';
            // foreach($banner_content as $ban_cont) :
            //     $banner_content_text = $ban_cont['content'];
            //     $banner_content_url = $ban_cont['url'];
            echo '<div class="slider-content-div"> ';
            echo '<strong> ⚡ SALE EXTENDED - ENDS MIDNIGHT THURSDAY 1 ⚡</strong>';
            //if($show_countdown_clock){
            echo clockdown_function($clockdown);
            //}
            echo '</div>';
            echo '<div class="slider-content-div"> ';
            echo '<strong> ⚡ SALE EXTENDED - ENDS MIDNIGHT THURSDAY 2 ⚡</strong>';
            // if($show_countdown_clock){
            echo clockdown_function($clockdown);
            // }
            echo '</div>';
            echo '<div class="slider-content-div"> ';
            echo '<strong> ⚡ SALE EXTENDED - ENDS MIDNIGHT THURSDAY 3 ⚡</strong>';
            // if($show_countdown_clock){
            echo clockdown_function($clockdown);
            // }
            echo '</div>';
            // endforeach;
            echo '</div>';
            echo '</div>';
        }
    } ?>

    <?php

    $banner = get_field('banner', 'options');
    $color = get_field('banner_background_color', 'options');

    foreach ($banner as $e) {
        $toggle = $e['toggle'];
        $content = $e['content'];
        $show_button = $e['show_button'];
        $button = $e['button'];
        $show_clockdown = $e['show_clockdown'];
        $clockdown = isset($e['clockdown']) ? $e['clockdown'] : "";
        $where_to_show = $e['where_to_show'];
        $where_to_show = $where_to_show ?? [];
        $clockdown_timestamp = strtotime($clockdown);
        $date_today = date('l, F d y h:i:s');
        $date_today_timestamp = strtotime($date_today);
        if ($clockdown_timestamp < $date_today_timestamp) {
            $toggle = false;
        }
        if ($toggle) { ?>
            <?php foreach ($where_to_show as $e) :
                $id = $e->ID;
                if (is_single($id) || is_page($id)) : ?>
                    <div class="banner" style="background-color: <?php echo $color; ?>;">
                        <div class="ast-container">
                            <?php if ($show_clockdown) { ?>
                                <div class="clockContainer">
                                    <div class="offer">Offer ends in:</div>
                                    <?php echo clockdown_function($clockdown); ?>
                                </div>
                            <?php } ?>
                            <div class="content">
                                <?php echo $content; ?>
                            </div>
                            <?php if ($show_button) { ?>
                                <div class="cta">
                                    <a href="<?php echo $button['link']; ?>"><?php echo $button['text']; ?></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

    <?php }
    }

    ?>
    <div class="primary-menu-container">
        <div class="ast-container">
            <div class="ast-row">
                <?php
                $country = get_user_geo_country_code();
                $site_logo = get_geo_logo($country);

                ?>
                <div data-country="<?php echo $country ?>" class="primary-menu-wrapper">
                    <div class="ast-col-md-3">
                        <div class="ti-logo">
                            <a href="<?php echo "/";
                                        echo is_subcountry_folder() ? strtolower(get_current_country()) . "/" : ""; ?>">
                                <img width="160" height="72" src="/wp-content/uploads/2023/06/TEFL-Logo_Institute.svg">
                            </a>
                        </div>
                    </div>
                    <div class="ast-col-md-7">
                        <?php $primary_header_menu_items = get_field('primary_header_menu_items', 'option'); ?>
                        <div class="top-bar-links">
                            <div class="links">
                                <?php foreach ($primary_header_menu_items as $key => $menu_item) :
                                    $menu_item_text = $menu_item['menu_text'];
                                    $menu_item_link = $menu_item['menu_link'];
                                ?>
                                    <div class="primary-menu-link__wrapper">
                                        <a class="primary-menu-link" href="<?php echo $menu_item_link ?>">
                                            <?php echo $menu_item_text ?>
                                        </a>
                                    </div>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="ast-col-md-2">
                        <div class="header-cta-icons">
                            <div class="search-input-container">
                                <form action="<?php echo get_home_url(); ?>" method="GET">

                                    <img class="search-icon" src="/wp-content/uploads/2023/05/search-icon.svg" alt="">
                                    <div class="search-input-field-wrapper hidden">
                                        <input name="s" type="text" placeholder="Search" class="search-input-field">
                                        <img class="search-submit-icon" src="/wp-content/uploads/2023/05/search-icon.svg" alt="">
                                    </div>

                                </form>
                            </div>
                            <div style="display:none" class="country-selector-icon-container">
                                <?php $geo_logo  = get_field('geo_logos', 'options');
                                ?>

                                <a class="choose-country">
                                    <i><img src="/wp-content/uploads/2023/05/globe-icon.svg" alt=""></i>
                                </a>

                                <ul name="ti_country_selector" id="ti_country_selector" class="ti-country-selector">
                                    <?php foreach ($geo_logo as $gl) {
                                        $cnt_url = $gl['landing_page'];
                                        $cnt_url = get_permalink($cnt_url);
                                        $cc = $gl['country_code'];
                                        $cname = WC()->countries->countries[$cc];
                                        $cc_l = strtolower($cc);
                                        $current_cc = get_current_country();
                                        $current_cc_l = '/' . strtolower($current_cc) . '/';
                                        $cnt_url_without_cc = str_replace($current_cc_l, "", $cnt_url);
                                    ?>

                                        <li value="<?php echo $cc; ?>" title="<?php echo $cname; ?>">
                                            <a class='country-link' data-call-details='<?php echo json_encode(array('html' => $site_call_details)) ?>' href="/"><img src="https://flagcdn.com/w20/<?php echo $cc_l; ?>.png"><?php echo $cname; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="student-login-icon-container">
                                <a target="_blank" href="/my-account/">
                                    <img src="/wp-content/uploads/2023/05/user-icon.svg" alt="">
                                </a>
                            </div>
                            <div class="cart-icon-container">
                                <a href="/cart/">
                                    <img src="/wp-content/uploads/2023/05/cart-icon.svg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="top-bar-search-mobile" style="display:none;">
        <div class="search-input">
            <form action="<?php echo get_home_url(); ?>" method="GET">
                <button class="search" type="submit">
                    <i class="fa fa-search"></i>
                </button>
                <input name="s" type="text" placeholder="SEARCH">
            </form>
        </div>
    </div>

    <div class="location-contact">
        <div class="ast-container">
            <div class="ast-row">
                <div class="links">
                    <a href="#">LOCATION</a>
                    <a href="/contact-us/">CONTACT US</a>
                </div>
            </div>
        </div>
    </div>

<?php
}

function add_base_to_menu_link($link)
{
    if (strpos($link, 'teflinstitute.com') === false) {
        $link = get_home_url() . $link;
    } else {
        $link = str_replace('https://teflinstitute.com', get_home_url(), $link);
    }

    return $link;
}

add_action('astra_main_header_bar_bottom', 'new_mega_menu');

function new_mega_menu()
{

    $country = get_current_country();
    $mega_menu_meta = 'teflcom_mega_menu_' . $country;


    $saved_mega_menu = get_transient($mega_menu_meta);
    if ($saved_mega_menu) {
        echo '<!-- Mega menu served from Transient ' . $mega_menu_meta . ' -->';
        echo $saved_mega_menu;
        return '';
    }

    $mega_menu_new = get_field('mega_menu_items', 'option');
    ob_start();
?>
    <div class="ti-mega-menu-new main-menu-bar">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col ti-mega-menu-container ast-col-md-12">
                    <div class="ti-mega-menu ast-flex">
                        
                        <div class="d-none ast-col ti-menu-item">
                            <a class="primary-menu-link bf-link gift-voucher-link" href="/january-tefl-course-sale/">
                                <img src="/wp-content/uploads/2024/01/Jan_sale_TI_1.gif" alt="">
                            </a>
                        </div>
                        <?php $count = 0;
                        foreach ($mega_menu_new as $index => $mm) {
                            $count++; ?>
                            <?php
                            $has_cta_block = $mm['has_cta_block'];
                            $has_sub_menu = $mm['has_sub_menu'];
                            $menu_link = $mm['menu_link'];
                            ?>
                            <div class="ast-col ti-menu-item <?php if ($has_sub_menu || $has_cta_block) echo "has-children"; ?>">
                                <?php if ($menu_link) : ?>
                                    <span><a class="menu-link" href="<?php echo $mm['menu_link']; ?>"><?php echo $mm['menu_title']; ?></a></span>
                                <?php else : ?>
                                    <span><?php echo $mm['menu_title']; ?></span>
                                <?php endif; ?>
                                <?php if ($has_sub_menu) {
                                    $sub_menu = $mm['sub_menu'];
                                    $sub_menu_has_cta_block = $mm['sub_menu_has_cta_block'];
                                    $cta_block = $mm['cta_block'];
                                    $menu_has_extra_links = $mm['menu_has_extra_links'];
                                    if (is_countable($sub_menu)) {
                                        $count_sub_menu = count($sub_menu);
                                        $col_div =  12 / $count_sub_menu;
                                        if ($sub_menu) { ?>
                                            <div class="ast-row ti-sub-menu-item sub-menu-count<?php echo $count; ?>">
                                                <div class="column-wrapper">
                                                    <?php if ($sub_menu_has_cta_block) : ?>
                                                        <div class="ast-col-md-3 sub-menu-left">
                                                            <div class="static-menu-content">
                                                                <?php
                                                                if ($cta_block === 'elt') {
                                                                    echo do_shortcode('[elt_block]');
                                                                } elseif ($cta_block === 'salary-calculator') {
                                                                    echo do_shortcode('[salary_calculator_block]');
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="ast-col-md-9 sub-menu-right-col">
                                                            <div class="ast-row sub-menu-right-inner-row">
                                                                <?php
                                                                $col_count = 1;
                                                                foreach ($sub_menu as $sm) {
                                                                    $sub_menu_head = $sm['sub_menu_header'];
                                                                    $sub_menu_content = $sm['sub_menu_item'];
                                                                    if ($col_count === 4) :
                                                                ?>
                                                                        <div class="ast-col-md-12">
                                                                            <div class="row-separator <?php echo $col_div ?>"></div>
                                                                        </div>
                                                                    <?php endif ?>
                                                                    <div class="ast-col-md-4" <?php echo $col_count; ?> <?php echo $count_sub_menu ?>>
                                                                        <ul>
                                                                            <div class="sub-menu-head"><?php echo $sub_menu_head; ?></div>
                                                                            <?php foreach ($sub_menu_content as $sbc) {
                                                                                $is_heading = isset($sbc['is_heading']) ? $sbc['is_heading'] : false;
                                                                                $sub_menu_title = $sbc['sub_menu_title'];
                                                                                $sub_menu_link = $sbc['sub_menu_link'];
                                                                                $css_classes = $sbc['css_classes'];
                                                                                
                                                                                if ($is_heading) : ?>
                                                                                    <div class="sub-menu-head <?php echo $css_classes; ?>"><?php echo $sub_menu_title; ?></div>
                                                                                <?php else : ?>
                                                                                    <li class="sub-menu-item <?php echo $css_classes; ?>">
                                                                                        <a <?php echo $add_custom_style ? 'style="background:' . $sm_bg_color . ';color:' . $sm_text_color . '"' : ''; ?> class="sub-menu-link" href="<?php echo $sub_menu_link; ?>">
                                                                                            <?php echo $sub_menu_title; ?>
                                                                                        </a>
                                                                                    </li>
                                                                                <?php endif; ?>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    </div>
                                                                    <?php
                                                                    if (($col_count === $count_sub_menu) && ($menu_has_extra_links)) :
                                                                        $extra_sub_menu = $mm['extra_sub_menu'];
                                                                    ?>
                                                                        <div class="ast-col-md-4 extra-sub-menu-item">
                                                                            <?php
                                                                            foreach ($extra_sub_menu as $esm) :
                                                                                $sub_menu_head = $esm['sub_menu_header'];
                                                                                $esm_content = $esm['sub_menu_item'];
                                                                            ?>
                                                                                <ul>
                                                                                    <div class="extra-sub-menu-head"><?php echo $sub_menu_head; ?></div>
                                                                                    <?php foreach ($esm_content as $esmc) {
                                                                                        $is_heading = isset($esmc['is_heading']) ? $esmc['is_heading'] : false;
                                                                                        $sub_menu_title = $esmc['sub_menu_title'];
                                                                                        $sub_menu_link = $esmc['sub_menu_link'];
                                                                                        $css_classes = $esmc['css_classes'];
                                                                                        if ($is_heading) : ?>
                                                                                            <div class="sub-menu-head <?php echo $css_classes; ?>"><?php echo $sub_menu_title; ?></div>
                                                                                        <?php else : ?>
                                                                                            <li class="sub-menu-item <?php echo $css_classes; ?>"><a class="sub-menu-link custom" href="<?php echo $sub_menu_link; ?>"><?php echo $sub_menu_title; ?></a></li>
                                                                                        <?php endif; ?>
                                                                                    <?php } ?>
                                                                                </ul>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    <?php endif ?>
                                                                <?php
                                                                    $col_count += 1;
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>

                                                        <?php foreach ($sub_menu as $sm) {

                                                            $sub_menu_head = $sm['sub_menu_header'];
                                                            $sub_menu_content = $sm['sub_menu_item']; ?>
                                                            <div class="ast-col-md-3" <?php echo $count; ?>>
                                                                <ul>
                                                                    <div class="sub-menu-head"><?php echo $sub_menu_head; ?></div>
                                                                    <?php foreach ($sub_menu_content as $sbc) {
                                                                        $is_heading = isset($sbc['is_heading']) ? $sbc['is_heading'] : false;
                                                                        $sub_menu_title = $sbc['sub_menu_title'];
                                                                        $sub_menu_link = $sbc['sub_menu_link'];
                                                                        $css_classes = $sbc['css_classes'];
                                                                        $title_has_icon = $sbc['title_has_icon'];
                                                                        $menu_title_icon = $sbc['menu_title_icon'];
                                                                        $link_has_label = $sbc['link_has_label'];
                                                                        $label_text = $sbc['label_text'];
                                                                        $add_custom_style = $sbc['add_custom_style'];
                                                                        if($add_custom_style){
                                                                            $custom_style = $sbc['custom_style'];
                                                                            $sm_bg_color = $custom_style['background_color'];
                                                                            $sm_text_color = $custom_style['text_color'];
                                                                        }
                                                                        if ($is_heading) : ?>
                                                                            <div class="sub-menu-head <?php echo $css_classes; ?>"><?php echo $sub_menu_title; ?></div>
                                                                        <?php else : ?>
                                                                            <li class="sub-menu-item <?php echo $css_classes; ?>">
                                                                                <a <?php echo $add_custom_style ? 'style="background:' . $sm_bg_color . ';color:' . $sm_text_color . '"' : ''; ?> href="<?php echo $sub_menu_link; ?>">
                                                                                    <?php if ($title_has_icon == 1) : ?>
                                                                                        <span class="menu-icon">
                                                                                            <img src="<?php echo $menu_title_icon; ?>" />
                                                                                        </span>
                                                                                    <?php endif; ?>
                                                                                    <?php echo $sub_menu_title; ?>
                                                                                </a>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        <?php } ?>
                                                    <?php endif; ?>

                                                    <?php include('mega_menu_CTA_buttons.php'); ?>
                                                </div>

                                            </div>
                                <?php }
                                    }
                                } ?>
                                <?php if ($has_cta_block) {
                                    $menu_cta_block    = $mm['menu_cta_block'];
                                    $left_block        = $menu_cta_block['left_block'];
                                    $block_title       = $left_block['block_title'];
                                    $left_cta_buttons  = $left_block['cta_buttons'];
                                    $right_block       = $menu_cta_block['right_block'];
                                    $right_cta_buttons = $right_block['cta_buttons'];
                                ?>
                                    <div class="ast-row ti-sub-menu-item">
                                        <div class="column-wrapper has-cta-block">
                                            <div class="ast-col-md-8 block-left">
                                                <h3 class="block-title block-title-bold"><?php echo $block_title ?></h3>
                                                <?php include('country_guides_menu_links.php') ?>
                                            </div>
                                            <div class="ast-col-md-4">
                                                <div class="block-right">
                                                    <?php 
                                                    foreach($left_cta_buttons as $cta_button):
                                                        $btn_image = $cta_button['button_imageicon'];
                                                        $btn_text  = $cta_button['button_text'];
                                                        $btn_link  = $cta_button['button_link'];  
                                                        $btn_bg_color = $cta_button['button_background_color'];
                                                        $btn_text_color = $cta_button['button_text_color'];
                                                        $btn_text_font_size = $cta_button['button_text_size']; 
                                                    ?>
                                                        <a style="color:<?php echo $btn_text_color.' !important'?>; font-size:<?php echo $btn_text_font_size?>px; background:<?php echo $btn_bg_color?>" href="<?php echo $btn_link?>" href="<?php echo $btn_link?>" class="cta-link">
                                                            <img src="<?php echo $btn_image?>" alt="" class="btn-img"/>
                                                            <span class="btn-text"><?php echo $btn_text?></span>
                                                        </a>
                                                    <?php 
                                                    endforeach;
                                                    ?>
                                                </div>
                                            </div>
                                            <?php include('mega_menu_CTA_buttons.php'); ?>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    $mega_menu = ob_get_clean();
    set_transient($mega_menu_meta, $mega_menu, WEEK_IN_SECONDS);
    echo $mega_menu;
}

// Delete transient if Mega menu is updated

add_action('acf/save_post', 'delete_mega_menu_transient', 5);

function delete_mega_menu_transient($post_id)
{
    if ($post_id !== 'options') {
        return;
    }

    $values = isset($_POST['acf']) ? $_POST['acf'] : array();

    $field_key = 'field_633fdb7aaf8f9';
    if (isset($values[$field_key])) {
        global $wpdb;
        error_log('Mega Menu transient deleted');
        $wpdb->query($wpdb->prepare("DELETE FROM `wp_options` WHERE `option_name` LIKE %s", '_transient_teflcom_mega_menu_%'));
    }
}





add_action('wp_footer', 'insert_gtag_code');
function insert_gtag_code()
{

?>
    <!-- Snippet for website call tracking -->
    <script>
        gtag('config', 'AW-456043344/jfdVCO6e4foBENDWutkB', {
            'phone_conversion_number': '0131 618 8798'
        });
    </script>

    <?php if (is_page(4195)) { ?>
        <!-- Event snippet for Submit lead form conversion page -->
        <script>
            gtag('event', 'conversion', {
                'send_to': 'AW-456043344/DqmxCIm59_oBENDWutkB'
            });
        </script>
    <?php }
}

/* woocommerce email as username */
add_filter('woocommerce_new_customer_data', function ($data) {
    $data['user_login'] = $data['user_email'];

    return $data;
});


// function get_user_geo_country_code(){
//     // $geo      = new WC_Geolocation(); // Get WC_Geolocation instance object
//     // $user_ip  = $geo->get_ip_address(); // Get user IP
//     // $user_geo = $geo->geolocate_ip( $user_ip ); // Get geolocated user data.
//     // $country  = $user_geo['country']; // Get the country code
//     $location = WC_Geolocation::geolocate_ip();
//     $country = $location['country'];
//     return $country; // return the country name
// }


// Hook in
// add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields($fields)
{
    $fields['billing']['billing_dob']['type'] = 'date';
    return $fields;
}


add_shortcode('custom_cert_identifier', 'custom_cert_identifier_fn');
function custom_cert_identifier_fn()
{
    ob_start();
    if (isset($_POST['certificate_number'])) {
        $certnumber = $_POST['certificate_number'];
        $certresults = wp_remote_get("https://courses.teflinstitute.com/verifycert.php?code=" . $certnumber);
        if ($certresults) {
            $certresults_array = json_decode($certresults['body'], true);
            if ($certresults_array['success'] == "true") {
                foreach ($certresults_array['issues'] as $issue) {
                    echo '<span style="background: #5C8F92;color: #fff;padding: 5px 20px;line-height: 1;display: inline-block;line-height: 1.4;" class="validcert">Verified - ' . $issue['firstname'] . " " . $issue['lastname'] . " completed " . $issue['coursefullname'] . '</span><br/>';
                }
            } else {
                echo '<span style="background: rgba(255,0,0,0.6); color: #fff; padding: 5px 20px; line-height: 1;" class="invalidcert">Not verified</span>';
            }
        }
    }
    ?>
    <form method="POST">
        <div style="display: flex; margin: 20px 0;" class="custom_cert_identifier_container">
            <input placeholder="Enter Certificate Number" type="text" name="certificate_number" id="certificate_number" value="<?php echo isset($_POST['certificate_number']) ? $_POST['certificate_number'] : "" ?>" />
            <input type="submit" value="Check" name="certificate_number_submit" id="certificate_number_submit" />
        </div>
    </form>
<?php
    return ob_get_clean();
}


function time_to_decimal($time)
{
    $timeArr = explode(':', $time);
    $decTime = ($timeArr[0] * 60) + ($timeArr[1]) + ($timeArr[2] / 60);

    return $decTime;
}

function ptefl_convert_utc_time($date)
{
    // return $date;
    // TEMP FIX

    $time_difference = isset($_COOKIE['offset']) ? $_COOKIE['offset'] : '';

    if (isset($_GET['offset'])) {
        $time_difference = time_to_decimal($_GET['offset']);
        setcookie("offset", $time_difference);
    }
    if ($time_difference != '') {
        $time = strtotime($date);
        $time = $time + ($time_difference * 60); //minutes * 60 seconds
        $date = date("H:i a", $time);
    } //on failure of js, default timezone is set as UTC below
    return $date;
}



function ti_time_to_decimal($time)
{
    $timeArr = explode(':', $time);
    $decTime = $timeArr[0] * 60 + $timeArr[1] +  (isset($timeArr[2]) ? $timeArr[2] : 0) / 60;
    return $decTime;
}

function ti_convert_utc_time($date, $offset = "00:00")
{
    $time_difference = ti_time_to_decimal($offset);
    if ($time_difference != '') {
        $time = strtotime($date);
        $time = $time + ($time_difference * 60); //minutes * 60 seconds
        $date = date("g:i a", $time);
    } //on failure of js, default timezone is set as UTC below
    return $date;
}


function ptefl_utc_timezone_name()
{

    // return '';
    // TEMP FIX

    $timezone_name = "";
    $timezone_offset_minutes = isset($_COOKIE['offset']) ? $_COOKIE['offset'] : '';


    if ($timezone_offset_minutes != '') {
        $timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes * 60, 0);
    }

    return $timezone_name;
}



/*GDPR COOKIE*/
//add_action('wp_footer', 'tefl_cookie_policy');
function tefl_cookie_policy()
{ ?>
    <div id="tefl_cookie_bar">
        <span>This website uses cookies to improve your experience.
            <a id="tefl_cookie_close" class="tefl_cookie_action">Accept</a>
            We'll assume you're ok with this, but you can opt-out if you wish.
            <a href="<?php site_url(); ?>/privacy-policy" target="_blank" class="tefl_cookie_read_more">Read More</a>
        </span>
    </div>
    <?php  }

function ts_email_header($email_heading, $email)
{

    $product_id = 14499; // Product ID of English Level Test

    $email_heading = 'Thanks for trying out our English Level Test';

    return $email_heading;
}

// add_action( 'woocommerce_email_heading_customer_completed_order', 'ts_email_header', 10, 2 );

// Set the product discount amount to zero
// add_filter('woocommerce_coupon_get_discount_amount', 'zero_discount_for_excluded_products', 12, 5);

function zero_discount_for_excluded_products($discount, $discounting_amount, $cart_item, $single, $coupon)
{
    $product_id = $cart_item['product_id'];
    $disable_coupon_code = get_field('disable_coupon_code', $product_id);

    // Check if the product has the 'exception' custom field set
    $exception_coupon = get_field('exception', $product_id);

    if ($exception_coupon && in_array($coupon->get_code(), explode(',', $exception_coupon))) {
        return $discount;
    }

    if ($disable_coupon_code) {
        $discount = 0;
        wc_add_notice(__('Coupon not applicable to this product.'), 'error');
    }

    return $discount;
}


function getYouTubeVideoId($pageVideUrl)
{
    $link = $pageVideUrl;
    $video_id = explode("?v=", $link);
    if (!isset($video_id[1])) {
        $video_id = explode("youtu.be/", $link);
    }
    $youtubeID = $video_id[1];
    if (empty($video_id[1])) $video_id = explode("/v/", $link);
    $video_id = explode("&", $video_id[1]);
    $youtubeVideoID = $video_id[0];
    if ($youtubeVideoID) {
        return $youtubeVideoID;
    } else {
        return false;
    }
}

add_filter('woocommerce_admin_reports', 'custom_tab');
function custom_tab($reports)
{
    $sales_by_country = array(
        'report_currency' => array(
            'title' => __('Change to EUR', 'woocommerce'),
            'description' => 'WooCommerce Change Report to Euro',
            'hide_title' => true,
            'callback' => array('wc_admin_orders_customers', 'change_report_to_euros')
        ),
    );

    if (isset($reports['orders']['reports'])) {
        $reports['orders']['reports'] = array_merge($reports['orders']['reports'], $sales_by_country);
    }

    return $reports;
}

/* SHOW REPORTS IN EUR CURRENCY */
add_filter('admin_head', 'report_currency_js');
function report_currency_js()
{
    if ((isset($_GET['page'])) && ($_GET['page'] == 'wc-reports')) {
        $base_currency = wcpbc_get_base_currency();
        $rates         = WCPBC_Pricing_Zones::get_currency_rates();
        $rates_string  = array();
        foreach ($rates as $currency => $rate) {
            if ($currency == 'EUR') {
                $euro_rate = $rate;
            }
        }
    ?>
        <script>
            jQuery(document).ready(function($) {
                $('.subsubsub a[href*="report_currency"]').click(function() {
                    event.preventDefault();
                    if (!$(this).hasClass("converted")) {
                        $(this).addClass("converted");
                        $(this).text("Change to USD");
                        $("span.woocommerce-Price-amount.amount").each(function() {
                            var value = Number($(this).text().replace(/[^0-9.-]+/g, ""));
                            var converted_value = value * parseFloat(<?php echo $euro_rate; ?>);
                            var converted = '<span class="woocommerce-Price-currencySymbol">&euro;</span>' + converted_value.toFixed(2);
                            $(this).html(converted);
                            console.log(converted);
                        });
                    } else {
                        $(this).removeClass("converted");
                        $(this).text("Change to EUR");
                        $("span.woocommerce-Price-amount.amount").each(function() {
                            var value = Number($(this).text().replace(/[^0-9.-]+/g, ""));
                            var converted_value = value / parseFloat(<?php echo $euro_rate; ?>);
                            var converted = '<span class="woocommerce-Price-currencySymbol">$</span>' + converted_value.toFixed(2);
                            $(this).html(converted);
                        });
                    }
                });
            });
        </script>
        <style>
            body.wp-admin.woocommerce_page_wc-reports .nav-tab-wrapper {
                display: flex;
            }

            body.wp-admin.woocommerce_page_wc-reports a.nav-tab[href*="report_currency"],
            body.wp-admin.woocommerce_page_wc-reports a.nav-tab[href*="report_currency"]:hover,
            body.wp-admin.woocommerce_page_wc-reports a.nav-tab[href*="report_currency"]:focus,
            body.wp-admin.woocommerce_page_wc-reports a.nav-tab[href*="report_currency"]:active {
                order: 2;
                background: none;
                border: none;
                color: blue;
                text-decoration: underline;
                outline: none;
                box-shadow: none;
            }
        </style>
    <?php

    }
}

/* Master Class SHORTCODE */
add_shortcode('video_masterclass_sc', 'video_masterclass_sc_fn');
function video_masterclass_sc_fn()
{ ?>
    <section class="tefl-brochure">
        <div class="ast-row">
            <div class="ast-col-md-12">
                <h1 class="section-heading">Video Masterclass | Creating Your Mini Demo Lesson</h1>
            </div>
        </div>
        <div class="ast-row tefl-brochure__container">
            <div class="ast-col-md-6 tefl-brochure__image">
                <img src="/wp-content/uploads/2021/12/Demo-video-1-1.jpeg" alt="">
            </div>
            <div class="ast-col-md-6 tef-brochure__content">
                <p>About to start your brand-new and exciting career teaching English online? Learn everything you need to know about making a high quality mini demo lesson that will impress recruiters and get you hired quickly. Sign up to receive your free masterclass including sample lesson slides.</p>
                <div class="tefl-brochure__form">
                    <?php echo do_shortcode('[contact-form-7 id="57456" title="Video Masterclass"]'); ?>
                </div>
            </div>
        </div>
    </section>
    <style>
        .section-heading {
            font-size: 1.25rem !important;
            text-align: center;
            letter-spacing: 0.3rem;
            text-transform: uppercase;
            margin: 3rem 0 3rem 0 !important;
        }

        .wpcf7 .wpcf7-form-control-wrap {
            margin-bottom: 1rem;
        }

        .tefl-brochure__container {
            margin-bottom: 2rem;
        }
    </style>
<?php
}


function ti_sort_woo_order_details($order_items)
{
    $order_items_arr = array();

    foreach ($order_items as $item_id => $item) {
        $product       = $item->get_product();
        $order_item_price = wc_get_order_item_meta($item_id, '_line_subtotal', true);
        $order_items_arr[$item_id] = $order_item_price;
    }

    arsort($order_items_arr); // sort high to low

    $order_items_sorted = array();
    foreach ($order_items_arr as $item_id => $price) {
        $order_items_sorted[$item_id] = $order_items[$item_id];
    }

    $order_items = $order_items_sorted;

    return $order_items;
}


function searchfilter($query)
{
    if ($query->is_search && !is_admin()) {
        $query->set('post_type', array('post', 'page', 'course', 'faqs', 'placement', 'internship'));
    }
    return $query;
}
add_filter('pre_get_posts', 'searchfilter');


add_filter('posts_request_ids', 'fix_broken_posts_request_ids', 99, 1);

function fix_broken_posts_request_ids($query)
{
    return str_replace("AND wp_posts.post_author NOT IN ()", "", $query);
}


function astra_site_branding_markup()
{

    $country   = get_user_geo_country_code();
    $site_logo = get_geo_logo($country); ?>

    <div class="site-branding">
        <div <?php
                echo astra_attr(
                    'site-identity',
                    array(
                        'class' => 'ast-site-identity',
                    )
                );
                ?>>

            <span class="site-logo-img">
                <a href="<?php echo site_url(); ?>" class="custom-logo-link" rel="home">
                    <img src="<?php echo !empty($site_logo) ? $site_logo : '/wp-content/uploads/2023/06/TEFL-Logo_Institute.svg' ?>" class="custom-logo" alt="TEFL Logo - TEFL Institute" decoding="async">
                </a>
            </span>

        </div>
    </div>

    <!-- .site-branding -->
<?php
}
