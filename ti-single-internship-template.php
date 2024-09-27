<?php

/**
 * The template for displaying all single internship.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-internship
 *
 * @package Astra
 * @since 1.0.0
 */



if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
$clockdown = get_field('clockdown', 'option');
$internship_product_id = get_field('internship_product');
$internship_product = wc_get_product($internship_product_id);
$internship_price_html = '';
if ($internship_product) :
    $internship_price_html = $internship_product->get_price_html();
    $full_price = $internship_product->get_price(); 

    $deposit_enabled = get_post_meta($internship_product_id, '_wc_deposit_enabled', true);

    $deposit_payment_plan = '';

    if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional') {
        $deposit_payment_plan = get_post_meta($internship_product_id, '_wc_deposit_payment_plans', true);
        $deposit_payment_plan = $deposit_payment_plan[0];
    }
    $deposit_class = '';
    if($deposit_payment_plan): 
        $deposit_class = "deposit-full-price payment-plan-".$deposit_payment_plan;
    endif; 
    $query = "SELECT amount FROM `wp_wc_deposits_payment_plans_schedule` WHERE `schedule_index` = 0 AND `plan_id` = ".$deposit_payment_plan;
    $deposit_percent = $wpdb->get_var($query);
    $deposit_percent = round((float)$deposit_percent / 100, 5);
endif; 
$get_the_brochure = get_field('get_the_brochure');
$overview = get_field('overview');
$video = get_field('video');
$itinerary = get_field('itinerary');
$essential_information = get_field('essential_information');
$fully_inclusive_programme = get_field('fully_inclusive_programme');
$location = get_field('location'); 

$show_alerts = get_field('show_alerts');
$register_for_alerts_link = get_field('register_for_alerts_link');

$show_eligibility_checker = get_field('show_eligibility_checker');
$eligibility_checker = get_field('eligibility_checker');

?>



