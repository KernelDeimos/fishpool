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
					<ul>
						<?php if (isset($groups)) foreach ($groups as $group) { ?>
							<li><?php $group->get_name(); ?></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		<?php } ?>
	</div>
</div>