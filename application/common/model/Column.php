<?php
//在模型里单独设置数据库连接信息
namespace app\common\model;

use think\Model;
class Column extends Model
{
    protected $pk = 'id';
    protected $name = 'Column';
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;
    public function listTree(){
        $data = $this->select();
        return $this->sortTree($data);
    }
    public function sortTree($data,$pid = 0,$level = 0){
        static $arr = array();
        foreach ($data as $k => $v){
            if($v['pid']==$pid){
                $v['level'] = $level;
                $arr[] = $v;
                $this->sortTree($data,$v['id'],$level+1);
            }
        }
        return $arr;
    }
}