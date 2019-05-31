<?php /*a:1:{s:44:"E:\www\tp5\/tpl/index/shop_cart\address.html";i:1559209404;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>收货地址</title>
    <link rel="stylesheet" type="text/css" href="/public/static/index/layui/css/layui.css">
</head>
<body>
<form class="layui-form" action="" id="hc-default">
    <?php if(is_array($address) || $address instanceof \think\Collection || $address instanceof \think\Paginator): $i = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <input type="radio" name="shopAddId" value="<?php echo htmlentities($vo['id']); ?>" title="<?php echo htmlentities($vo['address']); ?>" <?php if($vo['action'] == '1'): ?>checked<?php else: ?><?php endif; ?>>
        </div>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-sm layui-btn-primary">
                点击添加新的收货地址
                <i class="layui-icon">&#xe654;</i>
            </button>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="submit">确认修改</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<form class="layui-form" action="" id="hc-add">
    <div class="layui-form-item">
        <label class="layui-form-label">选择地区</label>
        <div class="layui-input-inline">
            <select name="province" lay-filter="province">
                <option value="">请选择省</option>
            </select>
        </div>
        <div class="layui-input-inline" style="display: none;">
            <select name="city" lay-filter="city">
                <option value="">请选择市</option>
            </select>
        </div>
        <div class="layui-input-inline" style="display: none;">
            <select name="area" lay-filter="area">
                <option value="">请选择县/区</option>
            </select>
        </div>
    </div>
</form>
<script type="text/javascript" src="/public/static/index/layui/layui.js"></script>
<script type="text/javascript" src="/public/static/js/area.js"></script>
<script>
    //Demo
    layui.use(['form','layer','jquery'], function(){
        let form = layui.form;
        let layer = layui.layer;
        $ = layui.jquery;
        //监听提交
        form.on('submit(submit)', function(data){
            $.ajax({
                url:"<?php echo url('ShopCart/setAddress'); ?>",
                method:'post',
                data:data.field,
                dataType:'JSON',
                success:function(res){
                    if(res.code='1001'){
                        layer.msg(res.data);
                        setTimeout(function () {
                            window.parent.location.reload();//刷新父页面
                            let index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);//关闭当前页
                        },2000);
                    }
                    else{
                        layer.msg('异步提交发生错误');
                    }
                },
                error:function (err) {
                    layer.msg(err);
                }
            });
            return false;
        });
    });
</script>
</body>
</html>