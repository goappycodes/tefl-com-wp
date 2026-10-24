<?php
  $what_comes_next  = get_field('what_comes_next');
  if($what_comes_next){
    $background_image = $what_comes_next['background_image'];
    $title            = $what_comes_next['title'];
    $text_color       = $what_comes_next['text_color'];
  }
?>

<section id="after-course" class="after-course-section">
  <div class="overlay-section " style="background-image: url('<?php echo esc_url($background_image); ?>');">
    <div class="ast-container">
      <div class="section-container">
        <h3 class="content-title" style="color: <?php echo esc_attr($text_color); ?>;">
          <?php echo esc_html($title); ?>
        </h3>
        <img class="title-underline" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/vector3.svg" alt="Underline">

        <p class="subtitle">Once you complete the course, you can:</p>

        <?php if (have_rows('course_outcome')): ?>
          <ul class="course-outcome-list">
            <?php while (have_rows('course_outcome')): the_row(); 
              $outcome = get_sub_field('outcome'); ?>
              <li><?php echo esc_html($outcome); ?></li>
            <?php endwhile; ?>
          </ul>
        <?php else: ?>
          <p>No course outcomes found.</p>
        <?php endif; ?>
      </div>
    </div>

    <div class="torn-bottom">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Vector1.svg" class="torn-left" alt="Torn Left">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Vector2.svg" class="torn-right" alt="Torn Right">
    </div>
  </div>
</section>
