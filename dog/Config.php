<?php
namespace dog;

/**
 * 框架入库应用处理
 * @author Frank
 *
 */
class Config {
	
	private static $config_array = [];
	private static $config_history = [];//历史记录,如有直接提取
	
	/**
	 * 加载配置文件,外部调用(根据开发环境获取数据)
	 * @param array $config_array
	 */
	public static function init($config_array){
		if(empty(self::$config_array)){
			self::$config_array = $config_array;
		}
	}
	
	/**
	 * 获取配置信息
	 * @param string $config_key
	 */
	public static function get($config_key){
		if(empty($config_key)) throw new \Exception('Param is empty');
		if(isset(self::$config_history[$config_key])) {
			return self::$config_history[$config_key];
		}
		$config_key_array = explode('.', $config_key);
		$config_data = self::$config_array;
		foreach ($config_key_array as $value){
			if(!isset($config_data[$value])){
				throw new \Exception("No found kes is $config_key in config file");
			}
			$config_data = $config_data[$value];
		}
		return $config_data;
	}
}