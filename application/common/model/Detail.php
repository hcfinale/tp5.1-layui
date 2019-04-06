<?php
//在模型里单独设置数据库连接信息
namespace app\common\model;

use think\Model;
use app\common\model\Column;
class Detail extends Model
{
    protected $pk = 'id';
    protected $name = 'Detail';
    protected $autoWriteTimestamp = true;
    public function listTree(){
        $column = new Column();
        $data = $column->field('id,pid,uid,title,keyword,sort,status')->select();
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
    // 首页商品展示
    public function selectDetail(){
        $result = $this->alias('d')
            ->leftJoin('__COLUMN__ c','d.cid = c.id')
            ->field('d.id,d.name,d.keyword,d.description,d.img,d.sum,d.price,d.sort,d.status,c.title')
            ->select();
        return $result;
    }
    // 添加商品
    public function addDetail($data){
        $data['uid'] = session('uid');
        $result = $this->save($data);
        return $result;
    }
    // 获取所属分类
    public function getParentById($id){
        $res = $this->field('id,cid')->find($id);
        return $res['cid'];
    }
}