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
				<?php if ($is_own_page){ ?>
					<form class = "form-horizontal" method = "POST">						
						<div class="form-group">
							<label class="col-xs-12"
							for="reg_name">Personal info: </label>
							<div class="col-xs-12">
								<input type="text" name="bio" class="form-control" id="reg_name" 
								value = "<?php echo $bio; ?>" style="font-family: 'PT Sans Caption', sans-serif;">							
							</div>
						</div>						
						<div class="form-group">
							<label class="col-xs-12"
							for="reg_name">Facebook: </label>
							<div class="col-xs-12">
								<input type="text" name="facebook" class="form-control" id="reg_name"
								value = "<?php echo $facebook; ?>" style="font-family: 'PT Sans Caption', sans-serif;">							
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12"
							for="reg_name">Twitter: </label>
							<div class="col-xs-12">
								<input type="text" name="twitter" class="form-control" id="reg_name"
								value = "<?php echo $twitter; ?>" style="font-family: 'PT Sans Caption', sans-serif;">							
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12"
							for="reg_name">Linkedin: </label>
							<div class="col-xs-12">
								<input type="text" name="linkedin" class="form-control" id="reg_name"
								value = "<?php echo $linkedin; ?>" style="font-family: 'PT Sans Caption', sans-serif;">							
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12"
							for="reg_name">Email: </label>
							<div class="col-xs-12">
								<input type="text" name="email" class="form-control" id="reg_name"
								value = "<?php echo $email; ?>" style="font-family: 'PT Sans Caption', sans-serif;">							
							</div>
						</div>						
						</br>						
						<div class=" col-xs-12 ">
							<input type="submit" class="btn btn-default" value="Edit info" name = "edit_info">
						</div>	
						</br>					
					</form>
					
					
				<?php } 
				else { ?>
					<?php if($bio == NULL && $facebook == NULL && $twitter == NULL && $linkedin == NULL && $email == NULL){ ?>
						<label class="col-xs-12"for="reg_name">we've got nothing</label>
					<?php } ?>
					<?php if($bio != NULL){ ?> 
						<label class="col-xs-12"for="reg_name">About:</label></br>
					<li><?php echo $bio;} ?> </li>						
					<?php if($facebook != NULL){ ?> 
						<label class="col-xs-12"for="reg_name">Facebook:</label></br> 
					<li><?php echo $facebook;} ?> </li>
					<?php if($twitter != NULL){ ?> 
						<label class="col-xs-12"for="reg_name">Twitter:</label></br>
					<li><?php echo $twitter;} ?> </li>
					<?php if($linkedin != NULL){ ?> 
						<label class="col-xs-12"for="reg_name">Linkedin:</label></br>
					<li><?php echo $linkedin;} ?> </li>
					<?php if($email != NULL){ ?> 
						<label class="col-xs-12"for="reg_name">Email:</label></br>
					<li><?php echo $email;} ?> </li>					
				<?php } ?>
			<br />
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
