<?php require_once('utils/agents.inc'); ?>

<section class="section cta" id="contact">
	<div class="row">
		<div class="medium-8 medium-centered columns">
			<h3 class="sectionTitle">Call us today to get started!</h3>
			<h4 class="sectionSubTitle phoneNumber"><a href="tel:8882846982">888-284-6982</a></h4>

			<?php include('includes/contact.inc'); ?>
			<div class="address">
				<p class="street">2375 East Camelback Road. Suite 600. Phoenix, AZ 85016</p>
				<p class="hours">7am-10pm 365 days a year.</p>
				<p class="hoursCaption">Send us an email anytime.  We'll respond fast.</p>
			</div>
		</div>
	</div>
</section>


<script>
	var anch = $(".phoneNumber").children();
	if(agent) {
		var a = agent;
		if(agent.salesperson_phone.length > 0) {
			// console.log(agent);
			var phone = 'tel:' + agent.salesperson_phone;
			anch.attr('href',phone);
			anch.text(agent.salesperson_phone);
		}
	}

	// $(this).attr("href");
</script>
