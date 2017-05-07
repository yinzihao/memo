<?php
namespace dog\db;

class Db
{
	private $host = null;
	private $username = null;
	private $password = null;
	private $port = null;
	private $dbname = null;
	
	public static $db_con = null;
	
	public function __construct($host = '127.0.0.1',$username = 'root',$password = 'root',$dbname = 'memory',$port=3306)
	{
		if(!self::$db_con){
			self::$db_con = mysqli_connect($host,$username,$password,$dbname,$port);
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