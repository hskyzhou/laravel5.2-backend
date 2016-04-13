<?php
	namespace App\Repositories\Backend;

	use App\Models\Permission;

	class PermissionRepository{
		
		/*==========================================后台调用=================================*/
		/**
		 * 获取权限列表 -- 按照 . 划分
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-07 16:38:58
		 * 
		 * @return		
		 */
		public function bkPermissionList(){
			/*获取 所有 权限*/
			$permissions = $this->all();  

			$returnArr = [];
			if($permissions){
				foreach($permissions as $permission){
					array_set($returnArr, $permission->slug, [
							'value' => $permission->slug, 
							'name' => $permission->name,
							'end' => true
						]
					);
				}
			}

			return $returnArr;
		}


		/*=======================================公共方法===================================*/
		/**
		 * 获取所有权限
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-07 16:00:07
		 * 
		 * @return		
		 */
		public function all(){
			return Permission::all();
		}

		/**
		 * 通过slug 获取权限
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-09 09:48:39
		 * 
		 * @return		
		 */
		public function getPermissionsBySlug($permissions = []){
			return Permission::whereIn('slug', $permissions)->get();
		}

		/**
		 * 获取用户单独权限
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-12 10:05:09
		 * 
		 * @return		
		 */
		public function userPermissions($user){
			return $user->userPermissions()->get();
		}

		/**
		 * 获取 用户单独权限的slug
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-12 10:54:18
		 * 
		 * @return		
		 */
		public function userPermissionSlugs($user){
			$userPermissionSlugs = [];

			$userPermissions = $this->userPermissions($user);
			
			if(!$userPermissions->isEmpty()){
				$userPermissionSlugs = $userPermissions->keyBy('slug')->keys()->toArray();
			}

			return $userPermissionSlugs;
		}

		/**
		 * 获取 角色权限
		 * 
		 * @param		
		 * 
		 * @author		wen.zhou@bioon.com
		 * 
		 * @date		2016-04-13 13:57:22
		 * 
		 * @return		
		 */
		public function rolePermissions($role){
			return $role->permissions()->get();
		}

		/**
		 * 获取角色权限的名称
		 * 
		 * @param		
		 * 
		 * @author		wen.zhou@bioon.com
		 * 
		 * @date		2016-04-13 13:58:19
		 * 
		 * @return		
		 */
		public function rolePermissionName($role){
			$rolePermissionNames = [];

			$rolePermissions = $this->rolePermissions($role);

			if(!$rolePermissions->isEmpty()){
				$rolePermissionNames = $rolePermissions->keyBy('name')->keys()->toArray();
			}

			return $rolePermissionNames;

		}

		/**
		 * 获取 用户所有权限
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-13 11:11:13
		 * 
		 * @return		
		 */
		public function userAllPermissions($user){
			return $user->getPermissions();
		}

		/**
		 * 获取用户所有权限的name
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-13 11:11:55
		 * 
		 * @return		
		 */
		public function userAllPermissionKeys($user, $key = 'name'){
			$userAllPermissionSlugs = [];

			$userPermissions = $this->userAllPermissions($user);
			
			if(!$userPermissions->isEmpty()){
				$userAllPermissionSlugs = $userPermissions->keyBy($key)->keys()->toArray();
			}

			return $userAllPermissionSlugs;
		}
		
		

		/**
		 * 删除用户所有权限
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-12 11:56:39
		 * 
		 * @return		
		 */
		public function detachUserPermissions($user){
			$user->detachAllPermissions();
		}
	}