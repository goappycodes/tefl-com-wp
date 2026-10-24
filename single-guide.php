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

$image = get_field('image');
$title = get_field('title');
$description = get_field('description');

?>

<div id="primary" class="content-area primary">
   <section class="header-section">
      <div calss="ast-container">
         <div class="ast-row">
            <div class="ast-col-12">
              	<?php if($image) { ?>
            		<img class="image" src="<?php echo $image; ?>">
              	<?php } ?>
               <h1 class="section-heading"><?php echo $title; ?></h1>
                  <?php if (get_queried_object_id() === 107391) : ?>
                     <div>
                        <p style="text-align: center;">
                           Prefer to chat directly?
                           <a href="https://dlopo.com/school-elective/intro-call"
                              data-dlopo-embed="true"
                              style="text-decoration: underline;">
                              Book a call
                           </a>
                        </p>

                        <script>
                           window.dlopoEmbed = {
                              mode: "element",
                              ownerUsername: "chloe-joomun",
                              linkSlug: "intro-call"
                           };
                        </script>
                        <script src="https://dlopo.com/embed.js" defer></script>
                     </div>
                  <?php endif; ?>
              	<h2 class="subsection-heading"><?php echo $description; ?></h2>
            </div>
         </div>
      </div>
   </section>
   <section class="form-section">
      <div class="ast-container">
         <div class="ast-row form-box">
            <div class="ast-col-12">
               <div class="form">
               <?php 
                 $form = get_field('contact_form_7');
                 echo do_shortcode($form); 
               ?>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>

<script>
   jQuery(document).ready(function($) {
      var alert_tag = "<?php the_field('tag'); ?>";
      $("input#mailchimp_tag").val(alert_tag);

      var page_url = "<?php echo get_permalink(); ?>";
      var page_title = "<?php single_post_title(); ?>";
      
      $("#page_url").val(page_url);
      $("#page_title").val(page_title);
   });

   document.addEventListener('wpcf7submit', function(event) {
      if ('66694' == event.detail.contactFormId && event.detail.status == 'mail_sent') {
         location = "<?php the_field('pdf'); ?>";
      }
   }, false);
</script>

<?php get_footer(); ?>
