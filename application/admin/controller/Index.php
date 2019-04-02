<?php
namespace app\admin\controller;

use app\common\controller\Base;
use think\Exception;
class Index extends Base {
    public function index(){
        return $this->fetch('index/index');
    }
    public function form(){
        return $this->fetch('form');
    }
    public function demo(){
    	request()->setAction('123hcdex');
    	dump(request()->action());
    	dump(cookie('userKey'));
    }
}
