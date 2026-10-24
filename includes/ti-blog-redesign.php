<?php
/**
 * TEFL Institute Ã¢â‚¬â€ single blog post redesign (v2)
 * Preview gating, template routing, asset enqueue, ACF config, render helpers.
 * Scoped so the current single-post.php is untouched until go-live.
 *
 * @package teflinstitute
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Should the redesigned blog template be used for the current request?
 * - Admins/editors: add ?redesign=1 (and ?redesign=0 to force the old one).
 * - Anyone with the build/QA preview token: ?redesign=ti2026
 * - Everyone, once go-live option is on.
 */
function ti_use_blog_redesign() {
	if ( ! is_singular( 'post' ) ) {
		return false;
	}
	if ( isset( $_GET['redesign'] ) ) {
		$val = sanitize_text_field( wp_unslash( $_GET['redesign'] ) );
		if ( current_user_can( 'edit_posts' ) ) {
			return '0' !== $val;
		}
		if ( 'ti2026' === $val ) {
			return true;
		}
	}
	return (bool) get_option( 'ti_blog_redesign_live', false );
}

/** Route single posts to the redesign template when active. */
add_filter( 'template_include', function ( $template ) {
	if ( ti_use_blog_redesign() ) {
		$new = get_stylesheet_directory() . '/single-post-redesign.php';
		if ( file_exists( $new ) ) {
			return $new;
		}
	}
	return $template;
}, 99 );

/** Mark the body so scoped CSS can neutralise the theme container. */
add_filter( 'body_class', function ( $classes ) {
	if ( ti_use_blog_redesign() ) {
		$classes[] = 'tibr-active';
	}
	return $classes;
} );

/** Enqueue redesign CSS/JS only when active; drop the old single-post assets to avoid clashes. */
add_action( 'wp_enqueue_scripts', function () {
	$dir = get_stylesheet_directory();
	$uri = get_stylesheet_directory_uri();

	if ( ! ti_use_blog_redesign() ) {
		return;
	}
	wp_dequeue_style( 'ti-single-post-css' );
	wp_dequeue_script( 'ti-single-post-js' );

	$css = $dir . '/assets/css/ti-single-post-redesign.css';
	$js  = $dir . '/assets/js/ti-single-post-redesign.js';
	wp_enqueue_style( 'ti-single-post-redesign', $uri . '/assets/css/ti-single-post-redesign.css', array(), file_exists( $css ) ? filemtime( $css ) : null, 'all' );
	wp_enqueue_script( 'ti-single-post-redesign', $uri . '/assets/js/ti-single-post-redesign.js', array(), file_exists( $js ) ? filemtime( $js ) : null, true );
}, 20 );

