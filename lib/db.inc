<?php
	require('medoo/medoo.php');
	$database = new medoo([
		// required
		'database_type' => 'mysql',
		'database_name' => 'db93816_agents',
		'server' => 'internal-db.s93816.gridserver.com',
		'username' => 'db93816',
		'password' => '}7v?Sd{7efA',
		'charset' => 'utf8',
		// [optional]
		//'port' => 3306,
		// [optional] Table prefix
		//'prefix' => 'PREFIX_',
	]);

	$table = "agents";

?>