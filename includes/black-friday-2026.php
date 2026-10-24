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
	return array( 'banner_section', 'accred_strip' );
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
		'hero_cta_primary_label'   => 'Shop the sale',
		'hero_cta_primary_url'     => '#',
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
	);

	return $d;
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
		);
		$d = isset( $paths[ $name ] ) ? $paths[ $name ] : '';
		return '<svg class="bf26-ic" width="' . intval( $size ) . '" height="' . intval( $size ) . '" viewBox="0 0 24 24" fill="none" stroke="' . esc_attr( $color ) . '" stroke-width="' . floatval( $stroke ) . '" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $d . '</svg>';
	}
}

/* =========================================================================
 * ACF: add the "Accredited strip" fields to the existing DB group.
 *
 * This APPENDS a new tab + "accred_strip" group to whatever the group already
 * contains (hero, student stories, etc.) and re-imports — existing fields are
 * matched by key and preserved. Run once from WP-CLI:
 *   wp eval 'echo bf26_add_accred_fields();'
 * It is idempotent (skips if accred_strip is already there).
 * ====================================================================== */
function bf26_accred_section_fields() {
	$d = bf26_defaults();
	return array(
		array(
			'key'       => 'field_bf26_tab_accred',
			'label'     => 'Accredited strip',
			'name'      => '',
			'type'      => 'tab',
			'placement' => 'left',
		),
		array(
			'key'        => 'field_bf26_accred_strip',
			'label'      => 'Accredited & regulated strip',
			'name'       => 'accred_strip',
			'type'       => 'group',
			'layout'     => 'block',
			'sub_fields' => array(
				array(
					'key'           => 'field_bf26_accred_label',
					'label'         => 'Strip label',
					'name'          => 'accred_label',
					'type'          => 'text',
					'default_value' => $d['accred_label'],
				),
				array(
					'key'          => 'field_bf26_accred_items',
					'label'        => 'Accreditors',
					'name'         => 'accred_items',
					'type'         => 'repeater',
					'instructions' => 'Leave empty to show the built-in list. Add rows to replace it entirely.',
					'min'          => 0,
					'layout'       => 'table',
					'button_label' => 'Add accreditor',
					'sub_fields'   => array(
						array(
							'key'     => 'field_bf26_accred_items_name',
							'label'   => 'Name',
							'name'    => 'name',
							'type'    => 'text',
							'wrapper' => array( 'width' => 50 ),
						),
						array(
							'key'     => 'field_bf26_accred_items_sub',
							'label'   => 'Sub-label',
							'name'    => 'sub',
							'type'    => 'text',
							'wrapper' => array( 'width' => 50 ),
						),
					),
				),
			),
		),
	);
}

function bf26_add_accred_fields() {
	if ( ! function_exists( 'acf_get_field_group' ) || ! function_exists( 'acf_import_field_group' ) ) {
		return 'ACF not available';
	}
	$group = acf_get_field_group( BF26_GROUP_KEY );
	if ( ! $group ) {
		return 'Group ' . BF26_GROUP_KEY . ' not found';
	}

	// Current fields, nested (group/repeater sub_fields included).
	$group['fields'] = acf_get_fields( BF26_GROUP_KEY );

	// Idempotent: bail if the strip group is already there.
	foreach ( (array) $group['fields'] as $f ) {
		if ( isset( $f['name'] ) && 'accred_strip' === $f['name'] ) {
			return 'accred_strip already present — nothing to do';
		}
	}

	// Convert to export format (parents become keys, IDs stripped), then append.
	$export = function_exists( 'acf_prepare_field_group_for_export' )
		? acf_prepare_field_group_for_export( $group )
		: $group;

	foreach ( bf26_accred_section_fields() as $new_field ) {
		$export['fields'][] = $new_field;
	}

	acf_import_field_group( $export );
	return 'imported accred_strip (total top-level fields now ' . count( $export['fields'] ) . ')';
}
