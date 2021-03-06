<?php /*a:4:{s:40:"E:\www\tp5\/tpl/index/goods\details.html";i:1563152524;s:40:"E:\www\tp5\/tpl/index/Public\header.html";i:1562057687;s:41:"E:\www\tp5\/tpl/index/Public\top_nav.html";i:1562923097;s:46:"E:\www\tp5\/tpl/index/Public\category_nav.html";i:1562642583;}*/ ?>
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

<div class="content content-nav-base datails-content">
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
  <div class="data-cont-wrap w1200">
    <div class="crumb">
      <a href="javascript:;">首页</a>
      <span>></span>
      <a href="javascript:;">所有商品</a>
      <span>></span>
      <a href="javascript:;">产品详情</a>
    </div>
    <div class="product-intro layui-clear">
      <form class="layui-form" method="post">
        <input type="hidden" id="did" name="did" value="<?php echo htmlentities($res['id']); ?>">
        <div class="preview-wrap">
          <a href="javascript:;"><img src="<?php echo htmlentities($res['img']); ?>" width="100%"></a>
        </div>
        <div class="itemInfo-wrap">
          <div class="itemInfo">
            <div class="title">
              <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($res['name']); ?></h4>
              <span><i class="layui-icon layui-icon-rate-solid"></i>收藏</span>
            </div>
            <div class="summary">
              <p class="reference"><span>参考价</span> <del>￥<?php echo htmlentities(decimal($res['price'])); ?></del></p>
              <p class="activity"><span>活动价</span><strong class="price"><i>￥</i><?php if(($res['new_price']=='0') or ($res['new_price']=='0.00')): ?><?php echo htmlentities(decimal($res['price'])); else: ?><?php echo htmlentities(decimal($res['new_price'])); ?><?php endif; ?></strong></p>
              <p class="address-box"><span>送&nbsp;&nbsp;&nbsp;&nbsp;至</span><strong class="address"><?php echo htmlentities((isset($address['address']) && ($address['address'] !== '')?$address['address']:"河南省   新乡市   红旗区")); ?></strong></p>
            </div>
            <div class="choose-attrs">
              <div class="color layui-clear"><span class="title">颜&nbsp;&nbsp;&nbsp;&nbsp;色</span> <div class="color-cont"><span class="btn">白色</span> <span class="btn active">粉丝</span></div></div>
              <div class="number layui-clear"><span class="title">数&nbsp;&nbsp;&nbsp;&nbsp;量</span><div class="number-cont"><span class="cut btn">-</span><input onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" maxlength="4" type="" name="sum" value="1"><span class="add btn">+</span></div></div>
            </div>
            <div class="choose-btns">
              <button class="layui-btn layui-btn-primary purchase-btn" lay-submit lay-filter="add-pay">立刻购买</button>
              <button class="layui-btn layui-btn-danger car-btn" lay-submit lay-filter="lay-add-cart"><i class="layui-icon layui-icon-cart-simple"></i>加入购物车</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="layui-clear">
      <div class="aside">
        <h4>热销推荐</h4>
        <div class="item-list">
          <?php if(is_array($rescloumn) || $rescloumn instanceof \think\Collection || $rescloumn instanceof \think\Paginator): $i = 0; $__LIST__ = $rescloumn;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <div class="item">
            <img src="<?php echo htmlentities($vo['img']); ?>">
            <p><span><?php echo htmlentities($vo['name']); ?></span><span class="pric">￥<?php echo htmlentities($vo['pirce']); ?></span></p>
          </div>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
      </div>
      <div class="detail">
        <h4>详情</h4>
        <div class="item">
          <?php echo $res['content']; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  layui.use(['form','layer','jquery'], function(){
    var form = layui.form;
    var layer = layui.layer;
    $ = layui.jquery;
    var cur = $('.number-cont input').val();
    $('.number-cont .btn').on('click',function(){
      if($(this).hasClass('add')){
        cur++;

      }else{
        if(cur > 1){
          cur--;
        }
      }
      $('.number-cont input').val(cur);
    });
    $('.address').on('click',function () {
      let uid = <?php if(empty(app('session')->get('uid')) || ((app('session')->get('uid') instanceof \think\Collection || app('session')->get('uid') instanceof \think\Paginator ) && app('session')->get('uid')->isEmpty())): ?>''<?php else: ?><?php echo htmlentities(app('session')->get('uid')); ?><?php endif; ?>;
      if (uid != ''){
        layer.open({
          type: 2,
          area: ['500px', '300px'],
          fix: false, //不固定
          maxmin: true,
          shade:0.4,
          title:'收货地址',
          content: '<?php echo url("ShopCart/setAddress"); ?>' //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
        });
      }else {
        layer.msg("您还没有登录");
      }
    });
    //监听提交,直接购买
    form.on('submit(add-pay)', function(data){
      let uid = <?php if(empty(app('session')->get('uid')) || ((app('session')->get('uid') instanceof \think\Collection || app('session')->get('uid') instanceof \think\Paginator ) && app('session')->get('uid')->isEmpty())): ?>''<?php else: ?><?php echo htmlentities(app('session')->get('uid')); ?><?php endif; ?>;
      if (uid != ''){
        let did = data.field.did;
        let sum = data.field.sum;
        layer.open({
          type:2,
          area:['500px','400px'],
          fix: false, // 不固定
          shade:0.5,
          title:'微信支付',
          btn:['确定','取消'],
          anim: 5,
          yes:function(index,layero){
            layer.close(index);
          },
          content: "<?php echo url('Wxpay/qrcode'); ?>"+'?did='+did+'&sum='+sum,
        });
      } else {
        layer.msg('您还没有登录');
      }
      return false;
    });
    //监听提交,加入购物车
    form.on('submit(lay-add-cart)', function(data){
      $.ajax({
        url:"<?php echo url('ShopCart/add'); ?>",
        method:'post',
        data:data.field,
        dataType:'JSON',
        success:function(res){
          if(res.code='1001'){
            window.location.href = '<?php echo url("ShopCart/cart"); ?>';
          }
          else{
            window.location.href = '<?php echo url("index/demo"); ?>';
          }
        },
        error:function (err) {
          layui.msg(err);
        }
      });
    });
  });
</script>
</body>
</html>