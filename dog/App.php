<?php
namespace dog;

/**
 * 框架入库应用处理
 * @author Frank
 *
 */
class App{
	
	/**
	 * 初始化加载配置数据
	 */
	public static function init_load(){
		//根据环境、加载配置信息 --start
		require CONFIG_PATH.'config_env.php';
		Config::init(require_once CONFIG_PATH.ENV.'/config.php');
		//根据环境、加载配置信息 --end
	}
	
	public static function run(){
		//加载应用/控制器/方法
		
		/**
		 * 获取url info 地址  
		 * 例如：http://www.project.com/index.php/index/index/run?id=1
		 * 只会获取/index/index/run 这一截 
		 * 如果是uri的方式获取就是/index.php/index/index/run?id=1
		 */
		$uri = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'';
		$uri_array = explode('/', $uri);
		
		$app_name = !empty($uri_array[1])?$uri_array[1]:'index';
		$control_name = !empty($uri_array[2])?$uri_array[2]:'index';
		$control_name = ucwords($control_name);//兼容Windows & Linux(文件名区分大小写)
		$method_name = !empty($uri_array[3])?$uri_array[3]:'index';
		
		$class_r = new \ReflectionClass("\\app\\$app_name\\control\\".$control_name);
		$control = $class_r->newInstance();
		if(!$class_r->hasMethod($method_name)) echo "Method:: $method_name not found";
		$method = $class_r->getMethod($method_name);
		echo $method->invoke($control);exit;
	}
}