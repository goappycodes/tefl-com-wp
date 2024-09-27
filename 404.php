<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<style>
   	#primary {
    margin: 50px 0 0 0;
}
    	.main {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 2rem;
        }

        .main .title {
            font-weight: 500;
            font-size: 30px;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .main .subtitle {
            font-size: 20px;
            font-weight: 400;
        }

        .main .title:before {
          	content: "";
            background: url(https://tefl.ie/wp-content/uploads/2023/03/Link.png) no-repeat center center / 40px;
            width: 40px;
            height: 40px;
            position: relative;
            display: block;
        }
      
     
      .ast-container {
      	padding: 0;
      	}
  
      .grid {
    margin: 50px 20px;
    display: flex;
    gap: 2rem;
}

.grid .item {
    width: 33%;
    background: #ECECEC;
}

.grid .item .image {
    height: 200px;
    background-size: cover;
    background-position: center;
}

.grid .item .btn {
    margin: 1.5rem 2rem;
    padding: 10px 30px;
    display: block;
    text-align: center;
    background: #256D74;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.2rem;
    font-size: 14px;
    line-height: 1.5;
}
      
.ast-container.tabs-column {
    margin-bottom: 30px;
}

.tabs-section {
    margin: 50px 20px;
}

.salary-calculator {
    background: url(https://teflinstitute.com/wp-content/uploads/2021/04/BYfbTePA.jpeg) no-repeat center center / cover;
}

.salary-calculator-inner {
  	background: rgba(0, 0, 0, 0.4);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 50px;
    text-align: center;
}

.salary-calculator-inner h3 {
    color: #fff;
    font-size: 1.25rem;
    font-weight: 500;
    line-height: 1.8rem;
    letter-spacing: .4rem;
    text-transform: uppercase;
    margin-bottom: 20px;
}

.salary-calculator-inner p {
    color: #fff;
    font-size: 14px;
    line-height: 1.5;
    margin: 0;
    padding-bottom: 30px;
    width: 600px;
}

.english-test {
    background: url(https://teflinstitute.com/wp-content/uploads/2020/11/take_the_test_bg.jpg) no-repeat center center / cover;
}

.english-test-inner {
  	background: rgba(0, 0, 0, 0.4);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 50px;
    text-align: center;
}
      
.english-test-inner h3 {
    color: #fff;
    font-size: 1.25rem;
    font-weight: 500;
    line-height: 1.8rem;
    letter-spacing: .4rem;
    text-transform: uppercase;
    margin-bottom: 20px;
}

.english-test-inner p {
    color: #fff;
    font-size: 14px;
    line-height: 1.5;
    margin: 0;
    padding-bottom: 30px;
    width: 600px;
}

a.learn-more-button {
    text-transform: uppercase;
    color: #fff;
    background: black;
    font-size: 0.688rem;
    letter-spacing: 0.3rem;
    padding: 10px 20px;
}

a.learn-more-button span {
    display: inline-block;
    margin-left: 30px;
}

hr.white {
    background: #fff;
}

hr.blue {
    background: #193847;
}
      
     .search-btn-div {
    /* width: 50px; */
    height: 50px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    /* background-color: #000; */
    /* border-radius: 50%; */
    cursor: pointer;

}

.search-btn-div i.fa.fa-search {
    /* color: #fff; */
    font-size: 1rem;
    margin-left: .5rem;
}

a.tefl-search-btn {
    background: var(--black);
    padding: 1rem;
    color: var(--white) !important;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-size: 0.8em;
}

a.tefl-search-btn:hover {
    color: var(--black) !important;
    background: var(--white);
}

.tefl-search-btn {
    line-height: 1rem;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-col-inner {
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-col-inner div.search-field {
    display: flex;
    flex-direction: column;
    border-right: 1px solid #000;
    padding-right: 30px;
    padding-left: 15px;
}

.search-section {
    background-color: #ececec;
    padding: 15px 0 15px 15px;
  	margin: 0 20px;
}
      
.search-picker-section .section-heading {
    text-transform: uppercase;
    margin-bottom: 1.5rem;
  	margin-left: 20px;
}

.search-field select {
    border: none;
    background-color: transparent;
    padding: 0px !important;
    width: 200px;
    height: 30px;
    font-size: 1rem !important;
    outline: none;
    font-weight: 400;
    color: #444D55;
    -webkit-appearance: none;
    background-image: url(/wp-content/uploads/2022/01/down-arrow.svg);
    background-position: right -20%;
    background-repeat: no-repeat;
    background-size: 20px;
    cursor: pointer;
}


.search-field label {
    font-size: 0.875rem;
    font-weight: 600;
  	line-height: 1.5;
}

.search-col-inner .degree-div {
    border-right: none !important;
    padding-right: 0px !important;
}

      
  	@media screen and (max-width:767px) {   
      
      	#primary {
    margin: 0;
}
      
      	.english-test-inner {
    padding: 20px;
}
      
      .ast-container.tabs-column {
    margin: 20px;
}
      .english-test-inner p {
    width: 100%;
}
      
      .salary-calculator-inner p {
    width: 100%;
}
    	.main .title {
        	flex-direction: column;
          	font-size: 24px;
        }
      	.main .subtitle {
      		padding: 0 20px;
      	}
      	.grid {
            flex-direction: column;
        }
     	
      	.grid .item {
        	width: 100%;
      	}
      
      	.search-col-inner {
        flex-direction: column;
        justify-content: unset;
        align-items: unset;
        padding: 20px;
        grid-template-columns: 1fr 1fr;
        column-gap: 3rem;
    }
    .search-field {
        border-right: none !important;
        margin-bottom: 10px;	
      	padding-right: 0 !important;
    }
    .tefl-search-btn:after {
        content: 'Search Courses';
        color: #fff;
        font-weight: 600;
    }
    .search-btn-div {
        text-align: center;
        grid-column: 1 / -1;
        margin-top: 0.5rem;
    }
    .tefl-search-btn {
        background-color: #DFB428;
        display: flex;
        border-radius: 25px;
        align-items: center;
        justify-content: center;
    }
    .search-field select {
        background-position: right -20%;
      	width: 100%;
    }
      .tabs-section {
    margin: 3rem 0 -2rem;
}
      
    }
      
    </style>

	<div id="primary" <?php astra_primary_class(); ?>>
		
      	<div class="main">
          	<h1 class="title">This page doesn't seem to exist.</h1>
          	<h2 class="subtitle">It looks like the link pointing here was faulty. Maybe try one of these:</h2>
        </div>
      
      	<div class="grid">
          	<div class="item">
              	<div class="image" style="background-image: url('https://tefl.ie/wp-content/uploads/2020/12/plaptop-notepad-1.jpg');"></div>
              	<a class="btn btn-primary" href="/tefl-courses/">Course Overview</a>
        	</div>
          	<div class="item">
              	<div class="image" style="background-image: url('https://tefl.ie/wp-content/uploads/2023/02/travel-homepage.png');"></div>
              	<a class="btn btn-primary" href="/tefl-internships/">Internships</a>
        	</div>
          	<div class="item">
              	<div class="image" style="background-image: url('https://tefl.ie/wp-content/uploads/2022/04/60-hour-level-5-featured.jpg');"></div>
              	<a class="btn btn-primary" href="https://jobs.teflinstitute.com/?ref=ticom">TEFL Jobs</a>
        	</div>
        </div>
      
      	<section class="search-picker-section">
            <div class="ast-container">
                <h1 class="section-heading">Find the Perfect TEFL Course</h1>
                <div class="ast-row">
                    <div class="ast-col-lg-12 ast-col-md-12 ast-col-sm-12">
                        <?php echo do_shortcode('[tefl_course_search]'); ?>
                    </div>
                </div>
            </div>
        </section>
      
      	<section class="tabs-section">
          <div class="ast-container tabs-column">
                <div class="ast-row">
                	<div class="ast-col-md-12">
                		<div class="english-test">
                			<div class="english-test-inner">
                                <h3>tefl institute english level test</h3>
                                <p>Test your level of English to see if EFL teacher training is for you and which course will suit you best! A quick 5-minute test will tell you all you need to know.</p>
                                <a class="learn-more-button" href="https://tefl.ie/english-level-test/">Take the Test Now <span>&gt;</span>
                                </a>
                            </div>
                		</div>
                	</div>
                </div>
            </div>
            <div class="ast-container tabs-column">
                <div class="ast-row">
                    <div class="ast-col-md-12">
                    	<div class="salary-calculator">
                    		<div class="salary-calculator-inner">
                                <h3>Salary Calculator</h3>
                                <p>How much can you earn teaching English Online? Calculater your salary now.</p>
                                <a class="learn-more-button" href="/salary-calculator/">Calculate Salary <span>&gt;</span>
                                </a>
                            </div>
                    	</div>
                    </div>
                </div>
            </div>
        </section>
      
		<?php // astra_primary_content_top(); ?>

		<?php // astra_404_content_template(); ?>		

		<?php // astra_primary_content_bottom(); ?>
   
	</div><!-- #primary -->

<?php get_footer(); ?>
