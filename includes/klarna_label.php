<?php
?>
<div class="klarna-label-outer">
    <div class="klarna-payment-info-container">
        <img src="/wp-content/uploads/2023/07/klarna.svg" alt="" class="klarna-logo">
        <div class="klarna-payment-info">
            Split the purchase into 3 payments of <?php echo geo_price($full_price/3)?> (0 APR).
            <?php
            if(is_front_page() || is_page_template('tefl-home-template-2023.php')):
            ?>
            <span class="klarna-learn-more" data-full-price="<?php echo strip_tags($price_per_installment)?>">Learn more</span>
            <?php
            else:
            ?>
            <span class="klarna-learn-more">Learn more</span>
            <?php
            endif
            ?>
        </div>
    </div>
</div>