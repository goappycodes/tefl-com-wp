<?php
/**
 * Template Name: TEFL for Schools v3
 *
 * Overview page for TEFL for Schools (design v3). Content comes from the
 * "TEFL for Schools landing" ACF fields; functions live in
 * includes/tefl-for-schools-v3.php.
 *
 * Section order: Hero (with social proof carousel), Testimonial carousel,
 * Outcomes (with the course in numbers), Cost, Why, Modules, Staff or
 * student, How it works + quote, Planner, Period Six, Routes, Taster, FAQ,
 * US schools, Note from Chloe, Guides.
 *
 * Image spaces: every optional image (the carousel and the section images)
 * shows a dashed placeholder to logged-in editors only while it is empty.
 * Visitors never see an empty box.
 *
 * @package WordPress
 * @subpackage Astra
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$pid      = get_queried_object_id();
$can_edit = current_user_can( 'edit_post', $pid );
$variant  = 'image' === tfs2_get( 'hero_variant' ) ? 'image' : 'form';
$chloe    = tfs2_img( tfs2_get( 'chloe_photo' ), get_stylesheet_directory_uri() . '/assets/images/tfs-chloe.jpg', 'medium_large' );
$name     = tfs2_get( 'chloe_name' );
$role     = tfs2_get( 'chloe_role' );
$email    = tfs2_get( 'chloe_email' );
$phone    = tfs2_get( 'chloe_phone' );
$tiers    = tfs2_tiers();
$n0       = 30;
$p0       = tfs2_price_for( $n0 );
$base     = $tiers ? $tiers[0]['price'] : 0;
$tier_ix  = 0;
foreach ( $tiers as $i => $t ) {
	if ( $n0 >= $t['min'] && $n0 <= $t['max'] ) {
		$tier_ix = $i;
	}
}
$ordinals = array( 'one', 'two', 'three', 'four', 'five', 'six' );
$steps    = tfs2_rows( 'steps' );
$modules  = tfs2_rows( 'modules' );
$faqs     = tfs2_rows( 'faqs' );
$quotes   = tfs2_rows( 'quotes' );
$guides   = tfs2_rows( 'guides' );
$popts    = tfs2_planner_options();
$to_form  = 'form' === $variant ? '#letsTalkTEFL' : '#quote'; // every "Request a quote" goes to the hero form
$proof    = array_values( array_filter( tfs2_rows( 'proof_slides' ), function ( $s ) {
	return ! empty( $s['image'] );
} ) );
?>
<div id="tfs2" class="tfs2" data-page="<?php echo (int) $pid; ?>">

<!-- ================= SUB NAVIGATION ================= -->
<nav class="tfs2-subnav" aria-label="TEFL for Schools">
	<div class="tfs2-subnav__in">
		<a class="tfs2-subnav__tab is-current" href="<?php echo esc_url( get_permalink() ); ?>" aria-current="page">Overview</a>
		<a class="tfs2-subnav__tab" href="<?php echo esc_url( tfs2_url( tfs2_get( 'staff_url' ) ) ); ?>">For staff</a>
		<a class="tfs2-subnav__tab" href="<?php echo esc_url( tfs2_url( tfs2_get( 'students_url' ) ) ); ?>">For students</a>
		<div class="tfs2-jump">
			<button type="button" class="tfs2-jump__btn" aria-expanded="false" aria-controls="tfs2-jump-menu">Jump to <?php echo tfs2_icon( 'chevron-down', 16 ); ?></button>
			<div class="tfs2-jump__menu" id="tfs2-jump-menu" hidden>
				<?php
				// Listed in page order.
				$jumps = array(
					'outcomes' => 'What students finish with',
					'cost'     => 'What it costs per student',
					'why'      => 'Why schools choose it',
					'quote'    => 'Get a quote',
					'planner'  => 'Will it fit your timetable',
					'routes'   => 'Where it could take students',
					'taster'   => 'Try the course',
					'faq'      => 'What schools ask us first',
				);
				$i = 0;
				foreach ( $jumps as $id => $label ) :
					$i++;
					?>
					<a class="tfs2-jump__item" href="#<?php echo esc_attr( $id ); ?>"><span class="tfs2-jump__n"><?php echo esc_html( str_pad( $i, 2, '0', STR_PAD_LEFT ) ); ?></span><?php echo esc_html( $label ); ?></a>
				<?php endforeach; ?>
				<a class="tfs2-jump__item tfs2-jump__item--mobile" href="<?php echo esc_url( tfs2_url( tfs2_get( 'staff_url' ) ) ); ?>">For staff</a>
				<a class="tfs2-jump__item tfs2-jump__item--mobile" href="<?php echo esc_url( tfs2_url( tfs2_get( 'students_url' ) ) ); ?>">For students</a>
			</div>
		</div>
		<div class="tfs2-subnav__ctas">
			<a class="tfs2-btn tfs2-btn--outline tfs2-btn--sm" href="<?php echo esc_url( tfs2_get( 'enroll_url' ) ); ?>"><?php tfs2_e( 'enroll_label' ); ?></a>
			<a class="tfs2-btn tfs2-btn--navy tfs2-btn--sm" href="<?php echo esc_attr( $to_form ); ?>">Request a quote</a>
		</div>
	</div>
</nav>

<!-- ================= HERO ================= -->
<section class="tfs2-hero tfs2-hero--<?php echo esc_attr( $variant ); ?>">
	<div class="tfs2-wrap tfs2-hero__grid">
		<div class="tfs2-hero__copy">
			<p class="tfs2-eyebrow tfs2-eyebrow--wide"><?php tfs2_e( 'hero_eyebrow' ); ?></p>
			<h1 class="tfs2-hero__title"><?php tfs2_e( 'hero_title' ); ?></h1>
			<p class="tfs2-hero__lede"><?php tfs2_e( 'hero_lede' ); ?></p>
			<?php if ( 'image' === $variant ) : ?>
				<div class="tfs2-row">
					<a class="tfs2-btn tfs2-btn--green" href="#planner">Plan it into your timetable</a>
					<a class="tfs2-btn tfs2-btn--ghost" href="#outcomes">See where it takes students</a>
				</div>
			<?php else : ?>
				<p class="tfs2-hero__talk"><span><?php tfs2_e( 'hero_talk_text' ); ?></span>
					<a class="tfs2-textlink" href="<?php echo esc_url( tfs2_get( 'booking_url' ) ); ?>" data-dlopo-embed="true" data-dlopo-url="<?php echo esc_url( tfs2_get( 'booking_url' ) ); ?>"><?php tfs2_e( 'hero_talk_label' ); ?></a></p>
			<?php endif; ?>
			<p class="tfs2-hero__meta"><?php tfs2_e( 'hero_meta' ); ?></p>
		</div>

		<?php if ( 'image' === $variant ) : ?>
			<div class="tfs2-hero__media">
				<?php
				$hero_img = tfs2_get( 'hero_image' );
				if ( $hero_img ) {
					echo wp_get_attachment_image( (int) $hero_img, 'large', false, array( 'class' => 'tfs2-hero__img', 'loading' => 'eager', 'fetchpriority' => 'high' ) );
				}
				?>
			</div>
		<?php else : ?>
			<div class="tfs2-hero__form" id="letsTalkTEFL">
				<h2 class="tfs2-hero__form-title"><?php tfs2_e( 'hero_form_title' ); ?></h2>
				<p class="tfs2-hero__form-intro"><?php tfs2_e( 'hero_form_intro' ); ?></p>
				<div class="tfs2-cf7">
					<?php echo do_shortcode( wp_kses_post( tfs2_get( 'hero_form_shortcode' ) ) ); ?>
				</div>
				<p class="tfs2-small tfs2-muted"><?php tfs2_e( 'hero_form_note' ); ?></p>
				<p class="tfs2-hero__buy"><?php tfs2_e( 'hero_buy_text' ); ?>
					<a href="<?php echo esc_url( tfs2_get( 'hero_buy_url' ) ); ?>"><?php tfs2_e( 'hero_buy_label' ); ?></a></p>
			</div>
		<?php endif; ?>

		<?php /* Social proof carousel: sits under the left-hand text on desktop, after the form on mobile. */ ?>
		<?php if ( $proof ) : ?>
			<div class="tfs2-proof" data-tfs2-carousel data-interval="6000" role="region" aria-roledescription="carousel" aria-label="<?php echo esc_attr( tfs2_get( 'proof_label' ) ); ?>">
				<div class="tfs2-proof__track" data-tfs2-carousel-track>
					<?php foreach ( $proof as $si => $s ) : ?>
						<figure class="tfs2-proof__slide" data-tfs2-slide role="group" aria-roledescription="slide" aria-label="<?php echo esc_attr( ( $si + 1 ) . ' of ' . count( $proof ) ); ?>">
							<?php echo wp_get_attachment_image( (int) $s['image'], 'large', false, array( 'class' => 'tfs2-proof__img', 'loading' => 0 === $si ? 'eager' : 'lazy', 'sizes' => '(max-width: 900px) 100vw, 620px' ) ); ?>
							<?php if ( ! empty( $s['caption'] ) || ! empty( $s['name'] ) ) : ?>
								<figcaption class="tfs2-proof__cap">
									<?php if ( ! empty( $s['caption'] ) ) : ?><span class="tfs2-proof__q"><?php echo esc_html( $s['caption'] ); ?></span><?php endif; ?>
									<?php if ( ! empty( $s['name'] ) ) : ?><span class="tfs2-proof__who"><?php echo esc_html( $s['name'] ); ?></span><?php endif; ?>
								</figcaption>
							<?php endif; ?>
						</figure>
					<?php endforeach; ?>
				</div>
				<?php if ( count( $proof ) > 1 ) : ?>
					<div class="tfs2-car__ctrl">
						<div class="tfs2-car__dots" data-tfs2-carousel-dots></div>
						<div class="tfs2-car__arrows">
							<button type="button" class="tfs2-car__arrow tfs2-car__pause" data-tfs2-carousel-pause aria-label="Pause slideshow"><?php echo tfs2_icon( 'pause', 16, 'tfs2-ic--pause' ) . tfs2_icon( 'play', 16, 'tfs2-ic--play' ); ?></button>
							<button type="button" class="tfs2-car__arrow" data-tfs2-carousel-prev aria-label="Previous slide"><?php echo tfs2_icon( 'chevron-left', 18 ); ?></button>
							<button type="button" class="tfs2-car__arrow" data-tfs2-carousel-next aria-label="Next slide"><?php echo tfs2_icon( 'chevron-right', 18 ); ?></button>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php elseif ( $can_edit ) : ?>
			<div class="tfs2-proof"><?php echo tfs2_slot_empty( 'Social proof carousel', 'Images → Social proof slides (add two or more)', 'proof' ); // phpcs:ignore ?></div>
		<?php endif; ?>
	</div>
