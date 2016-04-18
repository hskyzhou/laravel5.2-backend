<?php
	
	$router->group(['prefix' => 'user', 'as' => 'admin.user.'], function($router){
		$router->get('/', 'UserController@index');
		$router->get('ngindex', 'UserController@ngIndex');
		$router->get('ngcreate', 'UserController@ngCreate');
		$router->get('ajuserlist', 'UserController@adminAjaxUserList');
		$router->get('ngedit/{id}', 'UserController@ngEdit')->where(['id' => '[0-9a-zA-Z]+']);
		$router->delete('deletes', 'UserController@deletes')->name('deletes');  //删除多个
	});

	$router->resource('user', 'UserController');