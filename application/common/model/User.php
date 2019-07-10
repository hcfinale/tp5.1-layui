<?php
//在模型里单独设置数据库连接信息
namespace app\common\model;

use think\Model;
use app\common\model\ShopCart as Cart;
use app\common\validate\User as UserValidate;
class User extends Model
{
    protected $pk = 'id';
    protected $name = 'AdminUser';

    protected static function init(){

    }
    // 判断是否登录
    public static function isLogin($userKey=''){
        if (empty(session('uid'))) {
            return false;
        }
        $userKey == null ? $userKey = cookie('userKey') : $userKey;
        if ($userKey !== session('userKey')) {
            return false;
        }
        return true;
    }
    // 登录用户验证器验证
    public function found($logphone,$logpasswd){
        $validate = new UserValidate();
        $data = [
            'logphone'  =>  $logphone,
            'logpasswd' =>  $logpasswd,
        ];
        if (!$validate->scene('onLogin')->check($data)) {
            return [false,$validate->getError()];
        }
        $res = $this->where('mobile',$logphone)->find();
        if (!$res){
            return [true,'code'=>1004,'msg'=>'用户不存在'];
        }

        $result = $this->where(['mobile'=>$logphone,'password'=>md5($logpasswd)])->find();
        if($result){
            $cart = new Cart();
            $userKey = createStr(32);//生成userKey
            session('userKey', $userKey);//写入userKey
            cookie('userKey', $userKey);
            session('uid',$result['uid']);
            session('user',$result['mobile']);
            session('cartNum',$cart->findCartNum());
            session('logintime',request()->time());
            return [true,'code'=>1001,'msg'=>'登录成功'];
        }else{
            return [true,'code'=>1004,'msg'=>'密码错误'];
        }
    }
    // 注册验证器
    public function doReg($phone,$passwd,$yzm){
        $validate = new UserValidate();
        $data = [
            'phone'  =>  $phone,
            'passwd' =>  $passwd,
            'pnum'  =>  $yzm,
        ];
        if (!$validate->scene('onReg')->check($data)) {
            return [false,$validate->getError()];
        }
        if (empty(session('smsCode'))) {
            return [true,'code'=>'1004','msg'=>'验证码没有发送'];
        }
        if ($yzm != session('smsCode')) {
            return [true,'code'=>'1004','msg'=>'验证码错误'.$yzm];
        }
        $res = $this->where('mobile',$phone)->find();
        if ($res){
            return [true,'code'=>'1004','msg'=>'此手机号已经注册！'];
        }
        $datas = [
            'mobile'    =>  $phone,
            'password'  =>  md5($passwd),
            'gid'       =>  '2'
        ];
        $result = $this->save($datas);
        if ($result) {
            return [true,'code'=>'1001','msg'=>'注册成功'];
        }else{
            return [true,'code'=>'1004','msg'=>'注册失败'];
        }
    }
    // 退出登录，清空session
    public static function logout(){
        session(null);
        cookie('userKey',null);
    }
    // 所有用户查询
    public function userSelectAll(){
        $data = $this->field('uid,name,email,mobile,gender,status,loginnum')->select();
        return $data;
    }
    
}