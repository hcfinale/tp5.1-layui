<?php /*a:1:{s:38:"E:\www\tp5\/tpl/index/wxpay\index.html";i:1560333301;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Javascript 二维码生成库：QRCode</title>
    <script type="text/javascript" src="/public/static/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/public/static/js/qrcode.min.js"></script>
</head>
<body>
<img id="img" src="/<?php echo htmlentities($qrCode_url); ?>" alt="" width="150px" />
<br />
<div class="onqr">
    <input type="hidden" id="out_trade_no" value="<?php echo htmlentities($product_id); ?>" >
    <?php echo token(); ?>
</div>
<script type="text/javascript">
    // 产看订单状态
    var time = setInterval("check()",3000);    //3秒查询一次是否支付成功
    function check() {
        var url = "<?php echo url('/index/Wxpay/orderstate'); ?>";
        var out_trade_no = $("#out_trade_no").val();
        var param = {'out_trade_no':out_trade_no};
        $.post(url,param,function(data){
            var obj = eval(data);
            if (obj.trade_state == 'SUCCESS') {
                time = window.clearInterval(time);
                $(".onqr").hide();
                // 支付成功把二维码替换成支付成功图标
                $("#img").attr('src','/public/wxpay/images/success.png');
                console.log(obj);
            }else{
                console.log(obj);
            }
        });
    }
</script>
</body>
</html>