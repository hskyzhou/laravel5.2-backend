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

		/**
		 * 通过slug获取角色
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-09 09:45:23
		 * 
		 * @return		
		 */
		public function getRolesBySlug($roles = []){
			return Role::whereIn('slug', $roles)->get();
		}
	}