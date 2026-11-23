/**
 * Reveal on scroll: adds .is-revealed to [data-reveal] elements once they enter the viewport.
 */
( () => {
	const items = document.querySelectorAll( '[data-reveal]' );

	if ( ! items.length ) {
		return;
	}

	const reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	if ( reduceMotion || ! ( 'IntersectionObserver' in window ) ) {
		items.forEach( ( item ) => item.classList.add( 'is-revealed' ) );
		return;
	}

	const observer = new IntersectionObserver(
		( entries ) => {
			entries.forEach( ( entry ) => {
				if ( entry.isIntersecting ) {
					entry.target.classList.add( 'is-revealed' );
					observer.unobserve( entry.target );
				}
			} );
		},
		{ rootMargin: '0px 0px -10% 0px', threshold: 0.1 }
	);

	items.forEach( ( item ) => observer.observe( item ) );
} )();
