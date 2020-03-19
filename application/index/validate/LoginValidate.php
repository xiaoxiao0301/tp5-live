<?php

namespace app\index\validate;

use think\Validate;

class LoginValidate extends Validate
{
    protected $regex = [
        'phone' => "/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\\d{8}$/"
    ];

    protected $rule = [
        'phone' => 'require|max:11|regex:phone',
        'code' => 'require|max:4'
    ];

    protected $message = [
        'phone.require' => '手机号必须传递',
        'phone.max' => '手机号长度不能超过11位',
        'phone.regex' => '手机号码不存在',
        'code.require' => '验证码不能为空',
        'code.max' => '验证码不能超过4位'
    ];

    protected $scene = [
        'send' => ['phone'],
        'login' => ['phone', 'code']
    ];

}