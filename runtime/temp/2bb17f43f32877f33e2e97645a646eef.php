<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"F:\XAMPP\htdocs\video\public/../application/admin\view\version\index.html";i:1510306796;s:71:"F:\XAMPP\htdocs\video\public/../application/admin\view\open\header.html";i:1510306797;}*/ ?>
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
			<li class="active"><a href="<?php echo url('version/index'); ?>">版本管理</a></li>
			<li><a href="<?php echo url('version/add'); ?>">版本添加</a></li>
		</ul>
		<form method="post" class="js-ajax-form">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th width="50">ID</th>
						<th width="70">版本</th>
						<th width="70">版本号</th>
						<th width="70">系统类型</th>
						<th>升级说明</th>
						<th width="120">创建时间</th>
						<th width="70">是否强制</th>
						<th width="120">状态</th>
						<th width="120">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
					<tr>
						<td><?php echo $vo['version_id']; ?></td>
						<td><?php echo $vo['version']; ?></td>
						<td><?php echo $vo['version_code']; ?></td>
						<td><?php echo !empty($vo['os_type']) && $vo['os_type']==1?'Android' : 'IOS'; ?></td>
						<td><?php echo str_cut($vo['version_desc'],200); if(strlen($vo['version_desc']) > 200): ?><a href="javascript:artdialog_content('<?php echo $vo['version_desc']; ?>')">[更多]</a><?php endif; ?></td>
						<td><?php echo date('Y-m-d H:i',(int)$vo['create_time']); ?></td>
						<td><?php echo !empty($vo['is_force']) && $vo['is_force']==1?'是' : '否'; ?></td>
						<td><?php echo !empty($vo['status']) && $vo['status']==1?'正常' : '下架'; ?></td>
						<td>
							<a href="<?php echo url('version/edit',array('id'=>$vo['version_id'])); ?>">编辑</a> |
							<?php if($vo['status'] == 1): ?>
							<a href="<?php echo url('version/lock',array('id'=>$vo['version_id'])); ?>" class="js-ajax-dialog-btn" data-msg="您确定要下架此版本吗">下架</a> |
							<?php else: ?>
							<a href="<?php echo url('version/unlock',array('id'=>$vo['version_id'])); ?>" class="js-ajax-dialog-btn" data-msg="您确定要上架此版本吗">上架</a> |
							<?php endif; ?>
							<a href="<?php echo url('version/delete',array('id'=>$vo['version_id'])); ?>" class="js-ajax-delete">删除</a>
						</td>
					</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
			<div class="pagination"><?php echo $page; ?></div>
		</form>
	</div>
	<script src="__PUBLIC__/js/common.js?v="></script>
</body>
</html>