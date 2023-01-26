<?php $this->load->view('layout/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="mb-5 text-dark">&nbsp;</div>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center"><?php echo lang('edit_user_heading'); ?></h1>
                <?php echo form_open(uri_string()); ?>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php echo lang('edit_user_fname_label', 'first_name'); ?> <br/>
                            <?php echo form_input($first_name); ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php echo lang('edit_user_lname_label', 'last_name'); ?> <br/>
                            <?php echo form_input($last_name); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php echo lang('edit_user_company_label', 'company'); ?> <br/>
                            <?php echo form_input($company); ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php echo lang('edit_user_phone_label', 'phone'); ?> <br/>
                            <?php echo form_input($phone); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php echo lang('edit_user_password_label', 'password'); ?> <br/>
                            <?php echo form_input($password); ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?><br/>
                            <?php echo form_input($password_confirm); ?>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="groups[]" value="3" />
                <?php echo form_hidden('id', $user->id); ?>
                <?php echo form_hidden($csrf); ?>
                <div class="text-right"><?php echo form_submit('submit', 'Update User', array('class' => 'btn btn-success')); ?></div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer.php'); ?>
