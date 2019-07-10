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
    // 全部商品
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
            'goods' =>  $res,
            'count' =>  $count,
            'page'  =>  $page,
        ]);
    }
    // 今日团购活动商品 special特别的、重要的
    public function special(){
        $special = $this->goods->findSpecial();
        $orderBySpecial = $this->goods->sortFindSpecial();
        $page = $special->render();
        $count = count($special);
        return $this->fetch('special',[
            'special'   =>  $special,
            'orderSpecial'  =>  $orderBySpecial,
            'count' =>  $count,
            'page'  =>  $page,
        ]);
    }
    // 关于我们的简洁
    public function about(){
        return $this->fetch('about');
    }
    // 订单详情
    public function details($id){
        $rescloumn = $this->goods->selectCId($id);
        $res = $this->goods->findId($id);
        $uid = session('uid');
        if (isset($uid)) {
            $this->assign('address', Db::name('ShopAddress')->field('address')->where('uid',$uid)->where('action',['=',1],['=',0],'or')->order('action DESC')->find());
        }
        return $this->fetch('details',[
            'rescloumn'    =>  $rescloumn,
            'res' => $res,
        ]);
    }
}