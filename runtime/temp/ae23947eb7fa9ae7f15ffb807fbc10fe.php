<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"/home/wwwroot/momo/public/../application/admin/view/member/edit.html";i:1515570191;s:68:"/home/wwwroot/momo/public/../application/admin/view/open/header.html";i:1510306797;}*/ ?>
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
			<li><a href="<?php echo url('member/index'); ?>">会员列表</a></li>
			<li><a href="<?php echo url('member/add'); ?>">会员添加</a></li>
			<li class="active"><a>编辑会员</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo url('member/edit_post'); ?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label">手机</label>
					<div class="controls">
						<input type="text" name="member_mobile" value="<?php echo $member_info['member_mobile']; ?>">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">开通权限</label>
					<div class="controls">
						<?php if(is_array($nav_data) || $nav_data instanceof \think\Collection || $nav_data instanceof \think\Paginator): if( count($nav_data)==0 ) : echo "" ;else: foreach($nav_data as $key=>$vo): ?>
							<input type="checkbox" name="member_limit[]" value="<?php echo $vo['nav_id']; ?>" <?php if(in_array($vo['nav_id'],$member_limit)){echo 'checked="checked"';} ?>><?php echo $vo['nav_title']; endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">昵称</label>
					<div class="controls">
						<input type="text" name="member_name" value="<?php echo $member_info['member_name']; ?>">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">密码</label>
					<div class="controls">
						<input type="password" name="member_pass" value="<?php echo $member_info['member_pass']; ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">购买课程ID</label>
					<div class="controls">
						<input type="text" name="course_id" value="<?php echo $member_info['buy_course']; ?>">
						<span class="form-required">*&nbsp;多门课程以逗号分隔开</span>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<input type="hidden" name="member_id" value="<?php echo $member_info['member_id']; ?>" />
				<button type="submit" class="btn btn-primary js-ajax-submit">保存</button>
				<a class="btn" href="javascript:history.back(-1);">返回</a>
			</div>
		</form>
	</div>
	<script src="__PUBLIC__/js/common.js"></script>
</body>
</html>