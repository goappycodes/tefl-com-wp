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
	</div>
</section>

<!--/Contact Form Section-->

<script>
	jQuery(document).ready(function ($) {
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
                $('#whenToCall').datetimepicker({ minTime: '09:15', maxTime: '19:45' });
            } else {
                switch (inputDate.getDay()) {
                    case 1: // Monday
                    case 2: // Tuesday
                    case 3: // Wednesday
                    case 4: // Thursday
                        this.setOptions({
                            minTime: '09:15',
                            maxTime: '19:45'
                        });
                        break;
                    case 5: // Friday
                        this.setOptions({
                            minTime: '09:15',
                            maxTime: '16:45'
                        });
                        break;
                    case 6: // Saturday
                    case 0: // Sunday
                        this.setOptions({
                            minTime: '13:30',
                            maxTime: '16:45'
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
        $('#whenToCall').on('change', function () {
            var oldValue = $(this).val();
            oldValue = oldValue.replace(/\s+/g, 'T');
            let newValue = oldValue + ":00+0000";
            $("#whenToCallVar").val(newValue);
        });
    });
</script>
<?php 
get_footer();