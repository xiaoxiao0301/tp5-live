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
        // 钩子函数既可以单独绑定一个类，也可以绑定类中的一个方法，或者直接绑定一个匿名函数。
        //当绑定到一个类时，如果类中有run函数，那就直接执行run函数，如果没有run函数，
        //而有一个与钩子名一样的函数则会执行该函数。(注意：钩子函数是驼峰式命名，并且钩子函数名的优先级大于run函数的优先级)
        Hook::add('swoole_websocket_on_close', 'app\\http\\SwooleWebsocketOnclose');
    }
}