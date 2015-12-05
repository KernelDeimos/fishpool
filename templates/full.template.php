
<html>
<head>
	<title><?php echo (isset($page_title)) ? "FP - ".$page_title : "Fishpool"; ?></title>

	<!-- VENDOR INCLUDES -->

		<?php // Include JQuery
			HTMLShorts::includeJS("https://code.jquery.com/jquery-2.1.4.js");
		?>

		<!-- Nice sans-serif font from Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=PT+Sans+Caption' rel='stylesheet' type='text/css'>

		<!-- Bootstrap From CDN -->
		<!-- Latest compiled and minified CSS -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
		<!-- / Bootstrap From CDN -->

	<!-- / VENDOR INCLUDES -->

	<?php
		// Generic CSS classes
		HTMLShorts::includeCSS(WEB_PATH.'/resources/style/normalize.css');
		HTMLShorts::includeCSS(WEB_PATH.'/resources/style/tweaks.css');

		// Site CSS classes
		HTMLShorts::includeCSS(WEB_PATH.'/resources/style/fp-header.css');
		HTMLShorts::includeCSS(WEB_PATH.'/resources/style/fp-main.css');

		// Form submission JavaScript
		HTMLShorts::includeJS(WEB_PATH.'/resources/script/BasicForm.js');
	?>
	<script>
		$(document).ready(function () {
			// Attach a BasicForm object to each form
			$('.basic-form').each(function () {
				new BasicForm($(this));
			});
		});
	</script>
</head>
<body>
	<div class="fp-header">
		<div class="fp-title">
			FishPool // <small>// Swim in Code</small>
			<?php 
				if ($check){
					echo "<form class=logout-button method=post action=<?php echo WEB_PATH ?>/logout >
						<input type=submit class=btn btn-default value=Log Out name=logout/>
						</form>";
				}
			?>
		</div>
	</div>

	<div class="fp-background-upper">
	</div>

	<div class="page-contents">
		<?php
			if (isset($contents_template)) {
				$contents_template->run();
			}
		?>
	</div>
</body>
</html>