<?php
/**
* Template Name: Courses
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$trial = get_field('trial');

$banner_background_image = get_field('banner_background_image');
$banner_title = get_cfvalue_by_country('banner_title');
$banner_text = get_cfvalue_by_country('banner_text');
$banner_icon = get_field('banner_icon');
$banner_button_text = get_field('banner_button_text');
$banner_button_url = get_field('banner_button_url');

$accredited_tefl_course_title = get_cfvalue_by_country('accredited_tefl_course_title');
$accredited_tefl_course_section_text = get_cfvalue_by_country('accredited_tefl_course_section_text');
$accredited_tefl_course_section_text_with_icon = get_field('accredited_tefl_course_section_text_with_icon' );

$ultimate_tefl_teacher_background = get_field('ultimate_tefl_teacher_background');
$ultimate_tefl_teacher_title = get_field('ultimate_tefl_teacher_title');
$ultimate_tefl_teacher_text = get_field('ultimate_tefl_teacher_text');
$ultimate_tefl_teacher_button_text = get_field('ultimate_tefl_teacher_button_text');
$ultimate_tefl_teacher_button_url = get_field('ultimate_tefl_teacher_button_url');

$accredited_courses = get_field('accredited_courses' );

$virtual_tefl_course_background = get_field('virtual_tefl_course_background');
$virtual_tefl_course_title = get_field('virtual_tefl_course_title');
$virtual_tefl_course_text = get_field('virtual_tefl_course_text');
$virtual_tefl_course_button_text = get_field('virtual_tefl_course_button_text');
$virtual_tefl_course_button_url = get_field('virtual_tefl_course_button_url');

$level_5_course_section_title = get_field('level_5_course_section_title' );
$level_5_course_section_text = get_field('level_5_course_section_text' );
$level_5_course_section_text_with_icon = get_field('level_5_course_section_text_with_icon' );

$level_5_courses = get_field('level_5_courses' );

$english_level_test_background = get_field('english_level_test_background');
$english_level_test_title = get_field('english_level_test_title');
$english_level_test_text = get_field('english_level_test_text');
$english_level_test_button_text = get_field('english_level_test_button_text');
$english_level_test_button_url = get_field('english_level_test_button_url');

$classroom_bb_course_section_title = get_field('classroom_bb_course_section_title' );
$classroom_bb_course_section_text = get_field('classroom_bb_course_section_text' );

$classroom_bb_courses = get_field('classroom_bb_courses' );

$classroom_courses_location = get_field('classroom_courses_location' );

$specialist_course_section_title = get_field('specialist_course_section_title' );
$specialist_course_section_text = get_field('specialist_course_section_text' );

$specialist_courses = get_field('specialist_courses' );

get_header(); ?>

	<script type="application/ld+json">
	{
	  "@context": "https://schema.org/", 
	  "@type": "BreadcrumbList", 
	  "itemListElement": [{
		"@type": "ListItem", 
		"position": 1, 
		"name": "Home",
		"item": "https://teflinstitute.com/"  
	  },{
		"@type": "ListItem", 
		"position": 2, 
		"name": "TEFL Courses",
		"item": "https://teflinstitute.com/tefl-courses/"  
	  }]
	}
	</script>

	<div id="primary" <?php astra_primary_class(); ?>>

		<!--Banner Section-->

        <section class="banner-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-lg-12">
        		        <div class="course-banner" style="background-image: url('<?php echo $banner_background_image; ?>')">
        		            <div class="ast-col-lg-6 ast-col-md-8">
                		        <div class="banner-content-block">
                		            <div class="content-block">
                		                <?php if(!empty($banner_title)) : ?>
                		                    <h1><?php echo $banner_title; ?></h1>
                		                <?php endif; ?>
                		                <?php if(!empty($banner_text)) : ?>
                		                    <p><?php echo $banner_text; ?></p>
                		                <?php endif; ?>
                		                <?php if(!empty($banner_icon)) : ?>
                		                    <img src="<?php echo $banner_icon; ?>" alt="Archive Course Banner Icon">
                		                <?php endif; ?>
                		            </div>
                		            <?php if( !empty($banner_button_text) || !empty($banner_button_url) ) : ?>
                		                <a href="<?php echo $banner_button_url; ?>"><?php echo $banner_button_text; ?> <i class="fa fa-angle-right"></i></a>
                		            <?php endif; ?>
                		        </div>
                			</div>
        		        </div>        
        		    </div>
        		</div>
        	</div>
        </section>
        
        <!--/Banner Section-->
        
        
        <!--Courses Looking For Section-->

        <section class="courses-looking-for-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-lg-12">
        		        <h2>WHAT TEFL/TESOL COURSE ARE YOU LOOKING FOR?</h2>
        		        
        		        <div class="courses-looking-for-tabs">
                	        <div class="tabs">
                                <!--<button class="tablinks active" onclick="openCourse(event, 'accredit')">ACCREDITED TEFL COURSES</button>
                                <button class="tablinks" onclick="openCourse(event, 'govt_regulated')">GOVERNMENT REGULATED</button>
                                <button class="tablinks" onclick="openCourse(event, 'classroom_based')">CLASSROOM BASED</button>
                                <button class="tablinks" onclick="openCourse(event, 'specialized_courses')">SPECIALIST TEFL COURSES</button>-->
                                <a class="tablinks active" href="#accredit">ACCREDITED TEFL COURSES</a>
                                <a class="tablinks" href="#govt_regulated">GOVERNMENT REGULATED</a>
                                <a class="tablinks" href="#classroom_based">CLASSROOM BASED</a>
                                <a class="tablinks" href="#specialized_courses">SPECIALIST TEFL COURSES</a>
                            </div>
                            <!--<div class="tab-content">
                                <div id="accredit" class="tabcontent">
                                    <h2>RECOGNISED ACCREDITED TEFL COURSES</h2>
                                    <p>You can complete your accredited TEFL certification in your own time, and at your own pace. The TEFL Institute of Ireland is an TQUK Approved Centre and is also endorsed by the Accreditation Council for Distance Learning. Our courses are ideal for:</p>
                                    <div class="ast-row">
                                        <div class="ast-col-md-4">
                                            <img src="/wp-content/uploads/2020/11/native_non_native_speakers.svg">
                                            <p>Native or non native speakers</p>
                                        </div>
                                        <div class="ast-col-md-4">
                                            <img src="/wp-content/uploads/2020/11/tech_worldwide.svg">
                                            <p>Wanting to teach worldwide</p>
                                        </div>
                                        <div class="ast-col-md-4">
                                            <img src="/wp-content/uploads/2020/11/qualified_quickly.svg">
                                            <p>Want to get TEFL qualified quickly</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="govt_regulated" class="tabcontent">
                                    <h2>GOVERNMENT REGULATED COURSES</h2>
                                    <p>You can complete your accredited TEFL certification in your own time, and at your own pace. The TEFL Institute of Ireland is an TQUK Approved Centre and is also endorsed by the Accreditation Council for Distance Learning. Our courses are ideal for:</p>
                                    <div class="ast-row">
                                        <div class="ast-col-md-4">
                                            <img src="/wp-content/uploads/2020/11/native_non_native_speakers.svg">
                                            <p>Native or non native speakers</p>
                                        </div>
                                        <div class="ast-col-md-4">
                                            <img src="/wp-content/uploads/2020/11/tech_worldwide.svg">
                                            <p>Wanting to teach worldwide</p>
                                        </div>
                                        <div class="ast-col-md-4">
                                            <img src="/wp-content/uploads/2020/11/qualified_quickly.svg">
                                            <p>Want to get TEFL qualified quickly</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="classroom_based" class="tabcontent">
                                    <h2>CLASSROOM BASED COURSES</h2>
                                    <p>You can complete your accredited TEFL certification in your own time, and at your own pace. The TEFL Institute of Ireland is an TQUK Approved Centre and is also endorsed by the Accreditation Council for Distance Learning. Our courses are ideal for:</p>
                                    <div class="ast-row">
                                        <div class="ast-col-md-4">
                                            <img src="/wp-content/uploads/2020/11/native_non_native_speakers.svg">
                                            <p>Native or non native speakers</p>
                                        </div>
                                        <div class="ast-col-md-4">
                                            <img src="/wp-content/uploads/2020/11/tech_worldwide.svg">
                                            <p>Wanting to teach worldwide</p>
                                        </div>
                                        <div class="ast-col-md-4">
                                            <img src="/wp-content/uploads/2020/11/qualified_quickly.svg">
                                            <p>Want to get TEFL qualified quickly</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="specialized_courses" class="tabcontent">
                                    <h2>SPECIALIST TEFL COURSES</h2>
                                    <p>You can complete your accredited TEFL certification in your own time, and at your own pace. The TEFL Institute of Ireland is an TQUK Approved Centre and is also endorsed by the Accreditation Council for Distance Learning. Our courses are ideal for:</p>
                                    <div class="ast-row">
                                        <div class="ast-col-md-4">
                                            <img src="/wp-content/uploads/2020/11/native_non_native_speakers.svg">
                                            <p>Native or non native speakers</p>
                                        </div>
                                        <div class="ast-col-md-4">
                                            <img src="/wp-content/uploads/2020/11/tech_worldwide.svg">
                                            <p>Wanting to teach worldwide</p>
                                        </div>
                                        <div class="ast-col-md-4">
                                            <img src="/wp-content/uploads/2020/11/qualified_quickly.svg">
                                            <p>Want to get TEFL qualified quickly</p>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                	    </div>
        		        
        		    </div>
        		</div>
        	</div>
        </section>
        
        <!--/Courses Looking For Section-->
        
        
        <section class="govt-regulated-courses-section" id="accredit">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-md-12">
        		        <div class="govt-regulated-courses-section-block">
        		            <?php if(!empty($accredited_tefl_course_title)): ?>
        		                <h2><?php echo $accredited_tefl_course_title; ?></h2>
        		            <?php endif; ?>
        		            <?php if(!empty($accredited_tefl_course_section_text)): ?>
        		                <h4><?php echo $accredited_tefl_course_section_text; ?></h4>
        		            <?php endif; ?>
        		            <?php if ($accredited_tefl_course_section_text_with_icon): ?>
            		            <div class="ast-row three-blocks-row">
            		                <?php foreach($accredited_tefl_course_section_text_with_icon as $text_icon) :
            		                    $icon_url = $text_icon['icon'];
            		                    $icon_text = $text_icon['text']; ?>
            		                    <?php if ( !empty($icon_url) || !empty($icon_text) ): ?>
                		                    <div class="ast-col-md-4">
                		                        <img src="<?php echo $icon_url; ?>">
                                                <p><?php echo $icon_text; ?></p>
                		                    </div>
            		                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
        		        </div>
        		    </div>
        		</div>
        	</div>
        </section>

        
        <!--TEFL Teacher Section-->
  
        <section class="tefl-teacher-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-md-12">
                      <a href="https://teflinstitute.com/course/ofqual-level-5-tefl-course-government-regulated/"><img src="https://teflinstitute.com/wp-content/uploads/2022/10/jacob-banner-TI.jpg"></a>
        		        <!-- <div class="tefl-teacher-section-block" style="background-image: url('<?php echo $ultimate_tefl_teacher_background; ?>')">
        		            <div class="tefl-teacher-section-content">
        		                <?php if(!empty($ultimate_tefl_teacher_title)) : ?>
                		            <h2><?php echo $ultimate_tefl_teacher_title; ?></h2>
                		        <?php endif; ?>
                		        <?php if(!empty($ultimate_tefl_teacher_text)) : ?>
                		            <p><?php echo $ultimate_tefl_teacher_text; ?></p>
                		        <?php endif; ?>
                		        <?php if( !empty($ultimate_tefl_teacher_button_url) || !empty($ultimate_tefl_teacher_button_text) ) : ?>
                		            <a class="learn-more" href="<?php echo $ultimate_tefl_teacher_button_url; ?>"><?php echo $ultimate_tefl_teacher_button_text; ?> <i class="fa fa-angle-right"></i></a>
                		        <?php endif; ?>
                		    </div>
        		        </div>-->
        		    </div>
        		</div>
        	</div>
        </section>
        
        <!--/TEFL Teacher Section-->
        
        
        <!--Accredited Courses Section-->
        
        <?php if( !$accredited_courses ) : ?>
        <section class="courses-section gray-blocks">
            <div class="ast-container">
        		<div class="ast-row">
        		    <?php foreach($accredited_courses as $accredited_course) :
        		        $course_icon = $accredited_course['course_icon'];
                        $course_title = $accredited_course['course_title'];
                        $course_completion_time = $accredited_course['course_completion_time'];
                        
                        $course_zoom_classes = $accredited_course['zoom_classes'];
                        $zoom_classes_product = $accredited_course['zoom_classes_product'];
                        
        		        $course_id = $accredited_course['course'];
        		        $course_link = get_post_permalink($course_id);
        		        
                        $course_product_id = $accredited_course['course_product'];
                        $course_product = wc_get_product($course_product_id);
                        $percentage = '';
                        if($course_product->is_type('simple')) {
                            $course_price_html = $course_product->get_price_html();
                            $simple_regular_price = $course_product->get_regular_price();
                            $simple_sale_price = $course_product->get_sale_price();
                            if($simple_sale_price) :
                                $percentage = round( ( ( $simple_regular_price - $simple_sale_price ) / $simple_regular_price ) * 100 );
                            endif;
                        } elseif($course_product->is_type('variable')) {
                            $available_children = $course_product->get_children();
                            $children_count = count($available_children) - 1;
                            $product_var_id = $available_children[$children_count];
                            $variable_product = wc_get_product( $product_var_id );
                            $course_price_html = $variable_product->get_price_html();
                            
                        }?>
            		    <div class="ast-col-lg-4">
            		        <div class="course-item">
            		            <?php if($percentage) : ?>
                                    <div class="course-save"><span class="save">Save</span><span class="percent-value"><?php echo $percentage ?>%</span></div>
                                <?php endif; ?>
            		            <img src="<?php echo $course_icon; ?>" alt="<?php echo str_replace(' ', '_',strip_tags($course_title))."_Icon"; ?>">
            		            <h3 class="price"><?php echo $course_price_html; ?></h3>
            		            <?php if($course_zoom_classes) { ?>
                                    <div class="course-zoom">
                                        <?php 
                                            $zoom_classes_product_id = $zoom_classes_product;
                                            $zoom_classes_price = '';
                                            if($zoom_classes_product_id){
                                                $zoom_classes_product = wc_get_product($zoom_classes_product_id);
                                                if($zoom_classes_product){
                                                    $zoom_classes_price = $zoom_classes_product->get_price_html(); 
                                                }
                                            }
                                        ?>
                                        <img src="/wp-content/uploads/2021/11/zoom-black.png">
                                        <div>
                                            <?php echo $course_zoom_classes; ?>
                                            Worth <?php echo $zoom_classes_price; ?>
                                        </div>
                                    </div>
                                <?php } ?>
            		            <h3 class="course-title"><?php echo $course_title; ?></h3>
            		            <p class="duration">Completion time<br><?php echo $course_completion_time; ?></p>
            		            <a class="learn-more" href="<?php echo $course_link; ?>">LEARN MORE</a>
            		        </div>        
            		    </div>
						
            		<?php endforeach; ?>
        		</div>
        	</div>
        </section>
        <?php endif; ?>
        
        <!--/Accredited Courses Section-->

		<!--Accredited Courses Section-->
        
        <?php if( ($accredited_courses)) : ?>
        <section class="courses-section accredited-course-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <?php foreach($accredited_courses as $accredited_course) :
						$course_card_bg_image = $accredited_course['course_card_background_image'];
        		        $course_icon = $accredited_course['course_icon'];
                        $course_title = $accredited_course['course_title'];
                        $course_completion_time = $accredited_course['course_completion_time'];
                        
                        $course_zoom_classes = $accredited_course['zoom_classes'];
                        $zoom_classes_product = $accredited_course['zoom_classes_product'];
                        
        		        $course_id = $accredited_course['course'];
        		        $course_link = get_post_permalink($course_id);
        		        
                        $course_product_id = $accredited_course['course_product'];
                        $course_product = wc_get_product($course_product_id);
                        $percentage = '';
                        if($course_product->is_type('simple')) {
                            $course_price_html = $course_product->get_price_html();
                            $simple_regular_price = $course_product->get_regular_price();
                            $simple_sale_price = $course_product->get_sale_price();
                            if($simple_sale_price) :
                                $percentage = round( ( ( $simple_regular_price - $simple_sale_price ) / $simple_regular_price ) * 100 );
                            endif;
                        } elseif($course_product->is_type('variable')) {
                            $available_children = $course_product->get_children();
                            $children_count = count($available_children) - 1;
                            $product_var_id = $available_children[$children_count];
                            $variable_product = wc_get_product( $product_var_id );
                            $course_price_html = $variable_product->get_price_html();
                            
                        }
						$course_features = $accredited_course['course_features'];
						$includes  = $course_features['includes'];
						$excludes   = $course_features['excludes'];
						?>
            		    <div class="ast-col-md-6 course-item-wrapper">
            		        <div class="course-item">
								<div class="course-item-block accredited-course-item__block">
									<a href="<?php echo $course_link?>" class="course-clickbox"></a>
									<div style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.75)), url('<?php echo $course_card_bg_image?>')" class="course-item__left ast-col-md-8">
										<?php if($percentage) : ?>
											<div class="course-save"><span class="save">Save</span><span class="percent-value"><?php echo $percentage ?>%</span></div>
										<?php endif; ?>
										<img src="<?php echo $course_icon; ?>" alt="<?php echo str_replace(' ', '_', strip_tags($course_title))."_Icon"; ?>">
										<h3 class="price"><?php echo $course_price_html; ?></h3>
										<h3 class="course-title"><?php echo $course_title; ?></h3>
										<p class="duration">Completion time<br><?php echo $course_completion_time; ?></p>
										<a class="learn-more-btn" href="<?php echo $course_link; ?>">LEARN MORE</a>
									</div>
									<div class="course-item__right features ast-col-md-4">
										<?php 
										if(!empty($includes)):
											foreach($includes as $include):
												$feature = $include['feature'];
										?>
											<div class="feature-include"><img src="/wp-content/uploads/2022/11/checkmark.png" alt="" class="check-icon"><?php echo $feature?></div>
										<?php 
											endforeach;
										endif;
										if(!empty($excludes)):
											foreach($excludes as $exclude):
												$feature = $exclude['feature'];
										?>
											<div class="feature-exclude"><img src="/wp-content/uploads/2022/11/close.png" alt="" class="cross-icon"><?php echo $feature?></div>
										<?php 
											endforeach;
										endif?>
									</div>
								</div>
            		        </div>        
            		    </div>
						
            		<?php endforeach; ?>
        		</div>
        	</div>
        </section>
        <?php endif; ?>
        
        <!--/Accredited Courses Section-->
        
        
        <!--Full Block Course Section-->

        <section class="full-block-course-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-md-12">
        		        <div class="full-block-course-block" style="background-image: url('<?php echo $virtual_tefl_course_background; ?>')">
        		            <div class="full-block-course-content">
        		                <?php if(!empty($virtual_tefl_course_title)) : ?>
                		            <h2><?php echo $virtual_tefl_course_title; ?></h2>
                		        <?php endif; ?>
                		        <?php if(!empty($virtual_tefl_course_text)) : ?>
                		            <?php echo $virtual_tefl_course_text; ?>
                		        <?php endif; ?>
                		        <?php if( !empty($virtual_tefl_course_button_url) || !empty($virtual_tefl_course_button_text) ) : ?>
                		            <a class="book-now" href="<?php echo $virtual_tefl_course_button_url; ?>"><?php echo $virtual_tefl_course_button_text; ?> <i class="fa fa-angle-right"></i></a>
                		        <?php endif; ?>
                		    </div>
        		        </div>
        		    </div>
        		</div>
        	</div>
        </section>
        
        <!--/Full Block Course Section-->
        
        
        <!--Govt Regulated Level 5 Courses Section-->

        <section class="govt-regulated-courses-section" id="govt_regulated">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-md-12">
        		        <div class="govt-regulated-courses-section-block">
        		            <?php if(!empty($level_5_course_section_title)): ?>
        		                <h2><?php echo $level_5_course_section_title; ?></h2>
        		            <?php endif; ?>
        		            <?php if(!empty($level_5_course_section_text)): ?>
        		                <h4><?php echo $level_5_course_section_text; ?></h4>
        		            <?php endif; ?>
        		            <?php if ($level_5_course_section_text_with_icon): ?>
            		            <div class="ast-row three-blocks-row">
            		                <?php foreach($level_5_course_section_text_with_icon as $text_icon) :
            		                    $icon_url = $text_icon['icon'];
            		                    $icon_text = $text_icon['text']; ?>
            		                    <?php if ( !empty($icon_url) || !empty($icon_text) ): ?>
                		                    <div class="ast-col-md-4">
                		                        <img src="<?php echo $icon_url; ?>">
                                                <p><?php echo $icon_text; ?></p>
                		                    </div>
            		                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
        		        </div>
        		    </div>
        		</div>
        	</div>
        </section>
        
        <!--/Govt Regulated Level 5 Courses Section-->
        

		<!--3 Blocks Courses Section By Bikram-->
        <section class=" courses-section govt-regulated-course-section black-blocks">
            <div class="ast-container">
        		<div class="ast-row">
        		<?php foreach($level_5_courses as $level_5_course) :
					$course_card_bg_image = $level_5_course['course_card_background_image'];
					$course_icon = $level_5_course['course_icon'];
					$course_title = $level_5_course['course_title'];
					$course_completion_time = $level_5_course['course_completion_time'];
					
					$course_zoom_classes = $level_5_course['zoom_classes'];
					$zoom_classes_product = $level_5_course['zoom_classes_product'] ?? '';
					
					$course_id = $level_5_course['course'];
					$course_link = get_post_permalink($course_id);
					
					$course_product_id = $level_5_course['course_product'];
					$course_product = wc_get_product($course_product_id);
					$percentage = '';
					if($course_product->is_type('simple')) {
						$course_price_html = $course_product->get_price_html();
						$simple_regular_price = $course_product->get_regular_price();
						$simple_sale_price = $course_product->get_sale_price();
						if($simple_sale_price) :
							$percentage = round( ( ( $simple_regular_price - $simple_sale_price ) / $simple_regular_price ) * 100 );
						endif;
					} elseif($course_product->is_type('variable')) {
						$available_children = $course_product->get_children();
						$children_count = count($available_children) - 1;
						$product_var_id = $available_children[$children_count];
						$variable_product = wc_get_product( $product_var_id );
						$course_price_html = $variable_product->get_price_html();
						
					}
					$course_features = $level_5_course['course_features'];
					$includes  = $course_features['includes'];
					$excludes   = $course_features['excludes'];
					$course_feature_icon = $level_5_course['course_feature_icon'];
					//Get Deposit Info 
					$full_price = $course_product->get_price();
					$deposit_enabled = get_post_meta($course_product_id, '_wc_deposit_enabled', true);
					$deposit_payment_plan = '';

					if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional') {
						$deposit_payment_plan = get_post_meta($course_product_id, '_wc_deposit_payment_plans', true);
						$deposit_payment_plan = $deposit_payment_plan[0];
					}
					include(get_stylesheet_directory()."/template-parts/deposit-info.php"); 
					//End Get Deposit Info
					?>
						<div class="ast-col-md-6 course-item-wrapper">
							<div class="course-item">
								<div class="course-item-block level5-course-item__block">
									<a href="<?php echo $course_link?>" class="course-clickbox"></a>
									<div style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.75)), url('<?php echo $course_card_bg_image?>')" class="course-item__left ast-col-md-8">
										<?php if($percentage) : ?>
											<div class="course-save"><span class="save">Save</span><span class="percent-value"><?php echo $percentage ?>%</span></div>
										<?php endif; ?>
										<img src="<?php echo $course_icon; ?>" alt="<?php echo str_replace(' ', '_', strip_tags($course_title))."_Icon"; ?>">
										<h3 class="price"><?php echo $course_price_html; ?></h3>
										<h3 class="course-title"><?php echo $course_title; ?></h3>
										<p class="duration">Completion time<br><?php echo $course_completion_time; ?></p>
										<?php
										if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional'):
											if($deposit_payment_plan === 1 || $deposit_payment_plan === 3 || $deposit_payment_plan === 4):
										?>
											<div class="pay-in-two-three deposit-info ast-flex ast-align-items-center">
												<div class="depoist-info__icon">
													<img src="<?php echo $deposit_icon?>" alt="">
												</div>
												<div class="ast-flex flex-direction-column deposit-info__details">
													<h5 class="deposit-info_title">Pay in <?php echo $total_deposits?></h5>
													<div class="deposit-info_description">
														<?php echo $deposit_description?>
													</div>
												</div>
											</div>
											<?php 
											endif;
											if($deposit_payment_plan===6):
											?>
											<div 
												class="ajax-snippet" 
												data-snippet="pay_in_6_ribbon"
												data-objectid="<?php echo $course_product_id; ?>"
											>
											</div>
											<div id="loader" class="loader">
												Fetching deposit details <img src="/wp-content/uploads/2022/11/loading-black.gif" alt="fetching deposit details">
											</div>
											<?php
											endif;
										endif
                                        ?>
										<?php if($course_zoom_classes) { ?>
                                    	<div class="course-zoom">
                                        <?php 
                                            $zoom_classes_product_id = $zoom_classes_product;
                                            $zoom_classes_price = '';
                                            if($zoom_classes_product_id){
                                                $zoom_classes_product = wc_get_product($zoom_classes_product_id);
                                                if($zoom_classes_product){
                                                    $zoom_classes_price = $zoom_classes_product->get_price_html(); 
                                                }
                                            }
                                        ?>
											<img src="/wp-content/uploads/2022/11/zoom-icon.png">
											<?php echo $course_zoom_classes; ?>
											</div>
                                		<?php } 
										?>
										<a class="learn-more-btn" href="<?php echo $course_link; ?>">LEARN MORE</a>
									</div>
									<div class="course-item__right features ast-col-md-4">
										<h4 class="course-item__right-title">What's Included</h4>
										<div class="course-item__right-content">
											<?php 
											if(!empty($includes)):
												foreach($includes as $include):
													$feature = $include['feature'];
											?>
												<div class="feature-include"><img src="/wp-content/uploads/2022/11/checkmark.png" alt="" class="check-icon"><?php echo $feature?></div>
											<?php 
												endforeach;
											endif;
											if(!empty($excludes)):
												foreach($excludes as $exclude):
													$feature = $exclude['feature'];
											?>
												<div class="feature-exclude"><img src="/wp-content/uploads/2022/11/close.png" alt="" class="cross-icon"><?php echo $feature?></div>
											<?php 
												endforeach;
											endif?>
										</div>
										<img src="<?php echo  $course_feature_icon?>" class="course-item__right-icon"/>
									</div>
								</div>
							</div>        
						</div>
            		<?php endforeach; ?>
        		</div>
        	</div>
        </section>
        <!--/3 Blocks Courses Section  By Bikram-->
        
        <?php if($trial['toggle'] == true) { ?>
              
                  	<div class="ast-container trial">

                      	<div class="left" style="background-image: url('<?php echo $trial['image'] ?>');"></div>
                      
                      	<div class="right">
                      	
                          	<h3 class="title"><?php echo $trial['title'] ?></h3>
                          
                          	<div class="content"><?php echo $trial['content'] ?></div>
                          
                          	<a href="<?php echo $trial['cta']['link'] ?>" class="cta"><?php echo $trial['cta']['value'] ?></a>
                          	
                      	</div>

                  	</div>
              
		<?php } ?>
      
        <!--Full Block Course Section-->

        <section class="full-block-course-section take-the-test">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-md-12">
        		        <div class="full-block-course-block" style="background-image: url('<?php echo $english_level_test_background; ?>')">
        		            <div class="full-block-course-content">
        		                <?php if(!empty($english_level_test_title)) : ?>
                		            <h2><?php echo $english_level_test_title; ?></h2>
                		        <?php endif; ?>
                		        <?php if(!empty($english_level_test_text)) : ?>
                		            <p><?php echo $english_level_test_text; ?></p>
                		        <?php endif; ?>
                		        <?php if( !empty($english_level_test_button_url) || !empty($english_level_test_button_text) ) : ?>
                		            <a class="book-now" href="<?php echo $english_level_test_button_url; ?>"><?php echo $english_level_test_button_text; ?> <i class="fa fa-angle-right"></i></a>
                		        <?php endif; ?>
                		    </div>
        		        </div>
        		    </div>
        		</div>
        	</div>
        </section>
        
        <!--/Full Block Course Section-->
        
        
        <!--Classroom Blended Courses Courses Section-->

        <section class="classroom-blended-courses-section" id="classroom_based" >
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-md-12">
        		        <div class="classroom-blended-courses-section-block">
        		            <?php if(!empty($classroom_bb_course_section_title)): ?>
        		                <h2><?php echo $classroom_bb_course_section_title; ?></h2>
        		            <?php endif; ?>
        		            <?php if(!empty($classroom_bb_course_section_text)): ?>
        		                <h4><?php echo $classroom_bb_course_section_text; ?></h4>
        		            <?php endif; ?>
        		        </div>
        		    </div>
        		</div>
        	</div>
        </section>
        
        <!--/Classroom Blended Courses Courses Section-->
        
        
        <!--3 Blocks Classroom Blended Courses Courses Section-->
        <?php if($classroom_bb_courses) : ?>
		<section class="courses-section classroom-blended-courses-new" style="padding-bottom: 0px !important;">
            <div class="ast-container">
        		<div class="ast-row">
        		    <?php foreach($classroom_bb_courses as $cbb_course) :
        		        $course_icon = $cbb_course['course_icon'];
                        $course_title = $cbb_course['course_title'];
                        $course_completion_time = $cbb_course['course_completion_time'];
                        $course_background_image = $cbb_course['course_background_image'];
                        
        		        $course_id = $cbb_course['course'];
        		        $course_link = get_post_permalink($course_id);
        		        
                        $course_product_id = $cbb_course['course_product'];
                        $course_product = wc_get_product($course_product_id);
                        $percentage = '';
						$course_features = $cbb_course['course_features'];
						$includes  = $course_features['includes'];
						$excludes   = $course_features['excludes'];
                        if($course_product->is_type('simple')) {
                            $course_price_html = $course_product->get_price_html();
                            $simple_regular_price = $course_product->get_regular_price();
                            $simple_sale_price = $course_product->get_sale_price();
                            if($simple_sale_price) :
                                $percentage = round( ( ( $simple_regular_price - $simple_sale_price ) / $simple_regular_price ) * 100 );
                            endif;
                        } elseif($course_product->is_type('variable')) {
                            $available_children = $course_product->get_children();
                            $children_count = count($available_children) - 1;
                            $product_var_id = $available_children[$children_count];
                            $variable_product = wc_get_product( $product_var_id );
                            $course_price_html = $variable_product->get_price_html();
                        }
						//Get Deposit Info 
						$full_price = $course_product->get_price();
						$deposit_enabled = get_post_meta($course_product_id, '_wc_deposit_enabled', true);
						$deposit_payment_plan = '';

						if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional') {
							$deposit_payment_plan = get_post_meta($course_product_id, '_wc_deposit_payment_plans', true);
							$deposit_payment_plan = $deposit_payment_plan[0];
						}
						include(get_stylesheet_directory()."/template-parts/deposit-info.php"); 
						//End Get Deposit Info
						?>
                    
					<div class="ast-col-md-6 course-item-wrapper">
							<div class="course-item">
								<div class="course-item-block level5-course-item__block test">
									<a href="<?php echo $course_link?>" class="course-clickbox"></a>
									<div style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.75)), url('<?php echo $course_background_image?>')" class="course-item__left ast-col-md-8">
										<?php if($percentage) : ?>
											<div class="course-save"><span class="save">Save</span><span class="percent-value"><?php echo $percentage ?>%</span></div>
										<?php endif; ?>
										<img src="<?php echo $course_icon; ?>" alt="<?php echo str_replace(' ', '_', strip_tags($course_title))."_Icon"; ?>">
										<h3 class="price"><?php echo $course_price_html; ?></h3>
										<h3 class="course-title"><?php echo $course_title; ?></h3>
										<p class="duration">Completion time<br><?php echo $course_completion_time; ?></p>
										<?php
										if ($deposit_enabled == 'forced' || $deposit_enabled == 'optional'):
											if($deposit_payment_plan === 1 || $deposit_payment_plan === 3 || $deposit_payment_plan === 4):
										?>
											<div class="pay-in-two-three deposit-info ast-flex ast-align-items-center">
												<div class="depoist-info__icon">
													<img src="<?php echo $deposit_icon?>" alt="">
												</div>
												<div class="ast-flex flex-direction-column deposit-info__details">
													<h5 class="deposit-info_title">Pay in <?php echo $total_deposits?></h5>
													<div class="deposit-info_description">
														<?php echo $deposit_description?>
													</div>
												</div>
											</div>
											<?php 
											endif;
											if($deposit_payment_plan===6):
											?>
											<div 
												class="ajax-snippet" 
												data-snippet="pay_in_6_ribbon"
												data-objectid="<?php echo $course_product_id; ?>"
											>
											</div>
											<div id="loader" class="loader">
												Fetching deposit details <img src="/wp-content/uploads/2022/11/loading-black.gif" alt="fetching deposit details">
											</div>
											<?php
											endif;
										endif
                                        ?>
										<?php if($course_zoom_classes) { ?>
                                    	<div class="course-zoom">
                                        <?php 
                                            $zoom_classes_product_id = $zoom_classes_product;
                                            $zoom_classes_price = '';
                                            if($zoom_classes_product_id){
                                                $zoom_classes_product = wc_get_product($zoom_classes_product_id);
                                                if($zoom_classes_product){
                                                    $zoom_classes_price = $zoom_classes_product->get_price_html(); 
                                                }
                                            }
                                        ?>
											<img src="/wp-content/uploads/2022/11/zoom-icon.png">
											<?php echo $course_zoom_classes; ?>
											</div>
                                		<?php }
										else{
											?>
											<img src="/wp-content/uploads/2022/11/zoom-icon.png">
											Free 20 Hours Live TEFL Zoom Classes
											<?php
										} 
										?>
										<a class="learn-more-btn" href="<?php echo $course_link; ?>">LEARN MORE</a>
									</div>
									<div class="course-item__right features ast-col-md-4">
										<h4 class="course-item__right-title">What's Included</h4>
										<div class="course-item__right-content">
											<?php 
											if(!empty($includes)):
												foreach($includes as $include):
													$feature = $include['feature'];
											?>
												<div class="feature-include"><img src="/wp-content/uploads/2022/11/checkmark.png" alt="" class="check-icon"><?php echo $feature?></div>
											<?php 
												endforeach;
											endif;
											if(!empty($excludes)):
												foreach($excludes as $exclude):
													$feature = $exclude['feature'];
											?>
												<div class="feature-exclude"><img src="/wp-content/uploads/2022/11/close.png" alt="" class="cross-icon"><?php echo $feature?></div>
											<?php 
												endforeach;
											endif?>
										</div>
										<img src="<?php echo  $course_feature_icon?>" class="course-item__right-icon"/>
									</div>
								</div>
							</div>        
						</div>
            		<?php endforeach; ?>
        		</div>
        	</div>
        </section>
        <?php endif; ?>
        
        <!--/3 Blocks Classroom Blended Courses Courses Section-->
		
        
        
        <!--Specialized TEFL Courses Section-->

        <section class="specialized-tefl-courses-section" id="specialized_courses">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-md-12">
        		        <div class="specialized-tefl-courses-section-block">
        		            <?php if(!empty($specialist_course_section_title)): ?>
        		                <h2><?php echo $specialist_course_section_title; ?></h2>
        		            <?php endif; ?>
        		            <?php if(!empty($specialist_course_section_text)): ?>
        		                <h4><?php echo $specialist_course_section_text; ?></h4>
        		            <?php endif; ?>
        		        </div>
        		    </div>
        		</div>
        	</div>
        </section>
        
        <!--/Specialized TEFL Courses Section-->
        
        
        <!--Specialized TEFL Course Items Section-->
        <?php if($specialist_courses) : ?>
        <section class="specialized-tefl-course-items-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <?php foreach($specialist_courses as $sp_course) :
        		        $course_icon = $sp_course['course_icon'];
                        $course_title = $sp_course['course_title'];
                        $course_completion_time = $sp_course['course_completion_time'];
                        $course_background_image = $sp_course['course_background_image'];
                        
        		        $course_id = $sp_course['course'];
        		        $course_link = get_post_permalink($course_id);
        		        
                        $course_product_id = $sp_course['course_product'];
                        $course_product = wc_get_product($course_product_id);
                        $percentage = '';
                        if($course_product->is_type('simple')) {
                            $course_price_html = $course_product->get_price_html();
                            $simple_regular_price = $course_product->get_regular_price();
                            $simple_sale_price = $course_product->get_sale_price();
                            if($simple_sale_price) :
                                $percentage = round( ( ( $simple_regular_price - $simple_sale_price ) / $simple_regular_price ) * 100 );
                            endif;
                        } elseif($course_product->is_type('variable')) {
                            $available_children = $course_product->get_children();
                            $children_count = count($available_children) - 1;
                            $product_var_id = $available_children[$children_count];
                            $variable_product = wc_get_product( $product_var_id );
                            $course_price_html = $variable_product->get_price_html();
                        }
						?>
                        <div class="ast-col-lg-4">
            		        <div class="course-item">
            		            <?php if($percentage) : ?>
                                    <div class="course-save"><span class="save">Save</span><span class="percent-value"><?php echo $percentage ?>%</span></div>
                                <?php endif; ?>
            		            <div class="course-image" style="background: url('<?php echo $course_background_image; ?>');">
            		                <img src="<?php echo $course_icon; ?>" class="course-badge">
            		            </div>
            		            <h3><?php echo $course_price_html; ?></h3>
            		            <h4><?php echo $course_title; ?></h4>
            		            <p>Completion time<br/><?php echo $course_completion_time; ?></p>
            		            <a href="<?php echo $course_link; ?>" class="learn-more">LEARN MORE <i class="fa fa-angle-right"></i></a>
            		        </div>
            		    </div>
                    <?php endforeach; ?>
        		</div>
        	</div>
        </section>
        <?php endif; ?>
        
        <!--/Specialized TEFL Course Items Section-->
        
		<?php // $frequently_asked_questions = get_cfvalue_with_id_by_country('frequently_asked_questions', 1905); ?>
		<?php $frequently_asked_questions = get_field('frequently_asked_questions', 1905); ?>

		<section class="faq-tefl-course-section">
            <div class="ast-container">
        		<div class="ast-row">

					<div class="ast-col-md-12">
						<?php $i = 0; ?>
						<h2>
							TEFL Frequently asked Questions
						</h2>
						<?php foreach($frequently_asked_questions as $item): ?>

							<?php $question = $item['question']; ?>
							<?php $answer = $item['answer']; ?>

							<section class="accordion-container">
								<input id="accordion-<?php echo $i ?>" name="accordion-1" type="radio" <?php if($i === 0) { ?>checked<?php } ?>>
								<label for="accordion-<?php echo $i ?>"><?php echo $question ?></label>
								<article>
									<?php echo $answer ?>
								</article>
							</section>
						<?php $i++; endforeach; ?> 
					</div>
        		</div>
        	</div>
        </section>
		<script type="application/ld+json">
						{
						  "@context": "https://schema.org",
						  "@type": "FAQPage",
						  "mainEntity": [
						  	<?php 
							$faqcount = count($frequently_asked_questions);
							$counter = 0;
							foreach ($frequently_asked_questions as $item) {
								$counter++;
								?>
								{
									"@type": "Question",
									"name": <?php echo json_encode($item['question']); ?>,
									"acceptedAnswer": {
									  "@type": "Answer",
									  "text": <?php echo json_encode($item['answer']); ?>
									}
								}	
								<?php
								if ($faqcount != $counter) echo "," ;
							}
							?>
						  ]
						}
		</script>						
		
		
	</div><!-- #primary -->



<?php get_footer(); ?>