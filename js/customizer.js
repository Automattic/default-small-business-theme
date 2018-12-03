/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Hide Front Page Title
	wp.customize( 'hide_front_page_title', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				console.log( 'change CSS' );
				$( '.home .entry-title' ).css( {
					'display': 'none',
				} );

				$( '.home .hentry' ).css ( {
					'margin-top': '0',
				} );

				$( '.hentry .entry-content > :first-child' ).css ( {
					'margin-top': '0',
				} );

			} else {
				$( '.home .entry-title' ).css( {
					'display': 'block',
				} );

				$( '.home .hentry' ).css ( {
					'margin': 'calc(2 * 1.5rem) 0',
				} );

				$( '.hentry .entry-content > .alignfull:first-child' ).css ( {
					'margin-top': '1em',
				} );

			}
		} );
	} );
} )( jQuery );
