<?php
/**
 * Single source of truth for the .com mobile menu.
 *
 * Desktop nav = custom ACF mega menu (`new_mega_menu()` / `mega_menu_items`).
 * Mobile nav  = WP nav menu 17 (`#primary-menu`), opened by the hamburger; hidden on desktop.
 * This filters menu 17's output at render time so it mirrors the ACF mega menu — one edit, both menus.
 * Non-destructive: menu 17 is untouched in the DB; removing this file's filter reverts instantly.
 *
 * @package teflinstitute
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! defined( 'TI_MOBILE_MENU_TERM' ) ) {
	define( 'TI_MOBILE_MENU_TERM', 17 ); // "Quick Link Menu" = #primary-menu = the mobile menu.
}

/** URL from an ACF value that may be a link array or a plain string. */
function ti_acf_link_url( $v ) {
	if ( is_array( $v ) ) {
		return ! empty( $v['url'] ) ? esc_url( $v['url'] ) : '';
	}
	$v = (string) $v;
	return '' !== $v ? esc_url( $v ) : '';
}

/** Title from an ACF link array (empty for plain strings). */
function ti_acf_link_title( $v ) {
	return ( is_array( $v ) && ! empty( $v['title'] ) ) ? trim( wp_strip_all_tags( $v['title'] ) ) : '';
}

/**
 * Build the mobile menu <li> markup from the ACF mega menu.
 * Returns '' if ACF is empty (so the filter leaves the stored menu alone).
 */
function ti_mega_menu_to_mobile_items() {
	if ( ! function_exists( 'get_field' ) ) { return ''; }
	$items = get_field( 'mega_menu_items', 'option' );
	if ( empty( $items ) || ! is_array( $items ) ) { return ''; }

	$toggle = '<button class="ast-menu-toggle" aria-expanded="false"><span class="screen-reader-text">Menu Toggle</span><span class="ast-icon icon-arrow"></span></button>';
	$clean  = function ( $s ) {
		return trim( wp_strip_all_tags( str_ireplace( array( '</br>', '<br>', '<br/>', '<br />' ), ' ', (string) $s ) ) );
	};

	$out = '';
	foreach ( $items as $mm ) {
		$title = $clean( $mm['menu_title'] ?? '' );
		if ( '' === $title ) { continue; }
		$top_url = ti_acf_link_url( $mm['menu_link'] ?? '' );
		$top_url = $top_url ? $top_url : '#';

		$seen     = array(); // de-dupe links within this top item.
		$children = '';

		// Sub-menu GROUPS → nested collapsible level (header = toggle, items beneath).
		$groups = array();
		if ( ! empty( $mm['sub_menu'] ) && is_array( $mm['sub_menu'] ) ) {
			$groups = array_merge( $groups, $mm['sub_menu'] );
		}
		if ( ! empty( $mm['extra_sub_menu'] ) && is_array( $mm['extra_sub_menu'] ) ) {
			$groups = array_merge( $groups, $mm['extra_sub_menu'] );
		}
		foreach ( $groups as $grp ) {
			$header    = $clean( $grp['sub_menu_header'] ?? '' );
			$sub_items = ( isset( $grp['sub_menu_item'] ) && is_array( $grp['sub_menu_item'] ) ) ? $grp['sub_menu_item'] : array();
			$items_html = '';
			foreach ( $sub_items as $sm ) {
				$st = $clean( $sm['sub_menu_title'] ?? '' );
				if ( '' === $st ) { continue; }
				$su  = ti_acf_link_url( $sm['sub_menu_link'] ?? '' );
				$key = strtolower( $st ) . '|' . $su;
				if ( isset( $seen[ $key ] ) ) { continue; }
				$seen[ $key ] = 1;
				$items_html .= '<li class="menu-item menu-item-type-custom"><a class="menu-link" href="' . ( $su ? $su : '#' ) . '">' . esc_html( $st ) . '</a></li>';
			}
			if ( '' === $items_html ) { continue; }
			if ( '' !== $header ) {
				$children .= '<li class="menu-item menu-item-type-custom menu-item-has-children" aria-haspopup="true"><a class="menu-link" href="#" aria-expanded="false">' . esc_html( $header ) . '</a>' . $toggle . '<ul class="sub-menu">' . $items_html . '</ul></li>';
			} else {
				$children .= $items_html; // headerless group → flat
			}
		}

		// CTA-block button links → flat, directly under the top item.
		if ( ! empty( $mm['menu_cta_block'] ) && is_array( $mm['menu_cta_block'] ) ) {
			foreach ( array( 'left_block', 'right_block' ) as $side ) {
				$btns = ( isset( $mm['menu_cta_block'][ $side ]['cta_buttons'] ) && is_array( $mm['menu_cta_block'][ $side ]['cta_buttons'] ) ) ? $mm['menu_cta_block'][ $side ]['cta_buttons'] : array();
				foreach ( $btns as $btn ) {
					$bt = $clean( $btn['button_text'] ?? '' );
					if ( '' === $bt ) { $bt = ti_acf_link_title( $btn['button_link'] ?? '' ); }
					$bu = ti_acf_link_url( $btn['button_link'] ?? '' );
					if ( '' === $bt || '' === $bu ) { continue; }
					$key = strtolower( $bt ) . '|' . $bu;
					if ( isset( $seen[ $key ] ) ) { continue; }
					$seen[ $key ] = 1;
					$children .= '<li class="menu-item menu-item-type-custom"><a class="menu-link" href="' . $bu . '">' . esc_html( $bt ) . '</a></li>';
				}
			}
		}

		$has_children = ( '' !== $children );
		$li_class     = 'menu-item menu-item-type-custom' . ( $has_children ? ' menu-item-has-children' : '' );
		$out         .= '<li class="' . $li_class . '"' . ( $has_children ? ' aria-haspopup="true"' : '' ) . '>';
		$out         .= '<a class="menu-link" href="' . $top_url . '"' . ( $has_children ? ' aria-expanded="false"' : '' ) . '>' . esc_html( $title ) . '</a>';
		if ( $has_children ) {
			$out .= $toggle . '<ul class="sub-menu">' . $children . '</ul>';
		}
		$out .= '</li>';
	}
	return $out;
}

