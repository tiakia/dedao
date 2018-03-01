<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"/home/wwwroot/momo/public/../application/admin/view/member/index.html";i:1515570815;s:68:"/home/wwwroot/momo/public/../application/admin/view/open/header.html";i:1510306797;}*/ ?>
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
	.chart_background{  width:100%;  height: 100%;  background-color: rgba(0,0,0,0.5);  position: fixed;  left:0;  top:0;  display: none;  }
	.chart_background .chart_person{  width:50%;  position:absolute;  top:150px;  left:25%;  background-color:rgb(246,246,246);  }
	.chart_header,.chart_footer{  width:100%;  height:40px;  background-color:rgb(246,246,246);  }
	.chart_left{  display: inline-block;  float: left;  line-height: 40px;  margin:0 0 0 15px;  }
	.chart_right{  cursor: pointer;  display: inline-block;  float: right;  line-height: 40px;  margin:0 15px 0 0 ;  }
	.chart_footer>.chart_right{  width:45px;  height:25px;  margin-top:7px;  text-align: center;  line-height:25px;  color: white;  background-color:rgb(48,177,231);  border-radius: 4px;  }
	.Treant { position: relative; overflow: hidden; padding: 0 !important; }
	.Treant > .node,
	.Treant > .pseudo { position: absolute; display: block; visibility: hidden; }
	.Treant.Treant-loaded .node,
	.Treant.Treant-loaded .pseudo { visibility: visible; }
	.Treant > .pseudo { width: 0; height: 0; border: none; padding: 0; }
	.Treant .collapse-switch { width: 3px; height: 3px; display: block; border: 1px solid black; position: absolute; top: 1px; right: 1px; cursor: pointer; }
	.Treant .collapsed .collapse-switch { background-color: #868DEE; }
	.Treant > .node img {	border: none; float: left; }
	.chart_background .chart_person .chart {width:100%;background-color: white;}
	.Treant > .node { text-align: center }
	.Treant > p { font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; font-weight: bold; font-size: 12px; }
	.node-name {margin:4px;font-weight: bold;}
	.nodeExample1 {  padding: 2px;  -webkit-border-radius: 3px;  -moz-border-radius: 3px;  border-radius: 8px;  background-color: #ffffff;  border: 3px solid gray;  width: 150px;  font-size: 12px;  }
	.nodeExample1:hover{  transform: scale(1.2,1.2);  transition: all 0.5s;  }
	.nodeExample1:hover .node-name{  color:red;  transition: all 0.5s;  }
</style>
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('member/index'); ?>">会员列表</a></li>
			<li><a href="<?php echo url('member/add'); ?>">添加会员</a></li>
		</ul>
		<form class="well form-search" method="post" action="<?php echo url('member/index'); ?>">
			会员账号：
			<input type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>" placeholder="会员账号">
			<input type="submit" class="btn btn-primary" value="搜索" />
			<a class="btn btn-danger" href="<?php echo url('member/index'); ?>">清空</a>
		</form>
		<form method="post" class="js-ajax-form">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th width="50">ID</th>
						<th>手机号</th>
						<th>昵称</th>
						<th>注册时间</th>
						<th>登录时间</th>
						<th>登录IP</th>
						<th>购买课程</th>
						<th>状态</th>
						<th width="90">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
					<tr>
						<td align="center"><?php echo $vo['member_id']; ?></td>
						<td><?php echo $vo['member_mobile']; ?></td>
						<td><?php echo $vo['member_name']; ?></td>
						<td><?php echo date('Y-m-d H:i',$vo['member_time']); ?></td>
						<td><?php echo date('Y-m-d H:i',$vo['login_time']); ?></td>
						<td><?php echo $vo['login_ip']; ?></td>
						<td><?php echo $vo['buy_course']; ?></td>
						<td><?php if($vo['member_state'] == 1): ?>正常<?php else: ?>锁定<?php endif; ?></td>
						<td width="40px;">
							<a href="<?php echo url('member/edit',array('id'=>$vo['member_id'])); ?>">编辑</a> |
							<?php if($vo['member_state'] == 1): ?>
							<a href="<?php echo url('member/lock',array('id'=>$vo['member_id'])); ?>" class="js-ajax-dialog-btn" data-msg="您确定要锁定此用户吗？">锁定</a>
							<?php else: ?>
							<a href="<?php echo url('member/unlock',array('id'=>$vo['member_id'])); ?>" class="js-ajax-dialog-btn" data-msg="您确定要解锁此用户吗">解锁</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<div class="pagination"><?php echo $page; ?></div>
		</form>
	</div>
	<script src="__PUBLIC__/js/raphael.js"></script>
	<script src="__PUBLIC__/js/Treant.js"></script>
	<script src="__PUBLIC__/js/common.js"></script>
</body>
</html>