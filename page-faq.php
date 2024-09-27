<?php 
    /*
    Template Name: Frequently Asked Questions
    */
    
    get_header();
    
    $current_page_id = get_the_ID();

?>

<section class="faq-hero-section">
    <div class="ast-container" style="background: url('https://teflinstitute.com/wp-content/uploads/2020/11/take_the_test_bg.jpg');">
		<div class="ast-row banner-text-row">
		    <div class="ast-col-lg-12 ast-col-md-12 ast-col-sm-12 ast-col-xs-12">
		        <h2 class="banner-text">TEFL Institute <br> Frequently Asked Questions</h2>
			</div>
		</div>
	</div>
</section>

<?php $frequently_asked_questions = get_field('frequently_asked_questions'); ?>

<div class="ast-row more-space">
	<div class="ast-col-md-12">
		<?php $i = 0; ?>
		<?php foreach($frequently_asked_questions as $item): ?>
				
			<?php $question = $item['question']; ?>
			<?php $answer = $item['answer']; ?>

			<section class="accordion-container">
				<input id="accordion-<?php echo $i ?>" name="accordion-1" type="radio" <?php if($i === 0) { ?>checked<?php } ?>>
				<label for="accordion-<?php echo $i ?>"><?php echo $question ?></label>
				<article>
					<?php echo $answer ?>
				</article>
			</section>
		<?php $i++; endforeach; ?> 
		<script type="application/ld+json">
						{
						  "@context": "https://schema.org",
						  "@type": "FAQPage",
						  "mainEntity": [
						  	<?php 
							$faqcount = count($frequently_asked_questions);
							$counter = 0;
							foreach ($frequently_asked_questions as $item) {
								$counter++;
								?>
								{
									"@type": "Question",
									"name": <?php echo json_encode($item['question']); ?>,
									"acceptedAnswer": {
									  "@type": "Answer",
									  "text": <?php echo json_encode($item['answer']); ?>
									}
								}	
								<?php
								if ($faqcount != $counter) echo "," ;
							}
							?>
						  ]
						}
		</script>						
		
	</div>
</div>

<?php 
get_footer();