</section>

<!-- ================= TESTIMONIAL CAROUSEL (where the number strip used to be) ================= -->
<?php if ( $quotes ) : ?>
<section class="tfs2-voices" aria-label="<?php echo esc_attr( tfs2_get( 'quotes_title' ) ); ?>">
	<div class="tfs2-wrap">
		<div class="tfs2-voices__in" data-tfs2-carousel data-interval="7000" role="region" aria-roledescription="carousel" aria-label="<?php echo esc_attr( tfs2_get( 'quotes_title' ) ); ?>">
			<div class="tfs2-voices__head">
				<div>
					<p class="tfs2-eyebrow"><?php tfs2_e( 'quotes_eyebrow' ); ?></p>
					<h2 class="tfs2-h3 tfs2-h3--serif tfs2-h3--lg"><?php tfs2_e( 'quotes_title' ); ?></h2>
				</div>
				<?php if ( count( $quotes ) > 1 ) : ?>
					<div class="tfs2-car__ctrl">
						<div class="tfs2-car__dots" data-tfs2-carousel-dots></div>
						<div class="tfs2-car__arrows">
							<button type="button" class="tfs2-car__arrow tfs2-car__pause" data-tfs2-carousel-pause aria-label="Pause slideshow"><?php echo tfs2_icon( 'pause', 16, 'tfs2-ic--pause' ) . tfs2_icon( 'play', 16, 'tfs2-ic--play' ); ?></button>
							<button type="button" class="tfs2-car__arrow" data-tfs2-carousel-prev aria-label="Previous testimonials"><?php echo tfs2_icon( 'chevron-left', 18 ); ?></button>
							<button type="button" class="tfs2-car__arrow" data-tfs2-carousel-next aria-label="Next testimonials"><?php echo tfs2_icon( 'chevron-right', 18 ); ?></button>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="tfs2-voices__track" data-tfs2-carousel-track>
				<?php foreach ( $quotes as $qi => $q ) :
					$logo = ! empty( $q['logo'] ) ? wp_get_attachment_image( (int) $q['logo'], 'thumbnail', false, array( 'class' => 'tfs2-testi__logo', 'loading' => 'lazy', 'alt' => ! empty( $q['role'] ) ? $q['role'] . ' crest' : '' ) ) : '';
					?>
					<figure class="tfs2-testi<?php echo $logo ? '' : ' tfs2-testi--nologo'; ?>" data-tfs2-slide role="group" aria-roledescription="slide" aria-label="<?php echo esc_attr( ( $qi + 1 ) . ' of ' . count( $quotes ) ); ?>">
						<?php if ( $logo ) : ?><div class="tfs2-testi__media"><?php echo $logo; // phpcs:ignore ?></div><?php endif; ?>
						<div class="tfs2-testi__body">
							<blockquote><p>“<?php echo esc_html( $q['quote'] ); ?>”</p></blockquote>
							<figcaption>&mdash; <?php echo esc_html( $q['name'] ); ?><?php if ( ! empty( $q['role'] ) ) : ?>, <?php echo esc_html( $q['role'] ); ?><?php endif; ?></figcaption>
						</div>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- ================= 1. OUTCOMES (with the course in numbers) ================= -->
