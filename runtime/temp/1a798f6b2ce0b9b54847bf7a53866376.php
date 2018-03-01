<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"F:\XAMPP\htdocs\video\public/../application/video\view\common\login.html";i:1515381315;s:73:"F:\XAMPP\htdocs\video\public/../application/video\view\common\header.html";i:1515381366;}*/ ?>
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
						<li><a href="<?php echo url('common/login'); ?>">登录</a></li>
						<li><a href="<?php echo url('common/register'); ?>">注册</a></li>
					</ul>
				</div>
		</div>	
	</div>


	<div class="container container-small">
		<h1>登录
			<small>没有账号？<a href="signup.html">注册</a></small>
		</h1>

		<form >
			<div class="form-group">
				<label>手机</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group">
				<label>密码</label>
				<input type="password" class="form-control">
			</div>
			<div class="from-group">
				<button class="btn btn-primary btn-block" type="submit">登录</button>
			</div>
			<div class="form-group">
				<a href="#">忘记密码？</a>
			</div>

		</form>
	</div>
		
</body>
</html>