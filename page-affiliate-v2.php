<?php
/*
Template Name: Become an Affiliate v2
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$current_page_id = get_the_ID();

// Same ACF fields as page-affiliate.php, so the copy is edited in the same place.
$heading       = get_field( 'heading' );
$faqs          = get_field( 'affiliate_marketer' ) ?: array();
$why_choose_us = get_field( 'why_choose_us' ) ?: array();

$img = get_stylesheet_directory_uri() . '/assets/img/affiliate/';

$steps = array(
	array( 'Sign up free', 'Complete the form below. Your account and Affiliate Area are ready straight away.' ),
	array( 'Share your link or code', 'Use your affiliate link, coupon code and our ready-made banners on your website, social media or emails.' ),
	array( 'Get paid', 'Earn 11% on every course sale, paid by PayPal on or after the 15th of the following month.' ),
);

$facts = array(
	array( '11%', 'commission on every sale' ),
	array( '90 days', 'cookie tracking' ),
	array( '15th', 'of every month, paid by PayPal' ),
	array( '100+', 'banners and text links ready to use' ),
);
?>

<div class="tiav2">

	<section class="tiav2-hero">
		<div class="tiav2-wrap tiav2-hero__inner">
			<div class="tiav2-hero__text">
				<p class="tiav2-eyebrow">The TEFL Institute affiliate programme</p>
				<h1 class="tiav2-hero__title"><?php echo esc_html( $heading ?: 'Earn 11% commission as a TEFL Institute affiliate' ); ?></h1>
				<p class="tiav2-hero__lead">Share our internationally recognised TEFL courses with your audience and earn 11% on every sale. Free to join, with commission paid monthly by PayPal.</p>
				<div class="tiav2-hero__actions">
					<a class="tiav2-btn tiav2-btn--accent" href="#join">Join the programme</a>
					<a class="tiav2-btn tiav2-btn--ghost" href="/affiliate-area/">Affiliate login</a>
				</div>
				<ul class="tiav2-hero__points">
					<li>11% commission</li>
					<li>90-day cookie</li>
					<li>PayPal payouts on the 15th</li>
				</ul>
			</div>
			<div class="tiav2-hero__media">
				<img src="<?php echo esc_url( $img . 'affiliate-hero.png' ); ?>" width="800" height="503" alt="Smiling woman on a phone call holding a tablet" fetchpriority="high">
			</div>
		</div>
	</section>

	<section class="tiav2-facts" aria-label="Programme at a glance">
		<div class="tiav2-wrap tiav2-facts__grid">
			<?php foreach ( $facts as $fact ) : ?>
				<div class="tiav2-fact">
					<span class="tiav2-fact__value"><?php echo esc_html( $fact[0] ); ?></span>
					<span class="tiav2-fact__label"><?php echo esc_html( $fact[1] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="tiav2-section">
		<div class="tiav2-wrap">
			<h2 class="tiav2-h2">How it works</h2>
			<ol class="tiav2-steps">
				<?php foreach ( $steps as $i => $step ) : ?>
					<li class="tiav2-step">
						<span class="tiav2-step__num"><?php echo (int) $i + 1; ?></span>
						<h3 class="tiav2-step__title"><?php echo esc_html( $step[0] ); ?></h3>
						<p><?php echo esc_html( $step[1] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<?php if ( $why_choose_us ) : ?>
		<section class="tiav2-section tiav2-section--tint">
			<div class="tiav2-wrap">
				<h2 class="tiav2-h2">Why choose us</h2>
				<div class="tiav2-why">
					<?php foreach ( $why_choose_us as $element ) : ?>
						<div class="tiav2-why__card">
							<span class="tiav2-why__pre"><?php echo wp_kses_post( $element['paragraph'] ); ?></span>
							<span class="tiav2-why__title"><?php echo wp_kses_post( $element['title'] ); ?></span>
							<span class="tiav2-why__sub"><?php echo wp_kses_post( $element['subtitle'] ); ?></span>
							<span class="tiav2-why__small"><?php echo wp_kses_post( $element['small'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="tiav2-section">
		<div class="tiav2-wrap tiav2-faq">
			<div class="tiav2-faq__media">
				<h2 class="tiav2-h2">Become an affiliate for one of the fastest growing ESL companies</h2>
				<div class="tiav2-video">
					<iframe src="https://www.youtube-nocookie.com/embed/7j6B4xyoy2A" title="The TEFL Institute affiliate programme" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
			</div>
			<div class="tiav2-faq__list">
				<h2 class="tiav2-h2 tiav2-h2--small">Questions and answers</h2>
				<?php foreach ( $faqs as $i => $element ) : ?>
					<details class="tiav2-qa"<?php echo 0 === $i ? ' open' : ''; ?>>
						<summary><?php echo wp_kses_post( $element['question'] ); ?></summary>
						<div class="tiav2-qa__answer"><?php echo wp_kses_post( $element['answer'] ); ?></div>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="tiav2-section tiav2-section--tint" id="join">
		<div class="tiav2-wrap tiav2-join">
			<div class="tiav2-join__aside">
				<h2 class="tiav2-h2">Join the affiliate programme</h2>
				<p>Become an affiliate today! Earn 11% each time you refer someone to The TEFL Institute.</p>
				<ul class="tiav2-checklist">
					<li>Free to join, no minimum sales</li>
					<li>Your own affiliate link and coupon code</li>
					<li>Banners and text links for every offer</li>
					<li>Commission paid monthly by PayPal</li>
				</ul>
				<div class="tiav2-team">
					<img src="<?php echo esc_url( $img . 'lauren-affiliate-team.jpg' ); ?>" alt="Lauren, TEFL Institute affiliate, earns €600 a month" loading="lazy">
					<img src="<?php echo esc_url( $img . 'david-affiliate-team.jpg' ); ?>" alt="David, TEFL Institute affiliate, earns €400 a month" loading="lazy">
				</div>
				<p class="tiav2-join__contact">Questions? Email <a href="mailto:marketing@teflinstitute.com">marketing@teflinstitute.com</a></p>
			</div>
			<div class="tiav2-join__form">
				<p class="tiav2-login-note">Already an affiliate? <a href="/affiliate-area/">Log in to your Affiliate Area</a></p>
				<?php
				// The form is the Affiliate Registration block in the page editor; the old shortcode form is the fallback.
				if ( has_block( 'affiliatewp/registration', $current_page_id ) ) {
					echo apply_filters( 'the_content', get_post_field( 'post_content', $current_page_id ) );
				} else {
					echo do_shortcode( '[affiliate_registration]' );
				}
				?>
			</div>
		</div>
	</section>

	<section class="tiav2-cta">
		<div class="tiav2-wrap tiav2-cta__inner">
			<div>
				<h2 class="tiav2-h2">Ready to get started?</h2>
				<p>Book an online meeting with us and we'll walk you through the programme.</p>
			</div>
			<a class="tiav2-btn tiav2-btn--accent" href="/callback/">Choose a time and day</a>
		</div>
	</section>

</div>

<?php
get_footer();
