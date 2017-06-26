<?php
defined('FREEDOM_PATH') or define('FREEDOM_PATH', __DIR__.'/../freedom/library/');
defined('RUNDATA_PATH') or define('RUNDATA_PATH', FREEDOM_PATH.'../../rundata/');
define('SYS_MODULE', 'swoole');
require FREEDOM_PATH . 'PubFun.php';

/**
 * User: jksdd88
 * Date: 2017/6/26
 * Time: 17:43
 * 注：该文件函数只能用于cli命令行环境
 */

//异步循环间隔执行 (异步高精度定时器，粒度为毫秒级) 每隔2000ms触发一次
$id = swoole_timer_tick(2000, function ($timer_id) {
    save_log('swoole_timer_tick > '.json_encode($timer_id).' time > '.time(),'swoole');
});

//异步延迟执行 (异步高精度定时器，粒度为毫秒级) 3000ms后执行此函数
swoole_timer_after(3000, function () {

    save_log('swoole_timer_tick >'.time(),'swoole');
});
echo $id;
//可以使用 swoole_timer_clear 清除swoole_timer_tick or swoole_timer_after定时器，参数为定时器ID
//swoole_timer_clear($id);