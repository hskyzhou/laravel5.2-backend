<?php
	namespace App\Traits;

	Trait FieldTrait{

		public function setStatusText(){
			$returnString = "";
			if($this->status == config('backend.project.status.open')){
				$returnString = "<span class='label label-success'>".trans('label.status.open') ."</span>";
			}else{
				$returnString = "<span class='label label-danger'>".trans('label.status.close')."</span>";
			}
			return $returnString;
		}
	}