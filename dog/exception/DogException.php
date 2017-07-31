<?php
namespace dog\exception;

/**
 * 框架异常类
 * @author Frank
 *
 */
class DogException {
	
	/**
	 * set_error_handler
	 * 设置一个用户的函数(error_handler)来处理脚本中出现的错误
	 * 以下级别的错误不能由用户定义的函数来处理： E_ERROR、 E_PARSE、 E_CORE_ERROR、 E_CORE_WARNING、 E_COMPILE_ERROR、 E_COMPILE_WARNING，和在 调用 set_error_handler() 函数所在文件中产生的大多数 E_STRICT。 
	 * 如果错误发生在脚本执行之前（比如文件上传时），将不会 调用自定义的错误处理程序因为它尚未在那时注册。 
	 */
	public static function handle_error($err_no = 0, $err_msg = '', $err_file = '', $err_line = 0){
		$log = [
				'['.date('Y-m-d H:i:s').']',
				'|',$err_no,
				'|',$err_msg,
				'|',$err_file,
				'|',$err_line
		];
		file_put_contents(RUNTIME_PATH.'error_'.date('Y-m-d').'.log', json_encode($log).PHP_EOL,FILE_APPEND);
	}
	
	/**
	 * register_shutdown_function — 注册一个会在php中止时执行的函数
	 * 注册一个 callback ，它会在脚本执行完成或者 exit() 后被调用。
	 * 可以多次调用 register_shutdown_function() ，这些被注册的回调会按照他们注册时的顺序被依次调用。 如果你在注册的方法内部调用 exit()， 那么所有处理会被中止，并且其他注册的中止回调也不会再被调用。
	 */
	public static function handle_fatal_error(){
		$e = error_get_last();
		self::handle_error($e['type'], $e['message'], $e['file'], $e['line']);
		/**
		 * 异常分类处理 coding...
		 * switch ($e['type']) {
			case E_ERROR: //E_NOTICE...
				errorHandler($e['type'], $e['message'], $e['file'], $e['line']);
				break;
		}
		 */
	}
	
	/**
	 * set_exception_handler
	 * 设置默认的异常处理程序，用于没有用 try/catch 块来捕获的异常。 在 exception_handler 调用后异常会中止。 
	 */
	public static function handle_exception($excetion){
		self::handle_error('999', $excetion->getMessage(), $excetion->getFile(), $excetion->getLine());
	}
}