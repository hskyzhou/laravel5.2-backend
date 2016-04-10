<?php 
	namespace App\Traits;

	Trait ModelTrait{
		public $buttonString;
		protected $options = [
			
		];
		public $templateString = "<a href='%s' class='%s'>%s</a>";
		public $createTemplateString = "<a href='%s' class='%s'>%s</a>";
		public $updateTemplateString = "<a href='%s' class='%s'>%s</a>";
		public $deleteTemplateString = "<a href='%s' class='%s'>%s</a>";

		/*添加按钮*/
		public function createButton($name = '添加', $url = '', $options = ['class' => 'btn btn-success']){
			if(empty($url)){
				$url = route("{$this->type}.create");
			}
			$this->buttonString .= sprintf($this->createTemplateString, $url, $options['class'], $name);
		}

		/**
		 * 修改按钮
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-10 21:33:12
		 * 
		 * @return		
		 */
		public function updateButton($name = '修改', $url = '', $options = ['class' => 'btn btn-success']){
			if(empty($url)){
				$url = url($this->type . 'update');
			}
			$this->buttonString .= sprintf($this->updateTemplateString, $url, $options['class'], $name);
			return $this;
		}

		/**
		 * 删除按钮
		 * 
		 * @param		
		 * 
		 * @author		wen.zhou@bioon.com
		 * 
		 * @date		2016-04-10 21:34:52
		 * 
		 * @return		
		 */
		public function deleteButton($name = '删除', $url = '', $options = ['class' => 'btn btn-success']){
			if(empty($url)){
				$url = url($this->type . 'delete');
			}
			$this->buttonString .= sprintf($this->deleteTemplateString, $url, $options['class'], $name);
			return $this;
		}
		

		public function getButtonString(){
			return $this->buttonString;
		}
	}