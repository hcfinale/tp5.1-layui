<?php /*a:4:{s:41:"E:\www\tp5\/tpl/index/shop_cart\cart.html";i:1562917990;s:40:"E:\www\tp5\/tpl/index/Public\header.html";i:1562057687;s:41:"E:\www\tp5\/tpl/index/Public\top_nav.html";i:1562923097;s:46:"E:\www\tp5\/tpl/index/Public\category_nav.html";i:1562642583;}*/ ?>
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
  <div class="content content-nav-base shopcart-content">
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
    <div class="banner-bg w1200">
      <h3>夏季清仓</h3>
      <p>宝宝被子、宝宝衣服3折起</p>
    </div>
    <div class="cart w1200">
      <div class="cart-table-th">
        <div class="th th-chk">
          <div class="select-all">
            <div class="cart-checkbox">
              <input class="check-all check" id="allCheckked" type="checkbox" value="true">
            </div>
          <label>&nbsp;&nbsp;全选</label>
          </div>
        </div>
        <div class="th th-item">
          <div class="th-inner">
            商品
          </div>
        </div>
        <div class="th th-price">
          <div class="th-inner">
            单价
          </div>
        </div>
        <div class="th th-amount">
          <div class="th-inner">
            数量
          </div>
        </div>
        <div class="th th-sum">
          <div class="th-inner">
            小计
          </div>
        </div>
        <div class="th th-op">
          <div class="th-inner">
            操作
          </div>
        </div>  
      </div>
      <div class="OrderList">
        <div class="order-content" id="list-cont">
          <?php if(is_array($ShopCart) || $ShopCart instanceof \think\Collection || $ShopCart instanceof \think\Paginator): $i = 0; $__LIST__ = $ShopCart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <ul class="item-content layui-clear">
            <li class="th th-chk">
              <div class="select-all">
                <div class="cart-checkbox">
                  <input class="CheckBoxShop check" id="" type="checkbox" num="all" name="select-all" value="true">
                  <input type="hidden" class="myid" name="cid[]" value="<?php echo htmlentities($vo['id']); ?>" />
                </div>
              </div>
            </li>
            <li class="th th-item">
              <div class="item-cont">
                <a href="javascript:;"><img src="<?php echo htmlentities($vo['img']); ?>" alt=""></a>
                <div class="text">
                  <div class="title"><?php echo htmlentities($vo['name']); ?></div>
                  <p><span>描述：</span>&nbsp;&nbsp;<span><?php echo htmlentities($vo['d_key']); ?></span></p>
                </div>
              </div>
            </li>
            <li class="th th-price">
              <span class="th-su"><?php echo htmlentities($vo['price']); ?></span>
            </li>
            <li class="th th-amount">
              <div class="box-btn layui-clear">
                <div class="less layui-btn">-</div>
                <input class="Quantity-input" type="" name="" value="<?php echo htmlentities($vo['sum']); ?>" disabled="disabled">
                <div class="add layui-btn">+</div>
              </div>
            </li>
            <li class="th th-sum">
              <span class="sum"><?php echo htmlentities($vo['price']); ?></span>
            </li>
            <li class="th th-op">
              <span class="dele-btn">删除</span>
            </li>
          </ul>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
      </div>
      <div class="FloatBarHolder layui-clear">
        <div class="th th-chk">
          <div class="select-all">
            <div class="cart-checkbox">
              <input class="check-all check" id="" name="select-all" type="checkbox"  value="true">
            </div>
            <label>&nbsp;&nbsp;已选<span class="Selected-pieces">0</span>件</label>
          </div>
        </div>
        <div class="th batch-deletion">
          <span class="batch-dele-btn">批量删除</span>
        </div>
        <div class="th Settlement">
          <button class="layui-btn">结算</button>
        </div>
        <div class="th total">
          <p>应付：<span class="pieces-total">0</span></p>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">

  layui.config({
    base: '/public/static/index/static/js/util/' //你存放新模块的目录，注意，不是layui的模块目录
  }).use(['mm','form','layer','jquery','element','car'], function(){
    let mm = layui.mm;
    let form = layui.form;
    let layer = layui.layer;
    let $ = layui.jquery;
    let element = layui.element;
    let car = layui.car;
    car.init();
    // 提交数据，进行付款操作
    var checkBokShop = document.querySelectorAll(".CheckBoxShop.check");
    var zouni = document.getElementsByClassName('Settlement')[0];//批量删除按钮
    zouni.onclick = function(){
      layer.confirm('你确定要提交吗',{
        yes:function(index,layero){
          layer.close(index);
          localStorage.removeItem('id')
          var list = [];
          for(var i=0;i<checkBokShop.length;i++){
            if(checkBokShop[i].checked==true){
              console.log(checkBokShop[i].nextElementSibling.value);
              let num = checkBokShop[i].nextElementSibling.value;
              list.push(num);
            }
          }
          window.localStorage.setItem('id',list);
          var list = [];
        }
      })
    }
    // car.response();  // 缺点，无法提交数据，操作不便，提炼出来单独操作
    /**
    $('.Settlement button').click(function () {
      var valArr = new Array;
      var mm = $(".list-cont input[name='select-all']:checked").siblings();
      mm.each(function(i){
        valArr[i] = $(this).val();
      });
      var vals = valArr.join(',');
      console.log(vals);
      console.dir(mm);

    });
     **/
  });
</script>
</body>
</html>