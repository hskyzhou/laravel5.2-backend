<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/*仓库*/
use RoleRepo;

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
        JavaScript::put([
            'index' => [
                'title' => trans('prompt.role.delete.before.title'),
                'text' => trans('prompt.role.delete.before.text'),
                'confirmButtonText' => trans('prompt.role.delete.before.confirm'),
                'cancelButtonText' => trans('prompt.role.delete.before.cancel'),
                'deleteSuccessTitle' => trans('prompt.role.delete.before.successTitle'),
                'deleteSuccessText' => trans('prompt.role.delete.before.successText'),
                'i18n' => route('admin.i18n'),
            ]
        ]);
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
        return view('backend.role.ngindex')->with(compact('createButton'));
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
    public function create()
    {
        return view('backend.role.index');
    }

    public function ngCreate(){
        return view('backend.role.ngcreate');
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
