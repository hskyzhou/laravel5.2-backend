<?php
	return [
		/*id是否加密*/
		'encrypt' => [
			'id' => true,
		],

		/*状态*/
		'status' => [
			'select' => 0,
			'open' => 1,
			'close' => 2,
		],

		/*删除控制*/
		'delete' => [
			'logic' => false, //执行逻辑删除，否则物理删除
		],

		/*分页默认配置*/
		'pagniate' => [
			'start' => 0,
			'length' => 10
		],
	];