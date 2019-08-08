<?php /*a:3:{s:38:"E:\www\tp5\/tpl/admin/users\index.html";i:1563522026;s:40:"E:\www\tp5\/tpl/admin/Public\header.html";i:1555291684;s:40:"E:\www\tp5\/tpl/admin/Public\footer.html";i:1555291684;}*/ ?>
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
    <title>管理后台</title>
</head>
<body class="layui-view-body">
  <div class="layui-content">
      <div class="layui-row">
          <div class="layui-card">
              <div class="layui-card-body">
                  <div class="form-box">
                      <div class="layui-form layui-form-item">
                          <div class="layui-inline">
                              <div class="layui-form-mid">用户名:</div>
                              <div class="layui-input-inline" style="width: 100px;">
                                <input type="text" autocomplete="off" class="layui-input">
                              </div>
                              <div class="layui-form-mid">邮箱:</div>
                              <div class="layui-input-inline" style="width: 100px;">
                                <input type="text" autocomplete="off" class="layui-input">
                              </div>
                              <div class="layui-form-mid">性别:</div>
                              <div class="layui-input-inline" style="width: 100px;">
                                  <select name="sex">
                                      <option value="1">男</option>
                                      <option value="2">女</option>
                                  </select>     
                              </div>
                              <button class="layui-btn layui-btn-blue">查询</button>
                              <button class="layui-btn layui-btn-primary">重置</button>
                          </div>
                      </div>
                      <button class="layui-btn layui-btn-blue" onclick="hc_move('添加管理员','<?php echo url("users/add"); ?>')"><i class="layui-icon">&#xe654;</i>新增</button>
                      
                      <table id="demo" lay-filter="text"></table>
                      <script type="text/html" id="barDemo">
                        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                      </script>
                  </div>
              </div>
          </div>
      </div>
  </div>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="/public/static/admin/assets/layui.all.js"></script>
    <script src="/public/static/admin/assets/common.js"></script>
<script>
  var element = layui.element;
  var table = layui.table;
  var form = layui.form;

  //展示已知数据
  table.render({
    elem: '#demo',
    cols: [
      [ //标题栏
      {
        type: 'checkbox',
        fixed: 'left'
      },{
        field: 'uid',
        title: 'ID',
        align: 'center',
        sort: true
      }, {
        field: 'name',
        title: '用户名',
        align: 'center',
      }, {
        field: 'email',
        title: '邮箱',
      }, {
        field: 'mobile',
        title: '签名',
      }, {
        field: 'gender',
        title: '性别',
        align: 'center',
      }, {
        field: 'status',
        title: '城市',
        align: 'center',
      }, {
        field: 'loginnum',
        title: '积分',
        align: 'center',
        sort: true
      },{
        fixed: 'right',
        title:'操作',
        toolbar: '#barDemo',
        align: 'center',
      }]
    ],
    data: <?php echo $result; ?>,
    skin: 'line', //表格风格
    title: '用户数据表',
    cellMinWidth: 80,
    even: true,
    page: true, //是否显示分页
    limits: [5, 7, 10],
    limit: 7 //每页默认显示的数量
  });
  //监听行工具事件
  table.on('tool(text)', function(obj){
    var data = obj.data;
    if(obj.event === 'del'){
      layer.confirm('真的删除行么', function(index){
        obj.del();
        
        layer.close(index);
      });
    } else if(obj.event === 'edit'){
      layer.prompt({
        formType: 2
        ,value: data.email
      }, function(value, index){
        obj.update({
          email: value
        });
        layer.close(index);
      });
    }
  });
</script>
</body>
</html>