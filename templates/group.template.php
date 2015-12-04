<html style="min-height:100%">
<head>
	<title>Projects</title>
	<!-- Bootstrap Include Code -->
	<!-- Latest compiled and minified CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
	<!-- / Bootstrap Include Code -->

	<style>
		.varuns-style-0 {
			background-color: darkblue;
			color: black;
			width: 100%;
			
		}
		
		.varuns-style-1 {
			background-color: darkgreen;
			color: white;
			width: 100%;
		}
		.head-style {
			background-color: darkblue;
			color: white;
			width: 100%;
			padding: 15px;
		}

		.foot-style {
			background-color: darkblue;
			color: white;
			/*width: 100%;*/
			padding: 15px;
			padding-left: 30px;
			margin: 0 -15px;
		}

		
		.varuns-style-2 {
			background-color: cyan;
			color: black;
		}
		.varuns-style-3 {
			background-color: magenta;
			color: black;
			
		}
		.varuns-style-4 {
			background-color: lightgreen;
			color: black;
			-webkit-box-shadow: 0 0 10px -0px rgba(0,0,0,0.7);
			box-shadow: 0 0 10px -0px rgba(0,0,0,0.7);
		}
		.varuns-style-5 {
			display: inline-block;
			float: right;
			background-color: darkblue;
			color: #ADD8E6;

		}

		
	</style>
</head>
<body style="height:100%">
	
	<div class="container varuns-style-4">
	
	<h1><?php echo $group_name ?></h1>
	<font size="6.5">&emsp;Projects</font> 
	</br>
	<?php foreach ($group_projects as $project) { ?>
	<font size="5.5">&emsp;&emsp;&emsp;<?php echo $project->get_name(); ?></font> 
	&emsp;<button type="button" class="btn btn-primary">+</button>
	
	<p>
		
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font style="color: #0000FF">Code Link 1</font><br/>
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font style="color: #000000">Done by: </font><font style="color: #FF0000"><i>Author 1 Name</i></font><br/>
		
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font style="color: #0000FF">Code Link 2</font><br/>
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font style="color: #000000">Done by: </font><font style="color: #FF0000"><i>Author 2 Name</i></font><br/>
		
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font style="color: #0000FF">Code Link 3</font><br/>
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font style="color: #000000">Done by: </font><font style="color: #FF0000"><i>Author 3 Name</i></font><br/>
		
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font style="color: #0000FF">Code Link 4</font><br/>
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<font style="color: #000000">Done by: </font><font style="color: #FF0000"><i>Author 4 Name</i></font><br/>

		<form
		class="form-horizontal basic-form"
		role="form"
		action="" method="POST"
		data-success-url="<?php echo $_SERVER['REQUEST_URI']; ?>"
		>
			<input type="hidden" name="group_id" value="<?php echo $group_id; ?>" />
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2"
				for="reg_name">File:</label>

				<div class="col-xs-6 col-sm-4">
					<input type="file" name="name" class="form-control" id="reg_name"
					placeholder="Project Name">
				</div>

				<div class="col-xs-6 col-sm-4">
					<input type="submit" class="btn btn-default" value="Upload File">
				</div>
			</div>
		</form>
				
	</p>
	<?php } ?>

	<h1 />
	<h2>Create a Project</h2>

	<form
	class="form-horizontal basic-form"
	role="form"
	action="<?php echo WEB_PATH.'/create_project' ?>" method="POST"
	data-success-url="<?php echo $_SERVER['REQUEST_URI']; ?>"
	>
		<input type="hidden" name="group_id" value="<?php echo $group_id; ?>" />
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2"
			for="reg_name">Project Name:</label>

			<div class="col-xs-12 col-sm-10">
				<input type="text" name="name" class="form-control" id="reg_name"
				placeholder="Project Name">
			</div>
		</div>
		<div class="form-group"> 
			<div class="col-sm-offset-2 col-xs-12 col-sm-10">
				<input type="submit" class="btn btn-default" value="Create Project">
			</div>
		</div>
	</form>

	<div class=" foot-style ">

		<font style="color: #ADD8E6">
			Made by FishPool &copy; 2015
		</font>
		
	</div>

	</div>
	
</body>

</html>
