( function() {
	'use strict'

	/* -----------------------------------------
	Image Lightbox
	----------------------------------------- */
	var lightbox = new SimpleLightbox('.ci-lightbox, a[data-lightbox^="gal"]', {
		captionSelector: function (element) {
			return element.parentNode.querySelector('figcaption');
		},
		captionType: 'text',
		navText: ['<i class="olsen-icons olsen-icons-angle-left"></i>','<i class="olsen-icons olsen-icons-angle-right"></i>'],
		fadeSpeed: 500,
		history: false,
	});

	lightbox.on('show.simplelightbox', function () {
		lightbox.domNodes.overlay.dataset.opacityTarget = '0.9';

	});
})();
