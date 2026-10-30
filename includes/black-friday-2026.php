<?php
/**
 * Black Friday Landing Page 2026 — functions & ACF helpers
 *
 * Loaded from functions.php. Goes with:
 *   black-friday-landing-page-2026.php               (the page template, theme root)
 *   assets/css/black-friday-landing-page-2026.css
 *   assets/js/black-friday-landing-page-2026.js
 *   assets/img/black-friday-2026/                    (hero cut-out, world map)
 *
 * The ACF field group "Black Friday 2026" (key group_6adc86c0a1f16) is managed
 * in the ACF plugin (Custom Fields > Field Groups) and synced to acf-json. Each
 * page section is a top-level tab + a "group" field:
 *   - banner_section  — the hero
 *   - accred_strip    — the "Accredited & regulated" strip
 * bf26_data() merges those group values into one flat array keyed by sub-field
 * name, so templates read any field with bf26_get()/bf26_rows() regardless of
 * which section group it lives in. Every field falls back to bf26_defaults(),
 * so the page renders in full before anything is saved. Prefixed bf26_.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'BF26_TEMPLATE', 'black-friday-landing-page-2026.php' );
define( 'BF26_GROUP_KEY', 'group_6adc86c0a1f16' );   // the "Black Friday 2026" field group

/** The section "group" fields whose sub-values are merged for the template. */
function bf26_section_groups() {
	return array( 'banner_section', 'accred_strip', 'sale_countdown', 'course_section', 'gift_section', 'review_section', 'whyus_section', 'faq_section', 'bf26_follow' );
}

/* =========================================================================
 * Default content — the page renders fully before any field is saved.
 * ====================================================================== */
