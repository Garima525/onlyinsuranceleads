<?php $this->load->view('layout/header.php'); ?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="mb-5 text-dark">&nbsp;</div>
        <div id="infoMessage"><?php echo $message; ?></div>
        <div class="text-right p-1">
            <button class="btn btn-large btn-success" id="exportCSV">Export</button>
        </div>
        <div class="card w-100">
            <div class="card-body p-0">
                <h2 class="card-title text-center">Client Rating</h2>
                <table id="ratingTable" class="table table-striped">
                    <?php if (isset($client)) { ?>
                        <tr>
                            <td class="text-center text-black-50">Name</td>
                            <td colspan="12"><?php echo $client->first_name . ' ' . $client->last_name; ?></td>
                        </tr>
                        <tr>
                            <td class="text-center text-black-50">Email</td>
                            <td colspan="12"><?php echo $client->email; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="13" class="text-center text-black-50">Foundation Matrix</td>
                    </tr>
                    <tr>
                        <td class="text-center text-black-50">Step 1</td>
                        <td colspan="12"></td>
                    </tr>
                    <tr>
                        <td class="text-center text-black-50">Zip Codes See Below</td>
                        <td colspan="12"></td>
                    </tr>
                    <tr>
                        <td class="text-center text-black-50">Deductible</td>
                        <td class="text-right"><?php echo isset($rating['rating']->deductible) ? $rating['rating']->deductible : ''; ?></td>
                        <td colspan="11"></td>
                    </tr>
                    <tr>
                        <?php if (isset($rating['rating']->dwelling_cost)) { ?>
                            <?php foreach ($rating['rating']->dwelling_cost as $key => $value) { ?>
                                <?php if ($key == 0) { ?>
                                    <td class="text-center text-black-50"><?php echo $value; ?></td>
                                <?php } else if ($key == 1) { ?>
                                    <td class="text-right">$ <?php echo $value; ?></td>
                                <?php } else { ?>
                                    <td class="pre-dollar formatted-amount"><?php echo $value; ?></td>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php if (isset($rating['rating']->separate_structure_per)) { ?>
                            <?php foreach ($rating['rating']->separate_structure_per as $key => $value) { ?>
                                <?php if ($key == 0) { ?>
                                    <td class="text-center text-black-50"><?php echo $value; ?> %</td>
                                <?php } else if ($key == 1) { ?>
                                    <td class="text-right"><?php echo $value; ?></td>
                                <?php } else { ?>
                                    <td class="pre-dollar formatted-amount"><?php echo $value; ?></td>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php if (isset($rating['rating']->personal_property_per)) { ?>
                            <?php foreach ($rating['rating']->personal_property_per as $key => $value) { ?>
                                <?php if ($key == 0) { ?>
                                    <td class="text-center text-black-50"><?php echo $value; ?> %</td>
                                <?php } else if ($key == 1) { ?>
                                    <td class="text-right"><?php echo $value; ?></td>
                                <?php } else { ?>
                                    <td class="pre-dollar formatted-amount"><?php echo $value; ?></td>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                    <tr>
                        <?php if (isset($rating['rating']->loss_of_use)) { ?>
                            <?php foreach ($rating['rating']->loss_of_use as $key => $value) { ?>
                                <?php if ($key == 0) { ?>
                                    <td class="text-center text-black-50"><?php echo $value; ?> %</td>
                                <?php } else if ($key == 1) { ?>
                                    <td class="text-right"><?php echo $value; ?></td>
                                <?php } else { ?>
                                    <td class="pre-dollar formatted-amount"><?php echo $value; ?></td>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td class="text-center text-black-50">Liability</td>
                        <td></td>
                        <td>$ 300,000</td>
                        <td>$ 300,000</td>
                        <td>$ 300,000</td>
                        <td>$ 300,000</td>
                        <td>$ 300,000</td>
                        <td>$ 300,000</td>
                        <td>$ 300,000</td>
                        <td>$ 300,000</td>
                        <td>$ 300,000</td>
                        <td>$ 300,000</td>
                        <td>$ 300,000</td>
                    </tr>
                    <tr>
                        <td class="text-center text-black-50">Home's Square Feet</td>
                        <td></td>
                        <?php foreach ($rating['hsf'] as $key => $value) { ?>
                            <td class="formatted-amount"><?php echo $value; ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td class="text-center text-black-50">STEP 2</td>
                        <td class="text-center text-black-50" colspan="12"> Enter Estimated Premiums Per Year Built Below</td>
                    </tr>
                    <?php if (isset($rating['premiums'])) { ?>
                        <?php foreach ($rating['premiums'] as $key => $value) { ?>
                            <tr>
                                <td class="text-center text-black-50">Built in <?php echo $key; ?></td>
                                <td></td>
                                <td class="pre-dollar formatted-amount"><?php echo $value->sq_ft_1000; ?></td>
                                <td class="pre-dollar formatted-amount"><?php echo $value->sq_ft_1500; ?></td>
                                <td class="pre-dollar formatted-amount"><?php echo $value->sq_ft_1750; ?></td>
                                <td class="pre-dollar formatted-amount"><?php echo $value->sq_ft_2000; ?></td>
                                <td class="pre-dollar formatted-amount"><?php echo $value->sq_ft_2250; ?></td>
                                <td class="pre-dollar formatted-amount"><?php echo $value->sq_ft_2500; ?></td>
                                <td class="pre-dollar formatted-amount"><?php echo $value->sq_ft_3500; ?></td>
                                <td class="pre-dollar formatted-amount"><?php echo $value->sq_ft_5500; ?></td>
                                <td class="pre-dollar formatted-amount"><?php echo $value->sq_ft_7500; ?></td>
                                <td class="pre-dollar formatted-amount"><?php echo $value->sq_ft_8500; ?></td>
                                <td class="pre-dollar formatted-amount"><?php echo $value->sq_ft_10000; ?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function download_csv(csv, filename) {
        var csvFile;
        var downloadLink;
        // CSV FILE
        csvFile = new Blob([csv], {type: "text/csv"});
        // Download link
        downloadLink = document.createElement("a");
        // File name
        downloadLink.download = filename;
        // We have to create a link to the file
        downloadLink.href = window.URL.createObjectURL(csvFile);
        // Make sure that the link is not displayed
        downloadLink.style.display = "none";
        // Add the link to your DOM
        document.body.appendChild(downloadLink);
        // Lanzamos
        downloadLink.click();
    }

    function export_table_to_csv(html, filename) {
        var csv = [];
        var rows = document.querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");
            for (var j = 0; j < cols.length; j++)
                row.push(cols[j].innerText);
            csv.push(row.join(","));
        }
        // Download CSV
        download_csv(csv.join("\n"), filename);
    }
    document.querySelector("button").addEventListener("click", function () {
//        var html = document.querySelector("table").outerHTML;
//        export_table_to_csv(html, "clientRating.csv");
//        window.open("<?php echo site_url('clients/export_rating/'.$this->uri->segment(3)); ?>");
    });

    let x = document.querySelectorAll(".formatted-amount");
    for (let i = 0, len = x.length; i < len; i++) {
        let num = Number(x[i].innerHTML)
                .toLocaleString('en');
        x[i].innerHTML = num;
        x[i].classList.add("currSign");
    }

    $(document).ready(function ($) {
        $('#exportCSV').on('click', function (e) {
            window.open("<?php echo site_url('clients/export_rating/'.$this->uri->segment(3)); ?>");
        });
    });
</script>
<?php $this->load->view('layout/footer.php'); ?>
