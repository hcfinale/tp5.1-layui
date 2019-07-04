<?php
//在模型里单独设置数据库连接信息
namespace app\common\model;

use think\Model;
use think\db;
class ShopCart extends Model
{
    protected $pk = 'id';
    protected $name = 'ShopCart';
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;

    // 查询所有购物车中商品
    public function getSelectAll(){
        $result = $this->alias('sc')
            ->leftJoin('__DETAIL__ d','sc.name = d.name')
            ->leftJoin('__COLUMN__ c','d.cid = c.id')
            ->leftJoin('__ADMIN_USER__ u','sc.uid = u.uid')
            ->field('sc.id,sc.name,sc.sum,sc.sort,sc.status,d.img,d.price,d.payman,c.title,u.name as username')
            ->paginate(15,false,[
                'type'=>'BootstrapDetailed'
            ]);
        return $result;
    }
    // 获取商品状态为1的商品
    public function getStateAll(){
        $result = $this->alias('sc')
            ->leftJoin('__DETAIL__ d','sc.name = d.name')
            ->leftJoin('__COLUMN__ c','d.cid = c.id')
            ->leftJoin('__ADMIN_USER__ u','sc.uid = u.uid')
            ->where('status','1')
            ->field('sc.id,sc.name,sc.sum,sc.sort,sc.status,d.img,d.price,d.payman,c.title,u.name as username')
            ->paginate(15,false,[
                'type'=>'BootstrapDetailed'
            ]);
        return $result;
    }
    // 获取商品状态为0的商品
    public function getNoState(){
        $result = $this->alias('sc')
            ->leftJoin('__DETAIL__ d','sc.name = d.name')
            ->leftJoin('__COLUMN__ c','d.cid = c.id')
            ->leftJoin('__ADMIN_USER__ u','sc.uid = u.uid')
            ->where('status','0')
            ->field('sc.id,sc.name,sc.sum,sc.sort,sc.status,d.img,d.price,d.payman,c.title,u.name as username')
            ->paginate(15,false,[
                'type'=>'BootstrapDetailed'
            ]);
        return $result;
    }
    // 获取购物车中商品信息 参数uid为登录人信息
    public function getCart($uid){
        $result = $this->alias('sc')
            ->leftJoin('__DETAIL__ d','sc.name = d.name')
            ->leftJoin('__COLUMN__ c','d.cid = c.id')
            ->where('sc.status','=',1)
            ->where('sc.is_pay','<>',1)
            ->where('sc.uid','=',$uid)
            ->field('sc.id,sc.name,sc.is_pay,sc.sum,sc.sort,sc.status,d.keyword as d_key,d.img,d.price,d.payman,c.title')
            ->paginate(10,false,[
                'type'=>'BootstrapDetailed'
            ]);
        return $result;
    }
    // 加入购物车
    public function addCart($id,$sum){
        // 启动事务，启动事务之后时间在模型中不会自动更新上去。
        Db::startTrans();
        try {
            $res = Db::name('detail')->where(['id'=>$id])->field('name,price')->find();
            $res['sum'] = $sum;
            $res['uid'] = session('uid');
            $res['create_time'] = time();
            $result = Db::name('ShopCart')->insert($res);
//            Db::name('detail')->where(['id'=>$id])->update('');
            // 提交事务
            Db::commit();
            return $result;
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return false;
        }
    }
    // 直接购买
    public function addPay($id,$sum){
        // 启动事务，启动事务之后时间在模型中不会自动更新上去。
        Db::startTrans();
        try {
            $res = Db::name('detail')->where(['id'=>$id])->field('name,sum,price')->find();
            $res['sum'] = $sum;
            $res['uid'] = session('uid');
            $res['create_time'] = time();
            if (($res['sum']-$sum)>=0){
                $AfterNum = $res['sum']-$sum;
                Db::name('detail')->where('id',$id)->update(['sum'=>$AfterNum]);
                $result = Db::name('ShopCart')->insert($res);
                // 提交事务
                Db::commit();
                return $result;
            }else{
                $res['is_pay'] = -2;    // -2为仓库没有货了
                $result = Db::name('ShopCart')->insert($res);
                // 提交事务
                Db::commit();
                return $result;
            }
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return false;
        }
    }
    // 删除购物车的订单
    public function delCartOrder($id){
        db::startTrans();
        try{
            db::query("delete from my_order where order_id = (select order_id from my_shop_cart where id = $id)");
            db::query("delete from my_shop_cart where id = $id");
            return true;
        }catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return false;
        }
    }
    public function findCartNum(){
        $data = $this->where('uid',session('uid'))->count('id');
        return $data;
    }
}