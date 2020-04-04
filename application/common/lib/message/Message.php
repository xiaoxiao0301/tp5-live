<?php


namespace app\common\lib\message;


use think\facade\Log;
use think\swoole\WebSocketFrame;

class Message
{
    public static function run()
    {
        $server = WebSocketFrame::getInstance()->getServer();
        $frame = WebSocketFrame::getInstance()->getFrame();
        $data = WebSocketFrame::getInstance()->getData();
//        Log::debug('json解码:'.$data['content']);
//        $server->push($frame->fd, json_encode($data));
        $server->push($frame->fd, 'Hello,Client');
        Log::debug("receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n");
    }

}