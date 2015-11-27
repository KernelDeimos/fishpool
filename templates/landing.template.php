<html>
<head>

	<title>Landing Page</title>

	<!-- Bootstrap Include Code -->
	<!-- Latest compiled and minified CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
	<!-- / Bootstrap Include Code -->

	<style>
		.erics-style-1 {
			background-color: darkgreen;
			color: white;
		}
		.erics-style-2 {
			background-color: cyan;
			color: black;
		}
		.erics-style-3 {
			background-color: magenta;
			color: black;
		}
	</style>
</head>
<body>
	<h1>Landing Page</h1>
	<p>
		Hey! This is where the landing page is going to be.
	</p>
	<p>
		Bootstrap is also included in this file, but it doesn't
		really change anything until you use Bootstrap's classes.<br />
		All Bootstrap does is create some pre-defined classes for you, basically.
	</p>
	<div class="container erics-style-1">

		Here is bootstrap's container class, which chooses a reasonable
		column width based on the size of your screen.<br />
		Tip: try resizing the window.<br />

		<div class="col-xs-6 erics-style-2">
			Bootstrap has 12 column lengths. This box extends 6
			of those, making it half the width of the container.
		</div>

		<div class="col-xs-6 erics-style-3">
			The "xs" in "col-xs-6" means "extra small or larger". This
			covers all screen sizes. Available sizes are:
			<ul>
				<li>xs - extra small</li>
				<li>sm - small</li>
				<li>md - medium</li>
				<li>lg - large</li>
				<li>xl - extra large</li>
			</ul>
		</div>
	</div>
</body>
</html>
