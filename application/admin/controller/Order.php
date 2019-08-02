<?php
namespace app\admin\controller;

use app\common\controller\Base;
use think\Exception;
use app\common\model\User;
use app\common\model\Order as OrderModule;
use app\common\validate\Order as OrderValidate;

class Order extends Base {
    protected function initialize(){
        parent::initialize();
        $this->ordDetail = new OrderModule();
    }
    public function index(){
        $detail = $this->ordDetail->selectDetail();
        return $this->fetch('index',[
            'detail'  =>  $detail,
        ]);
    }
    // 编辑栏目
    public function edit($id = null){
        if (request()->isGet()) {
            $detailName = '商品修改';
            $columns = $this->ordDetail->listTree();
            $detailId = request()->param('id');
            $colPId = $this->modDetail->getParentById($detailId);
            $detailRes = $this->modDetail->field('id,cid,name,img,sum,price,new_price,keyword,description,content,status')->find($detailId);
            return $this->fetch('edit',[
                'category'  =>  $columns,
                'detail'    =>  $detailRes,
                'detailName'   =>  $detailName,
                'colPId'     =>  $colPId,
            ]);
        } elseif (request()->isPost()) {
            $update = input('post.');
            $update['price'] = sprintf("%.2f", input('post.price'));
            $validate = validate('app\admin\validate\Detail');
            if (!$validate->scene('edit')->check($update)) {
                $this->error($validate->getError());
            }
            $res = $this->modDetail->save($update,['id'=>$update['id']]);
            if($res){
                return self::showReturnCode('1001','更新成功');
            }
            return self::showReturnCode('1003','更新失败');
        }else{
            return $this->error('出现错误情况！');
        }
    }
    // 删除栏目
    public function del(){
        $id = $this->request->param('id');
        $result = $this->modDetail->find($id);
        if ($result){
            $this->modDetail->where('id',$id)->delect();
            return $this->success('删除成功');
        } else
            return $this->error('删除失败');
    }
    // 栏目添加
    public function add(){
        $columns = $this->modDetail->listTree();
        if(request()->isPost()){
            $data = input('post.');
            $validate = validate('app\admin\validate\Detail');
            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
            }
            $res = $this->modDetail->addDetail($data);
            if ($res){
                return json(self::showReturnCode(1001,"添加成功"));
            }
            return json(self::showReturnCode(1007,"添加失败"));
        }
        return $this->fetch('add',[
            'category'  =>  $columns,
        ]);
    }
    // 状态修改
    public function status(){
        if (request()->isPost()){
            $id = input('post.id','','htmlspecialchars');
            $result = $this->modDetail->field('status')->find($id);
            ($result['status']=='1')?($result['status']='0'):($result['status']='1');
            $re = $this->modDetail->save(['status'=>$result['status']],['id'=>$id]);
            if ($re){
                return json(self::showReturnCode(1001,"修改成功"));
            }else
                return json(self::showReturnCode(1002,"修改失败"));
        }
    }
    // 栏目排序ajax
    public function sort(){
        $id = $this->request->param('id');
        $sort = $this->request->param('sort');
        $result = $this->modDetail->where('id',$id)->find();
        if ($result){
            $res = $this->modDetail->save(['sort'=>$sort],['id'=>$id]);
            return json(self::showReturnCode('1001','排序成功'));
        }
        return json(\outResult(0, '修改失败'));
    }
}