/* ------------------------------------------------------------------ ACF ---- */

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title' => 'Blog Redesign Settings',
		'menu_title' => 'Blog Redesign',
		'menu_slug'  => 'blog-redesign-settings',
		'capability' => 'manage_options',
		'icon_url'   => 'dashicons-layout',
		'position'   => 59,
	) );
}

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Per-post options.
	acf_add_local_field_group( array(
		'key'      => 'group_ti_blog_redesign_post',
		'title'    => 'Blog post redesign',
		'fields'   => array(
			array(
					'key'           => 'field_tibr_sidebar_tools',
					'label'         => 'Sidebar tools (tick two)',
					'name'          => 'sidebar_tools',
					'type'          => 'checkbox',
					'choices'       => array(
						'salary'     => 'TEFL salary calculator',
						'level'      => 'English level test',
						'finder'     => 'Course finder',
						'prospectus' => 'Study prospectus (guide download)',
					),
					'default_value' => array( 'salary', 'prospectus' ),
					'layout'        => 'vertical',
					'instructions'  => 'Tick exactly two tools to show in the sidebar. First in the list above gets the "Best for this guide" badge. Defaults to Salary + Study prospectus.',
				),
			array(
				'key'           => 'field_tibr_show_wire',
				'label'         => 'Show inline Hire Wire signup',
				'name'          => 'show_hire_wire',
				'type'          => 'true_false',
				'ui'            => 1,
				'default_value' => 1,
			),
			array(
				'key'           => 'field_tibr_show_promo',
				'label'         => 'Show promo strip (under-hero banner)',
				'name'          => 'show_promo_strip',
				'type'          => 'true_false',
				'ui'            => 1,
				'default_value' => 1,
			),
			array(
				'key'           => 'field_tibr_promo_style',
				'label'         => 'Promo strip style',
				'name'          => 'promo_strip_style',
				'type'          => 'select',
				'choices'       => array( 'steady' => 'Steady', 'scrolling' => 'Scrolling' ),
				'default_value' => 'steady',
				'conditional_logic' => array(
					array(
						array( 'field' => 'field_tibr_show_promo', 'operator' => '==', 'value' => '1' ),
					),
				),
			),
			array(
				'key'          => 'field_tibr_intro',
				'label'        => 'Intro / lead paragraph (optional)',
				'name'         => 'blog_intro',
				'type'         => 'textarea',
				'rows'         => 3,
				'instructions' => 'Shown as the large lead paragraph. If blank, the first paragraph of the content is used.',
			),
			array(
				'key'        => 'field_tibr_takeaways',
				'label'      => 'Key takeaways (optional)',
				'name'       => 'key_takeaways',
				'type'       => 'repeater',
				'layout'     => 'table',
				'button_label' => 'Add takeaway',
				'sub_fields' => array(
					array(
						'key'   => 'field_tibr_takeaway_text',
						'label' => 'Takeaway',
						'name'  => 'text',
						'type'  => 'text',
					),
				),
			),
		),
		'location' => array(
			array(
				array( 'param' => 'post_type', 'operator' => '==', 'value' => 'post' ),
			),
		),
		'menu_order' => 0,
		'position'   => 'side',
	) );

	// Global options.
	acf_add_local_field_group( array(
		'key'      => 'group_ti_blog_redesign_options',
		'title'    => 'Blog Redesign Ã¢â‚¬â€ global settings',
		'fields'   => array(
			array( 'key' => 'field_tibr_o_salary_url', 'label' => 'Salary calculator URL', 'name' => 'tibr_salary_url', 'type' => 'url' ),
			array( 'key' => 'field_tibr_o_level_url', 'label' => 'English level test URL', 'name' => 'tibr_level_url', 'type' => 'url' ),
			array( 'key' => 'field_tibr_o_finder_url', 'label' => 'Course finder URL', 'name' => 'tibr_finder_url', 'type' => 'url' ),
			array( 'key' => 'field_tibr_o_prospectus_url', 'label' => 'Prospectus download URL', 'name' => 'tibr_prospectus_url', 'type' => 'url' ),
			array( 'key' => 'field_tibr_o_cta_url', 'label' => 'Main CTA / Browse courses URL', 'name' => 'tibr_cta_url', 'type' => 'url' ),
			array( 'key' => 'field_tibr_o_guides_url', 'label' => 'See all country guides URL', 'name' => 'tibr_guides_url', 'type' => 'url' ),
			array( 'key' => 'field_tibr_o_promo_link', 'label' => 'Promo strip link', 'name' => 'tibr_promo_link', 'type' => 'url' ),
			array( 'key' => 'field_tibr_o_promo_pill', 'label' => 'Promo strip pill text', 'name' => 'tibr_promo_pill', 'type' => 'text' ),
			array( 'key' => 'field_tibr_o_promo_title', 'label' => 'Promo strip title', 'name' => 'tibr_promo_title', 'type' => 'text' ),
			array( 'key' => 'field_tibr_o_promo_sub', 'label' => 'Promo strip subtitle', 'name' => 'tibr_promo_sub', 'type' => 'text' ),
			array( 'key' => 'field_tibr_o_promo_cta', 'label' => 'Promo strip button text', 'name' => 'tibr_promo_cta', 'type' => 'text' ),
			array( 'key' => 'field_tibr_o_wire_action', 'label' => 'Hire Wire form action URL', 'name' => 'tibr_wire_action', 'type' => 'url' ),
				array( 'key' => 'field_tibr_o_team_url', 'label' => 'Author "More from" link (Meet the Team)', 'name' => 'tibr_team_url', 'type' => 'url' ),
		),
		'location' => array(
			array(
				array( 'param' => 'options_page', 'operator' => '==', 'value' => 'blog-redesign-settings' ),
			),
		),
	) );
} );

/** Read a global redesign option with a placeholder fallback. */
function tibr_opt( $name, $fallback = '' ) {
	$v = function_exists( 'get_field' ) ? get_field( $name, 'option' ) : '';
	return ( $v !== '' && $v !== null && false !== $v ) ? $v : $fallback;
}

