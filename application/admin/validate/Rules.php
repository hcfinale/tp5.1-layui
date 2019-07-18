<?php
namespace app\admin\validate;

use think\Validate;

class Rules extends Validate
{
    protected $rule =   [
        'pid'   =>  'require|number',
        'title' =>  'require|max:50',
        'name'  =>  'require',
        'status'    =>  'require|number'
    ];

    protected $message  =   [
        'pid.require'   =>  '控制器不能为空，非法操作',
        'pid.number'    =>  '非法操作',
        'title.require' => '名称必须',
        'title.max'     => '名称最多不能超过50个字符',
        'name.require'  =>  '控制器|方法不存在',
        'status.require'    =>  '非法操作，状态不存在'
    ];
    protected $scene = [
        'changsRules'   =>  ['pid','title','name','status'],
    ];
}