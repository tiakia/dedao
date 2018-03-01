<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"F:\XAMPP\htdocs\video\public/../application/video\view\open\header.html";i:1515640322;s:71:"F:\XAMPP\htdocs\video\public/../application/video\view\course\item.html";i:1515642569;}*/ ?>
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
<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
	<div class="container" style="margin-top:20px;">
		<div class="row">
		<!-- <div class="col-sm-2">
			<div class="hidden-xs list-group side-bar">
				<a href="#" class="list-group-item active">综合</a>
				<a href="#" class="list-group-item">创业指南</a>
				<a href="#" class="list-group-item">处世之道</a>
				<a href="#" class="list-group-item">经济思维</a>
				<a href="#" class="list-group-item">科学思维</a>
				<a href="#" class="list-group-item">亲子育儿</a>
				<a href="#" class="list-group-item">能力提升</a>
				<a href="#" class="list-group-item">艺术修养</a>
				<a href="#" class="list-group-item">诗词文学</a>
			</div>
		</div> -->
		<div class="col-sm-7" style=" width:100%;">
			<div class="news-list">
				<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<div class="news-list-item clearfix">
						<a href="<?php echo url('course/article_detail',['article_id'=>$vo['article_id'],'course_id'=>$vo['course_id']]); ?>" class="title">
							<!-- <div class="col-xs-6" style="width:270px;">
								<img src="https://piccdn.igetget.com/img/201712/09/201712092237520856764819.jpg" >
							</div> -->
							<div><?php echo $vo['title']; ?></div>
							<div class="wenben" >
								　<?php echo $vo['description']; ?>
							</div>
							<div class="info">	
								<span class="avatar"><img src="<?php echo strexists($vo['thumb'],'http')?$vo['thumb'] : '__UPLOAD__/avatar/'.$vo['thumb']; ?>" ></span>
								<span><?php echo $author_name; ?></span>·
								<span><?php echo date('Y-m-d',$vo['create_time']); ?></span>
								<span><?php echo $vo['view_nums']; ?>人读过</span>
							</div>
						</a>	
					</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="pager" id="page" course_id="<?php echo $vo['course_id']; ?>"><?php echo $page; ?></div>
			</div>
			
		</div>
		<div class="col-sm-3">
			<!-- <div class="search-bar">
				<input type="search" class="form-control" placeholder="搜一下">
			</div>
			<div class="side-bar-card flag clearfix">
				<div class="col-xs-5">
					<img src="img/1.jpg" alt="">
				</div>
				<div class="col-xs-7">
					<div class="text-lg">问题反馈专区</div>
					<div>　加入交流群</div>
					<div>　575102866</div>
				</div>

			</div> -->
			<!-- <div class="side-bar-card">
				<div class="card-title">24小时热闻</div>
				<div class="card-body">
					<div class="list">
						<div class="item">
							<div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat, quae.
							</div>
							<div class="desc">15K阅读 1K评论 </div>
						</div>
						<div class="item">
							<div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat, quae.
							</div>
							<div class="desc">15K阅读 1K评论 </div>
						</div>
						<div class="item">
							<div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat, quae.
							</div>
							<div class="desc">15K阅读 1K评论 </div>
						</div>
						<div class="item">
							<div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat, quae.
							</div>
							<div class="desc">15K阅读 1K评论 </div>
						</div>
						<div class="item">
							<div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat, quae.
							</div>
							<div class="desc">15K阅读 1K评论 </div>
						</div>
						<div class="item">
							<div class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat, quae.
							</div>
							<div class="desc">15K阅读 1K评论 </div>
						</div>
					</div>
				</div>
			</div> -->
		</div>
		</div>
		</div>
	</div>	
</body>
</html>
<script type="text/javascript">
	$(function(){
		$("#page").click(function(){
			var course_id = $(this).attr('course_id');
			var href = $(this).find('a').attr('href');
			alert(href);
			alert(href+'&course_id='+course_id);
			// $(this).find('a').attr('href',href+'&course_id='+course_id);
		});
	});
</script>