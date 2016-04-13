<?php 
	namespace App\Traits;

	use Hashids;

	Trait ModelTrait{
		private $buttonString;
		private $encrypt_id;

		public function getButtonString(){
			return $this->buttonString;
		}

		/**
		 * 添加按钮
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-10 21:33:12
		 * 
		 * @return		
		 */
		public function createButton($options = []){
			$defaultOptions = [
				'name' => '添加',
				'url' => route($this->type . '.create'),
				'class' => 'btn btn-success',
			];
			$options = array_merge($defaultOptions, $options);
			$this->buttonString .= "<a href='{$options['url']}' class='tooltips {$options['class']}' data-container='body' data-trigger='hover' data-placement='top' data-content='' data-original-title='{$options['name']}'>{$options['name']}</a>";
			return $this;
		}

		/**
		 * 修改按钮
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-11 16:25:09
		 * 
		 * @return		
		 */
		public function updateButton($options = []){
			$encrypt_id = $this->id;
			if(config('backend.project.encrypt.id')){
				$encrypt_id = Hashids::encode($encrypt_id);
			}
			$defaultOptions = [
				'name' => '修改',
				'url' => route($this->type . '.edit', [$encrypt_id]),
				'class' => 'btn btn-warning',
			];
			$options = array_merge($defaultOptions, $options);
			$this->buttonString .= "<a href='{$options['url']}' class='tooltips margin-bottom-5 {$options['class']}' data-container='body' data-trigger='hover' data-placement='top' data-content='' data-original-title='{$options['name']}'><i class='fa fa-edit'></i>{$options['name']}</a>";
			return $this;
		}

		/**
		 * 删除按钮
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-11 16:25:17
		 * 
		 * @return		
		 */
		public function deleteButton($options = []){
			$encrypt_id = $this->id;
			if(config('backend.project.encrypt.id')){
				$encrypt_id = Hashids::encode($encrypt_id);
			}
			$defaultOptions = [
				'name' => '删除',
				'url' => route($this->type . '.destroy', [$encrypt_id]),
				'class' => 'btn btn-danger',
			];
			$options = array_merge($defaultOptions, $options);
			$this->buttonString .= "<a data-url='{$options['url']}' class='tooltips margin-bottom-5 {$options['class']}' data-container='body' data-trigger='hover' data-placement='top' data-content='' data-original-title='{$options['name']}'><i class='fa fa-remove'></i>{$options['name']}</a>";
			return $this;
		}
	}