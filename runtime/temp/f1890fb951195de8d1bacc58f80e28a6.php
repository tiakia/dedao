<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"F:\XAMPP\htdocs\video\public/../application/admin\view\category\add.html";i:1515037446;s:71:"F:\XAMPP\htdocs\video\public/../application/admin\view\open\header.html";i:1510306797;}*/ ?>
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
	        <li><a href="<?php echo url('category/index'); ?>">分类管理</a></li>
			<li  class="active"><a href="<?php echo url('category/add'); ?>">添加分类</a></li>
	    </ul>
		<form class="form-horizontal js-ajax-form" action="<?php echo url('category/add_post'); ?>" method="post">
			<div class="tabbable">
		        <div class="tab-content">
		          <div class="tab-pane active">
						<fieldset>
							<!-- <div class="control-group">
								<label class="control-label">上级菜单</label>
								<div class="controls">
									<select name="parent_id">
										<option value="0">作为一级菜单</option>
										<?php echo $categorys; ?> -->
										<!-- 这里写分类树，类似于添加菜单那里的选择 -->
									<!-- </select>
								</div>
							</div> -->
							<div class="control-group">
								<label class="control-label">分类名称</label>
								<div class="controls">
									<input type="text" name="catname" value=""><span class="form-required">*</span>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">分类描述</label>
								<div class="controls">
									<textarea name="description" rows="5" cols="57"></textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">分类类型</label>
								<div class="controls">
									<select name="type">
							        	<option value="1">文章</option>
							        	<!-- <option value="2">图集</option> -->
									</select>
								</div>
							</div>
						</fieldset>
		          </div>
		        </div>
		    </div>
		    <div class="form-actions">
		     	<button class="btn btn-primary js-ajax-submit"type="submit">添加</button>
		      	<a class="btn" href="javascript:history.back(-1);">返回</a>
		    </div>
		</form>
	</div>
	<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
</body>
</html>