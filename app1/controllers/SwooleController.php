<?php

class  SwooleController extends \library\Controller
{
	/**
	 * 异步循环间隔执行 (异步高精度定时器，粒度为毫秒级)
	 */
 	function timertickAction(){

		//每隔2000ms触发一次
		$id = swoole_timer_tick(2000, function ($timer_id) {
			save_log('swoole_timer_tick > '.json_encode($timer_id),'swoole');
		});
		s($id);
		//可以使用 swoole_timer_clear 清除此定时器，参数为定时器ID
//		swoole_timer_clear($id);
 	}

	/**
	 * 异步延迟执行 (异步高精度定时器，粒度为毫秒级)
	 */
	function timerafterAction(){

		//3000ms后执行此函数
		$time_nowa = time();
		swoole_timer_after(3000, function () {
			save_log('swoole_timer_tick > '. $time_nowa . ' '.time(),'swoole');
		});

	}
}