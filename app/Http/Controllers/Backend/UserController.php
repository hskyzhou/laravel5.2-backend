<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/*仓库*/
use UserRepo;
use RoleRepo;
use PermissionRepo;

class UserController extends Controller
{
    public function __construct(){

    }

    public function index(){
    	return view('backend.user.index');
    }

    public function ngIndex(){
    	return view('backend.user.ngindex');
    }

    /**
     * ajax 获取用户列表
     * 
     * @param		
     * 
     * @author		xezw211@gmail.com
     * 
     * @date		2016-04-06 16:50:42
     * 
     * @return		
     */
    public function adminAjaxUserList(){
        $returnData = UserRepo::searchUserList();

        return response()->json($returnData);
    }


    /**
     * 创建用户
     * 
     * @param        
     * 
     * @author        xezw211@gmail.com
     * 
     * @date        2016-04-07 13:32:11
     * 
     * @return        
     */
    public function create(){
        return view('backend.user.index');
    }

    public function ngCreate(){
        /*角色列表*/
        $roles = RoleRepo::all();

        /*权限列表*/
        $permissions = PermissionRepo::bkPermissionList();

        return view('backend.user.ngcreate', compact('roles', 'permissions'));
    }
}
