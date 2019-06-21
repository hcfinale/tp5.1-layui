<?php /*a:1:{s:43:"E:\www\tp5\/tpl/admin/index\statistics.html";i:1560501720;}*/ ?>
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
                            <img src="<?php echo url('index/map'); ?>"  alt="" />
                        </div>
                        <div class="layui-tab-item">
                            <!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
                            <div id="main" style="width: 600px;height:400px;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/public/static/admin/assets/layui.all.js"></script>
<!--cdn的就是这样，单文件的就会报错，暂时不懂是神马原因-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.1.0/echarts.js"></script>
<script>
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));
    // 指定图表的配置项和数据
    var option = {
        title: {
            text: 'ECharts 入门示例'
        },
        tooltip: {},
        legend: {
            data:['销量']
        },
        xAxis: {
            data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
        },
        yAxis: {},
        series: [{
            name: '销量',
            type: 'bar',
            data: [55, 120, 360, 100, 10, 26]
        }]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
</body>
</html>