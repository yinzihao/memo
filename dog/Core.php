<?php
/**
 * 框架核心初始化
 * @author Frank
 * 
 */
define('DS', DIRECTORY_SEPARATOR);
define('DOG_PATH', __DIR__.DS);
define('LIBRARY_PATH', __DIR__.DS.'library'.DS);
define('CORE_PATH_FILENAME', DOG_PATH.'Core.php');

define('VIEW_PATH', dirname(__DIR__).DS.'view'.DS);
define('ROOT_PATH', dirname(__DIR__).DS.'lib'.DS);
require LIBRARY_PATH.'Loader.php';
require DOG_PATH.'App.php';

\dog\library\Loader::register();
\dog\App::run();
