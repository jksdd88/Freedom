<?php

class  SwooleController extends \library\Controller
{
	/**
	 * 异步循环间隔执行 (异步高精度定时器，粒度为毫秒级) z
	 * 注：只能用于cli命令行环境
	 */
 	function timertickAction(){

		//每隔2000ms触发一次
		$id = swoole_timer_tick(2000, function ($timer_id) {
			save_log('swoole_timer_tick > '.json_encode($timer_id).' time > '.time(),'swoole');
		});

		//可以使用 swoole_timer_clear 清除swoole_timer_tick or swoole_timer_after定时器，参数为定时器ID
		swoole_timer_clear($id);
 	}

	/**
	 * 异步延迟执行 (异步高精度定时器，粒度为毫秒级)
	 * 注：只能用于cli命令行环境
	 */
	function timerafterAction(){

		//3000ms后执行此函数
		swoole_timer_after(3000, function () {
			save_log('swoole_timer_tick >'.time(),'swoole');
		});

	}

	//创建同步TCP客户端
	function clientAction(){
		$client = new swoole_client(SWOOLE_SOCK_TCP);

		//连接到服务器
		if (!$client->connect('127.0.0.1', 9601, 0.5))
		{
			die("connect failed.");
		}
		//向服务器发送数据
		if (!$client->send("hello world"))
		{
			die("send failed.");
		}
		//从服务器接收数据
		$data = $client->recv();
		if (!$data)
		{
			die("recv failed.");
		}
		echo $data;
		//关闭连接
		s($client->close());
	}

}