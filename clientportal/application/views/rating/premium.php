<?php $this->load->view('layout/header.php'); ?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="mb-5 text-dark">&nbsp;</div>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center">Estimated Premiums Per Year Built Below</h1>
                <?php echo form_open("rating/save_premium"); ?>
                <table class="table table-striped" cellpadding=0 cellspacing=10>
                    <tr>
                        <th class="text-black-50">*Home Square Footage</th>
                        <?php if ($years) { ?>
                            <?php foreach ($years as $year) { ?>
                                <th class="text-black-50 text-center">Year <?php echo $year; ?></th>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                    <?php if ($lengths) { ?>
                        <?php foreach ($lengths as $key => $length) { ?>
                            <tr>
                                <th class="text-black-50"><?php echo $length; ?></th>
                                <?php if ($years) { ?>
                                    <?php foreach ($years as $year) { ?>
                                        <td><input type="number" class="form-control" name="year-<?php echo $year; ?>[]" value="<?php echo isset($records[$year]) ? $records[$year]->$key : ''; ?>"></td>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    <?php } ?>
					<tr>
						<th class="text-black-50">*Home Square Footage is multiplied by the Cost per Square Foot.</th>
						<th class="text-black-50 text-center"></th>
						<th class="text-black-50 text-center"></th>
						<th class="text-black-50 text-center"></th>
						<th class="text-black-50 text-center"></th>
						<th class="text-black-50 text-center"></th>
						<th class="text-black-50 text-center"></th>
					</tr>
                </table>
                <div class="text-right">
                    <button type="submit" class="btn btn-success pull-right"><?php echo isset($update) ? 'Update' : 'Save'; ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="mb-5 text-dark">&nbsp;</div>
    </div>
</div>
<?php $this->load->view('layout/footer.php'); ?>