<section class="tfs2-sec tfs2-sec--white" id="outcomes">
	<div class="tfs2-wrap">
		<?php $slot = tfs2_slot( 'outcomes_image', 'Outcomes image' ); ?>
		<div class="tfs2-split<?php echo $slot ? ' has-media' : ''; ?>">
			<div class="tfs2-head">
				<p class="tfs2-eyebrow"><?php tfs2_e( 'outcomes_eyebrow' ); ?></p>
				<h2 class="tfs2-h2 tfs2-h2--lg"><?php tfs2_e( 'outcomes_title' ); ?></h2>
				<p class="tfs2-intro"><?php tfs2_e( 'outcomes_intro' ); ?></p>
			</div>
			<?php echo $slot; // phpcs:ignore ?>
		</div>
		<ul class="tfs2-outcomes">
			<?php foreach ( tfs2_rows( 'outcomes' ) as $o ) : ?>
				<li class="tfs2-outcome">
					<span class="tfs2-outcome__ic"><?php echo tfs2_icon( $o['icon'], 20 ); ?></span>
					<span><strong><?php echo esc_html( $o['title'] ); ?></strong><span><?php echo esc_html( $o['text'] ); ?></span></span>
				</li>
			<?php endforeach; ?>
		</ul>

		<div class="tfs2-stats" role="group" aria-label="The course in numbers">
			<div class="tfs2-stats__grid">
				<?php foreach ( tfs2_rows( 'stats' ) as $s ) : ?>
					<div class="tfs2-stat">
						<span class="tfs2-stat__ic"><?php echo tfs2_icon( $s['icon'], 20 ); ?></span>
						<span class="tfs2-stat__txt">
							<span class="tfs2-stat__n"><?php echo esc_html( $s['number'] ); ?></span>
							<span class="tfs2-stat__l"><?php echo nl2br( esc_html( $s['label'] ) ); ?></span>
						</span>
					</div>
				<?php endforeach; ?>
			</div>
			<ul class="tfs2-trust">
				<?php foreach ( tfs2_rows( 'trust' ) as $t ) : ?>
					<li><?php echo tfs2_icon( $t['icon'], 18 ); ?><span><?php echo esc_html( $t['text'] ); ?></span></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>

