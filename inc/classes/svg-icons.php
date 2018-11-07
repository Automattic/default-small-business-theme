<?php
/**
 * SVG Icons class.
 *
 * This class is in charge of displaying SVG icons across the site.
 *
 * Place each <svg> source on its own array key, without adding the
 * both `width` and `height` attributes, since these are added dnamically,
 * before rendering the SVG code.
 *
 * All icons are assumed to have equal width and height, hence the option
 * to only specify a `$size` parameter in the svg methods.
 *
 * @package Default_Small_Business_Theme
 */

class Default_Small_Business_Theme_SVG_Icons {

	/**
	 * Gets the SVG code for a given icon.
	 */
	public static function get_svg( $group, $icon, $size ) {
		if ( 'ui' == $group ) {
			$arr = self::$ui_icons;
		} else if ( 'social' == $group ) {
			$arr = self::$social_icons;
		} else {
			$arr = array();
		}
		if ( array_key_exists( $icon, $arr ) ) {
			$repl = sprintf( '<svg id="%s-icon-%s" class="svg-icon" width="%d" height="%d" aria-hidden="true" role="img"', $group, $icon, $size, $size );
			$svg = preg_replace( '/^<svg /', $repl, trim( $arr[ $icon ] ) ); // Add extra attributes to SVG code.
			$svg = preg_replace( "/([\n\t]+)/", '', $svg ); // Remove newlines & tabs.
			$svg = preg_replace( "/>\s*</", '><', $svg ); // Remove white space between SVG tags.
			return $svg;
		}
		return null;
	}

	/**
	 * User Interface icons – svg sources.
	 */
	static $ui_icons = array(
		'more_horiz' => /* material-design – more_horiz */ '
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
    <path d="M0 0h24v24H0z" fill="none"/>
    <path d="M6 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm12 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
</svg>',

		'expand_more' => /* material-design – expand_more */ '
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
	<path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/>
	<path d="M0 0h24v24H0z" fill="none"/>
</svg>',

		'link' => /* material-design – link */ '
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
    <path d="M0 0h24v24H0z" fill="none"/>
    <path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"/>
</svg>',

		'watch' => /* material-design – watch-later */ '
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
    <defs>
        <path id="a" d="M0 0h24v24H0V0z"/>
    </defs>
    <clipPath id="b">
        <use xlink:href="#a" overflow="visible"/>
    </clipPath>
    <path clip-path="url(#b)" d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm4.2 14.2L11 13V7h1.5v5.2l4.5 2.7-.8 1.3z"/>
</svg>',

		'archive' => /* material-design – folder */ '
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
    <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/>
    <path d="M0 0h24v24H0z" fill="none"/>
</svg>',

		'comment' => /* material-design – comment */ '
<svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18z"/>
    <path d="M0 0h24v24H0z" fill="none"/>
</svg>',

		'person' => /* material-design – person */ '
<svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
    <path d="M0 0h24v24H0z" fill="none"/>
</svg>',

		'edit' => /* material-design – edit */ '
<svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
    <path d="M0 0h24v24H0z" fill="none"/>
</svg>',

		'chevron_left' => /* material-design – chevron_left */ '
<svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
    <path d="M0 0h24v24H0z" fill="none"/>
</svg>',

		'chevron_right' => /* material-design – chevron_right */ '
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
    <path d="M0 0h24v24H0z" fill="none"/>
</svg>',

		'check' => /* material-design – check */ '
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
    <path d="M0 0h24v24H0z" fill="none"/>
    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
</svg>',

	);
}