/* --------------------------------------------------------------- Icons ---- */
/** Minimal inline Lucide-style icons (avoids loading the Lucide JS lib). */
function tibr_icon( $name, $size = 20 ) {
	$paths = array(
		'calculator'     => '<rect width="16" height="20" x="4" y="2" rx="2"/><line x1="8" x2="16" y1="6" y2="6"/><line x1="8" x2="8" y1="14" y2="14"/><line x1="12" x2="12" y1="14" y2="14"/><line x1="16" x2="16" y1="14" y2="14"/><line x1="8" x2="8" y1="18" y2="18"/><line x1="12" x2="12" y1="18" y2="18"/><line x1="16" x2="16" y1="18" y2="18"/>',
		'graduation-cap' => '<path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>',
		'compass'        => '<circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/>',
		'download'       => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/>',
		'arrow-right'    => '<line x1="5" x2="19" y1="12" y2="12"/><polyline points="12 5 19 12 12 19"/>',
		'headphones'     => '<path d="M3 14h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7a9 9 0 0 1 18 0v7a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3"/>',
		'play'           => '<polygon points="6 3 20 12 6 21 6 3"/>',
		'facebook'       => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
		'twitter'        => '<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>',
		'linkedin'       => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/>',
		'link'           => '<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>',
	);
	$body = isset( $paths[ $name ] ) ? $paths[ $name ] : '';
	$fill = ( 'facebook' === $name || 'twitter' === $name || 'play' === $name ) ? 'currentColor' : 'none';
	$stroke = ( 'currentColor' === $fill && 'play' !== $name ) ? '' : ' stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"';
	if ( 'play' === $name ) { $fill = 'currentColor'; $stroke = ''; }
	return '<svg xmlns="http://www.w3.org/2000/svg" width="' . (int) $size . '" height="' . (int) $size . '" viewBox="0 0 24 24" fill="' . $fill . '"' . $stroke . '>' . $body . '</svg>';
}

/* -------------------------------------------------------- Sidebar cards ---- */
/**
 * Render exactly two chosen lead-tool cards (tool 1 on top with the badge).
 */
function tibr_render_tool_cards( $tools = array( 'salary', 'prospectus' ) ) {
	$valid = array( 'salary', 'level', 'finder', 'prospectus' );
	if ( ! is_array( $tools ) ) { $tools = array( $tools ); }
	// Keep valid & unique, in canonical order (salary, level, finder, prospectus).
	$tools = array_values( array_unique( array_intersect( $valid, $tools ) ) );
	if ( count( $tools ) < 2 ) {
		foreach ( array( 'salary', 'prospectus', 'level', 'finder' ) as $d ) {
			if ( ! in_array( $d, $tools, true ) ) { $tools[] = $d; }
			if ( count( $tools ) >= 2 ) { break; }
		}
	}
	$tools   = array_slice( $tools, 0, 2 );
	$tpl_dir = get_stylesheet_directory_uri() . '/assets/img/blog-redesign';
	$out  = tibr_tool_card( $tools[0], 'Best for this guide', $tpl_dir );
	$out .= tibr_tool_card( $tools[1], 'Free', $tpl_dir );
	return $out;
}

