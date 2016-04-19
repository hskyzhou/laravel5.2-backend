<?php
    $router->group(['prefix' => 'role', 'as' => 'admin.role.'], function($router){
    	$router->get('/', 'RoleController@index');
    	$router->get('ngindex', 'RoleController@ngIndex');
    	$router->get('ngcreate', 'RoleController@ngCreate');
    	$router->get('ajrolelist', 'RoleController@adminAjaxRoleList');
    	$router->delete('deletes', 'RoleController@deletes')->name('deletes');
	});

	$router->resource('role', 'RoleController');