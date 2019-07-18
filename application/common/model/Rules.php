<?php
//在模型里单独设置数据库连接信息
namespace app\common\model;

use think\Model;
use think\db;

class Rules extends Model
{
    protected $pk = 'id';
    protected $name = 'AuthRule';
    // 排序
    public function splitRules(){
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
        // 对不是子集的控制器进行对其name的分割，使模块、控制器、方法进行分离
        foreach ($arr as $key => $value) {
        	if ($value['pid']!=0) {
	    		$arrs = explode('/',$value['name']);
	    		$value['module'] = $arrs[0];
	    		$value['controller'] = $arrs[1];
	    		$value['action'] = $arrs[2];
        	}
        }
        return $arr;
    }
    // 获取控制器
    public function getContro(){
    	$data = $this->where('pid','eq',0)->select();
    	return $data;
    }
    // 根据传来的id获取其父级|自己的pid为0的栏目信息
    public function getParentById($id = 1){
    	if ($id == 0) {
    		return [false,'code'=>'1004','msg'=>'非法操作'];
    	}else{
    		$result = $this->find($id);
    		if ($result['pid'] == 0) {
    			return [true,'code'=>'1001','msg'=>'当前修改的是控制器','data'=>$id];
    		}else{
    			$res = $this->find($result['pid']);
    			return [true,'code'=>'1001','msg'=>'当前修改的是方法','data'=>$res['id']];
    		}
    	}
    }
    // 添加权限
    public function addRules($data){
    	// 启动事务，启动事务之后时间在模型中不会自动更新上去。
    	Db::startTrans();
    	try {
    		if ($data['pid'] == 0) {
    			$data['name'] = 'admin/'.$data['name'];
    			$result = $this->allowField(true)->save($data);
    			// 提交事务
                Db::commit();
        		return $result;
    		} else {
    			$res = $this->allowField(true)->where(['id'=>$data['pid']])->find();
    			$arrs = explode('/',$res['name']);
    			$data['name'] = $arrs[0].'/'.$arrs[1].'/'.$data['name'];
    			$result = $this->allowField(true)->save($data);
    			// 提交事务
                Db::commit();
        		return $result;
    		}
    	} catch (\Exception $e) {
    		// 回滚事务
            Db::rollback();
            return false;
    	}
    }
    // 修改权限
    public function editRules($data){
        // 启动事务，启动事务之后时间在模型中不会自动更新上去。
        Db::startTrans();
        try {
            if ($data['pid'] == 0) {
                $data['name'] = 'admin/'.$data['name'];
                $result = $this->allowField(true)->save($data,['id'=>$data['id']]);
                // 提交事务
                Db::commit();
                return $result;
            } else {
                $res = $this->allowField(true)->where(['id'=>$data['pid']])->find();
                $arrs = explode('/',$res['name']);
                $data['name'] = $arrs[0].'/'.$arrs[1].'/'.$data['name'];
                $result = $this->allowField(true)->save($data,['id'=>$data['id']]);
                // 提交事务
                Db::commit();
                return $result;
            }
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return false;
        }
    }
}