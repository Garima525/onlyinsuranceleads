<?php $this->load->view('layout/header.php'); ?>
<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="AgreementTab">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#AgreementTabCollapse" aria-expanded="true" aria-controls="AgreementTabCollapse">Agreement</button>
            </h2>
        </div>
        <div id="AgreementTabCollapse" class="collapse show" aria-labelledby="AgreementTab" data-parent="#accordionExample">
            <div class="card-body">
                <h1 class="card-title text-center">Agreement</h1>
                <?php echo form_open("clients/update_agreement", array('id' => 'open_agreement')); ?>
                <div class="row">
                    <div class="col-lg-2 col-md-2"><b>Name:</b></div>
                    <div class="col-lg-10 col-md-10"><?php echo $agreement->first_name . ' ' . $agreement->last_name; ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2"><b>Email:</b></div>
                    <div class="col-lg-10 col-md-10"><?php echo $agreement->email; ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2"><b>Agreement:</b></div>
                    <div class="col-lg-10 col-md-10">
                        <p><?php echo $agreement->custom_agreement; ?></p>
                        <hr>
                        <div class="form-check mb-2">
                            <label class="checkbox-container">I have read and understand the scrubbing option.
                                <input type="checkbox" name="accept_agreement_chk_one" value="1" id="accept_agreement_chk_one" class="form-check-input" <?php echo strtolower($agreement->status) == 'approve' ? 'checked' : ''; ?>>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <hr>
                        <div class="form-check mb-2">
                            <label class="checkbox-container">I have read and understand the thirty (30) day cancellation policy.
                                <input type="checkbox" name="accept_agreement_chk_two" value="1" id="accept_agreement_chk_two" class="form-check-input" <?php echo strtolower($agreement->status) == 'approve' ? 'checked' : ''; ?>>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <hr>
                        <div class="form-check mb-2">
                            <label class="checkbox-container">I accept this agreement in its entirely.
                                <input type="checkbox" name="accept_agreement_chk_three" value="1" id="accept_agreement_chk_three" class="form-check-input" <?php echo strtolower($agreement->status) == 'approve' ? 'checked' : ''; ?>>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <?php if ($agreement->status != 'pending') { ?>
                    <div class="row">
                        <div class="col-lg-2 col-md-2"><b>Status:</b></div>
                        <div class="col-lg-10 col-md-10"><?php echo strtoupper($agreement->status); ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-2"><b>Address:</b></div>
                        <div class="col-lg-10 col-md-10"><?php echo isset($client_info) ? $client_info->address : ''; ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-2"><b>City:</b></div>
                        <div class="col-lg-10 col-md-10"><?php echo isset($client_info) ? $client_info->city : ''; ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-2"><b>State:</b></div>
                        <div class="col-lg-10 col-md-10"><?php echo isset($client_info) ? $client_info->state : ''; ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-2"><b>Zip Code(s):</b></div>
                        <div class="col-lg-10 col-md-10"><?php echo isset($client_info) ? $client_info->zip_code : ''; ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-2"><b>Artwork:</b></div>
                        <div class="col-lg-10 col-md-10">
                            <?php if ($agreement->art_work) : ?>
                                <?php $artwork_array = explode('.', $agreement->art_work); ?>
                                <?php if (strtolower(end($artwork_array)) == 'pdf') : ?>
                                    <embed src="<?php echo base_url('assets/artwork/' . $agreement->art_work); ?>" type="application/pdf" width="100%" height="1150px" />
                                <?php else: ?>
                                    <img src="<?php echo base_url('assets/artwork/' . $agreement->art_work); ?>" style="border: 1px solid;height: 300px;"/>
                                <?php endif; ?>
                            <?php else: ?>
                                <span>Image Not Available</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-2"><b>Signature:</b></div>
                        <div class="col-lg-10 col-md-10">
                            <?php if ($agreement->signature) : ?>
                                <img src="<?php echo $agreement->signature; ?>" style="border: 1px solid;"/>
                            <?php else: ?>
                                <span>Signature Not Available</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php } else { ?>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" name="address" id="address" value="<?php echo isset($address) ? $address : ''; ?>" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>City</label>
                                <input class="form-control" type="text" name="city" id="city" value="<?php echo isset($city) ? $city : ''; ?>" required>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>State</label>
                                <input class="form-control" type="text" name="state" id="state" value="<?php echo isset($state) ? $state : ''; ?>" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group" id="zipCodeContainer">
                                <label>Zip Code - <span class="oi oi-plus" title="Add another zip code" id="appendZipCode"></span></label>
                                <input class="form-control" type="text" name="zip_code[]" id="zip_code" value="<?php echo isset($zip_code) ? $zip_code : ''; ?>" required>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-lg-2 col-md-2"><b>Artwork:</b></div>
                        <div class="col-lg-10 col-md-10">
                            <?php if ($agreement->art_work) : ?>
                                <?php $artwork_array = explode('.', $agreement->art_work); ?>
                                <?php if (strtolower(end($artwork_array)) == 'pdf') : ?>
                                    <embed src="<?php echo base_url('assets/artwork/' . $agreement->art_work); ?>" type="application/pdf" width="100%" height="1150px" />
                                <?php else: ?>
                                    <img src="<?php echo base_url('assets/artwork/' . $agreement->art_work); ?>" style="border: 1px solid;height: 300px;"/>
                                <?php endif; ?>
                            <?php else: ?>
                                <span>Image Not Available</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-2"><b>Signature:</b></div>
                        <div class="col-lg-10 col-md-10">
                            <canvas id="signature" width="500" height="250"
                                    style="border: 1px solid #ddd;"></canvas>
                            <br>
                            <button class="btn btn-small btn-danger" id="clear-signature">Clear</button>
                        </div>
                    </div>
                    <hr>
                    <div class="text-right">
                        <input type="hidden" name="agreement_id" value="<?php echo $agreement->id; ?>">
                        <input type="hidden" name="client_id" value="<?php echo $agreement->client_id; ?>">
                        <input type="hidden" name="signatureImage" id="signatureImage" value="">
                        <?php echo form_submit('Accept', "Accept", array('class' => 'btn btn-success', 'id' => 'accept_agreement')); ?>
                        <?php echo form_submit('Decline', "Decline", array('class' => 'btn btn-danger', 'id' => 'decline_agreement')); ?>
                    </div>
                <?php } ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="RatingTab">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#RatingTabCollapse" aria-expanded="false" aria-controls="RatingTabCollapse">Rating</button>
            </h2>
        </div>
        <div id="RatingTabCollapse" class="collapse" aria-labelledby="RatingTab" data-parent="#accordionExample">
            <div class="card-body">
                <h1 class="card-title text-center">Rating</h1>
                <?php echo form_open(site_url('rating')); ?>
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
    <div class="card">
        <div class="card-header" id="PremiumTab">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#PremiumTabCollapse" aria-expanded="false" aria-controls="PremiumTabCollapse">Premium</button>
            </h2>
        </div>
        <div id="PremiumTabCollapse" class="collapse" aria-labelledby="PremiumTab" data-parent="#accordionExample">
            <div class="card-body">
                <h1 class="card-title text-center">Estimated Premiums Per Year Built Below</h1>
                <?php echo form_open("rating/save_premium"); ?>
                <table class="table table-striped" cellpadding=0 cellspacing=10>
                    <tr>
                        <th class="text-black-50"></th>
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
                </table>
                <div class="text-right">
                    <button type="submit" class="btn btn-success pull-right"><?php echo isset($update) ? 'Update' : 'Save'; ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="PaymentInfoTab">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#PaymentInfoTabCollapse" aria-expanded="false" aria-controls="PaymentInfoTabCollapse">Payment Info</button>
            </h2>
        </div>
        <div id="PaymentInfoTabCollapse" class="collapse" aria-labelledby="PaymentInfoTab" data-parent="#accordionExample">
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

        $('#open_agreement').submit(function (e) {
            getSignaturePadSign(); // call this function here, sets the imageData right before submitting the form.
            return true; // returning true submits the form.
        });
        $("#accept_agreement").on('click', function (e) {
            if ($("#accept_agreement_chk_one").is(":not(:checked)")) {
                e.preventDefault();
                alert("Please read Agreement & accept terms and conditions");
                return false;
            }
            if ($("#accept_agreement_chk_two").is(":not(:checked)")) {
                e.preventDefault();
                alert("Please read Agreement & accept terms and conditions");
                return false;
            }
            if ($("#accept_agreement_chk_three").is(":not(:checked)")) {
                e.preventDefault();
                alert("Please read Agreement & accept terms and conditions");
                return false;
            }
        });

        $("#appendZipCode").click(function (e) {
            e.preventDefault();
            $("#zipCodeContainer").append('<br><input class="form-control" type="text" name="zip_code[]" id="zip_code" value="">');
            return false;
        });

    });
</script>
<?php $this->load->view('layout/footer.php'); ?>
