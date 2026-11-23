<?php
/**
 * Site header.
 *
 * @package Atelier_North
 */

$atelier_overlay = atelier_has_transparent_header();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'atelier-north' ); ?></a>

<header class="site-header<?php echo $atelier_overlay ? ' is-overlay' : ''; ?>" data-header>
	<div class="site-header__bar">
		<div class="container site-header__inner">
			<div class="site-header__logo">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a class="site-header__title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>
			</div>

			<button class="site-header__toggle" type="button" aria-expanded="false" aria-controls="site-nav" data-nav-toggle>
				<span class="site-header__toggle-icon site-header__toggle-icon--open"><?php atelier_icon( 'menu' ); ?></span>
				<span class="site-header__toggle-icon site-header__toggle-icon--close"><?php atelier_icon( 'close' ); ?></span>
				<span class="screen-reader-text" data-nav-label><?php esc_html_e( 'Open menu', 'atelier-north' ); ?></span>
			</button>
		</div>
	</div>

	<nav id="site-nav" class="site-nav" aria-label="<?php esc_attr_e( 'Primary', 'atelier-north' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'site-nav__list',
				'menu_id'        => '',
				'depth'          => 1,
				'fallback_cb'    => 'atelier_primary_menu_fallback',
			)
		);
		?>
	</nav>
</header>

<?php if ( $atelier_overlay ) : ?>
	<div class="site-header__sentinel" data-header-sentinel></div>
<?php endif; ?>