function tibr_tool_card( $key, $badge, $img ) {
	$arrow = '<span class="tibr-arrow">' . tibr_icon( 'arrow-right', 18 ) . '</span>';
	ob_start();
	if ( 'salary' === $key ) :
		$url = tibr_opt( 'tibr_salary_url', 'https://teflinstitute.com/teaching-english-online-salary-calculator/' ); ?>
		<a class="tibr-card tibr-card--salary" href="<?php echo esc_url( $url ); ?>">
			<div class="tibr-card__top">
				<span class="tibr-card__icon"><?php echo tibr_icon( 'calculator', 26 ); ?></span>
				<span class="tibr-card__badge"><?php echo esc_html( $badge ); ?></span>
			</div>
			<p class="tibr-card__label">TEFL salary calculator</p>
			<h3 class="tibr-card__title">Interested in teaching English? See how much you can earn</h3>
			<div class="tibr-ticker" data-tibr-ticker>
				<div class="tibr-ticker__item is-on"><span class="tibr-ticker__place">Spain</span><span class="tibr-ticker__fig">&euro;800&ndash;&euro;1,000</span><span class="tibr-ticker__cap">a month &middot; language assistant</span></div>
				<div class="tibr-ticker__item"><span class="tibr-ticker__place">Thailand</span><span class="tibr-ticker__fig">Up to US$1,200</span><span class="tibr-ticker__cap">a month &middot; TEFL internship</span></div>
				<div class="tibr-ticker__item"><span class="tibr-ticker__place">Online</span><span class="tibr-ticker__fig">US$10.20</span><span class="tibr-ticker__cap">an hour &middot; Cambly published rate</span></div>
				<div class="tibr-ticker__item"><span class="tibr-ticker__place">Germany</span><span class="tibr-ticker__fig">&euro;75</span><span class="tibr-ticker__cap">a week &middot; summer placement</span></div>
			</div>
			<span class="tibr-card__cta tibr-card__cta--accent">Calculate my salary <?php echo $arrow; ?></span>
		</a>
	<?php elseif ( 'level' === $key ) :
		$url = tibr_opt( 'tibr_level_url', 'https://teflinstitute.com/test-your-english-level-free-online/' ); ?>
		<a class="tibr-card tibr-card--level" href="<?php echo esc_url( $url ); ?>">
			<div class="tibr-card__top">
				<span class="tibr-card__icon"><?php echo tibr_icon( 'graduation-cap', 26 ); ?></span>
				<span class="tibr-card__badge"><?php echo esc_html( $badge ); ?></span>
			</div>
			<p class="tibr-card__label">Free English level test</p>
			<h3 class="tibr-card__title">Find out which TEFL course suits your level of English</h3>
			<div class="tibr-cefr"><span>A1</span><span>A2</span><span>B1</span><span>B2</span><span>C1</span><span>C2</span></div>
			<div class="tibr-levelbar"><i></i></div>
			<p class="tibr-card__caption">20 questions &middot; about 10 minutes</p>
			<span class="tibr-card__cta tibr-card__cta--dark">Take the free test <?php echo $arrow; ?></span>
		</a>
	<?php elseif ( 'finder' === $key ) :
		$url = tibr_opt( 'tibr_finder_url', 'https://teflinstitute.com/tefl-courses-overview/' ); ?>
		<a class="tibr-card tibr-card--finder" href="<?php echo esc_url( $url ); ?>">
			<div class="tibr-card__top">
				<span class="tibr-card__icon"><?php echo tibr_icon( 'compass', 26 ); ?></span>
				<span class="tibr-card__badge"><?php echo esc_html( $badge ); ?></span>
			</div>
			<p class="tibr-card__label">TEFL course finder</p>
			<h3 class="tibr-card__title">Find your TEFL course based on your skills</h3>
			<div class="tibr-finder">
				<div class="tibr-finder__row"><span>I am a</span><strong>Sixth former</strong></div>
				<div class="tibr-finder__row"><span>I want to</span><strong>Take a gap year</strong></div>
				<div class="tibr-finder__row"><span>I have</span><strong>A levels</strong></div>
				<div class="tibr-finder__row tibr-finder__row--match"><span>Your match</span><strong>120 Hour TEFL &rarr;</strong></div>
			</div>
			<span class="tibr-card__cta tibr-card__cta--accent">Find my course <?php echo $arrow; ?></span>
		</a>
	<?php else :
		$url = tibr_opt( 'tibr_prospectus_url', '#' ); ?>
		<a class="tibr-card tibr-card--prospectus" href="<?php echo esc_url( $url ); ?>">
			<div class="tibr-card__top">
				<p class="tibr-card__label">Free download &middot; PDF</p>
				<span class="tibr-card__badge"><?php echo esc_html( $badge ); ?></span>
			</div>
			<div class="tibr-fan">
				<img class="tibr-fan__p2" src="<?php echo esc_url( $img . '/classroom-selfie.jpg' ); ?>" alt="">
				<img class="tibr-fan__p1" src="<?php echo esc_url( $img . '/thailand-elephants.jpg' ); ?>" alt="">
				<img class="tibr-fan__cover" src="<?php echo esc_url( $img . '/prospectus-cover.png' ); ?>" alt="TEFL Institute study prospectus">
			</div>
			<h3 class="tibr-card__title">Download the TEFL study prospectus</h3>
			<p class="tibr-card__caption">Every course we offer, with accreditation and prices.</p>
			<span class="tibr-card__cta tibr-card__cta--dark">Download free <?php echo tibr_icon( 'download', 18 ); ?></span>
		</a>
	<?php endif;
	return ob_get_clean();
}

/* ----------------------------------------------- Key takeaways style ---- */
/** Wrap a "Key takeaways" heading + its following list (authored in post content) in the cream box. */
function tibr_style_takeaways( $html ) {
	return preg_replace_callback(
		'/<h[1-6]\b[^>]*>\s*key\s*takeaways\s*<\/h[1-6]>\s*(<ul\b[^>]*>.*?<\/ul>)/is',
		function ( $m ) {
			return '<div class="tibr-takeaways"><p class="tibr-eyebrow">Key takeaways</p>' . $m[1] . '</div>';
		},
		$html
	);
}

/* ------------------------------------------------- Mid-content inject ---- */
/** Insert an HTML block roughly halfway through post content, after a paragraph boundary. */
function tibr_inject_midpoint( $html, $insert ) {
	$chunks = explode( '</p>', $html );
	$n = count( $chunks );
	if ( $n < 3 ) {
		return $html . $insert; // Too few paragraphs Ã¢â‚¬â€ append at the end.
	}
	$mid = intdiv( $n, 2 );
	$chunks[ $mid ] = $insert . $chunks[ $mid ];
	return implode( '</p>', $chunks );
}

/* ------------------------------------------------------------ Related ---- */
/** Query up to 3 related posts sharing the current post's primary category. */
function tibr_related_posts( $post_id, $count = 3 ) {
	$cats = wp_get_post_categories( $post_id );
	if ( empty( $cats ) ) {
		return array();
	}
	$q = new WP_Query( array(
		'post_type'           => 'post',
		'posts_per_page'      => $count,
		'post__not_in'        => array( $post_id ),
		'category__in'        => $cats,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
		'orderby'             => 'date',
		'order'               => 'DESC',
	) );
	return $q->posts;
}
