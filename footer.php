<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
			<?php astra_content_bottom(); ?>

			</div> <!-- ast-container -->

		</div><!-- #content -->

		<?php astra_content_after(); ?>

		<?php astra_footer_before(); ?>

		<?php astra_footer(); ?>

		<?php astra_footer_after(); ?>

	</div><!-- #page -->
    <?php if(!is_page(array('72123','73264', 'checkout','73603','cart'))):?>
    <!-- <a href="/january-tefl-courses-sales/" class="ti-floating-cta">
        <img src="/wp-content/uploads/2023/01/january-sale-floating-2.png" alt="TI Floating banner">
    </a> -->
    <?php endif?>
     <span class = "show-button"  id = "showButton"><i class ="fa fa-angle-up"></i></span> 
    <div class="mobile-bar">
        <a href="tel:+442033185366" class="callback"></a>
        <p class="passrate"></p>
        <span class = "close-button" id="closeButton"><i class="fa fa-times"></i></span>
    </div>
    
	<?php astra_body_bottom(); ?>
    <div class="footer-legal-holder" style="display:none">
     <p class="footer__legal" itemscope="" itemtype="http://schema.org/Organization"></p>
     <div itemscope="" itemtype="https://schema.org/AggregateRating">
        <div itemprop="itemReviewed" itemscope="" itemtype="https://schema.org/Organization">
           <img width="20" itemprop="image" src="https://teflinstitute.com/wp-content/uploads/2021/01/teflinstitute.jpg" alt="TEFL Institute">
           <span itemprop="name">The TEFL Institute</span>
           <span itemprop="telephone">+44 20 3318 5366</span>
           <span itemtype="http://schema.org/PostalAddress" itemscope="" itemprop="address">
           <span itemprop="streetAddress">6 Mornington Pl.,</span>
           <span>
           <span itemprop="addressLocality">Greater London NW1 7RP</span>, <span itemprop="addressRegion">United Kingdom</span> 
           </span>
           </span>
        </div>
        <span itemprop="ratingValue">4.9</span> out of <span itemprop="bestRating">5</span> stars -
        <span itemprop="ratingCount">540</span> votes
     </div>
    </div>  

	<?php wp_footer(); ?>


    <script id="salesiq" type="text/javascript">
    var $zoho=$zoho || {};
    $zoho.salesiq = $zoho.salesiq || 
    {widgetcode:"74a26abd2f179ee9efd8b1197e292e5a95a723cab12c21d03d540347f90270198167740cc29dc87330a4487db8a55c4d", values:{},ready:function(){}};
    var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;
    s.src="https://salesiq.zoho.eu/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);d.write("<div id='zsiqwidget'></div>");
    </script>
    
	</body>

</html>