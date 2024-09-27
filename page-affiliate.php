<?php 

	/*
	Template Name: Become an Affiliate Template
	*/

	get_header();

	$current_page_id = get_the_ID();

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}

	$heading = get_field('heading');
    $affiliate_marketer = get_field('affiliate_marketer');
	$why_choose_us = get_field('why_choose_us');

?>


<div class="ast-container">

    <div class="ast-row">

        <div class="ast-col">

            <img src="https://tefl.ie/wp-content/uploads/2021/02/work-with-us-and-earn.jpg">

        </div>

    </div>

</div>

<div class="section">

    <div class="ast-container">

        <div class="ast-row">

            <div class="ast-col">

                <div class="heading">

                    <?php echo $heading; ?>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="faq-section">

    <div class="ast-container">

        <div class="ast-row">

            <div class="ast-col-sm-12 ast-col-md-9">

                <div class="faq">
                    
                    <iframe width="100%" height="415" src="https://www.youtube.com/embed/7j6B4xyoy2A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    
                    <hr>
                    <h3>Become a Brand Ambassador for one of the fastest growing ESL companies</h3>

                    <div class="accordion"  id="accordionExample">

                        <?php
                
							$i = 0;
							foreach($affiliate_marketer as $element): 
								$question = $element['question'];
								$answer = $element['answer'];
							?>

                            <section class="accordion-container">
								<input id="accordion-<?php echo $i ?>" name="accordion-1" type="radio" <?php if($i === 0) { ?>checked<?php } ?>>
								<label for="accordion-<?php echo $i ?>"><?php echo $question ?></label>
								<article>
									<?php echo $answer ?>
								</article>
							</section>           

                        <?php $i++; endforeach;  ?>

                    </div>

                    <p class="question">Become an ambassador today! Earn 13% each time you refer someone to the TEFL Institute.</p>
                
				</div>

            </div>

            <div class="ast-col-sm 12 ast-col-md-3">

                <img src="https://tefl.ie/wp-content/uploads/2021/02/Lauren-team-mate.jpg"><br><br>
                <img src="https://tefl.ie/wp-content/uploads/2021/02/David-team-mate.jpg">

            </div>

        </div>

    </div>

</div>

<div class="choose-section section">
    <div class="ast-container">
        <h3>WHY CHOOSE US</h3>
        <div class="ast-row">
            <?php foreach($why_choose_us as $element) {

                $paragraph = $element['paragraph'];
                $title = $element['title'];
                $subtitle = $element['subtitle']; 
                $small = $element['small']; ?>

                <div class="ast-col-md-4">
                    <div class="item">
                        <div class="w-100">
                            <p><?php echo $paragraph ?></p>
                            <h2><?php echo $title ?></h2>
                            <h3><?php echo $subtitle ?></h3>
                            <span><?php echo $small ?></span>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</div>

<div class="section">
    <div class="ast-container">
        <div class="ast-row">
            <div class="ast-col">
                <div class="alert">Already an Ambassador? <a target="_blank" href="/affiliate-area/">Log in</a> or access your <a href="https://teflinstitute.com/affiliate-area/">dashboard</a>.</div>
                <div class="pt-5 form-container">
                    <?php echo do_shortcode( '[affiliate_registration]' ); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="started-section section">
    <div class="ast-container">
        <svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#000" fill-opacity="1" d="M0,128L120,122.7C240,117,480,107,720,101.3C960,96,1200,96,1320,96L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
        <div class="callback">
            <div class="ast-row d-flex align-items-end">
                <div class="ast-col-sm-12 ast-col-md-6">
                    <p class="heading-sm">Ready to Get Started?</p>
                    <p>Book an online meeting with us:</p>
                    <a href="https://teflinstitute.com/callback/" class="button-rounded">Choose a time and day here</a>
                </div>
                <div class="ast-col-sm-12 ast-col-md-6">
                    <img src="https://tefl.ie/wp-content/uploads/2021/02/affiliate-banner-min.png">
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
get_footer();