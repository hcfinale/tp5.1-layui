<?php
namespace app\index\controller;

use app\common\model\ShopCart as Cart;
use think\Db;

class ShopCart extends Base {
    protected function initialize(){
        parent::initialize();
        if (!self::islogin()){
            $this->error('您需要登录后在进行操作','user/login');
        }
        $this->Cart = new Cart();
    }
    // 购物车展示
    public function cart(){
        $data = $this->Cart->getCart(session('uid'));
        return $this->fetch('cart',[
            'ShopCart'  =>  $data,
        ]);
    }
    // 购物车商品添加
    public function add(){
        $goodsId = input('post.did');
        $goodsSum = input('post.sum');
        $pay = $this->Cart->addCart($goodsId,$goodsSum);
        if ($pay){
            return json(['code'=>'1001','data'=>'添加成功']);
        }else
            return json(['code'=>'1004','data'=>'添加失败']);
    }
    // 购物车商品购买
    public function pay(){
        $goodsId = input('post.did');
        $goodsSum = input('post.sum');
        $pay = $this->Cart->addPay($goodsId,$goodsSum);
        if ($pay){
            return json(['code'=>'1001','data'=>'购买成功']);
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
    // 修改收货地址
    public function setAddress(){
        $uid = session('uid');
        $address = Db::name('ShopAddress')->field('id,address,action')->where('uid',$uid)->order('action DESC')->select();
        if (request()->isPost()){
            $shopAddId = $this->request->param('shopAddId');
            // 启动事务，启动事务之后时间在模型中不会自动更新上去。
            Db::startTrans();
            try {
                Db::name('ShopAddress')->where(['uid' => $uid])->update(['action' => '0']);
                Db::name('ShopAddress')->where(['id' => $shopAddId,'uid' => $uid])->update(['action' => '1']);
                $Address = Db::name('ShopAddress')->where(['id' => $shopAddId,'uid' => $uid])->find();
                // 提交事务
                Db::commit();
                return json(['code'=>'1001','data'=>'修改成功','address'=>$Address]);
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return json(['code'=>'1004','data'=>'修改失败']);
            }

        }
        return $this->fetch('address',[
            'address'   =>  $address,
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