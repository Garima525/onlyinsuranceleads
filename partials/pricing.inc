<section class="section alt pricing" id="pricing">
	<div class="row">
		<h1 class="sectionTitle">Pricing</h1>
		<h4 class="sectionSubTitle">Reach more prospects. Spend less money.</h4>
		<div class="button-group">
				<div id="bottom-custom-pop-up-letter" class="btn btn-switcher selected" data-type="letter">Letters</div>
				<div id="bottom-custom-pop-up-postcard" class="btn btn-switcher" data-type="postcard">Postcards</div>
			</div>
		<div class="small-10 small-centered columns">
			<div class="row packageOptions">
				<div class="packageItem">
					<div class="package" id="connect" data-category="packages">
						<h4 class="packageName">Connect</h4>
						<span class="packageLetters">1000 - 1,999 <span class="perLetter perUnitHeading">letters</span></span>
						<!-- <span class="packagePrice">See below for starting price
						</span> -->
						<span class="packagePrice">Call for custom pricing
						</span>

							<!-- <span class="perLetter perUnitSave">per letter</span> -->
					</div>
				</div>
				<div class="packageItem">
					<div class="package " id="grow" data-category="packages">
						<h4 class="packageName">Grow</h4>
						<span class="packageLetters">2,000 - 3,499 <span class="perLetter perUnitHeading">letters</span></span>
						<span class="packagePrice">Call for custom pricing
						</span>
						<!-- <span class="packagePrice">Save $0.02 <span class="perLetter perUnitSave">per letter</span></span> -->
					</div>
				</div>
				<div class="packageItem">
					<div class="package selected" id="expand" data-category="packages">
						<h4 class="packageName">Expand</h4>
						<span class="packageLetters">3,500 - 5,999 <span class="perLetter perUnitHeading">letters</span></span>
						<!-- <span class="packagePrice">Save $0.06 <span class="perLetter perUnitSave">per letter</span></span> -->
						<span class="packagePrice">Call for custom pricing
						</span>
					</div>
				</div>
				<div class="packageItem">
					<div class="package" id="expandPlus" data-category="packages">
						<h4 class="packageName">Expand+</h4>
						<span class="packageLetters">6,000 - 9,999 <span class="perLetter perUnitHeading">letters</span></span>
						<!-- <span class="packagePrice">Save $0.03 <span class="perLetter perUnitSave">per letter</span></span> -->
						<span class="packagePrice">Call for custom pricing
						</span>
					</div>
				</div>
				<div class="packageItem">
					<div class="package" id="enterprise" data-category="packages">
						<h4 class="packageName">Enterprise</h4>
						<span class="packageLetters">10,000 - 24,999 <span class="perLetter perUnitHeading">letters</span></span>
						<!-- <span class="packagePrice">Save $0.02 <span class="perLetter perUnitSave">per letter</span></span> -->
						<span class="packagePrice">Call for custom pricing
						</span>
					</div>
				</div>
			</div>
			<?php require("pricing_roi.inc"); ?>

		</div>
	</div>
</section>
<script type="text/javascript">
$(function(){

	let url = $("#letterPreview").attr("src");
	let newUrl = updateQueryStringParameter( url, 'location', "<?php echo $location;?>" );
	$("#letterPreview").attr("src", newUrl);

	$(".btn-switcher").on("click", function(){
		if($(this).data("type") == 'postcard'){
			selected_template_type = 'postcard';
			$(".perUnitHeading").html("postcards");
            $(".perUnitSave").html("per postcard");
            $("#sliderHeading").html("Postcards");
			set_view_for_template();
            setTimeout(function() {
            	let newUrl = updateQueryStringParameter( url, 'location', "<?php echo $location;?>" );
            	    newUrl = updateQueryStringParameter( url, 'type', "postcard" );
           $("#letterPreview").attr("src", newUrl);
		}, 500);
		}
		if($(this).data("type") == 'letter'){
			selected_template_type = 'letter';
			$(".perUnitHeading").html("letters");
		    $(".perUnitSave").html("per letter");
		    $("#sliderHeading").html("Letters");
			set_view_for_template();
		    setTimeout(function() {
		   let newUrl = updateQueryStringParameter( url, 'location', "<?php echo $location;?>" );
		       newUrl = updateQueryStringParameter( url, 'type', "letter" );
           // $("#letterPreview").attr("src", '/mailings/mailing.php?id=7&type=letter&test=2&location=<?php echo $location;?>');
           $("#letterPreview").attr("src", newUrl);
		}, 500);
		}


	});

});

function updateQueryStringParameter(uri, key, value) {
	console.log(uri);
  var re = new RegExp("([?&])" + key + "=.*?(&|#|$)", "i");
  if( value === undefined ) {
  	if (uri.match(re)) {
		return uri.replace(re, '$1$2');
	} else {
		return uri;
	}
  } else {
  	if (uri.match(re)) {
  		return uri.replace(re, '$1' + key + "=" + value + '$2');
	} else {
    var hash =  '';
    if( uri.indexOf('#') !== -1 ){
        hash = uri.replace(/.*#/, '#');
        uri = uri.replace(/#.*/, '');
    }
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    return uri + separator + key + "=" + value + hash;
  }
  }
}


</script>
