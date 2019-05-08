<?php /*a:3:{s:43:"E:\www\tp5\/template/admin/detail\edit.html";i:1557128012;s:45:"E:\www\tp5\/template/admin/Public\header.html";i:1555291684;s:45:"E:\www\tp5\/template/admin/Public\footer.html";i:1555291684;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
		<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/public/static/admin/assets/css/layui.css">
    <link rel="stylesheet" href="/public/static/admin/assets/common.css">
	<link rel="stylesheet" href="/public/static/admin/assets/css/view.css"/>
    <title>商品修改</title>
</head>
<body class="layui-view-body">
<div class="layui-content">
	<div class="layui-page-header">
		<div class="pagewrap">
			<span class="layui-breadcrumb">
				<a href="">首页</a>
				<a href="">用户</a>
				<a><cite><?php echo htmlentities($detailName); ?></cite></a>
			</span>
			<h2 class="title"><?php echo htmlentities($detailName); ?></h2>
		</div>
	</div>
	<div class="layui-row">
		<div class="layui-col-lg-offset1 layui-col-lg10 layui-col-xs12">
			<form class="layui-form">
				<input type="hidden" name="id" value="<?php echo htmlentities($detail['id']); ?>">
				<div class="layui-form-item">
					<label class="layui-form-label">所属分类</label>
					<div class="layui-input-block">
						<select name="cid" lay-verify="required">
							<option value="0">请选择</option>
							<?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo htmlentities($cate['id']); ?>" <?php if($cate['id'] == $colPId): ?>selected<?php endif; ?>><?php if($cate['pid'] != '0'): ?>|<?php echo str_repeat("___",$cate['level']); ?><?php endif; ?> <?php echo htmlentities($cate['title']); ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">商品名称</label>
					<div class="layui-input-block">
						<input type="text" name="name" required  lay-verify="required" placeholder="<?php echo htmlentities($detail['name']); ?>" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">商品图片</label>
					<div class="layui-input-block">
						<button type="button" class="layui-btn" id="upcolumn">
							<i class="layui-icon">&#xe67c;</i>上传图片
						</button>
						<img src="<?php echo htmlentities($detail['img']); ?>" alt="" width="30%" height="auto" id="columnImg" />
						<input type="hidden" value="<?php echo htmlentities($detail['img']); ?>" name="img" id="columnimgs">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">商品数量</label>
					<div class="layui-input-block">
						<input type="text" name="sum" required  lay-verify="required" value="<?php echo htmlentities($detail['sum']); ?>" placeholder="请输入商品数量" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">商品价格</label>
					<div class="layui-input-block">
						<input type="text" name="price" required  lay-verify="required" value="<?php echo htmlentities($detail['price']); ?>" placeholder="请输入商品价格" autocomplete="off" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">关键词</label>
					<div class="layui-input-block">
						<textarea name="keyword" placeholder="请输入内容" class="layui-textarea"><?php echo htmlentities($detail['keyword']); ?></textarea>
					</div>
				</div>
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">描述</label>
					<div class="layui-input-block">
						<textarea name="description" placeholder="请输入内容" class="layui-textarea"><?php echo htmlentities($detail['description']); ?></textarea>
					</div>
				</div>
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">详情</label>
					<div class="layui-input-block">
						<!--style给定宽度可以影响编辑器的最终宽度-->
						<script type="text/plain" id="editor" name="content" style="width:100%;height:400px;"><?php echo $detail['content']; ?></script>
					</div>
				</div>
				<?php echo token(); ?>
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit lay-filter="edit">立即提交</button>
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
<script src="/public/static/editor/ueditor.config.js"></script>
<script src="/public/static/editor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/static/editor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
var option = {
	"upcolumnurl":"<?php echo url('detail/columnUpImg'); ?>",
};
var editor = UE.getEditor('editor', { initialFrameWidth: null , autoHeightEnabled: false});
layui.use(['form','upload'], function(){
	var form = layui.form;
	var upload = layui.upload;
	form.render();
	//图片上传
	var uploadInst = upload.render({
		elem: '#upcolumn'
		, accept: 'images'
		,acceptMime: 'image/*'
		, field: 'columnImg' //后台控制器中接受的参数，必须
		,auto:true // 自动上传
		,url: option.upcolumnurl //上传接口
		,before:function (obj) {
			console.log(obj);
			// 预览
			obj.preview(function(index,file,result) {
				$('#columnImg').toggleClass('layui-hide').attr({'src':result,'title':'商品图片'});;// 图片链接加载
				$('#columnImgs').val(result);
			});
		}
		,done: function (res) {
			if (res.code == 0) {
				layer.msg('上传成功！', {
					icon: 1,
					end: function () {
						$('#columnimgs').attr('src', res.url);
					}
				});
				$('#columnimgs').val(res.img);
			}
		}
		,error: function () {

		}
	});
	//监听提交
	form.on('submit(edit)', function(data){
		$('#editor').text(UE.getEditor('editor').getContent());
		var data = data.field;
		console.log(data);
		$.post("<?php echo url('detail/edit'); ?>",data,function(res){
			if(res.code == '1001'){
				layer.msg(res.data);
				setTimeout(function () {
					$('#editor').text("");
					layer.close(layer.index);
					window.parent.location.reload();
				},2000);
			}else{
				// layer.msg(res.info, {time: 2000});
				layer.msg('添加失败 ');
			}
		},'json');
		return false;
	});
});
</script>
</body>
</html>