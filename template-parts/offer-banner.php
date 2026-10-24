<?php
    global $post;
    $current_post_id = $post->ID;
    $hide_header_banner = get_field('hide_header_banner','option');
    $expiry_date = get_field('timer_expiry', 'option');
    $current_date = current_time('Y-m-d H:i:s'); 
    $timer_active = strtotime($current_date) < strtotime($expiry_date);
    $header_banner = get_field('banner','option');
    $banner_shown = false;
    $blog_page_id = (int) get_option('page_for_posts') ?: 122;

    if($header_banner):
        foreach($header_banner as $hb):
            $banner_text = $hb['content'];
            $banner_mobile_text    = $hb['mobile_content'];
            $content_icon = $hb['content_icon'];
            $banner_styling = $hb['banner_styling'];
            $banner_bg_color = $banner_styling['banner_background_color'];
            $banner_text_color = $banner_styling['banner_text_color'];
            $banner_text_font_size = $banner_styling['banner_text_font_size'];
            $banner_border_thickness = $banner_styling['banner_border_thickness'] ?? '1';
            $banner_border_color = $banner_styling['banner_border_color'] ?? '#1c1c1b';
            $where_to_show = !empty($hb['where_to_show']) ? $hb['where_to_show'] : [];
            $show_clockdown_option = $hb['show_clockdown'];
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
            $timer_active_banner = $show_clockdown_option && $timer_active;
            $clock_with_offer_text = $hb['clock_with_offer_text']; 

            $show_on_page = in_array($current_post_id, $where_to_show);
            $show_on_blog = is_singular('post') && in_array($blog_page_id, $where_to_show);
            
            if(($show_on_page || $show_on_blog) && !$hide_header_banner):
                $banner_shown = true;
        ?>
            <div data-test="<?php echo $timer_active_banner?>" style="--banner_border_thickness:<?php echo $banner_border_thickness.'px'?>; --banner_border_color:<?php echo $banner_border_color ?>; --banner-bg-color:<?php echo $banner_bg_color?>; --banner-z-index:999" class="sales-offer-banner-mobile header-offer-banner <?php echo current_user_can('administrator')?'is-wp-admin':''?>">
                <div class="ast-container ast-flex ast-align-items-center">
                    <div class="ast-col-md-3 logo-timer-container <?php echo $clock_with_offer_text ? 'clock-bubble' : ''; ?>">
                        <?php if($clock_with_offer_text ):
                            $clock_offer_text = $hb['clock_offer_text'];
                        ?>
                            <div class="banner-clock-offer-text">
                                <img class="no-lazy" src="/wp-content/uploads/2025/02/TI-brand-copy.png" alt="">
                                <div class="content-wrapper">
                                    <div class="clock-offer-text"><?php echo $clock_offer_text?></div>
                                    <div class="banner-clock-text">Offer Ends:</div>
                                    <div class="tefl_countdown_timer">
                                        <?php echo do_shortcode('[flip_countdown_timer expiry_date="' . esc_attr($expiry_date) . '"]');?>
                                    </div>
                                </div>
                            </div>
                            <div class="promo-logo-container">
                                <a href="<?php echo $banner_logo_link?>">
                                    <img src="<?php echo $banner_logo?>" alt="">
                                </a>
                            </div>
                        <?php else:?>
                            <div class="promo-logo-container">
                                <?php if($timer_active_banner): ?>
                                    <div class="tefl_countdown_timer">
                                        <div class="banner-clock-text">Offer Ends:</div>
                                        <?php echo do_shortcode('[flip_countdown_timer expiry_date="' . esc_attr($expiry_date) . '"]');?>
                                    </div>
                                <?php else: ?>
                                    <a href="<?php echo $banner_logo_link?>">
                                        <img src="<?php echo $banner_logo?>" alt="">
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif;?>
                    </div>
                    <div class="<?php echo($timer_active_banner && $show_button)?'ast-col-md-6':'ast-col-md-6'?> banner-content-container">
                        <?php
                            if(!empty($content_icon)):
                        ?>
                            <img src="<?php echo $content_icon; ?>" alt="">
                        <?php
                            endif;
                        ?>
                        <div style="--text-color:<?php echo $banner_text_color?>; --font-size:<?php echo $banner_text_font_size?>px" class="offer-banner-text desktop-offer-banner-text">
                            <?php echo geo_replace_currency_default($banner_text); ?>
                        </div>
                        <div style="--text-color:<?php echo $banner_text_color?>; --font-size:<?php echo $banner_text_font_size?>px" class="offer-banner-text mobile-offer-banner-text">
                            <?php echo geo_replace_currency_default($banner_mobile_text); ?>
                        </div>
                    </div>
                    <div class="ast-col-md-3 cta-container">
                        <?php if($show_button):?>
                            <a style="--bg-color:<?php echo $btn_bg_color ?>; --text-color:<?php echo $btn_text_color ?>; --font-size:<?php echo $btn_text_size ?>px" href="<?php echo $banner_btn_link?>" class="cta-btn-white"><?php echo $banner_btn_text?></a>
                        <?php endif?>
                    </div>
                    
                    <a href="<?php echo $banner_btn_link?>" class="banner-offer-overlay-link"></a>
                </div>
            </div>
        <?php 
            endif;
        endforeach;
    endif;

    $promo = get_field('page_promo_banner','option');
    $promo_where_to_show = !empty($promo['where_to_show']) ? $promo['where_to_show'] : [];
    $promo_show_on_page = in_array($current_post_id, $promo_where_to_show);
    $promo_show_on_blog = is_singular('post') && in_array($blog_page_id, $promo_where_to_show);

    if($promo && !$hide_header_banner && !$banner_shown && ($promo_show_on_page || $promo_show_on_blog)):
        $promo_content    = $promo['content'];
        $content_icon_promo = $promo['content_icon'];
        $promo_style      = $promo['banner_styling'];
        $promo_bg         = $promo_style['banner_background_color'];
        $promo_text_color = $promo_style['banner_text_color'];
        $promo_text_size  = $promo_style['banner_text_font_size'];
        $promo_border_color     = $promo_style['banner_border_color'] ?? '#1c1c1b';
        $promo_border_thickness = $promo_style['banner_border_thickness'] ?? '1';
        $promo_btn        = $promo['button'];
        $promo_btn_text   = $promo_btn['text'];
        $promo_btn_link   = $promo_btn['link'];
        $promo_btn_style  = $promo['button_styling'];
        $promo_btn_bg         = $promo_btn_style['button_background_color'];
        $promo_btn_text_color = $promo_btn_style['button_text_color'];
        $promo_btn_text_size  = $promo_btn_style['button_text_font_size'];
    ?>
        <div style="--banner_border_thickness:<?php echo $promo_border_thickness.'px'?>; --banner_border_color:<?php echo $promo_border_color?>; --banner-bg-color:<?php echo $promo_bg?>; --banner-z-index:999" class="sales-offer-banner-mobile header-offer-banner expired-banner <?php echo current_user_can('administrator')?'is-wp-admin':''?>">
            <div class="ast-container ast-flex ast-justify-content-center ast-align-items-center">
                <div class="ast-col-md-9 banner-content-container">
                    <?php
                        if(!empty($content_icon_promo)):
                    ?>
                        <img src="<?php echo $content_icon; ?>" alt="">
                    <?php
                        endif;
                    ?>
                    <div 
                        style="--text-color:<?php echo $promo_text_color ?>; --font-size:<?php echo $promo_text_size ?>px"
                        class="mobile-offer-banner-text"
                    >
                        <?php echo geo_replace_currency_default($promo_content); ?>
                    </div>
                </div>
                <div class="ast-col-md-3 cta-container">
                    <?php if($promo_btn_text && $promo_btn_link): ?>
                        <a style="--bg-color:<?php echo $promo_btn_bg?>; --text-color:<?php echo $promo_btn_text_color?>; --font-size:<?php echo $promo_btn_text_size?>px" href="<?php echo $promo_btn_link?>" class="cta-btn-white"><?php echo $promo_btn_text?></a>
                    <?php endif; ?>
                </div>
                <a href="<?php echo $promo_btn_link?>" class="banner-offer-overlay-link"></a>
            </div>
        </div>
    <?php
    endif;

    
?>

