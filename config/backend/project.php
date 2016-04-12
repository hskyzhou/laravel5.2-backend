<?php
	return [
		'encrypt' => [
			'id' => true,
		],

		'status' => [
			'select' => 0,
			'open' => 1,
			'close' => 2,
		],

		'delete' => [
			'logic' => false, //执行逻辑删除，否则物理删除
		],
	];