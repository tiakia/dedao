<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"F:\xampp\htdocs\sun\public/../application/admin\view\mange\index.html";i:1498725651;s:69:"F:\xampp\htdocs\sun\public/../application/admin\view\open\header.html";i:1498555874;}*/ ?>
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
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('mange/index'); ?>">管理员列表</a></li>
			<li><a href="<?php echo url('mange/add'); ?>">管理员添加</a></li>
		</ul>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="50">ID</th>
					<th>用户名</th>
					<th>角色</th>
					<th>最后登录IP</th>
					<th>最后登录时间</th>
					<th>登录次数</th>
					<th>状态</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($users) || $users instanceof \think\Collection || $users instanceof \think\Paginator): if( count($users)==0 ) : echo "" ;else: foreach($users as $key=>$vo): ?>
				<tr>
					<td><?php echo $vo['admin_id']; ?></td>
					<td><?php echo $vo['admin_name']; ?></td>
					<td><?php if(!empty($vo['role'])) echo  $vo['role']['name']; ?></td>
					<td><?php echo $vo['login_ip']; ?></td>
					<td>
						<?php if($vo['login_time'] == 0): ?>
							该用户暂无登录记录
						<?php else: ?>
							<?php echo date('Y-m-d H:s',$vo['login_time']); endif; ?>
					</td>
					<td><?php echo $vo['login_num']; ?></td>
					<td><?php if($vo['admin_status'] == 1): ?>正常<?php else: ?>锁定<?php endif; ?></td>
					<td>
						<?php if($vo['admin_id'] == 1): if($vo['admin_id'] == sp_get_current_admin_id()): ?>
							<a href='<?php echo url("mange/edit",array("id"=>$vo["admin_id"])); ?>'>编辑</a> |
							<?php else: ?>
							<font color="#cccccc">编辑</font> |
							<?php endif; ?>
						 	<font color="#cccccc">删除</font> |
							<?php if($vo['admin_status'] == 1): ?>
								<font color="#cccccc">锁定</font>
							<?php else: ?>
								<font color="#cccccc">解锁</font>
							<?php endif; else: ?>
							<a href='<?php echo url("mange/edit",array("id"=>$vo["admin_id"])); ?>'>编辑</a> |
							<?php if($vo['admin_status'] == 1): ?>
								<a href="<?php echo url('mange/lock',array('id'=>$vo['admin_id'])); ?>" class="js-ajax-dialog-btn" data-msg="您确定要锁定此用户吗？">锁定</a> | 
							<?php else: ?>
								<a href="<?php echo url('mange/unlock',array('id'=>$vo['admin_id'])); ?>" class="js-ajax-dialog-btn" data-msg="您确定要解锁此用户吗？">解锁</a> | 
							<?php endif; ?>
							<a class="js-ajax-delete" href="<?php echo url('mange/delete',array('id'=>$vo['admin_id'])); ?>">删除</a>
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
		<?php echo $page; ?>
	</div>
	<script src="__PUBLIC__/js/common.js"></script>
</body>
</html>