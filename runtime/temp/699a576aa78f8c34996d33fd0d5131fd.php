<?php /*a:3:{s:36:"E:\www\tp5\/tpl/admin/rules\add.html";i:1563352857;s:40:"E:\www\tp5\/tpl/admin/Public\header.html";i:1555291684;s:40:"E:\www\tp5\/tpl/admin/Public\footer.html";i:1555291684;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
		<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/public/static/admin/assets/css/layui.css">
    <link rel="stylesheet" href="/public/static/admin/assets/common.css">
	<link rel="stylesheet" href="/public/static/admin/assets/css/view.css"/>
    <link rel="icon" href="/public/static/admin/favicon.ico">
    <title>栏目添加</title>
</head>
<body class="layui-view-body">
<div class="layui-content">
	<div class="layui-row">
		<div class="layui-col-xs-offset2 layui-col-xs6">
			<form class="layui-form">
				<div class="layui-form-item">
					<label class="layui-form-label">父级：</label>
					<div class="layui-input-block">
						<select name="pid" lay-verify="required">
							<option value="0">请选择</option>
							<?php if(is_array($rules) || $rules instanceof \think\Collection || $rules instanceof \think\Paginator): $i = 0; $__LIST__ = $rules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo htmlentities($cate['id']); ?>"><?php if($cate['pid'] != '0'): ?>|<?php echo str_repeat("___",$cate['level']); ?><?php endif; ?> <?php echo htmlentities($cate['title']); ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">权限名称：</label>
					<div class="layui-input-block">
						<input type="text" name="title" required  lay-verify="required" placeholder="请输入权限名称" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">方法：</label>
					<div class="layui-input-block">
						<input type="text" name="name" required  lay-verify="required" placeholder="请输入操作方法" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
                    <label class="layui-form-label">状态：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="status" value="1" title="开" checked>
                        <input type="radio" name="status" value="0" title="关">
                    </div>
                </div>
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">附加条件：</label>
					<div class="layui-input-block">
						<textarea name="condition" placeholder="请输入附加条件，可以为空" class="layui-textarea"></textarea>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit lay-filter="add">立即提交</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="/public/static/admin/assets/layui.all.js"></script>
    <script src="/public/static/admin/assets/common.js"></script>
<script type="text/javascript">
layui.use(['form','jquery'], function(){
	var form = layui.form;
	$ = layui.jquery;
	//监听提交
	form.on('submit(add)', function(data){
		var data = data.field;
		console.log(data);
		$.post("<?php echo url('rules/add'); ?>",data,function(res){
			if(res.code == '1001'){
				layer.msg(res.data);
				setTimeout(function () {
					let index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);//关闭当前页
				},2000)
			}else{
				layer.msg('添加失败', {time: 2000});
			}
		},'json');
		return false;
	});
});
</script>
</body>
</html>