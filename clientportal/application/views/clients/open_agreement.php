<?php $this->load->view('layout/header.php'); ?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="mb-5 text-dark">&nbsp;</div>
        <div id="infoMessage"><?php echo $message; ?></div>
        <div class="row mb-2">
            <div class="col-xl-12 col-lg-12 col-md-12 text-right">
                <button class="btn btn-primary" id="exportClientAgreement">Export</button>
            </div>
        </div>
        <div class="card">
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
                        <?php if($agreement->reservation_form == 0){ ?>
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
                        <?php } ?>
                    </div>
                </div>
                <hr>
                <?php if ($this->uri->segment(2) == 'view_agreement') { ?>
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
        <div class="mb-5 text-dark">&nbsp;</div>
    </div>
</div>
<script>
    $(document).ready(function ($) {
        $("#exportClientAgreement").on('click', function (e) {
            window.open("<?php echo site_url('clients/export_agreement/' . $agreement->client_id); ?>");
        });
        var canvas = document.getElementById("signature");
        var signaturePad = new SignaturePad(canvas);
        // Returns signature image as data URL (see https://mdn.io/todataurl for the list of possible parameters)
        //signaturePad.toDataURL(); // save image as PNG
        //var fullQualityImage = signaturePad.toDataURL("image/jpeg", 1.0); // save image as JPEG
        //signaturePad.toDataURL("image/svg+xml"); // save image as SVG
        //$("#signatureImage").val(fullQualityImage);

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
