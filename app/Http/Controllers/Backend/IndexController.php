<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	/**
	 * 获取 jquery datatables 语言包
	 * 
	 * @param		
	 * 
	 * @author		wen.zhou@bioon.com
	 * 
	 * @date		2016-04-18 17:00:44
	 * 
	 * @return		
	 */
    public function i18n(){
    	return response()->json(trans('datatables.i18n'));
    }
}
