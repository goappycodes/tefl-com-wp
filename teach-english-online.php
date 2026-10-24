<?php
/**
* Template Name: What You Need To Teach English Online
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$gallery = get_field('gallery');
$title = get_field('title');
$subtitle = get_field('subtitle');
$cta = get_field('cta');
$steps = get_field('steps');
$courses = get_field('courses');
$best_label = get_field('best_label');
$one_block = get_field('one_block');
$two_block = get_field('two_block');
$three_block = get_field('three_block');
$english_level_test = get_field('english_level_test');
$callback = get_field('callback');

?>

<div id="primary" <?php astra_primary_class(); ?>>

    <section class="hero-section">
        <div class="ast-container">
            <div class="ast-row">
                <div class="hero">
                    <div class="ast-col-md-8">
                        <div class="gallery-container">
                            <div class="thumbnails">
                                <!-- Loop through and display small thumbnail images -->
                                <?php foreach ($gallery as $image) : ?>
                                    <div class="thumbnail" style="background-image: url('<?php echo $image['photo']; ?>');" data-large-image="<?php echo $image['photo']; ?>" alt="<?php echo $image['photo']; ?>"></div>
                                <?php endforeach; ?>
                            </div>
                            <div class="main-image">
                                <div class="large-image" style="background-image: url('<?php echo $gallery[0]['photo']; ?>');"></div>
                                <div class="prev-arrow">
                                    <img class="no-lazy" src="/wp-content/uploads/2024/06/prev-arrow.svg" alt="previous-arrow">
                                </div>
                                <div class="next-arrow">
                                    <img class="no-lazy" src="/wp-content/uploads/2024/06/next-arrow.svg" alt="next-arrow">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ast-col-md-4">
                        <div class="sidepanel">

                            <h1 class="title" style="font-size:24px;font-weight:700;line-height:30px;margin:0 0 13.68px;color:rgb(40,40,40)"><?php echo $title; ?></h1>

                            <div class="subtitle"><?php echo $subtitle; ?></div>
                            
                            <a href="<?php echo $cta['value']; ?>"><?php echo $cta['label']; ?></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="steps-section">
        <div class="ast-container">
            <div class="ast-row">
                <div class="steps">
                    <?php foreach($steps as $index => $step) : ?>
                    <div class="ast-col-md-3">
                        <div class="step color<?php echo $index; ?>" data-bg="<?php echo $step['bg_image']?>">
                            <div class="overlay"></div>
                            <div class="top">
                                <img src="<?php echo $step['icon']; ?>">
                                <div class="font-600">Step <?php echo $index + 1; ?></div>
                            </div>
                            <div class="center"><?php echo $step['title']; ?></div>
                            <div class="hidden"><?php echo $step['subtitle']; ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="courses-card-section">
        <div class="ast-container">
            <div class="ast-row">

            <?php foreach($courses as $course) : ?>
                <div class="ast-col-md-6">
                    <div class="course">

                        <div class="course-top">
                            <img src="<?php echo $course['icon']; ?>">
                            <div><?php echo $course['title']; ?></div>
                        </div>

                        <?php 
                        
                            $course_id = $course['course'];
                            $course_product_id = get_field('course_product', $course_id);
                            $course_product = wc_get_product($course_product_id);
                            $course_price_html = $course_product->get_price_html();
                            $course_regular_price = $course_product->get_regular_price();
                            $course_sale_price = $course_product->get_sale_price();
                            $cta = $course['cta'];

                        ?>

                        <div class="price">

                            <?php echo $course_price_html; ?>
                        
                        </div>

                        <div class="best-label">

                            <img src="<?php echo $course['best_label']['icon']; ?>">

                            <div class="texts">
                                <div class="title"><?php echo $course['best_label']['title']; ?></div>
                                <div class="subtitle"><?php echo $course['best_label']['subtitle']; ?></div>
                            </div>
                        
                        </div>

                        <div class="description">

                            <?php echo $course['description']; ?>
                        
                        </div>

                        <div class="features">

                            <?php foreach($course['features'] as $feature) : ?>
                        
                                <div class="feature">
                                    <svg class="feature-svg" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                    <?php echo $feature['feature']; ?>
                                </div>

                            <?php endforeach; ?>

                        </div>

                        <a class="cta" href="<?php echo $cta['value']; ?>"><?php echo $cta['label']; ?></a>

                    </div>
                </div>
            <?php endforeach; ?>

            </div>
        </div>
    </section>

    <section class="blocks-section">
        <div class="ast-container">
            <div class="ast-row ast-flex ast-align-items-center">
                <div class="ast-col-md-6">
                    <div class="block-one">
                        <div class="title font-700"><?php echo $one_block['title']; ?></div>
                        <div class="content"><?php echo $one_block['content']; ?></div>
                        <div class="points">
                            <?php foreach($one_block['points'] as $point) : ?>
                                <div class="point">
                                    <div class="title font-800"><?php echo $point['title']; ?></div>
                                    <div class="subtitle"><?php echo $point['subtitle']; ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="ast-col-md-6">

                <div class="two-blocks">
                    <div class="block-two">
                        <img src="<?php echo $two_block['image']; ?>">
                        <div class="block-content">
                            <div class="title"><?php echo $two_block['title']; ?></div>
                            <div class="subtitle"><?php echo $two_block['subtitle']; ?></div>
                            <?php if(!empty($two_block['cta']['value']) && $two_block['cta']['label']):?>
                                <a class="block-cta" href="<?php echo $two_block['cta']['value']; ?>"><?php echo $two_block['cta']['label']; ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="block-three">
                        <div class="block-content">
                            <div class="title"><?php echo $three_block['title']; ?></div>
                            <div class="subtitle"><?php echo $three_block['subtitle']; ?></div>
                            <?php if(!empty($three_block['cta']['value']) && $three_block['cta']['label']):?>
                                <a class="block-cta" href="<?php echo $three_block['cta']['value']; ?>"><?php echo $three_block['cta']['label']; ?></a>
                            <?php endif;?>
                        </div>
                        <img src="<?php echo $three_block['image']; ?>">
                    </div>
                </div>

                </div>
            </div>
        </div>
    </section>

    <section class="elt">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-6">
                    <div class="elt-left">
                        <div class="image" style="background-image:url('<?php echo $english_level_test['image']; ?>')"></div>
                    </div>
                </div>
                <div class="ast-col-md-6">
                    <div class="elt-right">
                        <div class="elt-title"><?php echo $english_level_test['title']; ?></div>
                        <div class="elt-subtitle"><?php echo $english_level_test['subtitle']; ?></div>
                        <div class="cta-flex"><a class="elt-cta" href="<?php echo $english_level_test['cta']['value']; ?>"><?php echo $english_level_test['cta']['label']; ?></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="callback-section">
        <div class="ast-container">
            <div class="ast-row ast-flex">
                <div class="ast-col-md-6">
                    <div class="callback-left" style="background-image:url('<?php echo $callback['thumbnail']; ?>')">
                        <span>Online TEFL Teacher</span>
                        <img class="play-btn no-lazy" src="/wp-content/uploads/2023/08/Play-icon-accent.svg">
                        <a href="https://youtu.be/<?php echo $callback['youtube']; ?>" class="image" data-lity></a>
                    </div>
                </div>
                <div class="ast-col-md-6">
                    <div class="callback-right">
                        <div class="callback-title"><?php echo $callback['title']; ?></div>
                        <div class="callback-subtitle"><?php echo $callback['subtitle']; ?></div>
                        <div class="callback-flex"><a class="elt-cta" href="<?php echo $callback['cta']['value']; ?>"><?php echo $callback['cta']['label']; ?></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>


<?php get_footer(); ?>