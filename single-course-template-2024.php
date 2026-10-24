<div id="primary" <?php astra_primary_class(); ?>>

    <!--  Hero Section -->

    <?php
        $is_virtual_course  = get_field('is_virtual_course_new');
        $video_testimonials_section = get_field('video_testimonials_section','option');
        $guides_prospectus_section = get_field('guides-prospectus_section');
        $reviews_widget = get_field('reviews_widget','option');
        $new_hero_section = get_field('new_hero_section');
        $is_level_5_diploma_course = get_field('is_level_5_diploma_course');
        if(!is_array_empty($new_hero_section)):
            $course_product_id = $new_hero_section['course']->ID;
            $course_product_id_new = $course_product_id;
            $object_id = $course_product_id_new;
            $banner_background_image = $new_hero_section['banner_background_image'];
            $banner_logo = $new_hero_section['banner_logo'];
            $banner_content = $new_hero_section['banner_content'];
            $course_icon = $banner_content['course_icon'];
            $cours_title = $banner_content['course_title'];
            $course_subtitle = $banner_content['course_subtitle'];
            $course_product_obj = wc_get_product($course_product_id);
            if ($course_product_obj){ 
                $course_price = $course_product_obj->get_price_html();
                $full_price = $course_product_obj->get_price();
                $simple_regular_price = $course_product_obj->get_regular_price();
                $simple_sale_price = $course_product_obj->get_sale_price();
                if (is_numeric($simple_regular_price) && is_numeric($simple_sale_price) && $simple_regular_price != 0) {
                    $save_percentage = round((($simple_regular_price - $simple_sale_price) / $simple_regular_price) * 100);
                }
            }
            $course_description = $banner_content['course_description'];

            $deposit_enabled = get_post_meta($course_product_id, '_wc_deposit_enabled', true);
            $deposit_payment_plan = '';

            if($deposit_enabled == 'forced' || $deposit_enabled == 'optional'){
                $deposit_payment_plan = get_post_meta($course_product_id, '_wc_deposit_payment_plans', true);
                $deposit_payment_plan = $deposit_payment_plan[0];
            }

            $deposit_class = '';
            if ($deposit_payment_plan) :
            $deposit_class = "deposit-full-price payment-plan-".$deposit_payment_plan;
            endif;
            $query = "SELECT amount FROM `wp_wc_deposits_payment_plans_schedule` WHERE `schedule_index` = 0 AND `plan_id` = ".$deposit_payment_plan;
            $deposit_percent = $wpdb->get_var($query);
            $deposit_percent = round((float)$deposit_percent / 100, 5);
            if($deposit_payment_plan === 4){
                $total_deposits = 3;
                $first_payment  = $full_price * 0.2;
                $first_payment = number_format($first_payment, 2, '.', '');
                $second_payment = $full_price * 0.4;
                $second_payment = number_format($second_payment, 2, '.', '');
                $third_payment  = $full_price * 0.4;
                $third_payment = number_format($third_payment, 2, '.', '');
                $first_due_date = date('jS M Y', strtotime("+45 days"));
                $last_due_date = date('jS M Y', strtotime("+90 days"));
            }
            if($deposit_payment_plan === 5){
                $total_deposits = 3;
                $first_payment  = $full_price * 0.2;
                $first_payment = number_format($first_payment, 2, '.', '');
                $second_payment = $full_price * 0.4;
                $second_payment = number_format($second_payment, 2, '.', '');
                $third_payment  = $full_price * 0.4;
                $third_payment = number_format($third_payment, 2, '.', '');
                $first_due_date = date('jS M Y', strtotime("+30 days"));
                $last_due_date = date('jS M Y', strtotime("+60 days"));
            }
            if($deposit_payment_plan === 1 || $deposit_payment_plan === 3){
                $total_deposits = 2;
                $first_payment = $full_price * 0.5;
                $first_payment = number_format($first_payment, 2, '.', '');
                $second_payment = $full_price * 0.5;	
                $second_payment = number_format($second_payment, 2, '.', '');
                $last_due_date = date('jS M Y', strtotime("+30 days"));
            }
            if($deposit_payment_plan === 7){
                $total_deposits = 3;
                $first_payment  = $full_price * 0.333;
                $first_payment = number_format($first_payment, 2, '.', '');
                $second_payment = $full_price * 0.333;
                $second_payment = number_format($second_payment, 2, '.', '');
                $third_payment  = $full_price * 0.334;
                $third_payment = number_format($third_payment, 2, '.', '');
                $first_due_date = date('jS M Y', strtotime("+30 days"));
                $last_due_date = date('jS M Y', strtotime("+60 days"));
            }
            $currency = get_woocommerce_currency_symbol();
            $course_completion_text = $banner_content['course_completion_text'];
            $reviews_count = isset($reviews_widget['total_reviews']) ? $reviews_widget['total_reviews']: 1671;
            
    ?>

        <section data-test data-pid="<?php echo $course_product_id_new?>" style="background-image:url('<?php echo $banner_background_image?>')" class="section-padding full-width-banner hero-banner">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-6">
                        <div id="heroBannerContent" class="hero-banner-content deposit-radio-container">
                            <div class="hero-banner-content__header">
                                <div class="hero-banner-content__header-left">
                                    <img class="course-icon" src="<?php echo $course_icon?>" alt="">
                                </div>
                                <div class="hero-banner-content__header-right">
                                    <h1 class="course-page-title large-heading">
                                        <?php echo $cours_title?>
                                    </h1>
                                    <span class="course-subtitle">
                                        <?php echo $course_subtitle?>
                                    </span>
                                    <?php if($course_price):?>
                                        <div data-depositpercent="<?php echo $deposit_percent?>" class="product-price <?php echo $deposit_class?> course-price-container">
                                            <?php echo $course_price?>
                                            <div class="savings d-none"><?php echo 'Save '.$save_percentage.'%'?></div>
                                        </div>
                                    <?php endif?>
                                </div>
                            </div>
                            <?php
                                if(!empty($deposit_payment_plan)):
                                    include('includes/ti-deposit-form.php');
                                endif;
                            ?>
                            <?php
                            // Sales countdown
                            $numbers_of_sale_courses_offered = empty(get_field('numbers_of_sale_courses_offered')) ? 0 : get_field('numbers_of_sale_courses_offered');
                            $numbers_of_sale_courses_sold = count_orders_with_product_since_date($course_product_id_new,'2024-09-17');
                            $numbers_of_sale_courses_sold_count = $numbers_of_sale_courses_sold['count'] ?? 0;
                            $numbers_of_sale_courses_remaining = (int)$numbers_of_sale_courses_offered - (int)$numbers_of_sale_courses_sold_count;

                            if ($numbers_of_sale_courses_remaining > 0 ) :
                            ?>
                                <div class="offer-sale-information-outer">
                                    <div class="text-center offer-sale-information">
                                        <div class="offer-sale-counter <?php echo $numbers_of_sale_courses_sold_count?> ">
                                            <span><?php echo $numbers_of_sale_courses_remaining; ?></span>
                                            <span>courses left</span>
                                        </div>
                                        <div class="offer-sale-information__details">
                                            <span class="font-700">Looking for extra income?</span>
                                            <span class="font-600">Start teaching English online</span>
                                            <span class="font-400">Applies to first 100 courses - <b>Act fast!</b></span>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endif;
                            ?>
                            <div class="<?php echo 'this'.$deposit_payment_plan?> hero-banner-content__description">
                                <?php echo $course_description?>
                            </div>
                            <div class="header-banner-content__buttons">
                                <?php if($is_virtual_course): ?>
                                    <div class=""><a class="sidebar_btn btn btn-centered enrol-btn btn-primary" href="#timetable">Enrol Now</a></div>
                                <?php else: ?>
                                <div class="enroll-now-link-btn <?php echo $current_cc?>">
                                    <a href="<?php echo site_url();?>/cart/?addtimetocart&prid=<?php echo $course_product_id; ?>" class="ti-enroll-btn enroll-now-btn btn btn-centered enrol-btn btn-primary">Enrol Now</a>
                                </div>
                                <?php endif?>
                                <a href="#courseOutline" class="course-details btn btn-centered btn-outline">Course Details</a>
                            </div>
                            <?php if(!empty($course_completion_text)):?>
                            <div class="course-completion-text text-center">
                                <?php echo $course_completion_text?>
                            </div>
                            <?php endif;?>
                            <?php if(!empty($reviews_count)):?>
                                <div class="google-reviews-info">
                                    <span class="font-700">Excellent</span>
                                    <img class="no-lazy reviews-star" src="/wp-content/uploads/2024/10/banner_reviews_stars.png" alt="">
                                    <span class="font-600"><?php echo $reviews_count?> reviews</span>
                                    <a href="https://search.google.com/local/reviews?placeid=ChIJaeBYjIqxe0gR8IEtXkiDSWo" target="blank">
                                        View on 
                                        <img class="no-lazy google-logo" src="/wp-content/uploads/2024/11/google-logo.svg" alt="">
                                    </a>
                                </div>
                            <?php endif?>
                            <?php 
                            $current_cc = get_user_geo_country_code();
                            $klarna_enabled_cc = array('AT', 'BE', 'CZ', 'DK', 'FI', 'FR', 'DE', 'GR', 'IE', 'IT', 'NL', 'NO', 'PL', 'PT', 'SE', 'CH', 'GB');
                            $klarna_enabled_courses = array( 259,13680,24443,72236,82962,84635,72473,55087,98447);
                            $show_klarna = (in_array($current_cc, $klarna_enabled_cc) && in_array(get_the_ID(), $klarna_enabled_courses)) ? 1 : 0;
                            if ( $show_klarna ): ?>
                                <div data-cc="<?php echo $current_cc?>" class="text-center pay-with-klarna font-600">Buy now, pay later with <img class="klarna-learn-more no-lazy" src="/wp-content/uploads/2023/04/Klarna-marketing-badge-pink-rgb.svg_.svg" alt=""></div>
                            <?php endif?>
                        </div>
                    </div>
                    <div class="ast-col-md-6">

                    <?php
                        if(!empty($banner_logo)):
                    ?>
                    <div class="banner-logo-container">
                            <img src="<?php echo $banner_logo ?>" class="banner-slide__content-logo" alt="">
                    </div>
                        <?php
                            else:
                            $common_hero_banner_logo = get_field('common_hero_banner_logo','option');
                            $common_banner_logo      = $common_hero_banner_logo['common_banner_logo'];
                            $selected_courses        = $common_hero_banner_logo['selected_courses'] ? $common_hero_banner_logo['selected_courses'] : [];
                            $show_alternate_logo     = $common_hero_banner_logo['show_alternate_logo'];
                            $common_banner_logo_link = $common_hero_banner_logo['common_banner_logo_link'];
                            if($show_alternate_logo){
                                $alternate_common_banner_logo = $common_hero_banner_logo['alternate_common_banner_logo'];
                                $alternate_common_banner_logo_link = $common_hero_banner_logo['alternate_common_banner_logo_link'];
                                $alternate_selected_courses = $common_hero_banner_logo['alternate_selected_courses']?$common_hero_banner_logo['alternate_selected_courses']:[];
                                foreach ($alternate_selected_courses as $course) {
                                    $key = array_search($course, $selected_courses);
                                    if ($key !== false) {
                                        unset($selected_courses[$key]);
                                    }
                                }
                            }
                            if (in_array($current_course_id, $selected_courses) && !empty($common_banner_logo)):
                        ?>
                            <div class="banner-logo-container">
                                <div style="position:relative">
                                    <?php 
                                        $numbers_of_sale_courses_offered = get_field('numbers_of_sale_courses_offered',11833);
                                        $numbers_of_sale_courses_sold = count_orders_with_product_since_date(11075,'2024-09-17');
                                        $numbers_of_sale_courses_sold_count = $numbers_of_sale_courses_sold['count'] ?? 0;
                                        $numbers_of_sale_courses_remaining = (int)$numbers_of_sale_courses_offered - (int)$numbers_of_sale_courses_sold_count;
                                        if(!is_single('11833') && $numbers_of_sale_courses_remaining>0):

                                    ?>
                                    <div class="offer-sale-counter d-none">
                                        <span class="courses-remaining">
                                            <?php echo $numbers_of_sale_courses_remaining?>
                                        </span>
                                        <span>courses left</span>
                                    </div>
                                    <?php
                                        endif;
                                    ?>
                                    <?php 
                                    if(empty($common_banner_logo_link)):?>
                                        <img src="<?php echo $common_banner_logo ?>" class="common-logo banner-slide__content-logo" alt="">
                                    <?php 
                                    else:
                                    ?>
                                    <a href="<?php echo $common_banner_logo_link?>">
                                        <img src="<?php echo $common_banner_logo ?>" class="common-logo banner-slide__content-logo" alt="">
                                    </a>
                                    <?php
                                    endif;
                                    ?>
                                </div>
                            </div>
                        <?php
                            endif;
                            if ($show_alternate_logo && in_array($current_course_id, $alternate_selected_courses) && !empty($alternate_common_banner_logo)):
                        ?>
                            <div class="banner-logo-container">
                                <img src="<?php echo $alternate_common_banner_logo ?>" class="alternate-common-logo common-logo banner-slide__content-logo" alt="">
                            </div>
                        <?php
                            endif;
                        endif;
                    ?>

                    </div>
                </div>
            </div>
        </section>

    <?php
        endif;
    ?>

    <!-- Hero Section End -->

    <?php
        $key_features = get_field('key_features','option');
        if(!empty($key_features)):
    ?>

    <!-- Key Features Section -->

        <section class="key-features-section">
            <div class="ast-container">
                <div class="key-features-row">
                    <div class="ast-row">
                        <?php foreach($key_features as $feature):
                            $feature_text = $feature['feature'];
                        ?>
                        <div class="ast-col-md-3">
                            <div class="feature">
                                <span><?php echo $feature_text?></span>
                            </div>
                        </div>
                        <?php endforeach?>
                    </div>
                </div>
            </div>
        </section>
    
    <!-- Key Features Section End -->
    
    <?php endif;?>


    <?php
        $course_intro_section = get_field('course_intro_section');
        if(!is_array_empty($course_intro_section)):
            $page_navigation = $course_intro_section['page_navigation'];
            $navigation_title = $page_navigation['navigation_title'];
            $enrollment_cut_off_date_text = $page_navigation['enrollment_cut_off_date_text'];
            $next_enrollment_date = get_field('timer_expiry','option');
            $date = DateTime::createFromFormat('Y/m/d H:i:s', $next_enrollment_date);
            if ($date !== false) {
                $next_enrollment_date_formatted = $date->format('l, jS F Y');
            }
            $page_introduction = $course_intro_section['page_introduction'];
            $page_introduction_title = $page_introduction['title'];
            $page_introduction_desc = $page_introduction['description'];
            $show_total_enrollment = $course_intro_section['show_total_enrollment'];
            $students_enrolled_this_week = $course_intro_section['students_enrolled_this_week']??0;
    ?>

    <!-- Course Intro Section -->
        <section class="course-intro-section section-padding">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="course-intro-section-row">
                        <div class="ast-col-md-4">
                            <div class="page-navigation deposit-radio-container">
                                <h2 class="page-navigation__title">
                                    Get Started
                                </h2>
                                <?php if($show_total_enrollment && !empty($students_enrolled_this_week)):
                                    $product_sold = count_orders_with_product($course_product_id_new,7);
                                    if($product_sold){
                                        $product_sold_count = $product_sold['count']??0;
                                    }    
                                ?>
                                    <div class="student-enrolled-text">
                                        <b><?php echo ($students_enrolled_this_week + $product_sold_count).' students '?></b> enrolled in this course in last 7 days
                                    </div>
                                <?php endif?>
                                <?php if(!empty($next_enrollment_date_formatted)):?>
                                    <div class="enrollment-cutoff-date">
                                        <span>Next Enrolment Cut Off Date:<br></span>
                                        <span class="font-700">
                                            <?php echo $next_enrollment_date_formatted?>
                                        </span>
                                    </div>
                                <?php endif?>
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
                                            <img class="no-lazy" src="/wp-content/uploads/2024/11/Vector-107.svg" alt="">
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
                                <div class="enroll-now-link-btn <?php echo $is_virtual_course ? '':'enroll-now'?> <?php echo $current_cc?>">
                                    <a href="<?php echo $is_virtual_course ? '#timetable' : site_url('/cart/?addtimetocart&prid=' . $course_product_id); ?>" class="btn enroll-now-btn btn-centered enrol-btn btn-primary">
                                        Enrol Now
                                    </a>
                                </div>
                                <div class="select-menu quick-links-select">
                                    <div class="select-btn">
                                        <span class="sBtn-text">Quick Links</span>
                                        <img class="no-lazy" src="/wp-content/uploads/2022/01/down-arrow.svg" alt="">
                                    </div>

                                    <ul class="options">
                                        <li data-target="courseOutline" class="option">
                                            <img class="no-lazy" src="/wp-content/uploads/2024/11/arrow-right-gray.svg" alt="">
                                            <span class="option-text">Course Outline</span>
                                        </li>
                                        <li data-target="topBenefits" class="option">
                                            <img class="no-lazy" src="/wp-content/uploads/2024/11/arrow-right-gray.svg" alt="">
                                            <span class="option-text">Top Benefits</span>
                                        </li>
                                        <li data-target="courseModules" class="option">
                                            <img class="no-lazy" src="/wp-content/uploads/2024/11/arrow-right-gray.svg" alt="">
                                            <span class="option-text">Course Modules</span>
                                        </li>
                                        <li data-target="courseProspectus" class="option">
                                            <img class="no-lazy" src="/wp-content/uploads/2024/11/arrow-right-gray.svg" alt="">
                                            <span class="option-text">Course Prospectus</span>
                                        </li>
                                        <li data-target="teamSection" class="option">
                                            <img class="no-lazy" src="/wp-content/uploads/2024/11/arrow-right-gray.svg" alt="">
                                            <span class="option-text">Meet Academic Team</span>
                                        </li>
                                        <li data-target="certificatePreview" class="option">
                                            <img class="no-lazy" src="/wp-content/uploads/2024/11/arrow-right-gray.svg" alt="">
                                            <span class="option-text">Certificate Preview</span>
                                        </li>
                                        <li data-target="testimonials" class="option">
                                            <img class="no-lazy" src="/wp-content/uploads/2024/11/arrow-right-gray.svg" alt="">
                                            <span class="option-text">Testimonials</span>
                                        </li>
                                        <li data-target="faqs" class="option">
                                            <img class="no-lazy" src="/wp-content/uploads/2024/11/arrow-right-gray.svg" alt="">
                                            <span class="option-text">FAQ's</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                                if($current_course_id === 13680):
                            ?>
                                <img src="/wp-content/uploads/2024/08/employers_choice_240.png" alt="" class="emp-choice-logo">
                            <?php endif?>
                            <img src="/wp-content/uploads/2023/01/guaranteed-irish.svg" alt="" class="guaranteed-irish">
                        </div>
                        <div class="ast-col-md-8">
                            <div class="page-introduction">
                                <h2 class="large-heading page-introduction__title underlined-header"><?php echo $page_introduction_title?></h2>
                                <div class="page-introduction__desc">
                                    <?php echo $page_introduction_desc?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Course Intro Section End -->
    <?php
        endif;
    ?>

