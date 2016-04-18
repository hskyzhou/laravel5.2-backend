<?php
	namespace App\Repositories\Backend;

	use App\User;

	/*仓库*/
	use RoleRepo;
	use PermissionRepo;
	/*第三方应用*/
	use Hashids, DB;
	
	use App\Traits\RepositoryTrait;

	class UserRepository{
		use RepositoryTrait;
		
		/**
		 * ajax 获取用户列表
		 * 
		 * @param		$searchData     数组
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-06 17:33:38
		 * 
		 * @return		
		 */
		public function searchUserList($searchData = []){
			$draw = (isset($searchData['draw']) && !empty($searchData['draw'])) ? $searchData['draw'] : request('draw', '');
			$name = (isset($searchData['name']) && !empty($searchData['name'])) ? $searchData['name'] : request('name', '');
			$email = (isset($searchData['email']) && !empty($searchData['email'])) ? $searchData['email'] : request('email', '');
			$status = (isset($searchData['status']) && !empty($searchData['status'])) ? $searchData['status'] : request('status', '');
			$created_at_from = (isset($searchData['created_at_from']) && !empty($searchData['created_at_from'])) ? $searchData['created_at_from'] : request('created_at_from', '');
			$created_at_to = (isset($searchData['created_at_to']) && !empty($searchData['created_at_to'])) ? $searchData['created_at_to'] : request('created_at_to', '');
			$updated_at_from = (isset($searchData['updated_at_from']) && !empty($searchData['updated_at_from'])) ? $searchData['updated_at_from'] : request('updated_at_from', '');
			$updated_at_to = (isset($searchData['updated_at_to']) && !empty($searchData['updated_at_to'])) ? $searchData['updated_at_to'] : request('updated_at_to', '');

			$returnData = [
				'draw' => $draw,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				'data' => [],
			];

			$user = new User;

			if(!empty($name)){
				$user = $user->where('name', $name);	
			}

			if(!empty($email)){
				$user = $user->where('email', $email);
			}

			if(!empty($status)){
				$user = $user->where('status', $status);
			}

			if(!empty($created_at_from)){
				$created_at_from = datetimeDeal($created_at_from, true);
				$user = $user->where('created_at', '>=', $created_at_from);
			}

			if(!empty($created_at_to)){
				$created_at_to = datetimeDeal($created_at_to, true);
				$user = $user->where('created_at', '<=', $created_at_to);
			}

			if(!empty($updated_at_from)){
				$updated_at_from = datetimeDeal($updated_at_from, true);
				$user = $user->where('updated_at', '>=', $updated_at_from);
			}

			if(!empty($updated_at_to)){
				$updated_at_to = datetimeDeal($updated_at_to, true);
				$user = $user->where('updated_at', '<=', $updated_at_to);
			}

			$count = $user->count();

			if($count){
				/*用户数据处理*/
				$data = [];
				$users = $user->get();
				if(!$users->isEmpty()){
					foreach($users as $key => $user){
						$data[$key] = $this->setEncryptId($user)->toArray();
						$data[$key]['status'] = $user->status == config('backend.project.status.open') ? "<span class='label label-success'>".trans('label.status.open') ."</span>" : "<span class='label label-danger'>".trans('label.status.close')."</span>";
						$data[$key]['roles'] = '';
						$data[$key]['permissions'] = '';
						$data[$key]['button'] = $user->updateButton()->deleteButton(['class' => 'btn btn-danger userdelete'])->getButtonString();

						$roles = RoleRepo::userRoles($user);
						if($roles && !$roles->isEmpty()){
							foreach($roles as $role){
								$rolePermissionNames = PermissionRepo::rolePermissionName($role);
								$rolePermissionsBody = implode("<br />", $rolePermissionNames);
								$rolePermissionsTitle = $role->name;

								$data[$key]['roles'] .= "<button class='btn grey-mint popovers margin-bottom-5' data-container='body' data-trigger='hover' data-placement='right' data-content='{$rolePermissionsBody}' data-original-title='{$rolePermissionsTitle}'>{$rolePermissionsTitle}</button>";
							}
						}

						$permissions = PermissionRepo::userAllPermissionKeys($user, 'name');
						if($permissions){
							$permission_body = implode("<br />", $permissions);
							$permission_title  = trans('database.user.permission');
							$data[$key]['permissions'] = "<button class='btn grey-mint popovers margin-bottom-5' data-container='body' data-trigger='hover' data-placement='right' data-content='{$permission_body}' data-original-title='{$permission_title}'>{$permission_title}</button>";


						}
					}
				}

				$returnData['recordsTotal'] = $count;
				$returnData['recordsFiltered'] = $count;
				$returnData['data'] = $data;
			}

			return $returnData;
		}

		/**
		 * 创建用户
		 * 
		 * @param		$userData     需要创建的用户信息
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-09 09:36:53
		 * 
		 * @return		
		 */
		public function createUser($userData){
			
			$user = new User;

			$user->fill($userData)->save();

			if(!$user){
				\Log::info("用户添加失败\n");
			}

			return $user;
		}

		/**
		 * 通过用户id 获取用户信息		
		 * 
		 * @param		id  获取用户的id
		 * @param 		encodeBool  获取的用户对象是否增加加密id
		 * @param 		decodeBool  对用户的id是否需要解密
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-12 10:12:29
		 * 
		 * @return		
		 */
		public function userinfoById($id, $encodeBool = true, $decodeBool = true){
			$userInfo = false;

			$id = $this->decodeEncryptId($id, $decodeBool);

			if(!empty($id)){
				$userInfo = User::where('id', $id)->first();
				$this->setEncryptId($userInfo, $encodeBool);
			}

			return $userInfo;
		}

		/**
		 * 修改用户信息		
		 * 
		 * @param		$id   用户id
		 * @param       $userData    用户数据
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-12 11:31:05
		 * 
		 * @return		
		 */
		public function updateUser($id, $userData){
			$userInfo = $this->userinfoById($id, false);

			if($userInfo){
				$userInfo->fill($userData)->push();
			}else{
				\Log::info('更新用户失败');
			}

			return $userInfo;
		}

		/**
		 * 删除用户
		 * 
		 * @param		$id   用户id
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-12 15:03:02
		 * 
		 * @return		
		 */
		public function deleteUser($id){
			$returnData = [
				'result' => true,
				'title' => trans('label.prompt.user.delete.after.title'),
				'message' => trans('label.prompt.user.delete.after.success'),
			];
			if(config('backend.project.delete.logic')){
				/*逻辑删除*/
				if(!$this->updateUser($id, ['status' => config('backend.project.status.close')])){
					$returnData['result'] = false;
					$returnData['title'] = trans('label.prompt.user.delete.after.title');
					$returnData['message'] = trans('label.prompt.user.delete.after.fail');
				}
			}else{
				/*物理删除*/
				$userInfo = $this->userinfoById($id);
				if($userInfo){	
					if(!$userInfo->delete()){
						$returnData['result'] = false;
						$returnData['title'] = trans('label.prompt.user.delete.after.title');
						$returnData['message'] = trans('label.prompt.user.delete.after.fail');
					}
				}else{
					$returnData['result'] = false;
					$returnData['title'] = trans('label.prompt.user.delete.after.title');
					$returnData['message'] = trans('label.prompt.user.delete.after.fail');
				}
			}

			return $returnData;
		}

		/**
		 * 删除多个用户
		 * 
		 * @param		$ids    数组ids
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-13 15:36:04
		 * 
		 * @return		
		 */
		public function deleteUsers($ids){
			$deleteInfo = [
				'result' => true,
				'title' => trans('label.prompt.user.delete.after.title'),
				'message' => trans('label.prompt.user.delete.after.success'),
			];

			if(!empty($ids) && is_array($ids)){
				DB::beginTransaction();
				foreach($ids as $id){
					$deleteInfo = $this->deleteUser($id);
					if(!$deleteInfo['result']){
						DB::rollBack();
						break;
					}
				}
				DB::commit();
			}

			return $deleteInfo;
		}
	}