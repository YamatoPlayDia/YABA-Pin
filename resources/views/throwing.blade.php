<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>throwing</title>

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
		<li class="fade"><img src="/assets/img/bottle_m.png" alt="throwing1"></li>
		<li><img src="/assets/img/bottle_s.png" alt="throwing2"></li>
		<li><img src="/assets/img/kirari.png" alt="throwing3"></li>
		<li><img src="/assets/img/pochon.png" alt="throwing4"></li>

	</ul>
</body>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
	$(function () {
		var setImg = '.slideshow-fade';
		var switchDelay = 5000;

		function slideShow() {
			var active = $(setImg + ' li.fade');
			var next = active.next('li').length ? active.next('li') : $(setImg + ' li:first');

			active.removeClass('fade');
			next.addClass('fade');

			setTimeout(slideShow, switchDelay);
		}

		slideShow();
	});
</script>
	@vite('resources/js/create_message.js')
</html>