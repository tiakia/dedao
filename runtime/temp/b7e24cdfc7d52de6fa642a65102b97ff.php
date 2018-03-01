<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"/home/wwwroot/momo/public/../application/admin/view/category/index.html";i:1515036939;s:68:"/home/wwwroot/momo/public/../application/admin/view/open/header.html";i:1510306797;}*/ ?>
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
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('category/index'); ?>">分类管理</a></li>
			<li><a href="<?php echo url('category/add'); ?>">添加分类</a></li>
		</ul>
		<form method="post" class="js-ajax-form" action="<?php echo url('category/list_orders'); ?>">
			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
					
						<th width="50">ID</th>
						<th>分类名称</th>
						<th>分类类型</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $categorys; ?>
				</tbody>
			</table>
			<!-- <div class="table-actions">
				<button type="submit" class="btn btn-primary btn-small js-ajax-submit">排序</button>
			</div> -->
		</form>
	</div>
	<script src="__PUBLIC__/js/common.js"></script>
</body>
</html>