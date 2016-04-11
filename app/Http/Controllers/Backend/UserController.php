<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/*仓库*/
use UserRepo;
use RoleRepo;
use PermissionRepo;

/*Request*/
use App\Http\Requests\UserRequest;
/*Event*/
use App\Events\Backend\AddRoleEvent;
use App\Events\Backend\AddPermissionEvent;

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

    public function store(UserRequest $userRequest){
        $userData = [
            'name' => request('name', ''),
            'email' => request('email', ''),
            'password' => bcrypt(request('password', '')),
            'status' => request('status', config('project.status.open')),
        ];

        $user = UserRepo::createUser($userData);

        if($user){
            /*添加用户角色*/
            $roles = RoleRepo::getRolesBySlug(request('roles', []));
            event(new AddRoleEvent($user, $roles));
            /*添加用户权限*/
            $permissions = PermissionRepo::getPermissionsBySlug(request('permissions', []));
            event(new AddPermissionEvent($user, $permissions));
        }

        return redirect()->route('admin.user.index');
    }

    /**
     * 修改用户
     * 
     * @param        
     * 
     * @author        xezw211@gmail.com
     * 
     * @date        2016-04-11 17:12:12
     * 
     * @return        
     */
    public function edit(){

    }

    /**
     * 删除用户
     * 
     * @param        
     * 
     * @author        wen.zhou@bioon.com
     * 
     * @date        2016-04-11 17:12:24
     * 
     * @return        
     */
    public function destory(){
        
    }
}
