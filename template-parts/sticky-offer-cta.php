<?php
$sticky_offer_data = $args['sticky_offer_data'];
$cta_title = $sticky_offer_data['cta_title'];
$cta_subtitle = $sticky_offer_data['cta_subtitle'];
$cta_summary = $sticky_offer_data['cta_summary'];
$cta_button_text = $sticky_offer_data['cta_button_text'];
$cta_button_link = $sticky_offer_data['cta_button_link'];
$offer_product_id = $sticky_offer_data['offer_product'];

$offer_product_price_html = '';
$sale_price = 25;

if ($offer_product_id) {
    $offer_product_obj = wc_get_product($offer_product_id);

    if ($offer_product_obj) {
        $regular_price = $offer_product_obj->get_regular_price();

        if (!empty($regular_price) && $regular_price > $sale_price) {
            $formatted_regular_price = wc_price($regular_price);
            $formatted_sale_price = wc_price($sale_price);

            $offer_product_price_html = sprintf(
                '<del aria-hidden="true">%1$s</del> <ins>%2$s</ins>',
                $formatted_regular_price,
                $formatted_sale_price
            );
        } else {
            $offer_product_price_html = wc_price($sale_price);
        }
    } else {
         $offer_product_price_html = wc_price($sale_price);
    }
} else {
    $offer_product_price_html = wc_price($sale_price);
}

$expiry_date = get_field('timer_expiry', 'option');
$current_time = current_time('timestamp');
$expiration_time = strtotime($expiry_date);
?>
<style>
    .sticky-offer-cta {
        --width: 250px;
        max-width: var(--width);
        z-index: 99999;
        position: fixed;
        top: 100px;
        left: 2rem;
        background: #dedcd3;
        text-align: center;
        border-radius: 8px;
        padding: 1rem;
        border: 5px double var(--black-jet);
        display: none;
    }

    .sticky-offer-cta .cta-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--black-jet);
    }

    .sticky-offer-cta .cta-subtitle {
        font-size: 18px;
        font-weight: 800;
        color: var(--black-jet);
    }

    .sticky-offer-cta .cta-summary {
        font-size: 16px;
        margin: 1rem auto;
    }

    .sticky-offer-cta .cta-offer-btn {
        background: var(--black-jet);
        color: var(--white);
        justify-content: center;
        padding: 10px;
        font-weight: 500;
        margin-top: 1rem;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 1px;
        width: 100%;
        border-radius: 8px;
    }

    .sticky-offer-cta .cta-offer-btn:hover{
        background: var(--white);
        color: var(--black-jet);
    }

    .sticky-offer-cta span.flip-clock__slot {
        color: var(--black-jet);
        font-weight: 600;
    }

    .sticky-offer-cta .flip-clock__piece {
        display: inline-block;
        margin: 0 3px;
    }
    
    .sticky-offer-toggle {
        position: fixed;
        top: 50%;
        transform:translateY(-50%);
        left: 15px;
        z-index: 100000;
        background: var(--black-jet);
        color: var(--white);
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        display: none; /* Hidden by default */
    }

    img.cta-offer-icon {
        --width: 55px;
        width: var(--width);
        left: calc(-1*var(--width)/2);
        top: calc(-1*var(--width)/2);
        position: absolute;
    }

    .sticky-offer-toggle i {
        font-size: 25px;
    }
    
    .sticky-offer-toggle:hover {
        background: #444;
    }
    
    .sticky-offer-close {
        position: absolute;
        top: 5px;
        right: 5px;
        font-size: 16px;
        cursor: pointer;
        color: var(--black-jet);
    }
    
 
    @media (max-width: 1750px) {
        .sticky-offer-cta {
            transform: translateX(-300px);
            transition: transform 0.3s ease;
        }
        
        .sticky-offer-cta.open {
            transform: translateX(0);
        }
    }
</style>

<div class="sticky-offer-toggle">
    <i class="fa fa-gift"></i>
</div>

