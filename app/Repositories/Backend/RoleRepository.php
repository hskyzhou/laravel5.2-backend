<?php
	namespace App\Repositories\Backend;

	use App\Models\Role;
	use App\Traits\RepositoryTrait;
	use DB;

	class RoleRepository{
		use RepositoryTrait;

		/**
		 * 创建角色
		 * @param		
		 * @author		xezw211@gmail.com
		 * @date		2016-04-20 11:11:59
		 * @return		
		 */
		public function createRole($roleData){
			$role = new Role;

			$role->fill($roleData)->save();

			if(!$role){
				\Log::info("用户添加失败\n");
			}

			return $role;
		}

		/**
		 * 生成添加按钮
		 * @param		
		 * @author		xezw211@gmail.com
		 * @date		2016-04-19 17:38:29
		 * @return		
		 */
		public function createButton(){
			$role = new Role;
			return $role->createButton()->getButtonString();
		}

		/**
		 * 搜索用户列表
		 * @param		
		 * @author		xezw211@gmail.com
		 * @date		2016-04-18 22:16:22
		 * @return		
		 */
		public function searchRoleList($searchData = []){
			$draw = $this->getFieldValue($searchData, 'draw');
			$name = $this->getFieldValue($searchData, 'name');
			$status = $this->getFieldValue($searchData, 'status');
			$created_at_from = $this->getFieldValue($searchData, 'created_at_from');
			$created_at_to = $this->getFieldValue($searchData, 'created_at_to');
			$start = $this->getFieldValue($searchData, 'start');
			$length = $this->getFieldValue($searchData, 'length');

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
				$roles = $role->offset($start)->limit($length)->get();
				if(!$roles->isEmpty()){
					foreach($roles as $key => $role){
						$data[$key] = $this->setEncryptId($role)->toArray();
						$data[$key]['status'] = $role->setStatusText();
						$data[$key]['button'] = $role->updateButton()->deleteButton(['class' => 'btn btn-danger infodelete'])->getButtonString();
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
		 * @param		
		 * @author		xezw211@gmail.com
		 * @date		2016-04-07 15:59:58
		 * @return		
		 */
		public function all(){
			return Role::all();
		}

		/**
		 * 通过slug获取角色
		 * @param		$roles   用户角色
		 * @author		xezw211@gmail.com
		 * @date		2016-04-09 09:45:23
		 * @return		
		 */
		public function getRolesBySlug($roles = []){
			return Role::whereIn('slug', $roles)->get();
		}

		/**
		 * 获取用户角色
		 * @param		$user   \App\User  
		 * @author		xezw211@gmail.com
		 * @date		2016-04-12 10:05:14
		 * @return		
		 */
		public function userRoles($user){
			return $user->getRoles();
		}

		/**
		 * 获取 用户角色的slug
		 * @param		$user   \App\User  
		 * @author		xezw211@gmail.com
		 * @date		2016-04-12 10:43:05
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
		 * @param		$user   \App\User  
		 * @author		xezw211@gmail.com
		 * @date		2016-04-13 11:06:18
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
		 * @param		$user   \App\User  
		 * @author		xezw211@gmail.com
		 * @date		2016-04-12 11:55:22
		 * @return		
		 */
		public function detachUserRoles($user){
			$user->detachAllRoles();
		}

		public function roleInfoById($id, $encodeBool = true, $decodeBool = true){
			$roleInfo = false;

			$id = $this->decodeEncryptId($id, $decodeBool);

			if(!empty($id)){
				$roleInfo = Role::where('id', $id)->first();
				$this->setEncryptId($roleInfo, $encodeBool);
			}

			return $roleInfo;
		}

		/**
		 * 删除角色
		 * @param		string 	$id
		 * @author		xezw211@gmail.com
		 * @date		2016-04-20 11:37:11
		 * @return		
		 */
		public function deleteRole($id){
			$returnData = [
				'result' => true,
				'title' => trans('prompt.role.delete.after.title'),
				'message' => trans('prompt.role.delete.after.success'),
			];

			if(config('backend.project.delete.logic')){
				/*逻辑删除*/
				if(!$this->updateUser($id, ['status' => config('backend.project.status.close')])){
					$returnData['result'] = false;
					$returnData['title'] = trans('prompt.role.delete.after.title');
					$returnData['message'] = trans('prompt.role.delete.after.fail');
				}
			}else{
				/*物理删除*/
				$userInfo = $this->roleInfoById($id);
				if($userInfo){	
					if(!$userInfo->delete()){
						$returnData['result'] = false;
						$returnData['title'] = trans('prompt.role.delete.after.title');
						$returnData['message'] = trans('prompt.role.delete.after.fail');
					}
				}else{
					$returnData['result'] = false;
					$returnData['title'] = trans('prompt.role.delete.after.title');
					$returnData['message'] = trans('prompt.role.delete.after.fail');
				}
			}

			return $returnData;
		}

		/**
		 * 删除多个角色
		 * @param		
		 * @author		xezw211@gmail.com
		 * @date		2016-04-20 11:44:25
		 * @return		
		 */
		public function deleteRoles($ids){
			$deleteInfo = [
				'result' => true,
				'title' => trans('prompt.user.delete.after.title'),
				'message' => trans('prompt.user.delete.after.success'),
			];

			if(!empty($ids) && is_array($ids)){
				DB::beginTransaction();
				foreach($ids as $id){
					$deleteInfo = $this->deleteRole($id);
					if(!$deleteInfo['result']){
						DB::rollBack();
						break;
					}
				}
				DB::commit();
			}

			return $deleteInfo;
		}

		/**
		 * 修改用户角色
		 * @param		string  $id
		 * @param 		array   $roleData
		 * @author		xezw211@gmail.com
		 * @date		2016-04-20 13:16:26
		 * @return		
		 */
		public function updateRole($id, $roleData){
			$roleInfo = $this->roleInfoById($id, false);

			if($roleInfo){
				$roleInfo->fill($roleData)->push();
			}else{
				\Log::info('更新用户失败');
			}

			return $roleInfo;
		}
	}