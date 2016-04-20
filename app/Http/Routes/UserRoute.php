<?php
	
	$router->group(['prefix' => 'user', 'as' => 'admin.user.'], function($router){
		$router->get('/', 'UserController@index');
		/*ajax*/
		$router->get('ajuserlist', 'UserController@adminAjaxUserList');
		$router->delete('deletes', 'UserController@deletes')->name('deletes');  //删除多个
		/*angular*/
		$router->get('ngindex', 'UserController@ngIndex');
		$router->get('ngcreate', 'UserController@ngCreate');
		$router->get('ngedit/{id}', 'UserController@ngEdit')->where(['id' => '[0-9a-zA-Z]+']);
	});

	$router->resource('user', 'UserController');