<?php
//在模型里单独设置数据库连接信息
namespace app\common\model;

use think\Model;
class User extends Model
{
    protected $pk = 'id';
    protected $name = 'AdminUser';

    protected static function init(){

    }
    public static function isLogin($userKey=''){
        if (empty(session('uid'))) {
            return false;
        }
        $userKey == null ? $userKey = cookie('userKey') : $userKey;
        if ($userKey !== session('userKey')) {
            return false;
        }
        return true;
    }
    public static function logout(){
        session(null);
        cookie(null);
    }
}