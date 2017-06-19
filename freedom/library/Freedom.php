<?php

// 初始化常量
defined('FREEDOM_PATH') or define('FREEDOM_PATH', __DIR__.'/');
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');
defined('APP_DEBUG') or define('APP_DEBUG', true);
defined('CONFIG_PATH') or define('CONFIG_PATH', FREEDOM_PATH.'../config/');
defined('INCLUDE_PATH') or define('INCLUDE_PATH', FREEDOM_PATH.'../include/');
defined('RUNDATA_PATH') or define('RUNDATA_PATH', FREEDOM_PATH.'../../rundata/');
defined('HTTP_HOST') or define('HTTP_HOST',strtolower($_SERVER["HTTP_HOST"]));

function __autoload($className)
{
	$className = explode('\\',$className);
	require_once $className[1].".php";
}

require CONFIG_PATH . 'Config.php';
require FREEDOM_PATH . 'PubFun.php';

//打印报错信息
if (APP_DEBUG === $GLOBALS['Freedom']['APP_DEBUG']) {
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set('display_errors','On');
} else {
	error_reporting(E_ALL);
	ini_set('display_errors','Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', RUNDATA_PATH. 'logs/error.log');
}

foreach($GLOBALS['AppSpace'] as $subname => $module)
{
	foreach($module["domain"] as $key => $val)
	{
		foreach($module["domain"][$key] as $key_s => $vals)
		{
			if(HTTP_HOST == $vals) {
				define('SYS_MODULE',$subname);
				define("SYS_RELEASE",$key);
				define("BASE_DOMAIN",'http://'.$vals);
				break;
			}
		}

	}
}

if(empty(defined('SYS_MODULE'))) {
	smarty_display(array() , '404.tpl');
	exit;
}

//核心框架类
$core = new \library\Core();
$core -> run();