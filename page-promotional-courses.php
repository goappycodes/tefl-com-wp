<?php
/**
* Template Name: TEFL Promotional Courses
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$banner_background_image = get_field('banner_background_image');
$banner_title = get_field('banner_title');
$banner_text = get_field('banner_text');
$banner_icon = get_field('banner_icon');
$banner_button_text = get_field('banner_button_text');
$banner_button_url = get_field('banner_button_url');

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

	<div id="primary" <?php astra_primary_class(); ?>>

		<!--Banner Section-->

        <section class="banner-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-lg-12">
						<img src="https://teflinstitute.com/wp-content/uploads/2021/07/Clean-Happy-Independence-Day-Instagram-Post-1.jpg" class="mobile-banner-image" style="display:none;">
        		        <div class="course-banner" style="background-image: url('<?php echo $banner_background_image; ?>')">
        		            <div class="ast-col-lg-6 ast-col-md-8">
                		        <div class="banner-content-block">
                		            <div class="content-block">
                		                <?php if(!empty($banner_title)) : ?>
                		                    <h3><?php echo $banner_title; ?></h3>
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
        
        <section class="govt-regulated-courses-section" id="accredit">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-md-12">
        		        <div class="govt-regulated-courses-section-block">
        		            <h2>RECOGNISED ACCREDITED TEFL COURSES</h2>
        		            <h4>You can complete your accredited TEFL certification in your own time, and at your own pace. The TEFL Institute is an TQUK Approved Centre and is also endorsed by the Accreditation Council for Distance Learning. Our courses are ideal for:</h4>
        		            <div class="ast-row three-blocks-row">
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
        		    </div>
                </div>
            </div>
        </section>        
        
        <!--3 Blocks Courses Section-->
        
        <?php if( $accredited_courses ) : ?>
        <section class="courses-section gray-blocks">
            <div class="ast-container">
        		<div class="ast-row">
        		    <?php foreach($accredited_courses as $accredited_course) :
        		        $course_icon = $accredited_course['course_icon'];
                        $course_title = $accredited_course['course_title'];
                        $course_completion_time = $accredited_course['course_completion_time'];
                        
        		        $course_id = $accredited_course['course'];
        		        $course_link = get_post_permalink($course_id);
        		        
                        $course_product_id = $accredited_course['course_product'];
                        $course_product = wc_get_product($course_product_id);
                        if($course_product->is_type('simple')) {
                            $course_price_html = $course_product->get_price_html();
                        } elseif($course_product->is_type('variable')) {
                            $available_children = $course_product->get_children();
                            $children_count = count($available_children) - 1;
                            $product_var_id = $available_children[$children_count];
                            $variable_product = wc_get_product( $product_var_id );
                            $course_price_html = $variable_product->get_price_html();
                        }?>
            		    <div class="ast-col-lg-4">
            		        <div class="course-item">
            		            <img src="<?php echo $course_icon; ?>" alt="<?php echo $course_title." Icon"; ?>">
            		            <h3 class="price"><?php echo $course_price_html; ?></h3>
            		            <h3 class="course-title"><?php echo $course_title; ?></h3>
            		            <p class="duration">Completion time<br><?php echo $course_completion_time; ?></p>
            		            <a class="learn-more" href="<?php echo $course_link; ?>">LEARN MORE</a>
            		        </div>        
            		    </div>
            		<?php endforeach; ?>
        		    <!--<div class="ast-col-lg-4">
        		        <div class="course-item">
        		            <img src="/wp-content/uploads/2020/11/Group-410@2x.png">
        		            <h3 class="price">£153</h3>
        		            <h3>120 HOUR PREMIER TEFL COURSE ACCREDITED</h3>
        		            <p class="duration">Completion time<br>2-4 Weeks</p>
        		            <a class="learn-more">LEARN MORE</a>
        		        </div>        
        		    </div>
        		    <div class="ast-col-lg-4">
        		        <div class="course-item">
        		            <img src="/wp-content/uploads/2020/11/Group-391@2x.png">
        		            <h3 class="price">£153</h3>
        		            <h3>120 HOUR PREMIER TEFL COURSE ACCREDITED</h3>
        		            <p class="duration">Completion time<br>2-4 Weeks</p>
        		            <a class="learn-more">LEARN MORE</a>
        		        </div>        
        		    </div>-->
        		</div>
        	</div>
        </section>
        <?php endif; ?>
        
        <!--/3 Blocks Courses Section-->        
                
        <!--3 Blocks Courses Section-->

        <section class="courses-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <?php foreach($level_5_courses as $level_5_course) :
        		        $course_icon = $level_5_course['course_icon'];
                        $course_title = $level_5_course['course_title'];
						$course_description = $level_5_course['course_description'];
                        $course_completion_time = $level_5_course['course_completion_time'];
                        
        		        $course_id = $level_5_course['course'];
        		        $course_link = get_post_permalink($course_id);
        		        
                        $course_product_id = $level_5_course['course_product'];
                        $course_product = wc_get_product($course_product_id);
                        if($course_product->is_type('simple')) {
                            $course_price_html = $course_product->get_price_html();
                        } elseif($course_product->is_type('variable')) {
                            $available_children = $course_product->get_children();
                            $children_count = count($available_children) - 1;
                            $product_var_id = $available_children[$children_count];
                            $variable_product = wc_get_product( $product_var_id );
                            $course_price_html = $variable_product->get_price_html();
                        }?>
                        <div class="ast-col-lg-6">
            		        <div class="course-item">
            		            <img src="<?php echo $course_icon; ?>">
            		            <h3 class="price"><?php echo $course_price_html; ?></h3>
								<h3 style="min-height: 54px;"><?php echo $course_title; ?></h3>
								<p class="course-desc"><?php echo $course_description; ?></p>
            		            <p class="duration">Completion time<br><?php echo $course_completion_time; ?></p>
            		            <a class="learn-more" href="<?php echo $course_link; ?>">LEARN MORE</a>
            		        </div>        
            		    </div>
        		    <?php endforeach; ?>
        		</div>
        	</div>
        </section>
        
        <!--/3 Blocks Courses Section-->
        
        
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
        <section class="courses-section classroom-blended-courses" style="padding-bottom: 0px !important;">
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
                        if($course_product->is_type('simple')) {
                            $course_price_html = $course_product->get_price_html();
                        } elseif($course_product->is_type('variable')) {
                            $available_children = $course_product->get_children();
                            $children_count = count($available_children) - 1;
                            $product_var_id = $available_children[$children_count];
                            $variable_product = wc_get_product( $product_var_id );
                            $course_price_html = $variable_product->get_price_html();
                        }?>
                    
                        <div class="ast-col-lg-4">
            		        <div class="course-item" style="background: url('<?php echo $course_background_image; ?>');">
            		            <div class="course-content">
                		            <img src="<?php echo $course_icon; ?>" alt="<?php echo $course_title." Icon"; ?>">
                		            <h3 class="price"><?php echo $course_price_html; ?></h3>
                		            <h3 class="course-title"><?php echo $course_title; ?></h3>
                		            <p class="duration">Completion time<br><?php echo $course_completion_time; ?></p>
                		        </div>
                		        <a class="learn-more" href="<?php echo $course_link; ?>">LEARN MORE</a>
            		        </div>
            		    </div>
            		<?php endforeach; ?>
        		</div>
        	</div>
        </section>
        <?php endif; ?>
        
        <!--/3 Blocks Classroom Blended Courses Courses Section-->
        
        
        <!--Classroom Course Location Section-->
        <?php //if($classroom_courses_location) : ?>
        <!--<section class="classroom-course-location-section">
            <div class="ast-container">
        		<div class="ast-row">
        		    <div class="ast-col-lg-12">
        		        <h2>CLASSROOM COURSE LOCATIONS</h2>
        		    </div>
        		</div>
        		<div class="ast-row">
        		    <?php //foreach($classroom_courses_location as $cl_course) :
        		        
                        //$course_title = $cl_course['course_title'];
                        //$course_background_image = $cl_course['course_background_image'];
                        
        		        //$course_id = $cl_course['course'];
        		        //$course_link = get_post_permalink($course_id); ?>
        		        
                        <div class="ast-col-lg-3">
            		        <div class="course-location">
            		            <img src="<?php //echo $course_background_image; ?>">
            		            <h3 class="course-title"><?php //echo $course_title; ?></h3>
            		            <a href="<?php //echo $course_link; ?>" class="learn-more">LEARN MORE <i class="fa fa-angle-right"></i></a>
            		        </div>
            		    </div>
            		    
            		<?php //endforeach; ?>
        		</div>
        	</div>
        </section>-->
        <?php //endif; ?>
        
        <!--/Classroom Course Location Section-->
        
        
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
                        if($course_product->is_type('simple')) {
                            $course_price_html = $course_product->get_price_html();
                        } elseif($course_product->is_type('variable')) {
                            $available_children = $course_product->get_children();
                            $children_count = count($available_children) - 1;
                            $product_var_id = $available_children[$children_count];
                            $variable_product = wc_get_product( $product_var_id );
                            $course_price_html = $variable_product->get_price_html();
                        }?>
                        <div class="ast-col-lg-4">
            		        <div class="course-item">
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
        		    <!--<div class="ast-col-lg-4">
        		        <div class="course-item">
        		            <div class="course-image" style="background: url('/wp-content/uploads/2020/11/s_tefl_course1.jpg);">
        		                <img src="/wp-content/uploads/2020/11/s_tefl_course_icon.svg" class="course-badge">
        		            </div>
        		            <h3>£71</h3>
        		            <h4>30 HOUR IELTS PREPARATION SPECIALIST COURSE</h4>
        		            <p>Completion time 1 Week</p>
        		            <a href="#" class="learn-more">LEARN MORE <i class="fa fa-angle-right"></i></a>
        		        </div>
        		    </div>
        		    <div class="ast-col-lg-4">
        		        <div class="course-item">
        		            <div class="course-image" style="background: url('/wp-content/uploads/2020/11/s_tefl_course2.jpg);">
        		                <img src="/wp-content/uploads/2020/11/s_tefl_course_icon.svg" class="course-badge">
        		            </div>
        		            <h3>£71</h3>
        		            <h4>30 HOUR TOEIC PREPARATION SPECIALIST COURSE</h4>
        		            <p>Completion time 1 Week</p>
        		            <a href="#" class="learn-more">LEARN MORE <i class="fa fa-angle-right"></i></a>
        		        </div>
        		    </div>
        		    <div class="ast-col-lg-4">
        		        <div class="course-item">
        		            <div class="course-image" style="background: url('/wp-content/uploads/2020/11/s_tefl_course3.jpg);">
        		                <img src="/wp-content/uploads/2020/11/s_tefl_course_icon.svg" class="course-badge">
        		            </div>
        		            <h3>£71</h3>
        		            <h4>30 HOUR TEACHING YOUNG LEARNERS SPECIALIST COURSE</h4>
        		            <p>Completion time 1 Week</p>
        		            <a href="#" class="learn-more">LEARN MORE <i class="fa fa-angle-right"></i></a>
        		        </div>
        		    </div>
        		    <div class="ast-col-lg-4">
        		        <div class="course-item">
        		            <div class="course-image" style="background: url('/wp-content/uploads/2020/11/s_tefl_course4.jpg);">
        		                <img src="/wp-content/uploads/2020/11/s_tefl_course_icon.svg" class="course-badge">
        		            </div>
        		            <h3>£71</h3>
        		            <h4>30 HOUR ADVANCED GRAMMAR COURSE FOR TEFL TEACHERS</h4>
        		            <p>Completion time 1 Week</p>
        		            <a href="#" class="learn-more">LEARN MORE <i class="fa fa-angle-right"></i></a>
        		        </div>
        		    </div>
        		    <div class="ast-col-lg-4">
        		        <div class="course-item">
        		            <div class="course-image" style="background: url('/wp-content/uploads/2020/11/s_tefl_course5.jpg);">
        		                <img src="/wp-content/uploads/2020/11/s_tefl_course_icon.svg" class="course-badge">
        		            </div>
        		            <h3>£71</h3>
        		            <h4>30 HOUR TEACHING BUSINESS ENGLISH SPECIALIST COURSE</h4>
        		            <p>Completion time 1 Week</p>
        		            <a href="#" class="learn-more">LEARN MORE <i class="fa fa-angle-right"></i></a>
        		        </div>
        		    </div>
        		    <div class="ast-col-lg-4">
        		        <div class="course-item">
        		            <div class="course-image" style="background: url('/wp-content/uploads/2020/11/s_tefl_course6.jpg);">
        		                <img src="/wp-content/uploads/2020/11/s_tefl_course_icon.svg" class="course-badge">
        		            </div>
        		            <h3>£71</h3>
        		            <h4>30 HOUR TEACHING ENGLISH ONLINE SPECIALIST COURSE</h4>
        		            <p>Completion time 1 Week</p>
        		            <a href="#" class="learn-more">LEARN MORE <i class="fa fa-angle-right"></i></a>
        		        </div>
        		    </div>-->
        		</div>
        	</div>
        </section>
        <?php endif; ?>
        
        <!--/Specialized TEFL Course Items Section-->
        

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