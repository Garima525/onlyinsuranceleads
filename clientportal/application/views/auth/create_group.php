<?php $this->load->view('layout/header.php'); ?>
<div class="row">
	<div class="col-lg-4 offset-lg-4 col-md-4 offset-md-4">
		<h1 class="text-center"><?php echo lang('create_group_heading'); ?></h1>
		<p class="text-center"><?php echo lang('create_group_subheading'); ?></p>
		<div id="infoMessage"><?php echo $message; ?></div>
		<?php echo form_open("auth/create_group"); ?>
		<div class="form-group">
			<?php echo lang('create_group_name_label', 'group_name'); ?> <br/>
			<?php echo form_input($group_name); ?>
		</div>
		<div class="form-group">
			<?php echo lang('create_group_desc_label', 'description'); ?> <br/>
			<?php echo form_input($description); ?>
		</div>
		<div class="text-right"><?php echo form_submit('submit', lang('create_group_submit_btn'), array('class'=>'btn btn-info')); ?></div>

		<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('layout/footer.php'); ?>
