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
                <?php echo form_open(""); ?>
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
                            <label>Address</label>
                            <input class="form-control" type="text" name="address" id="address" value="<?php echo isset($address) ? $address : ''; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>City</label>
                            <input class="form-control" type="text" name="city" id="city" value="<?php echo isset($city) ? $city : ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>State</label>
                            <input class="form-control" type="text" name="state" id="state" value="<?php echo isset($state) ? $state : ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input class="form-control" type="number" name="zip_code" id="zip_code" value="<?php echo isset($zip_code) ? $zip_code : ''; ?>" required>
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
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                        <input type="hidden" name="account_detail_id" id="account_detail_id" value="<?php echo isset($account_detail_id) ? $account_detail_id : ''; ?>">
                        <button type="submit" class="btn btn-primary"><?php echo isset($account_detail_id) ? 'Update' : 'Save'; ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="mb-5 text-dark">&nbsp;</div>
    </div>
</div>
<script>
    $(document).ready(function ($) {});
</script>
<?php $this->load->view('layout/footer.php'); ?>
