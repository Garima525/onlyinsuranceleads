<?php $this->load->view('layout/header.php'); ?>
<div class="row">
	<div class="col-xl-12 col-lg-12 col-md-12">
		<div class="mb-5 text-dark">&nbsp;</div>
		<div id="infoMessage"><?php echo $message; ?></div>
		<div class="card">
			<div class="card-body">
				<h1 class="card-title text-center">New User</h1>
				<?php echo form_open("auth/create_user"); ?>
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<?php echo lang('create_user_fname_label', 'first_name'); ?> <br/>
							<?php echo form_input($first_name); ?>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<?php echo lang('create_user_lname_label', 'last_name'); ?> <br/>
							<?php echo form_input($last_name); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<?php echo lang('create_user_company_label', 'company'); ?> <br/>
							<?php echo form_input($company); ?>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<?php echo lang('create_user_phone_label', 'phone'); ?> <br/>
							<?php echo form_input($phone); ?>
						</div>
					</div>
				</div>
				<?php
				if ($identity_column !== 'email') {
					echo '<p>';
					echo lang('create_user_identity_label', 'identity');
					echo '<br />';
					echo form_error('identity');
					echo form_input($identity);
					echo '</p>';
				}
				?>
				<div class="form-group">
					<?php echo lang('create_user_email_label', 'email'); ?> <br/>
					<?php echo form_input($email); ?>
				</div>
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<?php echo lang('create_user_password_label', 'password'); ?> <br/>
							<?php echo form_input($password); ?>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?> <br/>
							<?php echo form_input($password_confirm); ?>
						</div>
					</div>
				</div>
				<input type="hidden" name="groups[]" value="3" checked="checked">
				<div class="text-right"><?php echo form_submit('submit', lang('create_user_submit_btn'), array('class' => 'btn btn-success')); ?></div>

				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('layout/footer.php'); ?>
