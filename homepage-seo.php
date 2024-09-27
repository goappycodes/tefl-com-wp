<?php

/**
 * Template Name: Homepage SEO
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$webinar_args = array(
    'numberposts'      => 3,
    'post_type'        => 'webinar',
    'status'           => 'publish',
    'tax_query'        => array(
        array(
            'taxonomy'       => 'webinar_category',
            'field'          => 'slug',
            'terms'          => array('upcoming'),
        ),
    ),
    'meta_key'          => 'webinar_date',
    'orderby'           => 'meta_value_num',
    'order'             => 'ASC'
);

$webinars = get_posts($webinar_args);

get_header();
$banner = get_field('banner');
$show_slider = get_field('show_slider');
$slider = get_field('slider');
$total_slides = count($slider) + 1;
$banner_link_buttons = get_field('banner_link_buttons');

$banner_image = $banner['banner_image'];
$banner_image_mobile = $banner['mobile_banner_image'];
$banner_heading         = $banner['banner_heading'];
$banner_subheading         = $banner['banner_subheading'];

$banner_product_id = $banner['banner_product'];
$banner_product_price = '';
if ($banner_product_id) {
    $banner_product_product = wc_get_product($banner_product_id);
    if ($banner_product_product) {
        $banner_product_price = $banner_product_product->get_price_html();
    }
}

$banner_button = $banner['banner_button'];

$banner_link_button1    = $banner_link_buttons['banner_link_button1'];
$banner_link1           = $banner_link_button1['banner_link1'];
$banner_link1_text      = $banner_link_button1['banner_link1_text'];
$banner_link_button2    = $banner_link_buttons['banner_link_button2'];
$banner_link2           = $banner_link_button2['banner_link2'];
$banner_link2_text      = $banner_link_button2['banner_link2_text'];
$banner_link_button3    = $banner_link_buttons['banner_link_button3'];
$banner_link3           = $banner_link_button3['banner_link3'];
$banner_link3_text      = $banner_link_button3['banner_link3_text'];
$banner_logo = $banner['banner_logo'];

$show_banner = get_field('show_banner', 'options');
//$color = get_field('color', 'options'); 
?>

<style>
    @media (max-width:768px) {
        .homepage-hero-section>div:first-child {
            background-image: url(<?php echo $banner_image_mobile; ?>) !important
        }
    }
</style>

<div <?php echo $total_slides?> id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-touch='true' data-bs-ride="carousel" data-bs-interval="10000">
    <div class="carousel-indicators">
        <?php for($i=0;$i<$total_slides;$i+=1):?>
            <button type="button" data-bs-target="#carouselExampleCaptions" class="<?php echo $i===1?'active':''?>"  aria-current="<?php echo $i===1?'true':''?>" data-bs-slide-to="<?php echo $i?>" aria-label="Slide <?php echo $i?>"></button>
        <?php endfor;?>
    </div>
    <div class="carousel-inner">
        <section class="homepage-hero-section ">

            <div class=" <?php if ($show_slider) { ?>carousel-item <?php } ?>" style="background-image: url(<?php echo $banner_image ?>);" data-bs-interval="10000">
                <div class="ast-container item">
                    <img src="<?php echo $banner_logo ?>" alt="" class="banner-logo">
                    <div class="ast-row banner-text-row overlay-shadow">
                        <div class="ast-col-lg-12 ast-col-md-12 ast-col-sm-12 ast-col-xs-12">
                            <?php if ($banner_heading) : ?>
                                <h1 class="banner-text"><?php echo $banner_heading ?></h1>
                            <?php endif; ?>
                            <?php if ($banner_product_price) : ?>
                                <div class="banner-price"><?php echo $banner_product_price; ?></div>
                            <?php endif; ?>
                            <?php if ($banner_subheading) : ?>
                                <h2 class="banner-subtext"><?php echo $banner_subheading; ?></h2>
                            <?php endif; ?>
                            <?php if ($banner_button['button_link'] && $banner_button['button_value']) : ?>
                                <a class="banner-cta" href="<?php echo $banner_button['button_link']; ?>"><?php echo $banner_button['button_value']; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="ast-row banner-bottom-row">
                        <div class="ast-col-lg-4 ast-col-md-4 ast-col-sm-12 ast-col-xs-12 banner-link-col">
                            <a href="<?php echo $banner_link1 ?>" class="banner-link">
                                <span class="banner-link-text"><?php echo $banner_link1_text ?></span>
                                <span class="banner-link-icon"><i class="fa fa-angle-right"></i></span>
                            </a>
                        </div>
                        <div class="ast-col-lg-4 ast-col-md-4 ast-col-sm-12 ast-col-xs-12 banner-link-col">
                            <a href="<?php echo $banner_link2 ?>" class="banner-link">
                                <span class="banner-link-text"><?php echo $banner_link2_text ?></span>
                                <span class="banner-link-icon"><i class="fa fa-angle-right"></i></span>
                            </a>
                        </div>
                        <div class="ast-col-lg-4 ast-col-md-4 ast-col-sm-12 ast-col-xs-12 banner-link-col">
                            <a href="<?php echo $banner_link3 ?>" class="banner-link">
                                <span class="banner-link-text"><?php echo $banner_link3_text ?></span>
                                <span class="banner-link-icon"><i class="fa fa-angle-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($slider) :
                $slide_count = 1;
                foreach ($slider as $el) :
                    $show_clockdown = $el['show_clockdown'];
                    $expiry_date = get_field('black_friday_sale_timer_expiry','option');
                    $is_free_offer_banner = $el['free_offer_banner'];
                    $hide_banner_buttons = $el['hide_banner_buttons'];
                    $hide_banner_icon = $el['hide_banner_icon'];
                    $background = $el['background'];
                    $mobile_background = $el['mobile_background'];
                    $link = $el['link'];
                    $title = $el['title'];

                    $slider_product_id = $el['product'];
                    $slider_product_price = '';
                    if ($slider_product_id) {
                        $slider_product_product = wc_get_product($slider_product_id);
                        if ($slider_product_product) {
                            $slider_product_price = $slider_product_product->get_price_html();
                        }
                    }

                    $subtitle = $el['subtitle'];
                    $button = $el['button'];
                    $hide_overlay = $el['hide_overlay']; ?>
                    <?php if ($is_free_offer_banner) :
                        $title = $el['banner_title'];
                        $free_product_id = $el['free_product'];
                        $free_product_title = $el['product_name'];
                        $free_product_link = get_the_permalink($free_product_id);
                        $offer_expiry_date = $el['free_product_offer_expiry_date'];
                        $offer_expiry_date_timestamp = strtotime($offer_expiry_date);
                        $current_timestamp = time();
                        $time_difference = $offer_expiry_date_timestamp - $current_timestamp;
                        $is_expired = $time_difference > 0 ? false : true;
                        if (!$is_expired) :
                    ?>
                            <div id="carousel-<?php echo $slide_count; ?>" class="carousel-item second-carousel ">
                                <a class="clickable-banner" href="<?php echo $free_product_link ?>"></a>
                                <div class="ast-container item">
                                    <div class="ast-row  free-product-banner">
                                        <h2 class="banner-title"><?php echo $title ?></h2>
                                        <h3 class="banner-subtitle <?php echo $is_expired ?>"><span class="highlighted-text">free</span><?php echo $free_product_title ?></h3>
                                        <div class="countdown-timer" data-expiry="<?php echo $offer_expiry_date ?>">
                                            <ul class=" timer">
                                                <li class="timer__day">
                                                    <span id="dayCount"></span>
                                                    <span id="day-text">days</span>
                                                </li>
                                                <li class="timer__hour">
                                                    <span id="hourCount"></span>
                                                    <span id="hour-text">hours</span>
                                                </li>
                                                <li class="timer__minute">
                                                    <span id="minuteCount"></span>
                                                    <span id="minute-text">minutes</span>
                                                </li>
                                                <li class="timer__second">
                                                    <span id="secondCount"></span>
                                                    <span id="second-text">seconds</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="hours-remaining"></div>
                                        <a href="<?php echo $free_product_link ?>" class="pulsating-banner-link">
                                            Get Started
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <style>
                            #carousel-<?php echo $slide_count;

                                        ?> {
                                background-image: url(<?php echo $background; ?>);
                            }

                            @media (max-width:768px) {
                                #carousel-<?php echo $slide_count;

                                            ?> {
                                    background-image: url(<?php echo $mobile_background; ?>);
                                }
                            }
                        </style>
                        <div id="carousel-<?php echo $slide_count; ?>" class="<?php echo $slide_count===1?'active':''?> carousel-item second-carousel" data-bs-interval="10000">
                                <div class="overlay">
                                    
                                </div>
                                <?php if (!empty($link)) : ?>
                                    <a  class="clickbox" href="<?php echo $link; ?>"></a>
                                <?php endif; ?>
                                <div class="ast-container item">
                                    <div class=" ast-row banner-text-row <?php if (!$hide_overlay) { ?>overlay-shadow<?php } ?>">
                                        
                                        <!-- Clockdown -->
                                        <?php if($show_clockdown):?>
                                        <div class="ast-col-md-6 banner-clock">
                                            <h2 class="banner-clock-header text-center">Sale Ends in:</h2>
                                            <div class="banner-clock-container">
                                                <?php echo clockdown_function($expiry_date)?>
                                            </div>
                                            <a href="<?php echo $link?>" class="btn banner-btn-large">get deal</a>
                                        </div>
                                        <?php endif?>
                                        <!-- Clockdown end -->
                                        <div class="ast-col-lg-12 ast-col-md-12 ast-col-sm-12 ast-col-xs-12">
                                            <h2 class="banner-text"><?php echo $title; ?></h2>
                                            <?php if ($slider_product_price) : ?>
                                                <div class="banner-price"><?php echo $slider_product_price; ?></div>
                                            <?php endif; ?>
                                            <h2 class="banner-subtext"><?php echo $subtitle; ?></h2>
                                            <?php if ($banner_button['button_link'] && $banner_button['button_value']) : ?>
                                                <a class="banner-cta" href="<?php echo $button['button_link']; ?>"><?php echo $button['button_value']; ?></a>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!$hide_banner_icon) { ?>
                                            <!-- <div class="ast-col-lg-6 ast-col-md-6 ast-col-sm-12 ast-col-xs-12">
                                                <div class="banner-img-icon">
                                                    <img src="/wp-content/uploads/2022/03/yoga-and-mindfulness-overlay.png">
                                                </div>
                                            </div> -->
                                            <img src="<?php echo $banner_logo ?>" alt="" class="banner-logo">
                                        <?php } ?>
                                    </div>
                                    <?php if (!$hide_banner_buttons ) { ?>
                                        <div class="ast-row banner-bottom-row">
                                            <div class="ast-col-lg-4 ast-col-md-4 ast-col-sm-12 ast-col-xs-12 banner-link-col">
                                                <a href="<?php echo $banner_link1 ?>" class="banner-link">
                                                    <span class="banner-link-text"><?php echo $banner_link1_text ?></span>
                                                    <span class="banner-link-icon"><i class="fa fa-angle-right"></i></span>
                                                </a>
                                            </div>
                                            <div class="ast-col-lg-4 ast-col-md-4 ast-col-sm-12 ast-col-xs-12 banner-link-col">
                                                <a href="<?php echo $banner_link2 ?>" class="banner-link">
                                                    <span class="banner-link-text"><?php echo $banner_link2_text ?></span>
                                                    <span class="banner-link-icon"><i class="fa fa-angle-right"></i></span>
                                                </a>
                                            </div>
                                            <div class="ast-col-lg-4 ast-col-md-4 ast-col-sm-12 ast-col-xs-12 banner-link-col">
                                                <a href="<?php echo $banner_link3 ?>" class="banner-link">
                                                    <span class="banner-link-text"><?php echo $banner_link3_text ?></span>
                                                    <span class="banner-link-icon"><i class="fa fa-angle-right"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                                <?php if ($link) : ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
            <?php
                    $slide_count++;
                endforeach;
            endif; ?>
        </section>
    </div>
</div>

<section class="search-picker-section">
    <div class="ast-container">
        <h1 class="section-heading">Find the Perfect TEFL Course</h1>
        <div class="ast-row">
            <div class="ast-col-lg-12 ast-col-md-12 ast-col-sm-12">
                <?php echo do_shortcode('[tefl_course_search]'); ?>
            </div>
        </div>
    </div>
</section>

<div class="footer-adv-middle-section">
    <div class="footer-adv-middle">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-12">
                    <div class="logo-group">
                        <?php
                        $first_gallery = get_field('first_gallery', 'options');
                        if ($first_gallery) : ?>
                            <?php foreach ($first_gallery as $image) : ?>
                                <div class="image" style="background-image: url(<?php echo $image; ?>);"></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="logo-group">
                        <?php
                        $second_gallery = get_field('second_gallery', 'options');
                        if ($second_gallery) : ?>
                            <?php foreach ($second_gallery as $image) : ?>
                                <div class="image" style="background-image: url(<?php echo $image; ?>);"></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div><!-- .ast-container -->
    </div><!-- .footer-adv-overlay-->
</div>

<!--Government Regulated Section Start-->

<?php
$govt_regulated_courses                         = get_field('govt_regulated_courses');
$govt_regulated_course_heading                  = get_repeater_cfvalue_by_country('govt_regulated_courses', 'govt_regulated_course_heading');
$govt_regulated_course_details                  = get_repeater_cfvalue_by_country('govt_regulated_courses', 'govt_regulated_course_details');
$govt_regulated_course_media_banner             = $govt_regulated_courses['govt_regulated_course_media_banner'];
$govt_regulated_course_media_banner_title       = $govt_regulated_courses['govt_regulated_course_media_banner_title'];
$govt_regulated_course_media_banner_play_icon   = $govt_regulated_courses['govt_regulated_course_media_banner_play_icon'];

$course_video                                   = $govt_regulated_courses['course_video'];
?>

<section class="govt-regulated-section">
    <div class="ast-container">
        <div class="ast-row govt-regulated-row">
            <div class="ast-col-lg-6 ast-col-md-12 ast-col-sm-12 govt-regulated-text-col">
                <div class="inner-div">
                    <h1 class="section-heading"><?php echo $govt_regulated_course_heading ?></h1>
                    <p><?php echo $govt_regulated_course_details ?></p>
                </div>
            </div>
            <div class="ast-col-lg-6 ast-col-md-12 ast-col-sm-12 govt-regulated-video-col" style="background: url(<?php echo $govt_regulated_course_media_banner ?>);">
                <!-- <a class="lity-video" href="<?php echo $course_video ?>" data-lity></a> -->
                <a href="<?php echo $course_video ?>" data-lity="" class="video-caption-link lity-video">
                    <div class="vide-caption-box">
                        <span class="video-caption-text"><?php echo $govt_regulated_course_media_banner_title; ?></span>
                        <span class="video-icon <?php //if($show_banner) { echo $color; } 
                                                ?>"><img src="/wp-content/uploads/2021/10/Play-button.svg"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!--Government Regulated Section End-->


<!--Government Regulated Training Courses Start-->

<?php
$browse_btn             = get_field('browse_course_button');
$browse_btn_link        = $browse_btn['browse_course_link'];
$browse_btn_link_text   = $browse_btn['browse_course_link_text'];

$section_title   = $govt_regulated_courses['section_title'];
?>
<section class="govt-regulated-training-courses">
    <div class="ast-container">
        <div class="ast-row">
            <h2 class="section-heading"><?php echo $section_title ?></h2>
            <!--<div class="heading-bottom-line"></div>-->
            <div class="divider">
                <div>6 Months Study Time</div>
                <div class="center">Pay in Installments</div>
                <div>Personal Tutor Support</div>
                <!-- <span class="black"></span>
                    <span class="black"></span> -->
            </div>
            
                <div class="ast-row training-courses">
                    <div class="ast-col-lg-6 ast-col-md-12 ast-col-sm-12">
                        <div class="fasttrack-accredited training-course">
                            <h2>FAST TRACK ACCREDITED</h2>
                            <div class="ast-row training-courses">
                                <?php
                                $accredited_courses = get_field('accredited_courses');

                                foreach ($accredited_courses as $accredited_course) :
                                    $has_label          = $accredited_course['has_label'];
                                    if($has_label){
                                        $label_text     = $accredited_course['label_text'];
                                    }
                                    $course_icon        = $accredited_course['course_icon'];
                                    $course_title       = $accredited_course['course_title'];
                                    $course_description = $accredited_course['course_description'];

                                    $course_zoom_classes = $accredited_course['zoom_classes'];
                                    $zoom_classes_product = $accredited_course['zoom_classes_product'];

                                    $course_id = $accredited_course['course'];
                                    $course_link = get_the_permalink($course_id);

                                    $course_bottom_images = $accredited_course['course_bottom_images'];

                                    $course_product_id  = $accredited_course['course_product'];
                                    //Get Deposit Info 
                                    $deposit_enabled = get_post_meta($course_product_id, '_wc_deposit_enabled', true);
                                    $deposit_payment_plan = ''; 
                                    if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional') {
                                        $deposit_payment_plan = get_post_meta($course_product_id, '_wc_deposit_payment_plans', true);
                                        $deposit_payment_plan = $deposit_payment_plan[0];
                                    }
                                    include(get_stylesheet_directory()."/template-parts/deposit-info.php"); 
                                    //End Get Deposit Info
                                    $course_product     = wc_get_product($course_product_id);
                                    if ($course_product->is_type('simple')) {
                                        $course_price_html = $course_product->get_price_html();
                                    } elseif ($course_product->is_type('variable')) {
                                        $available_children = $course_product->get_children();
                                        $children_count     = count($available_children) - 1;
                                        $product_var_id     = $available_children[$children_count];
                                        $variable_product   = new WC_Product_Variation($product_var_id);
                                        $course_price_html  = $variable_product->get_price_html();
                                    }

                                    $percentage = '';

                                    if ($course_product) {
                                        $course_price = $course_product->get_price_html();
                                        $simple_regular_price = $course_product->get_regular_price();
                                        $simple_sale_price = $course_product->get_sale_price();
                                        $percentage = round((($simple_regular_price - $simple_sale_price) / $simple_regular_price) * 100);
                                        $course_url = get_post_permalink($course_id);
                                    } ?>
                                    <div class="course-item-container ast-col-lg-6 ast-col-md-6 ast-col-sm-12 ast-col-xs-12">
                                        <div  class="course-item <?php echo $has_label===1?'has-label':''?>">
                                            <a href="<?php echo $course_url?>" class="course-clickbox"></a>
                                            <div class="course-save <?php //if($show_banner) { echo $color; } 
                                                                    ?>"><span class="save">save</span><span class="price"><?php echo $percentage ?>%</span></div>
                                            <div class="course-icon">
                                                <img width="140" height="140" src="<?php echo $course_icon; ?>">
                                            </div>
                                            
                                            <h3 class="course-price"><?php echo $course_price_html; ?></h3>
                                            
                                            <h3 class="course-title"><?php echo $course_title; ?></h3>
                                            <p class="course-desc"><?php echo $course_description; ?></p>
                                            <?php if ($course_zoom_classes) { ?>
                                                <div class="course-zoom">
                                                    <?php
                                                    $zoom_classes_product_id = $zoom_classes_product;
                                                    $zoom_classes_price = '';
                                                    if ($zoom_classes_product_id) {
                                                        $zoom_classes_product = wc_get_product($zoom_classes_product_id);
                                                        if ($zoom_classes_product) {
                                                            $zoom_classes_price = $zoom_classes_product->get_price_html();
                                                        }
                                                    }
                                                    ?>
                                                    <img src="/wp-content/uploads/2021/11/zoom-black.png">
                                                    <div>
                                                        <?php echo $course_zoom_classes; ?>
                                                        Worth <?php echo $zoom_classes_price; ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="book-now fasttrack-accredited">
                                                <a href="<?php echo $course_link; ?>">LEARN MORE <i class="fa fa-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="ast-col-lg-6 ast-col-md-12 ast-col-sm-12">
                        <div class="govt-regulated training-course">
                            <h2>LEVEL 5 GOVERNMENT REGULATED</h2>
                            <div class="ast-row training-courses">
                                <?php
                                $level_5_govt_regulated_courses = get_field('level_5_govt_regulated_courses');

                                foreach ($level_5_govt_regulated_courses as $level_5_govt_regulated_course) :
                                    $has_label          = $level_5_govt_regulated_course['has_label'];
                                    if($has_label){
                                        $label_text     = $level_5_govt_regulated_course['label_text'];
                                    }
                                    $course_icon        = $level_5_govt_regulated_course['course_icon'];
                                    $course_title       = $level_5_govt_regulated_course['course_title'];
                                    $course_description = $level_5_govt_regulated_course['course_description'];

                                    $course_zoom_classes = $level_5_govt_regulated_course['zoom_classes'];
                                    $zoom_classes_product = $level_5_govt_regulated_course['zoom_classes_product'];

                                    $course_id = $level_5_govt_regulated_course['course'];
                                    $course_link = get_the_permalink($course_id);
                                    $course_bottom_images = $level_5_govt_regulated_course['course_bottom_images'];
                                    $course_product_id  = $level_5_govt_regulated_course['course_product'];
                                    $course_product     = wc_get_product($course_product_id);
                                    //Get Deposit Info 
                                    $full_price = $course_product->get_price();
                                    $deposit_enabled = get_post_meta($course_product_id, '_wc_deposit_enabled', true);
                                    $deposit_payment_plan = '';

                                    if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional') {
                                        $deposit_payment_plan = get_post_meta($course_product_id, '_wc_deposit_payment_plans', true);
                                        $deposit_payment_plan = $deposit_payment_plan[0];
                                    }
                                    include(get_stylesheet_directory()."/template-parts/deposit-info.php"); 
                                    //End Get Deposit Info
                                    if ($course_product->is_type('simple')) {
                                        $course_price_html = $course_product->get_price_html();
                                    } elseif ($course_product->is_type('variable')) {
                                        $available_children = $course_product->get_children();
                                        $children_count     = count($available_children) - 1;
                                        $product_var_id     = $available_children[$children_count];
                                        $variable_product   = new WC_Product_Variation($product_var_id);
                                        $course_price_html  = $variable_product->get_price_html();
                                    }

                                    $percentage = '';

                                    if ($course_product) {
                                        $course_price = $course_product->get_price_html();
                                        $simple_regular_price = $course_product->get_regular_price();
                                        $simple_sale_price = $course_product->get_sale_price();
                                        $percentage = round((($simple_regular_price - $simple_sale_price) / $simple_regular_price) * 100);
                                        $course_url = get_post_permalink($course_id);
                                    } ?>
                                    <div class="course-item-container ast-col-lg-6 ast-col-md-6 ast-col-sm-12 ast-col-xs-12">
                                        <div <?php echo $label_text ?> class="course-item <?php echo $has_label?'has-label':''?>">
                                            <a href="<?php echo $course_url?>" class="course-clickbox"></a>
                                            <div class="course-save"><span class="save">save</span><span class="price"><?php echo $percentage ?>%</span></div>
                                            <?php if($has_label):?>
                                                <span class="course-label-text"><?php echo $label_text?></span>
                                            <?php endif?>
                                            <div class="course-icon">
                                                <img width="140" height="140" src="<?php echo $course_icon; ?>">
                                            </div>
                                            <h3 class="course-price"><?php echo $course_price_html; ?></h3>
                                            <h3 class="course-title"><?php echo $course_title; ?></h3>
                                            <p class="course-desc"><?php echo $course_description; ?></p>
                                            <?php
                                            if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional'):
                                                if($deposit_payment_plan === 1 || $deposit_payment_plan === 3 || $deposit_payment_plan === 4):
                                            ?>
                                                <div class="pay-in-two-three deposit-info ast-flex ast-align-items-center">
                                                    <div class="depoist-info__icon">
                                                        <img src="<?php echo $deposit_icon?>" alt="">
                                                    </div>
                                                    <div class="ast-flex flex-direction-column deposit-info__details">
                                                        <h5 class="deposit-info_title">Pay in <?php echo $total_deposits?></h5>
                                                        <div class="deposit-info_description">
                                                            <?php echo $deposit_description?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php 
                                                endif;
                                                if($deposit_payment_plan===6):
                                                ?>
                                                <div 
                                                    class="ajax-snippet" 
                                                    data-snippet="pay_in_6_ribbon"
                                                    data-objectid="<?php echo $course_product_id; ?>"
                                                >
                                                </div>
                                                <div id="loader">
                                                    Fetching deposit details <img src="/wp-content/uploads/2022/11/loading-black.gif" alt="fetching deposit details">
                                                </div>
                                                <?php
                                                endif;
                                            endif
                                            ?>
                                            <?php if ($course_zoom_classes) { ?>
                                                <div class="course-zoom">
                                                    <?php
                                                    $zoom_classes_product_id = $zoom_classes_product;
                                                    $zoom_classes_price = '';
                                                    if ($zoom_classes_product_id) {
                                                        $zoom_classes_product = wc_get_product($zoom_classes_product_id);
                                                        if ($zoom_classes_product) {
                                                            $zoom_classes_price = $zoom_classes_product->get_price_html();
                                                        }
                                                    }
                                                    ?>
                                                    <img src="/wp-content/uploads/2022/11/zoom-icon.png">
                                                    <div>
                                                        <?php echo $course_zoom_classes; ?>
                                                        Worth <?php echo $zoom_classes_price; ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="book-now govt-regulated">
                                                <a href="<?php echo $course_link; ?>">LEARN MORE <i class="fa fa-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <a href="<?php echo $browse_btn_link; ?>" class="btn-block-black"><?php echo $browse_btn_link_text ?></a>
        </div>
    </div>
</section>

<!--Government Regulated Training Courses Section End-->

<?php
$internships = get_field('internships', '59815');
?>

<!-- To update the interships go to Internship Overview backend and edit there. Homepage will be updated automaticly @author: Przemysław Solan @date: 14/02/2022 -->
<div class="internships-section">
    <div class="ast-container">
        <div class="ast-row">
            <div class="ast-col-lg-12">
                <h2>Paid TEFL Internships</h2>
                <div class="ast-row">
                    <?php foreach ($internships as $e) { ?>
                        <?php $image = $e['image']; ?>
                        <?php $country = $e['country']; ?>
                        <?php $benefits = $e['benefits']; ?>
                        <?php $link = $e['link']; ?>
                        <?php $guide = $e['guide']; ?>
                        <?php
                        $course_product_id = $e['product'];
                        $course_product = wc_get_product($course_product_id);
                        if ($course_product->is_type('simple')) {
                            $course_price_html = $course_product->get_price_html();
                        } elseif ($course_product->is_type('variable')) {
                            $available_children = $course_product->get_children();
                            $children_count = count($available_children) - 1;
                            $product_var_id = $available_children[$children_count];
                            $variable_product = new WC_Product_Variation($product_var_id);
                            $course_price_html = $variable_product->get_price_html();
                        } ?>
                        <div class="ast-col-lg-4">
                            <div class="internship">
                                <a href="<?php echo $link?>" class="internship-clickbox"></a>
                                <div class="image" style="background-image: url('<?php echo $image; ?>')">
                                    <div class="country"><?php echo $country; ?></div>
                                    <div class="country_subtitle">Paid Internship</div>
                                </div>
                                <div class="content">
                                    <div class="price"><?php echo $course_price_html; ?></div>
                                    <div class="benefits">
                                        <h2>Top Benefits:</h2>
                                        <?php foreach ($benefits as $e) { ?>
                                            <?php $item = $e['item']; ?>
                                            <div class="benefit"><i class="fa fa-circle"></i><?php echo $item; ?></div>
                                        <?php } ?>
                                    </div>
                                    <a href="<?php echo $link; ?>" class="learn_more">Learn More</a>
                                </div>
                                <div class="guide" style="display:none;">
                                    <img src="<?php echo $guide['image']; ?>">
                                    <a href="<?php echo $guide['link']; ?>" class="learn_more">Download Guide</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <a href="/teach-english-jobs/" class="btn-block-black">The Definitive Guides to Teaching English Abroad - Updated July 2022</a>
            </div>
        </div>
    </div>
</div>


<!--Homepage Banner Section Start-->

<?php
$home_choice_banner = get_field('home_choice_banner');

$banner_image = $home_choice_banner['home_choice_banner_image'];
$banner_text = $home_choice_banner['home_choice_banner_text'];
$banner_icons = $home_choice_banner['home_choice_banner_icons'];
?>


<section class="homepage-choice-banner-section" style="display:none;">
    <div class="ast-container" style="background-image:url('<?php echo $banner_image ?>')">
        <div class="ast-row banner-text-row">
            <div class="ast-col-lg-12 ast-col-md-12 ast-col-sm-12 ast-col-xs-12">
                <h2 class="banner-text"><?php echo $banner_text ?></h2>
                <?php if ($banner_icons) : ?>
                    <div class="banner-icons">
                        <?php foreach ($banner_icons as $element) :
                            $icon = $element['icon'];
                            $text = $element['text']; ?>
                            <div class="banner-icon-box">
                                <img src="<?php echo $icon; ?>">
                                <p><?php echo $text; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!--Homepage Banner Section End-->


<!--Homepage Banner Section Start-->

<?php
$home_center_banner = get_field('home_center_banner');

$banner_image = $home_center_banner['home_center_banner_image'];
$banner_text = $home_center_banner['home_center_banner_text'];
?>


<section class="homepage-banner-section">
    <div class="ast-container" style="background-image:url('<?php echo $banner_image ?>')">
        <div class="ast-row banner-text-row">
            <div class="ast-col-lg-12 ast-col-md-12 ast-col-sm-12 ast-col-xs-12">
                <h2 class="banner-text"><?php echo $banner_text ?></h2>
            </div>
        </div>
    </div>
</section>

<!--Homepage Banner Section End-->


<!--TEFL Video Section Start-->

<?php
$tefl_video_section = get_field('tefl_video_section');
$video1             =  $tefl_video_section['tefl_video1'];
$video2             =  $tefl_video_section['tefl_video2'];

$video_play_btn     = $tefl_video_section['tefl_video_play_button'];

$video1_img         =  $video1['tefl_video1_thumbnail'];
$video1_txt         =  $video1['tefl_video1_caption'];
$tefl_video1_url    =  $video1['tefl_video1_url'];

$video2_img         =  $video2['tefl_video2_thumbnail'];
$video2_txt         =  $video2['tefl_video2_caption'];
$tefl_video2_url    =  $video2['tefl_video2_url'];

?>

<section class="tefl-video-section">
    <div class="ast-container">
        <div class="ast-row tefl-video-row">
            <div class="ast-col-lg-6 ast-col-md-6 ast-col-sm-12 ast-col-xs-12 tefl-video-col tefl-video-col-1" style="background-image:url('<?php echo $video1_img ?>')">
                <a href="<?php echo $tefl_video1_url ?>" data-lity class="video-caption-link lity-video">
                    <div class="vide-caption-box">
                        <span class="video-caption-text"><?php echo $video1_txt ?></span>
                        <span class="video-icon <?php //if($show_banner) { echo $color; } 
                                                ?>"><img src="/wp-content/uploads/2021/10/Play-button.svg"></span>
                    </div>
                </a>
            </div>
            <div class="ast-col-lg-6 ast-col-md-6 ast-col-sm-12 ast-col-xs-12 tefl-video-col tefl-video-col-2" style="background-image:url('<?php echo $video2_img ?>')">
                <a href="<?php echo $tefl_video2_url ?>" data-lity class="video-caption-link lity-video">
                    <div class="vide-caption-box">
                        <span class="video-caption-text"><?php echo $video2_txt ?></span>
                        <span class="video-icon <?php //if($show_banner) { echo $color; } 
                                                ?>"><img src="/wp-content/uploads/2021/10/Play-button.svg"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!--TEFL Video Section End-->

<!--verified student reviews-->
<section class="students-review ast-container" style="padding:0;">
    <h6 class="section-heading">verified student reviews</h6>
    <?php
    $review_banner = get_field('students_review_banner');
    if ($review_banner) { ?>
        <div class="review-banner" style="background-image:url('<?php echo $review_banner; ?>')"></div>
    <?php }
    ?>

    <div class="review-banner" style="background-image:url('https://teflinstitute.com/wp-content/uploads/2020/11/Group-326.jpg')"></div>
    <?php echo do_shortcode('[brb_collection id="1150"]'); ?>

</section>


<!--Why Choose Us Section Start-->

<?php
$why_us = get_field('why_choose_us');

$section_title = $why_us['section_title'];

$reason1 = $why_us['reason1'];
$reason2 = $why_us['reason2'];
$reason3 = $why_us['reason3'];
$reason4 = $why_us['reason4'];
$reason5 = $why_us['reason5'];
$reason6 = $why_us['reason6'];

$reason1_title = $reason1['reason1_heading'];
$reason1_img = $reason1['reason1_icon'];
$reason1_txt = $reason1['reason1_text'];

$reason2_title = $reason2['reason2_heading'];
$reason2_img = $reason2['reason2_icon'];
$reason2_txt = $reason2['reason2_text'];

$reason3_title = $reason3['reason3_heading'];
$reason3_img = $reason3['reason3_icon'];
$reason3_txt = $reason3['reason3_text'];

$reason4_title = $reason4['reason4_heading'];
$reason4_img = $reason4['reason4_icon'];
$reason4_txt = $reason4['reason4_text'];

$reason5_title = $reason5['reason5_heading'];
$reason5_img = $reason5['reason5_icon'];
$reason5_txt = $reason5['reason5_text'];

$reason6_title = $reason6['reason6_heading'];
$reason6_img = $reason6['reason6_icon'];
$reason6_txt = $reason6['reason6_text'];

?>

<section class="why-choose-us-section">
    <div class="ast-container">
        <div class="ast-row why-choose-us-row">
            <div class="ast-col-lg-12 ast-col-md-12 ast-col-sm-12 ast-col-xs-12 why-choose-us-col">
                <h2 class="section-heading"><?php echo $section_title ?></h2>
            </div>
        </div>
        <div class="ast-row why-choose-us-row why-choose-us-blocks">
            <div class="ast-col-lg-2 ast-col-md-2 ast-col-sm-12 ast-col-xs-12 why-choose-us-col">
                <div class="why-choose-us-icon">
                    <img src="<?php echo $reason1_img ?>">
                </div>
                <div class="why-choose-us-text">
                    <h4><?php echo $reason1_title ?></h4>
                    <p><?php echo $reason1_txt ?></p>
                </div>
            </div>
            <div class="ast-col-lg-2 ast-col-md-2 ast-col-sm-12 ast-col-xs-12 why-choose-us-col">
                <div class="why-choose-us-icon">
                    <img src="<?php echo $reason2_img ?>">
                </div>
                <div class="why-choose-us-text">
                    <h4><?php echo $reason2_title ?></h4>
                    <p><?php echo $reason2_txt ?></p>
                </div>
            </div>
            <div class="ast-col-lg-2 ast-col-md-2 ast-col-sm-12 ast-col-xs-12 why-choose-us-col">
                <div class="why-choose-us-icon">
                    <img src="<?php echo $reason3_img ?>">
                </div>
                <div class="why-choose-us-text">
                    <h4><?php echo $reason3_title ?></h4>
                    <p><?php echo $reason3_txt ?></p>
                </div>
            </div>
            <div class="ast-col-lg-2 ast-col-md-2 ast-col-sm-12 ast-col-xs-12 why-choose-us-col">
                <div class="why-choose-us-icon">
                    <img src="<?php echo $reason4_img ?>">
                </div>
                <div class="why-choose-us-text">
                    <h4><?php echo $reason4_title ?></h4>
                    <p><?php echo $reason4_txt ?></p>
                </div>
            </div>
            <div class="ast-col-lg-2 ast-col-md-2 ast-col-sm-12 ast-col-xs-12 why-choose-us-col">
                <div class="why-choose-us-icon">
                    <img src="<?php echo $reason5_img ?>">
                </div>
                <div class="why-choose-us-text">
                    <h4><?php echo $reason5_title ?></h4>
                    <p><?php echo $reason5_txt ?></p>
                </div>
            </div>
            <div class="ast-col-lg-2 ast-col-md-2 ast-col-sm-12 ast-col-xs-12 why-choose-us-col">
                <div class="why-choose-us-icon">
                    <img src="<?php echo $reason6_img ?>">
                </div>
                <div class="why-choose-us-text">
                    <h4><?php echo $reason6_title ?></h4>
                    <p><?php echo $reason6_txt ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Why Choose Us Section End-->


<!--Complimentary Webinar Section Start-->

<?php

$webinarss = get_field('webinars');

$section_title  = $webinarss['section_title'];
$button_text    = $webinarss['button_text'];
$button_link    = $webinarss['button_link'];

?>

<section class="webinar-section">
    <div class="ast-container">
        <div class="ast-row webinar-row">
            <div class="ast-col-lg-12 ast-col-md-12 ast-col-sm-12 ast-col-xs-12 webinar-col">
                <h2 class="section-heading"><?php echo $section_title ?></h2>
            </div>
        </div>
        <?php if ($webinars) : ?>
            <div class="ast-row webinar-row">
                <?php foreach ($webinars as $webinar) : ?>
                    <?php
                    $webinar_id         = $webinar->ID;
                    $webinar_title      = $webinar->post_title;
                    $webinar_location   = get_field('webinar_location', $webinar_id);
                    $webinar_date       = get_field('webinar_date', $webinar_id);
                    $webinar_time       = get_field('webinar_time', $webinar_id);
                    $webinar_image      = get_the_post_thumbnail_url($webinar_id, 'full');
                    $webinar_link       = get_post_permalink($webinar_id);
                    ?>
                    <div class="ast-col-lg-4 ast-col-md-4 ast-col-sm-12 ast-col-xs-12 webinar-col" style="background-image: url('<?php echo $webinar_image; ?>')">
                        <div class="webinar-div">
                            <a href="/upcoming-webinars" class="webinar-clickbox"></a>
                            <a href="/upcoming-webinars/" class= "webinar-info-box">
                                <h4 class="webinar-title"><?php echo $webinar_title; ?></h4>
                                <p class="webinar-location">LOCATION : <?php echo $webinar_location; ?></p>
                                <p class="webinar-date">DATE : <?php echo $webinar_date; ?></p>
                                <p class="webinar-time">TIME : <?php echo $webinar_time; ?> (UK TIME)</p>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="ast-row">
            <a href="<?php echo $button_link ?>" class="btn-block-black"><?php echo $button_text ?></a>
        </div>
    </div>
</section>

<!--Complimentary Webinar Section End-->

<!--FAQ section start-->

<?php $frequently_asked_questions = get_cfvalue_by_country('frequently_asked_questions'); ?>

<?php if ($frequently_asked_questions) : ?>

    <section class="faq-hero-section">
        <div class="ast-container" style="background: url('https://teflinstitute.com/wp-content/uploads/2020/11/take_the_test_bg.jpg');">
            <div class="ast-row banner-text-row">
                <div class="ast-col-lg-12 ast-col-md-12 ast-col-sm-12 ast-col-xs-12">
                    <h2 class="banner-text">TEFL Institute <br> Frequently Asked Questions</h2>
                </div>
            </div>
        </div>
    </section>

    <div class="ast-row more-space">
        <div class="ast-col-md-12">
            <?php $i = 0; ?>
            <?php foreach ($frequently_asked_questions as $item) : ?>

                <?php $question = $item['question']; ?>
                <?php $answer = $item['answer']; ?>

                <section class="accordion-container">
                    <input id="accordion-<?php echo $i ?>" name="accordion-1" type="radio" <?php if ($i === 0) { ?>checked<?php } ?>>
                    <label for="accordion-<?php echo $i ?>"><?php echo $question ?></label>
                    <article>
                        <?php echo $answer ?>
                    </article>
                </section>
            <?php $i++;
            endforeach; ?>
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

        </div>
    </div>

<?php endif; ?>

<!--FAQ section end-->

<!--TEFL On The Go Section Start-->

<?php

$tefl_on_the_go = get_field('tefl_on_the_go');

$section_title      = $tefl_on_the_go['section_title'];
$section_subtitle   = $tefl_on_the_go['section_subtitle'];
$content_text       = $tefl_on_the_go['content_text'];
$image              = $tefl_on_the_go['image'];
$play_store_link    = $tefl_on_the_go['play_store_link'];
$app_store_link     = $tefl_on_the_go['app_store_link'];

?>

<section class="tefl-on-the-go-section-new">
    <div class="ast-container">
        <div class="ast-row">
            <div class="mobile-container">
                <div class="ast-col-lg-12 ast-col-md-6 ast-col-sm-12 ast-col-xs-12 mobile-bg-left">
                    <h2 class="section-heading"><?php echo $section_title; ?></h2>
                    <h2 class="section-subheading"><?php echo $section_subtitle; ?></h2>
                    <p><?php echo $content_text; ?></p>
                    <div class="app-store">
                        <h2 class="section-heading">Download the app</h2>
                        <?php if ($app_store_link) : ?>
                            <a href="<?php echo $app_store_link; ?>"><img src="/wp-content/uploads/2021/08/apple-logo-1.svg"></a>
                        <?php endif; ?>
                        <?php if ($play_store_link) : ?>
                            <a href="<?php echo $play_store_link; ?>"><img src="/wp-content/uploads/2021/08/google-play-logo-1.svg"></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="ast-col-lg-12 ast-col-md-6 ast-col-sm-12 ast-col-xs-12 mobile-bg-right">
                    <img src="<?php echo $image; ?>">
                </div>
            </div>
        </div>
    </div>
</section>

<!--TEFL On The Go Section End-->




<?php get_footer(); ?>