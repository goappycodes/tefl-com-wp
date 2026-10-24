<?php 
/*
Template Name: Page Template with TOC
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>
	    
	    <div class="toc_body"> <ol  id="toc_body"> </ol> </div>

		<?php astra_primary_content_top(); ?>
        
        <!-- <div id="maincontent">
			<?php /* astra_content_page_loop(); */ ?>
        </div> -->
		
		<?php $content = get_field('content'); ?>
		<div class="content-container">
			<h1><?php single_post_title(); ?></h1>

			<?php if($content){
				echo $content;
			}else{
				echo get_the_content();
			} ?>
			
		</div>

		<?php $accordion = get_field('accordion'); ?>

		<?php $i = 0; ?>
		<?php if($accordion): 
    		foreach($accordion as $element): 
    			$title = $element['title']; 
    			$bookmark = $element['bookmark']; 
    			$questions_answers = $element['questions_answers']; ?>
    			<div id="<?php echo $bookmark ?>">
    				<h3><?php echo $title ?></h3>
    				<?php foreach($questions_answers as $element): 
    					$title = $element['title']; 
    					$content = $element['content']; ?>
    					<section class="accordion-container">
    						<input id="accordion-<?php echo $i ?>" name="accordion-1" type="radio" <?php if($i === 0) { ?>checked<?php } ?>>
    						<label for="accordion-<?php echo $i ?>"><?php echo $title ?></label>
    						<article>
    							<?php echo $content ?>
    						</article>
    					</section>
    
    				    <?php $i++; 
    				endforeach; ?>
    			</div>
    		<?php endforeach;
    	  endif; ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<script>
jQuery(document).ready(function(){
    
	var toc = "";
	var level = 0;
	var container = document.querySelector('.entry-content');
	var output = '#toc_body';
	
	console.log(container);

	container.innerHTML =
		container.innerHTML.replace(
		/<h([\d])>([^<]+)<\/h([\d])>/gi,
		function (str, openLevel, titleText, closeLevel) {
		    
		    if(openLevel == 1 || openLevel ==2  || openLevel ==3 || openLevel == 4 || openLevel == 5 || openLevel == 6){
		        return str;
		    }
		    
			if (openLevel != closeLevel) {
				return str;
			}

			toc += (new Array(1)).join('</li>');

			level = parseInt(openLevel);
			
			tempTitle = titleText.replace(/[1.2.3.4.5.6.7.8.9.10.]/g,"");
			
			var anchor = titleText.replace(/[ ?().!,$#@]/g, "_");

			toc += '<li><a href="#' + anchor + '">' + tempTitle
				+ '</a>';



			return '<h' + openLevel + ' id="' + anchor + '">'
				+ titleText + '</h' + closeLevel + '>';
		}
	);

	if (level) {
		toc += (new Array(level + 1)).join('</ul>');
	}

	document.querySelector(output).innerHTML += toc;
});
</script>

<style>

/*FAQ css*/

section.faq-hero-section .ast-container{
	background-size: cover !important;
	background-repeat: no-repeat !important;

}

section.faq-hero-section .banner-text-row {
	padding: 10% 2%;
	background-color: #00000073;
}

h3 {
	padding: 15px 0;
}
ol {
    margin: 10px 0 10px 20px;
}
.banner-text {
	color: #fff;
	font-size: 1.875rem;
	text-transform:uppercase;
	font-weight: 500;
	line-height: 2.6rem;
	letter-spacing: 0.6rem;
}
.accordion-container label {
	color: #fff;
	font-size: 0.688rem;
    font-weight: 500;
    line-height: 1.34rem;
    letter-spacing: 0.3rem;
	text-transform: uppercase;
  	display: block;
  	cursor: pointer;
  	padding: 15px 35px;
  	background: #000000;
}

.accordion-container {
  margin: 1px auto;
}

.accordion-container input {
  display: none;
}

.accordion-container article {
  overflow: hidden;
  height: 0;
}

.accordion-container input:checked ~ article {
  height: auto;	
  padding: 15px 35px;
}

.more-space {
    margin-bottom: 2em;
}

/* .content-container {
    padding: 0 30px 30px 30px;
} */

.content-container h1 {
	margin-bottom: 15px;
}

@media(max-width: 767px) {
	section {
		padding: 0 15px;
		margin-bottom: 25px;
	}

	.banner-bottom-row .banner-link-col {
		max-width: 33.33%;
		padding: 0;
	}

	.banner-text {
		font-size: 1.5rem;
		letter-spacing: 0.4rem;
	}

	section.homepage-hero-section .ast-container {
		background-position: 35%;
	}
}

</style>

<?php get_footer(); ?>
