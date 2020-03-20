<?php


namespace app\index\controller;

use app\common\lib\message\Message;
use think\Controller;
use think\facade\Hook;

class SocketMessage extends Controller
{
    /**
     *  Websocket onMessage 回调函数
     *  前端访问时 send 必须加 url参数   {"url": "Index/socket_message/recv"} 不能使用路由格式访问
     */
    public function recv()
    {
        Message::run();
        Hook::add('swoole_websocket_on_close', 'app\\http\\SwooleWebsocketOnclose');
    }
}