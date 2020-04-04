<?php

namespace app\common\lib\db;

use think\Log;

class RedisClient
{
    /**
     * @var resource $conn
     */
    public $conn;

    /**
     * @var string $host
     */
    public $host;

    /**
     * @var integer $port
     */
    public $port;

    /**
     * @var string $password
     */
    public $password;

    /**
     * @var integer $timeout
     */
    public $timeout;

    private static $_instance = null;

    private function __construct()
    {
        $this->configConnect();
        try {
            $this->connect();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     *
     * @return RedisClient|null
     */
    public static function getInstance()
    {
        if (empty(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Redis连接
     * @throws \Exception
     */
    public function connect()
    {
        $this->conn = new \Redis();
        $result = $this->conn->connect($this->host, $this->port, $this->timeout);
        if (!$result) {
            throw new \Exception('Redis connect error');
        }
        if ($this->password) {
            $this->conn->auth($this->password);
        }
    }

    /**
     * Redis 连接参数设置
     */
    public function configConnect()
    {
        $this->host = config('redis.host');
        $this->port = config('redis.port');
        $this->password = config('redis.password');
        $this->password = config('redis.timeout');
    }

    /**
     * 设置值
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function set(string $key, string $value):bool
    {
        return $this->conn->set($key, $value);
    }


    /**
     * 设置值加过期时间
     * @param string $key
     * @param int $time
     * @param string $value
     * @return bool
     */
    public function setex(string $key, int $time, string $value):bool
    {
        return $this->conn->setex($key, $time, $value);
    }

    /**
     * 获取值
     * @param string $key
     * @return string
     */
    public function get(string $key):string
    {
        return $this->conn->get($key);
    }

    /**
     * 删除key
     * @param string $key
     * @return boolean
     */
    public function del(string $key):bool
    {
        $result = $this->conn->del($key);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * hash多值设置
     * @param string $key
     * @param array $value
     * @return bool
     */
    public function hMSet(string $key, array $value):bool
    {
        // $redis->hMSet('user:1', array('name' => 'Joe', 'salary' => 2000));
        return $this->conn->hMSet($key, $value);
    }

    /**
     * hash多值获取
     * @param string $key
     * @return array
     */
    public function hMGet(string $key, array $value):array
    {
        // $redis->hmGet('h', array('field1', 'field2'));
        return $this->conn->hmGet($key, $value);
    }

    /**
     * 获取当前key的所有字段
     * @param string $key
     * @return array
     */
    public function hKeys(string $key):array
    {
        return $this->conn->hKeys($key);
    }

    /**
     * 获取所有key的所有值
     * @param string $key
     * @return array
     */
    public function hvals(string $key):array
    {
        return $this->conn->hVals($key);
    }

    /**
     * 获取在哈希表中指定 key 的所有字段和值
     * @param string $key
     * @return array
     */
    public function hGetAll(string $key):array
    {
        return $this->conn->hGetAll($key);
    }


    /**
     * 集合添加数据
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function sAdd(string $key, string $value):bool
    {
        return $this->conn->sAdd($key, $value);
    }


    /**
     * 删除集合中的元素
     * @param string $key
     * @param string $value
     * @return int
     */
    public function sRem(string $key, string $value):int
    {
        return $this->conn->sRem($key, $value);
    }

    /**
     * 返回集合中key的所有元素
     * @param string $key
     * @return array
     */
    public function sMembers(string $key):array
    {
        return $this->conn->sMembers($key);
    }

    /**
     * 释放连接
     * @return mixed
     */
    public function close()
    {
        return $this->conn->close();
    }

    public function __destruct()
    {
        $this->conn->close();
    }

}