/**
 * navigation.js
 *
 * Handles toggling the navigation menu and search menu for small screens.
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container )
		return;

	button = container.getElementsByTagName( 'h1' )[0];
	if ( 'undefined' === typeof button )
		return;

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( -1 === menu.className.indexOf( 'nav-menu' ) )
		menu.className += ' nav-menu';

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
		}
		else {
			container.className += ' toggled';
			searchcontainer.className = searchcontainer.className.replace( 'toggled', '' );
		}
	};

	//Search form
	var searchcontainer, searchbutton, searchmenu;

	searchcontainer = document.getElementById( 'header-search' );
	if ( ! searchcontainer )
		return;

	searchbutton = document.getElementById( 'header-search-toggle' );
	if ( 'undefined' === typeof searchbutton )
		return;

	searchbutton.onclick = function() {
		if ( -1 !== searchcontainer.className.indexOf( 'toggled' ) ) {
			searchcontainer.className = searchcontainer.className.replace( 'toggled', '' );
		}
		else {
			searchcontainer.className += 'toggled';
			container.className = container.className.replace( ' toggled', '' );
		}
	};
} )();
