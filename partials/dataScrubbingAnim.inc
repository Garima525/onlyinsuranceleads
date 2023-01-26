<?php
	$lastNames = array(
		'Black',
		'Rusch',
		'Broome',
		'Reamer',
		'Wheeler',
		'Cannon',
		'Shelton',
		'Lehman',
		'Mingo',
		'White'
	);

	$firstNames = array(
		'Jason',
		'Gerald',
		'David',
		'Catherine',
		'Jessica',
		'Amanda',
		'Judy',
		'Allison',
		'Elizabeth',
		'Julie'
	);

    $addresses = array(
		'Winifred Way',
		'Geraldine Lane',
		'Woodstock Drive',
		'Bell Street',
		'Carriage Lane',
		'Maud Street',
		'Vesta Drive',
		'Felosa Drive',
		'Meadow View Drive',
		'Richland Avenue'
	);

	$data = array();

	for($i=0; $i<=19; $i++) {
		$randFirst = rand(0, count($firstNames)-1);
		$randLast = rand(0, count($lastNames)-1);
		$randAddress = rand(0, count($addresses)-1);
		$name = $firstNames[$randFirst].' '.$lastNames[$randLast];
		$address = rand(100, 8999).' '.$addresses[$randAddress];

		array_push($data, array($name, $address));
	}
?>

<div class="dataScrubbingContainer">
	<div class="toolbar">
		<div class="circle"></div><div class="circle"></div><div class="circle"></div>
	</div>
	<table class="dataTable">
		<tbody>
			<?php
				for($i=0; $i<=count($data)-1; $i++){
			?>
					<tr>
						<td class="name"><?php echo $data[$i][0]; ?></td>
						<td class="address"><?php echo $data[$i][1]; ?></td>
						<td class="control"><div class="toggle"><span class="dash"></span></div></td>
					</tr>
			<?php
				}
			?>
			<?php
				for($i=0; $i<=count($data)-1; $i++){
			?>
					<tr>
						<td class="name"><?php echo $data[$i][0]; ?></td>
						<td class="address"><?php echo $data[$i][1]; ?></td>
						<td class="control"><div class="toggle"><span class="dash"></span></div></td>
					</tr>
			<?php
				}
			?>
		</tbody>
	</table>
</div>
