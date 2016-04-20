<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/*仓库*/
use RoleRepo, PermissionRepo;

/*service*/
use JavaScript, Flash;

/*事件*/
use App\Events\Backend\RoleAddPermissionEvent;

class RoleController extends Controller
{
    /**
     * 角色首页
     * @param        
     * @author        xezw211@gmail.com
     * @date        2016-04-19 14:25:42
     * @return        
     */
    public function index(){
        return view('backend.role.index');
    }

    /**
     * 角色 ng首页
     * @param        
     * @author        wen.zhou@bioon.com
     * @date        2016-04-19 14:23:35
     * @return        
     */
    public function ngIndex(){
        $createButton = RoleRepo::createButton();
        
        $jsVars = json_encode([
            'title' => trans('prompt.role.delete.before.title'),
            'text' => trans('prompt.role.delete.before.text'),
            'confirmButtonText' => trans('prompt.role.delete.before.confirm'),
            'cancelButtonText' => trans('prompt.role.delete.before.cancel'),
            'deleteSuccessTitle' => trans('prompt.role.delete.before.successTitle'),
            'deleteSuccessText' => trans('prompt.role.delete.before.successText'),
            'i18n' => route('admin.i18n'),
        ]);
        return view('backend.role.ngindex')->with(compact('createButton', 'jsVars'));
    }

    /**
     * admin ajax获取角色列表
     * @param        
     * @author      xezw211@gmail.com
     * @date        2016-04-19 14:25:56
     * @return      json
     */
    public function adminAjaxRoleList(){
        $returnData = RoleRepo::searchRoleList();

        return response()->json($returnData);
    }

    /**
     * 显示一个添加界面
     * @param        
     * @author      xezw211@gmail.com
     * @date        2016-04-19 14:32:09
     * @return      \Illuminate\Http\Response
     */
    public function create(){
        return view('backend.role.index');
    }

    public function ngCreate(){
        $jsVars = json_encode([
            'storeUrl' => route('admin.role.store'),
        ]);

        /*权限列表*/
        $permissions = PermissionRepo::bkPermissionList();

        return view('backend.role.ngcreate')->with(compact('jsVars', 'permissions'));
    }

    public function store(Request $request){
        $returnData = [
            'result' => false,
            'title' => trans('prompt.role.create.fail'),
            'text' => trans('prompt.role.create.text'),
            'confirm' => trans('prompt.role.create.confirm'),
            'cancel' => trans('prompt.role.create.cancel'),
            'indexUrlPath' => '/admin/role',
        ];

        $roleData = [
            'name' => request('name', ''),
            'slug' => request('slug', ''),
            'description' => request('description', ''),
            'level' => request('level', 100),
            'status' => request('status', config('backend.project.status.open')),
        ];

        $role = RoleRepo::createRole($roleData);

        if($role){
            /*添加角色权限*/
            $permissions = PermissionRepo::getPermissionsBySlug(request('permissions', []));
            event(new RoleAddPermissionEvent($role, $permissions));

            $returnData = [
                'result' => true,
                'title' => trans('prompt.role.create.success'),
                'text' => trans('prompt.role.create.text'),
                'confirm' => trans('prompt.role.create.confirm'),
                'cancel' => trans('prompt.role.create.cancel'),
                'indexUrlPath' => '/admin/role',
            ];
        }

        return response()->json($returnData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return view('backend.role.index');
    }

    public function ngEdit($id){
        if(empty($id)){
            abort(404);
        }
        
        /*权限列表*/
        $permissions = PermissionRepo::bkPermissionList();

        /*用户信息*/
        $roleInfo = RoleRepo::roleInfoById($id);
        $rolePermissionSlugs = PermissionRepo::rolePermissionSlugs($roleInfo);

        return view('backend.role.ngedit', compact('roles', 'permissions', 'roleInfo', 'userRoleSlugs', 'rolePermissionSlugs'));
    }

    /**
     * 用户角色信息
     * @param        
     * @author        xezw211@gmail.com
     * @date        2016-04-20 13:11:24
     * @return        
     */
    public function update(Request $request, $id){
        $roleData = [
            'name' => request('name', ''),
            'slug' => request('slug', ''),
            'description' => request('description', ''),
            'status' => request('status', config('backend.project.status.open')),
            'level' => request('level', 100),
        ];

        $role = RoleRepo::updateRole($id, $roleData);

        if($role){
            /*获取角色权限*/
            $permissions = PermissionRepo::getPermissionsBySlug(request('permissions', []));
            /*删除角色所有权限*/
            PermissionRepo::detachRolePermissions($role);
            event(new RoleAddPermissionEvent($role, $permissions));
            Flash::info('修改角色成功');
        }

        return redirect()->route('admin.role.index');
    }

    /**
     * 
     * @param        string     $id
     * @author        xezw211@gmail.com
     * @date        2016-04-20 11:35:59
     * @return        \Illuminate\Http\Response
     */
    public function destroy($id){
        return RoleRepo::deleteRole($id);
    }

    /**
     * 删除多个角色
     * @author        xezw211@gmail.com
     * @date        2016-04-20 11:43:57
     * @return        
     */
    public function deletes(){
        $ids = request('ids', []);
        return RoleRepo::deleteRoles($ids);
    }
}
