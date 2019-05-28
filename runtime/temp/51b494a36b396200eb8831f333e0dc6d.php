<?php /*a:3:{s:38:"E:\www\tp5\/tpl/admin/index\index.html";i:1557971930;s:40:"E:\www\tp5\/tpl/admin/Public\header.html";i:1555291684;s:40:"E:\www\tp5\/tpl/admin/Public\footer.html";i:1555291684;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/public/static/admin/assets/css/layui.css">
    <link rel="stylesheet" href="/public/static/admin/assets/common.css">
    <link rel="stylesheet" href="/public/static/admin/assets/css/admin.css">
    <link rel="icon" href="/public/static/admin/favicon.ico">
    <title>管理后台</title>
</head>
<body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header custom-header">
            
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item slide-sidebar" lay-unselect>
                    <a href="javascript:;" class="icon-font"><i class="ai ai-menufold"></i></a>
                </li>
            </ul>

            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;">BieJun</a>
                    <dl class="layui-nav-child">
                        <dd><a href="">帮助中心</a></dd>
                        <dd><a href="<?php echo url('login/logout'); ?>">退出</a></dd>
                    </dl>
                </li>
            </ul>
        </div>

        <div class="layui-side custom-admin">
            <div class="layui-side-scroll">

                <div class="custom-logo">
                    <img src="/public/static/admin/assets/images/logo.png" alt=""/>
                    <h1>Layui Admin</h1>
                </div>
                <ul id="Nav" class="layui-nav layui-nav-tree">
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe609;</i>
                            <em>主页</em>
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a href="<?php echo url('index/statistics'); ?>">控制台</a></dd>
                            <dd><a href="<?php echo url('index/demo'); ?>">测试</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe649;</i>
                            <em>类别</em>
                        </a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a href="javascript:;">栏目</a>
                                <dl class="layui-nav-child">
                                    <dd><a href="<?php echo url('column/index'); ?>">栏目管理</a></dd>
                                    <dd><a href="<?php echo url('column/add'); ?>">栏目添加</a></dd>
                                </dl>
                            </dd>
                            <dd>
                                <a href="javascript:;">商品</a>
                                <dl class="layui-nav-child">
                                    <dd><a href="<?php echo url('detail/index'); ?>">商品管理</a></dd>
                                    <dd><a href="<?php echo url('detail/add'); ?>">商品添加</a></dd>
                                </dl>
                            </dd>
                            <dd>
                                <a href="javascript:;">订单</a>
                                <dl class="layui-nav-child">
                                    <dd><a href="<?php echo url('index/shop_cart/order'); ?>">订单一览表</a></dd>
                                </dl>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe857;</i>
                            <em>组件</em>
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a href="<?php echo url('index/form'); ?>">表单</a></dd>
                            <dd>
                                <a href="javascript:;">页面</a>
                                <dl class="layui-nav-child">
                                    <dd>
                                        <a href="<?php echo url('login/login'); ?>">登录页</a>
                                    </dd>
                                </dl>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe612;</i>
                            <em>用户</em>
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a href="<?php echo url('users/index'); ?>">用户组</a></dd>
                            <dd><a href="<?php echo url('rules/index'); ?>">权限配置</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>

        <div class="layui-body">
             <div class="layui-tab app-container" lay-allowClose="true" lay-filter="tabs">
                <ul id="appTabs" class="layui-tab-title custom-tab"></ul>
                <div id="appTabPage" class="layui-tab-content"></div>
            </div>
        </div>

        <div class="layui-footer">
            <p>© 2018 更多模板：<a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>
        </div>

        <div class="mobile-mask"></div>
    </div>
    	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="/public/static/admin/assets/layui.all.js"></script>
    <script src="/public/static/admin/assets/common.js"></script>
    <script src="/public/static/admin/home.js" data-main="home"></script>
</body>
</html>