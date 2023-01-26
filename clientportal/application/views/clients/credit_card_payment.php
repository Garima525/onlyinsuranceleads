<?php $this->load->view('layout/header.php'); ?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="mb-5 text-dark">&nbsp;</div>
        <?php if ($message) { ?>
            <div class="alert alert-success" role="alert"><?php echo $message; ?></div>
        <?php } ?>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center">BLC Insurance Solutions, Inc.</h1>
                <p class="text-center font-weight-bold">Credit Card Authorization Form</p>
                <br>
                <p>Please fill in all the blanks. Your invoice will be emailed on or before the 1st day of each month.</p>
                <p>The funds will be charged to your Credit Card on the 1st of each month.</p>
                <?php echo form_open("", array('id' => 'credit_card_payment')); ?>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Name as it Appears on Credit Card</label>
                            <input class="form-control" type="text" name="name_on_card" id="name_on_card" value="<?php echo isset($name_on_card) ? $name_on_card : ''; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Credit Card Number</label>
                            <input class="form-control" type="number" name="credit_card_number" id="credit_card_number" value="<?php echo isset($credit_card_number) ? $credit_card_number : ''; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input class="form-control" type="text" name="expiry_date" id="expiry_date" value="<?php echo isset($expiry_date) ? $expiry_date : ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>CVV</label>
                            <input class="form-control" type="number" name="cvv_code" id="cvv_code" value="<?php echo isset($cvv_code) ? $cvv_code : ''; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Email you wish to use on this account</label>
                            <input class="form-control" type="email" name="account_email" id="account_email" value="<?php echo isset($account_email) ? $account_email : ''; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="font-weight-bold">AUTHORIZATION RESPECTING CHARGES INITIATED BY BLC INSURANCE SOLUTIONS, INC.</p>
                        <p>As a convenience to me, I hereby request and authorize BLC Insurance Solutions, Inc., to collect my Direct Mail charges and other amounts due from me to BLC Insurance Solutions, Inc., by charging my Credit Card and I hereby request and authorize my credit card company to pay and charge such amounts to my credit card. This authority is to remain in effect until revoked by me in writing.</p>
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

        $('#credit_card_payment').submit(function (e) {
            getSignaturePadSign(); // call this function here, sets the imageData right before submitting the form.
            return true; // returning true submits the form.
        });
    });
</script>
<?php $this->load->view('layout/footer.php'); ?>
