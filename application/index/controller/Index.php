<?php
namespace app\index\controller;

use think\facade\Config;
class Index extends Base {
    public function index(){
    	
        return $this->fetch('index');
    }
}