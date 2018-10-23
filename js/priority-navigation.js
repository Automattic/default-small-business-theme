/**
 * Priority navigation.
 */

( function( $, mobileBreakpoint ) {
	var menu = $( '#primary-menu' );
	var more = $( '#more-menu' ).hide();
	var hidden = more.find( 'ul.sub-menu' );
	
	function adjustMenu() {
		if ( window.innerWidth >= mobileBreakpoint ) {
			hideItems() || showItems();
			hidden.children( 'li' ).length > 0 ? more.show() : more.hide();
		} else {
			hidden.children( 'li' ).each( function( i, node ) {
				$( node ).insertBefore( more );
			} );
			more.hide();
		}
	}

	function hideItems() {
		var w = 0, width = menu.outerWidth() - more.outerWidth(), didHide = false;
		var itemsHidden = hidden.children( 'li' ).length > 0;
		menu.children( 'li' ).not( more ).each( function( i, node ) {
			var item = $( node );
			w += item.outerWidth();
			if ( w > width ) {
				itemsHidden ? item.prependTo( hidden ) : item.appendTo( hidden );
				didHide = true;
			}
		} );
		return didHide;
	}

	function showItems() {
		var width = menu.outerWidth() - more.outerWidth();
		var visibleWidth = menu.children( 'li' ).not( more ).toArray().reduce( function( w, node ) {
			return w + $( node ).outerWidth();
		}, 0 );
		hidden.children( 'li' ).each( function( i, node ) {
			var item = $( node ), w = item.outerWidth();
			if ( ( visibleWidth + w ) < width ) {
				item.insertBefore( more );
				visibleWidth += w;
			}
		} );
	}
	
	$( window ).resize( adjustMenu );

	adjustMenu();
} ).call( this, jQuery, 815 );