<div class="row form-container">
    <div class="small-12 medium-10 medium-centered large-8 columns">
        <h4 class="sectionSubTitle">Or send us an email</h4>
        <form action="utils/submit-contact-form.php" method="post" class="vanilla-form" novalidate="novalidate">
            <div class="column-100">
                <input type="text" name="name" placeholder="Your name" required="required">
                <input type="email" name="email" placeholder="Your e-mail" required="required">
                <input type="tel" name="tel" placeholder="Phone">
                <input type="hidden" id="salesperson_email" name="salesperson_email" placeholder="Salesperson Email">
                <input type="hidden" id="salesperson_full_name" name="salesperson_full_name" placeholder="Salesperson Name">
                <input type="hidden" id="salesperson_id" name="salesperson_id" placeholder="Salesperson ID">
            </div>
            <div class="column-100">
                <textarea name="message" placeholder="Type your message here..."></textarea>
            </div>
            <div id="html_element" style="margin-left:23%;margin-bottom:3%"></div>
            <!-- <div class="column-100 text-left">
                <input type="submit" value="Send" data-error="Fix errors" data-processing="Sending..." data-success="Thank you!">
            </div>
            <footer class="notification-box"></footer>
            </form> -->
            <div class="column-100 text-left" style="display:none">
               <input id='real_button' type="submit" value="Send" data-error="Fix errors" data-processing="Sending..." data-success="Thank you!">
           </div>
           <button type="button" id="testing_button" style="height:40px;width:94%;border-radius:7px;"> Send </button>
           <footer class="notification-box"></footer>
       </form>
       <p id="captcha_errror" style="text-align:center;background:#e9796b;border:solid 1px #e2513f;margin-top:-5%;color:white;height:40px;padding-top:7px;border-radius:4px;display:none">
           Please select <b>I'm not a robot</b> first and then press Send Button
       </p>
    </div>
</div>

<script>

$('#testing_button').click(function(event) {
    if(grecaptcha.getResponse()==''){
        $('#html_element iframe').css('border','solid 3px red');
        $('#captcha_errror').show();
        return;
    }else{
        $('#html_element iframe').css('border','none');
        $('#captcha_errror').hide();
        $('#test_button').hide();
        $('#real_button').show();
        $('#real_button').click();
    }
  });
var contactMeRequestInProgress = false;
$("#contact_us_form").submit(function (e) {
  setTimeout(function(){
    check = $("#contact_us_button").val();
    if(check!=='Sending...'){
      contactMeRequestInProgress = false;
      return;
    }
    if(contactMeRequestInProgress){
       e.preventDefault();
       return false;
    }
    contactMeRequestInProgress = true;
    setTimeout(function(){
      contactMeRequestInProgress = false;
    },3000);
  },50);
});



if(agent) {
    if(agent.salesperson_phone.length > 0) {
        $('#salesperson_email').val(agent.salesperson_email);
    }
    $('#salesperson_full_name').val(agent.nobreakname);
    $('#salesperson_id').val(agent.purl);

}
</script>
