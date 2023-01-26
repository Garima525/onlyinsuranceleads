<header class="pageHeader" id="ourService">
<h1 class="pageTitle">Mail <em>targeted</em>, customized home insurance quotes<br> on a mass mailing scale</h1>
<div class="videoContainer">
	<video autoplay poster="images/header/neighborhood.jpg" id="bg-video" muted loop>
    	<source src="images/header/headerVideo.mp4" type="video/mp4">
	</video>
</div>
	<div class="container-fluid hq-container">
		<div class="machineContainer">
			<div class="hqParamContainer">
				<div class="agencyInfo">
					<div class="agencyName">
						YOUR AGENCY
					</div>
					<div class="agencyName2">
						<?php
							if($agent['shortname']) {
								echo 'Insurance Agency';
							}
						?>
					</div>
					<div class="agencyMarketingAudience">TARGET MARKETING AUDIENCE</div>
					<div class="agencyZipCodes">ZIP CODES: <span class="agencyZip"><?php echo $zipCode; ?></span></div>
				</div>
				<div class="agencyParams">
					<table>
						<tr class="paramName">
							<td>Credit</td>
							<td>Year Built</td>
							<td>Square Feet</td>
						</tr>
						<tr class="paramValue">
							<td>TOP TIER</td>
							<td>1982-<?php echo date('Y'); ?></td>
							<td>1250-8500</td>
						</tr>
					</table>
				</div>
				<div class="hqStats">
					<span class="renewalMonth">
					<?php
						echo date('F Y', strtotime("first day of +1 months"));
					?>
					</span>
				</div>
			</div>
<style>
  .container-fluid.hq-container {
    width:1420px;
    margin-left: auto;
    margin-right: auto;
  }

	.capturing {
	  position: absolute;
	  top: 0;
		left: 0;
		width: 242px;
		height: 206px;
		opacity: 1;
		z-index: 1;
		overflow: hidden;
	}

	.capturing img {
		object-fit: cover;
		border-radius: 4px;
	}
	
	.main-img-homes {
  	height: 100%;
  	width: 100%;
	}

	.home .machineContainer .machineTrack .card .back {
		width: 241px;
	}

	.home .machineContainer .machineTrack .card .printedLetter {
		width: 241px;
	}

	.home .machineContainer .machineTrack .card .cardContainer {
		width: 241px;
	}

	.home .machineContainer .machineTrack .card .frontContainer {
		width: 241px;
	}

	.home .machineContainer .hqParamContainer {
		width: 295px;
	}

	.home .machineContainer .hqParamContainer .agencyParams {
		width: 275px;
	}

	.home .machineContainer .hqParamContainer .hqStats {
	  width: 275px;
	}

	.home .machineContainer .hqParamContainer .agencyInfo {
	  left: 40px !important;
	}

@-webkit-keyframes blinked {
	0% {
	  opacity: 0;
	  height: 226px;
    width: 270px;
    left: 0;
	}
	48% {
	  opacity: 1;
	  height: 226px;
    width: 270px;
    left: 0;
	}
	50% {
		opacity: 1;
		height: 206px;
    width: 246px;
    left: 0;	
	}
	100% {
		opacity: 1;
		height: 206px;
    width: 246px;
    left: 0;
	}
}
@-moz-keyframes blinked {
	0% {
	  opacity: 0;
	}
	44%{
		opacity: 0
	}
	45% {
			opacity: 1;
	}
	55% {
			opacity: 1;
	}
	56%{
		opacity: 0
	}
	100% {
			opacity: 0;
	}
}
@-o-keyframes blinked {
	0% {
		opacity: 0;
		height: 226px;
    width: 270px;
    left: -5px;
  }
	44% {
		opacity: 0
		height: 226px;
    width: 270px;
    left: -5px;
  }
	45% {
		opacity: 1;
		height: 206px;
    width: 246px;
    left: 0;
	}
	55% {
		opacity: 1;
		height: 206px;
    width: 246px;
    left: 0;
	}
	56% {
	  opacity: 0;
	  height: 206px;
    width: 246px;
    left: 0;
  }
	100% {
	  opacity: 0;
	  height: 206px;
    width: 246px;
    left: 0;
	}
}


.blinkTabImage {
    -webkit-animation: blinked 5s;
    -webkit-animation-iteration-count: infinite;
    -moz-animation: blinked 5s;
    -moz-animation-iteration-count: infinite;
    -o-animation: blinked 5s;
    -o-animation-iteration-count: infinite;
}

.flash {
    position:fixed;
    /* top:0;
    left:0;
    width:100%;
    height:100%; */
    /* background-color:#fff; */
}

@-webkit-keyframes blinkedtwo {
	0% {
	  opacity: 0;
	  height: 226px;
    width: 270px;
    left: 0;
	}
	48% {
	  opacity: 0;
	  height: 226px;
    width: 270px;
    left: 0;
	}
	50% {
		opacity: 0;
		height: 206px;
    width: 246px;
    left: 0;	
	}
	60% {
		opacity: 0;
		height: 206px;
    width: 246px;
    left: 0;	
	}
	61% {
		opacity: 1;
		height: 206px;
    width: 246px;
    left: 0;	
	}
	62% {
		opacity: 0;
		height: 206px;
    width: 246px;
    left: 0;	
	}
	100% {
		opacity: 0;
		height: 206px;
    width: 246px;
    left: 0;
	}
}
@-moz-keyframes blinkedtwo {
	0% {
	  opacity: 0;
	}
	44%{
		opacity: 0
	}
	45% {
			opacity: 1;
	}
	55% {
			opacity: 1;
	}
	56%{
		opacity: 0
	}
	100% {
			opacity: 0;
	}
}
@-o-keyframes blinkedtwo {
	0% {
		opacity: 0;
		height: 226px;
    width: 270px;
    left: -5px;
  }
	44% {
		opacity: 0
		height: 226px;
    width: 270px;
    left: -5px;
  }
	45% {
		opacity: 0;
		height: 206px;
    width: 246px;
    left: 0;
	}
	55% {
		opacity: 0;
		height: 206px;
    width: 246px;
    left: 0;
	}
	56% {
	  opacity: 0;
	  height: 206px;
    width: 246px;
    left: 0;
  }
	100% {
	  opacity: 0;
	  height: 206px;
    width: 246px;
    left: 0;
	}
}

img.tablet-img-white.blinkTabImage {
    -webkit-animation: blinkedtwo 5s;
    -webkit-animation-iteration-count: infinite;
    -moz-animation: blinkedtwo 5s;
    -moz-animation-iteration-count: infinite;
    -o-animation: blinkedtwo 5s;
    -o-animation-iteration-count: infinite;
}

</style>

			<div class="hqMachineRight"></div>
			<div class="machineTrack">
				<?php
					for($i=1; $i <= 7; $i++) {
						$idx = $i;
						include('homeCard.inc');
					}
				?>
			</div>
		</div>
	</div>
</header>
