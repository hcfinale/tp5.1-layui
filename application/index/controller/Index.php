<?php
namespace app\index\controller;

use app\common\model\Column;
use think\facade\Config;
class Index extends Base {
    public function index(){
    	$column = new Column();
    	$result = $column->getNavCategory(0);
        return $this->fetch('index',[
            'result'    =>  $result,
        ]);
    }
    public function demo(){
        var_dump(123);
    }
}