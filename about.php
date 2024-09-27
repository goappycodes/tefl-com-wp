<?php
/**
* Template Name: About Us
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$webinar_args = array(
  'numberposts'     => 3,
  'post_type'       => 'webinar',
  'tax_query'       => array(
			array(
				'taxonomy'       => 'webinar_category',
				'field'          => 'slug',
				'terms'          => array( 'upcoming' ),
			),
		),
		'orderby'=>'webinar_date',
	'order'=>'ASC'
);
 
$webinars = get_posts( $webinar_args );

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
<section class="banner-section" style="background-image:url('<?php echo $banner_img ?>')">
    
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-lg-6 ast-col-md-8">
		        <div class="banner-content-block">
		            <div class="content-block">
		                <h2 class="section-heading"><?php echo $cta_title ?></h2>
		                <h3><?php echo $cta_stitle ?></h3>
		                <p><?php echo $cta_txt ?></p>
		                <img src="/wp-content/uploads/2020/11/Group-57.svg">
		            </div>
		            <a href="<?php echo $cta_btn_link ?>"><?php echo $cta_btn_txt ?> <i class="fa fa-angle-right"></i></a>
		        </div>
			</div>
		</div>
	</div>
</section>

<!--/Banner Section-->


<!--Tefl Institute London Section-->
<?php
    $about_tefl = get_field('about_tefl');
    
    $about_heading = $about_tefl['heading'];
    $about_txt = $about_tefl['text'];
    $about_img = $about_tefl['image'];
?>
<section class="tefl-institute-london-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-6">
		        <img src="<?php echo $about_img ?>">
			</div>
			<div class="ast-col-md-6">
		        <h2 class="section-heading"><?php echo $about_heading ?></h2>
		        <p><?php echo $about_txt ?></p>
			</div>
		</div>
	</div>
</section>

<!--/Tefl Institute London Section-->


<!--Our Core Values Section-->
<?php 
    $core_values=get_field('core_values');
    
    $heading = $core_values['heading'];
?>
<section class="our-core-values-section">
    <div class="ast-container our-core-values-container">
		<div class="ast-row our-core-values-row">
		    <div class="ast-col-md-12">
		        <h2 class="section-heading"><?php echo $heading ?></h2>
			</div>
		</div>
		<?php $values = $core_values['values'];
		    if($values): ?>
		<div class="ast-row our-core-values-row">
		    <?php foreach($values as $value): ?>
		    <div class="ast-col-lg-3 ast-col-md-6 ast-col-xs-6 our-core-values-col">
		        <?php $icon = $value['icon'];
		              $title = $value['title'];
		              $text = $value['text'];
		                ?>
		        <img src="<?php echo $icon ?>">
		        <h3><?php echo $title ?></h3>
		        <p><?php echo $text ?></p>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<!--/Our Core Values Section-->


<!--What makes us different Section-->
<?php
    $more_about_tefl = get_field('more_about_tefl');
    
    $heading = $more_about_tefl['heading'];
    $txt = $more_about_tefl['text'];
    $img = $more_about_tefl['image'];
?>
<section class="makes-us-different-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-6">
		        <h2 class="section-heading"><?php echo $heading ?></h2>
		        <p><?php echo $txt ?></p>
			</div>
			<div class="ast-col-md-6">
		        <img src="<?php echo $img ?>">
			</div>
		</div>
	</div>
</section>

<!--/What makes us different Section-->


<!--Contact us Section-->
<?php 
    //$contact_details = get_field('contact_details');
    
    //$heading = $contact_details['heading'];
?>
<!--<section class="contact-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-12">
		        <h2 class="section-heading"><?php //echo $heading ?></h2>
			</div>
		</div>
		<?php //$contacts = $contact_details['contact_infos'];
		 //if($contacts):
		?>
		<div class="ast-row">
		    <?php //foreach($contacts as $contact): 
		          //$icon = $contact['icon'];
		          //$title = $contact['title'];
		          //$subtitle = $contact['subtitle'];
		          //$details = $contact['details'];
		    ?>
		    <div class="ast-col-md-3">
		        <img src="<?php //echo $icon ?>">
		        <h3><?php //echo $title ?></h3>
		        <p><?php //echo $subtitle ?></p>
		        <p><?php //echo $details ?></p>
			</div>
			<?php //endforeach; ?>
		</div>
		<?php //endif ?>
	</div>
</section>-->

<!--/Contact us Section-->



<?php get_footer(); ?>