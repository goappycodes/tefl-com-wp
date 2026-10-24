<?php
global $post;
$current_course_id = $post->ID;
$variation_timetable = variation_timetable($course_product_obj,$course_product_id); ?>

<div data-id = "<?php echo $course_product_id?>" class="section timetable-section" id="timetable">
    <div class="ast-container">
        <div class="course_content_row">
            <div class="ast-row ">
                <div class="tablecontent-col">
                    <div class="text-center enroll_btn flexible-booking-btn flexible-booking-btn-new"><a class="button" href="/?addtimetocart&prid=<?php echo $course_product_id; ?>&date=Flexible - Book now and select your preferred dates and times later"><span class="font-700">Flexible booking</span> - book now and choose the date later</a></div>
                    <?php echo $variation_timetable; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
function variation_timetable($course_product_obj,$course_product_id) { 
    $class_course_dates = get_field('course_dates', 'options');
    $date_today = date('Y-m-d');
    $date_today_timestamp = strtotime($date_today);
    $course_price_html = '';

    if ($course_product_obj) {
        $course_price_html = $course_product_obj->get_price_html();
    }

    ob_start();
    ?>
    <div class="table-outer-div">
        <table class="tablecontent">
            <thead>
                <tr class="table_header">
                    <th class="tablepara date">Dates</th>
                    <th class="tablepara time">Time</th>
                    <th class="tablepara availability">Spaces</th>
                    <th class="tablepara price">Price</th>
                    <th class="tablepara enroll_btn">Booking</th>
                </tr>
            </thead>
            <tbody>
                <tr class="course-row-1 available">
                    <td class="date">Book now and choose the date later</td>
                    <td class="time">Flexible booking</td>
                    <td class="availability"></td>
                    <td class="price"><?php echo $course_price_html; ?></td>
                    <td class="enroll_btn">
                        <a rel="nofollow" class="table_btn btn btn-centered btn-primary" href="/?addtimetocart&prid=<?php echo $course_product_id; ?>&date=Flexible - Book now and select your preferred dates and times later">Enrol Now</a>
                    </td>
                </tr>
            </tbody>
            <tbody>
            <?php
            $date_count = 0;

            foreach ($class_course_dates as $class_course_date) {
                $instructor_name = $class_course_date['instructor_name'];
                $formatted_instructor_name = (count($name_parts = explode(' ', $instructor_name)) == 2)
                ? substr($name_parts[0], 0, 1) . '. ' . $name_parts[1]
                : $instructor_name;
                $instructor_image = $class_course_date['instructor_image'];
                if(empty($instructor_image)){
                    $instructor_image = '/wp-content/uploads/2024/06/IMG_2598-Edit-scaled.jpg';
                }
                $class_course_start_date = str_replace('/', '-', $class_course_date['start_date']);
                $class_course_start_date_new = date('Y-m-d', strtotime($class_course_start_date));
                $class_course_start_date_timestamp = strtotime($class_course_start_date_new);

                $class_course_start_date = date('l jS M', strtotime($class_course_start_date));
                $class_course_end_date = date('l jS M', strtotime(str_replace('/', '-', $class_course_date['end_date'])));

                $course_start_end_date = $class_course_start_date . ' - ' . $class_course_end_date;

                if (($class_course_start_date_timestamp > $date_today_timestamp) || ($class_course_start_date_timestamp == $date_today_timestamp)) {
                    $course_start_time = $class_course_date['start_time'] ? date("g:i a", strtotime($class_course_date['start_time'])) : '';
                    $course_end_time = $class_course_date['end_time'] ? date("g:i a", strtotime($class_course_date['end_time'])) : '';
                    $course_time = $course_start_time && $course_end_time ? $course_start_time . " - " . $course_end_time : '';

                    $time_now = strtotime(date('Y-m-d g:i a'));

                    if (strtotime($class_course_start_date_new . ' ' . $course_start_time) > $time_now) {
                        $date_count++;
                        $low_stock = "";

                        $availability = $class_course_date['number_of_seats'] ? $class_course_date['number_of_seats'] : '<span class="space-full">FULL</span>';
                        $avail_class = $class_course_date['number_of_seats'] ? "available" : "full";

                        if ($class_course_date['number_of_seats'] <= 3) {
                            $low_stock = "red";
                        }
                        ?>
                        <tr class="table-row course-row-<?php echo $date_count; ?> <?php echo $avail_class; ?>">
                            <td class="date"><i class="fa fa-question"></i><?php echo $course_start_end_date; ?></td>
                            <td class="time"><?php echo $course_time; ?></td>
                            <td class="availability <?php echo $low_stock; ?>"><?php echo $availability; ?></td>
                            <td class="price <?php echo $low_stock; ?>"><?php echo $course_price_html; ?></td>
                            <td class="enroll_btn">
                                <a rel="nofollow" class="table_btn btn btn-centered btn-primary" href="/?addtimetocart&prid=<?php echo $course_product_id; ?>&date=<?php echo $class_course_date['start_date']; ?>">Enrol Now</a>
                            </td>
                            <td class="instructor-info-container">
                                <div class="instructor-info">
                                    <span class="instructor-info__image">
                                        <img class="no-lazy" src="<?php echo $instructor_image?>" alt=""> 
                                    </span>
                                    <span class="instructor-info__title">
                                        <p>With Tutor</p>
                                        <p class="font-700"><?php echo $formatted_instructor_name?></p>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
            </tbody>
        </table>
        <?php if ($date_count > 3) : ?>
            <div class="dates-more d-none"><span>SHOW ALL DATES</span></div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
?>




            

    	

