<?php
namespace app\memo\control;
use dog\Control;
use dog\db\Db;
class Index extends Base{
	
	public function index(){
		header("location: /index.php/memo/admin/index");exit;
	}
}