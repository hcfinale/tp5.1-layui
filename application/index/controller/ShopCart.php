<?php
namespace app\index\controller;

use app\common\model\ShopCart as Cart;

class ShopCart extends Base {
    protected function initialize(){
        parent::initialize();
        if (!self::islogin()){
            $this->redirect('index/index');
        }
        $this->Cart = new Cart();
    }
    // 购物车展示
    public function cart(){
        return $this->fetch('cart');
    }
    // 购物车商品添加
    public function add(){

    }
    // 购物车商品购买
    public function pay(){
        $goodsName = input('post.');
        if ($goodsName){
            return json(['code'=>'1001','data'=>$goodsName]);
        }else
            return json(['code'=>'1004','data'=>'付款失败']);
    }
    // 购物车中的订单
    public function order(){
        $shopCart = $this->Cart->getSelectAll();
        return $this->fetch('index',[
            'shopCart' =>  $shopCart,
        ]);
    }
    // 状态修改
    public function status(){
        if (request()->isPost()){
            $id = input('post.id','','htmlspecialchars');
            $result = $this->Cart->field('status')->find($id);
            ($result['status']=='1')?($result['status']='0'):($result['status']='1');
            $re = $this->Cart->save(['status'=>$result['status']],['id'=>$id]);
            if ($re){
                return json(['code'=>'1001','data'=>'修改成功']);
            }else
                return json(['code'=>'1004','data'=>'修改失败']);
        }
    }
    // 栏目排序ajax
    public function sort(){
        $id = $this->request->param('id');
        $sort = $this->request->param('sort');
        $result = $this->Cart->where('id',$id)->find();
        if ($result){
            $res = $this->Cart->save(['sort'=>$sort],['id'=>$id]);
            return json(['code'=>'1001','data'=>'修改成功']);
        }
        return json(['code'=>'1004','data'=>'修改失败']);
    }
}