<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"/home/wwwroot/momo/public/../application/admin/view/money/add_points.html";i:1515994893;s:68:"/home/wwwroot/momo/public/../application/admin/view/open/header.html";i:1510306797;}*/ ?>
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
            <li><a href="<?php echo url('Points/index'); ?>">积分明细</a></li>
            <li class="active"><a href="<?php echo url('Points/points_option'); ?>">积分充值</a></li>
        </ul>
        <form method="post" class="form-horizontal js-ajax-form" action="<?php echo url('money/add_post'); ?>">
            <fieldset>
                <div class="control-group">
                    <label class="control-label">会员账号</label>
                    <div class="controls">
                        <input type="text" name="member_mobile" required />
                        <span class="form-required">*</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">增减类型</label>
                    <div class="controls">
                        <select name="type">
                            <option value="admin_add" selected>增加</option>
                            <option value="admin_del">扣除</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-group">
                        <label class="control-label">点券值</label>
                        <div class="controls">
                            <input type="text" name="points" required />
                            <span class="form-required">*</span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-group">
                        <label class="control-label">描述</label>
                        <div class="controls">
                            <textarea name="pl_desc" id="" cols="10" rows="5" style="resize: none;">管理员手动操作点券</textarea>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary js-ajax-submit">保存</button>
                <a class="btn" href="javascript:history.back(-1);">返回</a>
            </div>
        </form>
    </div>
    <script src="__PUBLIC__/js/common.js"></script>
</body>
</html>