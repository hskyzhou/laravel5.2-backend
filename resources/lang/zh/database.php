<?php
	return [
		/*用户*/
		'user' => [
			'id' => '序号',
			'name' => '昵称',
			'email' => '邮箱',
			'password' => '密码',
			'status' => '状态',
			'created_at' => '创建时间',
			'updated_at' => '修改时间',
			'role' => '角色',
			'permission' => '权限',
		],

		/*角色*/
		'role' => [
			'id' => '序号',
			'name' => '角色',
			'slug' => '角色标识',
			'description' => '描述',
			'level' => '级别',
			'created_at' => '创建时间',
			'updated_at' => '修改时间',
			'status' => '状态',
			'help' => [
				'level' => '级别越小,角色权限越大'
			]
		]
	];