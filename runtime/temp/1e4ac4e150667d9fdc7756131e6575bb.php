<?php /*a:2:{s:44:"E:\www\tp5\/template/admin/column\index.html";i:1554685209;s:45:"E:\www\tp5\/template/admin/Public\header.html";i:1554259509;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/public/static/admin/assets/css/layui.css">
    <link rel="stylesheet" href="/public/static/admin/assets/common.css">
    <link rel="stylesheet" href="/public/static/admin/assets/css/view.css"/>
    <link rel="icon" href="/public/static/admin/favicon.ico">
    <title>权限配置</title>    
    <style type="text/css">
        .layui-input-block{margin-left:0px; }
    </style>
</head>
<body class="layui-view-body">
<div class="layui-content">
    <div class="layui-page-header">
        <div class="pagewrap">
            <span class="layui-breadcrumb">
              <a href="">首页</a>
              <a href="">用户</a>
              <a><cite>权限配置</cite></a>
            </span>
            <h2 class="title">权限配置</h2>
        </div>
    </div>
    <div class="layui-row">
        <div class="layui-card">
            <div class="layui-card-body">
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col width="50">
                        <col width="250">
                        <col width="500">
                        <col width="60">
                        <col>
                    </colgroup>
                <thead>
                    <tr>
                        <td>排序</td>
                        <th>id</th>
                        <th>栏目名称</th>
                        <th>关键词</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr> 
                </thead>
                <tbody>
                    <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$column): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <input type="hidden" name="cid" value="<?php echo htmlentities($column['id']); ?>">
                        <td><input type="text" name="sort" value="<?php echo htmlentities($column['sort']); ?>" style="width: 35px;text-align: center;"></td>
                        <td><?php echo htmlentities($column['id']); ?></td>
                        <td><?php if($column['pid'] != '0'): ?>|<?php echo str_repeat("___",$column['level']); ?><?php endif; ?><?php echo htmlentities($column['title']); ?></td>
                        <td><?php echo htmlentities($column['keyword']); ?></td>
                        <td>
                            <form class="layui-form">
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <input type="checkbox" value="<?php echo htmlentities($column['status']); ?>" <?php if($column->status == '1'): ?>checked<?php endif; ?> title="<?php echo htmlentities($column['id']); ?>" lay-skin="switch" lay-text="开启|关闭">
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td>
                            <div class="layui-btn-group">
                                <button class="layui-btn layui-btn-primary layui-btn-sm" onclick="hc_move('修改栏目','<?php echo url("column/edit",["id"=>$column["id"]]); ?>')">
                                    <i class="layui-icon">&#xe65f;</i>
                                </button>
                                <button class="layui-btn layui-btn-primary layui-btn-sm" onclick="hc_edit('修改栏目','<?php echo url("column/edit",["id"=>$column["id"]]); ?>')">
                                    <i class="layui-icon">&#xe642;</i>
                                </button>
                                <button class="layui-btn layui-btn-primary layui-btn-sm" onclick="hc_del('','<?php echo url("column/del",["id"=>$column["id"]]); ?>')">
                                    <i class="layui-icon">&#xe640;</i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="/public/static/admin/assets/layui.all.js"></script>
<script src="/public/static/admin/assets/common.js"></script>
<script>
window.onload = function(){
    layui.use(['form','layer'], function(){
        var form = layui.form;
        var layer = layui.layer;   
        form.on('switch', function(data) {
            $(data.elem).val(this.checked ? 1 : 0);
            var id = data.elem.title;
            console.log(data.elem.value);
            $.ajax({
                method: 'post',
                url: '<?php echo url("column/status"); ?>',
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function(res) {
                    if(res.code == '1001'){
                        layer.msg(res.data);
                        setTimeout(function () {
                            window.location.href = '';
                        },2000)
                    }else{
                        layer.msg('修改失败 ');
                    }
                },
                error:function () {
                    layer.msg('状态修改失败 ');
                }
            })
        });
        // 栏目排序 fid
        $("input[name='sort']").each(function () {
            $(this).on('change',function () {
                var cid = $(this).parents('td').siblings("input[name='cid']").val();
                var sort = $(this).val();
                $.ajax({
                    method: 'post',
                    url: '<?php echo url("column/sort"); ?>',
                    data: {
                        id: cid,
                        sort: sort,
                    },
                    dataType: 'json',
                    success: function(res) {
                        if(res.code == '1001'){
                            layer.msg(res.data);
                        }else{
                            layer.msg('修改失败 ');
                        }
                    },
                    error:function (err) {
                        layer.msg('修改失败'+err);
                    }
                });
            });
        });
    });
}
</script>
</body>
</html>