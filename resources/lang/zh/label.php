<?php
	return [
		'action' => '操作',

		'menu' => '菜单',
		'user' => '用户',
		'role' => '角色',
		
		'button' => [
			'add' => '添加',
			'delete' => '删除',
		],


		'status' => [
			'select' => '选择',
			'open' => '开启',
			'close' => '禁止'
		],

		'prompt' => [
			'user' => [
				'create' => [
					'success' => '添加用户成功',
					'fail' => '添加用户失败',
					'text' => '是否继续添加用户',
					'confirm' => '继续添加用户',
					'cancel' => '返回用户列表',
				],
				'delete' => [
					'before' => [
						'title' => "您确定要删除吗?",
						'text' => "删除之后将不能还原!",
						'confirm' => "确定",
			            'cancel' => "取消",
			            'successTitle' => '删除成功!',
			            'successText' => '',
					],
					'after' => [
						'title' => '删除完成',
						'success' => '删除用户成功',
						'fail' => '删除用户失败',
					]

				],
			],
		],
	];