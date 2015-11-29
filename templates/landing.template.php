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
	.Login-Box {
		padding-top:20px;
		padding-bottom:8px;
	}
	
	

	</style>
	
</head>
<body>
	<h1 align="center">Fish Pool</h1>

	<div class="container">
		<div style="outline:5px solid black;" class="Login-Box">
			<form class="form-horizontal" role="form" >
				<div class="form-group">
					<label class="control-label col-xs-4" for="user">Username:</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" id="user" placeholder="Enter username">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-4" for="pwd">Password:</label>
					<div class="col-xs-3"> 
					<input type="password" class="form-control" id="pwd" placeholder="Enter password">
					</div>
				</div>
				<div class="form-group"> 
					<div class="col-xs-offset-6 col-xs-1">
						<input type="submit" class="btn btn-default">
					</div>
				</div>
			</form>
		</div>
	</div>

</body>
</html>
