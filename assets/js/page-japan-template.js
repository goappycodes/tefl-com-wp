/**
 * Japan Page Template — front-end interactions.
 *
 * Japan Placements: the floating card's ‹ › arrows cycle through the cities in
 * the ACF "Cities" repeater. Switching a city swaps the map image, the card
 * photo/title/text and the right-hand description panel in sync. All city data
 * is printed inline by the template as JSON (.japan-place__data).
 */
( function ( $ ) {
	'use strict';

	$( function () {

		$( '.japan-place[data-place-switch="1"]' ).each( function () {

			var $section = $( this );
			var $data    = $section.find( '.japan-place__data' );

			if ( ! $data.length ) {
				return;
			}

			var cities;
			try {
				cities = JSON.parse( $data.text() );
			} catch ( err ) {
				return;
			}

			if ( ! cities || cities.length < 2 ) {
				return;
			}

			var $map    = $section.find( '.japan-place__map-img' );
			var $photo  = $section.find( '.japan-place__card-photo img' );
			var $cTitle = $section.find( '.japan-place__card-title' );
			var $cText  = $section.find( '.japan-place__card-text' );
			var $pTitle = $section.find( '.japan-place__panel-title' );
			var $pBody  = $section.find( '.japan-place__panel-content' );

			var index = 0;
			var busy  = false;

			function apply( city ) {
				if ( city.map ) {
					$map.attr( 'src', city.map ).attr( 'alt', city.panel_title || '' );
				}
				$photo.attr( 'src', city.photo || '' ).attr( 'alt', city.card_title || '' );
				$cTitle.text( city.card_title || '' );
				$cText.text( city.card_text || '' );
				$pTitle.text( city.panel_title || '' );
				$pBody.html( city.panel_content || '' );
			}

			function go( dir ) {
				if ( busy ) {
					return;
				}
				busy  = true;
				index = ( index + dir + cities.length ) % cities.length;

				// Fade the pieces out, swap content, fade back in.
				$section.addClass( 'is-switching' );
				window.setTimeout( function () {
					apply( cities[ index ] );
					$section.removeClass( 'is-switching' );
					busy = false;
				}, 200 );
			}

			$section.on( 'click', '.japan-place__nav--prev', function ( e ) {
				e.preventDefault();
				go( -1 );
			} );

			$section.on( 'click', '.japan-place__nav--next', function ( e ) {
				e.preventDefault();
				go( 1 );
			} );

		} );

	} );

	/* ----------------------------------------------------------------------
	 * Sticky Table of Contents
	 * Desktop (> 1199px): the floating box is hidden while the hero banner is on
	 * screen, shown (.is-active) once you scroll past it, and hidden again as the
	 * footer comes into view. Small screens use a CSS sticky top bar (no JS).
	 * Links smooth-scroll to their target section.
	 * -------------------------------------------------------------------- */
	$( function () {

		var $toc = $( '.japan-toc' );
		if ( ! $toc.length ) {
			return;
		}

		var $hero    = $( '.japan-hero' );
		var $footer  = $( '#colophon, .site-footer, footer' ).first();
		var mqDesktop = window.matchMedia( '(min-width: 1550px)' );
		var OFFSET   = 100; // sticky-header allowance for smooth scroll

		function update() {
			// On small screens the CSS sticky bar handles everything.
			if ( ! mqDesktop.matches ) {
				$toc.removeClass( 'is-active' );
				return;
			}

			var y         = window.pageYOffset || document.documentElement.scrollTop;
			var vpBottom  = y + window.innerHeight;
			var heroH      = $hero.length ? $hero.outerHeight() : 320;
			var heroBottom = $hero.length ? $hero.offset().top + heroH : 320;
			var footerTop  = $footer.length ? $footer.offset().top : document.body.scrollHeight;

			// Arrive as the banner is nearly out — once only ~25% of it remains.
			var pastHero    = y > ( heroBottom - heroH * 0.25 );
			var beforeFooter = footerTop > ( vpBottom - 40 );

			$toc.toggleClass( 'is-active', pastHero && beforeFooter );
		}

		$( window ).on( 'scroll resize', update );
		update();

		// Smooth-scroll the links to their target section.
		$toc.on( 'click', '.japan-toc__link', function ( e ) {
			var sel = $( this ).attr( 'data-target' );
			if ( ! sel ) {
				return;
			}
			var $target = $( sel ).first();
			if ( ! $target.length ) {
				return;
			}
			e.preventDefault();
			$( 'html, body' ).animate( { scrollTop: $target.offset().top - OFFSET }, 500 );
		} );

	} );

} )( jQuery );
