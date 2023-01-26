<section class="section gallery" id="templates">
	<div class="row">
		<div class="medium-10 medium-centered small-12 columns">
			<h2 class="sectionTitle">Choosing and customizing your template</h2>
			<p class="sectionDescription">Each prospect will receive their custom quote on one of our proven templates, customized to include your agency’s contact information.</p>
			<div class="button-group">
				<div id="custom-pop-up-letter" class=" btn btn-switcher selected" data-type="letter">Letters</div>
				<div id="custom-pop-up-postcard" class=" btn btn-switcher" data-type="postcard">Postcards</div>
			</div>
		</div>
	</div>
	<div class="row letterGallery">
		<div class="postcard-size">Postcard size is 6" X 9"</div>
		<div style="display:none;text-align:center;margin-top:1%;margin-bottom:-3%;" class="letter-one-disc">This template requires a Wall-to-wall envelope</div>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php include('partials/galleryItems.inc'); ?>
			</div>
			<div class="swiper-label">Template # <span class="templateNumber">2</span></div>
			<div class="swiper-pagination"></div>
			<div class="swiper-button-next"></div>
    		<div class="swiper-button-prev"></div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function(){
		$("#custom-pop-up-letter").click(function(){
			$(".postcard-size").hide();
		});
		$("#custom-pop-up-postcard").click(function(){
			$(".postcard-size").show();
		});
		$("#bottom-custom-pop-up-letter").click(function(){
			$(".postcard-size").hide();
		});
		$("#bottom-custom-pop-up-postcard").click(function(){
			$(".postcard-size").show();
		});
	});

</script>

<style>
	.postcard-size {display:none; text-align: center; margin-top: 40px;}
	.pricingOptions .postcard-size {margin-top:0; margin-bottom: 40px; max-width: 425px;}
</style>
