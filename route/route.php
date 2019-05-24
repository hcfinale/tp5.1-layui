<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('thinks', function () {
    return 'hello,ThinkPHP5!这个也是可以的';
});


Route::get('/', 'index/index');
Route::get('demo', 'index/demo');
Route::rule('goods', 'goods/index');
Route::rule('goods/:id', 'goods/index');
Route::rule('details/:id', 'goods/details');
return [

];
