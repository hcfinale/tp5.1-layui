<?php
//在模型里单独设置数据库连接信息
namespace app\common\model;

use think\Model;
class User extends Model
{
    protected $pk = 'id';
    protected $name = 'AdminUser';
}