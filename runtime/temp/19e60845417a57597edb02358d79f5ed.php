<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"F:\XAMPP\htdocs\video\public/../application/video\view\open\header.html";i:1515476192;s:81:"F:\XAMPP\htdocs\video\public/../application/video\view\course\article_detail.html";i:1515399239;}*/ ?>
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

<link href="__PUBLIC__/css/audio.css" rel="stylesheet">
<div class="container">
	<div class="col-md-8">
		<h1 class="news-title"><?php echo $article_info['title']; ?></h1>
		<div class="news-status"><?php echo date('Y-m-d',$article_info['create_time']); ?> 发布
			<div class="label label-default">理财</div>
			<div class="label label-default">金融</div>
			<div class="label label-default">香帅</div>
		</div>
		<div class="news-content">
			<div class="player-v2" id="audio-1514300725158">
				<div class="player-wrap">
					<!-- i-play / i-pause -->
					<button class="i-play"></button>
					<div class="progress-group">
						<div class="audio-title">108｜用VR创新应用打造极致娱乐体验——迟墨墨</div>
						<input type="range" min="0" max="100" value="0" data-current="0:00" data-max="12:17" data-total="737"/>
					</div>
					<audio title="108｜用VR创新应用打造极致娱乐体验——迟墨墨" src="http://igetoss.cdn.igetget.com/mp3/201712/26/201712262305410785861860.mp3" preload cover="https://piccdn.igetget.com/img/201704/24/201704242328257260784871.jpg" cover-img="https://piccdn.igetget.com/img/201704/24/201704242328257260784871.jpg"></audio>
				</div>
			</div>
		　　<div><?php echo $article_info['content']; ?></div>
		</div>
	</div>
	<div class="col-md-4"></div>
	     
</body>
</html>