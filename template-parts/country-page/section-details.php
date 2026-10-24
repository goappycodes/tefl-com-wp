<?php 
    $why_learners_choose_us = get_field('why_learners_choose_us');
    if($why_learners_choose_us){
        $title              = $why_learners_choose_us['title'];
        $content            = $why_learners_choose_us['text_color'];
        $description        = $why_learners_choose_us['description'];
        $background_image   = $why_learners_choose_us['background_image'];
    }
    $what_the_course_includes  = get_field('what_the_course_includes');
    if($what_the_course_includes){
        $course_includes_title              = $what_the_course_includes['title'];
        $course_includes_description        = $what_the_course_includes['description'];
        $course_includes_background_image   = $what_the_course_includes['background_image'];
    }
?>
<section id="course-details" class="secondary-bg">
    <div class="ast-container">
          <div class="ast-row">
                    <div class="ast-flex">
                              <?php if($why_learners_choose_us): ?>
                                    <div class="ast-col-md-6">
                                        <div class="exp-cta-card">
                                            <?php if($background_image): ?>
                                                <div class="exp-cta-card__image-header exp-cta-card__image-header" style = "background-image: url('<?php echo $background_image; ?>');">
                                                   <h3 class="why_learner_choose_us_title" style="color:<?php echo $content; ?>"><?php echo $title  ?></h3>
                                                </div>
                                            <?php endif; ?>
                                            <div class="exp-cta-card__body">
                                                <?php if($description):?>
                                                    <div class="exp-cta-card__body-content">
                                                        <?php echo $description; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($what_the_course_includes): ?>
                                <div class="ast-col-md-6">
                                    <div class="exp-cta-card">
                                        <?php if($course_includes_background_image): ?>
                                            <div class="exp-cta-card__image-header exp-cta-card__image-header" style = "background-image: url('<?php echo $course_includes_background_image; ?>');">
                                                   <h3 class="why_the_course_include" style="color:<?php echo $content; ?>"><?php echo $course_includes_title  ?></h3>
                                                </div>
                                        <?php endif; ?>
                                        <div class="exp-cta-card__body">
                                            <?php if($course_includes_description): ?>
                                                <div class="exp-cta-card__body-content">
                                                        <?php echo $course_includes_description; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                    </div>
                   
                </div>
    </div>
</section>