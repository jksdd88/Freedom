<?php
/**
 * User: jksdd88
 * Date: 2017/6/26
 * Time: 16:27
 */
//创建Server对象，监听 127.0.0.1:9604端口，类型为SWOOLE_SOCK_UDP
$serv = new swoole_server("0.0.0.0", 9604, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

//监听数据接收事件
$serv->on('Packet', function ($serv, $data, $clientInfo) {
    $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
    var_dump($clientInfo);
});

//启动服务器
$serv->start();