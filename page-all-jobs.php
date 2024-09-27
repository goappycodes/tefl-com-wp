<?php
/**
* Template Name: All TEFL Jobs
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



get_header(); 

$gocambio_jobs = ti_jobs_feed();

?>

<section class="banner-section">
    <div class="ast-container" style="background: url('https://teflinstitute.com/wp-content/uploads/2021/02/gabriel-benois-qnWPjzewewA-unsplash-1-scaled.jpg')">
		<div class="ast-row">
		    <div class="ast-col-lg-12">
				<div class="search-bar">
                    <input class="job-search" type="text" placeholder="Job Search..">
                </div>
			</div>
		</div>
	</div>
</section>


<?php if($gocambio_jobs) : ?>
<section class="job-section">
	<div class="ast-container">
		<h1 class="section-heading">Jobs</h1>
		<img src="https://teflinstitute.com/wp-content/uploads/2021/02/loader.gif" class="job-preloader">
		<div class="ast-row job-row">
			<?php $count=1; ?>
			<?php foreach($gocambio_jobs as $gj) : 
				$job_id = $gj->id;
				$job_title = $gj->title;
				$job_title = wp_trim_words( $job_title, 7, '...' );
				$job_link = $gj->link;
				$job_logo = $gj->company_logo;
				$job_type = $gj->type;
				$job_type = $job_type[0]->name;
				$job_comp_name = $gj->company_name;
				$job_location = $gj->job_location;
				$job_location = wp_trim_words( $job_location, 4, '...' );
				$rate_min = $gj->rate_min;
				$rate_min = preg_replace('/[^0-9]/', '', $rate_min);
				$rate_max = $gj->rate_max;
				$rate_max = preg_replace('/[^0-9]/', '', $rate_max);
				$salary_min = $gj->salary_min;
				$salary_max = $gj->salary_max;
				$job_content = $gj->content;
				$job_currency_code = $gj->job_currency_code;

				if(empty($job_logo)){
					$job_logo = 'https://teflinstitute.com/wp-content/uploads/2021/02/wordpress-581849_640.jpg';
				}

				if(!empty($rate_min) && !empty($rate_max)){
					$rate = $rate_min.' - '.$rate_max.' '.$job_currency_code.'/hour';
				}elseif(!empty($rate_min) && empty($rate_max)){
					$rate = $rate_min.' '.$job_currency_code.'/hour';
				}elseif(empty($rate_min) && !empty($rate_max)){
					$rate = $rate_max.' '.$job_currency_code.'/hour';
				}

				if(!empty($salary_min) && !empty($salary_max)){
					$salary = $salary_min.' '.$job_currency_code.' - '.$salary_max.' '.$job_currency_code;
				}elseif(!empty($salary_min) && empty($salary_max)){
					$salary = $salary_min.' '.$job_currency_code;
				}elseif(empty($salary_min) && !empty($salary_max)){
					$salary = $salary_max.' '.$job_currency_code;
				}
				
				?>
				<div class="ast-col-lg-3 ast-col-md-3 ast-col-sm-12 ast-col-xs-12 job-col job-<?php echo $count; ?> job-<?php echo $job_id; ?>">
						<div class="job inner-div">
						    <?php if(!empty($job_type) || !empty($job_title) || !empty($job_comp_name) || !empty($job_location)): ?>
							    <div class="job__info">
							    	<?php if(!empty($job_type)): ?>
							    		<p class="job-type"><span><?php echo $job_type; ?></span></p>
							    	<?php endif; ?>
									<div class="job__img">
										<img src="<?php echo $job_logo; ?>">
									</div>
							    	<?php if(!empty($job_title)): ?>
							        	<h6 class="job-title"><?php echo $job_title; ?></h6>
							        <?php endif; ?>
							        <?php if(!empty($job_comp_name)): ?>
							        	<p class="comp-name"><span class="job-icons" style="background-image: url('https://teflinstitute.com/wp-content/uploads/2021/04/Company.svg')"></span> <?php echo $job_comp_name; ?></p>
							        <?php endif; ?>
							        <?php if(!empty($job_location)): ?>
							        	<p class="job-location"><span class="job-icons" style="background-image: url('https://teflinstitute.com/wp-content/uploads/2021/04/Location.svg')"></span> <?php echo $job_location; ?></p>
							        <?php endif; ?>
							        <?php if(!empty($rate)): ?>
							        	<p class="job-rate"><span class="job-icons" style="background-image: url('https://teflinstitute.com/wp-content/uploads/2021/04/Payment.svg')"></span> <?php echo $rate; ?></p>
							        <?php endif; ?>
							    </div>
							<?php endif; ?>
							<?php if(!empty($job_link)): ?>
							    <div class="job__cta">
							        <a class="btn" target="_blank" href="<?php echo $job_link; ?>">learn more <i class="fa fa-angle-right"></i></a>
							    </div>
							<?php endif; ?>
						</div>
					</div>
				<?php $count++; ?>
			<?php endforeach; ?>
		</div>

		<div id="loadMore">Load more</div>

	</div>
</section>
<?php endif; ?>


<?php get_footer(); ?>