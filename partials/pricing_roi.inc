<?php
    function switcher($switchLabel, $switchId)
    {
        $tpl = '
			<div class="row" data-switch="'.$switchId.'">
				<div class="columns small-8">
					<span class="roiCategory">'.$switchLabel.'</span>
				</div>
				<div class="columns small-4">
					<div class="material-switch">
						<input id="'.$switchId.'" name="'.$switchLabel.'" type="checkbox" class="'.$switchId.'" data-category="'.$switchId.'"/>
						<label for="'.$switchId.'" class="label-default"></label>
					</div>
				</div>
			</div>';
        echo $tpl;
    }
    require_once($_SERVER['DOCUMENT_ROOT']. '/mailings/prospects.php');
    if (!isset($agent['city'])) {
        $agent['city'] = $localData->city;
        $agent['state'] = $localData->region_code;
        $agent['zip'] = $localData->zip;
    }
?>

<div class="row pricingOptions">
	<div class="small-12 medium-6 columns templateContainer">
		<div class="postcard-size">Postcard size is 6" X 9"</div>
        <div style="text-align:center;margin-bottom:3%;display:none;" class="letter-one-disc">This template requires a Wall-to-wall envelope</div>
		<div class="envelope" id="envelopePreview">
			<img src="/mailings/images/teaser.svg" style="visibility:visible" class="teaserImg">
			<div class="addressWindow">
				<div style="display:none;"><div class="name"><?php echo $prospects[7]['first_name'].' '.$prospects[7]['last_name'] ?></div>
				<div class="address"><?php echo $prospects[7]['address'] ?></div></div>

				<div class="name">Allison Lehman</div>
				<div class="address">2848 Felosa Dr.</div>
				<div class="city"><?php echo $agent['city'] ?>, <?php echo $agent['state'] ?> <?php echo $agent['zip'] ?></div>
			</div>
		</div>
        <!-- <div  style="display:none;position:absolute;bottom:-6%;z-index:5;left:1%;" class="envelope" id="envelopePreviewNew"> -->
        <div  style="display:none;position:absolute;top:4%;z-index:5;left:1%;" class="envelope" id="envelopePreviewNew">
			<img src="/mailings/images/envelope-over-2.png" class="teaserImg">
			<div style=" display:none; position:absolute;bottom:36%;left:57%; font-size: .5rem;" class="addressWindow">
				<div style="display:none;"><div class="name"><?php echo $prospects[7]['first_name'].' '.$prospects[7]['last_name'] ?></div>
				<div class="address"><?php echo $prospects[7]['address'] ?></div></div>

				<div class="name">Allison Lehman</div>
				<div class="address">2848 Felosa Dr.</div>
				<div class="city"><?php echo $agent['city'] ?>, <?php echo $agent['state'] ?> <?php echo $agent['zip'] ?></div>
			</div>
		</div>
		<div class="previewContainer embed-responsive embed-responsive-ratio">
			<iframe src="" id="letterPreview" class="letterFrame" seamless="seamless" scrolling="no" frameborder="0"></iframe>
		</div>
	</div>

	<div class="small-12 medium-5 end columns roiCalculator">
		<div class="row">
			<div class="small-6 columns">
				<h4 class="sectionSubTitle"><span id="sliderHeading">Letters</span>: <input type="text" class="prospects" value="3500"></h4>
			</div>
			<!-- <div class="small-4 columns totalContainer">
				<span id="total"></span> <small>each</small>
			</div> -->
            <div class="small-6 columns totalContainer">
                <h4 class="sectionSubTitle" style="text-align:right"><span id="testid">Custom Pricing</span>: <input id="customprice" type="text" value="0.1" class="prospectprice" ></h4>
			</div>
		</div>
		<div class="row">
			<div class="small-8 columns">

			</div>
			<div class="small-4 columns totalContainer">

			</div>
		</div>
		<input type="range" min="1250" max="4999" value="3500" id="slider" class="rangeslider">
		<!-- List group -->
		<h4 class="areaTitle">Payment Options</h4>
		<div class="paymentOptions">
			<img src="images/payment/ach.png" class="paymentType selected" data-payment="check">
			<img src="images/payment/visa.png" class="paymentType" data-payment="visa">
			<img src="images/payment/mastercard.png" class="paymentType" data-payment="mastercard">
			<img src="images/payment/amex.png" class="paymentType" data-payment="amex">
			<img src="images/payment/discover.png" class="paymentType" data-payment="discover">
		</div>
		<div class="row printOptions">
			<div class="small-12 medium-6 columns filters">
				<h4 class="areaTitle">Target Audience Filters</h4>
				<?php
                    switcher('High Credit', 'highCredit');
                    switcher('Year Built Range', 'yearBuilt');
                    switcher('Sq. Ft. Range', 'sqFtRange');
                ?>
			</div>
			<div class="small-12 medium-6 columns" style="margin:0;padding:0">
				<h4 class="areaTitle">Print Options</h4>
				<?php
                    switcher('Color Printing', 'ink');
                    switcher('Wall-to-wall Envelope', 'envelope');
                ?>
			</div>
		</div>

		<h4 class="sectionSubTitle">ROI Calculator</h4>

		<div class="row roiInfo">
			<div class="small-8 columns">
				<span class="roiCategory">Reasonable close rate for direct mail</span>
			</div>
			<div class="small-4 columns">
				<select class="roiPrice roiInput" id="roiCloseRate">
					<option value="0.0025">0.25%</option>
					<option value="0.005" selected="selected">0.5%</option>
					<option value="0.01">1%</option>
					<option value="0.015">1.5%</option>
					<option value="0.02">2%</option>
					<option value="0.025">2.5%</option>
					<option value="0.03">3%</option>
					<option value="0.035">3.5%</option>
					<option value="0.04">4%</option>
				</select>
			</div>
		</div>
		<div class="row roiInfo">
			<div class="small-8 columns">
				<span class="roiCategory">New business households</span>
			</div>
			<div class="small-4 columns">
				<span class="roiPrice" id="households">6</span>
			</div>
		</div>
		<div class="row roiInfo">
			<div class="small-8 columns">
					<span class="roiCategory">Avg. annual commission per household</span>
					<small>(Households usually insure 1 home and 2 cars)</small>
			</div>
			<div class="small-4 columns">
					<input class="roiPrice roiInput" id="commission" value="$250.00">
			</div>
		</div>

		<div class="row roiInfo">
			<div class="small-8 columns">
				<span class="roiCategory">Average number of years you retain client</span>
			</div>
			<div class="small-4 columns">
				<select class="roiPrice roiInput" id="clientYears">
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8" selected>8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
			</div>
		</div>
		<div class="row roiInfo">
			<div class="small-8 columns">
				<span class="roiCategory">Monthly Investment</span>
			</div>
			<div class="small-4 columns">
				<span class="roiPrice" id="investment">$44.37</span>
			</div>
		</div>
		<div class="row roiInfo roiTotal">
			<div class="small-8 columns">
				<h5 class="sectionSubTitle">Total ROI</h5>
			</div>
			<div class="small-4 columns">
				<span class="roiPrice"><span class="sectionSubTitle" id="roi">$15,625</span> <br><span class="small">in commissions</span>
			</div>
		</div>
	</div>
</div>
