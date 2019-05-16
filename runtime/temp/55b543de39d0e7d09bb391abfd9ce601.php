<?php /*a:1:{s:48:"E:\www\tp5\/template/admin/index\statistics.html";i:1557912081;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/public/static/admin/assets/css/layui.css">
    <link rel="stylesheet" href="/public/static/admin/assets/css/view.css"/>
    <title></title>
</head>
<body class="layui-view-body">
<div class="layui-content">
    <div class="layui-row layui-col-space20">
        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-body chart-card">
                    <div class="chart-header">
                        <div class="metawrap">
                            <div class="meta">
                                <span>总用户数</span>
                            </div>
                            <div class="total"><?php echo htmlentities($countUser); ?></div>
                        </div>
                    </div>
                    <div class="chart-body">
                        <div class="contentwrap">
                            当前用户：<?php echo htmlentities($user); ?>
                        </div>
                    </div>
                    <div class="chart-footer">
                        <div class="field">
                            <span>日注册量</span>
                            <span>321</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-body chart-card">
                    <div class="chart-header">
                        <div class="metawrap">
                            <div class="meta">
                                <span>总栏目数</span>
                            </div>
                            <div class="total"><?php echo htmlentities($countColumn); ?></div>
                        </div>
                    </div>
                    <div class="chart-footer">
                        <div class="field">
                            <span>日创建量</span>
                            <span>321</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-body chart-card">
                    <div class="chart-header">
                        <div class="metawrap">
                            <div class="meta">
                                <span>总商品数</span>
                            </div>
                            <div class="total"><?php echo htmlentities($countDetail); ?></div>
                        </div>
                    </div>
                    <div class="chart-footer">
                        <div class="field">
                            <span>日添加量</span>
                            <span>321</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-body chart-card">
                    <div class="chart-header">
                        <div class="metawrap">
                            <div class="meta">
                                <span>总销售量</span>
                            </div>
                            <div class="total"><?php echo htmlentities($countOrder); ?></div>
                        </div>
                    </div>
                    <div class="chart-footer">
                        <div class="field">
                            <span>日注册量</span>
                            <span>321</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-sm12 layui-col-md12">
            <div class="layui-card">
                <div class="layui-tab layui-tab-brief">
                    <ul class="layui-tab-title">
                        <li class="layui-this">新增数</li>
                        <li>活跃度</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            dddd
                        </div>
                        <div class="layui-tab-item">
                            ddd
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/public/static/admin/assets/layui.all.js"></script>
<script src="/public/static/js/echarts.min.js"></script><!--图表插件-->
<script>
    var element = layui.element;

</script>
</body>
</html>