<?php
	$incPath = "/images/templates/letters/components/";

	if(!isset($agent) || !$agent) {
		$agent = getAgent();
	}

	function getAgent() {
		if(isset($_GET['agent'])) {
			$agent = unserialize(base64_decode($_GET['agent']));
			$agent['disaster'] = getDisaster();
		} else {
			$agent = array('company'=>false, 'firstName'=>'John', 'name'=>"John Doe", 'address'=>'1234 Any Street', 'city'=>'Anywhere', 'state'=>'USA', 'zip'=>'12345', 'email'=>'info@agencyname.com', 'website'=>'www.agencyname.com', 'phone'=>'555-555-5555');
		}
		$agent['logo'] = getCompanyLogo();

		return $agent;
	}

	function getCompanyLogo() {
		global $agent;
		$company = $agent['company'];
		$companies = array("allstate", "fbfs", "country", "american");
		if(in_array($company, $companies)) {
			return $company;
		} else {
			return 'genericLogo';
		}
	}

	function getDisaster() {
		global $agent;
		$state = $agent['state'];
		$disaster = false;
		$flooding = array("MA","NJ","NY","VA");
		$hurricanes = array("AL","FL","GA","LA","MS","NC","SC","TX");
		$tornadoes = array("IL","IA","KS","MO","NE","OK","SD");
		$wildfires = array("AK","AZ","CA","CO","ID","MT","NV","NM","OR","UT","WA");
		$generic = array("AR","CT","DE","HI","IN","KY","ME","MD","MI","MN","NH","ND","OH","PA","RI","TN","TX","VT","WV","WI","WY");
		if(in_array($state, $flooding)) {
			$disaster = "flooding";
		} else if(in_array($state, $hurricanes)) {
			$disaster = "hurricanes";
		} else if(in_array($state, $tornadoes)) {
			$disaster = "tornadoes";
		} else if(in_array($state, $wildfires)) {
			$disaster = "wildfires";
		} else {
			$disaster = false;
		}

		return $disaster;
	}

	function inc($file, $variables = array(), $print = true) {
		global $agent, $incPath, $prospect;
		$output = NULL;
		// Extract the variables to a local namespace
		extract($variables);
		
		$file = $_SERVER['DOCUMENT_ROOT'].$incPath.$file;
		if(file_exists($file)){

			// Start output buffering
			ob_start();

			// Include the template file
			include $file;

			// End buffering and return its contents
			$output = ob_get_clean();
		}
		if ($print) {
			print $output;
		}
		return $output;
	}
?>