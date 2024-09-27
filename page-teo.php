<?php
/**
* Template Name: Teach English Online
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$hero = get_field('hero');
$main = get_field('main');
$get_started = get_field('get_started');
$why_teach_english_online = get_field('why_teach_english_online');
$explained = get_field('explained');
$teo_courses = get_field('teo_courses');
$english_level_test = get_field('english_level_test');
$faq = get_cfvalue_by_country('faq');

$gocambio_jobs = ti_online_tefl_job_feed();

get_header(); 

?>

<section class="banner-section" style="background-image: url('<?php echo $hero['image']; ?>');">

    <div class="ast-container">

		<div class="ast-row">

		    <div class="ast-col"></div>

		</div>

	</div>

</section>

<section class="header-section">
    
    <div calss="ast-container">

        <div class="ast-row">

            <div class="ast-col-lg-7">

                <h1 class="section-heading"><?php echo get_repeater_cfvalue_by_country('hero', 'title'); ?></h1>
                <p><?php echo $hero['subtitle']; ?></p>

            </div>
           
        </div>

    </div>
    
</section>

<section class="main-section">
    
    <div calss="ast-container">

        <div class="ast-row">

            <div class="ast-col-lg-6">

                <img src="<?php echo $main['top']['image']; ?>" class="main-image">

            </div>
           
			<div class="ast-col-lg-6">
				
				<div class="main-box">
                	<h3 class="section-heading"><?php echo $main['top']['title']; ?></h3>
					<p><?php echo $main['top']['description']; ?></p>
				</div>

            </div>
           
        </div>

    </div>
    
</section>

<section class="main-section">
    
    <div calss="ast-container">

        <div class="ast-row">

			<div class="ast-col-lg-6">

				<div class="main-box">
                	<h3 class="section-heading"><?php echo get_group_cfvalue_by_country('main', 'bottom', 'title'); ?></h3>
					<p><?php echo get_group_cfvalue_by_country('main', 'bottom', 'description'); ?></p>
				</div>

			</div>

			<div class="ast-col-lg-6">

				<img src="<?php echo $main['bottom']['image']; ?>" class="main-image">

			</div>

           
        </div>

    </div>
    
</section>

<section class="main-section">
    
    <div calss="ast-container">

        <div class="ast-row">

            <div class="ast-col-lg-12">

                <div class="get-started">

					<h3><?php echo $get_started['title']; ?></h3>
                	<p><?php echo $get_started['description']; ?></p>

					<div class="timeline">
						<div class="timeline-item">
							<div class="timeline-arrow"></div>
							<div class="number">1</div>
							<p>Enrol onto your accredited or Ofqual-regulated Level 5 TEFL course.</p>
						</div>
						<div class="timeline-item">
							<div class="timeline-arrow"></div>
							<div class="number">2</div>
							<p>Complete your TEFL course at your pace with 24/7 online access & academic support</p>
						</div>
						<div class="timeline-item">
							<div class="timeline-arrow"></div>
							<div class="number">3</div>
							<p>Get job hunting advice from our experienced team & apply for online TEFL jobs.</p>
						</div>
						<div class="timeline-item">
							<div class="number">4</div>
							<p>Land your dream job & start teaching English online!</p>
						</div>
					</div>

					<a class="" href="<?php echo $get_started['link']; ?>">See our courses <i class="fa fa-angle-right"></i></a>

				</div>

            </div>
           
        </div>

    </div>
    
</section>

<section class="why-teach-section">
    
    <div calss="ast-container">

		<h2 class="section-heading"><?php echo $why_teach_english_online['title']; ?></h2>

		<div class="ast-row">

			<?php foreach($why_teach_english_online['items'] as $element) {
				$icon = $element['icon'];
				$description = $element['description']; ?>

				<div class="ast-col-lg-3">

					<div class="why-teach-box">

						<img src="<?php echo $icon ?>">
						<p><?php echo $description ?></p>

					</div>
					
				</div>

			<?php } ?>

		</div>

    </div>
    
</section>

<section class="explained-section">
    
    <div calss="ast-container">

		<h2 class="section-heading"><?php echo $explained['title']; ?></h2>
		<p><?php echo $explained['subtitle']; ?></p>

		<div class="ast-row">

			<div class="ast-col-12">

				<div class="explained-video" style="background-image: url('<?php echo $explained['thumbnail']; ?>')">
				
					<a href="<?php echo $explained['youtube']; ?>" data-lity class="video-caption-link lity-video">
						<span class="video-icon"></span>
					</a>
				
				</div>

			</div>
		
		</div>

    </div>
    
</section>

<section class="teo-courses-section">
    
    <div calss="ast-container">

		<h3 class="section-heading"><?php echo get_repeater_cfvalue_by_country('teo_courses','title'); ?></h3>
        <p><?php echo get_repeater_cfvalue_by_country('teo_courses','description'); ?></p>

        <div class="ast-row">

			<?php foreach($teo_courses['courses'] as $element) {
				$badge = $element['badge'];
				$background = $element['background'];
				$title = $element['title'];
				$subtitle = $element['subtitle'];
				$learn_more = $element['learn_more']; ?>

				<div class="ast-col-lg-4">

					<div class="teo-course-box" style="background-image: url('<?php echo $background; ?>')">

						<div class="teo-course-inner">

							<img class="badge" src="<?php echo $badge ?>">
							<div class="title"><?php echo $title ?></div>
							<div class="subtitle"><?php echo $subtitle ?></div>
							<a href="<?php echo $learn_more ?>" class="link">Learn More</a>

						</div>

					</div>

				</div>

			<?php } ?>
           
        </div>

    </div>
    
</section>

<section class="test-section">

    <div class="ast-container">

		<div class="ast-row">

		    <div class="ast-col-md-12">

		        <div class="test-container lazy" style="background-image: url('<?php echo $english_level_test['background']; ?>');">

		            <div class="test-container-content">

		                <h3><?php echo $english_level_test['title']; ?></h3>
		                <p><?php echo $english_level_test['subtitle']; ?></p>
		                <a class="blog-link" href="<?php echo $english_level_test['link']; ?>">Take the Test <i class="fa fa-angle-right"></i></a>

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
                    $job_start_date  = $job->job_start_date ?? '';
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


<section class="faq-section">

    <div class="ast-container">

		<h3>FAQ's</h3>

		<div class="ast-row">

			<?php foreach($faq as $element) {
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

<?php get_footer(); ?>