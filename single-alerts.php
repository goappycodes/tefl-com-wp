<?php

/**
 * The template for displaying all single posts.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>  
 
<?php

    $alert_page_title = get_the_title();

    $alert_banner = get_the_post_thumbnail_url();

    $alert_title = get_field('alert_title');

    $alert_content = get_field('alert_content');

    $alert_form = get_field('alert_form');

    $alert_tag = get_field('alert_tag');

?>
 
<script>

    jQuery(document).ready(function($) {

        var alert_tag = "<?php echo $alert_tag ?>";

        $("input#mailchimp_tag").val(alert_tag);

    });

    var page_url = "<?php echo get_permalink(); ?>";
    var page_title = "<?php single_post_title(); ?>";

    jQuery(document).ready(function($) {
        $("#page_url").val(page_url);
        $("#page_title").val(page_title);
    });

</script>

<div id="content" class="site-content">
    
  	<div class="ast-container">
      
        <section class="header-section">

            <div calss="ast-container">

                <div class="ast-row">

                    <div class="ast-col-lg-6">

                         <h1 class="section-heading"><?php echo $alert_title; ?></h1>

                         <p><?php echo $alert_content; ?></p>

                    </div>

                </div>
            </div>

        </section>
      
    </div>
  
  	<section class="contact-form-section">
    <div class="ast-container">
		<div class="ast-row callback-form">
		 
		 
			
			<div class="ast-col-md-8 contact-form-col">
		        <div class="callback-form-div">
                                    
              <?php echo do_shortcode($alert_form); ?>
              </div>
			</div>
		</div>
	</div>
</section>


                    
</div>

<?php
    get_footer();
?>