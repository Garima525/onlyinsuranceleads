<?php $this->load->view('layout/header.php'); ?>
    <div style="padding:1%">
        <button type="button" onclick="location.href='<?php echo site_url("/clients"); ?>';" class="btn btn-outline-<?=$agreement ?> btn-lg btn-block">Agreement</button>
    </div>

    <?php if($permissions['rating']){ ?>
        <div style="padding:1%">
            <button type="button" onclick="location.href='<?php echo site_url("/rating"); ?>';" class="btn btn-outline-<?=$rating ?> btn-lg btn-block">Rating</button>
        </div>
    <?php } ?>

    <?php if($permissions['premium']){ ?>
        <div style="padding:1%">
            <button type="button" onclick="location.href='<?php echo site_url("/rating/premium"); ?>';" class="btn btn-outline-<?=$premium ?> btn-lg btn-block">Premium</button>
        </div>
    <?php } ?>

    <?php if($permissions['credit_card']){ ?>
        <div style="padding:1%">
            <button type="button" onclick="location.href='<?php echo site_url("/clients/credit_card_payment"); ?>';" class="btn btn-outline-<?=$credit_card ?> btn-lg btn-block">Credit Card Authorization</button>
        </div>
    <?php } ?>

    <?php if($permissions['ach_bank']){ ?>
        <div style="padding:1%">
            <button type="button" onclick="location.href='<?php echo site_url("/clients/ach_payment"); ?>';" class="btn btn-outline-<?=$ach_payment ?> btn-lg btn-block">ACH Payment Authorization</button>
        </div>
    <?php } ?>

<?php $this->load->view('layout/footer.php'); ?>
