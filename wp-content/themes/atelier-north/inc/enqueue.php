<?php
/**
 * Front-end styles and scripts.
 *
 * @package Atelier_North
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueues the theme stylesheets, each depending on the previous one to keep the cascade order.
 */
function atelier_enqueue_styles() {
	$styles = array(
		'tokens',
		'base',
		'layout',
		'components/typography',
		'components/buttons',
		'components/media',
		'components/cards',
		'components/forms',
		'components/reveal',
	);
	$deps   = array( 'atelier-fonts' );

	foreach ( $styles as $name ) {
		$path   = '/assets/css/' . $name . '.css';
		$handle = 'atelier-' . str_replace( '/', '-', $name );

		wp_enqueue_style(
			$handle,
			ATELIER_NORTH_URI . $path,
			$deps,
			(string) filemtime( ATELIER_NORTH_DIR . $path )
		);

		$deps = array( $handle );
	}
}
add_action( 'wp_enqueue_scripts', 'atelier_enqueue_styles' );

/**
 * Enqueues the theme scripts.
 */
function atelier_enqueue_scripts() {
	$path = '/assets/js/reveal.js';

	wp_enqueue_script(
		'atelier-reveal',
		ATELIER_NORTH_URI . $path,
		array(),
		(string) filemtime( ATELIER_NORTH_DIR . $path ),
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);
}
add_action( 'wp_enqueue_scripts', 'atelier_enqueue_scripts' );

/**
 * Adds a `js` class to <html> before first paint, so JS-only states (e.g. reveal) never hide content without JS.
 */
function atelier_js_class() {
	wp_print_inline_script_tag( "document.documentElement.classList.add('js');" );
}
add_action( 'wp_head', 'atelier_js_class', 0 );
