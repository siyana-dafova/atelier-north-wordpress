<?php
/**
 * Style guide for visual checks of the design system.
 * Used automatically for a page with the slug `styleguide`; only rendered in the local environment.
 *
 * @package Atelier_North
 */

if ( 'local' !== wp_get_environment_type() ) {
	wp_safe_redirect( home_url( '/' ) );
	exit;
}

$atelier_colors = array(
	'bg',
	'surface',
	'muted',
	'text',
	'accent',
	'dark',
	'text-soft',
	'error',
	'success',
);

$atelier_icons = array( 'arrow-right', 'arrow-left', 'arrow-up-right', 'close', 'menu', 'plus' );

add_filter( 'atelier_transparent_header', '__return_true' );

get_header();
?>

<main id="main" class="site-main">

	<section class="section section--dark site-hero">
		<div class="container">
			<p class="eyebrow">Design system</p>
			<h1 class="display">Style <em>guide</em></h1>
			<p class="lead text-soft">Every component of the Atelier North theme on one page. Resize the window to check the 375 / 768 / 1024 / 1440 breakpoints.</p>
		</div>
	</section>

	<section class="section section--flush-top">
		<div class="container">
			<h2 class="h3">Colors</h2>
			<div class="grid" style="margin-top: var(--space-6)">
				<?php foreach ( $atelier_colors as $atelier_color ) : ?>
					<div class="span-2 span-md-2 span-lg-3">
						<div style="height: 6rem; border: 1px solid var(--color-border); background: var(--color-<?php echo esc_attr( $atelier_color ); ?>)"></div>
						<p class="label" style="margin-top: var(--space-2)">--color-<?php echo esc_html( $atelier_color ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section section--surface">
		<div class="container">
			<h2 class="h3">Typography</h2>
			<div style="display: grid; gap: var(--space-6); margin-top: var(--space-6)">
				<p class="label">ARCHITECTURE &amp; INTERIOR DESIGN — 2026</p>
				<p class="display">
					<span class="line">Material.</span>
					<span class="line line--indent"><em>Meaning.</em></span>
					<span class="line">Mood.</span>
				</p>
				<p class="h1">Spaces shaped by <em>quiet light</em></p>
				<p class="h2">Heading two, the section title</p>
				<p class="h3">Heading three, the card title</p>
				<p class="h4">Heading four, the small title</p>
				<p class="lead">Lead paragraph. Residential, hospitality and workplace interiors designed with restraint, natural materials and a calm sense of proportion.</p>
				<p style="max-width: var(--measure)">Body text. We believe a space should feel inevitable: every material chosen for a reason, every line drawn with care. <a href="#main">Inline link</a> and <strong>strong text</strong>.</p>
				<p class="eyebrow">Eyebrow label</p>
				<p class="text-soft"><small>Small text, captions and meta information.</small></p>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<h2 class="h3">Buttons &amp; icons</h2>
			<div style="display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-6); margin-top: var(--space-6)">
				<a class="button button--link" href="#main">Get in touch <?php atelier_icon( 'arrow-right' ); ?></a>
				<a class="button button--solid" href="#main">View projects <?php atelier_icon( 'arrow-right' ); ?></a>
				<a class="button button--outline" href="#main">Our services</a>
				<button class="button button--solid" type="button">Button element</button>
			</div>
			<div style="display: flex; flex-wrap: wrap; gap: var(--space-6); margin-top: var(--space-6)">
				<?php foreach ( $atelier_icons as $atelier_icon_name ) : ?>
					<div style="display: flex; align-items: center; gap: var(--space-2)">
						<?php atelier_icon( $atelier_icon_name ); ?>
						<span class="label"><?php echo esc_html( $atelier_icon_name ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section section--dark">
		<div class="container">
			<p class="eyebrow">On dark</p>
			<h2 class="h2" style="margin-top: var(--space-4)">Bring intention into <em>your space</em></h2>
			<div style="display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-6); margin-top: var(--space-6)">
				<a class="button button--link" href="#main">Get in touch <?php atelier_icon( 'arrow-right' ); ?></a>
				<a class="button button--light" href="#main">Start a project <?php atelier_icon( 'arrow-right' ); ?></a>
				<a class="button button--outline" href="#main">Our process</a>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<h2 class="h3">Media ratios</h2>
			<div class="grid" style="margin-top: var(--space-6)">
				<div class="span-2 span-md-2 span-lg-3">
					<div class="media media--portrait"></div>
					<p class="label" style="margin-top: var(--space-2)">Portrait 4:5</p>
				</div>
				<div class="span-2 span-md-3 span-lg-4">
					<div class="media media--landscape"></div>
					<p class="label" style="margin-top: var(--space-2)">Landscape 10:7</p>
				</div>
				<div class="span-4 span-md-3 span-lg-5">
					<div class="media media--hero media--overlay"></div>
					<p class="label" style="margin-top: var(--space-2)">Hero 48:25 + overlay</p>
				</div>
			</div>
		</div>
	</section>

	<section class="section section--flush-top">
		<div class="container">
			<h2 class="h3">Cards</h2>
			<div class="grid" style="margin-top: var(--space-6); row-gap: var(--space-8)">
				<article class="card card--project span-full span-md-4 span-lg-4" data-reveal>
					<div class="card__body">
						<h3 class="card__title">
							<a href="#main">Linden House</a>
							<span class="card__arrow"><?php atelier_icon( 'arrow-right' ); ?></span>
						</h3>
						<p class="card__meta label"><span>Residential</span><span>Oslo</span><span>2025</span></p>
					</div>
					<div class="card__media media media--portrait media--zoom"></div>
				</article>

				<article class="card card--article span-full span-md-4 span-lg-4" data-reveal style="--reveal-delay: 1">
					<div class="card__body">
						<p class="card__meta label"><span>Materials</span><time datetime="2026-10-14">Oct 14, 2026</time><span>5 min read</span></p>
						<h3 class="card__title"><a href="#main">Why we start every project with light</a></h3>
						<p class="card__excerpt">Before a single material is chosen, we study how daylight moves through the space across the day and the seasons.</p>
						<span class="card__more label">Read more <?php atelier_icon( 'arrow-right' ); ?></span>
					</div>
					<div class="card__media media media--landscape media--zoom"></div>
				</article>

				<article class="card card--service span-full span-md-4 span-lg-4" data-reveal style="--reveal-delay: 2">
					<div class="card__body">
						<p class="card__number label">01</p>
						<h3 class="card__title"><a href="#main">Interior Design</a></h3>
						<p class="card__excerpt">Complete interiors, from spatial planning to the last piece of furniture.</p>
					</div>
					<div class="card__media media media--portrait media--zoom"></div>
				</article>
			</div>
		</div>
	</section>

	<section class="section section--surface">
		<div class="container container--narrow">
			<h2 class="h3">Form fields</h2>
			<form class="form" style="margin-top: var(--space-6)" action="#" onsubmit="return false">
				<div class="field">
					<label class="field__label" for="sg-name">Name <span class="field__required" aria-hidden="true">*</span></label>
					<input class="input" id="sg-name" type="text" placeholder="Your full name" required>
				</div>
				<div class="field">
					<label class="field__label" for="sg-email">Email <span class="field__required" aria-hidden="true">*</span></label>
					<input class="input" id="sg-email" type="email" value="not-an-email" aria-invalid="true" aria-describedby="sg-email-error" required>
					<p class="field__error" id="sg-email-error">Please enter a valid email address.</p>
				</div>
				<div class="field">
					<label class="field__label" for="sg-type">Project type</label>
					<select class="select" id="sg-type">
						<option>Residential</option>
						<option>Commercial</option>
						<option>Hospitality</option>
						<option>Office</option>
					</select>
				</div>
				<div class="field">
					<label class="field__label" for="sg-message">Message</label>
					<textarea class="textarea" id="sg-message" aria-describedby="sg-message-hint" placeholder="Tell us about your space"></textarea>
					<p class="field__hint" id="sg-message-hint">Location, size and timeline help us reply faster.</p>
				</div>
				<label class="checkbox">
					<input type="checkbox" checked>
					<span>I agree to the <a href="#main">Privacy Policy</a>.</span>
				</label>
				<label class="checkbox">
					<input type="checkbox" aria-invalid="true">
					<span>Unchecked, invalid state.</span>
				</label>
				<p class="notice notice--success" role="status">Thank you, we will reply within two working days.</p>
				<p class="notice notice--error" role="alert">Something went wrong. Please try again.</p>
				<div>
					<button class="button button--solid" type="submit">Send inquiry <?php atelier_icon( 'arrow-right' ); ?></button>
				</div>
			</form>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<h2 class="h3">Reveal on scroll</h2>
			<div class="grid" style="margin-top: var(--space-6)">
				<?php for ( $atelier_i = 0; $atelier_i < 4; $atelier_i++ ) : ?>
					<div class="span-2 span-md-2 span-lg-3" data-reveal style="--reveal-delay: <?php echo (int) $atelier_i; ?>">
						<div class="media media--square"></div>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
