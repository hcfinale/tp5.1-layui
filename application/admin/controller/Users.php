<?php
namespace app\admin\controller;

use app\common\controller\Base;
use think\Exception;
use app\common\model\User;
class Users extends Base {
    public function index(){
        $user = new User();
        $result = $user->userSelectAll();
        return $this->fetch('index',[
            'result'    =>  $result,
        ]);
    }
}
