<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"F:\XAMPP\htdocs\video\public/../application/admin\view\mange\edit.html";i:1510306796;s:71:"F:\XAMPP\htdocs\video\public/../application/admin\view\open\header.html";i:1510306797;}*/ ?>
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
			<li><a href="<?php echo url('mange/index'); ?>">管理员列表</a></li>
			<li><a href="<?php echo url('mange/add'); ?>">管理员添加</a></li>
			<li class="active"><a>编辑管理员</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo url('mange/edit_post'); ?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label">用户名</label>
					<div class="controls">
						<input type="text" name="admin_name" value="<?php echo $users['admin_name']; ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">密码</label>
					<div class="controls">
						<input type="password" name="admin_password" value="" placeholder="******">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">角色</label>
					<div class="controls">
						<select name="role_id" <?php if(sp_get_current_admin_id() != 1 && $vo['admin_id'] == 1): ?>disabled="true"<?php endif; ?>>
							<option value="0">请选择</option>
							<?php if(is_array($roles) || $roles instanceof \think\Collection || $roles instanceof \think\Paginator): if( count($roles)==0 ) : echo "" ;else: foreach($roles as $key=>$vo): ?>
							<option value="<?php echo $vo['role_id']; ?>" <?php if($vo['role_id'] == $users['role_id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<input type="hidden" name="id" value="<?php echo $users['admin_id']; ?>" />
				<button type="submit" class="btn btn-primary js-ajax-submit">保存</button>
				<a class="btn" href="javascript:history.back(-1);">返回</a>
			</div>
		</form>
	</div>
	<script src="__PUBLIC__/js/common.js"></script>
</body>
</html>