
<div class="fp-landing-header">
	<div class="container container-style-1">
		<div class="col-xs-12 col-sm-6 col-md-4 col-no-spacing fp-landing-login-box">
			<form class="form-horizontal basic-form"
				role="form"
				action="<?php echo WEB_PATH.'/login_submit' ?>" method="POST"
				data-success-url="http://www.google.ca"
			>

				<div class="form-group">
					<label class="control-label col-xs-4"
					for="logn_user"
					style="font-family: 'PT Sans Caption', sans-serif;"
					>Email:</label>
					<div class="col-xs-8">
						<input name="email" type="text" class="form-control" id="logn_user" placeholder="Enter your email" style="font-family: 'PT Sans Caption', sans-serif;">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-4"
					for="logn_pass"
					style="font-family: 'PT Sans Caption', sans-serif;"
					>Password:</label>
					<div class="col-xs-5 col-md-4 col-lg-5">
						<input name="pass" type="password" class="form-control" id="logn_pass" style="font-family: 'PT Sans Caption', sans-serif;">
					</div>
					<div class="col-xs-3 col-md-4 col-lg-3">
						<input type="submit" class="form-control" id="logn_submit" style="font-family: 'PT Sans Caption', sans-serif;" value="Login">
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

<div class="container">

	<div class="col-xs-12 col-lg-6 col-no-spacing">
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
						<label class="control-label col-xs-12 col-sm-3"
						for="reg_name" style="font-family: 'PT Sans Caption', sans-serif;">Display Name:</label>

						<div class="col-xs-12 col-sm-9">
							<input type="text" name="name" class="form-control" id="reg_name"
							placeholder="Enter an email" style="font-family: 'PT Sans Caption', sans-serif;">
						</div>
					</div>
					<br />
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3"
						for="reg_email" style="font-family: 'PT Sans Caption', sans-serif;">Email:</label>

						<div class="col-xs-12 col-sm-9">
							<input type="text" name="email" class="form-control" id="reg_email"
							placeholder="Enter an email" style="font-family: 'PT Sans Caption', sans-serif;">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3"
						for="reg_repeat_email" style="font-family: 'PT Sans Caption', sans-serif;">Repeat:</label>

						<div class="col-xs-12 col-sm-9">
							<input type="text" class="form-control" id="reg_repeat_email"
							placeholder="Enter an email" style="font-family: 'PT Sans Caption', sans-serif;">
						</div>
					</div>
					<br />
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3"
						for="reg_pass" style="font-family: 'PT Sans Caption', sans-serif;">Password:</label>
						
						<div class="col-xs-12 col-sm-9"> 
							<input type="password" name="pass" class="form-control" id="reg_pass"
							placeholder="Enter password" style="font-family: 'PT Sans Caption', sans-serif;">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3"
						for="reg_pass_repeat" style="font-family: 'PT Sans Caption', sans-serif;">Repeat:</label>
						
						<div class="col-xs-12 col-sm-9"> 
							<input type="password" class="form-control" id="reg_pass_repeat"
							placeholder="Enter password" style="font-family: 'PT Sans Caption', sans-serif;">
						</div>
					</div>
					<br />
					<div class="form-group"> 
						<div class="col-sm-offset-3 col-xs-12 col-sm-9">
							<input type="submit" class="btn btn-default" value="Register" style="font-family: 'PT Sans Caption', sans-serif;">
						</div>
					</div>

					<div class="error-message">
					</div>
				</form>

			</div>

		</div><!-- /.fp-form-box -->
	</div><!-- /.col -->

	<div class="col-xs-12 col-lg-6 col-no-spacing col-lg-spacing">
		<div class="fp-landing-whatis">
			<h1>What is FishPool?</h1>
			<p>Fishy fish fish swimmy fishy fishy fish fish</p>
		</div>
	</div>

</div><!-- /.container -->
