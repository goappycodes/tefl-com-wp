<?php
/**
 * Template: Course Page 2026
 * Loaded by includes/course-2026.php when "Use the 2026 course design" is on.
 * Any section whose fields are empty is skipped (and drops out of the section nav).
 *
 * Schools add-on: on course pages with the post meta c26_schools_form = 1 the hero
 * image is replaced by the TEFL for Schools quote form, and with c26_schools_quotes = 1
 * the TEFL for Schools testimonials are shown before the FAQs. Both are read from the
 * TEFL for Schools v3 page (ID 110427), so editing them there updates every course page.
 *
 * @package teflinstitute
 */

defined( 'ABSPATH' ) || exit;

get_header();

$pid   = get_queried_object_id();
$title = get_field( 'c26_hero_title', $pid );
$title = $title ? $title : get_the_title( $pid );

$quote    = ti_c26_quote( $pid );
$end_ms   = ti_c26_countdown_end( $pid );
$enrol_lb = get_field( 'c26_enrol_label', $pid );
$enrol_lb = $enrol_lb ? $enrol_lb : 'Enrol now';
list( $main_product_id ) = ti_c26_products_for( $pid );
$fallback_cart_url = $main_product_id ? add_query_arg( 'add-to-cart', $main_product_id, wc_get_checkout_url() ) : '#';

/** Small helpers scoped to this template. */
$kicker = function ( $text ) {
	return $text ? '<div class="c26-kicker">' . esc_html( $text ) . '</div>' : '';
};
$rule = '<div class="c26-rule" aria-hidden="true"></div>';
$img  = function ( $id, $size = 'large', $class = '' ) {
	return $id ? wp_get_attachment_image( $id, $size, false, array( 'class' => $class, 'loading' => 'lazy' ) ) : '';
};

/* -------------------------------------------------------------------------
 * Build main-column sections first so the sticky nav only lists what exists.
 * ---------------------------------------------------------------------- */
$sections = array(); // id => [ nav label, html ]

/* Overview */
$body  = get_field( 'c26_overview_body', $pid );
$stats = get_field( 'c26_stats', $pid );
if ( $body || $stats ) {
	ob_start(); ?>
	<section id="overview" class="c26-section">
		<?php echo $rule; ?>
		<h2 class="c26-h2"><?php echo esc_html( get_field( 'c26_overview_heading', $pid ) ); ?></h2>
		<div class="c26-prose"><?php echo wp_kses_post( $body ); ?></div>
		<?php if ( $stats ) : ?>
			<div class="c26-stats">
				<?php
				/* Icons for the key numbers, in order (same Lucide set as the schools page). */
				$stat_icons = array(
					'<path d="M12 6v6l4 2"/><circle cx="12" cy="12" r="10"/>',
					'<path d="m12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/>',
					'<path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/>',
					'<path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>',
				);
				foreach ( array_values( $stats ) as $si => $s ) :
					$ic = $stat_icons[ $si % count( $stat_icons ) ];
					?>
					<div class="c26-stat">
						<span class="c26-stat-icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><?php echo $ic; // phpcs:ignore -- fixed markup ?></svg></span>
						<div class="c26-stat-num"><?php echo esc_html( $s['value'] ); ?></div>
						<div class="c26-stat-label"><?php echo esc_html( $s['label'] ); ?></div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</section>
	<?php
	$sections['overview'] = array( 'Overview', ob_get_clean() );
}

/* What you get */
$included = get_field( 'c26_included', $pid );
if ( $included ) {
	ob_start(); ?>
	<section id="included" class="c26-section">
		<div class="c26-head"><?php echo $kicker( get_field( 'c26_included_kicker', $pid ) ); ?><h2 class="c26-h2"><?php echo esc_html( get_field( 'c26_included_heading', $pid ) ); ?></h2></div>
		<div class="c26-included">
			<?php foreach ( $included as $o ) : ?>
				<div class="c26-included-item">
					<span class="c26-included-icon"><?php echo ti_c26_icon( $o['icon'] ? $o['icon'] : 'check' ); // phpcs:ignore -- trusted theme file ?></span>
					<div><div class="c26-included-title"><?php echo esc_html( $o['title'] ); ?></div><div class="c26-small"><?php echo esc_html( $o['text'] ); ?></div></div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
	$sections['included'] = array( get_field( 'c26_included_heading', $pid ) ? get_field( 'c26_included_heading', $pid ) : 'What you get', ob_get_clean() );
}

