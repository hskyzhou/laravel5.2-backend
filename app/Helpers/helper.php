<?php
	use Carbon\Carbon;

	if(!function_exists('datetimeDeal')){
		/**
		 * 判断时间是否需要加上时分秒
		 * 
		 * @param		
		 * 
		 * @author		xezw211@gmail.com
		 * 
		 * @date		2016-04-06 17:22:52
		 * 
		 * @return		
		 */
		function datetimeDeal($timeString, $isStart = true){
			$cb = new Carbon($timeString);
			if($isStart){
				return $cb->startOfDay()->toDateTimeString();
			}else{
				return $cb->endOfDay()->toDateTimeString();
			}
		}
	}

	if(!function_exists('sprintfArr')){
		function sprintfArr($arr, $template = ''){
			foreach($arr as $key => $val){
				
				
			}
		}
	}