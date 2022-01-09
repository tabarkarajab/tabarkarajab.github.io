( function() {
	'use strict'

	/* -----------------------------------------
	Main Carousel
	----------------------------------------- */
	var homeSlider = document.querySelector('.home-slider');

	if (!!homeSlider) {
		var slider = tns({
			container: '.home-slider',
			autoplay: homeSlider.dataset.autoplay == 1,
			nav: false,
			arrowKeys: true,
			autoplayButtonOutput: false,
			controlsPosition: 'bottom',
			speed: 500,
			autoplayTimeout: homeSlider.dataset.autoplayspeed,
			mode: homeSlider.dataset.fade == 1 ? 'gallery' : 'carousel',
			onInit: function (event) {
				event.container.classList.add('tns-initialized');
			},
		});
	}
})();
