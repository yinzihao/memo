<?php
namespace app\index\control;
use dog\Control;
class Index extends Control{
	
	public function index(){
		$data = $this->db->select('select * from m_memo');	
		require VIEW_PATH.__FUNCTION__.'.php';
	}
}