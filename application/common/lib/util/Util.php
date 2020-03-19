<?php

namespace app\common\lib\util;

class Util
{
    /**
     * API输出格式
     * @param $status
     * @param string $message
     * @param string $data
     * @return mixed
     */
    public static function show($status, $message = '', $data = [])
    {
        $result = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return json($result);
    }

}