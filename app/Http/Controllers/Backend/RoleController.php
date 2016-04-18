<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(){
    	return view('backend.role.index');
    }

    
    public function ngIndex(){
    	return view('backend.role.ngindex');
    }
}
