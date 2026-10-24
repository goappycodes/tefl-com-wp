<?php

// $post_id = get_the_ID();

// $last_visit_date = get_post_meta($post_id, '_last_visit_date', true);

// if ($last_visit_date) {
   
//     $current_time = current_time('timestamp', 1);
//     $time_elapsed = $current_time - $last_visit_date;

  
//     $days = floor($time_elapsed / (60 * 60 * 24));
//     $hours = floor(($time_elapsed % (60 * 60 * 24)) / (60 * 60));
//     $minutes = floor(($time_elapsed % (60 * 60)) / 60);

//     $time_elapsed_str = '';

//     if ($days > 0) {
//         $time_elapsed_str .= $days . ' day' . ($days > 1 ? 's' : '') . ' ';
//     }
//     if ($hours > 0) {
//         $time_elapsed_str .= $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ';
//     }
//     if ($minutes > 0) {
//         $time_elapsed_str .= $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ';
//     }

//     echo 'Last visited ' . trim($time_elapsed_str) . 'ago';
// }

$single_course_page_styling = get_field('single_course_page_styling','option');

if(isset($single_course_page_styling) && !is_array_empty($single_course_page_styling)){
    $course_title_underline_color = !empty($single_course_page_styling['course_title_underline_color'])?$single_course_page_styling['course_title_underline_color']:'#1c1c1b';
    $interactive_course_label_border_color = !empty($single_course_page_styling['interactive_course_label_border_color'])?$single_course_page_styling['interactive_course_label_border_color']:'#1c1c1b';
    $savings_label_color = !empty($single_course_page_styling['savings_label_color']) ? $single_course_page_styling['savings_label_color'] : '#1c1c1b';
    $pay_in_deposit_switcher_button_styling = $single_course_page_styling['pay_in_deposit_switcher_button_styling'];
    $active_bg_color = !empty($pay_in_deposit_switcher_button_styling['active_bg_color']) ? $pay_in_deposit_switcher_button_styling['active_bg_color'] : '#1c1c1b';
    $active_text_color = !empty($pay_in_deposit_switcher_button_styling['active_text_color']) ? $pay_in_deposit_switcher_button_styling['active_text_color'] : '#fff';
    $inactive_bg_color = !empty($pay_in_deposit_switcher_button_styling['inactive_bg_color']) ? $pay_in_deposit_switcher_button_styling['inactive_bg_color'] : '#cccccc';
    $inactive_text_color = !empty($pay_in_deposit_switcher_button_styling['inactive_text_color']) ? $pay_in_deposit_switcher_button_styling['inactive_text_color'] : '#fff';
    $view_all_reviews_button_styling = $single_course_page_styling['view_all_reviews_button_styling'];
}

?>



