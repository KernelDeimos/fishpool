<div class="container">

	<h1><?php echo $folder_name; ?></h1>

	<ul class="ul">
		<?php foreach ($items as $item) { ?>
			<li><?php echo $item->get_name(); ?></li>
		<?php } ?>
	</ul>


	<form
	class="form-horizontal"
	role="form"
	action="" method="POST"
	data-success-url="<?php echo $_SERVER['REQUEST_URI']; ?>"
	>
		<input type="hidden" name="folder_id" value="<?php echo $folder_id; ?>" />
		<div class="form-group">
			<div class="col-xs-offset-8 col-sm-offset-10 col-xs-4 col-sm-2">
				<input name="folder" type="submit" class="btn btn-default" value="New Folder">
			</div>
		</div>
	</form>

	<form
	class="form-horizontal"
	role="form"
	action="" method="POST"
	data-success-url="<?php echo $_SERVER['REQUEST_URI']; ?>"
	>
		<input type="hidden" name="folder_id" value="<?php echo $folder_id; ?>" />
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2"
			for="reg_name">File:</label>

			<div class="col-xs-8 col-sm-8">
				<input type="file" name="name" class="form-control" id="reg_name"
				placeholder="Project Name">
			</div>

			<div class="col-xs-4 col-sm-2">
				<input name="file" type="submit" class="btn btn-default" value="Upload File">
			</div>
		</div>
	</form>
</div>