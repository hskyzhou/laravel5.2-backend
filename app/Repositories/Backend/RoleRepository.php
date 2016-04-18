<?php
	namespace App\Repositories\Backend;

	use App\Models\Role;
	use App\Traits\RepositoryTrait;

	class RoleRepository{
		use RepositoryTrait;
		/**
		 * 搜索用户列表
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-18 22:16:22
		 * 
		 * @return		
		 */
		public function searchRoleList(){
			$draw = (isset($searchData['draw']) && !empty($searchData['draw'])) ? $searchData['draw'] : request('draw', '');
			$name = (isset($searchData['name']) && !empty($searchData['name'])) ? $searchData['name'] : request('name', '');
			$status = (isset($searchData['status']) && !empty($searchData['status'])) ? $searchData['status'] : request('status', '');
			$created_at_from = (isset($searchData['created_at_from']) && !empty($searchData['created_at_from'])) ? $searchData['created_at_from'] : request('created_at_from', '');
			$created_at_to = (isset($searchData['created_at_to']) && !empty($searchData['created_at_to'])) ? $searchData['created_at_to'] : request('created_at_to', '');

			$returnData = [
				'draw' => $draw,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				'data' => [],
			];

			$role = new Role;

			if(!empty($name)){
				$role = $role->where('name', $name);	
			}

			if(!empty($status)){
				$role = $role->where('status', $status);
			}

			if(!empty($created_at_from)){
				$created_at_from = datetimeDeal($created_at_from, true);
				$role = $role->where('created_at', '>=', $created_at_from);
			}

			if(!empty($created_at_to)){
				$created_at_to = datetimeDeal($created_at_to, true);
				$role = $role->where('created_at', '<=', $created_at_to);
			}

			$count = $role->count();

			if($count){
				/*用户数据处理*/
				$data = [];
				$roles = $role->get();
				if(!$roles->isEmpty()){
					foreach($roles as $key => $role){
						$data[$key] = $this->setEncryptId($role)->toArray();
						$data[$key]['status'] = $role->status == config('backend.project.status.open') ? "<span class='label label-success'>".trans('label.status.open') ."</span>" : "<span class='label label-danger'>".trans('label.status.close')."</span>";
						$data[$key]['button'] = $role->updateButton()->deleteButton(['class' => 'btn btn-danger userdelete'])->getButtonString();
					}
				}

				$returnData['recordsTotal'] = $count;
				$returnData['recordsFiltered'] = $count;
				$returnData['data'] = $data;
			}

			return $returnData;
		}
		
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
		 * @param		$roles   用户角色
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
		 * @param		$user   \App\User  
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
		 * @param		$user   \App\User  
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
		 * 获取 用户角色名称
		 * 
		 * @param		$user   \App\User  
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-13 11:06:18
		 * 
		 * @return		
		 */
		public function userRoleNames($user){
			$userRoleSlugs = [];

			$userRoles = $this->userRoles($user);

			if(!$userRoles->isEmpty()){
				$userRoleSlugs = $userRoles->keyBy('name')->keys()->toArray();
			}

			return $userRoleSlugs;
		}

		/**
		 * 删除用户 所有角色
		 * 
		 * @param		$user   \App\User  
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