function bf26_defaults() {
	static $d = null;
	if ( null !== $d ) {
		return $d;
	}

	$d = array(

		/* ---------- Hero: departures board ---------- */
		'hero_board_status' => 'DEPARTURES',
		'hero_board_gate'   => 'TEFL GATE · NOW BOARDING',
		'hero_board_text'   => 'BLACK FRIDAY IS LIVE',

		/* ---------- Hero: headline ---------- */
		'hero_title_line1'  => 'Black',
		'hero_title_line2'  => 'Friday.',
		'hero_off_pre'      => "TEFL courses\nup to",
		'hero_off_big'      => '82%',
		'hero_off_post'     => 'off',
		'hero_lead'         => 'Fully accredited, Ofqual-regulated TEFL courses at the lowest prices of the year. Teach abroad, online, or add a qualification to your CV. <strong>No teaching experience needed.</strong>',

		/* ---------- Hero: free gifts pill ---------- */
		'hero_gift_title'    => '+ 6 Free Gifts with every course',
		'hero_gift_subtitle' => 'AI module, Travel Influencer course and 4 teaching guides',
		'hero_gift_link'     => '#free-gifts',

		/* ---------- Hero: CTAs ---------- */
		/* Primary CTA ("Shop the sale") links to the #courses section automatically. */
		'hero_cta_primary_label'   => 'Shop the sale',
		'hero_cta_secondary_label' => 'Take the English test',
		'hero_cta_secondary_url'   => '#',

		/* ---------- Hero: art ---------- */
		'hero_image'       => '', // falls back to the theme asset below
		'hero_badge_pre'   => 'UP TO',
		'hero_badge_num'   => '82%',
		'hero_badge_post'  => 'OFF',
		'hero_floats'      => array(
			array( 'icon' => 'globe',        'label' => 'Teach Worldwide' ),
			array( 'icon' => 'shield-check', 'label' => 'Ofqual Level 5' ),
			array( 'icon' => 'laptop',       'label' => 'Teach Online' ),
		),
		'hero_bundle_label' => 'ULTIMATE BUNDLE',
		'hero_bundle_price' => '€287',
		'hero_bundle_was'   => '€1,595',

		/* ---------- Accredited & regulated strip ---------- */
		'accred_label' => 'ACCREDITED & REGULATED BY',
		'accred_items' => array(
			array( 'name' => 'Highfield', 'sub' => 'Approved Centre' ),
			array( 'name' => 'Ofqual',    'sub' => 'Regulated' ),
			array( 'name' => 'OTCAC',     'sub' => 'Accredited' ),
			array( 'name' => 'DEAC',      'sub' => 'Approved' ),
			array( 'name' => 'AQC',       'sub' => 'Quality Curriculum' ),
		),

		/* ---------- Sale countdown ---------- */
		'sale_show'          => true,
		'sale_label'         => 'SALE ENDS IN',
		'sale_end'           => '2026-11-30 23:59:59', // parsed with strtotime(); counts down to this moment
		'sale_end_note'      => '30 November, midnight',
		'sale_places_strong' => '59 places',
		'sale_places_text'   => 'left at this price',

		/* ---------- Course cards ---------- */
		'course_eyebrow'    => 'CHOOSE YOUR COURSE',
		'course_title_pre'  => 'Four ways to ',
		'course_title_em'   => 'SAVE',
		'course_title_post' => ' this Black Friday.',
		'course_note'       => 'All prices include certificate, tutor support and app access.',
		'course_cards'      => array(
			array(
				'variant'  => 'standard',
				'save'     => '63%',
				'category' => 'ENTRY LEVEL',
				'cat_icon' => 'book-open',
				'image'    => 'course-120-online-teacher.png',
				'title'    => '120 Hour Advanced TEFL Course',
				'price'    => '€145',
				'was'      => '€395',
				'klarna'   => true,
				'features' => array(
					array( 'icon' => 'clock',  'text' => 'Certified in 2–4 weeks' ),
					array( 'icon' => 'plane',  'text' => 'For first-time teachers and travellers' ),
					array( 'icon' => 'globe',  'text' => 'Accepted by employers worldwide' ),
					array( 'icon' => 'users',  'text' => 'Tutor support and live mentorship' ),
				),
				'cta_label' => 'Enrol now',
				'cta_url'   => '#',
			),
			array(
				'variant'  => 'standard',
				'save'     => '72%',
				'category' => 'MOST POPULAR',
				'cat_icon' => 'award',
				'image'    => 'course-180-kids-classroom.png',
				'title'    => '180-Hour Level 5 TEFL Course',
				'price'    => '€195',
				'was'      => '€695',
				'klarna'   => true,
				'features' => array(
					array( 'icon' => 'shield-check', 'text' => 'Ofqual-regulated, awarded by Highfield' ),
					array( 'icon' => 'star',         'text' => 'CELTA-equivalent qualification' ),
					array( 'icon' => 'users',        'text' => 'Personal tutor and live mentorship' ),
					array( 'icon' => 'briefcase',    'text' => 'Jobs board access' ),
				),
				'cta_label' => 'Enrol now',
				'cta_url'   => '#',
			),
			array(
				'variant'  => 'standard',
				'save'     => '73%',
				'category' => 'PROFESSIONAL',
				'cat_icon' => 'graduation-cap',
				'image'    => 'course-300-class-group.png',
				'title'    => '300-Hour Level 5 TEFL Diploma',
				'price'    => '€245',
				'was'      => '€895',
				'klarna'   => true,
				'features' => array(
					array( 'icon' => 'file-badge', 'text' => 'Our most comprehensive diploma' ),
					array( 'icon' => 'book-open',  'text' => 'Specialist modules built in' ),
					array( 'icon' => 'briefcase',  'text' => 'For higher-paying roles' ),
					array( 'icon' => 'life-buoy',  'text' => 'Lifetime tutor support' ),
				),
				'cta_label' => 'Enrol now',
				'cta_url'   => '#',
			),
			array(
				'variant'  => 'bundle',
				'save'     => '82%',
				'category' => 'BEST DEAL',
				'cat_icon' => 'gift',
				'image'    => 'course-bundle-selfie.png',
				'title'    => 'Ultimate Black Friday Bundle',
				'price'    => '€287',
				'was'      => '€1,595',
				'klarna'   => true,
				'features' => array(
					array( 'icon' => 'award',     'text' => '180-Hour Level 5 TEFL Course' ),
					array( 'icon' => 'laptop',    'text' => 'Teaching Online + Business English' ),
					array( 'icon' => 'book-open', 'text' => 'Advanced Grammar, IELTS, Young Learners, Yoga for Children' ),
					array( 'icon' => 'clock',     'text' => 'Express marking' ),
				),
				'cta_label' => 'Get the bundle',
				'cta_url'   => '#',
			),
		),
		'course_free_title_pre' => 'Still not sure? ',
		'course_free_title_em'  => 'Try these for free.',
		'course_free_tiles'     => array(
			array( 'icon' => 'briefcase', 'label' => 'Calculate Your Salary', 'url' => '#' ),
			array( 'icon' => 'book-open', 'label' => 'Free English Level Test', 'url' => '#' ),
			array( 'icon' => 'file-badge', 'label' => 'Download Brochure', 'url' => '#' ),
		),

		/* ---------- Free gifts ---------- */
		'gifts_board_status' => 'ARRIVALS',
		'gifts_board_gate'   => 'WITH ANY COURSE',
		'gifts_board_text'   => '6 FREE GIFTS',
		'gifts_title_pre'    => 'Open your ',
		'gifts_title_em'     => 'free gifts.',
		'gifts_intro'        => 'Tap each suitcase to unzip it and see what\'s inside. Enrol in any primary course (120–310 hours) and all six are yours.',
		'gifts_opened_label' => 'OPENED',
		'gifts_open_all'     => 'Open all',
		'gifts_rewrap'       => 'Re-wrap',
		'gifts'              => array(
			array( 'name' => 'AI Module', 'image' => 'https://teflinstitute.com/wp-content/uploads/2024/01/AI.png', 'c1' => '#D7263D', 'c2' => '#8E1626' ),
			array( 'name' => 'Travel Influencer Launchpad Course', 'image' => 'https://teflinstitute.com/wp-content/uploads/2026/04/travel-influencer-tefl-insitute-300x300.jpg', 'c1' => '#E3B341', 'c2' => '#C99A2E' ),
			array( 'name' => 'Grammar Guide', 'image' => 'https://teflinstitute.com/wp-content/uploads/2025/01/TI_grammar_guide.png', 'c1' => '#2A2A2A', 'c2' => '#3A3A3A' ),
			array( 'name' => 'Lesson Planning Guide', 'image' => 'https://teflinstitute.com/wp-content/uploads/2025/01/TI_lesson_planning_guide.png', 'c1' => '#D7263D', 'c2' => '#8E1626' ),
			array( 'name' => 'Teaching Young Learners Lesson Pack', 'image' => 'https://teflinstitute.com/wp-content/uploads/2022/11/young-learners.png', 'c1' => '#E3B341', 'c2' => '#C99A2E' ),
			array( 'name' => 'Teaching Business English Lesson Pack', 'image' => 'https://teflinstitute.com/wp-content/uploads/2022/11/business-english.png', 'c1' => '#2A2A2A', 'c2' => '#3A3A3A' ),
		),
		'gifts_banner_strong' => 'All 6 cases unpacked.',
		'gifts_banner_text'   => 'They\'re yours free with any course.',
		'gifts_banner_cta'    => 'Claim my gifts',
		'gifts_banner_url'    => '#',

		/* ---- Reviews & stats ----
		 * The Trustpilot stat's rating + count are pulled live (bf26_live_trustpilot).
		 * The three stats below are the editable repeater defaults. */
		'stats'               => array(
			array( 'num' => '90+',     'label' => 'countries where our graduates teach' ),
			array( 'num' => 'Level 5', 'label' => 'Ofqual-regulated, awarded by Highfield' ),
			array( 'num' => 'Lifetime','label' => 'tutor support and jobs board access' ),
		),
		'tp_rating'           => '4.9',
		'tp_count'            => '1,900',
		'review_quote'        => 'An amazing TEFL course! The lessons were clear, practical, and very comprehensive. I learned so much and now feel confident and excited to begin my journey as an English teacher.',
		'review_author'       => 'Miriam Danso-Kumi',
		'review_role'         => 'TEFL graduate',
		'review_title_pre'    => 'Your first ',
		'review_title_em'     => 'classroom',
		'review_title_post'   => ' is closer than you think.',
		'review_cta_label'    => 'Claim up to 82% off',
		'review_cta_url'      => '#',

		/* ---- Why choose us ---- */
		'whyus_eyebrow'       => 'WHY US?',
		'whyus_title_pre'     => 'Why choose ',
		'whyus_title_em'      => 'our',
		'whyus_title_post'    => ' training.',
		'whyus_intro'         => 'With 10+ years of experience and thousands of graduates teaching in 90+ countries, TEFL Institute gives you everything from your first lesson plan to your first TEFL job.',
		'whyus_cards'         => array(
			array( 'icon' => 'shield-check',  'title' => 'Accredited',             'text' => 'Ofqual-regulated Level 5 qualifications, awarded by Highfield and recognised worldwide.' ),
			array( 'icon' => 'life-buoy',     'title' => 'Lifetime Support',        'text' => 'Tutors and our student team stay with you long after you finish the course.' ),
			array( 'icon' => 'laptop',        'title' => 'Learn on Any Device',     'text' => 'Study at your own pace on laptop, tablet or phone through our app.' ),
			array( 'icon' => 'calendar-days', 'title' => 'Flexible Payment Plans',  'text' => 'Spread the cost of your course with interest-free instalments.' ),
			array( 'icon' => 'briefcase',     'title' => 'Jobs Board Access',       'text' => 'Find teaching roles online and abroad with schools that know our graduates.' ),
		),

		/* ---- FAQ ---- */
		'faq_eyebrow'         => 'FAQS',
		'faq_title_pre'       => 'Frequently asked ',
		'faq_title_em'        => 'questions',
		'faq_title_post'      => '',
		'faqs'                => array(
			array( 'q' => 'Are your TEFL courses accredited?', 'a' => 'Yes — our courses are Ofqual-regulated Level 5 qualifications awarded by Highfield and recognised by employers and schools worldwide.' ),
			array( 'q' => 'Do I need a degree or teaching experience?', 'a' => 'No. Our courses are designed for complete beginners as well as experienced teachers looking to formalise their skills with a recognised qualification.' ),
			array( 'q' => 'How long do I have to complete my course?', 'a' => 'You study at your own pace with lifetime access, so there is no deadline. Most learners finish a 120-hour course in around 2–4 weeks.' ),
			array( 'q' => 'Will this help me get a teaching job?', 'a' => 'Yes — you get access to our jobs board plus guidance from our student team to help you find teaching roles online and abroad.' ),
			array( 'q' => 'Can I pay in instalments?', 'a' => 'Yes. You can spread the cost with interest-free payment plans at checkout through Klarna.' ),
			array( 'q' => 'When does the Black Friday offer end?', 'a' => 'The sale runs until 30 November at midnight. Enrol before then to lock in up to 82% off plus your 6 free gifts.' ),
		),

		/* ---- Follow the journey (social) ----
		 * Namespaced "follow_*" because the site already has a social_section /
		 * social_links field group that would otherwise win ACF name resolution. */
		'follow_eyebrow'      => 'FOLLOW THE JOURNEY',
		'follow_links'        => array(
			array( 'icon' => 'facebook',  'url' => 'https://www.facebook.com/theteflinstitute/' ),
			array( 'icon' => 'instagram', 'url' => 'https://www.instagram.com/theteflinstitute' ),
			array( 'icon' => 'tiktok',    'url' => '#' ),
			array( 'icon' => 'youtube',   'url' => '#' ),
			array( 'icon' => 'linkedin',  'url' => 'https://www.linkedin.com/company/tefl-institute-ireland/' ),
		),
	);

	return $d;
}

/** The course (course CPT) selected on a card. */
function bf26_card_course_id( $card ) {
	if ( empty( $card['course'] ) ) {
		return 0;
	}
	$c = $card['course'];
	if ( is_array( $c ) ) {
		return (int) ( $c['ID'] ?? 0 );
	}
	if ( is_object( $c ) ) {
		return (int) ( isset( $c->ID ) ? $c->ID : 0 );
	}
	return (int) $c;
}

/**
 * The WooCommerce product behind a card's course — read from the course's own
 * "course_product" meta (the site convention; see ti-homepage-template-2024).
 */
