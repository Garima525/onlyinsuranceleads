<div class="card card<?php echo $idx ?>" id="card<?php echo $idx ?>">
	<div class="printedLetter">
			<div class="position_image">
				<img data-src="<?php echo getEnvelopeImage(); ?>" class="letter lazy">
			</div>
			<div class="receiverInfoContainer">
				<div class="agentName">name </div>
				<div class="agentAddress">address </div>
				<div class="agentLocation">location </div>
			</div>

			<div class="senderInfoContainer">
				<div class="senderName">The <?php echo $agent['shortname']; ?></div>
				<div class="senderNameTwo"><?php echo $agent['lastname']; ?></div>
				<div class="senderAddress"><?php echo $agent['address']; ?></div>
				<div class="senderLocation"><?php echo $agent['city']; ?>, <?php echo $agent['state']; ?> <?php echo $agent['zip']; ?></div>
				<div class="senderPhone"><?php echo $agent['phone']; ?></div>
				<div class="senderEmail"><?php echo $agent['email']; ?></div>
			</div>
	</div>
	<div class="cardContainer">
		<div class="capturing">
			<img class="main-img-homes" src="/images/header/home<?php echo $idx ?>.jpg">
			<img class="tablet-img blinkTabImage" src="/images/header/tablet.png">
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
					<div class="location">Anywhere, USA 12345</div>
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
