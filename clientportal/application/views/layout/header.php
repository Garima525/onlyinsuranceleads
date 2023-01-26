<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/open-iconic-bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
        <!--<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.slim.min.js'); ?>"></script>-->
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<!--	<script type="text/javascript" src="--><?php //echo base_url('assets/js/signature_pad.min.js');                                                                                                      ?><!--"></script>-->
        <script type="text/javascript" src="<?php echo base_url('assets/js/signature_pad.umd.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
        <?php $user = $this->ion_auth->user()->row(); ?>
        <?php $user_group = $this->ion_auth->get_users_groups($user->id)->row(); ?>
        <script type="text/javascript">
            $(document).ready(function ($) {
                $(':input[type="number"]').keypress(function (evt) {
                    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
                    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
                        return false;
                    } else {
                        return true;
                    }
                });
                $("#logOutLink").on('click', function (e) {
                    e.preventDefault();
                    $.ajax({
                        method: "POST",
                        url: "<?php echo site_url('clients/getClientLogOutPermission/' . $user->id); ?>"
                    }).done(function (result) {
                        var res = JSON.parse(result);
                        if (res.modal === false) {
                            window.location.href = $("#logOutLink").attr('href');
                        } else {
                            $("#logoutModalBody").html(res.msg);
                            $("#GoToMissingDataLink").attr("href", res.url);
                            $("#GoToMissingDataLink").text(res.btnTxt);
                            $("#launchLogOutModal").trigger("click");
                        }
                    });
                });
                $("#logOutFoceFully").on('click', function () {
                    window.location.href = $("#logOutLink").attr('href');
                });
            });
        </script>
        <style>
            .card {
                border-radius: .5rem !important;
            }
            li.page-item > a.page-link {
                color: rgba(0, 0, 0, 0.5) !important;
            }
            li.page-item.active > a.page-link {
                background-color: grey !important;
                border-color: black !important;
                color: black !important;
            }
        </style>
    </head>
    <body style="background-color: #f9f9f9;">
        <header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar" style="background-color: #566AD4;">
            <div class="navbar-nav-scroll">
                <ul class="navbar-nav bd-navbar-nav flex-row">
                    <li>
                        <a class="nav-link" href="<?php echo site_url(''); ?>">
                            <img width="100" src="<?php echo base_url('assets/img/' . LOGO_NAME); ?>" />
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $this->uri->segment(1) == '' ? 'active' : ''; ?>" href="<?php echo site_url(''); ?>">Home</a>
                    </li>
                    <?php if ($user_group->name == 'admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $this->uri->segment(1) == 'auth' ? 'active' : ''; ?>" href="<?php echo site_url('/auth'); ?>">Users</a>
                        </li>
                    <?php } ?>
                    <?php if ($user_group->name == 'admin' || $user_group->name == 'sales') { ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $this->uri->segment(1) == 'clients' ? 'active' : ''; ?>" href="<?php echo site_url('/clients'); ?>">Clients</a>
                        </li>
                    <?php } ?>
                    <?php if ($user_group->name == 'client') { ?>
                        <?php $client_permission = $this->ion_auth->get_client_permissions(); ?>

                        <li class="nav-item">
                            <a class="nav-link <?php echo $this->uri->segment(1) == 'rating' ? 'active' : ''; ?>" href="<?php echo site_url('/clients'); ?>">Agreement</a>
                        </li>
                        <?php if($client_permission && $client_permission[0]['rating']){ ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $this->uri->segment(1) == 'rating' ? 'active' : ''; ?>" href="<?php echo site_url('/rating'); ?>">Rating</a>
                            </li>
                        <?php } ?>
                        <?php if($client_permission && $client_permission[0]['premium']){ ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $this->uri->segment(2) == 'premium' ? 'active' : ''; ?>" href="<?php echo site_url('/rating/premium'); ?>">Premium</a>
                            </li>
                        <?php } ?>

                        <?php if($client_permission && ($client_permission[0]['credit_card'] || $client_permission[0]['ach_bank'])){ ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle <?php echo $this->uri->segment(2) == 'credit_card_payment' || $this->uri->segment(2) == 'ach_payment' ? 'active' : ''; ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Payment Info</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php if( $client_permission[0]['credit_card']){ ?>
                                        <a class="dropdown-item" href="<?php echo site_url('/clients/credit_card_payment'); ?>">Credit Card Authorization</a>
                                    <?php } ?>
                                    <?php if($client_permission[0]['ach_bank']){ ?>
                                        <a class="dropdown-item" href="<?php echo site_url('/clients/ach_payment'); ?>">ACH Payment Authorization</a>
                                    <?php } ?>
                                </div>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" <?php echo $user_group->name == 'client' ? "id='logOutLink'" : ''; ?> href="<?php echo site_url('auth/logout'); ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </header>


        <!-- Button trigger modal -->
        <button style="visibility: hidden;" id="launchLogOutModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"></button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" id="logoutModalBody">Some data is missing. Are you sure to want to logout?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <a class="btn btn-success" id="GoToMissingDataLink"></a>
                        <button type="button" id="logOutFoceFully" class="btn btn-success">Yes Logout</button>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($this->uri->segment(2) == 'view_rating' || $this->uri->segment(2) == 'premium') { ?>
            <div class="container-fluid">
        <?php } else { ?>
            <div class="container">
        <?php } ?>
