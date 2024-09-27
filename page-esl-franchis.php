<?php
/**
* Template Name: ESL Franchisee Page
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 

?>
<style>
section{margin:50px 0 0}section.banner-section{background-position:center!important;background-size:cover!important;max-width:1180px;margin:0 auto;padding-top:50px;margin-bottom:4rem}@media screen and (max-width:768px){section.banner-section{background-size:contain!important;background-position:top!important;background-repeat:no-repeat!important;margin-top:-25px!important}}.banner-content-block .content-block{background-color:#fff;padding:50px 60px 50px 50px;position:relative}.banner-content-block .content-block h3{font-size:1.125rem;font-weight:600!important;padding:0 0 1rem;text-transform:uppercase;font-weight:500;margin:0 0 1rem;letter-spacing:2px;border-bottom:2px solid #eee}.banner-buttons .btn{display:flex;align-items:center;text-transform:uppercase;justify-content:space-between;padding:12px 20px;min-height:55px;margin-bottom:-55px;font-size:.688rem;letter-spacing:.3rem;width:50%}.banner-buttons .btn-white{color:#000;background:#fff;border:1px solid #000}.banner-buttons .btn-black{font-size:1rem;text-transform:uppercase;margin-top:0;color:#fff;background:#000}.why-choose-us{margin-bottom:50px}.application-procedures .section-heading,.become-partner-form .section-heading,.contact-section .section-heading,.why-choose-us .section-heading{font-weight:700;text-transform:uppercase;text-align:center;color:#000}.feature-box__icon img{width:65px;height:65px}.feature-box__title,.procedure-faq__title{font-size:1rem;font-weight:600;text-transform:uppercase;letter-spacing:.3rem;color:var(--black)}.feature-box__title{margin:20px 0}.procedure-faq__title{margin-bottom:20px;text-align:center}.feature-box__description{border-top:1px solid;margin-top:1.5rem;font-size:14px;line-height:1.75}@media screen and (max-width:767px){.feature-box{margin-top:2rem}}.application-procedures__body{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;flex-wrap:wrap;margin-top:2rem}.application-procedures__body>[class*=col-]{display:flex;flex-direction:column}.procedure-faq{height:100%;background:#ededed;margin-bottom:2rem}.procedure-faq__image{height:200px;width:100%;object-fit:cover}.procedure-faq__body{font-size:14px;padding:1.5rem}.procedure-faq__details ul{margin:0 0 0 1rem}.application-procedures{margin-top:100px}.partner-logo{display:flex;justify-content:center;margin-bottom:.75rem}.partner-logo:last-of-type{width:100%}.partner-logo:last-of-type img{width:50px}.partner-logo img{height:32px;object-fit:contain}.is-slider:not(.loaded){display:none}.testimonial{text-align:center}.testimonial-section-title{text-align:center;font-size:10px;font-weight:600;margin-top:1rem}.testimonial-name{text-align:center;color:#000;font-weight:700;font-size:14px}.become-partner-form{margin-bottom:50px}.tefl-schools-form textarea{width:100%}.contact-section{background:#ededed;padding:2rem}.contact-section .section-heading{text-align:initial}.contact-email{margin-top:2rem}.contact-email a{color:#000;font-weight:700;border-bottom:2px solid #bbb;padding-bottom:.25rem;transition:.4s all ease}.contact-email a:hover{padding-bottom:.5rem}@media screen and (max-width:767px){.contacts-row{margin-top:1rem}.banner-section>.ast-container{padding:0}.banner-buttons .btn{font-size:.75rem !important}}img.contact-image{height:180px;width:180px;object-fit:contain;margin-bottom:1rem}.contact-person{display:flex;flex-direction:column;align-items:center}.contact-person__details{text-align:center}.contact-person__designation,.contact-person__name{text-transform:uppercase;font-size:12px;letter-spacing:2px}.contact-person__name{color:#000;font-weight:700}.contact-person__designation{color:#3a3a3a;font-weight:600}	
</style>

<?php 
	$banner_section = get_field('banner_section');
	$banner_image 	= $banner_section['banner_image'];
	$banner_cta 	= $banner_section['banner_cta'];

	$cta_title 		= $banner_cta['cta_title'];
	$cta_summary 	= $banner_cta['cta_summary'];
	$cta_buttons 	= $banner_cta['cta_buttons'];

	$button_1 		= $cta_buttons['button_1'];
	$button_text_1 	= $button_1['button_text'];
	$button_url_1 	= $button_1['button_url'];

	$button_2 		= $cta_buttons['button_2'];
	$button_text_2 	= $button_2['button_text'];
	$button_url_2 	= $button_2['button_url'];
?>
<section class="banner-section" style="background:url(<?php echo $banner_image;?>)">
	<div class="ast-container">
		<div class="row">
		<div class="ast-col-md-6">
			<div class="banner-content-block">
				<div class="content-block">
					<h3><?php echo $cta_title; ?></h3>
					<p><?php echo $cta_summary; ?></p>
				</div>
				<div class="banner-buttons ast-flex http://recruitment@teflinstitute.com">
					<a class="btn-white btn" href="<?php echo $button_url_1; ?>"><?php echo $button_text_1; ?><i class="fa fa-angle-right"></i></a>
					<a rel="nofollow" class="btn btn-black" href="<?php echo $button_url_2; ?>"><?php echo $button_text_2; ?><i class="fa fa-angle-right"></i></a>
				</div>
			</div>
		</div>
		</div>
	</div>
</section>

<?php 
	$application_procedure_details 	= get_field('application_procedure_details');
	$application_procedure_title 	= $application_procedure_details['title'];
	$short_description 				= $application_procedure_details['short_description'];
	$who_we_work_with 				= $application_procedure_details['who_we_work_with'];
	$procedures_faqs 				= $application_procedure_details['procedures_faqs'];
?>
<section class="application-procedures">
	<div class="ast-row application-procedures__title">
		<div class="ast-col-md-12">
			<h2 class="section-heading"><?php echo $application_procedure_title; ?></h2>
		</div>
		<div class="ast-col-md-12"><?php echo $short_description; ?></div>
	</div>
	<div class="ast-row application-procedures__body">

		<?php 
			$faqs_count = 0;
			$application_procedure_details = get_field('application_procedure_details');
				$procedures_faqs = $application_procedure_details['procedures_faqs'];
				if( $procedures_faqs ) {
					foreach( $procedures_faqs as $procedures_faq ) {
					 	$faqs_count++; 
					 	$image 		= $procedures_faq['image'];
					 	$title 		= $procedures_faq['title'];
					 	$details 	= $procedures_faq['details'];
					?>
			    	<div class="ast-col-md-4">
						<div class="procedure-faq">
							<img width="2560" height="1707" class="procedure-faq__image entered error" src="<?php echo $image; ?>" data-lazy-src="<?php echo $image; ?>" data-ll-status="error">
							<noscript><img width="2560" height="1707" class="procedure-faq__image" src="<?php echo $image; ?>"/></noscript>
							<div class="procedure-faq__body">
								<h4 class="procedure-faq__title">
									<?php echo $title; ?>
								</h4>
								<div class="procedure-faq__details">
									<?php echo $details; ?>
								</div>
							</div>
						</div>
					</div>

					<?php
						if( $faqs_count == 4 ){
      					$who_we_work_with = get_field('who_we_work_with');
      				?>
					<div class="ast-col-md-4">
						<div class="procedure-faq who-we-work-with">
							<div class="procedure-faq__body">
								<h4 class="procedure-faq__title"><?php echo $who_we_work_with['title']; ?></h4>
								<div class="procedure-faq__details ast-row">
									<?php
									if ( have_rows( 'who_we_work_with' ) ) : the_row();
			    						while ( have_rows( 'partner_logos' ) ) : the_row();
									?>
                                        <div class="ast-col-md-4 partner-logo">
                                          <img width="1047" height="299" src="<?php the_sub_field( 'logo' ); ?>" alt="partner-logo" data-lazy-src="<?php the_sub_field( 'logo' ); ?>">
                                          <noscript><img width="1047" height="299" src="<?php the_sub_field( 'logo' ); ?>" alt="partner-logo"></noscript>
                                        </div>
									<?php
											endwhile;
                                  		endif;
									?>
								</div>
                              
                              	<?php $testimonials = get_field('testimonials'); ?>
								<div class="ast-row testimonial-section">
									<h6 class="testimonial-section-title"><?php echo $testimonials['testimonial_title']; ?></h6>
									<div class="ast-col-md-12 ">
									<div class="testimonial">
										<?php
										if ( have_rows( 'testimonials' ) ) : the_row();
			    								while ( have_rows( 'testimonial_content' ) ) : the_row();
										?>
										<h5 class="testimonial-name"><?php the_sub_field( 'title' ); ?></h5>
										<p class="testimonial-description"><?php the_sub_field( 'content' ); ?></p>
										<?php   
												endwhile;
											endif;
										?>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			<?php
					}
				}
			}
		?>			
    </div>
</section>

<section class="become-partner-form" id="tefl-school-form">
	<h2 class="section-heading center">Become a Partner School</h2>
	<?php echo do_shortcode('[contact-form-7 id="67369" title="Become a partner school form"]'); ?>
</section>

<?php 
	$contact_section	= get_field('contact_section');
	$title 				= $contact_section['title'];
	$contact_summary 	= $contact_section['contact_summary'];
	$contact_mail 		= $contact_section['contact_mail'];
	$contacts 			= $contact_section['contacts'];
?>
<section class="contact-section">
	<div class="ast-row">
		<div class="ast-col-md-6">
		<h2 class="section-heading">
			<?php echo $title; ?>
		</h2>
		<p><?php echo $contact_summary; ?></p>
		<div class="contact-email">
			Email: <a href="mailto:<?php echo $contact_mail; ?>"><?php echo $contact_mail; ?></a>
		</div>
		</div>
		<div class="ast-col-md-6">
		<div class="ast-row contacts-row">
			<?php 
				if ( have_rows( 'contact_section' ) ) : the_row();
				    while ( have_rows( 'contacts' ) ) : the_row(); $faqs_count++;
			?>
			<div class="ast-col-md-6">
				<div class="contact-person">
					<img width="500" height="500" class="contact-image" src="<?php the_sub_field('image'); ?>" alt="contact-person" data-lazy-src="<?php the_sub_field('image'); ?>">
					<noscript><img width="500" height="500" class="contact-image" src="<?php the_sub_field('image'); ?>" alt="contact-person"></noscript>
					<div class="contact-person__details">
					<h4 class="contact-person__name"><?php the_sub_field('name'); ?></h4>
					<p class="contact-person__designation"><?php the_sub_field('designation'); ?></p>
					</div>
				</div>
			</div>
			<?php   
					endwhile;
				endif;
			?>
		</div>
		</div>
	</div>
</section>

<?php 
	$why_choose_us_section	= get_field('why_choose_us_section');
	$title 					= $why_choose_us_section['title'];
	$features 				= $why_choose_us_section['features'];
?>
<section class="why-choose-us">
	<div class="ast-row section-title">
		<div class="ast-col-md-12">
		<h2 class="section-heading">
			<?php echo $title; ?>
		</h2>
		</div>
	</div>
	<div class="ast-row section-body">
		<?php 
			if ( have_rows( 'why_choose_us_section' ) ) : the_row();
			    while ( have_rows( 'features' ) ) : the_row(); $faqs_count++;
		?>
		<div class="ast-col-md-2 feature-box">
			<div class="feature-box__icon">
				<img width="71" height="71" src="<?php the_sub_field('icon'); ?>">
			</div>
			<div class="feature-box__description">
				<h4 class="feature-box__title">
					<?php the_sub_field('title'); ?>                            
				</h4>
				<p><?php the_sub_field('summary'); ?></p>
			</div>
		</div>
		<?php   
				endwhile;
			endif;
		?>
	</div>
</section>

<?php get_footer(); ?>