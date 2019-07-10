<?php /*a:4:{s:38:"E:\www\tp5\/tpl/index/goods\index.html";i:1562639407;s:40:"E:\www\tp5\/tpl/index/Public\header.html";i:1562057687;s:41:"E:\www\tp5\/tpl/index/Public\top_nav.html";i:1562728028;s:46:"E:\www\tp5\/tpl/index/Public\category_nav.html";i:1562642583;}*/ ?>
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

  <div class="content content-nav-base commodity-content">
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
    <div class="commod-cont-wrap">
      <div class="commod-cont w1200 layui-clear">
        <div class="left-nav">
          <div class="title">所有分类</div>
          <div class="list-box">
            <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
            <dl>
              <dt><?php echo htmlentities($cate['title']); ?></dt>
              <?php if(is_array($cate['child']) || $cate['child'] instanceof \think\Collection || $cate['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cate['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <dd><a href="<?php echo url('goods/index',['id'=>$vo['id']]); ?>" <?php if($vo['id'] == $id): ?>style="color:#ff0000"<?php endif; ?>><?php echo htmlentities($vo['title']); ?></a></dd>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </dl>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
        </div>
        <div class="right-cont-wrap">
          <div class="right-cont">
            <div class="sort layui-clear">
              <a class="active" href="javascript:;" event = 'volume'>销量</a>
              <a href="javascript:;" event = 'price'>价格</a>
              <a href="javascript:;" event = 'newprod'>新品</a>
              <a href="javascript:;" event = 'collection'>收藏</a>
            </div>
            <div class="prod-number">
              <span><?php echo htmlentities($count); ?></span>
            </div>
            <div class="cont-list layui-clear" id="list-cont">
              <?php if(is_array($goods) || $goods instanceof \think\Collection || $goods instanceof \think\Paginator): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <div class="item">
                <div class="img">
                  <a href="<?php echo url('goods/details',['id'=>$vo['id']]); ?>"><img src="<?php echo htmlentities($vo['img']); ?>" title="<?php echo htmlentities($vo['name']); ?>" style="display: block;margin: 0 auto;"></a>
                </div>
                <div class="text">
                  <p class="title"><?php echo htmlentities($vo['name']); ?></p>
                  <p class="price">
                    <span class="pri"><?php if(($vo['new_price']=='0') or ($vo['new_price']=='0.00')): ?>￥<?php echo htmlentities(decimal($vo['price'])); else: ?>活动价：￥<?php echo htmlentities(decimal($vo['new_price'])); ?><?php endif; ?></span>
                    <span class="nub"><?php echo htmlentities($vo['payman']); ?>付款</span>
                  </p>
                </div>
              </div>
              <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <!-- 模版引擎导入 -->
            <!-- <script type="text/html" id="demo">
              {{# layui.each(d.menu.milk.content,function(index,item){}}
                <div class="item">
                  <div class="img">
                    <a href="javascript:;"><img src="{{item.img}}"></a>
                  </div>
                  <div class="text">
                    <p class="title"></p>
                    <p class="price">
                      <span class="pri">{{item.pri}}</span>
                      <span class="nub">{{item.nub}}</span>
                    </p>
                  </div>
                </div>
              {{# }); }}
            </script> -->
            <div id="demo0" style="text-align: center;">
              <?php echo $page; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>

  layui.config({
    base: '/public/static/index/static/js/util/' //你存放新模块的目录，注意，不是layui的模块目录
  }).use(['mm','laypage','jquery'],function(){
      var laypage = layui.laypage,$ = layui.$,
     mm = layui.mm;



    // 模版引擎导入
    //  var html = demo.innerHTML;
    //  var listCont = document.getElementById('list-cont');
    //  // console.log(layui.router("#/about.html"))
    // mm.request({
    //     url: '../json/commodity.json',
    //     success : function(res){
    //       console.log(res)
    //       listCont.innerHTML = mm.renderHtml(html,res)
    //     },
    //     error: function(res){
    //       console.log(res);
    //     }
    //   })
    $('.main-nav .inner-cont2 a').eq(0).addClass('active');
    $('.sort a').on('click',function(){
      $(this).addClass('active').siblings().removeClass('active');
    })
    $('.list-box dt').on('click',function(){
      if($(this).attr('off')){
        $(this).removeClass('active').siblings('dd').show()
        $(this).attr('off','')
      }else{
        $(this).addClass('active').siblings('dd').hide()
        $(this).attr('off',true)
      }
    })

});
</script>


</body>
</html>