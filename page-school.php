<?php

/* 
Template Name: TEFL for Schools
*/

get_header();

$hero_banner = get_field('hero_banner');

$faq = get_cfvalue_by_country('faq');

?>

<div id="primary" <?php astra_primary_class(); ?>>

    <?php
    $hero_banner = get_field('hero_banner');

    $banner_img =  $hero_banner['banner_image'];
    $banner_CTA =  $hero_banner['banner_cta'];

    $banner_cta_title =  get_group_cfvalue_by_country('hero_banner', 'banner_cta', 'banner_cta_title');
    $banner_cta_text =  get_group_cfvalue_by_country('hero_banner', 'banner_cta', 'banner_cta_text');
    $banner_cta_buttons =  $banner_CTA['banner_cta_buttons'];

    $button_text =  $banner_cta_buttons['button_text'];
    $button_link =  $banner_cta_buttons['button_link'];

    ?>
    <section class="banner-section" style="background-image:url('<?php echo $banner_img ?>')">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-lg-6 ast-col-md-8 formobile">
                    <div class="banner-content-block">
                        <div class="content-block">
                            <h3><?php echo $banner_cta_title ?></h3>
                            <?php echo $banner_cta_text ?>
                            <img src="/wp-content/uploads/2020/11/Group-57.svg">
                        </div>
                        <div class="banner-buttons">
                            <a href="<?php echo $button_link ?>"><?php echo $button_text ?> <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    $main = get_field('main');

    $title = get_repeater_cfvalue_by_country('main', 'title');
    $subtitle = get_repeater_cfvalue_by_country('main','subtitle');
    $content = get_repeater_cfvalue_by_country('main', 'content');

    ?>
    <section class="main-section">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-12">
                    <h6 class="section-heading" style="margin-bottom: 0.5rem;"><?php echo $title ?></h6>
                    <h6 class="section-heading"><?php echo $subtitle ?></h6>
                    <div class="main-content"><?php echo $content ?></div>
                </div>
            </div>
        </div>
    </section>

    <?php
    $why = get_field('why');

    $title =  get_repeater_cfvalue_by_country('why', 'title');
    $content =  get_repeater_cfvalue_by_country('why', 'content');
    $background =  $why['background'];

    ?>
    <section class="why-section">
        <div class="ast-container">
            <h6 class="section-heading"><?php echo $title ?></h6>
            <div class="ast-row" style="display: flex;">
                <div class="ast-col-sm-12 ast-col-md-4 background hide-mobile" style="background-image: url('<?php echo $background ?>')"></div>
                <div class="ast-col-sm-12 ast-col-md-8 why-content"><?php echo $content ?></div>
            </div>
        </div>
    </section>

    <?php
    $blog_cta = get_field('blog_cta_section');

    $title =  $blog_cta['title'];
    $content =  $blog_cta['content'];
    $background =  $blog_cta['background'];
    $cta_button_text = $blog_cta['cta_button_text'];
    $cta_button_link = $blog_cta['cta_button_link'];
    ?>
    
    <section class="blog-cta-section" style="background-image: url('<?php echo $background ?>')">
        <div class="ast-container">
            <div class="ast-row blog-cta-section__row">
                <h6 class="section-heading blog-cta-section__title"><?php echo $title ?></h6>
                <div  class="ast-col-md-12 blog-cta-section__content"><?php echo $content ?></div>
                <a href="<?php echo $cta_button_link?>" class="blog-cta-section__btn">
                    <?php echo $cta_button_text?>
                </a>
            </div>
        </div>
    </section>

    <?php
    $course = get_field('course');

    $title =  $course['title'];
    $content =  $course['content'];
    $background =  $course['background'];

    ?>
    <section class="course-section">
        <div class="ast-container">
            <h6 class="section-heading"><?php echo $title ?></h6>
            <div class="ast-row" style="display: flex;">
                <div class="ast-col-sm-12 ast-col-md-8"><?php echo $content ?></div>
                <div class="ast-col-sm-12 ast-col-md-4 background hide-mobile" style="background-image: url('<?php echo $background ?>')"></div>
            </div>
        </div>
    </section>

    <?php
    $bonus = get_field('bonus');
    
    $title = get_repeater_cfvalue_by_country('bonus', 'title');
    $content = get_repeater_cfvalue_by_country('bonus', 'content');
    $background = $bonus['background'];

    ?>
    <section class="why-section">
        <div class="ast-container">
            <h6 class="section-heading"><?php echo $title; ?></h6>
            <div class="ast-row" style="display: flex;">
                <div class="ast-col-sm-12 ast-col-md-4 background hide-mobile" style="background-image: url('<?php echo $background ?>')"></div>
                <div class="ast-col-sm-12 ast-col-md-8 why-content"><?php echo $content ?></div>
            </div>
        </div>
    </section>

    <?php
    $bonus = get_field('bonus');

    $background =  $bonus['background'];
    $content =  $bonus['content'];

    ?>
    <section class="guide-section" id="brochure">
        <div class="ast-container">
        
            <div class="ast-row" style="display: flex;">
                <div class="ast-col-sm-12 ast-col-md-5">
                    <h6 class="section-heading" style="text-align:left;">TEFL for Schools Brochure</h6>
                    <?php echo do_shortcode( '[contact-form-7 id="5736" title="Free Guide"]' ); ?>
                </div>
                <div class="ast-col-sm-12 ast-col-md-7 background hide-mobile" style="background-image: url('https://teflinstitute.com/wp-content/uploads/2021/06/Guide.png')">
                    
                </div>
            </div>
        </div>
    </section>

    <?php
    $elective = get_field('elective');

    $content =  $elective['content'];
    $button_text =  $elective['button_text'];
    $button_link =  $elective['button_link'];
    ?>
    <section class="contact-section">
        <div class="ast-container">
            <div class="contact-container">
                <div class="ast-row" style="display: flex;">
                    <div class="ast-col-sm-12 ast-col-md-3 icon hide-mobile" style="background-image: url('https://teflinstitute.com/wp-content/uploads/2020/12/120-Advanced-TEFL.svg')"></div>
                    <div class="ast-col-sm-12 ast-col-md-9 content">
                        <?php echo $content; ?>
                        <a href="<?php echo $button_link; ?>" class="link-blue">
                            <span class="banner-link-text"><?php echo $button_text; ?></span>
                            <span class="banner-link-icon"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    
    <section class="contact-section">
        <div class="ast-container">
            <div class="contact-container">
                <h6 class="section-heading">Request Tailored Programme for your School</h6>
                <div class="ast-row">
                    <div class="ast-col-12">
                        <?php echo do_shortcode( '[contact-form-7 id="6530" title="TEFL for Schools Contact"]' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php if($faq): ?>
        <section class="faq-section">
            <div class="ast-container">
        		<h3>FAQ's</h3>
        		<div class="ast-row">
                    <div class="ast-col-md-12">
                        <?php foreach($faq as $key => $element) {
                            $question = $element['question'];
                            $answer = $element['answer']; ?>
                            <section class="accordion-container">
                                <input id="accordion-<?php echo $key ?>" name="accordion-1" type="radio" <?php if ($key === 0) { ?>checked<?php } ?>>
                                <label for="accordion-<?php echo $key?>"><?php echo $question ?></label>
                                <article>
                                    <?php echo $answer ?>
                                </article>
                            </section>
                        <?php } ?>
                        <script type="application/ld+json">
                            {
                                "@context": "https://schema.org",
                                "@type": "FAQPage",
                                "mainEntity": [
                                    <?php
                                    $faqcount = count($faq);
                                    $counter = 0;
                                    foreach ($faq as $item) {
                                        $counter++;
                                    ?> {
                                            "@type": "Question",
                                            "name": <?php echo json_encode($item['question']); ?>,
                                            "acceptedAnswer": {
                                                "@type": "Answer",
                                                "text": <?php echo json_encode($item['answer']); ?>
                                            }
                                        }
                                    <?php
                                        if ($faqcount != $counter) echo ",";
                                    }
                                    ?>
                                ]
                            }
                        </script>
                    </div>
        		</div>
        	</div>
        </section>
    <?php endif; ?>
</div>

<?php get_footer(); ?>