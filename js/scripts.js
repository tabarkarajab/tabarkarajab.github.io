( function() {
	'use strict'
	/**
	 * File skip-link-focus-fix.js.
	 *
	 * Helps with accessibility for keyboard only users.
	 *
	 * Learn more: https://git.io/vWdr2
	 */
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}

	/* -----------------------------------------
	Responsive Menus
	----------------------------------------- */
	var body             = document.querySelector('body');
	var mobileWPMenu     = document.querySelectorAll('#masthead .mobile-navigation');
	var mainNav          = mobileWPMenu.length > 0 ? mobileWPMenu : document.querySelectorAll('#masthead .navigation');
	var mobileNav        = document.querySelector( '.navigation-mobile-wrap' );
	var mobileNavTrigger = document.querySelector('.mobile-nav-trigger');
	var mobileNavDismiss = document.querySelector('.navigation-mobile-dismiss');
	var navWrap          = document.querySelector('#menu-main');
	var navSubmenus      = navWrap ? navWrap.querySelectorAll( 'ul' ) : null;

	mainNav.forEach(function (el, i) {
		var itemClass = el.classList.contains('mobile-navigation') ? '.mobile-navigation' : '.navigation';
		var listItems = el.cloneNode(true).querySelectorAll( itemClass + ' > li');
		listItems.forEach(function (el, i) {
			el.removeAttribute('id');
			mobileNav.querySelector('.navigation-mobile').append(el);
		});
	});

	mobileNav.querySelectorAll('li').forEach(function(item, i){
		item.removeAttribute('id');

		if ( item.querySelector('.sub-menu') ) {
			var btn = document.createElement('button');
			btn.classList.add('menu-item-sub-menu-toggle');
			item.appendChild(btn);
		}
	});

	var mobileToggle = mobileNav.querySelectorAll('.menu-item-sub-menu-toggle');
	mobileToggle.forEach(function(item, i){
		item.onclick = function(event) {
			event.preventDefault();
			item.parentNode.classList.toggle('menu-item-expanded');
		}
	});

	mobileNavTrigger.onclick = function(event) {
		event.preventDefault();
		body.classList.add('mobile-nav-open');
		mobileNavDismiss.focus();
	}

	mobileNavDismiss.onclick = function(event) {
		event.preventDefault();
		body.classList.remove('mobile-nav-open');
		mobileNavTrigger.focus();
	}

	function setMenuClasses() {
		if ( navSubmenus === null || navWrap.offsetParent === null ) {
			return;
		}

		var windowWidth = window.innerWidth;

		Array.prototype.forEach.call(navSubmenus, function(el, i){

			var parent = el.parentNode;
			parent.classList.remove('nav-open-left');

			var rect = el.getBoundingClientRect();

			var leftOffset = rect.left + document.body.scrollLeft + el.offsetWidth + 20;

			if ( leftOffset > windowWidth ) {
				parent.classList.add( 'nav-open-left' );
			}
		});
	}

	setMenuClasses();

	var resizeTimer;

	window.addEventListener('resize', function() {
		clearTimeout( resizeTimer );
		resizeTimer = setTimeout( function () {
			setMenuClasses();
		}, 350 );
	});

}) ();
