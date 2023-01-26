<?php
	if(!$agent) {
		return;
	}

	$prospects = '';
	$prospectsDist = '';
	$hasComps = false;

	if($agent['prospects']) {
		$prospects = $agent['prospects'].' Prospects';
		$prospectsDist = 'found within 25 mi. of your office.';
	}

	if($agent['competitors'][0][0]) {
		$hasComps = true;
	}

	$prospectIcon = "images/icon_competitor_".$agent['company'].".svg";
?>

<section id="agentMap" class="section">
	<div class="row">
		<div class="medium-3 medium-offset-1 small-5 small-offset-1 columns prospectsDetail">
			<div class="prospectsContainer">
				<div class="prospects"><?php echo $prospects; ?></div>
				<div class="prospectsDist"><?php echo $prospectsDist; ?></div>
			</div>
			<?php
				if($hasComps) {
			?>
				<div class="closestCompetitors">Closest Competitors</div>
				<div class="competitorsContainer">
				<table>
			<?php
					foreach($agent['competitors'] as $comp) {
			?>
					<tr>
						<td class="icon_container">
							<img src="<?php echo $prospectIcon ?>" class="icon_competitor">
						</td>
						<td class="competitorName">
							<?php echo $comp[0]; ?>
						</td>
						<?php
							$dist = '';
							if($comp[1]) {
								$dist = $comp[1].' mi.';
							}
						?>
						<td nowrap="true" class="competitorDist"><?php echo $dist; ?></td>
					</tr>
			<?php
					}
			?>
				</table>
				</div>
			<?php
				}
			?>
		</div>
	</div>
	<div id="map"></div>

</section>

<script>
	var geocoder, map, loc;
	var competitorIcon = getCompetitorIcon();
	var prospectIcon = "prospect";
	var spherical;

	var zindex = {
		idx: 1,
		max: function(){
			return google.maps.Marker.MAX_ZINDEX + 1;
		},
		up: function() {
			zindex.idx++;
		},
		value: function() {
			return this.idx;
		}
	}

	function getCompetitorIcon() {
		var company = agent['company'];
		return "images/icon_competitor_" + company + ".svg";
	}

	function initMap() {
		var agencyAddress = agent['address']+' '+agent['zip'];
		codeAddress(agencyAddress);
		spherical = google.maps.geometry.spherical;
	}

	function codeAddress(address) {
		geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			'address': address
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				loc = results[0].geometry.location;
				var myOptions = {
					zoom: 10,
					center: loc,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					scrollwheel: false,
					disableDefaultUI: true,
					zoomControl: false,
					navigationControl: false,
					mapTypeControl: false,
					scaleControl: false,
					draggable: false,
					disableDoubleClickZoom: true
				}
				map = new google.maps.Map(document.getElementById("map"), myOptions);
				var miles = 25;

				renderRadius(miles);
				renderProspects(agent['prospects']);
				renderMarker(address);
				renderCompetitors(agent['competitors']);
			}
		});
	}

	function getDistance(miles) {
		return miles * 1609.344;
	}

	function renderProspects(amt) {

		if(amt > 400) {
			amt = 400;
		}
		var dist = getDistance(25);
		for(var i = 1; i <= amt;) {
			var position = getRandomLoc(dist);

			if(!showOnLand(position, showIconOnMap, prospectIcon)) {
				i++;
				zindex.up();
			}
		}
	}

	function showIconOnMap(loc, icon) {
		zindex.up();
		zidx = zindex.value();

		if(icon == competitorIcon) {
			zidx = zindex.max() + 900;
		} else {
			icon = {
				path: google.maps.SymbolPath.CIRCLE,
				scale: 1.5,
				strokeColor: "#443078",
				fillColor: "#443078",
				fillOpacity: 1
			}
		}


		var pros = new google.maps.Marker({
			icon: icon,
			position: loc,
			map: map,
			zIndex: zidx
		});
	}

	function renderMarker(title) {
		zindex.up();
		var marker = new google.maps.Marker({
			map: map,
			position: loc,
			optimized: false,
			zIndex: 1200000,
			title: title
		});
	}

	function renderCompetitors(competitors) {
		for(var i = 0; i < competitors.length; i++) {
			zindex.up();
			var dist = competitors[i][1];

			if(dist > 19) {
				dist += 5;
			}

			if(dist < 2) {
				dist = Math.floor(Math.random() * Math.floor(5));
			}

			dist = getDistance(dist);
			var position = getRandomLoc(dist);


			if(!showOnLand(position, showIconOnMap, competitorIcon)) {
				zindex.up();
			}
		}
	}

	function renderRadius(miles) {
		var circle = new google.maps.Circle({
			center: loc,
			radius: getDistance(miles),
			fillColor: "#00B5DF",
			fillOpacity: 0.2,
			strokeOpacity: 1,
			strokeWeight: 1,
			strokeColor: "#00B5DF",
			map: map
		});
	}

	function showOnLand(loc, callback, icon) {
		var lat = loc.lat();
		var lng = loc.lng();
		var map_url = "//maps.googleapis.com/maps/api/staticmap?center="+lat+","+lng+"&zoom="+map.getZoom()+"&size=1x1&maptype=roadmap&key=<?php echo $apiKey;?>";

		var canvas = document.createElement('canvas');
		var ctx = canvas.getContext('2d');

		var image = new Image();
		image.crossOrigin = "Anonymous";
		image.src = map_url;

		image.onload = function() {
			canvas.width = image.width;
			canvas.height = image.height;
			canvas.getContext('2d').drawImage(image, 0, 0, image.width, image.height);
			var pixelData = canvas.getContext('2d').getImageData(0, 0, 1, 1).data;
			if(isLand(pixelData)) {
				callback(loc, icon);
				return true;
			} else {
				return false;
			}
		}
	}

	function isLand(pixelData) {
		if(pixelData[0] > 150 && pixelData[0] < 190 && pixelData[1] > 190 && pixelData[1] < 220 ) {
			//water
			return false;
		} else {
			// land
			return true;
		}
	}

	function getRandomLoc(dist) {
		var randDist = Math.floor((Math.random() * dist) + 1);
		var randCoord = Math.floor((Math.random() * 360) + 1);
		var position = spherical.computeOffset(loc, randDist, randCoord);

		return position;
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apiKey; ?>&callback=initMap&libraries=geometry "async defer></script>
