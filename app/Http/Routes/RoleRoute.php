<?php
    $router->group(['prefix' => 'role'], function($router){
    	$router->get('/', 'RoleController@index');
	});