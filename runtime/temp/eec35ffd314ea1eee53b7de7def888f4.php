<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"/home/wwwroot/momo/public/../application/admin/view/index/index.html";i:1514871165;}*/ ?>
<!DOCTYPE html>
<html lang="zh_CN" style="overflow: hidden;">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<meta charset="utf-8">
<title>普罗米修斯 后台管理中心</title>

<meta name="description" content="This is page-header (.page-header &gt; h1)">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="__PUBLIC__/css/theme.min.css" rel="stylesheet">
<link href="__PUBLIC__/css/simplebootadmin.css" rel="stylesheet">
<link href="__PUBLIC__/font-awesome/4.4.0/css/font-awesome.min.css?page=index"  rel="stylesheet" type="text/css">
<!--[if IE 7]>
	<link rel="stylesheet" href="__PUBLIC__/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
<![endif]-->
<link rel="stylesheet" href="__PUBLIC__/css/simplebootadminindex.min.css?">
<link href="__PUBLIC__/js/artDialog/skins/default.css" rel="stylesheet" />
<!--[if lte IE 8]>
	<link rel="stylesheet" href="__PUBLIC__/css/simplebootadminindex-ie.css?" />
<![endif]-->
<style>
.navbar .nav_shortcuts .btn{margin-top: 5px;}
.macro-component-tabitem{width:101px;}

/*-----------------导航hack--------------------*/
.nav-list>li.open{position: relative;}
.nav-list>li.open .back {display: none;}
.nav-list>li.open .normal {display: inline-block !important;}
.nav-list>li.open a {padding-left: 7px;}
.nav-list>li .submenu>li>a {background: #fff;}
.nav-list>li .submenu>li a>[class*="fa-"]:first-child{left:20px;}
.nav-list>li ul.submenu ul.submenu>li a>[class*="fa-"]:first-child{left:30px;}
/*----------------导航hack--------------------*/
</style>

<script>
//全局变量
var GV = {
	HOST:"<?php echo $_SERVER['HTTP_HOST']; ?>",
    WEB_ROOT: "/",
    JS_ROOT: "public/js/"
};
</script>
<?php $submenus=$menus; function getsubmenu($submenus){ if(is_array($submenus)) foreach($submenus as $menu){  ?>
					<li>
						<?php 
							$menu_name=$menu['name'];
						 if(empty($menu['items'])){ ?>
							<a href="javascript:openapp('<?php echo $menu['url']; ?>','<?php echo $menu['id']; ?>','<?php echo $menu_name; ?>',true);">
								<i class="fa fa-<?php echo (isset($menu['icon']) && ($menu['icon'] !== '')?$menu['icon']:'desktop'); ?>"></i>
								<span class="menu-text">
									<?php echo $menu_name; ?>
								</span>
							</a>
						<?php }else{ ?>
							<a href="#" class="dropdown-toggle">
								<i class="fa fa-<?php echo (isset($menu['icon']) && ($menu['icon'] !== '')?$menu['icon']:'desktop'); ?> normal"></i>
								<span class="menu-text normal">
									<?php echo $menu_name; ?>
								</span>
								<b class="arrow fa fa-angle-right normal"></b>
								<i class="fa fa-reply back"></i>
								<span class="menu-text back">返回</span>
								
							</a>
							
							<ul  class="submenu">
									<?php getsubmenu1($menu['items']) ?>
							</ul>	
							<?php } ?>
						
					</li>
					
				<?php } } function getsubmenu1($submenus){ foreach($submenus as $menu){ ?>
					<li>
						<?php 
							$menu_name=$menu['name'];
						 if(empty($menu['items'])){ ?>
							<a href="javascript:openapp('<?php echo $menu['url']; ?>','<?php echo $menu['id']; ?>','<?php echo $menu_name; ?>',true);">
								<i class="fa fa-caret-right"></i>
								<span class="menu-text">
									<?php echo $menu_name; ?>
								</span>
							</a>
						<?php }else{ ?>
							<a href="#" class="dropdown-toggle">
								<i class="fa fa-caret-right"></i>
								<span class="menu-text">
									<?php echo $menu_name; ?>
								</span>
								<b class="arrow fa fa-angle-right"></b>
							</a>
							<ul  class="submenu">
									<?php getsubmenu2($menu['items']) ?>
							</ul>	
						<?php } ?>
						
					</li>
					
				<?php } } function getsubmenu2($submenus){ foreach($submenus as $menu){ ?>
					<li>
						<?php 
							$menu_name=$menu['name'];
						 ?>
						
						<a href="javascript:openapp('<?php echo $menu['url']; ?>','<?php echo $menu['id']; ?>','<?php echo $menu_name; ?>',true);">
							&nbsp;<i class="fa fa-angle-double-right"></i>
							<span class="menu-text">
								<?php echo $menu_name; ?>
							</span>
						</a>
					</li>
					
				<?php } } ?>


<if condition="APP_DEBUG">
<style>
#think_page_trace_open{left: 0 !important;
right: initial !important;}			
</style>
</if>

