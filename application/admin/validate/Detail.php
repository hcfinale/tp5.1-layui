<?php
namespace app\admin\validate;

use think\Validate;

class Detail extends Validate
{
    protected $rule =   [
        'cid'   =>  'require|number',
        'name'  => 'require|max:50',
        'sum'   => 'require|number|min:1',
        'price' => 'require',
        'new_price' =>  'require',
        'keyword'   =>  'require',
        'description'   =>  'require',
        'content'   =>  'require',
    ];

    protected $message  =   [
        'cid.require'   =>  '父亲id必须存在',
        'cid.number'    =>  '栏目id非法',
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过50个字符',
        'sum.require'   =>  '商品数量必须存在，不能为空',
        'sum.number'   => '商品数量必须是数字',
        'sum.min'   => '商品数量最少为1',
        'price.require' => '价格不能为空',
        'new_price.require' =>  '商品活动价格',
    ];

    protected $scene = [
        'edit'  =>   ['cid','name','sum','price','new_price'],
        'add'   =>  ['cid','name','sum','price','new_price','content'],
    ];
}