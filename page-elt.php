<?php
/**
* Template Name: English Level Test Template
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


get_header(); ?>


<!--Banner Section-->
<?php
        $hero_banner = get_field('hero_banner');
        
        $banner_img = $hero_banner['banner_image'];
        $banner_cta = $hero_banner['banner_cta'];
        
        $cta_title = $banner_cta['cta_title'];
        $cta_stitle = $banner_cta['cta_subtitle'];
        $cta_txt = $banner_cta['cta_text'];
        $cta_btn_txt = $banner_cta['cta_button_text'];
        $cta_btn_link = $banner_cta['cta_button_link'];
    ?>
    
<link rel='stylesheet' id='stripe_styles-css'  href='/wp-content/plugins/woocommerce-gateway-stripe/assets/css/stripe-styles.css?ver=4.2.0' type='text/css' media='all' />
<script src="/wp-content/plugins/woocommerce/assets/js/frontend/checkout.min.js?ver=3.6.2"></script>

<section class="banner-section" style="background-image:url('<?php echo $banner_img ?>')">
    
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-lg-6 ast-col-md-8">
		        <div class="banner-content-block">
		            <div class="content-block">
		                <h1 class="section-heading"><?php echo $cta_title ?></h1>
		                <h2><?php echo $cta_stitle ?></h2>
		                <p><?php echo $cta_txt ?></p>
		                <img src="/wp-content/uploads/2020/11/Group-57.svg">
		            </div>
					<a class="english-test-btn" href="#eltQuiz">Take Quiz Now <i class="fa fa-angle-right"></i></a>
		        </div>
			</div>
		</div>
	</div>
</section>

<!--/Banner Section-->

        
<!--Tefl Institute London Section-->
<?php
    $elt_content = get_field('elt_text');
    $elt_text = $elt_content['text'];
    $elt_img = $elt_content['image'];
    $elt_head = $elt_content['heading'];
	$elt_btn_txt = $elt_content['button_text'];
	$elt_btn_url = $elt_content['button_url'];
?>
<section class="tefl-institute-london-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-6">
		        <img class="elt-section-img" src="<?php echo $elt_img; ?>">
			</div>
			<div class="ast-col-md-6">
		        <h2 class="section-heading"><?php echo $elt_head; ?></h2>
		        <p><?php echo $elt_text; ?></p>
				<?php if($elt_btn_txt_ && $elt_btn_url): ?>
					<div class="elt-content_btn"><a class="button" href="<?php echo $elt_btn_url; ?>"><span><?php echo $elt_btn_txt; ?></span><i class="fa fa-angle-right"></i></a></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>


<!--Quiz Section-->
 
<hr>
<section class="hidden" id="eltQuiz">
	<div class="ast-container">
		<div class="ast-row quiz-registration">
			<?php echo do_shortcode('[contact-form-7 id="73457" title="Custom ELT Form"]')?>
		</div>
	</div>
</section>
        
<!--/Quiz Section-->
<?php get_footer(); ?>