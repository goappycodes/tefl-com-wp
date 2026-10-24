<?php
/**
* Template Name: Internships
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$hero = get_field('hero');
$our_tefl_internships = get_field('our_tefl_internships');
$internships = get_field('internships');
$highlights = get_field('highlights');
$more_details = get_field('more_details');
$travel_advisor = get_field('travel_advisor');
$journal = get_field('journal');

get_header(); ?>

	<script type="application/ld+json">
	{
	  "@context": "https://schema.org/", 
	  "@type": "BreadcrumbList", 
	  "itemListElement": [{
		"@type": "ListItem", 
		"position": 1, 
		"name": "Home",
		"item": "https://teflinstitute.com/"  
	  },{
		"@type": "ListItem", 
		"position": 2, 
		"name": "TEFL Internships",
		"item": "https://teflinstitute.com/tefl-internships/"  
	  }]
	}
	</script>

	<div id="primary" <?php astra_primary_class(); ?>>

        <div class="banner-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-lg-12">
        		        <div class="badge-container"><div class="badge" style="background-image: url('<?php echo $hero['badge']; ?>')"></div></div>
                		<div class="course-banner" style="background-image: url('<?php echo $hero['image'] ?>')">
        		            <div class="ast-col-lg-6 ast-col-md-8">
        		                <div class="banner-content-block">
                		            <div class="content-block">
                		                <h2 class="title"><?php echo $hero['title']; ?></h2>
                		                <h2 class="subtitle"><?php echo $hero['subtitle']; ?></h2>
                		            </div>
                		        </div>
                			</div>
        		        </div>        
        		    </div>
        		</div>
        	</div>
        </div>
        
        <div class="our-internsips-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <h1><?php echo $our_tefl_internships['main_title']; ?></h1>
        		    <div class="ast-col-lg-6">
        		        <h2><?php echo $our_tefl_internships['title']; ?></h2>
        		        <div class="content"><?php echo $our_tefl_internships['content']; ?></div>
        		    </div>
        		    <div class="ast-col-lg-6">
        		        <div class="included-container">
        		            <h3><?php echo $our_tefl_internships['included_title']; ?></h3>
            		        <?php foreach($our_tefl_internships['included'] as $e) { ?>
            		            <?php $item = $e['item']; ?>
            		            <div class="item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"/></svg><?php echo $item; ?></div>
            		        <?php } ?> 
        		        </div>
        		    </div>
        		</div>
        	</div>
        </div>     
        	
        		        
        <div class="internships-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-lg-12">
        		        <h2>Paid TEFL Internships</h2> 
        		        <div class="ast-row ast-flex">
        		            <?php foreach($internships as $e) { ?>
        		                <?php $image = $e['image']; ?>
        		                <?php $country = $e['country']; ?>
        		                <?php $benefits = $e['benefits']; ?>
        		                <?php $link = $e['link']; ?>
        		                <?php $guide = $e['guide']; ?>
        		                <?php
									$course_price_html  = '';
									$course_product_id  = $e['product'];
									$course_product     = $course_product_id ? wc_get_product( $course_product_id ) : false;

									if ( $course_product instanceof WC_Product ) {

										if ( $course_product->is_type( 'simple' ) ) {
											$course_price_html = $course_product->get_price_html();

										} elseif ( $course_product->is_type( 'variable' ) ) {
											$available_children = $course_product->get_children();

											if ( ! empty( $available_children ) ) {
												$product_var_id   = end( $available_children ); 
												$variable_product = wc_get_product( $product_var_id );

												if ( $variable_product instanceof WC_Product ) {
													$course_price_html = $variable_product->get_price_html();
												}
											}

											if ( $course_price_html === '' ) {
												$course_price_html = $course_product->get_price_html();
											}
										}
									}
									if($course_price_html === '' || $course_product->get_price() === '') { continue; }
								?>
            		            <div class="ast-col-lg-4">
                    		        <div class="internship">
                    		            <div class="image" style="background-image: url('<?php echo $image; ?>')">
                    		                <div class="country"><?php echo $country; ?></div>
                    		                <div class="country_subtitle">Paid Internship</div>
                    		            </div>
                    		            <div class="content">
                    		                <div class="price"><?php echo $course_price_html; ?></div>
                    		                <div class="benefits">
                    		                    <h2>Top Benefits:</h2>
                    		                    <?php foreach($benefits as $e) { ?>
        		                                    <?php $item = $e['item']; ?>
        		                                    <div class="benefit"><i class="fa fa-circle"></i><?php echo $item; ?></div>
        		                                <?php } ?> 
                    		                </div>
                    		                <a href="<?php echo $link; ?>" class="learn_more">Learn More</a>
                    		            </div>
                    		            <div class="guide" style="display:none;">
                    		                <img src="<?php echo $guide['image']; ?>">
                    		                <a href="<?php echo $guide['link']; ?>" class="learn_more">Download Guide</a>
                    		            </div>
                    		        </div>
                    		    </div>
                		    <?php } ?> 
        		        </div>
        		    </div>
        		</div>
        	</div>
        </div>
    
        <div class="discover-graphics">
            <div class="left"></div>
            <div class="right"></div>
        </div>
        <div class="discover-top-destinations-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-md-12">
        		        <div class="discover-top-destination">
        		            <h2>Discover the Top TEFL Destinations for 2026</h2>
        		            <div class="discover-top-destination-form">
        		                <?php echo do_shortcode( '[contact-form-7 id="181" title="Discover Destinations Form"]' ); ?>
        		            </div>
        		        </div>
        		    </div>
        		</div>
        	</div>
        </div>
        
        <div class="more-details-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-lg-6">
        		        <img src="<?php echo $more_details['left']['icon']; ?>">
        		        <h2 class="content"><?php echo $more_details['left']['title']; ?></h2>
        		        <div class="content"><?php echo $more_details['left']['content']; ?></div>
        		    </div>
        		    <div class="ast-col-lg-6">
        		        <img src="<?php echo $more_details['right']['icon']; ?>">
        		        <h2 class="content"><?php echo $more_details['right']['title']; ?></h2>
        		        <div class="content"><?php echo $more_details['right']['content']; ?></div>
        		    </div>
        		</div>
        	</div>
        </div>     
        
        <div class="tefl-video-section">
            <div class="ast-container">
                <h2>Life Abroad Interns Highlights:</h2>
        		<div class="ast-row tefl-video-row">
        		    <?php foreach($highlights as $e) { ?>
        		        <?php $image = $e['image']; ?>
        		        <?php $youtube_link = $e['youtube_link']; ?>
        		        <?php $length = $e['length']; ?>
        		        <?php $name = $e['name']; ?>
            		    <div class="ast-col-lg-6 ast-col-md-6 ast-col-sm-12 ast-col-xs-12 tefl-video-col tefl-video-col-1" style="background-image:url('<?php echo $image; ?>')">
            		        <a href="<?php echo $youtube_link; ?>" data-lity class="video-caption-link lity-video">
                                <div class="vide-caption-box">
                                    <span class="video-caption-text"><?php echo $name; ?></span>
                                    <span class="video-icon"><div class="video-length"><?php echo $length; ?></div></span>
                                </div>
                		    </a>
            			</div>
        			<?php } ?> 
        		</div>
        	</div>
        </div>
        
        <div class="feed-contact">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-6">
                        <h3>Instagram Feed</h3>
        		        <p>Follow us on Instagram for the latest news and updates</p>
        		        <?php echo do_shortcode('[insta-gallery id="1"]'); ?>
        		    </div>
        		    <div class="ast-col-md-6">
        		        <div class="contact">
            		        <div class="learn-more-form">
                                <div class="form-head-row">
                                 	<p>Are you interested in this internship & you would like to learn more? Request a priority call with one of our internships experts about this opportunity.</p>
                                  	<?php if($travel_advisor): ?>
                                  	     <img class="form-img" src="<?php echo $travel_advisor; ?>">
                                  	<?php endif; ?>
                                </div>
                                <?php echo do_shortcode('[contact-form-7 id="57896" title="Want to Learn More?"]'); ?>
                            </div>
            		    </div>
        		    </div>
        		</div>
        	</div>
        </div>

		<script>
		
			var page_url = "<?php echo get_permalink(); ?>";
			var page_title = "<?php single_post_title(); ?>";

			jQuery(document).ready(function($) {
				$("#page_url").val(page_url);
				$("#page_title").val(page_title);
			});
			
		</script>
        
        <div class="blogs-section life-story-abroad tefl-advice-sec">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-md-12">
        		        <h2>Journal</h2>
        		    </div>
        		    <?php foreach($journal as $e) { ?>
        		        <?php $article = $e['article']; ?>
        		        <?php $thumbnail = get_the_post_thumbnail_url($article->ID); ?>
        		        <?php $permalink = get_permalink($article->ID); ?>
            		    <?php $title = get_the_title($article->ID); ?>	        
                		<div class="ast-col-md-4">
                		    <div class="blog-item" style="background: url('<?php echo esc_html($thumbnail); ?>')">
                		        <div class="blog-content">
                		            <h3><?php echo esc_html($title); ?></h3>
                		            <a class="blog-link" href="<?php echo esc_html($permalink); ?>">READ MORE <i class="fa fa-angle-right"></i></a>
                		        </div>
                		    </div>
                		</div>
        			<?php } ?> 
        		</div>
        	</div>
        </div>

    </div>

<?php get_footer(); ?>