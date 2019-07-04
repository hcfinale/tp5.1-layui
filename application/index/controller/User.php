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

    public function login(){
        if (request()->isPost()) {
            $phoneNum = trim(input('post.logphone'));
            $passwd = trim(input('post.logpasswd'));
            $re = $this->user->where('mobile',$phoneNum)->find();
            if (!$re){
                // return json(['code'=>1004,'msg'=>'用户不存在']);
                $this->error('用户名不存在');
            }
            $result = $this->user->where(['mobile'=>$phoneNum,'password'=>md5($passwd)])->find();
            if($result){
                $userKey = createStr(32);//生成userKey
                session('userKey', $userKey);//写入userKey
                cookie('userKey', $userKey);
                session('uid',$result['uid']);
                session('user',$result['name']);
                session('cartNum',$this->cart->findCartNum());
                session('logintime',request()->time());
                // return json(['code'=>1001,'msg'=>'登录成功']);
                $this->success('登录成功','index/index');
            }else{
                // return json(['code'=>1004,'msg'=>'密码错误']);
                $this->error('密码错误');
            }
        }
        return $this->fetch('index');
    }
    // 注册账号
    public function register(){
        if (request()->isGet()) {
            $yzm = trim(input('post.punm'));
            if ($yzm != session('smsCode')) {
                return json(['code'=>1004,'msg'=>'验证码错误']);
            }
            $phoneNum = trim(input('post.phone'));
            $passwd = trim(input('post.passwd'));
            $re = $this->user->where('mobile',$phoneNum)->find();
            if ($re){
                // return json(['code'=>1004,'msg'=>'用户不存在']);
                $this->error('此手机号已经注册！');
            }
            $this->user->data([
                'mobile'    =>  $phoneNum,
                'password'  =>  md5($passwd),
                'gid'       =>  '2'
            ]);
            $result = $this->user->save();
            $this->success('注册账号成功','index/index');
        }else{
            return json(['code'=>1004,'msg'=>'非法访问']);
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
        $phone = request()->get('phone');
        $smsCode = mt_rand(100000,999999);
        session('smsCode', $smsCode);
        return json(['code'=>'1001','data'=>'数据请求成功','smsCode'=>$smsCode,'msg'=>$phone]);
    }
    // 退出登录
    public function logout(){
        session(null);
        cookie(null);
        $this->redirect('index/index');
    }
}