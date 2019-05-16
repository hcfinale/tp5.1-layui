<?php
//在模型里单独设置数据库连接信息
namespace app\common\model;

use think\Model;

class Order extends Model
{
    protected $pk = 'id';
    protected $name = 'Order';
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;
    
}