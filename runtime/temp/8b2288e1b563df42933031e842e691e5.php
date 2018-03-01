<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"F:\XAMPP\htdocs\video\public/../application/admin\view\menu\add.html";i:1510306797;s:71:"F:\XAMPP\htdocs\video\public/../application/admin\view\open\header.html";i:1510306797;}*/ ?>
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
			<li><a href="<?php echo url('menu/index'); ?>">菜单列表</a></li>
			<li class="active"><a href="<?php echo url('menu/add'); ?>">菜单添加</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo url('menu/add_post'); ?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label">上级:</label>
					<div class="controls">
						<select name="parent_id">
							<option value="0">作为一级菜单</option>
							<?php echo $select_categorys; ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">名称:</label>
					<div class="controls">
						<input type="text" name="name">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">应用:</label>
					<div class="controls">
						<input type="text" name="app" id="app">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">控制器:</label>
					<div class="controls">
						<input type="text" name="model" id="model">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">方法:</label>
					<div class="controls">
						<input type="text" name="action" id="action">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">参数:</label>
					<div class="controls">
						<input type="text" name="url_param">
						例:id=3&amp;p=3
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">图标:</label>
					<div class="controls">
						<input type="text" name="icon" id="action">
						<a href="http://www.thinkcmf.com/font/icons" target="_blank">选择图标</a> 不带前缀fa-，如fa-user => user
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">备注:</label>
					<div class="controls">
						<textarea name="remark" rows="5" cols="57" style="width: 500px;"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">状态:</label>
					<div class="controls">
						<select name="status">
							<option value="1">显示</option>
							<option value="0">隐藏</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">类型:</label>
					<div class="controls">
						<select name="type">
							<option value="1" selected>权限认证+菜单</option>
							<option value="0">只作为菜单</option>
						</select>
						注意：“权限认证+菜单”表示加入后台权限管理，纯碎是菜单项请不要选择此项。
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit">添加</button>
				<a class="btn" href="javascript:history.back(-1);">返回</a>
			</div>
		</form>
	</div>
	<script src="__PUBLIC__/js/common.js"></script>
</body>
</html>