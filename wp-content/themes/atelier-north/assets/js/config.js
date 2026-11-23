/**
 * Front-end configuration printed by WordPress for this module.
 */
const element = document.querySelector( 'script[id="wp-script-module-data-atelier-config"]' );

let config = {};

if ( element instanceof HTMLScriptElement ) {
	try {
		config = JSON.parse( element.text );
	} catch ( error ) {
		config = {};
	}
}

export default config;
