<?php
	
	$router->group(['prefix' => 'user'], function($router){
		$router->get('/', 'UserController@index');
		$router->get('ngindex', 'UserController@ngIndex');
		$router->get('ngcreate', 'UserController@ngCreate');
		$router->get('ajuserlist', 'UserController@adminAjaxUserList');
	});

	$router->resource('user', 'UserController');