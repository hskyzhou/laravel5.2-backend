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

		/**
		 * 获取用户角色
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-12 10:05:14
		 * 
		 * @return		
		 */
		public function userRoles($user){
			return $user->getRoles();
		}

		/**
		 * 获取 用户角色的slug
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-12 10:43:05
		 * 
		 * @return		
		 */
		public function userRoleSlugs($user){
			$userRoleSlugs = [];

			$userRoles = $this->userRoles($user);

			if(!$userRoles->isEmpty()){
				$userRoleSlugs = $userRoles->keyBy('slug')->keys()->toArray();
			}

			return $userRoleSlugs;
		}

		/**
		 * 删除用户 所有角色
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-12 11:55:22
		 * 
		 * @return		
		 */
		public function detachUserRoles($user){
			$user->detachAllRoles();
		}
	}