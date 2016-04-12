<?php
	namespace App\Repositories\Backend;

	use App\User;

	/*仓库*/
	use RoleRepo;
	use PermissionRepo;
	/*第三方应用*/
	use Hashids;

	class UserRepository{
		
		/**
		 * ajax 获取用户列表
		 * 
		 * @param		
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
						$data[$key] = $user->toArray();
						$data[$key]['status'] = $user->status == config('backend.project.status.open') ? "<span class='label label-success'>".trans('label.status.open') ."</span>" : "<span class='label label-danger'>".trans('label.status.close')."</span>";
						$data[$key]['button'] = $user->updateButton()->deleteButton(['class' => 'btn btn-danger userdelete'])->getButtonString();
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
		 * @param		
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
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-12 10:12:29
		 * 
		 * @return		
		 */
		public function userinfoById($id, $create = true){
			if(config('backend.project.encrypt.id')){
			    $id = Hashids::decode($id);
			}

			$userInfo = User::where('id', $id)->first();

			if($userInfo && $create){
				if(config('backend.project.encrypt.id')){
					$userInfo->encrypt_id = Hashids::encode($userInfo->id);
				}
			}

			return $userInfo;
		}

		/**
		 * 修改用户信息		
		 * 
		 * @param		
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
		 * @param		
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
				'title' => trans('label.delete.user.title'),
				'message' => trans('label.delete.user.success'),
			];
			if(config('backend.project.delete.logic')){
				/*逻辑删除*/
				if(!$this->updateUser($id, ['status' => config('backend.project.status.close')])){
					$returnData['result'] = false;
					$returnData['title'] = trans('label.delete.user.title');
					$returnData['message'] = trans('label.delete.user.fail');
				}
			}else{
				/*物理删除*/
				$userInfo = $this->userinfoById($id);
				if($userInfo){	
					if(!$userInfo->delete()){
						$returnData['result'] = false;
						$returnData['title'] = trans('label.delete.user.title');
						$returnData['message'] = trans('label.delete.user.fail');
					}
				}
			}

			return $returnData;
		}
	}