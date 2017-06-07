<?php

class  IndexController extends \library\Controller
{
 	function indexAction(){
// 	    phpinfo();
//        save_log(123,'abc');
//		s(date('Y-m-d H:i:s',time()+60));exit;
//		$a = debug_backtrace();
//		$b = debug_print_backtrace();
		$a = new EnglishWords();
		$a->debug();
		$a -> select_list('select * from english_words where 1');

// 		$this->display(array(),"index.tpl");
 	}

	function aAction(){
		salog('abc');
		echo 1;
	}
}