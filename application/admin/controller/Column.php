<?php
namespace app\admin\controller;

use app\common\controller\Base;
use app\common\model\User;
use app\common\model\Column as ColumnModule;

class Column extends Base {
    protected function initialize(){
        parent::initialize();
        $this->modColumn = new ColumnModule();
    }
    public function index(){
        $columns = $this->modColumn->listTree();
        return $this->fetch('index',[
            'category'  =>  $columns,
        ]);
    }
    // 编辑栏目
    public function edit($id = null){
    	if (request()->isGet()) {
            $Name = '栏目修改';
            $columns = $this->modColumn->listTree();
    		$colId = request()->param('id');
            $colPId = $this->modColumn->getParentById($colId);
            $result = $this->modColumn->field('id,pid,title,img,keyword,description,status')->find($colId);
    		return $this->fetch('edit',[
                'category'  =>  $columns,
                'column'    =>  $result,
                'columnName'   =>  $Name,
                'colPId'     =>  $colPId,
            ]);
    	} elseif (request()->isPost()) {
    		$update = input('post.');
            $validate = validate('app\admin\validate\Column');
            if (!$validate->scene('edit')->check($update)) {
                $this->error($validate->getError());
            }
    		$res = $this->modColumn->save($update,['id'=>$update['id']]);
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
        $result = $this->modColumn->find($id);
        if ($result){
            $this->modColumn->where('id',$id)->delect();
            return $this->success('删除成功');
        } else
            return $this->error('删除失败');
    }
    // 栏目添加
    public function add(){
        $columns = $this->modColumn->listTree();
    	if(request()->isPost()){
    	    $data = input('post.');
            $validate = validate('app\admin\validate\Column');
            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
            }
            $res = $this->modColumn->addClumn($data);
            if ($res){
                return json(self::showReturnCode(1001,"添加成功"));
            }
            return json(self::showReturnCode(1007,"添加失败"));
    	}
    	return $this->fetch('add',[
    	    'category'  =>  $columns,
        ]);
    }
    // 上传栏目图片，可以不用上传栏目的图片
    public function columnUpImg(){
        $imgResult = request()->file('columnImg');
        if (empty($imgResult)) {
            return json(array('code'=>1,'errmsg'=>'上传失败,文件为空.'));
        }
        // $image = \think\Image::open(request()->file('ebookimg'));
        // $image->crop(317, 432)->save('http://www.hcadmin123.com/cart.jpg');
        $info = $imgResult->move('./public/uploads');
        if ($info) {
            $path = $info->getSaveName();
            $data['img'] = '\\public\\uploads\\'.$path;
            return json(array('code'=>0,'url'=>'/public/uploads/'.$path,'msg'=>'上传成功！','img'=>$data['img']));
        } else {
            return json(array('code'=>1,'errmsg'=>'上传失败'));
        }
    }
    // 状态修改
    public function status(){
        if (request()->isPost()){
            $id = input('post.id','','htmlspecialchars');
            $result = $this->modColumn->field('status')->find($id);
            ($result['status']=='1')?($result['status']='0'):($result['status']='1');
            $re = $this->modColumn->save(['status'=>$result['status']],['id'=>$id]);
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
        $result = $this->modColumn->where('id',$id)->find();
        if ($result){
            $res = $this->modColumn->save(['sort'=>$sort],['id'=>$id]);
            return json(self::showReturnCode('1001','排序成功'));
        }
        return json(\outResult(0, '修改失败'));
    }
}