<div id="primary" <?php astra_primary_class(); ?>>

    <!--Banner Section-->

    <?php
    $course_product_id = get_field('course_product');
    $course_product = wc_get_product($course_product_id);
    $course_price = $course_product->get_price_html();
    $course_price_value = $course_product->get_price();
    $full_price = $course_price_value;
	$trial = get_field('trial');
  	$guide = get_field('guide');
  
    if($course_product){
        $simple_regular_price = $course_product->get_regular_price();
        $simple_sale_price = $course_product->get_sale_price();
        if (is_numeric($simple_regular_price) && is_numeric($simple_sale_price) && $simple_regular_price != 0) {
            $save_percentage = round((($simple_regular_price - $simple_sale_price) / $simple_regular_price) * 100);
        }
    }

    $add_to_cart_url = site_url() . '/?add-to-cart=' . $course_product_id;

    $course_button_color = get_field('course_button_color', 'options');

    $hero_banner = get_field('hero_banner');
    $freebies = get_field('freebies');

    $banner_img =  $hero_banner['banner_image'];
    $banner_CTA =  $hero_banner['banner_cta'];


    $CTA_btns = $banner_CTA['banner_cta_buttons'];
    $btn1 = $CTA_btns['button1'];
    $btn2 = $CTA_btns['button2'];
    $btn1_txt = $btn1['button1_text'];
    $btn2_txt = $btn2['button2_text'];
    $btn1_link = $btn1['button1_link'];
    $btn2_link = $btn2['button2_link'];
    $CTA_title = $banner_CTA['banner_cta_title'];
    $CTA_txt =  $banner_CTA['banner_cta_text'];

    $flexible_product = get_field('flexible_product');

    $deposit_enabled = get_post_meta($course_product_id, '_wc_deposit_enabled', true);
    $deposit_payment_plan = '';

    if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional') {
        $deposit_payment_plan = get_post_meta($course_product_id, '_wc_deposit_payment_plans', true);
        $deposit_payment_plan = $deposit_payment_plan[0];
    }

    $deposit_class = $deposit_class ?? '';
    $deposit_percent = $deposit_percent ?? 0;

    if ($deposit_payment_plan) :
        $deposit_class = "deposit-full-price payment-plan-".$deposit_payment_plan;
        $query = "SELECT amount FROM `wp_wc_deposits_payment_plans_schedule` WHERE `schedule_index` = 0 AND `plan_id` = ".$deposit_payment_plan;
        $deposit_percent = $wpdb->get_var($query);
        $deposit_percent = round((float)$deposit_percent / 100, 5);
    endif;

    if (ENABLE_99 && $deposit_payment_plan == 6 ){
        $fixed_99 = true;        
    } else {
        $fixed_99 = false;
    }

    if (ENABLE_99 && $deposit_payment_plan == 7 ){
        $fixed_3995 = true;        
    } else {
        $fixed_3995 = false;
    }

    ?>
    <?php
    if ($course_product_id) {
    ?>
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "hasCourseInstance": {
        "@type": "CourseInstance",
        "courseMode": "Online",
        "courseWorkload": "PT150H",
        "startDate": "2025-05-01",
        "endDate": "2025-10-28"
    },
    "CourseInstance": "",
    "courseMode": [
        "online"
    ],
    "@type": "Course",
    "name": "<?php echo get_the_title(); ?>",
    "description": <?php echo json_encode($CTA_txt); ?>,
    "url": "<?php echo get_the_permalink(); ?>",
    "timeRequired": "PT<?php echo get_field('time_required') ? get_field('time_required') : 30; ?>H",
    "offers": {
        "category": "TEFL",
        "@type": "Offer",
        "price": "<?php echo $course_price_value; ?>",
        "priceCurrency": "<?php echo get_woocommerce_currency(); ?>",
        "validFrom": "<?php echo date('y-m-d');?>"
    },
    "typicalAgeRange": "16+",
    "inLanguage": "en-US",
    "provider": {
        "@type": "Organization",
        "name": "TEFL Institute",
        "sameAs": "https://teflinstitute.com"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": 4.91,
        "reviewCount": 540
    }
}
</script>
        <div class="product-schema-output-custom" style="display:none">
            <?php
            $course_product_post = get_post($course_product_id);
            setup_postdata($course_product_post);
            // do_action('woocommerce_single_product_summary');
            wp_reset_postdata();
            ?>
        </div>
    <?php
    }
    ?>
    <!-- Top bar section -->
    <section class="full-width top-bar-section">
        <div class="ast-container">
            <div class="ast-row">
                <?php 
                $black_bar_content = get_field('black_bar_content', 'options');
                if ($black_bar_content) :
                    $black_bar_content = $black_bar_content['content']; 
                ?>
                    <div class="top-bar-container">
                        <?php foreach ($black_bar_content as $bbc) :
                            $bbc_text = $bbc['text']; ?>
                            <?php if ($bbc_text) : ?>
                                <div class="bar">
                                    <img class="bar__image" src="/wp-content/uploads/2022/11/checkmark.png">
                                    <div class="bar__content">
                                        <?php echo $bbc_text; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- Top bar section End-->

    <!-- Hero banner section -->
    <section class="hero-banner-section" style="background-image:url('<?php echo $banner_img ?>')">
        <?php
        $CTA_stitle =  $banner_CTA['banner_cta_subtitle'];
        ?>
        <div class="ast-container">
            <div class="ast-row ast-flex">
                <div class="ast-col-md-6">
                    <div class="hero-banner__content">
                        <div class="hero-banner__heading">
                            <?php
                                $current_post_id = get_the_ID(); 
                                $level_5_tefl_courses_IDs = array(743, 2704, 838, 825); 
                                if (in_array($current_post_id, $level_5_tefl_courses_IDs)):
                            ?>
                                <div class="is-interactive"
                                     style="--border-color:<?php echo $interactive_course_label_border_color?>"
                                >
                                    <div class="wrapper-class">
                                        <img src="/wp-content/uploads/2023/07/interactive_icon.svg" alt="" class="interactive-icon">
                                        <span class="interactive-text">Interactive course</span>
                                    </div>
                                </div>
                            <?php
                                endif;
                            ?>
                            <span class="page-title__sub">
                                <?php echo $CTA_stitle?>
                            </span>
                            <h1 class="page-title__main large-heading <?php echo (($current_post_id === 812) || ($current_post_id === 62237)) ? 'flex-title' : ''; ?>"
                                style="--underline-color:<?php echo $course_title_underline_color?>"
                            >
                                <?php if($current_post_id === 812): ?>
                                    <img src="/wp-content/uploads/2025/04/IELTS-Educator-logo.png" alt="">
                                <?php endif; ?>

                                <span><?php echo $CTA_title; ?></span>

                                <?php if($current_post_id === 62237): ?>
                                    <img src="/wp-content/uploads/2025/04/IELTS-Educator-logo.png" alt="">
                                <?php endif; ?>
                            </h1>
                        </div>
                        <div class="tution-fee">
                            <?php
                                $current_cc = get_user_geo_country_code();
                                $klarna_enabled_courses = array(47,745,70837,62237,71925,70830);
                                $klarna_enabled_cc = array('AT', 'BE', 'CZ', 'DK', 'FI', 'FR', 'DE', 'GR', 'IE', 'IT', 'NL', 'NO', 'PL', 'PT', 'SE', 'CH', 'GB');
                                $show_klarna = (in_array($current_cc, $klarna_enabled_cc) && in_array($current_post_id, $klarna_enabled_courses)) ? 1 : 0;

                            ?>
                            <div id="priceWrapper" class="tution-fee-txt <?php echo $show_klarna === 1?'has-klarna':'no-klarna'?>">
                                <span data-isfixed3995="<?php echo $fixed_3995?>" data-isfixed99 = "<?php echo $fixed_99; ?>" data-depositpercent = "<?php echo $deposit_percent?>" class="full-price <?php echo $deposit_class; ?>">
                                    <?php echo $course_price; ?>
                                    <?php if($save_percentage && $save_percentage>0):?>
                                    <div class="savings"
                                         style="--text-color:<?php echo $savings_label_color?>"
                                    >
                                        <?php echo 'Save '.$save_percentage.'%'?>
                                    </div>
                                    <?php endif?>
                                </span>
                                <?php 
                                    if($show_klarna){
                                        include('includes/klarna_label.php'); 
                                        include('includes/klarna_modal.php');
                                    }
                                ?>
                            </div>
                            <?php 
                                $course_extra_info = get_field('course_extra_info');
                                if(!empty($course_extra_info)):?>
                                <div class="course-extra-info">
                                    <?php echo $course_extra_info?>
                                </div>
                            <?php endif?>
                            <div class="deposit-breakdown">
                                <?php if ($deposit_payment_plan) : ?>
                                    <?php include('includes/ti-deposit-form.php'); ?>
                                    <?php wp_enqueue_script('ti-deposit-form-js'); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="hero-banner__summary">
                        <?php echo $CTA_txt ?>
                        </div>
                        <div class="banner-cta-buttons">
                            <?php
                                    if ($current_post_id === 9689 || $current_post_id === 743 || $current_post_id === 2704 ) {
                                    $default_course_ids = [62238, 70828]; 
                                    
                                    $select_two_product_ids = [62238, 70828, 71500, 70829];
                                    $select_two_products = [];

                                    foreach ($select_two_product_ids as $product_id) {
                                        $product = wc_get_product($product_id);
                                        if ($product) {
                                            $raw_name = $product->get_name();
                                            $cutoff = mb_strpos($raw_name, '– Regulatory ref');
                                            $clean_name = $cutoff !== false ? trim(mb_substr($raw_name, 0, $cutoff)) : $raw_name;

                                            $select_two_products[] = [
                                                'product' => $product_id,
                                                'product_name' => $clean_name
                                            ];
                                        }
                                    }

                                    if (!empty($select_two_products)) :
                                        ?>
                                        <input type="hidden" name="selected_courses" id="selected_courses_field" value="<?php echo implode(',', $default_course_ids); ?>">
                                        
                                        <div class="select-menu select-two-required" data-defaults="<?php echo implode(',', $default_course_ids); ?>">
                                            <span>Select Two Courses</span>
                                            <div class="select-btn">
                                                <span class="sBtn-text">Choose your 60 Hour Courses</span>
                                                <img class="no-lazy" src="/wp-content/uploads/2024/09/Vector-107.svg" alt="">
                                            </div>
                                            <ul class="options">
                                                <?php foreach ($select_two_products as $product): ?>
                                                    <li class="option" 
                                                        data-pid="<?php echo $product['product']; ?>" 
                                                        data-name="<?php echo htmlspecialchars($product['product_name']); ?>">
                                                        
                                                        <span class="option-text" style="display: flex; gap: 8px;">
                                                            <span class="custom-checkbox" aria-hidden="true"></span>
                                                            <b><?php echo $product['product_name']; ?></b>
                                                        </span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <?php
                                    endif;

                                    } else {
                                        ?>
                                        <a class="callback-btn banner-btn" href="/callback"><?php echo  $btn1_txt ?></a>
                                        <?php
                                    }
                                ?>
                            <?php if ($is_virtual_couse) : ?>
                                <a class="ti-enroll-btn banner-btn text-center" href="#timetable"><?php echo  $btn2_txt ?></a>
                            <?php else : ?>
                                <a class="ti-enroll-btn enroll-now-btn banner-btn" rel="nofollow" href="<?php echo get_home_url(); ?>/?addtimetocart&prid=<?php echo $course_product_id; ?>"><?php echo  $btn2_txt ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="d-none" style="margin-top:2rem;">
                            <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
                            <div class="trustpilot-widget" data-locale="en-GB" data-template-id="5418052cfbfb950d88702476" data-businessunit-id="61c0c19118c53fc28bcc355d" data-style-height="30px" data-style-width="100%" data-tags="<?php echo get_field('trustpilot_tag') ?: 'content'; ?>" data-stars="1,2,3,4,5" data-review-languages="en">
                                <a href="https://uk.trustpilot.com/review/teflinstitute.com" target="_blank" rel="noopener">Trustpilot</a>
                            </div>
                        </div>

                        <?php
                        $trustpilot_tag = '';
                        $course_title = get_the_title();

                        if (strpos($course_title, '120') !== false) {
                            $trustpilot_tag = '120';

                        } elseif (strpos($course_title, '180') !== false) {
                            $trustpilot_tag = '180';

                        } elseif (strpos($course_title, '240') !== false) {
                            $trustpilot_tag = '240';

                        } elseif (
                            strpos($course_title, '300') !== false ||
                            strpos($course_title, '310') !== false
                        ) {
                            $trustpilot_tag = 'L5';
                        }
                        ?>

                        <?php if ($trustpilot_tag) : ?>
                        <div style="margin-top:2rem;">

                            <!-- TrustBox script -->
                            <script type="text/javascript"
                                src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js"
                                async>
                            </script>
                            <!-- End TrustBox script -->

                            <!-- TrustBox widget - Drop-Down -->
                            <div class="trustpilot-widget"
                                data-locale="en-US"
                                data-template-id="5418052cfbfb950d88702476"
                                data-businessunit-id="61c0c19118c53fc28bcc355d"
                                data-style-height="50px"
                                data-style-width="100%"
                                data-token="ff8bfbc9-6191-40f5-9ffb-021d1cc6f484"
                                data-tags="<?php echo esc_attr($trustpilot_tag); ?>"
                                data-stars="4,5"
                                data-review-languages="en">

                                <a href="https://www.trustpilot.com/review/teflinstitute.com"
                                target="_blank"
                                rel="noopener">
                                    Trustpilot
                                </a>

                            </div>
                            <!-- End TrustBox widget -->

                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div  class="ast-col-md-6 hero-banner__logo-container">
                <?php
                $banner_has_logo = $hero_banner['banner_has_logo'];
                $common_hero_banner_logo = get_field('common_hero_banner_logo', 'option');
                $show_alternate_logo = $common_hero_banner_logo['show_alternate_logo'];
                
                if ($banner_has_logo && !empty($hero_banner['banner_logo'])):
                    $banner_logo = $hero_banner['banner_logo'];
                    $banner_logo_link = $hero_banner['banner_logo_link'];
                    if (empty($banner_logo_link)):
                ?>
                        <img src="<?php echo $banner_logo ?>" class="banner-slide__content-logo" alt="">
                <?php
                    else:
                ?>
                        <a href="<?php echo $banner_logo_link ?>">
                            <img src="<?php echo $banner_logo ?>" class="banner-slide__content-logo" alt="">
                        </a>
                <?php
                    endif;
                else:
                    $common_banner_logo = $common_hero_banner_logo['common_banner_logo'];
                    $selected_courses = $common_hero_banner_logo['selected_courses'] ? $common_hero_banner_logo['selected_courses'] : [];
                    if($show_alternate_logo){
                        $alternate_common_banner_logo = $common_hero_banner_logo['alternate_common_banner_logo'];
                        $alternate_selected_courses = $common_hero_banner_logo['alternate_selected_courses']?$common_hero_banner_logo['alternate_selected_courses']:[];
                        foreach ($alternate_selected_courses as $course) {
                            $key = array_search($course, $selected_courses);
                            if ($key !== false) {
                                unset($selected_courses[$key]);
                            }
                        }
                    }
                    if (in_array($course_id, $selected_courses) && !empty($common_banner_logo)):
                ?>
                        <img src="<?php echo $common_banner_logo ?>" alt="" class="common-logo banner-slide__content-logo">
                <?php
                    endif;
                    if ($show_alternate_logo && in_array($course_id, $alternate_selected_courses) && !empty($alternate_common_banner_logo)):
                ?>
                        <img src="<?php echo $alternate_common_banner_logo ?>" alt="" class="alternate-common-logo common-logo banner-slide__content-logo">
                <?php
                    endif;
                endif;
                ?>

                </div>
            </div>
        </div>
    </section>

    <!-- Hero banner section End-->

    <!-- Offer Banner -->

    <?php //include('template-parts/offer-banner.php'); ?>

    <!-- Offer Banner End -->


    <!-- Gifts Section -->
    
    <?php
    $course_gifts_section = get_field('course_gifts_section','option');
    $show_gifts_section = $course_gifts_section['show_gifts_section'];
    $section_title        = $course_gifts_section['section_title'];
    $gifts                = $course_gifts_section['gifts'];
    $selected_courses     = $course_gifts_section['selected_courses'];
    $selected_courses     = !empty($selected_courses) ? $selected_courses : [];
    $courses_gift_expires = get_field('timer_expiry', 'option');
    $current_time         = current_time('timestamp');
    $expiration_time      = strtotime($courses_gift_expires);
    // && ($current_time < $expiration_time)
    // if ($show_gifts_section && (in_array($course_id, $selected_courses))) :
    if(false):
    ?>
    
    <section class="section-padding-top gifts-section">
        <div class="ast-container">
            <div class="ast-row">
                <div class="course-gifts-wrapper">
                    <div class="ast-col-md-12">
                        <div class="course-gifts">
                            <h3 class="gifts-title"><?php echo geo_replace_currency($section_title); ?></h3>
                            <div class="gift-images">
                                <?php foreach ($gifts as $g) : ?>
                                    
                                    <div class="gift">
                                        <img class="no-lazy" src="<?php echo esc_url($g['gift_image']); ?>" alt="Gift Image">
                                        <span><?php echo $g['gift_title']?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>       

    <?php
    endif;
    ?>

    <?php
    $free_bundle_section  = get_field('free_bundle_section', 'option');
    
    $selected_courses   = !empty($free_bundle_section['selected_courses']) ? $free_bundle_section['selected_courses'] : [];

    $section_label   = !empty($free_bundle_section['section_label'])   ? $free_bundle_section['section_label']   : '';
    $section_title   = !empty($free_bundle_section['section_title'])   ? $free_bundle_section['section_title']   : '';
    $section_summary = !empty($free_bundle_section['section_summary']) ? $free_bundle_section['section_summary'] : '';
    $section_image   = !empty($free_bundle_section['section_image'])   ? $free_bundle_section['section_image']   : '';

    $section_image_caption = !empty($free_bundle_section['image_caption']) ? $free_bundle_section['image_caption'] : 'Add 4 high value TEFL skills to your CV:';

    if ($show_gifts_section && in_array($course_id, $selected_courses)) :
    ?>

    <section class="section-padding-top free-bundle-section">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <div class="free-bundle-card">

                        <div class="free-bundle-content">
                            <?php if ($section_label) : ?>
                                <div class="free-bundle-label-row">
                                    <span class="free-bundle-label">
                                        <?php echo esc_html($section_label); ?>
                                        <svg class="outline-svg" preserveAspectRatio="none">
                                            <rect x="0" y="0" width="100%" height="100%" rx="6" ry="6" pathLength="100"/>
                                        </svg>
                                    </span>
                                    <span class="free-bundle-flame" aria-hidden="true">
                                        <img class="no-lazy" src="/wp-content/uploads/2026/04/source.gif" alt="">
                                    </span>
                                </div>
                            <?php endif; ?>

                            <?php if ($section_title) : ?>
                                <h3 class="free-bundle-title"><?php echo esc_html(geo_replace_currency($section_title)); ?></h3>
                            <?php endif; ?>

                            <?php if ($section_summary) : ?>
                                <p class="free-bundle-summary">
                                    <?php echo wp_kses_post(geo_replace_currency_default(nl2br($section_summary))); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <?php if ($section_image) : ?>
                            <div class="free-bundle-visual">
                                <span class="bundle-caption"><?php echo esc_html($section_image_caption); ?></span>
                                <img class="no-lazy"
                                    src="<?php echo esc_url($section_image); ?>"
                                    alt="<?php echo esc_attr($section_title); ?>">
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?>
    
    <!-- Gifts Section End -->

    <!-- Course Details Section -->

    <section class="course-details-section section-padding-top">
        <div class="ast-container">
            <?php
                $new_course_details_tabs = get_field('new_course_details_tabs');
            ?>
            <?php?>
            <div id="tabs-section" class="tabs ast-row">
                <div class="ast-col-md-6 tab-wrapper">
                    <ul class="tab-head">
                        <?php 
                        foreach($new_course_details_tabs as $key => $new_course_details_tab):
                            $tab_title = $new_course_details_tab['tab_title'];
                        ?>
                        
                        <li>
                            <a href="#tab-<?php echo $key+1?>" class="tab-link <?php echo $key === 0?'active':''?>"><span class="tab-label"><?php echo $tab_title ?></span><i class="fa fa-arrow-right"></i></a>
                        </li>
                        <?php endforeach?>
                        
                    </ul>
                </div>
                <div class="ast-col-md-6">
                    <div class="course-details-tab-content">
                        <?php 
                        foreach($new_course_details_tabs as $key => $new_course_details_tab):
                            $tab_title = $new_course_details_tab['tab_title'];
                            $tab_content_title = $new_course_details_tab['tab_content_title'];
                            $extra_tab_content = $new_course_details_tab['extra_tab_content'];
                            $tab_content       = $new_course_details_tab['tab_content'];
                            $tab_faq_content   = $new_course_details_tab['tab_faq_content'];
                            $tab_accordian_content = $new_course_details_tab['tab_accordian_content'];
                        ?>
                            <section data-extra-content="<?php echo $extra_tab_content?>" id="tab-<?php echo $key+1?>" class="tab-body <?php echo $key === 0?'active active-content':''?>">
                                <h2 class="tab-body__title large-heading"><?php echo $tab_content_title?$tab_content_title:$tab_title?></h2>
                                    <?php if(!empty($tab_faq_content) && $extra_tab_content === 'faq-content'):
                                        
                                        $faq_questions = get_cfvalue_by_country('frequently_asked_questions');
                                        if(is_array_empty($faq_questions)){
                                            $faq_questions = $tab_faq_content['faq_questions']; 
                                        }
                                    ?>
                                        <div class="tab-body__content--faq">
                                            <script type="application/ld+json">
                                                {
                                                    "@context": "https://schema.org",
                                                    "@type": "FAQPage",
                                                    "mainEntity": [
                                                        <?php
                                                        $faqcount = count($faq_questions);
                                                        $counter = 0;
                                                        foreach($faq_questions as $faq) {
                                                            $counter++;
                                                        ?> {
                                                                "@type": "Question",
                                                                "name": <?php echo json_encode($faq['question']); ?>,
                                                                "acceptedAnswer": {
                                                                    "@type": "Answer",
                                                                    "text": <?php echo json_encode($faq['answer']); ?>
                                                                }
                                                            }
                                                        <?php
                                                            if ($faqcount != $counter) echo ",";
                                                        }
                                                        ?>
                                                    ]
                                                }
                                            </script>
                                            <?php foreach($faq_questions as $faq):
                                                $question = $faq['question'];
                                                $answer   = $faq['answer'];    
                                            ?>
                                            <div class="tab-faq">
                                                <h3 class="tab-faq__question">
                                                    <?php echo $question?>
                                                </h3>
                                                <div class="tab-faq__answer">
                                                    <?php echo $answer?>
                                                </div>
                                            </div>
                                            <?php endforeach?>
                                        </div>
                                    <?php endif?>
                                    <div class="tab-body__content--main">
                                        <?php echo $tab_content?>
                                    </div>
                                    <?php if($extra_tab_content != 'faq-content'):?>
                                        <div class="tab-body__content--extra">
                                            <?php if($extra_tab_content === 'accordion-content'):?>
                                                <ul class="tab-body__content--accordion">
                                                    <?php 
                                                    $accordion = $tab_accordian_content['accordion'];
                                                    foreach($accordion as $key => $acc):
                                                        $accordion_title = $acc['accordion_title'];
                                                        $accordion_stitle = $acc['accordion_subtitle'];
                                                        $accordion_content = $acc['accordion_content'];
                                                        if(!empty($accordion_content)):
                                                    ?>
                                                        <li>
                                                            <input type="checkbox" name="faq-trigger-<?php echo $key?>" <?php echo $key===0?'checked':''?>>
                                                            <i></i>
                                                            <h2>
                                                                <span class="faq-drawer__title--sub"><?php echo $accordion_stitle?></span>
                                                                <span class="faq-drawer__title--main"><?php echo $accordion_title?></span>
                                                            </h2>
                                                            <div class="faq-drawer__content-wrapper">
                                                                <div class="faq-drawer__content">
                                                                    <?php echo $accordion_content?>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php
                                                        else:
                                                    ?>
                                                        <h5 class="accordion-header">
                                                            <?php echo $accordion_title?>
                                                        </h5>
                                                    <?php
                                                        endif;
                                                    endforeach
                                                    ?>
                                                </ul>
                                            <?php endif?>
                                        </div>
                                    <?php endif?>
                            </section>
                        <?php endforeach?>
                        <div class="read-more-btn-container">
                            <div>
                                <span>read more</span>
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

    <!-- Course Details Section End-->



    <?php

    if ($is_virtual_couse) :
        if (get_field('summary_of_course')) {
            echo '<div class="course-summary-virtual">' . get_field('summary_of_course') . "</div>";
        }

        if (get_post_type(get_the_ID()) == 'course') {
            include('includes/virtual-course-variation.php');
        } else if (get_post_type(get_the_ID()) == 'course_location') {
            include('includes/virtual-course-location-variation.php');
        }
    endif;
    ?>

    <?php if (in_array(19, $course_category) || ($course_id == 825) || ($course_id == 2704)) : ?>
        <?php $level_5_tefl_courses_videos = get_field('level_5_tefl_courses_videos', 'options');
        if ($level_5_tefl_courses_videos) : 
            $section_heading = $level_5_tefl_courses_videos['section_heading'];
            $video_links = $level_5_tefl_courses_videos['videos'];
        ?>
            <section class="level5-video-section">
                <div class="ast-container level5-video-container">
                    <div class="ast-row">
                        <div class="ast-col-md-12">
                            <h2 class="large-heading text-center common-heading"><?php echo $section_heading?></h2>
                        </div>
                    </div>
                    <div class="ast-row level5-video-row">
                        <?php foreach ($video_links as $video) :
                            $video_link = $video['video_link'];
                            $youtubeID = getYouTubeVideoId($video_link);
                            $thumbURL = 'https://img.youtube.com/vi/' . $youtubeID . '/hqdefault.jpg'; ?>
                            <div class="ast-col-md-6 level5-video-col">
                                <div class="video-container">
                                    <a href="<?php echo $video_link ?>" data-lity>
                                        <div class="video-img">
                                            <img src="<?php echo $thumbURL; ?>">
                                        </div>
                                        <div class="video-play-btn">
                                            <img class="video__play" src="/wp-content/uploads/2020/11/play-btn.svg" alt="">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>

    <?php
        // $fast_track_info_block = get_field('fast_track_info_block','option');
        // $fast_track_info_block_content = $fast_track_info_block['info_block']?:[];
        // $where_to_show = $fast_track_info_block['where_to_show']?$fast_track_info_block['where_to_show']:[];
        // if(!is_array_empty($fast_track_info_block) && in_array($current_post_id,$where_to_show)):
            if(false):
            
    ?>

        <section class="fast-track-info-section- mt-2">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <div class="fast-track-info-section-content-wrapper mt-5">
                            <div class="image-wrapper">
                                <a href="https://jobs.teflinstitute.com/all-jobs/" target="_blank">
                                    <img class="iec-logo" src="/wp-content/uploads/2025/02/institute-of-higher-education-icon.png" alt="">
                                </a>
                            </div>
                            <div class="fast-track-info-section-content">
                                <?php echo $fast_track_info_block_content?>
                            </div>
                            <div class="image-wrapper">
                                <a target="_blank" href="https://jobs.teflinstitute.com/all-jobs/" >
                                    <img class="tif-logo" src="/wp-content/uploads/2025/01/founded-icon.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        

    <?php 
        endif;
    ?>
    
    <!-- Course Features -->
    <?php if(have_rows('course_features')):?>
        <section class="course-features-section section-padding">
            <div class="ast-container">
                <?php
                    $course_features = get_field('course_features');
                    $features = $course_features['features'];
                    $elt_cta_box = get_field('elt_cta_box','option');

                    $elt_cta_title = $elt_cta_box['cta_title'];
                    $elt_cta_text = $elt_cta_box['cta_text'];
                    $elt_cta_btn_text = $elt_cta_box['cta_button_text'];
                    $elt_cta_btn_link = $elt_cta_box['cta_button_url'];

                    $salary_calculator_cta = get_field('salary_calculator_cta','option');

                    $salary_calculator_cta_title = $salary_calculator_cta['cta_title'];
                    $salary_calculator_cta_text = $salary_calculator_cta['cta_text'];
                    $salary_calculator_cta_btn_text = $salary_calculator_cta['cta_button_text'];
                    $salary_calculator_cta_btn_link = $salary_calculator_cta['cta_button_url'];

                    $higlighted_features = get_field('highlighted_features','option');
                ?>
                <div class="ast-row ast-flex feature-row">
                    <?php if(!empty($elt_cta_box)):?>
                        <div class="ast-col-md-6">
                            <div class="elt-cta-col">
                                <h3 class="elt-cta__title">
                                    <?php echo $elt_cta_title?>
                                </h3>
                                <div class="elt-cta__text text-center">
                                    <?php echo $elt_cta_text?>
                                </div>
                                <a href="<?php echo $elt_cta_btn_link?>" class="btn btn-black elt-cta__btn">
                                    <?php echo $elt_cta_btn_text?>
                                </a>
                            </div>
                        </div>
                    <?php endif?>
                    <?php if(!empty($salary_calculator_cta)):?>
                        <div class="ast-col-md-6">
                            <div class="elt-cta-col salary-cta-col">
                                <h3 class="elt-cta__title">
                                    <?php echo $salary_calculator_cta_title?>
                                </h3>
                                <div class="elt-cta__text text-center">
                                    <?php echo $salary_calculator_cta_text?>
                                </div>
                                <a href="<?php echo $salary_calculator_cta_btn_link?>" class="btn btn-black elt-cta__btn">
                                    <?php echo $salary_calculator_cta_btn_text?>
                                </a>
                            </div>
                        </div>
                    <?php endif?>
                    <?php foreach($features as $key=>$feature):
                        $feature_heading = $feature['feature_heading'];
                        $feature_content = $feature['feature_content'];    
                    ?>
                    <div class="ast-col-md-6">
                        <div class="feature-col">
                            <h3 class="feature__heading">
                                <?php echo $feature_heading?>
                            </h3>
                            <div class="feature__content">
                                <?php echo $feature_content?>
                            </div>
                            <?php if (strcasecmp(trim($feature_heading), 'Easy employer verification') === 0) : ?>
                                <div class="feature__verification-form">
                                    <h3 class="feature__heading">Academic Credentials Verification</h3>
                                    <?php echo do_shortcode('[custom_cert_identifier]'); ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div> 
                    <?php endforeach?>
                    <?php if(!empty($higlighted_features)):?>
                        <div class="ast-col-md-6">
                            <div class="feature-col feature-col--highlight">
                                <div class="feature-col-flex-wrapper">
                                    <div>
                                        <?php foreach($higlighted_features as $higlighted_feature):
                                            $higlighted_feature_text = $higlighted_feature['feature_text'];
                                        ?>
                                            <div class="highlight-feature">
                                                <i class="fa fa-check-circle"></i>
                                                <span>
                                                    <?php echo $higlighted_feature_text?>
                                                </span>
                                            </div>
                                        <?php endforeach?>
                                    </div>
                                    <?php
                                        $europass_courses = [743,838,825,2704,70837,62237,71925,70830];
                                        if(in_array($current_post_id,$europass_courses)):
                                    ?>
                                    <div class="europass-logo">
                                        <a href="https://europass.europa.eu/en/europass-digital-tools/european-qualifications-framework" target="_blank">
                                            <img src="/wp-content/uploads/2024/12/image_2024_12_06T13_41_38_015Z-e1733560354534.png" alt="">
                                        </a>
                                    </div>
                                    <?php
                                        endif;
                                    ?>
                                </div>
                              	<?php if($guide['value']) { ?>
                                  <a href="<?php echo $guide['link']; ?>" class="guide_link"><?php echo $guide['value']; ?></a>
                              <?php } ?>
                            </div>
                          	
                        </div>
                    <?php endif?>
                    <div class="ast-col-md-6">
                        <div class="prospectus-cta-box prospectus-cta">
                            <img src="/wp-content/uploads/2025/05/prospectus-cover-2.png" alt="">
                            <h4 class="prospectus-cta-box__title">TEFL STUDY PROSPECTUS</h4>
                            <div class="prospectus-cta-box__summary">
                                Explore global teaching opportunities with our TEFL study prospectus
                            </div>
                            <a href="/wp-content/uploads/2023/06/TEFL-Institute-Prospectus-2.pdf" class="btn" target = "_blank">
                                <span>Download</span>
                                <img src="/wp-content/uploads/2025/03/download-icon.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif?>
    <!-- Course Features End -->

    <?php 
        // if(in_array($current_post_id,$europass_courses)):
        if(false):
    ?>

        <section class="section-padding-bottom europass-iec-section">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <div class="fast-track-info-section-content-wrapper">
                            <div class="image-wrapper">
                                <a href="https://jobs.teflinstitute.com/all-jobs/" target="_blank">
                                    <img class="iec-logo" src="/wp-content/uploads/2025/02/institute-of-higher-education-icon.png" alt="">
                                </a>
                            </div>
                            <div class="fast-track-info-section-content">
                                <h2 class="large-heading common-section-heading text-center">
                                    Who can take the TEFL course?                               
                                </h2>
                                <div class="text-center">
                                    Ideal for anybody between the ages of 17-70<br>
                                    Non-native speakers and native speakers<br>
                                    Degree and non-degree holders 
                                </div>
                            </div>
                            <div class="image-wrapper">
                                <a target="_blank" href="https://jobs.teflinstitute.com/all-jobs/" >
                                    <img class="tif-logo" src="/wp-content/uploads/2025/01/founded-icon.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ast-container d-none">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <div class=" mt-5">
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

    

    <?php endif;?>


    <!-- Search Courses Section -->

    <section class="search-courses-section section-padding-bottom">
        <div class="ast-container">
            <div class="ast-row">
                <h2 class="search-courses-section__heading text-center common-heading">
                    Find The Perfect TEFL Course
                </h2>
                <div class="search-courses-section__body ast-col-md-12">
                <?php echo do_shortcode('[tefl_course_search]'); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Courses Section End -->
  
    <!-- Student Reviews Function -->
    <?php
    $student_reviews_section = get_field('student_reviews_section');
    if(!empty($student_reviews_section)):
    ?>
    <section class="students-review">
        <?php
            $section_heading = $student_reviews_section['section_heading'];
            $section_image = $student_reviews_section['section_image'];
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
        <div class="ast-container">
            <div class="ast-row ast-flex students-review-row">
                <div class="ast-col-md-6 students-review__image" style="background-image:url('<?php echo $section_image; ?>')">

                </div>
                <div class="ast-col-md-6">
                    <div class="students-review__content">
                        <h2 class="students-review__content-heading">
                            <?php echo $section_heading?>
                        </h2>
                        <div class="rating-div-wrapper">
                            <div>
                                <div class="rating-div">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-empty"></i>
                                    <span class="course-review-count">(<?php echo $reviews_average; ?>)</span>
                                </div>
                                <div class="total-count-text">Out of <?php echo $total_reviews_count ?> global reviews</div>
                            </div>
                            <?php
                                $button_text_color = !empty($view_all_reviews_button_styling['button_text_color']) ? $view_all_reviews_button_styling['button_text_color'] : '#ffffff';
                                $button_bg_color = !empty($view_all_reviews_button_styling['button_bg_color']) ? $view_all_reviews_button_styling['button_bg_color'] : '#1c1c1b';
                            ?>
                            <a href="https://www.google.com/search?sca_esv=8d785069c21da656&sca_upv=1&hl=en-IE&gl=ie&q=The+TEFL+Institute+Ireland+%7C+TEFL+Courses+%26+Certification,+13+Adelaide+Rd,+Saint+Kevin%27s,+Dublin,+D02+P950&uds=ADvngMhDJElofzFqOx8yLCqxrZBfORdohN-zZWd2DtE2wkfY_Hz8LxAbxWyTqbQXp_hpoUOW2uxhpWyrB1IL2IpdWcWiPs5S-vGBywcJzrO9PJe_HdF91Ppndo2Knjst1hsy0DuQ_1Yy71pyrotGeYeqK9tgwKhS1Dz3nAO5HG6XIft-vP8sUXZPMIt75-GkZH8kdUstEDG07k_uQg6GZSA3HkqfKbTCnzBS1_wxYJkYsxPWWzYHd35xJVCoLbwXmLTFBoT-lFXh&si=ACC90nwjPmqJHrCEt6ewASzksVFQDX8zco_7MgBaIawvaF4-7mSRR1kRGE4hCmZtLOUumbi46V_tOIxRTOEjel4eIAxPbsZAzQfZDyayafoOPMus5kIWjD0%3D&sa=X&ved=2ahUKEwixoZaa4Z6HAxUHYEEAHXfKDf8Q3PALegQIGxAE&biw=1536&bih=745&dpr=2" 
                               class="btn-centered btn reviews-btn"
                               style="--btn-text-color:<?php echo $button_text_color?>;--btn-bg-color:<?php echo $button_bg_color?>"
                            >
                                Read all reviews
                            </a>
                        </div>
                        <div class="reviews-summary">
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
                        </div>
                        <div class="students-review__content-slider">
                            <?php echo do_shortcode('[brb_collection id="76302"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        
    </section>
    <?php endif?>

    <!-- Student Reviews Function End -->

    <?php if($trial['toggle'] == true): 
    ?>
        <section class="trial-course-section section-padding-bottom">
            <div class="ast-container">
                <div class="ast-row ast-flex">
                    <div class="left ast-col-md-6">
                        <div class="trial-course-section__image" style="background-image: url('<?php echo $trial['image'] ?>');">

                        </div>
                    </div>
                    <div class="right ast-col-md-6">
                        <div class="trial-course-section__content">
                            <h2 class="title common-heading"><?php echo $trial['title'] ?></h2>
                            <div class="content"><?php echo $trial['content'] ?></div>
                            <a href="<?php echo $trial['cta']['link'] ?>" class="btn btn-black "><?php echo $trial['cta']['value'] ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>  
	<?php  
    endif;
    ?>

    <!-- Course Offer Section  -->
    <?php 
    if (have_rows('sale_courses') && get_the_ID() != 90318 && get_the_ID() != 93278):
    $sale_courses = get_field('sale_courses');
    ?>

    <section class="course-offer-section section-padding">
        <div class="ast-container">
            <?php 
                foreach($sale_courses as $key => $sale_course):
                $course_image = $sale_course['course_image'];
                $course_logo = $sale_course['course_logo'];
                $course_title = $sale_course['course_title'];
                $course = $sale_course['course'];
                $course_link = get_post_permalink($course);
                $course_product_id = get_field('course_product', $course);
                $course_price = '';
                $add_to_cart_link = '';
                if ($course_product_id) {
                    $course_product = wc_get_product($course_product_id);
                    if ($course_product) {
                        $course_price = $course_product->get_price_html();        
                    }
                    $add_to_cart_link = site_url() . '?addtimetocart&prid=' . $course_product_id;
                }
                $includes = $sale_course['includes'];
                $excludes = $sale_course['excludes'];
                $freebie_courses = $sale_course['freebie_courses'];
                $other_freebie = $sale_course['other_freebie'];
                $timer_expiry = '';
                $is_expired = true;
                $excluded_courses = get_field('excluded_courses', 'options');
                $excluded_courses = $excluded_courses ? $excluded_courses : [];

                if (!in_array($course_id, $excluded_courses)) {
                    $timer_expiry = get_field('timer_expiry', 'options');
                }
        
                $time_diff = 0;
                if ($timer_expiry) {
                    $course_offer_end_date = strtotime($timer_expiry);
                    $current_time = current_time('timestamp');
                    $time_diff = $course_offer_end_date - $current_time;
                }
                $is_expired = $time_diff < 0 ? true : false;
            ?>
            <div class="ast-row course-offer-section__header">
                <div class="ast-col-md-12">
                    <?php if($key===0):?>
                    <h2>Limited Time TEFL Offer</h2>
                    <?php endif?>
                    <h6 class="font-600"><?php echo $course_title?></h2>
                </div>
            </div>
            <div class="ast-row course-offer-section__body">
                <div class="ast-col-md-4">
                    <div class="course-offer-features">
                    <?php if ($includes || $excludes) : ?>
                        <div class="inc-exc-div">
                            <h3 class="inc-exc-title">What’s Included</h3>
                            <?php if ($includes) : ?>
                                <?php 
                                    $includes = array_filter($includes);
                                    foreach ($includes as $inc) :
                                    $inc_item = $inc['content']; ?>
                                    <div class="item inc-item"><i class="fa fa-check"></i><div><?php echo $inc_item; ?></div></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if ($excludes) : 
                                $excludes = array_filter($excludes)    
                            ?>
                                <?php foreach ($excludes as $exc) :
                                    $exc_item = $exc['content']; ?>
                                    <div class="item exc-item"><i class="fa fa-times"></i><div><?php echo $exc_item; ?></div></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
                <div class="ast-col-md-4">
                    <div class="course-offer-details">
                        <?php if ($course_image) : ?>
                            <div class=" d-none course-img">
                                <img src="<?php echo $course_image; ?>">
                            </div>
                        <?php endif; ?>
                        <?php
                        if($timer_expiry && !is_global_timer_expired()):?>
                            <div class="countdown-timer" data-expiry ="<?php echo $timer_expiry?>">
                                <ul class="timer">
                                    <li>
                                        <span id="dayCount"></span>
                                        <span id="day-text">days</span>
                                    </li>
                                    <li>
                                        <span id="hourCount"></span>
                                        <span id="hour-text">hours</span>
                                    </li>
                                    <li>
                                        <span id="minuteCount"></span>
                                        <span id="minute-text">minutes</span>
                                    </li>
                                    <li>
                                        <span id="secondCount"></span>
                                        <span id="second-text">seconds</span>
                                    </li>
                                </ul>
                            </div>
                        <?php 
                        endif;
                        ?>
                        <div class="hunter-kit-cta">
                            <div class="hunter-kit-img">
                                <img src="/wp-content/uploads/2025/03/job-hunters-kit.png" alt="">
                            </div>
                            <div class="hunter-kit-download" >
                                <div class="text-center hunter-kit-text font-600">
                                    Tefl Institute</br>Job Hunter's Kit
                                </div>
                                <a href="/free-resources/" class="btn" target = "_blank">
                                    <span>Learn More</span>
                                    <img src="/wp-content/uploads/2025/03/download-icon.png" alt="">
                                </a>
                            </div>
                        </div>
                        <?php if ($course_price) : ?>
                            <div class="course-price"><?php echo $course_price; ?></div>
                        <?php endif; ?>
                        
                        <?php
                            $teaching_resources = get_field('teaching_resources','option');
                            if($teaching_resources):
                        ?>
                        <div class="resources-select-wrapper">
                            <div class="resources-select-wrapper__header">
                                <h6 class="text-center font-500">
                                Add Teaching Resources
                                </h6>
                                <i class="fa fa-info"></i>
                                <div class="resource-info-container">
                                    Please Select a resource
                                </div>
                            </div>
                            
                            <div class="select-menu resources-select">
                                <div class="select-btn">
                                    <span class="sBtn-text">Select Option</span>
                                    <img class="no-lazy" src="/wp-content/uploads/2024/09/Vector-107.svg" alt="">
                                </div>

                                <ul class="options">
                                    <?php
                                        foreach($teaching_resources as $key => $tc):
                                            $product_id = $tc['product'];
                                            $product_name = $tc['product_name'];
                                            $product_desc = $tc['resources_description'];
                                            $resource_page_link = $tc['resource_page_link'];
                                    ?>
                                        <li class="option" 
                                            data-pid = "<?php echo $product_id?>"
                                            data-name="<?php echo htmlspecialchars($product_name); ?>" 
                                            data-desc="<?php echo htmlspecialchars($product_desc); ?>"
                                            data-pagelink = "<?php echo htmlspecialchars($resource_page_link); ?>"
                                        >
                                            <span class="option-text">
                                                <b><?php echo $product_name?></b>
                                                <span class="ajax-loaded-price"></span>
                                            </span>
                                        </li>
                                    <?php
                                        endforeach
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                            endif;
                        ?>
                    </div>
                </div>
                <div class="ast-col-md-4">
                    <?php if ($freebie_courses || $other_freebie) : ?>
                        <div class="course-offer-freebies">
                            <h3 class="course-offer-freebies-title">Free Resources</h3>
                            <?php if ($freebie_courses) : ?>
                                <?php foreach ($freebie_courses as $fc) :
                                    $free_course_icon = $fc['icon'];
                                    $free_course_title = $fc['title'];
                                    $free_course_product_id = $fc['product'];
                                    $free_course_price = '';
                                    if ($free_course_product_id) {
                                        $free_course_product = wc_get_product($free_course_product_id);
                                        if ($free_course_product) {
                                            $free_course_price = $free_course_product->get_price_html();
                                        }
                                    } ?>
                                    <div class="freebie-course">
                                        <?php if ($free_course_icon) : ?>
                                            <img class="free-course-icon" src="<?php echo $free_course_icon; ?>">
                                        <?php endif; ?>
                                        <?php if ($free_course_title) : ?>
                                            <p class="free-course-title"><?php echo $free_course_title; ?>
                                            <?php echo $free_course_price?' worth '.$free_course_price:''?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if ($other_freebie) : ?>
                                <?php foreach ($other_freebie as $of) :
                                    $other_freebie_icon = $of['icon'];
                                    $other_freebie_title = $of['title']; ?>
                                    <div class="other-freebie">
                                        <?php if ($other_freebie_icon) : ?>
                                            <img class="other-freebie-icon" src="<?php echo $other_freebie_icon; ?>">
                                        <?php endif; ?>
                                        <?php if ($other_freebie_title) : ?>
                                            <p class="other-freebie-title"><?php echo $other_freebie_title; ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="course-offer-section__footer ast-row">
                <div class="ast-col-md-4 ast-col-md-offset-4">
                <?php 
                if ($add_to_cart_link) : ?>
                    <?php if ($is_virtual_couse) : ?>
                        <a class="ti-enroll-btn banner-btn" href="#timetable"><?php echo  $btn2_txt ?></a>
                    <?php else : ?>
                        <a class="ti-enroll-btn enroll-now-btn banner-btn" rel="nofollow" href="<?php echo get_home_url(); ?>/?addtimetocart&prid=<?php echo $course_product_id; ?>"><?php echo  $btn2_txt ?>
                        </a>
                    <?php endif; ?>
                    
                <?php  
                endif; 
                ?>
                </div>
                
            </div>
            <?php endforeach?>
        </div>
    </section>

    <?php endif?>

    <!-- Course Offer Section End -->


    <!-- Instructors Info Section -->

    <?php
        $instructors_info_section = get_field('instructors_info_section','option');
        if(!empty($instructors_info_section)):
    ?>
        <section class="instructors-info-section section-padding">
            <?php
                $section_heading = $instructors_info_section['section_heading'];
                $section_subheading = $instructors_info_section['section_subheading'];
                $section_summary = $instructors_info_section['section_summary'];
                $instructors = $instructors_info_section['instructors'];
            ?>
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h3 class="instructors-info-section__subheading text-center">
                            <?php echo $section_subheading?>
                        </h3>
                        <h2 class="instructors-info-section__heading common-heading text-center">
                            <?php echo $section_heading?>
                        </h2>
                        <div class="instructors-info-section__summary w-75 text-center">
                            <?php echo $section_summary?>
                        </div>
                        <div class="instructors-info-section__instructors">
                            <div class="glide instructors-glide">
                                <div class="glide__track" data-glide-el="track">
                                    <ul class="glide__slides">
                                        <?php 
                                            foreach($instructors as $key => $instructor):
                                                $ins_image = $instructor['image'];
                                                $ins_name = $instructor['name'];
                                                $ins_desg = $instructor['designation'];
                                        ?>
                                            <li class="glide__slide">
                                                <div class="instructor-card">
                                                    <img src="<?php echo $ins_image?>" alt="" class="instructor-card__image no-lazy">
                                                    <h4 class="instructor-card__name"><?php echo $ins_name?></h4>
                                                    <span class="instructor-card__designation">
                                                        <?php echo $ins_desg?>
                                                    </span>
                                                </div>
                                            </li>
                                        <?php
                                            endforeach;
                                        ?>
                                    </ul>
                                </div>
                                <div class="glide__arrows" data-glide-el="controls">
                                    <a class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fa fa-angle-left"></i></a>
                                    <a class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    <?php
        endif
    ?>
    <!-- Instructors Info Section -->

    <!-- Salary Calculator CTA Section -->
    <?php 
        $salary_calculator_cta_bar = get_field('salary_calculator_cta_bar', 'options');  
        if(!empty($salary_calculator_cta_bar)):
            $cta_bar_content = $salary_calculator_cta_bar['bar_content'];
            $cta_button_text = $salary_calculator_cta_bar['cta_button_text'];
            $cta_button_url = $salary_calculator_cta_bar['cta_button_url']; 
        ?>                                    
        <section class="salary-calculator-cta-section">
            <div class="ast-container">
                <div class="salary-calculator-cta">
                    <div class="ast-row">
                        <div class="bar-content ast-col-md-9">
                            <?php echo $cta_bar_content; ?>
                        </div>
                        <div class="bar-button ast-col-md-3">
                            <a class="btn btn-white btn-rounded" href="<?php echo $cta_button_url; ?>">
                                <?php echo $cta_button_text; ?> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
        endif;
    ?>

    <!-- Salary Calculator CTA Section End -->

    <?php
        $ielts_cta_block = get_field('ielts_cta_block', 'option');
        $where_to_show = !empty($ielts_cta_block['where_to_show']) ? $ielts_cta_block['where_to_show'] : []; 
        $cta_block = $ielts_cta_block['cta_block'];    
        if(in_array($current_post_id,$where_to_show) && !is_array_empty($cta_block)):
            $block_title = $cta_block['block_title'];
            $block_summary = $cta_block['block_summary'];
            $block_image = $cta_block['block_image'];
            $block_bg_color = !empty($cta_block['block_bg_color']) ? $cta_block['block_bg_color']:'#ffffff';
            $block_text_color = !empty($cta_block['block_text_color']) ? $cta_block['block_text_color']:'#1c1c1b' ;
            $block_cta_button = $cta_block['block_cta_button'];
            $cta_text = $block_cta_button['cta_text'];
            $cta_link = $block_cta_button['cta_link'];
            $button_bg_color = !empty($block_cta_button['button_bg_color']) ? $block_cta_button['button_bg_color']:'#1c1c1b';
            $button_text_color = !empty($block_cta_button['button_text_color']) ? $block_cta_button['button_text_color']:'#ffffff';
    ?>

    <!-- IELTS Guide Section -->

    <section class="ielts-guide-section section-padding-top">
        <div class="ast-container">
            <div class="ielts-guide-section-row"
                 style="--bg-color:<?php echo $block_bg_color?>; --text-color:<?php echo $block_text_color?>"
            >
                <div class="ast-row">
                    <div class="ast-col-md-8">
                        <h2 class="common-heading ielts-guide-section-heading">
                            <?php echo $block_title?>
                        </h2>
                        <div class="ielts-guide-section-summary">
                            <?php echo $block_summary?>
                        </div>
                        <a href="<?php echo $cta_link?>" class="ielts-guide-btn"
                           style="--bg-color:<?php echo $button_bg_color?>; --text-color:<?php echo $button_text_color?>"
                        >
                            <?php echo $cta_text?>
                        </a>
                    </div>
                    <div class="ast-col-md-4">
                        <img src="<?php echo $block_image?>" alt="" class="ielts-guide-image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- IELTS Guide Section End-->
    <?php
        endif;
    ?>

    <!-- Certificate Review Section -->

    <?php $certificate_review = get_field('certificate_review');
    if (!empty($certificate_review)): 
        $cert_img = $certificate_review['certificate_review_image'];
        $show_transcript = $certificate_review['show_certificate_transcript_image'];
        if($show_transcript){
            $transcript_img = $certificate_review['certificate_transcript'];
        }
        $cert_title = $certificate_review['certificate_review_title'];
        $cert_details = $certificate_review['certificate_review_details'];
        $buttons = $certificate_review['certificate_review_buttons'];

        $teaching_video_masterclass = get_field('teaching_video_masterclass');
    ?>
    <?php if (get_the_ID() != 101642) : ?>
        <section class="certificate-preview-section section-padding" >
            <div class="ast-container">
                <div class="ast-row">
                    <div class="certificate-preview__row">
                        <div class=" ast-col-md-6">
                            <div class="certificate-preview">
                                <h2 class="certificate-preview__heading text-center">
                                    <?php echo $cert_title?>
                                </h2>
                                <div class="image-container">
                                    <div class="cert-image <?php echo $show_transcript?'ast-col-md-6':'ast-col-md-12'?>">
                                        <img src="<?php echo $cert_img ?>">
                                    </div>
                                <?php if($show_transcript):?>
                                    <div class="cert-image ast-col-md-6">
                                        <img src="<?php echo $transcript_img ?>">
                                    </div>
                                <?php endif?>
                                </div>
                                <?php if ($buttons) : ?>
                                    <div class="btn-group certificate-preview__buttons">
                                        <?php foreach ($buttons as $button) :
                                            $button_text = $button['button_text'];
                                            $button_link = $button['button_link']; 
                                            $is_primary_btn = $button['is_primary'];
                                            ?>
                                            <a class="cta-btn btn-rounded <?php echo $is_primary_btn?'cta-btn-primary':'cta-btn-secondary'?>" href="<?php echo $button_link; ?>" target="_blank">
                                                <?php echo $button_text; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="ast-col-md-6">
                            <div class="video-masterclass">
                                <?php 
                                if(is_array($teaching_video_masterclass)){
                                    $teaching_video_masterclass = array_filter($teaching_video_masterclass);
                                } 
                                if(!empty($teaching_video_masterclass)):
                                    $tvm_heading = $teaching_video_masterclass['heading'];
                                    $tvm_image = $teaching_video_masterclass['image'];
                                    $tvm_buttons = $teaching_video_masterclass['cta_buttons'];
                                ?>
                                    <h2 class="video-masterclass__heading text-center">
                                        <?php echo $tvm_heading?>
                                    </h2>
                                    <div class="video-masterclass__image">
                                        <img src="<?php echo $tvm_image?>" alt="">
                                    </div>
                                    <div class="video-masterclass__buttons">
                                        <?php 
                                            foreach($tvm_buttons as $tvm_btn):
                                                $is_primary_btn = $tvm_btn['is_primary'];
                                                $btn_text = $tvm_btn['button_text'];
                                                $btn_link = $tvm_btn['button_link'];
                                        ?>
                                        <a href="<?php echo $btn_link?>" class="cta-btn btn-rounded <?php echo $is_primary_btn?'cta-btn-primary':'cta-btn-secondary'?>">
                                            <?php echo $btn_text?>
                                        </a>
                                        <?php
                                            endforeach;
                                        ?>
                                    </div>
                                <?php endif?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
    <?php endif?>

    <!-- Certificate Review Section End  -->

    <!-- Accreditation Section -->

    <?php 
        $tefl_accreditation = get_field('tefl_accreditation');
        if(!empty($tefl_accreditation)):
            $section_heading = $tefl_accreditation['section_heading'];
            if(empty($section_heading)){
                $section_heading='TEFL Accreditation with The TEFL Institute';
            }
            $section_subheading = $tefl_accreditation['section_subheading'];
            if(empty($section_subheading)){
                $section_subheading='Ranked Number #1 TEFL Trainer by Schools and Employers Worldwide';
            }
            $is_ofqual = $tefl_accreditation['is_ofqual'];
            $accred_img = $tefl_accreditation['image'];
            $accred_title = $tefl_accreditation['title'];
            $accred_subtitle = $tefl_accreditation['subtitle'];
            $common_accreditation = get_field('common_accreditation','option');
            if (is_single(array('836', '838', '743', '825', '2704')) || $is_ofqual){
                $common_accreditation = get_field('level_5_common_accreditation','option');
            }

    ?>
    <section class="accreditation-section section-padding-bottom">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <h2 class="accreditation-section__heading text-center common-heading">
                        <?php echo $section_heading?>
                    </h2>
                    <h3 class="accreditation-section__subheading text-center">
                        <?php echo $section_subheading?>
                    </h3>
                    <div class="accreditation-section__body">
                        <?php if (is_single(array('836', '838', '743', '825', '2704')) || $is_ofqual) {
                            $ofqual_section = get_field('ofqual_accreditation_section', 'options');
                            $ofqual_img = $ofqual_section['image'];
                            $ofqual_content = $ofqual_section['content']; ?>
                            <div class="ofqual-section">
                                <?php if ($ofqual_img) : ?>
                                    <img src="<?php echo $ofqual_img; ?>">
                                <?php endif; ?>
                                <?php if ($ofqual_content) : ?>
                                    <div><?php echo $ofqual_content; ?></div>
                                <?php endif; ?>
                            </div>
                        <?php } ?>
                        <div class="accreditation-section__logos">
                            <?php
                            if ($accred_img && $accred_title) : ?>
                                <div class="item">
                                    <div class="image-box">
                                        <img src="<?php echo $accred_img; ?>">
                                    </div>
                                    <div>
                                        <h5><?php echo $accred_title; ?></h5>
                                        <h6><?php echo $accred_subtitle; ?></h6>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php 
                                if(have_rows('common_accreditation','option')):
                                    foreach($common_accreditation as $comm_acc):
                                        $accred_img = $comm_acc['logo'];
                                        $accred_title = $comm_acc['title'];
                                        $accred_subtitle = $comm_acc['subtitle'];
                                        $accred_link = $comm_acc['link'];
                            ?>
                                <div class="item">
                                    <div class="image-box">
                                        <a href="<?php echo $accred_link?>" target="_blank">
                                            <img src="<?php echo $accred_img; ?>">
                                        </a>
                                    </div>
                                    <div class="image-text">
                                        <h5><?php echo $accred_title; ?></h5>
                                        <h6><?php echo $accred_subtitle; ?></h6>
                                    </div>
                                </div>
                            <?php 
                                    endforeach;
                                endif
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        endif;
    ?>

    <!-- Accreditation Section End -->

    <!-- Video Testimonials -->

    <?php 
    
    $graduate_testimonials_section = get_field('graduate_testimonials_section','option'); 
        if (!empty($graduate_testimonials_section)) : 
        $graduate_testimonials_section_heading = $graduate_testimonials_section['section_heading'];
        $graduate_testimonials_section_slider = $graduate_testimonials_section['graduate_review_slider'];
    ?>
        <section class="video-testimoinials-section section-padding">
            <div class="ast-container">
                <div class="ast-row">
                    <h2 class="video-testimonials-section__heading text-center common-heading">
                        <?php echo $graduate_testimonials_section_heading?>
                    </h2>
                    <div class="ast-col-md-12 video-testimonials-section__slider">
                        <div class="glide video-testimoinials__glide">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">
                                    <?php
                                        foreach($graduate_testimonials_section_slider as $slider):
                                            $slider_image = $slider['review_image'];
                                            $slider_title = $slider['review_title'];
                                            $slider_subtitle = $slider['review_slider_subtitle'];
                                            $slider_snippet = $slider['review_snippet'];
                                            $slider_link = $slider['review_link'];
                                    ?>
                                    <li class="glide__slide">
                                        <div class="video-testimonial-card">
                                            <a  href="<?php echo $slider_link?>" class="popup-video-review">
                                            <div class="video-testimonial-card_image-container">
                                                <img src="<?php echo $slider_image?>" alt="" class="video-testimonial-card__image no-lazy">
                                                <img class="play-btn no-lazy" src="/wp-content/uploads/2020/11/play-btn.svg">
                                            </div>
                                            
                                            <h3 class="video-testimonial-card__title">
                                                <?php echo $slider_title?>
                                            </h3>
                                            <h4 class="video-testimonial__subtitle">
                                                <?php echo $slider_subtitle?>
                                            </h4>
                                            <div class="video-testimonial-card__snippet">
                                                <?php echo $slider_snippet?>
                                            </div>
                                            </a>
                                        </div>
                                    </li>
                                    <?php
                                        endforeach
                                    ?>
                                </ul>
                            </div>
                            <div class="glide__arrows" data-glide-el="controls">
                                <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fa fa-angle-left"></i></button>
                                <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class="fa fa-angle-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Video Testimonials End -->

    <?php if (in_array(19, $course_category) || in_array(18, $course_category)) { ?>
        <?php $funding_content = get_field('funding_content', 'options');
        if ($funding_content) : ?>
            <div class="funding" style="display:none;">
                <div class="ast-container">
                    <h6 class="section-heading">Student or Unemployed Funding:</h6>
                    <div class="ast-row">
                        <div class="ast-col-md-12">
                            <?php echo $funding_content; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php } ?>

    <!-- Free Resources Section-->

    <?php
        $popular_resources_section = get_field('popular_resources_section','option');
        if(!empty($popular_resources_section)):
            $section_heading = $popular_resources_section['section_heading'];
            $recourses_column = $popular_resources_section['recourses_column'];
    ?>
    <section class="popular-resources-section section-padding">
        <div class="ast-container">
            <div class="ast-row">
                <h2 class="popular-resources-section__heading text-center common-heading">
                    <?php echo $section_heading?>
                </h2>
                <div class="popular-resources-section__cards">
                    <?php 
                        foreach($recourses_column as $rsc):
                            $title = $rsc['heading'];
                            $image = $rsc['image'];
                            $summary = $rsc['summary'];
                            $cta_btns = $rsc['cta_buttons'];
                    ?>
                        <div class="ast-col-md-4">
                            <div class="resources-card">
                                <h3 class="recources-card__title text-center">
                                    <?php echo $title?>
                                </h3>
                                <img src="<?php echo $image ?>" class="recources-card__image" alt="">
                                <div class="resources-card__summary">
                                    <?php echo $summary?>
                                </div>
                                <div class="resources-card__buttons">
                                    <?php
                                        foreach($cta_btns as $btn):
                                            $btn_link = $btn['button_link'];
                                            $btn_text = $btn['button_text'];
                                    ?>
                                    <a href="<?php echo $btn_link?>"><?php echo $btn_text?></a>
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php 
                        endforeach
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif?>
    <!-- Free Resources Section End-->

    <?php if (false && !$is_virtual_couse) :
        /* Temporarily HIDE GUIDES - Request from IAN */
    ?>
        <!--download guide-->
        <section class="download-guide">
            <div class="ast-container">
                <h6 class="centered section-heading">download your free guides</h6>
                <div class="ast-row download-guide-row">

                    <div class="ast-col-lg-4 download-guide-col" style="padding-right:2rem;">

                        <a href="#boxzilla-1724" class="menu_tefl_brochure" data-guide="brochure" data-href="/tefl-form-brochure/">
                            <div class="guide guide1 bg-image">
                                <p>teach english abroad</p>
                                <img src="/wp-content/uploads/2020/11/Group-437.svg">
                            </div>
                        </a>
                    </div>
                    <div class="ast-col-lg-4 download-guide-col" style="padding-right:2rem">

                        <a href="#boxzilla-1724" class="menu_tefl_brochure" data-guide="teoguide" data-href="/wp-content/uploads/2020/05/tefl.ie-teach-english-online-guide-copy-6.pdf">
                            <div class="guide guide1 bg-image">
                                <p>teach english online</p>
                                <img src="/wp-content/uploads/2020/11/Group-437.svg">
                            </div>
                        </a>
                    </div>
                    <div class="ast-col-lg-4 download-guide-col">

                        <a href="#boxzilla-1724" class="menu_tefl_brochure" data-guide="thailandguide" data-href="/thailand-interactive-guide/">
                            <div class="guide guide1 bg-image">
                                <p>tefl guide to thailand</p>
                                <img src="/wp-content/uploads/2020/11/Group-437.svg">
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </section>
    <?php endif; ?>


    <?php
    if ($is_virtual_couse) :
        $faqs_arg = array(
            'numberposts' => 3,
            'post_type'   => 'faqs'
        );

        $faqs_post = get_posts($faqs_arg);
        if ($faqs_post) :
    ?>

            <section class="faq-section section-padding-bottom">
                <div class="ast-container">
                    <h2 class="centered section-heading common-heading">FAQS</h2>
                    <div class="ast-row faq-row">
                        <div class="faq-row">
                        <?php foreach ($faqs_post as $fq) : ?>
                            <?php
                            $faq_id = $fq->ID;
                            $faq_title = $fq->post_title;
                            $faq_img_url = get_the_post_thumbnail_url($faq_id, 'full');
                            $faq_content = apply_filters('the_content', $fq->post_content);
                            $faq_url = get_post_permalink($faq_id);
                            ?>
                            <div class="ast-col-md-4 faq-col">
                                <div class="faq-col">
                                    <?php if (!empty($faq_img_url)) : ?>
                                        <!-- <h6 class="faq-img-div" style="background-image:url('<?php echo $faq_img_url; ?>')"></h6> -->
                                        <img class="faq-img-div" src="<?php echo $faq_img_url; ?>">
                                    <?php endif; ?>
                                    <?php if (!empty($faq_title)) : ?>
                                        <div class="faq-title"><?php echo $faq_title; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($faq_content)) : ?>
                                        <div class="faq-content"><?php echo $faq_content; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($faq_url)) : ?>
                                        <div class="faq-link"><a href="<?php echo $faq_url; ?>">Learn More</a></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <section class="why-teflinstitute-section">
            <div class="ast-container">
                <h2 class="centered section-heading common-heading">WHY TEFL INSTITUTE</h2>
                <div class="ast-row why-teflinstitute-row">
                    <div class="ast-col-lg-1 ast-col-sm-12 blank-col"></div>
                    <div class="ast-col-lg-10 ast-col-sm-12 why-teflinstitute-content-col">
                        <div class="ast-row">
                            <div class="ast-col-lg-4 ast-col-sm-12 why-teflinstitute-col">
                                <div class="why-ti-img-div">
                                    <img src="/wp-content/uploads/2021/01/Group-164.svg" alt="quality-service-img">
                                </div>
                                <h6 class="why-ti-title">QUALITY & SERVICE WE ARE DEDICATED TO GIVING YOU THE BEST
                                    EXPERIENCE</h6>
                                <div class="why-ti-content">Our experience in the TEFL industry is second to none and we’re
                                    pretty passionate about what we do. (That’s why 92% of customers recommend us)</div>
                            </div>
                            <div class="ast-col-lg-4 ast-col-sm-12 why-teflinstitute-col">
                                <div class="why-ti-img-div">
                                    <img src="/wp-content/uploads/2021/01/Group-168.svg" alt="tefl-specialist-img">
                                </div>
                                <h6 class="why-ti-title">TEFL SPECIALISTS OVER 20 YEARS IN THE TEFL INDUSTRY</h6>
                                <div class="why-ti-content">Sharing our English teaching knowledge gives you the superior
                                    training experience you deserve. We’ll prepare you for all teaching scenarios.</div>
                            </div>
                            <div class="ast-col-lg-4 ast-col-sm-12 why-teflinstitute-col">
                                <div class="why-ti-img-div">
                                    <img src="/wp-content/uploads/2021/01/Group-166.svg" alt="support-abroad-img">
                                </div>
                                <h6 class="why-ti-title">SUPPORT ABROAD WELL HELP GET YOU THERE</h6>
                                <div class="why-ti-content">As a newly qualified English teacher, join an all-inclusive,
                                    fully-supported teaching internship. Gain all the confidence you need to TEFL like a
                                    boss!</div>
                            </div>
                        </div>
                    </div>
                    <div class="ast-col-lg-1 ast-col-sm-12 blank-col"></div>
                </div>
            </div>
        </section>

    <?php endif; ?>
          
    <!-- Learn More Section -->

    <?php
        $learn_more_section = get_field('learn_more_section','option');
        if(!empty($learn_more_section)):
            $section_heading = $learn_more_section['section_heading'];
            $section_summary = $learn_more_section['section_summary'];
            $CTA_btn_text = $learn_more_section['section_cta_button_text'];
            $CTA_btn_link = $learn_more_section['section_cta_button_link'];
    ?>
        <section class="learn-more-section">
            <div class="ast-container">
                <div class="ast-row ">
                    <div class="ast-col-md-7">
                        <span>We love taking your call.</span>
                        <div class="heading-cta-container">
                            <!-- <img class="logo-only" src="/wp-content/uploads/2023/01/TEFL-Logo_Icon-Square.png"/> -->
                            <h2 class="large-heading">TEFL Institute
                                <span class="font-300">guides</span>
                            </h2>
                            
                            <a href="<?php echo $CTA_btn_link?>" class="">
                                <img src="/wp-content/uploads/2023/05/care-arrow.svg"/>
                            </a>
                        </div>
                        
                        
                    </div>
                </div>

                <!-- 5 country guide covers (client brief 2026-10) -->
                <div class="ast-row">
                  <div class="ast-col-md-12">
                    <div class="tg-guides">
                      <a class="tg-cover" href="https://teflinstitute.com/teach-english-abroad/teach-english-in-spain/">
                        <span class="tg-code" aria-hidden="true">ES</span>
                        <div class="tg-top"><div class="tg-label">Plan for 2027</div><div class="tg-rule"></div>
                        <h3 class="tg-country">Spain</h3><p class="tg-sub">Jobs, pay and visa routes</p></div>
                        <div class="tg-foot"><span>Read the guide</span><span class="tg-arrow" aria-hidden="true">&rarr;</span></div>
                      </a>
                      <a class="tg-cover is-featured" href="https://teflinstitute.com/teach-english-abroad/south-korea/">
                        <span class="tg-code" aria-hidden="true">KR</span>
                        <div class="tg-top"><div class="tg-label">Plan for 2027</div><div class="tg-rule"></div>
                        <h3 class="tg-country">South Korea</h3><p class="tg-sub">EPIK, hagwons and pay</p></div>
                        <div class="tg-foot"><span>Read the guide</span><span class="tg-arrow" aria-hidden="true">&rarr;</span></div>
                      </a>
                      <a class="tg-cover" href="https://teflinstitute.com/teach-english-abroad/japan/">
                        <span class="tg-code" aria-hidden="true">JP</span>
                        <div class="tg-top"><div class="tg-label">Plan for 2027</div><div class="tg-rule"></div>
                        <h3 class="tg-country">Japan</h3><p class="tg-sub">JET, ALT and eikaiwa pay</p></div>
                        <div class="tg-foot"><span>Read the guide</span><span class="tg-arrow" aria-hidden="true">&rarr;</span></div>
                      </a>
                      <a class="tg-cover" href="https://teflinstitute.com/teach-english-abroad/vietnam/">
                        <span class="tg-code" aria-hidden="true">VN</span>
                        <div class="tg-top"><div class="tg-label">Plan for 2027</div><div class="tg-rule"></div>
                        <h3 class="tg-country">Vietnam</h3><p class="tg-sub">Work permits and requirements</p></div>
                        <div class="tg-foot"><span>Read the guide</span><span class="tg-arrow" aria-hidden="true">&rarr;</span></div>
                      </a>
                      <a class="tg-cover" href="https://teflinstitute.com/teach-english-abroad/thailand/">
                        <span class="tg-code" aria-hidden="true">TH</span>
                        <div class="tg-top"><div class="tg-label">Plan for 2027</div><div class="tg-rule"></div>
                        <h3 class="tg-country">Thailand</h3><p class="tg-sub">Visas and teaching licences</p></div>
                        <div class="tg-foot"><span>Read the guide</span><span class="tg-arrow" aria-hidden="true">&rarr;</span></div>
                      </a>
                      
                      <a class="tg-cover" href="https://teflinstitute.com/teach-english-abroad/italy/">
                    <span class="tg-code" aria-hidden="true">IT</span>
                    <div class="tg-top">
                        <div class="tg-label">Plan for 2027</div>
                        <div class="tg-rule"></div>
                        <h3 class="tg-country">Italy</h3>
                        <p class="tg-sub">Jobs, pay and visa routes</p>
                    </div>
                    <div class="tg-foot"><span>Read the guide</span><span class="tg-arrow" aria-hidden="true">&rarr;</span></div>
                    </a>
                    <a class="tg-cover" href="https://teflinstitute.com/teach-english-abroad/dubai/">
                    <span class="tg-code" aria-hidden="true">AE</span>
                    <div class="tg-top">
                        <div class="tg-label">Plan for 2027</div>
                        <div class="tg-rule"></div>
                        <h3 class="tg-country">Dubai</h3>
                        <p class="tg-sub">Pay, requirements and visas</p>
                    </div>
                    <div class="tg-foot"><span>Read the guide</span><span class="tg-arrow" aria-hidden="true">&rarr;</span></div>
                    </a>
                    <a class="tg-cover" href="https://teflinstitute.com/teach-english-abroad/czech-republic/">
                    <span class="tg-code" aria-hidden="true">CZ</span>
                    <div class="tg-top">
                        <div class="tg-label">Plan for 2027</div>
                        <div class="tg-rule"></div>
                        <h3 class="tg-country">Czech Republic</h3>
                        <p class="tg-sub">Pay, visas and cities</p>
                    </div>
                    <div class="tg-foot"><span>Read the guide</span><span class="tg-arrow" aria-hidden="true">&rarr;</span></div>
                    </a>
                    <a class="tg-cover" href="https://teflinstitute.com/teach-english-abroad/cambodia/">
                    <span class="tg-code" aria-hidden="true">KH</span>
                    <div class="tg-top">
                        <div class="tg-label">Plan for 2027</div>
                        <div class="tg-rule"></div>
                        <h3 class="tg-country">Cambodia</h3>
                        <p class="tg-sub">Pay, requirements and visas</p>
                    </div>
                    <div class="tg-foot"><span>Read the guide</span><span class="tg-arrow" aria-hidden="true">&rarr;</span></div>
                    </a>
                    <a class="tg-cover" href="https://teflinstitute.com/teach-english-abroad/estonia/">
                    <span class="tg-code" aria-hidden="true">EE</span>
                    <div class="tg-top">
                        <div class="tg-label">Plan for 2027</div>
                        <div class="tg-rule"></div>
                        <h3 class="tg-country">Estonia</h3>
                        <p class="tg-sub">Jobs, pay and work routes</p>
                    </div>
                    <div class="tg-foot"><span>Read the guide</span><span class="tg-arrow" aria-hidden="true">&rarr;</span></div>
                    </a>

                    </div>
                  </div>
                </div>
            </div>
        </section>
    <?php
        endif;
    ?>           
    <?php
        // include('includes/save-your-search-modal.php');
    ?>     

    <!-- Learn More Section End -->
</div>
<!-- #primary -->
