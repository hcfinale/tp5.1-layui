<?php
namespace app\admin\validate;

use think\Validate;

class Column extends Validate
{
    protected $rule =   [
        'pid'   =>  'require|number',
        'title' =>  'require|max:50|token',
    ];

    protected $message  =   [
        'pid.require'   =>  '栏目字段不允许为空，非法操作',
        'title.require' => '名称必须',
        'title.max'     => '名称最多不能超过50个字符',
    ];
    protected $scene = [
        'add'   =>  ['pid','title'],
        'edit'   =>  ['cid','name'],
    ];
}