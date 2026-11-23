<?php
/**
 * SVG icons from assets/icons/sprite.svg.
 *
 * @package Atelier_North
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the markup for a sprite icon. Decorative by default (hidden from screen readers).
 *
 * @param string $name  Symbol id in sprite.svg, e.g. 'arrow-right'.
 * @param string $label Accessible label; when set, the icon is exposed as an image.
 * @return string
 */
function atelier_get_icon( $name, $label = '' ) {
	$href = ATELIER_NORTH_URI . '/assets/icons/sprite.svg?ver=' . ATELIER_NORTH_VERSION . '#' . $name;
	$a11y = '' === $label
		? 'aria-hidden="true" focusable="false"'
		: sprintf( 'role="img" aria-label="%s"', esc_attr( $label ) );

	return sprintf(
		'<svg class="icon icon--%1$s" %2$s><use href="%3$s"></use></svg>',
		esc_attr( $name ),
		$a11y,
		esc_url( $href )
	);
}

/**
 * Prints a sprite icon.
 *
 * @param string $name  Symbol id in sprite.svg.
 * @param string $label Optional accessible label.
 */
function atelier_icon( $name, $label = '' ) {
	echo atelier_get_icon( $name, $label ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- All parts are escaped in atelier_get_icon().
}