function bf26_card_product_id( $card ) {
	$course_id = bf26_card_course_id( $card );
	if ( ! $course_id ) {
		return 0;
	}
	return (int) get_post_meta( $course_id, 'course_product', true );
}

/**
 * Resolve a card's price / was-price / save-% from the chosen course's linked
 * product. Everything is live from WooCommerce (regular/sale price); a course
 * with no linked product simply shows no price.
 * Returns [ 'price' => html, 'was' => html, 'save' => '63%' ].
 */
function bf26_card_pricing( $card ) {
	$price = '';
	$was   = '';
	$save  = '';

	$product_id = bf26_card_product_id( $card );

	if ( $product_id && function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( $product_id );
		if ( $product ) {
			$reg  = (float) $product->get_regular_price();
			$sale = (float) $product->get_sale_price();
			$cur  = $sale ? $sale : (float) $product->get_price();
			if ( $cur ) {
				$price = function_exists( 'wc_price' ) ? wc_price( $cur ) : $cur;
			}
			if ( $reg && $reg > $cur ) {
				$was  = function_exists( 'wc_price' ) ? wc_price( $reg ) : $reg;
				$save = round( ( ( $reg - $cur ) / $reg ) * 100 ) . '%';
			}
		}
	}

	return array( 'price' => $price, 'was' => $was, 'save' => $save );
}

/**
 * Resolve a course card image to a URL. Accepts an ACF image (array or id),
 * a full URL, or a bare filename that lives in the theme's BF-2026 image dir.
 */
function bf26_card_image( $card ) {
	$img = isset( $card['image'] ) ? $card['image'] : '';
	if ( is_array( $img ) && ! empty( $img['url'] ) ) {
		return $img['url'];
	}
	if ( is_numeric( $img ) ) {
		$url = wp_get_attachment_image_url( (int) $img, 'large' );
		if ( $url ) {
			return $url;
		}
	}
	if ( is_string( $img ) && '' !== $img ) {
		if ( 0 === strpos( $img, 'http' ) || false !== strpos( $img, '/' ) ) {
			return $img;
		}
		return get_stylesheet_directory_uri() . '/assets/img/black-friday-2026/' . $img;
	}
	return '';
}

/** First "<n> hour" figure found in a string (e.g. "180-Hour Level 5" -> 180). */
function bf26_course_hours( $text ) {
	if ( preg_match( '/(\d{2,4})\s*[- ]?\s*hour/i', (string) $text, $m ) ) {
		return (int) $m[1];
	}
	return 0;
}

/**
 * Work out a card's button link + label from the chosen course:
 *   - 180-hour and 300-hour courses  -> the course page
 *   - every other course             -> add the course's product to the cart
 *     (falling back to the course page when it isn't directly purchasable)
 * The bundle card keeps a manually-entered link (cta_url).
 * Returns [ 'url' => ..., 'label' => ... ].
 */
function bf26_card_cta( $card ) {
	$variant = ( isset( $card['variant'] ) && 'bundle' === $card['variant'] ) ? 'bundle' : 'standard';
	$label   = ! empty( $card['cta_label'] ) ? $card['cta_label'] : ( 'bundle' === $variant ? 'Get the bundle' : 'Enrol now' );

	// Bundle: manual link field.
	if ( 'bundle' === $variant ) {
		return array( 'url' => ! empty( $card['cta_url'] ) ? $card['cta_url'] : '#', 'label' => $label );
	}

	$course_id  = bf26_card_course_id( $card );
	$product_id = bf26_card_product_id( $card );

	if ( $course_id ) {
		$hours = bf26_course_hours( get_the_title( $course_id ) . ' ' . ( isset( $card['title'] ) ? $card['title'] : '' ) );
		// 180-hour and 300-hour courses go straight to their course page.
		if ( in_array( $hours, array( 180, 300 ), true ) ) {
			return array( 'url' => get_permalink( $course_id ), 'label' => $label );
		}
		// Otherwise add the course's product to the cart when it can be.
		if ( $product_id && function_exists( 'wc_get_product' ) ) {
			$product = wc_get_product( $product_id );
			if ( $product && $product->is_purchasable() && ! $product->is_type( 'variable' ) && ! $product->is_type( 'external' ) ) {
				// Site's own cart handler (see includes/tefl-course-variation-date.php).
				return array( 'url' => '/?addtimetocart&prid=' . (int) $product_id, 'label' => $label );
			}
		}
		// No purchasable product: send them to the course page.
		return array( 'url' => get_permalink( $course_id ), 'label' => $label );
	}

	// No course chosen yet: fall back to the manual link (defaults to '#').
	return array( 'url' => ! empty( $card['cta_url'] ) ? $card['cta_url'] : '#', 'label' => $label );
}

/**
 * The "Learn more" URL for a card — the chosen course's page.
 * Returns '' when there's nothing to link to (so the button is hidden).
 */
function bf26_card_learn_url( $card ) {
	$course_id = bf26_card_course_id( $card );
	if ( $course_id ) {
		$url = get_permalink( $course_id );
		if ( $url ) {
			return $url;
		}
	}
	// No course (e.g. a bundle linked only by URL): use the manual link if real.
	if ( ! empty( $card['cta_url'] ) && '#' !== $card['cta_url'] ) {
		return $card['cta_url'];
	}
	return '';
}

/**
 * Sale end as an ISO-8601 string the browser's Date() can parse reliably.
 * Linked to the site-wide Global Timer ("Timer Expiry", option: timer_expiry),
 * so the countdown stays in sync with the rest of the site. Falls back to the
 * built-in default only when the global timer is empty.
 */
function bf26_sale_end_iso() {
	$raw = '';
	if ( function_exists( 'get_field' ) ) {
		$raw = (string) get_field( 'timer_expiry', 'option' ); // Global Timer, site-wide.
	}
	$ts = $raw ? strtotime( $raw ) : false;
	if ( ! $ts ) {
		$d  = bf26_defaults();
		$ts = strtotime( isset( $d['sale_end'] ) ? $d['sale_end'] : '2026-11-30 23:59:59' );
	}
	return date( 'c', $ts ); // e.g. 2026-10-31T23:59:59+00:00
}

/** Whether to render the countdown (unset defaults to on). */
function bf26_sale_show() {
	$v = bf26_get( 'sale_show' );
	return ! ( '0' === (string) $v || false === $v || 0 === $v );
}

/* =========================================================================
 * Helpers
 * ====================================================================== */

/** Is the current request a page using this template? */
function bf26_is_active() {
	return is_page_template( BF26_TEMPLATE );
}

/** All section group values merged into one flat array (cached per post). */
function bf26_data( $post_id = null ) {
	static $cache = array();
	$post_id = $post_id ? $post_id : get_queried_object_id();
	if ( ! array_key_exists( $post_id, $cache ) ) {
		$merged = array();
		if ( function_exists( 'get_field' ) ) {
			foreach ( bf26_section_groups() as $group ) {
				$val = get_field( $group, $post_id );
				if ( is_array( $val ) ) {
					$merged = array_merge( $merged, $val );
				}
			}
		}
		$cache[ $post_id ] = $merged;
	}
	return $cache[ $post_id ];
}

/** A single field, falling back to the default when empty. */
function bf26_get( $name, $post_id = null ) {
	$data  = bf26_data( $post_id );
	$value = isset( $data[ $name ] ) ? $data[ $name ] : null;
	if ( null === $value || false === $value || '' === $value || array() === $value ) {
		$d     = bf26_defaults();
		$value = isset( $d[ $name ] ) ? $d[ $name ] : '';
	}
	return $value;
}

/** Repeater rows, falling back to the defaults until rows are saved. */
function bf26_rows( $name, $post_id = null ) {
	$data = bf26_data( $post_id );
	$rows = isset( $data[ $name ] ) ? $data[ $name ] : null;
	if ( is_array( $rows ) && $rows ) {
		return array_values( $rows );
	}
	$d = bf26_defaults();
	return isset( $d[ $name ] ) ? $d[ $name ] : array();
}

/** Echo escaped text from a field. */
function bf26_e( $name ) {
	echo esc_html( bf26_get( $name ) );
}

