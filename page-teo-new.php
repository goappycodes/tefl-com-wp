<?php
/**
* Template Name: Teach English Online New
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/


$header 						= get_field('hero');
$mainImage 						= $header['image'];
$title  						= $header['title'];
$subtitle 						= $header['subtitle'];
$buttonText 					= $header['button_text'];
$buttonLink 					= $header['button_link'];

$homeabroad 					= get_field('home_abroad');
$headtitle 						= $homeabroad['head_title'];
$maintitle 						= $homeabroad['title'];
$homecontent 					= $homeabroad['content'];

$columnlr 						= get_field('main');
$bgimageyt 						= $columnlr['top']['image']; 
$ytlink 						= $columnlr['top']['youtube'];
$colcontent 					= $columnlr['top']['description'];

$requirement 					= get_field('requirement');
$reqtitle 						= $requirement['title'];
$reqcontent 					= $requirement['content'];

$teachenglish 					= get_field('teach_english');
$teachengheading 				= $teachenglish['heading'];

$englishcontent 				= get_field('content');

$start_teaching 				= get_field('start_teaching');
$start_teaching_heading 		= $start_teaching['heading'];
$create_steps 					= $start_teaching['create_steps'];

$calculate_salary 				= get_field('calculate_salary');
$calculate_image 				= $calculate_salary['image'];
$calculate_heading 				= $calculate_salary['heading'];
$calculate_description 			= $calculate_salary['description'];
$calculate_button_text 			= $calculate_salary['button_text'];
$calculate_button_link 			= $calculate_salary['button_link'];

$teach_english_jobs 			= get_field('online_degree');
$teach_english_header 			= $teach_english_jobs['header'];
$gocambio_jobs 					= ti_online_tefl_job_feed();

$demo_video 					= get_field('certificate_review');
$demo_video_heading 			= $demo_video['heading'];
$demo_video_button_text 		= $demo_video['button_text'];
$demo_video_button_link 		= $demo_video['button_link'];

$online_teaching_webinars 		= get_field('watch_online');
$online_webinar_header 			= $online_teaching_webinars['header'];

$online_webinar_left_title 		= $online_teaching_webinars['left_side']['title'];
$online_webinar_image       	= $online_teaching_webinars['left_side']['thumbnail'];
$online_webinar_youtube 		= $online_teaching_webinars['left_side']['youtube'];

$online_webinar_right_title 	= $online_teaching_webinars['right_side']['title'];
$online_webinar_right_image     = $online_teaching_webinars['right_side']['thumbnail'];
$online_webinar_right_youtube 	= $online_teaching_webinars['right_side']['youtube'];

$start_up_guide 				= get_field('start_guide');
$start_up_title 				= $start_up_guide['header'];
$start_up_image 				= $start_up_guide['image'];
$start_up_bt_txt				= $start_up_guide['button_text'];
$start_up_link					= $start_up_guide['button_link'];

$tips_english_online 			= get_field('teaching_tips');
$tips_english_header 			= $tips_english_online['header'];
$tips_english_details 			= $tips_english_online['details'];
$tips_english_content 			= $tips_english_online['content'];

$recommended_blogs              = get_field('recommended_blogs');
$recommended_blogs_header       = $recommended_blogs['header'];
$recommended_blog_list          = $recommended_blogs['blogs'];

$finding_online_teaching_job    = get_field('finding_online_teaching_job');
$fotj_header                    = $finding_online_teaching_job['header'];
$fotj_blogs                     = $finding_online_teaching_job['blogs'];

$online_teaching_resources      = get_field('online_teaching_resources');
$online_teaching_header         = $online_teaching_resources['header'];
$online_teaching_eng_courses    = $online_teaching_resources['english_courses'];
$excluded_courses = get_field('excluded_courses', 'options');
$excluded_courses = $excluded_courses ? $excluded_courses : [];

get_header(); 
?>

<section class="banner-section" style="background-image: url('<?php echo $mainImage; ?>');">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col">
				<div class="content">
					<h1><?php echo $title;?></h1>
					<p><?php echo $subtitle;?></p>
					<a href="<?php echo $buttonLink;?>" class="button-green"><?php echo $buttonText;?></a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="abroad-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col">
				<h2 class="font-600"><?php echo $headtitle;?></h2>
				<h3 class="large-heading common-section-heading"><?php echo $maintitle;?></h3>
				<p><?php echo $homecontent;?></p>
			</div>
		</div>
		<div class="ast-row">
		    <div class="ast-col-lg-6 video-link">
				<div class="explained-video" style="background-image: url('<?php echo $bgimageyt; ?>')">
					<a href="<?php echo $ytlink; ?>" data-lity class="video-caption-link lity-video">
						<span class="video-icon"></span>
					</a>
				</div>
			</div>
			<div class="ast-col-lg-6 content-column">
				<?php echo $colcontent;?>
			</div>
		</div>
	</div>
</section>

<section class="requirement-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col">
				<h2 class="req-head large-heading common-section-heading"><?php echo $reqtitle;?></h2>
				<p class="req-content"><?php echo $reqcontent;?></p>
			</div>
		</div>
	</div>
</section>

<div class="teach-online-section">
    <div class="teach-online-heading">
	    <h2><?php echo $teachengheading;?></h2>
    </div>
    <div class="container-section">
			<?php foreach($englishcontent as $engcontent) { 
				$engimg = $engcontent['image'];
				$engtitle = $engcontent['title'];
				$engdes = $engcontent['description'];
				?>
			<div class="ast-row" style="background: url('<?php echo $engimg; ?>') no-repeat center center / cover;">
				<div class="ast-col content-box">
					<div class="mid-content">
						<h2><?php echo $engtitle;?></h2>
						<p><?php echo $engdes;?></p>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<section class="start-teaching-online-section">
	<h2><?php echo $start_teaching_heading;?></h2>
    <div class="ast-container">
		<div class="ast-row">
			<?php foreach($create_steps as $steps) { 
				$stepsicon 			= $steps['icon'];
				$stepsheader 		= $steps['header'];
				$stepstitle 		= $steps['title'];
				$stepsdescription 	= $steps['description'];
				?>
				<div class="ast-col-md-6 steps-column">
					<div class="step-icons">
						<h3><?php echo $stepsheader; ?></h3>
						<img style="width:15%" src="<?php echo $stepsicon;?>" alt="" title="">
					</div>
					<div class="step-content">
						<h3><?php echo $stepstitle; ?></h3>
						<p><?php echo $stepsdescription; ?></p>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>

<section class="calculate-my-salary" style="background: url('<?php echo $calculate_image; ?>') no-repeat center center / cover;">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-lg-7 calculate-salary-details">
				<h2><?php echo $calculate_heading;?></h2>
				<p><?php echo $calculate_description;?></p>
				<a class="calculate-button" href="<?php echo $calculate_button_link;?>">
				<i class="fa fa-calculator" aria-hidden="true"></i> <?php echo $calculate_button_text;?>
				</a>
			</div>
		</div>
	</div>
</section>

<!--Job Section-->

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
        if (!in_array($current_course_id, $excluded_courses)) {
            $timer_expiry = get_field('timer_expiry', 'options');
        }
        if ($timer_expiry) {
            $course_offer_end_date = strtotime($timer_expiry);
            $current_time = current_time('timestamp');
            $time_diff = $course_offer_end_date - $current_time;
        }
        $is_expired = $time_diff < 0 ? true : false;
    ?>

        <div class="section tefl-section sale-courses-section">
            <div class="ast-row sale-courses-header-row">
                <div class="ast-col ast-col-md-12 section-header-col">
                    <div class="section-header">RECOMMENDED COURSE FOR TEACHING ONLINE</div>
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
                        <?php else : ?>
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
                        <?php endif; ?>
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
                                        <div class="item inc-item"><img src="/wp-content/uploads/2021/11/Group-22.svg"><?php echo $inc_item; ?></div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if ($excludes) : ?>
                                    <?php foreach ($excludes as $exc) :
                                        $exc_item = $exc['content']; ?>
                                        <div class="item exc-item"><img src="/wp-content/uploads/2021/11/Group-21-1.png"><?php echo $exc_item; ?></div>
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

<section class="teach-english-online">
	<div class="ast-container">
		<div class="row">
			<div class="ast-col-lg-12 ">
				<h2><?php echo $teach_english_header; ?></h2>
			</div>
		</div>
	</div>		
</section>
<section class="job-section job-section-new without-degree-job-section">
    <div class="ast-container">
        <?php $job_without_degree = $teach_english_jobs['company_without_degree'];
                $section_heading = $job_without_degree['heading'];
                $jobs = $job_without_degree['jobs'];
        ?>
        <h3 class="job-section-heading"><?php echo $section_heading?></h3>
        <div class="ast-row">
            <?php include(get_stylesheet_directory()."/template-parts/job-cards.php");?>
        </div>
    </div>
</section>

<section class="job-section job-section-new without-degree-job-section">
    <div class="ast-container">
        <?php 
            $job_with_degree = $teach_english_jobs['company_with_degree'];
            $section_heading = $job_with_degree['heading'];
            $jobs = $job_with_degree['jobs'];
        ?>
        <h3 class="job-section-heading"><?php echo $section_heading?></h3>
        <div class="ast-row">
            <?php include(get_stylesheet_directory()."/template-parts/job-cards.php");?>
        </div>
    </div>
</section>

<section class="job-section job-section-new without-degree-job-section">
    <div class="ast-container">
        <?php 
            $job_for_non_native = $teach_english_jobs['company_hire_english'];
            $section_heading = $job_for_non_native['heading'];
            $jobs = $job_for_non_native['jobs'];
        ?>
        <h3 class="job-section-heading"><?php echo $section_heading?></h3>
        <div class="ast-row">
            <?php include(get_stylesheet_directory()."/template-parts/job-cards.php");?>
        </div>
    </div>
</section>
<!-- OLD SECTIOn -->
<?php
//$ti_jobs = get_ti_jobs(6, false);
if ($ti_jobs) : ?>
    <section class="job-section">
        <div class="ast-container">
            <h3>TEFL/TESOL Careers</h3>
            <div class="ast-row">
                <?php foreach ($ti_jobs as $job) :
                    $job_title = $job->job_title;
                    $job_title = wp_trim_words($job_title, 7, '...');
                    $job_logo = $job->job_image;
                    if (empty($job_logo)) {
                        $job_logo = '/wp-content/uploads/2022/02/jobs_board_icon.svg';
                    }
                    $job_link = $job->job_link;
                    $job_location = $job->job_location;
                    $job_salary = $job->job_salary;
                    $job_start_date  = $job->job_start_date;
                    $job_type = $job->job_type;
                    $job_duration = $job->job_duration;
                    $job_company = $job->job_company_name;
                ?>
                    <div class="ast-col-md-4">
                        <a target="_blank" href="<?php echo $job_link; ?>" class="job-clickbox"></a>
                        <div class="job-card">
                            <div class="job-card__header">
                                <div class="job-type">
                                    <?php echo $job_type; ?>
                                </div>
                                <div class="job-image">
                                    <img src="<?php echo $job_logo; ?>">
                                </div>
                            </div>
                            <div class="job-card__body">
                                <div class="job-card__title">
                                    <h4><?php echo $job_title; ?></h4>
                                </div>
                                <div class="job-card__meta">
                                    <div class="job-meta job-meta__company ast-flex">
                                        <img class="job-meta_icon" src="/wp-content/uploads/2021/04/Company.svg" alt="">
                                        <span class="job-meta_value"><?php echo !empty($job_company) ? $job_company : 'NA'; ?></span>
                                    </div>
                                    <div class="job-meta job-meta__location ast-flex">
                                        <img class="job-meta_icon" src="/wp-content/uploads/2021/04/Location.svg" alt="">
                                        <span class="job-meta_value"><?php echo !empty($job_location) ? $job_location : 'NA' ?></span>
                                    </div>
                                    <div class="job-meta job-meta__salary ast-flex">
                                        <img class="job-meta_icon" src="/wp-content/uploads/2021/04/Payment.svg" alt="">
                                        <span class="job-meta_value"><?php echo !empty($job_salary) ? $job_salary : 'NA' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="job-card__footer">
                                <a target="_blank" href="<?php echo $job_link; ?>" class="learn-more black-button"><span>learn more</span><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="button-container">
                <a href="https://jobs.teflinstitute.com/all-jobs" target="_blank" class="black-button">View All Jobs <i class="fa fa-angle-right"></i></a>
            </div>
    </section>
<?php endif; ?>
<!-- OLD SECTIOn -->

<section>
	<div class="ast-container">
		<div class="row">
			<div class="ast-col demo-video-heading">
				<h2><?php echo $demo_video_heading;?></h2>	
			</div>
		</div>
	</div>
</section>

<section class="demo-video">
    <div class="ast-container demo-video-columns">
		<div class="ast-row">
		    <div class="ast-col-lg-5 demo-form">
				<?php echo do_shortcode( '[contact-form-7 id="68710" title="Demo Video"]' ); ?>
			</div>
			<div class="ast-col-lg-7 certificate_review-video-col" style="background: url('https://teflinstitute.com/wp-content/uploads/2021/12/Demo-video-1-1.jpeg');height: 350px;background-position: center;background-size: cover;">
               <a href="/video-masterclass" class="video-caption-link lity-video">
                    <div class="vide-caption-box">
						<span class="video-caption-text">Diana | Video Masterclass</span>
						<span class="video-icon"><img src="/wp-content/uploads/2021/10/Play-button.svg"></span>
                	</div>
                </a>
				<div class="video-masterclass">
					<a href="<?php echo $demo_video_button_link;?>"><?php echo $demo_video_button_text; ?> <span class="arrow"> > </span></a> <i class="fa fa-arrow"></i>
				</div>
            </div>
		</div>
	</div>
</section>

<section class="online-teaching-webinar">
	
    <div class="ast-container">
		<div class="ast-row">
            <div class="ast-col-md-12">
            <h2><?php echo $online_webinar_header; ?></h2>
            </div>
			<div class="ast-col-lg-6 ast-col-md-6 ast-col-sm-12 webinar-video-link">
					<h3><?php echo $online_webinar_left_title;?></h3>
					<div class="webinar-explained-video" style="background-image: url('<?php echo $online_webinar_image; ?>')">
						<a href="<?php echo $online_webinar_youtube; ?>" data-lity class="video-caption-link lity-video">
							<span class="webinar-video-icon"></span>
						</a>
					</div>
			</div>

			<div class="ast-col-lg-6 ast-col-md-6 ast-col-sm-12 webinar-video-link">
					<h3><?php echo $online_webinar_right_title;?></h3>
					<div class="webinar-explained-video" style="background-image: url('<?php echo $online_webinar_right_image; ?>')">
						<a href="<?php echo $online_webinar_right_youtube; ?>" data-lity class="video-caption-link lity-video">
							<span class="webinar-video-icon"></span>
						</a>
					</div>
			</div>
		</div>
	</div>
</section>

<section class="start-up-guide">
	<div class="ast-container">
		<div class="ast-row">
			<div class="ast-col guide-content">
				<h2><?php echo $start_up_title;?></h2>
				<img style="width:70%;" src="<?php echo $start_up_image;?>" alt="" title="">
				<a class="btn-download guide-download" href="#"><?php echo $start_up_bt_txt;?></a>
			</div>
		</div>
        <div class="guide-donwnload-form hidden ast-row">
            <?php echo do_shortcode('[contact-form-7 id="74494" title="Teach English Online Guide"]')?>
        </div>
	</div>
</section>

<section class="tips-teaching-english-online">
	<h3><?php echo $tips_english_header;?></h3>
	<p><?php echo $tips_english_details;?></p>
		<?php foreach ($tips_english_content as $tips_content) {
					$tips_image = $tips_content['image'];
					$tips_title = $tips_content['title'];
					$tips_description = $tips_content['description'];
		?>
		<div class="ast-container tteo-content">
			<div class="row">
				<div class="ast-col-lg-6 tips-image">
					<img src="<?php echo $tips_image;?>" alt="" title="">
				</div>
				<div class="ast-col-lg-6 tips-content">
					<h4><?php echo $tips_title;?></h4>
					<p><?php echo $tips_description;?></p>
				</div>
			</div>
		</div>
		<?php }; ?>
</section>

 

<section class="recommended-blogs-section">
    <div class="ast-container">
        <div class="ast-row">
            <div class="ast-col-md-12">
                <h3><?php echo $recommended_blogs_header;?></h3>
            </div>
            <?php foreach($recommended_blog_list as $bloglist):
                $article = $bloglist;
                $thumbnail    	= get_the_post_thumbnail($article->ID); 
                $permalink    	= get_permalink($article->ID); 
                $title        	= get_the_title($article->ID); 	
                $excerpt      	= get_the_excerpt($article->ID);
                $excerpt 		= wp_trim_words($excerpt, 20, '.'); 
                $date         	= get_the_time('F j, Y', $article->ID);?>         
                <div class="ast-col-md-4">
                    <div class="blog-item">
                        <div class="blog-content">
                            <h2><?php echo $date; ?></h2>
                            <h3><?php echo esc_html($title); ?></h3>
                            <?php echo $thumbnail;?>
                            <p><?php echo $excerpt;?></p>
                            <a class="blog-link" href="<?php echo esc_html($permalink); ?>">READ MORE</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?> 
        </div>
    </div>
</section>

<section class="finding-online-teaching-job">
		<div class="ast-container">
			<div class="ast-row">
                <div class="ast-col-md-12">
                <h3><?php echo $fotj_header;?></h3>
                </div>
                <?php foreach($fotj_blogs  as $fotj_bloglist):
                    $fotj_article 		= $fotj_bloglist; 
                    $fotj_thumbnail   	= get_the_post_thumbnail($fotj_article->ID); 
                    $fotj_permalink   	= get_permalink($fotj_article->ID); 
                    $fotj_title       	= get_the_title($fotj_article->ID); 
                    $fotj_excerpt     	= get_the_excerpt($fotj_article->ID);
                    $fotj_excerpt 		= wp_trim_words($fotj_excerpt, 25, '.');
                    $fotj_date        	= get_the_time('F j, Y', $fotj_article->ID);?>	        
                    <div class="ast-col-md-4">
                        <div class="blog-item">
                            <div class="blog-content">
                                <h2><?php echo $fotj_date; ?></h2>
                                <h3><?php echo esc_html($fotj_title); ?></h3>
                                <?php echo $fotj_thumbnail;?>
                                <p><?php echo $fotj_excerpt;?></p>
                                <a class="blog-link" href="<?php echo esc_html($fotj_permalink); ?>">READ MORE</a>
                            </div>
                        </div>
                    </div>
        		<?php endforeach; ?> 
			</div>
		</div>
</section>

<section class="online-teaching-resources">
    <div class="ast-container teaching-container">
        <div class="ast-row">
            <div class="ast-col-md-12">
            <h3><?php echo $online_teaching_header;?></h3>
            </div>
            <?php 
            $courses = $online_teaching_resources['courses'];
            foreach($courses as $course):
                $course_ID = $course['course_product'];
                $course_image   = $course['course_image'];
                $course_link    = get_permalink($course_ID); 
                $course_title   = get_the_title($course_ID);
                $course_product  = wc_get_product($course_ID);
                if ($course_product) {
                    $course_price = $course_product->get_price_html();
                }
                ?>
                <div class="ast-col-md-4">
                    <div class="ont-item">
                        <div class="ont-content">
                            <h3><?php echo esc_html($course_title);?></h3>
                            <h4>ONLINE LESSON PACK</h4>
                            <img src="<?php echo $course_image;?>" alt="">
                            <div class="otr-course-price">
                            <?php echo $course_price; ?>
                            </div>
                            <a class="ont-blog-link" href="<?php echo esc_html($course_link); ?>">LEARN MORE</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?> 
        </div>
    </div>
</section>



<?php get_footer(); ?>