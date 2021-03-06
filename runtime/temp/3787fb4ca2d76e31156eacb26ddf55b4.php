<?php /*a:1:{s:38:"E:\www\tp5\/tpl/admin/login\login.html";i:1562576422;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/public/static/admin/assets/css/layui.css">
    <link rel="stylesheet" href="/public/static/admin/assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/static/admin/assets/common.css">
    <link rel="icon" href="/favicon.ico">
    <title>管理后台</title>
</head>
<body class="login-wrap">
    <div class="login-container">
        <form class="login-form" id="doLogin" name="doLogin" method="post">
            <h1 class="text-center title">用户登录</h1>
            <div class="input-group">
                <input type="text" id="username" name="name" lay-verify="required" class="input-field">
                <label for="username" class="input-label">
                    <span class="label-title">用户名</span>
                </label>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="passwd" lay-verify="required" class="input-field">
                <label for="password" class="input-label">
                    <span class="label-title">密码</span>
                </label>
            </div>
            <button class="login-button" lay-filter="dologin" lay-submit="">登录<i class="ai ai-enter"></i></button>
        </form>
    </div>
</body>
<script src="/public/static/admin/assets/layui.js"></script>
<script>
layui.use(['layer','form'], function(){
    var form = layui.form;
    var layer= layui.layer;
    $ =layui.jquery;
    //监听提交
    form.on('submit(dologin)', function(){
        var uname = document.querySelector('#username').value;
        var password = document.querySelector('#password').value;
        $.ajax({
            url:"<?php echo url('admin/login/dologin'); ?>",
            method:'post',
            data:{'name':uname,'passwd':password},
            dataType:'JSON',
            success:function(res){
                if (res.code==1001){
                    layer.msg(res.msg);
                    setTimeout(function(){
                        location.href = '<?php echo url("admin/index/index"); ?>';
                    },2000);
                } else if(res.code==1004){
                    layer.msg(res.msg);
                    setTimeout(function(){
                        location.reload();
                    },2000)
                }
            },
            error:function (ress) {
                layer.msg(ress);
            }
        })
        return false;
    });
});
</script>
</html>