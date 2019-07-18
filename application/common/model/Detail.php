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
    // 商品树形排序
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
    // 首页所有商品展示
    public function selectDetail(){
        $result = $this->alias('d')
            ->leftJoin('__COLUMN__ c','d.cid = c.id')
            ->field('d.id,d.name,d.keyword,d.description,d.img,d.sum,d.price,d.new_price,d.payman,d.sort,d.status,c.title')
            ->paginate(15,false,[
                'type'=>'BootstrapDetailed'
            ]);
        return $result;
    }
    // 
    public function searchDetail($search,$key){
        $result = $this->where('name|keyword','like',"%".$search."%")->select();
        return $result;
    }
    // 活动商品
    public function findSpecial(){
        $result = $this->alias('d')
            ->leftJoin('__COLUMN__ c','d.cid = c.id')
            ->field('d.id,d.name,d.keyword,d.description,d.img,d.sum,d.price,d.new_price,d.payman,d.sort,d.status,c.title')
            ->where('d.new_price != 0 or d.new_price != 0.00')
            ->paginate(15,false,[
                'type'=>'BootstrapDetailed'
            ]);
        return $result;
    }
    // 活动商品排行榜
    public function sortFindSpecial(){
        $result = $this->alias('d')
            ->leftJoin('__COLUMN__ c','d.cid = c.id')
            ->field('d.id,d.name,d.keyword,d.description,d.img,d.sum,d.price,d.new_price,d.payman,d.sort,d.status,c.title')
            ->where('d.new_price != 0 or d.new_price != 0.00')
            ->order('d.payman desc')
            ->limit(5)
            ->select();
        return $result;
    }
    // 根据栏目展示
    public function selectCId($cid){
        $result = $this->alias('d')
            ->leftJoin('__COLUMN__ c','d.cid = c.id')
            ->where('d.cid',$cid)
            ->field('d.id,d.name,d.keyword,d.description,d.img,d.sum,d.price,d.new_price,d.payman,d.sort,d.status,c.title')
            ->paginate(1,false,[
                'type'=>'BootstrapDetailed'
            ]);
        return $result;
    }
    // 查看商品详情
    public function findId($id){
        $result = $this->alias('d')
            ->leftJoin('__COLUMN__ c','d.cid = c.id')
            ->where('d.id',$id)
            ->field('d.id,d.name,d.keyword,d.description,d.content,d.img,d.sum,d.price,d.new_price,d.payman,d.sort,d.status,c.title')
            ->find();
        return $result;
    }
    // 添加商品
    public function addDetail($data){
        $data['uid'] = session('uid');
        $data['price'] = sprintf("%.2f", $data['price']);
        $result = $this->save($data);
        return $result;
    }
    // 获取所属分类
    public function getParentById($id){
        $res = $this->field('id,cid')->find($id);
        return $res['cid'];
    }
    // 修改
}