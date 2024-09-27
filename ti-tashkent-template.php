<?php

/**
 * Template Name: TEFL Course in Tashkent Uzbekistan
 * 
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Przemysław Solan <przemek.solan@teflinstitute.com>
 * @date 30th November 2023
 */

 if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); 

$hero = get_field('hero');

    $page_title = get_field('page_title');

    $page_sub_title = get_field('page_sub_title');

    $post_featured_image = get_the_post_thumbnail_url(); 

$job_types = get_field('job_types');

$qualifications = get_field('qualifications');

$requirements = get_field('requirements');

$locations = get_field('locations');

$culture = get_field('culture');

$key_facts = get_field('key_facts');

$living_costs = get_field('living_costs');

$faq = get_field('faq');

?>

<div id="primary" class="content-area primary">

    <section class="section">

        <div class="hero" style="background-image: url('<?php echo esc_url($post_featured_image); ?>');">

            <?php if($page_title): ?>

                <h1><?php echo $page_title; ?></h1>
                
            <?php endif; ?>

        </div>

        <h2 class="heading"><?php echo $hero['title']; ?></h2>

        <div class="content"><?php echo $hero['content']; ?></div>

    </section>

    <section class="section">

        <h2 class="heading"><?php echo $job_types['title']; ?></h2>

        <div class="content"><?php echo $job_types['content']; ?></div>

    </section>

    <section class="section">

        <h2 class="heading"><?php echo $qualifications['title']; ?></h2>

        <div class="content"><?php echo $qualifications['content']; ?></div>

    </section>

    <section class="section">

        <h2 class="heading"><?php echo $requirements['title']; ?></h2>

        <div class="content"><?php echo $requirements['content']; ?></div>

    </section>

    <section class="section">

        <h2 class="heading"><?php echo $locations['title']; ?></h2>

        <div class="content"><?php echo $locations['content']; ?></div>

    </section>

    <section class="section">

        <h2 class="heading"><?php echo $culture['title']; ?></h2>

        <div class="content"><?php echo $culture['content']; ?></div>

    </section>

    <section class="section">

        <h2 class="heading"><?php echo $key_facts['title']; ?></h2>

        <div class="content"><?php echo $key_facts['content']; ?></div>

    </section>

    <section class="section">

        <h2 class="heading"><?php echo $living_costs['title']; ?></h2>

        <div class="content"><?php echo $living_costs['content']; ?></div>

    </section>

    <section class="section">

        <h2 class="heading"><?php echo $faq['title']; ?></h2>

        <div class="content"><?php echo $faq['content']; ?></div>

    </section>

</div>

<?php get_footer(); ?>