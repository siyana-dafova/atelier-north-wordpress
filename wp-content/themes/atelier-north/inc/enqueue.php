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
		'components/header',
		'components/footer',
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
 * Removes the block-library styles. The front-end does not render core blocks.
 */
function atelier_dequeue_block_styles() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'classic-theme-styles' );
	wp_dequeue_style( 'global-styles' );

	// Core enqueues this again from the footer.
	remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
}
add_action( 'wp_enqueue_scripts', 'atelier_dequeue_block_styles', 100 );

/**
 * Enqueues the theme script modules and the conditional ones for later templates.
 *
 * A conditional script is skipped until its file exists, so the templates can land one at a time.
 */
function atelier_enqueue_scripts() {
	atelier_register_module( 'atelier-config', '/assets/js/config.js' );

	wp_enqueue_script_module(
		'atelier-header',
		ATELIER_NORTH_URI . '/assets/js/header.js',
		array( 'atelier-config' ),
		(string) filemtime( ATELIER_NORTH_DIR . '/assets/js/header.js' )
	);

	atelier_enqueue_module( 'atelier-reveal', '/assets/js/reveal.js' );

	$conditional = array(
		'atelier-filters'  => array(
			'file' => '/assets/js/filters.js',
			'load' => is_post_type_archive( 'project' ) || is_tax( 'project_type' ),
		),
		'atelier-lightbox' => array(
			'file' => '/assets/js/lightbox.js',
			'load' => is_singular( 'project' ),
		),
		'atelier-contact'  => array(
			'file' => '/assets/js/contact.js',
			'load' => is_page_template( 'page-contact.php' ) || is_page( 'contact' ),
		),
	);

	foreach ( $conditional as $id => $script ) {
		if ( $script['load'] ) {
			atelier_enqueue_module( $id, $script['file'] );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'atelier_enqueue_scripts' );

/**
 * Registers a script module when the file exists.
 *
 * @param string $id       Module identifier.
 * @param string $relative Path relative to the theme directory.
 */
function atelier_register_module( $id, $relative ) {
	$path = ATELIER_NORTH_DIR . $relative;

	if ( ! is_readable( $path ) ) {
		return;
	}

	wp_register_script_module(
		$id,
		ATELIER_NORTH_URI . $relative,
		array(),
		(string) filemtime( $path )
	);
}

/**
 * Enqueues a registered-on-the-fly script module when the file exists.
 *
 * @param string $id       Module identifier.
 * @param string $relative Path relative to the theme directory.
 */
function atelier_enqueue_module( $id, $relative ) {
	$path = ATELIER_NORTH_DIR . $relative;

	if ( ! is_readable( $path ) ) {
		return;
	}

	wp_enqueue_script_module(
		$id,
		ATELIER_NORTH_URI . $relative,
		array(),
		(string) filemtime( $path )
	);
}

/**
 * Data for the config module: REST endpoint, nonce and strings shared by the scripts.
 *
 * @param array $data Module data.
 * @return array
 */
function atelier_script_config( $data ) {
	$data['restUrl'] = esc_url_raw( rest_url( 'atelier/v1/' ) );
	$data['nonce']   = wp_create_nonce( 'wp_rest' );
	$data['i18n']    = array(
		'openMenu'  => __( 'Open menu', 'atelier-north' ),
		'closeMenu' => __( 'Close menu', 'atelier-north' ),
		'loading'   => __( 'Loading', 'atelier-north' ),
		'close'     => __( 'Close', 'atelier-north' ),
	);

	return $data;
}
add_filter( 'script_module_data_atelier-config', 'atelier_script_config' );

/**
 * Adds a `js` class to <html> before first paint, so JS-only states never hide content without JS.
 */
function atelier_js_class() {
	wp_print_inline_script_tag( "document.documentElement.classList.add('js');" );
}
add_action( 'wp_head', 'atelier_js_class', 0 );
