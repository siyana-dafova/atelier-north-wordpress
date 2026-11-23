<?php
/**
 * Self-hosted web fonts.
 *
 * @package Atelier_North
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueues the @font-face stylesheet.
 */
function atelier_enqueue_fonts() {
	$path = '/assets/css/fonts.css';

	wp_enqueue_style(
		'atelier-fonts',
		ATELIER_NORTH_URI . $path,
		array(),
		(string) filemtime( ATELIER_NORTH_DIR . $path )
	);
}
add_action( 'wp_enqueue_scripts', 'atelier_enqueue_fonts' );

/**
 * Preloads the fonts used above the fold, so text renders without a late swap.
 *
 * @param array $resources Resources to preload.
 * @return array
 */
function atelier_preload_fonts( $resources ) {
	$critical = array(
		'cormorant-garamond-400.woff2',
		'manrope-400.woff2',
	);

	foreach ( $critical as $file ) {
		$resources[] = array(
			'href'        => ATELIER_NORTH_URI . '/assets/fonts/' . $file,
			'as'          => 'font',
			'type'        => 'font/woff2',
			'crossorigin' => 'anonymous',
		);
	}

	return $resources;
}
add_filter( 'wp_preload_resources', 'atelier_preload_fonts' );
