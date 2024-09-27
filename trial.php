<?php

/**
 * Template Name: 3 Days Free Trial
 * 
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Przemysław Solan <przemek.solan@tefl.ie>
 * @date 8th May 2023
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" class="content-area primary">
    
    <?php $hero = get_field('hero'); ?>
  	<div class="section banner-section" style="background-image: url(https://tefl.ie/wp-content/uploads/2021/09/elt-bg.jpg)">
        <div class="ast-row">
            <div class="ast-col-md-12">	
            	<h1 class="elt-heading"><?php echo $hero['title']; ?></h1>
            </div>
        </div>
        <div class="ast-row">
            <div class="ast-col-md-2"></div>
            <div class="ast-col-md-8 banner-content-col">
            	<div class="ast-row">
            		<div class="ast-col-md-5 banner-content-img-col">
            			<div class="banner-content-img">
            				<img src="<?php echo $hero['image']; ?>">
            			</div>
            		</div>
            		<div class="ast-col-md-7 banner-content-txt-col">
            			<div class="banner-content-inner">
                        	<div class="banner-content-txt-wrap heading"><?php echo $hero['heading']; ?></div>
            				<div class="banner-content-txt-wrap content"><?php echo $hero['content']; ?></div>
                          	<div class="warning"><?php echo $hero['warning_text']; ?></div>
                          	<div class="secure"><?php echo $hero['safe_&_secure']; ?></div>
                          	
							<span class="wpcf7-list-item"><input class="checkbox" type="checkbox" oninput="msg(this)" name="permission" value="I give my permission to TEFL Institute to email me">I have read and agree to the <a href="/terms-conditions" target="_blank">terms & conditions</a> and <a href="/privacy" target="_blank">privacy policy</a>.</span>
                            <div class="img-btn-div" id="img-btn-div" style="display:none;">
                            	<a class="english-test-btn btn btn-secondary yellow-btn" href="/?addtimetocart&prid=77294">Start your Free Trial</a>
                            </div>
							<script>
							function msg(is) {
								var btn = document.getElementById('img-btn-div');
								if(is.checked) {
									btn.style.display = 'flex';
								} else {
									btn.style.display = 'none';
								}
							}
						</script>
            			</div>
            		</div>
            	</div>
       		</div>
          	<div class="ast-col-md-2"></div>
        </div>
	</div>
    
    <?php $why = get_field('why'); ?>
  	<div class="section elt-feat-section">
        <div class="ast-container elt-feat-container">
            <div class="ast-row elt-feat-head-row">
            	<div class="ast-col-md-12">
            		<h3 class="elt-sec-heading"><?php echo $why['title']; ?></h3>
            	</div>
            </div>
            <div class="ast-row elt-feat-content-row">
              	<?php  
                	foreach($why['points'] as $e):
                        $icon = $e['icon'];
                        $heading = $e['heading'];
              			$text = $e['text'];
                ?>
            	<div class="ast-col-md-4 elt-feat-content-col">
            		<div class="elt-feat-inner">
             			<div class="img-div">
            				<img src="<?php echo $icon; ?>">
            			</div>
            			<h5><?php echo $heading; ?></h5>
            			<p><?php echo $text; ?></p>
                    </div>
                </div>
              	<?php endforeach; ?>
            </div>
        </div>
    </div>

</div>
   
<?php get_footer(); ?>