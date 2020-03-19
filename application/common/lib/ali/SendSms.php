<?php


namespace app\common\lib\ali;

use think\facade\Log;

class SendSms
{

    /**
     * 短信签名
     * @var string $signName
     */
    public $signName;
    /**
     * 短信模板code
     * @var string $templateCode
     */
    public $templateCode;

    /**
     * @var string $accessKeyId
     */
    public $accessKeyId;

    /**
     * @var string $accessSecret
     */
    public $accessSecret;


    private static $_instance = null;

    /**
     * SendSms constructor.
     */
    private function __construct()
    {
        $this->setConfig();
    }

    public static function getInstance()
    {
        if (empty(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * 发送短信验证码逻辑
     * @param $code
     */
    public function sendSms(string $phone, string $code)
    {









        Log::debug("手机号: ".$phone.",发送验证码:".$code);
    }

    private function setConfig()
    {
        $this->signName = config('ali.SignNameJson');
        $this->templateCode = config('ali.TemplateCode');
        $this->accessKeyId = config('ali.accessKeyId');
        $this->accessSecret = config('ali.accessSecret');
    }
}