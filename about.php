<!DOCTYPE html>
<html>
	<head>
		<title>Only Insurance Leads - About Us</title>
		<?php include('includes/meta.inc'); ?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/themes/odometer-theme-car.min.css" integrity="sha256-HF9FH1xckU8DcX+7gWocw8a9jLGAzVVLjs9y6GxUR4M=" crossorigin="anonymous" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js" integrity="sha256-65R1G5irU1VT+k8L4coqgd3saSvO/Wufson/w+v2Idw=" crossorigin="anonymous"></script>
	</head>
	<body class="about">
		<?php
			include('includes/nav.inc');
		?>
		<main>
			<section class="pageHeader">
				<div class="row">
					<div class="small-10 small-centered columns">
						<h1 class="pageTitle">We believe insurance agents are still relevant</h1>
						<h2 class="pageSubTitle">We help insurance agents grow fast with customized direct mail marketing.</h2>

					</div>
				</div>
			</section>
			<section class="agents">
				<div class="row">
					<div class="medium-5 medium-offset-1 columns sectionDescriptions">
						<h1 class="sectionTitle">We are former insurance agents</h1>
						<p>We've walked many miles in your shoes and seen it all. As licensed insurance agents located in Phoenix, Arizona, we originally designed our program to overcome the DO NOT CALL and Caller ID legislation, which made it difficult for insurance agents to market via the telephone.</p>

						<p>But because the success of our strategic program was so significant, we were able to leapfrog to the number 2 producing property/casualty agency from a field of 15,000 agents at one of the big Top 3 insurance carriers. We also started to get requests about the secrets of our soaring success from other insurance agents all over the country. As a result of this huge demand, we started Only Insurance Leads. Now, we've been in business for more than 10 years and have mailed more than 20 million customized quotes for insurance agencies nationwide. And the demand continues because our program works.</p>
					</div>
					<div class="medium-5 columns end">
						<img src="images/aboutFormerAgents.png" class="formerAgents">
						<div class="mailingsContainer">
							<h5 class="over">Over</h5>
							<span id="mailings" class="odometer">
								<?php
									$startAmt = 20000000;
									$interval = ((date('Y') - 2017) * 12) + (date('m') - 01);
									$mailings = $interval * 320312 + $startAmt;
									echo $startAmt;
									?>
							</span>
							<div class="mailed">customized quotes mailed</div>
						</div>
					</div>
				</div>
			</section>
			<section class="section leadership">
				<div class="row">
					<div class="small-10 small-centered columns">
						<h1 class="sectionTitle">Leadership</h1>
						<h2 class="sectionSubTitle">We are a group of trendsetters, marketing experts, tech geeks and insurance agent gurus.<br>
						We have one common goal: To help insurance agencies grow <em class="fast">fast</em>.</h2>
					</div>
				</div>
			</section>
			<section class="section team">
				<div class="row">
					<div class="small-10 small-centered columns">
						<h1 class="sectionTitle">Executive Team</h1>
					</div>
				</div>
				<div class="row">
					<div class="medium-5 medium-offset-1 columns profile">
						<div class="profileImage david"></div>
						<h1 class="sectionSubTitle">David Cohen</h1>
						<h2 class="sectionSubTitle bioTitle">Co-Founder/CFO</h2>

						<div class="bio">
							<p>An expert in insurance sales and marketing and licensed insurance agent with more than 22 years in the industry, David Cohen is the CFO of Only Insurance Leads, the largest insurance direct mail marketing company in the United States.</p>
							<p>Prior to becoming CFO of Only Insurance Leads, David spent 22 years at Farmers Insurance as an insurance agent. During his time with Farmers, David built a scratch agency from 0-6,000 policies in less than 8 years all through organic growth and qualified for every single achievement club the company offered. In 2005, David was the number 2 producing property/casualty agent from a field of 15,000 other agents, having issued more than 1,800 policies in that year alone.</p>
							<p>David is married with 2 children and resides in Chandler, Arizona. In his spare time, David enjoys walking his beloved lab named Dooby, biking, cooking, playing competitive backgammon and volunteering for a local animal rescue.</p>
							<p><a href="http://www.linkedin.com/pub/david-s-cohen-lutcf/16/601/172"><img src="images/linkedinLogo.png" class='connectLogo'> Connect with David</a></p>
						</div>
					</div>
					<div class="medium-5 end columns profile">
						<div class="profileImage ben"></div>
						<h1 class="sectionSubTitle">Ben Cohen</h1>
						<h2 class="sectionSubTitle bioTitle">Co-Founder/CIO</h2>
						<div class="bio">
							<p>An expert in reverse engineering and tinkering, and also a licensed insurance agent with more than 13 years in the industry, Ben Cohen is the CIO of Only Insurance Leads.</p>
							<p>Prior to becoming the CIO of Only Insurance Leads, Ben spent 10 years at his brother's insurance agency as a licensed sales producer. During the time, Ben developed the first generation software program that had the ability to generate insurance quotes on a mass scale with the click of a button. Ben's program was responsible for the vast majority of growth at David’s agency. After receiving hundreds upon hundreds of calls to learn more about Ben's program, it was then Only Insurance Leads was born.</p>
							<p>Ben is married with 2 children and resides in Phoenix, Arizona. In his spare time, Ben enjoys biking, exercising, cooking, being a stay at home dad and more tinkering.</p>
							<p><a href="http://www.linkedin.com/pub/benjamin-l-cohen/63/145/770"><img src="images/linkedinLogo.png" class='connectLogo'> Connect with Ben</a></p>

						</div>
					</div>
				</div>
			</section>
			<?php
				include('partials/getStarted.inc');
				include('includes/footer.inc');
			?>
		</main>
		<script>
			
			var el = document.getElementById('mailings');
			od = new Odometer({
				el: el,
				format: '',
				theme: 'car',
				value: <?php echo $startAmt; ?>,
				duration: 10000
				
			});
			
			od.update(<?php echo $mailings; ?>)
			
		</script>
	</body>
</html>