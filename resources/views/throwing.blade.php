<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>throwing</title>
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

	<!-- Styles -->
	<style>
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			margin: 0;
			background-color: #000;
		}

		.slideshow-fade {
			position: relative;
			width: 390px;
			height: 844px;
			overflow: hidden;
		}

		.slideshow-fade li {
			list-style: none;
			position: absolute;
			top: 0;
			left: 0;
			opacity: 0;
			transition: opacity 2s;
			z-index: 1;
		}

		.slideshow-fade li.fade {
			opacity: 1;
			z-index: 2;
		}

		.slideshow-fade li img {
			object-fit: cover;
			height: 844px;
			width: 390px;
			object-position: center;
		}
	</style>
	@vite('resources/css/app.css')
</head>

<body>
	<ul class="slideshow-fade">
		<li class="fade" data-delay="1000"><img src="/assets/img/bottle.png" alt="throwing1"></li>
		<li data-delay="2000"><img src="/assets/img/bottle_m.png" alt="throwing2"></li>
		<li data-delay="2500"><img src="/assets/img/bottle_s.png" alt="throwing3"></li>
		<li data-delay="4000"><img src="/assets/img/kirari.png" alt="throwing4"></li>
		<li data-delay="4000"><img src="/assets/img/pochon.png" alt="throwing5"></li>
	</ul>
	<script>
		$(function () {
			var setImg = '.slideshow-fade';
			var totalTime = 0;

			$(setImg + ' li').each(function() {
				totalTime += parseInt($(this).data('delay')) || 4000;
			});

			function slideShow() {
				var active = $(setImg + ' li.fade');
				var next = active.next('li').length ? active.next('li') : null; // if no next slide, set to null
				var switchDelay = next ? (next.data('delay') || 4000) : 0; // if no next slide, set delay to 0

				// Only remove the 'fade' class if there is a next slide.
				if (next) {
					active.removeClass('fade');
					next.addClass('fade');
					setTimeout(slideShow, switchDelay);
				}
			}

			slideShow();

			// Redirect when total time is passed.
			setTimeout(function() {
				window.location.href = '/thrown';
			}, totalTime);
		});
	</script>
	@vite('resources/js/app.js')
</body>
</html>