/* Who it is for */
$who    = get_field( 'c26_who', $pid );
$promos = get_field( 'c26_promos', $pid );
if ( $who || $promos ) {
	ob_start(); ?>
	<section id="who" class="c26-section">
		<div class="c26-head"><?php echo $rule; ?><h2 class="c26-h2"><?php echo esc_html( get_field( 'c26_who_heading', $pid ) ); ?></h2></div>
		<?php if ( $who ) : ?>
			<div class="c26-grid-2">
				<?php foreach ( $who as $w ) : ?>
					<div class="c26-card c26-card--ivory"><div class="c26-h4"><?php echo esc_html( $w['title'] ); ?></div><div class="c26-small"><?php echo esc_html( $w['text'] ); ?></div></div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php if ( $promos ) : ?>
			<div class="c26-grid-2">
				<?php foreach ( $promos as $p ) : ?>
					<div class="c26-promo c26-promo--<?php echo esc_attr( $p['style'] ); ?>">
						<?php if ( $p['kicker'] ) : ?><div class="c26-promo-kicker"><?php echo esc_html( $p['kicker'] ); ?></div><?php endif; ?>
						<div class="c26-promo-title"><?php echo esc_html( $p['title'] ); ?></div>
						<div class="c26-promo-text"><?php echo esc_html( $p['text'] ); ?></div>
						<?php echo ti_c26_link( $p['link'], 'c26-promo-link', ti_c26_icon( 'arrow-right', 'c26-icon c26-icon--sm' ) ); // phpcs:ignore ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</section>
	<?php
	$sections['who'] = array( 'Who it is for', ob_get_clean() );
}

/* Modules */
$modules = get_field( 'c26_modules', $pid );
if ( $modules ) {
	$foot = get_field( 'c26_modules_footnote', $pid );
	ob_start(); ?>
	<section id="modules" class="c26-section">
		<div class="c26-head">
			<?php echo $kicker( get_field( 'c26_modules_kicker', $pid ) ); ?>
			<h2 class="c26-h2"><?php echo esc_html( get_field( 'c26_modules_heading', $pid ) ); ?></h2>
			<div class="c26-meta">
				<?php if ( get_field( 'c26_modules_time_note', $pid ) ) : ?><span><?php echo ti_c26_icon( 'clock', 'c26-icon c26-icon--sm c26-green' ); echo esc_html( get_field( 'c26_modules_time_note', $pid ) ); ?></span><?php endif; ?>
				<?php if ( get_field( 'c26_modules_access_note', $pid ) ) : ?><span><?php echo ti_c26_icon( 'laptop', 'c26-icon c26-icon--sm c26-green' ); echo esc_html( get_field( 'c26_modules_access_note', $pid ) ); ?></span><?php endif; ?>
			</div>
		</div>
		<div class="c26-accordion c26-modules">
			<?php foreach ( $modules as $i => $m ) : $open = 0 === $i; ?>
				<details class="c26-acc-item"<?php echo $open ? ' open' : ''; ?>>
					<summary class="c26-module-row">
						<span class="c26-module-num"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<span class="c26-module-title"><?php echo esc_html( $m['title'] ); ?></span>
						<span class="c26-chev"><?php echo ti_c26_icon( 'chevron-down' ); ?></span>
					</summary>
					<div class="c26-module-body">
						<div class="c26-body-text"><?php echo esc_html( $m['text'] ); ?></div>
						<?php if ( $foot ) : ?><div class="c26-module-foot"><?php echo ti_c26_icon( 'check', 'c26-icon c26-icon--xs c26-green' ); echo esc_html( $foot ); ?></div><?php endif; ?>
					</div>
				</details>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
	$sections['modules'] = array( 'Course outline', ob_get_clean() );
}

