<?php /*a:4:{s:37:"E:\www\tp5\/tpl/index/user\index.html";i:1562728441;s:40:"E:\www\tp5\/tpl/index/Public\header.html";i:1562057687;s:41:"E:\www\tp5\/tpl/index/Public\top_nav.html";i:1562923097;s:46:"E:\www\tp5\/tpl/index/Public\category_nav.html";i:1562642583;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="/public/static/index/static/css/main.css">
	<link rel="stylesheet" type="text/css" href="/public/static/index/layui/css/layui.css">
	<script type="text/javascript" src="/public/static/index/layui/layui.js"></script>
</head>
<body>
<body>
<div class="site-nav-bg">
    <div class="site-nav w1200">
      <p class="sn-back-home">
        <i class="layui-icon layui-icon-home"></i>
        <a href="/">首页</a>
      </p>
      <div class="sn-quick-menu">
        <div class="login"><?php if(empty(app('request')->session('user'))): ?><a href="<?php echo url('user/login'); ?>">登录 / 注册</a><?php else: ?>欢迎归来：<?php echo htmlentities(app('request')->session('user')); ?><?php endif; ?></div>
        <div class="sp-cart"><a href="<?php echo url('shop_cart/cart'); ?>">购物车</a><?php if(empty(app('request')->session('user'))): else: ?><span><?php echo htmlentities(app('request')->session('cartNum')); ?></span><?php endif; ?></div>
      </div>
    </div>
  </div>

  <div class="header">
    <div class="headerLayout w1200">
      <div class="headerCon">
        <h1 class="mallLogo">
          <a href="/" title="母婴商城">
            <img src="/public/static/index/static/img/logo.png">
          </a>
        </h1>
        <div class="mallSearch">
          <form action="" class="layui-form" method="post">
            <input type="text" name="searchKey" required  lay-verify="required" autocomplete="off" class="layui-input" placeholder="请输入需要的商品">
            <button class="layui-btn" lay-submit lay-filter="search">
                <i class="layui-icon layui-icon-search"></i>
            </button>
            <input type="hidden" name="key" value="1">
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="content content-nav-base login-content">
        <div class="main-nav">
      <div class="inner-cont0">
        <div class="inner-cont1 w1200">
          <div class="inner-cont2">
            <a href="<?php echo url('goods/index'); ?>">所有商品</a>
            <a href="<?php echo url('goods/special'); ?>">今日团购</a>
            <a href="http://tb.53kf.com/code/client/10134569/1">母婴资讯</a>
            <a href="<?php echo url('goods/about'); ?>">关于我们</a>
          </div>
        </div>
      </div>
    </div>
    <div class="login-bg">
      <div class="login-cont w1200">
        <div class="layui-tab form-box">
          <ul class="layui-tab-title">
            <li class="layui-this">用户登录</li>
            <li>用户注册</li>
          </ul>
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
              <form class="layui-form" method="post" name="dologin" id="dologin">
                <legend>手机号登录</legend>
                <div class="layui-form-item">
                  <div class="layui-inline iphone">
                    <div class="layui-input-inline">
                      <i class="layui-icon layui-icon-cellphone iphone-icon"></i>
                      <input type="tel" name="logphone" id="logphone" lay-verify="required|phone" placeholder="请输入手机号" autocomplete="off" class="layui-input">
                    </div>
                  </div>
                  <div class="layui-inline passwd">
                    <div class="layui-input-inline">
                      <i class="layui-icon layui-icon-password passwd-icon"></i>
                      <input type="password" name="logpasswd" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                  </div>
                </div>
                <div class="layui-form-item login-btn">
                  <div class="layui-input-block">
                    <button class="layui-btn" lay-filter="login" lay-submit="">登录</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="layui-tab-item">
              <form class="layui-form" method="post" name="doregister" id="doregister">
                <legend>手机号注册</legend>
                <div class="layui-form-item">
                  <div class="layui-inline iphone">
                    <div class="layui-input-inline">
                      <i class="layui-icon layui-icon-cellphone iphone-icon"></i>
                      <input type="text" name="phone" id="phone" lay-verify="required|phone" placeholder="请输入手机号" autocomplete="off" class="layui-input">
                    </div>
                  </div>
                  <div class="layui-inline passwd">
                    <div class="layui-input-inline">
                      <i class="layui-icon layui-icon-password passwd-icon"></i>
                      <input type="password" name="passwd" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                  </div>
                  <div class="layui-inline veri-code">
                    <div class="layui-input-inline">
                      <input id="pnum" type="text" name="pnum" lay-verify="required" placeholder="请输入验证码" autocomplete="off" class="layui-input">
                      <input type="button" class="layui-btn" id="find" value="验证码" /> 
                    </div>
                  </div>
                </div>
                <div class="layui-form-item login-btn">
                  <div class="layui-input-block">
                    <button class="layui-btn" lay-filter="register" lay-submit="">登录</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="footer">
    <div class="ng-promise-box">
      <div class="ng-promise w1200">
        <p class="text">
          <a class="icon1" href="javascript:;">7天无理由退换货</a>
          <a class="icon2" href="javascript:;">满99元全场免邮</a>
          <a class="icon3" style="margin-right: 0" href="javascript:;">100%品质保证</a>
        </p>
      </div>
    </div>
    <div class="mod_help w1200">                                     
      <p>
        <a href="javascript:;">关于我们</a>
        <span>|</span>
        <a href="javascript:;">帮助中心</a>
        <span>|</span>
        <a href="javascript:;">售后服务</a>
        <span>|</span>
        <a href="javascript:;">母婴资讯</a>
        <span>|</span>
        <a href="javascript:;">关于货源</a>
      </p>
      <p class="coty">母婴商城版权所有 &copy; 2012-2020</p>
    </div>
  </div>
  <script type="text/javascript">
   layui.config({
     base: '/public/static/index/static/js/util/' //你存放新模块的目录，注意，不是layui的模块目录
    }).use(['jquery','form','element'],function(){
        var $ = layui.$,form = layui.form,element = layui.element;
        $("#find").click(function() {
            if(!/^1\d{10}$/.test($("#phone").val())){
              layer.msg("请输入正确的手机号");
              return false;
            }
            var obj=this;
            $.ajax({
                type:"get",
                url:"<?php echo url('user/mnSms'); ?>",
                data:{'phone':$("#phone").val()},
                dataType:"json",//返回的
                success:function(data) {
                  console.log(data);
                    if(data.code=='1001'){
                        $("#find").addClass("layui-btn-disabled");
                        $('#find').attr('disabled',"true");
                        settime(obj);
                        // $("#msg").text(data.msg);
                    }else{
                        layer.msg(data.msg);
                    }
                },
                error:function(msg) {
                    console.log(msg);
                }
            }); 
        });
        var countdown=60; 
        function settime(obj) { 
        if (countdown == 0) { 
            obj.removeAttribute("disabled"); 
            obj.classList.remove("layui-btn-disabled")
            obj.value="获取验证码"; 
            countdown = 60; 
            return;
        } else {
            obj.value="重新发送(" + countdown + ")"; 
            countdown--; 
        } 
        setTimeout(function() { 
            settime(obj) }
            ,1000)
        };
        // 手机号注册
        form.on('submit(register)', function(data){
            var param = data.field;
            $.ajax({
                type:'post',
                url:"<?php echo url('user/register'); ?>",
                data:param,
                dataType:'JSON',
                success:function(res){
                    if (res.code==1001){
                        layer.msg(res.msg);
                        setTimeout(function(){
                          location.href = '<?php echo url("index/index"); ?>';
                        },2000);
                    } else if(res.code==1004){
                        layer.msg(res.msg);
                        setTimeout(function(){
                          location.href = '<?php echo url("user/login"); ?>';
                        },2000);
                    }
                },
                error:function (ress) {
                    layer.msg(ress);
                    setTimeout(function(){
                      location.href = '<?php echo url("user/login"); ?>';
                    },2000);
                }
            })
            return false;
        });
        //监听提交登录
        form.on('submit(login)', function(data){
            var param = data.field;
            console.log(param);
            $.ajax({
                type:'post',
                url:"<?php echo url('user/dologin'); ?>",
                data:param,
                dataType:'JSON',
                success:function(res){
                    if (res.code==1001){
                        layer.msg(res.msg);
                        setTimeout(function(){
                          location.href = '<?php echo url("index/index"); ?>';
                        },2000);
                    } else if(res.code==1004){
                        layer.msg(res.msg);
                        setTimeout(function(){
                          location.reload();
                        },2000);
                    }
                },
                error:function (ress) {
                    layer.msg(ress);
                    setTimeout(function(){
                      location.href = '<?php echo url("user/login"); ?>';
                    },2000);
                }
            })
            return false;
        });
    })
  </script>
</body>
</html>