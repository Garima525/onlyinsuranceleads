<?php
	function switcherPostcard($switchLabel, $switchId) {
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
	if(!isset($agent['city'])) {
		$agent['city'] = "Anywhere";
		$agent['state'] = "USA";
		$agent['zip'] = "12345";
	}
?>

<div class="row pricingOptions">
	<div class="small-12 medium-6 columns">
		<!--<div class="envelope" id="envelopePreview">
			<img src="/mailings/images/teaser.svg" class="teaserImg">
			<div class="addressWindow">
				<div class="name"><?php echo $prospects[7]['first_name'].' '.$prospects[7]['last_name'] ?></div>
				<div class="address"><?php echo $prospects[7]['address'] ?></div>
				<div class="city"><?php echo $location; ?></div>
			</div>
		</div>-->
		<div class="embed-responsive embed-responsive-ratio">
			<iframe src="/mailings/mailing.php?id=6&type=postcard&location=Amsterdam, Noord-Holland, NL, 1105" id="letterPreview2" class="letterFrame" seamless="seamless" scrolling="no" frameborder="0"></iframe>
		</div>
	</div>

	<div class="small-12 medium-5 end columns roiCalculator">
		<div class="row">
			<div class="small-8 columns">
				<h4 class="sectionSubTitle">Letters: <input type="text" class="prospectsCard" value="1,250"></h4>
			</div>
			<div class="small-4 columns totalContainer">
				<span id="total"></span> <small>each</small>
			</div>
		</div>
		<div class="row">
			<div class="small-8 columns">

			</div>
			<div class="small-4 columns totalContainer">

			</div>
		</div>
		<input type="range" min="1250" max="4999" value="1250" id="slidercard" class="rangeslider">
		<!-- List group -->
		<h4 class="areaTitle">Payment Options</h4>
		<div class="paymentOptions">
			<img src="images/payment/check.png" class="paymentType selected" data-payment="check">
			<img src="images/payment/visa.png" class="paymentType" data-payment="visa">
			<img src="images/payment/mastercard.png" class="paymentType" data-payment="mastercard">
			<img src="images/payment/amex.png" class="paymentType" data-payment="amex">
			<img src="images/payment/discover.png" class="paymentType" data-payment="discover">
		</div>
		<div class="row printOptions">
			<div class="small-12 medium-6 columns filters">
				<h4 class="areaTitle">Target Audience Filters</h4>
				<?php
					switcherPostcard('High Credit', 'highCredit');
					switcherPostcard('Year Built Range', 'yearBuilt');
					switcherPostcard('Sq. Ft. Range', 'sqFtRange');
				?>
			</div>
			<div class="small-12 medium-6 columns">
				<h4 class="areaTitle">Print Options</h4>
				<?php
					switcherPostcard('Color Printing', 'ink');
					switcherPostcard('Envelope Teaser', 'envelope');
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
