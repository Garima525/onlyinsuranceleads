<?php
	$isDebug = false;
	$apiKey = 'AIzaSyAI5S-ScEMYCPkcNEp-KP7t6nfJJ-aJwdc';
	date_default_timezone_set('America/Phoenix');
	require('lib/db.inc');

	if(isset($_REQUEST['debug'])) {
		$isDebug = true;
	}

	function isProperAgentURL($agent){
		if(isset($_REQUEST['debug'])){
			return false;
		}
		if(!isset($_REQUEST['agent'] )) {
			return false;
		}
		if(isset($agent['name']) && !is_null($agent['name']) && !empty($agent['name'])){
			$agentCode = $_REQUEST['agent'];
			$queryString = $_SERVER['QUERY_STRING'];
			$agentString='agent='.$agentCode;
			if($queryString == $agentString){
				return true;
			}
			return false;
		}
	}
	// Setup the Agent data
	$agent = getAgentData();


	// Echo the agent data to the page for AJAX use.
	echoAgentData($agent);

	// Check URL for an agent code
	function getPurl() {
		$purl = false;
		if (isset($_REQUEST['agent'])) {
	    	$purl = $_REQUEST['agent'];
		}

		return $purl;
	}

	// Get agent data from database
	function getAgentData() {
		global $isDebug, $database, $table;
		$purl = getPurl();
		$agentData = false;



		if($purl) {
			$agentData = $database->get($table, "*", [
				"purl" => $purl,
			]);
		}


		if($isDebug) {
			$debug = 'true';
		} else {
			$debug = 'false';
		}

		if($agentData ) {

			$agent = normalizeAgentData($agentData);
			if(isProperAgentURL($agent)){
				$database->update($table, ["hits"=>$agent['hits']+1], ["purl" => $purl]);
			}
			return $agent;
		} else {
			return false;
		}
	}


	function normalizeAgentData($agentData) {
		$agent = array();
		$agent['class'] = 'purl';
		$agent['company'] = strtolower($agentData['CARRIER']);
		$agent['name'] = 'The ' . $agentData['FullName'] . "\n Insurance Agency";
		$agent['nobreakname'] = 'The ' . $agentData['FullName'] . " Insurance Agency";
		$agent['prefix'] = 'The';
		$agent['lastname'] = 'Insurance Agency';
		$agent['shortname'] = $agentData['FullName'];
		$agent['address'] = $agentData['Address'];
		$agent['city'] = $agentData['City'];
		$agent['state'] = $agentData['St'];
		$agent['zip'] = $agentData['Zip'];
		$agent['email'] = 'info@agencyname.com';
		$agent['website'] = 'www.agencyname.com';
		$agent['salesperson_email'] = $agentData['salesperson_email'];
		$agent['salesperson_phone'] = $agentData['salesperson_phone'];
		$agent['phone'] = '555-555-5555';
		$agent['purl'] = $agentData['purl'];
		$agent['hits'] = $agentData['hits'];
		$agent['competitors'] = [
			[$agentData['CLOSESTCOMPANYNAME'], $agentData['DISTANCE1']],
			[$agentData['CLOSESTCOMPANYNAME1'], $agentData['DISTANCE2']],
			[$agentData['CLOSESTCOMPANYNAME2'], $agentData['DISTANCE3']]
		];
		$agent['prospects'] = $agentData['count'];

		if($agentData['Email']) {
			$agent['email'] = $agentData['Email'];
		}

		if($agentData['website']) {
			$agent['website'] = formatUrl($agentData['website']);
		}

		if($agentData['Phone']) {
			$agent['phone'] = formatPhone($agentData['Phone']);
		}
		if($agentData['salesperson_phone']) {
			$agent['salesperson_phone'] = formatPhone($agentData['salesperson_phone']);
		}


		return $agent;
	}


	function echoAgentData($agent) {
		global $isDebug;

		if($agent) {
			print_r('<script>
						var agentData = "'.base64_encode(serialize($agent)).'";
						var agent = '.json_encode($agent).';
						var isDebug = "'.$isDebug.'";
				</script>');

		} else {
			echo '<script>
						var agent = false;
						var isDebug = false;
				</script>';

		}
	}

	function formatPhone($number) {
		$phone = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $number). "\n";
		trim($phone);
		return $phone;
	}

	function formatUrl($url) {
		return str_replace('\\', '/', $url);
	}


	function getDateTime() {
		return date("D F j, Y, g:ia");
	}


	function getTemplateImage($num, $size="full") {
		global $agent;
		$baseDir = '../images/templates';

		if($agent) {
			$imgSrc = 'utils/templateImage.php?template='.$num.'&agent='.base64_encode(serialize($agent)).'&size='.$size;
		} else {
			$imgSrc = $baseDir.'/generic/template_'.$num.'.png';
		}

		return $imgSrc;
	}

	function getPrintProdImage( $subType='letter') {
		global $agent;
		$imageDir = "images";

		if($agent) {
			if($subType=='postcard'){
				$imgSrc = 'utils/envelopeImageTop.php?&type=printProduction&subType=postcard&agent='.base64_encode(serialize($agent));
			}else{
				$imgSrc = 'utils/envelopeImageTop.php?&type=printProduction&subType=letter&agent='.base64_encode(serialize($agent));
			}
		} else {
			if($subType=='postcard'){
				$imgSrc = $imageDir.'/printProductionpostcard.jpg';
			}else{
				$imgSrc = $imageDir.'/printProductionLetter.jpg';
			}
		}

		return $imgSrc;
	}

	function getEnvelopeImage() {
		global $agent;
		$imageDir = "images";
		if($agent) {
			$imgSrc = 'utils/envelopeImage.php?&type=envelope&agent='.base64_encode(serialize($agent));
		}else {
			$imgSrc = 'utils/dummyImage.php';
			// $imgSrc = $imageDir.'/header/printedLetter.png';
		}
		return $imgSrc;
	}

?>
