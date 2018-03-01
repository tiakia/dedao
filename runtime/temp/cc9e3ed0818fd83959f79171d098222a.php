<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"F:\XAMPP\htdocs\video\public/../application/admin\view\role\index.html";i:1510306796;s:71:"F:\XAMPP\htdocs\video\public/../application/admin\view\open\header.html";i:1510306797;}*/ ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="__PUBLIC__/css/theme.min.css" rel="stylesheet">
    <link href="__PUBLIC__/css/simplebootadmin.css" rel="stylesheet">
    <link href="__PUBLIC__/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="__PUBLIC__/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="__PUBLIC__/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<script type="text/javascript">
	//全局变量
	var GV = {
	    WEB_ROOT: "/",
	    JS_ROOT: "__PUBLIC__/js/",
	    APP:"admin"/*当前应用名*/
	};
	</script>
    <script src="__PUBLIC__/js/jquery.js"></script>
    <script src="__PUBLIC__/js/wind.js"></script>
    <script src="__PUBLIC__/js/bootstrap.min.js"></script>
    <script>
    	$(function(){
    		$("[data-toggle='tooltip']").tooltip();
    	});
    </script>
<if condition="APP_DEBUG">
	<style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style>
</if> 
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('role/index'); ?>">角色管理</a></li>
			<li><a href="<?php echo url('role/add'); ?>">添加角色</a></li>
		</ul>
		<form action="<?php echo url('role/listorders'); ?>" method="post">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th width="30">ID</th>
						<th align="left">角色名称</th>
						<th align="left">角色描述</th>
						<th width="40" align="left">状态</th>
						<th width="120">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($roles) || $roles instanceof \think\Collection || $roles instanceof \think\Paginator): if( count($roles)==0 ) : echo "" ;else: foreach($roles as $key=>$vo): ?>
					<tr>
						<td><?php echo $vo['role_id']; ?></td>
						<td><?php echo $vo['name']; ?></td>
						<td><?php echo $vo['remark']; ?></td>
						<td>
							<?php if($vo['status'] == 1): ?>
								<font color="red">√</font>
							<?php else: ?> 
								<font color="red">╳</font>
							<?php endif; ?>
						</td>
						<td>
							<?php if($vo['role_id'] == 1): ?>
								<font color="#cccccc">权限设置</font>|
								<font color="#cccccc">编辑</font> | <font color="#cccccc">删除</font>
							<?php else: ?>
								<a href="<?php echo url('role/authorize',array('id'=>$vo['role_id'])); ?>">权限设置</a>|
								<a href="<?php echo url('role/edit',array('id'=>$vo['role_id'])); ?>">编辑</a>|
								<a class="js-ajax-delete" href="<?php echo url('role/delete',array('id'=>$vo['role_id'])); ?>">删除</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</form>
	</div>
	<script src="__PUBLIC__/js/common.js"></script>
</body>
</html>