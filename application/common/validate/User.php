<?php
namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    protected $rule =   [
        // 用户登录
        'logphone'  =>  'number|max:11',
        'logpasswd' =>  'require|min:4',
        // 用户注册
        'phone' =>  'number|max:11',
        'passwd'    =>  'require|min:6',
        'pnum'  =>  'require',
    ];

    protected $message  =   [
        'logphone.number' => '手机号不合法,必须为数字',
        'logphone.max'     => '手机号最大11位',
        'logpasswd.require'   => '登录密码不能为空',
        'logpasswd.min'  => '密码最少4位',

        'phone.number' => '手机号不合法,必须为数字',
        'phone.max'     => '手机号最大11位',
        'passwd.require'   => '登录密码不能为空',
        'passwd.min'  => '密码最少6位',
        'pnum'        => '验证码不能为空',
    ];
    protected $scene = [
        'onLogin'  =>  ['logphone','logpasswd'],
        'onReg'  =>  ['phone','passwd','pnum'],
    ];

}