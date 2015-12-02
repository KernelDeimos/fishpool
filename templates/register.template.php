<div class="container">
	<div class="fp-form-box">

		<div class="form-header">
			<div class="title">Create Your Account</div>
		</div>

		<div class="form-body">

			<form
			class="form-horizontal basic-form"
			role="form"
			action="<?php echo WEB_PATH.'/register_submit' ?>" method="POST"
			data-success-url="http://www.google.ca"
			>
				<br />
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-2"
					for="reg_name" style="font-family: 'PT Sans Caption', sans-serif;">Display Name:</label>

					<div class="col-xs-12 col-sm-10">
						<input type="text" name="name" class="form-control" id="reg_name"
						placeholder="Enter an email" style="font-family: 'PT Sans Caption', sans-serif;">
					</div>
				</div>
				<br />
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-2"
					for="reg_email" style="font-family: 'PT Sans Caption', sans-serif;">Email:</label>

					<div class="col-xs-12 col-sm-10">
						<input type="text" name="email" class="form-control" id="reg_email"
						placeholder="Enter an email" style="font-family: 'PT Sans Caption', sans-serif;">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-2"
					for="reg_repeat_email" style="font-family: 'PT Sans Caption', sans-serif;">Repeat:</label>

					<div class="col-xs-12 col-sm-10">
						<input type="text" class="form-control" id="reg_repeat_email"
						placeholder="Enter an email" style="font-family: 'PT Sans Caption', sans-serif;">
					</div>
				</div>
				<br />
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-2"
					for="reg_pass" style="font-family: 'PT Sans Caption', sans-serif;">Password:</label>
					
					<div class="col-xs-12 col-sm-10"> 
						<input type="password" name="pass" class="form-control" id="reg_pass"
						placeholder="Enter password" style="font-family: 'PT Sans Caption', sans-serif;">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-2"
					for="reg_pass_repeat" style="font-family: 'PT Sans Caption', sans-serif;">Repeat:</label>
					
					<div class="col-xs-12 col-sm-10"> 
						<input type="password" class="form-control" id="reg_pass_repeat"
						placeholder="Enter password" style="font-family: 'PT Sans Caption', sans-serif;">
					</div>
				</div>
				<br />
				<div class="form-group"> 
					<div class="col-sm-offset-2 col-xs-12 col-sm-10">
						<input type="submit" class="btn btn-default" value="Register" style="font-family: 'PT Sans Caption', sans-serif;">
					</div>
				</div>

				<div class="error-message">
				</div>
			</form>

		</div>

	</div>
</div>
