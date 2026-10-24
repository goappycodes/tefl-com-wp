<?php
/**
 * The template for displaying all single screening_forms.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-ppc
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$country = get_field('country');
$guide = get_field('guide');
$get_started = get_field('get_started');
$about = get_field('about');
$passport = get_field('passport');
$level = get_field('level');
$degree = get_field('degree');
$age = get_field('age');
$record = get_field('record');
$healthy = get_field('healthy');
$open = get_field('open');
$congratulations_image = get_field('congratulations_image');

get_header();

?>

<div id="primary" <?php astra_primary_class(); ?>>
  
  	<div class="salary-calculator-form"><?php echo do_shortcode('[contact-form-7 id="389046" title="Screening Form"]'); ?></div>
  
</div>

<script>
	jQuery(document).ready(function($) {
      
      	$('#country_heading').text('<?php echo $country; ?>');
        $('#country_subheading').text('<?php echo $country; ?>');
      
      	$('#get_started').css('background-image', 'url("<?php echo $get_started; ?>")');
      	$('#about_image').css('background-image', 'url("<?php echo $about; ?>")');
      
		$('#passport_image').css('background-image', 'url("<?php echo $passport['image']; ?>")');
      	<?php
        	foreach ($passport['options'] as $e) { $answer = $e['answer']; ?>
      		$('#passport_options').append('<label><span class="wpcf7-list-item-label"><?php echo $answer; ?></span><input type="radio" name="passport" value="<?php echo $answer; ?>"></label>');
        <?php } ?>
        
        $('#level_image').css('background-image', 'url("<?php echo $level['image']; ?>")');
      	<?php
        	foreach ($level['options'] as $e) { $answer = $e['answer']; ?>
      		$('#level_options').append('<label><span class="wpcf7-list-item-label"><?php echo $answer; ?></span><input type="radio" name="english-level" value="<?php echo $answer; ?>"></label>');
        <?php } ?>
      
		$('#degree_image').css('background-image', 'url("<?php echo $degree['image']; ?>")');
      	<?php
        	foreach ($degree['options'] as $e) { $answer = $e['answer']; ?>
      		$('#degree_options').append('<label><span class="wpcf7-list-item-label"><?php echo $answer; ?></span><input type="radio" name="degree" value="<?php echo $answer; ?>"></label>');
        <?php } ?>
      
        $('#age_image').css('background-image', 'url("<?php echo $age['image']; ?>")');
      	<?php
        	foreach ($age['options'] as $e) { $answer = $e['answer']; ?>
      		$('#age_options').append('<label><span class="wpcf7-list-item-label"><?php echo $answer; ?></span><input type="radio" name="age" value="<?php echo $answer; ?>"></label>');
        <?php } ?>
      
      	$('#record_image').css('background-image', 'url("<?php echo $record['image']; ?>")');
      	<?php
        	foreach ($record['options'] as $e) { $answer = $e['answer']; ?>
      		$('#record_options').append('<label><span class="wpcf7-list-item-label"><?php echo $answer; ?></span><input type="radio" name="criminal-record" value="<?php echo $answer; ?>"></label>');
        <?php } ?>
      
		$('#healthy_image').css('background-image', 'url("<?php echo $healthy['image']; ?>")');
      	<?php
        	foreach ($healthy['options'] as $e) { $answer = $e['answer']; ?>
      		$('#healthy_options').append('<label><span class="wpcf7-list-item-label"><?php echo $answer; ?></span><input type="radio" name="health" value="<?php echo $answer; ?>"></label>');
        <?php } ?>
      
        $('#open_image').css('background-image', 'url("<?php echo $open['image']; ?>")');
      	<?php
        	foreach ($open['options'] as $e) { $answer = $e['answer']; ?>
      		$('#open_options').append('<label><span class="wpcf7-list-item-label"><?php echo $answer; ?></span><input type="radio" name="open-mind" value="<?php echo $answer; ?>"></label>');
        <?php } ?>
      
      	var show_common_style = 'display:flex;';
        var hide_common_style = 'display:none;';
      
      	var tefl_passport = 0;
      	var tefl_english_level = 0;
		var tefl_degree = 0;
        var tefl_age = 0;
        var tefl_criminal_record = 0;
        var tefl_healthy = 0;
        var tefl_open_mind = 0;
      	var total = 0;
        
        $('.salary-calculator-form .wpcf7-submit').attr('disabled', 'disabled');

        $(document).on('click', '.get-started-btn', function(e) {
            e.preventDefault();
            $('.name-div').attr('style', show_common_style);
            $('.info-text').attr('style', hide_common_style);
        })

        $(document).on('click', '.name-ok-btn', function(e) {
            e.preventDefault();
            $('.tefl-passport-div').attr('style', show_common_style);
            $('.name-div').attr('style', hide_common_style);
        })
      
      	$(document).on('click', 'input[name="passport"]', function(e) {
            if ($('input[name="passport"]').is(':checked')) {
                $('.tefl-passport .wpcf7-list-item').removeClass('checked');
                $(this).parent().parent().addClass('checked');
              	setTimeout(function() {
                  	<?php
                        foreach ($passport['options'] as $key=>$e) { $answer = $e['answer']; $points = $e['points']; ?>
                          	if ($('input[name=passport]:checked', '#passport_options').val() == '<?php echo $answer; ?>') {
                    			tefl_passport = <?php echo $points; ?>;
                          	} 
                    <?php } ?>
                  
                    $('.tefl-english-level-div').attr('style', show_common_style);
                    $('.tefl-passport-div').attr('style', hide_common_style);
                }, 1000);
            }
        })

        $(document).on('click', 'input[name="english-level"]', function(e) {
            if ($('input[name="english-level"]').is(':checked')) {
                $('.tefl-english-level .wpcf7-list-item').removeClass('checked');
                $(this).parent().parent().addClass('checked');
                setTimeout(function() {
                  	<?php
                        foreach ($level['options'] as $key=>$e) { $answer = $e['answer']; $points = $e['points']; ?>
                          	if ($('input[name=english-level]:checked', '#level_options').val() == '<?php echo $answer; ?>') {
                    			tefl_english_level = <?php echo $points; ?>;
                          	} 
                    <?php } ?>
                  
                    $('.tefl-degree-div').attr('style', show_common_style);
                    $('.tefl-english-level-div').attr('style', hide_common_style);
                }, 1000);
            }
        })

        $(document).on('click', 'input[name="degree"]', function(e) {
            if ($('input[name="degree"]').is(':checked')) {
                $('.tefl-degree .wpcf7-list-item').removeClass('checked');
                $(this).parent().parent().addClass('checked');
                setTimeout(function() {
                  	<?php
                        foreach ($degree['options'] as $key=>$e) { $answer = $e['answer']; $points = $e['points']; ?>
                          	if ($('input[name=degree]:checked', '#degree_options').val() == '<?php echo $answer; ?>') {
                    			tefl_degree = <?php echo $points; ?>;
                          	} 
                    <?php } ?>
                  
                    $('.tefl-age-div').attr('style', show_common_style);
                    $('.tefl-degree-div').attr('style', hide_common_style);
                }, 1000);
            }
        })

        $(document).on('click', 'input[name="age"]', function(e) {
            if ($('input[name="age"]').is(':checked')) {
                $('.tefl-age .wpcf7-list-item').removeClass('checked');
                $(this).parent().parent().addClass('checked');
                setTimeout(function() {
                  	<?php
                        foreach ($age['options'] as $key=>$e) { $answer = $e['answer']; $points = $e['points']; ?>
                          	if ($('input[name=age]:checked', '#age_options').val() == '<?php echo $answer; ?>') {
                    			tefl_age = <?php echo $points; ?>;
                          	} 
                    <?php } ?>
                  
                    $('.tefl-criminal-record-div').attr('style', show_common_style);
                    $('.tefl-age-div').attr('style', hide_common_style);
                }, 1000);
            }
        })

        $(document).on('click', 'input[name="criminal-record"]', function(e) {
            if ($('input[name="criminal-record"]').is(':checked')) {
                $('.tefl-criminal-record .wpcf7-list-item').removeClass('checked');
                $(this).parent().parent().addClass('checked');
                setTimeout(function() {
                  	<?php
                        foreach ($record['options'] as $key=>$e) { $answer = $e['answer']; $points = $e['points']; ?>
                          	if ($('input[name=criminal-record]:checked', '#record_options').val() == '<?php echo $answer; ?>') {
                    			tefl_criminal_record = <?php echo $points; ?>;
                          	} 
                    <?php } ?>
                  
                    $('.tefl-health-div').attr('style', show_common_style);
                    $('.tefl-criminal-record-div').attr('style', hide_common_style);
                }, 1000);
            }
        })

        $(document).on('click', 'input[name="health"]', function(e) {
            if ($('input[name="health"]').is(':checked')) {
                $('.tefl-health .wpcf7-list-item').removeClass('checked');
                $(this).parent().parent().addClass('checked');
                setTimeout(function() {
                    <?php
                        foreach ($healthy['options'] as $key=>$e) { $answer = $e['answer']; $points = $e['points']; ?>
                          	if ($('input[name=health]:checked', '#healthy_options').val() == '<?php echo $answer; ?>') {
                    			tefl_healthy = <?php echo $points; ?>;
                          	} 
                    <?php } ?>
                  	
                  	$('.tefl-open-mind-div').attr('style', show_common_style);
                    $('.tefl-health-div').attr('style', hide_common_style);
                }, 1000);
            }
        })

        $(document).on('click', 'input[name="open-mind"]', function(e) {
            if ($('input[name="open-mind"]').is(':checked')) {
                $('.open-mind .wpcf7-list-item').removeClass('checked');
                $(this).parent().parent().addClass('checked');
              	<?php
                	foreach ($open['options'] as $key=>$e) { $answer = $e['answer']; $points = $e['points']; ?>
                    	if ($('input[name=open-mind]:checked', '#open_options').val() == '<?php echo $answer; ?>') {
                  			tefl_open_mind = <?php echo $points; ?>;
                        } 
                <?php } ?>

              	total = parseInt(tefl_passport) + parseInt(tefl_english_level) + parseInt(tefl_degree) + parseInt(tefl_age) + parseInt(tefl_criminal_record) + parseInt(tefl_healthy) + parseInt(tefl_open_mind);
            	console.log('end total: ' + total);
              	document.getElementById("country").value = '<?php echo $country; ?>';
              	document.getElementById("total").value = total;
              
                $('.final-submit-div').attr('style', show_common_style);
                $('.wpcf7-submit').removeAttr('disabled');
            }
        })
      
      	document.addEventListener('wpcf7submit', function(event) {
            if ('77549' == event.detail.contactFormId) {

                $('.salary-calculator-form .wpcf7-response-output').attr('total', total);
                $('.salary-calculator-form .wpcf7-response-output').addClass('ast-row');
                $('.tefl-open-mind-div, .final-submit-div').attr('style', 'display:none;');
                var html_prev_text = '<div class="ast-col-md-6 ast-col-sm-12 img-col"><div style="background-image: url(<?php echo $congratulations_image; ?>);"></div></div>';
            var html_txt = '<p class="small-note"><small>* Please note that this form provides an initial screening only and does not guarantee you a position.</small>';
			var html_callback_internships = '<div style="display:flex;justify-content: center;gap: 20px;"><a style="background-color: #09487B;border-radius: 5px;color: white;margin-bottom: 20px !important;font-size: 1rem;padding: 10px 20px;letter-spacing: 0.3px;text-transform: uppercase;" href="/callback">Get a Callback</a><a style="background-color: #000;border-radius: 5px;color: white;margin-bottom: 20px !important;font-size: 1rem;padding: 10px 20px;letter-spacing: 0.3px;text-transform: uppercase;" href="/tefl-internships/">See all Internships</a></div>';
          
            setTimeout(function() {
                if (total < 7) {
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col"><p>Unfortunately, you do not meet the criteria needed for the <?php echo $country; ?> Internship. We are sorry about this! Please feel free to get in touch with us if you feel that this is a mistake or you\'d like to look at other options.</p>' + html_callback_internships + html_txt + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                } else if (total > 6) {
                    var response = html_prev_text + '<div class="ast-col-md-6 ast-col-sm-12 content-col"><p>Congratulations it looks like you meet all of the requirements for our teaching in <?php echo $country; ?> Internship. A member of our sales team will give you a call within the next two working days to go through the program in more depth.</p>' + html_txt + '</div>';
                    $('.salary-calculator-form .wpcf7-response-output').html(response);
                }
            }, 200);
            }
        }, false);

      
      	$(document).on('keyup change', 'input[name="your-name"], input[name="last-name"], input[name="your-email"], input[name="phoneNumber"]', function(e) {
            if (($('input[name="your-name"]').val().length !== 0) && ($('input[name="last-name"]').val().length !== 0) && ($('input[name="your-email"]').val().length !== 0)  && ($('input[name="phoneNumber"]').val().length !== 0) ) {
                $('.name-ok-btn').attr('style', 'display:inline-block;');
                if (e.keyCode === 13) {
                    $(".name-ok-btn").click();
                }
            } else {
                $('.name-ok-btn').attr('style', hide_common_style);
            }
        })
      
      	$(document).on('keyup change', 'input[name="phoneNumber"]', function(e) {
            if ($('input[name="phoneNumber"]').val().length >= 10 && $('input[name="phoneNumber"]').val().length <= 15) {
                $('.phone-ok-btn').attr('style', 'display:inline-block;');
                if (e.keyCode === 13) {
                    $(".phone-ok-btn").click();
                }
            } else {
                $('.phone-ok-btn').attr('style', hide_common_style);
            }
        })
    
        var page_url = "<?php echo get_permalink(); ?>";
        var page_title = "<?php single_post_title(); ?>";

        jQuery(document).ready(function($) {
            $("#page_url").val(page_url);
            $("#page_title").val(page_title);
        });

	});
  
</script>

<?php get_footer(); ?>