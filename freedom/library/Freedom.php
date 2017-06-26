<?php

// 初始化常量
defined('FREEDOM_PATH') or define('FREEDOM_PATH', __DIR__.'/');
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');
defined('CONFIG_PATH') or define('CONFIG_PATH', FREEDOM_PATH.'../config/');
defined('INCLUDE_PATH') or define('INCLUDE_PATH', FREEDOM_PATH.'../include/');
defined('RUNDATA_PATH') or define('RUNDATA_PATH', FREEDOM_PATH.'../../rundata/');
!defined('HTTP_HOST') && !empty($_SERVER["HTTP_HOST"]) ?  define('HTTP_HOST',strtolower($_SERVER["HTTP_HOST"])): true;

$include_path = '';
foreach(scandir(INCLUDE_PATH) as $values_path)
{
	strstr($values_path , '.') !== false ? : $include_path .= INCLUDE_PATH . $values_path . PATH_SEPARATOR;
}

//设置文件包含路径
ini_set('include_path',
	FREEDOM_PATH . PATH_SEPARATOR . $include_path . ini_get('include_path')
);

require CONFIG_PATH . 'Config.php';

foreach(scandir(FREEDOM_PATH) as $values_path)
{
	strstr($values_path , '.php') == false || strstr($values_path , 'Freedom.php') == true ? : require FREEDOM_PATH . $values_path;
}

//加载核心框架类
$core = new \library\Core();
$core -> run();