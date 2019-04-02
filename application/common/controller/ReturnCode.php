<?php
namespace app\common\controller;

use think\Controller;
class ReturnCode extends Controller
{
    /**
     * Power by Mikkle
     * QQ:776329498
     * @param $code
     * @param $data
     * @param $msg
     */
    static public $return_code = [
        '1001' => '操作成功',
        '1002' => '你想做什么呢', //非法的请求方式 非ajax
        '1003' => '请求参数错误', //如参数不完整,类型不正确
        '1004' => '请先登陆再访问', //未登录 或者 未授权
        '1005' => '请求授权不符', ////非法的请求  无授权查看
        '1006' => '数据加载失败', //
        '1010' => '数据不存在', //
        '1020' => '验证码输入不正确', //
        '1021' => '用户账号或密码错误', //
        '1022' => '用户账号被禁用', //
        '1030' => '数据操作失败', //
    ];
}