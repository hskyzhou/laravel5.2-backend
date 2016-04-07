<?php
	namespace App\Repositories\Backend;

	use App\Models\Role;

	class RoleRepository{
		
		/**
		 * 获取所有角色
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-07 15:59:58
		 * 
		 * @return		
		 */
		public function all(){
			return Role::all();
		}
	}