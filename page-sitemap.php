<?php
/**
* Template Name: Sitemap
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


$banner = get_field('banner');

get_header(); 

?>

<style>
	.header-section {
    margin: 50px 0;
}

.category-section {
    border-top: 1px solid #eaeaea;
    padding: 20px 0;
    margin-bottom: 100px;
}

.category-section h3 {
    width: 25%;
    position: sticky;
}

.category-section .ast-col {
    display: flex;
    align-items: flex-start;
}

.category-section-item {
    width: 75%;
    margin: 0;
    flex-wrap: wrap;
    justify-content: space-between;
    display: flex;
    list-style: none;
}

.category-section-item li {
    width: 28%;
    margin-bottom: 10px;
	line-height: 1.5;
}

</style>

<section class="header-section">

	<div class="ast-container">

		<div class="ast-row">

			<div class="ast-col">

				<h1>Sitemap</h1>
			
			</div>

		</div>

	</div>

</section>

<section class="category-section">

	<div class="ast-container">

		<div class="ast-row">

			<div class="ast-col">

				<h3>About</h3>
				
				<ul class="category-section-item">
					<li><a href="/tefl-courses/">TEFL Courses</a></li>
					<li><a href="/tefl-jobs/">TEFL Jobs</a></li>
					<li><a href="/meet-the-team/">Meet the Team</a></li>
					<li><a href="/about-us/">About Us</a></li>
					<li><a href="/blog/">Journal</a></li>
					<li><a href="/contact-us/">Get in Touch</a></li>
					<li><a href="/tefl-support-center/">Support Center</a></li>
				</ul>
				
			</div>

		</div>

	</div>

</section>

<section class="category-section">

	<div class="ast-container">

		<div class="ast-row">

			<div class="ast-col">

				<h3>Courses</h3>
				
				<ul class="category-section-item">
					<li><a href="/course/120-hour-advanced-tefl-course/">120 Hour Advanced TEFL Course</a></li>
					<li><a href="/course/180-hour-professional-tefl-course/">180 Hour Professional TEFL Course</a></li>
					<li><a href="/course/240-hour-master-tefl-course/">240 Hour Master TEFL Course</a></li>
					<li><a href="/course/180-hour-government-regulated-level-5-tefl-course/">180 Hour Level 5 TEFL Course</a></li>
					<li><a href="/course/240-hour-government-regulated-level-5-tefl-course/">240 Hour Level 5 TEFL Course</a></li>
					<li><a href="/course/300-hour-government-regulated-level-5-tefl-course/">300 Hour Level 5 TEFL Course</a></li>
					<li><a href="/course/10-hour-virtual-tefl-course/">10 Hour Virtual TEFL Course</a></li>
					<li><a href="/course/130-hour-hybrid-tefl-course/">130 Hour Hybrid TEFL Course</a></li>
					<li><a href="/course/190-hour-hybrid-level-5-tefl-course/">190 Hour Level 5 Hybrid TEFL Course</a></li>
					<li><a href="/course/310-hour-level-5-hybrid-tefl-course/">310 Hour Level 5 Hybrid TEFL Course</a></li>
					<li><a href="/course/specialist-online-teacher-course/">Specialist Online Teacher Course</a></li>
					<li><a href="/course/30-hour-learn-how-to-teach-english-online/">30 Hour Teaching English Online</a></li>
					<li><a href="/course/30-hour-teaching-young-learners/">30 Hours Teaching Young Learners</a></li>
					<li><a href="/course/30-hour-teaching-business-english-course/">30 Hour Teaching Business English</a></li>
					<li><a href="/course/30-hour-teaching-ielts-exam-preparation/">30 Hour IELTS Specialist</a></li>
					<li><a href="/course/30-hour-teaching-toeic-course/">30 Hour TOEIC Preparation</a></li>
					<li><a href="/course/30-hour-advanced-grammar-for-english-teachers/">30 Hour Advanced Grammar Course</a></li>
				</ul>
				
			</div>

		</div>

	</div>

</section>

<section class="category-section">

	<div class="ast-container">

		<div class="ast-row">

			<div class="ast-col">

				<h3>Pages</h3>
				
				<ul class="category-section-item">
					<li><a href="/become-an-affiliate/">Become an affiliate</a></li>
					<li><a href="/newsletter/">Newsletter</a></li>
					<li><a href="/tefl-shop/">TEFL Shop</a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
					<li><a href=""></a></li>
				</ul>
				
			</div>

		</div>

	</div>

</section>

<?php get_footer(); ?>