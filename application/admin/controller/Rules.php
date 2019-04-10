<?php
namespace app\admin\controller;

use app\common\controller\Base;
use think\Exception;
class Rules extends Base {
    public function index(){
        return $this->fetch('index');
    }
}
