<?php 
    /*
    Template Name: Blog Archive Template
    */
    
    get_header();
    

    $current_page_id = get_the_ID();
?>


<!--Banner Section-->

<?php

$banner = get_field('banner');

$background_image        = $banner['background_image'];
$banner_title            = $banner['banner_title'];
$banner_subtitle         = $banner['banner_subtitle'];
$banner_text             = $banner['banner_text'];
$banner_cta_button_link  = $banner['banner_cta_button_link'];
$banner_cta_button_text  = $banner['banner_cta_button_text'];
$banner_logo             = $banner['banner_logo'];

?>

<section class="banner-section" style="background: url('<?php echo $background_image; ?>');">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-lg-6 ast-col-md-8">
		        <div class="banner-content-block">
		            <div class="content-block">
		                <h1 class="section-heading"><?php echo $banner_title; ?></h1>
		                <h2><?php echo $banner_subtitle; ?></h2>
		                <p><?php echo $banner_text; ?></p>
		                <img src="<?php echo $banner_logo; ?>">
						<a class="btn btn-primary" href="<?php echo $banner_cta_button_link; ?>"><?php echo $banner_cta_button_text; ?> <i class="fa fa-angle-right"></i></a>
		            </div>
		            
		        </div>
			</div>
		</div>
	</div>
</section>

<!--/Banner Section-->

<section class="search-filter-section" style="padding: 60px 0; background: var(--bg-color);">
    <div class="ast-container">
        <div class="ast-row" style="margin-bottom: 40px;">
            <div class="ast-col-md-12">
                <div class="live-search-wrapper" style="max-width: 600px; margin: 0 auto;">
                    <input type="text" id="blog-live-search" placeholder="Search blogs..." style="width: 100%; padding: 15px 30px; border-radius: 50px; border: 2px solid #000; font-size: 1rem; outline: none;">
                </div>
            </div>
        </div>
        
        <div id="search-results-container" class="ast-row">
            <?php blog_live_search_handler(); ?>
        </div>

        <div class="ast-row">
            <div class="ast-col-md-12" style="text-align: center; margin-top: 30px;">
                <button id="load-more-btn" class="btn btn-primary">LOAD MORE</button>
            </div>
        </div>
    </div>
</section>

<!--Blogs Section-->

<?php
$uncat_category_id = get_field('uncategorized_category');
$uncat_args = array(
    'post_status'   => 'publish',
    'numberposts'   => 3,
    'post_type'     => 'post',
    'category'      => $uncat_category_id,
    'orderby'       => 'date',
    'order'         => 'DESC',
);
 
$uncat = get_posts( $uncat_args ); 
?>

<?php //if($uncat): 
if(false):	
?>

<section class="blogs-section">
    <div class="ast-container">
		<div class="ast-row">
		    <?php foreach($uncat as $uc) :

    	        $post_id            = $uc->ID;
    	        $post_title         = get_the_title($post_id);
    	        $post_thumbnail_url = get_the_post_thumbnail_url($post_id);
    	        $post_link          = get_the_permalink($post_id); ?>
    		    <div class="ast-col-md-4">
    		        <div class="blog-item" style="background: url('<?php echo $post_thumbnail_url; ?>')">
						<a href="<?php echo $post_link; ?>" class="clickbox"></a>
    		            <div class="bolg-content">
    		                <h3><?php echo $post_title; ?></h3>
    		                <a class="blog-link" href="<?php echo $post_link; ?>">READ MORE <i class="fa fa-angle-right"></i></a>
    		            </div>
    		        </div>
    			</div>
		    <?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!--/Blogs Section-->


<!--Test Section-->

<?php

$english_level_test = get_field('english_level_test');

$background_image   = $english_level_test['background_image'];
$title              = $english_level_test['title'];
$content_text       = $english_level_test['content_text'];
$button_text        = $english_level_test['button_text'];
$button_link        = $english_level_test['button_link'];

?>

<section class="test-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-12">
		        <div class="take-the-test" style="background: url('<?php echo $background_image; ?>');">
		            <div class="take-the-test-content">
		                <h3><?php echo $title; ?></h3>
		                <p><?php echo $content_text; ?></p>
		                <a class="blog-link" href="<?php echo $button_link; ?>"><?php echo $button_text; ?> <i class="fa fa-angle-right"></i></a>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</section>

