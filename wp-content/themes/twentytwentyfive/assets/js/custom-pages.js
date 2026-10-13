/*
 * Corporate page interactions.
 * Handles reveal-on-scroll and animated number counters.
 */

(function () {
	'use strict';

	var revealItems = document.querySelectorAll('.reveal-on-scroll');
	var counters = document.querySelectorAll('.stat-number[data-count]');

	if (!('IntersectionObserver' in window)) {
		revealItems.forEach(function (item) {
			item.classList.add('is-visible');
		});
		return;
	}

	var animateCounter = function (element) {
		var target = parseInt(element.getAttribute('data-count'), 10);
		var duration = 1200;
		var start = 0;
		var startTime = null;

		if (!target || element.dataset.counted === 'true') {
			return;
		}

		element.dataset.counted = 'true';

		var tick = function (time) {
			if (!startTime) {
				startTime = time;
			}

			var progress = Math.min((time - startTime) / duration, 1);
			var value = Math.floor(progress * (target - start) + start);
			element.textContent = value.toString();

			if (progress < 1) {
				window.requestAnimationFrame(tick);
			}
		};

		window.requestAnimationFrame(tick);
	};

	var observer = new IntersectionObserver(
		function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) {
					return;
				}

				entry.target.classList.add('is-visible');

				if (entry.target.classList.contains('stat-number')) {
					animateCounter(entry.target);
				}

				observer.unobserve(entry.target);
			});
		},
		{
			threshold: 0.18,
			rootMargin: '0px 0px -24px 0px'
		}
	);

	revealItems.forEach(function (item) {
		observer.observe(item);
	});

	counters.forEach(function (counter) {
		observer.observe(counter);
	});
})();
