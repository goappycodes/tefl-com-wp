<?php
/**
 * Gift Cards
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/html-gift-card-container.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce Gift Cards
 * @version 1.3.2
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><div id="giftcard__container">
	<div id="giftcard__body" style="color: #222;">
		<?php echo wp_kses_post( wpautop( wptexturize( apply_filters( 'woocommerce_email_intro_content', $intro_content, $giftcard ) ) ) ); ?>
		<?php //if (wc_price($giftcard->get_balance()) === wc_price(100) || wc_price($giftcard->get_balance()) === wc_price(200) || wc_price($giftcard->get_balance()) === wc_price(300)) : ?>
			<div style="color: #222;">
			You have been treated with the gift of TEFL which helps you to have endless opportunities, such as:<br><br>
			✓ New beginnings,<br>
			✓ Opportunity to travel,<br>
			✓ Upskilling,<br>
			✓ Teaching English online or abroad,<br>
			✓ Working on their own schedule.
			</div>
		<?php //endif; ?>
	</div>
	<?php if ( $giftcard->get_message() ) : ?>
		<div id="giftcard__message">
			<?php echo nl2br( esc_html( $giftcard->get_message() ) ); ?>
		</div>
	<?php endif; ?>
	<div id="giftcard__card">

		<?php if ( $include_header ) : ?>
			<?php //if ( 'background' === $render_image ) : ?>
			<!-- <div id="giftcard__card-header" style="height: 350px;background-image: url( <?php echo esc_attr( $image_src ); ?> );background-position: <?php echo esc_attr( $position_X ); ?> <?php echo esc_attr( $position_Y ); ?>;"></div> -->
			<?php //elseif ( 'element' === $render_image ) : ?>
				<!-- <img id="giftcard__card-image" src="<?php echo esc_attr( $image_src ); ?>" width="100%" height="auto" /> -->
			<?php //endif; ?>
			<img id="giftcard__card-image" src="<?php echo esc_attr( $image_src ); ?>" width="100%" height="auto" />
		<?php endif; ?>

		<div id="giftcard__card-amount-container">
			<div><?php echo esc_html_x( 'Amount', 'Email gift card received', 'woocommerce-gift-cards' ); ?>:</div>
			<div id="giftcard__card-amount"><?php echo wc_price( $giftcard->get_balance() ); ?></div>
		</div>
		
		<?php if ( $show_redeem_button ): ?>
			<a href="<?php echo esc_attr( add_query_arg( array( 'do_email_redeem' => urlencode( $giftcard->get_hash() ) ), wc_get_account_endpoint_url( 'giftcards' ) ) ); ?>" id="giftcard__action-button" class="redeem-action"><?php echo apply_filters( 'woocommerce_gc_email_received_redeem_button_text', esc_html_x( 'Add to your Account', 'Email gift card received', 'woocommerce-gift-cards' ), $giftcard ); ?></a>

			<div id="giftcard__separator">&mdash; <?php echo esc_html_x( 'or', 'Email gift card received', 'woocommerce-gift-cards' ); ?> &mdash;</div>

			<div id="giftcard__card-code-container">
				<div><?php echo esc_html_x( 'Use this gift voucher at the checkout', 'Email gift card received', 'woocommerce-gift-cards' ); ?>:</div>
				<div id="giftcard__card-code"><?php echo esc_html( $giftcard->get_code() ); ?></div>
			</div>

		<?php else: ?>
			<a href="<?php echo esc_attr( add_query_arg( array( 'do_email_session' => urlencode( $giftcard->get_hash() ) ), apply_filters( 'woocommerce_gc_email_received_action_button_url', site_url(), $giftcard ) ) ); ?>" id="giftcard__action-button" class="shop-action"><?php echo apply_filters( 'woocommerce_gc_email_received_action_button_text', esc_html_x( 'Shop Now', 'Email gift card received', 'woocommerce-gift-cards' ), $giftcard ); ?></a>
			
			<div id="giftcard__card-code-container">
				<div><?php echo esc_html_x( 'Use this gift voucher at the checkout', 'Email gift card received', 'woocommerce-gift-cards' ); ?>:</div>
				<div id="giftcard__card-code"><?php echo esc_html( $giftcard->get_code() ); ?></div>
			</div>

		<?php endif; ?>

		<?php if ( $giftcard->get_expire_date() > 0 ) : ?>
			<div id="giftcard__expiration"><?php /* translators: %s: Gift card expiration date */ echo sprintf( esc_html_x( 'Expires on %s', 'Email gift card received', 'woocommerce-gift-cards' ), esc_html( date_i18n( get_option( 'date_format' ), $giftcard->get_expire_date() ) ) ); ?></div>
		<?php endif; ?>

	</div>

	<?php //if (wc_price($giftcard->get_balance()) === wc_price(100) || wc_price($giftcard->get_balance()) === wc_price(200) || wc_price($giftcard->get_balance()) === wc_price(300)) : ?>
		<div id="giftcard__card-code-container" style="margin-top:20px;text-align: left;color: #222;">
			<div>
				The opportunities with TEFL are endless.  All you need to do now is choose what you would like to spend the Gift Card on!  You can choose from an array of our specialist, accredited & Government Regulated Level 5 TEFL courses, ranging from 30 hours to 300 hour and you will gain your qualification for life!  Remember you can also put this amazing gift towards an adventure of a lifetime by signing up to a job placement which includes a TEFL qualification!  
			</div>
			<div style="text-align:center;">	
				<a href="https://teflinstitute.com/tefl-courses/" id="giftcard__action-button" style="font-weight:normal;text-decoration:none;display:inline-block;background:#000;color:#ffffff;padding:8px 15px;margin-top:20px;margin-right:10px;" target="_blank">VIEW ALL TEFL COURSES</a>
				<a href="https://teflinstitute.com/tefl-jobs/" id="giftcard__action-button" style="font-weight:normal;text-decoration:none;display:inline-block;background:#000;color:#ffffff;padding:8px 15px;margin-top:20px;margin-left:10px;" target="_blank">VIEW JOB PLACEMENTS</a>		
			</div>
		</div>
	<?php //endif; ?>

	<style>
		#giftcard__card{
			padding:0 !important;
		}
		.im {
			color: #333;
		}
	</style>
</div>
