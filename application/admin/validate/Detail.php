<?php
namespace app\admin\validate;

use think\Validate;

class Detail extends Validate
{
    protected $rule =   [
        'cid'   =>  'require|number',
        'name' =>  'require|max:50|token',
        'sum'   => 'number|between:1,99999',
        'price' =>  'require',
    ];

    protected $message  =   [
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过50个字符',
        'sum.number'   => '商品个数应当为数字',
        'sum.between'  => '商品个数要在1到99999之间',
        'price.require'        => '价格不能为空',
    ];
    protected $scene = [
        'add'   =>  ['cid','name','sum','price'],
        'edit'   =>  ['cid','name','sum','price'],
    ];
}