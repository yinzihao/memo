<?php
/**
 * 配置信息
 */
return [	
	'mysql' => ['dbname' => 'memo','host' => '127.0.0.1','port' => '3306','username' => 'root','password' => 'mysql3033322'],
	'sphinx' => [
					'host' => '127.0.0.1','port' => '9312',
					'indexs' => ['memo' => 'test1']
				]
];