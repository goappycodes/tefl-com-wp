<?php

/**
 * The template for displaying all single country job.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */



if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

?>

<div id="primary" <?php astra_primary_class(); ?>>
    
    <?php 
        $page_title = get_field('page_title');
        $page_sub_title = get_field('page_sub_title');
        $post_featured_image = get_the_post_thumbnail_url(); 
    ?>
    <div class="hero" style="background-image: url('<?php echo esc_url($post_featured_image); ?>');">
        <?php if($page_title): ?>
            <h1><?php echo $page_title; ?></h1>
        <?php endif; ?>
    </div>
    
    <?php
        $job_location_name = get_the_title();
        $job_title = get_field('job_title');
        $content = get_field('content'); 
        $country_image = get_field('country_image'); 
        $post_ID = get_the_ID();
    ?>
    <div class="section main-content-section">
        <div class="ast-row ast-flex main-content-row read-more-section">
            <div class="ast-col-md-7 main-content-col">
                <h2 class="main-section-title"><?php echo $job_title; ?></h2>
                <div class="section-links">
                    <a href="#living_costs"><?php echo $post_ID === 67449 ? 'Where to find a job teaching online':'Living costs'?></a>
                    <a href="#key_facts">Key facts</a>
                    <a href="#faq">FAQ’s</a>
                    <a href="#student_story">Student Story</a>
                    <a href="#jobs"><?php echo $job_title; ?></a>
                </div>
                <div class="section-content"><?php the_content(); ?></div>
            </div>
            <div class="ast-col-md-5 main-content-img-col">
                <?php foreach($country_image as $ci):
                    $alt_img_name = basename($ci); ?>
                    <div class="country-image-div"><img src="<?php echo $ci; ?>" alt="<?php echo $alt_img_name; ?>"></div>
                <?php endforeach; ?>
            </div>
            <div class="read-more-btn"><a href="javascript:void(0);">Read more <i class="fa fa-angle-down"></i></a></div>
            <div class="read-less-btn"><a href="javascript:void(0);">Close <i class="fa fa-angle-up"></i></a></div>
        </div>
    </div>
    
    <?php $living_cost = get_field('living_costs');
    if($living_cost) :
        $living_cost_content = $living_cost['content'];
        $living_cost_featured_points = $living_cost['featured_points'];
        if($living_cost_content || $living_cost_featured_points) : ?>
            <div id="living_costs" class="section living-cost-section">
                <div class="ast-row living-cost-row">
                    <div class="ast-col-md-12 living-cost-heading-col">
                        <h2 class="main-section-title"><?php echo $post_ID === 67449 ? 'Where to find a job teaching online':'Living costs'?></h2>
                    </div>
                </div>
                <div class="ast-row ast-flex living-cost-row">
                    <?php if($living_cost_content) : ?>
                        <div class="ast-col-md-7 living-cost-content-col">
                            <div class="section-content"><?php echo $living_cost_content; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if($living_cost_featured_points) : ?>
                        <div class="ast-col-md-5 living-cost-feature-col">
                            <ul class="living-cost-features">
                            <?php foreach($living_cost_featured_points as $lc_fp):
                                $fp_title = $lc_fp['title'];
                                $fp_content = $lc_fp['content'];
                                if($fp_title && $fp_content) :  ?>
                                    <li class="feature-point"><b><?php echo $fp_title.': '; ?></b><?php echo $fp_content; ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php $key_points = get_field('key_points');
    if($key_points) : ?>
        <div class="section key-points-section">
            <div class="ast-row key-points-heading-row">
                <div class="ast-col-md-12 key-points-heading-col">
                    <h3 class="sub-main-section-title center"><?php echo $job_title.': '; ?> KEY POINTS</h3>
                </div>
            </div>
            <div class="ast-row ast-flex key-points-row">
                <?php foreach($key_points as $kp) :
                    $key_points_icon = $kp['icon'];
                    $alt_img_name = basename($key_points_icon);
                    $key_points_title = $kp['title'];
                    $key_points_content = $kp['content'];
                    if($key_points_icon && $key_points_title && $key_points_content): ?>
                        <div class="ast-col-md-3 key-points-col">
                            <div class="key-points-div">
                                <div class="key-points-icon">
                                    <img src="<?php echo $key_points_icon; ?>" alt="<?php echo $alt_img_name; ?>">
                                </div>
                                <p class="key-points-title"><?php echo $key_points_title; ?></p>
                                <p class="key-points-content"><?php echo $key_points_content; ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    
    <?php $key_facts = get_field('key_facts');
    if($key_facts) :
        $key_facts_featured_points = $key_facts['featured_points'];
        $key_facts_content = $key_facts['content'];
        if($key_facts_featured_points || $key_facts_content) : ?>
            <div id="key_facts" class="section key-facts-section">
                <div class="ast-row key-facts-heading-row">
                    <div class="ast-col-md-12 key-facts-heading-col">
                        <h2 class="main-section-title">KEY FACTS</h2>
                    </div>
                </div>
                <div class="ast-row ast-flex key-facts-row">
                    <?php if($key_facts_featured_points) : ?>
                        <div class="ast-col-md-6 key-facts-feature-col">
                            <ul class="living-cost-features">
                            <?php foreach($key_facts_featured_points as $kf_fp):
                                $kf_fp_title = $kf_fp['title'];
                                $kf_fp_content = $kf_fp['content'];
                                if($kf_fp_title && $kf_fp_content) :  ?>
                                    <li class="feature-point"><b><?php echo $kf_fp_title.': '; ?></b><?php echo $kf_fp_content; ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if($key_facts_content) : ?>
                        <div class="ast-col-md-6 key-facts-content-col">
                            <div class="section-content"><?php echo $key_facts_content; ?></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="read-more-btn"><a href="javascript:void(0);">Read more <i class="fa fa-angle-down"></i></a></div>
                <div class="read-less-btn"><a href="javascript:void(0);">Close <i class="fa fa-angle-up"></i></a></div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php $facts = get_field('facts'); ?>
    <?php $country_name = get_field('country_name'); ?>
    <div class="section facts-section">
        <div class="ast-row facts-heading-row">
            <div class="ast-col-md-12 facts-heading-col">
                <h3 class="sub-main-section-title center">Facts about <?php echo $country_name; ?></h3>
            </div>
        </div>
        <div class="ast-row facts-row">
            <!-- <div class="ast-col-md-2"></div> -->
            <div class="ast-col-md-12 facts-col">
                <div class="ast-row facts-inner-row ast-flex">
                    <?php foreach($facts as $fact) :
                        $fact_icon = $fact['icon'];
                        $alt_img_name = basename($fact_icon);
                        $fact_title = $fact['title'];
                        $fact_content = $fact['content']; ?>
                        <div class="ast-col-md-2 facts-inner-col">
                            <div class="facts-div">
                                <div class="facts-icon">
                                    <img src="<?php echo $fact_icon; ?>" alt="<?php echo $alt_img_name; ?>">
                                </div>
                                <p class="facts-title"><?php echo $fact_title; ?></p>
                                <p class="facts-content"><?php echo $fact_content; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- <div class="ast-col-md-2"></div> -->
        </div>
    </div>

    <?php $faqs = get_field('faqs');
    if($faqs) : 
        $faq_img = $faqs['image'];
        $alt_img_name = basename($faq_img);
        $faq_content = $faqs['faq_content'];
        if($faq_content): ?>
            <div id="faq" class="section faqs-section">
                <div class="ast-row faqs-row">
                    <div class="ast-col-md-6 faqs-img-col">
                        <img src="<?php echo $faq_img; ?>" alt="<?php echo $alt_img_name; ?>">
                    </div>
                    <div class="ast-col-md-6 faqs-content-col">
                        <h3 class="sub-main-section-title center"><?php echo $job_title.': '; ?> FAQS</h3>
                        <div class="faq-content-div">
                            <div class="panel-group" id="accordion">
                                <?php $count = 1;
                                foreach ($faq_content as $faq) :
                                    $question = $faq['question'];
                                    $answer = $faq['answer']; ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading-wrapper" aria-expanded="<?php echo ($count == 1)? 'true' : 'false';  ?>">
                                            <div class="panel-side">Q:</div>
                                            <div class="panel-heading">
                                                <h4 class="panel-title" data-toggle="collapse" data-target="#collapse<?php echo $count; ?>"><?php echo $question ?></h4>
                                            </div>
                                        </div>
                                        <div id="collapse<?php echo $count; ?>" class="panel-collapse collapse <?php if($count == 1) echo 'show'; ?>">
                                            <div class="panel-body panel-extra-space"><?php echo $answer ?></div>
                                        </div>
                                    </div>
                                <?php $count++;
                                endforeach; ?>
                                
                                <script type="application/ld+json">
                    						{
                    						  "@context": "https://schema.org",
                    						  "@type": "FAQPage",
                    						  "mainEntity": [
                    						  	<?php 
                    							$faqcount = count($faq_content);
                    							$counter = 0;
                    							foreach ($faq_content as $item) {
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
        <?php endif; ?>
    <?php endif; ?>
   
    <?php $teacher_story = get_field('teacher_story');
    if($teacher_story) : 
        $teacher_story_content = $teacher_story['content'];
        $teacher_name_designation = $teacher_story['name_&_designation'];
        $teacher_story_img = $teacher_story['image'];
        $alt_img_name = basename($teacher_story_img);
        if($teacher_story_content): ?>
            <div id="student_story" class="section teacher-story-section">
                <div class="ast-row teacher-story-heading-row">
                    <div class="ast-col-md-12 teacher-story-heading-col">
                        <h3 class="sub-main-section-title">Teacher Story</h3>
                    </div>
                </div>
                <div class="ast-row teacher-story-row">
                    <div class="ast-col-md-6 teacher-story-content-col">
                        <div class="teacher-story-content-div">
                            <div class="teacher-story-content">
                                <?php echo $teacher_story_content; ?>
                            </div>
                            <?php if($teacher_name_designation): ?>
                                <h6 class="name-and-designation"><?php echo $teacher_name_designation; ?></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="ast-col-md-6 teacher-story-img-col">
                        <div class="teacher-story-img-div">
                            <img src="<?php echo $teacher_story_img; ?>" alt="<?php echo $alt_img_name;?>">
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php 
    if($job_location_name) : 
        
        $response_body_decoded = get_ti_jobs_location($job_location_name);
        
        if($response_body_decoded) : ?>
            <div id="jobs" class="section job-section">
                <div class="ast-row job-heading-row">
                    <div class="ast-col-md-12 job-heading-col">
                        <h2 class="main-section-title">LATEST JOBS</h2>
                    </div>
                </div>
                <div class="ast-row ast-flex job-row">
                    <?php foreach($response_body_decoded as $job):
                        $company_logo = $job->company_logo;
                        $alt_img_name = basename($company_logo);
                        $job_title = $job->title; 
                        $company_name = $job->company_name;
                        $job_location = $job->job_location;
                        $job_type = $job->type;
                        $job_type = $job_type[0]->name;
                        $job_link = $job->link;
                        $job_salary = $job->salary; ?>
                        <div class="ast-col-md-3 ast-flex job-col">
                            <div class="job-div">
                                <div class="job-inner-div">
                                    <div class="comp-logo-div">
                                        <img class="comp-logo" src="<?php echo $company_logo; ?>" alt="<?php echo $alt_img_name; ?>">
                                    </div>
                                    <p class="apply-now-tag"><span>Apply Now</span></p>
                                    <h5 class="job-title"><?php echo $job_title; ?></h5>
                                    <div class="features-div">
                                        <p class="job-comp-name"><img src="/wp-content/uploads/2022/05/company-name-icon-removebg-preview.png"><span><?php echo $company_name; ?></span></p>
                                        <p class="job-location"><img src="/wp-content/uploads/2022/05/location_icon-removebg-preview.png"><span><?php echo $job_location; ?></span></p>
                                        <p class="job-salary"><img src="/wp-content/uploads/2022/05/money_icon-removebg-preview.png"><span><?php echo $job_salary; ?></span></p>
                                        <h6 class="job-type"><span><?php echo $job_type; ?></span></h6>
                                    </div>
                                </div>
                                <div class="learn-more-btn"><a href="<?php echo $job_link; ?>"><span>Learn More</span><i class="fa fa-angle-right"></i></a></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    
    <?php endif; ?>
    
    <?php $other_links = get_field('other_links')??[]; 
        if(isset($other_links)):
    ?>
    <div class="section tefl-courses-internship-job-section">
        <div class="ast-row tefl-courses-internship-job-row">
            <?php foreach($other_links as $e) :
                $title = $e['title'];
                $content = $e['content'];
                $image = $e['image']; 
                $cta = $e['cta']; 
            ?>
            <div class="ast-col-md-4 tefl-courses-col">
                <div class="col-div tefl-courses-div">
                    <h5 class="col-heading"><?php echo $title; ?></h5>
                    <p class="content"><?php echo $content; ?></p>
                    <img src="<?php echo $image; ?>">
                    <div class="btn-div">
                        <a class="btn btn-primary" href="<?php echo $cta['link']; ?>"><?php echo $cta['value']; ?></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>  
    </div>
        <?php endif; ?>
    <!-- Quick links Section -->
    <div class="section tefl-courses-internship-job-section">
        <div class="ast-row tefl-courses-internship-job-row">
            <div class="ast-col-md-4 tefl-courses-col">
                <div class="col-div tefl-courses-div">
                    <h5 class="col-heading">TEFL courses</h5>
                    <p class="content">Become a confident, qualified English teacher with flexible online, classroom or mixed learning.</p>
                    <img src="/wp-content/uploads/2022/04/online-g3b2301855_1920.jpg">
                    <div class="btn-div">
                        <a class="btn btn-primary" href="/tefl-courses">View our Tefl Courses</a>
                    </div>
                </div>
            </div>
            <div class="ast-col-md-4 tefl-courses-col">
                <div class="col-div tefl-courses-div">
                    <h5 class="col-heading">TEFL internship</h5>
                    <p class="content">With accommodation, training and full in-country support sorted – it’s the hassle-free way to kick-start your TEFL career.</p>
                    <img src="/wp-content/uploads/2022/03/road-g33f30ef59_1920.jpg">
                    <div class="btn-div">
                        <a class="btn btn-primary" href="/tefl-internships">View our internships</a>
                    </div>
                </div>
            </div>
            <div class="ast-col-md-4 tefl-courses-col">
                <div class="col-div tefl-courses-div">
                    <h5 class="col-heading">TEFL jobs</h5>
                    <p class="content">Check out new TEFL job listings on our sister company’s well-stocked jobs board.</p>
                    <img src="/wp-content/uploads/2022/04/classroom-2093744_1920.jpg">
                    <div class="btn-div">
                        <a class="btn btn-primary" href="https://jobs.teflinstitute.com/?ref=ticom">view TEFL jobs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
</div><!-- #primary -->

<?php get_footer(); ?>