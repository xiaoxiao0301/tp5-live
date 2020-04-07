<?php


namespace app\common\timer;


use think\swoole\template\Timer;

class MonitorTimer extends Timer
{

    const PORT = 8001;


    public function initialize($args)
    {

    }

    public function run()
    {
        $shell = "netstat -anp 2> /dev/null | grep ".self::PORT."| grep LISTEN | wc -l";
        $execResult = shell_exec($shell);
        if ($execResult != 1) {
            echo "error: ", date('Y-m-d H:i:s'), PHP_EOL;
        } else {
            echo "success: ", date('Y-m-d H:i:s'), PHP_EOL;
        }
    }
}