<!--/Test Section-->


<!--Life Story Section-->

<?php
$lsa_category_id = get_field('lsa_category');
$ls_abroad_args = array(
    'post_status'   => 'publish',
    'numberposts'   => 3,
    'post_type'     => 'post',
    'category'      => $lsa_category_id,
    'orderby'       => 'date',
    'order'         => 'DESC',
);
 
$ls_abroad = get_posts( $ls_abroad_args ); 
?>

<?php if($ls_abroad) : ?>
<section class="blogs-section life-story-abroad life-story-sec">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-12"><h2><?php echo $life_stories_abroad_section_title = get_field('life_stories_abroad_section_title'); ?></h2></div>
		    <?php foreach($ls_abroad as $ls) :
	        
    	        $post_id            = $ls->ID;
    	        $post_title         = get_the_title($post_id);
    	        $post_thumbnail_url = get_the_post_thumbnail_url($post_id);
    	        $post_link          = get_the_permalink($post_id); ?>
    	        
    		    <div class="ast-col-md-4">
    		        <div class="blog-item" style="background: url('<?php echo $post_thumbnail_url; ?>')">
						<a href="<?php echo $post_link; ?>" class="clickbox"></a>
						<div class="bolg-content">
    		                <h3><?php echo $post_title; ?></h3>
    		                <a class="blog-link" href="<?php echo $post_link; ?>">READ MORE <i class="fa fa-angle-right"></i></a>
    		            </div>
    		        </div>
    			</div>
		    <?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!--/Life Story Section-->


<!--Test Section-->

<?php

$read_story = get_field('read_story');

$background_image   = $read_story['background_image'];
$title              = $read_story['title'];
$content_text       = $read_story['content_text'];
$button_text        = $read_story['button_text'];
$button_link        = $read_story['button_link'];

?>

<section class="test-section blog-post">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-12">
		        <div class="take-the-test" style="background: url('<?php echo $background_image; ?>')">
		            <div class="take-the-test-content">
		                <h3><?php echo $title; ?></h3>
		                <p><?php echo $content_text; ?></p>
		                <a class="blog-link" href="<?php echo $button_link; ?>"><?php echo $button_text; ?> <i class="fa fa-angle-right"></i></a>
		            </div>
		        </div>
			</div>
		</div>
	</div>
</section>

<!--/Test Section-->


<!--TEFL Advice Section-->

<?php

$tefl_advice_category_id = get_field('tefl_advice_category');

$tefl_advice_args = array(
    'post_status'   => 'publish',
    'numberposts'   => 3,
    'post_type'     => 'post',
    'category'      => $tefl_advice_category_id,
    'orderby'       => 'date',
    'order'         => 'DESC',
);
 
$tefl_advice = get_posts( $tefl_advice_args ); ?>

<?php if($tefl_advice): ?>
<section class="blogs-section life-story-abroad tefl-advice-sec">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-12"><h2><?php echo $tefl_advice_section_title = get_field('tefl_advice_section_title'); ?></h2></div>
		    <?php foreach($tefl_advice as $tadvice) :
	        
    	        $post_id            = $tadvice->ID;
    	        $post_title         = get_the_title($post_id);
    	        $post_thumbnail_url = get_the_post_thumbnail_url($post_id);
    	        $post_link          = get_the_permalink($post_id); ?>
    	        
    		    <div class="ast-col-md-4">
    		        <div class="blog-item" style="background: url('<?php echo $post_thumbnail_url; ?>')">
						<a href="<?php echo $post_link; ?>" class="clickbox"></a>
						<div class="bolg-content">
    		                <h3><?php echo $post_title; ?></h3>
    		                <a class="blog-link" href="<?php echo $post_link; ?>">READ MORE <i class="fa fa-angle-right"></i></a>
    		            </div>
    		        </div>
    			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!--/TEFL Advice Section-->


<!--Discover Top Destinations-->

<section class="discover-top-destinations-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-12">
		        <div class="discover-top-destination">
		            <h2><?php echo $discover_destination_section_title = get_field('discover_destination_section_title'); ?></h2>
		            <div class="discover-top-destination-form">
		                <?php echo do_shortcode( '[contact-form-7 id="181" title="Discover Destinations Form"]' ); ?>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</section>

