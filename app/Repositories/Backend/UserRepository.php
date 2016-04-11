<?php
	namespace App\Repositories\Backend;

	use App\User;

	/*仓库*/
	use RoleRepo;
	use PermissionRepo;

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
						$data[$key]['status'] = $user->status == config('backend.project.status.open') ? trans('label.status.open') : trans('label.status.close');
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
	}