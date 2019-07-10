<?php /*a:4:{s:40:"E:\www\tp5\/tpl/index/goods\special.html";i:1562650607;s:40:"E:\www\tp5\/tpl/index/Public\header.html";i:1562057687;s:41:"E:\www\tp5\/tpl/index/Public\top_nav.html";i:1562650428;s:46:"E:\www\tp5\/tpl/index/Public\category_nav.html";i:1562642583;}*/ ?>
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
        <div class="login"><?php if(empty(app('request')->session('user'))): ?><a href="<?php echo url('user/login'); ?>">登录</a><?php else: ?>欢迎归来：<?php echo htmlentities(app('request')->session('user')); ?><?php endif; ?></div>
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
          <form action="" class="layui-form" novalidate>
            <input type="text" name="title" required  lay-verify="required" autocomplete="off" class="layui-input" placeholder="请输入需要的商品">
            <button class="layui-btn" lay-submit lay-filter="formDemo">
                <i class="layui-icon layui-icon-search"></i>
            </button>
            <input type="hidden" name="" value="">
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="content content-nav-base buytoday-content">
    <div id="list-cont">
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
      <div class="banner-box">
        <div class="banner"></div>
      </div>
      <div class="product-list-box">
        <div class="product-list w1200">  
          <div class="tab-title">
            <a href="javascript:;" class="active tuang" data-content="tuangou">今日团购</a>
            <a href="javascript:;" data-content="yukao">明日预告</a>
          </div>
          <div class="list-cont" cont = 'tuangou'>
            <div class="item-box layui-clear">
              <?php if(is_array($special) || $special instanceof \think\Collection || $special instanceof \think\Paginator): $i = 0; $__LIST__ = $special;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <div class="item">
                <a href="<?php echo url('goods/details',['id'=>$vo['id']]); ?>"><img src="<?php echo htmlentities($vo['img']); ?>" title="<?php echo htmlentities($vo['name']); ?>" style="display: block;margin: 0 auto;"></a>
                <div class="text-box">
                  <p class="title"><?php echo htmlentities($vo['name']); ?></p>
                  <p class="plic">
                    <span class="ciur-pic">￥<?php echo htmlentities(decimal($vo['new_price'])); ?></span>
                    <span class="Ori-pic">￥<?php echo htmlentities(decimal($vo['price'])); ?></span>
                    <span class="discount"><?php echo htmlentities($vo['price']/$vo['new_price']); ?>折</span>
                  </p>
                </div>
              </div>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div id="demo0" style="text-align: center;">
              <?php echo $page; ?>
            </div>
          </div>
          <div class="list-cont layui-hide" cont = 'yukao'>
            <div class="item-box layui-clear">
              <?php if(is_array($special) || $special instanceof \think\Collection || $special instanceof \think\Paginator): $i = 0; $__LIST__ = $special;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <div class="item">
                <a href="<?php echo url('goods/details',['id'=>$vo['id']]); ?>"><img src="<?php echo htmlentities($vo['img']); ?>" title="<?php echo htmlentities($vo['name']); ?>" style="display: block;margin: 0 auto;"></a>
                <div class="text-box">
                  <p class="title"><?php echo htmlentities($vo['name']); ?></p>
                  <p class="plic">
                    <span class="ciur-pic">￥<?php echo htmlentities(decimal($vo['new_price'])); ?></span>
                    <span class="Ori-pic">￥<?php echo htmlentities(decimal($vo['price'])); ?></span>
                    <span class="discount"><?php echo htmlentities($vo['price']/$vo['new_price']); ?>折</span>
                  </p>
                </div>
              </div>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div id="demo0" style="text-align: center;">
              <?php echo $page; ?>
            </div>
          </div>
        </div>  
      </div>
      <div class="footer-wrap">
        <div class="footer w1200">
          <div class="title">
            <h3>团购销量榜</h3>
          </div>
          <div class="list-box layui-clear" id="footerList">
            <?php if(is_array($orderSpecial) || $orderSpecial instanceof \think\Collection || $orderSpecial instanceof \think\Paginator): $index = 0;$__LIST__ = is_array($orderSpecial) ? array_slice($orderSpecial,0,3, true) : $orderSpecial->slice(0,3, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($index % 2 );++$index;?>
            <div class="item">
              <a href="<?php echo url('goods/details',['id'=>$vo['id']]); ?>"><img src="<?php echo htmlentities($vo['img']); ?>" title="<?php echo htmlentities($vo['name']); ?>"></a>
              <div class="text">
                <div class="right-title-number"><?php echo htmlentities($index); ?></div>
                <div class="commod">
                  <p><?php echo htmlentities($vo['name']); ?></p>
                  <span>￥<?php echo htmlentities(decimal($vo['new_price'])); ?></span>
                </div>
              </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
  layui.config({
    //你存放新模块的目录，注意，不是layui的模块目录
    base: '/public/static/index/static/js/util/'
  }).use(['mm','laypage','jquery'],function(){
    var laypage = layui.laypage,$ = layui.$,mm = layui.mm;

    $('.main-nav .inner-cont2 a').eq(1).addClass('active');

    $('body').on('click','*[data-content]',function(){
      $(this).addClass('active').siblings().removeClass('active')
      var dataConte = $(this).attr('data-content');
      $('*[cont]').each(function(i,item){
        var itemCont = $(item).attr('cont');
        console.log(item)
        if(dataConte === itemCont){
          $(item).removeClass('layui-hide');
        }else{
          $(item).addClass('layui-hide');
        }
      })
    })
});
</script>
</body>
</html>