<!--/Discover Top Destinations-->


<!--Teaching English Section-->

<?php

$teaching_english_category_id = get_field('teaching_english_category');

$teach_eng_args = array(
    'post_status'   => 'publish',
    'numberposts'   => 3,
    'post_type'     => 'post',
    'category'      => $teaching_english_category_id,
    'orderby'       => 'date',
    'order'         => 'DESC',
);
 
$teach_eng = get_posts( $teach_eng_args ); ?>

<?php if($teach_eng): ?>
<section class="blogs-section life-story-abroad teaching-english-sec">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-12"><h2><?php echo $teaching_english_section_title = get_field('teaching_english_section_title'); ?></h2></div>
		    <?php foreach($teach_eng as $teng) :
		      
        	        $post_id            = $teng->ID;
        	        $post_title         = get_the_title($post_id);
        	        $post_thumbnail_url = get_the_post_thumbnail_url($post_id);
        	        $post_link          = get_the_permalink($post_id); ?>
        		    <div class="ast-col-md-4">
        		        <div class="blog-item" style="background: url('<?php echo $post_thumbnail_url; ?>')">
							<a href="<?php echo $post_link; ?>" class="clickbox"></a>
        		            <div class="bolg-content">
        		                <h3><?php echo $post_title; ?></h3>
        		                <a class="blog-link" href="<?php echo $post_link; ?>">READ MORE <i class="fa fa-angle-right"></i></a>
        		            </div>
        		        </div>
        			</div>
			    <?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!--/Blogs Section-->


<!--Test Section-->

<?php

$hear_from = get_field('hear_from');

$background_image   = $hear_from['background_image'];
$title              = $hear_from['title'];
$content_text       = $hear_from['content_text'];
$button_text        = $hear_from['button_text'];
$button_link        = $hear_from['button_link'];

?>

<section class="test-section blog-post" style="padding-bottom: 60px;">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-12">
		        <div class="take-the-test" style="background: url('<?php echo $background_image; ?>')">
		            <div class="take-the-test-content">
		                <h3><?php echo $title; ?></h3>
		                <p><?php echo $content_text; ?></p>
		                <a class="blog-link" href="<?php echo $button_link; ?>"><?php echo $button_text; ?> <i class="fa fa-angle-right"></i></a>
		            </div>
		        </div>
			</div>
		</div>
	</div>
</section>

<div class="ast-container">
	<div class="ast-row">
		<div class="ast-col-md-12 category-links-title"><h2 class="large-heading font-700">Read more on these topics:</h2>
	</div>
	<div class="ast-row">

	</div>
	<div class="category-links">
	<?php
	$categories = get_categories( array(
		'orderby' => 'name',
		'order'   => 'ASC'
	) );
	
	foreach( $categories as $category ) {
		$category_link = sprintf( 
			'<a href="%1$s" alt="%2$s">%3$s</a>',
			esc_url( get_category_link( $category->term_id ) ),
			esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
			esc_html( $category->name )
		);
		
		echo '<p>' . sprintf( $category_link ) . '</p> ';
	} ?> 
	</div>
	</div>
</div>


<!--/Test Section-->


<!--Search Journals Section-->

<!--<section class="search-journals">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-12">
		        <h2><?php //echo $search_journals_section_title = get_field('search_journals_section_title'); ?></h2>
		        <div class="search-form">
		            <?php //echo do_shortcode( '[contact-form-7 id="187" title="Search Journal Form"]' ); ?>
		        </div>
		        <div class="social">
		            <?php 
		            
		                /*$social_links = get_field('social_links');
		                
		                foreach($social_links as $social_link) :
		                
        		        $icon = $social_link['icon'];
                        $link = $social_link['link'];*/
                    ?>
		            <a href="<?php //echo $link; ?>"><img src="<?php //echo $icon; ?>"></i></a>
		            <?php //endforeach; ?>
		            <a href="#"><i class="fa fa-twitter"></i></a>
		            <a href="#"><i class="fa fa-google-plus"></i></a>
		            <a href="#"><i class="fa fa-youtube"></i></a>
		            <a href="#"><i class="fa fa-instagram"></i></a>
		        </div>
			</div>
		</div>
	</div>
</section>-->

<!--/Search Journals Section-->


<?php 
get_footer();