/**
 * Live Trustpilot rating + review count for the stats strip.
 * Reads the site's own review options (kept current outside this page) and
 * falls back to the design defaults when they are empty.
 */
function bf26_live_trustpilot() {
	$d      = bf26_defaults();
	$rating = '';
	$count  = '';

	if ( function_exists( 'get_field' ) ) {
		$tp = get_field( 'trustpilot_reviews', 'option' );
		if ( is_array( $tp ) ) {
			$rating = isset( $tp['reviews_rating'] ) ? trim( (string) $tp['reviews_rating'] ) : '';
			$count  = isset( $tp['reviews_count'] ) ? trim( (string) $tp['reviews_count'] ) : '';
		}
		if ( '' === $rating || '' === $count ) {
			$g = get_field( 'google_reviews', 'option' );
			if ( is_array( $g ) ) {
				if ( '' === $rating && ! empty( $g['reviews_rating'] ) ) { $rating = trim( (string) $g['reviews_rating'] ); }
				if ( '' === $count && ! empty( $g['reviews_count'] ) )   { $count  = trim( (string) $g['reviews_count'] ); }
			}
		}
	}

	if ( '' === $rating ) { $rating = $d['tp_rating']; }
	if ( '' === $count )  { $count  = $d['tp_count']; }

	$digits = preg_replace( '/[^0-9]/', '', $count );
	if ( '' !== $digits ) { $count = number_format( (int) $digits ); }

	return array( 'rating' => $rating, 'count' => $count );
}

/**
 * Read + normalise the Business Reviews Bundle cache (the same reviews the site
 * shows via [brb_collection]). Returns up to a handful of strong 5-star reviews,
 * English course-related ones first. Does NOT fetch — it only reads whatever
 * BRB has already cached. Returns [] when every collection cache is cold.
 *
 * @return array[] each item: [ 'text' => string, 'author' => string, 'role' => string ]
 */
function bf26_read_brb_reviews() {
	if ( ! function_exists( 'get_transient' ) ) {
		return array();
	}
	$ver     = defined( 'BRB_VERSION' ) ? BRB_VERSION : '1.9.5';
	$reviews = array();
	foreach ( array( 1150, 77247, 108607 ) as $cid ) {
		$data = get_transient( 'brb_collection_' . $ver . '_' . $cid . '_reviews' );
		if ( is_array( $data ) && ! empty( $data['reviews'] ) ) {
			$reviews = $data['reviews'];
			break;
		}
	}
	if ( empty( $reviews ) ) {
		return array();
	}

	$keywords  = array( 'course', 'tefl', 'english', 'great', 'recommend', 'helpful', 'support', 'learn', 'excellent', 'amazing', 'enjoy', 'experience', 'teach' );
	$primary   = array(); // English / course-related 5-star reviews.
	$secondary = array(); // other 5-star reviews with text.

	foreach ( $reviews as $r ) {
		$r = (array) $r;
		if ( 5 !== (int) ( $r['rating'] ?? 0 ) ) { continue; }
		$txt = isset( $r['text'] ) ? trim( preg_replace( '/\s+/', ' ', $r['text'] ) ) : '';
		$len = function_exists( 'mb_strlen' ) ? mb_strlen( $txt ) : strlen( $txt );
		if ( $len < 40 ) { continue; }

		$author   = isset( $r['author_name'] ) ? trim( $r['author_name'] ) : '';
		$provider = isset( $r['provider'] ) ? trim( (string) $r['provider'] ) : '';
		$item     = array(
			'text'   => $txt,
			'author' => '' !== $author ? $author : 'Verified student',
			'role'   => $provider ? ucfirst( $provider ) . ' review' : 'Verified review',
		);

		$low = function_exists( 'mb_strtolower' ) ? mb_strtolower( $txt ) : strtolower( $txt );
		$hit = false;
		foreach ( $keywords as $k ) { if ( false !== strpos( $low, $k ) ) { $hit = true; break; } }
		if ( $hit ) { $primary[] = $item; } else { $secondary[] = $item; }
	}

	return array_merge( $primary, $secondary );
}

/**
 * Live reviews for the testimonial scroller.
 *
 * The BRB cache is only (re)populated when a page containing a [brb_collection]
 * shortcode is viewed; the Black Friday page has none, so those transients can
 * all be cold at render time. To never fall back to the placeholder review:
 *   1. read whatever BRB has cached;
 *   2. if that's empty, serve a durable backup saved from a previous success;
 *   3. only if there is no backup either, warm the cache the way BRB's own
 *      shortcode does (one synchronous fetch) and read it.
 * The durable backup is refreshed from fresh data at most once every 6 hours.
 *
 * @return array[] each item: [ 'text' => string, 'author' => string, 'role' => string ]
 */
function bf26_live_reviews( $limit = 10 ) {
	$d        = bf26_defaults();
	$fallback = array( array( 'text' => $d['review_quote'], 'author' => $d['review_author'], 'role' => $d['review_role'] ) );

	$fresh = bf26_read_brb_reviews();
	$out   = $fresh;

	if ( empty( $out ) ) {
		$backup = get_option( 'bf26_reviews_backup' );
		if ( is_array( $backup ) && ! empty( $backup ) ) {
			$out = $backup; // fast path — never show the placeholder once warmed once.
		} elseif ( function_exists( 'do_shortcode' ) ) {
			do_shortcode( '[brb_collection id="1150"]' ); // populates the BRB transient.
			$fresh = bf26_read_brb_reviews();
			$out   = $fresh;
		}
	}

	// Keep a durable backup from fresh data, throttled to ~once every 6 hours.
	if ( ! empty( $fresh ) && function_exists( 'update_option' ) ) {
		$last = (int) get_option( 'bf26_reviews_backup_time' );
		if ( ( time() - $last ) > 6 * HOUR_IN_SECONDS ) {
			update_option( 'bf26_reviews_backup', $fresh, false );
			update_option( 'bf26_reviews_backup_time', time(), false );
		}
	}

	if ( empty( $out ) ) {
		return $fallback;
	}
	return array_slice( $out, 0, max( 1, (int) $limit ) );
}

/** Resolve the hero image to a usable [url, alt] pair, with a theme fallback. */
function bf26_hero_image() {
	$img = bf26_get( 'hero_image' );
	$fallback_url = get_stylesheet_directory_uri() . '/assets/img/black-friday-2026/hero-victory-pose.png';
	$fallback_alt = 'Excited student with headphones celebrating at her laptop';

	if ( is_array( $img ) && ! empty( $img['url'] ) ) {
		return array(
			'url' => $img['url'],
			'alt' => ! empty( $img['alt'] ) ? $img['alt'] : $fallback_alt,
		);
	}
	if ( is_numeric( $img ) ) {
		$url = wp_get_attachment_image_url( (int) $img, 'full' );
		if ( $url ) {
			$alt = get_post_meta( (int) $img, '_wp_attachment_image_alt', true );
			return array( 'url' => $url, 'alt' => $alt ? $alt : $fallback_alt );
		}
	}
	if ( is_string( $img ) && $img ) {
		return array( 'url' => $img, 'alt' => $fallback_alt );
	}
	return array( 'url' => $fallback_url, 'alt' => $fallback_alt );
}

/** Lucide icons, inline, 1.5px stroke. Coloured via the stroke argument. */
if ( ! function_exists( 'bf26_icon' ) ) {
	function bf26_icon( $name, $size = 22, $color = 'currentColor', $stroke = 1.5 ) {
		static $paths = array(
			'gift'           => '<rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/>',
			'globe'          => '<circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>',
			'shield-check'   => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
			'laptop'         => '<path d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16"/>',
			'plane'          => '<path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>',
			'award'          => '<path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/><circle cx="12" cy="8" r="6"/>',
			'book-open'      => '<path d="M12 7v14"/><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"/>',
			'briefcase'      => '<path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><rect width="20" height="14" x="2" y="6" rx="2"/>',
			'graduation-cap' => '<path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>',
			'clock'          => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
			'users'          => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
			'star'           => '<path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/>',
			'file-badge'     => '<path d="M12 22h6a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M5 17a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M7 16.5 8 22l-3-1-3 1 1-5.5"/>',
			'life-buoy'      => '<circle cx="12" cy="12" r="10"/><path d="m4.93 4.93 4.24 4.24"/><path d="m14.83 9.17 4.24-4.24"/><path d="m14.83 14.83 4.24 4.24"/><path d="m9.17 14.83-4.24 4.24"/><circle cx="12" cy="12" r="4"/>',
			'calendar-days'  => '<path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/>',
		);
		$d = isset( $paths[ $name ] ) ? $paths[ $name ] : '';
		return '<svg class="bf26-ic" width="' . intval( $size ) . '" height="' . intval( $size ) . '" viewBox="0 0 24 24" fill="none" stroke="' . esc_attr( $color ) . '" stroke-width="' . floatval( $stroke ) . '" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $d . '</svg>';
	}
}

