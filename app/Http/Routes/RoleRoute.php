<?php
    $router->group(['prefix' => 'role', 'as' => 'admin.role.'], function($router){
    	$router->get('/', 'RoleController@index');
    	/*ajax*/
    	$router->get('ajrolelist', 'RoleController@adminAjaxRoleList');
    	$router->delete('deletes', 'RoleController@deletes')->name('deletes');
    	/*angular*/
    	$router->get('ngindex', 'RoleController@ngIndex');
    	$router->get('ngcreate', 'RoleController@ngCreate');
    	$router->get('ngedit/{id}', 'RoleController@ngEdit')->where(['id' => '[0-9a-zA-Z]+']);
	});

	$router->resource('role', 'RoleController');