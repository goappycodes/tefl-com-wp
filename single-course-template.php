<div id="primary" <?php astra_primary_class(); ?>>

    <!--Banner Section-->

    <?php
    $course_product_id = get_field('course_product');
    $course_product = new WC_Product($course_product_id);
    $course_price = $course_product->get_price_html();
    $course_price_value = $course_product->get_price();
    $full_price = $course_price_value;

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
    $deposit_class = '';
    if ($deposit_payment_plan) :
        $deposit_class = "deposit-full-price payment-plan-".$deposit_payment_plan;
    endif;
    $query = "SELECT amount FROM `wp_wc_deposits_payment_plans_schedule` WHERE `schedule_index` = 0 AND `plan_id` = ".$deposit_payment_plan;
    $deposit_percent = $wpdb->get_var($query);
    $deposit_percent = round((float)$deposit_percent / 100, 5);

    if (ENABLE_99 && ($deposit_payment_plan == 6 || $deposit_payment_plan == 7 )){
        $fixed_99 = true;        
    } else {
        $fixed_99 = false;
    }
    $excluded_courses = get_field('excluded_courses', 'options');
    $excluded_courses = $excluded_courses ? $excluded_courses : [];
    ?>
    <?php
    if ($course_product_id) {
    ?>
        <script type="application/ld+json">
             {
		  "@context": "http://schema.org",
		  "hasCourseInstance": {
    		"@type": "CourseInstance",
    		"courseMode": "Online"
  			},
		  "@type": "Course",
		  "name": "<?php echo get_the_title(); ?>",
		  "description": <?php echo json_encode($CTA_txt); ?>,
		  "url": "<?php echo get_the_permalink(); ?>",
		  "timeRequired": "PT<?php echo get_field('time_required') ? get_field('time_required') : 30; ?>H",
		  "offers": {
			"@type": "Offer",
			"price": "<?php echo $course_price_value; ?>",
			"priceCurrency": "<?php echo get_woocommerce_currency(); ?>",
			"validFrom": "<?php echo date('y-m-d');?>"
		  },
		  "typicalAgeRange": "16+",
		  "inLanguage": "en-US",
		  "provider": {
			"@type": "Organization",
			"name": "The TEFL Institute",
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
    <?php $enable_yoga_course = get_field('enable_yoga_course', 'options'); ?>

    <section class="banner-section" style="background-image:url('<?php echo $banner_img ?>')">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-lg-6 ast-col-md-8 formobile">
                    <div class="banner-content-block">
                        <div class="content-block">
                            <h1>
                                <?php echo $CTA_title; ?>
                                <div class="tution-fee">
                                    <p id="priceWrapper" class="tution-fee-txt">Tuition Fee: <span data-isfixed99 = "<?php echo $fixed_99; ?>" data-depositpercent = "<?php echo $deposit_percent?>" class="full-price <?php echo $deposit_class; ?>"><?php echo $course_price; ?></span>
                                    </p>
                                    <?php 
                                        $free_offer_text = get_field('free_offer_text');
                                        if(!empty($free_offer_text)):?>
                                        <div class="free-offer-text">
                                            <?php echo $free_offer_text?>
                                        </div>
                                    <?php endif?>
                                    <div class="deposit-breakdown">
                                        <?php if ($deposit_payment_plan) : ?>
                                            <?php include('includes/ti-deposit-form.php'); ?>
                                            <?php wp_enqueue_script('ti-deposit-form-js'); ?>
                                        <?php endif; ?>
                                        <?php 
                                        if( $deposit_enabled == 'forced' || $deposit_enabled == 'optional' ):
                                        ?>
                                            <div class="installments-breakdown">
                                                <div
                                                    class="ajax-snippet" 
                                                    data-snippet="installment_breakdown"
                                                    data-objectid="<?php echo $course_product_id; ?>"
                                                >
                                                </div>
                                                <div id="loader" class="loader">
                                                Fetching installment breakdown details <img src="/wp-content/uploads/2022/11/loading-yellow.gif" alt="fetching deposit details">
                                                </div>
                                            </div>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </h1>
                            
                            <?php echo $CTA_txt ?>

                            <?php if (is_single(array('836', '838', '743', '825', '2704'))) { ?>
                                <img class="floating-logo" src="/wp-content/uploads/2021/10/Highfield-badge-TII-2.png">
                            <?php } else { ?>
                                <img class="floating-logo" src="/wp-content/uploads/2020/11/Group-57.svg">
                            <?php } ?>
                            <?php if ($enable_yoga_course) :
                                $yoga_course_text = get_field('yoga_course_text', 'options');
                                if ($yoga_course_text) : ?>
                                    <div class="yoga-course-section">
                                        <span class="bonus-course">Bonus Course!</span>
                                        <div class="yoga-course-text">
                                            <img src="/wp-content/uploads/2022/03/yoga_icon.png">
                                            <?php echo $yoga_course_text; ?>
                                        </div>
                                    </div>
                            <?php endif;
                            endif; ?>

                        </div>
                        <div class="banner-buttons">
                            <a class="callback-btn" href="/callback"><?php echo  $btn1_txt ?> <i class="fa fa-angle-right"></i></a>
                            <?php if ($is_virtual_couse) : ?>
                                <a class="ti-enroll-btn" href="#timetable"><?php echo  $btn2_txt ?> <i class="fa fa-angle-right"></i></a>
                            <?php else : ?>
                                <a class="ti-enroll-btn enroll-now-btn" rel="nofollow" href="<?php echo get_home_url(); ?>/?addtimetocart&prid=<?php echo $course_product_id; ?>"><?php echo  $btn2_txt ?>
                                    <i class="fa fa-angle-right"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($freebies) { ?>
                        <div class="freebies">
                            <div class="freebies-container">
                                <?php
                                $zoom_classes = $freebies['zoom_classes'];
                                $show = $zoom_classes['show']; ?>
                                <?php if ($show) { ?>
                                    <div class="freebie">
                                        <?php
                                        $product = $zoom_classes['product'];
                                        $product_id = wc_get_product($product);
                                        //$regular_product = $product_id->get_regular_price();
                                        $regular_product = $product_id->get_price_html();
                                        ?>
                                        <!-- <div class="price">Worth <span><?php //echo get_woocommerce_currency_symbol().$regular_product; 
                                                                            ?></span></div> -->
                                        <div class="price">Worth <span><?php echo $regular_product; ?></span></div>
                                        <img src="/wp-content/uploads/2021/11/zoom.png">
                                        <div class="content"><?php echo $zoom_classes['content']; ?></div>
                                    </div>
                                <?php } ?>
                                <?php $course = $freebies['course'];
                                $show = $course['show']; ?>
                                <?php if ($show) { ?>
                                    <div class="freebie">
                                        <?php
                                        $product = $course['product'];
                                        $product_id = wc_get_product($product);
                                        //$regular_product = $product_id->get_regular_price();
                                        $regular_product = $product_id->get_price_html();
                                        ?>
                                        <!-- <div class="price">Worth <span><?php //echo get_woocommerce_currency_symbol().$regular_product; 
                                                                            ?></span></div> -->
                                        <div class="price">Worth <span><?php echo $regular_product; ?></span></div>
                                        <img src="/wp-content/uploads/2021/11/laptop.png">
                                        <div class="content"><?php echo $course['content']; ?></div>
                                    </div>
                                <?php } ?>
                                <?php $guide = $freebies['guide'];
                                $show = $guide['show']; ?>
                                <?php if ($show) { ?>
                                    <div class="freebie">
                                        <?php
                                        $product = $guide['product'];
                                        $product_id = wc_get_product($product);
                                        //$regular_product = $product_id->get_regular_price();
                                        $regular_product = $product_id->get_price_html();
                                        ?>
                                        <!-- <div class="price">Worth <span><?php //echo get_woocommerce_currency_symbol().$regular_product; 
                                                                            ?></span></div> -->
                                        <div class="price">Worth <span><?php echo $regular_product; ?></span></div>
                                        <img src="/wp-content/uploads/2021/11/book.png">
                                        <div class="content"><?php echo $guide['content']; ?></div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!--/Banner Section-->

    <?php $black_bar_content = get_field('black_bar_content', 'options');  ?>

    <?php if ($black_bar_content) :
        $black_bar_content = $black_bar_content['content']; ?>
        <div class="divider-black-bar">
            <?php foreach ($black_bar_content as $bbc) :
                $bbc_icon = $bbc['icon'];
                $bbc_text = $bbc['text']; ?>
                <?php if ($bbc_icon && $bbc_text) : ?>
                    <div class="bar">
                        <div class="left-icon-img"><img src="<?php echo $bbc_icon; ?>"></div>
                        <?php echo $bbc_text; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php $below_black_bar_content = get_field('below_black_bar_content', 'options');  ?>
    <?php if ($below_black_bar_content) :
        $below_black_bar_content = $below_black_bar_content['content']; ?>
        <div class="divider-bar" style="display:none;">
            <?php foreach ($below_black_bar_content as $bbbc) :
                $bbbc_icon = $bbbc['icon'];
                $bbbc_text = $bbbc['text']; ?>
                <?php if ($bbbc_icon && $bbbc_text) : ?>
                    <div class="bar">
                        <div class="icon-img"><img src="<?php echo $bbbc_icon; ?>"></div>
                        <div class="text"><?php echo $bbbc_text; ?></div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php $below_black_bar_guarantee = get_field('below_black_bar_guarantee', 'options');  ?>

    <?php if ($below_black_bar_guarantee) : ?>
        <div class="below-black-bar-guarantee">
            <div class="img-container">
                <img src="/wp-content/uploads/2022/03/our-pledge.png">
            </div>
            <div class="content-container">
                <h6 class="centered syllabus section-heading">OUR PLEDGE<br>Risk Free Guarantee</h6>
                <div class="content"><?php echo $below_black_bar_guarantee; ?></div>
            </div>
        </div>
    <?php endif; ?>


    <section class="premier-course-details">
        <!-- radio input as tabs-->

        <?php
        $details_tabs = get_field('course_details_tabs');

        $test_card = $details_tabs['take_test_card'];

        $card_img = $test_card['card_image'];
        $card_title = $test_card['card_title'];
        $card_stitle = $test_card['card_subtitle'];
        $card_btn_txt = $test_card['card_button_text'];
        $card_button_link = $test_card['card_button_link'];

        $tab_content = $details_tabs['tab_contents'];

        $tab1 = $tab_content['tab1'];
        $tab1_title = $tab1['tab1_title'];
        $tab1_details = $tab1['tab1_details'];

        $tab2 = $tab_content['tab2'];
        $tab2_title = $tab2['tab2_title'];
        $tab2_details = $tab2['tab2_details'];
        $tab2_content = $tab2['tab2_content'];
        $tab2_show_second_content = $tab2['tab2_show_second_content'];
        $tab2_second_title = $tab2['tab2_second_title'];
        $tab2_second_content = $tab2['tab2_second_content'];

        $tab3 = $tab_content['tab3'];
        $tab3_title = $tab3['tab3_title'];
        $tab3_logos = $tab3['tab3_logos'];
        $tab3_details = $tab3['tab3_details'];

        $tab4 = $tab_content['tab4'];
        $tab4_title = $tab4['tab4_title'];
        $tab4_details = $tab4['tab4_details'];

        $tab5 = $tab_content['tab5'];
        $tab5_title = $tab5['tab5_title'];
        $tab5_details = $tab5['tab5_details'];

        if (is_subcountry_folder()) {
            $cc = strtolower(get_current_country());
            $tab5_faqs = $tab5['tab_5_rich_faq_' . $cc];
            if (!$tab5_faqs) {
                $tab5_faqs = $tab5['tab_5_rich_faq'];
            }
        } else {
            $tab5_faqs = $tab5['tab_5_rich_faq'];
        }

        $bonus_guide_tab = $tab_content['bonus_guide_tab'];
        $our_promise_tab = $tab_content['our_promise_tab'];
        ?>

        <div class="ast-container tab-head-container">
            <div class="ast-row">
                <div class="ast-col-lg-12" style="padding: 0;">
                    <h6 class="centered syllabus section-heading">COURSE SYLLABUS</h6>
                    <div class="tab-buttons">
                        <?php if (!empty($tab1_details)) : ?>
                            <input id="summ" name="tabs" data-tab-target="#summary" type="radio" checked>
                            <label class="tab-button" id="summid" for="summ"><img src="/wp-content/uploads/2020/11/summary.svg">what will i learn</label>
                        <?php endif; ?>

                        <?php if (!empty($tab2_content)) : ?>
                            <input id="course" name="tabs" data-tab-target="#course-content" type="radio">
                            <label class="tab-button" id="courseid" for="course"><img src="/wp-content/uploads/2020/11/course-content.svg">course content</label>

                        <?php endif; ?>
                        <?php if (!empty($tab3_details)) : ?>
                            <input id="accred" name="tabs" data-tab-target="#accreditation" type="radio">
                            <label class="tab-button" id="accredid" for="accred"><img src="/wp-content/uploads/2020/11/accred.svg">accreditation</label>

                        <?php endif; ?>
                        <?php if (!empty($tab4_details)) : ?>
                            <input id="why" name="tabs" data-tab-target="#whyus" type="radio">
                            <label class="tab-button" id="whyusid" for="why"><img src="/wp-content/uploads/2020/11/whyus.svg">why us</label>
                        <?php endif; ?>

                        <?php if (!empty($tab5_details)) : ?>
                            <input id="faq" name="tabs" data-tab-target="#faqs" type="radio">
                            <label class="tab-button" id="faqsid" for="faq"><img src="/wp-content/uploads/2020/11/faqs.svg">faqs</label>
                        <?php endif; ?>

                        <?php if (!empty($bonus_guide_tab)) : ?>
                            <input id="bonusguide" name="tabs" data-tab-target="#bonus_guide" type="radio">
                            <label class="tab-button" id="bonusguideid" for="bonusguide"><img src="/wp-content/uploads/2020/11/course-content.svg">bonus guides</label>
                        <?php endif; ?>
                        <?php if (!empty($our_promise_tab)) : ?>

                            <input id="ourpromises" name="tabs" data-tab-target="#our_promises" type="radio">
                            <label class="tab-button" id="ourpromisesid" for="ourpromises"><img src="/wp-content/uploads/2020/11/accred.svg">our promise</label>
                        <?php endif; ?>

                        <!--tab contents as a two coulumn grid         -->
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-contents ast-container" style="padding-left: 0;">
            <div id="summary" data-tab-content class="tab-content ast-row active">
                <div class="tab-content__card ast-col-md-4 ast-col-sm-12 ast-col-xsm-12">
                    <div class="card-container bg-image" style="background-image:url('<?php echo  $card_img ?>')">
                        <div class="card-body">
                            <img class="card-icon" src="https://teflinstitute.com/wp-content/uploads/2022/01/test-icon.png">
                            <div class="card-body-content">
                                <h6 class="section-heading"><?php echo $card_title ?></h6>
                                <p>
                                    <?php echo $card_stitle ?>
                                </p>
                            </div>

                            <a class="btn" href="<?php echo $card_button_link; ?>" style="background-color:<?php echo $course_button_color ?>"><?php echo $card_btn_txt ?>
                                <i class="fa fa-angle-right" aria-hidden="true">
                                </i>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="tab-content__body ast-col-md-8 ast-col-sm-12 ast-col-xsm-12">
                    <div class="tab1-details">
                        <?php if ($tab1_title) : ?>
                            <h6 class="section-heading"><?php echo $tab1_title ?></h6>
                            <?php endif; ?>
                            <?php echo $tab1_details ?>
                    </div>
                    <div class="view-more"><span>View More <i class="fa fa-angle-down"></i></span></div>
                    <div class="view-less"><span>View Less <i class="fa fa-angle-up"></i></span></div>
                </div>
            </div>
            <div id="course-content" data-tab-content class="tab-content ast-row">
                <div class="tab-content__body ast-col-md-12">
                    <?php if ($tab2_title) { ?>
                        <h6 class="section-heading"><?php echo $tab2_title ?></h6>
                    <?php } ?>
                    <?php $i = 0; ?>
                    <?php if ($tab2_content) { ?>

                        <?php foreach ($tab2_content as $element) : ?>

                            <?php $modules_numbers = $element['modules_numbers']; ?>
                            <?php $modules_title = $element['modules_title']; ?>
                            <?php $modules_content = $element['modules_content']; ?>

                            <section class="accordion-container">
                                <input id="accordion-<?php echo $i ?>" name="accordion-1" type="checkbox" <?php if ($i === 0) { ?>checked<?php } ?>>
                                <label for="accordion-<?php echo $i ?>">
                                    <div style="background: white;margin: -15px 25px -22px -35px;height: 50px;display: inline-block;position: relative;text-align: center;border: 1px solid #000 !important;color: #000;overflow: auto;padding: 0 20px;width: 110px;line-height: 48px;">
                                        <?php echo $modules_numbers ?></div><?php echo $modules_title ?>
                                </label>
                                <article>
                                    <?php echo $modules_content ?>
                                </article>
                            </section>
                        <?php $i++;
                        endforeach; ?>
                    <?php } ?>
                    <?php if ($tab2_show_second_content == true) { ?>
                        <h6 class="section-heading second-section-heading"><?php echo $tab2_second_title ?></h6>
                        <?php foreach ($tab2_second_content as $element) : ?>

                            <?php $modules_numbers = $element['modules_numbers']; ?>
                            <?php $modules_title = $element['modules_title']; ?>
                            <?php $modules_content = $element['modules_content']; ?>

                            <section class="accordion-container">
                                <input id="accordion-<?php echo $i ?>" name="accordion-1" type="checkbox" <?php if ($i === 0) { ?>checked<?php } ?>>
                                <label for="accordion-<?php echo $i ?>">
                                    <div style="background: white;margin: -15px 25px -22px -35px;height: 50px;display: inline-block;position: relative;text-align: center;border: 1px solid #000 !important;color: #000;overflow: auto;padding: 0 20px;width: 110px;line-height: 48px;">
                                        <?php echo $modules_numbers ?></div><?php echo $modules_title ?>
                                </label>
                                <article>
                                    <?php echo $modules_content ?>
                                </article>
                            </section>
                        <?php $i++;
                        endforeach; ?>

                    <?php } ?>
                </div>

            </div>
            <div id="accreditation" data-tab-content class="tab-content ast-row">
                <div class="tab-content__body ast-col-md-12">
                    <?php if ($tab3_title) { ?>
                        <h6 class="section-heading"><?php echo $tab3_title ?></h6>
                    <?php } ?>
                    <div class="accreditation-tab-content">
                        <div class="section-logos">
                            <?php foreach ($tab3_logos as $element) :
                                $logo = $element['logo']; ?>
                                <img src="<?php echo $logo ?>">
                            <?php endforeach; ?>
                        </div>
                        <div class="section-content">
                            <div class="tab3-details">
                                <?php echo $tab3_details ?>
                            </div>
                            <div class="view-more"><span>View More <i class="fa fa-angle-down"></i></span></div>
                            <div class="view-less"><span>View Less <i class="fa fa-angle-up"></i></span></div>
                        </div>
                    </div>
                </div>

            </div>
            <?php if (!empty($tab4_details)) : ?>
                <div id="whyus" data-tab-content class="tab-content ast-row">
                    <div class="tab-content__body ast-col-md-12">
                        <?php if ($tab4_title) { ?>
                            <h6 class="section-heading"><?php echo $tab4_title ?></h6>
                        <?php } ?>
                        <p>
                            <?php echo $tab4_details ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($tab5_details)) : ?>
                <div id="faqs" data-tab-content class="tab-content ast-row">
                    <div class="tab-content__body ast-col-md-12">
                        <?php if ($tab5_title) { ?>
                            <h6 class="section-heading"><?php echo $tab5_title ?></h6>
                        <?php } ?>
                        <?php if ($tab5_faqs) { ?>
                            <script type="application/ld+json">
                                {
                                    "@context": "https://schema.org",
                                    "@type": "FAQPage",
                                    "mainEntity": [
                                        <?php
                                        $faqcount = count($tab5_faqs);
                                        $counter = 0;
                                        foreach ($tab5_faqs as $tab5_faq) {
                                            $counter++;
                                        ?> {
                                                "@type": "Question",
                                                "name": <?php echo json_encode($tab5_faq['question']); ?>,
                                                "acceptedAnswer": {
                                                    "@type": "Answer",
                                                    "text": <?php echo json_encode($tab5_faq['answer']); ?>
                                                }
                                            }
                                        <?php
                                            if ($faqcount != $counter) echo ",";
                                        }
                                        ?>
                                    ]
                                }
                            </script>
                            <ul class="course-faq">
                                <?php
                                foreach ($tab5_faqs as $tab5_faq) {
                                ?>
                                    <li class="course-faq-single">
                                        <h6><?php echo $tab5_faq['question']; ?></h6>
                                        <span><?php echo $tab5_faq['answer']; ?></span>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        <?php } ?>

                        <p>
                            <?php echo $tab5_details ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($bonus_guide_tab)) : ?>
                <div id="bonus_guide" data-tab-content class="tab-content ast-row">
                    <div class="tab-content__body ast-col-md-12">
                        <!--<h6 class="section-heading"><?php echo $tab5_title ?></h6>-->
                        <p>
                            <?php echo $bonus_guide_tab; ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($our_promise_tab)) : ?>
                <div id="our_promises" data-tab-content class="tab-content ast-row">
                    <div class="tab-content__body ast-col-md-12">
                        <!--<h6 class="section-heading"><?php echo $tab5_title ?></h6>-->
                        <p>
                            <?php echo $our_promise_tab; ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

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

    <?php //if ($flexible_product) : 
    ?>
    <!--<div class="flexi-container">-->
    <!--    <a href="/cart/?add-to-cart=<?php //echo $flexible_product; 
                                        ?>" class="">Flexible booking - book now &amp; choose date later</a>-->
    <!--</div>-->
    <?php //endif; 
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
                            <h6 class="section-heading"><?php echo $section_heading?></h6>
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

    <?php if (have_rows('course_eligibility')) : ?>

        <!--who can take the course-->

        <section class="course-eligibility-details">
            <div class="ast-container">
                <div class="ast-row" style="background: #F2F2F2;">
                    <div class="ast-col-md-12">
                        <div class="course-eligibility-details-block ast-col-md-12">
                            <h6 class="section-heading">who can take the course</h6>
                            <?php if (have_rows('course_eligibility')) : ?>
                                <div class="eligibility-detail-content">
                                    <?php while (have_rows('course_eligibility')) : the_row(); ?>
                                        <div class="ast-col-md-3 ast-col-sm-6 ast-col-xsm-12 eligibility-detail">
                                            <div><img src="/wp-content/uploads/2020/11/tick.svg"></div>
                                            <p><?php the_sub_field('criteria'); ?></p>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>

                </div>
                <div class="divider">
                    <div>Online TEFL Courses</div>
                    <div class="center">100% online and available 24/7</div>
                    <div>97% pass rate</div>
                </div>
            </div>
        </section>

    <?php endif; ?>

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

    <!--verified student reviews-->
    
    <section class="students-review ast-container" style="padding:0;">
        <h6 class="section-heading">verified student reviews</h6>
        <?php
        //if(isset($_GET['debug'])): 
        include('includes/ti-reviews-functions.php');
        //endif;
        ?>
        <?php
        $review_banner = get_field('students_review_banner');
        if ($review_banner) { ?>
            <div class="review-banner" style="background-image:url('<?php echo $review_banner; ?>')"></div>
        <?php }
        ?>
        <?php echo do_shortcode('[brb_collection id="1150"]'); ?>

    </section>


    <?php $salary_calculator_bar = get_field('salary_calculator_bar', 'options');  ?>

    <?php if ($salary_calculator_bar) :
        $salary_bar_content = $salary_calculator_bar['bar_content'];
        $salary_button_content = $salary_calculator_bar['button_content'];
        $salary_button_url = $salary_calculator_bar['button_url']; ?>
        <div class="salary-black-bar">
            <?php if ($salary_bar_content && $salary_button_content && $salary_button_url) : ?>
                <div class="bar-icon"><img src="/wp-content/uploads/2022/12/black-laptop.svg"></div>
                <div class="bar-content"><?php echo $salary_bar_content; ?></div>
                <div class="bar-button"><a href="<?php echo $salary_button_url; ?>"><?php echo $salary_button_content; ?> <img src="https://teflinstitute.com/wp-content/uploads/2022/02/enter.png"><i class="fa fa-sign-in" style="display:none;"></i></a></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Courses Sales Section -->
    <?php
    $sale_courses = get_field('sale_courses');

    foreach ($sale_courses as $sc) :
        $course_image = $sc['course_image'];
        $course_logo = $sc['course_logo'];
        $course_title = $sc['course_title'];
        $course = $sc['course'];
        $course_link = get_post_permalink($course);
        $course_product_id = get_field('course_product', $course);
        $course_price = '';
        $add_to_cart_link = '';
        if ($course_product_id) {
            $course_product = wc_get_product($course_product_id);
            if ($course_product) {
                $course_price = $course_product->get_price_html();
                
            }
            $add_to_cart_link = site_url() . '/cart/?add-to-cart=' . $course_product_id;
        }
        $includes = $sc['includes'];
        $excludes = $sc['excludes'];
        $freebie_courses = $sc['freebie_courses'];
        $other_freebie = $sc['other_freebie'];
        $timer_expiry = '';
        $is_expired = true;
        if (!in_array($course_id, $excluded_courses)) {
            $timer_expiry     = get_field('timer_expiry', 'options');
            $date_today       = date('l, F d y h:i:s');
            $date_today_unix  = strtotime($date_today);
        }

        $time_diff = 0;
        if ($timer_expiry) {
            $course_offer_end_date = strtotime($timer_expiry);
            $current_time = current_time('timestamp');
            $time_diff = $course_offer_end_date - $current_time;
        }
        $is_expired = $time_diff < 0 ? true : false;  ?>

        <div class="<?php echo $course_id?> section tefl-section sale-courses-section">
            <div class="ast-row sale-courses-header-row">
                <div class="ast-col ast-col-md-12 section-header-col">
                    <div class="section-header">TEFL Offers</div>
                </div>
            </div>
            <div class="ast-row sale-courses-content-row">
                <div class="ast-col ast-col-md-4 course-detail-col">
                    <div class="course-detail-col-inner">
                        <?php if ($course_image) : ?>
                            <div class="course-img">
                                <img src="<?php echo $course_image; ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($course_logo) : ?>
                            <div class="course-logo">
                                <img src="<?php echo $course_logo; ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($course_title) : ?>
                            <h4 class="course-title"><?php echo $course_title; ?></h4>
                        <?php endif; ?>
                        <?php if ($course_price) : ?>
                            <div class="course-price"><?php echo $course_price; ?></div>
                        <?php endif; ?>
                        <?php if ($add_to_cart_link && $is_expired) : ?>
                            <div class="enroll-now-btn">
                                <a class="btn btn-primary dark-btn" rel="nofollow" href="<?php echo $add_to_cart_link; ?>">Enrol Now</a>
                            </div>
                        <?php else :   
                            if($timer_expiry):
                             if($date_today_unix<$course_offer_end_date):?>
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
                        endif;
                    endif; ?>
                    </div>
                </div>
                <div class="ast-col ast-col-md-4 course-inc-exc-col">
                    <?php if ($includes || $excludes) : ?>
                        <div class="inc-exc-inner">
                            <p class="inc-exc-title">What’s Included</p>
                            <div class="inc-exc-div">
                                <?php if ($includes) : ?>
                                    <?php foreach ($includes as $inc) :
                                        $inc_item = $inc['content']; ?>
                                        <div class="item inc-item"><img src="/wp-content/uploads/2021/11/Group-22.svg"><div><?php echo $inc_item; ?></div></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if ($excludes) : ?>
                                    <?php foreach ($excludes as $exc) :
                                        $exc_item = $exc['content']; ?>
                                        <div class="item exc-item"><img src="/wp-content/uploads/2021/11/Group-21-1.png"><div><?php echo $exc_item; ?></div></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="ast-col ast-col-md-4 freebie-col">
                    <?php if ($freebie_courses || $other_freebie || $course_link) : ?>
                        <div class="freebie-col-inner">
                            <p class="freebie-title">Free Resources</p>
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
                                            <div class="free-course-icon"><img src="<?php echo $free_course_icon; ?>"></div>
                                        <?php endif; ?>
                                        <?php if ($free_course_title) : ?>
                                            <p class="free-course-title"><?php echo $free_course_title; ?></p>
                                        <?php endif; ?>
                                        <?php if ($free_course_price) : ?>
                                            <div class="free-course-price"><?php echo $free_course_price; ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if ($other_freebie) : ?>
                                <div class="other-freebie-div">
                                    <?php foreach ($other_freebie as $of) :
                                        $other_freebie_icon = $of['icon'];
                                        $other_freebie_title = $of['title']; ?>
                                        <div class="other-freebie-div-inner">
                                            <?php if ($other_freebie_icon) : ?>
                                                <div class="other-freebie-icon">
                                                    <img src="<?php echo $other_freebie_icon; ?>">
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($other_freebie_title) : ?>
                                                <p class="other-freebie-title"><?php echo $other_freebie_title; ?></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( $add_to_cart_link) : ?>
                                <div class="learn-more-btn">
                                    <?php if ($is_virtual_couse) : ?>
                                    <a class="btn btn-primary dark-btn" href="#timetable">Enrol Now</a>
                                    <?php else: ?>
                                    <a class="btn btn-primary dark-btn" rel="nofollow" href="<?php echo $add_to_cart_link; ?>">Enrol Now</a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

    <!-- Courses Sales Section End -->

    <?php $certificate_review = get_field('certificate_review');
    if ($certificate_review) : ?>
        <!--certificate review-->
        <section class="certificate-review">

            <?php 
            $cert_img = $certificate_review['certificate_review_image'];
            $show_transcript = $certificate_review['show_certificate_transcript_image'];
            if($show_transcript){
                $transcript_img = $certificate_review['certificate_transcript'];
            }
            $cert_title = $certificate_review['certificate_review_title'];
            $cert_details = $certificate_review['certificate_review_details'];
            $buttons = $certificate_review['certificate_review_buttons'];
            if ($cert_img && $cert_title && $buttons) : ?>
                <div class="certificate-review__body ast-container">
                    <div class="ast-row">
                        <div class="ast-col-md-12" style="padding: 0;">
                            <div class="certificate-review-block">
                                <div class="ast-col-md-6 ast-col-sm-12 ast-col-xsm-12">
                                    <div class="certificate-review-block-content">
                                        <?php if ($cert_title) : ?>
                                            <h6 class="section-heading"><?php echo $cert_title ?></h6>
                                        <?php endif; ?>
                                        <div class="image-container ast-row">
                                            <div class="cert-image <?php echo $show_transcript?'ast-col-md-6':'ast-col-md-12'?>">
                                                <img src="<?php echo $cert_img ?>">
                                            </div>
                                        <?php if($show_transcript):?>
                                            <div class="cert-image ast-col-md-6">
                                                <img src="<?php echo $transcript_img ?>">
                                            </div>
                                        <?php endif?>
                                        </div>
                                        <?php if ($cert_details) : ?>
                                            <p><?php echo $cert_details ?></p>
                                        <?php endif; ?>
                                        <?php if ($buttons) : ?>
                                            <div class="btn-group">
                                                <?php foreach ($buttons as $button) :
                                                    $button_text = $button['button_text'];
                                                    $button_link = $button['button_link']; ?>
                                                    <a class="btn" href="<?php echo $button_link; ?>" target="_blank"><?php echo $button_text; ?>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                    </a>
                                                <?php endforeach; ?>
                                                <!--<a class="btn" href="#">preview your certificate-->
                                                <!--    <i class="fa fa-angle-right" aria-hidden="true"></i>-->
                                                <!--</a>-->
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="ast-col-md-6 ast-col-sm-12 ast-col-xsm-12 certificate_review-video-col" style="background: url('https://teflinstitute.com/wp-content/uploads/2021/12/Demo-video-1-1.jpeg');height: 480px;background-position: center;background-size: cover;">
                                    <a href="/video-masterclass" class="video-caption-link lity-video">
                                        <div class="vide-caption-box">
                                            <span class="video-caption-text">Diana | Video Masterclass</span>
                                            <span class="video-icon"><img src="/wp-content/uploads/2021/10/Play-button.svg"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <section class="accreditation">
        <h6 class="section-heading">TEFL Accreditation with The TEFL Institute</h6>
        <h6 class="section-heading" style="font-size: 1rem;margin-top: -1rem;">Ranked Number #1 TEFL Trainer by Schools
            and Employers Worldwide</h6>
        <div class="ast-container">
            <div class="ast-row ast-flex">
                <div class="ast-col-md-12">
                    <?php if (is_single(array('836', '838', '743', '825', '2704'))) {
                        $ofqual_section = get_field('ofqual_section', 'options');
                        $ofqual_img = $ofqual_section['image'];
                        $ofqual_content = $ofqual_section['content']; ?>
                        <div class="ofqual">
                            <?php if ($ofqual_img) : ?>
                                <img src="<?php echo $ofqual_img; ?>">
                                <?php //else: 
                                ?>
                                <!-- <img src="/wp-content/uploads/2020/12/1200px-Ofqual_logo_2018.svg-e1608720323794.png"> -->
                            <?php endif; ?>
                            <?php if ($ofqual_content) : ?>
                                <div><?php echo $ofqual_content; ?></div>
                                <?php //else: 
                                ?>
                                <!-- <div>
                                    Ofqual is responsible for regulating education standards, certifications and exams in England and Wales. TQUK is an Ofqual regulated awarding body who have approved The TEFL Org as a TQUK centre. A regulated Level 5 qualification means that it has been assessed to be a level 5 course according to Ofqual’s qualification framework. This qualification is of an equal level of achievement and difficulty to other qualifications at the same level, including CELTA and Trinity CertTESOL qualifications.
                                </div> -->
                            <?php endif; ?>
                        </div>
                    <?php } ?>
                    <div class="bottom-grid">
                        <?php $tefl_accreditation = get_field('tefl_accreditation');
                        $accred_img = $tefl_accreditation['image'];
                        $accred_title = $tefl_accreditation['title'];
                        $accred_subtitle = $tefl_accreditation['subtitle'];
                        if ($accred_img && $accred_title) : ?>
                            <div class="item">
                                <div class="image-box"><img src="<?php echo $accred_img; ?>"></div>
                                <div>
                                    <div><?php echo $accred_title; ?></div>
                                    <?php echo $accred_subtitle; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (is_single(array('836', '838', '743', '825', '2704'))) { ?>
                            <div class="item">
                                <div class="image-box"><img src="/wp-content/uploads/2021/11/Highfield-Qualifications-approved-centre-1024x374-1.jpeg">
                                </div>
                                <div>
                                    <div>Highfield</div>
                                    Approved center number: 21335
                                </div>
                            </div>
                        <?php } ?>
                        <!-- <div class="item">
                            <div class="image-box">
                                <img src="/wp-content/uploads/2022/01/TQUK-Logo-cropped.png">
                            </div>
                            <div>
                                <div>TQUK</div>
                                Approved centre number: C000854
                            </div>
                        </div> -->
                        <div class="item">
                            <div class="image-box">
                                <!-- <img src="/wp-content/uploads/2021/03/Screenshot-2021-03-16-at-15.52.39.png"> -->
                                <img src="/wp-content/uploads/2022/01/odlqc-logo-cropped.png">
                            </div>
                            <div>
                                <div>ODLQC</div>
                                (Open & Distance Learning Quality Council)
                            </div>
                        </div>
                        <div class="item">
                            <div class="image-box"><img src="/wp-content/uploads/2020/12/ACDL-Logo.png"></div>
                            <div>
                                <div>ACDL</div>
                                Accreditation number: 2854-2540
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php //if (!$is_virtual_couse) : 
    ?>
    <!--distance learning information-->
    <section class="distance-learning-info ast-container">
        <div class="ast-row ast-flex">
            <div class="ast-col-md-6 logo-container">
                <img src="<?php the_field('accreditation_image_1', 'option'); ?>">
                <img src="<?php the_field('accreditation_image_2', 'option'); ?>">
                <?php if (in_array(19, $course_category)) : ?>
                    <img src="<?php the_field('accreditation_image_3', 'option'); ?>">
                <?php endif; ?>
                <img src="<?php the_field('accreditation_image_4', 'option'); ?>">
            </div>
            <div class="ast-col-md-6 info-container">
                <h6 class="section-heading"><?php the_field('accreditation_heading', 'option'); ?></h6>
                <?php the_field('accreditation_body', 'option'); ?>
            </div>
        </div>
    </section>
    <?php //endif; 
    ?>

    <?php $course_benefits = get_field('course_benefits');
    if ($course_benefits) : ?>
        <!--course benefits-->
        <section class="course-benefits">
            <div class="logo-container">
                <img src="/wp-content/uploads/2021/01/Group-369.svg" height="100%" width="100%">
            </div>
            <div class="side-logos">
                <img src="/wp-content/uploads/2022/01/14-days-guarantee.png" height="100%" width="100%">
                <img src="/wp-content/uploads/2022/01/6-months-study-time.png" height="100%" width="100%">
            </div>
            <div class="ast-row benefits-row">
                <h6 class="section-heading">course benefits</h6>
                <div class="ast-col-md-12 ast-col-sm-12 benefits-list" style="padding:0">
                    <ul class="benefit-list">
                        <?php foreach ($course_benefits as $course_benefit) :
                            $benefit = $course_benefit['benefit']; ?>
                            <li class="benefit"><?php echo $benefit; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>


            </div>

        </section>
    <?php endif; ?>


    <?php if (have_rows('graduate_review_slider')) : ?>
        <!--graduates review slider-->
        <section class="graduate-review-slider">
            <h6 class="section-heading">What our graduates say</h6>
            <img src="/wp-content/uploads/2020/11/prev.svg" class="review-slider-prev">
            <img src="/wp-content/uploads/2020/11/next.svg" class="review-slider-next">
            <div class="slider-track">
                <div class="review-slider">

                    <?php if (have_rows('graduate_review_slider')) : ?>
                        <?php while (have_rows('graduate_review_slider')) : the_row(); ?>

                            <div class="review bg-image" style="background-image:url('<?php the_sub_field('review_slide_image'); ?>')">
                            <a href="<?php the_sub_field('review_slide_url'); ?>" data-lity class="slide-clickbox lity-video">    
                            <div class="review__footer">
                                    <a href="<?php the_sub_field('review_slide_url'); ?>" data-lity class="video-caption-link lity-video">
                                        <div class="play-btn">
                                            <img src="/wp-content/uploads/2020/11/play-btn.svg">
                                        </div>
                                        <span><?php the_sub_field('review_slide_title'); ?></span>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            </div>

        </section>
    <?php endif; ?>

    <!--course offers-->
    <?php $course_offer = get_field('course_offer');
    $side_col1 = $course_offer['side_col1'];
    $side_col2 = $course_offer['side_col2'];
    $mid_col = $course_offer['mid_col'];
    $class = 'three-columns';

    $side_col1_img = $side_col1['side_col1_icon'];
    $side_col1_title = $side_col1['side_col1_title'];
    $side_col1_stitle = $side_col1['side_col1_subtitle'];
    $side_col1_footer = $side_col1['side_col1_footer'];

    $mid_col_text = $mid_col['mid_col_text'];
    $btns = $mid_col['mid_col_buttons'];
    $btn1 = $btns['button1'];
    $btn1_text = $btn1['button1_text'];
    $btn1_link = $btn1['button1_link'];
    $btn2 = $btns['button2'];
    $btn2_text = $btn2['button2_text'];
    $btn2_link = $btn2['button2_link'];

    $side_col2_free = $side_col2['side_col2_free'];
    $side_col2_img = $side_col2['side_col2_icon'];
    $side_col2_title = $side_col2['side_col2_title'];
    $side_col2_stitle = $side_col2['side_col2_subtitle'];
    $side_col2_footer = $side_col2['side_col2_footer'];

    $current_course_id = get_the_ID();

    $timer_expiry = '';

    if (!in_array($current_course_id, $excluded_courses)) {
        $timer_expiry = get_field('timer_expiry', 'options');
    }

    if ($timer_expiry) {
        $course_offer_end_date = strtotime($timer_expiry);
        $current_time = current_time('timestamp');
        $time_diff = $course_offer_end_date - $current_time;
    }

    if ($time_diff < 0) :
        $price_class = 'sale_expires';
    else :
        $price_class = '';
    endif;

    if (($side_col2_img == '') && ($side_col2_title == '') && ($side_col2_stitle == '') && ($side_col2_footer == '')) {
        $class = 'two-columns';
    }

    if ($timer_expiry) {

        $timer_expiry_format = date("M d, Y H:i:s", strtotime($timer_expiry));  ?>

        <script>
            let searchParams = new URLSearchParams(window.location.search)
            const timer = () => {
                //set the date to countdown
                //const countDownDate = new Date("Dec 25, 2020 12:00:00").getTime();
                const countDownDate = new Date("<?php echo $timer_expiry_format; ?>").getTime();

                //update time each second

                const update = setInterval(() => {
                    //get time now and find differnce from countdown time

                    var now = new Date().getTime();
                    const diff = countDownDate - now;

                    //calculate time as days, hours months and second

                    if (diff > 0) {
                        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                        // if(searchParams.has('debug')){
                        //     alert("days: " + days + " hours: " + hours + " minutes: " + minutes + " seconds: " + seconds);

                        // }

                        //display timer
                        document.querySelector('#day').innerHTML = days;
                        document.querySelector('#hour').innerHTML = hours;
                        document.querySelector('#minute').innerHTML = minutes;
                        document.querySelector('#second').innerHTML = seconds;
                    } else {
                        document.getElementsByClassName('hascountdown')[0].style.display = 'none';
                        document.getElementsByClassName('hascountdown')[1].style.display = 'none';
                        document.getElementsByClassName('hascountdown')[2].style.display = 'none';
                        document.getElementsByClassName('salarycalculator-form')[0].style.display = 'block';
                        document.getElementsByClassName('mid-col')[0].style.background = 'black';

                    }
                }, 1000);
            }

            jQuery(document).ready(function($) {
                // timer();
            })
        </script>

    <?php }

    if (isset($_course_offer)) : ?>

        <section class="premier-course-offer <?php echo $class; ?>">

            <?php $salary_field = get_field('salary_calculator', 'options');
            $salary_bg_img = $salary_field['background_image'];
            $salary_heading = $salary_field['salary_heading'];
            $salary_text = $salary_field['salary_text'];
            $salary_button_text = $salary_field['salary_button_text'];
            $salary_button_url = $salary_field['salary_button_url']; ?>

            <?php if ($mid_col && $mid_col_text && $btns) : ?>
                <div class="mid-col">
                    <div class="salarycalculator-form" style="display:none; background-image:url('<?php echo $salary_bg_img; ?>');">
                        <div class="inner-div">
                            <h6 class="section-heading"><?php echo $salary_heading; ?></h6>
                            <p class="salary-text"><?php echo $salary_text; ?></p>
                            <a href="<?php echo $salary_button_url; ?>"><span><?php echo $salary_button_text; ?></span><i class="fa fa-angle-right"></i></a>
                        </div>
                        <!-- <div class="typeform-widget" style="width: 100%; height: 550px; margin: 0;" data-url="https://form.typeform.com/to/YoukGCVa" data-transparency="0" data-hide-footer="true"></div> -->
                        <!-- <script>
                            (function() {
                                var qs, js, q, s, d = document,
                                    gi = d.getElementById,
                                    ce = d.createElement,
                                    gt = d.getElementsByTagName,
                                    id = "typef_orm",
                                    b = "https://embed.typeform.com/";
                                if (!gi.call(d, id)) {
                                    js = ce.call(d, "script");
                                    js.id = id;
                                    js.src = b + "embed.js";
                                    q = gt.call(d, "script")[0];
                                    q.parentNode.insertBefore(js, q)
                                }
                            })()
                        </script> -->
                    </div>
                    <div class="mid-col__header hascountdown">
                        <h6 class="section-heading"><?php echo $mid_col_text . " " . $course_price; ?></h6>
                        <?php if ($timer_expiry) { ?>
                            <h5 class="offer-ends-timer">
                                Offer Ends on <br /><?php echo date("F j, Y, g:i a", strtotime($timer_expiry)); ?>
                            </h5>
                        <?php } ?>
                    </div>
                    <?php if ($timer_expiry) { ?>
                        <div class="mid-col__body hascountdown">
                            <ul class="timer">
                                <li>
                                    <span id="day"></span>
                                    <span id="day-text">days</span>
                                </li>
                                <li>
                                    <span id="hour"></span>
                                    <span id="hour-text">hours</span>
                                </li>
                                <li>
                                    <span id="minute"></span>
                                    <span id="minute-text">minutes</span>
                                </li>
                                <li>
                                    <span id="second"></span>
                                    <span id="second-text">seconds</span>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>

                    <div class="mid-col__btns hascountdown">
                        <a class="btn" href="/callback"><?php echo $btn1_text ?>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                        <!-- <a class="btn" href="<?php //echo $add_to_cart_url; 
                                                    ?>"><?php //echo $btn2_text 
                                                        ?>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a> -->
                        <?php if ($is_virtual_couse) : ?>
                            <a class="btn ti-enroll-btn" href="#timetable"><?php echo  $btn2_txt ?> <i class="fa fa-angle-right"></i></a>
                        <?php else : ?>
                            <a class="btn ti-enroll-btn enroll-now-btn" rel="nofollow" href="<?php echo get_home_url(); ?>/?addtimetocart&prid=<?php echo $course_product_id; ?>"><?php echo  $btn2_txt ?>
                                <i class="fa fa-angle-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($side_col1 && $side_col1_img && $side_col1_title && $side_col1_stitle && $side_col1_footer) : ?>
                <div class="side-col side-col1 ">

                    <div class="side-col__header">
                        accredited
                    </div>
                    <hr class="line">
                    <div class="side-col__body">
                        <div class="circular-logo">
                            <img src="<?php echo $side_col1_img ?>">
                        </div>
                        <h6 class="section-heading"><?php echo $side_col1_title ?></h6>
                        <p class="content-text">
                            <?php echo $side_col1_stitle ?>
                        </p>
                    </div>
                    <p class="footer-text">
                        <?php echo $side_col1_footer ?>
                    </p>
                </div>
            <?php endif; ?>

            <?php if (!is_single(array('822', '814', '820', '812', '816', '809'))) : ?>
                <?php if ($side_col2 && $side_col2_img && $side_col2_title && $side_col2_stitle) : ?>
                    <div class="side-col side-col2">
                        <div class="side-col__header">
                            <?php echo $side_col2_free ?>
                        </div>
                        <hr class="line">
                        <div class="side-col__body">
                            <!-- <div class="circular-logo" <?php if (is_single(array(47, 898, 745, 58, 832, 825, 2816))) { ?>style="width: 150px;display:none;"<?php } ?>>
                                <img src="<?php echo $side_col2_img ?>" <?php if (is_single(array(47, 898, 745, 58, 832, 825, 2816))) { ?>style="margin-top:-10px;"<?php } ?>>
                            </div> -->
                            <div class="circular-logo">
                                <img src="<?php echo $side_col2_img ?>">
                            </div>
                            <h6 class="section-heading"><?php echo $side_col2_title ?></h6>
                            <p class="content-text">
                                <?php echo $side_col2_stitle ?>
                            </p>
                        </div>
                        <p class="footer-text">
                            <?php echo $side_col2_footer ?>
                        </p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    <?php endif; ?>


    <section class="course-brochure-details" style="display: block;">
        <div class="ast-container">
            <div class="ast-row" style="background: #F2F2F2;">
                <div class="ast-col-md-12">
                    <div class="course-brochure-details-block ast-col-md-12">
                        <h6 class="section-heading">The TEFL Institute Explained: <span class="">TEFL Courses
                                Breakdown</span></h6>
                        <div class="section-paragraph">Your first steps to becoming a fully accredited, internationally
                            recognised EFL/ESL teacher within 4 weeks!</div>
                        <img src="https://teflinstitute.com/wp-content/uploads/2021/04/TEFL-Institute-Brochure-Download-Image-1_No-Shadow-1-min.png" class="section-image">
                        <div class="brochure-detail">
                            <!-- <a class="btn" href="https://teflinstitute.com/wp-content/uploads/2021/04/TEFL-Institute-Study-Prospectus-Interactive.pdf" target="_blank">Download Now
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </a> -->
                            <a class="btn" href="/tefl-brochure" target="_blank">Download Now
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="job-hunter-guide">
        <div class="ast-row">
            <div class="ast-col-md-6 ast-col-sm-12">
                <?php $guide = get_field('guide', 'option');
                if ($guide) :
                    $hunter_bg = $guide['guide_background'];
                    $hunter_title = $guide['guide_title'];
                    $hunter_subtitle = $guide['guide_subtitle'];
                    $hunter_img = $guide['guide_preview'];
                    $hunter_pdf_url = $guide['guide_download']; ?>
                    <div class="guide-left-outer" style="background-image: url('<?php echo $hunter_bg; ?>');">
                        <div class="guide-left">
                            <h6 class="section-heading"><?php echo $hunter_title; ?></h6>
                            <p class=""><?php echo $hunter_subtitle; ?></p>
                            <img class="hunter-guide-image" src="<?php echo $hunter_img; ?>">
                            <a class="hunter-button"><span>Download Now</span><i class="fa fa-angle-right"></i></a>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="ast-col-md-6 ast-col-sm-12">
                <?php $app = get_field('app', 'option'); ?>
                <div class="guide-right">
                    <h6 class="section-heading"><?php echo $app['app_title']; ?></h6>
                    <p class=""><?php echo $app['app_subtitle']; ?></p>
                    <img src="<?php echo $app['app_preview']; ?>">
                    <div class="stores">
                        <?php if ($app['app_google_play_store']) { ?>
                            <a href="<?php echo $app['app_google_play_store']; ?>">
                                <svg style="position: relative;top: 4px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 24.516 26.39" style="enable-background:new 0 0 24.516 26.39;" xml:space="preserve">
                                    <g id="Group_134" transform="translate(-718.252 -7871.596)">
                                        <path id="Path_99" d="M718.259,7884.838c0-3.847,0-7.695,0-11.543c-0.032-0.46,0.122-0.914,0.426-1.26   c0.13-0.139,0.223-0.176,0.383-0.013c2.589,2.642,5.182,5.28,7.779,7.914c1.68,1.707,3.362,3.412,5.046,5.115   c0.164,0.165,0.178,0.252,0.005,0.424c-4.126,4.103-8.246,8.212-12.361,12.327c-0.133,0.193-0.398,0.242-0.591,0.109   c-0.029-0.02-0.055-0.043-0.078-0.069c-0.411-0.317-0.639-0.816-0.609-1.334c0-2.278-0.002-4.557-0.005-6.836   c0-1.612,0-3.223,0-4.834L718.259,7884.838z" />
                                        <path id="Path_100" d="M719.738,7871.6c0.265-0.002,0.525,0.069,0.75,0.208c5.27,2.953,10.541,5.904,15.812,8.854   c0.242,0.135,0.237,0.211,0.05,0.4c-1.179,1.159-2.348,2.329-3.516,3.5c-0.127,0.126-0.2,0.2-0.372,0.027   c-4.193-4.276-8.389-8.548-12.589-12.816C719.838,7871.726,719.809,7871.684,719.738,7871.6z" />
                                        <path id="Path_101" d="M720.917,7897.7c3.825-3.867,7.648-7.733,11.469-11.6c0.237-0.241,0.347-0.209,0.559,0.012   c0.969,1.01,1.953,2.005,2.941,3c0.174,0.175,0.188,0.246-0.047,0.375c-4.911,2.688-9.819,5.38-14.724,8.077   C721.047,7897.606,720.981,7897.651,720.917,7897.7z" />
                                        <path id="Path_102" d="M742.768,7884.945c-0.01,0.389-0.208,0.749-0.531,0.966c-0.234,0.165-0.479,0.313-0.732,0.447   c-1.484,0.82-2.973,1.633-4.454,2.46c-0.142,0.117-0.352,0.097-0.469-0.045c-0.005-0.006-0.01-0.013-0.015-0.02   c-1.055-1.088-2.118-2.17-3.189-3.244c-0.155-0.156-0.16-0.242,0-0.4c1.247-1.228,2.487-2.461,3.72-3.7   c0.096-0.135,0.284-0.166,0.419-0.069c0.004,0.003,0.008,0.006,0.013,0.009c1.467,0.831,2.94,1.651,4.41,2.475   C742.402,7884.014,742.721,7884.446,742.768,7884.945z" />
                                    </g>
                                </svg>
                            </a>
                        <?php } ?>
                        <?php if ($app['app_apple_store']) { ?>
                            <a href="<?php echo $app['app_apple_store']; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 25.779 30" style="enable-background:new 0 0 25.779 30;" xml:space="preserve">
                                    <g id="Group_136" transform="translate(-766.219 -7867.791)">
                                        <path id="Path_103" d="M792,7889.8c-0.532,1.272-1.184,2.491-1.949,3.639c-1.266,1.927-3.05,4.327-5.26,4.347   c-1.965,0.018-2.469-1.279-5.134-1.264s-3.223,1.287-5.188,1.269c-2.21-0.021-3.9-2.188-5.166-4.114   c-3.54-5.389-3.91-11.712-1.727-15.074c1.34-2.23,3.701-3.65,6.3-3.787c2.343,0,3.816,1.285,5.753,1.285   c1.879,0,3.024-1.287,5.733-1.287c2.279,0.104,4.392,1.22,5.763,3.043c-3.186,1.763-4.34,5.776-2.577,8.962   C789.307,7888.192,790.531,7889.249,792,7889.8z" />
                                        <g id="Group_135">
                                            <path id="Path_104" d="M783.3,7872.661c1.12-1.362,1.646-3.117,1.46-4.87c-1.786,0.212-3.425,1.093-4.586,2.467    c-1.153,1.298-1.699,3.026-1.5,4.751C780.492,7874.968,782.193,7874.104,783.3,7872.661z" />
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="hunter_brochure">
        <div class="hunter_brochure_container">
            <span class="cross">&#x2716;</span>
            <div class="ast-row ast-flex hunter_brochure_row">
                <div class="ast-col-md-6 ast-col-sm-12 brochure-image">
                    <img src="<?php echo $hunter_img ?>">
                </div>
                <div class="ast-col-md-6 ast-col-sm-12 brochure_content_col">
                    <div class="brochure_content">
                        <div class="brochure-title"><?php echo $hunter_title ?></div>
                        <div class="brochure-content">
                            <?php echo $hunter_subtitle ?>
                        </div>
                    </div>
                    <div class="brochure_form">
                        <div class="brochure_form_inner">
                            <?php echo do_shortcode('[contact-form-7 id="7170" title="Job Hunter\'s Guide"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (have_rows('recommended_courses')) : ?>
        <!--recommended courses-->
        <section class="recommended-courses">
            <div class="ast-container-nopadding">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <h6 class="centered section-heading">VIEW RECOMMENDED TEFL COURSES</h6>
                        <div class="ast-row ast-flex courses-row">
                            <?php if (have_rows('recommended_courses')) : 
                                $count=1;    
                            ?>
                                <?php while (have_rows('recommended_courses')) : the_row(); ?>
                                    <div class="ast-col-lg-3 ast-col-md-3 course-col">
                                        <div class="course course1">
                                            <a href="<?php the_sub_field('button_link');?>" class="course-clickbox"></a>
                                            <div class="course__body">
                                                <img src="<?php the_sub_field('course_icon'); ?>">
                                                <h6 class=><?php the_sub_field('course_title'); ?>
                                            </div>
                                            <div class="course__cta">
                                                <a class="btn <?php echo $count <= 2?'btn-white':'btn-black'?>" href="<?php the_sub_field('button_link'); ?>"><?php the_sub_field('button_text'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                                    $count+=1;
                                    endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php endif; ?>

    <?php

    $webinar_args = array(
        'numberposts'     => 3,
        'post_type'       => 'webinar',
        'post_status'     => 'publish',
        'tax_query'       => array(
            array(
                'taxonomy'       => 'webinar_category',
                'field'          => 'slug',
                'terms'          => array('upcoming'),
            ),
        ),
        'meta_key'          => 'webinar_date',
        'orderby'           => 'meta_value_num',
        'order'             => 'ASC'
    );

    $webinars = get_posts($webinar_args);

    ?>
    <?php

    $webinarss = get_field('webinars', 2);

    $section_title  = $webinarss['section_title'];
    $button_text    = $webinarss['button_text'];
    $button_link    = $webinarss['button_link'];

    ?>

    <section class="webinar-section">
        <div class="ast-container">
            <div class="ast-row webinar-row">
                <div class="ast-col-lg-12 ast-col-md-12 ast-col-sm-12 ast-col-xs-12 webinar-col">
                    <h2 class="section-heading"><?php echo $section_title ?></h2>
                </div>
            </div>

            <?php if ($webinars) : 
                $total_webinars=count($webinars);
                if ($webinars) :
                    foreach ($webinars as $webinar) :
                        $webinar_id         = $webinar->ID;
                        $webinar_date       = get_field('webinar_date', $webinar_id);
                        if (strtotime($webinar_date) > time()) { 
                            $upcoming_webinar = $webinar;
                            break;
                        }
                    endforeach;
                endif;
            ?>
                <div class="ast-row webinar-row">
                    <?php if($upcoming_webinar): ?>
                        <?php
                        $webinar_id         = $upcoming_webinar->ID;
                        $webinar_title      = $upcoming_webinar->post_title;
                        $webinar_location   = get_field('webinar_location', $webinar_id);
                        $webinar_date       = get_field('webinar_date', $webinar_id);
                        $webinar_time       = get_field('webinar_time', $webinar_id);
                        $webinar_image      = get_the_post_thumbnail_url($webinar_id, 'full');
                        $webinar_link       = get_home_url() . '/upcoming-webinars/';
                        //$webinar_link       = get_post_permalink($webinar_id); 
                        ?>
                        <div class="ast-col-md-12 webinar-col" style="background:linear-gradient(90deg, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.75)), url('<?php echo $webinar_image; ?>')">
                        <div class="webinar-div">
                            <a href="<?php echo $button_link ?>" class="webinar-clickbox"></a>
                            <div class="webinar-div__content">
                                <h4 class="webinar-title"><?php echo $webinar_title; ?></h4>
                                <p class="webinar-location">LOCATION : <?php echo $webinar_location; ?></p>
                                <p class="webinar-date">DATE : <?php echo $webinar_date; ?></p>
                                <p class="webinar-time">TIME : <?php echo $webinar_time; ?> (UK TIME)</p>
                            </div>    
                            <a href="<?php echo $button_link ?>" class="btn-signup">
                                <div class="btn-signup__inner">
                                Sign Up
                                </div>
                            </a>      
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
                <div class="ast-row webinar-btn-row">
                    <a href="<?php echo get_home_url() . '/upcoming-tefl-webinars/'; ?>" class="btn-block-black">Register Now</a>
                </div>

            <?php endif; ?>
        </div>
    </section>

    <!--Complimentary Webinar Section End-->

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

            <section class="faq-section">
                <div class="ast-container">
                    <h6 class="centered section-heading">FAQS</h6>
                    <div class="ast-row faq-row">
                        <?php foreach ($faqs_post as $fq) : ?>
                            <?php
                            $faq_id = $fq->ID;
                            $faq_title = $fq->post_title;
                            $faq_img_url = get_the_post_thumbnail_url($faq_id, 'full');
                            $faq_content = apply_filters('the_content', $fq->post_content);
                            $faq_url = get_post_permalink($faq_id);
                            ?>
                            <div class="ast-col-lg-4 ast-col-sm-12 faq-col">
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
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <section class="why-teflinstitute-section">
            <div class="ast-container">
                <h6 class="centered section-heading">WHY TEFL INSTITUTE</h6>
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
                                <h6 class="why-ti-title">SUPPORT ABROAD WE’LL HELP GET YOU THERE</h6>
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
</div>
<!-- #primary -->
