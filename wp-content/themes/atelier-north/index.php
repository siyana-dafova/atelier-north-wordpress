<?php
/**
 * Fallback template, used when no more specific template matches.
 *
 * @package Atelier_North
 */

get_header();
?>

<main id="main" class="site-main">
	<?php if ( have_posts() ) : ?>

		<?php if ( is_archive() ) : ?>
			<?php the_archive_title( '<h1>', '</h1>' ); ?>
		<?php endif; ?>

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( is_singular() ) : ?>
					<?php the_title( '<h1>', '</h1>' ); ?>
					<?php the_content(); ?>
				<?php else : ?>
					<?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>

		<?php the_posts_pagination(); ?>

	<?php else : ?>

		<h1><?php esc_html_e( 'Nothing found', 'atelier-north' ); ?></h1>
		<p><?php esc_html_e( 'The page you are looking for does not exist or has been moved.', 'atelier-north' ); ?></p>

	<?php endif; ?>
</main>

<?php
get_footer();
