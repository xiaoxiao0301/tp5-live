<?php

namespace app\index\controller;

use app\common\lib\consts\Code;
use app\common\lib\db\RedisClient;
use app\common\lib\task\SmsTask;
use app\common\lib\util\Util;
use app\index\validate\LoginValidate;
use think\Controller;
use think\facade\Cookie;
use think\Request;

class Login extends Controller
{
    public function login(Request $request)
    {
//        $token = $request->token('token');
//        $this->assign('token', $token);
        return $this->fetch();
    }

    /**
     * 发送短信
     * @param Request $request
     * @return mixed
     */
    public function send(Request $request)
    {
        $phone = $request->phone;
        $loginValidate = new LoginValidate();
        if (!$loginValidate->scene('send')->check(['phone' => $phone])) {
            return Util::show(Code::PHONE_INVALID, $loginValidate->getError());
        }

        // 生成随机数
        $code = rand(1000, 9999);

        // 发送短信验证码,Task处理
        $taskData = [
            'phone' => $phone,
            'code' => $code
        ];
        app('swoole')->task(new SmsTask($taskData));

        // 发送成功后逻辑
//        \Co::set(['hook_flags' => SWOOLE_HOOK_TCP]);
//        go(function () use($phone, $code) {
//            $redis = RedisClient::getInstance();
//            $redis->setex('sms_'.$phone, Code::PHONE_KEY_EXPR_TIME, $code);
//            defer(function () use($redis) {
//                $redis->close();
//            });
//        });

        return Util::show(Code::SUCCESS, '验证码发送成功');
    }

    public function do_login(Request $request)
    {
        $data = input('post.');
        $loginValidate = new LoginValidate();
        if (!$loginValidate->scene('login')->check($data)) {
            return Util::show(Code::ERROR, $loginValidate->getError());
        }
        $redis = RedisClient::getInstance();
        $value = $redis->get('sms_'.$data['phone']);
        if ($value != $data['code']) {
            return Util::show(Code::PHONE_CODE_ERROR, '验证码错误');
        } else {
            // 将短信验证码删除
            $redis->del('sms_'.$data['phone']);
            // 将用户存入到redis中
            $result = [
                'user' => $data['phone'],
                'user_key' => md5('user_'.$data['phone']),
                'time' => date('Y-m-d H:i:s'),
                'isLogin' => true
            ];
            $redis->hMSet('user_'.$data['phone'], $result);
            // 登陆用户信息写入cookie
            Cookie::set('isLogin', json_encode($result));
            // 将用户数据存入表中
            //TODO
            return Util::show(Code::SUCCESS, '登陆成功！', $result);
        }
    }
}



