/* Certificate */
$cert_intro = get_field( 'c26_cert_intro', $pid );
$accs       = get_field( 'c26_accreditations', $pid );
$cert_img   = get_field( 'c26_cert_image', $pid );
if ( $cert_intro || $accs || $cert_img || get_field( 'c26_cert_title', $pid ) ) {
	ob_start(); ?>
	<section id="certificate" class="c26-section">
		<div class="c26-head">
			<?php echo $rule; ?>
			<h2 class="c26-h2"><?php echo esc_html( get_field( 'c26_cert_heading', $pid ) ); ?></h2>
			<?php if ( $cert_intro ) : ?><p class="c26-lead"><?php echo esc_html( $cert_intro ); ?></p><?php endif; ?>
		</div>
		<div class="c26-cert-panel">
			<?php if ( $cert_img ) : ?>
				<div class="c26-cert c26-cert--image"><?php echo $img( $cert_img, 'large' ); ?></div>
			<?php else : ?>
				<div class="c26-cert" aria-label="Sample certificate">
					<div class="c26-cert-inner">
						<span class="c26-cert-logo"><?php echo ti_c26_site_logo_img(); ?></span>
						<div class="c26-cert-label">Certificate of completion</div>
						<div class="c26-cert-italic">This is to certify that</div>
						<div class="c26-cert-name">Your Name</div>
						<div class="c26-cert-line"></div>
						<div class="c26-cert-text">has completed the<br><strong><?php echo esc_html( get_field( 'c26_cert_title', $pid ) ); ?></strong></div>
						<div class="c26-cert-foot"><span>No. TI-120-000000</span><span class="c26-cert-seal"><?php echo ti_c26_icon( 'award', 'c26-icon c26-icon--sm' ); ?></span><span><?php echo esc_html( get_field( 'c26_cert_footer', $pid ) ); ?></span></div>
					</div>
				</div>
			<?php endif; ?>
			<div class="c26-stack">
				<div class="c26-h3"><?php echo esc_html( get_field( 'c26_cert_card_heading', $pid ) ); ?></div>
				<div class="c26-body-text"><?php echo esc_html( get_field( 'c26_cert_card_text', $pid ) ); ?></div>
				<div class="c26-btn-row">
					<?php echo ti_c26_link( get_field( 'c26_cert_sample', $pid ), 'c26-btn c26-btn--green c26-btn--sm' ); // phpcs:ignore ?>
					<?php echo ti_c26_link( get_field( 'c26_cert_verify', $pid ), 'c26-btn c26-btn--outline c26-btn--sm' ); // phpcs:ignore ?>
				</div>
			</div>
		</div>
		<?php if ( $accs ) : ?>
			<div class="c26-accs">
				<?php foreach ( $accs as $a ) : ?>
					<div class="c26-acc-badge">
						<?php if ( $a['logo'] ) : ?><span class="c26-acc-logo"><?php echo $img( $a['logo'], 'medium' ); ?></span>
						<?php elseif ( $a['badge'] ) : ?><span class="c26-acc-text"><?php echo esc_html( $a['badge'] ); ?></span><?php endif; ?>
						<span class="c26-acc-copy"><strong><?php echo esc_html( $a['name'] ); ?></strong><span><?php echo esc_html( $a['note'] ); ?></span></span>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</section>
	<?php
	$sections['certificate'] = array( 'Certificate', ob_get_clean() );
}

