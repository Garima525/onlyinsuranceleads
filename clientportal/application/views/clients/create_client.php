<?php $this->load->view('layout/header.php'); ?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="mb-5 text-dark">&nbsp;</div>
        <div id="infoMessage"><?php echo $message; ?></div>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center">New Client</h1>
                <?php echo form_open_multipart("clients/create_client"); ?>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php echo lang('create_user_fname_label', 'first_name'); ?> <br/>
                            <?php echo form_input($first_name); ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php echo lang('create_user_lname_label', 'last_name'); ?> <br/>
                            <?php echo form_input($last_name); ?>
                        </div>
                    </div>
                </div>
                <?php
                if ($identity_column !== 'email') {
                    echo '<p>';
                    echo lang('create_user_identity_label', 'identity');
                    echo '<br />';
                    echo form_error('identity');
                    echo form_input($identity);
                    echo '</p>';
                }
                ?>
                <div class="form-group">
                    <?php echo lang('create_user_email_label', 'email'); ?> <br/>
                    <?php echo form_input($email); ?>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php echo lang('create_user_password_label', 'password'); ?> <br/>
                            <?php echo form_input($password); ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?> <br/>
                            <?php echo form_input($password_confirm); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding:1%">
                        Client Pages
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-check mb-2">
                            <label class="checkbox-container">Ratings Form
                                <input type="checkbox" name="rating_form" id="rating_form" class="form-check-input" value="1" checked>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-check mb-2">
                            <label class="checkbox-container">Premium Table
                                <input type="checkbox" name="premium_form" id="premium_form" class="form-check-input" value="1" checked>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-check mb-2">
                            <label class="checkbox-container">ACH Bank Details
                                <input type="checkbox" name="ach_form" id="ach_form" class="form-check-input" value="1" checked>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-check mb-2">
                            <label class="checkbox-container">Credit Card Form
                                <input type="checkbox" name="cc_form" id="cc_form" class="form-check-input" value="1" checked>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="custom_agreement">Custom Agreement:</label>
                            <?php //echo form_textarea($custom_agreement); ?>
                            <textarea name="custom_agreement" id="custom_agreement" class="form-control" rows="20">
                                <h5 class="text-center">AGREEMENT FOR PROVIDING CUSTOMER LISTS AND DIRECT MAIL SERVICES</h5>
                                <p>BLC Insurance Solutions, Inc., doing business as Only Insurance Leads (the “Company”), is a leading provider of Data and Data-driven marketing services for salespeople, marketers, and professionals in the home insurance industry (the “Customer”).  This Agreement is entered into this <?php echo date('d'); ?> day of <?php echo date('M'); ?>, <?php echo date('Y'); ?>, by and between the Company and the Customer identified below.</p>
                                <p>1. <u>Data to be Provided to Customer</u></p>
                                <p>The Company shall provide to Customer the Data prior to each mailing.  Data means the Company’s home insurance Database, which includes a prospect’s name, home address, year of home construction, size of home measured in square feet, estimated annual property insurance premium, recommended insurance coverage and approximate renewal month.</p>
                                <p>The Company’s Home View program provides Customers with a frontal, if available, or otherwise aerial, image of each prospect’s home in their direct mail letter or postcard.  Should the image provider, Microsoft Corporation, be unable to provide the Company a frontal or aerial image because of an outage or other technological issue, a stock image of a home will be used.  The Company makes no representations as to the quality or usefulness of images provided, as images may contain imperfections related to clarity, including, but not limited to, darkness, blurriness, inclusion of foreign objects, and off-centeredness</p>
                                <p>2. <u>Customer’s Selections</u></p>
                                <p>Any requested account changes such as zip code(s) changes, template revisions, HQ Foundation matrix updates must be completed before the 15th of the month to take effect on the following months cycle.</p>
                                <p>There is a $20.00 fee for any template revisions after initial set up.</p>
                                <p>Special Instructions (if any):</p>
                                <p>3. <u>Billing and Payment</u></p>
                                <p>3.1 Price.  Customer shall pay, on a monthly basis, seventy-five cents (75¢) per color letter or postcard for each prospect listed on the customer list, subject to increase at any time. In the event of such increase, Customer will be provided 30-day advance written notice after which Customer may choose to continue or cancel service.</p>
                                <p>3.2 Method of Invoicing and Payment and Delivery of Lists.  Only Insurance Leads shall submit, via email, monthly invoices to Customer on or about the twentieth (20th) day of each month.  Payments are automatically processed on the first (1st) day of each month either by ACH or credit card.  Customer shall be in default in the event that Customer’s payment is declined for any reason.  In such event, the Company shall give notice electronically of such default, giving Customer the right to cure said default within five (5) business days.  If Customer fails to cure, Company shall have the option to immediately terminate this Agreement by notice to Customer electronically or other means, at which time Customer shall have no further rights under this Agreement. The Company shall e-mail the Data to the Customer before the 9th day of each month.  Customer will also be provided with a postal receipt upon request that will confirm the amount of the mailings and the actual date their letters or postcards were mailed.</p>
                                <p>4. <u>Exclusivity</u></p>
                                <p>Customer shall enjoy exclusive use of the Data for the zip codes identified in section 3 and will not compete with any other agent within their own company or any agent from any other company, subject to termination as set forth in section 9.  The zip codes for which Customer shall have exclusivity may be updated from time to time by agreement between the Company and Customer.</p>
                                <p>5. <u>No Warranties; Limitations of Liability</u></p>
                                <p>The Company makes no warranty, whether express, implied, or statutory, as to the description, quality, merchantability, completeness, or fitness for any purpose of the Data, or as to any other matter (including response rates or ROI), all of which are hereby excluded and disclaimed.  In no event shall the Company be liable for any damages, either direct, indirect, consequential, special, incidental, actual, punitive, or otherwise, or for any lost profits of any kind or nature whatsoever, arising out of mistakes, errors, omissions, interruptions, or delays.  The Company furthermore makes no representation or warranty whether or not a prospect is on the “Do Not Call” list as published by the Federal Trade Commission.  It shall be Customer’s sole responsibility to make this determination and comply with all relevant telephone solicitation rules.</p>
                                <p>6. <u>Scrubbing options</u></p>
                                <p>Scrubbing means removing existing clients from their agency and carrier from their data.</p>
                                <p>6.1 Captive.  If Customer desires “scrubbed” Data to eliminate identifying current customers, Customer shall receive “Pre-Scrubbed” Data on or before the 1st day of each month.  Customer shall have two (2) business days to scrub and return Data to Company.  If Customer’s scrubbed list is not received by Company by the eighth (8th) day of the month (notwithstanding the day of the week that might fall), all of Customer’s Data will be scrubbed and no mailing shall be provided to Customer for the particular month.  In such event, Customer shall receive a credit of thirty-five cents ($0.35) per lead.</p>
                                <p>6.2 Independent.	If Customer desires “scrubbed” Data to eliminate identifying current customers, Customer shall receive “Pre-Scrubbed” Data on or before the 1st day of each month.  Customer shall have two (2) business days to scrub and return Data to Company.  If Customer’s scrubbed list is not received by Company by the eighth (8th) day of the month (notwithstanding the day of the week that might fall), Customer’s original pre-scrubbed Data will be sent to print production and Company shall not be responsible for the verification of any upset or dissatisfied customers.</p>
                                <p>7. <u>Termination</u></p>
                                <p>Either party may terminate this Agreement provided that Customer has had at least four (4) paid invoice cycles. After 4 paid invoice cycles, this Agreement will continue on a month-to-month basis. Customer acknowledges that thirty (30) day written notice to the Company is required for all cancellations.  Customer also acknowledges that Customer will no longer be able to use the Company’s copyrighted templates for the Customer’s use unless the Customer elects to reinstate services with Company.</p>
                                <p>8. <u>Deposit</u></p>
                                <p>Upon approval of this Agreement, Company requires a one hundred dollar ($100.00) fully refundable deposit.  Payment is required prior to, or immediately upon approval of this Agreement by the Company.  The deposit will be applied to the Customer’s final invoice.</p>
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="art_work">Art Work</label>
                            <?php echo form_input($art_work); ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <br><br>
                        <div class="form-check mb-2">
                            <label class="checkbox-container">Reservation Form
                                <input type="checkbox" name="reservation_form" id="reservation_form" class="form-check-input" value="1">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text-right"><?php echo form_submit('submit', "Create Agreement", array('class' => 'btn btn-success')); ?></div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('custom_agreement', {
        height: '25em'
    });
</script>
<?php $this->load->view('layout/footer.php'); ?>