</head>

<body style="min-width:900px;" screen_capture_injected="true">
	<div id="loading"><i class="loadingicon"></i><span>正在加载..</span></div>
	<div id="right_tools_wrapper">
		<span id="refresh_wrapper" title="刷新" ><i class="fa fa-refresh right_tool_icon"></i></span>
	</div>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a href="<?php echo url('admin/index/index'); ?>" class="brand"> <small> 
					普罗米修斯 后台管理中心
				</small>
				</a>
				<ul class="nav simplewind-nav pull-right">
					<li class="light-blue">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<img class="nav-user-photo" width="30" height="30" src="__PUBLIC__/images/logo-18.png" alt="">
							<span class="user-info">
								欢迎, admin
							</span>
							<i class="fa fa-caret-down"></i>
						</a>
						<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
							<!-- <if condition="sp_auth_check(sp_get_current_admin_id(),'admin/setting/site')">
								<li><a href="javascript:openapp('<?php echo url('setting/site'); ?>','index_site','网站信息');"><i class="fa fa-cog"></i> 网站信息</a></li>
							</if>
							<if condition="sp_auth_check(sp_get_current_admin_id(),'admin/user/userinfo')">
								<li><a href="javascript:openapp('<?php echo url('user/userinfo'); ?>','index_userinfo','修改信息');"><i class="fa fa-user"></i> 修改信息</a></li>
							</if> -->
							<!-- <if condition="sp_auth_check(sp_get_current_admin_id(),'admin/setting/password')"> -->
							<li><a href="javascript:openapp('<?php echo url('open/edit_pass'); ?>','index_password','修改密码');"><i class="fa fa-lock"></i> 修改密码</a></li>
							<!-- </if> -->
							<li><a href="<?php echo url('open/logout'); ?>"><i class="fa fa-sign-out"></i> 退出</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="main-container container-fluid">

		<div class="sidebar" id="sidebar">
			<!-- <div class="sidebar-shortcuts" id="sidebar-shortcuts">
			</div> -->
			<div id="nav_wraper">
			<ul class="nav nav-list">
				<?php echo getsubmenu($submenus); ?>
			</ul>
			</div>
			
		</div>

		<div class="main-content">
			<div class="breadcrumbs" id="breadcrumbs">
				<a id="task-pre" class="task-changebt">←</a>
				<div id="task-content">
				<ul class="macro-component-tab" id="task-content-inner">
					<li class="macro-component-tabitem noclose" app-id="0" app-url="<?php echo url('main/index'); ?>" app-name="首页">
						<span class="macro-tabs-item-text">首页</span>
					</li>
				</ul>
				<div style="clear:both;"></div>
				</div>
				<a id="task-next" class="task-changebt">→</a>
			</div>

			<div class="page-content" id="content">
				<iframe src="<?php echo url('index/main'); ?>" style="width:100%;height: 100%;" frameborder="0" id="appiframe-0" class="appiframe"></iframe>
			</div>
		</div>
	</div>
	
	<script src="__PUBLIC__/js/jquery.js"></script>
	<script src="__PUBLIC__/js/wind.js"></script>
	<script src="__PUBLIC__/js/bootstrap.min.js"></script>
	<script>
	var ismenumin = $("#sidebar").hasClass("menu-min");
	$(".nav-list").on( "click",function(event) {
		var closest_a = $(event.target).closest("a");
		if (!closest_a || closest_a.length == 0) {
			return
		}
		if (!closest_a.hasClass("dropdown-toggle")) {
			if (ismenumin && "click" == "tap" && closest_a.get(0).parentNode.parentNode == this) {
				var closest_a_menu_text = closest_a.find(".menu-text").get(0);
				if (event.target != closest_a_menu_text && !$.contains(closest_a_menu_text, event.target)) {
					return false
				}
			}
			return
		}
		var closest_a_next = closest_a.next().get(0);
		if (!$(closest_a_next).is(":visible")) {
			var closest_ul = $(closest_a_next.parentNode).closest("ul");
			if (ismenumin && closest_ul.hasClass("nav-list")) {
				return
			}
			closest_ul.find("> .open > .submenu").each(function() {
						if (this != closest_a_next && !$(this.parentNode).hasClass("active")) {
							$(this).slideUp(150).parent().removeClass("open")
						}
			});
		}
		if (ismenumin && $(closest_a_next.parentNode.parentNode).hasClass("nav-list")) {
			return false;
		}
		$(closest_a_next).slideToggle(150).parent().toggleClass("open");
		return false;
	});
	</script>
	<script src="__PUBLIC__/js/common.js"></script>
	<script src="__PUBLIC__/js/index.js"></script>
</body>
</html>