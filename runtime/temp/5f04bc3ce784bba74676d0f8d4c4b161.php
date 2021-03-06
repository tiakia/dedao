<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"F:\XAMPP\htdocs\video\public/../application/admin\view\course\index.html";i:1515573315;s:71:"F:\XAMPP\htdocs\video\public/../application/admin\view\open\header.html";i:1510306797;}*/ ?>
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
			<li class="active"><a href="javascript:;">课程管理</a></li>
			<li><a href="<?php echo url('course/add'); ?>" target="_self">添加课程</a></li>
		</ul>
		<form class="well form-search" method="get" action="<?php echo url('course/index'); ?>">
			课程名称： 
			<input type="text" name="course_name" value="<?php echo \think\Request::instance()->get('course_name'); ?>" style="width: 160px;" autocomplete="off"> &nbsp; &nbsp;
			作者： 
			<input type="text" name="author_name" value="<?php echo \think\Request::instance()->get('author_name'); ?>" style="width: 100px;" autocomplete="off"> &nbsp; &nbsp;
			课程ID： 
			<input type="text" name="course_id" value="<?php echo \think\Request::instance()->get('course_id'); ?>" style="width: 50px;" autocomplete="off"> &nbsp; &nbsp;
			课程类型： 
			<select name="is_free" style="width:100px;">
				<option>请选择</option>
				<option value="0">免费课程</option>
				<option value="1">付费课程</option>
			</select>
			<input type="submit" class="btn btn-primary" value="搜索" />
			<a class="btn btn-danger" href="<?php echo url('course/index'); ?>">清空</a>
		</form>
			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
						<th width="50">ID</th>
						<th width="430">标题</th>
						<th width="70">封面图</th>
						<th >作者</th>
						<th >所属平台</th>
						<th >课程分类</th>
						<th >状态</th>
						<th >是否付费</th>
						<th >发布时间</th>
						<th width="200">操作</th>
					</tr>
				</thead>
				<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
				<tr>
                    <td><b><?php echo $vo['course_id']; ?></b></td>
					<td><?php echo $vo['title']; ?></td>
					<td><img src="<?php echo strexists($vo['thumb'],'http')?$vo['thumb'] : '__UPLOAD__/avatar/'.$vo['thumb']; ?>" width="20" height="20"></td>
					<td><?php echo $vo['author_name']; ?></td>
					<td><?php echo $vo['plat_name']; ?></td>
					<td><?php echo $vo['cate_name']; ?></td>
					<td><?php if($vo['is_use'] == 1): ?>上架<?php else: ?>下架<?php endif; ?></td>
					<td><?php if($vo['is_free'] == 1): ?>是<?php else: ?>否<?php endif; ?></td>
					<td><?php echo date("Y-m-d H:i"); ?></td>
					<td>
						<a href="<?php echo url('article/index',array('course_id'=>$vo['course_id'])); ?>">课程列表</a> | 
						<a href="<?php echo url('course/edit',array('course_id'=>$vo['course_id'])); ?>">编辑</a> | 
						<a href="<?php echo url('course/delete',array('course_id'=>$vo['course_id'])); ?>" class="js-ajax-delete">删除</a> | 
						<?php if($vo['is_use'] == 1): ?>
						<a href="<?php echo url('course/lock',array('course_id'=>$vo['course_id'])); ?>"  class="js-ajax-dialog-btn" data-msg="您确定要下架此课程吗？">下架</a> 
						<?php elseif($vo['is_use'] == 0): ?>
						<a href="<?php echo url('course/unlock',array('course_id'=>$vo['course_id'])); ?>"  class="js-ajax-dialog-btn" data-msg="您确定要上架此课程吗？">上架</a> 
						<?php endif; ?>
						
					</td>
				</tr>
			    <?php endforeach; endif; else: echo "" ;endif; ?>
			</table>
			<div class="pagination"><?php echo $lists->render(); ?></div>
	</div>
	<script src="__PUBLIC__/js/common.js"></script>
	<script>
		function refersh_window() {
			var refersh_time = getCookie('refersh_time');
			if (refersh_time == 1) {
				window.location = "<?php echo url('AdminPost/index'); ?>";
			}
		}
		setInterval(function() {
			refersh_window();
		}, 2000);
		$(function() {
			setCookie("refersh_time", 0);
			Wind.use('ajaxForm', 'artDialog', 'iframeTools', function() {
				//批量复制
				$('.js-articles-copy').click(function(e) {
					var ids=[];
					$("input[name='ids[]']").each(function() {
						if ($(this).is(':checked')) {
							ids.push($(this).val());
						}
					});
					if (ids.length == 0) {
						art.dialog.through({
							id : 'error',
							icon : 'error',
							content : '您没有勾选信息，无法进行操作！',
							cancelVal : '关闭',
							cancel : true
						});
						return false;
					}
					
					ids= ids.join(',');
					art.dialog.open("/index.php/admin/article/header?ids="+ ids, {
						title : "批量复制",
						width : "300px"
					});
				});
				//批量移动
				$('.js-articles-move').click(function(e) {
					var ids=[];
					$("input[name='ids[]']").each(function() {
						if ($(this).is(':checked')) {
							ids.push($(this).val());
						}
					});
					
					if (ids.length == 0) {
						art.dialog.through({
							id : 'error',
							icon : 'error',
							content : '您没有勾选信息，无法进行操作！',
							cancelVal : '关闭',
							cancel : true
						});
						return false;
					}
					
					ids= ids.join(',');
					art.dialog.open("/index.php/admin/article/move?old_term_id=1&ids="+ ids, {
						title : "批量移动",
						width : "300px"
					});
				});
			});
		});
	</script>
</body>
</html>