<?php

/**
 * Template Name: Black Friday Landing Page 2023
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}
get_header(); ?>

<div id="primary" <?php astra_primary_class();  ?>>
  <!-- < Hero Banner Section > -->
  <?php
  $banner_field = get_field('banner');
  $background_image = $banner_field['background_image'];
  $banner_content     = $banner_field['banner_content'];
  $content_title      = $banner_content['title'];
  $content_summary    = $banner_content['summary'];
  $show_offer_bubbles = $banner_content['show_offer_bubbles'];
  if($show_offer_bubbles){
    $offer_bubbles = $banner_content['offer_bubbles'];
    $offer_bubble_1  = $offer_bubbles['offer_bubble_1'];
    $offer_bubble_2  = $offer_bubbles['offer_bubble_2'];
    $bubble_color    = $offer_bubbles['bubble_color'];
  }
  ?>
  <section class="black-friday-2023-hero-banner-section section-padding" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),url('<?php echo $background_image; ?>')">
    <div class="ast-container">
      <div class="ast-row ast-flex">
          <div class="ast-col-md-6 banner-inner-col">
            <div class="banner-content">
              <h1 class="text-center mb-2 banner-content__title">
                <?php echo $content_title?>
              </h1>
              <div class="banner-content__summary">
                <?php echo $content_summary?>
              </div>
            </div>
          </div>
          <?php
            if($show_offer_bubbles):
          ?>
          <div class="ast-col-md-6">
            <div class="offer-bubbles">
              <div class="offer-bubble offer-bubble-top" style="background:<?php echo $bubble_color?>;box-shadow: <?php echo $bubble_color?> 0px 22px 70px 4px;">
                <?php echo $offer_bubble_1?>
              </div>
              <div class="offer-bubble offer-bubble-bottom" style="background:<?php echo $bubble_color?>;box-shadow: <?php echo $bubble_color?> 0px 22px 70px 4px;">
                <?php echo $offer_bubble_2?>
              </div>
            </div>
          </div>
          <?php
            endif;
          ?>
      </div>
    </div>
  </section>
  <!-- < Hero Banner Section End /> -->

  <!-- < tefl-intro-info-container > -->
  <section class="full-width section-padding dark-theme-section">
    <div class="ast-container tefl-intro-info-container">
      <div class="ast-row">
        <?php
        $tefl_institute_intro = get_field('tefl_institute_intro');
        $content_title = $tefl_institute_intro['content_title'];
        $content_subtitle = $tefl_institute_intro['content_subtitle'];
        $content_description = $tefl_institute_intro['content_description'];
        // ------- Accordion Repeater Field>
        $tefl_institute_intro_accordion = $tefl_institute_intro['tefl_institute_intro_accordion'];
        ?>
        <div class="ast-col-md-5">
          <div class="tefl-institute-intro-description">
            <h2 class="content-title large-heading"><?php echo $content_title; ?></h2>
            <h4 class="content-subtitle"><?php echo $content_subtitle; ?></h4>
            <div class="main-content font-600 mt-2"><?php echo $content_description; ?></div>
          </div>
        </div>
        <div class="ast-col-md-7">
          <div class="ques-ans-section">
            <div class="ques-ans-accordion-container">
              <?php foreach ($tefl_institute_intro_accordion as $accordion) :
                $accordion_question = $accordion['accordion_title'];
                $accordion_answer = $accordion['accordion_content'];
              ?>
                <div class="ques-ans-accordion">
                  <div class="ques-ans-heading">
                    <h4 class="ques-ans-title"><?php echo $accordion_question; ?></h4>
                  </div>
                  <div class="ques-ans-content">
                    <div class="ques-ans-body"><?php echo $accordion_answer; ?></div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
  </section>
  <!-- < tefl-intro-info-container /> -->

  <!-- < Why Tefl.com section >-->
  <section class="dark-theme-section why-us-section-wrapper">
    <div class="ast-container why-us-section-container">
      <div class="ast-row">
        <div class="ast-col-md-12">
          <div class="why-us-content-block">
            <div class="ast-row">
              <?php
              $why_us = get_field('why_us');

              foreach ($why_us as $list) :
                $icon = $list['icon'];
                $column_title = $list['column_title'];
                $column_subtitle = $list['column_subtitle'];

              ?>
                <div class="ast-col-md-3 why-us-icon-descritpion">
                  <img src="<?php echo  $icon; ?>" class="why-us-icon">
                  <div class="why-us-conent">
                    <span class="why-us-title"><?php echo $column_title; ?></span>
                    <span class="why-us-sub-title"><?php echo $column_subtitle; ?></span>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- < Why Tefl.com section />-->

  <!-- < Tefl Courses Section >  -->
  <section class="dark-theme-section section-padding  tefl-courses-section-wrapper">
    <div class="tefl-courses-cards">
      <div class="ast-container">
        <?php
        $tefl_courses = get_field('tefl_courses');
        $section_title = $tefl_courses['section_title'];
        $courses = $tefl_courses['courses'];

        ?>
        <h3 class="tefl-courses-section-header large-heading"><?php echo $section_title; ?></h3>
        <div class="ast-row tefl-courses-cards-wrapper">
          <!-- --- -->
          <?php foreach ($courses as $course) :
            $course_id = $course['course'];
            $course_product_id = get_field('course_product', $course_id);
            $course_product = new WC_Product($course_product_id);
            $course_price_html = $course_product->get_price_html();
            $course_regular_price = $course_product->get_regular_price();
            $course_sale_price = $course_product->get_sale_price();
            $off_percentage = round((($course_regular_price - $course_sale_price) / $course_regular_price) * 100);
            $background_image = $course['background_image'];
            $course_hour_sticker = $course['course_hour_sticker'];

            $course_icon =  $course['course_icon'];
            $course_payment_plan = $course['course_payment_plan'];
            $message = $course['payment_plan_description'];
            $course_title = $course['course_title'];
            $course_completion_time = $course['course_completion_time'];
            $guide_link = $course['guide_link'];

          ?>
            <!-- --- -->
            <div class="ast-col-md-4">
              <div class="course-card black-friday-23-course-card" style="background-image: url('<?php echo $background_image; ?>')">
                <?php if (!empty($off_percentage) && !is_nan($off_percentage)) : ?>
                  <div class="discount-sticker">
                    <span class="discount-percent"><?php echo $off_percentage; ?>%</span>
                    <span class="discount-text">Off</span>
                  </div>
                <?php endif; ?>
                <div class="card-head">
                  <img class="course-hour-sticker" src="<?php echo $course_hour_sticker; ?>" alt="">
                </div>

                <?php
                if (false && $course_product_id == 1099) :
                ?>
                  <div class="ast-flex ast-align-items-center free_10_hour_flex">
                    <img class="free_10_hour" src="https://teflinstitute.com/wp-content/uploads/2023/11/10-TI.png">
                  </div>
                <?php endif ?>

                <div class="card-sub-head">
                  <img class="card-sub-head-img course-icon" src="<?php echo $course_icon; ?>" alt="">
                  <div class="card-subhead-content">
                    <h6 class="card-sub-head-title course-payment-plan"><?php echo $course_payment_plan; ?></h6>
                    <span class="card-sub-head-text"><?php echo $message; ?></span>
                  </div>
                </div>
                <div class="price-guide-download">
                  <div class="course-price-duration-info">
                    <h4 class="course-title text-center"><?php echo $course_title; ?></h4>
                    <?php ?>
                    <div class="course-discount-price">
                      <div class="course-price-html">
                        <?php echo $course_price_html ?>
                      </div>
                    </div>
                    <?php ?>
                    <div class="course-completion-time-info">
                      <span class="course-completion-title">Completion time</span>
                      <span class="course-completion-time"><?php echo $course_completion_time; ?></span>
                    </div>
                    <a href="<?php echo $guide_link; ?>"><button class="course-guide-download-button">Download Guide</button></a>
                  </div>
                </div>
              </div>
            </div>
            <!-- --- -->
          <?php endforeach; ?>
          <!-- --- -->



        </div>
      </div>
    </div>
    <div class="courses-content-details">

      <div class="ast-container">
        <?php
        $course_package_content = $tefl_courses['course_package_content'];
        ?>
        <div class="ast-row">
          <?php foreach ($course_package_content as $course) :
            $course_package_title = $course['course_package_title'];
            $features_include = $course['features_include'];
            $feature_exclude = $course['feature_exclude'];
            $cta_button_links = $course['cta_button_links'];
            $learn_more_button_link = $cta_button_links['learn_more_button_link'];
            $enrol_now_button_link = $cta_button_links['enrol_now_button_link'];
          ?>
            <div class="ast-col-md-4">
              <div class="course_card__bottom black-friday-23-course-card">
                <h3 class="course-card__bottom-title text-center font-600">
                  <?php echo $course_package_title ?>
                </h3>
                <div class="course-card__bottom-content features">
                  <?php
                  foreach ($features_include as $feature_included) :
                    $feature_included_list_item = $feature_included['feature'];
                  ?>
                    <div class="feature-include"><img src="/wp-content/uploads/2023/07/check.svg" alt="" class="check-icon"><?php echo  $feature_included_list_item; ?></div>

                  <?php
                  endforeach;
                  foreach ($feature_exclude as $feature_excluded) :
                    $feature_excluded_list_item = $feature_excluded['exclude'];
                  ?>
                    <div class="feature-exclude"><img src="/wp-content/uploads/2023/07/cross_muted.svg" alt="" class="cross-icon"><?php echo $feature_excluded_list_item; ?></div>
                  <?php
                  endforeach;
                  ?>
                </div>
                <div class="enrol-buttons">
                  <a href="<?php echo $learn_more_button_link; ?>" class="btn-centered"><button class="learn-more-btn">Learn More</button></a>
                  <a href="<?php echo $enrol_now_button_link; ?>" class="btn-centered"><button class="enrol-now-btn">Enrol Now</button></a>
                </div>

              </div>
            </div>
          <?php endforeach; ?>
          <div class="ast-col-md-4">

          </div>
          <div class="ast-col-md-4">

          </div>
        </div>
        <?php ?>
      </div>
    </div>
  </section>
  <!-- < Tefl Courses Section />  -->
  <!-- < Free Gift Info Section > -->
  <section class="dark-theme-section section-padding free-gift-info-section">
    <div class="ast-container">

      <div class="ast-row">
        <?php
        $free_gift_info_section = get_field('course_gifts_section', 'option');
        $gift_column = $free_gift_info_section['gifts'];
        $section_title = $free_gift_info_section['section_title'];  
        ?>
        <div class="ast-col-md-12">
          <div class="gifts-info-container">
            <div class="gift-ribbon">
              <img src="/wp-content/uploads/2023/11/gold-bow-1-1.svg" alt="">
            </div>
            <div class="animated-gif-wrapper">
              <h3 class="mb-1 text-center font-600"><?php echo $section_title?></h3>
              <?php
              global $post;
              $post_id = $post->ID;
              $user_country = get_user_geo_country_code();
              $gif_title = get_geo_banner_gifs($user_country, $post_id);
              ?>
              <img style="display:none" data-country="<?php echo $user_country ?>" class="animated-gif" src="<?php echo $gif_title; ?>" alt="">
            </div>
            <div class="course-badge-body">
              <?php
              foreach($gift_column as $index =>$course_badge):
                $course_badge_icon  = $course_badge['gift_image'];
                $course_badge_title = $course_badge['gift_title'];
              ?>  
              <div class="gift">
                <div class="badge-icon">
                  <img class="no-lazy" src="<?php echo $course_badge_icon;?>" alt="badge-icon">
                </div>
                <div class="course-badge-text">
                  <p class="badge-title mt-1"><?php echo $course_badge_title;?></p>
                </div>
              </div>
              <?php endforeach; ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- < Free Gift Details Section /> -->
  <!-- < Tefl Internship Section > -->
  <section class="dark-theme-section tefl-courses-section-wrapper">
    <div class="tefl-courses-cards">
      <div class="ast-container">
        <?php
        $tefl_courses = get_field('tefl_internships');
        $section_title = $tefl_courses['section_title'];
        $courses = $tefl_courses['courses'];
        $cta_bottom_button_link = $tefl_courses['cta_button_link'];
        ?>
        <h3 class="tefl-courses-section-header large-heading"><?php echo $section_title; ?></h3>
        <div class="ast-row">
          <!-- --- -->
          <?php foreach ($courses as $course) :
            $course_id = $course['course'];
            $course_product_id = get_field('internship_product', $course_id);
            $course_product = new WC_Product($course_product_id);
            $course_price_html = $course_product->get_price_html();
            $course_regular_price = $course_product->get_regular_price();
            $course_sale_price = $course_product->get_sale_price();
            // $off_percentage = round((($course_regular_price - $course_sale_price) / $course_regular_price) * 100);

            $background_image = $course['background_image'];
            $internship_country_name = $course['internship_country_name'];
            $course_icon =  $course['course_icon'];
            $course_payment_plan = $course['course_payment_plan'];
            $course_payment_plan_desc = $course['payment_plan_description'];
            $course_title = $course['course_title'];
            $internship_completion_time = $course['internship_completion_time'];
            $cta_button_link = $course['cta_button_link'];


            $course_regular_price = $course_product->get_regular_price();
            $course_sale_price = $course_product->get_sale_price();
            if ($course_product->is_type('variable')) :
              $course_regular_price = $course_product->get_variation_regular_price();
              $course_sale_price = $course_product->get_variation_sale_price();
            endif;
            if(!empty($course_sale_price) && !empty($course_regular_price)){
              $off_percentage = round((($course_regular_price -  $course_sale_price) /  $course_regular_price) * 100);
            }
          ?>
            <!-- --- -->
            <div class="ast-col-md-4" data-test="<?php echo $course_sale_price.'--'.$course_regular_price?>">
              <div class="course-card black-friday-23-course-card" style="background-image: url('<?php echo $background_image; ?>')">
                <?php if (!empty($off_percentage) && !is_nan($off_percentage)) : ?>
                  <div class="discount-sticker">
                    <span class="discount-percent"><?php echo $off_percentage; ?>%</span>
                    <span class="discount-text">Off</span>
                  </div>
                <?php endif; ?>
                <div class="card-head country-name-wrapper snall-heading">
                  <h3 class="country-name large-heading"><?php echo $internship_country_name; ?></h3>
                </div>
                <div class="card-sub-head">
                  <img class="card-sub-head-img course-icon" src="<?php echo $course_icon; ?>" alt="">
                  <div class="card-subhead-content">
                    <h6 class="card-sub-head-title course-payment-plan"><?php echo $course_payment_plan; ?></h6>
                    <span class="card-sub-head-text"><?php echo $course_payment_plan_desc?></span>
                  </div>
                </div>
                <div class="price-guide-download">
                  <div class="course-price-duration-info">
                    <h4 class="course-title text-center"><?php echo $course_title; ?></h4>
                    <div class="course-discount-price">
                      <div class="course-price-html">
                        <?php echo $course_price_html ?>
                      </div>
                    </div>
                    <div class="course-completion-time-info">
                      <span class="course-completion-title">Placement duration</span>
                      <span class="course-completion-time"><?php echo $internship_completion_time; ?></span>
                    </div>
                    <a href="<?php echo $cta_button_link; ?>"><button class="course-guide-download-button">Learn More</button></a>
                  </div>
                </div>
              </div>
            </div>
            <!-- --- -->
          <?php endforeach; ?>
          <!-- --- -->
        </div>
        <div class="ast-row">
          <div class="ast-col-md-4">

          </div>
          <div class="ast-col-md-4">
            <div class="internship-cta-large-button">
              <a href="<?php echo $cta_bottom_button_link ?>"><button class="view-all-intership-button">view all internships</button></a>
            </div>
          </div>
          <div class="ast-col-md-4">

          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- < Tefl Internship Section /> -->
  <!-- < Verified Student Reviews > -->
  <?php
  $verified_reviews_section = get_field('verified_reviews_section');
  if ($verified_reviews_section) :
    $section_stitle = $verified_reviews_section['section_subtitle'];
    $section_title = $verified_reviews_section['section_title'];
    $reviews_widget = $verified_reviews_section['reviews_widget'];
    $total_reviews_count    = isset($reviews_widget['total_reviews']) ? $reviews_widget['total_reviews'] : 1570;
    $five_star_percentage   = isset($reviews_widget['star_percentage_5']) ? (float)$reviews_widget['star_percentage_5'] : 0;
    $four_star_percentage   = isset($reviews_widget['star_percentage_4']) ? (float)$reviews_widget['star_percentage_4'] : 0;
    $three_star_percentage  = isset($reviews_widget['star_percentage_3']) ? (float)$reviews_widget['star_percentage_3'] : 0;
    $two_star_percentage    = isset($reviews_widget['star_percentage_2']) ? (float)$reviews_widget['star_percentage_2'] : 0;
    $one_star_percentage    = isset($reviews_widget['star_percentage_1']) ? (float)$reviews_widget['star_percentage_1'] : 0;

    $reviews_average = (($five_star_percentage * 5) + ($four_star_percentage * 4) + ($three_star_percentage * 3) + ($two_star_percentage * 2) + ($one_star_percentage * 1)) / 100;
  ?>
    <section class="verified-student-reviews-section pt-5 section-padding dark-theme-section">
      <div class="ast-container">
        <div class="ast-row ">
          <div class="verified-student-reviews-section__header">
            <div class="ast-col-md-6">
              <h2 class="large-heading common-section-heading verified-student-reviews-section__title">
                <?php echo $section_title ?>
              </h2>
              <span class="verified-student-reviews-section__subtitle">
                <?php echo $section_stitle ?>
              </span>
            </div>
            <div class="ast-col-md-6">
              <div class="reviews-average">
                <div class="rating-div">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half-empty"></i>

                </div>
                <div class="total-count-text font-600"><span class="course-review-count">(<?php echo $reviews_average; ?>)</span> Out of <?php echo $total_reviews_count ?> global reviews</div>
              </div>
            </div>
          </div>
        </div>
        <div class="spacer-column"></div>
        <div class="ast-row verified-student-reviews-section__row">
          <div class="verified-student-reviews-section__row">
            <div class="equal-height ast-col-md-5">
              <div class="verified-student-reviews-section__review-summary">
                <?php for ($i = 5; $i >= 1; $i--) :
                  $star_percentage = $reviews_widget['star_percentage_' . $i];
                  if (empty($star_percentage)) :
                    $star_percentage = 0;
                  endif; ?>
                  <div class="review-status">
                    <div class="progress-text"><?php echo $i; ?> Star</div>
                    <div class="progress">
                      <div class="progress-bar" percent="<?php echo $star_percentage; ?>">
                      </div>
                    </div>
                    <div class="progress-value"><?php echo $star_percentage; ?>%</div>
                  </div>
                <?php endfor; ?>
              </div>
              <div class="rplg rplg-insert" data-id="77247">

              </div>
            </div>
            <div class="equal-height ast-col-md-7 verified-student-reviews-section__slider">
              <?php echo do_shortcode('[brb_collection id="77247"]'); ?>
            </div>
          </div>
        </div>
      </div>
    </section>

  <?php
  endif
  ?>
  <!-- < Verified Student Reviews /> -->
  <!-- < Specialist Course Section > -->
  <section class="dark-theme-section section-padding-top specialist-course-section-wrapper">
    <div class="specialist-courses-cards">
      <div class="ast-container">
        <?php
        $specialist_courses = get_field('specialist_courses');
        $section_title = $specialist_courses['section_title'];
        $specialist_bottom_cta_link = $specialist_courses['specialist_cta_link'];
        ?>
        <h3 class="specialist-course-section-header large-heading"><?php echo $section_title; ?></h3>
        <div class="ast-row">
          <?php $course_card = $specialist_courses['course_card'];
          foreach ($course_card as $card) :
            $course_id =  $card['course'];
            $course_product_id = get_field('course_product', $course_id);
            $course_product = new WC_Product($course_product_id);
            $course_price_html = $course_product->get_price_html();
            $course_regular_price = $course_product->get_regular_price();
            $course_sale_price = $course_product->get_sale_price();
            $off_percentage = round((($course_regular_price - $course_sale_price) / $course_regular_price) * 100);
            $background_image = $card['background_image'];
            $card_top_sticker = $card['card_top_sticker'];
            $course_title = $card['course_title'];
            $course_completion_time = $card['course_completion_time'];
            $card_cta_link = $card['card_cta_link'];
          ?>
            <div class="ast-col-md-4">
              <div class="specialist-course-card black-friday-23-course-card">
                <?php if (!empty($off_percentage) && !is_nan($off_percentage)) : ?>
                  <div class="discount-sticker">
                    <span class="discount-percent"><?php echo $off_percentage; ?>%</span>
                    <span class="discount-text">Off</span>
                  </div>
                <?php endif; ?>
                <div class="card-top" style="background-image: url('<?php echo $background_image; ?>');">
                  <img class="specialist-course-sticker" src="<?php echo $card_top_sticker; ?>" alt="">
                </div>
                <div class="card-body">
                  <div class="specialist-course-discount-price">
                    <div class="course-price-html">
                      <?php echo $course_price_html ?>
                    </div>
                  </div>
                  <div class="course-type">
                    <span><?php echo $course_title ?></span>
                    <span>Specialist Course</span>
                  </div>
                  <div class="course-duration">
                    <span>Completion time</span>
                    <span><?php echo $course_completion_time; ?></span>
                  </div>
                  <a href="<?php echo $card_cta_link; ?>"><button class="specialist-course-cta">Learn More</button></a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <!-- <div class="specialist-course-cta-large-button">
          <a href="<?php echo  $specialist_bottom_cta_link ?>"><button class="view-all-specialist-course-button">view all specialist courses</button></a>
        </div> -->
        <div class="ast-row">
          <div class="ast-col-md-3">

          </div>
          <div class="ast-col-md-6 specialist-course-btn-column">
            <div class="specialist-course-cta-large-button ">
              <a href="<?php echo $specialist_bottom_cta_link ?>"><button class="view-all-specialist-course-button">View All Specialist Courses</button></a>
            </div>
          </div>
          <div class="ast-col-md-3">

          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- < Specialist Course Section /> -->

  <!-- < Trial Section > -->
  <section class="section-padding dark-theme-section trial-section-wrapper">
    <div class="ast-container trial-section-container">
      <div class="ast-row">
        <?php
        $trial_section = get_field('level_test_and_salary_calculation_section');
        foreach ($trial_section as $card) :
          $background_image = $card['background_image'];
          $card_icon =  $card['card_icon'];
          $card_title = $card['card_title'];
          $card_description =  $card['card_description'];
          $cta_buttons = $card['cta_buttons'];
          // ----
          $cta_text = $cta_buttons['cta_text'];
          $cta_link = $cta_buttons['cta_link'];
        ?>
          <div class="ast-col-md-6">
            <div class="trial-card" style="background:url('<?php echo $background_image; ?>;')">
              <div class="trial-card-content">
                <img class="trial-card-icon" src="<?php echo $card_icon; ?>" alt="">
                <h6 class="trial-card-title"><?php echo $card_title; ?></h6>
                <div class="trial-card-description"><?php echo $card_description; ?></div>
                <a href="<?php echo $cta_link; ?>"><button class="trial-card-button"><?php echo $cta_text; ?></button></a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
  </section>
  <!-- < Trial Section > -->
  <!-- < Partners Accreditations Section >-->
  <section class="section-padding dark-theme-section partners-accreditations-wrapper">
    <div class="ast-container partners-accreditations-container">
      <div class="ast-row partners-accreditations-row">
        <div class="ast-col-md-12 partners-accreditations-column">
          <?php
          $partners_accreditations_section = get_field('partners_accreditations_section');
          $section_title = $partners_accreditations_section['section_title'];

          ?>
          <div class="partners-accreditations-heading">
            <h3 class="large-heading"><?php echo $section_title; ?></h3>
          </div>
          <div class="">
            <div class="partners-logo-wrapper partners-logo-row">
              <?php
              $logo_container = $partners_accreditations_section['logo_container'];
              ?>
              <?php foreach ($logo_container as $partners_logo) : ?>
                <div class="partners-logo">
                  <img src="<?php echo $partners_logo['logo']; ?>" alt="">
                </div>
              <?php endforeach; ?>


            </div>

            <div class="accreditations-container">
              <div class="accreditations-container-row">
                <?php
                $lists = $partners_accreditations_section['lists'];
                foreach ($lists as $accreditation_list) :
                ?>

                  <div class="ast-col-md-3">
                    <div class="accreditations-point"><i class="fa fa-check"></i><span class="accreditations-point-text"><?php echo $accreditation_list['accreditation_item']; ?></span></div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

          </div>
        </div>
      </div>
  </section>
  <!-- < Partners Accreditations Section />-->
</div>

<?php get_footer(); ?>