<?php
/**
 * Dabuba System 大布吧系统
 *
 * ====================================================================
 * @link      http://www.dabuba.com/
 * @copyright Copyright (c) 2016 Dabuba.com All rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE.-2.0
 * ====================================================================
 *
 * @package     阿里云短信公共类
 *
 * @subpackage  阿里云短信验证码发送类
 *
 * @author      Tggui
 *
 */
namespace app\common;
use think\Controller;

class Alisms extends Controller
{
    // 保存错误信息
    public $error;
    // Access Key ID
    private $accessKeyId    = '';
    // Access Access Key Secret
    private $accessKeySecret= '';
    //短信签名  阿里云短信服务里面申请的那个
    private $aliProduct     = '';

    public function __construct()
    {
        // 配置参数 去阿里云获取
        $this -> accessKeyId      = 'xxxx';
        $this -> accessKeySecret  = 'xxxx';
        $this -> aliProduct       = 'xxxx';
    }

    private function percentEncode($string) {
        $string = urlencode ( $string );
        $string = preg_replace ( '/\+/', '%20', $string );
        $string = preg_replace ( '/\*/', '%2A', $string );
        $string = preg_replace ( '/%7E/', '~', $string );
        return $string;
    }

    /**
     * 签名
     *
     * @param unknown $parameters
     * @param unknown $accessKeySecret
     * @return string
     */
    private function computeSignature($parameters, $accessKeySecret) {
        ksort ( $parameters );
        $canonicalizedQueryString = '';
        foreach ( $parameters as $key => $value ) {
            $canonicalizedQueryString .= '&' . $this->percentEncode ( $key ) . '=' . $this->percentEncode ( $value );
        }
        $stringToSign = 'GET&%2F&' . $this->percentencode ( substr ( $canonicalizedQueryString, 1 ) );
        $signature = base64_encode ( hash_hmac ( 'sha1', $stringToSign, $accessKeySecret . '&', true ) );
        return $signature;
    }

    /**
     * 发送短信
     *
     * @param string $mobile 手机号码
     * @param string $type 类型
     * @param int $create_id 操作人menber_id
     * @return bool 返回状态
     */
    public function sendSms( $mobile, $type, $create_id = 0 )
    {
        $returnArr      = [];
        $returnArr['status']    = 0;
        //判断是否能发送
        $isSend_time    = model('sms') -> isSend( $mobile );
        //请等待多少秒后才能重新获取短信验证码
        if ( !empty($isSend_time) ) {
            $returnArr['time']  = $isSend_time;
            return $returnArr;
        }
        //获取短信模板信息
        $tempCodeArr    = $this -> tempCode($type);
        //写入数据库
        $addData        = ['create_id' => $create_id, 'mobile' => $mobile, 'code' => $tempCodeArr['sms_code'], 'create_time' => time()];
        $sms_id         = model('sms') -> insertGetId($addData);
        if ($sms_id) {
            $params     = [
                'SignName'          => $tempCodeArr['signName'],
                'Format'            => 'JSON',
                'Version'           => '2017-05-25',
                'AccessKeyId'       => $this -> accessKeyId,
                'SignatureVersion'  => '1.0',
                'SignatureMethod'   => 'HMAC-SHA1',
                'SignatureNonce'    => uniqid(),
                'Timestamp'         => gmdate( 'Y-m-d\TH:i:s\Z' ),
                'Action'            => 'SendSms',
                'TemplateCode'      => $tempCodeArr['TemplateCode'],
                'PhoneNumbers'      => $mobile,
                'TemplateParam'     => '{"code":"' . $tempCodeArr['sms_code'] . '"}'
            ];
            // 计算签名并把签名结果加入请求参数
            $params ['Signature']   = $this -> computeSignature ( $params, $this -> accessKeySecret );
            //请求的接口
            $url    = 'http://dysmsapi.aliyuncs.com/?' . http_build_query ( $params );
            //公共方法的curl
            dbb_curl( $url, null, $result );
            //将json转换数组
            $result = json_decode ( $result, true );
            /**
             * 返回数据的大概格式
             *  [
            'Message'     => "OK"
            'RequestId'   => "xxxx"
            'BizId'       => "xxxxxx"
            'Code'        => "OK"
            ]
             */
            //以下自己写严谨点 我大概给个示例
            if ( $result ['Code'] == 'OK' ) {
                //存在 更新数据库
                $rs_update  = model('sms') -> sendUpdate($sms_id, $result['RequestId']);
                if ($rs_update) {
                    $returnArr['status'] = 1;
                }
            }
            //错误信息
//          return $this->error = $this->getErrorMessage($status)
        }
        return $returnArr;
    }

    /**
     * 短信模板
     */
    private function tempCode( $type )
    {
        //短信签名
        $product  = $this -> aliProduct;
        //随机4位 + 2(66/88)
        $code_arr = array('66','88');
        $sms_code = random('4','2356789').$code_arr[array_rand($code_arr,1)];
        switch ($type) {
            //模板1
            case 1 :
                $TemplateCode = "SMS_xxx01";
                break;
            //模板2
            case 2 :
                $TemplateCode = "SMS_xxx02";
                break;
        }
        return [ 'sms_code' => $sms_code, 'TemplateCode' => $TemplateCode, 'signName' => $product ];
    }

    /**
     * 获取详细错误信息
     *
     * @param unknown $status
     */
    public function getErrorMessage( $status )
    {
        $message    = [
            'isv.InvalidDayuStatus.Malformed'           => '账户短信开通状态不正确',
            'isv.InvalidSignName.Malformed'             => '短信签名不正确或签名状态不正确',
            'isv.InvalidTemplateCode.MalFormed'         => '短信模板Code不正确或者模板状态不正确',
            'isv.InvalidRecNum.Malformed'               => '目标手机号不正确，单次发送数量不能超过100',
            'isv.InvalidParamString.MalFormed'          => '短信模板中变量不是json格式',
            'isv.InvalidParamStringTemplate.Malformed'  => '短信模板中变量与模板内容不匹配',
            'isv.InvalidSendSms'                        => '触发业务流控',
            'isv.InvalidDayu.Malformed'                 => '变量不能是url，可以将变量固化在模板中'
        ];
        if (isset ( $message [$status] )) {
            return $message [$status];
        }
        return $status;
    }
}