<?php
//在模型里单独设置数据库连接信息
namespace app\common\model;

use think\Model;

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
}