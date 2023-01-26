<?php

	require_once('imageUtils.php');

	$agent = '';
	$image = '';
	$colors = getColors();

	$type = $_GET['type'];

	init($type);

	function init($type) {
		global $agent, $image, $colors;
		$agent = getAgentData();
		$image = createImage($type);
	}


	function createImage($type) {
		global $agent, $image, $colors;

		$image = new PHPImage();

		if($type == 'printProduction') {
			$bg = '../images/printProduction.jpg';
			$image->setDimensionsFromImage($bg);
			$image->setOutput('jpg', 55);
		} elseif($type == 'envelope') {
			$bg = '../images/header/printedLetter.png';
			$image->setDimensionsFromImage($bg);
			$image->setOutput('png', 7);
		}

		$image->draw($bg);
		$image->setFont(font('Bold'));

		replaceLogo($type);
		if($type == 'printProduction') {
			$image->resize(834, 888);
		}
		$image->show();
	}

	// Replace existing generic company logo
	function replaceLogo($type) {
		global $agent, $image, $colors, $imageDir;

		$company = strtolower($agent['company']);

		if(!doLogoReplace($company)){
			return false;
		}
		$logoHeight = getLogoHeight();


		if($type == 'printProduction') {
			$center = $image->getWidth() / 2 - 120;
			$image->rectangle($center, 740, 450, 150, $colors['white'], 1);
			$x = $center+160;
			$y = 780;
			$textX = 150;
			$textY = $logoHeight + $y;
			$fontSize = 13;
			$logoUrl = getCompanyLogo($company, 'lg');
		} elseif($type == 'envelope') {
			$center = $image->getWidth() / 2 - 120;
			// $image->rectangle(300, 060, 150, 76, $colors['white'], 1);
			$image->rectangle(352, 060, 100, 76, $colors['white'], 1);
			$image->rectangle(90, 150, 110, 50, $colors['white'], 1);
			$x = 35;
			$y = 54;
			$textX = 353;
			$textY = $logoHeight + $y - 75;

			$fontSize = 8;
			$logoUrl = getCompanyLogo($company, 'sm');

		}
		$image->draw($logoUrl, $x, $y);
		$agent_name = 'The John Doe';
		$agent_egency = 'Insurance Agency';

		if($agent['name']){
			$agent_name = 'The '.$agent['shortname'];
		}

		//the old code
	// $image->text($agent_name, array(
	// 			'fontSize' => $fontSize, // Desired starting font size
	// 			'x' => $textX + 17,
	// 			'y' => $textY,
	// 			'fontColor' => $colors['darkGray'],
	// 			'fontFile' => font('Regular'),
	// 			'width' => $image->getWidth(),
	// 			'height' => 50,
	// 			'alignHorizontal' => 'center',
	// 			'alignVertical' => 'center'
	// 	));
	//
	// 	$image->text($agent_egency, array(
	// 			'fontSize' => $fontSize, // Desired starting font size
	// 			'x' => $textX + 30,
	// 			'y' => $textY + 14,
	// 			'fontColor' => $colors['darkGray'],
	// 			'fontFile' => font('Regular'),
	// 			'width' => $image->getWidth(),
	// 			'height' => 50,
	// 			'alignHorizontal' => 'center',
	// 			'alignVertical' => 'center'
	// 	));

	//	the new code
		// $image->text($agent_name, array(
	  //       'fontSize' => 6, // Desired starting font size
	  //       'x' => $textX ,
	  //       'y' => $textY + 8,
	  //       'fontColor' => $colors['darkGray'],
	  //       'fontFile' => font('Regular'),
	  //       'width' => $image->getWidth(),
	  //       'height' => 50,
	  //       'alignHorizontal' => 'left',
	  //       'alignVertical' => 'center'
	  //   ));
		//
	  //   $image->text($agent_egency, array(
	  //       'fontSize' => 6, // Desired starting font size
	  //       'x' => $textX ,
	  //       'y' => $textY + 18,
	  //       'fontColor' => $colors['darkGray'],
	  //       'fontFile' => font('Regular'),
	  //       'width' => $image->getWidth(),
	  //       'height' => 50,
	  //       'alignHorizontal' => 'left',
	  //       'alignVertical' => 'center'
	  //   ));


	}

?>
