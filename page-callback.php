<?php 
/*
Template Name: Callback Template
*/

get_header();


$current_page_id = get_the_ID();

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<!--Banner Section-->
<?php
$hero_banner = get_field('hero_banner');

$banner_img = $hero_banner['banner_image'];
$banner_cta = $hero_banner['banner_cta'];

$cta_title = $banner_cta['cta_title'];
$cta_stitle = $banner_cta['cta_subtitle'];
$cta_txt = $banner_cta['cta_text'];
$cta_btn_txt = $banner_cta['cta_button_text'];
$cta_btn_link = $banner_cta['cta_button_link'];

if ($banner_img) {
?>
<section class="banner-section" style="margin-bottom: 80px; background-image:url('<?php echo $banner_img ?>')">
   <div class="ast-container">
		<div class="ast-row">
		    <div class="ast-col-md-6 ast-col-md-offset-6">
		        <div class="banner-content-block">
		            <div class="content-block">
		                <h2 class="section-heading"><?php echo $cta_title ?></h2>
		                <h3><?php echo $cta_stitle ?></h3>
		                <p><?php echo $cta_txt ?></p>
		                <!-- <img src="/wp-content/uploads/2020/11/Group-57.svg" /> -->
		            </div>
		            <a href="#contactForm"><?php echo $cta_btn_txt ?> <i class="fa fa-angle-right"></i></a>
		        </div>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<!--/Banner Section-->

<!--Contact Form Section-->
<?php
$cf_shortcode = get_field('contact_form_shortcode');
$cf_img = get_field('contact_form_image');
?>
<?php
	if(is_page('1126')):
?>
	<section class="header-section">
		<div class="ast-container">
			<div class="ast-row">
				<div class="ast-col-md-8">
					<h1 class="section-heading">request a callback</br>teaching english abroad</br>has never been easier</h1>
						<p>We make travelling the world an adventure our teachers will never forget, and to take you places you never imagined possible</p>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
	endif;
?>
<section id = "contactForm" class="contact-form-section">
    <div class="ast-container">
		<div class="ast-row callback-form">
			<div class="ast-col-md-10 contact-form-col">
		        <div class="callback-form-div">
					<?php 
						if(is_page('82151')):
							echo do_shortcode('[contact-form-7 id="dc779dd" title="Black Friday Callback Form"]');
						else:
							echo do_shortcode($cf_shortcode);
						endif;
					?>
                </div>
			</div>
		</div>
        <div class="ast-row d-none">
            <div style="margin: auto;max-width: 1100px;padding-bottom: 2rem;">
                <h1 class="section-heading" style="text-align: center;text-transform: uppercase;">What Our Students Say About Us</h1>
                <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
                <div class="trustpilot-widget" data-locale="en-GB" data-template-id="54ad5defc6454f065c28af8b" data-businessunit-id="61c0c19118c53fc28bcc355d" data-style-height="240px" data-style-width="100%" data-tags="Team" data-stars="3,4,5" data-review-languages="en">   <a href="https://uk.trustpilot.com/review/teflinstitute.com" target="_blank" rel="noopener">Trustpilot</a> </div>
            </div>
        </div>
    </div>
</section>

<!--/Contact Form Section-->

<script>
	jQuery(document).ready(function ($) {

        // Show selected time in user's time zone 

        let userTimezone = null;
        let isUpdating = false; 
    
        function initializeTimezone() {
            if (typeof callback_data !== 'undefined' && callback_data.detected_timezone) {
                userTimezone = callback_data.detected_timezone;
                setCookie('user_timezone', userTimezone, 30);
            } else {
                let cookieTimezone = getCookie('user_timezone');
                if (cookieTimezone) {
                    userTimezone = cookieTimezone;
                } else {
                    try {
                        userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                        setCookie('user_timezone', userTimezone, 30);
                    } catch (e) {
                        console.log('Could not detect timezone');
                        userTimezone = 'UTC'; 
                    }
                }
            }
            
            console.log('User timezone detected:', userTimezone);
        }
        
        function setCookie(name, value, days) {
            const expires = new Date(Date.now() + days * 864e5).toUTCString();
            document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + expires + '; path=/; SameSite=Strict';
        }
        
        function getCookie(name) {
            return document.cookie.split('; ').reduce((r, v) => {
                const parts = v.split('=');
                return parts[0] === name ? decodeURIComponent(parts[1]) : r;
            }, '');
        }
        
        function convertToUserTime(ukDateTimeString) {
            if (!userTimezone || !ukDateTimeString || isUpdating) {
                return null;
            }
            
            try {
                // const ukDate = new Date(ukDateTimeString + ' GMT+0000');

                const date = new Date(ukDateTimeString);
                const isBST = date.getTimezoneOffset() < 0; 
                const ukDate = new Date(ukDateTimeString + (isBST ? ' GMT+0100' : ' GMT+0000'));
                
                const options = {
                    timeZone: userTimezone,
                    weekday: 'short',
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                };
                
                return {
                    formatted: new Intl.DateTimeFormat('en-US', options).format(ukDate),
                    timezone: userTimezone
                };
            } catch (e) {
                console.error('Error converting timezone:', e);
                return null;
            }
        }
        
        function displayUserLocalTime(ukDateTime) {
            if (isUpdating) return;
            
            const display = $('#userTimezoneDisplay');
            const timeSpan = $('#userLocalTime');
            const timezoneInfo = $('#timezoneInfo');
            
            if (!userTimezone || !ukDateTime) {
                display.slideUp(200);
                return;
            }
            
            const converted = convertToUserTime(ukDateTime);
            if (!converted) {
                display.slideUp(200);
                return;
            }
            
            isUpdating = true;
            
            if (display.is(':visible')) {
                timeSpan.fadeOut(150, function() {
                    timeSpan.text(converted.formatted).fadeIn(150);
                    timezoneInfo.text('(' + converted.timezone + ')');
                    isUpdating = false;
                });
            } else {
                timeSpan.text(converted.formatted);
                timezoneInfo.text('(' + converted.timezone + ')');
                display.slideDown(300, function() {
                    isUpdating = false;
                });
            }
        }
        
        initializeTimezone();

        // Date Time Picker
        let datesToDisable = [
            '2024-03-18',
            '2024-04-01',
            '2024-05-06',
            '2024-06-03',
            '2024-08-05',
            '2024-10-28',
            '2024-12-25',
            '2024-12-26',
        ];

        function disableDates() {
            // Disable dates
            datesToDisable.forEach(date => {
                var [year, month, day] = date.split('-').map(val => parseInt(val, 10));
                const dateCells = $(`.xdsoft_date[data-year="${year}"][data-month="${month - 1}"][data-date="${day}"]`);
                dateCells.addClass('xdsoft_disabled');
            });
        }

        function checkPastTime(inputDateTime) {
            let current = new Date();
            let currentBST = new Date(current.getTime() + (current.getTimezoneOffset()+ 60) * 60000);
            let inputDate = new Date(inputDateTime);

            if (inputDate <= currentBST) {
                // Reset datetime picker to current time
                $('#whenToCall').datetimepicker('reset');
                $('#whenToCall').datetimepicker({ minTime: '09:15', maxTime: '17:00' });
                $('#userTimezoneDisplay').slideUp(200);
            } else {
                clearTimeout(window.timezoneUpdateTimer);
                window.timezoneUpdateTimer = setTimeout(() => {
                    displayUserLocalTime(inputDateTime);
                }, 100);

                switch (inputDate.getDay()) {
                    case 1: // Monday
                    case 2: // Tuesday
                    case 3: // Wednesday
                    case 4: // Thursday
                        this.setOptions({
                            minTime: '09:15',
                            maxTime: '17:00'
                        });
                        break;
                    case 5: // Friday
                        this.setOptions({
                            minTime: '09:15',
                            maxTime: '17:00'
                        });
                        break;
                    case 6: // Saturday
                    case 0: // Sunday
                        this.setOptions({
                            minTime: '13:30',
                            maxTime: '17:00'
                        });
                        break;
                }
                
            }
        }

        var currentYear = new Date().getFullYear();
        $('#whenToCall').datetimepicker({
            format: 'Y-m-d H:i',
            minDate: 0,
            defaultTime: '09:15',
            step: 15,
            // disabledWeekDays: [0, 6],
            yearStart: currentYear, // Start value for current Year selector
            onChangeDateTime: checkPastTime,
            onShow: checkPastTime,
            onGenerate: disableDates
        });

        // Manually trigger onShow to set initial minTime and maxTime
        $('#whenToCall').datetimepicker('show').datetimepicker('hide');
        
        let changeTimer;
        $('#whenToCall').on('change input', function () {
            clearTimeout(changeTimer);
            
            const selectedValue = $(this).val().trim();
            
            changeTimer = setTimeout(() => {
                if (selectedValue) {
                    const formattedValue = selectedValue.replace(/\s+/g, 'T') + ":00+0000";
                    $("#whenToCallVar").val(formattedValue);
                    
                    displayUserLocalTime(selectedValue);
                } else {
                    $('#userTimezoneDisplay').slideUp(200);
                }
            }, 300); 
        });
    });
</script>

<style>
    .timezone-display {
        margin-top: 12px;
        display: none;
        animation: slideIn 0.3s ease-out;
    }

    .timezone-content {
        padding: 12px 16px;
        background: linear-gradient(135deg, #f0f8ff 0%, #e6f3ff 100%);
        border-left: 4px solid #007cba;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0,123,186,0.1);
        font-size: 14px;
        line-height: 1.5;
    }

    .timezone-content p {
        display: inline;
    }
    
    .timezone-content strong {
        color: #007cba;
        font-weight: 600;
    }

    .timezone-content small {
        display: block;
        color: #666;
        font-size: 12px;
        margin-top: 2px;
        opacity: 0.8;
    }

    .time-note {
        display: block;
        font-size: 12px;
        color: #666;
        font-style: italic;
        margin-top: 5px;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #userLocalTime {
        transition: all 0.2s ease;
    }

    @media (max-width: 768px) {
        .timezone-content {
            font-size: 13px;
            padding: 10px 12px;
        }
    }

    .timezone-loading {
        opacity: 0.6;
        pointer-events: none;
    }
</style>
<?php 
get_footer();