<?php
namespace app\sso\control;
use dog\Control;
class Login extends Control{
	
	public function index(){
		if(isset($_SESSION['name'])){
			return "Your name is ".$_SESSION['name'];
		}
		return 'Please login';
	}
	
	public function login(){
		$name = $this->get_value('name');
		if($name == 'admin'){
			$_SESSION['name'] = $name;
			return 'login success';
		}
		return 'login error';
	}
}