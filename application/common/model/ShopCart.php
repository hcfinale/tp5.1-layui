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
    // 加入购物车
    public function addCart(){

    }
    // 直接购买
    public function addPay($id,$sum){
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
}