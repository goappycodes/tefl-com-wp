<?php

/**
* Template Name: Search Courses Template
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 
$search_page_about_text = get_field('search_page_about_text','options');
$course_search_title = get_field('course_search_title', 'options');
$clock_text = get_field('clock_text', 'options'); 
$video = get_field('video', 'options');
$clock_text = get_field('clock_text', 'options'); 
$user_type = isset($_GET['usertype']) ? $_GET['usertype'] : '';
$user_preference = isset($_GET['userpreference']) ? $_GET['userpreference'] : '';
$user_level = isset($_GET['userlevel']) ? $_GET['userlevel'] : '';
$user_qualification = isset($_GET['userqual']) ? $_GET['userqual'] : '';
$selected_course = '';

if($user_type && $user_preference && $user_level && $user_qualification):
    $selected_course = tefl_selected_course($user_type, $user_preference, $user_level, $user_qualification);
endif;
$selected_course_id = [];
$selected_course_text = '';
if($selected_course) :
    $selected_course_id = $selected_course['id_arr'];
    $selected_course_text = $selected_course['text'];
endif;
$course_count = 0; ?>

<div id="primary" <?php astra_primary_class(); ?>>

    <?php
        if(!empty($search_page_about_text)):
    ?>
    <section class="about-section">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <div class="about-text">
                        <?php echo $search_page_about_text?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        endif;
    ?>
    <div class="section course-result-section" id="course_result_section">
         <div class="ast-container course-result-container"> 
            <div class="ast-row ast-flex course-result-row">
                <div class="ast-col ast-col-md-12 course-result-col">
                    
                    
                    <?php if($selected_course_text) : ?>
                        <?php if($course_search_title) : ?>
                            <h1 class="section-heading common-heading large-heading"><?php echo $course_search_title; ?></h1>
                        <?php endif; ?>
                        <div class="course-search-text"><?php echo $selected_course_text; ?></div>
                    <?php endif; ?>
                    <div class="timer-container" style="display:none;">
                        <div class="tefl-timer-text"><?php echo $clock_text; ?></div>
                        <?php echo do_shortcode('[tefl_timer_shortcode]'); ?>
                    </div>
                    <?php if($selected_course_id) : ?>
                        <div class="ast-row course-row">
                            <?php foreach($selected_course_id as $cid):
                                $course_count++;
                                $course_image = get_the_post_thumbnail_url( $cid );
                          		$hero_banner = get_field('hero_banner', $cid);
                          		$course_bg_image = $hero_banner['banner_image'];
                                $course_title = get_the_title( $cid );
                                $course_link = get_post_permalink( $cid );
                                $course_price = tefl_get_course_price_html($cid);
                                $course_includes = get_field('course_benefits', $cid);
                          		$guide = get_field('guide', $cid);
                                $buy_link = tefl_buy_now_link($cid); ?>
                                <div class="ast-col-md-4 course-col">
                                    <div class="course-col-inner">
                                      	<div class="course-top">
                                        <?php if($course_count == 2): ?>
                                            <div class="recommended-banner-div btn btn-primary"><span class="recommended-banner"><i class="fa fa-star-o"></i> Most Recommended</span></div>
                                        <?php endif;?>
                                     
                                            <?php if($course_image): ?>
                                                <div class="course-img-div">
                                                    <a href="<?php echo $course_link; ?>"><img src="<?php echo $course_bg_image; ?>"></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if($course_price): ?>
                                                <div class="course-price"><?php echo $course_price; ?></div>
                                            <?php endif; ?>
                                            <?php if($course_title): ?>
                                                <h4 class="course-title"><a href="<?php echo $course_link; ?>"><?php echo $course_title; ?></a></h4>
                                            <?php endif; ?>
                                          	<div class="course-btn-div">
                                                <?php if($course_link): ?>
                                                    <a class="btn btn-primary learn-more-link" href="<?php echo $course_link; ?>">Learn More</a>
                                                <?php endif; ?>
                                            </div> 
                                          </div>
                                          	<div class="course-bottom">
                                            <?php if(!empty($course_includes)): ?>
                                                <div class="course-inc-div">
                                                    <p class="course-inc-head">This course includes:</p>
                                                    <?php foreach($course_includes as $course_include) :
                                                        $course_title = $course_include['benefit']; 
                                                        if($course_title) : ?>
                                                            <div class="course-includes">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather-check <?php if($course_count == 2): ?>recommended-icon<?php endif;?>"><polyline points="20 6 9 17 4 12"/></svg>
                                                                <div class="course-includes-txt">
                                                                    <?php echo $course_title; ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if(!empty($guide['image'])): ?>
                                              <div class="guide">
                                                <div class="title"><?php echo $guide['value']; ?></div>
                                                <img src="<?php echo $guide['image']; ?>">
                                              </div>
                                              <a class="btn btn-primary guide-link" href="<?php echo $guide['link']; ?>">Download</a>
                                            <?php endif; ?>
                                        
                                        <div class="course-btn-div" style="display:none;">
                                            <?php if($buy_link): 
                                                echo $buy_link;
                                            endif; ?>
                                            <?php if($course_link): ?>
                                                <a class="btn btn-primary learn-more-link" href="<?php echo $course_link; ?>">Learn More</a>
                                            <?php endif; ?>
                                        </div>
                                              </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                  
                    <div class="forms">
                        <div class="callback">
                            <div class="title">GET PROFESSIONAL & PERSONALISED ADVICE</div>
                            <?php echo do_shortcode("[contact-form-7 id='79744' title='Search Courses Advice']"); ?>
                        </div>
                        <div class="callback-form-img ">
                            <img class="no-lazy" src="/wp-content/uploads/2025/05/meet-the-team.jpg" alt="">
                        </div>

                        
                    </div>

                    <div class="newsletter">
                        <div class="promo">
                            <img src="https://teflinstitute.com/wp-content/uploads/2021/07/laptop_mobile-1.png">
                            <div class="title">Sign up to our newsletter and receive a 10% discount</div>
                        </div>
                        <div class="newsletter-form-container">
                            <?php echo do_shortcode("[contact-form-7 id='72610' title='Newsletter popup']"); ?>
                        </div>
                    </div>
                  
                    <div class="video">
                      	<div class="content">
                      		<div class="title">Watch this video & find out what's the difference between TEFL course and its levels</div>
                          	<a href="<?php echo $video['youtube']; ?>" data-lity class="video_player youtube_icon">Watch Now</a>
                      	</div>
                      	<a href="<?php echo $video['youtube']; ?>" data-lity class="thumbnail" style="background-image: url('<?php echo $video['thumbnail']; ?>');"></a>
                  	</div>
                  
                  	<?php
                        $frequently_asked_questions = get_field('faq','option');
                    ?>
                 	<h2 class="large-heading faqs-heading common-section-heading font-800">faqs</h2>
                  	<div class="faqs-accordion">
                        <?php
                            foreach($frequently_asked_questions as $key => $faq):
                                $faq_answer = $faq['answer'];
                                $faq_question = $faq['question'];
                        ?>
                        <div class="faqs-accordion__item <?php echo $key===0?'active':''?>">
                            <input type="checkbox" id="acc-<?php echo $key?>" name="faq-accordion" <?php echo $key===0 ?'checked':''?> hidden>
                            <label class="font-700" for="acc-<?php echo $key?>">
                                <span><?php echo $faq_question?></span>
                                <i class="fa fa-plus"></i>
                            </label>
                            <div class="faqs-accordion__content <?php echo $key===0?'active':''?>">
                                <?php echo $faq_answer?>
                            </div>
                        </div>
                        <?php 
                            endforeach
                        ?>
                        
                    </div>
                    <div class="show-more-faqs">
                        <span>Show More Faqs</span>
                    </div>
                </div>
            </div>
         </div> 
    </div>
     <script>
jQuery('document').ready(function ($) {
  
	$('.show-more-faqs').on('click', function() {
      let expandable = $(this).prev();
      expandable.toggleClass('expanded');
      isExpanded = expandable.hasClass('expanded');
      $(this).find('span').text(isExpanded ? 'Show Less Faqs' : 'Show More Faqs');
    });  
  
 	 $('.faqs-accordion__item input[type="checkbox"]').change(function() {
      if ($(this).is(':checked')) {
        $(this).parent('.faqs-accordion__item').addClass('active');
        $(this).parent('.faqs-accordion__item').find('.faqs-accordion__content ').addClass('active');
      } else {
        $(this).parent('.faqs-accordion__item').removeClass('active');
        $(this).parent('.faqs-accordion__item').find('.faqs-accordion__content ').removeClass('active');
      }
    });
  
});
</script>

    <?php $request_a_call_text = get_field('request_a_call_text', 'options');
    $form_header_image = get_field('form_header_image','options');
    $brochure_details = get_field('brochure_details','options'); ?>
    <section class="contact-form-section" style="display:none;">
        <div class="ast-container">
            <div class="ast-row">
                <div class="contact-form-section-row">
                    <div class="ast-col-md-6 contact-form-text-col">
                        <?php if($brochure_details): 
                            $brochure_heading = $brochure_details['heading'];
                            $brochure_sub_heading = $brochure_details['sub_heading'];
                            $brochure_content = $brochure_details['content']; 
                            $brochure_image = $brochure_details['brochure_image']; 
                            $brochure_link = $brochure_details['brochure_link']; ?>
                            <div class="course-brochure-details-block ast-col-md-12">
                                <?php if($brochure_heading): ?>
                                    <h6 class="section-heading"><?php echo $brochure_heading; ?> 
                                    <?php if($brochure_sub_heading): ?>
                                        <span class=""><?php echo $brochure_sub_heading; ?></span>
                                    <?php endif; ?>
                                    </h6>
                                <?php endif; ?>
                                <?php if($brochure_content): ?>
                                    <div class="section-paragraph"><?php echo $brochure_content; ?></div>
                                <?php endif; ?>
                                <?php if($brochure_image): ?>
                                    <div class="brochure-image"><img src="<?php echo $brochure_image; ?>" class="section-image"></div>
                                <?php endif; ?>
                                <?php if($brochure_link): ?>
                                    <div class="brochure-detail">
                                        <a class="btn" href="<?php echo $brochure_link; ?>" target="_blank">Download Now
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>   
                        <?php endif; ?>                 
                    </div>
                    <div class="ast-col-md-6 contact-form-col">
                        <div class="learn-more-form">
                            <div class="form-head-row">
                                <?php if($request_a_call_text): ?>
                                    <div class="contact-form-text"><?php echo $request_a_call_text; ?></div>
                                <?php endif; ?>
                                <?php if($form_header_image): ?>
                                    <img class="form-img" src="<?php echo $form_header_image; ?>">
                                <?php endif; ?>
                            </div>
                            <?php echo do_shortcode('[contact-form-7 id="57896" title="Want to Learn More?"]'); ?>
                        </div>                             
                    </div>
                </div>
            </div>
        </div>
    </section>
  

</div><!-- #primary -->

<?php get_footer(); ?>