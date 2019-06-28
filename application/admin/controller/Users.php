<?php
namespace app\admin\controller;

use app\common\controller\Base;
use think\Exception;
use app\common\model\User;
use think\facade\Env;
class Users extends Base {
    public function index(){
        $user = new User();
        $result = $user->userSelectAll();
        return $this->fetch('index',[
            'result'    =>  $result,
        ]);
    }
    public function add(){
        if (request()->isPost()) {
            # code...
        }
        return $this->fetch('add');
    }

    /**
     * 清楚缓存
     */
    public function cache(){
        $path = Env::get('runtime_path');
        delDir($path);
        $this->success('清除缓存成功');
    }
}
