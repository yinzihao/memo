<?php 
namespace dog\db;
use dog\Config;
class Db
{
	private $host = null;
	private $username = null;
	private $password = null;
	private $port = null;
	private $dbname = null;
	
	public static $db_con = null;
	
	public function __construct($host = '',$username = '',$password = '',$dbname = '',$port='')
	{
		if(!self::$db_con){
			if(empty($host)) $host = Config::get('mysql.host');
			if(empty($port)) $port = Config::get('mysql.port');
			if(empty($username)) $username = Config::get('mysql.username');
			if(empty($password)) $password = Config::get('mysql.password');
			if(empty($dbname)) $dbname = Config::get('mysql.dbname');
			self::$db_con = mysqli_connect($host,$username,$password,$dbname,$port);
			mysqli_set_charset(self::$db_con, "utf8");
			if (mysqli_connect_errno(self::$db_con)){
				throw new \Exception("连接 MySQL 失败: " . mysqli_connect_error());	
			}
		}
	}
	
	public function select($sql)
	{
		$result = mysqli_query(self::$db_con,$sql);
		$data = [];
		while ($row = mysqli_fetch_assoc($result)){
			$data[] = $row;
  		}
		return $data;
	}
	
	public function find($sql)
	{
		$result = mysqli_query(self::$db_con,$sql);
		return mysqli_fetch_assoc($result);
	}
	
	public function delte($table,$where){
		$sql = "delete from %s where %s";
		$sql = sprintf($sql,$table,$where);
		mysqli_query(self::$db_con, $sql);
	}
	
	public function update($table,$data,$where){
		$sql = "update %s set %s where %s";
		
		$sets = '';
		foreach ($data as $key => $value){
			$sets.=",$key = '$value'";
		}
		
		if(!empty($sets))
			$sets = substr($sets, 1,strlen($sets));
		
		$sql = sprintf($sql,$table,$sets,$where);
		mysqli_query(self::$db_con, $sql);
	}
	
	public function insert($table,$data){
		$sql = "insert into $table(%s) values(%s)";
		$files = '';
		$values = '';
	
		foreach ($data as $key => $value){
			$files.=','.$key;
			$values.=",'$value'";
		}
		if(!empty($files))
			$files = substr($files, 1,strlen($files));
		
		if(!empty($values))
			$values = substr($values, 1,strlen($values));
		
		$sql = sprintf($sql,$files,$values);
		mysqli_query(self::$db_con, $sql);
		return mysqli_insert_id(self::$db_con);
	}
}