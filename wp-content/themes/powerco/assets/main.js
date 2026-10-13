(function () {
	// Mobile menu
	var toggle = document.querySelector('.menu-toggle');
	var nav = document.querySelector('.main-nav');
	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			var open = nav.classList.toggle('open');
			toggle.setAttribute('aria-expanded', open);
		});
		nav.querySelectorAll('.menu-item-has-children > a').forEach(function (a) {
			a.addEventListener('click', function (e) {
				if (window.innerWidth <= 960) {
					var li = a.parentElement;
					if (!li.classList.contains('open')) {
						e.preventDefault();
						li.classList.add('open');
					}
				}
			});
		});
	}

	// Testimonials slider
	var slider = document.querySelector('[data-slider]');
	if (slider) {
		var slides = slider.querySelectorAll('.testimonial');
		var dots = slider.querySelector('.dots');
		var current = 0;
		var show = function (i) {
			slides[current].classList.remove('active');
			dots.children[current].classList.remove('active');
			current = i;
			slides[current].classList.add('active');
			dots.children[current].classList.add('active');
		};
		slides.forEach(function (_, i) {
			var b = document.createElement('button');
			b.setAttribute('aria-label', 'Testimonial ' + (i + 1));
			if (i === 0) b.className = 'active';
			b.addEventListener('click', function () { show(i); });
			dots.appendChild(b);
		});
		setInterval(function () { show((current + 1) % slides.length); }, 6000);
	}
})();
