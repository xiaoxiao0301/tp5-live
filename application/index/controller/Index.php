<?php
namespace app\index\controller;

use think\Controller;
use think\swoole\WebSocketFrame;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function time()
    {
        $time =  date('Y-m-d H:i:s');
        $server = WebSocketFrame::getInstance()->getServer();
        echo "个数:", count($server->connections), PHP_EOL;
//        foreach ($server->connections as $fd) {
//           $server->push($fd, $time);
//        }
        return $time;
    }


    public function testWebSocket()
    {
        return $this->fetch('test');
    }

    public function detail()
    {
        return $this->fetch();
    }
}
