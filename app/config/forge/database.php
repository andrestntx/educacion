<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/
	'default' => 'pgsqlforge',

	'connections' => array(

		'pgsqlforge' => array(
			'driver'   => 'pgsql',
			'host'      => getenv('db_host'),
			'database'  => getenv('db_name'),
			'username'  => getenv('db_username'),
			'password'  => getenv('db_password'),
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
		),

	),

);
