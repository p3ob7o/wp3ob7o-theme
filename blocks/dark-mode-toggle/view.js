/**
 * Dark Mode Toggle — view script.
 *
 * Handles the toggle button interaction. The preference-reading script
 * that prevents flash-of-wrong-theme runs separately in <head> via
 * functions.php (pu_dark_mode_head_script).
 */
( function () {
	var buttons = document.querySelectorAll( '.dark-mode-toggle' );
	if ( ! buttons.length ) return;

	function updateAriaState() {
		var isDark = document.documentElement.classList.contains( 'dark-mode' );
		buttons.forEach( function ( btn ) {
			btn.setAttribute( 'aria-checked', isDark ? 'true' : 'false' );
		} );
	}

	buttons.forEach( function ( btn ) {
		btn.addEventListener( 'click', function () {
			var html = document.documentElement;
			html.classList.toggle( 'dark-mode' );

			var isDark = html.classList.contains( 'dark-mode' );
			try {
				localStorage.setItem( 'pu-dark-mode', isDark ? 'on' : 'off' );
			} catch ( e ) {
				// Private browsing or storage full — toggle still works per-session
			}

			updateAriaState();
		} );
	} );

	// Set initial aria state on load
	updateAriaState();
} )();
