<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<?php wc_print_notices(); ?>

<section class="guides-section" style="display:block;">

    <div class="ast-container">

		<div class="ast-row">

		    <div class="ast-col-lg-12">

		        <h2>Save 59% on our Guides</h2>
		        <p>Informative guides available to the TEFL Institute alumni and the public created by EFL/ESL professionals to help teachers become the best version of themselves and to progress in CPD. </p>

			</div>

		</div>

		<div class="ast-row product-row">

			<?php $guides = get_field('guides', 'option'); ?>
			<?php foreach ($guides as $element) : ?>
				<?php 
				$thumbnail = $element['thumbnail']; 
				$sample_pdf = $element['sample_pdf']; 
				$product = $element['product']; 
				
				$el_id = $product->ID;
				$el_product = wc_get_product($el_id); 
				$el_product_title = $el_product->get_title();
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

				
				?>

				<div class="team-col ast-col-lg-4 ast-col-md-4 ast-col-sm-12">
					<div class="guide">
						<div class="guide-image">
						    <a href="<?php echo $sample_pdf ?>" data-lity class="look" data-lity>Look Inside<img src="/wp-content/uploads/2021/12/Artboard-2.png"></a>
						    <a href="<?php echo $sample_pdf ?>" data-lity><img src="<?php echo $thumbnail ?>"></a>
						</div>
						<div class="guide-content">
							<h5 class="guide-name"><?php echo $el_product_title ?></h5>
							<div class="guide-buy-container">
								<div class="guide-price">
									<?php echo $el_price_html; ?>
									<!-- <?php //echo get_woocommerce_currency_symbol().$el_sale_price ?> <span class="guide-regular-price"><?php //echo get_woocommerce_currency_symbol().$el_regular_price ?></span> -->
								</div>
								<div class="guide-link">
									<a href="<?php echo $el_product->add_to_cart_url();?>">Add to Cart <i class="fa fa-angle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

        </div>

	</div>

</section>

<div class="ast-row">
	<div class="tefl-cart-outer ast-col ast-col-md-12">
		<form class="woocommerce-cart-form tefl-custom" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>
	
			<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				<tbody class="cart-body">
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>
	
					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
						
						$is_deposit = $cart_item['is_deposit'];
						$product_upsell_addons = get_field('product_upsell_addons', $product_id);
	
						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<tr class="<?php echo $is_deposit?> woocommerce-cart-form-row woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
								<td class="woocommerce-cart-form-col">
									<div class="product-thumbnail">
										<?php $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
	
										if ( ! $product_permalink ) {
											echo $thumbnail; // PHPCS: XSS ok.
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
										} ?>
									</div>
	
									<div class="product-details-with-addons">
										<div class="product-details">
											<div class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
												<?php if ( ! $product_permalink ) {
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
												} else {
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
												}
	
												do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
	
												// Meta data.
												if ( has_term( 'extension', 'product_cat', $product_id ) ){
													echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
												}
												
												echo display_split_payment_breakdown_html($cart_item);
												// Backorder notification.
												if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
												}
												?>
											</div>
	
											<div class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
												<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
											</div>
	
											<div class="product-remove">
												<?php
													echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
														'woocommerce_cart_item_remove_link',
														sprintf(
															'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
															esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
															esc_html__( 'Remove this item', 'woocommerce' ),
															esc_attr( $product_id ),
															esc_attr( $_product->get_sku() )
														),
														$cart_item_key
													);
												?>
											</div>
										</div>

										<?php if($product_upsell_addons) : ?>
									
											<div class="cart-item-addons">
												<?php foreach($product_upsell_addons as $pua ) :
													$product_id = $pua['product'];
													$product = new WC_Product($product_id); 
													$product_link = get_post_permalink($product_id);
													$product_img = get_the_post_thumbnail_url($product_id, 'full');
													$pt_show_product_page = get_field('pt_show_product_page', $product_id);
													$price_html = $product->get_price_html();
													$image = $pua['image'] ?? ""; 
													$heading = $pua['heading'] ?? ""; 
													$description = $pua['description'] ?? ""; 
													if (WC()->cart) :
														$product_cart_id = WC()->cart->generate_cart_id( $product_id );
														$in_cart = WC()->cart->find_product_in_cart( $product_cart_id );
														if ( !$in_cart ) : ?>
															<div class="cart-item-addon-outer">
																<div class="cart-item-addon">
																	<?php if($product_img) { ?>
																		<div class="addon-img"><i class="fa fa-plus-circle"></i><img src="<?php echo $product_img; ?>"></div>
																	<?php } ?>
																	<div class="addon-content">
																		<h4 class=""><?php echo $heading.' for '.$price_html; ?></h4>
																		<div class="desc"><?php echo $description; ?></div>
																	</div>
																	<?php if ($pt_show_product_page) { ?>
																	<a href="<?php echo $product_link; ?>" class="learn-more-btn">Learn More</a>
																	<?php } ?>
																</div>
																<div class="add-addon-div"><a href="<?php echo $product->add_to_cart_url() ?>" value="<?php echo esc_attr( $product->get_id() ); ?>" class="add-addon-btn button ajax_add_to_cart add_to_cart_button" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" aria-label="Add '<?php echo $heading; ?>' to your cart">Add</a></div>
																<!-- <div class="add-addon-div"><a href="/?add-to-cart=<?php //echo $product_id; ?>" class="add-addon-btn button product_type_simple add_to_cart_button ajax_add_to_cart">Add</a></div> -->
															</div>
														<?php endif; ?>
													<?php endif; ?>
												<?php endforeach; ?>
											</div>
	
										<?php endif; ?>
	
									</div>
								</td>
	
							</tr>
	
							<?php
						}
					}
					?>
	
					<?php do_action( 'woocommerce_cart_contents' ); ?>
	
			
	
					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</tbody>
			</table>
	
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>
		
		<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
	
		<div class="cart-collaterals">
			<?php
				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action( 'woocommerce_cart_collaterals' );
			?>
		</div>
		
	</div>
</div>



<?php do_action( 'woocommerce_after_cart' ); ?>
