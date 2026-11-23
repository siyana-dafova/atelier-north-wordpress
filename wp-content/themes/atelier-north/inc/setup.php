<?php
/**
 * Theme supports, image sizes, menus and front-end head cleanup.
 *
 * @package Atelier_North
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers theme supports, cropped image sizes and navigation menus.
 */
function atelier_setup() {
	load_theme_textdomain( 'atelier-north', ATELIER_NORTH_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 88,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Hard crops. Sizes that share an aspect ratio are combined by core into one srcset.
	add_image_size( 'an-hero', 1920, 1000, true );
	add_image_size( 'an-hero-md', 1280, 667, true );
	add_image_size( 'an-hero-sm', 768, 400, true );
	add_image_size( 'an-hero-mobile', 800, 1000, true );
	add_image_size( 'an-project-large', 1200, 1500, true );
	add_image_size( 'an-project-card', 800, 1000, true );
	add_image_size( 'an-service-card', 600, 750, true );
	add_image_size( 'an-editorial', 1000, 700, true );
	add_image_size( 'an-editorial-sm', 600, 420, true );

	register_nav_menus(
		array(
			'primary' => __( 'Primary', 'atelier-north' ),
			'footer'  => __( 'Footer', 'atelier-north' ),
			'social'  => __( 'Social', 'atelier-north' ),
		)
	);
}
add_action( 'after_setup_theme', 'atelier_setup' );

/**
 * Adds the sizes an editor would actually choose. The smaller siblings exist only for srcset.
 *
 * @param array $sizes Image size names.
 * @return array
 */
function atelier_image_size_names( $sizes ) {
	return array_merge(
		$sizes,
		array(
			'an-hero'          => __( 'Hero', 'atelier-north' ),
			'an-project-large' => __( 'Project, large', 'atelier-north' ),
			'an-project-card'  => __( 'Project card', 'atelier-north' ),
			'an-service-card'  => __( 'Service card', 'atelier-north' ),
			'an-editorial'     => __( 'Editorial', 'atelier-north' ),
		)
	);
}
add_filter( 'image_size_names_choose', 'atelier_image_size_names' );

/**
 * Removes emoji scripts, oEmbed discovery links and other unused head output.
 */
function atelier_disable_head_clutter() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
	remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'template_redirect', 'rest_output_link_header', 11 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 4 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'embed_head', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	add_filter( 'tiny_mce_plugins', 'atelier_disable_emoji_plugin' );
}
add_action( 'after_setup_theme', 'atelier_disable_head_clutter' );

/**
 * Drops the emoji plugin from the classic editor.
 *
 * @param array $plugins TinyMCE plugins.
 * @return array
 */
function atelier_disable_emoji_plugin( $plugins ) {
	if ( ! is_array( $plugins ) ) {
		return array();
	}

	return array_diff( $plugins, array( 'wpemoji' ) );
}
