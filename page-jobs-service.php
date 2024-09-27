<?php

/**
 * Template Name: Free TEFL Jobs Service
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$webinar_args = array(
    'numberposts'     => 3,
    'post_type'       => 'webinar',
    'status' => 'published',
    'tax_query'       => array(
        array(
            'taxonomy'       => 'webinar_category',
            'field'          => 'slug',
            'terms'          => array('upcoming'),
        ),
    ),
    'orderby' => 'webinar_date',
    'order' => 'ASC'
);

$webinars = get_posts($webinar_args);

$banner = get_field('banner');
$header = get_field('header');
$team = get_field('team');
$teaching_experience = get_field('teaching_experience');
$blogs = get_field('blogs');
$promo = get_field('promo');
$faq = get_cfvalue_by_country('faq');

get_header();

$gocambio_jobs = ti_jobs_feed();

?>

<section class="banner-section lazy" style="background-image: url(<?php echo $banner['photo'] ?>);">

    <div class="ast-container">
        <div class="ast-row">
            <div class="ast-col-lg-6 ast-col-md-8">
                <div class="banner-content-block">
                    <div class="content-block">
                        <h1 class="section-heading"><?php echo get_repeater_cfvalue_by_country('banner', 'title'); ?></h1>
                        <h3><?php echo get_repeater_cfvalue_by_country('banner', 'subtitle'); ?></h3>
                        <p></p>
                        <p><?php echo get_repeater_cfvalue_by_country('banner', 'slugline'); ?></p>

                        <img class="lazy loaded" src="/wp-content/uploads/2020/11/Group-57.svg" data-src="/wp-content/uploads/2020/11/Group-57.svg" data-was-processed="true">
                    </div>
                    <a href="/wp-content/uploads/2021/04/TEFL-Institute-Study-Prospectus-Interactive.pdf">Download Brochure <i class="fa fa-angle-right"></i></a>
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
                <img src="/wp-content/uploads/2021/07/job-hunters-mock.png">
            </div>
            <div class="ast-col-md-6 ast-col-sm-12 brochure_content_col">
                <div class="brochure_content">
                    <div class="brochure-title">Job Hunter's Guide</div>
                    <div class="brochure-content">Your first steps to becoming a fully accredited, internationally recognised EFL/ESL teacher within 4 weeks!</div>
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


<!-- <section class="banner-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-lg-12">
				<div class="promo" style="background: url('<?php echo $banner['photo'] ?>')"></div>
				<div class="strip">
                    <p><?php echo $banner['slugline'] ?></p>
                    <div class="button" data-toggle="modal" data-target="#brochure">Download brochure</div>
                </div>
				<div class="hr"></div>
			</div>
		</div>
	</div>
</section> -->

<?php $featured_jobs = get_field('featured_jobs'); ?>
<?php if ($featured_jobs) { ?>
    <section class="jobs-section">
        <div class="ast-container">
            <h2>Featured Teaching Placements Abroad - TEFL Training & Guaranteed Interview</h2>
            <div class="ast-row">
                <?php foreach ($featured_jobs as $element) {
                    $background = $element['background'];
                    $salary = $element['salary'];
                    $title = $element['title'];
                    $info = $element['info'];
                    $link = $element['link']; ?>
                    <div class="ast-col-md-4 ast-col-sm-12 ast-col-xs-12 job-col">
                        <div class="job">
                            <a href="<?php echo $link; ?>" class="background" style="background-image:url('<?php echo $background; ?>');">
                                <?php if ($salary) { ?><div class="salary"><?php echo $salary; ?></div><?php } ?>
                            </a>
                            <div class="title"><?php echo $title; ?></div>

                            <?php foreach ($info as $e) {
                                $icon = $e['icon'];
                                $content = $e['content']; ?>
                                <p class="info">
                                    <span class="icon" style="background-image: url('<?php echo $icon; ?>')"></span>
                                    <?php echo $content; ?>
                                </p>
                            <?php } ?>

                            <a href="<?php echo $link; ?>">Learn More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<section class="header-section">
    <div class="ast-container">
        <div class="ast-row">
            <div class="ast-col-lg-12">
                <h2><?php echo get_repeater_cfvalue_by_country('header', 'title'); ?></h2>
                <div class="ast-row">
                    <div class="ast-col-lg-6">
                        <p><?php echo get_repeater_cfvalue_by_country('header', 'subtitle'); ?></p>
                    </div>
                    <div class="ast-col-lg-6">
                        <img src="<?php echo get_repeater_cfvalue_by_country('header', 'image'); ?>">
                        <div class="button-container">
                            <?php //if(isset($_GET['debug'])): 
                            ?>
                            <a class="hunter-button black-button"><span>Download Brochure</span><i class="fa fa-angle-right"></i></a>
                            <?php //endif; 
                            ?>
                            <!-- <a href="/wp-content/uploads/2021/08/TEFL-Institute-Job-Hunters-Guide-Landscape-compressed-1.pdf" class="black-button">Download Brochure <i class="fa fa-angle-right"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$ti_jobs = get_ti_jobs(8, false);
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
                    <div class="ast-col-md-3">
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
<?php if (!$gocambio_jobs) : ?>
    <section class="job-section" id="job_section">
        <div class="ast-container">
            <h3>TEFL/TESOL Careers</h3>
            <div class="ast-row">
                <?php $count = 1; ?>
                <?php foreach ($gocambio_jobs as $gj) :
                    if ($count <= 8) :
                        $job_id = $gj->id;
                        $job_title = $gj->title;
                        $job_title = wp_trim_words($job_title, 7, '...');
                        $job_link = $gj->link;
                        $job_logo = $gj->company_logo;
                        $job_type = $gj->type;
                        $job_type = $job_type[0]->name;
                        $job_comp_name = $gj->company_name;
                        $job_location = $gj->job_location;
                        $job_location = wp_trim_words($job_location, 4, '...');
                        $rate_min = $gj->rate_min;
                        $rate_min = preg_replace('/[^0-9]/', '', $rate_min);
                        $rate_max = $gj->rate_max;
                        $rate_max = preg_replace('/[^0-9]/', '', $rate_max);
                        $salary_min = $gj->salary_min;
                        $salary_max = $gj->salary_max;
                        $job_content = $gj->content;
                        $job_currency_code = $gj->job_currency_code;

                        if (empty($job_logo)) {
                            $job_logo = 'https://teflinstitute.com/wp-content/uploads/2021/02/wordpress-581849_640.jpg';
                        }

                        if (!empty($rate_min) && !empty($rate_max)) {
                            $rate = $rate_min . ' - ' . $rate_max . ' ' . $job_currency_code . '/hour';
                        } elseif (!empty($rate_min) && empty($rate_max)) {
                            $rate = $rate_min . ' ' . $job_currency_code . '/hour';
                        } elseif (empty($rate_min) && !empty($rate_max)) {
                            $rate = $rate_max . ' ' . $job_currency_code . '/hour';
                        }

                        if (!empty($salary_min) && !empty($salary_max)) {
                            $salary = $salary_min . ' ' . $job_currency_code . ' - ' . $salary_max . ' ' . $job_currency_code;
                        } elseif (!empty($salary_min) && empty($salary_max)) {
                            $salary = $salary_min . ' ' . $job_currency_code;
                        } elseif (empty($salary_min) && !empty($salary_max)) {
                            $salary = $salary_max . ' ' . $job_currency_code;
                        }

                ?>
                        <div class="ast-col-lg-3 ast-col-md-3 ast-col-sm-12 ast-col-xs-12 job-col job-<?php echo $count; ?> job-<?php echo $job_id; ?>">
                            <div class="job inner-div">
                                <?php if (!empty($job_type) || !empty($job_title) || !empty($job_comp_name) || !empty($job_location)) : ?>
                                    <div class="job__info">
                                        <?php if (!empty($job_type)) : ?>
                                            <p class="job-type"><span><?php echo $job_type; ?></span></p>
                                        <?php endif; ?>
                                        <div class="job__img">
                                            <img src="<?php echo $job_logo; ?>">
                                        </div>
                                        <?php if (!empty($job_title)) : ?>
                                            <h6 class="job-title"><?php echo $job_title; ?></h6>
                                        <?php endif; ?>
                                        <?php if (!empty($job_comp_name)) : ?>
                                            <p class="comp-name"><span class="job-icons" style="background-image: url('https://teflinstitute.com/wp-content/uploads/2021/04/Company.svg')"></span> <?php echo $job_comp_name; ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($job_location)) : ?>
                                            <p class="job-location"><span class="job-icons" style="background-image: url('https://teflinstitute.com/wp-content/uploads/2021/04/Location.svg')"></span> <?php echo $job_location; ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($rate)) : ?>
                                            <p class="job-rate"><span class="job-icons" style="background-image: url('https://teflinstitute.com/wp-content/uploads/2021/04/Payment.svg')"></span> <?php echo $rate; ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($job_link)) : ?>
                                    <div class="job__cta">
                                        <a class="btn" target="_blank" href="<?php echo $job_link; ?>">learn more <i class="fa fa-angle-right"></i></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $count++; ?>
                <?php endforeach; ?>
            </div>
            <div class="button-container">
                <a href="https://jobs.teflinstitute.com/all-jobs" target="_blank" class="black-button">View All Jobs <i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="experience-section">
    <div class="ast-container">
        <h2>Your Online Teaching Experience</h2>
        <h3>In a Nutshell</h3>
        <div class="ast-row">
            <div class="ast-col-lg-12">
                <div class="experience-box">
                    <div class="experience-left-inner">
                        <h2>Working Hours</h2>
                        <p><?php echo $teaching_experience['working_hours']; ?></p>
                    </div>
                    <div class="experience-right-inner">
                        <h2>Class Size</h2>
                        <p><?php echo $teaching_experience['class_size']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team-section">
    <div class="ast-container team-container">
        <h2>Your Expert TEFL Recruitment Team</h2>
        <div class="ast-row team-row">
            <?php
            $array_count = count($team); 
            foreach ($team as $member) :
                $rowCount++;
                $image = $member['photo'];
                $image_position = $member['photo_position'];
                $name = $member['name'];
                $designation = $member['designation'];
                $details = $member['description'];
            ?>

                <div class="team-col ast-col-lg-4 <?php if ($rowCount == $array_count and $array_count > 3) {
                                                        echo 'ast-col-lg-offset-4';
                                                    } ?> ast-col-md-6 ast-col-sm-12">
                    <div class="team-member <?php if ($rowCount == $array_count) {
                                                echo 'last';
                                            } ?>">
                        <div class="team-member-image" style="background-image: url('<?php echo $image ?>'); background-position: <?php echo $image_position ?>;"></div>
                        <h5 class="team-member-name"><?php echo $name ?></h5>
                        <h5 class="team-member-title"><?php echo $designation ?></h5>
                        <p class="team-member-about"><?php echo $details ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="salary-section">

    <div class="ast-container">

        <div class="ast-row">

            <div class="ast-col-md-12">

                <div class="salary-container lazy" style="background-image: url('<?php echo $promo['image']; ?>');">

                    <div class="salary-container-content">

                        <h3><?php echo $promo['title']; ?></h3>
                        <p><?php echo $promo['subtitle']; ?></p>
                        <a class="blog-link" href="<?php echo $promo['link']; ?>">Take the Test <i class="fa fa-angle-right"></i></a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- <section class="salary-calculator-section">
    <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-lg-6">
				<div class="salary-calculator" style="display: block; background-image: url('https://teflinstitute.com/wp-content/uploads/2020/11/pexels-jopwell-2422293-scaled.jpg');">
					<div class="salary-calculator-inner">
						<h6 class="section-heading">Teaching English Online Salary Calculator</h6>
                		<p class="salary-text">There is much information out there about the world of TEFL, mostly with conflicting answers. We have answered all of the frequent questions we are asked including questions on our programs, as well as this, we have tried to simplify and bring clarity to the different types of TEFL qualifications available.</p>
                		<a href="/salary-calculator/"><span>Take The Test</span><i class="fa fa-angle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="ast-col-lg-3">
				<div class="salary-small-box">
					<div class="salary-small-box-title">HOURS:</div>
					<p>The hours you could be expected to work play an important part in your decision. If you work in a classroom, your working days will be determined by the school’s term hours (typically Monday to Friday between 7.30 am and 3.30 pm). Or, in the case of private language schools, classroom hours could be all year round and include evenings. As an online teacher, you will have more flexibility over your schedule, but you’ll have to factor in time zones if you teach students in a different country to where you live.</p>
				</div>
			</div>
			<div class="ast-col-lg-3">
		        <div class="salary-small-box">
					<div class="salary-small-box-title">CLASS SIZE:</div>
					<p>Teaching English in a classroom means you could be teaching class sizes of 12 students up to 50, whereas online classes are usually one-on-one or with a handful of students. In both cases, classroom sizes will depend on the school and what country you are teaching in. But it’s important to think about what class size you’d prefer and feel most comfortable teaching in when deciding whether to teach online or in class.</p>
				</div>
			</div>
		</div>
	</div>
</section> -->


<section class="blog-section">
    <div class="ast-container">
        <h2>Recommended Readings</h2>
        <div class="ast-row blog-row">
            <?php foreach ($blogs as $uc) :

                $post_id            = $uc->ID;
                $post_title         = get_the_title($post_id);
                $post_thumbnail_url = get_the_post_thumbnail_url($post_id);
                $post_link          = get_the_permalink($post_id); ?>
                <div class="ast-col-md-4 blog-col">
                    <div class="blog-item" style="background: url('<?php echo $post_thumbnail_url; ?>')">
                        <div class="bolg-content">
                            <h3><?php echo $post_title; ?></h3>
                            <a class="blog-link" href="<?php echo $post_link; ?>" target="_blank">READ MORE <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- <div class="button-container">
			<a href="https://gocambio.com/" target="_blank" class="black-button">Find your perfect TEFL job</a>
		</div> -->
    </div>
</section>


<?php if ($faq) : ?>
    <section class="faq-section">

        <div class="ast-container">

            <h3>FAQ's</h3>

            <div class="ast-row">

                <?php foreach ($faq as $element) {
                    $question = $element['question'];
                    $answer = $element['answer']; ?>

                    <div class="ast-col-md-4">

                        <div class="faq-box">

                            <h4><?php echo $question ?></h4>
                            <p><?php echo $answer ?></p>

                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>

    </section>
<?php endif; ?>


<?php get_footer(); ?>