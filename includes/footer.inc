<footer class="footer">
	<div class="row">
		<div class="small-12 columns copyright">
			<span>&copy; <?php echo date("Y") ?>, Only Insurance Leads. All Rights Reserved.</span>
		</div>
	</div>
</footer>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-16224922-1', 'auto');
  ga('send', 'pageview');

</script>

<script type="text/javascript">

// $('#testingId:visible').livequery(function() {
//     debugger;
// });

jQuery(document).ready(function(){

	// $('#testingId:visible').livequery(function() {
	//     debugger;
	// });
	setTimeout(function(){
		for (i = 1; i < 8; i++) {
			$('#card'+i+' .agentName').text($('#card'+i+' .details .name').text());
			$('#card'+i+' .agentAddress').text($('#card'+i+' .details .address').text());
			$('#card'+i+' .agentLocation').text($('#card'+i+' .details .location').text());
		}
	}, 5000);

      jQuery('.letterPreviewToggle').on('click',function(){

          if(jQuery( "#custom-pop-up-letter" ).hasClass( "selected" )){

              if(jQuery("#custom-pop-up-letter").data('type')=='letter'){

                jQuery('.fancybox-content').removeClass('custom-pop-up-postcard');

              }

          } else if(jQuery( "#custom-pop-up-postcard" ).hasClass( "selected" )){

              if(jQuery("#custom-pop-up-postcard").data('type')=='postcard'){

                  jQuery('.fancybox-content').addClass('custom-pop-up-postcard');
              }
          }

      })

			jQuery('#custom-pop-up-letter').on('click',function(){
			 $('#postCard_printProduction_image').hide();
			 $('#letter_printProduction_image').show();
			 jQuery('#bottom-custom-pop-up-postcard').removeClass('selected');
			 jQuery('#bottom-custom-pop-up-letter').addClass('selected');
		 });

		 jQuery('#custom-pop-up-postcard').on('click',function(){
			 checkAndChangeEnvelopTeaser();
			 $('#letter_printProduction_image').hide();
			 $('#postCard_printProduction_image').show();
			 jQuery('#bottom-custom-pop-up-postcard').addClass('selected');
			 jQuery('#bottom-custom-pop-up-letter').removeClass('selected');
		 });

		 $('#bottom-custom-pop-up-letter').on('click',function(){
			 $('#postCard_printProduction_image').hide();
			 $('#letter_printProduction_image').show();
			 $('#custom-pop-up-postcard').removeClass('selected');
			 $('#custom-pop-up-letter').addClass('selected');
		 });

		 $('#bottom-custom-pop-up-postcard').on('click',function(){
			 checkAndChangeEnvelopTeaser();
			 $('#letter_printProduction_image').hide();
			 $('#postCard_printProduction_image').show();
			 $('#custom-pop-up-letter').removeClass('selected');
			 $('#custom-pop-up-postcard').addClass('selected');
		 });

		 function checkAndChangeEnvelopTeaser(){
			 if($('#envelope').is(":checked")){
				 $('#envelope').click();
			 }
		 }


      jQuery('.fancybox-content').removeClass('custom-pop-up-postcard');

  })
</script>
