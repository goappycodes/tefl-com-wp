<?php

$day_light = DAY_LIGHT_SAVINGS; ?>

<div class="section section-padding timetable-section" id="timetable">
    <div class="ast-container">
        <div class="ast-row course_content_row">

            <div class="ast-col-md-12 tablecontent-col">

                <?php if (get_post_type(get_the_ID()) == 'placement') : ?>
                    <h6 class="centered common-heading section-heading">Select your Virtual Course Date</h6>
                <?php else : ?>
                    <h6 class="centered common-heading">Upcoming Classes by Timezone</h6>

                    <?php //if($deposit_payment_plan): 
                    ?>
                    <!-- <div class="pay-in-2-info">
                            <div class="icon-div"><img src="/wp-content/uploads/2021/11/Pay-in-2-icon.png"></div>
                            <p><span>New!</span>Pay in 2 installments</p>
                            <div class="pay-checkbox-div">
                                <label class="container">Pay in 2 deposits
                                <input type="checkbox">
                                <span class="checkmark"></span>
                                </label>
                            </div>
                        </div> -->
                    <?php //endif; 
                    ?>

                    <div class="flexible-booking-btn">
                        <a class="btn btn-primary btn-rounded" rel="nofollow" href="/?addtimetocart&prid=<?php echo $course_product_id; ?>&date=Flexible - Book now and select your preferred dates and times later">Flexible booking - book now and choose the date later</a>
                    </div>
                <?php endif; ?>

                <!-- Nav tabs -->

                <ul class="nav nav-tabs">
                    <li role="presentation" class="london-li"><a data-title="london" class="active"><i class="fa fa-angle-double-right"></i>UK<span> (London)</span></a></li>

                    <li role="presentation" class="boston-li"><a data-title="boston"><i class="fa fa-angle-double-right"></i>USA<span> (Boston)</span></a></li>

                    <li role="presentation" class="vancouver-li"><a data-title="vancouver"><i class="fa fa-angle-double-right"></i>Canada<span> (Vancouver)</span></a></li>

                    <!--<li role="presentation" class="hanoi-li"><a data-title="hanoi"><i class="fa fa-angle-double-right"></i>Vietnam<span> (Hanoi)</span></a></li>-->
                    <li role="presentation" class="southafrica-li"><a data-title="southafrica"><i class="fa fa-angle-double-right"></i>South Africa<span> (Cape Town)</span></a></li>
                </ul>

                <!-- Tab panes -->

                <div class="tab-content <?php echo $day_light ?>">
                    <div class="london tab-pane fade in active">
                        <?php if ($day_light == 0) {
                            $offset = '01:00';
                        } else {
                            $offset = '00:00';
                        } ?>
                        <?php echo variation_timetable($offset); ?>
                    </div>
                    <div class="boston tab-pane fade in">
                        <?php if ($day_light == 0) {
                            $offset = '-04:00';
                        } else {
                            $offset = '-05:00';
                        } ?>
                        <?php echo variation_timetable($offset); ?>
                    </div>
                    <div class="vancouver tab-pane fade in">
                        <?php if ($day_light == 0) {
                            $offset = '-07:00';
                        } else {
                            $offset = '-08:00';
                        } ?>
                        <?php echo variation_timetable($offset); ?>
                    </div>
                    <!--<div class="hanoi tab-pane fade in">-->
                    <!--    <?php //$offset = '+07:00'; 
                            ?>-->
                    <!--    <?php //echo variation_timetable($offset); 
                            ?>-->
                    <!--</div>-->
                    <div class="southafrica tab-pane fade in">
                        <?php if ($day_light === 0) {
                            $offset = '+02:00';
                        } else {
                            $offset = '+01:00';
                        } ?>
                        <?php echo variation_timetable($offset); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php function variation_timetable($offset)
{
    $class_course_dates = get_field('course_dates', 'option');
    //$date_today = date('l, F d y h:i:s');
    $date_today = date('Y-m-d');
    $date_today_timestamp = strtotime($date_today);
    $course_product_id = get_field('course_product');
    $course_price_value = $course_price_value ?? get_post_meta($course_product_id, '_price', true);
    $deposit_payment_plan = get_post_meta($course_product_id, '_wc_deposit_payment_plans', true);
    $deposit_payment_plan = $deposit_payment_plan[0];
    $course_product = wc_get_product($course_product_id);
    $course_price_html = '';

    if ($course_product) {
        $course_price_html = $course_product->get_price_html();
    }


    $deposit_class = '';

    $start_date_order_count = get_all_order_count_with_start_date();

    // if($deposit_payment_plan): 
    //     $deposit_class = "deposit-prod";
    // endif;

    $html = '<div class="table-outer-div">';
    $html .= '<table class="tablecontent">';
    $html .= '<thead>';
    $html .= '<tr class="table_header">';
    $html .= '<th class="tablepara date">Dates</th>';
    $html .= '<th class="tablepara time">Time</th>';
    $html .= '<th class="tablepara availability">Availability</th>';
    $html .= '<th class="tablepara price">Price</th>';
    $html .= '<th class="tablepara enroll_btn">Booking</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    $date_count = 0;
    foreach ($class_course_dates as $class_course_date) :
        $single_course_booking_count = 0;
        $class_course_start_date = $class_course_date['start_date'];
        $class_course_start_date_new = str_replace('/', '-', $class_course_start_date);
        $class_course_start_date_new = date('Y-m-d', strtotime($class_course_start_date_new));
        $class_course_start_date_timestamp = strtotime($class_course_start_date_new);

        $class_course_start_date = str_replace('/', '-', $class_course_start_date);
        $class_course_start_date = date('l jS M', strtotime($class_course_start_date));

        $class_course_end_date = $class_course_date['end_date'];
        $class_course_end_date = str_replace('/', '-', $class_course_end_date);
        $class_course_end_date = date('l jS M Y', strtotime($class_course_end_date));

        $course_start_end_date = $class_course_start_date . ' - ' . $class_course_end_date;

        if (($class_course_start_date_timestamp > $date_today_timestamp) || ($class_course_start_date_timestamp = $date_today_timestamp)) :
            $course_start_time = $class_course_date['start_time'];

            $single_course_booking_count  = get_total_count_by_start_date($start_date_order_count, $class_course_start_date, $course_product_id);

            // if(current_user_can('administrator')){
            //     echo '<pre>';
            //     print_r($class_course_start_date);
            //     print_r($start_date_order_count);
            //     echo '</pre>';
            // }
            if ($course_start_time) :
                $course_start_time_str  = date("g:i a", strtotime($course_start_time));
                $course_start_time_new = ti_convert_utc_time($course_start_time_str, $offset);
                $course_start_date_time = $class_course_start_date_new . ' ' . $course_start_time_str;
                $course_start_date_time_str  = date("Y-m-d g:i a", strtotime($course_start_date_time));
                $course_start_time_ts = strtotime($course_start_date_time_str);
            endif;

            $course_end_time = $class_course_date['end_time'];

            if ($course_end_time) :
                $course_end_time_str  = date("g:i a", strtotime($course_end_time));
                $course_end_time_new = ti_convert_utc_time($course_end_time_str, $offset);
            endif;

            if ($course_start_time && $course_end_time) :
                $course_time = $course_start_time_new . " - " . $course_end_time_new;
            else :
                $course_time = "";
            endif;

            $time_now = date('Y-m-d g:i a');
            $time_now = strtotime($time_now);

            if ($course_start_time_ts > $time_now) :
                $date_count++;
                $low_stock = "";
                $disabled_class = "";
                if ($class_course_date['number_of_seats']) :
                    // $availability = (int)$class_course_date['number_of_seats'] - (int)$single_course_booking_count;
                    $availability = (int)$class_course_date['number_of_seats'];
                else :
                    $availability = '<span class="space-full">FULL</span>';
                endif;

                if ($class_course_date['number_of_seats'] <= 3) :
                    $low_stock = "red";
                endif;
                if ((int)$class_course_date['number_of_seats'] < 1) :
                    $disabled_class = "disabled";
                endif;
                $html .= '<tr class="' . $disabled_class . ' course-row-' . $date_count . '">';
                $html .= '<td class="date">' . $course_start_end_date . '</td>';
                $html .= '<td class="time">' . $course_time . '</td>';
                $html .= '<td class="availability ' . $low_stock . '">' . $availability . '</td>';
                $html .= '<td class="price ' . $low_stock . ' ' . $deposit_class . '">' . $course_price_html . '</td>';
                $html .= '<td class="enroll_btn"><a rel="nofollow" class="table_btn ' . $disabled_class . '" href="/?addtimetocart&prid=' . $course_product_id . '&date=' . $class_course_date["start_date"] . '">Enrol</a></td>';

                $html .= '</tr>'; ?>

                <script type="application/ld+json">
                    {
                        "@context": "http://schema.org",
                        "@type": "EducationEvent",
                        "name": "<?php the_title(); ?>",
                        "performer": "The TEFL Institute of Ireland",
                        "url": "<?php echo get_the_permalink() . '#course-' . $date_count; ?>",
                        "startDate": "<?php echo $class_course_date['start_date']; ?>",
                        "endDate": "<?php echo $class_course_date['end_date']; ?>",
                        "eventStatus": "EventScheduled",
                        "eventAttendanceMode": "OnlineEventAttendanceMode",
                        "description": "In just 10 hours have a certificate of practical teaching experience under your belt",
                        "offers": {
                            "@type": "Offer",
                            "price": "<?php echo $course_price_value; ?>",
                            "priceCurrency": "<?php echo get_woocommerce_currency(); ?>",
                            "availability": "http://schema.org/InStock",
                            "url": "<?php echo '/?addtimetocart&prid=' . $course_product_id . '&date=' . $class_course_date['start_date']; ?>",
                            "validFrom": "2020-01-01T12:00"
                        },
                        "organizer": {
                            "@type": "Organization",
                            "name": "The TEFL Institute of Ireland",
                            "url": "https://teflinstitute.com/",
                            "logo": {
                                "@type": "ImageObject",
                                "url": "https://teflinstitute.com/wp-content/uploads/2021/01/TEFL-Logo_Institute-scaled.jpg",
                                "width": "432px",
                                "height": "190px"
                            }
                        },
                        "location": {
                            "@type": "VirtualLocation",
                            "url": "https://courses.teflinstitute.com/"
                        },
                        "image": {
                            "@type": "ImageObject",
                            "url": "https://teflinstitute.com/wp-content/uploads/2021/01/TEFL-Logo_Institute-scaled.jpg",
                            "width": "300px",
                            "height": "300px"
                        }
                    }
                </script>

<?php endif;
        endif;
    endforeach;
    $html .= '</tbody>';
    $html .= '</table>';
    if ($date_count > 2) :
        $html .= '<div class="dates-more"><span>SHOW ALL DATES</span></div>';
    endif;
    $html .= '</div>';
    return $html;
}
