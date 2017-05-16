<?php
namespace app\index\control;
use dog\Control;
use dog\db\Db;
class Base extends Control
{
	private $assign_arr = [];
	protected function assign($key,$value)
	{
		$this->assign_arr[$key] = $value;
	}
	protected function view($function)
	{
		extract($this->assign_arr);
		require VIEW_PATH.'index/'.$function.'.php';
	}
		
}