<!-- ================= 2. COST ================= -->
<section class="tfs2-sec tfs2-sec--ivory" id="cost">
	<div class="tfs2-wrap">
		<?php $slot = tfs2_slot( 'cost_image', 'Cost section image' ); ?>
		<div class="tfs2-split<?php echo $slot ? ' has-media' : ''; ?>">
			<div class="tfs2-head">
				<p class="tfs2-eyebrow"><?php tfs2_e( 'cost_eyebrow' ); ?></p>
				<h2 class="tfs2-h2 tfs2-h2--lg"><?php tfs2_e( 'cost_title' ); ?></h2>
				<p class="tfs2-intro"><?php tfs2_e( 'cost_intro' ); ?></p>
			</div>
			<?php echo $slot; // phpcs:ignore ?>
		</div>
		<div class="tfs2-calc">
			<div class="tfs2-calc__in">
				<div>
					<h3 class="tfs2-h3 tfs2-h3--serif"><?php tfs2_e( 'cost_card_title' ); ?></h3>
					<p class="tfs2-small tfs2-muted"><?php tfs2_e( 'cost_card_text' ); ?></p>
				</div>
				<div class="tfs2-range">
					<label class="tfs2-range__top" for="tfs2-n"><span>How many students</span><output class="tfs2-range__val" data-bind="n" for="tfs2-n"><?php echo (int) $n0; ?></output></label>
					<input type="range" id="tfs2-n" min="5" max="60" step="1" value="<?php echo (int) $n0; ?>" data-tfs2-n>
					<div class="tfs2-range__ends" aria-hidden="true"><span>5</span><span>60</span></div>
				</div>
				<fieldset class="tfs2-cur">
					<legend>Show it in</legend>
					<div class="tfs2-cur__pills">
						<?php foreach ( array( 'GBP' => '£', 'EUR' => '€', 'USD' => '$' ) as $code => $sym ) : ?>
							<label class="tfs2-cur__p"><input type="radio" name="tfs2-cur" value="<?php echo esc_attr( $code ); ?>"<?php checked( 'GBP', $code ); ?>><span><?php echo esc_html( $code . ' ' . $sym ); ?></span></label>
						<?php endforeach; ?>
					</div>
					<span class="tfs2-cur__note" data-bind="curNote">we invoice in pounds sterling</span>
				</fieldset>
				<div class="tfs2-tiers" data-tfs2-tiers>
					<?php foreach ( $tiers as $i => $t ) : ?>
						<div class="tfs2-tiers__row<?php echo $i === $tier_ix ? ' is-on' : ''; ?>"><span><?php echo (int) $t['min'] . ' to ' . (int) $t['max']; ?> students</span><span><?php echo esc_html( tfs2_gbp( $t['price'] ) ); ?> each</span></div>
					<?php endforeach; ?>
					<div class="tfs2-tiers__row"><span><?php echo (int) tfs2_get( 'bespoke_from' ); ?> or more students</span><span>Talk to Chloe</span></div>
				</div>
			</div>
			<div class="tfs2-calc__out" aria-live="polite">
				<p class="tfs2-label tfs2-label--onink">Your cohort</p>
				<p class="tfs2-calc__big"><span data-bind="perStudent"><?php echo esc_html( $p0 ? tfs2_gbp( $p0 ) : 'Bespoke' ); ?></span> <span class="tfs2-calc__unit" data-bind="perLabel">per student</span></p>
				<p class="tfs2-calc__tier" data-bind="tierName">Tier <?php echo esc_html( $ordinals[ $tier_ix ] ); ?>, <?php echo $tiers ? (int) $tiers[ $tier_ix ]['min'] . ' to ' . (int) $tiers[ $tier_ix ]['max'] . ' students' : ''; ?></p>
				<dl class="tfs2-calc__rows" data-tfs2-costrows>
					<div><dt>Students</dt><dd><?php echo (int) $n0; ?></dd></div>
					<div><dt>Total for the group</dt><dd><?php echo esc_html( tfs2_gbp( $p0 * $n0 ) ); ?></dd></div>
					<div><dt>Cost per guided learning hour</dt><dd><?php echo esc_html( tfs2_gbp( $p0 / 120, 2 ) ); ?></dd></div>
					<div><dt>Against the smallest cohort rate</dt><dd><?php echo esc_html( $p0 < $base ? 'Save ' . tfs2_gbp( ( $base - $p0 ) * $n0 ) : 'Base rate' ); ?></dd></div>
				</dl>
				<p class="tfs2-calc__next" data-bind="nextTier">&nbsp;</p>
				<p class="tfs2-calc__vat"><?php tfs2_e( 'vat_note' ); ?></p>
				<a class="tfs2-btn tfs2-btn--white tfs2-btn--block" href="<?php echo esc_attr( $to_form ); ?>">Put this in writing</a>
			</div>
		</div>
	</div>
</section>

