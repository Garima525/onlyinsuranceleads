<div class="graph">

</div>
<section class="section quotes">
	<div class="row">
		<div class="large-8 small-12 small-centered columns end">
			<div class="quoteContainer">
				<?php
					$contents = file_get_contents('partials/testimonials.json');
					$results = json_decode($contents);
					$quotes = $results->quotes;
					$hidden = "";
					foreach($quotes as $quote) {
						$quoteText = $quote->quote;
						$cite = $quote->cite;
						$company = $quote->company;
						$companyClass = $quote->companyClass;
						include('testimonial.inc');
						$hidden = "hidden";
					}
				?>
			</div>
		</div>
	</div>
</section>
