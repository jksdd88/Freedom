<?php

function smarty_display($data , $tpl_path , $template_dir =  ''){
	
	
	include_once INCLUDE_PATH . 'smarty/Smarty.class.php';
	$smarty = new Smarty();
	
	$smarty->force_compile = $GLOBALS['Smarty']['force_compile'];
	$smarty->compile_check = $GLOBALS['Smarty']['compile_check'];
	$smarty->debugging = $GLOBALS['Smarty']['debugging'];
	$smarty->caching = $GLOBALS['Smarty']['caching'];
	$smarty->cache_lifetime = $GLOBALS['Smarty']['cache_lifetime'];
	$smarty->template_dir = $template_dir == '' ? $GLOBALS['Smarty']['template_dir'] : $template_dir;
	if (!is_dir($GLOBALS['Smarty']['cache_dir'] . '/' . SYS_MODULE))		mkdir($GLOBALS['Smarty']['cache_dir'] . '/' . SYS_MODULE);
	$smarty->cache_dir = $GLOBALS['Smarty']['cache_dir'] . '/' . SYS_MODULE;
	 
	//      $smarty->config_dir = $GLOBALS['Smarty']['config_dir'];
	//     	$smarty->plugins_dir = $GLOBALS['Smarty']['plugins_dir'];		//插件
	
	if (!is_dir($GLOBALS['Smarty']['compile_dir'] . '/' . SYS_MODULE))		mkdir($GLOBALS['Smarty']['compile_dir'] . '/' . SYS_MODULE);
	$smarty->compile_dir = $GLOBALS['Smarty']['compile_dir']. '/' . SYS_MODULE;
	$smarty->left_delimiter = $GLOBALS['Smarty']['left_delimiter'];
	$smarty->right_delimiter = $GLOBALS['Smarty']['right_delimiter'];
	 
	//      $smarty->testInstall();		//Smarty测试
	
	if($data)	$smarty->assign($data);
	$smarty->display($tpl_path);
	
}

function s($val='' , $exit=0){

	$val=$val===''?time():$val;
	echo "<pre>";
	print_r($val);
	echo "</pre>";
	echo("<hr>");
	if($exit)exit;
	return;

	echo("<pre style='background:#ffffff'>");
	if(is_bool($val)){
		var_dump($val);
	}else{
		print_r($val);
	}
	echo("</pre>");
	echo("<hr>");

}

function save_log($txt , $filename='log')
{
	$dir = RUNDATA_PATH . '/logs/' . SYS_MODULE;
	if (!is_dir($dir))		mkdir($dir);
	$dir .= '/' . date("Y-m-d") . '/';
	if (!is_dir($dir))		mkdir($dir);

	error_log(date("H:i:s").'> '.$txt."\n", 3, $dir.$filename.date("Y-m-d").".log");
}

/**
 * @param $txt 日志信息
 * @param string $filename 'log' -> 一般日志 ，'error'->错误日志 ，'info'->信息日志 ，'warn'->警告日志 ，'trace'->输入日志同时会打出调用栈 ，'alert'->将日志以alert方式弹出
 */
function salog($txt , $filename = 'log' , $flag = true)
{
	include_once INCLUDE_PATH . 'socket/slog.function.php';
	//配置
	slog(array(
		'host'                => '139.196.46.137',//websocket服务器地址，默认localhost
		'optimize'            => $flag,//是否显示利于优化的参数，如果运行时间，消耗内存等，默认为false
		'show_included_files' => false,//是否显示本次程序运行加载了哪些文件，默认为false
		'error_handler'       => $flag,//是否接管程序错误，将程序错误显示在console中，默认为false
		'force_client_ids'    => array(//日志强制记录到配置的client_id,默认为空,client_id必须在allow_client_ids中
			'wangyu_test1',
		),
		'allow_client_ids'    => array(//限制允许读取日志的client_id，默认为空,表示所有人都可以获得日志。
			'wangyu_test1',
		),
	),'config');

	//输出日志
	slog($txt , $filename);  //一般日志
//	slog('msg','log','color:red;font-size:20px;');//自定义日志的样式，第三个参数为css样式
}