/** Brand/social icons (inline SVG, stroke = currentColor), used by the social strip. */
if ( ! function_exists( 'bf26_social_icon' ) ) {
	function bf26_social_icon( $name, $size = 22 ) {
		static $paths = array(
			'facebook'  => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
			'instagram' => '<rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".6" fill="currentColor"/>',
			'tiktok'    => '<path d="M16 3c.4 2.6 2 4.2 4.5 4.5V11c-1.7 0-3.2-.5-4.5-1.4V15a6 6 0 1 1-6-6v3.5a2.5 2.5 0 1 0 2.5 2.5V3z"/>',
			'youtube'   => '<path d="M2.5 17a24 24 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49 49 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24 24 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49 49 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/>',
			'linkedin'  => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>',
		);
		$d = isset( $paths[ $name ] ) ? $paths[ $name ] : '';
		return '<svg width="' . intval( $size ) . '" height="' . intval( $size ) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $d . '</svg>';
	}
}

/** Social platform labels (for aria-label / the ACF select). */
function bf26_social_choices() {
	return array(
		'facebook'  => 'Facebook',
		'instagram' => 'Instagram',
		'tiktok'    => 'TikTok',
		'youtube'   => 'YouTube',
		'linkedin'  => 'LinkedIn',
	);
}

/* =========================================================================
 * ACF: add a section's fields to the existing DB field group by APPENDING
 * them with acf_update_field(). This never replaces the group, so — unlike
 * acf_import_field_group() — it cannot create duplicate field-group posts.
 * Run once from WP-CLI, e.g.:  wp eval 'echo bf26_add_countdown_fields();'
 * ====================================================================== */

/** Append a tab + a "group" field (with sub-fields) to the group. Idempotent. */
function bf26_append_group_section( $tab_key, $tab_label, $group_key, $group_name, $group_label, $sub_fields ) {
	if ( ! function_exists( 'acf_update_field' ) || ! function_exists( 'acf_get_field_group' ) ) {
		return 'ACF not available';
	}
	$g = acf_get_field_group( BF26_GROUP_KEY );
	if ( ! $g || empty( $g['ID'] ) ) {
		return 'group ' . BF26_GROUP_KEY . ' not found';
	}
	$gid = (int) $g['ID'];

	if ( function_exists( 'acf_get_field' ) && acf_get_field( $group_key ) ) {
		return $group_name . ' already present — nothing to do';
	}

	$existing = acf_get_fields( $gid );
	$order    = is_array( $existing ) ? count( $existing ) : 0;

	acf_update_field( array(
		'key'        => $tab_key,
		'label'      => $tab_label,
		'name'       => '',
		'type'       => 'tab',
		'placement'  => 'left',
		'parent'     => $gid,
		'menu_order' => $order,
	) );

	$grp = acf_update_field( array(
		'key'        => $group_key,
		'label'      => $group_label,
		'name'       => $group_name,
		'type'       => 'group',
		'layout'     => 'block',
		'parent'     => $gid,
		'menu_order' => $order + 1,
	) );
	$pid = (int) $grp['ID'];

	bf26_create_fields( $sub_fields, $pid );

	return 'added ' . $group_name . ' with ' . count( $sub_fields ) . ' fields';
}

/** Recursively create fields under a parent (group ID or parent field ID). */
function bf26_create_fields( $fields, $parent_id ) {
	$o = 0;
	foreach ( $fields as $f ) {
		$children = isset( $f['sub_fields'] ) ? $f['sub_fields'] : null;
		unset( $f['sub_fields'] );
		$f['parent']     = $parent_id;
		$f['menu_order'] = $o++;
		$saved = acf_update_field( $f );
		if ( $children && ! empty( $saved['ID'] ) ) {
			bf26_create_fields( $children, (int) $saved['ID'] );
		}
	}
}

