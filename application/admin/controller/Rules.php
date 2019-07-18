<?php
namespace app\admin\controller;

use app\common\controller\Base;
use app\common\model\Rules as RulesModel;
use think\Exception;
class Rules extends Base {
    public function initialize(){
        parent::initialize();
        $this->modRules = new RulesModel();
    }
    public function index(){
    	$rules = $this->modRules->splitRules();
        return $this->fetch('index',[
        	'rules'	=>	$rules,
        ]);
    }
    // 编辑栏目
    public function edit($id = null){
    	if (request()->isGet()) {
    		$ruleId = request()->param('id');
    		$rulePId = $this->modRules->getParentById($ruleId);
    		if ($rulePId[0]&&$rulePId['code']=='1001') {
    			$ruleName = '权限修改';
	            $lists = $this->modRules->getContro();
	            $rules = $this->modRules->find($ruleId);
	    		return $this->fetch('edit',[
	                'lists'  =>  $lists,
	                'rules'    =>  $rules,
	                'ruleName'   =>  $ruleName,
	                'rulePId'     =>  $rulePId['data'],
	            ]);
    		}else{
    			return json(['code'=>$rulePId['code'],'msg'=>$rulePId['msg']]);
    		}
    	} elseif (request()->isPost()) {
    		$update = input('post.');
            $validate = validate('app\admin\validate\Rules');
            if (!$validate->scene('changsRules')->check($update)) {
                $this->error($validate->getError());
            }
    		// $res = $this->modRules->save($update,['id'=>$update['id']]);
            $res = $this->modRules->editRules($update);
    		if($res){
                return self::showReturnCode('1001','更新成功');
            }
            return self::showReturnCode('1003','更新失败');
    	}else{
    	    return $this->error('出现错误情况！');
        }
    }
    /**
    // 删除栏目
    public function del(){
        $id = $this->request->param('id');
        $result = $this->modColumn->find($id);
        if ($result){
            $this->modColumn->where('id',$id)->delect();
            return $this->success('删除成功');
        } else
            return $this->error('删除失败');
    }
    **/
    // 权限添加
    public function add(){
        $rules = $this->modRules->getContro();
    	if(request()->isPost()){
    	    $data = input('post.');
            $validate = validate('app\admin\validate\Rules');
            if (!$validate->scene('changsRules')->check($data)) {
                $this->error($validate->getError());
            }
            $res = $this->modRules->addRules($data);
            if ($res){
                return json(self::showReturnCode(1001,"添加成功"));
            }
            return json(self::showReturnCode(1007,"添加失败"));
    	}
    	return $this->fetch('add',[
    	    'rules'  =>  $rules,
        ]);
    }

    // 状态修改
    public function status(){
        if (request()->isPost()){
            $id = input('post.id','','htmlspecialchars');
            $result = $this->modRules->field('status')->find($id);
            ($result['status']=='1')?($result['status']='0'):($result['status']='1');
            $re = $this->modRules->save(['status'=>$result['status']],['id'=>$id]);
            if ($re){
                return json(self::showReturnCode(1001,"修改成功"));
            }else
                return json(self::showReturnCode(1002,"修改失败"));
        }
    }
}
