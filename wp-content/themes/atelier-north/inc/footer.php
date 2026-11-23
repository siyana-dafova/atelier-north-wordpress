<?php
/**
 * Footer content: contact details and legal links.
 *
 * Contact details are filled by the plugin settings (an_get_option, Phase 2.5)
 * or by the atelier_contact_details filter. Until then the contact column
 * links to the contact page.
 *
 * @package Atelier_North
 */

defined( 'ABSPATH' ) || exit;

/**
 * Contact details shown in the footer.
 *
 * @return array{email: string, phone: string, address: string, map_url: string}
 */
function atelier_get_contact_details() {
	$details = array(
		'email'   => '',
		'phone'   => '',
		'address' => '',
		'map_url' => '',
	);

	if ( function_exists( 'an_get_option' ) ) {
		$details['email']   = (string) an_get_option( 'email' );
		$details['phone']   = (string) an_get_option( 'phone' );
		$details['address'] = (string) an_get_option( 'address' );
		$details['map_url'] = (string) an_get_option( 'map_link' );
	}

	/**
	 * Filters the contact details shown in the footer.
	 *
	 * @param array $details email, phone, address and map_url.
	 */
	$details = apply_filters( 'atelier_contact_details', $details );

	if ( ! is_array( $details ) ) {
		$details = array();
	}

	$details = wp_parse_args(
		$details,
		array(
			'email'   => '',
			'phone'   => '',
			'address' => '',
			'map_url' => '',
		)
	);

	return array(
		'email'   => sanitize_email( (string) $details['email'] ),
		'phone'   => sanitize_text_field( (string) $details['phone'] ),
		'address' => sanitize_textarea_field( (string) $details['address'] ),
		'map_url' => esc_url_raw( (string) $details['map_url'] ),
	);
}

/**
 * Address with line breaks preserved and every line escaped.
 *
 * @param string $address Multiline address.
 * @return string
 */
function atelier_format_address( $address ) {
	$lines = preg_split( "/\r\n|\r|\n/", $address );

	if ( ! is_array( $lines ) ) {
		return '';
	}

	$html = '';

	foreach ( $lines as $index => $line ) {
		if ( $index > 0 ) {
			$html .= '<br>';
		}

		$html .= esc_html( $line );
	}

	return $html;
}

/**
 * Permalink for a page slug, or the expected URL when the page does not exist yet.
 *
 * @param string $slug Page slug.
 * @return string
 */
function atelier_get_page_url( $slug ) {
	$page = get_page_by_path( $slug );

	if ( $page instanceof WP_Post ) {
		$url = get_permalink( $page );

		if ( $url ) {
			return $url;
		}
	}

	return home_url( '/' . trim( $slug, '/' ) . '/' );
}

/**
 * Legal links for the footer bottom row.
 *
 * @return array<int, array{label: string, url: string}>
 */
function atelier_get_legal_links() {
	$privacy = get_privacy_policy_url();

	$links = array(
		array(
			'label' => __( 'Privacy policy', 'atelier-north' ),
			'url'   => $privacy ? $privacy : atelier_get_page_url( 'privacy-policy' ),
		),
		array(
			'label' => __( 'Terms', 'atelier-north' ),
			'url'   => atelier_get_page_url( 'terms' ),
		),
		array(
			'label' => __( 'Cookie policy', 'atelier-north' ),
			'url'   => atelier_get_page_url( 'cookie-policy' ),
		),
	);

	/**
	 * Filters the legal links in the footer.
	 *
	 * @param array $links List of label/url pairs.
	 */
	$links = apply_filters( 'atelier_legal_links', $links );

	if ( ! is_array( $links ) ) {
		return array();
	}

	$clean = array();

	foreach ( $links as $link ) {
		if ( ! is_array( $link ) || empty( $link['label'] ) || empty( $link['url'] ) ) {
			continue;
		}

		$clean[] = array(
			'label' => sanitize_text_field( $link['label'] ),
			'url'   => esc_url_raw( $link['url'] ),
		);
	}

	return $clean;
}
