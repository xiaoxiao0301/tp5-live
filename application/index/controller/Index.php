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
        return date('Y-m-d H:i:s');
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
