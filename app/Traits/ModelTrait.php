<?php 
	namespace App\Traits;

	Trait ModelTrait{
		private $buttonString;

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
		 * @date		2016-04-11 16:24:59
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
			$this->buttonString .= "<a href='{$options['url']}' class='{$options['class']}'>{$options['name']}</a>";
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
			$defaultOptions = [
				'name' => '修改',
				'url' => route($this->type . '.edit', [$this->id]),
				'class' => 'btn btn-warning',
			];
			$options = array_merge($defaultOptions, $options);
			$this->buttonString .= "<a href='{$options['url']}' class='{$options['class']}'>{$options['name']}</a>";
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
			$defaultOptions = [
				'name' => '删除',
				'url' => route($this->type . '.destroy', [$this->id]),
				'class' => 'btn btn-danger',
			];
			$options = array_merge($defaultOptions, $options);
			$this->buttonString .= "<a href='{$options['url']}' class='{$options['class']}'>{$options['name']}</a>";
			return $this;
		}
	}