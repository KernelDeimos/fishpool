<html>
<head>
	<title><?php echo (isset($page_title)) ? "FP - ".$page_title : "Fishpool"; ?></title>
	<!-- Nice sans-serif font from Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=PT+Sans+Caption' rel='stylesheet' type='text/css'>
	<?php
		HTMLShorts::includeCSS(WEB_PATH.'/resources/style/normalize.css');
		HTMLShorts::includeCSS(WEB_PATH.'/resources/style/fp-header.css');
		HTMLShorts::includeCSS(WEB_PATH.'/resources/style/fp-main.css');
	?>
</head>
<body>
	<div class="fp-header">
		<div class="fp-title">
			FishPool
		</div>
	</div>

	<div class="fp-background-upper">
	</div>

	<div class="page-contents">
	</div>
</body>
</html>
