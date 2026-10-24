<?php


if(get_field('is_virtual_couse')): 
    
    /* $product_variations_sorted = $select_list = array();
    $date_now = date("Y-m-d"); // this format is string comparable
    
    foreach ($product_variations as $var_id) :
    	$course_date_meta = get_post_meta($var_id, 'attribute_pa_dates', true); // Get the human readable course date
    	$course_date_term = get_term_by('slug', $course_date_meta, 'pa_dates');
    	$course_start_date = get_post_meta($var_id, 'course_date', true); // Get the machine readable course date
    	$course_date = $course_date_term->name;
    
        if (!array_key_exists($course_start_date, $dates)):
            if ($date_now < $course_start_date):
                $product_variations_sorted[$course_start_date] = $var_id;
    			$dates[$course_date_meta] = $course_start_date;
    			$select_list[$course_start_date] = $course_date_meta;
    			$select_label[$course_start_date] = $course_date;
            endif;
        endif; 
    endforeach; 
    
    sort($dates); */

	$class_course_dates = get_field('course_dates', 'option');
	
    $timezone = ptefl_utc_timezone_name();
	?>
    
    <section class="timetable-section" id="timetable">
        <!--<div class="ast-container">-->
            <div class="common_part ast-row course_content_row">
                
                <?php if ( get_post_type( get_the_ID() ) == 'placement' ) : ?>
                    <h6 class="centered section-heading">Select your Virtual Course Date</h6>
                <?php else : ?>
                    <h6 class="centered section-heading">Upcoming Dates</h6>
                <?php endif; ?>
                
                <div class="ast-col ast-col-md-12">
            		<table class="tablecontent">
            		    <thead>
                			<tr class="table_header">
                				<th class="tablepara">Dates</th>
                				<th class="tablepara">
                                    <?php
                                    
                                    if (isset($_GET['offset'])){
                                        $decimalzone = time_to_decimal($_GET['offset']);
                                        if ($decimalzone >= 0){
                                        $timezone = "UTC+".$_GET['offset'];
                                        } else {
                                        $timezone = "UTC".$_GET['offset'];
                                        }
                                    }
                                    ?>
                                    <script>
                                        jQuery(document).ready(function($){
                                            $("select#timezone-offset").change(function(){
                                                var offset = $(this).val();
                                                var newurl = $(this).attr("current-url")+"?offset="+offset;
                                                console.log(newurl);
                                                window.location.href = newurl;
                                            });
                                        });
                                    </script>
                                    <select current-url="<?php echo get_the_permalink(); ?>" style="width: 160px;display: block;border-radius: 5px;cursor: pointer;font-size: 12px;border-color: #ddd;padding: 5px;" name="timezone_offset" id="timezone-offset" class="span5">
                                        <option value="">Change timezone</option>
                                        <option value="-12:00">(GMT -12:00) Eniwetok, Kwajalein</option>
                                        <option value="-11:00">(GMT -11:00) Midway Island, Samoa</option>
                                        <option value="-10:00">(GMT -10:00) Hawaii</option>
                                        <option value="-09:30">(GMT -9:30) Taiohae</option>
                                        <option value="-09:00">(GMT -9:00) Alaska</option>
                                        <option value="-08:00">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
                                        <option value="-07:00">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
                                        <option value="-06:00">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
                                        <option value="-05:00">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
                                        <option value="-04:30">(GMT -4:30) Caracas</option>
                                        <option value="-04:00">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
                                        <option value="-03:30">(GMT -3:30) Newfoundland</option>
                                        <option value="-03:00">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
                                        <option value="-02:00">(GMT -2:00) Mid-Atlantic</option>
                                        <option value="-01:00">(GMT -1:00) Azores, Cape Verde Islands</option>
                                        <option value="+00:00">(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
                                        <option value="+01:00">(GMT +1:00) Brussels, Copenhagen, Madrid, Paris</option>
                                        <option value="+02:00">(GMT +2:00) Kaliningrad, South Africa</option>
                                        <option value="+03:00">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
                                        <option value="+03:30">(GMT +3:30) Tehran</option>
                                        <option value="+04:00">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
                                        <option value="+04:30">(GMT +4:30) Kabul</option>
                                        <option value="+05:00">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
                                        <option value="+05:30">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
                                        <option value="+05:75">(GMT +5:45) Kathmandu, Pokhara</option>
                                        <option value="+06:00">(GMT +6:00) Almaty, Dhaka, Colombo</option>
                                        <option value="+06:30">(GMT +6:30) Yangon, Mandalay</option>
                                        <option value="+07:00">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
                                        <option value="+08:00">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
                                        <option value="+08:75">(GMT +8:45) Eucla</option>
                                        <option value="+09:00">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
                                        <option value="+09:30">(GMT +9:30) Adelaide, Darwin</option>
                                        <option value="+10:00">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
                                        <option value="+10:30">(GMT +10:30) Lord Howe Island</option>
                                        <option value="+11:00">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
                                        <option value="+11:30">(GMT +11:30) Norfolk Island</option>
                                        <option value="+12:00">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
                                        <option value="+12:75">(GMT +12:45) Chatham Islands</option>
                                        <option value="+13:00">(GMT +13:00) Apia, Nukualofa</option>
                                        <option value="+14:00">(GMT +14:00) Line Islands, Tokelau</option>
                                    </select> 
                                    Time <!-- (GMT 00:00) --><?php echo ( isset($timezone) ) ? " (in ".$timezone.")" : " (in UTC)"; ?>
                                </th>
                				<th class="tablepara">Availability</v>
                				<th class="tablepara">Price</th>
                				<th class="tablepara">Booking</th>
                			</tr>
                		</thead>
                		<tbody>
            			<?php
							
						$date_count = 0;
						foreach ($class_course_dates as $class_course_date){
                            $course_start_time = $class_course_date['start_time'];
                            
                            if($course_start_time):
                                $course_start_time_str  = date("g:ia", strtotime($course_start_time));
                                $course_start_time_new = ptefl_convert_utc_time($course_start_time_str);
                            endif;
                            
                            $course_end_time = $class_course_date['end_time'];
                            
                            if($course_end_time):
                                $course_end_time_str  = date("g:ia", strtotime($course_end_time));
                                $course_end_time_new = ptefl_convert_utc_time($course_end_time_str);
                            endif;
                            
                            if($course_start_time && $course_end_time):
                                $course_time = $course_start_time_new." - ".$course_end_time_new;
                            else:
                                $course_time = "";
                            endif;

							$date_count++;
							?>
        					<tr class="<?php // echo $course_date_slug; ?>">
        						<td class="date">
        							<?php echo $class_course_date['start_date']." - ".$class_course_date['end_date']; ?>	
        						</td>
        						<td class="time">
        						    <?php //echo $class_course_date['start_time'];  ?>
                                    <?php echo $course_time; ?>
        						</td>
                                <td class="availability">
                                    <?php 
                                        if($class_course_date['number_of_seats']) {
											echo $class_course_date['number_of_seats'];
										} else{
                                            echo '<span class="space-full">FULL</span>';
										}
                                    ?>
                                </td>
        						<td class="price"><?php echo $course_price;?> </td>
        						<td class="enroll_btn <?php // echo $class; ?>">
									<a 
                                        rel="nofollow"    
                                        class="table_btn" 
								        href="<?php echo '/?addtimetocart&prid='.$course_product_id.'&date='.$class_course_date['start_date'] ; ?>">
                                        Enrol Now
                                    </a>
								</td>
        					</tr>

                            <script type="application/ld+json">
                                {
                                    "@context": "http://schema.org",
                                    "@type": "EducationEvent",
                                    "name": "<?php the_title(); ?>",
                                    "performer": "The TEFL Institute of Ireland",
                                    "url": "<?php echo get_the_permalink().'#course-'.$date_count; ?>",
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
                                        "url": "<?php echo '/?addtimetocart&prid='.$course_product_id.'&date='.$class_course_date['start_date']; ?>",
                                        "validFrom": "2020-01-01T12:00",
                                        "category": "Course"
                                    },
                                    "organizer": {
                                        "@type": "Organization",
                                        "name": "The TEFL Institute of Ireland",
                                        "url" : "https://teflinstitute.com/",
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
							
							<?php

						}
							
            			/* foreach($dates as $course_date_meta => $date):
    				    	$var_id = $product_variations_sorted[$date];
    				        $var_product = wc_get_product($var_id);
    
    				        $course_date_meta = get_post_meta($var_id, 'attribute_pa_dates', true); // Get the human readable course date
    						$course_date_term = get_term_by('slug', $course_date_meta, 'pa_dates');
    				    	$course_start_date = get_post_meta($var_id, 'course_date', true); // Get the machine readable course date
    						$course_date = $course_date_term->name;
    						
    						$course_start_time = get_post_meta($var_id, 'course_start_time', true);
    						
    						if($course_start_time):
                                $course_start_time_str  = date("G:i a", strtotime($course_start_time));
                            endif;
                            
                            $course_end_time = get_post_meta($var_id, 'course_end_time', true);
    						
    						if($course_end_time):
                                $course_end_time_str  = date("G:i a", strtotime($course_end_time));
                            endif;
                            
                            if($course_start_time && $course_end_time):
                                $course_time = $course_start_time_str." - ".$course_end_time_str;
                            else:
                                $course_time = "";
                            endif;
    
    				    	$stock_avail = $var_product->is_in_stock();
    				    	
    				    	$class = '';
    				    	
                            if(!$stock_avail) :
                               $class = "disable_btn";
                            endif;
    				    	
    						$course_availability = $var_product->get_stock_quantity();
    						$course_availability = round($course_availability);
    
    						$add_to_cart_link = site_url().'/?add-to-cart='.$course_product_id.'&variation_id='.$var_id.'&attribute_pa_dates='.$course_date_meta; ?>
            		    	    
        					<tr class="<?php echo $course_date_slug; ?>">
        						<td class="date">
        							<?php if($course_date):
        								echo $course_date;
        							else:
        								echo "-";
        							endif; ?>	
        						</td>
        						<td class="time">
        						    <?php if($course_time):
                                        echo $course_time;
            						else:
            							echo "-";
            						endif; ?>
        						</td>
                                <td class="availability">
                                    <?php 
                                        if($stock_avail) :
                                            if($course_availability) :
                                                echo $course_availability;
                    						else:
                    							echo "-";
                                            endif; 
                                        else:
                                            echo '<span class="space-full">FULL</span>';
                                        endif;
                                    ?>
                                </td>
        						<td class="price"><?php echo $var_product->get_price_html();?> </td>
        						<td class="enroll_btn <?php echo $class; ?>"><a class="table_btn" rel="nofollow" href="<?php echo $add_to_cart_link;?>">Enrol Now</a></td>
        					</tr>
            			<?php endforeach; */
						?>
            			</tbody>
            		</table>
            		<?php
					if ($date_count >= 3) {
						?>
						<div class="dates-more">
							<span>SHOW ALL DATES</span>
						</div>
						<?php
					}
                    /* foreach ($product_variations as $var_id):
                        $variation = wc_get_product($var_id);
                        $variation_data = $variation->get_variation_attributes(); // variation data in array
                        $course_date_slug = $variation_data['attribute_pa_dates'];
                        if( $course_date_slug == 'flexible-booking-book-now-and-choose-the-date-later') :
                            $add_to_cart_link = site_url().'/cart/?add-to-cart='.$var_id; ?>
                            <div class="flexible-booking-btn text-center"><a class="table_btn" rel="nofollow" href="<?php echo $add_to_cart_link; ?>">Flexible booking - book now and choose the date later</a></div>
                        <?php endif;
                    endforeach;  */
                    ?>
            	</div>
            </div>
        <!--</div>-->
    </section>
<?php endif; ?>