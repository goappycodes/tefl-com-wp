<?php
    $accredation_heading = get_field('accredation_heading');
    if($accredation_heading){
        $accreditation_heading_text     = $accredation_heading['accredation_heading_text'];
        $text_color                     = $accredation_heading['text_color'];
    }

    $accredation_title  =  get_field('title');
    if($accredation_title){
        $accredation_title_text     = $accredation_title['title_text'];
        $accredation_title_color    = $accredation_title['accredation_title_color'];
    }

    $accreditations = get_field('accreditations');   
?>

<section id="accreditation" class="secondary-bg ptb-50">
    <div class="ast-container">
        <!-- Headings -->
        <div>
            <h3 class="reviewer-name font-bold m-0 text-center large-heading">
                <?php echo $accreditation_heading_text ?>
            </h3>
            <h4 class="text-center">
                <?php echo $accredation_title_text ?>
            </h4>
        </div>

        <!-- Accreditation Blocks -->
        <div class="accreditations-container">
            <?php
                $description = get_field('accre_description');
                foreach ($accreditations as $key => $accreditation):
                    $accred_title   = $accreditation['title'];
                    $accred_logo    = $accreditation['logo'];
                    $accred_status  = $accreditation['status'];
                    $country_icon   = $accreditation['country_icon'];
            ?>
                <div class="accreditation">
                    <!-- Country + Status -->
                    <span class="accreditation-title">
                        <img src="<?php echo $country_icon ?>" alt="" class="no-lazy">
                        <?php echo $accred_status . ":"; ?>
                    </span>
                    <img src="<?php echo $accred_logo ?>" alt="" class="no-lazy accreditation-logo">
                    <span class="font-600"><?php echo $accred_title ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Description -->
        <div class="accreditation-description">
            <p><?php echo $description; ?></p>
        </div>
    </div>
</section>
