<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"F:\XAMPP\htdocs\video\public/../application/video\view\open\header.html";i:1515640322;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>普罗米修斯</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="http://list-1252895662.coscd.myqcloud.com/CSS/main.css">
	<script src="__PUBLIC__/js/jquery.js"></script>
</head>
<script type="text/javascript">
    $(document).ready(function(){
    	$("#nav_click>li").click(function(){
    		$(this).addClass("active");
    		$(this).siblings().removeClass('active');
    	});
       //  $(".level1>a").click(function(){
       //      $(this).addClass("current")     
       //          .next().show()     //下一个元素显示
       //          .parent().siblings().children("a").removeClass("current")     //父元素的同辈元素的子元素<a>移除“current”样式
       //          .next().hide();  //他们的下一个元素隐藏
     		// return false;
       //  })
    })
</script>
<body>
<div class="navbar navbar-default" style="height:60px;margin-bottom:0;">
	<div class="container" >
			<div class="navbar-header">
				<a href="<?php echo url('index/index'); ?>" class="navbar-brand" ></a>
			</div>
		    <label id="toggel-label" class="visible-xs-inline-block" for="toggel-checkbox">MENU</label>
		    <input class="hidden" id ="toggel-checkbox" type="checkbox">
			<div class="hidden-xs">
				<ul class="nav navbar-nav" id="nav_click">
					<!-- <li class="active"><a href="<?php echo url('index/index'); ?>">得到APP</a></li> -->
					<?php if(is_array($nav_data) || $nav_data instanceof \think\Collection || $nav_data instanceof \think\Paginator): if( count($nav_data)==0 ) : echo "" ;else: foreach($nav_data as $key=>$vo): ?>
						<li><a href="<?php echo $vo['nav_url']; ?>" ><?php echo $vo['nav_title']; ?></a></li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php if(\think\Cookie::get('member_name')): ?>
						<li><a href="javascript:;"><?php echo \think\Cookie::get('member_name'); ?></a></li>
						<li><a href="<?php echo url('open/logout'); ?>">退出</a></li>
					<?php else: ?>
						<li><a href="<?php echo url('open/login'); ?>">登录</a></li>
						<li><a href="<?php echo url('open/register'); ?>">注册</a></li>
					<?php endif; ?>
				</ul>
			</div>
	</div>	
</div>