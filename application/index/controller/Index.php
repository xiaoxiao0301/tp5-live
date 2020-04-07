<?php
namespace app\index\controller;

use app\common\timer\MonitorTimer;
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

    public function testTimers()
    {
        $port = 8001;
        app('swoole')->tick(1000, function ($timer_id) use ($port) {
            $shell = "netstat -anp 2> /dev/null | grep ".$port."| grep LISTEN | wc -l";
            $execResult = shell_exec($shell);
            if ($execResult != 1) {
                echo "error: ", date('Y-m-d H:i:s'), PHP_EOL;
            } else {
                echo "success: ", date('Y-m-d H:i:s'), PHP_EOL;
            }
        });

        return "123";
    }
}
