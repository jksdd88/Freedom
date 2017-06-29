<?php
/**
 * User: jksdd88
 * Date: 2017/6/26
 * Time: 16:27
 */
defined('FREEDOM_PATH') or define('FREEDOM_PATH', __DIR__.'/../freedom/library/');
defined('RUNDATA_PATH') or define('RUNDATA_PATH', FREEDOM_PATH.'../../rundata/');
define('SYS_MODULE', 'swoole');
require FREEDOM_PATH . 'PubFun.php';


//创建Server对象，监听 127.0.0.1:9601端口
$serv = new swoole_server("127.0.0.1", 9601);

//设置异步任务的工作进程数量
$serv->set(array('task_worker_num' => 4));

//监听连接进入事件
$serv->on('connect', function ($serv, $fd) {
    save_log('swoole_server > Start '.time(),'swoole');
});

//监听数据接收事件
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    //投递异步任务
    $task_id = $serv->task($data);
    save_log('swoole_server > Dispath AsyncTask: id='.$task_id,'swoole');
});

//处理异步任务
$serv->on('task', function ($serv, $task_id, $from_id, $data) {
    save_log('swoole_server > New AsyncTask[id=$task_id]'.PHP_EOL,'swoole');
    //返回任务执行的结果
    $serv->finish("$data -> OK");
});


//处理异步任务的结果
$serv->on('finish', function ($serv, $task_id, $data) {
    save_log('swoole_server > AsyncTask[$task_id] Finish: $data'.PHP_EOL,'swoole');
});


//监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    save_log('swoole_server > Client: Close.','swoole');
});

//启动服务器
$serv->start();