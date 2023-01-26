<?php
	require('medoo/medoo.php');
	$database = new medoo([
		// required
		'database_type' => 'mysql',
		'database_name' => 'onlyinsuranceleads',
		'server' => 'localhost',
		'username' => 'onlyinsuranceleads',
		'password' => '5a*/Dj-cTXS[k)u!',
		'charset' => 'utf8',
		// [optional]
		//'port' => 3306,
		// [optional] Table prefix
		//'prefix' => 'PREFIX_',
	]);

	$table = "agents";

?>