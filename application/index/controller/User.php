<?php
namespace app\index\controller;

use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;
use app\common\model\User as ModelUser;
use app\common\model\ShopCart as Cart;

class User extends Base {
    protected function initialize(){
        static $user;
        static $cart;
        parent::initialize();
        $this->user = new ModelUser();
        $this->cart = new Cart();
    }
    // 用户登录验证
    public function login(){
        return $this->fetch('index');
    }
    public function dologin(){
        if (request()->isPost()) {
            $phoneNum = trim(input('post.logphone'));
            $passwd = trim(input('post.logpasswd'));

            $res = $this->user->found($phoneNum,$passwd);
            if ($res[0]&&$res['code']=='1001') {
                return json(['code'=>'1001','msg'=>$res['msg']]);
            } else if($res[0]&&$res['code'=='1004']) {
                return json(['code'=>'1004','msg'=>$res['msg']]);
            } else {
                return json(['code'=>'1004','msg'=>$res[1]]);
            }
        }
    }
    // 注册账号
    public function register(){
        if (request()->isPost()) {
            $yzm = trim(input('post.pnum'));
            $phoneNum = trim(input('post.phone'));
            $passwd = trim(input('post.passwd'));

            $res = $this->user->doReg($phoneNum,$passwd,$yzm);
            if ($res[0]&&$res['code']=='1001') {
                return json(['code'=>'1001','msg'=>$res['msg']]);
            } else if($res[0]&&$res['code'=='1004']) {
                return json(['code'=>'1004','msg'=>$res['msg']]);
            } else {
                return json(['code'=>'1004','msg'=>$res[1]]);
            }
        }else{
            return json(['code'=>'1004','msg'=>'非法访问']);
        }        
    }
    /**
     * 发送短信
     *
     * @param string $mobile 手机号码
     * @param string $type 类型：1-用户注册验证码、2-修改密码验证码
     * @param int $create_id 操作人menber_id
     * @return bool 返回状态
     */
    public function sendSms(){
        $config = [
            'accessKeyId'    => 'LTAIbVA2LRQ1tULr',
            'accessKeySecret' => 'ocS48RUuyBPpQHsfoWokCuz8ZQbGxl',
        ];

        $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers('13851752194');
        $sendSms->setSignName('叶子坑');
        $sendSms->setTemplateCode('SMS_77670013');
        $sendSms->setTemplateParam(['code' => rand(100000, 999999)]);
        $sendSms->setOutId('this is test demo');

        print_r($client->execute($sendSms));
    }
    // 发送验证码
    public static function mnSms(){
        if (request()->isGet()) {
            $phone = request()->get('phone');
            if (preg_match('/^1[34578]\d{9}$/',$phone)) {
                $smsCode = mt_rand(100000,999999);
                session('smsCode', $smsCode);
                return json(['code'=>'1001','data'=>'数据请求成功','smsCode'=>$smsCode,'msg'=>$phone]);
            }else{
                return json(['code'=>'1004','data'=>'手机号格式有误']);
            }
        }else{
            return json(['code'=>'1004','data'=>'非法请求']);
        }
        
    }
    // 退出登录
    public function logout(){
        session(null);
        cookie(null);
        $this->redirect('index/index');
    }
}