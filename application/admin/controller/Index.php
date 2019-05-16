<?php
namespace app\admin\controller;

use app\common\controller\Base;
use think\Exception;
class Index extends Base {
    public function index(){
        return $this->fetch('index/index');
    }
    public function statistics(){
        $this->assign('countUser',db('AdminUser')->cache(true,'300')->count('*'));
        $this->assign('user',session('user'));
        $this->assign('countColumn',db('column')->cache(true,'300')->count('*'));
        $this->assign('countDetail',db('detail')->cache(true,'300')->count('*'));
        $this->assign('countOrder',db('order')->cache(true,'300')->count('*'));
        return $this->fetch('index/statistics');
    }
    public function form(){
        return $this->fetch('form');
    }
    public function demo(){
    	// request()->setAction('123hcdex');
    	// dump(request()->action());
    	// dump(cookie('userKey'));
        dump(randOrder());
    }
}
