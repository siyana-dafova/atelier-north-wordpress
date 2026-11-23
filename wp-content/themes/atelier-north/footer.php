<?php
/**
 * Site footer.
 *
 * @package Atelier_North
 */

$atelier_contact = atelier_get_contact_details();
$atelier_legal   = atelier_get_legal_links();
$atelier_phrase  = __( 'Get in touch', 'atelier-north' );
$atelier_phone   = preg_replace( '/[^\d+]/', '', $atelier_contact['phone'] );
$atelier_phone   = is_string( $atelier_phone ) ? $atelier_phone : '';
?>
<footer class="site-footer">
	<a class="site-footer__marquee" href="<?php echo esc_url( atelier_get_page_url( 'contact' ) ); ?>" aria-label="<?php echo esc_attr( $atelier_phrase ); ?>">
		<span class="site-footer__marquee-track" aria-hidden="true">
			<?php for ( $atelier_group = 0; $atelier_group < 2; $atelier_group++ ) : ?>
				<span class="site-footer__marquee-group">
					<?php for ( $atelier_copy = 0; $atelier_copy < 8; $atelier_copy++ ) : ?>
						<span class="site-footer__marquee-item">
							<?php echo esc_html( $atelier_phrase ); ?>
							<span class="site-footer__marquee-dot">&middot;</span>
						</span>
					<?php endfor; ?>
				</span>
			<?php endfor; ?>
		</span>
	</a>

	<div class="site-footer__main">
		<div class="container site-footer__grid">
			<div class="site-footer__brand">
				<a class="site-footer__name" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php if ( get_bloginfo( 'description' ) ) : ?>
					<p class="site-footer__tagline"><?php bloginfo( 'description' ); ?></p>
				<?php endif; ?>
			</div>

			<nav class="site-footer__col" aria-labelledby="footer-menu-label">
				<p id="footer-menu-label" class="site-footer__heading label"><?php esc_html_e( 'Menu', 'atelier-north' ); ?></p>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'site-footer__list',
						'menu_id'        => '',
						'depth'          => 1,
						'fallback_cb'    => 'atelier_footer_menu_fallback',
					)
				);
				?>
			</nav>

			<nav class="site-footer__col" aria-labelledby="footer-social-label">
				<p id="footer-social-label" class="site-footer__heading label"><?php esc_html_e( 'Follow us', 'atelier-north' ); ?></p>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'container'      => false,
						'menu_class'     => 'site-footer__list',
						'menu_id'        => '',
						'depth'          => 1,
						'fallback_cb'    => 'atelier_social_menu_fallback',
					)
				);
				?>
			</nav>

			<div class="site-footer__col">
				<p class="site-footer__heading label"><?php esc_html_e( 'Contact', 'atelier-north' ); ?></p>
				<div class="site-footer__stack">
					<?php if ( $atelier_contact['address'] ) : ?>
						<?php if ( $atelier_contact['map_url'] ) : ?>
							<a class="site-footer__address" href="<?php echo esc_url( $atelier_contact['map_url'] ); ?>">
								<?php echo wp_kses( atelier_format_address( $atelier_contact['address'] ), array( 'br' => array() ) ); ?>
							</a>
						<?php else : ?>
							<p class="site-footer__address">
								<?php echo wp_kses( atelier_format_address( $atelier_contact['address'] ), array( 'br' => array() ) ); ?>
							</p>
						<?php endif; ?>
					<?php elseif ( $atelier_contact['map_url'] ) : ?>
						<a href="<?php echo esc_url( $atelier_contact['map_url'] ); ?>"><?php esc_html_e( 'Map', 'atelier-north' ); ?></a>
					<?php endif; ?>

					<?php if ( $atelier_contact['phone'] && $atelier_phone ) : ?>
						<a href="<?php echo esc_url( 'tel:' . $atelier_phone ); ?>"><?php echo esc_html( $atelier_contact['phone'] ); ?></a>
					<?php endif; ?>

					<?php if ( $atelier_contact['email'] ) : ?>
						<a href="<?php echo esc_url( 'mailto:' . $atelier_contact['email'] ); ?>"><?php echo esc_html( $atelier_contact['email'] ); ?></a>
					<?php endif; ?>

					<?php if ( ! $atelier_contact['address'] && ! $atelier_contact['phone'] && ! $atelier_contact['email'] && ! $atelier_contact['map_url'] ) : ?>
						<a href="<?php echo esc_url( atelier_get_page_url( 'contact' ) ); ?>"><?php echo esc_html( $atelier_phrase ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="site-footer__bottom">
		<div class="container site-footer__bottom-inner">
			<p class="site-footer__copyright">
				<?php
				printf(
					/* translators: 1: year, 2: site name. */
					esc_html__( '© %1$s %2$s', 'atelier-north' ),
					esc_html( wp_date( 'Y' ) ),
					esc_html( get_bloginfo( 'name' ) )
				);
				?>
			</p>

			<?php if ( $atelier_legal ) : ?>
				<nav aria-label="<?php esc_attr_e( 'Legal', 'atelier-north' ); ?>">
					<ul class="site-footer__legal">
						<?php foreach ( $atelier_legal as $atelier_link ) : ?>
							<li>
								<?php
								printf(
									'<a href="%1$s"%2$s>%3$s</a>',
									esc_url( $atelier_link['url'] ),
									atelier_is_current_url( $atelier_link['url'] ) ? ' aria-current="page"' : '',
									esc_html( $atelier_link['label'] )
								);
								?>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php endif; ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
