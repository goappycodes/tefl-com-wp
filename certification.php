<?php
/**
* Template Name: TEFL Certification
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


<?php $frequently_asked_questions = get_field('faqs'); ?>

<section class="tefl-institute-london-section faq-section" style="margin-bottom: 40px">
    <div class="ast-container">
        <div class="ast-row more-space">
        	<div class="ast-col-md-12">
        	    <h2 style="text-align:center" class="section-heading"><?php the_field('faq_header'); ?></h2>
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
        									"name": <?php echo json_encode($item['question']); ?>,
        									"acceptedAnswer": {
        									  "@type": "Answer",
        									  "text": <?php echo json_encode($item['answer']); ?>
        									}
        								}	
        								<?php
        								if ($faqcount != $counter) echo "," ;
        							}
        							?>
        						  ]
        						}
        		</script>						
        		
        	</div>
        </div>
	</div>
</section>

<section class="tefl-institute-london-section seo-section" style="margin-bottom: 40px">
    <div class="ast-container">
        <div class="ast-row more-space">
        	<div class="ast-col-md-12">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	
</section>
<style>
section.tefl-institute-london-section h2, section.tefl-institute-london-section h1 {
	margin-bottom: 10px;
	font-weight: bold;
	text-transform: uppercase;
}	
</style>

<?php get_footer(); ?>