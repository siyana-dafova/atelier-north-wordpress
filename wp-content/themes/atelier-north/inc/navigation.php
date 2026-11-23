<?php
/**
 * Navigation helpers.
 *
 * @package Atelier_North
 */

defined( 'ABSPATH' ) || exit;

/**
 * Whether the header starts transparent and sits over a dark hero.
 *
 * Templates opt in: add_filter( 'atelier_transparent_header', '__return_true' ).
 * The header turns solid once the sentinel scrolls out of view.
 *
 * @return bool
 */
function atelier_has_transparent_header() {
	return (bool) apply_filters( 'atelier_transparent_header', false );
}

/**
 * Adds a body class when the transparent header is active.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function atelier_header_body_class( $classes ) {
	if ( atelier_has_transparent_header() ) {
		$classes[] = 'has-transparent-header';
	}

	return $classes;
}
add_filter( 'body_class', 'atelier_header_body_class' );

/**
 * Default page links, used until a menu is assigned in Appearance > Menus.
 *
 * @return array<string, string> Slug => label.
 */
function atelier_default_nav_items() {
	return array(
		'projects' => __( 'Projects', 'atelier-north' ),
		'services' => __( 'Services', 'atelier-north' ),
		'about'    => __( 'About', 'atelier-north' ),
		'journal'  => __( 'Journal', 'atelier-north' ),
		'contact'  => __( 'Contact', 'atelier-north' ),
	);
}

/**
 * Prints a fallback menu list.
 *
 * @param array<string, string> $items      Slug => label.
 * @param string                $list_class Class for the list.
 * @param string                $item_class Class for each item. A `--current` modifier is added.
 */
function atelier_render_fallback_menu( $items, $list_class, $item_class ) {
	echo '<ul class="' . esc_attr( $list_class ) . '">';

	foreach ( $items as $slug => $label ) {
		$url     = home_url( '/' . $slug . '/' );
		$current = atelier_is_current_url( $url );
		$class   = $item_class . ( $current ? ' ' . $item_class . '--current' : '' );

		printf(
			'<li class="%1$s"><a href="%2$s"%3$s>%4$s</a></li>',
			esc_attr( $class ),
			esc_url( $url ),
			$current ? ' aria-current="page"' : '',
			esc_html( $label )
		);
	}

	echo '</ul>';
}

/**
 * Fallback for the primary menu, used until a menu is assigned in Appearance > Menus.
 */
function atelier_primary_menu_fallback() {
	atelier_render_fallback_menu( atelier_default_nav_items(), 'site-nav__list', 'site-nav__item' );
}

/**
 * Fallback for the footer menu.
 */
function atelier_footer_menu_fallback() {
	atelier_render_fallback_menu( atelier_default_nav_items(), 'site-footer__list', 'site-footer__item' );
}

/**
 * Social profiles for the footer.
 *
 * A menu assigned to the Social location replaces this list. Until then, URLs come from
 * an_get_option() (Phase 2.5 keys: instagram, pinterest, behance, linkedin) or the
 * atelier_social_links filter. Entries without a URL are printed as text.
 *
 * @return array<int, array{label: string, url: string}>
 */
function atelier_get_social_links() {
	$links = array(
		'instagram' => array(
			'label' => __( 'Instagram', 'atelier-north' ),
			'url'   => '',
		),
		'pinterest' => array(
			'label' => __( 'Pinterest', 'atelier-north' ),
			'url'   => '',
		),
		'behance'   => array(
			'label' => __( 'Behance', 'atelier-north' ),
			'url'   => '',
		),
		'linkedin'  => array(
			'label' => __( 'LinkedIn', 'atelier-north' ),
			'url'   => '',
		),
	);

	if ( function_exists( 'an_get_option' ) ) {
		foreach ( array_keys( $links ) as $key ) {
			$links[ $key ]['url'] = (string) an_get_option( $key );
		}
	}

	/**
	 * Filters the social profiles shown when no Social menu is assigned.
	 *
	 * @param array $links Keyed list of label/url pairs.
	 */
	$links = apply_filters( 'atelier_social_links', $links );

	if ( ! is_array( $links ) ) {
		return array();
	}

	$clean = array();

	foreach ( $links as $link ) {
		if ( ! is_array( $link ) || empty( $link['label'] ) ) {
			continue;
		}

		$clean[] = array(
			'label' => sanitize_text_field( $link['label'] ),
			'url'   => empty( $link['url'] ) ? '' : esc_url_raw( $link['url'] ),
		);
	}

	return $clean;
}

/**
 * Fallback for the social menu.
 */
function atelier_social_menu_fallback() {
	$links = atelier_get_social_links();

	if ( ! $links ) {
		return;
	}

	echo '<ul class="site-footer__list">';

	foreach ( $links as $link ) {
		echo '<li class="site-footer__item">';

		if ( $link['url'] ) {
			printf(
				'<a href="%1$s">%2$s</a>',
				esc_url( $link['url'] ),
				esc_html( $link['label'] )
			);
		} else {
			echo esc_html( $link['label'] );
		}

		echo '</li>';
	}

	echo '</ul>';
}

/**
 * Compares a URL with the current request path.
 *
 * @param string $url Absolute URL.
 * @return bool
 */
function atelier_is_current_url( $url ) {
	$request = isset( $GLOBALS['wp']->request ) ? (string) $GLOBALS['wp']->request : '';
	$current = untrailingslashit( home_url( $request ) );

	return untrailingslashit( $url ) === $current;
}
