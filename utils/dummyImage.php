<?php

	require_once('imageUtils.php');

	// $agent = '';
	$image = '';
	$colors = getColors();

  $image = new PHPImage();
	$image = new PHPImage();
  $bg = '../images/header/printedLetter.png';
  $image->setDimensionsFromImage($bg);
  $image->setOutput('png', 7);
	$image->draw($bg);
	$image->setFont(font('Bold'));
  $company = 'independent';
  $logoHeight = getLogoHeight();
  $center = $image->getWidth() / 2 - 120;
  $image->rectangle(90, 150, 110, 50, $colors['white'], 1);
  $x = 35;
  $y = 54;
  $textX = 110;
  $textY = $logoHeight + $y - 75;
  $fontSize = 8;
  $logoUrl = getCompanyLogo($company, 'sm');
	$image->draw($logoUrl, $x, $y);
	$image->show();

?>
