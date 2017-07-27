<?php
/**
 * 配置信息
 */
return [	
	'mysql' => ['dbname' => 'memo','host' => '127.0.0.1','port' => 3306,'username' => 'root','password' => ''],
	'sphinx' => [
					'host' => '54.254.217.92','port' => 9312,
				 	'indexs' => ['memo' => 'test1']
				]
];