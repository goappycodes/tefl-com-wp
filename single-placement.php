<?php

/**
 * The template for displaying all single placements.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

$is_virtual_couse = get_field('is_virtual_couse');
$hero = get_field('hero');

$course_product_id      = get_field('course_product');
$course_product         = wc_get_product($course_product_id);
$course_regular_price   = $course_product ? $course_product->get_regular_price() : 0;
$course_sale_price      = $course_product ? $course_product->get_sale_price() : 0;
    
?>

<div id="primary" <?php astra_primary_class(); ?>>

    <div class="hero">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-lg-12">
                    <h1 class="heading"><?php echo $hero['title']; ?></h1>
                </div>
            </div>
            <div class="ast-row">
                <div class="ast-col-lg-12">
                    <div class="hero__container" style="background-image: url('<?php echo $hero['background']; ?>');">
                        <div class="collage">
                            <?php $id = 0; ?>
                            <?php if($hero['collage']) { ?>
                            <?php foreach($hero['collage'] as $element) {
				                $polaroid = $element['polaroid']; ?>
                                <div class="polaroid" id="polaroid<?php echo $id; ?>"><div class="polaroid__photo" style="background-image: url('<?php echo $polaroid; ?>');"></div></div>
                            <?php $id++; } } ?>
                        </div>
                        <h2 class="sub__heading"><?php echo $hero['subtitle']; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="main">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col ast-col-md-4 ast-col-sm-12 placement-sidebar-col sticky">
                    
                    <?php $sidebar = get_field('sidebar'); ?>
                    <div class="sidebar">
                        <div class="sidebar__type"><?php echo $sidebar['type'] ?></div>
                        
                        <h2 class="sidebar__heading"><?php echo $hero['subtitle']; ?></h2>
                        
                        <div class="sidebar__info">
                            <div class="ast-container">
                                <div class="ast-row">
                                    <?php foreach($sidebar['info'] as $element) {
        				                $icon = $element['icon']; 
        				                $title = $element['title']; 
        				                $subtitle = $element['subtitle']; ?>
        				              
                                        <div class="ast-col-md-6">
                                            <div class="info__item">
                                                <div class="info__top"><?php echo $title; ?></div>
                                                <div class="info__bottom"><?php echo $subtitle; ?></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="sidebar__price">
                            <?php /*
                                if($course_sale_price) { */ ?>
                                    <span class="regular">Was: <?php echo get_woocommerce_currency_symbol().$course_regular_price; ?></span>
                                <?php /* } else { */ ?>
                                    <span class="sale">Now: <?php echo get_woocommerce_currency_symbol().$course_sale_price; ?></span>
                                <?php /* } */
                            ?>
                        </div>
                        
                        <?php $timer_expiry = get_field('timer', 'option');

                            if ($timer_expiry) {
                                $course_offer_end_date = strtotime($timer_expiry);
                                $current_time = current_time('timestamp');
                                $time_diff = $course_offer_end_date - $current_time;
                            }
                        
                            if ($time_diff < 0) :
                                $price_class = 'sale_expires';
                            else :
                                $price_class = '';
                            endif;
                        
                            if( ($side_col2_img == '') && ($side_col2_title == '') && ($side_col2_stitle == '') && ($side_col2_footer == '') ){
                                $class = 'two-columns';
                            }
                            
                            if ($timer_expiry) {
                        
                        ?>
                        
                            <script>
                                const timer = () => {
                                    //set the date to countdown
                                    //const countDownDate = new Date("Dec 25, 2020 12:00:00").getTime();
                                    const countDownDate = new Date('<?php echo $timer_expiry; ?>').getTime();
                    
                                    //update time each second
                    
                                    const update = setInterval(() => {
                                        //get time now and find differnce from countdown time
                    
                                        const now = new Date().getTime();
                                        const diff = countDownDate - now;
                                        //calculate time as days, hours months and second
                                        //console.log("diff" + diff);
                                        if (diff > 0) {
                                            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                                            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                                            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                    
                                            //display timer
                                            document.querySelector('#day').innerHTML = days;
                                            document.querySelector('#hour').innerHTML = hours;
                                            document.querySelector('#minute').innerHTML = minutes;
                                            document.querySelector('#second').innerHTML = seconds;
                                        } else {
                                            document.getElementsByClassName('hascountdown')[0].style.display = 'none';
                                            document.getElementsByClassName('hascountdown')[1].style.display = 'none';
                                            document.getElementsByClassName('hascountdown')[2].style.display = 'none';
                                            document.getElementsByClassName('salarycalculator-form')[0].style.display = 'block';
                                            document.getElementsByClassName('mid-col')[0].style.background = 'black';
                    
                                        }
                                    }, 1000);
                                }
                    
                                jQuery(document).ready(function($) {
                                    timer();
                                })
                            </script>

                        <?php } ?>
                        
                        
                        <?php if ($timer_expiry) { ?>
                        <div class="mid-col__body hascountdown">
                            <div class="save">Time left to save!</div>
                            <ul class="timer">
                                <li>
                                    <span id="day"></span>
                                    <span id="day-text">Days</span>
                                </li>
                                <li class="separator">:</li>
                                <li>
                                    <span id="hour"></span>
                                    <span id="hour-text">Hrs</span>
                                </li>
                                <li class="separator">:</li>
                                <li>
                                    <span id="minute"></span>
                                    <span id="minute-text">Mins</span>
                                </li>
                                <li class="separator">:</li>
                                <li>
                                    <span id="second"></span>
                                    <span id="second-text">Sec</span>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                        
                        <div class="sidebar__buttons">
                            <a href="#boxzilla-7169">Download<i class="fa fa-angle-right"></i></a>
                            <a href="#timetable">Apply Today<i class="fa fa-angle-right"></i></a>
                        </div>
                        
                    </div>
                </div>
                
                <div class="ast-col ast-col-md-8 ast-col-sm-12">
                    
                    <?php $introduction = get_field('introduction'); ?>
                    
                    <div class="introduction">
                        <h3 class="main__heading">Introduction</h3>
                        
                        <div class="content">
                            <?php echo $introduction; ?>
                        </div>
                        
                    </div>
                    
                    <?php $whats_included = get_field('whats_included'); ?>
                    
                    <div class="included">
                        
                        <hr>
                        <h3 class="main__heading">What's Included</h3>
                        
                        <input type="radio" id="tab1" name="tab" checked>
                        <label for="tab1">Inclusions</label>
                        <input type="radio" id="tab2" name="tab">
                        <label for="tab2">Requirements</label>
                        <input type="radio" id="tab3" name="tab">
                        <label for="tab3">What do I need to Organise</label>
                        
                        <div class="line"></div>
                          
                        <div class="content-container">
                            <div class="content" id="c1">
                                <?php foreach($whats_included['inclusions'] as $element) {
				                    $item = $element['item']; ?>
                                    <div class="included__item">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                      <span><?php echo $item; ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="content" id="c2">
                                 <?php foreach($whats_included['requirements'] as $element) {
				                    $item = $element['item']; ?>
                                    <div class="included__item">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                      <span><?php echo $item; ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="content" id="c3">
                                <?php foreach($whats_included['organise'] as $element) {
				                    $item = $element['item']; ?>
                                    <div class="included__item">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                      <span><?php echo $item; ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                          
                    </div>
                    
                    <?php
                        if ($is_virtual_couse) {
                            // include('includes/course_variation_timetable.php');
                            
                            // if(current_user_can('administrator')){
                                include('includes/virtual-course-variation.php');
                            //}
                            
                            
                        }
                    ?>
                    
                    <?php $location = get_field('location');
                    $form_content = $location['form_content'];
                    $form_header_image = get_field('form_header_image','options'); ?>
                    
                    <div class="location section">
                        <div class="ast-row">
                            <div class="ast-col ast-col-md-12">
                                <h3 class="main__heading">Location</h3>
                                <div class="location__content">
                                    <?php echo $location['content']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="ast-row location__container">
                            <div class="ast-col ast-col-md-6">
                                <div class="location__map">
                                    <img src="<?php echo $location['map']; ?>">
                                </div>
                            </div>
                            <div class="ast-col ast-col-md-6">
                                <div class="learn-more-form">
                                    <div class="form-head-row">
                                        <?php if( $form_content ): ?>
                                            <div class="form-content">
                                                <?php echo $form_content; ?>
                                            </div>
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
                    
                    <div class="guide-left-outer section" style="background-image: url('https://teflinstitute.com/wp-content/uploads/2021/07/job-hunters-background.png');">

                        <div class="guide-left">
    
                            <h6 class="section-heading">Job Hunter's Guide</h6>  
    
                            <p class="">Your first steps to becoming a fully accredited, internationally recognised EFL/ESL teacher within 4 weeks!</p>
                            
                            <img src="https://teflinstitute.com/wp-content/uploads/2021/07/job-hunters-mock.png">  
    
                            <a href="#boxzilla-7169"><span>Download Now</span><i class="fa fa-angle-right"></i></a>
    
                        </div>  
    
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php get_footer(); ?>