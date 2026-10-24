<?php

/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

global $post;
$course_id = $post->ID;
$is_virtual_couse = get_field('is_virtual_couse');

$course_category = wp_get_post_terms($course_id, 'course_category', array('fields' => 'ids'));
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "<?php echo get_the_title(); ?>",
  "description": "<?php echo get_the_title(); ?>",
  "offers": {
    "category": "TEFL",
    "@type": "AggregateOffer",
    "priceCurrency": "USD"
  },
  "hasCourseInstance": {
    "@type": "CourseInstance",
    "courseMode": "Online",
    "courseWorkload": "PT150H",
    "startDate": "2025-05-01",
    "endDate": "2025-10-28"
  },
  "CourseInstance": "",
  "courseMode": [
    "online"
  ],
  "provider": {
    "@type": "Organization",
    "name": "THE TEFL INSTITUTE",
    "sameAs": "https://teflinstitute.com/"
  }
}
</script>

<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "BreadcrumbList",
        "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "https://teflinstitute.com/"
        }, {
            "@type": "ListItem",
            "position": 2,
            "name": "TEFL Courses",
            "item": "https://teflinstitute.com/tefl-courses/"
        }, {
            "@type": "ListItem",
            "position": 3,
            "name": "<?php echo get_the_title(); ?>",
            "item": "<?php echo get_the_permalink(); ?>"
        }]
    }
</script>
<?php if (astra_page_layout() == 'left-sidebar') : ?>

    <?php get_sidebar(); ?>
    
<?php endif ?>

<?php

if (get_field('is_new_design')) {
    include('single-course-template-new2023.php');
} 
else if(get_field('is_2024_design')){
  include('single-course-template-2024.php');
}
else {
    include('single-course-template.php');
}

?>

<?php if (astra_page_layout() == 'right-sidebar') : ?>

    <?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>