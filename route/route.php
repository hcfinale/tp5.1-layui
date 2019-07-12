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

Route::get('thinks/:name', function ($name = null) {
    return $name;
});

// 路由重命名和其他的get、post等方法的命名方法不一样
Route::alias('admins','admin/index/index');
Route::alias('login','admin/login/login');
Route::alias('cart','index/shop_cart/cart');

Route::get('/', 'index/index');
Route::get('demo', 'index/demo');
Route::get('goods', 'goods/index');
Route::get('goods/:id', 'goods/index');
Route::get('details/:id', 'goods/details');
// 匹配所有路由
Route::any('special','goods/special');
Route::any('about','goods/about');


return [

];
