<?php


namespace app\index\controller;


use app\common\lib\consts\Code;
use app\common\lib\db\RedisClient;
use app\common\lib\util\Util;
use think\Controller;
use think\Db;
use think\facade\Log;
use think\Request;
use think\swoole\WebSocketFrame;

class Live extends Controller
{
    public function live()
    {
        return $this->fetch();
    }

    public function saves(Request $request)
    {
        $datas = $request->post();
//        // 赛事数据入库
//        $datas['game_id'] = 1;
//        $datas['created_time'] = time();
//        $datas['updated_time'] = time();
//        Db::name('live_outs')->insert($datas);
        // push到前端页面
        $teams = [
            1 => [
                'name' => '马刺',
                'logo' => '/static/live/imgs/team1.png'
            ],
            2 => [
                'name' => '火箭',
                'logo' => '/static/live/imgs/team2.png'
            ]
        ];
        $result = [
            'type' => $datas['type'],
            'title' => $teams[$datas['team_id']]['name'] ?? '直播员',
            'logo' => $teams[$datas['team_id']]['logo'] ?? ' ',
            'content' => $datas['content'] ?? ' ',
            'image' => $datas['image'] ?? ' '
        ];
        //TODO Task 任务完成
        // app('swoole')->task(new PushTask($result));
        // 获取链接的用户
        $fds = RedisClient::getInstance()->sMembers(config('redis.live_outs_key'));
        $server = WebSocketFrame::getInstance()->getServer();
        foreach ($fds as $fd) {
//            $server->push($fd, Util::show(Code::SUCCESS, 'OK', $result));
            $server->push($fd, json_encode($result));
        }
    }


    // 记录聊天信息
    public function chart(Request $request)
    {
        $datas = $request->post();
//        foreach ($server->ports[1]->connections as $fd) {
//            $server->push($fd, 'Tests');
//        }
        $result = [
            'user' => "Tom".rand(0, 2000),
            'content' => $datas['content']
        ];
        $fds = RedisClient::getInstance()->sMembers(config('redis.live_charts_key'));
        $server = WebSocketFrame::getInstance()->getServer();
        foreach ($fds as $fd) {
//            $server->push($fd, Util::show(Code::SUCCESS, 'OK', $result));
            $server->push($fd, json_encode($result));
        }

    }


    /**
     * 上传图片
     * @param Request $request
     * @return string
     */
    public function uploader(Request $request)
    {
        /**
            halt($_FILES);
         * array(1) {
                 ["file"] => array(5) {
         *          ["name"] => string(9) "house.jpg"
         *          ["type"] => string(10) "image/jpeg"
         *          ["tmp_name"] => string(25) "/tmp/swoole.upfile.0bPno4"
         *          ["error"] => int(0)
         *          ["size"] => int(36127)
         *      }
         * }
         */
        $file = $request->file('file');
        $path = "public/static/upload/";
        // move方法成功的话返回的是一个\think\File对象，
        /**
         * object(think\File)#152 (13) {
            ["error":"think\File":private] => string(0) ""
            ["filename":protected] => string(102) "/var/www/html/thinkphp-env/tp5-live/public/static/upload/20200404/92f95f280714fc322c0116b083a26dde.jpg"
            ["saveName":protected] => string(45) "20200404/92f95f280714fc322c0116b083a26dde.jpg"
            ["rule":protected] => string(4) "date"
            ["validate":protected] => array(0) {
            }
            ["isTest":protected] => NULL
            ["info":protected] => array(5) {
            ["name"] => string(9) "house.jpg"
            ["type"] => string(10) "image/jpeg"
            ["tmp_name"] => string(25) "/tmp/swoole.upfile.gbTlTG"
            ["error"] => int(0)
            ["size"] => int(36127)
            }
            ["hash":protected] => array(0) {
            }
            ["pathName":"SplFileInfo":private] => string(66) "public/static/upload/20200404/92f95f280714fc322c0116b083a26dde.jpg"
            ["fileName":"SplFileInfo":private] => string(36) "92f95f280714fc322c0116b083a26dde.jpg"
            ["openMode":"SplFileObject":private] => string(1) "r"
            ["delimiter":"SplFileObject":private] => string(1) ","
            ["enclosure":"SplFileObject":private] => string(1) """
        }
         */
        $info = $file->move($path);
        if ($info) {
            $data = [
                'path' => '/static/upload/'.$info->getSaveName(),
            ];
            return Util::show(Code::SUCCESS, '上传成功!', $data);
        } else {
            return Util::show(Code::ERROR, '上传失败!');
        }
    }

}