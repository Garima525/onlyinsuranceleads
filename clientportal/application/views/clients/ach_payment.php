<?php $this->load->view('layout/header.php'); ?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="mb-5 text-dark">&nbsp;</div>
        <?php if ($message) { ?>
            <div class="alert alert-success" role="alert"><?php echo $message; ?></div>
        <?php } ?>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center">ACH Payment Authorization</h1>
                <p class="text-center font-weight-bold">ACH Authorization Form</p>
                <hr>
                <p class="text-center">Authorization Agreement</p>
                <hr>
                <p>I(we) hereby authorize BLC Insurance Solutions, Inc. to initiate entries to my (our) checking/saving accounts at the financial institution listed below, and, if necessary, initiate adjustments for any transactions credited/debited in error. this authority will remain i erect until BLC Insurance Solutions, Inc. is notified INSTITUTION a reasonable opportunity to act on it.</p>
                <?php echo form_open_multipart("", array('id' => 'ach_payment')); ?>
                <hr>
                <p class="text-center">Account Information</p>
                <hr>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Name of Financial Institution</label>
                            <input class="form-control" type="text" name="financial_institution" id="financial_institution" value="<?php echo isset($financial_institution) ? $financial_institution : ''; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Routing Number</label>
                            <input class="form-control" type="text" name="routing_number" id="routing_number" value="<?php echo isset($routing_number) ? $routing_number : ''; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Account Number</label>
                            <input class="form-control" type="text" name="account_number" id="account_number" value="<?php echo isset($account_number) ? $account_number : ''; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="cheque_file">Check Image:</label>
                            <?php if (isset($account_detail_id)) { ?>
                                <?php if ($cheque_image) : ?>
                                    <img height="250" src="<?php echo base_url('assets/payment/' . $cheque_image); ?>" style="border: 1px solid;"/>
                                <?php else: ?>
                                    <span> Check Image not uploaded.</span>
                                <?php endif; ?>
                            <?php } else { ?>
                                <input type="file" name="cheque_file" id="cheque_file" class="form-control">
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-center">
                        <p>Signature</p>
                        <?php if (isset($account_detail_id)) { ?>
                            <?php if ($signature) : ?>
                                <img src="<?php echo $signature; ?>" style="border: 1px solid;"/>
                            <?php else: ?>
                                <span>Signature Not Available</span>
                            <?php endif; ?>
                        <?php } else { ?>
                            <canvas id="signature" width="500" height="250" style="border: 1px solid #ddd;"></canvas>
                            <br>
                            <button class="btn btn-small btn-danger" id="clear-signature">Clear</button>
                        <?php } ?>
                    </div>
                </div>
                <?php if (!isset($account_detail_id)) { ?>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <input type="hidden" name="signatureImage" id="signatureImage" value="">
                            <input type="hidden" name="account_detail_id" id="account_detail_id" value="<?php echo isset($account_detail_id) ? $account_detail_id : ''; ?>">
                            <button type="submit" class="btn btn-primary"><?php echo isset($account_detail_id) ? 'Update' : 'Save'; ?></button>
                        </div>
                    </div>
                <?php } ?>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="mb-5 text-dark">&nbsp;</div>
    </div>
</div>
<script>
    $(document).ready(function ($) {
        var canvas = document.getElementById("signature");
        var signaturePad = new SignaturePad(canvas);
        $('#clear-signature').on('click', function (e) {
            signaturePad.clear();
            e.preventDefault();
        });
        function getSignaturePadSign() {
            var fullQualityImage = signaturePad.toDataURL();
            document.getElementById("signatureImage").setAttribute("value", fullQualityImage);
        }

        $('#ach_payment').submit(function (e) {
            getSignaturePadSign(); // call this function here, sets the imageData right before submitting the form.
            return true; // returning true submits the form.
        });
    });
</script>
<?php $this->load->view('layout/footer.php'); ?>
