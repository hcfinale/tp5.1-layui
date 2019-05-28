<?php
namespace app\index\controller;

use app\common\model\Column;
use app\common\model\Detail;
use think\Db;

class Goods extends Base {
    protected function initialize(){
        parent::initialize();
        $this->column = new Column();
        $this->goods = new Detail();
    }
    public function index(){
        $category = $this->column->getNavCategory(0);
        $id = request()->param('id');

        if (!empty($id)){
            $res = $this->goods->selectCId($id);
            $page = $res->render();
            $count = count($res);
        }else{
            $res = $this->goods->selectDetail();
            $page = $res->render();
            $count = count($res);
        }
        return $this->fetch('index',[
            'id'    =>  $id,
            'category'  =>  $category,
            'count' =>  $count,
            'goods' =>  $res,
            'page'  =>  $page,
        ]);
    }
    public function details($id){
        $rescloumn = $this->goods->selectCId($id);
        $res = $this->goods->findId($id);
        $address = Db::name('ShopAddress')->where('uid',session('uid'))->select();
        return $this->fetch('details',[
            'rescloumn'    =>  $rescloumn,
            'res' => $res,
        ]);
    }
}