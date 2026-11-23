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
	$styles = array( 'tokens', 'base', 'layout' );
	$deps   = array( 'atelier-fonts' );

	foreach ( $styles as $name ) {
		$path   = '/assets/css/' . $name . '.css';
		$handle = 'atelier-' . $name;

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
