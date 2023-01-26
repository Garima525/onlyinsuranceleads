<?php $this->load->view('layout/header.php'); ?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="mb-5 text-dark">&nbsp;</div>
        <div id="infoMessage"><?php echo $message; ?></div>
        <div class="row mb-2">
            <div class="col-xl-12 col-lg-12 col-md-12 text-right">
                <button class="btn btn-primary" id="exportClientPaymentInfo">Export</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center">Payment Information</h1>
                <?php if ($payment_info) { ?>
                    <?php foreach ($payment_info as $rec) { ?>
                        <?php if ($rec->payment_type == 'cc') { ?>
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="text-center">Credit Card Payment Detail</h3>
                                    <p>Please fill in all the blanks. Your invoice will be emailed on or before the 1st day of each month.</p>
                                    <p>The funds will be charged to your Credit Card on the 1st of each month.</p>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4"><b>Name as it Appears on Credit Card:</b></div>
                                        <div class="col-lg-8 col-md-8"><?php echo isset($rec->name_on_card) ? $rec->name_on_card : ''; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4"><b>Credit Card Number:</b></div>
                                        <div class="col-lg-8 col-md-8"><?php echo isset($rec->card_number) ? $rec->card_number : ''; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4"><b>Expiry Date:</b></div>
                                                <div class="col-lg-8 col-md-8"><?php echo isset($rec->card_expiry) ? $rec->card_expiry : ''; ?></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4"><b>CVV:</b></div>
                                                <div class="col-lg-8 col-md-8"><?php echo isset($rec->card_cvv) ? $rec->card_cvv : ''; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4"><b>Email you wish to use on this account:</b></div>
                                        <div class="col-lg-8 col-md-8"><?php echo isset($rec->email_for_accout) ? $rec->email_for_accout : ''; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <p class="font-weight-bold">AUTHORIZATION RESPECTING CHARGES INITIATED BY BLC INSURANCE SOLUTIONS, INC.</p>
                                            <p>As a convenience to me, I hereby request and authorize BLC Insurance Solutions, Inc., to collect my Direct Mail charges and other amounts due from me to BLC Insurance Solutions, Inc., by charging my Credit Card and I hereby request and authorize my credit card company to pay and charge such amounts to my credit card. This authority is to remain in effect until revoked by me in writing.</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2"><b>Signature:</b></div>
                                        <div class="col-lg-10 col-md-10">
                                            <?php if ($rec->signature) : ?>
                                                <img src="<?php echo $rec->signature; ?>" style="border: 1px solid;"/>
                                            <?php else: ?>
                                                <span>Signature Not Available</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="text-center">ACH Payment Detail</h3>
                                    <p>I(we) hereby authorize BLC Insurance Solutions, Inc. to initiate entries to my (our) checking/saving accounts at the financial institution listed below, and, if necessary, initiate adjustments for any transactions credited/debited in error. this authority will remain i erect until BLC Insurance Solutions, Inc. is notified INSTITUTION a reasonable opportunity to act on it.</p>
                                    <?php echo form_open("", array('id' => 'ach_payment')); ?>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4"><b>Name of Financial Institution:</b></div>
                                        <div class="col-lg-8 col-md-8"><?php echo isset($rec->financial_institution) ? $rec->financial_institution : ''; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4"><b>Routing Number:</b></div>
                                                <div class="col-lg-8 col-md-8"><?php echo isset($rec->routing_number) ? $rec->routing_number : ''; ?></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4"><b>Account Number:</b></div>
                                                <div class="col-lg-8 col-md-8"><?php echo isset($rec->account_number) ? $rec->account_number : ''; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2"><b>Cheque Image:</b></div>
                                        <div class="col-lg-10 col-md-10">
                                            <?php if ($rec->cheque_image) : ?>
                                                    <img height="250" src="<?php echo base_url('assets/payment/' . $rec->cheque_image); ?>" style="border: 1px solid;"/>
                                            <?php else: ?>
                                                <span>Cheque Image is not uploaded.</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2"><b>Signature:</b></div>
                                        <div class="col-lg-10 col-md-10">
                                            <?php if ($rec->signature) : ?>
                                                <img src="<?php echo $rec->signature; ?>" style="border: 1px solid;"/>
                                            <?php else: ?>
                                                <span>Signature Not Available</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="mb-2 text-dark">&nbsp;</div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="text-black-50 text-center p-5">Client has not added yet.</div>
                <?php } ?>
            </div>
        </div>
        <div class="mb-5 text-dark">&nbsp;</div>
    </div>
</div>
<script>
    $(document).ready(function ($) {
        $("#exportClientPaymentInfo").on('click', function (e) {
            window.open("<?php echo site_url('clients/export_paymentInfo/' . $this->uri->segment(3)); ?>");
        });
    });
</script>
<?php $this->load->view('layout/footer.php'); ?>
