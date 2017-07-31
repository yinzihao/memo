<?php
namespace dog\library;

/**
 * 框架自动加载类
 * autoload,exception
 * @author Frank
 *
 */
class Loader{
	
	/**
	 * 加载类
	 * @param string $class
	 */
	public static function autoload($class){
		spl_autoload_register(function($class){
			if($class){
				$file = str_replace('\\', '/', $class);
				$file .= '.php';
		
				if(file_exists($file)) include $file;
			}
		});
	}
	
	/**
	 * spl_autoload_register 
	 * exception_register
	 * @param string $autoload
	 */
	public static function register($autoload = ''){
		set_error_handler('\dog\exception\DogException::handle_error');
		set_exception_handler('\dog\exception\DogException::handle_exception');
		register_shutdown_function('\dog\exception\DogException::handle_fatal_error');
		spl_autoload_register($autoload?:'\dog\library\Loader::autoload');
	}
}