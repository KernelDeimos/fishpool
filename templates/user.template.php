<!--   FISH POOL
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
#      O             o                     O                #
#       o         O                  _  ___ o               #
#   ><>            O                |_\/  o\                #
#                o                  |_/\___/                #
#                 <><                                       #    
#===========================================================#
-->
<html>


<div class="container">
	<div class="col-xs-12 col-lg-9">
		<div class="fp-form-box">
			<div class="form-header">
				<div class="title"><?php echo $user_name; ?></div>
			</div>
		</div>

		<?php if ($is_own_page) { ?>
			<div class="fp-form-box">
				<div class="form-header">
					<div class="title">My Groups</div>
				</div>

				<div class="form-body">
					I put the box here for demo; feel free to change it
					<ul>
						<?php if (isset($groups)) foreach ($groups as $group) { ?>
							<li><?php echo $group->get_name(); ?></li>
						<?php } else { ?>
							Error fetching groups! :/ [<?php echo $groups_fetch_error; ?>]
						<?php } ?>
					</ul>
				</div>
			</div>

			<div class="fp-form-box">
				<div class="form-header">
					<div class="title">Create New Group</div>
				</div>

				<div class="form-body">
					<form
					class="form-horizontal basic-form"
					role="form"
					action="<?php echo WEB_PATH.'/create_group' ?>" method="POST"
					data-success-url = "<?php echo $_SERVER['REQUEST_URI']; ?>"
					>
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-2"
							for="reg_name">Group Name:</label>

							<div class="col-xs-12 col-sm-10">
								<input type="text" name="name" class="form-control" id="reg_name"
								placeholder="The Code Group" style="font-family: 'PT Sans Caption', sans-serif;">
							</div>
						</div>
						<br />
						<div class="form-group"> 
							<div class="col-sm-offset-2 col-xs-12 col-sm-10">
								<input type="submit" class="btn btn-default" value="Create Group">
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php } ?>
	</div>
</div>