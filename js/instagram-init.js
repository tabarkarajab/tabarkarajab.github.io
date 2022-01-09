( function() {
	'use strict'

	/* -----------------------------------------
	Instagram Widget
	----------------------------------------- */
	var instagramWrap = document.querySelector('.footer-widget-area');
	var instagramWidget = instagramWrap ? instagramWrap.querySelectorAll('.zoom-instagram-widget__items') : null;

	if ( instagramWidget && instagramWidget.length > 0 ) {
		var auto  = instagramWrap.dataset.auto,
		speed = instagramWrap.dataset.speed;

		var slider = tns({
			container: '.footer-widget-area .zoom-instagram-widget__items',
			autoplay: auto == 1,
			nav: false,
			items: 4,
			arrowKeys: false,
			autoplayButtonOutput: false,
			controls: false,
			speed: speed,
			autoplayTimeout: Math.max(3000, parseInt(speed, 10) + 501),
			mouseDrag: true,
			mode: 'carousel',
			autowidth: true,
			responsive: {
				768: {
					items: 8
				},
			}
		});
	}

}) ();
