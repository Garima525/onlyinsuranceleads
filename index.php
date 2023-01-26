<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
		$(document).ready(function(){
		$.getJSON("https://api.ipify.org?format=json", function(data) {
			window.location.reload();
			var ip = data.ip;
			document.cookie = 'userIp='+ip;
			});
		});
</script>
<?php 

//echo $ip = isset($_SERVER['HTTP_CLIENT_IP'])? $_SERVER['HTTP_CLIENT_IP']: (isset($_SERVER['HTTP_X_FORWARDED_FOR'])? $_SERVER['HTTP_X_FORWARDED_FOR']: $_SERVER['REMOTE_ADDR']);

include('includes/location.inc');
use Mobilyte\Tools\LocationData as local;

$obj = new local();

$localData = $obj->ipToLocationinfo();

//echo "<pre>"; print_r($localData); die('okok');

$address = '1234, Any Street';
$cityName = ($localData->city) ? $localData->city.", " : 'Anywhere, ';
$stateName =  ($localData->region_code) ? $localData->region_code." " : '';
//$countryName = ($localData->country_name) ? $localData->country_name.", " : 'USA ';
$countryName = "";
$zipCode = ($localData->zip) ? $localData->zip : '12345';

$location = $cityName.$stateName.$zipCode;
// die($location);



?>
<!DOCTYPE html>
<html>
	<head>
		<title>Only Insurance Leads</title>
		<script type="text/javascript">
			var cityName = "<?php echo ($localData->city) ? $localData->city.", " : 'Anywhere, '; ?>";
			var stateName = "<?php echo ($localData->region_code) ? $localData->region_code." " : ''; ?>";
			//var countryName = "<?php echo ($localData->country_name) ? $localData->country_name.", " : 'USA '; ?>";
			var countryName = "";
			var zipCode = "<?php echo ($localData->zip) ? $localData->zip : '12345'; ?>";
			var orgAgency = "<?php echo ($localData->org) ? $localData->org : 'YOUR AGENCY'; ?>";
		</script>


		<?php
            include('includes/meta.inc');
            include('utils/agents.inc');
        ?>
	<body class="home <?php echo $agent['class'] ?> ">
		<?php
            include('includes/nav.inc');
            include('partials/landingHeader_old.inc');
            include('utils/send-agent-notice.php');
        ?>
		
		<!-- to find out the browser name  -->
		<script type="text/jscript">

			var nVer = navigator.appVersion;
			var nAgt = navigator.userAgent;
			var browserName  = navigator.appName;
			var fullVersion  = ''+parseFloat(navigator.appVersion);
			var majorVersion = parseInt(navigator.appVersion,10);
			var nameOffset,verOffset,ix;

			// In Opera, the true version is after "Opera" or after "Version"
			if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
			 browserName = "Opera";
			 fullVersion = nAgt.substring(verOffset+6);
			 if ((verOffset=nAgt.indexOf("Version"))!=-1)
			   fullVersion = nAgt.substring(verOffset+8);
			}
			// In MSIE, the true version is after "MSIE" in userAgent
			else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
			 browserName = "Microsoft Internet Explorer";
			 fullVersion = nAgt.substring(verOffset+5);
			}
			// In Chrome, the true version is after "Chrome"
			else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
			 browserName = "Chrome";
			 fullVersion = nAgt.substring(verOffset+7);
			}
			// In Safari, the true version is after "Safari" or after "Version"
			else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
			 browserName = "Safari";
			 fullVersion = nAgt.substring(verOffset+7);
			 if ((verOffset=nAgt.indexOf("Version"))!=-1)
			   fullVersion = nAgt.substring(verOffset+8);
			}
			// In Firefox, the true version is after "Firefox"
			else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
			 browserName = "Firefox";
			 fullVersion = nAgt.substring(verOffset+8);
			}
			// In most other browsers, "name/version" is at the end of userAgent
			else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) <
			          (verOffset=nAgt.lastIndexOf('/')) )
			{
			 browserName = nAgt.substring(nameOffset,verOffset);
			 fullVersion = nAgt.substring(verOffset+1);
			 if (browserName.toLowerCase()==browserName.toUpperCase()) {
			  browserName = navigator.appName;
			 }
			}
			// trim the fullVersion string at semicolon/space if present
			if ((ix=fullVersion.indexOf(";"))!=-1)
			   fullVersion=fullVersion.substring(0,ix);
			if ((ix=fullVersion.indexOf(" "))!=-1)
			   fullVersion=fullVersion.substring(0,ix);

			majorVersion = parseInt(''+fullVersion,10);
			if (isNaN(majorVersion)) {
			 fullVersion  = ''+parseFloat(navigator.appVersion);
			 majorVersion = parseInt(navigator.appVersion,10);
			}
			var siteBody = document.body;
			var class_browserName = "css_"+browserName.toLowerCase();
			siteBody.classList.add(class_browserName);
			// document.write(''
			//  +'Browser name  = '+browserName+'<br>'
			//  +'Full version  = '+fullVersion+'<br>'
			//  +'Major version = '+majorVersion+'<br>'
			//  +'navigator.appName = '+navigator.appName+'<br>'
			//  +'navigator.userAgent = '+navigator.userAgent+'<br>'
			// )

		</script>
		<!-- to find out the browser name  -->


		<main>
			<?php
                include('includes/trusted.inc');
                include('partials/process.inc');
                include('partials/howItWorks.inc');
                include('partials/targetedProspects.inc');
                include('partials/agentMap.inc');
                include('partials/dataScrubbing.inc');
                include('partials/gallery.inc');
                include('partials/printProduction.inc');
                include('partials/becomeCustomers.inc');
                include('partials/quotes.inc');
                include('partials/recap.inc');
                include('partials/pricing.inc');
                include('partials/getStarted.inc');
                include('includes/footer.inc');
            ?>
		</main>
	</body>
</html>
