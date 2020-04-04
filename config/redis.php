<?php

return [
    'host'   =>  '127.0.0.1',
    'port'   =>   '6379',
    'password' => '',
    'timeout' => 5,
    'user_register_key_prefix' => 'sms_'.uniqid().'_',
    // 直播 key
    'live_outs_key' => 'live_game'
];
