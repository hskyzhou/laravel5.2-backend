<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*后台*/
Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'middleware' => ['web']], function ($router) {
	$router->get('i18n', 'IndexController@i18n')->name('admin.i18n');
    /*用户*/
    require(__DIR__ . '/Routes/UserRoute.php');
    
    /*权限*/
    require(__DIR__ . '/Routes/PermissionRoute.php');
    
    /*角色*/
    require(__DIR__ . '/Routes/RoleRoute.php');
    
    /*菜单*/
    require(__DIR__ . '/Routes/MenuRoute.php');
});
