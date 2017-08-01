<?php

use \library\Cache;

class  IndexController extends \library\Controller
{
 	function indexAction(){

		s('Hi,I\'m Freedom.');
		// 		$included_files = get_included_files();
// 		foreach ($included_files as $filename) {
// 			echo "$filename<br>";
// 		}
// 	    phpinfo();
//        save_log(123,'abc');
//		s(date('Y-m-d H:i:s',time()+60));exit;
//		$a = debug_backtrace();
//		$b = debug_print_backtrace();
		$a = new User();
		$a->debug();
		$a->update_data(array('username'=> 'aa1a'),' where id = 1');
		$val = $a -> select_list('select * from user where 1=1');
s($val);
		Cache::set('aaa','111');
		s(Cache::get('aaa'));
		set_session('abc',222);
//		s(get_session('abc'));
 		$this->display(array(),"index.tpl");
 	}

	function aAction(){
		s(session_id());
		s(get_session('abc'));exit;
		save_log('aaa','test');
		salog('abc');
		echo 1;
	}

	function infoAction(){
		phpinfo();
	}

//	function __autoload($className)
//	{
//
//		$include_path = '';
//		foreach(scandir(INCLUDE_PATH) as $values_path)
//		{
//			strstr($values_path , '.') !== false ? : $include_path .= INCLUDE_PATH . $values_path . PATH_SEPARATOR;
//		}
//
//		//设置文件包含路径
//		ini_set('include_path',
//			FREEDOM_PATH . PATH_SEPARATOR . $include_path . ini_get('include_path')
//		);
//
//		$className = explode('\\',$className);
//		var_dump($className);
//		require_once $className[1].".php";
//	}

}