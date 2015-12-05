<div class="container">

<?php if (isset($status)) {
	$class = ($status === "okay") ? "alert-success" : "alert-danger";
	?>
	<div class="alert <?php echo $class; ?>">
		<?php echo $message; ?>
	</div>
<?php } ?>

	<h1><?php echo $folder_name; ?></h1>
	<?php if (isset($parent_uri)) { ?>
		<a href="<?php echo $parent_uri; ?>">
		<h3>[Up to <?php echo $folder_name; ?>]</h3>
		</a>
	<?php } ?>

	<ul class="ul">
		<?php foreach ($items as $item) {
			?>
			<a href="<?php echo $item->get_access_uri(); ?>">
				<li><?php echo $item->get_name(); ?></li>
			</a>
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
			<label class="control-label col-xs-12 col-sm-2"
			for="addfolder_name">Folder:</label>

			<div class="col-xs-8 col-sm-8">
				<input type="text" name="name" class="form-control" id="addfolder_name"
				placeholder="Folder Name">
			</div>

			<div class="col-xs-4 col-sm-2">
				<input name="folder" type="submit" class="btn btn-default" value="Create Folder">
			</div>
		</div>
	</form>

	<form
	class="form-horizontal"
	role="form"
	action="" method="POST"
	data-success-url="<?php echo $_SERVER['REQUEST_URI']; ?>"
	enctype="multipart/form-data"
	>
		<input type="hidden" name="folder_id" value="<?php echo $folder_id; ?>" />
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-2"
			for="addfile_file">File:</label>

			<div class="col-xs-8 col-sm-8">
				<input type="file" name="codefile" class="form-control" id="addfile_file"
				>
			</div>

			<div class="col-xs-4 col-sm-2">
				<input name="file" type="submit" class="btn btn-default" value="Upload File">
			</div>
		</div>
	</form>
</div>