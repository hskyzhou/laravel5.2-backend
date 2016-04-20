<?php
	namespace App\Traits;

	use Hashids;

	Trait RepositoryTrait{
		/*===========================================私有方法========================*/
		/**
		 * 加密id
		 * 
		 * @param		$info  需要加密字段的对象
		 * @param       $encodeBool    获取的用户对象是否增加加密id
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-13 16:21:55
		 * 
		 * @return		
		 */
		private function setEncryptId($info, $encodeBool = true){
			if($info && $encodeBool){
				if(config('backend.project.encrypt.id')){
					$info->encrypt_id = Hashids::encode($info->id);
				}
			}
			return $info;
		}

		/**
		 * 解密id
		 * 
		 * @param		$id    被加密的id
		 * @param       decodeBool  对用户的id是否需要解密
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-13 16:21:47
		 * 
		 * @return		
		 */
		private function decodeEncryptId($id, $decodeBool = true){
			if(config('backend.project.encrypt.id') && $decodeBool){
			    $id = Hashids::decode($id);
			    if(!empty($id)){
			    	$id = $id[0];
			    }
			}
			return $id;
		}

		/**
		 * 自动获取字段值
		 * @param		
		 * @author		xezw211@gmail.com
		 * @date		2016-04-20 17:13:35
		 * @return		
		 */
		private function getFieldValue($arr, $key){
			return (isset($arr[$key]) && !empty($arr[$key])) ? $arr[$key] : request($key, '');
		}
	}