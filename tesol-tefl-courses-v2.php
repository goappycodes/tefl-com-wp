<?php

/**
 * Template Name: TESOL/TEFL Courses v2
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 * @author Bikram <bikram@appycodes.com>
 * @date June 2023
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

?>

<div id="primary" <?php astra_primary_class(); ?>>

    <?php
        $hero = get_field('hero');
        $hero_background = $hero['background'];
        $hero_title = $hero['title'];
        $hero_summary = $hero['summary'];
        $hero_button = $hero['button'];
        if(!is_array_empty($hero)):
    ?>

    <section class="hero-banner-section section-padding" style="background:url(<?php echo $hero_background ?>)">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-6">
                    <?php if(!empty($hero_summary) && !empty($hero_title)):?>
                    <div class="hero-banner-section__content">

                        <h1 class="large-heading common-section-heading"><?php echo $hero_title ?></h1>
                        <div class="hero-banner-section__content-summary"><?php echo $hero_summary ?></div>
                        <a href="<?php echo $hero_button['link'] ?>" class="btn btn-primary btn-centered"><?php echo $hero_button['value'] ?></a>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </section>
    <?php
        endif;
    ?>
   
    <?php
    
        $main = get_field('main');
            $main_title = $main['title'];
            $main_content = $main['content'];
            $main_cards = $main['cards'];
            $main_points = $main['points'];     
            $main_elt = $main['elt'];       
            $main_salary_calculator = $main['salary_calculator'];       
            $main_faq = $main['faq'];    
            if(is_array_empty($main_faq)){
                $main_faq = get_cfvalue_by_country('frequently_asked_questions');
            }   
            $main_blogs = $main['blogs'];
            $main_accreditations  = $main['accreditations'];
            $key_features_section = $main['key_features_section'];
            $section_heading      = $key_features_section['section_heading'];
            $key_features_cards   = $key_features_section['key_features_cards'];
            $main_banner_section  = $main['banner_cta_section'];
            $map_section          = $main['map_section'];
            $map_main_title       = $map_section ['main_title'];
            $map_content          = $map_section ['map_content'];
            $below_faq_section    = $main['below_faq_section'];
            $map_title            = $below_faq_section['title'];
            $main_map_summary          = $below_faq_section['summary'];
            $main_map             = $below_faq_section['main_map'];
            
    ?>
     
    <section class="section-padding">
        <div class="ast-container">
            <div class="offer-section-row">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                        <?php if(!empty($main_title) && ($main_content)):?>
                        <h2 class="main_title"><?php echo $main_title ?></h2>

                        <div class="main_content"><?php echo $main_content ?></div>
                        <?php endif; ?>
                         <?php $main_cards = get_field('icon_sec_cards', 'option');    
                         ?>

                        <div class="cards">
                            <?php
                                foreach ($main_cards as $index => $card) :
                                    $icon    = $card['icon'];
                                    $title   = $card['title'];
                                    $summary = $card['summary'];
                                    $button  = $card['button'];
                                ?>
                            
                            <div class="card">

                                <img src="<?php echo $icon ?>" class="cta-card__icon perfmatters-lazy entered pmloaded">
                                <h4 class="cta-card__title font-600" style="height: 30px;"><?php echo $title ?></h4>
                                <div class="cta-card__summary" style="height: 130px;"><?php echo $summary ?></div>
                                <a href="<?php echo $button['link'] ?>" class="cta-card__link"><?php echo $button['value'] ?></a>

                            </div>

                            <?php endforeach; ?>

                        </div>

                        <?php $courses_option = get_field('courses', 'option'); ?>

                        <div class="heading">Our Recommended TEFL Courses</div>

                        <div class="courses">
                            <?php
                                foreach ($courses_option as $index => $course) :
                                    $actual_course = $course['course'];
                                    $course_link = get_post_permalink($actual_course);
                                    $course_product_id = get_field('course_product', $actual_course);
                                    $course_product = wc_get_product($course_product_id);
                                    if($course_product){
                                        $course_price_html = $course_product->get_price_html();
                                    }
                                    
                                    $background = $course['background'];
                                    $title = $course['title'];
                                    $icon = $course['icon'];
                                    $installments = $course['installments'];
                                    $includes = $course['includes'];
                                    $completion_time = $course['completion_time'];
                                    $guide = $course['guide'];
                                ?>
                            
                            <div class="course">
                                <div class="top" style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo $background ?>')">
                                    <img src="<?php echo $icon ?>" class="icon">
                                    <div class="fast-track-course deposit-info ast-flex ast-align-items-center">
                                        <div class="ast-flex flex-direction-column deposit-info__details">
                                            <h5 class="deposit-info_title"><?php echo $installments['title'] ?></h5>
                                            <div class="deposit-info_description"><?php echo $installments['subtitle'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="title"><?php echo $title ?></div>
                                    <div class="price"><?php echo $course_price_html ?></div>
                                    <div class="includes">
                                        <div class="includes-heading">Course Includes:</div>
                                        <?php
                                            foreach ($includes as $index => $e) :
                                                $feature = $e['feature'];
                                            ?>
                                            <div class="feature"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg><?php echo $feature ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="completion-guarantee">
                                        <div class="completion-time">
                                            <img src="https://teflinstitute.com/wp-content/uploads/2024/02/completion-time.png">
                                            <div>
                                                <span>Completion Time <br><?php echo $completion_time ?></span>
                                            </div>
                                        </div>
                                        <div class="guarantee">
                                            <img src="https://teflinstitute.com/wp-content/uploads/2024/02/14-days.png">
                                            <div>14 Day Money Back Guarantee</div>
                                        </div>
                                    </div>
                                    <a target="_blank" href="<?php echo $course_link ?>" class="course-cta-btn btn btn-learn btn-centered">Learn More</a>
                                    <a target="_blank" href="<?php echo $guide ?>" class="course-cta-btn btn btn-download btn-centered">Download Guide</a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                </div>   
            </div>
        <div>
    </section> 

<!-- key-features section -->
     <?php if(!empty($key_features_cards)  && ($section_heading)):?>
    <section class="key-feature-section">
        <div class="ast-container">
            <div class="ast-row">
           
                <div class="heading top-title"><?php echo $section_heading;?></div>
                 <?php 
                    foreach ($key_features_cards as $index => $features_card):
                    $card_img     = $features_card['card_img'];
                    $card_title   = $features_card['card_title'];
                    $card_summary = $features_card['card_summary'];   
                  ?>
                 <div class="ast-col-md-4">
                     <div class="key-card">
                        <div class="key-card-img">
                            <img src="<?php echo $card_img;?>" alt="">
                        </div>
                        <div class="key-card-body">
                          <div class="key-card-title">
                            <?php echo $card_title;?>
                          </div>
                        <div class="key-card-summary">
                            <?php echo $card_summary?>
                        </div>

                        <div class="expandable-card font-500">
                          <span>Show More</span>
                           <i class="fa fa-angle-down"></i>
                        </div>
                    </div>      
                    </div>          
                </div>        
                <?php endforeach;?> 
               
                 
            </div>
        </div>
                      
    </section>
    <?php endif;?>
    <!-- banner section -->
  <?php if(!empty($hero_summary)):?>
    <section class="section-padding full-width-banner">
        <div class="ast-row">      
            <div class="banner-cta"  style="background:url(<?php echo $main_banner_section?>)">     
        </div>
    </section>
  <?php endif;?>
<!-- map section -->
    <section class ="map-section">
        <div class="ast-container">
            <div class="ast-row">
                  <?php if(!empty($map_main_title) && ($map_content)):?>
                <div class="heading top-title"><?php echo $map_main_title ;?></div>
                <?php 
                foreach($map_content as $index => $map_main_content ):
                    $map_summary  = $map_main_content['main_summary'];
                    $hotspots_map = $map_main_content['hotspots_map'];
                ?>
                <div class="ast-col-md-4">
                    <div class="map-card">
                     <div class="hotspots-map">
                      <?php echo $hotspots_map;?>
                      </div>
                    <div class="map-main-summary key-card-summary">
                      <?php echo $map_summary;?>
                    </div>

                     <div class="expandable-card font-500">
                    <span>Show More</span>
                    <i class="fa fa-angle-down"></i>
                    </div>
                    </div>  
                </div>
                <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    </section>

    <section class="below-courses-section">
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12">
                    <?php $i = 0; ?>
                    <div class="points">
                    <?php if($main_points): 
                        foreach($main_points as $element): 
                            $title = $element['title']; 
                            $point = $element['point']; ?>
                            
                                    <section class="accordion-container">
                                        <input id="accordion-<?php echo $i ?>" name="accordion-1" type="radio" <?php if($i === 0) { ?>checked<?php } ?>>
                                        <label for="accordion-<?php echo $i ?>"><?php echo $title ?><i class="fa fa-plus"></i></label>
                                        <article>
                                            <?php echo $point ?>
                                        </article>
                                    </section>
                
                                    <?php $i++; 
                            ?>    
                        <?php endforeach;
                    endif; ?>
                    </div>

                    <?php $main_elt = get_field('elt_section', 'option'); 
                        $calculator_content = get_field('calculator_content', 'option');            
                        
                    ?>
                    <div class="elt_sc">

                        <div class="elt_sc_each" style="background-image: url('<?php echo $main_elt['background'] ?>')">
                            <div class="block-inner">
                                <img class="block_icon" src="<?php echo $main_elt['icon'] ?>">
                                <div class="block_title"><?php echo $main_elt['title'] ?></div>
                                <div class="block_subtitle"><?php echo $main_elt['subtitle'] ?></div>
                                <a target="_blank" href="<?php echo $main_elt['button']['link'] ?>" class="block_link"><?php echo $main_elt['button']['value'] ?></a>
                            </div>
                        </div>

                        <div class="elt_sc_each" style="background-image: url('<?php echo $calculator_content['background'] ?>')">
                            <div class="block-inner">
                                <img class="block_icon" src="<?php echo $calculator_content['icon'] ?>">
                                <div class="block_title"><?php echo $calculator_content['title'] ?></div>
                                <div class="block_subtitle"><?php echo $calculator_content['subtitle'] ?></div>
                                <a target="_blank" href="<?php echo $calculator_content['button']['link'] ?>" class="block_link"><?php echo $calculator_content['button']['value'] ?></a>
                            </div>
                        </div>

                    </div>
                    <?php if(!empty($main_faq)):?>
                    <div class="faqs-section full-width has-bg">      
                        <div class="ast-container">
                            <div class="ast-row">
                                <div class="ast-col-md-12">
                                    <div class="faqs-section__row">
                                        <div class="faqs-section__row-body">
                                            <div class="faqs-accordion">
                                                <?php
                                                foreach ($main_faq as $key => $e) :
                                                    $faq_question = $e['question'];
                                                    $faq_answer = $e['answer'];
                                                ?>
                                                    <div class="faqs-accordion__item <?php echo $key === 0 ? 'active' : '' ?>">
                                                        <input type="radio" id="acc-<?php echo $key ?>" name="faq-accordion" <?php echo $key === 0 ? 'checked' : '' ?> hidden>
                                                        <label class="font-700" for="acc-<?php echo $key ?>">
                                                            <span><?php echo $faq_question ?></span>
                                                            <i class="fa fa-plus"></i>
                                                        </label>
                                                        <div class="font-500 faqs-accordion__content <?php echo $key === 0 ? 'active' : '' ?>">
                                                            <?php echo $faq_answer ?>
                                                        </div>
                                                    </div>
                                                <?php
                                                endforeach
                                                ?>

                                            </div>
                                            <div class="show-more-faqs">
                                                <span>Show More FAQ's</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($main_blogs)):?>
                    <div class="blogs">

                        <?php
                            foreach ($main_blogs as $key => $e) :
                                $background = $e['background'];
                                $title = $e['title'];
                                $link = $e['link'];
                        ?>

                        <div class="article" style="background-image: url('<?php echo $background ?>')">
                            <div class="article-inner">
                                <div class="article_title"><?php echo $title ?></div>
                                <a target="_blank" href="<?php echo $link ?>" class="article_link">Read More</a>
                            </div>
                        </div>

                        <?php endforeach ?>

                    </div>
                    <?php endif; ?>
                    <!-- map section start -->
                    <div class="below-faq-section">
                        <div class=" heading top-title map-main-title"><?php echo $map_title;?></div>
                        <div class="map-summary"><?php echo $main_map_summary ;?></div>
                        <div class="main-map"><?php echo $main_map;?></div>

                    </div>
                    <!-- map section end -->

                    <?php $main_accreditations = get_field('accreditations', 'option');    
                    ?>
                    <div class="accreditations">
                        
                        <div class="title"><?php echo $main_accreditations['title'] ?></div>

                        <img class="logos" src="<?php echo $main_accreditations['logos'] ?>"> 

                        <div class="points">

                            <?php
                                foreach ($main_accreditations['points'] as $key => $e) :
                                    $point = $e['point'];
                            ?>

                                <div class="point"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="4" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg><?php echo $point ?></div>

                            <?php endforeach ?>

                        </div>
                    </div>

                    <div class="main-form">
                        <div class="form">
                            
                            <?php echo do_shortcode('[contact-form-7 id="ae1ff3e" title="TESOL/TEFL Courses"]'); ?>

                        </div>
                    </div>
                </div>
                </div>
            </div>        
        </div>           
    <section>
</div>

<?php get_footer(); ?>