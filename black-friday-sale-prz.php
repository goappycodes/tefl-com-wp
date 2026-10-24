<?php

/**
 * Template Name: Black Friday Sale Prz
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
    ?>

    <div class="hero" style="background-image: url('<?php echo $hero['background']; ?>')">
        <div class="glitter-overlay"></div>
        <div class="hero-outer">
            <div class="content-container">
                <img class="promo-image" src="<?php echo $hero['promo']; ?>">
                <div class="discount">
                    <div class="font-dosis">Discount Deadline:</div>
                    <?php echo do_shortcode('[tefl_timer_shortcode timer="black-friday-sales"]'); ?>
                </div>
            </div>
        </div> 
    </div>

    <div class="content-container">
        <?php 
            $top = get_field('top');
        ?>
        <section class="content-section">
            <div class="top-heading">
                <img src="/wp-content/uploads/2026/01/Layer_1.png">
                <div>
                    <h2 class="section-title">

                        <?php echo $top['title']; ?>
                    </h2>
                </div>
            </div>
            <!-- <div class="top-save">
                <div>Save Up To:</div>
                <img src="<?php echo $top['save_graphic']; ?>">
            </div> -->
        </section>

       
        <section class="content-section">

            <?php
                $courses        = get_field('courses'); 
                $courses_title  = get_field('courses_title'); 
            ?>

            <div class="courses-title"><?php echo $courses_title; ?></div>

            <section class="content-section courses">

    <?php
        // Load Trustpilot bootstrap only once
        $tp_bootstrap_loaded = false;

        // Klarna installment count used in your markup
        $installment_count = 3;

        foreach ($courses as $index => $course):
            $thumbnail       = $course['thumbnail'];
            $icon            = $course['icon'];
            $title           = $course['title'];
            $product         = $course['product'];
            $product_id      = $product->ID;
            $product_obj     = wc_get_product($product_id);
            $currency_symbol = get_woocommerce_currency_symbol();
            $regular_price   = $product_obj->get_regular_price();
            $sale_price      = $product_obj->get_sale_price();

            $price_to_use    = $sale_price ? $sale_price : $regular_price;

            $full_price         = $product_obj->get_price();
            $installment_price  = geo_price($full_price/3);

            if ($regular_price && $sale_price) {
                $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
            } else {
                $discount_percentage = 0;
            }

            $completion_time = $course['completion_time'];
            $enrol_button    = $course['enrol_button'];
            $includes_title  = $course['includes_title'];
            $includes        = $course['includes'];
            $toggle_offer    = $course['toggle_offer'];
            $offer           = $course['offer'];
            $button          = $course['button'];
            $learn_more      = $course['learn_more'];
    ?>
    
    <div class="course">
        
        <a href="<?php echo $learn_more['link']; ?>">
            <div class="thumbnail" style="background-image: url('<?php echo $thumbnail; ?>')">
                <div class="off-container"><div class="off">January Sale <span style="color:#DDB239"><?php echo esc_html($discount_percentage); ?>% Off</span></div></div>
                <div class="thumbnail-outer">
                    <div class="icon" style="background-image: url('<?php echo $icon; ?>')"></div>
                </div>
            </div>
        </a>

        <div class="title"><?php echo $title; ?></div>

        <div class="price">
            <div class="product-pricing">
                <div><?php echo $product_obj->get_price_html();?></div>
            </div>
        </div>

        <div class="completion-time"><span>Completion Time:</span><?php echo $completion_time; ?></div>

        <div class="klarna">
            <img src="https://teflinstitute.com/wp-content/uploads/2024/11/klarna-1.png" alt="Klarna">
            <div>Split the purchase into <?php echo $installment_count; ?> payments of <?php echo $installment_price; ?> (0% APR). <a href="#" class="learn-more-link">Learn more</a></div>
        </div>

        <div class="includes_title"><?php echo $includes_title; ?></div>

        <div class="includes">
            <?php foreach($includes as $index => $include): ?>
                <div class="include">
                    <img src="https://teflinstitute.com/wp-content/uploads/2025/11/tikpoint.svg" alt="">
                    <?php echo $include['text']; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($toggle_offer) : ?>
            <div class="offer"><?php echo $offer; ?></div>
        <?php endif; ?>

        <div class="buttons">
            <a class="default-button" href="<?php echo $button['link']; ?>"><?php echo $button['value']; ?></a>

            <?php if ($product_id === 430): ?>
                <a class="enrol" href="/cart/?addtimetocart&prid=<?php echo $product_id;?>"><?php echo $learn_more['value']; ?></a>
            <?php else: ?>
                <a class="enrol" href="<?php echo $learn_more['link']; ?>"><?php echo $learn_more['value']; ?></a>
            <?php endif; ?>
        </div>

        <?php
            // ---- Trustpilot widget just after buttons ----
            // Detect which course (by title) and select tag + token
            $tp_tag   = null;
            $tp_token = null;

            if (stripos($title, '120') !== false) {
                $tp_tag   = '120';
                $tp_token = '05cba9f3-167d-4342-b7ae-1a730b015165';
            } elseif (stripos($title, '180') !== false) {
                $tp_tag   = '180';
                $tp_token = '081da83e-d5b4-4245-96d5-28deb09a200b';
            } elseif (stripos($title, '300') !== false) {
                $tp_tag   = '300';
                $tp_token = '78a648a4-18ce-47d2-83b3-89c57e2fcbe0';
            }

            if ($tp_tag):
                // load bootstrap only once
                if (!$tp_bootstrap_loaded) {
                    $tp_bootstrap_loaded = true;
                    ?>
                    <!-- TrustBox script -->
                    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
                    <!-- End TrustBox script -->
                    <?php
                }
                ?>
                <!-- TrustBox widget - Drop-Down -->
                <div class="trustpilot-widget"
                    data-locale="en-US"
                    data-template-id="5418052cfbfb950d88702476"
                    data-businessunit-id="61c0c19118c53fc28bcc355d"
                    data-style-height="30px"
                    data-style-width="100%"
                    data-token="<?php echo esc_attr($tp_token); ?>"
                    data-tags="<?php echo esc_attr($tp_tag); ?>"
                    data-stars="4,5"
                    data-review-languages="en">
                    <a href="https://www.trustpilot.com/review/teflinstitute.com" target="_blank" rel="noopener">Trustpilot</a>
                </div>
                <!-- End TrustBox widget -->
                <style>.course .trustpilot-widget{margin-top:12px}</style>
        <?php endif; ?>

    </div>

    <?php endforeach; ?>

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
                  
            <div class="bundle-title font-dosis"><?php echo $bundle_title; ?></div>
            
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
                                <img src="https://teflinstitute.com/wp-content/uploads/2025/11/yellow_tikpoint.svg" alt="" srcset="">
                                <?php echo $text; ?>
                            </div>

                        <?php endforeach ;?>

                    </div>

                    <div class="subheading"><?php echo $bundle['subheading']; ?></div>

                    <div class="links">
                            
                        <a class="default-button" href="<?php echo $bundle['learn_more']; ?>">Learn More</a>

                        <a class="enrol" href="<?php echo $bundle['enrol_now']; ?>">CLAIM MY DEAL</a>

                    </div>

                </div>

            </div>

        </section>



        
        <section class="content-section">

            <?php
                $gifts = get_field('gifts'); 
            ?>
            
            <div class="gifts">

                <div class="left">
                    <div class="title font-dosis"><?php echo $gifts['title']; ?></div>
                    <div class="text"><?php echo $gifts['text']; ?></div>
                    
                    <a class="enrol font-dosis" href="/tefl-courses-overview/">Worth £250 - Yours Free!</a>
                    
                </div>

                <div class="right">

                    <?php
                        foreach($gifts['guides'] as $index => $guide): 
                            $image = $guide['image'];
                            $name = $guide['name'];
                    ?>

                        <div class="guide">
                            <img src="<?php echo $image; ?>">
                        </div>

                    <?php endforeach ;?>
                </div>

            </div>

        </section>



<section class="content-section">
    <div class="power-pack">
        <div class="left" style="background-image:url('https://teflinstitute.com/wp-content/uploads/2025/11/power-pack.png')">

        </div>
        <div class="right">
            <div class="title">The January Sale Specialist Power Pack</div>
            <div class="short-description">
                This Black Friday, unlock your full TEFL potential with our best-selling Specialist Power Pack - now only £62.
Get 6 courses for the price of one and gain specialist TEFL certificates that will help you stand out in the global teaching market.
Perfect for those who already hold a TEFL qualification or want to deepen their expertise - this bundle is your key to becoming a sought-after teacher.
<b>Don’t miss your chance - once it’s gone, it’s gone.</b>
            </div>
            <div class="links">
                            
                <a class="default-button" href="https://teflinstitute.com/tefl-specialist-course-bundle/">Learn More</a>

                <a class="enrol" href="https://teflinstitute.com/cart/?addtimetocart&prid=91273">CLAIM MY DEAL</a>

            </div>
        </div>
    </div>
</section>
<section class="content-section review-section">

<!-- reviews section -->
<?php
$verified_reviews_section = get_field('verified_reviews_section');
if($verified_reviews_section):
    $section_stitle = $verified_reviews_section['section_subtitle'];
    $section_title  = $verified_reviews_section['section_title'];
    // $reviews_widget = $verified_reviews_section['reviews_widget']; 
    $reviews_widget = $verified_reviews_section['reviews_widget'];
    $total_reviews_count    = isset($reviews_widget['total_reviews']) ? $reviews_widget['total_reviews']: 1671;
    $five_star_percentage   = isset($reviews_widget['5_star_percentage']) ? (float)$reviews_widget['5_star_percentage'] : 0;
    $four_star_percentage   = isset($reviews_widget['4_star_percentage']) ? (float)$reviews_widget['4_star_percentage'] : 0;
    $three_star_percentage  = isset($reviews_widget['3_star_percentage']) ? (float)$reviews_widget['3_star_percentage'] : 0;
    $two_star_percentage    = isset($reviews_widget['2_star_percentage']) ? (float)$reviews_widget['2_star_percentage'] : 0;
    $one_star_percentage    = isset($reviews_widget['1_star_percentage']) ? (float)$reviews_widget['1_star_percentage'] : 0;
    
    $reviews_average = (($five_star_percentage * 5) + ($four_star_percentage * 4 ) + ($three_star_percentage * 3) + ($two_star_percentage * 2) + ($one_star_percentage * 1 ))/100;
    
?>
<!-- Verified Student Reviews -->
<section class="testimonial-section">

            <!-- reviews section -->
            <?php
                $verified_reviews_section = get_field('verified_reviews_section');
                if($verified_reviews_section):
                    $section_stitle = $verified_reviews_section['section_subtitle'];
                    $section_title  = $verified_reviews_section['section_title'];
                    $video_testimonials_section  = $verified_reviews_section['video_testimonials_section'];
                    $video_testimonials  = $video_testimonials_section['video_testimonials'];
                    $review_logos  = $video_testimonials_section['review_logos'];
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
                                        <div class="verified-student-reviews-section__title font-600 mb-1 large-heading double-underline">
                                            <?php echo $section_title?>
                                        </div>
                                        <p class="verified-student-reviews-section__subtitle">
                                            <?php echo $section_stitle?>
                                        </p>
                                    </div>
                                </div>  
                        </div>          
                        <div class="spacer-column"></div>
                                <div class="ast-row verified-student-reviews-section__row">
                                    <div class="verified-student-reviews-section__row">
                                        <div class="ast-col-md-6">
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
                                            <div class="verified-student-reviews-section__slider">
                                                <?php echo do_shortcode('[brb_collection id="77247"]'); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="ast-col-md-6 video-testimonials">
                                            <div class="ast-row video-testimonial">
                                                <div class="video-testimonials__slider">
                                                    <?php foreach($video_testimonials as $testimonials):
                                                    $thumbnail_image = $testimonials['thumbnail_image'];
                                                    $play_button_image = $testimonials['play_button_image'];
                                                    $name = $testimonials['name'];
                                                    $subtitle = $testimonials['subtitle'];
                                                    $video_link = $testimonials['video_link'];
                                                     ?>
                                                        <div class="ast-col-md-6">
                                                            <div class="video-testimonial-card">
                                                                <a data-lity href="<?php echo $video_link; ?>" class="popup-video-review">
                                                                <div class="video-testimonial-card_image-container">
                                                                    <img src="<?php echo $thumbnail_image; ?>" alt="" class="video-testimonial-card__image">
                                                                    <div class="play-btn">
                                                                        <img src="<?php echo $play_button_image; ?>" alt="" class="">
                                                                    </div>
                                                                    
                                                                </div>
                                                                
                                                                <h3 class="video-testimonial-card__title font-600 small-heading"><?php echo $name; ?></h3>
                                                                <span class="video-testimonial__subtitle font-400"><?php echo $subtitle; ?></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="reviews-cols">
                                                <?php foreach($review_logos as $review_logo):
                                                    $review_logo_image = $review_logo['review_logo_image'];
                                                    $review_logo_link = $review_logo['review_logo_link']; ?>
                                                <a href="<?php echo $review_logo_link; ?>" class="google-widget" target="_blank" rel="noopener noreferrer">
                                                    <div class="google-reviews-badge">
                                                        <img src="<?php echo $review_logo_image; ?>"/>
                                                    </div>
                                                </a>
                                                <?php endforeach; ?>
                                            </div>
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
<!-- Verified Student Reviews End -->
<?php
endif
?>


</section>

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

        <section class="content-section">

        <?php
            $faq = get_field('faq'); 
        ?>

        <div class="faq">

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