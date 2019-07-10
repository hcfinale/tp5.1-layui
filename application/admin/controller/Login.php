<?php
namespace app\admin\controller;

use app\common\model\User;
use think\Controller;
use think\Db;

class Login extends Controller{
    public function login(){
        return $this->fetch('login');
    }
    public function dologin(){
        if (user::isLogin()) {
            return redirect('index/index');
        }
        if(request()->isPost()){
            $username = trim(input('post.name'));
            $passwd = md5(trim(input('post.passwd')));
            $user = new User();
            // $re = Db::query('select * from my_admin_user where name=:name or mobile=:mobile',['name'=>$username,'mobile'=>$username]);
            $res = $user->where('name',$username)->find();
            if (!$res){
                return json(['code'=>1004,'msg'=>$username]);
                // $this->error('用户名不存在');
            }
            $result = $user->where(['name'=>$username,'password'=>$passwd])->find();
            if($result){
                $userKey = createStr(32);//生成userKey
                session('userKey', $userKey);//写入userKey
                cookie('userKey', $userKey);
                session('uid',$result['uid']);
                session('user',$result['name']);
                session('logintime',request()->time());
                return json(['code'=>1001,'msg'=>'登录成功']);
                // $this->success('登录成功','admin/index/index');
            }else{
                return json(['code'=>1004,'msg'=>'密码错误']);
                // $this->error('密码错误');
            }
        }
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
