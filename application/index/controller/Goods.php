<?php
namespace app\index\controller;

use app\common\model\Column;
use app\common\model\Detail;
use think\facade\Config;
class Goods extends Base {
    public function index(){
        $column = new Column();
        $category = $column->getNavCategory(0);
        $id = request()->param('id');
        $goods = new Detail();
        if (!empty($id)){
            $res = $goods->selectCId($id);
            $page = $res->render();
            $count = count($res);
        }else{
            $res = $goods->selectDetail();
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
}