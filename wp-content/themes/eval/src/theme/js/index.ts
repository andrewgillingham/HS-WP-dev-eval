console.log( 'Un mouton déguisé en loup.' );

( function ( $ ) {
	const mobileToggles = $.querySelectorAll( '.mobile-toggle' );
	mobileToggles.forEach( ( toggle ) => {
		toggle.addEventListener( 'click', () => {
			const target = toggle.getAttribute( 'data-target' );
			if ( ! target ) {
				return;
			}
			const targetEl = $.getElementById( target );
			if ( targetEl ) {
				targetEl.classList.toggle( 'visible' );
			}
		} );
	} );
} )( document );
