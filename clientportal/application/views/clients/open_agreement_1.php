<?php $this->load->view('layout/header.php'); ?>
<style>
    .checkbox-container {
        display: block;
        padding-left: 5px;
        cursor: pointer;
        font-size: 16px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    /* Hide the browser's default checkbox */
    .checkbox-container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }
    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 2px;
        left: 0;
        height: 18px;
        width: 18px;
        background-color: #eee;
    }
    /* On mouse-over, add a grey background color */
    .checkbox-container:hover input ~ .checkmark {
        background-color: #ccc;
    }
    /* When the checkbox is checked, add a blue background */
    .checkbox-container input:checked ~ .checkmark {
        border: 1px solid white;
        background-color: #3AABD5;
    }
    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }
    /* Show the checkmark when checked */
    .checkbox-container input:checked ~ .checkmark:after {
        display: block;
    }
    /* Style the checkmark/indicator */
    .checkbox-container .checkmark:after {
        left: 5px;
        top: 1px;
        width: 6px;
        height: 12px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="mb-5 text-dark">&nbsp;</div>
        <div id="infoMessage"><?php echo $message; ?></div>
        <div class="row mb-2">
            <div class="col-xl-12 col-lg-12 col-md-12 text-right">
                <a class="btn btn-primary" href="<?php echo site_url('clients/export_agreement/' . $agreement->client_id); ?>">Export</a>
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
                        <h5 class="text-center">AGREEMENT FOR PROVIDING CUSTOMER LISTS AND DIRECT MAIL SERVICES</h5>
                        <br>
                        <p>BLC Insurance Solutions, Inc., doing business as Only Insurance Leads (the “Company”), is a leading provider of Data and Data-driven marketing services for salespeople, marketers, and professionals in the home insurance industry (the “Customer”).  This Agreement is entered into this <?php echo date('d', $agreement->created_on); ?> day of <?php echo date('M', $agreement->created_on); ?>, <?php echo date('Y', $agreement->created_on); ?>, by and between the Company and the Customer identified below.</p>
                        <br>
                        <ol>
                            <li><u>Data to be Provided to Customer</u></li>
                            <p>The Company shall provide to Customer the Data prior to each mailing.  Data means the Company’s home insurance Database, which includes a prospect’s name, home address, year of home construction, size of home measured in square feet, estimated annual property insurance premium, recommended insurance coverage and approximate renewal month.</p>
                            <p>The Company’s Home View program provides Customers with a frontal, if available, or otherwise aerial, image of each prospect’s home in their direct mail letter or postcard.  Should the image provider, Microsoft Corporation, be unable to provide the Company a frontal or aerial image because of an outage or other technological issue, a stock image of a home will be used.  The Company makes no representations as to the quality or usefulness of images provided, as images may contain imperfections related to clarity, including, but not limited to, darkness, blurriness, inclusion of foreign objects, and off-centeredness</p>
                            <li><u>Customer’s Selections</u></li>
                            <p>Any requested account changes such as zip code(s) changes, template revisions, HQ Foundation matrix updates must be completed before the 15th of the month to take effect on the following months cycle.</p>
                            <p>There is a $20.00 fee for any template revisions after initial set up.</p>
                            <p>Special Instructions (if any):</p>
                            <li><u>Billing and Payment</u></li>
                            <p>3.1	Price.  Customer shall pay, on a monthly basis, seventy-five cents (75¢) per color letter or postcard for each prospect listed on the customer list, subject to increase at any time. In the event of such increase, Customer will be provided 30-day advance written notice after which Customer may choose to continue or cancel service.</p>
                            <p>3.2	Method of Invoicing and Payment and Delivery of Lists.  Only Insurance Leads shall submit, via email, monthly invoices to Customer on or about the twentieth (20th) day of each month.  Payments are automatically processed on the first (1st) day of each month either by ACH or credit card.  Customer shall be in default in the event that Customer’s payment is declined for any reason.  In such event, the Company shall give notice electronically of such default, giving Customer the right to cure said default within five (5) business days.  If Customer fails to cure, Company shall have the option to immediately terminate this Agreement by notice to Customer electronically or other means, at which time Customer shall have no further rights under this Agreement. The Company shall e-mail the Data to the Customer before the 9th day of each month.  Customer will also be provided with a postal receipt upon request that will confirm the amount of the mailings and the actual date their letters or postcards were mailed.</p>
                            <li><u>Exclusivity</u></li>
                            <p>Customer shall enjoy exclusive use of the Data for the zip codes identified in section 3 and will not compete with any other agent within their own company or any agent from any other company, subject to termination as set forth in section 9.  The zip codes for which Customer shall have exclusivity may be updated from time to time by agreement between the Company and Customer.</p>
                            <li><u>No Warranties; Limitations of Liability</u></li>
                            <p>The Company makes no warranty, whether express, implied, or statutory, as to the description, quality, merchantability, completeness, or fitness for any purpose of the Data, or as to any other matter (including response rates or ROI), all of which are hereby excluded and disclaimed.  In no event shall the Company be liable for any damages, either direct, indirect, consequential, special, incidental, actual, punitive, or otherwise, or for any lost profits of any kind or nature whatsoever, arising out of mistakes, errors, omissions, interruptions, or delays.  The Company furthermore makes no representation or warranty whether or not a prospect is on the “Do Not Call” list as published by the Federal Trade Commission.  It shall be Customer’s sole responsibility to make this determination and comply with all relevant telephone solicitation rules.</p>
                            <li><u>Scrubbing options</u></li>
                            <p>Scrubbing means removing existing clients from their agency and carrier from their data.</p>
                            <p>6.1 	Captive.  If Customer desires “scrubbed” Data to eliminate identifying current customers, Customer shall receive “Pre-Scrubbed” Data on or before the 1st day of each month.  Customer shall have two (2) business days to scrub and return Data to Company.  If Customer’s scrubbed list is not received by Company by the eighth (8th) day of the month (notwithstanding the day of the week that might fall), all of Customer’s Data will be scrubbed and no mailing shall be provided to Customer for the particular month.  In such event, Customer shall receive a credit of thirty-five cents ($0.35) per lead.</p>
                            <p>6.2.	Independent.	If Customer desires “scrubbed” Data to eliminate identifying current customers, Customer shall receive “Pre-Scrubbed” Data on or before the 1st day of each month.  Customer shall have two (2) business days to scrub and return Data to Company.  If Customer’s scrubbed list is not received by Company by the eighth (8th) day of the month (notwithstanding the day of the week that might fall), Customer’s original pre-scrubbed Data will be sent to print production and Company shall not be responsible for the verification of any upset or dissatisfied customers.</p>
                            <li><u>Termination</u></li>
                            <p>Either party may terminate this Agreement provided that Customer has had at least four (4) paid invoice cycles. After 4 paid invoice cycles, this Agreement will continue on a month-to-month basis. Customer acknowledges that thirty (30) day written notice to the Company is required for all cancellations.  Customer also acknowledges that Customer will no longer be able to use the Company’s copyrighted templates for the Customer’s use unless the Customer elects to reinstate services with Company.</p>
                            <li><u>Deposit</u></li>
                            <p>Upon approval of this Agreement, Company requires a one hundred dollar ($100.00) fully refundable deposit.  Payment is required prior to, or immediately upon approval of this Agreement by the Company.  The deposit will be applied to the Customer’s final invoice.</p>
                        </ol>
                        <hr>
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
                <?php if ($this->uri->segment(2) == 'view_agreement') { ?>
                    <div class="row">
                        <div class="col-lg-2 col-md-2"><b>Status:</b></div>
                        <div class="col-lg-10 col-md-10"><?php echo strtoupper($agreement->status); ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-2"><b>Art Work:</b></div>
                        <div class="col-lg-10 col-md-10">
                            <?php if ($agreement->art_work) : ?>
                                <img src="<?php echo base_url('assets/artwork/' . $agreement->art_work); ?>"
                                     style="border: 1px solid;height: 250px;"/>
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
                        <div class="col-lg-2 col-md-2"><b>Art Work:</b></div>
                        <div class="col-lg-10 col-md-10">
                            <?php if ($agreement->art_work) : ?>
                                <img src="<?php echo base_url('assets/artwork/' . $agreement->art_work); ?>"
                                     style="border: 1px solid;height: 250px;"/>
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
    });
</script>
<?php $this->load->view('layout/footer.php'); ?>