<div id="primary" <?php astra_primary_class(); ?>>

    <?php $banner = get_field('banner');

    if ($banner) :
        $banner_image = $banner['image'];
        $banner_icon = $banner['icon'];
        $banner_title = $banner['title'];
        $banner_desc = $banner['description'];
    endif; ?>

    <!-- Banner Section Start -->
    <?php if ($banner) : ?>
        <div class="section hero-section">
            <div class="ast-container hero-container">
                <div class="ast-row ast-flex hero-row">
                    <?php if ($banner_title || $banner_desc) : ?>
                        <div class="ast-col ast-col-md-6 ast-col-sm-12 hero-content-col">
                            <div class="content-div">
                                <?php if ($banner_title) : ?>
                                    <div class="banner-title">
                                        <h1 class="section-heading"><?php echo $banner_title; ?></h1>
                                    </div>
                                <?php endif; ?>
                                <?php if ($banner_desc) : ?>
                                    <div class="desc-div"><?php echo $banner_desc; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($banner_image) : ?>
                        <div class="ast-col ast-col-md-6 ast-col-sm-12 hero-img-col">
                            <div style="background-image: url('<?php echo $banner_image; ?>')"></div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($banner_icon) : ?>
                    <div class="ast-row ast-flex icon-row">
                        <div class="ast-col ast-col-md-12 ast-col-sm-12 icon-col">
                            <div class="icon-img-div" style="background-image: url(<?php echo $banner_icon; ?>);"></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <!-- Banner Section End -->

    <div class="ast-container internship-content-container">
        <div class="ast-row ast-flex internship-content-row">
            <div class="ast-col ast-col-md-4 ast-col-sm-12 internship-sidebar-col">
                <div class="sidebar-container sticky">
                    <?php if($show_alerts) { ?>
                  		<?php $country_name = get_field('country_name'); ?>
                        <h3 class="section-heading">Paid Internship in <?php echo $country_name; ?></h3>
                        <p>This internship is unavailable at the moment. If you wish to stay updated, sign up to the alert below and we will notify you when it is available.</p>
                          
                        <a href="<?php echo $register_for_alerts_link ?>" class="btn btn-primary">Register for Alerts</a>
                  
                    <?php } else { ?>
                      <div class="internship-timer">
                          <?php echo do_shortcode('[tefl_timer_shortcode timer="global"]'); ?>
                      </div>
                    
                      <div class="sidebar-title">Upcoming Start Dates</div>
                      <?php if ($internship_price_html) : ?>
                          <li class="sidebar-menu-book-now">
                              <?php if(get_post_type($internship_product_id) == 'product') : ?>
                                  <?php if(!$internship_product->is_in_stock()) : ?>
                                      <small style="display:block;line-height: 1.25;font-size: 100%;text-align: center;" class="text-secondary">Please <a href="/contact/">contact</a> our team if you would like your name to be added to our waiting list for when the programme re-opens again.</small>
                                  <?php else : ?>

                                      <?php if($internship_product->is_type('simple')) : ?>
                                          <a href="<?php echo '/?addtimetocart&prid='.$internship_product_id.'&date='; ?>" class="button book-now-btn"><span>Book Now</span><i class="fa fa-angle-right"></i></a>
                                      <?php elseif($internship_product->is_type('variable')) :
                                          $course_product_post = get_post($internship_product_id);
                                          setup_postdata( $course_product_post );    		      
                                          woocommerce_variable_add_to_cart();
                                          wp_reset_postdata(); ?>
                                          <div id="priceWrapper" data-depositpercent = "<?php echo $deposit_percent?>" class="internship-price <?php echo $deposit_class;?>">
                                              <?php echo $internship_price_html; ?>
                                          </div>
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
                                                          data-objectid="<?php echo $internship_product_id; ?>"
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
                                          <a disabled="disabled" rel="nofollow" href="/?addtimetocart&prid=<?php echo $internship_product_id; ?>" class="button book-now-btn variable-book-now-btn atc-disabled"><span>Book Now</span><i class="fa fa-angle-right"></i></a>                                
                                      <?php endif; ?> 
                                  <?php endif; ?>
                              <?php endif; ?>
                          </li>
                      <?php endif; ?>
                          	
                    <?php } ?>
                  
                    <ul class="sidebmar-menu">
                        <?php if($overview) : ?>
                            <li class="sidebar-menu-item"><a href="#overview"><img src="/wp-content/uploads/2021/12/Overview-icon.png">Overview</a></li>
                        <?php endif; ?>
                        
                        <?php if($essential_information) : ?>
                            <li class="sidebar-menu-item"><a href="#checklist"><img src="/wp-content/uploads/2021/12/checklist-icon.png">Checklist</a></li>
                        <?php endif; ?>

                        <?php if($itinerary) : ?>
                            <li class="sidebar-menu-item"><a href="#itinerary"><img src="/wp-content/uploads/2021/12/Itinerary-icon.png">Itinerary</a></li>
                        <?php endif; ?>

                        <?php //if($fully_inclusive_programme) : ?>
                            <!-- <li class="sidebar-menu-item"><a href="#fully_inclusive_prog"><img src="/wp-content/uploads/2021/12/investment-icon.png">Investment</a></li> -->
                        <?php //endif; ?>

                        <?php if($location) : ?>
                            <li class="sidebar-menu-item"><a href="#locations"><img src="/wp-content/uploads/2021/12/locations-icon.png">Locations</a></li>
                        <?php endif; ?>

                        <?php if($get_the_brochure) : ?>
                            <li class="sidebar-menu-item">
                                <a href="<?php echo $get_the_brochure ?>" target="_blank"><img src="/wp-content/uploads/2021/12/get-the-brochure-icon.png">Get the Brochure</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                     
                </div>
            </div>

            <div class="ast-col ast-col-md-8 ast-col-sm-12 internship-main-col">

                <!-- Upcoming Date Section Start -->
                <?php //$upcoming_start_dates = get_field('upcoming_start_dates'); ?>
                <?php //if ($upcoming_start_dates) : ?>
                    <!-- <div class="section upcoming-dates-section">
                        <div class="upcoming-dates-inner-div">
                            <div class="heading">Upcoming Start Dates<br /><span class="dates-span">Apply by</span></div>
                            <?php //foreach ($upcoming_start_dates as $element) :
                                    // $date = $element['date'];
                                    // $description = $element['description']; ?>
                                    <div class="date-div"><?php // echo $date; ?><br /><span class="dates-span"><?php // echo $description; ?></span></div>
                            <?php //endforeach; ?>
                        </div>
                    </div> -->
                <?php //endif; ?>

                <!-- Upcoming Date Section End -->

                <!-- Overview Section Start -->

                <?php if ($overview) :
                    $overview_content = $overview['content'];
                    $header_image = $overview['header_image']; ?>
                    <div id="overview" class="section overview-section">
                        <div class="header-img"><img src="<?php echo $header_image; ?>"></div>
                        <h3 class="section-heading">Overview</h3>
						<div class="overview-section-content"><?php the_content(); ?></div>
                        <?php if ($video) : 
                            $video_thumbnail = $video['thumbnail'];
                            $video_id = $video['youtube'];
                            $video_caption = $video['content'];
                            if ($video_id) : ?>
                                <div class="video" style="background: url('<?php echo $video_thumbnail; ?>');">
                    				<a href="https://youtu.be/<?php echo $video_id; ?>" data-lity="" class="video-caption-link lity-video">
                    		            <div class="vide-caption-box">
                                            <span class="video-caption-text"><?php echo $video_caption; ?></span>
                                            <span class="video-icon "><img src="/wp-content/uploads/2021/10/Play-button.svg"></span>
                    		            </div>
                        		    </a>				
        			            </div>
    			            <?php endif; ?>
			            <?php endif; ?>
                      	
                      	<?php if($show_eligibility_checker) { ?>
                          	<div class="eligibility-checker" style="background-image: url('<?php echo $eligibility_checker['background_image']; ?>');">
                              	<div class="title"><?php echo $eligibility_checker['title']; ?></div>
                              	<div class="content"><?php echo $eligibility_checker['content']; ?></div>
                              	<a href="<?php echo $eligibility_checker['button']['button_link']; ?>" class="button"><?php echo $eligibility_checker['button']['button_value']; ?></a>
                          	</div>
                      	<?php } ?>
                    </div>
                <?php endif; ?>

                <!-- Overview Section End -->


                <!-- Essential Information Start -->

                <?php if ($essential_information) : 
                    $title = $essential_information['title']; ?>
                    <div id="checklist" class="section checklist-section">
                        <h3 class="section-heading">Essential information about this trip</h3>
                        <div class="internship-tabpanel" role="tabpanel">
                            <!-- Nav tabs -->
                            <ul id="essential_info_tabs" class="nav nav-tabs nav-tabs-responsive" role="tablist">
                                <?php foreach ($essential_information as $ess) :
                                    $tab_title = $ess['title'];
                                    $tab_id = ti_remove_spaces_special_chars($tab_title, 'id');
                                    $tab_class = ti_remove_spaces_special_chars($tab_title, 'class'); ?>
                                    <li class="<?php echo $tab_class; ?>"><a id="<?php echo $tab_id; ?>_tab" role="tab"
                                        data-toggle="tab" aria-controls="<?php echo $tab_id; ?>"
                                        class=""><?php echo $tab_title; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                            <div id="essential_info_tabs_content" class="tab-content">
                                <?php foreach ($essential_information as $ess) :
                                    $tab_title = $ess['title'];
                                    $tab_id = ti_remove_spaces_special_chars($tab_title, 'id');
                                    $tab_list = $ess['list']; ?>
                                    <div role="tabpanel" class="tab-pane fade in" id="<?php echo $tab_id; ?>" aria-labelledby="<?php echo $tab_id; ?>_tab">
                                        <div class="internship_inside_content">
                                            <?php foreach ($tab_list as $tl) :
                                                $item = $tl['item']; ?>
                                                <div class="internship_included">
                                                    <i class="fa fa-circle"></i>
                                                    <span><?php echo $item ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Essential Information End -->

                <?php $course_included = get_field('course_included'); ?>
                <?php if($course_included[toggle]) { ?>
                    <div class="course-included">
                        <div class="section-image">
                            <img src="<?php echo $course_included['image']; ?>">
                            <div class="image-overlay">Culture</div>
                        </div>
                        <div class="section-content">
                            <h1 class="section-heading"><?php echo $course_included['title']; ?></h1>
                            <p><?php echo $course_included['description']; ?></p>
                        </div>
                    </div>
                <?php } ?>

                <!-- Full Inclusive Programme Start -->

                <?php //$fully_inclusive_header_image = get_field('fully_inclusive_header_image');
                // if ($fully_inclusive_programme) : 
                //     $title = $fully_inclusive_programme['title']; ?>
                    <!-- <div id="fully_inclusive_prog" class="section fully-inclusive-prog-section">
                        <?php //if ($fully_inclusive_header_image) : ?>
                            <div class="header-img"><img src="<?php //echo $fully_inclusive_header_image; ?>"></div>
                        <?php //endif; ?>
                        <h3 class="section-heading">Fully Inclusive Programme</h3>
                        <div class="internship-tabpanel" role="tabpanel">
                            /* Nav Tab */
                            <ul id="internship_tabs" class="nav nav-tabs nav-tabs-responsive" role="tablist">
                                <?php //foreach ($fully_inclusive_programme as $fip) :
                                        // $tab_title = $fip['title'];
                                        // $tab_id = ti_remove_spaces_special_chars($tab_title, 'id');
                                        // $tab_class = ti_remove_spaces_special_chars($tab_title, 'class'); ?>
                                    <li class="<?php //echo $tab_class; ?>"><a id="<?php //echo $tab_id; ?>_tab" role="tab"
                                        data-toggle="tab" aria-controls="<?php //echo $tab_id; ?>"
                                        class=""><?php //echo $tab_title; ?></a></li>

                                <?php //endforeach; ?>
                            </ul>

                            <div id="internship_tabs_content" class="tab-content">
                                <?php// foreach ($fully_inclusive_programme as $fip) :
                                    // $tab_title = $fip['title'];
                                    // $tab_id = ti_remove_spaces_special_chars($tab_title, 'id');
                                    // $tab_list = $fip['list']; ?>
                                    <div role="tabpanel" class="tab-pane fade in" id="<?php //echo $tab_id; ?>"
                                        aria-labelledby="<?php //echo $tab_id; ?>_tab">
                                        <div class="internship_inside_content">
                                            <?php //foreach ($tab_list as $tl) :
                                                // $item = $tl['item']; ?>
                                                <div class="internship_included">
                                                    <img class="list-icon" src="/wp-content/uploads/2021/12/plus-icon.png">
                                                    <span><?php //echo $item ?></span>
                                                </div>
                                            <?php //endforeach; ?>
                                        </div>
                                    </div>
                                <?php //endforeach; ?>
                            </div>
                        </div>
                    </div> -->
                <?php //endif; ?>

                <!-- Full Inclusive Programme End -->


                <!-- Itinerary Start -->

                <?php if ($itinerary) : 
                    $itinerary_header_image = $itinerary['header_image'];
                    $timeline_array = $itinerary['timeline']; ?>
                    <div id="itinerary" class="section itinerary-section">
                        <?php if ($itinerary_header_image) : ?>
                            <div class="header-img"><img src="<?php echo $itinerary_header_image; ?>"></div>
                        <?php endif; ?>
                        <h3 class="section-heading">Your Trip Itinerary</h3>
                        <div class="course-content-div">
                            <div class="panel-group" id="accordion">
                                <?php foreach ($timeline_array as $timeline_array_item) :
                                    $day = $timeline_array_item['day'];
                                    $day_id = str_replace(' ', '_', $day);
                                    $title = $timeline_array_item['title'];
                                    $description = $timeline_array_item['description']; ?>
                                    <div class="panel panel-default">
                                        <div class="panel-side"><?php echo $day; ?></div>
                                        <div class="panel-heading ">
                                            <h4 class="panel-title" data-toggle="collapse" data-target="#collapse<?php echo $day_id; ?>"><?php echo $title ?></h4>
                                        </div>
                                        <div id="collapse<?php echo $day_id; ?>" class="panel-collapse collapse">
                                            <div class="panel-body panel-extra-space"><?php echo $description ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Itinerary End -->

                <!-- What our interns say Start -->

                <?php $interns = get_field('interns');
                $intern_section_header = get_field('interns_section_header'); ?>
                <?php if ($interns) : ?>
                    <div class="section previous-interns-section">
                        <?php if($intern_section_header): ?> 
                            <h3 class="section-heading"><?php echo $intern_section_header; ?></h3>
                        <?php endif; ?>
                        <div class="previous-interns-container">
                            <div class="ast-row previous-interns-row">
                                <?php foreach ($interns as $intern) :
                                    $image = $intern['image'];
                                    $name = $intern['name'];
                                    $content = $intern['content'];
                                    $link = $intern['link']; ?>
                                    <div class="ast-col ast-col-md-6 ast-col-sm-12 previous-interns-col">
                                        <div class="intern-link">
                                            <div class="intern-image">
                                                <img src="<?php echo $image; ?>">
                                            </div>
                                            <div class="intern-data">
                                                <h6 class="intern-name"><?php echo $name; ?></h6>
                                                <div class="intern-content"><?php echo $content; ?></div>
                                                <?php if($link): ?>
                                                    <a class="button read-more-btns" href="<?php echo $link ?>">Read More</a>
                                                <?php endif; ?>
                                            </div>
                                            
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- What our interns say End -->


                <!-- Locations Start -->

                <?php if ($location) : 
                    $location_content = $location['content'];
                    $location_map = $location['map'];
                    $text_below_map = $location['text_below_map'];
                    $group_size = $location['group_size'];
                    $availability = $location['availability'];
                    $form_header_image = get_field('form_header_image','options'); ?>
                    <div id="locations" class="section location-section">
                        <h3 class="section-heading">Locations</h3>
                        <p><?php echo esc_attr($location_content); ?></p>
                        <div class="ast-row location-map-row">
                            <div class="ast-col ast-col-md-6 ast-col-sm-12 location-map-col">
                                <div class="location-map-img">
                                    <img src="<?php echo esc_attr($location_map); ?>">
                                </div>
                                <?php if($group_size): ?>
                                    <div class="group-box">
                                        <div class="group-left">
                                            <div class="group-number"><?php echo $group_size; ?></div>
                                            <div class="group-below">Group Size</div>
                                        </div>
                                        <div class="group-right">
                                            <div class="group-number"><?php echo $availability; ?></div>
                                            <div class="group-below">Current Availability</div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="ast-col ast-col-md-6 ast-col-sm-12 learn-more-form-col">
                                <div class="learn-more-form">
                                    <div class="form-head-row">
                                 		<div class="">
                                  			<p><?php the_field('request_a_call_intro'); ?></p>
                                  	    </div>
                                  	    <?php if($form_header_image): ?>
                                  	        <img class="form-img" src="<?php echo $form_header_image; ?>">
                                  	    <?php endif; ?>
                                  	</div>
									<?php //if (current_user_can('administrator')) { ?>
									<!-- <iframe width='100%' height='585px' src='https://theteflinstitute-teflinstitute.zohobookings.eu/portal-embed#/customer/theteflinstitute' frameborder='0' allowfullscreen='' > </iframe> -->
									<?php //}  else { ?>
                                    <?php echo do_shortcode('[contact-form-7 id="57896" title="Want to Learn More?"]'); ?>
									<?php //}   ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Locations End -->


                <!-- How it works Start -->

                <?php $how_it_works = get_field('how_it_works'); ?>
                <?php if ($how_it_works) : ?>
                    <div class="section flow-section">
                        <h3 class="section-heading">How it works</h3>
                        <p class="flow-text"><?php echo esc_attr($how_it_works['description']); ?></p>
                        <div class="flow-img-div">
                            <img src="<?php echo esc_attr($how_it_works['icon']); ?>" class="m">
                        </div>
                    </div>
                <?php endif; ?>

                <!-- How it works End -->


                <!-- Guide Start -->
                <?php $guide = get_field('guide');
                $guide_popup = get_field('guide_popup'); ?>
                <?php if ($guide) :
                    $guide_title = $guide['title'];
                    $guide_image = $guide['preview_image'];
                    $guide_content = $guide['content'];
                    $guide_button_text = $guide['guide_button_text'];
                    $guide_button_url = $guide['guide_button_url'];
                    $guide_class = '';
                    if($guide_popup) :
                        $popup_image = $guide_popup['popup_image'];
                        $popup_title = $guide_popup['popup_title'];
                        $popup_subtitle = $guide_popup['popup_subtitle'];
                        $brochure_url = $guide_popup['brochure_url'];
                        if($popup_image && $popup_title && $popup_subtitle && $brochure_url):
                            $guide_button_url = '';
                            $guide_class = 'guide-popup';
                        endif;
                    endif; ?>
                    <?php if ($guide_title && $guide_image && $guide_content) : ?>
                        <div id="guide" class="section guide-section" data-guide-popup=<?php echo (!empty($guide_popup['popup_image']) && !empty($guide_popup['popup_url']))?'yes':'no'?>>
                            <?php if ($guide_title) : ?>
                                <h3 class="section-subheading"><?php echo $guide_title; ?></h3>
                            <?php endif; ?>
                            <?php if ($guide_image) : ?>
                                <div class="download-guide-img">
                                    <img class="download-guide-one" src="<?php echo $guide_image; ?>">
                                </div>
                            <?php endif; ?>
                            <?php if ($guide_content) : ?>
                                <p class="guide-content"><?php echo $guide_content; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($guide_button_text && $guide_button_url) : ?>
                        <div class="section guide-btn-section">
                            <a href="<?php echo $guide_button_url; ?>"
                                class="guide-link button <?php echo $guide_class; ?>"><span><?php echo $guide_button_text; ?></span><i
                                    class="fa fa-angle-right"></i></a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Guide End -->


                <!-- Cultural excursions Start -->

                <?php $cultural_excursions = get_field('cultural_excursions'); ?>
                <?php if ($cultural_excursions['cultural']) :
                    $cultural_excursions_content = $cultural_excursions['content'];
                    $cultural = $cultural_excursions['cultural']; ?>
                    <div id="tour" class="section cultural-excursions">
                        <h3 class="section-heading">Cultural excursions</h3>
                        <?php if ($cultural_excursions_content) : ?>
                            <div class="cultural-excursions-top-content"><?php echo $cultural_excursions_content; ?></div>
                        <?php endif; ?>
                        <div class="ast-row cultural-excursions-row">
                            <?php foreach ($cultural as $ce) :
                                $image = $ce['image'];
                                $image_title = $ce['image_title'];
                                $title = $ce['title'];
                                $content = $ce['content'];
                                if ($image || $image_title || $title || $content) : ?>
                                    <div class="ast-col-sm-12 ast-col-md-4 cultural-excursions-col">
                                        <div class="card">
                                            <div class="cultural-thumbnail">
                                                <img src="<?php echo $image; ?>">
                                                <p class="image-title"><?php echo $image_title; ?></p>
                                            </div>
                                            <div class="cultural-content-div">
                                                <p class="cultural-title"><?php echo $title; ?></p>
                                                <div class="cultural-content"><?php echo $content ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Cultural excursions End -->

            </div>
        </div>
    </div>

    <!-- Want More Inspiration? Start -->

    <?php $other_destinations = get_field('other_destinations'); ?>
    <?php if ($other_destinations) : ?>
        <div id="destinations" class="destinations-section">
            <div class="ast-container destinations-container">
                <div class="ast-row destinations-row">
                    <div class="ast-col-md-12 destinations-col">
                        <h3 class="section-heading">Want More Inspiration?</h3>
                        <p class="section-sub-heading">See other destinations:</p>
                    </div>
                </div>
                <div class="ast-row destination-row">
                    <?php foreach ($other_destinations as $feat_intern) :
                        $feat_intern_img = $feat_intern['image'];
                        $feat_intern_id = $feat_intern['internship'];
                        $title = get_the_title($feat_intern_id);
                        $permalink = get_permalink($feat_intern_id); ?>
                        <div class="ast-col-md-4 ast-col-sm-12 slide-item destination-col">
                            <a href="<?php echo esc_url($permalink); ?>" class="destination-link">
                                <div class="destination-thumbnail">
                                    <img src="<?php echo $feat_intern_img; ?>">
                                </div>
                                <h4 class="destination-name"><?php echo $title; ?></h4>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Want More Inspiration? End -->

    <?php
    require_once 'template-parts/ti-popup-template.php'; 
    ?>


</div><!-- #primary -->


<?php get_footer(); ?>
