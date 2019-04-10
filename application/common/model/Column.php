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
        $data = $this->field('id,pid,uid,title,keyword,sort,status')->select();
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
    // 添加栏目
    public function addClumn($data){
        $data['uid'] = session('uid');
        $result = $this->save($data);
        return $result;
    }
    // 获取腹肌栏目
    public function getParentById($id){
        $res = $this->field('id,pid')->find($id);
        if ($res['pid']!=0){
            return $res['pid'];
        }
        return $res['id'];
    }
    // 首页导航
    public function getNavCategory($id = 0){
        $result = $this->where(['status'=>'1','pid'=>$id])->field('id,pid,title')->select();
        $arr = array();
        if (!empty($result)){
            foreach ($result as $v){
                $v['child'] = self::getNavCategory($v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
}