<?php global $affwp_creative_atts;?>
<?php
$affcreative_id = str_replace(" ", "", esc_attr( $affwp_creative_atts['id_class'] ) );
$creative_share_text = $affwp_creative_atts['text'] ? $affwp_creative_atts['text'] : "TEFL Courses by the TEFL Institute";
$creative_share_text = $affwp_creative_atts['description'] ? $affwp_creative_atts['description'] : $creative_share_text;
?>
<div class="affwp-creative<?php echo esc_attr( $affwp_creative_atts['id_class'] ); ?>">

	<?php if ( ! empty( $affwp_creative_atts['desc'] ) ) : ?>
		<p class="affwp-creative-desc"><?php echo $affwp_creative_atts['desc']; ?></p>
	<?php endif; ?>

	<?php if ( $affwp_creative_atts['preview'] != 'no' ) : ?>

		<?php
		// Image preview - using ID of image from media library
		if ( $affwp_creative_atts['image_attributes'] ) : ?>
		<p>
			<a href="<?php echo esc_url( affwp_get_affiliate_referral_url( array( 'base_url' => $affwp_creative_atts['url'] ) ) ); ?>" title="<?php echo esc_attr( $affwp_creative_atts['text'] ); ?>">
				<img src="<?php echo esc_attr( $affwp_creative_atts['image_attributes'][0] ); ?>" width="<?php echo esc_attr( $affwp_creative_atts['image_attributes'][1] ); ?>" height="<?php echo esc_attr( $image_attributes[2] ); ?>" alt="<?php echo esc_attr( $text ); ?>">
			</a>
		</p>

		<?php
		// Image preview - External image URL or picked from media library
		elseif ( $affwp_creative_atts['image_link'] ) :
			$image = $affwp_creative_atts['image_link'];
		?>
			<p>
				<a href="<?php echo esc_url( affwp_get_affiliate_referral_url( array( 'base_url' => $affwp_creative_atts['url'] ) ) ); ?>" title="<?php echo esc_attr( $affwp_creative_atts['text'] ); ?>">
					<img src="<?php echo esc_attr( $affwp_creative_atts['image_link'] ); ?>" alt="<?php echo esc_attr( $affwp_creative_atts['text'] ); ?>">
				</a>
			</p>

		<?php else : // text link preview ?>
			<p>
				<a href="<?php echo esc_url( affwp_get_affiliate_referral_url( array( 'base_url' => $affwp_creative_atts['url'] ) ) ); ?>" title="<?php echo esc_attr( $affwp_creative_atts['text'] ); ?>"><?php echo esc_attr( $affwp_creative_atts['text'] ); ?></a>
			</p>
		<?php endif; ?>

	<?php endif; ?>

	<?php
		/**
		 * Filters the text of the current Creative.
		 *
		 * @since 1.0
		 *
		 * @param string $text Text of the creative.
		 */

		// Image - media library
		if ( $affwp_creative_atts['image_attributes'] ) {
			$image_or_text = '<img src="' . esc_attr( $affwp_creative_atts['image_attributes'][0] ) . '" alt="' . esc_attr( $affwp_creative_atts['text'] ) .'" />';
		}
		// Image - External URL
		elseif ( $affwp_creative_atts['image_link'] ) {
			$image_or_text = '<img src="' . esc_attr( $affwp_creative_atts['image_link'] ) . '" alt="' . esc_attr( $affwp_creative_atts['text'] ) .'" />';
		}
		// Show site name when no image
		else {
			$image_or_text = esc_attr( $affwp_creative_atts['text'] );
		}
	?>

	<em>Share on social media</em>
	<div id="affshare-<?php echo $affcreative_id; ?>"></div>
    <script>
        $("#affshare-<?php echo $affcreative_id; ?>").jsSocials({
            shares: ["email", "twitter", "facebook", "linkedin", "pinterest", "whatsapp"],
			url: "<?php echo esc_url( affwp_get_affiliate_referral_url( array( 'base_url' => $affwp_creative_atts['url'] ) ) ); ?>",
			text: "<?php echo $creative_share_text ; ?>",
			showLabel: false,
			showCount: false
        });
    </script>
	<br/>
	<?php
		echo apply_filters( 'affwp_affiliate_creative_text', '<em>' . __( 'or copy and paste the following HTML snippet and paste it anywhere on your website or within your blog post!', 'affiliate-wp' ) . '</em>' );
	?>
	<?php
		$creative = '<a href="' . esc_url( affwp_get_affiliate_referral_url( array( 'base_url' => $affwp_creative_atts['url'] ) ) ) .'" title="' . esc_attr( $affwp_creative_atts['text'] ) . '">' . $image_or_text . '</a>';
		echo '<pre><code id="'.$affcreative_id.'" onclick="copyDivToClipboard(\''.$affcreative_id.'\')">' . esc_html( $creative ) . '</code></pre>';
	?>

</div>