/** The sale-countdown sub-fields (source of truth for the append). */
function bf26_countdown_subfields() {
	$d = bf26_defaults();
	return array(
		array( 'key' => 'field_bf26_sale_show', 'label' => 'Show countdown', 'name' => 'sale_show', 'type' => 'true_false', 'ui' => 1, 'default_value' => 1, 'message' => 'Show the sale countdown band' ),
		array( 'key' => 'field_bf26_sale_label', 'label' => 'Label', 'name' => 'sale_label', 'type' => 'text', 'default_value' => $d['sale_label'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_sale_end_note', 'label' => 'End note', 'name' => 'sale_end_note', 'type' => 'text', 'default_value' => $d['sale_end_note'], 'wrapper' => array( 'width' => 50 ), 'instructions' => 'The countdown ends at the site-wide Global Timer → Timer Expiry; this is just the label shown under the clock.' ),
		array( 'key' => 'field_bf26_sale_places_strong', 'label' => 'Places left — bold text', 'name' => 'sale_places_strong', 'type' => 'text', 'default_value' => $d['sale_places_strong'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_sale_places_text', 'label' => 'Places left — rest', 'name' => 'sale_places_text', 'type' => 'text', 'default_value' => $d['sale_places_text'], 'wrapper' => array( 'width' => 50 ) ),
	);
}

/** One-shot: add the "Sale countdown" tab + group to the DB field group. */
function bf26_add_countdown_fields() {
	return bf26_append_group_section(
		'field_bf26_tab_sale',
		'Sale countdown',
		'field_bf26_sale_countdown',
		'sale_countdown',
		'Sale countdown',
		bf26_countdown_subfields()
	);
}

/** Icon choices shared by the course-section selects. */
function bf26_course_icon_choices() {
	return array(
		'book-open' => 'Book', 'award' => 'Award', 'graduation-cap' => 'Graduation cap', 'gift' => 'Gift',
		'clock' => 'Clock', 'plane' => 'Plane', 'globe' => 'Globe', 'users' => 'Users', 'shield-check' => 'Shield check',
		'star' => 'Star', 'file-badge' => 'File badge', 'life-buoy' => 'Life buoy', 'laptop' => 'Laptop',
		'briefcase' => 'Briefcase', 'calendar-days' => 'Calendar',
	);
}

/** The course-section sub-fields (source of truth for the append). */
function bf26_course_subfields() {
	$d     = bf26_defaults();
	$icons = bf26_course_icon_choices();
	return array(
		array( 'key' => 'field_bf26_course_eyebrow', 'name' => 'course_eyebrow', 'label' => 'Eyebrow', 'type' => 'text', 'default_value' => $d['course_eyebrow'] ),
		array( 'key' => 'field_bf26_course_title_pre', 'name' => 'course_title_pre', 'label' => 'Title — before highlight', 'type' => 'text', 'default_value' => $d['course_title_pre'], 'wrapper' => array( 'width' => 34 ) ),
		array( 'key' => 'field_bf26_course_title_em', 'name' => 'course_title_em', 'label' => 'Title — highlight', 'type' => 'text', 'default_value' => $d['course_title_em'], 'wrapper' => array( 'width' => 33 ) ),
		array( 'key' => 'field_bf26_course_title_post', 'name' => 'course_title_post', 'label' => 'Title — after highlight', 'type' => 'text', 'default_value' => $d['course_title_post'], 'wrapper' => array( 'width' => 33 ) ),
		array( 'key' => 'field_bf26_course_note', 'name' => 'course_note', 'label' => 'Note (right of heading)', 'type' => 'text', 'default_value' => $d['course_note'] ),
		array(
			'key' => 'field_bf26_course_cards', 'name' => 'course_cards', 'label' => 'Course cards', 'type' => 'repeater',
			'instructions' => 'Leave empty to show the built-in four cards. Price, "was" price and the % off all come from the linked product.',
			'min' => 0, 'layout' => 'block', 'button_label' => 'Add card',
			'sub_fields' => array(
				array( 'key' => 'field_bf26_card_variant', 'name' => 'variant', 'label' => 'Style', 'type' => 'select', 'choices' => array( 'standard' => 'Standard (cream)', 'bundle' => 'Bundle (red)' ), 'default_value' => 'standard', 'wrapper' => array( 'width' => 50 ) ),
				array( 'key' => 'field_bf26_card_klarna', 'name' => 'klarna', 'label' => 'Show Klarna', 'type' => 'true_false', 'ui' => 1, 'default_value' => 1, 'wrapper' => array( 'width' => 50 ) ),
				array( 'key' => 'field_bf26_card_course', 'name' => 'course', 'label' => 'Course', 'type' => 'post_object', 'post_type' => array( 'course' ), 'return_format' => 'id', 'ui' => 1, 'allow_null' => 1, 'instructions' => 'Pick the course. The card shows its price, "was" price and % off (from the course\'s linked product) and links to the course page.' ),
				array( 'key' => 'field_bf26_card_category', 'name' => 'category', 'label' => 'Category pill', 'type' => 'text', 'wrapper' => array( 'width' => 60 ) ),
				array( 'key' => 'field_bf26_card_cat_icon', 'name' => 'cat_icon', 'label' => 'Pill icon', 'type' => 'select', 'choices' => $icons, 'default_value' => 'book-open', 'wrapper' => array( 'width' => 40 ) ),
				array( 'key' => 'field_bf26_card_image', 'name' => 'image', 'label' => 'Image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium' ),
				array( 'key' => 'field_bf26_card_title', 'name' => 'title', 'label' => 'Title', 'type' => 'text' ),
				array(
					'key' => 'field_bf26_card_features', 'name' => 'features', 'label' => 'Features', 'type' => 'repeater',
					'min' => 0, 'layout' => 'table', 'button_label' => 'Add feature',
					'sub_fields' => array(
						array( 'key' => 'field_bf26_feat_icon', 'name' => 'icon', 'label' => 'Icon', 'type' => 'select', 'choices' => $icons, 'default_value' => 'book-open', 'wrapper' => array( 'width' => 30 ) ),
						array( 'key' => 'field_bf26_feat_text', 'name' => 'text', 'label' => 'Text', 'type' => 'text', 'wrapper' => array( 'width' => 70 ) ),
					),
				),
				array( 'key' => 'field_bf26_card_cta_label', 'name' => 'cta_label', 'label' => 'Button label', 'type' => 'text', 'default_value' => 'Enrol now', 'wrapper' => array( 'width' => 50 ) ),
				array( 'key' => 'field_bf26_card_cta_url', 'name' => 'cta_url', 'label' => 'Button link (bundle only)', 'type' => 'text', 'instructions' => 'Only used by the bundle card. Standard cards link automatically from the product (cart, or course page for 180/300-hour).', 'wrapper' => array( 'width' => 50 ), 'conditional_logic' => array( array( array( 'field' => 'field_bf26_card_variant', 'operator' => '==', 'value' => 'bundle' ) ) ) ),
			),
		),
		array( 'key' => 'field_bf26_course_free_title_pre', 'name' => 'course_free_title_pre', 'label' => 'Free tiles — title before', 'type' => 'text', 'default_value' => $d['course_free_title_pre'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_course_free_title_em', 'name' => 'course_free_title_em', 'label' => 'Free tiles — title highlight', 'type' => 'text', 'default_value' => $d['course_free_title_em'], 'wrapper' => array( 'width' => 50 ) ),
		array(
			'key' => 'field_bf26_course_free_tiles', 'name' => 'course_free_tiles', 'label' => 'Free tiles', 'type' => 'repeater',
			'min' => 0, 'max' => 3, 'layout' => 'table', 'button_label' => 'Add tile',
			'sub_fields' => array(
				array( 'key' => 'field_bf26_free_icon', 'name' => 'icon', 'label' => 'Icon', 'type' => 'select', 'choices' => $icons, 'default_value' => 'book-open', 'wrapper' => array( 'width' => 25 ) ),
				array( 'key' => 'field_bf26_free_label', 'name' => 'label', 'label' => 'Label', 'type' => 'text', 'wrapper' => array( 'width' => 45 ) ),
				array( 'key' => 'field_bf26_free_url', 'name' => 'url', 'label' => 'Link', 'type' => 'text', 'wrapper' => array( 'width' => 30 ) ),
			),
		),
	);
}

/** One-shot: add the "Course cards" tab + group to the DB field group. */
function bf26_add_course_fields() {
	return bf26_append_group_section(
		'field_bf26_tab_course',
		'Course cards',
		'field_bf26_course_section',
		'course_section',
		'Course cards',
		bf26_course_subfields()
	);
}

/** One-shot: make the card button link field show for the bundle card only. */
function bf26_make_cta_bundle_only() {
	if ( ! function_exists( 'acf_get_field' ) || ! function_exists( 'acf_update_field' ) ) {
		return 'ACF not available';
	}
	$f = acf_get_field( 'field_bf26_card_cta_url' );
	if ( ! $f ) {
		return 'cta_url field not found';
	}
	$f['label']             = 'Button link (bundle only)';
	$f['instructions']      = 'Only used by the bundle card. Standard cards link automatically from the product (cart, or course page for 180/300-hour).';
	$f['conditional_logic'] = array( array( array( 'field' => 'field_bf26_card_variant', 'operator' => '==', 'value' => 'bundle' ) ) );
	acf_update_field( $f );
	return 'cta_url is now bundle-only';
}

/** The free-gifts sub-fields (source of truth for the append). */
function bf26_gift_subfields() {
	$d = bf26_defaults();
	return array(
		array( 'key' => 'field_bf26_gifts_board_status', 'name' => 'gifts_board_status', 'label' => 'Board status', 'type' => 'text', 'default_value' => $d['gifts_board_status'], 'wrapper' => array( 'width' => 34 ) ),
		array( 'key' => 'field_bf26_gifts_board_gate', 'name' => 'gifts_board_gate', 'label' => 'Board gate line', 'type' => 'text', 'default_value' => $d['gifts_board_gate'], 'wrapper' => array( 'width' => 33 ) ),
		array( 'key' => 'field_bf26_gifts_board_text', 'name' => 'gifts_board_text', 'label' => 'Split-flap text', 'type' => 'text', 'default_value' => $d['gifts_board_text'], 'wrapper' => array( 'width' => 33 ) ),
		array( 'key' => 'field_bf26_gifts_title_pre', 'name' => 'gifts_title_pre', 'label' => 'Title — before highlight', 'type' => 'text', 'default_value' => $d['gifts_title_pre'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_gifts_title_em', 'name' => 'gifts_title_em', 'label' => 'Title — highlight', 'type' => 'text', 'default_value' => $d['gifts_title_em'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_gifts_intro', 'name' => 'gifts_intro', 'label' => 'Intro paragraph', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => $d['gifts_intro'] ),
		array( 'key' => 'field_bf26_gifts_opened_label', 'name' => 'gifts_opened_label', 'label' => 'Progress label', 'type' => 'text', 'default_value' => $d['gifts_opened_label'], 'wrapper' => array( 'width' => 34 ) ),
		array( 'key' => 'field_bf26_gifts_open_all', 'name' => 'gifts_open_all', 'label' => '"Open all" label', 'type' => 'text', 'default_value' => $d['gifts_open_all'], 'wrapper' => array( 'width' => 33 ) ),
		array( 'key' => 'field_bf26_gifts_rewrap', 'name' => 'gifts_rewrap', 'label' => '"Re-wrap" label', 'type' => 'text', 'default_value' => $d['gifts_rewrap'], 'wrapper' => array( 'width' => 33 ) ),
		array(
			'key' => 'field_bf26_gifts', 'name' => 'gifts', 'label' => 'Gifts', 'type' => 'repeater',
			'instructions' => 'Leave empty to show the built-in six gifts.',
			'min' => 0, 'layout' => 'block', 'button_label' => 'Add gift',
			'sub_fields' => array(
				array( 'key' => 'field_bf26_gift_name', 'name' => 'name', 'label' => 'Gift name', 'type' => 'text' ),
				array( 'key' => 'field_bf26_gift_image', 'name' => 'image', 'label' => 'Image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'wrapper' => array( 'width' => 50 ) ),
				array( 'key' => 'field_bf26_gift_c1', 'name' => 'c1', 'label' => 'Case body colour', 'type' => 'color_picker', 'default_value' => '#D7263D', 'wrapper' => array( 'width' => 25 ) ),
				array( 'key' => 'field_bf26_gift_c2', 'name' => 'c2', 'label' => 'Case lid colour', 'type' => 'color_picker', 'default_value' => '#8E1626', 'wrapper' => array( 'width' => 25 ) ),
			),
		),
		array( 'key' => 'field_bf26_gifts_banner_strong', 'name' => 'gifts_banner_strong', 'label' => 'Banner — bold lead', 'type' => 'text', 'default_value' => $d['gifts_banner_strong'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_gifts_banner_text', 'name' => 'gifts_banner_text', 'label' => 'Banner — rest', 'type' => 'text', 'default_value' => $d['gifts_banner_text'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_gifts_banner_cta', 'name' => 'gifts_banner_cta', 'label' => 'Banner button label', 'type' => 'text', 'default_value' => $d['gifts_banner_cta'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_gifts_banner_url', 'name' => 'gifts_banner_url', 'label' => 'Banner button link', 'type' => 'text', 'default_value' => $d['gifts_banner_url'], 'wrapper' => array( 'width' => 50 ) ),
	);
}

/** One-shot: add the "Free gifts" tab + group to the DB field group. */
function bf26_add_gift_fields() {
	return bf26_append_group_section(
		'field_bf26_tab_gifts',
		'Free gifts',
		'field_bf26_gift_section',
		'gift_section',
		'Free gifts',
		bf26_gift_subfields()
	);
}

/** The reviews & stats sub-fields (source of truth for the append). */
function bf26_review_subfields() {
	$d = bf26_defaults();
	return array(
		array(
			'key' => 'field_bf26_stats', 'name' => 'stats', 'label' => 'Stats strip', 'type' => 'repeater',
			'instructions' => 'Leave empty to show the built-in stats. (The Trustpilot rating and reviews come from the live Trustpilot widget, not here.)',
			'min' => 0, 'layout' => 'table', 'button_label' => 'Add stat',
			'sub_fields' => array(
				array( 'key' => 'field_bf26_stat_num', 'name' => 'num', 'label' => 'Number / headline', 'type' => 'text', 'wrapper' => array( 'width' => 30 ) ),
				array( 'key' => 'field_bf26_stat_label', 'name' => 'label', 'label' => 'Label', 'type' => 'text', 'wrapper' => array( 'width' => 70 ) ),
			),
		),
		array( 'key' => 'field_bf26_review_title_pre', 'name' => 'review_title_pre', 'label' => 'Heading — before highlight', 'type' => 'text', 'default_value' => $d['review_title_pre'], 'wrapper' => array( 'width' => 34 ) ),
		array( 'key' => 'field_bf26_review_title_em', 'name' => 'review_title_em', 'label' => 'Heading — highlight', 'type' => 'text', 'default_value' => $d['review_title_em'], 'wrapper' => array( 'width' => 33 ) ),
		array( 'key' => 'field_bf26_review_title_post', 'name' => 'review_title_post', 'label' => 'Heading — after highlight', 'type' => 'text', 'default_value' => $d['review_title_post'], 'wrapper' => array( 'width' => 33 ) ),
		array( 'key' => 'field_bf26_review_cta_label', 'name' => 'review_cta_label', 'label' => 'Button label', 'type' => 'text', 'default_value' => $d['review_cta_label'], 'wrapper' => array( 'width' => 50 ) ),
		array( 'key' => 'field_bf26_review_cta_url', 'name' => 'review_cta_url', 'label' => 'Button link', 'type' => 'text', 'default_value' => $d['review_cta_url'], 'wrapper' => array( 'width' => 50 ) ),
	);
}

/** One-shot: add the "Reviews & stats" tab + group to the DB field group. */
function bf26_add_review_fields() {
	return bf26_append_group_section(
		'field_bf26_tab_review',
		'Reviews & stats',
		'field_bf26_review_section',
		'review_section',
		'Reviews & stats',
		bf26_review_subfields()
	);
}

/** One-shot: remove the manual testimonial fields — these now come from the
 *  live Trustpilot widget, so the quote/name/role fields are no longer needed. */
function bf26_remove_review_live_fields() {
	if ( ! function_exists( 'acf_delete_field' ) || ! function_exists( 'acf_get_field' ) ) {
		return 'ACF not available';
	}
	$removed = array();
	foreach ( array( 'field_bf26_review_quote', 'field_bf26_review_author', 'field_bf26_review_role' ) as $key ) {
		$f = acf_get_field( $key );
		if ( $f && ! empty( $f['ID'] ) ) {
			acf_delete_field( $f['ID'] );
			$removed[] = $key;
		}
	}
	return $removed ? 'removed: ' . implode( ', ', $removed ) : 'nothing to remove';
}

/** The "Why choose us" sub-fields (source of truth for the append). */
function bf26_whyus_subfields() {
	$d = bf26_defaults();
	return array(
		array( 'key' => 'field_bf26_whyus_eyebrow', 'name' => 'whyus_eyebrow', 'label' => 'Eyebrow', 'type' => 'text', 'default_value' => $d['whyus_eyebrow'], 'wrapper' => array( 'width' => 100 ) ),
		array( 'key' => 'field_bf26_whyus_title_pre', 'name' => 'whyus_title_pre', 'label' => 'Heading — before highlight', 'type' => 'text', 'default_value' => $d['whyus_title_pre'], 'wrapper' => array( 'width' => 34 ) ),
		array( 'key' => 'field_bf26_whyus_title_em', 'name' => 'whyus_title_em', 'label' => 'Heading — highlight', 'type' => 'text', 'default_value' => $d['whyus_title_em'], 'wrapper' => array( 'width' => 33 ) ),
		array( 'key' => 'field_bf26_whyus_title_post', 'name' => 'whyus_title_post', 'label' => 'Heading — after highlight', 'type' => 'text', 'default_value' => $d['whyus_title_post'], 'wrapper' => array( 'width' => 33 ) ),
		array( 'key' => 'field_bf26_whyus_intro', 'name' => 'whyus_intro', 'label' => 'Intro paragraph', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'default_value' => $d['whyus_intro'] ),
		array(
			'key' => 'field_bf26_whyus_cards', 'name' => 'whyus_cards', 'label' => 'Feature cards', 'type' => 'repeater',
			'instructions' => 'Leave empty to show the built-in five cards.',
			'min' => 0, 'layout' => 'block', 'button_label' => 'Add card',
			'sub_fields' => array(
				array( 'key' => 'field_bf26_whyus_card_icon', 'name' => 'icon', 'label' => 'Icon', 'type' => 'select', 'choices' => bf26_course_icon_choices(), 'default_value' => 'shield-check', 'ui' => 1, 'wrapper' => array( 'width' => 34 ) ),
				array( 'key' => 'field_bf26_whyus_card_title', 'name' => 'title', 'label' => 'Title', 'type' => 'text', 'wrapper' => array( 'width' => 66 ) ),
				array( 'key' => 'field_bf26_whyus_card_text', 'name' => 'text', 'label' => 'Description', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '' ),
			),
		),
	);
}

/** One-shot: add the "Why choose us" tab + group to the DB field group. */
function bf26_add_whyus_fields() {
	return bf26_append_group_section(
		'field_bf26_tab_whyus',
		'Why choose us',
		'field_bf26_whyus_section',
		'whyus_section',
		'Why choose us',
		bf26_whyus_subfields()
	);
}

/** The FAQ sub-fields (source of truth for the append). */
function bf26_faq_subfields() {
	$d = bf26_defaults();
	return array(
		array( 'key' => 'field_bf26_faq_eyebrow', 'name' => 'faq_eyebrow', 'label' => 'Eyebrow', 'type' => 'text', 'default_value' => $d['faq_eyebrow'], 'wrapper' => array( 'width' => 100 ) ),
		array( 'key' => 'field_bf26_faq_title_pre', 'name' => 'faq_title_pre', 'label' => 'Heading — before highlight', 'type' => 'text', 'default_value' => $d['faq_title_pre'], 'wrapper' => array( 'width' => 34 ) ),
		array( 'key' => 'field_bf26_faq_title_em', 'name' => 'faq_title_em', 'label' => 'Heading — highlight', 'type' => 'text', 'default_value' => $d['faq_title_em'], 'wrapper' => array( 'width' => 33 ) ),
		array( 'key' => 'field_bf26_faq_title_post', 'name' => 'faq_title_post', 'label' => 'Heading — after highlight', 'type' => 'text', 'default_value' => $d['faq_title_post'], 'wrapper' => array( 'width' => 33 ) ),
		array(
			'key' => 'field_bf26_faqs', 'name' => 'faqs', 'label' => 'Questions', 'type' => 'repeater',
			'instructions' => 'Leave empty to show the built-in questions. The first one opens by default.',
			'min' => 0, 'layout' => 'block', 'button_label' => 'Add question',
			'sub_fields' => array(
				array( 'key' => 'field_bf26_faq_q', 'name' => 'q', 'label' => 'Question', 'type' => 'text' ),
				array( 'key' => 'field_bf26_faq_a', 'name' => 'a', 'label' => 'Answer', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ),
			),
		),
	);
}

/** One-shot: add the "FAQ" tab + group to the DB field group. */
function bf26_add_faq_fields() {
	return bf26_append_group_section(
		'field_bf26_tab_faq',
		'FAQ',
		'field_bf26_faq_section',
		'faq_section',
		'FAQ',
		bf26_faq_subfields()
	);
}

/** The "Follow the journey" (social) sub-fields (source of truth for the append).
 *  Names are "follow_*" to avoid the site's existing social_section/social_links. */
function bf26_social_subfields() {
	$d = bf26_defaults();
	return array(
		array( 'key' => 'field_bf26_follow_eyebrow', 'name' => 'follow_eyebrow', 'label' => 'Eyebrow', 'type' => 'text', 'default_value' => $d['follow_eyebrow'] ),
		array(
			'key' => 'field_bf26_follow_links', 'name' => 'follow_links', 'label' => 'Social links', 'type' => 'repeater',
			'instructions' => 'Leave empty to show the built-in links. Set each link\'s URL; remove a row to hide that network.',
			'min' => 0, 'layout' => 'table', 'button_label' => 'Add link',
			'sub_fields' => array(
				array( 'key' => 'field_bf26_follow_icon', 'name' => 'icon', 'label' => 'Network', 'type' => 'select', 'choices' => bf26_social_choices(), 'default_value' => 'facebook', 'ui' => 1, 'wrapper' => array( 'width' => 34 ) ),
				array( 'key' => 'field_bf26_follow_url', 'name' => 'url', 'label' => 'URL', 'type' => 'text', 'wrapper' => array( 'width' => 66 ) ),
			),
		),
	);
}

/** One-shot: add the "Follow the journey" tab + group to the DB field group. */
function bf26_add_social_fields() {
	return bf26_append_group_section(
		'field_bf26_tab_follow',
		'Follow the journey',
		'field_bf26_follow_section',
		'bf26_follow',
		'Follow the journey',
		bf26_social_subfields()
	);
}

/** One-shot: remove the first (colliding) social fields that used the generic
 *  social_section / social_links names. Safe to run once after the rename. */
function bf26_remove_old_social_fields() {
	if ( ! function_exists( 'acf_delete_field' ) || ! function_exists( 'acf_get_field' ) ) {
		return 'ACF not available';
	}
	$removed = array();
	foreach ( array( 'field_bf26_tab_social', 'field_bf26_social_section', 'field_bf26_social_eyebrow', 'field_bf26_social_links', 'field_bf26_social_icon', 'field_bf26_social_url' ) as $key ) {
		$f = acf_get_field( $key );
		if ( $f && ! empty( $f['ID'] ) ) {
			acf_delete_field( $f['ID'] );
			$removed[] = $key;
		}
	}
	return $removed ? 'removed: ' . implode( ', ', $removed ) : 'nothing to remove';
}

/** One-shot: remove the hero primary-CTA link field — "Shop the sale" now links
 *  automatically to the #courses section, so the manual URL field is not needed. */
function bf26_remove_hero_primary_url_field() {
	if ( ! function_exists( 'acf_delete_field' ) || ! function_exists( 'acf_get_field' ) ) {
		return 'ACF not available';
	}
	$f = acf_get_field( 'field_bf26_hero_cta_primary_url' );
	if ( $f && ! empty( $f['ID'] ) ) {
		acf_delete_field( $f['ID'] );
		return 'removed field_bf26_hero_cta_primary_url';
	}
	return 'nothing to remove';
}

/** One-shot: remove the manual course-card price fields — price, "was" price and
 *  the % off now always come from the linked WooCommerce product. */
function bf26_remove_card_manual_price_fields() {
	if ( ! function_exists( 'acf_delete_field' ) || ! function_exists( 'acf_get_field' ) ) {
		return 'ACF not available';
	}
	$removed = array();
	foreach ( array( 'field_bf26_card_save', 'field_bf26_card_price', 'field_bf26_card_was' ) as $key ) {
		$f = acf_get_field( $key );
		if ( $f && ! empty( $f['ID'] ) ) {
			acf_delete_field( $f['ID'] );
			$removed[] = $key;
		}
	}
	return $removed ? 'removed: ' . implode( ', ', $removed ) : 'nothing to remove';
}

/** One-shot: remove the page-level "Sale end date & time" field — the countdown
 *  now reads the site-wide Global Timer (option: timer_expiry). */
function bf26_remove_sale_end_field() {
	if ( ! function_exists( 'acf_delete_field' ) || ! function_exists( 'acf_get_field' ) ) {
		return 'ACF not available';
	}
	$f = acf_get_field( 'field_bf26_sale_end' );
	if ( $f && ! empty( $f['ID'] ) ) {
		acf_delete_field( $f['ID'] );
		return 'removed field_bf26_sale_end';
	}
	return 'nothing to remove';
}

/** One-shot: switch the course-card selector from a product to a course.
 *  Adds field_bf26_card_course into the existing cards repeater (taking the old
 *  product field's slot), then removes field_bf26_card_product. */
function bf26_switch_card_to_course() {
	if ( ! function_exists( 'acf_get_field' ) || ! function_exists( 'acf_update_field' ) || ! function_exists( 'acf_delete_field' ) ) {
		return 'ACF not available';
	}
	$out = array();

	if ( ! acf_get_field( 'field_bf26_card_course' ) ) {
		$prod   = acf_get_field( 'field_bf26_card_product' );
		$parent = $prod ? (int) $prod['parent'] : 0;
		$order  = $prod ? (int) $prod['menu_order'] : 2;
		if ( ! $parent ) {
			return 'course_cards repeater not found (product field missing)';
		}
		acf_update_field( array(
			'key'           => 'field_bf26_card_course',
			'name'          => 'course',
			'label'         => 'Course',
			'type'          => 'post_object',
			'post_type'     => array( 'course' ),
			'return_format' => 'id',
			'ui'            => 1,
			'allow_null'    => 1,
			'instructions'  => 'Pick the course. The card shows its price, "was" price and % off (from the course\'s linked product) and links to the course page.',
			'parent'        => $parent,
			'menu_order'    => $order,
		) );
		$out[] = 'added field_bf26_card_course';
	} else {
		$out[] = 'course field already present';
	}

	$prod = acf_get_field( 'field_bf26_card_product' );
	if ( $prod && ! empty( $prod['ID'] ) ) {
		acf_delete_field( $prod['ID'] );
		$out[] = 'removed field_bf26_card_product';
	}

	return implode( '; ', $out );
}
