<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +------------------------------------------l----------------------------


Route::get('/login', 'Index/login/login')->name('user.login');
// 发送短信验证码
Route::post('/send', 'Index/login/send')->name('send_sms');
// 登陆
Route::post('/do_login', 'Index/login/do_login')->name('user.do_login');

// WebSocket onMessage
Route::get('recv', 'Index/socket_message/recv')->name('socket_on_message');
