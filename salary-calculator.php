<?php

add_shortcode('salary_calculator_form','salary_calculator_form_fn');

function salary_calculator_form_fn(){
	?>
	<form class="salary-calculator-form">
	  <!-- Do you have a TEFL Qualification or similar? -->
	  	<div class="">
		  	<label>Do you have a TEFL Qualification or similar?</label>
		  	<select name="tefl_qualification" class="custom-select-sm">
		    	<option selected>Select...</option>
		    	<option value="1">120 hour TEFL Certificate</option>
		    	<option value="2">Level 5/CELTA Certificate</option>
		    	<option value="0">Not Yet</option>
		  	</select>
		</div>


	  <!-- What is your highest level of education? -->
	  <select name="level_of_education" class="custom-select-sm">
	    <option selected>What is your highest level of education?</option>
	    <option value="0">High school diploma, A-levels, or equivalent</option>
	    <option value="1">Associates or Bachelor's degree</option>
	    <option value="2">Master's degree or above</option>
	  </select>

	  <!-- Where do you hold your passport from?  -->
	  <select name="passport_country" class="custom-select-sm">
	    <option selected>Where do you hold your passport from?</option>
	    <option value="2">UK/Ireland/Oz/NewZealand/US/Canada</option>
	    <option value="1">Other (where English is the official language)</option>
	    <option value="0">Other (non-native English speaking Country)</option>
	  </select>

	  <!-- Do you have experience in TEFL, online or abroad?   -->
	  <select name="passport_country" class="custom-select-sm">
	    <option selected>Do you have experience in TEFL, online or abroad?</option>
	    <option value="2">Over 5 years</option>
	    <option value="1">1-5 years</option>
	    <option value="0">None Yet</option>
	  </select>

	  <!-- Would you like your curriculum and lesson planning done for you?   -->
	  <select name="passport_country" class="custom-select-sm">
	    <option selected>Would you like your curriculum and lesson planning done for you?</option>
	    <option value="1">Yes</option>
	    <option value="3">No</option>
	  </select>

	  <input type="submit" value="Submit" class="salary-calc-submit">
	</form>
<?php
}