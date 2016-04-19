<?php
	return [
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

		'role' => [
			'create' => [
				'success' => '添加角色成功',
				'fail' => '添加角色失败',
				'text' => '是否继续添加角色',
				'confirm' => '继续添加角色',
				'cancel' => '返回角色列表',
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
					'success' => '删除角色成功',
					'fail' => '删除角色失败',
				]

			],
		],
	];