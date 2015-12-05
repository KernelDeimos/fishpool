<!--   FISH POOL
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~#
#      O             o                     O                #
#       o         O                  _  ___ o               #
#   ><>            O                |_\/  o\                #
#                o                  |_/\___/                #
#                 <><                                       #    
#===========================================================#
-->


<div class="container">
	<div class="col-xs-12 <?php if ($is_own_page) { ?>col-sm-6 col-md-8 col-lg-9<?php } ?>">
		<div class="fp-form-box">
			<div class="form-header">
				<div class="title"><?php echo $user_name . " bio";?>
				</div>
			</div>
			
			
			<div class="form-body">
				<?php if($bio == NULL && $facebook == NULL && $twitter == NULL && $linkedin == NULL && $email == NULL){ ?>
					<label class="col-xs-12"for="reg_name">we've got nothing</label>
				<?php } ?>
				<?php if($bio != NULL){ ?> 
					<label class="col-xs-12"for="reg_name">bio:</label>
				<?php echo $bio;} ?> 						
				<?php if($facebook != NULL){ ?> 
					<label class="col-xs-12"for="reg_name">facebook:</label> 
				<?php echo $facebook;} ?> 
				<?php if($twitter != NULL){ ?> 
					<label class="col-xs-12"for="reg_name">twitter:</label>
				<?php echo $twitter;} ?> 
				<?php if($linkedin != NULL){ ?> 
					<label class="col-xs-12"for="reg_name">linkedin:</label>
				<?php echo $linkedin;} ?> 
				<?php if($email != NULL){ ?> 
					<label class="col-xs-12"for="reg_name">email:</label>
				<?php echo $email;} ?> 						
				<?php if ($is_own_page) { ?>						
					<div class=" col-xs-12 ">
						<input type="submit" class="btn btn-default" value="Edit info">
					</div>						
				<?php } ?>
			
			</div>
		</div>		
	</div>
	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
		<?php if ($is_own_page) { ?>
			<div class="fp-form-box">
				<div class="form-header">
					<div class="title">My Groups</div>
				</div>


				<div class="form-body">
					<ul>
						<?php if (isset($groups)) foreach ($groups as $group) { ?>
							<li><a href="<?php echo WEB_PATH?>/group/<?php echo $group->get_id();?>"><?php echo $group->get_name();?></a></li>
						<?php } else { ?>
							Error fetching groups! :/ [<?php echo $groups_fetch_error; ?>]`
						<?php } ?>
					</ul>
				</div>
			

	
				 

				<div class="form-body">
					<form
					class="form-horizontal basic-form"
					role="form"
					action="<?php echo WEB_PATH.'/create_group' ?>" method="POST"
					data-success-url = "<?php echo $_SERVER['REQUEST_URI']; ?>"
					>
						<div class="form-group">
							<label class="col-xs-12"
							for="reg_name">Add New Group:</label>

							<div class="col-xs-12">
								<input type="text" name="name" class="form-control" id="reg_name"
								placeholder="Group Name" style="font-family: 'PT Sans Caption', sans-serif;">
							</div>
						</div>
						<br />
						<div class="form-group"> 
							<div class=" col-xs-12 ">
								<input type="submit" class="btn btn-default" value="Create Group">
							</div>
						</div>
					</form>				
				</div>
			</div>		
		<?php } ?>
	</div>
</div>
