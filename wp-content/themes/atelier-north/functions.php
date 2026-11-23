<?php
/**
 * Atelier North theme bootstrap.
 *
 * @package Atelier_North
 */

defined( 'ABSPATH' ) || exit;

define( 'ATELIER_NORTH_VERSION', wp_get_theme( get_template() )->get( 'Version' ) );
define( 'ATELIER_NORTH_DIR', get_template_directory() );
define( 'ATELIER_NORTH_URI', get_template_directory_uri() );

$atelier_inc_files = glob( ATELIER_NORTH_DIR . '/inc/*.php' );

if ( $atelier_inc_files ) {
	sort( $atelier_inc_files );

	foreach ( $atelier_inc_files as $atelier_inc_file ) {
		require_once $atelier_inc_file;
	}
}

unset( $atelier_inc_files, $atelier_inc_file );
