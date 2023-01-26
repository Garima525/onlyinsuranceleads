<style>
.main-img-homes {
	position: relative;
}

.tablet-img {
	position: absolute;
	top: 0;
	right: 0;
	left: 0;
	bottom: 0;
	border-radius: 4px;
}
</style>

<div class="card card<?php echo $idx ?>" id="card<?php echo $idx ?>">
	<div class="printedLetter">
		<div class="position_image">
			<img data-src="<?php echo getEnvelopeImage(); ?>" class="letter lazy">
		</div>
		<!-- <div class="agentName" style="font-weight:bold;position:absolute;top:39%;font-size:.30rem;left:20%">name </div>
		<div class="agentAddress" style="font-weight:bold;position:absolute;top:42%;font-size:.30rem;left:20%">address </div>
		<div class="agentLocation" style="font-weight:bold;position:absolute;top:45%;font-size:.30rem;left:20%">location </div> -->
	</div>
	<div class="cardContainer">
		<div class="capturing">
			<img class="main-img-homes" src="/images/header/home<?php echo $idx ?>.jpg">
			<img class="tablet-img blinkTabImage flash" src="/images/header/tablet.png">
			<img style="opacity: 0" class="tablet-img tablet-img-white blinkTabImage flash" src="/images/header/tablet-white.png">
		</div>

		<div class="frontContainer">
			<div class="mask"></div>
			<div class="front">
				<div class="calculating">
					<div class="name">Calculating</div>
					<div class="address">Estimated Annual Premium</div>
				</div>
				<div class="details">
					<div class="name">Jamie Johnson</div>
					<div class="address">1234 Main St.</div>
					<div class="location"><?php echo $location; ?></div>
				</div>
				<div class="params">
					<div class="row">
						<div class="credit small-4 columns paramItem paramCredit">
							<span class="paramValue cardCredit">Top Tier</span>
							<span class="paramLabel">Credit</span>
						</div>
						<div class="year small-4 columns paramItem">
							<span class="paramValue cardBuilt">2004</span>
							<span class="paramLabel">Built</span>
						</div>
						<div class="size small-4 columns paramItem">
							<span class="paramValue cardSquareFeet">1,000</span>
							<span class="paramLabel">Sq. Ft.</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="back">
			<div class="wand"></div>
			<div class="hqQuote">
				<div class="coverageTitle">Recommended Insurance Coverage</div>
				<table class="rates">
					<tr>
						<td class="coverageLabel">Dwelling</td>
						<td class="coverageValue cardDwelling">$120,000</td>
					</tr>
					<tr>
						<td class="coverageLabel">Separate Structures</td>
						<td class="coverageValue cardSepStructure">$12,000</td>
					</tr>
					<tr>
						<td class="coverageLabel">Personal Property</td>
						<td class="coverageValue cardPersonalProperty">$72,000</td>
					</tr>
					<tr>
						<td class="coverageLabel">Loss of Use</td>
						<td class="coverageValue">Up to 12 months</td>
					</tr>
					<tr>
						<td class="coverageLabel">Liability</td>
						<td class="coverageValue">$300,000</td>
					</tr>
					<tr>
						<td class="coverageLabel">Guest Medical</td>
						<td class="coverageValue">$5,000</td>

					</tr>
				</table>
				<div class="premiumTitle">Estimated Annual Premium</div>
				<div class="premiumValue cardPremium">$655.00</div>
			</div>
		</div>
	</div>
</div>
