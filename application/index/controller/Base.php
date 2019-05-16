<?php
namespace app\index\controller;

use app\common\model\User;
use think\Controller;

abstract class Base extends Controller {
    protected function initialize(){
    	
    }
    // 用户管理
    public function userAuth($uid = null){
        $module = request()->module();
        $controller = request()->controller();
        $action = request()->action();
        $auth = new Auth();
        if ($auth->check($module.'/'.$controller . '/' . $action, $uid)){
            return true;
        }else {
            return false;
        }
    }
    // 判断是否登录
    public function islogin(){
        if (User::isLogin()){
            return true;
        }
        return false;
    }
    // 空控制器处理
    public function _empty(){
        $this->error('您访问了一个不存在的方法');
    }
}
