<?php
/**
* Template Name: Where can TEFL take you? 
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 

$title = get_field('title');
$subtitle = get_field('subtitle');
$path = get_field('path');
$teaching_english_online = get_field('teaching_english_online');
$teaching_english_abroad = get_field('teaching_english_abroad');
$tefl_courses = get_field('tefl_courses');
$free_call = get_field('free_call');
$download_guides = get_field('download_guides');

?>

<div id="primary" <?php astra_primary_class(); ?>>

    <div class="box">

        <div class="title"><?php echo $title; ?></div>

        <div class="subtitle"><?php echo $subtitle; ?></div>

        <div class="path"><?php echo $path; ?></div>

        <div class="planes"></div>

        <div class="cards">

            <div class="card" style="background-image: url('<?php echo $teaching_english_online['background']; ?>');">

                <div class="card-overlay">

                    <div class="card-title"><?php echo $teaching_english_online['title']; ?></div>

                    <div class="card-subitle"><?php echo $teaching_english_online['subtitle']; ?></div>

                    <div class="card-btn">

                        <a href="<?php echo $teaching_english_online['btn']['link']; ?>"><?php echo $teaching_english_online['btn']['value']; ?></a>

                    </div>

                </div>

            </div>

            <div class="card" style="background-image: url('<?php echo $teaching_english_abroad['background']; ?>');">

                <div class="card-overlay">

                    <div class="card-title"><?php echo $teaching_english_abroad['title']; ?></div>

                    <div class="card-subitle"><?php echo $teaching_english_abroad['subtitle']; ?></div>

                    <div class="card-btn">

                        <a href="<?php echo $teaching_english_abroad['btn']['link']; ?>"><?php echo $teaching_english_abroad['btn']['value']; ?></a>

                    </div>

                </div>

            </div>

        </div>

        <div class="blocks">

            <div class="block">

                <img src="<?php echo $tefl_courses['icon']; ?>" class="block-icon">

                <div class="block-title"><?php echo $tefl_courses['title']; ?></div>

                <div class="block-subitle"><?php echo $tefl_courses['subtitle']; ?></div>

                <div class="block-btn">

                    <a href="<?php echo $tefl_courses['button']['link']; ?>"><?php echo $tefl_courses['button']['value']; ?></a>

                </div>

            </div>

            <div class="block">

                <img src="<?php echo $free_call['icon']; ?>" class="block-icon">

                <div class="block-title"><?php echo $free_call['title']; ?></div>

                <div class="block-subitle"><?php echo $free_call['subtitle']; ?></div>

                <div class="block-btn">

                    <a href="<?php echo $free_call['button']['link']; ?>"><?php echo $free_call['button']['value']; ?></a>

                </div>

            </div>

        </div>

    </div>

    <div class="guides">

        <div class="guides-title"><?php echo $download_guides['title']; ?></div>

        <div class="guides-inner">

            <?php foreach($download_guides['guides'] as $guide) : ?>

                <div class="guide">

                    <img src="<?php echo $guide['image']; ?>" class="guide-image">

                    <div class="guide-name"><?php echo $guide['name']; ?></div>

                    <div class="guide-link">

                        <a href="<?php echo $guide['link']; ?>">
                            Download
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="svg"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M18 13l-6 6" /><path d="M6 13l6 6" /></svg>
                        </a>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</div>

<?php get_footer(); ?>