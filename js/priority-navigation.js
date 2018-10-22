/**
 * Priority navigation.
 */

( function( $ ) {
	var menu = $( '#primary-menu' );
	var more = $( '#more-menu' );
	var hidden = more.find( 'ul.sub-menu' );

	function adjustMenu() {
		hideItems() || showItems();
	}
	
	function hideItems() {
		var w = 0, width = menu.outerWidth() - more.outerWidth(), didHide = false;
		var itemsHidden = hidden.children( 'li' ).length > 0;
		menu.children( 'li' ).not( more ).each( function( i, node ) {
			var item = $( node );
			w += item.outerWidth();
			if ( w > width ) {
				itemsHidden ? item.prependTo( hidden ) : item.appendTo( hidden );;
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
	
	function adjustMenuHandler() {
		if ( window.innerWidth >= 815 ) adjustMenu();
	}
	
	$( window ).resize( adjustMenuHandler );

	adjustMenuHandler();
} ).call( this, jQuery );