<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
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
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name as it Appears on Credit Card:</th>
                                            <td><?php echo isset($rec->name_on_card) ? $rec->name_on_card : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Credit Card Number:</th>
                                            <td><?php echo isset($rec->card_number) ? $rec->card_number : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Expiry Date:</th>
                                            <td><?php echo isset($rec->card_expiry) ? $rec->card_expiry : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <th>CVV:</th>
                                            <td><?php echo isset($rec->card_cvv) ? $rec->card_cvv : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email you wish to use on this account:</th>
                                            <td><?php echo isset($rec->email_for_accout) ? $rec->email_for_accout : ''; ?></td>
                                        </tr>
                                    </table>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <p class="font-weight-bold">AUTHORIZATION RESPECTING CHARGES INITIATED BY BLC INSURANCE SOLUTIONS, INC.</p>
                                            <p>As a convenience to me, I hereby request and authorize BLC Insurance Solutions, Inc., to collect my Direct Mail charges and other amounts due from me to BLC Insurance Solutions, Inc., by charging my Credit Card and I hereby request and authorize my credit card company to pay and charge such amounts to my credit card. This authority is to remain in effect until revoked by me in writing.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php if ($rec->signature) : ?>
                                            <img src="<?php echo $rec->signature; ?>" style="border: 1px solid;"/>
                                        <?php else: ?>
                                            <span>Signature Not Available</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="text-center">ACH Payment Detail</h3>
                                    <p>I(we) hereby authorize BLC Insurance Solutions, Inc. to initiate entries to my (our) checking/saving accounts at the financial institution listed below, and, if necessary, initiate adjustments for any transactions credited/debited in error. this authority will remain i erect until BLC Insurance Solutions, Inc. is notified INSTITUTION a reasonable opportunity to act on it.</p>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name of Financial Institution:</th>
                                            <td><?php echo isset($rec->financial_institution) ? $rec->financial_institution : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Routing Number:</th>
                                            <td><?php echo isset($rec->routing_number) ? $rec->routing_number : ''; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Account Number:</th>
                                            <td><?php echo isset($rec->account_number) ? $rec->account_number : ''; ?></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <div class="row">
                                        <?php if ($rec->cheque_image) : ?>
                                            <?php $cheque_base_64 = base64_encode(file_get_contents(base_url('assets/payment/' . $rec->cheque_image))); ?>
                                            <img height="250" src="<?php echo 'data:image/png;base64,' . $cheque_base_64; ?>" />
                                        <?php else: ?>
                                            <span>Cheque Image is not uploaded.</span>
                                        <?php endif; ?>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <?php if ($rec->signature) : ?>
                                            <img src="<?php echo $rec->signature; ?>" style="border: 1px solid;"/>
                                        <?php else: ?>
                                            <span>Signature Not Available</span>
                                        <?php endif; ?>
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