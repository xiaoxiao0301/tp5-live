<?php


namespace app\common\lib\behavior;


class WebsocketsClose
{
    public function run($params)
    {
        [$server, $fd, $reactorId] = $params;
        echo "Client {$fd} closed\n";
        $redis = \app\common\lib\db\RedisClient::getInstance();
        $redis->sRem(config('redis.live_outs_key'), $fd);
    }

}