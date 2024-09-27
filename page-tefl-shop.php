<?php
/**
* Template Name: TEFL Shop
*
* @package WordPress
* @subpackage Astra
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$hero = get_field('hero');
$featured = get_field('featured');
$delivery_information = get_field('delivery_information');
$products = get_field('products');
$teaching_resources = get_field('teaching_resources');
$article = get_field('article');

get_header(); 

?>

<section class="banner-section" style="background-image: url('<?php echo $hero['image']; ?>');">

    <div class="ast-container">

		<div class="ast-row">

		    <div class="ast-col"></div>

		</div>

	</div>

</section>

<section class="header-section">
    
    <div calss="ast-container">

        <div class="ast-row">

            <div class="ast-col-lg-7">

                <h1><?php echo $hero['title']; ?></h1>
                <p><?php echo $hero['subtitle']; ?></p>

            </div>
           
        </div>

    </div>
    
</section>

<section class="filter-section">
    
    <div calss="ast-container">

        <div class="ast-row">

            <div class="ast-col-lg-12">

                <ul class="list">
				
					<li>Filter</li>
					<li><a href="#certificates">Certificates</a></li>
					<li><a href="#extensions">Extensions</a></li>
					<li><a href="#resume-service">Resume Service</a></li>
					<li><a href="#reference-letter">Reference Letter</a></li>
					<li><a href="#gift-card">Gift Card</a></li>

				</ul>

            </div>

        </div>

    </div>
    
</section>


<section class="grid-section">
    
    <div calss="ast-container">

        <div class="ast-row grid-section-row">

			<?php foreach($featured as $el):
                $title = $el['title'];
                $subtitle = $el['subtitle']; 
				$image = $el['image']; 
				$description = $el['description']; 
				$note = $el['note']; 
				$additional_information = $el['additional_information'];
				$product = $el['product']; 

				$el_id = $product->ID;
				$el_product = wc_get_product($el_id); 
				if($el_product->is_type('simple')) {
					$el_price_html = $el_product->get_price_html();
					$el_regular_price = $el_product->get_regular_price();
					$el_sale_price = $el_product->get_sale_price();
				} elseif($el_product->is_type('variable')) {
					$el_available_children = $el_product->get_children();
					$el_children_count = count($el_available_children) - 1;
					$el_product_var_id = $el_available_children[$el_children_count];
					$el_variable_product = new WC_Product_Variation( $el_product_var_id );
					$el_var_price = $el_variable_product->get_price_html();
					$el_regular_price = $el_variable_product->get_regular_price();
					$el_sale_price = $el_variable_product->get_sale_price();
				}

				$id = $product->ID;
				$product = wc_get_product($id);
				if ($product) {
					$price_html = $product->get_price_html();
				}
				
			?>
            
            <div class="ast-col-lg-6">

                <div class="product-card">
			
					<h2><?php echo $title; ?></h2>
			
					<?php if($el_product->is_type('simple')) { ?>
						<h3>From <?php echo get_woocommerce_currency_symbol().$el_regular_price ?></h3>
					<?php } elseif($el_product->is_type('variable')) { ?>
						<h3>From <?php echo get_woocommerce_currency_symbol().$el_regular_price ?></h3>
					<?php } ?>		

					<div class="image" style="background-image: url('<?php echo $image; ?>');"></div>
					<div class="product-card-description">
						<?php echo $description; ?>
						<p class="small"><?php echo $note; ?></p>
						<?php if($additional_information) { ?>
                            <div class="additional_information"><?php echo $additional_information; ?></div>
                        <?php } ?>
					</div>
		
					<?php if($product) { ?>

						<?php if ($product->is_type('variable') ) {
					
							woocommerce_variable_add_to_cart();
					
						} else { ?>

							<div class="banner-buttons-container">
								<div class="banner-buttons">
									<a href="/callback">Ask us a question <i class="fa fa-angle-right"></i></a>
									<a href="<?php echo $product->add_to_cart_url();?>">Add to Cart <i class="fa fa-angle-right"></i></a>
								</div>
							</div>

						<?php } ?>

					<?php } ?>

				</div>
				
			</div>

			<?php endforeach; ?>

        </div>

    </div>
    
</section>

<section class="delivery-section" style="display:none">
    
    <div calss="ast-container">

        <div class="ast-row">

            <div class="ast-col-lg-12">

				<h2>Delivery information</h2>

                <table class="table">
					<thead>
						<tr>
							<th scope="col">Delivery</th>
							<th scope="col">UK</th>
							<th scope="col">Europe</th>
							<th scope="col">USA</th>
							<th scope="col">Rest of the World</th>
							<th scope="col">Tracking Number?</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($delivery_information as $el):
							$delivery = $el['delivery'];
							$uk = $el['uk']; 
							$europe = $el['europe']; 
							$usa = $el['usa']; 
							$rest_of_the_world = $el['rest_of_the_world']; 
							$tracking_number = $el['tracking_number']; 
						?> 

						<tr>
							<td><?php echo $delivery; ?></td>
							<td><?php echo $uk; ?></td>
							<td><?php echo $europe; ?></td>
							<td><?php echo $usa; ?></td>
							<td><?php echo $rest_of_the_world; ?></td>
							<td><?php echo $tracking_number; ?></td>
						</tr>

						<?php endforeach; ?>

					</tbody>
				</table>

            </div>

        </div>

    </div>
    
</section>

<section class="grid-section">
    
    <div calss="ast-container">

        <div class="ast-row grid-section-row">

			<?php foreach($products as $el):
                $title = $el['title'];
				$image = $el['image']; 
				$description = $el['description']; 
				$note = $el['note']; 
				$bookmark = $el['bookmark']; 
				$sample_pdf = $el['sample_pdf'];
				$product = $el['product'];
				$not_a_product = $el['not_a_product'];

				$el_id = $product->ID;
				$el_product = wc_get_product($el_id); 
				if($el_product->is_type('simple')) {
					$el_price_html = $el_product->get_price_html();
					$el_regular_price = $el_product->get_regular_price();
					$el_sale_price = $el_product->get_sale_price();
				} elseif($el_product->is_type('variable')) {
					$el_available_children = $el_product->get_children();
					$el_children_count = count($el_available_children) - 1;
					$el_product_var_id = $el_available_children[$el_children_count];
					$el_variable_product = new WC_Product_Variation( $el_product_var_id );
					$el_var_price = $el_variable_product->get_price_html();
					$el_regular_price = $el_variable_product->get_regular_price();
					$el_sale_price = $el_variable_product->get_sale_price();
				}

				$id = $product->ID;
				$product = wc_get_product($id);
				if ($product) {
					$price_html = $product->get_price_html();
				}
			
			?> 
            
            <div class="ast-col-lg-6">

                <div class="product-card" id="<?php echo $bookmark; ?>">
				
					<h2><?php echo $title; ?></h2>
                	
					<?php if($el_product->is_type('simple')) { ?>
						<h3>From <?php echo get_woocommerce_currency_symbol().$el_regular_price ?></h3>
					<?php } elseif($el_product->is_type('variable')) { ?>
						<h3>From <?php echo get_woocommerce_currency_symbol().$el_regular_price ?></h3>
					<?php } ?>

					<div class="image" style="background-image: url('<?php echo $image; ?>');"></div>
					<div class="product-card-description"><?php echo $description; ?><?php if($note) { ?><p class="small"><?php echo $note; ?></p><?php } ?></div>

                    <?php if(!$not_a_product) { ?>

    					<?php if($product) { ?>
    					
    						<?php if ($product->product_type == 'variable') {
								if($bookmark==='extensions'){?>
								<div class="banner-buttons-container">
    								<div class="banner-buttons course-extension-button">
    									<a href="/course-extensions">purchase study extension <i class="fa fa-angle-right"></i></a>
    								</div>
    							</div>
								<?php
								}
								else{
    							woocommerce_variable_add_to_cart();
								}
    					
    						} else { ?>
    
    							<div class="banner-buttons-container">
    								<div class="banner-buttons">
    									<a href="/callback">Ask us a question <i class="fa fa-angle-right"></i></a>
    									<a href="<?php echo $product->add_to_cart_url(); ?>">Add to Cart <i class="fa fa-angle-right"></i></a>
    								</div>
    							</div>
    
    						<?php } ?>
    
    					<?php } ?>

                    <?php } else { ?>
                    
                        <div class="banner-buttons-container">
                    		<div class="banner-buttons">
                    			<a href="/callback">Ask us a question <i class="fa fa-angle-right"></i></a>
                    		    <a href="<?php echo $product->add_to_cart_url(); ?>">Choose your Voucher <i class="fa fa-angle-right"></i></a>
                    		</div>
                    	</div>
                    	
                    <?php } ?>

				</div>

            </div>

			<?php endforeach; ?>

        </div>

    </div>
    
</section>

<section class="resources-section">
    
    <div calss="ast-container">

		<h3>Teaching Resources</h3>

        <div class="ast-row resources-section-row">

			<?php foreach($teaching_resources as $el):
                $title = $el['title'];
				$image = $el['image']; 
				$description = $el['description']; 
				$note = $el['note']; 
				$bookmark = $el['bookmark']; 
				$sample_pdf = $el['sample_pdf'];
				$product = $el['product']; 

				$el_id = $product->ID;
				$el_product = wc_get_product($el_id); 
				if($el_product->is_type('simple')) {
					$el_price_html = $el_product->get_price_html();
					$el_regular_price = $el_product->get_regular_price();
					$el_sale_price = $el_product->get_sale_price();
				} elseif($el_product->is_type('variable')) {
					$el_available_children = $el_product->get_children();
					$el_children_count = count($el_available_children) - 1;
					$el_product_var_id = $el_available_children[$el_children_count];
					$el_variable_product = new WC_Product_Variation( $el_product_var_id );
					$el_var_price = $el_variable_product->get_price_html();
					$el_regular_price = $el_variable_product->get_regular_price();
					$el_sale_price = $el_variable_product->get_sale_price();
				}

				$id = $product->ID;
				$product = wc_get_product($id);
				if ($product) {
					$price_html = $product->get_price_html();
				}
			
			?> 
            
            <div class="ast-col-lg-6">

                <div class="product-card" id="<?php echo $bookmark; ?>">
				
					<h2><?php echo $title; ?></h2>
                	
					<?php if($el_product->is_type('simple')) { ?>
						<h3>From <?php echo get_woocommerce_currency_symbol().$el_sale_price ?></h3>
					<?php } elseif($el_product->is_type('variable')) { ?>
						<h3>From <?php echo get_woocommerce_currency_symbol().$el_sale_price ?></h3>
					<?php } ?>

					<div class="image" style="background-image: url('<?php echo $image ?>');"><?php if($sample_pdf) { ?><a href="<?php echo $sample_pdf ?>" data-lity></a><?php } ?></div>
					<!-- <div class="image" style="background: url('<?php echo $image; ?>');"></div> -->
					<div class="product-card-description"><?php echo $description; ?><?php if($note) { ?><p class="small"><?php echo $note; ?></p><?php } ?></div>

					<?php if($product) { ?>
					
						<?php if ($product->product_type == 'variable') {
					
							woocommerce_variable_add_to_cart();
					
						} else { ?>

							<div class="banner-buttons-container">
								<div class="banner-buttons">
									<a href="/callback">Ask us a question <i class="fa fa-angle-right"></i></a>
									<a href="<?php echo $product->add_to_cart_url();?>">Add to Cart <i class="fa fa-angle-right"></i></a>
								</div>
							</div>

						<?php } ?>

					<?php } ?>

				</div>

            </div>

			<?php endforeach; ?>

        </div>

    </div>
    
</section>

<section class="blog-section">

    <div class="ast-container">

		<div class="ast-row">

		    <div class="ast-col-md-12">

		        <div class="article-container" style="background-image: url('<?php echo $article['image']; ?>')">

		            <div class="article-container-content">

		                <h3><?php echo $article['title']; ?></h3>
		                <p><?php echo $article['description']; ?></p>
		                <a class="blog-link" href="<?php echo $article['link']; ?>">Read the Blog <i class="fa fa-angle-right"></i></a>

		            </div>

		        </div>

		    </div>

		</div>

	</div>

</section>
<!-- <script>
	jQuery('document').ready(function($) {
		$('.product-card h2').equalizeHeights();
		$('.product-card h3').equalizeHeights();
	}
	);
</script> -->
<?php get_footer(); ?>