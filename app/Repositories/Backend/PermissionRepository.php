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
	}