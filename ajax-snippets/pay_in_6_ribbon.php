<?php
$course_product_id = $_POST['objectid'];

$course_product     = wc_get_product($course_product_id);
if ($course_product){
    $full_price = $course_product->get_price();
    $deposit_payment_plan = 6;
    
    $simple_regular_price = $course_product->get_regular_price();
    $simple_sale_price = $course_product->get_sale_price();
    
    $percentage = round((($simple_regular_price - $simple_sale_price) / $simple_regular_price) * 100);
    
    include(get_stylesheet_directory()."/template-parts/deposit-info.php"); 
    
    ?>
    
    <div class="pay-in-six deposit-info ast-flex ast-align-items-center">
        <div class="deposit-info__first-deposit">
            <span class="title-text">enrol today for</span>
            <?php echo geo_price($first_payment)?>
        </div>
        <div class="ast-flex flex-direction-column deposit-info__details">
            <!-- <h5 class="deposit-info_title">Save <?php echo $percentage?>%</h5> -->
            <div class="deposit-info_description">
                <?php echo $deposit_description?>
            </div>
        </div>
    </div>
    <?php
}