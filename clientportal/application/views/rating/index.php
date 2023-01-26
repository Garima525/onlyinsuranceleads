<?php $this->load->view('layout/header.php'); ?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="mb-5 text-dark">&nbsp;</div>
        <?php if ($message) { ?>
            <div class="alert alert-success" role="alert"><?php echo $message; ?></div>
        <?php } ?>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center">Rating</h1>
                <?php echo form_open(""); ?>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>What deductible are you using to quote your leads?</label>
                            <!--AnswerGoesInB4-->
                            <input class="form-control" type="number" name="deductible" id="deductible" value="<?php echo isset($deductible) ? $deductible : ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>What is the dwelling cost per square foot you would like us to use?</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">$</span>
                                <input class="form-control" type="number" name="dwelling_cost" id="dwelling_cost" value="<?php echo isset($dwelling_cost) ? $dwelling_cost : ''; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>What percentage would you like to use for separate structure coverage?</label>
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="number" name="separate_structure_per" id="separate_structure_per" value="<?php echo isset($separate_structure_per) ? $separate_structure_per : ''; ?>" required>
                                <span class="input-group-text" id="addon-wrapping">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>What percentage would you like to use for personal property coverage?</label>
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="number" name="personal_property_per" id="personal_property_per" value="<?php echo isset($personal_property_per) ? $personal_property_per : ''; ?>" required>
                                <span class="input-group-text" id="addon-wrapping">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>What percentage (if applicable) would you like to use for loss of use coverage? <small>(For Example 50% or up to 12 Months)</small></label>
                            <div class="input-group flex-nowrap">
                                <input class="form-control" type="text" name="loss_of_use" id="loss_of_use" value="<?php echo isset($loss_of_use) ? $loss_of_use : ''; ?>">
                                <span class="input-group-text" id="addon-wrapping">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                        <input type="hidden" name="rating_id" id="rating_id" value="<?php echo isset($rating_id) ? $rating_id : ''; ?>">
                        <button type="submit" class="btn btn-primary"><?php echo isset($rating_id) ? 'Update' : 'Save'; ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer.php'); ?>
