<?php $this->load->view('layout/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="mb-5 text-dark">&nbsp;</div>
        <?php if ($message) { ?>
            <div class="alert alert-info" role="alert"><?php echo $message; ?></div>
        <?php } ?>
        <?php if ($create_client): ?>
            <p><?php echo anchor('clients/create_client', "+ Create a New Client", array('class' => 'text-black-50')) ?></p>
        <?php endif; ?>
        <?php $user = $this->ion_auth->user()->row(); ?>
        <?php $user_group = $this->ion_auth->get_users_groups($user->id)->row(); ?>
        <div class="card">
            <div class="card-body p-0">
                <?php if ($agreements): ?>
                    <h1 class="card-title text-center">Clients</h1>
                    <table class="table table-striped" cellpadding=0 cellspacing=10>
                        <thead>
                            <tr>
                                <?php if ($user_group->name == 'admin') { ?>
                                    <th class="text-black-50">Sales Person</th>
                                <?php } ?>
                                <th class="text-black-50">Client</th>
                                <th class="text-black-50">Email</th>
                                <th class="text-black-50">Status</th>
                                <th class="text-black-50 text-center">Agreement</th>
                                <th class="text-black-50 text-center">Rating</th>
                                <th class="text-black-50 text-center">Payment Info</th>
                                <th class="text-black-50 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($agreements as $key => $agreement): ?>
                                <tr>
                                    <?php if ($user_group->name == 'admin') { ?>
                                        <td><?php echo ($agreement->c_fname ? $agreement->c_fname : '') . ' ' . ($agreement->c_lname ? $agreement->c_lname : ''); ?></td>
                                    <?php } ?>

                                    <td><?php echo ($agreement->client_fname ? $agreement->client_fname : '') . " " . ($agreement->client_lname ? $agreement->client_lname : ''); ?></td>
                                    <td><?php echo $agreement->client_email ? $agreement->client_email : ''; ?></td>

                                    <td><?php echo strtoupper($agreement->status); ?></td>
                                    <?php if ($user_group->name == 'client' && $agreement->status == 'pending') { ?>
                                        <td>
                                            <a href="<?php echo site_url('/clients/open_agreement/' . $agreement->id); ?>">Open</a>
                                        </td>
                                    <?php } ?>
                                    <?php if ($user_group->name == 'admin' || $user_group->name == 'sales') { ?>
                                        <td class="text-center">
                                            <a class="text-black-50" href="<?php echo site_url('/clients/view_agreement/' . $agreement->id); ?>"><span class="oi oi-eye"></span></a>
                                        </td>
                                        <td class="text-center">
                                            <a class="text-black-50" href="<?php echo site_url('/clients/view_rating/' . $agreement->client_id); ?>"><span class="oi oi-eye"></span></a>
                                        </td>
                                        <td class="text-center">
                                            <a class="text-black-50" href="<?php echo site_url('/clients/view_payment_info/' . $agreement->client_id); ?>"><span class="oi oi-eye"></span></a>
                                        </td>
                                        <td class="text-center">
                                            <a class="text-black-50" href="<?php echo site_url('/clients/delete_client/' . $agreement->client_id); ?>"><span class="oi oi-trash"></span></a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center"><?php echo $links; ?></div>
                <?php else: ?>
                    <div class="text-black-50 text-center p-5">No Client exist. Please <?php echo anchor('clients/create_client', "Create a New Client", array('class' => 'text-dark')) ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer.php'); ?>
