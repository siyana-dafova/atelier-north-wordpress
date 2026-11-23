/**
 * Header: solid background after the sentinel scrolls away, and the mobile menu.
 */
import config from 'atelier-config';

const header = document.querySelector( '[data-header]' );

if ( header ) {
	const toggle = header.querySelector( '[data-nav-toggle]' );
	const nav = header.querySelector( '#site-nav' );
	const label = toggle ? toggle.querySelector( '[data-nav-label]' ) : null;
	const media = window.matchMedia( '(max-width: 767px)' );
	const i18n = config.i18n || {};

	const setLabel = ( text ) => {
		if ( label && text ) {
			label.textContent = text;
		}
	};

	const setInert = () => {
		if ( ! nav ) {
			return;
		}

		if ( media.matches && ! header.classList.contains( 'is-menu-open' ) ) {
			nav.setAttribute( 'inert', '' );
		} else {
			nav.removeAttribute( 'inert' );
		}
	};

	const closeMenu = ( restoreFocus ) => {
		header.classList.remove( 'is-menu-open' );
		document.body.classList.remove( 'is-menu-open' );

		if ( toggle ) {
			toggle.setAttribute( 'aria-expanded', 'false' );
		}

		setLabel( i18n.openMenu );
		setInert();

		if ( restoreFocus && toggle ) {
			toggle.focus();
		}
	};

	const openMenu = () => {
		header.classList.add( 'is-menu-open' );
		document.body.classList.add( 'is-menu-open' );

		if ( toggle ) {
			toggle.setAttribute( 'aria-expanded', 'true' );
		}

		setLabel( i18n.closeMenu );
		setInert();

		const firstLink = nav ? nav.querySelector( 'a[href]' ) : null;

		if ( firstLink ) {
			firstLink.focus();
		} else if ( toggle ) {
			toggle.focus();
		}
	};

	if ( toggle && nav ) {
		toggle.addEventListener( 'click', () => {
			if ( header.classList.contains( 'is-menu-open' ) ) {
				closeMenu( false );
			} else {
				openMenu();
			}
		} );

		document.addEventListener( 'keydown', ( event ) => {
			if ( ! header.classList.contains( 'is-menu-open' ) ) {
				return;
			}

			if ( 'Escape' === event.key ) {
				event.preventDefault();
				closeMenu( true );
				return;
			}

			if ( 'Tab' !== event.key ) {
				return;
			}

			const items = [ toggle, ...nav.querySelectorAll( 'a[href]' ) ];
			const first = items[ 0 ];
			const last = items[ items.length - 1 ];

			if ( event.shiftKey && document.activeElement === first ) {
				event.preventDefault();
				last.focus();
			} else if ( ! event.shiftKey && document.activeElement === last ) {
				event.preventDefault();
				first.focus();
			}
		} );

		media.addEventListener( 'change', () => {
			if ( ! media.matches ) {
				closeMenu( false );
			}

			setInert();
		} );

		setInert();
	}

	const sentinel = document.querySelector( '[data-header-sentinel]' );

	if ( sentinel && 'IntersectionObserver' in window ) {
		const observer = new IntersectionObserver( ( entries ) => {
			entries.forEach( ( entry ) => {
				header.classList.toggle( 'is-solid', ! entry.isIntersecting );
			} );
		} );

		observer.observe( sentinel );
	}
}
