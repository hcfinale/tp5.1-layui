<?php /*a:2:{s:38:"E:\www\tp5\/tpl/admin/rules\index.html";i:1563336343;s:40:"E:\www\tp5\/tpl/admin/Public\header.html";i:1555291684;}*/ ?>
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
                <button class="layui-btn layui-btn-blue" onclick="hc_move('添加权限','<?php echo url("rules/add"); ?>')"><i class="layui-icon">&#xe654;</i>新增</button>
            </div>
            <div class="layui-card-body">
                <table class="layui-table">
                    <colgroup>
                        <col width="50">
                        <col width="200">
                        <col width="80">
                        <col width="80">
                        <col width="80">
                        <col width="100">
                        <col width="200">
                        <col>
                    </colgroup>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>栏目名称</th>
                        <th>模块</th>
                        <th>控制器</th>
                        <th>方法</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr> 
                </thead>
                <tbody>
                    <?php if(is_array($rules) || $rules instanceof \think\Collection || $rules instanceof \think\Paginator): $i = 0; $__LIST__ = $rules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rule): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <input type="hidden" name="id" value="<?php echo htmlentities($rule['id']); ?>">
                        <td><?php echo htmlentities($rule['id']); ?></td>
                        <td><?php if($rule['pid'] != '0'): ?>|<?php echo str_repeat("___",$rule['level']); ?><?php endif; ?><?php echo htmlentities($rule['title']); ?></td>

                        <td><?php if($rule['pid'] != '0'): ?><?php echo htmlentities($rule['module']); else: ?><?php echo explode('/',$rule['name'])[0]?><?php endif; ?></td>
                        <td><?php if($rule['pid'] != '0'): ?><?php echo htmlentities($rule['controller']); else: ?><?php echo explode('/',$rule['name'])[1]?><?php endif; ?></td>
                        <td><?php if($rule['pid'] != '0'): ?><?php echo htmlentities($rule['action']); else: ?><?php endif; ?></td>
                        <td>
                            <form class="layui-form">
                                <div class="layui-form-item">
                                    <div class="layui-input-block">
                                        <input type="checkbox" value="<?php echo htmlentities($rule['status']); ?>" <?php if($rule->status == '1'): ?>checked<?php endif; ?> title="<?php echo htmlentities($rule['id']); ?>" lay-skin="switch" lay-text="开启|关闭">
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td>
                            <div class="layui-btn-group">
                                <button class="layui-btn layui-btn-primary layui-btn-sm" onclick="hc_move('修改栏目','<?php echo url("rules/edit",["id"=>$rule["id"]]); ?>')">
                                    <i class="layui-icon">&#xe65f;</i>
                                </button>
                                <button class="layui-btn layui-btn-primary layui-btn-sm" onclick="hc_edit('修改栏目','<?php echo url("rules/edit",["id"=>$rule["id"]]); ?>')">
                                    <i class="layui-icon">&#xe642;</i>
                                </button>
                                <button class="layui-btn layui-btn-primary layui-btn-sm" onclick="hc_del('','<?php echo url("rules/del",["id"=>$rule["id"]]); ?>')">
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
<script src="/public/static/admin/assets/layui.all.js"></script>
<script src="/public/static/admin/assets/common.js"></script>
<script>
layui.use(['form','layer','jquery'], function(){
    var form = layui.form;
    var layer = layui.layer;
    $ = layui.jquery; 
    form.on('switch', function(data) {
        $(data.elem).val(this.checked ? 1 : 0);
        var id = data.elem.title;
        console.log(data.elem.value);
        console.log(data.elem.title);
        $.ajax({
            type: 'post',
            url: '<?php echo url("Rules/status"); ?>',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function(res) {
                if(res.code == '1001'){
                    layer.msg(res.data);
                    setTimeout(function () {
                        location.reload();
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
});
</script>
</body>
</html>