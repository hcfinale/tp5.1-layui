<?php
namespace app\admin\controller;

use app\common\model\User;
use think\Controller;
class Login extends Controller{
    public function login(){
        if (user::isLogin()) {
            return redirect('index/index');
        }
        if(request()->isPost()){
            $username = input('post.name');
            $passwd = md5(input('post.passwd'));
            $user = new User();
            $re = $user->where('name',$username)->find();
            if (!$re){
                $this->error('用户名密码不存在');
            }
            $result = $user->where(['name'=>$username,'password'=>$passwd])->find();
            if($result){
                $userKey = createStr(32);//生成userKey
                session('userKey', $userKey);//写入userKey
                cookie('userKey', $userKey);

                session('uid',$result['uid']);
                session('user',$result['name']);
                session('logintime',request()->time());
                $this->success('登录成功','index/index');
            }else{
                $this->error('密码错误');
            }
        }
        return $this->fetch('login');
    }
    public function logout(){
        if (User::isLogin()) {
            User::logout();
            return $this->success('退出成功！', 'index/index/index');
        } else {
            return $this->error('当前无需退出呢！');
        }
    }
}
