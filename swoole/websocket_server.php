<?php
/**
 * User: jksdd88
 * Date: 2017/6/26
 * Time: 16:27
 */
//创建websocket服务器对象，监听0.0.0.0:9603端口
$ws = new swoole_websocket_server("0.0.0.0", 9603);

//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) {
    var_dump($request->fd, $request->get, $request->server);
    $ws->push($request->fd, "hello, welcome\n");
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    $ws->push($frame->fd, "server: {$frame->data}");
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();