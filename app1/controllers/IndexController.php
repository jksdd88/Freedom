<?php

class  IndexController extends \library\Controller
{
 	function indexAction(){
		s('My name is WebTest.');
// 	    phpinfo();
//        save_log(123,'abc');
//		s(date('Y-m-d H:i:s',time()+60));exit;
//		$a = debug_backtrace();
//		$b = debug_print_backtrace();
		$a = new User();
		$a->debug();
		$a -> select_list('select * from user where 1=1');

 		$this->display(array(),"index.tpl");
 	}

	function aAction(){
		salog('abc');
		echo 1;
	}

	function infoAction(){
		phpinfo();
	}
}