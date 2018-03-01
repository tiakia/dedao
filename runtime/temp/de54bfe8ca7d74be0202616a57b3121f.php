<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"/home/wwwroot/momo/public/../application/admin/view/money/index.html";i:1515996171;s:68:"/home/wwwroot/momo/public/../application/admin/view/open/header.html";i:1510306797;}*/ ?>
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
            <li class="active"><a href="<?php echo url('Money/index'); ?>">点券明细</a></li>
            <li><a href="<?php echo url('Money/add_points'); ?>">点券充值</a></li>
        </ul>
       <!--  <form class="well form-search" method="get" action="<?php echo url('money/index'); ?>">
            会员账号：
            <input type="text" name="member_mobile" style="width: 200px;" value="<?php echo \think\Request::instance()->get('member_mobile'); ?>" placeholder="请输入会员账号">
            时间：
            <input type="text" name="start_time" class="js-datetime" value="<?php echo \think\Request::instance()->get('start_time'); ?>" style="width: 120px;" autocomplete="off">-
            <input type="text" name="end_time" class="js-datetime"  value="<?php echo \think\Request::instance()->get('end_time'); ?>" style="width: 120px;" autocomplete="off"> &nbsp; &nbsp;

            操作管理员：
            <input type="text" name="admin_name" style="width: 200px;" value="<?php echo \think\Request::instance()->get('admin_name'); ?>" placeholder="请输入管理员名称">
            <input type="submit" class="btn btn-primary" value="搜索" />
            <a class="btn btn-danger" href="<?php echo url('money/index'); ?>">清空</a>
        </form> -->
        <form class="js-ajax-form" action="" method="post">
            <table class="table table-hover table-bordered table-list">
                <thead>
                <tr>
                    <th width="50">ID</th>
                    <th width="80">会员名称</th>
                    <th width="80">会员账号</th>
                    <th width="50">操作人</th>
                    <th width="50">点券值</th>
                    <th width="50">操作时间</th>
                    <th width="50">描述</th>
                </tr>
                </thead>
                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
                    <tr>
                        <td><?php echo $vo['pl_id']; ?></td>
                        <td>呃呃呃</td>
                        <td><?php echo $vo['member_mobile']; ?></td>
                        <td><?php if(!empty($vo['admin_name'])): ?>
                                <?php echo $vo['admin_name']; endif; if(!empty($vo['name'])): ?>
                            （<?php echo $vo['name']; ?>）
                            <?php endif; ?>
                        </td>
                        <td><?php echo $vo['points']; ?></td>
                        <td><?php echo date("Y-m-d H:i:s",$vo['add_time']); ?></td>
                        <td><?php echo $vo['pl_desc']; ?></td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <?php echo $page; ?>
        </form>
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