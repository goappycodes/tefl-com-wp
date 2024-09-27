<?php

$_transient_brb_collection_reviews = get_option( '_transient_brb_collection_1.6_1150_reviews' );
$brb_businesses = isset($_transient_brb_collection_reviews['businesses']) ? $_transient_brb_collection_reviews['businesses'] : [];

foreach($brb_businesses as $brbb) :
    if( $brbb->provider == 'google' ) :
        $google_review_count = $brbb->review_count;
    endif;
endforeach;

// $reviews_widget = get_field('reviews_widget');
$reviews_widget = get_field('reviews_widget','option');


$total_reviews_count    = isset($reviews_widget['total_reviews']) ? $reviews_widget['total_reviews']: 1570;
$five_star_percentage   = isset($reviews_widget['star_percentage_5']) ? (float)$reviews_widget['star_percentage_5'] : 0;
$four_star_percentage   = isset($reviews_widget['star_percentage_4']) ? (float)$reviews_widget['star_percentage_4'] : 0;
$three_star_percentage  = isset($reviews_widget['star_percentage_3']) ? (float)$reviews_widget['star_percentage_3'] : 0;
$two_star_percentage    = isset($reviews_widget['star_percentage_2']) ? (float)$reviews_widget['star_percentage_2'] : 0;
$one_star_percentage    = isset($reviews_widget['star_percentage_1']) ? (float)$reviews_widget['star_percentage_1'] : 0;

$reviews_average = (($five_star_percentage * 5) + ($four_star_percentage * 4 ) + ($three_star_percentage * 3) + ($two_star_percentage * 2) + ($one_star_percentage * 1 ))/100;

?>

<?php wp_enqueue_style('ti-new-review-css'); ?>

<div class="review-widget-views">
    <h6 class="section-heading">CUSTOMER REVIEWS</h6>
    <div class="star-div"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-empty"></i><span class="course-review-count">(<?php echo $reviews_average; ?>)</span></div>
    <div class="total-count-text">Out of <?php echo $total_reviews_count ?> global reviews</div>
    <div class="review-statuses">
        <?php for($i=5; $i>=1; $i--) :
            $star_percentage = $reviews_widget['star_percentage_'.$i]; 
            if(empty($star_percentage)): 
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
        <div class="read-all-reviews-btn"><a href="https://search.google.com/local/reviews?placeid=ChIJR8_41hsMZ0gR2i2CJcrWIf8">
            <span>Read all reviews</span> <i class="fa fa-angle-right"></i>
        </a></div>
    </div>
    
</div>

<?php wp_enqueue_script('ti-new-review-js'); ?>