/** Resolve the nav menu term object from wp_nav_menu $args. */
function ti_nav_args_menu_obj( $args ) {
	$menu_obj = null;
	if ( is_object( $args->menu ) ) {
		$menu_obj = $args->menu;
	} elseif ( ! empty( $args->menu ) ) {
		$menu_obj = wp_get_nav_menu_object( $args->menu );
	}
	if ( ! $menu_obj && ! empty( $args->theme_location ) ) {
		$locs = get_nav_menu_locations();
		if ( ! empty( $locs[ $args->theme_location ] ) ) {
			$menu_obj = wp_get_nav_menu_object( $locs[ $args->theme_location ] );
		}
	}
	return $menu_obj;
}

/** Primary: intercept menu 17 before any cache short-circuit and render it from the ACF. */
add_filter( 'pre_wp_nav_menu', 'ti_mobile_menu_pre_mega', 1, 2 );
function ti_mobile_menu_pre_mega( $output, $args ) {
	$menu_obj = ti_nav_args_menu_obj( $args );
	if ( ! $menu_obj || TI_MOBILE_MENU_TERM !== (int) $menu_obj->term_id ) {
		return $output;
	}
	$items = ti_mega_menu_to_mobile_items();
	if ( ! $items ) {
		return $output;
	}
	$menu_id  = ! empty( $args->menu_id ) ? $args->menu_id : ( 'menu-' . $menu_obj->slug );
	$menu_cls = ! empty( $args->menu_class ) ? $args->menu_class : 'menu';
	$wrap_tpl = ! empty( $args->items_wrap ) ? $args->items_wrap : '<ul id="%1$s" class="%2$s">%3$s</ul>';
	$nav      = sprintf( $wrap_tpl, esc_attr( $menu_id ), esc_attr( $menu_cls ), $items );
	if ( ! empty( $args->container ) ) {
		$cid    = ! empty( $args->container_id ) ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
		$cclass = ! empty( $args->container_class ) ? ' class="' . esc_attr( $args->container_class ) . '"' : '';
		$nav    = '<' . $args->container . $cid . $cclass . '>' . $nav . '</' . $args->container . '>';
	}
	return $nav;
}

/** Fallback: if pre_wp_nav_menu did not short-circuit, swap menu 17's items. */
add_filter( 'wp_nav_menu_items', 'ti_mobile_menu_items_mega', 20, 2 );
function ti_mobile_menu_items_mega( $items, $args ) {
	$menu_obj = ti_nav_args_menu_obj( $args );
	if ( $menu_obj && TI_MOBILE_MENU_TERM === (int) $menu_obj->term_id ) {
		$gen = ti_mega_menu_to_mobile_items();
		if ( $gen ) {
			return $gen;
		}
	}
	return $items;
}
