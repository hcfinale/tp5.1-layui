<?php /*a:1:{s:39:"E:\www\tp5\/tpl/index/wxpay\qrcode.html";i:1559012368;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>显示二维码</title>
</head>
<body>
<h2>显示二维码地方</h2>
<img id="qrcode" src="" alt="">
<p id="url"><?php echo htmlentities($qrCode_url); ?></p>
<script type="text/javascript" src="/public/static/js/jquery-3.3.1.min.js"></script>
<script>
    var qrcodeurl = $('#url').text();
    $.ajax({
        url:"<?php echo url('wxpay/create'); ?>",
        data:{'qrcodeurl':qrcodeurl},
        type:'post',
        dataType:'json',
        success:function(result){
            if (result.code==200) {
                //console.log(r);
                var path = 'data:image/png;base64,'+result.data;
                //给img的sec赋值。
                $("#qrcode").attr('src',path);
            } else {
                alert(r.err);
            }
        },
        error:function () {
            console.log('请求出现问题！请检查');
        }
    });
</script>
</body>
</html>