/* Resources */
$guides = get_field( 'c26_guides', $pid );
if ( $guides ) {
	ob_start(); ?>
	<section id="resources" class="c26-section">
		<div class="c26-head"><?php echo $kicker( get_field( 'c26_resources_kicker', $pid ) ); ?><h2 class="c26-h2"><?php echo esc_html( get_field( 'c26_resources_heading', $pid ) ); ?></h2></div>
		<div class="c26-guides">
			<?php foreach ( $guides as $g ) :
				$href = $g['file'] ? $g['file'] : $g['url']; ?>
				<div class="c26-guide">
					<div class="c26-guide-img c26-fit-<?php echo esc_attr( $g['fit'] ? $g['fit'] : 'cover' ); ?>"><?php echo $img( $g['image'], 'medium_large' ); ?></div>
					<div class="c26-guide-body">
						<div class="c26-h4"><?php echo esc_html( $g['title'] ); ?></div>
						<div class="c26-small"><?php echo esc_html( $g['text'] ); ?></div>
						<?php if ( $href ) : ?>
							<a class="c26-btn c26-btn--outline c26-btn--xs" href="<?php echo esc_url( $href ); ?>"<?php echo $g['file'] ? ' download' : ''; ?>><?php echo ti_c26_icon( 'download', 'c26-icon c26-icon--xs' ); ?>Download</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>
	<?php
	$sections['resources'] = array( '', ob_get_clean() ); // Not in nav (matches design).
}

$videos = get_field( 'c26_videos', $pid );
$faqs   = ti_c26_faq_rows( $pid );

/* Schools add-on: quote form and testimonials, read from the TEFL for Schools v3 page. */
$tfs_src = (int) apply_filters( 'c26_schools_source_page', 110427 );
/* Read a field from the schools page; works whether or not the schools helper functions are loaded. */
$tfs_get = function ( $name, $default = '' ) use ( $tfs_src ) {
	$v = function_exists( 'tfs2_get' ) ? tfs2_get( $name, $tfs_src ) : get_field( $name, $tfs_src );
	return ( null === $v || false === $v || '' === $v ) ? $default : $v;
};
$tfs_form = (bool) get_post_meta( $pid, 'c26_schools_form', true );
$tfs_quotes = array();
if ( get_post_meta( $pid, 'c26_schools_quotes', true ) ) {
	/* This course's own testimonials win; otherwise use the ones on the schools page. */
	$own_quotes = get_field( 'c26_testimonials', $pid );
	if ( is_array( $own_quotes ) && $own_quotes ) {
		$tfs_quotes = $own_quotes;
	} else {
		$tfs_quotes = function_exists( 'tfs2_rows' ) ? tfs2_rows( 'quotes', $tfs_src ) : get_field( 'quotes', $tfs_src );
		$tfs_quotes = is_array( $tfs_quotes ) ? $tfs_quotes : array();
	}
}
$quotes_kicker  = get_field( 'c26_testimonials_kicker', $pid );
$quotes_heading = get_field( 'c26_testimonials_heading', $pid );

$nav = array();
foreach ( $sections as $id => $s ) {
	if ( $s[0] ) {
		$nav[ $id ] = $s[0];
	}
}
if ( $videos ) {
	$nav['students'] = 'Students';
}
if ( $tfs_quotes ) {
	$nav['reviews'] = 'Reviews';
}
if ( $faqs ) {
	$nav['faq'] = 'FAQs';
}

/* Breadcrumb */
$crumb = get_field( 'c26_breadcrumb_parent', $pid );
?>

