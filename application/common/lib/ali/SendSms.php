<?php


namespace app\common\lib\ali;

use app\common\lib\consts\Code;
use app\common\lib\db\RedisClient;
use think\facade\Log;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

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
     * @param string $phone
     * @param string $code
     */
    public function sendSms(string $phone, string $code)
    {
        /**
         *  composer require alibabacloud/client
         */
//        try {
//            AlibabaCloud::accessKeyClient($this->accessKeyId, $this->accessSecret)
//                ->regionId('cn-hangzhou')
//                ->asDefaultClient();
//        } catch (ClientException $e) {
//            Log::debug('密钥设置错误: '.$e->getMessage());
//        }
//
//        try {
//            $result = AlibabaCloud::rpc()
//                ->product('Dysmsapi')
//                // ->scheme('https') // https | http
//                ->version('2017-05-25')
//                ->action('SendSms')
//                ->method('POST')
//                ->host('dysmsapi.aliyuncs.com')
//                ->options([
//                    'query' => [
//                        'RegionId' => "cn-hangzhou",
//                        'PhoneNumbers' => $phone,
//                        'SignName' => $this->signName,
//                        'TemplateCode' => $this->templateCode,
//                        // {"code": "1234"}
//                        'TemplateParam' => '{"code": "'.$code.'"}',
//                    ],
//                ])
//                ->request();
//        } catch (ClientException $e) {
//            echo $e->getErrorMessage() . PHP_EOL;
//        } catch (ServerException $e) {
//            echo $e->getErrorMessage() . PHP_EOL;
//        }
//        $data = $result->toArray();
//        if ($data['code'] == 'OK') {
//            Log::debug("手机号: ".$phone.",发送验证码:".$code);
//        } else {
//            Log::error("手机号: ".$phone.",发送验证码:".$code. "失败：" .json_encode($data));
//        }

        $redis = RedisClient::getInstance();
        $redis->setex('sms_'.$phone, Code::PHONE_KEY_EXPR_TIME, $code);
    }

    private function setConfig()
    {
        $this->signName = config('ali.SignNameJson');
        $this->templateCode = config('ali.TemplateCode');
        $this->accessKeyId = config('ali.accessKeyId');
        $this->accessSecret = config('ali.accessSecret');
    }
}