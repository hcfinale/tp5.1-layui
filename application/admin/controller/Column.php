<?php
namespace app\admin\controller;

use app\common\controller\Base;
use app\common\model\User;
use app\common\model\Column as ColumnModule;

class Column extends Base {
    public function index(){
        return $this->fetch('index',['name'=>'thinkphp']);
    }

}
