<?php /*a:3:{s:42:"E:\www\tp5\/template/admin/column\add.html";i:1554259692;s:45:"E:\www\tp5\/template/admin/Public\header.html";i:1554259509;s:45:"E:\www\tp5\/template/admin/Public\footer.html";i:1554258877;}*/ ?>
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
	<div class="layui-page-header">
		<div class="pagewrap">
			<span class="layui-breadcrumb">
				<a href="">首页</a>
				<a href="">用户</a>
				<a><cite>栏目添加</cite></a>
			</span>
			<h2 class="title">栏目添加</h2>
		</div>
	</div>
	<div class="layui-row">
		<form class="layui-form" action="">
			<div class="layui-form-item">
				<label class="layui-form-label">输入框</label>
				<div class="layui-input-block">
					<input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">密码框</label>
				<div class="layui-input-inline">
					<input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-mid layui-word-aux">辅助文字</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">选择框</label>
				<div class="layui-input-block">
					<select name="city" lay-verify="required">
						<option value=""></option>
						<option value="0">北京</option>
						<option value="1">上海</option>
						<option value="2">广州</option>
						<option value="3">深圳</option>
						<option value="4">杭州</option>
					</select>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">复选框</label>
				<div class="layui-input-block">
					<input type="checkbox" name="like[write]" title="写作">
					<input type="checkbox" name="like[read]" title="阅读" checked>
					<input type="checkbox" name="like[dai]" title="发呆">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">开关</label>
				<div class="layui-input-block">
					<input type="checkbox" name="switch" lay-skin="switch">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">单选框</label>
				<div class="layui-input-block">
					<input type="radio" name="sex" value="男" title="男">
					<input type="radio" name="sex" value="女" title="女" checked>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label class="layui-form-label">文本域</label>
				<div class="layui-input-block">
					<textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
					<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				</div>
			</div>
		</form>
	</div>
</div>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="/public/static/admin/assets/layui.all.js"></script>
    <script src="/public/static/admin/assets/common.js"></script>
<script type="text/javascript">
layui.use('form', function(){
  var form = layui.form;
  
  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});
</script>
</body>
</html>