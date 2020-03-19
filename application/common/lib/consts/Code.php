<?php

namespace app\common\lib\consts;

class Code
{
    // 全剧错误码
    const SUCCESS = 1;
    const ERROR = -1;

    // 手机号相关错误码
    const PHONE_KEY_EXPR_TIME = 120;
    const PHONE_INVALID = 1000;
    const PHONE_CODE_ERROR = 1001;
}