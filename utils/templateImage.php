<?php
	require_once('imageUtils.php');

	$agent = '';
	$image = '';
	$colors = getColors();
	$templateNumber = '';
	$imageDir = "../images/templates";
	$size = '';

	init();

	function init() {
		global $agent, $image, $colors, $templateNumber, $size;

		$templateNumber = $_REQUEST['template'];
		$size = $_REQUEST['size'];
		$agent = getAgentData();
		$templateUrl = getTemplateUrl();
		$layout = getTemplateLayout();
		$image = createImage($templateUrl, $layout);
	}


	function createImage($templateUrl, $layout) {
		global $agent, $image, $colors, $size;

		$bg = $templateUrl;

		$image = new PHPImage();
		$image->setDimensionsFromImage($bg);
		$image->draw($bg);
		$image->setOutput('png', 9);
		$image->setFont(font('Bold'));


		switch($layout) {
			case '1':
				replaceLogo('center');
				replaceRightSideInfo();
				replaceBottomInfo();
				replaceContentPhone($agent['phone'], 'large');
				replaceAddressee();
				replaceBottomAddress();
				placeBodyText();
				break;
			case '2':
				createTopRightInfo();
				replaceLogo('left');
				replaceContentPhone($agent['phone'], 'large');
				replaceBottomInfo();
				replaceAddressee();
				replaceBottomAddress();
				placeBodyText();
				break;
			case '3':
				createTopRightInfo();
				replaceLogo('left');
				replaceBottomInfo();
				replaceContentPhone($agent['phone'], 'small');
				replaceAddressee();
				replaceBottomAddress();
				placeBodyText();
				break;

			case '4':
				createTopRightInfo();
				replaceLogo('left');
				replaceAddressee();
				break;
		}

		if($size == "thumb") {
			$image->resize(400, 517);
			$image->setOutput("jpg", 85);
		}
		$image->show();
	}

	// Replace existing generic company logo
	function replaceLogo($pos) {
		global $agent, $image, $colors, $imageDir;
		$company = strtolower($agent['company']);

		if(!doLogoReplace($company)){
			return false;
		}

		$logoUrl = getCompanyLogo($company, 'lg');
		$logoHeight = getLogoHeight();

		switch ($pos) {
			case 'left':
				$image->rectangle(0, 0, 350, 150, $colors['white'], 1);
				$x = 60;
				$y = 65;
				break;

			case 'center':
				$center = $image->getWidth() / 2 - 120;
				$image->rectangle($center-50, 0, 550, 150, $colors['white'], 1);
				$x = $center;
				$y = 30;
				break;
		}

		if($pos == 'center') {

			$image->text($agent['name'], array(
		        'fontSize' => 13, // Desired starting font size
		        'x' => 0,
		        'y' => $logoHeight + 30,
		        'fontColor' => $colors['darkGray'],
		        'fontFile' => font('Regular'),
		        'width' => $image->getWidth(),
		        'height' => 50,
		        'alignHorizontal' => 'center',
		        'alignVertical' => 'center'
		    ));
		}

		$image->draw($logoUrl, $x, $y);
	}


	// Replace the addressee
	function replaceAddressee() {
		global $agent, $image, $colors;

		$fontsizeMinor = 10;

		// Cover existing right side text
		$image->rectangle(100, 190, 170, 80, $colors['white'], 1);

		$lines = array(
			getName(),
			getAddress(),
			$agent['city'].', '.$agent['state'].' '.$agent['zip']
		);

		$params = array(
			'width' => 200,
			'height' => 420,
			'fontSize' => $fontsizeMinor,
			'fontColor' => $colors['black'],
			'x' => 100
		);

		multiline($lines, $params, 8, 190);
		return $image;
	}


	// Replace existing generic company info
	function createTopRightInfo() {
		global $agent, $image, $colors;

		$right = $image->getWidth();
		$width = 200;
		$height = 100;

		$y = 100; //y
		$x = $right - $width - 40;

		$margin = 8;
		$fontsize = 11;
		$fontsizeMinor = 9;


		// Cover existing right side text
		$image->rectangle($x, 0, $width, $height*2, $colors['white'], 1);


		// Add company name
		$image->text($agent['name'], array(
			'width' => $width,
			'height' => $height,
			'fontSize' => $fontsize,
			'fontColor' => $colors['darkGray'],
			'x' => $x,
			'y' => $y - ($fontsize + $margin * 2)
		));

		// Setup multiline right side text
		$agentPhone = 'Phone: '.$agent['phone'];

		$lines = array(
					$agent['address'],
					$agent['city'].', '.$agent['state'].' '.$agent['zip'],
					'Phone: '.$agent['phone'],
					$agent['email']
				);


		$params = array(
			'width' => $width,
			'height' => $height,
			'fontSize' => $fontsizeMinor,
			'fontColor' => $colors['blue'],
			'x' => $x
		);

		multiline($lines, $params, $margin, $y);

		return $image;
	}

	function replaceRightSideInfo() {
		global $agent, $image, $colors;

		// Replace Company Name on Right
		$width = 200;
		$height = 20;
		$fontsize = 12;
		$x = 530;
		$y = 370;
		$image->rectangle($x, $y, $width, $height*2, $colors['white'], 1);

		// Add company name
		$image->text($agent['name'], array(
			'width' => $width,
			'height' => $height,
			'fontSize' => $fontsize,
			'fontFile' => font('Regular'),
			'fontColor' => $colors['darkGray'],
			'x' => $x,
			'y' => $y + 12,
			'alignVertical' => 'center',
			'alignHorizontal' => 'center'
		));


		// Replace Phone on Right
		$height = 30;
		$y = 450;
		$image->rectangle($x, $y, $width, $height*2, $colors['white'], 1);

		// Phone number
		$image->text($agent['phone'], array(
			'width' => $width,
			'height' => $height,
			'fontSize' => $fontsize,
			'fontFile' => font('Regular'),
			'fontColor' => $colors['deepBlue'],
			'x' => $x,
			'y' => $y + 5,
			'alignVertical' => 'center',
			'alignHorizontal' => 'center'
		));

		// Email address
		$image->text($agent['email'], array(
			'width' => $width,
			'height' => $height,
			'fontSize' => $fontsize,
			'fontFile' => font('Regular'),
			'fontColor' => $colors['deepBlue'],
			'x' => $x,
			'y' => $y + 27,
			'alignVertical' => 'center',
			'alignHorizontal' => 'center'
		));

		// Replace website URL on right
		$height = 10;
		$y = 533;
		$image->rectangle($x, $y, $width, $height*2, $colors['white'], 1);

		// Add company name
		$image->text($agent['website'], array(
			'width' => $width,
			'height' => $height,
			'fontSize' => $fontsize,
			'fontFile' => font('Regular'),
			'fontColor' => $colors['deepBlue'],
			'x' => $x,
			'y' => $y+8,
			'alignVertical' => 'center',
			'alignHorizontal' => 'center'
		));

	}

	// Replace the phone number in the body copy
	function replaceContentPhone($phone, $size) {
		global $image;

		$colors = getColors();
		$color = $colors['blue'];
		if($size == 'large') {
			$width = 94;
			$height = 15;
			$x = 305;
			$y = 427;
		} else {
			$width = 97;
			$height = 15;
			$x = 550;
			$y = 726;
		}

		$image->rectangle($x, $y, $width-7, $height, array(255, 255, 255), 1);
		$image->text($phone, array(
			'width' => $width,
			'height' => $height,
			'fontSize' => 8.65,
			'fontColor' => $color,
			'autoFit' => true,
			'x' => $x,
			'y' => $y
		));
	}


	// Replace bottom info on templates
	function replaceBottomInfo() {
		global $agent, $image, $colors;

		$layout = getTemplateLayout();
		$bottom = $image->getHeight();
		$width = $image->getWidth();
		$height = 105;
		$x = 0;


		switch($layout) {
			case '1':
					$backgroundColor = $colors['white'];
					$textColor = $colors['lightGray'];
				break;

			case '2':
				$backgroundColor = $colors['white'];
				$textColor = $colors['darkBlue'];
				break;

			case '3':
				$backgroundColor = $colors['darkBlue'];
				$textColor = $colors['white'];
				break;
		}


		if($layout == '2' || $layout == '3') {
			$margin = 10;
			$fontsize = 14;
			$y = $bottom - $height;

			$lines = array('Call us now at '.trim($agent['phone']), 'to lock in a better rate today!');
			$font = font('BoldItalic');
			array_push($lines, [$agent['website'], ['fontSize'=>12]]);
		}

		if($layout == '1') {
			$margin = 10;
			$fontsize = 9;
			$font = font('Regular');
			$y = $bottom - $height + 10;

			$lines = array($agent['address'].' '.$agent['city'].', '.$agent['state'].' '.$agent['zip']);
			array_push($lines, 'Phone: '.$agent['phone']);
			array_push($lines, $agent['website']);

		}

		$alignH = 'center';
		$alignV = 'center';

		$image->rectangle(0, $y, $width, $height, $backgroundColor, 1);

		$params = array(
			'width' => $width,
			'height' => $height,
			'fontSize' => $fontsize,
			'fontFile' => $font,
			'fontColor' => $textColor,
			'alignVertical' => 'center',
			'alignHorizontal' => 'center'
		);

		multiline($lines, $params, $margin, $y-27);
	}

	// Replace the address in the recommended insurance box

	function replaceBottomAddress() {
		global $agent, $image, $colors, $templateNumber;

		$layout = getTemplateLayout();

		$txt = getAddress().' '.$agent['city'].', '.$agent['state'].' '.$agent['zip'];
		$color = $colors['black'];
		$backgroundColor = $colors['lightBlue'];

		switch($layout) {
			case 1:
				$x = 130;
				$y = 505;
				$height = 15;
				$width = 300;
				break;

			case 2:
				$x = 238;
				$y = 512;
				$height = 15;
				$width = 300;
				break;

			case 3:
				$x = 85;
				$y = 512;
				$height = 17;
				$width = 300;
				break;
		}

		$image->rectangle($x, $y, $width-7, $height, $backgroundColor, 1);
		$image->text($txt, array(
			'width' => $width,
			'height' => $height,
			'fontSize' => 9,
			'fontColor' => $color,
			'autoFit' => true,
			'x' => $x,
			'y' => $y,
			'alignHorizontal' => true
		));
	}


	function getTemplateUrl() {
		global $templateNumber, $imageDir;
		return $imageDir.'/generic/template_'.$templateNumber.'.png';
	}

	function getTemplateLayout() {
		global $templateNumber;
		// Layout 1 - Template 1
		// Layout 2 - Templates 2 and 3
		// Layout 3 - Templates 4 and 5
		$templates[1] = '1';
		$templates[2] = '2';
		$templates[3] = '2';
		$templates[4] = '3';
		$templates[5] = '3';
		$templates[6] = '3';
		$templates[7] = '3';
		$templates[8] = '2';
		$templates[9] = '3';
		$templates[10] = '2';
		$templates[11] = '2';
		$templates[12] = '4';

		return $templates[$templateNumber];
	}

	function placeBodyText() {
		global $agent, $image, $colors, $templateNumber;
		$txt = getBodyText();
		switch(getTemplateLayout()) {
			case 1:

			case 2:
				$image->rectangle(50, 400, 450, 70, $colors['white']);
				justifiedText($txt, array(
					"left"=>60,
					"top"=>400,
					"width"=>420,
					"linespacing"=>1.3
				));
				break;

			case 3:
				$image->rectangle(435, 675, 300, 150, $colors['white']);
				justifiedText($txt, array(
					"left"=>452,
					"top"=>675,
					"width"=>279,
					"linespacing"=>1.5
				));
				break;

			case 4:
		}



	}


?>
