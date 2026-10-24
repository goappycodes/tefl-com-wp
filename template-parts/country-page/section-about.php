  <?php 
        $about = get_field('about');
        if($about){
            $about_text     = $about['about_heading'];
            $description    = $about['about_description'];
            $about_image    = $about['about_image'];
        }
    ?>
    <?php if($about): ?>
        <section class="about-section secondary-bg">
            <div class="ast-container">
                <div class="about-container">
                    <div class="about-content ptb-50">
                        <h2 class="about-heading"><?php echo $about_text; ?></h2>
                        <p class="about-description"><?php echo $description; ?></p>
                    </div>
                    <div class="about-image-container image-wrapper">
                        <img class="about-image" src="<?php echo $about_image; ?>" alt="About Image">
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>