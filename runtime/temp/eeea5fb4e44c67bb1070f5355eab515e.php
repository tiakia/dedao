<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"/home/wwwroot/momo/public/../application/admin/view/member/add.html";i:1515570051;s:68:"/home/wwwroot/momo/public/../application/admin/view/open/header.html";i:1510306797;}*/ ?>
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
			<li class="active"><a>会员添加</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo url('member/add_post'); ?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label">手机</label>
					<div class="controls">
						<input type="text" name="member_mobile" value="">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">开通权限</label>
					<div class="controls">
						<?php if(is_array($nav_data) || $nav_data instanceof \think\Collection || $nav_data instanceof \think\Paginator): if( count($nav_data)==0 ) : echo "" ;else: foreach($nav_data as $key=>$vo): ?>
							<input type="checkbox" name="member_limit[]" value="<?php echo $vo['nav_id']; ?>"><?php echo $vo['nav_title']; endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">昵称</label>
					<div class="controls">
						<input type="text" name="member_name" value="">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">密码</label>
					<div class="controls">
						<input type="password" name="member_pass" value="">
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">购买课程ID</label>
					<div class="controls">
						<input type="password" name="course_id" value="">
						<span class="form-required">*&nbsp;多门课程以逗号分隔开</span>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit">添加</button>
				<a class="btn" href="javascript:history.back(-1);">返回</a>
			</div>
		</form>
	</div>
	<script src="__PUBLIC__/js/common.js"></script>
	<script>

		function avatar_upload(obj){
			var $fileinput=$(obj);
			Wind.css("jcrop");
			Wind.use("ajaxfileupload","jcrop","noty",function(){
				$.ajaxFileUpload({
					url:"<?php echo url('member/avatar_upload'); ?>",
					secureuri:false,
					fileElementId:'avatar_uploder',
					dataType: 'json',
					success: function (data){
						if(data.code == 1){
							var src= "__UPLOAD__avatar/"+data.file;
							open_iframe_dialog("<?php echo url('member/pic_cut',array('type' => 'member')); ?>" + "&x=120&y=120&src="+src,'图片裁剪',{'width' : '690px','height':'auto'});
						}else{
							artdialog_alert(data.msg);
						}
						
					},
					error: function (data, status, e){}
				});
			});
			return false;
		}
		//裁剪图片后返回接收函数
		function call_back(picname){
			$('#member_avatar').val(picname);
		}
	</script>
</body>
</html>