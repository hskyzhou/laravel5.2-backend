<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/*仓库*/
use UserRepo;

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

}