<?php
        $course_outline_section = get_field('course_outline_section');
        if(!is_array_empty($course_outline_section)):
            $section_title = $course_outline_section['section_title'];
            $outlines = $course_outline_section['outlines'];
            
            $accreditation = $is_level_5_diploma_course ? get_field('accreditations_level_5','option'):get_field('accreditations','option');
    ?>

    <!-- Course Outline Section -->
        <section id="courseOutline" class="section-padding-bottom course-outline-section">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-8">
                        <div class="course-outline-container">
                            <h2 class="large-heading underlined-header">
                                <?php echo $section_title?>
                            </h2>
                            <div class ="course-outline-accordion-container">
                                <?php
                                foreach($outlines as $index => $outline):
                                    $outline_title = $outline['title'];
                                    $outline_content  = $outline['description'];
                                ?>
                                    <div class="course-outline-accordion <?php echo $index===0?'active':''?>">
                                        <div class="course-outline-heading">
                                            <h4 class="course-outline-title"><?php echo $outline_title; ?></h4>
                                        </div>
                                        <div class="course-outline-content">
                                            <div class="course-outline-body"><?php echo $outline_content; ?></div>
                                        </div>
                                    </div>
                                <?php 
                                endforeach; 
                                ?>
							</div>
                        </div>
                    </div>
                    <?php if(!is_array_empty($accreditation)):
                        
                    ?>
                    <div class="ast-col-md-4">
                        <div class="accreditation-container">
                            <h2 class="large-heading text-center font-500">
                            Accreditation Partners
                            </h2>
                            <div class="accreditations">
                                <?php
                                    foreach($accreditation as $partner):
                                        $partner_logo = $partner['logo'];
                                        $partner_title = $partner['title'];
                                        $partner_link = $partner['link'];
                                        $country_icon = $partner['country_icon'];
                                ?>
                                    <div class="accred-partner">
                                        <?php 
                                            if(!empty($partner_link)):
                                        ?>
                                            <a target="_blank" href="<?php echo $partner_link?>" class="partner-link">
                                                <img class="no-lazy" src="<?php echo $partner_logo?>" alt="">
                                            </a>
                                        <?php 
                                            else:
                                        ?>
                                            <img class="no-lazy" src="<?php echo $partner_logo?>" alt="">
                                        <?php
                                            endif
                                        ?>
                                        <div class="acred-partner-title text-center">
                                            <span><?php echo $partner_title?></span>
                                            <img src="<?php echo $country_icon?>">
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <!-- Course Outline Section End -->
    <?php
        endif;
    ?>

    <?php

    if ($is_virtual_course) :
            include('includes/virtual-course-variation_new.php');
    endif;
    ?>

    <?php
        $top_benefits_section = get_field('top_benefits_section','option');
        if(!is_array_empty($top_benefits_section)):
            $section_title = $top_benefits_section['section_title'];
            $benefits = $top_benefits_section['benefits'];
    ?>
    <!-- Benefits Section -->
        <section id="topBenefits" class="section-padding-bottom top-benefits-section">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="large-heading text-center top-benefits-heading">
                            <?php echo $section_title?>
                        </h2>
                    </div>
                    <?php
                        foreach($benefits as $key => $benefit):
                            $benefit_icon = $benefit['icon'];
                            $benefit_title = $benefit['title'];
                            $benefit_desc = $benefit['description'];
                            if($key===2):
                    ?>
                        <div class="ast-col-md-12 column-gap"></div>
                    <?php
                            endif
                    ?>
                        <div class="ast-col-md-6">
                            <div class="benefit">
                                <div class="benefit-icon">
                                    <img class="no-lazy" src="<?php echo $benefit_icon?>" alt="">
                                </div>
                                <div class="benefit-details">
                                    <h4 class="benefits-details__title">
                                        <?php echo $benefit_title?>
                                    </h4>
                                    <div class="benefits-details__desc">
                                        <?php echo $benefit_desc?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        endforeach;
                    ?>
                </div>
            </div>
        </section>
    <!-- Benefits Section End -->
    <?php endif;?>

    <?php
        $certificate_preview_section = get_field('certificate_preview_section');
        if(!is_array_empty($certificate_preview_section)):
            $section_title = $certificate_preview_section['section_title'];
            $certificate_image = $certificate_preview_section['certificate_image'];
            $section_description = $certificate_preview_section['section_description'];
            $cta_buttons = $certificate_preview_section['cta_buttons'];
    ?>
    <!-- Certificate Preview Section -->
        <section id="certificatePreview" class="section-padding certificate-preview-sect">
            <div class="ast-container">
                <div class="certificate-preview-row">
                    <div class="ast-row">
                        <div class="ast-col-md-5">
                            <div class="certificate-image">
                                <img src="<?php echo $certificate_image?>" alt="">
                            </div>
                        </div>
                        <div class="ast-col-md-7">
                            <div class="certifate-preview-body">
                                <h2 class="large-heading font-500">
                                    <?php echo $section_title?>
                                </h2>
                                <div class="certificate-preview-body__desc">
                                    <?php echo $section_description?>
                                </div>
                                <div class="certificate-preview-buttons">
                                    <?php
                                        foreach($cta_buttons as $key => $button):
                                            $cta_link = $button['link'];
                                            $cta_label = $button['label'];
                                    ?>
                                    <a target="_blank" href="<?php echo $cta_link?>" class="btn btn-centered <?php echo $key===0?'btn-primary':'btn-outline'?>">
                                        <?php echo $cta_label?>
                                    </a>
                                    <?php
                                        endforeach
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Certificate Preview Section End -->
    <?php
        endif;
    ?>

    <?php
        $course_modules_section = get_field('course_modules_section');
        if(!is_array_empty($course_modules_section)):
            $section_title = $course_modules_section['section_title'];
            $modules = $course_modules_section['modules'];
            $course_completion_time = $course_modules_section['course_completion_time'];
            $course_study_time = $course_modules_section['course_study_time'];
    ?>
    <!-- Course Modules Section -->
        <section id="courseModules" class="section-padding-bottom course-modules-section">
            <div class="ast-container">
                <div class="course-modules-row">
                    <div class="ast-row">
                        <div class="ast-col-md-12">
                            <h2 class="large-heading underlined-header">
                                <?php echo $section_title?>
                            </h2>
                        </div>
                        <div class="course-modules-tab">
                            <div class="ast-col-md-6">
                                <div class="course-modules-tab__menu">
                                    <?php foreach($modules as $key => $module): 
                                        $module_title = truncate_string($module['module_title'], 6);
                                        if ($key % 4 == 0): ?>
                                            <div class="course-modules-tab__menu-row module-row">
                                        <?php endif; ?>
                                        
                                        <a href="#tab-<?php echo $key + 1 ?>" class="course-modules-tab__menu-link module-item <?php echo $key === 0 ? 'active' : '' ?>">
                                            <?php echo htmlspecialchars($module_title); ?>
                                        </a>
                                        
                                        <?php if ($key % 4 == 3 || $key == count($modules) - 1): ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <div class="progress"></div>
                                <div class="course-time">
                                    <div class="course-time__completion">
                                        <img src="/wp-content/uploads/2024/11/completion-time.svg" alt="">
                                        <span>Completion Time: <?php echo $course_completion_time?></span>
                                    </div>
                                    <div class="course-time__study">
                                        <img src="/wp-content/uploads/2024/11/study-time.svg" alt="">
                                        <span><?php echo $course_study_time?>Study Time</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ast-col-md-6">
                                <div class="course-modules-tab__content">
                                    <?php
                                        foreach($modules as $key => $module):
                                            $module_title = $module['module_title'];
                                            $module_content = $module['module_content'];
                                    ?>
                                        <div id="tab-<?php echo $key+1?>" class="tab-body course-module-tab-body <?php echo $key === 0?'active':''?>">
                                            <h4 class="course-module-tab-body__title"><?php echo $module_title?></h2>
                                            <div class="course-module-tab-body__content"><?php echo $module_content?></div>
                                        </div>
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Course Modules Section -->
    <?php
        endif;
    ?>

    <?php
        $cta_boxes = get_field('cta_boxes','option');
        if(!is_array_empty($cta_boxes)):
    ?>
    <!-- CTA Boxes Section  -->
        <section class="section-padding-bottom elt-salary-calc-section">
            <div class="ast-container">
                <div class="ast-row">
                    <?php
                        foreach($cta_boxes as $key => $box):
                            $title = $box['title'];
                            $summary = $box['summary'];
                            $button_text = $box['button_text'];
                            $button_link = $box['button_link'];
                    ?>
                        <div class="ast-col-md-6">
                            <div class="text-center cta-box cta-box-<?php echo $key+1?>">
                                <h3 class="cta-box__title font-700">
                                    <?php echo $title?>
                                </h3>
                                <div class="cta-box__summary">
                                    <?php echo $summary?>
                                </div>
                                <a href="<?php echo $button_link?>" class="btn btn-primary btn-centered">
                                    <?php echo $button_text?>
                                </a>
                            </div>
                        </div>
                    <?php
                        endforeach;
                    ?>
                </div>
            </div>
        </section>
    <!-- CTA Boxes Section End -->
    <?php
        endif
    ?>

    <?php
        $milestones = get_field('milestones','option');
        if(!is_array_empty($milestones)):
    ?>
    <!-- Milestones Section -->
        <section class="milestones-section">
            <div class="ast-container">
                <div class="milestones-row">
                    <div class="ast-row">
                        <?php
                            foreach($milestones as $key => $milestone):
                                $milestone_title = $milestone['title'];
                                $milestone_desc = $milestone['description'];
                        ?>
                            <div class="ast-col-md-3">
                                <div class="milestone">
                                    <h3 class="milestone-title text-white large-heading text-center"><?php echo $milestone_title?></h3>
                                    <div class="milestone-description text-center">
                                        <?php echo $milestone_desc?>
                                    </div>
                                </div>
                            </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <!-- Milestones Section End -->
    <?php
        endif;
    ?>

    <?php
        
        if(!is_array_empty($guides_prospectus_section)):
            $guide = $guides_prospectus_section['guide'];
            $prospectus = $guides_prospectus_section['prospectus'];
    ?>
    <!-- Guide CTA Section -->
        <section id="courseProspectus" class="section-padding guides-prospectus-section">
            <div class="ast-container">
                <div class="guides-prospectus-row">
                    <div class="ast-row">
                        <?php
                            if(!empty($guide)):
                                $title = $guide['title'];
                                $summary = $guide['summary'];
                                $image = $guide['image'];
                                $cta_label = $guide['cta_label'];
                                $cta_link = $guide['cta_link'];
                        ?>
                            <div class="ast-col-md-6">
                                <div class="guide-card">
                                    <div class="guide-card__left">
                                        <img src="<?php echo $image?>" alt="">
                                    </div>
                                    <div class="guide-card__right">
                                        <h3 class="guide-card-title">
                                            <?php echo $title?>
                                        </h3>
                                        <div class="guide-card-summary equal-height-cta">
                                            <?php echo $summary?>
                                        </div>
                                        <a href="<?php echo $cta_link?>" class="btn guide-cta-btn btn-primary btn-centered">
                                            <?php echo $cta_label?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                            endif;
                        ?>

                        <?php
                        if(!empty($prospectus)):
                                $title = $prospectus['title'];
                                $summary = $prospectus['summary'];
                                $image = $prospectus['image'];
                                $cta_label = $prospectus['cta_label'];
                                $cta_link = $prospectus['cta_link'];
                        ?>
                            <div class="ast-col-md-6">
                                <div class="prospectus-card">
                                    <div class="prospectus-card__left">
                                        <h3 class="prospectus-card-title">
                                            <?php echo $title?>
                                        </h3>
                                        <div class="prospectus-card-summary equal-height-cta">
                                            <?php echo $summary?>
                                        </div>
                                        <a href="<?php echo $cta_link?>" class="btn prospectus-cta-btn btn-primary btn-centered">
                                            <?php echo $cta_label?>
                                        </a>
                                    </div>
                                    <div class="prospectus-card__right">  
                                        <img src="<?php echo $image?>" alt="">
                                    </div>
                                </div>
                            </div>
                        <?php
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <!-- Guide CTA Section -->
    <?php
        endif;
    ?>

    <?php
        $team_section = get_field('team_section','option');
        if(!is_array_empty($team_section)):
            $section_title = $team_section['section_title'];
            $members = $team_section['team_members'];
    ?>
    <!-- Team Section -->
        <section id="teamSection" class="section-padding team-section">
            <div class="ast-container">
                <div class="team-section-row">
                    <div class="ast-row">
                        <div class="ast-col-md-12">
                            <h2 class="team-section-heading large-heading underlined-header text-center">
                                <?php echo $section_title ?>
                            </h2>
                        </div>
                    </div>
                    <div id="team-members-slider" class="splide team-members-slider">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php foreach($members as $key => $member):
                                    $image = $member['image'];
                                    $full_name = $member['full_name'];
                                    $designation = $member['designation'];
                                    $description = $member['description'];
                                    $name_parts = explode(' ', $full_name);
                                    $first_name = $name_parts[0] ?? $full_name;
                                ?>
                                    <li class="splide__slide">
                                        <span><?php echo $first_name . ', ' . $designation ?></span>
                                        <div class="member-image member-image-<?php echo $key + 1 ?>">
                                            <img class="no-lazy" src="<?php echo $image ?>" alt="<?php echo $full_name; ?>">
                                        </div>
                                    </li>
                                    <li class="splide__slide">
                                        <div class="member-details member-details-<?php echo $key + 1 ?>">
                                            <div class="member-details__summary">
                                                <?php echo $description ?>
                                            </div>
                                            <div class="member-name-desg-wrapper">
                                                <h4 class="member-details__name font-700">
                                                    <?php echo $full_name ?>
                                                </h4>
                                                <h4 class="member-details__designation font-400">
                                                    <?php echo $designation ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Team Section End -->
    <?php endif; ?>

    <!-- Verified Student Reviews -->
    <?php
        $verified_reviews_section = get_field('verified_reviews_section');
        if(!is_array_empty($verified_reviews_section)):
            $section_stitle = $verified_reviews_section['section_subtitle'];
            $section_title = $verified_reviews_section['section_title'];
            $total_reviews_count    = isset($reviews_widget['total_reviews']) ? $reviews_widget['total_reviews']: 1671;
            $five_star_percentage   = isset($reviews_widget['star_percentage_5']) ? (float)$reviews_widget['star_percentage_5'] : 0;
            $four_star_percentage   = isset($reviews_widget['star_percentage_4']) ? (float)$reviews_widget['star_percentage_4'] : 0;
            $three_star_percentage  = isset($reviews_widget['star_percentage_3']) ? (float)$reviews_widget['star_percentage_3'] : 0;
            $two_star_percentage    = isset($reviews_widget['star_percentage_2']) ? (float)$reviews_widget['star_percentage_2'] : 0;
            $one_star_percentage    = isset($reviews_widget['star_percentage_1']) ? (float)$reviews_widget['star_percentage_1'] : 0;
            
            $reviews_average = (($five_star_percentage * 5) + ($four_star_percentage * 4 ) + ($three_star_percentage * 3) + ($two_star_percentage * 2) + ($one_star_percentage * 1 ))/100;
    ?>
    
        <section class="verified-student-reviews-section">
            <div class="ast-container">
                <div class="ast-row ">
                    <div class="verified-student-reviews-section__header">
                        <div class="ast-col-md-6">
                            <div class="header-wrapper">
                                <h2 class=" common-section-heading">
                                    <?php echo $section_title?>
                                </h2>
                            </div>
                            <span class="verified-student-reviews-section__subtitle">
                                <?php echo $section_stitle?>
                            </span>
                        </div>
                        <div class="ast-col-md-6">
                            <div class="verified-student-reviews-section__header-right">
                                <a target="_blank" href="https://search.google.com/local/reviews?placeid=ChIJaeBYjIqxe0gR8IEtXkiDSWo" class="btn-primary btn">
                                    <span>View All Reviews</span>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                                <div class="reviews-average">
                                    <div class="rating-div">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-empty"></i>
                                        
                                    </div>
                                    <div class="total-count-text"><span class="course-review-count">(<?php echo $reviews_average; ?>)</span> Out of <?php echo $total_reviews_count ?> global reviews</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="spacer-column"></div>
                <div class="ast-row verified-student-reviews-section__row">
                    <div class="verified-student-reviews-section__row">
                        <div class="ast-col-md-5">
                            <div class="verified-student-reviews-section__review-summary">
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
                            <div class="rplg rplg-insert" data-id="77247"></div>
                        </div>
                        <div class="ast-col-md-7 verified-student-reviews-section__slider">
                            <?php echo do_shortcode('[brb_collection id="77247"]'); ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    <?php
        endif
    ?>
    <!-- Verified Student Reviews End -->

    <!-- Video Testimonials Section -->
    <?php
        $video_testimonials_section = get_field('video_testimonials_section',90386);
        if(!is_array_empty($video_testimonials_section)):
            $section_stitle = $video_testimonials_section['section_subtitle'];
            $section_title = $video_testimonials_section['section_title'];
            $testimonials = $video_testimonials_section['testimonials'];
    ?>
        <section id="testimonials" class="video-testimonials-section section-padding">
            <div class="ast-container">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h2 class="common-section-heading video-testimonials-section__title text-center">
                            <?php echo $section_title?>
                        </h2>
                        <div class="video-testimonials-section__subtitle font-500 common-subheading text-center">
                            <?php echo $section_stitle?>
                        </div>
                    </div>
                </div>
                <div class="spacer-column"></div>
                <div class="video-testimonials__slider splide">
                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev">
                            <i class="fa fa-arrow-left"></i>
                        </button>
                        <button class="splide__arrow splide__arrow--next">
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php
                                foreach($testimonials as $testimonial):
                                    $thumbnail = $testimonial['thumbnail'];
                                    $name = $testimonial['name'];
                                    $designation = $testimonial['designation'];
                                    $video_link = $testimonial['video_link'];
                                    $title = $testimonial['title'];
                            ?>
                                <li class="splide__slide">
                                    <div class="video-testimonial-card">
                                        <div class="video-testimonial-card_image-container">
                                            <img src="<?php echo $thumbnail?>" alt="" class="video-testimonial-card__image">
                                        </div>
                                        <div class="video-testimonial-card_content">
                                            <span class="video-testimonial-card__title">
                                                <?php echo $title?>
                                            </span>
                                            <h3 class="video-testimonial-card__name font-600 small-heading">
                                                <?php echo $name?>
                                            </h3>
                                            <span class="video-testimonial__subtitle font-400">
                                                <?php echo $designation?>
                                            </span>
                                            <a href="<?php echo $video_link?>" data-lity class="btn btn-primary">
                                                <span>Watch Now</span>
                                                <img src="/wp-content/uploads/2024/10/play-btn-white.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                
                            <?php
                                endforeach
                            ?>
                        </ul>
                    </div>
                
                </div>
            </div>
        </section>
    <?php
        endif;
    ?>
    <!-- Video Testimonials Section End -->
    
    <?php
        $offer_banner = get_field('offer_banner','option');
        if(!is_array_empty($offer_banner)):
            $banner_image = $offer_banner['banner_image'];
            $offer_text = $offer_banner['offer_text'];
            $banner_button_text = $offer_banner['banner_button_text'];
    ?>
        <section class="offer-banner-section">
            <div class="ast-container">
                <div class="offer-banner-row">
                    <div class="ast-row ast-flex">
                        <div class="ast-col-md-3">
                            <div class="offer-banner-logo text-center">
                                <img src="<?php echo $banner_image?>" alt="">
                            </div>
                        </div>
                        <div class="ast-col-md-6">
                            <div class="offer-banner-clock">
                                <span class="font-700 offer-banner-text">
                                    <?php echo $offer_text?>
                                </span>
                                <?php //if (!in_array($current_course_id, $excluded_courses_from_sale)) : ?>
                                    <?php echo do_shortcode('[flip_countdown_timer]'); ?>
                                <?php //endif; ?>
                            </div>
                        </div>
                        <div class="ast-col-md-3 text-center">
                            <a href="#" class="btn font-700 offer-banner-btn btn-centered btn-outline">
                                <?php echo $banner_button_text?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
        endif;
    ?>

    <!-- FAQS Section -->
    <section id="faqs" class="faqs-section faqs-section-redesigned section-padding">
        <?php
        $frequently_asked_questions = get_cfvalue_by_country('frequently_asked_questions');
        ?>
        
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <h2 class=" faqs-heading common-section-heading">
                        faqs
                    </h2>
                </div>
                <div class="ast-col-md-8 faqs">
                    
                    <div class="faqs-wrapper equal-height">
                        <div class="faqs-accordion">
                            <?php
                            foreach ($frequently_asked_questions as $key => $faq) :
                                $faq_answer = $faq['answer'];
                                $faq_question = $faq['question'];
                            ?>
                                <div class="faqs-accordion__item <?php echo $key === 0 ? 'active' : '' ?>">
                                    <input type="radio" id="acc-<?php echo $key ?>" name="faq-accordion" <?php echo $key === 0 ? 'checked' : '' ?> hidden>
                                    <label class="font-700" for="acc-<?php echo $key ?>">
                                        <span><?php echo $faq_question ?></span>
                                        <i class="fa fa-plus"></i>
                                    </label>
                                    <div class="font-500 faqs-accordion__content <?php echo $key === 0 ? 'active' : '' ?>">
                                        <?php echo $faq_answer ?>
                                    </div>
                                </div>
                            <?php
                            endforeach
                            ?>

                        </div>
                        <div class="show-more-faqs">
                            <span>Show More Faqs</span>
                        </div>
                    </div>
                </div>
                <div class="ast-col-md-4">
                    <div class="app-download-container equal-height" style="background:url('/wp-content/uploads/2024/10/app_download.png')">
                        <h4>STUDY ON THE GO</h4>
                        <span>Download the app</span>
                        <div class="app-download-cta__icons flex-box">
                            <a href="https://play.google.com/store/apps/details?id=com.teflinstitute.teflinstitute">
                                <img src="/wp-content/uploads/2021/08/google-play-logo-1.svg">
                            </a>
                            <a href="https://apps.apple.com/app/id1568312366">
                                <img src="/wp-content/uploads/2021/08/apple-logo-1.svg">
                            </a>
                        </div>
                        <div class="donwload-icon text-center font-600">
                            <span>Download App</span>
                            <img src="/wp-content/uploads/2024/10/donwload_icon.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQS Section End -->

    <!-- Search Courses -->

    <section class="tefl-search-section section-padding-bottom">
        <div class="ast-container">
            <div class="tefl-search">
                <h2 class=" common-section-heading tefl-search-section__title text-center">
                Find The Best TEFL Course For You:
                </h2>
                <?php echo do_shortcode('[tefl_course_search]'); ?>
            </div>
        </div>
    </section>

    <!-- Search Courses End -->

</div>