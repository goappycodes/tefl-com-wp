<?php
/**
* Template Name: Contact Page Template
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
    $cta_btn_link = $banner_cta['cta_button_link']; ?>
        
<!--<section class="banner-section" style="background-image:url('<?php //echo $banner_img ?>')">-->
    
<!--    <div class="ast-container">-->
<!--		<div class="ast-row">-->
<!--		    <div class="ast-col-lg-6 ast-col-md-8">-->
<!--		        <div class="banner-content-block">-->
<!--		            <div class="content-block">-->
<!--		                <h2 class="section-heading"><?php //echo $cta_title ?></h2>-->
<!--		                <h3><?php //echo $cta_stitle ?></h3>-->
<!--		                <p><?php //echo $cta_txt ?></p>-->
<!--		                <img src="/wp-content/uploads/2020/11/Group-57.svg">-->
<!--		            </div>-->
<!--		            <a href="<?php //echo $cta_btn_link ?>"><?php //echo $cta_btn_txt ?> <i class="fa fa-angle-right"></i></a>-->
<!--		        </div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
	
<!--</section>-->

<!--/Banner Section-->

<!--Header Section-->

<section class="header-section">
    
    <div calss="ast-container">
        <div class="ast-row">
            <div class="ast-col-lg-6 ast-col-sm-12">
                 <h1 class="section-heading">contact us</br>helping you become a tefl</br>teacher</h1>
                  
                 <p>Whether you are here to launch your TEFL career or travel the world with ease, the TEFL Institute is here to help. Our institute allows you to become a fully qualified and internationally recognized TEFL teacher.</p>
            </div>
           
        </div>
    </div>
    
</section>

<!--/Header Section-->


<!--What makes us different Section-->
<?php
    $contact_form_section = get_field('contact_form_section');
    
    $contact_form_shortcode = $contact_form_section['contact_form_shortcode'];
    $img = $contact_form_section['image'];
?>
<section class="makes-us-different-section contact-form">
    <div class="ast-container">
		<div class="ast-row contact-us-form">
		    <div class="ast-col-md-7">
		        <?php //echo do_shortcode($contact_form_shortcode); ?>
		        <iframe width='100%' height='605px' src='https://theteflinstitute-teflinstitute.zohobookings.eu/portal-embed#/customer/theteflinstitute' frameborder='0' allowfullscreen='' > </iframe>
			</div>
			<div class="ast-col-md-5">
		        <div class="contact-details">
					<div class="details">
		                <h4>Headquarters</h4>
		                <p>
						The TEFL Institute<br>
						4 Shandon Street<br>
						Dungarvan<br>
						Co. Waterford<br>
						X35 A365
						</p>
		            </div>
		            <div class="details">
		                <h4>Central Administration</h4>
		                <p>
						The TEFL Institute<br>
						6 Mornington Pl,<br>
						Greater, London NW1 7RP,<br>
						United Kingdom
		                </p>
		            </div>
		            <div class="details">
		                <h4>EMAIL US</h4>
		                <p>
		                   <a href="mailto:hello@teflinstitute.com">hello@teflinstitute.com</a>
		                </p>
		            </div>
		            <div class="details">
		                <h4>CALL US</h4>
						<p><span><a href="tel:003535873135">🇮🇪 +(0) 353 5873135</a></span><br>
						<span><a href="tel:00442033185366">🇬🇧 +44 203 318 5366</a></span><br>
						<span><a href="tel:0016172022524">🇺🇸 +1 6172022524</a></span><br>
						<!-- <span><a href="tel:00442033185366">🇦🇺 +44 203 318 5366</a></span><br> -->
						<span><a href="tel:0027311002396">🇿🇦 +27 311002396</a></span></p>
		            </div>

					<div class="details footer-social-col">
						<a href="https://www.facebook.com/theteflinstitute" target="_blank"><i class="fa fa-facebook"></i></a>
						<a href="https://www.linkedin.com/company/the-tefl-institute-ltd/" target="_blank"><i class="fa fa-linkedin"></i></a>
					</div>
                </div>
			</div>
		</div>
	</div>
</section>

<!--/What makes us different Section-->


<!--Contact us Section-->
<?php 
    $contact_details = get_field('contact_details');
    
    $heading = $contact_details['heading'];
?>
<section class="contact-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-12">
		        <h2 class="section-heading"><?php echo $heading ?></h2>
			</div>
		</div>
		<?php $contacts = $contact_details['contact_infos'];
		 if($contacts):
		?>
		<div class="ast-row contact-icons">
		    <?php foreach($contacts as $contact): 
		          $icon = $contact['icon'];
		          $title = $contact['title'];
		          $subtitle = $contact['subtitle'];
		          $details = $contact['details'];
		    ?>
			<div class="ast-col-md-3 ast-col-xs-6">
		        <img src="<?php echo $icon ?>">
		        <h3><?php echo $title ?></h3>
		        <p><?php echo $subtitle ?></p>
		        <p><?php echo $details ?></p>
			</div>
			<?php endforeach; ?>
			<!--<div class="ast-col-md-3">-->
		 <!--       <img src="/wp-content/uploads/2020/11/mobile.svg">-->
		 <!--       <h3>SALES</h3>-->
		 <!--       <p>Telephone Number<br>01-5563038</p>-->
			<!--</div>-->
			<!--<div class="ast-col-md-3">-->
		 <!--       <img src="/wp-content/uploads/2020/11/telephone.svg">-->
		 <!--       <h3>WHATSAPP</h3>-->
		 <!--       <p>Telephone Number<br>058-73135</p>-->
			<!--</div>-->
			<!--<div class="ast-col-md-3">-->
		 <!--       <img src="/wp-content/uploads/2020/11/email.svg">-->
		 <!--       <h3>EMAIL</h3>-->
		 <!--       <p>24 Hour Response<br>hello@teflinstitute.com</p>-->
			<!--</div>-->
		</div>
		<?php endif ?>
	</div>
</section>

<!--/Contact us Section-->



<?php get_footer(); ?>