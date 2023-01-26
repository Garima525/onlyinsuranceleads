<html>
<head>
	<title>Login | Client Portal</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/open-iconic-bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
</head>
<body class="body-bg-img">
<div class="container">
	<div class="row">
		<div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-4 offset-md-4 col-sm-6 offset-sm-3 center mt-5">
			<div class="text-center mb-5">
				<a href="<?php echo site_url(); ?>">
					<img style="width: 75%;" src="<?php echo base_url('assets/img/'.LOGO_NAME); ?>"/>
				</a>
			</div>
			<h1 class="text-center text-white"><?php echo lang('forgot_password_heading'); ?></h1>
			<p class="text-center text-white"><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>
			<div id="infoMessage"><?php echo $message; ?></div>
			<?php echo form_open("auth/forgot_password"); ?>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text no-border-radius bg-white"><?php echo(($type == 'email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label)); ?></span>
				</div>
				<?php echo form_input($identity); ?>
			</div>
			<?php echo form_submit('submit', lang('forgot_password_submit_btn'), array('class' => 'btn btn-dark btn-lg btn-block text-white')); ?>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
</body>
</html>
