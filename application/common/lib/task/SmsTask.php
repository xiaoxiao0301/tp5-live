<?php


namespace app\common\lib\task;


use app\common\lib\ali\SendSms;
use think\swoole\template\Task;

class SmsTask extends Task
{
    /**
     * @var string $phone
     */
    public $phone;
    /**
     * @var string $code
     */
    public $code;


    /**
     * SmsTask constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct();
        $this->phone = $config['phone'];
        $this->code = $config['code'];
    }


    public function run($serv, $taskId, $fromWorkerId)
    {
        $sms = SendSms::getInstance();
        $sms->sendSms($this->phone, $this->code);
    }

    public function initialize($args)
    {
        // TODO: Implement initialize() method.
    }
}