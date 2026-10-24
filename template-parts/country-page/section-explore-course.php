<?php 
    $courses  = get_field('courses');
    if($courses){
        $course_image           = $courses['course_image'];
        $course_name            = $courses['course_name'];
        $course_description     = $courses['course_description'];
        $button                 = $courses['button'];
    }
?>

<section id="tefl_reviews" class="reviews ptb-50 secondary-bg">
  <div class="ast-container">
      <div class="section-inner">
        <div class="tefl-review">
                <div class="client-review">
                    <?php if($course_image): ?>
                        <div class="client-photo">    
                            <img src="<?php echo $course_image; ?>" alt="<?php echo $course_name; ?>" class="client-img">
                        </div>
                    <?php endif; ?>
                    <div class="client-info review-content course-card">
                        <div class="reviewer-info">
                            <h3 class="reviewer-name font-bold m-0"><?php echo $course_name; ?></h3>
                        </div>
                        <div class="client-review"><?php echo $course_description; ?></div>
                        <div>
                            <?php
                                if($button){
                                    $button_text    = $button['button_text'];
                                    $button_link    = $button['button_link'];
                                    $button_color   = $button['button_color'];
                                }
                            ?>
                            <a target="_blank" href="<?php echo $button_link; ?>" class="btn btn-primary" style="background-color:<?php echo $button_color; ?>"><?php echo $button_text; ?></a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
  </div>
</section>