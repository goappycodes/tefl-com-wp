<?php
/**
 * The template for displaying all single guide.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 

$hero 				= get_field('hero');

$main 				= get_field('main');

$accreditations 	= get_field('accreditations');

$courses		 	= get_field('courses');

$extras			 	= get_field('extras');

$video_testimonials	= get_field('video_testimonials');

$sale				= get_field('sale');

$mailchimp_tag 		= get_field('mailchimp_tag');

?>

<?php if($hero): ?>
  
	<section class="hero-section" style="background-image: url('<?php echo $hero['background']; ?>')">

		<div class="ast-container">
              
        	<div class="ast-row">

             	<div class="ast-col-md-12 hero">
					
                    <a href="/" class="logo"><img src="https://teflinstitute.com/wp-content/uploads/2021/09/TEFL-Logo-White_Institute.png"></a>
                      
                    <h1><?php echo $hero['title']; ?></h1>
                      
					<h2><?php echo $hero['subtitle']; ?></h2>

				</div>
                  
			</div>

		</div>

	</section>
  
<?php endif; ?>

<div id="primary" class="content-area primary">
  
  	<?php if($main): ?>
  
        <section class="section">

            <div class="ast-container">
              
                <div class="ast-row">

              		<div class="ast-col-md-12 main">
					
                      	<h3 class="section-heading"><?php echo $main['title']; ?></h3>
                      
                      	<h5 class="section-subheading"><?php echo $main['subtitle']; ?></h5>

                  	</div>
                  
                </div>
              
              	<div class="ast-row">

              		<div class="ast-col-md-8 form-image">
					
                      	<div class="image" style="background-image: url('<?php echo $main['image']; ?>')">
                          
                          	<div class="overlay" style="background-color: <?php echo $main['image_overlay']['color']; ?>">
                              
                                <div class="title-subtitle">
                                  
                                	<div class="title"><?php echo $main['image_overlay']['title']; ?></div>

                                  	<div class="subtitle"><?php echo $main['image_overlay']['subtitle']; ?></div>
                                  
                                </div>
                              
                              	<div class="small"><?php echo $main['image_overlay']['small_heading']; ?></div>
                              
                          	</div>
                          
                      	</div>

                  	</div>
                  
                  	<div class="ast-col-md-4 form-cointainer">
					
                      	<?php echo do_shortcode('[contact-form-7 id="76360" title="PPC TEFL Career Guide"]'); ?>

                  	</div>
                  
                </div>

            </div>

        </section>
  
  	<?php endif; ?>
  
  	<?php if($accreditations): ?>
  
        <section class="section">

            <div class="ast-container">
              
                <div class="ast-row">

              		<div class="ast-col-md-12 main">

                      	<h3 class="section-heading accreditations"><?php echo $accreditations['title']; ?></h3>

                      	<div class="desktop"><img src="<?php echo $accreditations['desktop_image']; ?>"></div>
                      
                        <div class="mobile"><img src="<?php echo $accreditations['mobile_image']; ?>"></div>

                      	<div class="points">
                      
                            <?php foreach ($accreditations['points'] as $point) { ?>

                                <div class="point">

                                    <?php echo $point['point']; ?>  

                                </div>

                            <?php } ?>

                        </div>

                  	</div>
                  
                </div>

            </div>

        </section>
  
  	<?php endif; ?>
  
  	<?php if($courses): ?>
  
        <section class="section">

            <div class="ast-container">
              
                <div class="ast-row">
                  
              		<div class="ast-col-md-12 main">

              			<h2><?php echo $courses['title']; ?></h2>

                		<h4><?php echo $courses['subtitle']; ?></h4>
                  
                  		<div class="countdown-timer-container">
                      
                      		<?php echo do_shortcode('[tefl_timer_shortcode timer="sales"]'); ?>
                      	
                      	</div>  
                          
                  		<div class="main-container">

                        	<?php foreach ($courses['table'] as $table) { ?>

                                <div class="course" style="<?php if($table['most_popular']) { ?> outline: 6px solid <?php echo $table['theme']; ?>80; border-radius: 8px; <?php } ?>border: 1px solid <?php echo $table['theme']; ?>">
									
                                  	<?php if($table['most_popular']) { ?>
                                  
                                  		<div class="most-popular-icon" style="background-image: url(<?php echo $courses['most_popular']; ?>);"></div>
                                  
                                  	<?php } ?>
                                  
                                    <div class="course-heading" style="background-color:<?php echo $table['theme']; ?>;">
	
                                      	<div class="title"><?php echo $table['title']; ?></div>
                                      
                                      	<div class="subtitle"><?php echo $table['subtitle']; ?></div>
                                      
                                    </div>
                                  
                                  	<div class="course-thumbnail" style="background-image: url('<?php echo $table['thumbnail']; ?>')"></div>
                                  
                                  	<div class="course-text"><?php echo $table['jobs_text']; ?></div>
                                  
                                  	<div class="course-product">
                                  
                                      	<div class="stars"><img src="/wp-content/uploads/2023/04/review-stars.png"><span>(<?php echo $table['stars']; ?>)</span></div>
                                      
                                      	<?php 
                                             
                                        
										$product_id = $table['product'];
                       
						$course_price_html = '';
						if ($product_id) :
							$course_product = wc_get_product($product_id);
                            $productid = $course_product->get_id();
							$deposit_enabled = get_post_meta($product_id, '_wc_deposit_enabled', true);
							if ($course_product) :
								$course_price_html = $course_product->get_price_html();
							endif;
							$simple_regular_price = $course_product->get_regular_price();
                            $simple_sale_price = $course_product->get_sale_price();
                            $percentage = round( ( ( $simple_regular_price - $simple_sale_price ) / $simple_regular_price ) * 100 );
						endif;
                                        ?>
                                      
                                        <div class="price">
                                          
                                        	<?php echo $course_price_html; ?>
                                          	
                                          	<div class="save">Save <?php echo $percentage; ?>%</div>
                                          
                                    	</div>
                                      
                                      	<div class="labels">
                                          
                                          	<?php foreach ($table['labels'] as $label) { ?>
                                          
        										<div class="label"><?php echo $label['label']; ?></div>
                                          
                                          	<?php } ?>
                                          
        								</div>
                                      
                                      	<div class="book-link">

                                        	<a href="<?php echo get_home_url('/'); ?>?addtimetocart&prid=<?php echo $productid ?>" class="book-now"><span>Book Now</span><i class="fa fa-angle-right"></i></a>
                                        
                                        </div>
                                      
                                      	<div class="learn-more-link">

                                        	<a href="<?php echo $table['learn_more'] ?>" class="learn-more-now"><span>Learn More</span><i class="fa fa-angle-right"></i></a>
                                        
                                        </div>
                                          
                                  	</div>
                                      
                                </div>

                            <?php } ?>
                          
                  		</div>
                  
                	</div>
                  
                </div>

            </div>

        </section>
  
  		<section id="wp-posts" class="section">

		<div class="ast-container">

			<div class="ast-row">

			    <?php 
              
			    foreach($extras as $element) {

					$background = $element['background'];

			        $title = $element['title'];

			        $subtitle = $element['subtitle'];

					$learn_more = $element['learn_more'];

					$color = $element['color'];
					
			    ?>

			    <div class="ast-col-md-12 post-col">

						<div class="ast-row post-row" style="background-image: url(<?php echo $background; ?>);">

							<div class="ast-col-md-6 post-content-col">

								<div class="post-content-div">

									<div class="title-div">

										<p class="title">

										    <span><?php echo $title; ?></span>

										</p>
                                      
                                      	<p class="subtitle">

										    <span><?php echo $subtitle; ?></span>

										</p>

									</div>

									<div class="meta-register-div">

										<div class="register-div">

											<a class="button ptefl-button" href="<?php echo $learn_more; ?>">Learn More</a>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

				<?php } ?>

			</div>

		</div>

	</section>
  	
    <section class="tefl-video-section">
      
      <h3 class="section-heading">TEFL Institute Graduate Testimonials</h3>
      
      <div class="ast-container">
        
          <div class="ast-row tefl-video-row">
            
            <?php foreach($video_testimonials as $video_testimonials_item) {
           
                $testimonials_image = $video_testimonials_item['thumbnail'];

                $name = $video_testimonials_item['name'];
                $title_name = $video_testimonials_item['title'];
                $testimonials_youtube = $video_testimonials_item['youtube']; 
                $thumbnail = "http://img.youtube.com/vi/".$testimonials_youtube.'/hqdefault.jpg'; 
            ?>
            	<div class="ast-col-lg-6 ast-col-md-6 ast-col-sm-12 ast-col-xs-12 tefl-video-col tefl-video-col-1" style="background-image:url('<?php echo $testimonials_image ?>')">
                  <a href="https://youtu.be/<?php echo $testimonials_youtube ?>" data-lity="" class="video-caption-link lity-video">
                      <div class="vide-caption-box">
                          <span class="video-caption-text"><?php echo $name ?> | <?php echo $title_name ?></span>
                          <span class="video-icon "><img src="/wp-content/uploads/2021/10/Play-button.svg"></span>
                      </div>
                  </a>
            	</div>
            
            <?php } ?>
            
          </div>
        
      </div>
      
  	</section>

  	<?php 
  
    	$reviews_shortcode = do_shortcode('[brb_collection id="53081"]');
  
    ?>
  
  	<div class="ast-row reviews">
      	
      	<h3 class="section-heading">Verifed Reviews</h3>
      
    	<div class="ast-col-md-12">
        	<div class="review-banner" style="background-image:url('https://teflinstitute.com/wp-content/uploads/2020/11/Group-326.jpg')"></div>
    		<?php echo do_shortcode('[brb_collection id="1150"]'); ?>
    	</div>
      
    </div>
  
  	<?php endif; ?>
  
  	<?php if($sale): ?>
  
        <section class="section">

            <div class="ast-container">

                <div class="ast-row limited-time-only">

                    <h2 class=""><?php echo $sale['title']; ?></h2>

                    <h3 class=""><?php echo $sale['subtitle']; ?></h3>
                  
                  	<div class="points">
                      
                      	<?php foreach ($sale['points'] as $point) { ?>

                          	<div class="point">
                            
                              	<?php echo $point['point']; ?>  
                            
                          	</div>

                      	<?php } ?>
                      
                    </div>
                  
                  	<h3 class=""><?php echo $sale['heading']; ?></h3>
                  
                  	<a href="<?php echo $sale['call_to_action']['link']; ?>" class="call-to-action"><span><?php echo $sale['call_to_action']['value']; ?></span><i class="fa fa-angle-right"></i></a>

                </div>

            </div>

        </section>
  
  	<?php endif; ?>
  			
</div>

<script>
		
    document.addEventListener( 'wpcf7mailsent', function( event ) {
      if ( '76360' == event.detail.contactFormId ) {
        location = '/wp-content/uploads/2023/04/TEFL-Kickstarter-Pack.pdf';
      }
    }, false );

  	document.getElementById("mc-tag").value = <?php echo json_encode($mailchimp_tag); ?>;
  
</script>

<?php get_footer(); ?>
