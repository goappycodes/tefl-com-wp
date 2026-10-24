<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>
	    
		<!--Banner Section-->
		
		<?php
        
        $banner = get_field('banner');
        
        $background_image        = $banner['background_image'];
        $banner_title            = $banner['banner_title'];
        $banner_subtitle         = $banner['banner_subtitle'] ?? '';
        $banner_text             = $banner['banner_text'];
        $banner_cta_button_link  = $banner['banner_cta_button_link'];
        $banner_cta_button_text  = $banner['banner_cta_button_text'];
        $banner_logo             = $banner['banner_logo'];
        					
		if( is_subcountry_folder() ) {
            $cc = strtolower(get_current_country());
            $content = get_field('blog_content_'.$cc);
        }

		if(empty($background_image )){
			$background_image = get_the_post_thumbnail_url();
		}
        
        ?>

        <section class="banner-section" style="background: url('<?php echo $background_image; ?>');">
            
        </section>
        
        <!--/Banner Section-->
        
        
        <!--Blog Content Section-->

        <section class="blog-content-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-lg-12">
        		        <div class="share-blog">
        		            <span>Share this blog via</span>
        		            
        		            <?php $home_url = home_url(); ?>
        		            <?php $post_url = $_SERVER['REQUEST_URI']; ?>
        		            <?php $share_url = $home_url.$post_url; ?>
        		            
        		            <?php
        		            global $post;
        		            $post_title = get_the_title($post);
        		            ?>
        		            
        		            <div class="social-share">
        		                <a href="https://www.facebook.com/sharer.php?u=<?php echo $share_url; ?>"><i class="fa fa-facebook"></i></a>
            		            <a href="https://twitter.com/share?url=<?php echo $share_url; ?>&text=<?php echo $post_title; ?>"><i class="fa fa-twitter"></i></a>
            		            <a href="https://plus.google.com/share?url=<?php echo $share_url; ?>"><i class="fa fa-google-plus"></i></a>
            		            <a href="https://www.linkedin.com/shareArticle?url=<?php echo $share_url; ?>&title=<?php echo $post_title; ?>"><i class="fa fa-linkedin"></i></a>
        		            </div>
        		        </div>        
        		    </div>
        		</div>
        		
        		<div class="ast-row middle-content-row">
					<?php $left_side_title = get_field('left_side_title');
					$content_title = get_field('content_title');
					if($left_side_title) : ?>
						<div class="ast-col-md-2">
							<h3 class="small-heading">
								<?php echo $left_side_title; ?>
							</h3>
						</div>
						
						<div class="ast-col-lg-7">
							
							<h1 class="large-heading font-700 content-heading"><?php echo $content_title?$content_title:get_the_title(); ?></h1>
    				        
    				        <div class="content table-container-enhanced">
								<?php the_post_meta_stamp(); ?>
								<?php 
							    if(!empty($content)) {
        			                echo $content;
        			            } else {
    	    		                the_content();
    		    	            } ?>
							</div>
							
						</div>
					<?php else: ?>
						<div class="ast-col-lg-9">
							
							<h1 class="large-heading font-700 content-heading"><?php echo $content_title?$content_title:get_the_title(); ?></h1>
							
							<div class="content table-container-enhanced">
								<?php the_post_meta_stamp(); ?>
								<?php 
							    if(!empty($content)) {
        			                echo $content;
        			            } else {
    	    		                the_content();
    		    	            } ?>
							</div>
							
						</div>
					<?php endif; ?>
        		    <div class="ast-col-lg-3 sticky-sidebar <?php echo current_user_can('administrator')?'is-admin':'' ?>">
        		            <div class="category-links">
								<?php wp_list_categories( array(
									'orderby'    => 'name',
									'show_count' => false
								) ); ?> 
							</div>
        		    </div>
        		</div>
        	</div>
        </section>
        
        <!--/Blog Content Section-->
        
        
        <!--Social Share Section-->

        <section class="social-share-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-lg-12">
        		        <div class="social-share-block">
        		            <span>Share this blog via:<?php //echo $social_share_text = get_field('social_share_text'); ?></span>
        		            <div class="social-share-icons">
        		                <a href="https://www.facebook.com/sharer.php?u=<?php echo $share_url; ?>"><i class="fa fa-facebook"></i></a>
            		            <a href="https://twitter.com/share?url=<?php echo $share_url; ?>&text=<?php echo $post_title; ?>"><i class="fa fa-twitter"></i></a>
            		            <a href="https://plus.google.com/share?url=<?php echo $share_url; ?>"><i class="fa fa-google-plus"></i></a>
            		            <a href="https://www.linkedin.com/shareArticle?url=<?php echo $share_url; ?>&title=<?php echo $post_title; ?>"><i class="fa fa-linkedin"></i></a>
        		            </div>
        		        </div>        
        		    </div>
        		</div>
        	</div>
        </section>
        
        <!--/Social Share Section-->
        
        <!--Blogs Section-->
        
        <?php $life_stories_abroad_section_title = get_field('life_stories_abroad_section_title');
        $life_stories_abroad_posts = get_field('life_stories_abroad_posts' ); 

		if($life_stories_abroad_posts) : ?>
		
			<section class="blogs-section life-story-abroad">
				<div class="ast-container">
					<div class="ast-row">
						<?php if($life_stories_abroad_section_title): ?>
							<h2><?php echo $life_stories_abroad_section_title; ?></h2>
						<?php endif; ?>
						
						<?php if($life_stories_abroad_posts): ?>
							<?php foreach($life_stories_abroad_posts as $life_stories_abroad_post) :
							
								$post_id            = $life_stories_abroad_post['lsa_post'];
								$post_title         = get_the_title($post_id);
								$post_thumbnail_url = get_the_post_thumbnail_url($post_id);
								$post_link          = get_the_permalink($post_id); ?>
								<div class="ast-col-md-4">
									<div class="blog-item" style="background: url('<?php echo $post_thumbnail_url; ?>')">
										<div class="bolg-content">
											<h3><?php echo $post_title; ?></h3>
											<a class="blog-link" href="<?php echo $post_link; ?>">READ MORE <i class="fa fa-angle-right"></i></a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</section>
		
		<?php endif; ?>
        
        <!--/Blogs Section-->

		<!--FAQ section start-->

		<?php $frequently_asked_questions = get_cfvalue_by_country('frequently_asked_questions'); ?>

		<?php
		/* Country guide cards - shown on every blog post (replaces the FAQ hero banner). Deterministic 5-of-15 by post ID. */
		$tg_guides = array(
			array( 'Spain', 'Jobs, pay and visa routes', 'ES', 'teach-english-in-spain' ),
			array( 'South Korea', 'EPIK, hagwons and pay', 'KR', 'south-korea' ),
			array( 'Japan', 'JET, ALT and eikaiwa pay', 'JP', 'japan' ),
			array( 'Vietnam', 'Work permits and requirements', 'VN', 'vietnam' ),
			array( 'Thailand', 'Visas and teaching licences', 'TH', 'thailand' ),
			array( 'Italy', 'Jobs, pay and visa routes', 'IT', 'italy' ),
			array( 'Dubai', 'Pay, requirements and visas', 'AE', 'dubai' ),
			array( 'Czech Republic', 'Pay, visas and cities', 'CZ', 'czech-republic' ),
			array( 'Cambodia', 'Pay, requirements and visas', 'KH', 'cambodia' ),
			array( 'Estonia', 'Jobs, pay and work routes', 'EE', 'estonia' ),
			array( 'China', 'Z visa, pay and cities', 'CN', 'china' ),
			array( 'Taiwan', 'Buxibans, pay and visas', 'TW', 'taiwan' ),
			array( 'Mexico', 'Jobs, pay and cities', 'MX', 'mexico' ),
			array( 'Germany', 'Freelance work and pay', 'DE', 'germany' ),
			array( 'Portugal', 'Jobs, pay and visa routes', 'PT', 'portugal' ),
		);
		mt_srand( (int) get_the_ID() );
		shuffle( $tg_guides );
		mt_srand();
		$tg_pick = array_slice( $tg_guides, 0, 5 );
		?>
		<section class="learn-more-section tg-blog">
			<div class="ast-container">
				<span class="tg-intro">We love taking your call.</span>
				<div class="tg-head">
					<h2>TEFL Institute <span>guides</span></h2>
					<a href="https://teflinstitute.com/teach-english-jobs/"><img src="/wp-content/uploads/2023/05/care-arrow.svg" alt=""></a>
				</div>
				<div class="tg-guides">
					<?php foreach ( $tg_pick as $i => $g ) : ?>
					<a class="tg-cover<?php echo ( 1 === $i ) ? ' is-featured' : ''; ?>" href="<?php echo esc_url( 'https://teflinstitute.com/teach-english-abroad/' . $g[3] . '/' ); ?>">
						<span class="tg-code" aria-hidden="true"><?php echo esc_html( $g[2] ); ?></span>
						<div class="tg-top">
							<div class="tg-label">Plan for 2027</div>
							<div class="tg-rule"></div>
							<h3 class="tg-country"><?php echo esc_html( $g[0] ); ?></h3>
							<p class="tg-sub"><?php echo esc_html( $g[1] ); ?></p>
						</div>
						<div class="tg-foot"><span>Read the guide</span><span class="tg-arrow" aria-hidden="true">&rarr;</span></div>
					</a>
					<?php endforeach; ?>
				</div>
				<div class="tg-all-wrap">
					<a class="tg-all" href="https://teflinstitute.com/teach-english-jobs/">See all 63 country guides <span aria-hidden="true">&rarr;</span></a>
				</div>
			</div>
		</section>

		<?php if($frequently_asked_questions): ?>


			<section class="faq-content-section">
				<div class="ast-container">
					<div class="ast-row more-space">
						<div class="ast-col-md-12">
							<?php $i = 0; ?>
							<?php foreach($frequently_asked_questions as $item): ?>
									
								<?php $question = $item['question']; ?>
								<?php $answer = $item['answer']; ?>

								<section class="accordion-container">
									<input id="accordion-<?php echo $i ?>" name="accordion-1" type="radio" <?php if($i === 0) { ?>checked<?php } ?>>
									<label for="accordion-<?php echo $i ?>"><?php echo $question ?></label>
									<article>
										<?php echo $answer ?>
									</article>
								</section>
							<?php $i++; endforeach; ?> 
							<script type="application/ld+json">
								{
								"@context": "https://schema.org",
								"@type": "FAQPage",
								"mainEntity": [
									<?php 
									$faqcount = count($frequently_asked_questions);
									$counter = 0;
									foreach ($frequently_asked_questions as $item) {
										$counter++;
										?>
										{
											"@type": "Question",
											"name": <?php echo json_encode($item['question'], JSON_UNESCAPED_UNICODE); ?>,
											"acceptedAnswer": {
											"@type": "Answer",
											"text": <?php echo json_encode($item['answer'], JSON_UNESCAPED_UNICODE); ?>
											}
										}	
										<?php
										if ($faqcount !== $counter) echo "," ;
									}
									?>
								]
								}
							</script>	
						</div>
					</div>
				</div>
			</section>

		<?php endif; ?>

		<!--FAQ section end-->

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
