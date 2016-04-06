<?php
	
	$router->group(['prefix' => 'user'], function($router){
		$router->get('/', 'UserController@index');
		$router->get('ngindex', 'UserController@ngIndex');
	});

	$router->resource('user', 'UserController');