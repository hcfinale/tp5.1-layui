<?php
//在模型里单独设置数据库连接信息
namespace app\common\model;

use think\Model;
use think\Db;
class Order extends Model
{
    protected $pk = 'id';
    protected $name = 'Order';
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;

    // 直接购买
    public function addPay($id,$sum,$orderId){
        // 启动事务，启动事务之后时间在模型中不会自动更新上去。
        Db::startTrans();
        try {
            $res = Db::name('detail')->where(['id'=>$id])->field('name,sum,price')->find();
            $data_c = [
                'name'  =>  $res['name'],
                'price' =>  $res['price'],
                'sum'   =>  $sum,
                'uid'   =>  session('uid'),
                'order_id'  =>  $orderId,
                'create_time'   =>  time(),
            ];
            $data_o = [
                'order_id'  =>  $orderId,
                'uid'   =>  session('uid'),
                'amount'    =>  (float)($sum*($res['price'])),
                'ispay' =>  0,
            ];
            $this->insert($data_o);
            if (($res['sum']-$sum)>=0){
                $AfterNum = $res['sum']-$sum;
                Db::name('detail')->where('id',$id)->update(['sum'=>$AfterNum]);
                Db::name('ShopCart')->insert($data_c);
                // 提交事务
                Db::commit();
            }else{
                $data_c['is_pay'] = -2;    // -2为仓库没有货了
                Db::name('ShopCart')->insert($data_c);
                // 提交事务
                Db::commit();
            }
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return false;
        }
    }
}