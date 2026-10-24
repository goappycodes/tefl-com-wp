<?php
/**
 * The header for Astra Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php astra_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<meta name="yandex-verification" content="f146ee88e794efac" />
<meta name="google-site-verification" content="aVQFHMlYWc0F2G6T8kBBuZ8qBgoroP3r0oGWguA8wMc" />
<meta name="baidu-site-verification" content="codeva-UisXe1YmJs" />
<meta name="msvalidate.01" content="EAB42E5C3356A871BF1943A5B0A030DD" />
<script src="https://analytics.ahrefs.com/analytics.js" data-key="PjBPyHKU14NMMbrGDWp/aA"
  async>
</script>
<script id="pt_obj" type='text/javascript'>
    var pt_obj = {"pt_ajax":"https:\/\/teflinstitute.com\/wp-admin\/admin-ajax.php"};
    var split_deposit = '<?php echo get_first_payment_amount(); ?>';
    var split_deposit_new = '<?php echo get_first_payment_amount_new(); ?>';

    document.addEventListener("DOMContentLoaded", function(event) {
        var body = document.body;
        var bodywidth = document.documentElement.clientWidth;
        bodywidth = parseInt(bodywidth);
        console.log("bodywidth", bodywidth);
        if (bodywidth < 768) {
            body.classList.add("ast-header-break-point");
            body.classList.remove("ast-desktop");
        } else {
            body.classList.remove("ast-header-break-point");
            body.classList.add("ast-desktop");
        }
    });
</script>

<?php tefl_lang_translation(); ?>
<?php wp_head(); ?>

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#eeeeee">

<?php astra_head_bottom(); ?>

<!-- no CLS CSS -->
<style>
.top-bar button.search img {
    height: 14px;
    width: 14px;
}
.main-header-menu > .menu-item > .menu-link {
    padding: 8px 1.3em;
}
.banner-strip {
    text-align: center;
    text-transform: uppercase;
    color: #fff;
    display: flex;
    justify-content: center;
    font-size: 1rem;
    letter-spacing: 0.3rem;
    align-items: center;
}
.tefl_countdown_timer {
    min-width: 20px;
}    
.ti-logo a img {
    max-width: 160px;
}
@media (max-width:768px){
    .banner-strip {
        display: block;
        text-align: center;
        padding: 1rem 0;
    }
    .banner-strip p {
        font-size: 1rem;
        letter-spacing: 0;
        line-height: 1.2;
    }
    .carousel-item {
        height: 400px!important;
    }    
    .homepage-hero-section .banner-text-row {
        height: 345px!important;
        min-height: 1px;
    }    
}
</style>

</head>
<body <?php echo $banner_show ?? ''; ?> <?php astra_schema_body(); ?> <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KKHNP46P"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php astra_body_top(); ?>
<?php wp_body_open(); ?>
<div 
	<?php
	echo astra_attr(
		'site',
		array(
			'id'    => 'page',
			'class' => 'hfeed site',
		)
	);
	?>
>

	<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html( astra_default_strings( 'string-header-skip-link', false ) ); ?></a>

	
    
    <?php astra_header_before(); ?>
    
    
	<?php astra_header(); ?>

	<?php astra_header_after(); ?>
    
	<?php astra_content_before(); ?>

	<div id="content" class="site-content">

		<div class="ast-container">

		<?php astra_content_top(); ?>
