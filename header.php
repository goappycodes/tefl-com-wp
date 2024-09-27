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
<meta name="baidu-site-verification" content="code-btXkGO693o" />	
<meta name="google-site-verification" content="aVQFHMlYWc0F2G6T8kBBuZ8qBgoroP3r0oGWguA8wMc" />
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

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KKHNP46P');</script>
<!-- End Google Tag Manager -->

<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "gdlzcdgymr");
</script>
	
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9E3XFFB9D9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-9E3XFFB9D9');
  gtag('config', 'AW-11116325429');
</script>
	
<!--<script src="https://cdn-eu.pagesense.io/js/stjrymja/b77dafd5bf3545f3833201e886e6ca12.js"></script>-->
	
<script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"56350453"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script>

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

<!-- Add data-attrubute for color themes -->
<?php
    $theme_colors = get_field('theme_colors', 'options');
?>
<!-- Add data-attrubute for color themes -->

<body data-colors=<?php echo json_encode($theme_colors); ?> <?php echo $banner_show ?? ''; ?> <?php astra_schema_body(); ?> <?php body_class(); ?>>

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
