<?php

class  SwooleController extends \library\Controller
{
	/**
	 * 异步循环间隔执行 (异步高精度定时器，粒度为毫秒级)
	 */
 	function timertickAction(){
		//每隔2000ms触发一次
		swoole_timer_tick(2000, function ($timer_id) {
			echo "tick-2000ms\n";
		});
 	}

	/**
	 * 异步延迟执行 (异步高精度定时器，粒度为毫秒级)
	 */
	function timerafterAction(){
		//3000ms后执行此函数
		swoole_timer_after(3000, function () {
			echo "after 3000ms.\n";
		});
	}
}