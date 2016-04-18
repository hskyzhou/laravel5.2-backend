<?php
    $router->group(['prefix' => 'role'], function($router){
    	$router->get('/', 'RoleController@index');
    	$router->get('ngindex', 'RoleController@ngIndex');
    	$router->get('ajuserlist', 'RoleController@adminAjaxRoleList');
	});

	$router->resource('role', 'RoleController');