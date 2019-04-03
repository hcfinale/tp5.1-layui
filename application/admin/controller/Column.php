<?php
namespace app\admin\controller;

use app\common\controller\Base;
use app\common\model\User;
use app\common\model\Column as ColumnModule;

class Column extends Base {
    public function index(){

        return $this->fetch('index');
    }
    public function edits($id = null){
    	if (request()->param('cid')) {
    		$colId = request()->param('cid');
    	} else {
    		echo "123";
    	}
    }
    public function add(){
    	if(request()->isPost()){
    		
    	}
    	return $this->fetch('add');
    }

}
