<?php
namespace dog;
use dog\db\Db;
class Control{
	public $db =  null;
	public $request = [];
	private $_request = [];
	public function __construct(){
		$this->db = new Db();
		$this->request = $_REQUEST;
		$this->_request = $_REQUEST;
	}
	
	protected  function get_value($key){
		if(!isset($this->_request[$key])) 
			return null;
		return $this->_request[$key];
	}
	
	protected  function exist_key($key){
		if(!isset($this->_request[$key])) return false;
		return true;
	}
	
}