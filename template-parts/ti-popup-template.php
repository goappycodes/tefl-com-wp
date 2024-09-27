<?php 
$guide_popup = get_field('guide_popup'); 
if($guide_popup) : 
    $popup_image = $guide_popup['popup_image'];
    $popup_title = $guide_popup['popup_title'];
    $popup_subtitle = $guide_popup['popup_subtitle'];
    $brochure_url = $guide_popup['brochure_url'];
    if($popup_image && $popup_title && $popup_subtitle && $brochure_url): ?>
        <div class="exit-intent-popup">
            <div class="popup-content">
                <span class="close">x</span>
                <div class="popup-content-inner">
                    <div class="popup-img">
                        <img src="<?php echo $popup_image; ?>">
                    </div>
                    <h4><?php echo $popup_title; ?></h4>
                    <p><?php echo $popup_subtitle; ?></p>
                    <a class="view-form">Download Here</a>
                </div>
                <div id="brochure_form_div">
                    <?php echo do_shortcode('[contact-form-7 id="63500" title="TEFL Internship Brochure Form"]'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <script>
        jQuery(document).ready(function($){
            setTimeout(() => {
               $(".selected-guide input").attr("value", "<?php echo $brochure_url; ?>"); 
            }, 500);
            
        })
    </script>
<?php endif; ?>
