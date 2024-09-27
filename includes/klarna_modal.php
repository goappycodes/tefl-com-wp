<?php
?>
<div id="klarnaModal" class="klarna-modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img class="klarna-logo-header" src="/wp-content/uploads/2023/07/Klarna-logotype-black.svg_.svg" alt="">
        <?php
            if(is_front_page()):
        ?>
        <h2 class="klarna-modal-header home">3 interest payments of <span class="installment-price"></span> (0 APR).</h2>
        <?php
        else:
        ?>
        <h2 class="klarna-modal-header">3 interest payments of <?php echo geo_price($full_price/3)?> (0 APR).</h2>
        <?php
            endif;
        ?>
        <span class="klarna-modal-subheader">Pay in 3 interest-free payments so you can spread the cost. No fees.</span>
        <div class="klarna-payment-details">
            <span class="klarna-payment-detail">
                Add item(s) to your basket.
            </span>
            <span class="klarna-payment-detail">
                Go to checkout and choose 
                <img src="/wp-content/uploads/2023/07/klarna.svg" alt="" class="klarna-logo">
            </span>
            <span class="klarna-payment-detail">
                Enter your debit or credit card information.
            </span>
            <span class="klarna-payment-detail">
                To check eligibility, Klarna will perform a soft search with credit reference agency. This will not affect your credit score.
            </span>
            <span class="klarna-payment-detail">
                Spread the cost in 3 interest-free payments. The first payment is made at point of purchase, with the remaining 2 payments scheduled automatically every 30 days. No fees.
            </span>
        </div>
        <div class="klarna-payment-footnote">
            Please note that a  higher initial payment maybe required for some purchases. You must be 18+ to use this credit offer. Klarna uses soft searches with credit reference agencies. This do not affect your credit rating. Missed payments can affect your ability to use Pay in 3 feature.
        </div>
        <a href="#" class="close close-btn">Close</a>
    </div>
</div>
