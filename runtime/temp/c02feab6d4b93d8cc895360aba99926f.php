<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"/home/wwwroot/momo/public/../application/admin/view/version/edit.html";i:1510306796;s:68:"/home/wwwroot/momo/public/../application/admin/view/open/header.html";i:1510306797;}*/ ?>
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
			<li><a href="<?php echo url('version/index'); ?>">版本管理</a></li>
			<li><a href="<?php echo url('version/add'); ?>">版本添加</a></li>
			<li class="active"><a>编辑版本</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo url('version/edit_post'); ?>">
			<fieldset>
				
				<div class="control-group">
					<label class="control-label">版本</label>
					<div class="controls">
						<select name="version" id="">
							<option value="0">请选择</option>
							<?php if(is_array($version_list) || $version_list instanceof \think\Collection || $version_list instanceof \think\Paginator): if( count($version_list)==0 ) : echo "" ;else: foreach($version_list as $key=>$vo): ?>
							<option value="<?php echo $vo; ?>" <?php if(!empty($vo) && $vo==$data['version']) echo  'selected="selected"'; ?>><?php echo $vo; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">版本号</label>
					<div class="controls">
						<input type="text" name="version_code" value="<?php echo $data['version_code']; ?>">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">下载地址</label>
					<div class="controls">
						<input type="text" name="download_url" value="<?php echo $data['download_url']; ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">升级说明</label>
					<div class="controls">
						<textarea name="version_desc" rows="7"><?php echo $data['version_desc']; ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">系统类型</label>
					<div class="controls">
						<label class="radio inline" for="active_true">
							<input type="radio" name="os_type" value="1" <?php if(!empty($data['os_type']) && $data['os_type']==1) echo  'checked=""'; ?>>Android
						</label>
						<label class="radio inline" for="active_false">
							<input type="radio" name="os_type" value="2" <?php if(!empty($data['os_type']) && $data['os_type']==2) echo  'checked=""'; ?>>IOS
						</label>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">是否强制</label>
					<div class="controls">
						<label class="radio inline" for="active_true">
							<input type="radio" name="is_force" value="1" <?php if($data['is_force'] == 1): ?>checked=""<?php endif; ?>>是
						</label>
						<label class="radio inline" for="active_false">
							<input type="radio" name="is_force" value="0" <?php if($data['is_force'] == 0): ?>checked=""<?php endif; ?>>否
						</label>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<input type="hidden" name="version_id" value="<?php echo $data['version_id']; ?>" />
				<button type="submit" class="btn btn-primary js-ajax-submit">保存</button>
				<a class="btn" href="javascript:history.back(-1);">返回</a>
			</div>
		</form>
	</div>
	<script src="__PUBLIC__/js/common.js"></script>
</body>
</html>