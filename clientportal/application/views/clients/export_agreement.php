<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="mb-5 text-dark">&nbsp;</div>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center">Agreement</h1>
                <div class="row">
                    <div class="col-lg-2 col-md-2"><b>Name:</b></div>
                    <div class="col-lg-10 col-md-10"><?php echo $client->first_name . ' ' . $client->last_name; ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2"><b>Email:</b></div>
                    <div class="col-lg-10 col-md-10"><?php echo $client->email; ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2"><b>Agreement:</b></div>
                    <div class="col-lg-10 col-md-10">
                        <p><?php echo $agreement->custom_agreement; ?></p>
                    </div>
                </div>
                <hr>
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
                <?php if ($agreement->status == 'approve') { ?>
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
                <?php } ?>
            </div>
        </div>
        <div class="mb-5 text-dark">&nbsp;</div>
    </div>
</div>