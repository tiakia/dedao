<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"F:\XAMPP\htdocs\video\public/../application/video\view\common\header.html";i:1515387389;s:73:"F:\XAMPP\htdocs\video\public/../application/video\view\open\register.html";i:1515387382;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>普罗米修斯</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://list-1252895662.coscd.myqcloud.com/CSS/main.css">
</head>
<body>
<div class="navbar navbar-default ">
		<div class="container">
				<div class="navbar-header">
					<a href="index.html" class="navbar-brand" ></a>
				</div>
			    <label id="toggel-label" class="visible-xs-inline-block" for="toggel-checkbox">MENU</label>
			    <input class="hidden" id ="toggel-checkbox" type="checkbox">
				<div class="hidden-xs">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">得到APP</a></li>
						<?php if(is_array($nav_data) || $nav_data instanceof \think\Collection || $nav_data instanceof \think\Paginator): if( count($nav_data)==0 ) : echo "" ;else: foreach($nav_data as $key=>$vo): ?>
							<li><a href="<?php echo $vo['nav_url']; ?>"><?php echo $vo['nav_title']; ?></a></li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo url('open/login'); ?>">登录</a></li>
						<li><a href="<?php echo url('open/register'); ?>">注册</a></li>
					</ul>
				</div>
		</div>	
	</div>

	<div class="container container-small">
		<h1>注册
			<small>没有账号？<a href="<?php echo url('open/register'); ?>">注册</a></small>
		</h1>

		<form action="<?php echo url('open/doregister'); ?>" method="post">
			<div class="form-group">
				<label>手机</label>
				<input type="text" name="member_mobile" class="form-control">
			</div>
			<div class="form-group">
				<label>昵称</label>
				<input type="text" name="member_name" class="form-control">
			</div>
			<div class="form-group">
				<label>密码</label>
				<input type="password" name="member_pass" class="form-control">
			</div>
			<!-- <div class="form-group">
				<label>验证码</label>
				<div class="input-group">
					<input type="text" class="form-control">
					<div class="input-group-btn">
						<div class="btn btn-default">获取验证码</div>
					</div>
				</div>
			</div> -->
			<div class="form-group">
				<label>确认密码</label>
				<input type="password" name="member_confirm" class="form-control">
			</div>
			<div class="from-group">
				<button class="btn btn-primary btn-block" type="submit">注册</button>
			</div>
			<div class="form-group">
				注册普罗米修斯即代表您同意<a href="#">普罗米修斯服务条款</a>
			</div>
	
		</form>
	</div>
		
</body>
</html>