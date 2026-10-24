<?php
add_action('wp_footer', 'ti_footer_course_banner');

function ti_footer_course_banner(){
    if(is_singular('course')){
        $course_id = get_the_ID();
    }elseif (isset($_COOKIE['course_id'])) {
        $course_id = $_COOKIE['course_id'];
    }
    $hide_footer_banner = get_field('hide_footer_banner','option');
    if($hide_footer_banner!=1):
        if(is_front_page() || is_singular('course')){
            $expiry_date= get_field('timer_expiry', 'option');
            $footer_offer_banner = get_field('footer_offer_banner','option');
            $show_clockdown = $footer_offer_banner['show_clockdown'];
            $show_banner_button = $footer_offer_banner['show_banner_button'];
            $banner_text = $footer_offer_banner['banner_text'];
            $banner_btn = $footer_offer_banner['banner_button'];
            $banner_btn_text = $banner_btn['button_text'];
            $banner_btn_link = $banner_btn['button_link'];
            $banner_styling =  $footer_offer_banner['banner_styling'];
            $banner_bg_color = $banner_styling['banner_background_color'];
            $banner_text_color = $banner_styling['banner_text_color'];
            $banner_text_font_size = $banner_styling['banner_text_font_size'];
            $banner_btn_bg_color = $banner_styling['banner_button_background_color'];
            $banner_btn_text_color = $banner_styling['banner_button_text_color'];
            $banner_btn_text_font_size = $banner_styling['banner_button_text_font_size'];
            if($show_banner_button && $show_clockdown){
                $banner_content_class="ast-col-md-6";
            }
            else
            if(!$show_banner_button && !$show_clockdown){
                $banner_content_class="ast-col-md-12";
            }
            else{
                $banner_content_class="ast-col-md-9";
            }
            ?>
            <div style = "background-color:<?php echo $banner_bg_color?>" class="footer-course-banner course-banner-outer footer-promo-banner sales-offer-banner">
                <div data-test="<?php echo $banner_content_class?>" class="banner-container">
                    <div class="ast-flex align-items-center footer-sales-banner">
                        <?php if(!empty($show_clockdown) && $show_clockdown):?>
                        <div class="ast-col-md-3 clockdown">
                            <span class="timer-text">
                                Offer ends in:
                            </span>
                            <div class="tefl_countdown_timer">
                                <?php echo clockdown_function($expiry_date);?>
                            </div>
                        </div>
                        <?php endif;?>
                        <div class="<?php echo $banner_content_class?>">
                            <div class="offer-banner-text"  style = "color:<?php echo $banner_text_color?>; font-size:<?php echo $banner_text_font_size?>px">
                                <?php echo $banner_text?>
                            </div>
                        </div>
                        <?php if(!empty($show_banner_button) && $show_banner_button):?>
                        <div class="ast-col-md-3">
                            <a style = "background:<?php echo $banner_btn_bg_color?>; color:<?php echo $banner_btn_text_color?> !important ; font-size:<?php echo $banner_btn_text_font_size?>px" href="<?php echo $banner_btn_link?>" class="cta-btn"><?php echo $banner_btn_text?></a>
                        </div>
                        <?php endif?>
                    </div>
                </div>
            </div>
            <?php
        }
        else{
            $show_footer_promo_banner = get_field('show_footer_promo_banner', 'options');
            if($show_footer_promo_banner){
                $footer_promo_banner = get_field('footer_promo_banner', 'options');
                $footer_promo_banner_text = $footer_promo_banner['text'];
                $footer_promo_banner_link = $footer_promo_banner['link'];
                $footer_promo_banner_product_id = $footer_promo_banner['product'];
                $footer_promo_banner_product_price = '';
                if($footer_promo_banner_product_id) :
                    $footer_promo_banner_product = wc_get_product( $footer_promo_banner_product_id );
                    $footer_promo_banner_product_price = $footer_promo_banner_product->get_price_html();
                endif;
                if($footer_promo_banner_text):
                    $html = '<div class="footer-course-banner course-banner-outer footer-promo-banner">';
                    $html .= '<div class="pass-rate"><img src="/wp-content/uploads/2022/01/megaphone.png"></div>';
                    $html .= '<div class="course-banner">';
                    $html .= '<div class="course-name">';
                    if($footer_promo_banner_link):
                        $html .= '<a href="'.$footer_promo_banner_link.'">';
                    endif;
                    $html .= $footer_promo_banner_text;
                    if($footer_promo_banner_product_price):
                        $html .= ' WAS '.$footer_promo_banner_product_price;
                    endif; 
                    if($footer_promo_banner_link):
                        $html .= '</a>';
                    endif;
                    $html .= '<div class="start-icon"><a href="'.$footer_promo_banner_link.'">Start <img src="/wp-content/uploads/2022/02/enter.png"></a></div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    echo $html;
                endif;
            }else{
                if($course_id){
                    $course_title = get_the_title($course_id);
                    $course_url = get_post_permalink($course_id);
                    $course_product_id = get_field('course_product', $course_id);
                    $_product = wc_get_product( $course_product_id );
                    // $percentage = round( ( ( $_product->regular_price - $_product->sale_price ) / $_product->regular_price ) * 100 );
                    $course_product_price = $_product->get_price_html();
                    $add_to_cart_url = home_url()."/checkout/?add-to-cart=".$course_product_id;
                    $has_variation = get_field('is_virtual_couse', $course_id);
                    if($has_variation){
                        $add_to_cart_url = get_post_permalink($course_id);
                        $add_to_cart_url = $add_to_cart_url.'#timetable';
                    }
                    $html = '<div class="footer-course-banner course-banner-outer">';
                    $html .= '<div class="pass-rate"><img src="/wp-content/uploads/2021/05/97-pass-rate-1.svg"><div><div class="top">97%</div><div class="bottom">PASS RATE</div></div></div>';
                    $html .= '<div class="course-banner">';
                    $html .= '<div class="course-name"><a href="'.$course_url.'">';
                    $html .= $course_title;
                    $html .= '</a></div>';
                    $html .= '<div class="start-icon"><a href="/"><img src="/wp-content/uploads/2022/02/Start-button.png"></a></div>';
                    $html .= '<div class="course-cart-url"><a href="'.$add_to_cart_url.'">Enrol Today <i class="fa fa-angle-right"></i></a>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    echo $html;
                }
            }
        }
    endif;
}