<div class="c26" id="c26">

	<!-- HERO -->
	<section class="c26-hero">
		<nav class="c26-crumbs c26-wrap" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span>/</span>
			<a href="<?php echo esc_url( home_url( '/tefl-courses-overview/' ) ); ?>">TEFL Courses</a><span>/</span>
			<?php if ( ! empty( $crumb['url'] ) ) : ?><a href="<?php echo esc_url( $crumb['url'] ); ?>"><?php echo esc_html( $crumb['title'] ); ?></a><span>/</span><?php endif; ?>
			<span class="c26-crumb-current" aria-current="page"><?php echo esc_html( get_the_title( $pid ) ); ?></span>
		</nav>
		<div class="c26-hero-grid c26-wrap">
			<div class="c26-hero-copy">
				<?php $badges = get_field( 'c26_badges', $pid ); if ( $badges ) : ?>
					<div class="c26-badges">
						<?php foreach ( $badges as $b ) : ?><span class="c26-badge c26-badge--<?php echo esc_attr( $b['style'] ); ?>"><?php echo esc_html( $b['label'] ); ?></span><?php endforeach; ?>
					</div>
				<?php endif; ?>
				<h1 class="c26-h1"><?php echo esc_html( $title ); ?></h1>
				<?php if ( get_field( 'c26_hero_intro', $pid ) ) : ?><p class="c26-hero-intro"><?php echo esc_html( get_field( 'c26_hero_intro', $pid ) ); ?></p><?php endif; ?>
				<?php $points = get_field( 'c26_hero_points', $pid ); if ( $points ) : ?>
					<ul class="c26-ticks">
						<?php foreach ( $points as $pt ) : ?><li><span class="c26-tick"><?php echo ti_c26_icon( 'check', 'c26-icon c26-icon--xs' ); ?></span><?php echo esc_html( $pt['text'] ); ?></li><?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<div class="c26-btn-row">
					<a href="<?php echo esc_url( $fallback_cart_url ); ?>" class="c26-btn c26-btn--green" data-c26-enrol><?php echo esc_html( $enrol_lb ); ?></a>
					<?php if ( $modules && get_field( 'c26_hero_secondary_label', $pid ) ) : ?>
						<a href="#modules" class="c26-btn c26-btn--outline" data-c26-jump="modules"><?php echo esc_html( get_field( 'c26_hero_secondary_label', $pid ) ); ?></a>
					<?php endif; ?>
				</div>
				<div class="c26-trust">
					<?php if ( get_field( 'c26_trust_rating', $pid ) ) : ?>
						<span class="c26-trust-item"><?php echo ti_c26_icon( 'star', 'c26-icon c26-icon--sm c26-gold' ); ?><strong><?php echo esc_html( get_field( 'c26_trust_rating', $pid ) ); ?></strong> <?php echo esc_html( get_field( 'c26_trust_rating_label', $pid ) ); ?></span>
						<span class="c26-trust-div" aria-hidden="true"></span>
					<?php endif; ?>
					<?php if ( get_field( 'c26_trust_stat', $pid ) ) : ?>
						<span><strong><?php echo esc_html( get_field( 'c26_trust_stat', $pid ) ); ?></strong> <?php echo esc_html( get_field( 'c26_trust_stat_label', $pid ) ); ?></span>
					<?php endif; ?>
				</div>
			</div>
			<?php if ( $tfs_form ) : ?>
				<div class="c26-hero-form" id="letsTalkTEFL">
					<h2 class="c26-hero-form-title"><?php echo esc_html( $tfs_get( 'hero_form_title', 'Let\'s talk TEFL for your students' ) ); ?></h2>
					<p class="c26-hero-form-intro"><?php echo esc_html( $tfs_get( 'hero_form_intro' ) ); ?></p>
					<div class="c26-cf7">
						<?php echo do_shortcode( wp_kses_post( $tfs_get( 'hero_form_shortcode', '[contact-form-7 id="04f1bda" title="TEFL for Schools"]' ) ) ); // phpcs:ignore ?>
					</div>
					<p class="c26-hero-form-note"><?php echo esc_html( $tfs_get( 'hero_form_note' ) ); ?></p>
				</div>
			<?php else : ?>
				<div class="c26-hero-media">
					<?php
					$hero_img = get_field( 'c26_hero_image', $pid );
					echo $hero_img ? wp_get_attachment_image( $hero_img, 'large', false, array( 'fetchpriority' => 'high', 'loading' => 'eager' ) ) : get_the_post_thumbnail( $pid, 'large' );
					?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php
	/* Group bookings strip: shown only on courses with the post meta c26_schools_strip (its value is the text). */
	$strip_text = trim( (string) get_post_meta( $pid, 'c26_schools_strip', true ) );
	if ( $strip_text ) :
		$ql_strip   = get_field( 'c26_quote_link', $pid );
		$strip_href = $tfs_form ? '#letsTalkTEFL' : ( ! empty( $ql_strip['url'] ) ? $ql_strip['url'] : '' );
		?>
		<!-- GROUP BOOKINGS STRIP -->
		<aside class="c26-strip" aria-label="Group bookings for schools">
			<div class="c26-strip-inner c26-wrap">
				<span class="c26-strip-icon"><?php echo ti_c26_icon( 'users' ); // phpcs:ignore ?></span>
				<p class="c26-strip-text"><?php echo esc_html( $strip_text ); ?></p>
				<?php if ( $strip_href ) : ?>
					<a class="c26-btn c26-btn--white c26-btn--sm" href="<?php echo esc_url( $strip_href ); ?>">Get in touch</a>
				<?php endif; ?>
			</div>
		</aside>
	<?php endif; ?>

	<!-- STICKY SECTION NAV -->
	<div class="c26-subnav">
		<div class="c26-subnav-inner c26-wrap">
			<nav class="c26-tabs" aria-label="On this page">
				<?php foreach ( $nav as $id => $label ) : ?>
					<a href="#<?php echo esc_attr( $id ); ?>" class="c26-tab" data-c26-jump="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></a>
				<?php endforeach; ?>
			</nav>
			<?php if ( $quote['ok'] ) : ?>
				<div class="c26-subnav-price">
					<span><strong data-c26="now"><?php echo esc_html( $quote['now'] ); ?></strong> <s data-c26="was"><?php echo esc_html( $quote['was'] ); ?></s></span>
					<a href="<?php echo esc_url( $fallback_cart_url ); ?>" class="c26-btn c26-btn--navy c26-btn--sm" data-c26-enrol><?php echo esc_html( $enrol_lb ); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- MAIN + PRICE CARD -->
	<div class="c26-layout c26-wrap">
		<main class="c26-main">
			<?php foreach ( $sections as $s ) { echo $s[1]; } // phpcs:ignore -- escaped above ?>
		</main>

		<aside id="price" class="c26-aside">
			<?php if ( $quote['ok'] ) : ?>
				<div class="c26-price-card" data-c26-price>
					<div class="c26-price-top">
						<div class="c26-price-row">
							<span class="c26-label"><?php echo esc_html( get_field( 'c26_price_kicker', $pid ) ); ?></span>
							<span class="c26-save" data-c26="saving"<?php echo $quote['saving'] ? '' : ' hidden'; ?>><?php echo esc_html( $quote['saving'] ); ?></span>
						</div>
						<div class="c26-price-big"><span data-c26="now"><?php echo esc_html( $quote['now'] ); ?></span><s data-c26="was"><?php echo esc_html( $quote['was'] ); ?></s></div>
					</div>
					<div class="c26-price-body">
						<?php if ( $quote['addons'] ) : ?>
							<div class="c26-label c26-label--rule"><?php echo esc_html( get_field( 'c26_addons_heading', $pid ) ); ?></div>
							<?php foreach ( $quote['addons'] as $aid => $a ) : ?>
								<button type="button" class="c26-addon" data-c26-addon="<?php echo esc_attr( $aid ); ?>" aria-pressed="false">
									<span class="c26-addon-copy"><span class="c26-addon-name"><?php echo esc_html( $a['name'] ); ?></span><span class="c26-addon-price" data-c26-addon-price><?php echo esc_html( $a['price'] . ( $a['save'] ? ' · save ' . $a['save'] : '' ) ); ?></span></span>
									<span class="c26-addon-btn" data-c26-addon-label>+ Add</span>
								</button>
							<?php endforeach; ?>
							<div class="c26-total"><span>Total today</span><strong data-c26="total"><?php echo esc_html( $quote['total'] ); ?></strong></div>
						<?php endif; ?>
						<a href="<?php echo esc_url( $fallback_cart_url ); ?>" class="c26-btn c26-btn--green c26-btn--block" data-c26-enrol><?php echo esc_html( $enrol_lb ); ?> <?php echo ti_c26_icon( 'arrow-right', 'c26-icon c26-icon--sm' ); ?></a>
						<div class="c26-enrol-error" role="alert" hidden></div>
						<?php if ( get_field( 'c26_price_note', $pid ) ) : ?><div class="c26-price-note"><?php echo esc_html( get_field( 'c26_price_note', $pid ) ); ?></div><?php endif; ?>
					</div>
					<?php if ( $end_ms ) : ?>
						<div class="c26-countdown" data-c26-countdown="<?php echo esc_attr( $end_ms ); ?>">
							<div class="c26-label c26-label--green">Offer ends in</div>
							<div class="c26-cd-grid">
								<?php foreach ( array( 'd' => 'Days', 'h' => 'Hours', 'm' => 'Minutes', 's' => 'Seconds' ) as $k => $l ) : ?>
									<div class="c26-cd-cell"><span data-c26-cd="<?php echo esc_attr( $k ); ?>">00</span><small><?php echo esc_html( $l ); ?></small></div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php $ql = get_field( 'c26_quote_link', $pid ); if ( ! empty( $ql['url'] ) ) : ?>
				<div class="c26-quote">
					<?php echo $img( get_field( 'c26_quote_avatar', $pid ), 'thumbnail', 'c26-avatar' ); ?>
					<div><strong><?php echo esc_html( get_field( 'c26_quote_heading', $pid ) ); ?></strong><?php echo ti_c26_link( $ql, 'c26-quote-link' ); // phpcs:ignore ?></div>
				</div>
			<?php endif; ?>
		</aside>
	</div>

	<?php if ( $videos ) : ?>
	<!-- STUDENTS (pinned horizontal scroll on desktop, swipe on mobile) -->
	<section id="students" class="c26-students" data-c26-students>
		<div class="c26-students-pin">
			<div class="c26-students-head c26-wrap">
				<div class="c26-head"><?php echo $kicker( get_field( 'c26_students_kicker', $pid ) ); ?><h2 class="c26-h2 c26-h2--lg"><?php echo esc_html( get_field( 'c26_students_heading', $pid ) ); ?></h2></div>
				<div class="c26-progress" aria-hidden="true"><div data-c26-bar></div></div>
			</div>
			<div class="c26-students-track" data-c26-track>
				<?php foreach ( $videos as $i => $v ) : ?>
					<div class="c26-video">
						<button type="button" class="c26-video-media" <?php echo $v['video'] ? 'data-c26-video="' . esc_attr( $i ) . '"' : 'disabled'; ?> aria-label="<?php echo esc_attr( 'Play video: ' . $v['name'] ); ?>">
							<?php echo $img( $v['image'], 'medium_large' ); ?>
							<?php if ( $v['video'] ) : ?><span class="c26-play"><?php echo ti_c26_icon( 'play', 'c26-icon c26-icon--sm' ); ?></span><?php endif; ?>
						</button>
						<div class="c26-video-name"><?php echo esc_html( $v['name'] ); ?></div>
						<?php if ( $v['video'] ) : ?><template data-c26-video-embed="<?php echo esc_attr( $i ); ?>"><?php echo $v['video']; // phpcs:ignore -- ACF oEmbed output ?></template><?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<dialog class="c26-modal" data-c26-modal aria-label="Student video">
		<button type="button" class="c26-modal-close" data-c26-close aria-label="Close">&times;</button>
		<div class="c26-modal-body" data-c26-modal-body></div>
	</dialog>
	<?php endif; ?>

	<?php if ( $tfs_quotes ) : ?>
	<!-- REVIEWS (from the TEFL for Schools v3 page) -->
	<section id="reviews" class="c26-reviews">
		<div class="c26-wrap">
			<div class="c26-head">
				<?php echo $kicker( $quotes_kicker ? $quotes_kicker : $tfs_get( 'quotes_eyebrow', 'From schools running it' ) ); // phpcs:ignore ?>
				<h2 class="c26-h2 c26-h2--lg"><?php echo esc_html( $quotes_heading ? $quotes_heading : $tfs_get( 'quotes_title', 'What students and schools say' ) ); ?></h2>
			</div>
			<div class="c26-testis">
				<?php foreach ( $tfs_quotes as $q ) :
					if ( empty( $q['quote'] ) ) {
						continue;
					}
					$logo = ! empty( $q['logo'] ) ? wp_get_attachment_image( (int) $q['logo'], 'thumbnail', false, array( 'class' => 'c26-testi-logo', 'loading' => 'lazy', 'alt' => ! empty( $q['role'] ) ? $q['role'] . ' crest' : '' ) ) : '';
					?>
					<figure class="c26-testi<?php echo $logo ? '' : ' c26-testi--nologo'; ?>">
						<?php if ( $logo ) : ?><div class="c26-testi-media"><?php echo $logo; // phpcs:ignore ?></div><?php endif; ?>
						<div>
							<blockquote><p>&ldquo;<?php echo esc_html( $q['quote'] ); ?>&rdquo;</p></blockquote>
							<figcaption>&mdash; <?php echo esc_html( $q['name'] ); ?><?php if ( ! empty( $q['role'] ) ) : ?>, <?php echo esc_html( $q['role'] ); ?><?php endif; ?></figcaption>
						</div>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $faqs ) : ?>
	<!-- FAQ -->
	<section id="faq" class="c26-faq">
		<div class="c26-faq-grid c26-wrap">
			<div class="c26-head">
				<?php echo $rule; ?>
				<h2 class="c26-h2 c26-h2--lg"><?php echo esc_html( get_field( 'c26_faq_heading', $pid ) ); ?></h2>
				<p class="c26-body-text"><?php echo esc_html( get_field( 'c26_faq_intro', $pid ) ); ?></p>
			</div>
			<div class="c26-accordion">
				<?php foreach ( array_values( $faqs ) as $i => $f ) : ?>
					<details class="c26-acc-item"<?php echo 0 === $i ? ' open' : ''; ?>>
						<summary class="c26-faq-q"><?php echo esc_html( wp_strip_all_tags( $f['question'] ) ); ?><span class="c26-chev"><?php echo ti_c26_icon( 'chevron-down' ); ?></span></summary>
						<div class="c26-faq-a"><?php echo wp_kses_post( $f['answer'] ); ?></div>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- CTA BAND -->
	<?php $cta_h = get_field( 'c26_cta_heading', $pid ); if ( $cta_h ) : ?>
	<section class="c26-cta">
		<div class="c26-cta-inner c26-wrap">
			<div class="c26-stack-sm">
				<div class="c26-label c26-label--green"><?php echo esc_html( get_field( 'c26_cta_kicker', $pid ) ? get_field( 'c26_cta_kicker', $pid ) : get_the_title( $pid ) ); ?></div>
				<div class="c26-cta-h"><?php echo esc_html( $cta_h ); ?></div>
			</div>
			<div class="c26-btn-row">
				<a href="#price" class="c26-btn c26-btn--green" data-c26-jump="price"><?php echo esc_html( $enrol_lb ); ?><?php if ( $quote['ok'] ) : ?> · <span data-c26="now"><?php echo esc_html( $quote['now'] ); ?></span><?php endif; ?></a>
				<?php echo ti_c26_link( get_field( 'c26_cta_secondary', $pid ), 'c26-btn c26-btn--ghost' ); // phpcs:ignore ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- DLOPO POPUP: Dlopo's own embed (same code as Dlopo's "Popup Embed"). Plain JavaScript, no PHP. -->
	<script>
	window.dlopoEmbed = {
		mode: "element",
		ownerUsername: "chloe-joomun",
		linkSlug: "intro-call"
	};
	( function () {
		var root = document.getElementById( 'c26' );
		if ( ! root ) {
			return;
		}
		var links = root.querySelectorAll( 'a[href*="dlopo.com"]' );
		if ( ! links.length ) {
			return;
		}
		/* Let Dlopo's embed take over every Dlopo link on the page (e.g. "Request a callback"). */
		for ( var i = 0; i < links.length; i++ ) {
			links[ i ].setAttribute( 'data-dlopo-embed', 'true' );
		}
		/* Load Dlopo's script. Until it has loaded (or if it is blocked), the link opens Dlopo as normal. */
		var ready = false;
		var tag = document.createElement( 'script' );
		tag.src = 'https://dlopo.com/embed.js';
		tag.defer = true;
		tag.onload = function () { ready = true; };
		document.body.appendChild( tag );
		root.addEventListener( 'click', function ( e ) {
			var link = e.target.closest ? e.target.closest( 'a[data-dlopo-embed]' ) : null;
			if ( link && ready ) {
				e.preventDefault(); // Dlopo opens its popup; don't also leave the page.
			}
		} );
	}() );
	</script>

</div>

<?php
get_footer();