<?php

    global $post;
    $current_post_id = $post->ID;
    $hide_header_banner = get_field('hide_header_banner','option');
    $expiry_date= get_field('timer_expiry', 'option');
    $header_banner = get_field('banner','option');
    foreach($header_banner as $hb):
        $banner_text = $hb['content'];
        $banner_styling = $hb['banner_styling'];
        $banner_bg_color = $banner_styling['banner_background_color'];
        $banner_text_color = $banner_styling['banner_text_color'];
        $banner_text_font_size = $banner_styling['banner_text_font_size'];
        $where_to_show = !empty($hb['where_to_show']) ? $hb['where_to_show'] : [];
        $show_clockdown = $hb['show_clockdown'];
        $banner_logo = $hb['banner_logo'];
        $banner_logo_link = $hb['banner_logo_link'];
        $show_button = $hb['show_button'];
        $banner_btn = $hb['button'];
        $banner_btn_link = $banner_btn['link'];
        $banner_btn_text = $banner_btn['text'];
        $banner_btn_styling = $hb['button_styling'];
        $btn_bg_color = $banner_btn_styling['button_background_color'];
        $btn_text_color = $banner_btn_styling['button_text_color'];
        $btn_text_size = $banner_btn_styling['button_text_font_size'];
        
        if(in_array($current_post_id, $where_to_show) && !$hide_header_banner):
    ?>
        <div style="background:<?php echo $banner_bg_color?>; z-index:999" class="sales-offer-banner-mobile header-offer-banner <?php echo current_user_can('administrator')?'is-wp-admin':''?>">
            <div class="ast-container ast-flex ast-align-items-center">
                <div class="ast-col-md-3 logo-timer-container">
                    <?php if($show_clockdown):?>
                    <div class="banner-clock-text">Offer ends in:</div>
                    <div class="tefl_countdown_timer">
                        <?php echo do_shortcode('[flip_countdown_timer expiry_date="' . esc_attr($expiry_date) . '"]');?>
                    </div>
                    <?php else:?>
                        <div class="promo-logo-container <?php echo $banner_logo?>">
                            <a href="<?php echo $banner_logo_link?>">
                            <img src="<?php echo $banner_logo?>" alt="">
                            </a>
                        </div>
                    <?php endif;?>
                </div>
                <div class="<?php echo($show_clockdown && $show_button)?'ast-col-md-6':'ast-col-md-6'?> banner-content-container">
                    <div style="color:<?php echo $banner_text_color?>; font-size:<?php echo $banner_text_font_size?>px" class="mobile-offer-banner-text">
                        <?php echo $banner_text ?>
                    </div>
                </div>
                <div class="ast-col-md-3 cta-container">
                    <?php if($show_button):?>
                        <a style="background:<?php echo $btn_bg_color?>; color:<?php echo $btn_text_color?> !important; font-size:<?php echo $btn_text_size?>px" href="<?php echo $banner_btn_link?>" class="cta-btn-white"><?php echo  $banner_btn_text?></a>
                    <?php endif?>
                </div>
                
                <a href="<?php echo $banner_btn_link?>" class="banner-offer-overlay-link"></a>
            </div>
        </div>
    <?php 
            endif;
        endforeach;
    ?>