<!-- ================= 3. WHY (with testimonials) ================= -->
<section class="tfs2-sec tfs2-sec--white" id="why">
	<div class="tfs2-wrap">
		<?php $slot = tfs2_slot( 'why_image', 'Why schools image' ); ?>
		<div class="tfs2-split<?php echo $slot ? ' has-media' : ''; ?>">
			<div class="tfs2-head">
				<span class="tfs2-rule" aria-hidden="true"></span>
				<h2 class="tfs2-h2 tfs2-h2--lg tfs2-h2--narrow"><?php tfs2_e( 'why_title' ); ?></h2>
			</div>
			<?php echo $slot; // phpcs:ignore ?>
		</div>
		<div class="tfs2-cards3">
			<?php foreach ( tfs2_rows( 'why_cards' ) as $c ) : ?>
				<div class="tfs2-card">
					<h3 class="tfs2-h3"><?php echo esc_html( $c['title'] ); ?></h3>
					<p><?php echo esc_html( $c['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="tfs2-row tfs2-row--after">
			<a class="tfs2-btn tfs2-btn--green" href="#planner">Plan it into your timetable</a>
			<a class="tfs2-btn tfs2-btn--ghost" href="#cost">See what it costs per student</a>
		</div>
	</div>
</section>

<!-- ================= 4. MODULES ================= -->
<section class="tfs2-prog" id="programme" data-tfs2-prog>
	<div class="tfs2-prog__pin">
		<div class="tfs2-wrap tfs2-prog__head">
			<div>
				<p class="tfs2-eyebrow tfs2-eyebrow--onink"><?php tfs2_e( 'programme_eyebrow' ); ?></p>
				<h2 class="tfs2-h2 tfs2-h2--lg"><?php tfs2_e( 'programme_title' ); ?></h2>
				<p class="tfs2-intro tfs2-intro--onink"><?php tfs2_e( 'programme_intro' ); ?></p>
			</div>
			<div class="tfs2-prog__count" aria-hidden="true">
				<p><span class="tfs2-prog__num" data-tfs2-modnum>01</span> <span>of <?php echo count( $modules ); ?></span></p>
				<div class="tfs2-prog__bar"><span data-tfs2-modbar></span></div>
			</div>
		</div>
		<ol class="tfs2-prog__track" data-tfs2-track>
			<?php foreach ( $modules as $mi => $m ) : ?>
				<li class="tfs2-mod<?php echo 0 === $mi ? ' is-on' : ''; ?>">
					<span class="tfs2-mod__n"><?php echo esc_html( str_pad( $mi + 1, 2, '0', STR_PAD_LEFT ) ); ?></span>
					<span class="tfs2-mod__t"><?php echo esc_html( $m['title'] ); ?></span>
					<?php if ( ! empty( $m['text'] ) ) : ?><span class="tfs2-mod__d"><?php echo esc_html( $m['text'] ); ?></span><?php endif; ?>
					<span class="tfs2-mod__foot"><?php echo tfs2_icon( 'check', 16 ); ?>Ends in a quiz they can retake</span>
				</li>
			<?php endforeach; ?>
			<li class="tfs2-mod tfs2-mod--end">
				<span class="tfs2-mod__t tfs2-mod__t--end"><?php tfs2_e( 'programme_end' ); ?></span>
				<a class="tfs2-btn tfs2-btn--white tfs2-btn--block" href="#outcomes"><?php tfs2_e( 'programme_receive' ); ?></a>
				<a class="tfs2-btn tfs2-btn--onink tfs2-btn--block" href="<?php echo esc_url( tfs2_url( tfs2_get( 'brochure_url' ) ) ); ?>"><?php tfs2_e( 'brochure_label' ); ?></a>
			</li>
		</ol>
	</div>
</section>

<!-- ================= 5. STAFF OR STUDENT ================= -->
<section class="tfs2-who" id="who">
	<div class="tfs2-wrap">
		<span class="tfs2-rule" aria-hidden="true"></span>
		<h2 class="tfs2-h2"><?php tfs2_e( 'who_title' ); ?></h2>
		<div class="tfs2-doors">
			<a class="tfs2-door tfs2-door--staff" href="<?php echo esc_url( tfs2_url( tfs2_get( 'staff_url' ) ) ); ?>">
				<span class="tfs2-label"><?php tfs2_e( 'door_staff_eyebrow' ); ?></span>
				<span class="tfs2-door__title"><?php tfs2_e( 'door_staff_title' ); ?></span>
				<span class="tfs2-door__text"><?php tfs2_e( 'door_staff_text' ); ?></span>
				<span class="tfs2-door__go"><?php tfs2_e( 'door_staff_link' ); ?> <?php echo tfs2_icon( 'arrow-right', 16 ); ?></span>
			</a>
			<a class="tfs2-door tfs2-door--student" href="<?php echo esc_url( tfs2_url( tfs2_get( 'students_url' ) ) ); ?>">
				<span class="tfs2-label"><?php tfs2_e( 'door_student_eyebrow' ); ?></span>
				<span class="tfs2-door__title"><?php tfs2_e( 'door_student_title' ); ?></span>
				<span class="tfs2-door__text"><?php tfs2_e( 'door_student_text' ); ?></span>
				<span class="tfs2-door__go"><?php tfs2_e( 'door_student_link' ); ?> <?php echo tfs2_icon( 'arrow-right', 16 ); ?></span>
			</a>
		</div>
	</div>
</section>

<!-- ================= 6. HOW IT WORKS + QUOTE ================= -->
<section class="tfs2-sec tfs2-sec--ivory tfs2-sec--how">
	<div class="tfs2-wrap">
		<div class="tfs2-story" data-tfs2-story>
			<div class="tfs2-story__steps">
				<div class="tfs2-head tfs2-head--tight">
					<p class="tfs2-eyebrow"><?php tfs2_e( 'steps_eyebrow' ); ?></p>
					<h2 class="tfs2-h2 tfs2-h2--lg"><?php tfs2_e( 'steps_title' ); ?></h2>
					<p class="tfs2-intro"><?php tfs2_e( 'steps_intro' ); ?></p>
				</div>
				<ol class="tfs2-story__list">
					<?php foreach ( $steps as $si => $st ) : ?>
						<li class="tfs2-step<?php echo 0 === $si ? ' is-on is-done' : ''; ?>" data-step="<?php echo (int) $si; ?>">
							<span class="tfs2-step__n" aria-hidden="true"><?php echo (int) $si + 1; ?></span>
							<div>
								<h3 class="tfs2-step__t"><?php echo esc_html( $st['title'] ); ?></h3>
								<p class="tfs2-step__d"><?php echo esc_html( $st['text'] ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
			<div class="tfs2-story__visual" aria-hidden="true">
				<div class="tfs2-story__panel">
					<div class="tfs2-story__top">
						<span class="tfs2-label tfs2-label--onink" data-bind="stepLabel">Step 1 of <?php echo count( $steps ); ?></span>
						<span class="tfs2-story__dots"><?php foreach ( $steps as $si => $st ) : ?><i class="<?php echo 0 === $si ? 'is-on' : ''; ?>"></i><?php endforeach; ?></span>
					</div>

					<div class="tfs2-layer is-on" data-layer="0">
						<div class="tfs2-mock">
							<div class="tfs2-mock__head"><img src="<?php echo esc_url( $chloe ); ?>" alt="" width="36" height="36" loading="lazy"><div><strong><?php echo esc_html( $name ); ?>, The TEFL Institute</strong><span>Your written quote</span></div></div>
							<dl class="tfs2-mock__rows">
								<div><dt>Students</dt><dd data-bind="n"><?php echo (int) $n0; ?></dd></div>
								<div><dt>Year group</dt><dd data-bind="yearLabel">Year 12</dd></div>
								<div><dt>Start date</dt><dd data-bind="startLabel">September</dd></div>
								<div><dt>Per student</dt><dd data-bind="perStudent"><?php echo esc_html( tfs2_gbp( $p0 ) ); ?></dd></div>
								<div><dt>Total for the group</dt><dd data-bind="total" class="is-strong"><?php echo esc_html( tfs2_gbp( $p0 * $n0 ) ); ?></dd></div>
							</dl>
						</div>
					</div>

					<div class="tfs2-layer" data-layer="1">
						<div class="tfs2-mock">
							<div class="tfs2-mock__head tfs2-mock__head--lg"><img src="<?php echo esc_url( $chloe ); ?>" alt="" width="52" height="52" loading="lazy"><div><strong class="tfs2-serif">Call with <?php echo esc_html( $name ); ?></strong><span><?php echo esc_html( $role ); ?></span></div></div>
							<ul class="tfs2-mock__ticks">
								<li><?php echo tfs2_icon( 'check', 14 ); ?>Cohort size</li>
								<li><?php echo tfs2_icon( 'check', 14 ); ?>Timetable</li>
								<li><?php echo tfs2_icon( 'check', 14 ); ?>Who is administering it at your end</li>
							</ul>
						</div>
					</div>

					<div class="tfs2-layer" data-layer="2">
						<div class="tfs2-mock tfs2-mock--center">
							<div class="tfs2-mock__code">
								<span class="tfs2-label tfs2-label--grey">Your school code</span>
								<span class="tfs2-mock__codebox">SIXTH-<span data-bind="n"><?php echo (int) $n0; ?></span></span>
								<span class="tfs2-small tfs2-muted">Students enrol themselves online using the school code.</span>
							</div>
							<div class="tfs2-mock__foot"><span>Students enrolled</span><strong>0 of <span data-bind="n"><?php echo (int) $n0; ?></span></strong></div>
						</div>
					</div>

					<div class="tfs2-layer" data-layer="3">
						<div class="tfs2-mock">
							<div class="tfs2-mock__title"><strong class="tfs2-serif">Cohort progress</strong><span><span data-bind="n"><?php echo (int) $n0; ?></span> students</span></div>
							<div class="tfs2-mock__prog">
								<?php
								foreach ( array( array( 'Amira K.', 42, 5 ), array( 'Ben T.', 30, 4 ), array( 'Freya M.', 64, 7 ), array( 'Dan O.', 18, 2 ) ) as $row ) :
									?>
									<div><strong><?php echo esc_html( $row[0] ); ?></strong><span class="tfs2-mock__track"><i style="width:<?php echo (int) $row[1]; ?>%"></i></span><span>Module <?php echo (int) $row[2]; ?> of 10</span></div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="tfs2-quotecta" id="quote">
			<div>
				<span class="tfs2-rule" aria-hidden="true"></span>
				<h2 class="tfs2-h2"><?php tfs2_e( 'quote_title' ); ?></h2>
				<p class="tfs2-intro"><?php tfs2_e( 'quote_text' ); ?></p>
			</div>
			<div class="tfs2-contact">
				<div class="tfs2-contact__who"><img src="<?php echo esc_url( $chloe ); ?>" alt="<?php echo esc_attr( $name ); ?>" width="56" height="56" loading="lazy"><div><strong><?php echo esc_html( $name ); ?></strong><span><?php echo esc_html( $role ); ?></span></div></div>
				<p class="tfs2-onink-muted"><?php tfs2_e( 'quote_reply' ); ?></p>
				<a class="tfs2-btn tfs2-btn--white tfs2-btn--block" href="<?php echo esc_attr( $to_form ); ?>"><?php tfs2_e( 'quote_button' ); ?></a>
			</div>
		</div>
	</div>
</section>

<!-- ================= 7. WILL IT FIT (PLANNER GATE) ================= -->
<section class="tfs2-sec tfs2-sec--white" id="planner">
	<div class="tfs2-wrap">
		<?php $slot = tfs2_slot( 'planner_image', 'Planner image' ); ?>
		<div class="tfs2-split<?php echo $slot ? ' has-media' : ''; ?>">
			<div class="tfs2-head">
				<p class="tfs2-eyebrow"><?php tfs2_e( 'planner_eyebrow' ); ?></p>
				<h2 class="tfs2-h2 tfs2-h2--lg"><?php tfs2_e( 'planner_title' ); ?></h2>
				<p class="tfs2-intro"><?php tfs2_e( 'planner_intro' ); ?></p>
			</div>
			<?php echo $slot; // phpcs:ignore ?>
		</div>
		<div class="tfs2-gate">
			<div>
				<h3 class="tfs2-h3 tfs2-h3--serif"><?php tfs2_e( 'planner_card_title' ); ?></h3>
				<p class="tfs2-muted"><?php tfs2_e( 'planner_card_text' ); ?></p>
			</div>
			<form class="tfs2-gate__form" data-tfs2-gate novalidate>
				<div class="tfs2-gate__fields">
					<label class="tfs2-field"><span>Name</span><input type="text" name="name" autocomplete="name" placeholder="Your name" required></label>
					<label class="tfs2-field"><span>School email</span><input type="email" name="email" autocomplete="email" placeholder="name@school.org.uk" required></label>
				</div>
				<label class="tfs2-hp" aria-hidden="true">Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
				<p class="tfs2-error" role="alert" data-tfs2-gate-error hidden></p>
				<div class="tfs2-row tfs2-row--center">
					<button type="submit" class="tfs2-btn tfs2-btn--green">Open the planner</button>
					<span class="tfs2-small tfs2-muted"><?php tfs2_e( 'planner_privacy' ); ?></span>
				</div>
			</form>
		</div>
	</div>
</section>

<!-- ================= 8. ENRICHMENT MAGNET (PERIOD SIX) ================= -->
<section class="tfs2-p6" id="periodsix">
	<div class="tfs2-wrap tfs2-p6__grid">
		<div>
			<p class="tfs2-label tfs2-label--onink"><?php tfs2_e( 'p6_eyebrow' ); ?></p>
			<h2 class="tfs2-h3 tfs2-h3--serif tfs2-h3--lg"><?php tfs2_e( 'p6_title' ); ?></h2>
			<p class="tfs2-onink-muted"><?php tfs2_e( 'p6_text' ); ?></p>
		</div>
		<div>
			<form class="tfs2-p6__form" data-tfs2-p6 novalidate>
				<label class="tfs2-sr" for="tfs2-p6-name">First name</label>
				<input id="tfs2-p6-name" type="text" name="name" placeholder="First name" autocomplete="given-name" required>
				<label class="tfs2-sr" for="tfs2-p6-email">School email</label>
				<input id="tfs2-p6-email" type="email" name="email" placeholder="School email" autocomplete="email" required>
				<button type="submit" class="tfs2-btn tfs2-btn--green"><?php tfs2_e( 'p6_button' ); ?></button>
			</form>
			<p class="tfs2-p6__msg" role="status" data-tfs2-p6-msg></p>
			<p class="tfs2-p6__fine"><?php tfs2_e( 'p6_fine' ); ?> <a href="<?php echo esc_url( get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/privacy-policy/' ) ); ?>">Privacy policy</a>.</p>
		</div>
	</div>
</section>

<!-- ================= 9. WHERE IT COULD TAKE YOU (ROUTES) ================= -->
<section class="tfs2-sec tfs2-sec--white" id="routes">
	<div class="tfs2-wrap">
		<?php $slot = tfs2_slot( 'routes_image', 'Routes image' ); ?>
		<div class="tfs2-split<?php echo $slot ? ' has-media' : ''; ?>">
			<div class="tfs2-head">
				<p class="tfs2-eyebrow"><?php tfs2_e( 'routes_eyebrow' ); ?></p>
				<h2 class="tfs2-h2 tfs2-h2--lg"><?php tfs2_e( 'routes_title' ); ?></h2>
				<p class="tfs2-intro"><?php tfs2_e( 'routes_intro' ); ?></p>
			</div>
			<?php echo $slot; // phpcs:ignore ?>
		</div>
		<div class="tfs2-tool tfs2-tool--ivory">
			<div class="tfs2-tool__head">
				<h3 class="tfs2-h3 tfs2-h3--serif"><?php tfs2_e( 'routes_card_title' ); ?></h3>
				<p class="tfs2-small tfs2-muted"><?php tfs2_e( 'routes_card_text' ); ?></p>
			</div>
			<form class="tfs2-tool__body" data-tfs2-routes>
				<?php
				$rqs = array(
					array( 'when', 'When are you thinking about', '', array( 'While I am still at school', 'A gap year before university', 'After my degree' ) ),
					array( 'want', 'What matters most to you', 'pick one', array( 'Earning something', 'Getting somewhere far away', 'Something serious on the CV', 'Working with people, not a screen' ) ),
					array( 'struct', 'How much structure do you want', '', array( 'A programme that organises it for me', 'I would rather sort it myself' ) ),
				);
				foreach ( $rqs as $qi => $rq ) :
					?>
					<fieldset class="tfs2-q">
						<legend class="tfs2-q__label"><span class="tfs2-q__num"><?php echo esc_html( '0' . ( $qi + 1 ) ); ?></span><span class="tfs2-q__title"><?php echo esc_html( $rq[1] ); ?></span><?php if ( $rq[2] ) : ?><span class="tfs2-q__hint"><?php echo esc_html( $rq[2] ); ?></span><?php endif; ?></legend>
						<div class="tfs2-chips">
							<?php foreach ( $rq[3] as $oi => $label ) : ?>
								<label class="tfs2-chip tfs2-chip--green"><input type="radio" name="<?php echo esc_attr( $rq[0] ); ?>" value="<?php echo (int) $oi; ?>"<?php checked( 0, $oi ); ?>><span><?php echo esc_html( $label ); ?></span></label>
							<?php endforeach; ?>
						</div>
					</fieldset>
				<?php endforeach; ?>
				<button type="submit" class="tfs2-btn tfs2-btn--green tfs2-self-start">Show me the routes</button>
				<div class="tfs2-matches" data-tfs2-matches aria-live="polite" hidden></div>
			</form>
		</div>
	</div>
</section>

<!-- ================= TASTER ================= -->
<section class="tfs2-sec tfs2-sec--ivory" id="taster">
	<div class="tfs2-wrap tfs2-taster">
		<div class="tfs2-taster__intro">
			<p class="tfs2-eyebrow"><?php tfs2_e( 'taster_eyebrow' ); ?></p>
			<h2 class="tfs2-h2 tfs2-h2--lg"><?php tfs2_e( 'taster_title' ); ?></h2>
			<p class="tfs2-intro"><?php tfs2_e( 'taster_intro' ); ?></p>
			<?php echo tfs2_slot( 'taster_image', 'Taster image', 'side' ); // phpcs:ignore ?>
		</div>
		<div class="tfs2-tool">
			<div class="tfs2-tool__head">
				<h3 class="tfs2-h3 tfs2-h3--serif tfs2-h3--sm"><?php tfs2_e( 'taster_card_title' ); ?></h3>
				<p class="tfs2-small tfs2-muted"><?php tfs2_e( 'taster_card_text' ); ?></p>
			</div>
			<div class="tfs2-tool__body">
				<div class="tfs2-quiz" data-tfs2-quiz aria-live="polite">
					<noscript><p class="tfs2-muted">The taster needs JavaScript switched on.</p></noscript>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ================= 10. FAQ ================= -->
<section class="tfs2-sec tfs2-sec--white" id="faq">
	<div class="tfs2-wrap tfs2-faq">
		<div>
			<span class="tfs2-rule" aria-hidden="true"></span>
			<h2 class="tfs2-h2 tfs2-h2--lg"><?php tfs2_e( 'faq_title' ); ?></h2>
			<?php echo tfs2_slot( 'faq_image', 'FAQ image', 'side' ); // phpcs:ignore ?>
		</div>
		<div class="tfs2-faq__list">
			<?php foreach ( $faqs as $fi => $f ) :
				$open = 0 === $fi;
				?>
				<div class="tfs2-faq__item">
					<h3 class="tfs2-faq__q">
						<button type="button" class="tfs2-faq__btn" aria-expanded="<?php echo $open ? 'true' : 'false'; ?>" aria-controls="tfs2-faq-<?php echo (int) $fi; ?>">
							<span><?php echo esc_html( $f['question'] ); ?></span><?php echo tfs2_icon( 'chevron-down', 20 ); ?>
						</button>
					</h3>
					<div class="tfs2-faq__a" id="tfs2-faq-<?php echo (int) $fi; ?>"<?php echo $open ? '' : ' hidden'; ?>><p><?php echo esc_html( $f['answer'] ); ?></p></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ================= 11. US SCHOOLS ================= -->
<section class="tfs2-sec tfs2-sec--white tfs2-sec--us">
	<div class="tfs2-wrap">
		<div class="tfs2-us">
			<div>
				<p class="tfs2-label"><?php tfs2_e( 'us_eyebrow' ); ?></p>
				<h2 class="tfs2-h3 tfs2-h3--serif tfs2-h3--lg"><?php tfs2_e( 'us_title' ); ?></h2>
				<p class="tfs2-muted"><?php tfs2_e( 'us_text' ); ?></p>
			</div>
			<?php
			$us_url  = tfs2_get( 'us_url' );
			$us_href = $us_url ? esc_url( tfs2_url( $us_url ) ) : 'mailto:' . esc_attr( antispambot( $email ) ) . '?subject=US%20cohort';
			$us_book = $us_url && false !== strpos( $us_url, 'dlopo.com' );
			?>
			<a class="tfs2-btn tfs2-btn--green" href="<?php echo $us_href; // phpcs:ignore -- escaped above ?>"<?php if ( $us_book ) : ?> data-dlopo-embed="true" data-dlopo-url="<?php echo esc_url( $us_url ); ?>"<?php endif; ?>><?php tfs2_e( 'us_label' ); ?></a>
		</div>
	</div>
</section>

<!-- ================= 12. A NOTE FROM CHLOE ================= -->
<section class="tfs2-sec tfs2-sec--white tfs2-note-sec" id="chloe">
	<div class="tfs2-wrap">
		<div class="tfs2-note">
			<div class="tfs2-note__side">
				<img class="tfs2-note__pic" src="<?php echo esc_url( $chloe ); ?>" alt="<?php echo esc_attr( $name ); ?>" width="230" height="230" loading="lazy">
				<div class="tfs2-note__who"><strong><?php echo esc_html( $name ); ?></strong><span><?php echo esc_html( $role ); ?></span></div>
				<a class="tfs2-btn tfs2-btn--green tfs2-btn--sm" href="<?php echo esc_url( tfs2_get( 'booking_url' ) ); ?>" data-dlopo-embed="true" data-dlopo-url="<?php echo esc_url( tfs2_get( 'booking_url' ) ); ?>">Book a Call</a>
			</div>
			<div class="tfs2-note__main">
				<span class="tfs2-rule" aria-hidden="true"></span>
				<h2 class="tfs2-h2"><?php tfs2_e( 'note_title' ); ?></h2>
				<div class="tfs2-note__body" id="tfs2-note-body" data-collapsed="true">
					<?php echo wp_kses_post( tfs2_get( 'note_body' ) ); ?>
				</div>
				<button type="button" class="tfs2-note__toggle" aria-expanded="false" aria-controls="tfs2-note-body"><span>Read more</span><?php echo tfs2_icon( 'chevron-down', 16 ); ?></button>
			</div>
		</div>
	</div>
</section>

<!-- ================= GUIDES ================= -->
<?php if ( $guides ) : ?>
<section class="tfs2-sec tfs2-sec--white tfs2-sec--guides">
	<div class="tfs2-wrap">
		<h2 class="tfs2-h3 tfs2-h3--serif tfs2-h3--lg"><?php tfs2_e( 'guides_title' ); ?></h2>
		<ul class="tfs2-guides">
			<?php foreach ( $guides as $g ) : ?>
				<li><a href="<?php echo esc_url( $g['url'] ); ?>"><strong><?php echo esc_html( $g['title'] ); ?></strong><span><?php echo esc_html( $g['text'] ); ?></span></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
<?php endif; ?>

<!-- ================= PLANNER DIALOG ================= -->
<div class="tfs2-modal" data-tfs2-modal="planner" hidden>
	<div class="tfs2-modal__box tfs2-modal__box--wide" role="dialog" aria-modal="true" aria-labelledby="tfs2-planner-title">
		<div class="tfs2-modal__head">
			<div>
				<h2 class="tfs2-h3 tfs2-h3--serif" id="tfs2-planner-title"><?php tfs2_e( 'planner_card_title' ); ?></h2>
				<p class="tfs2-small tfs2-muted">Your plan for <span data-bind="leadName"></span>. You can print the result.</p>
			</div>
			<button type="button" class="tfs2-modal__x" data-tfs2-close aria-label="Close"><?php echo tfs2_icon( 'x', 20 ); ?></button>
		</div>
		<form class="tfs2-modal__body" data-tfs2-planner>
			<?php
			$pqs = array(
				array( 'year', 'Which year group', '', $popts['years'], 'y12' ),
				array( 'slot', 'What slot can you give it', 'per week, in school time', $popts['slots'], 'hour' ),
				array( 'start', 'When would you start', '', $popts['starts'], 'sep' ),
			);
			foreach ( $pqs as $qi => $pq ) :
				?>
				<fieldset class="tfs2-q">
					<legend class="tfs2-q__label"><span class="tfs2-q__num tfs2-q__num--grey"><?php echo esc_html( '0' . ( $qi + 1 ) ); ?></span><span class="tfs2-q__title"><?php echo esc_html( $pq[1] ); ?></span><?php if ( $pq[2] ) : ?><span class="tfs2-q__hint"><?php echo esc_html( $pq[2] ); ?></span><?php endif; ?></legend>
					<div class="tfs2-chips">
						<?php foreach ( $pq[3] as $o ) : ?>
							<label class="tfs2-chip"><input type="radio" name="<?php echo esc_attr( $pq[0] ); ?>" value="<?php echo esc_attr( $o['id'] ); ?>"<?php checked( $pq[4], $o['id'] ); ?>><span><?php echo esc_html( $o['label'] ); ?><?php if ( ! empty( $o['sub'] ) ) : ?> <small><?php echo esc_html( $o['sub'] ); ?></small><?php endif; ?></span></label>
						<?php endforeach; ?>
					</div>
				</fieldset>
			<?php endforeach; ?>
			<div class="tfs2-q">
				<label class="tfs2-q__label" for="tfs2-pn"><span class="tfs2-q__num tfs2-q__num--grey">04</span><span class="tfs2-q__title">How many students</span><output class="tfs2-range__val tfs2-push" data-bind="n" for="tfs2-pn"><?php echo (int) $n0; ?></output></label>
				<input type="range" id="tfs2-pn" min="5" max="60" step="1" value="<?php echo (int) $n0; ?>" data-tfs2-n>
			</div>
			<div class="tfs2-row tfs2-row--center">
				<button type="submit" class="tfs2-btn tfs2-btn--green">Build the plan</button>
				<span class="tfs2-small tfs2-muted">Cohort size is shared with the cost calculator</span>
			</div>
			<div class="tfs2-plan" data-tfs2-plan hidden>
				<div class="tfs2-plan__head">
					<h3 class="tfs2-h3 tfs2-h3--serif" data-bind="planTitle"></h3>
					<button type="button" class="tfs2-btn tfs2-btn--outline-green tfs2-btn--xs" data-tfs2-print>Print the plan</button>
				</div>
				<dl class="tfs2-plan__rows" data-tfs2-planrows></dl>
				<p class="tfs2-small tfs2-muted" data-tfs2-plan-sent></p>
			</div>
		</form>
	</div>
</div>

<!-- ================= STICKY PRICE ================= -->
<div class="tfs2-pill" data-tfs2-pill aria-hidden="true">
	<span><strong data-bind="stickyPrice"><?php echo esc_html( tfs2_gbp( $p0 ) ); ?> per student</strong> <span class="tfs2-pill__sub" data-bind="stickySub">for <?php echo (int) $n0; ?> students</span></span>
	<a class="tfs2-btn tfs2-btn--green tfs2-btn--xs" href="#cost" tabindex="-1">What it costs <?php echo tfs2_icon( 'arrow-right', 15 ); ?></a>
</div>

</div><!-- #tfs2 -->
<?php
get_footer();