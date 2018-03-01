<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"F:\XAMPP\htdocs\video\public/../application/admin\view\index\main.html";i:1514942132;s:71:"F:\XAMPP\htdocs\video\public/../application/admin\view\open\header.html";i:1510306797;}*/ ?>
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
<style>
.home_info li em {
	float: left;
	width: 120px;
	font-style: normal;
}
li {
	list-style: none;
}
</style>
</head>
<body>
	<div class="wrap">
		<div class="well section">
			<i class="sc_icon"></i>
			<h4>系统信息</h4>
			<span class="stop" title="收起详情"></span>
			<div class="clearboth"></div>
		</div>
		<div class="home_info">
			<table cellpadding="0" cellspacing="0" class="system_table">
				<tbody>
				<tr>
					<td class="gray_bg">服务器操作系统:</td>
					<td><?php echo PHP_OS; ?></td>
					<td class="gray_bg">Web 服务器:</td>
					<td><?php echo $_SERVER["SERVER_SOFTWARE"]; ?></td>
				</tr>
				<tr>
					<td class="gray_bg">PHP 版本:</td>
					<td><?php echo PHP_VERSION; ?></td>
					<td class="gray_bg">MySQL 版本:</td>
					<td><?php echo $data['mysql']; ?></td>
				</tr>
				<tr>
					<td class="gray_bg">安全模式:</td>
					<td><?php echo $data['safe_mode']; ?></td>
					<td class="gray_bg">安全模式GID:</td>
					<td><?php echo $data['safe_mode_gid']; ?></td>
				</tr>
				<tr>
					<td class="gray_bg">Socket 支持:</td>
					<td><?php echo $data['sockets']; ?></td>
					<td class="gray_bg">时区设置:</td>
					<td><?php echo $data['time']; ?></td>
				</tr>
				<tr>
					<td class="gray_bg">GD 版本:</td>
					<td><?php echo $data['gd']; ?></td>
					<td class="gray_bg">PHP运行方式:</td>
					<td><?php echo php_sapi_name(); ?></td>
				</tr>
				<tr>
					<td class="gray_bg">文件上传的最大大小:</td>
					<td><?php echo $data['file']; ?></td>
					<td class="gray_bg">剩余空间:</td>
					<td><?php echo $data['extra']; ?></td>
				</tr>
				<tr>
					<td class="gray_bg">执行时间限制:</td>
					<td><?php echo $data['run_time']; ?></td>
					<td class="gray_bg">菜单图标素材地址:</td>
					<td><a href="http://www.thinkcmf.com/font/icons" target="_blank">Font Awesome</a></td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	<script src="__PUBLIC__/js/highcharts.js"></script>
	<script src="__PUBLIC__/js/common.js"></script>
	<script src="__PUBLIC__/js/main.js"></script>
</body>
</html>