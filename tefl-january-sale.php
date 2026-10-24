<?php

/**
 * Template Name: TEFL January Sale 2025
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" <?php astra_primary_class(); ?>>

    <?php 
        $hero = get_field('hero');
        if(!is_array_empty($hero)):
    ?>

    <div class="hero" style="background-image: url('<?php echo $hero['background']; ?>')">
        <div class="hero-outer">
            <div class="content-container">
                <img class="promo-image" src="<?php echo $hero['promo']; ?>">
                <div class="discount">
                    <div>Discount Deadline:</div>
                    <?php echo do_shortcode('[tefl_timer_shortcode]'); ?>
                </div>
            </div>
        </div> 
    </div>

    <?php
        endif;
    ?>

    <div class="content-container">
    
        <?php 
            $top = get_field('top');
            if(!is_array_empty($top)):
        ?>

        <section class="content-section">
            <div class="top-heading">
                <img src="/wp-content/uploads/2024/12/sale_basket.png">
                <div><?php echo $top['title']; ?></div>
            </div>
            <div class="top-save">
                <div>Save Up To:</div>
                <img src="<?php echo $top['save_graphic']; ?>">
            </div>
        </section>

        <?php
            endif;
        ?>

        <section class="content-section">

        <?php
            $courses = get_field('courses'); 
            $courses_title = get_field('courses_title');
            if(!is_array_empty($courses)):
        ?>

            <div class="courses-title"><?php echo $courses_title; ?></div>
            
            <section class="content-section courses">

                <?php
                    foreach ($courses as $index => $course):
                        $thumbnail = $course['thumbnail'];
                        $icon = $course['icon'];
                        $title = $course['title'];
                        $product = $course['product'];
                        $product_id = $product->ID;
                        $product_obj = wc_get_product($product_id);
                        $currency_symbol = get_woocommerce_currency_symbol();
                        $regular_price = $product_obj->get_regular_price();
                        $sale_price = $product_obj->get_sale_price();
                    
                        // Use sale price if available, otherwise use regular price
                        $price_to_use = $sale_price ? $sale_price : $regular_price;
                    
                        // Calculate installment amount for 3 payments
                        $installment_count = 3; // Number of installments
                        // $installment_price = $price_to_use / $installment_count;

                        $full_price = $product_obj->get_price();
                        $installment_price = geo_price($full_price/3);
                    
                        if ($regular_price && $sale_price) {
                            $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                        } else {
                            $discount_percentage = 0; 
                        }
                    
                        $completion_time = $course['completion_time'];
                        $enrol_button = $course['enrol_button'];
                        $includes_title = $course['includes_title'];
                        $includes = $course['includes'];
                        $excludes = $course['excludes'];
                        $toggle_offer = $course['toggle_offer'];
                        $offer = $course['offer'];
                        $button = $course['button'];
                        $learn_more = $course['learn_more'];
                ?>

                <div class="course">
                    
                    <div class="thumbnail" style="background-image: url('<?php echo $thumbnail; ?>')">
                        <div class="off-container"><div class="off">January Sale<span><?php echo esc_html($discount_percentage); ?>% Off</span></div></div>
                        <div class="thumbnail-outer">
                            <div class="icon" style="background-image: url('<?php echo $icon; ?>')"></div>
                        </div>
                    </div>

                    <div class="title"><?php echo $title; ?></div>

                    <div class="price">
                        <?php if ($regular_price && $sale_price) : ?>
                            <div class="product-pricing">
                                <div><?php echo $product_obj->get_price_html();?></div>
                            </div>
                        <?php else: ?>
                            <div class="product-pricing">
                                <div><?php echo $product_obj->get_price_html();?></div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="completion-time"><span>Completion Time:</span><?php echo $completion_time; ?></div>

                    <a class="enrol more-x-space" href="/cart/?addtimetocart&prid=<?php echo $product_id?>">
                        <?php echo $enrol_button; ?>
                    </a>

                    <div class="klarna">
                        <img src="https://teflinstitute.com/wp-content/uploads/2024/11/klarna-1.png">
                        <div>Split the purchase into <?php echo $installment_count; ?> payments of <?php echo $installment_price; ?> (0% APR). <a href="#" class="learn-more-link">Learn more</a></div>
                    </div>

                    <div class="includes_title"><?php echo $includes_title; ?></div>

                    <div class="includes">

                        <?php
                            foreach($includes as $index => $include): 
                                $text = $include['text'];
                        ?>
                            <div class="include">
                                <img src="/wp-content/uploads/2024/11/yes.png">
                                <span><?php echo $text; ?></span>
                            </div>

                        <?php endforeach ;?>
                        
                        <?php
                            foreach($excludes as $index => $exclude):
                                $text = $exclude['text'];
                        ?>
                            <div class="exclude">
                                <img src="/wp-content/uploads/2024/11/no.png">
                                <span><?php echo $text; ?></span>
                            </div>

                        <?php endforeach ;?>

                    </div>

                    <?php if ($toggle_offer) : ?>

                        <div class="offer"><?php echo $offer; ?></div>

                    <?php endif; ?>

                    <div class="buttons">
                                
                        <a class="default-button" href="<?php echo $button['link']; ?>"><?php echo $button['value']; ?></a>

                        <a class="enrol" href="<?php echo $learn_more['link']; ?>"><?php echo $learn_more['value']; ?></a>

                    </div>

                </div>

                <?php endforeach ;?>

            </section>
        <?php
            endif;
        ?>
        </section>

        <section class="content-section">

            <?php
                $gifts = get_field('gifts'); 
                if(!is_array_empty($gifts)):
            ?>
            
            <div class="gifts">

                <div class="left">
                    <div class="title"><?php echo $gifts['title']; ?></div>
                    <div class="text"><?php echo $gifts['text']; ?></div>
                </div>

                <div class="right">

                    <?php
                        foreach($gifts['guides'] as $index => $guide): 
                            $image = $guide['image'];
                            $name = $guide['name'];
                    ?>

                        <div class="guide">
                            <img src="<?php echo $image; ?>">
                            <?php echo $name; ?>
                        </div>

                    <?php endforeach ;?>
                </div>

            </div>
            <?php
                endif;
            ?>
        </section>

        <section class="content-section">

            <?php
                $bundle = get_field('bundle'); 
                $bundle_title = get_field('bundle_main_title'); 
                $product = $bundle['product'];
                $product_id = $product->ID;
                $product_obj = wc_get_product($product_id);
                $currency_symbol = get_woocommerce_currency_symbol();
                $regular_price = $product_obj->get_regular_price();
                $sale_price = $product_obj->get_sale_price();

                if ($regular_price && $sale_price) {
                    $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                } else {
                    $discount_percentage = 0; 
                }

            ?>
                  
            <div class="bundle-title"><?php echo $bundle_title; ?></div>

            <div class="bundle">

                <div class="left" style="background-image: url('<?php echo $bundle['background']; ?>')"><div class="badge"><?php echo $bundle['badge']; ?></div></div>

                <div class="right">

                    <div class="title"><?php echo $bundle['title']; ?></div>
                    <div class="text"><?php echo $bundle['text']; ?></div>

                    <div class="product-outer">
                        <div class="whats_included">What's Included:</div>
                        <div class="price-outer">
                            <div class="price-left">
                                <?php if ($regular_price && $sale_price) : ?>
                                    <div class="product-pricing">
                                        <div><?php echo $product_obj->get_price_html();?></div>
                                    </div>
                                <?php else: ?>
                                    <div class="product-pricing">
                                        <div><?php echo $product_obj->get_price_html();?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="price-right">Save <?php echo esc_html($discount_percentage); ?>%</div>
                        </div>
                    </div>

                    <div class="whats_included_outer">

                        <?php
                            foreach($bundle['whats_included'] as $index => $e): 
                                $text = $e['text'];
                        ?>

                            <div class="text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <?php echo $text; ?>
                            </div>

                        <?php endforeach ;?>

                    </div>

                    <div class="subheading"><?php echo $bundle['subheading']; ?></div>

                    <div class="links">
                            
                        <a class="default-button" href="<?php echo $bundle['learn_more']; ?>">Learn More</a>

                        <a class="enrol" href="<?php echo $bundle['enrol_now']; ?>">Enrol Now</a>

                    </div>

                </div>

            </div>

        </section>

        <section>

            <!-- reviews section -->
            <?php
            $verified_reviews_section = get_field('verified_reviews_section');
            if($verified_reviews_section):
                $section_stitle = $verified_reviews_section['section_subtitle'];
                $section_title  = $verified_reviews_section['section_title'];
                // $reviews_widget = $verified_reviews_section['reviews_widget'];  
                $reviews_widget = get_field('reviews_widget','option');      
                $total_reviews_count    = isset($reviews_widget['total_reviews']) ? $reviews_widget['total_reviews']: 1671;
                $five_star_percentage   = isset($reviews_widget['star_percentage_5']) ? (float)$reviews_widget['star_percentage_5'] : 0;
                $four_star_percentage   = isset($reviews_widget['star_percentage_4']) ? (float)$reviews_widget['star_percentage_4'] : 0;
                $three_star_percentage  = isset($reviews_widget['star_percentage_3']) ? (float)$reviews_widget['star_percentage_3'] : 0;
                $two_star_percentage    = isset($reviews_widget['star_percentage_2']) ? (float)$reviews_widget['star_percentage_2'] : 0;
                $one_star_percentage    = isset($reviews_widget['star_percentage_1']) ? (float)$reviews_widget['star_percentage_1'] : 0;
                
                $reviews_average = (($five_star_percentage * 5) + ($four_star_percentage * 4 ) + ($three_star_percentage * 3) + ($two_star_percentage * 2) + ($one_star_percentage * 1 ))/100;
                    
            ?>
            <!-- Verified Student Reviews -->
                <section class="verified-student-reviews-section section-padding-top">
                    <div class="ast-container">
                        <div class="ast-row ">
                                <div class="verified-student-reviews-section__header">
                                    <div class="ast-col-md-6">
                                        <div class="verified-student-reviews-section__title font-600 mb-1 large-heading  ">
                                            <?php echo $section_title?>
                                        </div>
                                        <span class="verified-student-reviews-section__subtitle">
                                            <?php echo $section_stitle?>
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
                                        <div class="total-count-text"><span class="course-review-count">(<?php echo $reviews_average; ?>)</span> Out of <?php echo $total_reviews_count ?>global reviews</div>
                                    </div>
                                    </div>
                                </div>  
                        </div>          
                        <div class="spacer-column"></div>
                                <div class="ast-row verified-student-reviews-section__row">
                                    <div class="verified-student-reviews-section__row">
                                        <div class="ast-col-md-5">
                                            <div class="verified-student-reviews-section__review-summary">
                                                <?php for($i=5; $i>=1; $i--) :
                                                    $star_percentage = $reviews_widget['star_percentage_'.$i]; 
                                                    if(empty($star_percentage)): 
                                                        $star_percentage = 0;
                                                    endif; ?>
                                                    <div class     ="review-status">
                                                        <div class ="progress-text"><?php echo $i; ?> Star</div>
                                                        <div class="progress">
                                                            <div class="progress-bar" percent="<?php echo $star_percentage; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="progress-value"><?php echo $star_percentage;?>%</div>
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                            <div class="rplg rplg-insert" data-id="48500"></div>
                                        </div>
                                        <div class="ast-col-md-7 verified-student-reviews-section__slider">
                                            <?php echo do_shortcode('[brb_collection id="77247"]'); ?>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </section>
            <!-- Verified Student Reviews End -->
            <?php
            endif
            ?>

        </section>

        <?php
            $specialist_courses = get_field('specialist_courses');
            if(!is_array_empty($specialist_courses)):
        ?>
        <section class="content-section">
            <div class="specialist-courses-slider splide">
                <div class="splide__track">
                    <ul class="splide__list">
                    <?php
                    foreach ($specialist_courses as $key => $sc):
                        $image = $sc['image'] ?? '';
                        $icon = $sc['icon'] ?? '';
                        $title = $sc['title'] ?? '';
                        $completion_time = $sc['completion_time'] ?? '';
                        $course_id = $sc['course'] ?? '';
                        $course_link = $sc['course_link'] ?? '';
                        $course_price = ''; 

                        if ($course_id) {
                            $course_obj = wc_get_product($course_id);
                            $course_price = $course_obj ? $course_obj->get_price_html() : '';
                        }
                    ?>
                        <li class="splide__slide">
                            <div class="specialist-course-card">
                                <div class="card-header">
                                    <img class="course-header__image" src="<?php echo $image ?>" alt="">
                                    <img class="course-header__icon" src="<?php echo $icon ?>" alt="">
                                </div>
                                <div class="card-body">
                                    <div class="course-price">
                                        <?php echo $course_price ?>
                                    </div>
                                    <div class="course-title">
                                        <?php echo $title ?>
                                    </div>
                                    <div class="course-completion-time">
                                        <span>Completion time</span>
                                        <span><?php echo $completion_time ?></span>
                                    </div>
                                    <a href="<?php echo $course_link?>" class="course-link">
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php
                    endforeach;
                    ?>

                    </ul>
                </div>
            
            </div>
        </section>
        <?php
            endif;
        ?>

        <section class="content-section">

            <?php
                $tools = get_field('tools'); 
                $tools_title = get_field('tools_title'); 
            ?>
            
            <div class="tools-title"><?php echo $tools_title; ?></div>

            <div class="tools">
    
                <?php
                    foreach($tools as $index => $e): 
                        $icon = $e['icon'];
                        $name = $e['name'];
                        $text = $e['text'];
                        $button = $e['button'];
                ?>

                    <div class="tool">
                        <img src="<?php echo $icon; ?>">
                        <div class="name"><?php echo $name; ?></div>
                        <div class="text"><?php echo $text; ?></div>
                        <a href="<?php echo $button['link']; ?>" class="ahref"><?php echo $button['value']; ?></a>
                    </div>

                <?php endforeach ;?>

            </div>

        </section>

        <section class="content-section">

            <?php
                $accreditations = get_field('accreditations'); 
            ?>
            
            <div class="accreditations">

                <div class="title"><?php echo $accreditations['title']; ?></div>
                <img src="<?php echo $accreditations['graphic']; ?>">

                <div class="points">

                    <?php
                        foreach($accreditations['points'] as $index => $point): 
                            $point = $point['point'];
                    ?>

                        <div class="point">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="accreditations-svg"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <?php echo $point; ?>
                        </div>

                    <?php endforeach ;?>
                </div>

            </div>

        </section>

        <?php
            $faq = get_field('faq'); 
            if(!is_array_empty($faq)):
        ?>

        <section class="faq content-section">

            <div class="left-faq">

                <div class="title"><?php echo $faq['title']; ?></div>

                <div class="subtitle"><?php echo $faq['subtitle']; ?></div>

                <div class="faq-text"><?php echo $faq['text']; ?></div>
            
            </div>

            <div class="right-faq">
                <?php foreach ($faq['questions'] as $index => $e): 
                    $heading = $e['heading'];
                    $text = $e['text'];
                ?>
                    <div class="each-question">
                        <div class="heading" onclick="toggleFaq(this)">
                            <?php echo $heading; ?>
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="text">
                            <?php echo $text; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </section>

        <?php
            endif;
        ?>

        <section class="content-section">

            <?php
                $panel = get_field('panel'); 
            ?>

            <div class="panel">

                <?php
                    foreach($panel as $index => $e):
                        $icon = $e['icon'];
                        $heading = $e['heading'];
                        $text = $e['text'];
                ?>

                    <div class="each-panel">
                        <div class="left-panel"><img src="<?php echo $icon; ?>"></div>
                        <div class="right-panel">
                            <span><?php echo $heading; ?></span>
                            <?php echo $text; ?>
                        </div>
                    </div>

                <?php endforeach ;?>
            </div>

        </section>

    </div>

</div>

<div id="klarnaModal" class="klarna-modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img class="klarna-logo-header" src="/wp-content/uploads/2023/04/Klarna-logotype-black.svg_.svg" alt="">
        <?php if (is_front_page()): ?>
            <h2 class="klarna-modal-header home">3 interest payments of <span class="installment-price"></span> (0% APR).</h2>
        <?php else: ?>
            <h2 class="klarna-modal-header">3 interest payments of <?php echo geo_price($full_price / 3); ?> (0% APR).</h2>
        <?php endif; ?>
        <span class="klarna-modal-subheader">Pay in 3 interest-free payments so you can spread the cost. No fees.</span>
        <div class="klarna-payment-details">
            <span class="klarna-payment-detail">Add item(s) to your basket.</span>
            <span class="klarna-payment-detail">
                Go to checkout and choose 
                <img src="/wp-content/uploads/2023/04/Klarna-marketing-badge-pink-rgb.svg_.svg" alt="" class="klarna-logo">
            </span>
            <span class="klarna-payment-detail">Enter your debit or credit card information.</span>
            <span class="klarna-payment-detail">
                To check eligibility, Klarna will perform a soft search with credit reference agency. This will not affect your credit score.
            </span>
            <span class="klarna-payment-detail">
                Spread the cost in 3 interest-free payments. The first payment is made at point of purchase, with the remaining 2 payments scheduled automatically every 30 days. No fees.
            </span>
        </div>
        <div class="klarna-payment-footnote">
            Please note that a higher initial payment may be required for some purchases. You must be 18+ to use this credit offer. Klarna uses soft searches with credit reference agencies. This does not affect your credit rating. Missed payments can affect your ability to use the Pay in 3 feature.
        </div>
        <a href="#" class="close close-btn">Close</a>
    </div>
</div>

<script>
    function toggleFaq(element) {
        const text = element.nextElementSibling; // Get the .text div
        const icon = element.querySelector('.toggle-icon'); // Get the toggle icon
        
        // Toggle the display of the text content
        if (text.style.display === "block") {
            text.style.display = "none";
            icon.textContent = "+"; // Change icon back to +
        } else {
            text.style.display = "block";
            icon.textContent = "-"; // Change icon to -
        }
    }
</script>

<script>
    jQuery(document).ready(function ($) {
        var observer = new IntersectionObserver(function (entries) {
            console.log(entries);
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    // Only animate when the target element is in view
                    animateProgressBars();
                }
            });
        });
        // Observe the target element
        var targetElement = $('.verified-student-reviews-section')[0];
        observer.observe(targetElement);

        // Function to animate the progress bars
        function animateProgressBars() {

            $(".verified-student-reviews-section__slider .rplg-grid").appendTo(".verified-student-reviews-section__row .rplg-insert");

            $('.progress-bar').each(function () {
                var $this = $(this);
                var percent = $this.attr('percent');
                $this.css("width", percent + '%');
                $({ animatedValue: 0 }).animate({ animatedValue: percent }, {
                    duration: 3000,
                    step: function () {
                        $this.attr('percent', Math.floor(this.animatedValue) + '%');
                    },
                    complete: function () {
                        $this.attr('percent', Math.floor(this.animatedValue) + '%');
                    }
                });
            });
        }

        if ($('.specialist-courses-slider').length) {
            let testimonialsSlider = new Splide('.specialist-courses-slider', {
            type: 'slide',
            rewind: true,
            gap: '2rem',
            perPage: 3,
            perMove: 1,
            arrows: true,
            pagination: false,
            breakpoints: {
                768: {
                perPage: 1,
                perMove: 1,
                pagination: false,
                }
            }
            });


            function applyClass() {
                $('.splide__slide').removeClass('is-out-of-view');

                let index = testimonialsSlider.index;
                let visibleSlides = testimonialsSlider.options.perPage;

                $('.splide__slide').each(function (i) {
                    if (i < index || i >= index + visibleSlides) {
                    $(this).addClass('is-out-of-view');
                    }
                });
            }

            testimonialsSlider.on('move', applyClass);
            testimonialsSlider.mount();
            applyClass();
        }

        

        if (matchMedia('(min-width: 768px)').matches) {
            $('.course .includes').equalizeHeights();
        }
    })
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var modal = document.getElementById("klarnaModal");
        var learnMoreLinks = document.querySelectorAll(".learn-more-link"); // Add this class to your "Learn more" links
        var closeBtns = document.querySelectorAll(".close");

        // Open modal when "Learn more" is clicked
        learnMoreLinks.forEach(function (link) {
            link.addEventListener("click", function (event) {
                event.preventDefault();
                modal.style.display = "block";
            });
        });

        // Close modal when close button is clicked
        closeBtns.forEach(function (btn) {
            btn.addEventListener("click", function () {
                modal.style.display = "none";
            });
        });

        // Close modal when clicking outside the modal content
        window.addEventListener("click", function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
</script>

<?php get_footer(); ?>