<!-- Sticky CTA container -->
<div class="sticky-offer-cta">
    <img src="https://teflinstitute.com/wp-content/uploads/2025/04/IELTS-Educator-logo.png" alt="" class="no-lazy cta-offer-icon">
    <div class="sticky-offer-close">&times;</div>
    <h4 class="cta-subtitle"><?php echo $cta_subtitle; ?></h4>
    <h3 class="cta-title"><?php echo $cta_title; ?></h3>
    <div class="cta-product-price">
        <?php echo $offer_product_price_html; ?>
    </div>
    <div class="cta-summary">
        <?php echo $cta_summary; ?>
    </div>
    <?php
        if($current_time < $expiration_time):
    ?>
    <div class="cta-offer-clock">
        <?php echo do_shortcode('[flip_countdown_timer]'); ?>
    </div>
    <?php
        endif;
    ?>
    <?php
        if(get_the_ID() === 47):
    ?>
    <a rel="nofollow" class="btn cta-offer-btn" href="https://teflinstitute.com/?addtimetocart&prid=430">
        Enrol Today
    </a>
    <?php
        else:
    ?>
    <a class="btn cta-offer-btn" href="<?php echo $cta_button_link; ?>">
        <?php echo $cta_button_text; ?>
    </a>
    <?php
        endif;
    ?>
</div>

<script>
    jQuery(document).ready(function($) {
        const targetSection = $('.cta-section');
        const stickyCTA = $('.sticky-offer-cta');
        const stickyToggle = $('.sticky-offer-toggle');
        const stickyClose = $('.sticky-offer-close');

        const targetSectionExists = targetSection.length > 0;
        let sectionTop = 0;
        let isUpdateScheduled = false;

        function updateVisibilityBasedOnWidthAndState() {
            const windowWidth = $(window).width();
            if (windowWidth > 1750) {
                if (!stickyCTA.is(':visible')) stickyCTA.show();
                if (stickyToggle.is(':visible')) stickyToggle.hide();
            } else {
                if (stickyToggle.css('display') !== 'flex') stickyToggle.css('display', 'flex');
                const isOpen = stickyCTA.hasClass('open');
                const isVisible = stickyCTA.is(':visible');
                if (isOpen && !isVisible) {
                    stickyCTA.show();
                } else if (!isOpen && isVisible) {
                    stickyCTA.hide();
                }
            }
        }

        function hideAllStickyElements() {
            if (stickyCTA.is(':visible')) stickyCTA.hide();
            if (stickyToggle.is(':visible')) stickyToggle.hide();
            if ($(window).width() <= 1750 && stickyCTA.hasClass('open')) {
                stickyCTA.removeClass('open');
            }
        }

        if (targetSectionExists) {
            sectionTop = targetSection.offset().top;

            function runScrollBasedUpdate() {
                const scrollTop = $(window).scrollTop();
                if (scrollTop >= sectionTop) {
                    updateVisibilityBasedOnWidthAndState();
                } else {
                    hideAllStickyElements();
                }
                isUpdateScheduled = false;
            }

            runScrollBasedUpdate();

            $(window).on('scroll', function() {
                if (!isUpdateScheduled) {
                    isUpdateScheduled = true;
                    requestAnimationFrame(runScrollBasedUpdate);
                }
            });

            $(window).on('resize', function() {
                sectionTop = targetSection.offset().top;
                if (!isUpdateScheduled) {
                    isUpdateScheduled = true;
                    requestAnimationFrame(runScrollBasedUpdate);
                }
            });

        } else {

            updateVisibilityBasedOnWidthAndState();

            $(window).on('resize', function() {
                if (!isUpdateScheduled) {
                    isUpdateScheduled = true;
                    requestAnimationFrame(updateVisibilityBasedOnWidthAndState);
                }
            });
        }

        stickyToggle.on('click', function() {
            stickyCTA.toggleClass('open').show();
        });

        stickyClose.on('click', function() {
            const wasOpen = stickyCTA.hasClass('open');
            stickyCTA.removeClass('open');
            // if (wasOpen) {
                setTimeout(function() {
                    if (!stickyCTA.hasClass('open')) {
                        stickyCTA.hide();
                        stickyToggle.css('display','flex');
                    }
                }, 300);
            // }
        });

    });
</script>