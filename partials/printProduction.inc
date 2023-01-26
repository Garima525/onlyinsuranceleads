<?php
  $agent_location = $agent['city'].' '.$agent['state'].", ".' '.$agent['zip'];
  $first = rand(0, 10);
  $second = rand(0, 10);
  $address = rand(0, 10);
?>

<style>
  <?php
    $agent_browser = $_SERVER["HTTP_USER_AGENT"];

    if (preg_match('/MSIE (\d+\.\d+);/', $agent_browser)) {
      echo "";
    } elseif (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent_browser)) {
      echo "";
    } elseif (preg_match('/Edge\/\d+/', $agent_browser)) {
      echo "";
    } elseif (preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent_browser)) {
      echo "";
    } elseif (preg_match('/OPR[\/\s](\d+\.\d+)/', $agent_browser)) {
      echo "";
    } elseif (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent_browser)) {
      echo ".postcardTemplate.postcardLayoutSplitRight .left .callNow.saf {top: 58vw}";
    }
    ?>


.second_address{
	color: black !important;
	top:77%!important;
	left:67%!important;
}
#postCard_printProduction_image .position_title_text{
	color:white;top:56%;left:31%;
}
#postCard_printProduction_image .extra_info {
    color:#000;
    top:62%;
    left:69%;
}
#postCard_printProduction_image .extra_info p.p3 {
    font-family: 'Open Sans', sans-serif !important;
    font-size: 1em;
    line-height: .5rem;
    font-weight: 900;
    width: 100%;
    margin-bottom: 0;
    margin-top: 0;
}
#postCard_printProduction_image .extra_info p.p4 {
    font-family: 'Open Sans', sans-serif !important;
    font-size: 1.1em;
    font-weight: 900;
    width: 100%;
    margin-bottom: 0;
}
#postCard_printProduction_image .position_phone_number img {
    width: 31%;
    height: auto;
    display: block;
    position: relative;
    left: 2px;
}
#postCard_printProduction_image .position_phone_number {
    color:#000;top:68%;left:52%;
}
#postCard_printProduction_image .position_phone_number p.p5 {
  font-family: 'Open Sans', sans-serif !important;
  font-size: 1.8em;
  font-weight: 900;
  margin-bottom: 0;
}
#postCard_printProduction_image .position_address_text{
	color:white;
}
@media screen and (min-width: 850px) and (max-width:1030px) {
  .position_address_text{
		top:57%!important;
		left:43%!important;
	}

	.second_address{
		top:70% !important;
		left: 60%!important;
	}

	#postCard_printProduction_image .position_title_text{
		top:48%!important;
		left:44%!important;
	}

	#letter_printProduction_image .position_title_text{
		top:50%!important;
		left:50%!important;
	}
}
@media screen and (min-width: 600px) and (max-width:849px) {
  .position_address_text{
		top:57%!important;
		left:40%!important;
	}
	.second_address{
		top:70% !important;
		left: 61%!important;
	}



	#postCard_printProduction_image .position_title_text{
		top:48%!important;
		left:40%!important;
	}

	#letter_printProduction_image .position_title_text{
		top:50%!important;
		left:50%!important;
	}
}
</style>
<section class="section alt" id="printProduction">
	<div class="row">

		<div class="small-10 small-centered medium-uncentered medium-10 medium-offset-1 large-offset-1 large-6 large-push-4 end columns sectionDescription">
			<h2 class="sectionTitle">Print Production, Quality Assurance and On-Time Mailing</h2>
			<div class="">
				<p>After you remove any current clients, we'll prepare your direct mail campaign for printing by merging each prospect's specific home data including year built, square footage and a custom insurance quote, with your chosen template. Once completed, our Quality Assurance department will verify that each prospect’s quote contains all of the correct variable data information.</p>

				<p>Each quote is printed, folded, inserted, sealed and addressed on the same professional, high quality digital presses and other equipment used every day by top direct mail companies. After your quotes are printed, we inspect the quality and accuracy of your job before it is mailed.</p>

				<p>Quality assurance is very important to us.  We have 9 separate quality control checks before one quote is mailed to ensure an absolutely perfect mailing, 100% guaranteed!</p>

			</div>
		</div>


		<div id="letter_printProduction_image" class="small-hide large-pull-7 large-5 columns printImage">
			<div class="position_img">
				<img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo getPrintProdImage(); ?>" class="lazy printImg">
			</div>
			<div class="position_title_text <?php // if ($agent['shortname']) {echo 'agency';}?>">
				<?php // echo ($agent['shortname']) ? $agent['nobreakname'] : 'The John Doe Insurance Agency';?>

			</div>
			<div class="position_address_text">
				<p class="p1">Your Prospect<?php // echo $prospects[$first]['first_name'].' '.$prospects[$second]['last_name']?></p>
				<p class="p2">1234 Any St.<?php // echo $prospects[$address]['address']?></p>
				<p class="p2">
					<?php if ($agent) {
        echo $agent_location;
    } else {
      echo $location;
    }
  ?>
				</p>
			</div>
		</div>

		<div id="postCard_printProduction_image" style="display:none" class="small-hide large-pull-7 large-5 columns printImage">
			<div class="position_img">
				<img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo getPrintProdImage('postcard'); ?>" class="lazy printImg">
			</div>
			<div style="" class="position_title_text <?php if ($agent['shortname']) {
                        echo 'agency';
                    } ?>">
				<?php //echo ($agent['shortname']) ? '' : 'The John Doe Insurance Agency';?>
			</div>
			<?php if ($agent) { ?>
				<div style="" class="position_title_text">
					<?php //echo $agent['nobreakname'];?>
				</div>
			<?php }
            if ($agent) {
                // $agent_name = $agent['shortname'];
                $agent_name1 = 'The' . $agent['shortname'];
                $agent_address = $agent['address'];
                $agent_logo = $agent['logo'];
            } else {
                // $agent_name = $prospects[7]['first_name'].' '.$prospects[7]['last_name'];
                $agent_name1 = 'The John Doe';
                $agent_address = '1234 Any Street';
            }
            $agent_name2 = 'Insurance Agency';
            ?>

			<div class="position_address_text second_address" >
				<p class="p2">Your Prospect<?php // echo $prospects[$first]['first_name'].' '.$prospects[$second]['last_name']?></p>
				<p class="p2">1234 Any St.<?php // echo $prospects[$address]['address']?></p>
				<p class="p2">
					<?php if ($agent) {
                echo $agent_location;
            } else {
                            echo $location;
                        }
                    ?>
				</p>
			</div>
            <div class="position_address_text extra_info" style="color:#000">
	            <p class="p3"><?php echo $agent_logo  ?></p>
                <p class="p3"><?php echo $agent_name1 ?></p>
                <p class="p3"><?php echo $agent_name2 ?></p>
                <p class="p3"><?php echo $agent_address ?></p>
                <p class="p3">
	                <?php if ($agent) {
                        echo $agent_location;
                    } else {
                            echo $location;
                        }
                    ?>
                </p>
            </div>
		</div>


	</div>
</section>

<style type="text/css">
.position_title_text {
	display:none;
    position: absolute;
    top: 57.5%;
    font-size: .36rem;
    left: 47%;
}
.position_title_text.agency {
    position: absolute;
    top: 60.8%;
    font-size: .36rem;
    left: 51.3%;
}
#letter_printProduction_image .position_title_text.agency {
    display: block;
    top: 59.8%;
    font-size: .36rem;
    left: 42%;
    width: 28%;
    background: #fefefe;
    padding: 1px;
}
.position_address_text {
    position: absolute;
    top: 64%;
    font-size: .36rem;
    left: 64%;
}
.position_address_text p.p1 {
	font-size: .4rem;
    margin: -3px 0 0 0 !important;
    padding: 0 !important;
    font-weight: 900;
    font-family: 'Open Sans', sans-serif !important;
}
.position_address_text p.p2{font-size: .36rem;margin: 0 !important;padding: 0 !important;}
</style>
