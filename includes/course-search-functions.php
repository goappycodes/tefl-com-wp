<?php

if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly.

}

add_shortcode('tefl_course_search', 'tefl_course_search_fn');
function tefl_course_search_fn(){
    ob_start();
    $course_search_bar_search_icon = get_field('course_search_bar_search_icon', 'option');
    if (isset($course_search_bar_search_icon) && !empty($course_search_bar_search_icon)) {
        $icon_bg_color = $course_search_bar_search_icon['icon_bg_color'] ?? '#1c1c1b'; 
        $icon_color = $course_search_bar_search_icon['icon_color'] ?? '#ffffff'; 
    }

    ?>
    <section id="search_section" class="search-section">
        <div class="ast-row search-row">
            <div class="ast-col-md-12 search-col">
                <div class="search-col-inner">
                    <div class="user-type-div search-field">
                        <label for="user_type">I am a</label>
                        <select name="user_type" id="user_type">
                          <option value="-1">Select</option>
                          <option value="professional">Professional</option> 
                          <option value="student">Student</option>
                          <option value="teacher">Teacher</option>
                        </select>
                    </div>
                    <div class="user-preference-div search-field">
                        <label for="user_preference">I want to</label>
                        <select name="user_preference" id="user_preference">
                          <option value="-1">Select</option>
                          <option value="teach_abroad">Teach Abroad</option>
                          <option value="teach_online">Teach Online</option>
                          <option value="volunteer">Volunteer</option>
                        </select>
                    </div>
                    <div class="user-level-div search-field">
                        <label for="user_level">I have a</label>
                        <select name="user_level" id="user_level">
                          <option value="-1">Select</option>
                          <option value="native_level_of_english">Native Level of English</option>
                          <option value="an_advanced_level_of_english">An Advanced Level of English</option>
                          <option value="a_basic_level_of_english">A Basic Level of English</option>
                        </select>
                    </div>
                    <div class="user-qualification-div search-field">
                        <label for="user_qualification">My experience is</label>
                        <select name="user_qualification" id="user_qualification">
                          <option value="-1">Select</option>
                          <option value="no_exp">No Teaching Experience</option>
                          <option value="less_than_1_year">Less than 1 year</option>
                          <option value="more_than_1_year">More than 1 year</option>
                        </select>
                    </div>
                    <div class="search-btn-div">
                        <a style="background:<?php echo $icon_bg_color?>" href="" class="course-search-btn no-lazy">
                            <i style="color:<?php echo $icon_color?>" class="fa fa-search"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>    
    <?php
    return ob_get_clean();
}


function tefl_selected_course($user_type, $user_preference, $user_level, $user_qualification){
    $course_id = [];
    $course_result = [];
    $applications = get_field('applications', 'options');
    
    foreach($applications as $app){
        $set_user_type = $app['user_type'];
        $set_user_preference = $app['user_preference'];
        $set_user_level = $app['user_english_level'];
        $set_teaching_experience = $app['teaching_experience'];
        
        $set_courses = $app['courses'];
        
        if( ti_in_arrayi($user_type, $set_user_type) && ti_in_arrayi($user_preference, $set_user_preference) && ti_in_arrayi($user_level, $set_user_level) && ti_in_arrayi($user_qualification, $set_teaching_experience)  ) {
            $course_id = $set_courses;
            $course_result['id_arr'] = $course_id;
            $course_result['text'] = $app['search_text'];
        }
    }
    
    if(!empty($course_result)){
        return $course_result;
    }else{
        return false;
    }
}

function tefl_get_course_price_html($cid){
    $course_product_id = get_field('course_product', $cid);
    $course_product_obj = wc_get_product($course_product_id);
    $course_price = '';
    if ($course_product_obj){
        $course_price = $course_product_obj->get_price_html();
    }
    return $course_price;
}

function tefl_buy_now_link($cid){
    $has_variable_dates = get_field('is_virtual_couse', $cid); 
    $course_link = get_post_permalink( $cid );
    $course_product_id = get_field('course_product', $cid);
    $buy_now_link = '';
    if($has_variable_dates){
        $buy_now_link .= '<a class="btn btn-primary buy-now-link" href="'.$course_link.'/#timetable">Pick Dates</i></a>';
    }else{
        $buy_now_link .= '<a class="btn btn-primary buy-now-link" href="'.site_url().'/cart/?add-to-cart='.$course_product_id.'">Buy Now</a>';
    }
    return $buy_now_link;
}

function ti_in_arrayi($needle, $haystack) {
    return in_array(strtolower($needle), array_map('strtolower', $haystack));
}