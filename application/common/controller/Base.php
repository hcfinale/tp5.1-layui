<?php
namespace app\common\controller;

use think\Db;
use think\Session;
use think\Request;
use think\Cache;
use think\Loader;
use think\Exception;
use Auth\Auth;
use app\common\model\User;
abstract class Base extends ReturnCode {

    protected function initialize(){
        $module = request()->module();
        $controller = request()->controller();
        $action = request()->action();
        $uid = session('uid');
        if (!User::isLogin()) {
            $this->error('请登录后再说！', url('index/index/index'));
        }
        $auth = new auth();
        if(!$uid || request()->time() - session('logintime') > 8*60*60){
            session(null);
            cookie(null);
            $this->error('非法访问,请重新登录','admin/Login/login');
        }elseif(session('uid') == '2') {
            return true;
        }
        if(!$auth->check($module.'/'.$controller.'/'.$action, session('uid'))){
            $this->error('你没有权限访问','index/index/index');
        }
    }
    // 用户管理
    public function userAuth($uid = null){
        $module = request()->module();
        $controller = request()->controller();
        $action = request()->action();
        $auth = new Auth();
        if ($auth->check($module.'/'.$controller . '/' . $action, $uid)){
            return true;
        }else {
            return false;
        }
    }
    /**
     * Power by Mikkle
     * QQ:776329498
     * @param string $code
     * @param array $data
     * @param string $msg
     * @return array
     */
    static public function showReturnCode($code = '', $data = [], $msg = '')
    {
        $return_data = [
            'code' => '500',
            'msg' => '未定义消息',
            'data' => $code == 1001 ? $data : [],
        ];
        if (empty($code)) return $return_data;
        $return_data['code'] = $code;
        if(!empty($msg)){
            $return_data['msg'] = $msg;
        }else if (isset(ReturnCode::$return_code[$code]) ) {
            $return_data['msg'] = ReturnCode::$return_code[$code];
        }
        return $return_data;
    }

    static public function showReturnCodeWithOutData($code = '', $msg = '')
    {
        return self::showReturnCode($code,[],$msg);

    }
    /**
     * 数据库字段 网页字段转换
     * #User: Mikkle
     * #Email:776329498@qq.com
     * #Date:
     * @param $array 转化数组
     * @return 返回数据数组
     */
    protected function buildParam($array=[])
    {
        $data=[];
        if (is_array($array)&&!empty($array)){
            foreach( $array as $item=>$value ){
                $data[$item] = $this->request->param($value);
            }
        }
        return $data;
    }
    public function _empty(){
        $this->error('您访问了一个不存在的方法','admin/index/demo');
    }
}
