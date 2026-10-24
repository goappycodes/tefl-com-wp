 <?php 
        $background_image  = get_field('background_image');
        $heading           = get_field('heading');
        if($heading){
            $heading_text = $heading['heading_text'];
            $text_color   = $heading['text_color'];
        }
    ?>
    <!-- Hero section  -->
    <div  class="has-overlay hero-section" style="background-image: url('<?php echo $background_image?>')">
        <div class="ast-container">
            <div class="section-inner">
               
                <h1 class = "hero-heading" style="color : <?php echo $text_color; ?>;margin:0">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Layer_1.svg" alt="Hero Logo" class="hero-logo" /> 
                    <?php echo  $heading_text; ?>
                </h1>
            </div>
        </div>       
    </div>
   <section class="accreditation-section secondary-bg">
    <div class="ast-container">
        <div class="accreditation-partner-container">
            <div class="accreditation-box">
                <span class="label">Our accreditation partners</span>
                <div class="logos">
                    <?php
                        $our_accreditation_partner = get_field('our_accreditation_partner');

                        $partners = $our_accreditation_partner['accreditation_partner'];
                        foreach ($partners as $logo_url): ?>
                        <img src="<?php echo esc_url($logo_url); ?>" alt="Partner Logo">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
