<?php $this->load->view('layout/header.php'); ?>
<div class="row">
	<div class="col-md-12">
		<h1 class="text-center"><?php echo lang('deactivate_heading'); ?></h1>
		<p class="text-center"><?php echo sprintf(lang('deactivate_subheading'), $user->{$identity}); ?></p>
		<?php echo form_open("auth/deactivate/" . $user->id); ?>
		<div class="form-group text-center">
			<div class="form-check">
				<input class="form-check-input" type="radio" name="confirm" value="yes" checked="checked"/>
				<?php echo lang('deactivate_confirm_y_label', 'confirm'); ?>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="radio" name="confirm" value="no"/>
				<?php echo lang('deactivate_confirm_n_label', 'confirm'); ?>
			</div>

			<?php echo form_hidden($csrf); ?>
			<?php echo form_hidden(['id' => $user->id]); ?>

			<p><?php echo form_submit('submit', lang('deactivate_submit_btn'), array('class' => 'btn btn-success')); ?></p>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('layout/footer.php'); ?>
