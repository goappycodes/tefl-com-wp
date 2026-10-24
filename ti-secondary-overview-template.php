<?php

/**
 * Template Name: Secondary Overview Landing
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram Rana <bikram@appycodes.com>
 * @date June 2023
 */


 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>
<div id="primary" <?php astra_primary_class(); ?>>
        <!-- Hero Banner Section start -->
        <?php 
            $hero_banner = get_field('hero_banner');
            if(!empty ($hero_banner)):
            $banner_background = $hero_banner['banner_background'];
            $banner_content    = $hero_banner['banner_content'];
            $banner_title      = $banner_content['banner_title'];
            $sub_title         = $banner_content ['sub_title'];
            $sub_content       = $banner_content ['sub_content'];
        ?>
            
            <section class="hero-banner-section" style="background:url(<?php echo $banner_background?>)">
                <div class="ast-container">
                    <div class="ast-row">
                        <div class="ast-col-md-6">
                        <div class="hero-banner-section__content">
                                <h1 class="hero-banner-title mt-1 mb-1">
                                    <?php echo $banner_title?>
                                </h1>
                                <div class="hero-banner-subtitle mb-2">
                                        <?php echo $sub_title?>
                                    </div>
                                    <div class="hero-banner-section__content-summary mt-1">
                                        <?php echo $sub_content?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- Hero Banner section end -->
    
        <!-- Features section start -->
        <?php
        $features = get_field('features');
        ?>
        
        <div class="ast-container">
            <div class="ast-row">
                <div class="features section-top">
                    <?php foreach($features as $e) {
                        $title = $e['title'];
                        $subtitle = $e['subtitle']; ?>
                        <div class="ast-col-md-3 ast-col-xs-12">
                            <div class="features-inner">
                                <img src="/wp-content/uploads/2023/08/Group-1.svg">
                                <div class="feature">
                                    <div class="title"><?php echo $title; ?></div>
                                    <div class="subtitle"><?php echo $subtitle; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Features section end -->

        <!-- explanation section start -->
        <?php $explanation = get_field('explanation'); ?>
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12 explanation">
                    <div class="image" style="background-image: url('<?php echo $explanation['image']; ?>');"></div>
                    <div class="explanation-inner">
                        <div class="title mb-1"><?php echo $explanation['title']; ?></div>
                        <div class="subtitle mb-1"><?php echo $explanation['subtitle']; ?></div>
                        <div class="content"><?php echo $explanation['content']; ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- explanation section end -->

        <!-- courses section start -->
        <?php 
        $thirty_hours_courses_features = get_field('30_hours_courses_features');
        $thirty_hour_tefl_courses = get_field('30_hour_tefl_courses');
        ?>

        <section class="specialists-tefl-course section-top">
            <div class="ast-container">
                <div class="ast-row ">
                    <div class="ast-col-md-12">
                        <h2 class="course-title">
                            Specialist TEFL Courses
                        </h2>
                    </div>
                    <div class="ast-col-md-12">
                        <div class="specialist-courses">
                            <div class="ast-col-md-3">
                                <div class="clock-sidebar">
                                    <?php echo do_shortcode('[tefl_timer_shortcode timer="sale"]'); ?>
                                </div>
                                <div class="features-div">
                                <?php if ($thirty_hours_courses_features) :
                                        foreach ($thirty_hours_courses_features as $key => $element) : 
                                ?>
                                    <div class="feat-<?php echo $key + 1; ?>"><?php echo $element['feature']; ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>  
                                </div>
                            </div>

                            <?php 
                                if ($thirty_hour_tefl_courses) :
                                    foreach($thirty_hour_tefl_courses as $index => $hour_tefl_course):
                                        $course_icon = $hour_tefl_course['icon'];
                                        $course_title = $hour_tefl_course['title'];
                                        $course_product_id = $hour_tefl_course['product'];
                                        if($course_product_id){
                                            $course_products = wc_get_product($course_product_id);
                                            if($course_products){
                                                $hour_tefl_course_price = $course_products->get_price_html();
                                            }
                                        }

                                        $link       = $hour_tefl_course['link'];
                                        $duration   = $hour_tefl_course['duration'];
                                        $features   = $hour_tefl_course['features'];
                                        $study_time = $hour_tefl_course['study_time'];
                                        $pick_dates = $hour_tefl_course['pick_dates'];
                                        $trial      = $hour_tefl_course['trial']; 
                                ?>
                                    <div class="ast-col-md-3 ast-col-xs-12 ">
                                        <div class ="specialist-courses-inner">
                                            <div class="course-icon">
                                            <img  src="<?php echo $course_icon?>" alt="icon" >
                                            </div>
                                            <div class="course-heading"><?php echo $course_title?></div>
                                            <div class="course-price"><?php  echo $hour_tefl_course_price?> </div>
                                            <div class="course-duration"><?php echo $duration?></div>

                                            <?php if ($features) : ?>
                                                <div class="features-div-icons">
                                                    <div class="feat-1">
                                                        <span>Personal Tutor Support</span>
                                                        <?php echo $features['personal_tutor_support']; ?>
                                                    </div>
                                                    <div class="feat-2">
                                                    <span>Internationally Recognized Cert</span>
                                                        <?php echo $features['internationally_recognized_cert']; ?></div>
                                                    <div class="feat-3">
                                                    <span>100% Online Learning</span>
                                                        <?php echo $features['100%_online_learning']; ?></div>
                                                    <div class="feat-4">
                                                    <span>247 Study Access & App</span>
                                                        <?php echo $features['247_study_access_&_app']; ?></div>
                                                    <div class="feat-5">
                                                    <span>Tefl job Service</span>
                                                        <?php echo $features['tefl_job_service']; ?></div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="buy-now-div"><a class= " btn btn-small" href="/cart/?add-to-cart=<?php echo $course_product_id; ?>">Buy Now</a></div>
                                            <div class="learn-more-div"><a class="btn btn-small" href="<?php echo $link; ?>">Learn More</a></div>
                                            
                                            <div class="access-time-div"><?php echo $study_time; ?></div>
                                        </div>
                                    </div>
                                    <?php
                                        if($index===2):
                                    ?>
                                    
                                    <div class="ast-col-md-3">
                                        <div class="clock-sidebar" style="visibility:hidden">
                                            <?php echo do_shortcode('[tefl_timer_shortcode timer="sale"]'); ?>
                                        </div>
                                        <div class="features-div">
                                        <?php if ($thirty_hours_courses_features) :
                                                foreach ($thirty_hours_courses_features as $key => $element) : 
                                        ?>
                                            <div class="feat-<?php echo $key + 1; ?>"><?php echo $element['feature']; ?></div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>  
                                        </div>
                                    </div>

                                    <?php
                                        endif;
                                    ?>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
              
            </div>
        </section>


        <!-- courses section end -->

        <?php
            $courses_cta_section = get_field('courses_cta_section');
            if(!is_array_empty($courses_cta_section)):
                $courses_cta = $courses_cta_section['courses_cta'];
        ?>
        <section class="courses-cta-section">
            <div class="ast-container">
                <?php
                    foreach($courses_cta as $key => $ccta):
                        $cta_image = $ccta['cta_image'];
                        $cta_icon = $ccta['cta_icon'];
                        $cta_course = $ccta['cta_course'];
                        if($cta_course){
                            $cta_course_product = wc_get_product($cta_course);
                            if ($cta_course_product) {
                                $cta_course_price = $cta_course_product->get_price_html();
                            } else {
                                $cta_course_price = '';
                            }
                        }                    
                        $cta_course_title = $ccta['cta_course_title'];
                        $cta_course_summary = $ccta['cta_course_summary'];
                        $cta_course_icon = $ccta['cta_course_icon'];
                        $cta_button_text = $ccta['cta_button_text'];
                        $cta_button_link = $ccta['cta_button_link'];
                ?>
                <div class="<?php echo $cta_course?> course-cta-section__row <?php echo ($key+1)%2 === 0 ?'even-row':'odd-row'?>">
                    <div class="ast-row ast-flex">
                        <div class="ast-col-md-7">
                            <div class="cta-image" style="background:url('<?php echo $cta_image?>')">
                                <img class="cta-icon" src="<?php echo $cta_icon?>" alt="">
                            </div>
                        </div>
                        <div class="ast-col-md-5">
                            <div class="cta-content">
                                <div class="cta-content__title">
                                    <h3><?php echo $cta_course_title?></h3>
                                    <?php
                                        if(!empty($cta_course_icon)):
                                    ?>
                                    <img src="<?php echo $cta_course_icon?>" alt="">
                                    <?php
                                        endif;
                                    ?>
                                </div>
                                <div class="cta-course-price">
                                    <?php echo $cta_course_price?>
                                </div>
                                <div class="cta-content__summary">
                                    <?php echo $cta_course_summary?>
                                </div>
                                <a href="<?php echo $cta_button_link?>" class="course-cta-btn">
                                    <?php echo $cta_button_text?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                ?>
            </div>
        </section>
        <?php
            endif;
        ?>

        <!-- video section start -->
            <?php
            $videos = get_field('videos');    
            ?>
            <section class="tefl-course-video-section">
                <div class="ast-container">
                    <div class="ast-row">
                        
                        <?php foreach($videos as $video_item){
                            $image       = $video_item['image'];
                            $name        = $video_item['name'];
                            $video_link  = $video_item['video_link'];
                        ?>
                                    
                            <div class="ast-col-md-6">
                                <div class="video-sectio-col">
                                    <div class="video-play-container">
                                        <div class="video-section-image"><img src="<?php echo $image  ?>"></div>
                                        <div class="video-btn video-play-btn">
                                            <a href="<?php echo $video_link ?>" data-lity><img src="/wp-content/uploads/2023/08/Group-7.png"></a>
                                        </div>
                                    </div>
                                    <div class="video-description-section">
                                        <div class="video-description-section--author-name"><?php echo $name ?></div>
                                        <div class="video-description-section--institute-name">TEFL Institute Graduate</div>
                                    </div>
                                </div>
                            </div>
                            
                        <?php } ?>
                    </div>
                </div>
            </section> 
        <!-- video section end -->

        <!-- quote section start -->    
        <?php 
            $quote_section = get_field('quote_section');
            if(!empty($quote_section)){
                $quote_img               = $quote_section['quote_image'];
                $quote_title             = $quote_section['quote_title'];
                $quote_sub_content       = $quote_section['sub_content'];
                $content_footer_title    = $quote_section['content_footer_title'];
                $content_footer_subtitle = $quote_section['content_footer_subtitle'];
            }
        ?>
        <section class="quote section-top">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <div class="quote-wrapper" style="background:url(<?php echo $quote_img?>)">
                            <div class="ast-col-md-6 quote-inner">
                                <div class="quote-title"><?php echo $quote_title ?></div>
                                <div class="quote-sub-content"><?php echo $quote_sub_content?></div>
                                <div class="content-footer-title"><?php echo $content_footer_title?></div>
                                <div class="content-footer-subtitle"><?php echo $content_footer_subtitle?></div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- quote section end -->

        <!-- post content section start -->
        <?php
        $post_sections = get_field('post_sections');
        ?>
        <section class="post-content-sections">
            <div class="ast-container">
                <div class="ast-row">
                    <?php foreach($post_sections as $index => $post_section):
                    $post_image       = $post_section['post_image'];
                    $post_content     = $post_section['content'];
                    $content_title    = $post_content['content_title'];
                    $content_subtitle = $post_content['content_subtitle'];
                    $content_summary  = $post_content['content_summary'];
                    $cta_btn          = $post_content['cta_btn'];

                    if($index%2==0):
                    ?>
                    
                    <div class="post-wrapper post-wrapper-<?php echo $index+1?>">
                        <div class="ast-col-md-6 ast-col-xs-12">
                            <div class="post-img" style="background:url('<?php echo $post_image?>')">
                                
                            </div>
                        </div>

                    <div class="ast-col-md-6 ast-col-xs-12">
                        <div class="post-content equal-height">
                            <div class="content-title"><?php echo $content_title?></div>
                            <div class="content-subtitle"><?php echo $content_subtitle?></div>
                            <div class = "content-summary mb-1"><?php echo $content_summary ?></div>

                            <a class = "content-btn btn-primary w-50" href="<?php echo $cta_btn?> "><span>Learn More</span>
                            <i class="fa fa-angle-right"></i>
                        </a>   
                        </div>
                    </div>   
                    </div>

                <?php else : ?>
                    <div class="post-wrapper post-wrapper-<?php echo $index+1?>">
                        <div class="ast-col-md-6">
                            <div class="post-content equal-height">
                                <div class="content-title"><?php echo $content_title?></div>
                                <div class="content-subtitle"><?php echo $content_subtitle?></div>
                                <div class="content-summary"></php echo $content_summary?></div>
                                <a class = "content-btn btn-primary w-50" href="<?php echo $cta_btn?> "><span>Learn More</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                            </div>
                        </div>   
                        
                        <div class="ast-col-md-6">
                            <div class="post-img" style="background:url('<?php echo $post_image?>')">
                                
                            </div>
                        </div>
                    </div>
                <?php endif;?>

                <?php endforeach;?>


                </div>  
            </div>
        </section>

        <!-- post content section end -->

        <!-- faq section  start-->
            <section class="faqs-section full-width has-bg section-padding-bottom section-top">
                    <?php
                        $frequently_asked_questions = get_field('frequently_asked_questions', 77005); 
                    ?>
                    <script type="application/ld+json">
                        {
                            "@context": "https://schema.org",
                            "@type": "FAQPage",
                            "mainEntity": [
                                <?php
                                $faqcount = count($frequently_asked_questions);
                                $counter = 0;
                                foreach ($frequently_asked_questions as $item) {
                                    $counter++;
                                ?> {
                                        "@type": "Question",
                                        "name": <?php echo json_encode($item['question']); ?>,
                                        "acceptedAnswer": {
                                            "@type": "Answer",
                                            "text": <?php echo json_encode($item['answer']); ?>
                                        }
                                    }
                                <?php
                                    if ($faqcount != $counter) echo ",";
                                }
                                ?>
                            ]
                        }
                    </script>
                    <div class="ast-container">
                        <div class="ast-row">
                            <div class="ast-col-md-12">
                                <div class="faqs-section__row">
                                    <h2 class="large-heading common-section-heading">New To TEFL – Before You Start</h2>
                                    <div class="faqs-section__row-body">
                                        <div class="faqs-accordion">
                                            <?php
                                                foreach($frequently_asked_questions as $key => $faq):
                                                    $faq_answer = $faq['answer'];
                                                    $faq_question = $faq['question'];
                                            ?>
                                            <div class="faqs-accordion__item <?php echo $key===0?'active':''?>">
                                                <input type="radio" id="acc-<?php echo $key?>" name="faq-accordion" <?php echo $key===0 ?'checked':''?> hidden>
                                                <label class="font-700" for="acc-<?php echo $key?>">
                                                    <span><?php echo $faq_question?></span>
                                                    <i class="fa fa-plus"></i>
                                                </label>
                                                <div class="font-500 faqs-accordion__content <?php echo $key===0?'active':''?>">
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
                    </div>
            </section>
        <!-- faq section end -->
</div><!-- #primary -->
<?php get_footer(); ?>