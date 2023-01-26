<?php
    require_once('imageUtils.php');
    header('Content-Type: image/png');
    $agent;
	$map = '';
	$colors = getColors();
    $image = new PHPImage(300, 300);
    $prospects = 200;

	init();

	function init() {
		global $agent, $image, $colors, $prospects;
		$agent = getAgentData();
        $map = getStaticMap();
        $prospects = $agent['prospects'];
        createProspects($prospects);
        show();
    }

    function getStaticMap() {
        global $agent, $image, $colors;
        $address = $agent['address'].' '.$agent['zip'];
        $address = urlencode($address);
        $apiKey = 'AIzaSyAI5S-ScEMYCPkcNEp-KP7t6nfJJ-aJwdc';
        $mapUrl = "http://maps.googleapis.com/maps/api/staticmap?key=".$apiKey."&center=".$address."&zoom=9&format=png&maptype=roadmap&style=element:labels%7Cvisibility:off&style=feature:administrative.land_parcel%7Cvisibility:off&style=feature:administrative.neighborhood%7Cvisibility:off&style=feature:poi%7Celement:labels.text%7Cvisibility:off&style=feature:poi.business%7Cvisibility:off&style=feature:road%7Cvisibility:off&style=feature:road%7Celement:labels.icon%7Cvisibility:off&style=feature:transit%7Cvisibility:off&size=300x300";
        $map = imagecreatefrompng($mapUrl);
        return $map;
    }

    function createProspects($count) {
        global $agent, $map, $image;
        if($count >= 300) {
            $count = 30;
        }
        $rad = 300;
        for($i=0; $i<= $count; $i+=2) {
            $x = rand(0, $rad);
            $y = rand(0, $rad);

            if(isLand($x, $y)) {
                prospect($x, $y);
                prospect(rand(0, $x), rand(0, $y));
            }
        }
    }

    function prospect($x, $y) {
        global $image;
        $image->circle($x, $y, 4, array(255, 24, 12));
    }

    function isLand($x, $y) {
        global $map;
        $color = imagecolorat(getStaticMap(), $x, $y);
        if($color > 150 && $color < 190 && $color > 190 && $color < 210 ) {
            return false;
        } else {
            return true;
        }
    }

    function show() {
        global $image;
        $image->show();
    }
?>
