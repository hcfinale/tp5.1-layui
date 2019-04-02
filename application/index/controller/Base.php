<?php
namespace app\index\controller;

use think\Db;
use think\Session;
use think\Request;
use think\Cache;
use think\Loader;
use think\Exception;
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
    public function _empty(){
        $this->error('您访问了一个不存在的方法');
    }
}
