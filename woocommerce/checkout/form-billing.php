<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>

<?php
// Get ACF resources
$teaching_resources = get_field('teaching_resources', 'option');

// Initialize as empty array if ACF returns nothing
if (!is_array($teaching_resources)) {
    $teaching_resources = [];
}

$hardcoded_resources = [
      [
         'product' => 1106, 
         'product_name' => '30 Hour IELTS Preparation Specialist Course',
         'resources_description' => '<p>The IELTS exam is a global standard for assessing English proficiency, with millions of students taking it each year. By becoming an IELTS specialist, you’ll:</p>
        <ul>
        <li>Access highly motivated students who are determined to succeed in their academic or professional journeys.</li>
        <li>Boost your earning potential as IELTS teachers are often paid more, especially across Asia.</li>
        <li>Expand your TEFL career opportunities, with flexibility to teach online or abroad.</li>
        <li>Gain in-demand skills that set you apart from other TEFL teachers and make you a specialist in the field.</li>
        </ul>',
         'cart_page_info' => [
            'icon' => '/wp-content/uploads/2025/04/IELTS-Educator-logo.png', 
            'title' => '30 Hour IELTS Preparation Specialist Course',
            'description' => 'The 30-Hour IELTS Preparation Specialist Course is your key to becoming a highly skilled and sought-after IELTS teacher.'
         ],
         'resource_page_link' => '/course/ielts-exam-preparation-instructor/'
      ],
      [
         'product' => 1103,
         'product_name' => '30 Hour Teaching English Online Specialist Course',
         'resources_description' => '<p>The IELTS exam is a global standard for assessing English proficiency, with millions of students taking it each year. By becoming an IELTS specialist, you’ll:</p>
                <ul>
                <li>Great starting point</li>
                <li>Top-up for TEFL graduates</li>
                <li>No experience necessary</li>
                </ul>',
         'cart_page_info' => [
            'icon' => '/wp-content/uploads/2020/12/30-Teaching-English-to-Young-Learners.svg', 
            'title' => '30 Hour Teaching English Online Specialist Course',
            'description' => 'If you’re looking for a flexible, rewarding way to earn money from anywhere, our 30 Hour Teaching English Online Course is the perfect opportunity to get started.'
         ],
         'resource_page_link' => '/course/learn-how-to-teach-english-online/'
      ]
   ];

$all_resources = array_merge($teaching_resources, $hardcoded_resources);

if (is_array_empty($all_resources)) {
    return;
}

?>
<div class="resources-carousel-wrapper">
    <a href="#" class="carousel-btn carousel-prev" aria-label="Previous resource">
    <i class="fa fa-angle-left"></i>
    </a>
    
    <div class="carousel-track">
        <?php
        foreach ($all_resources as $index => $resource) {
        $product_id = $resource['product'];
        $product_name = $resource['product_name'];
        $product_desc = $resource['resources_description'];
        $cart_page_info = $resource['cart_page_info'];
        $resource_page_link = $resource['resource_page_link'];

        if (is_array_empty($cart_page_info)) {
            continue;
        }

        $icon = $cart_page_info['icon'];
        $title = $cart_page_info['title'];
        $desc = $cart_page_info['description'];

        $product_obj = wc_get_product($product_id);
        if (!$product_obj) {
            continue;
        }
        
        $product_price = $product_obj->get_price_html();

        $product_in_cart = false;
        foreach (WC()->cart->get_cart() as $cart_item) {
            if ($cart_item['product_id'] == $product_id) {
                $product_in_cart = true;
                break;
            }
        }

        if (!$product_in_cart) {
            ?>
            <div class="resource-container <?php echo str_replace(' ', '_', esc_html($product_name)); ?>">
                <?php
                    if($product_id===87270):
                ?>
                <div class="rescource-label">
                    <span>Frequently Bought Together</span>
                    🔥
                </div>
                <?php
                    endif;
                ?>
                <div class="resource-container__top">
                    <div class="resource-icon">
                    <img src="<?php echo esc_url($icon); ?>" alt="">
                    </div>
                    <div class="resource-description">
                    <div class="resource-description-header">
                        <h3><?php echo $title; ?></h3>
                        <i class="fa d-none fa-info" data-target="info-<?php echo $index; ?>"></i>
                        <div id="info-<?php echo $index; ?>" class="resource-info-container">
                            <h6><?php echo esc_html($product_name); ?></h6>
                            <div class="resource-info">
                                <?php echo wp_kses_post($product_desc); ?>
                            </div>
                            <a href="<?php echo $resource_page_link ?>" target="_blank" class="btn btn-red btn-centered">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <span><?php echo esc_html($desc); ?></span>
                    </div>
                </div>
                <div class="resource-container__bottom">
                    <div class="resource-price">
                    <?php echo $product_price; ?>
                    </div>
                    <div class="resource-add-to-cart">
                    <a href="<?php echo esc_url($product_obj->add_to_cart_url()); ?>" value="<?php echo esc_attr($product_obj->get_id()); ?>" class="add-resource-btn button add_to_cart_button" data-product_id="<?php echo esc_attr($product_obj->get_id()); ?>" data-product_sku="<?php echo esc_attr($product_obj->get_sku()); ?>" aria-label="Add '<?php echo esc_attr($product_name); ?>' to your cart">
                        Add To Cart 
                        <i class="fa fa-angle-right"></i>
                    </a>
                    </div>
                </div>
            </div>
            <?php
        }
        }
        ?>
    </div>

    <a href="#" class="carousel-btn carousel-next" aria-label="Next resource">
    <i class="fa fa-angle-right"></i>
    </a>
</div>

<div class="woocommerce-billing-fields">
	<?php
	$cart_items = WC()->cart->get_cart();
	$first_item_name = '';
	
	if ( ! empty( $cart_items ) ) {
		$first_item = reset( $cart_items );
		$first_item_name = $first_item['data']->get_name();
	}
	
	if ( ! empty( $first_item_name ) ) {
		echo '<p class="first-cart-item-name">' . esc_html( $first_item_name ) . '</p>';
	}
	?>
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3><?php esc_html_e( 'Student\'s Details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) {
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
