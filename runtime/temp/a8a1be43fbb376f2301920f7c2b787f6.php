<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"/home/wwwroot/momo/public/../application/admin/view/order/index.html";i:1517212860;s:68:"/home/wwwroot/momo/public/../application/admin/view/open/header.html";i:1510306797;}*/ ?>
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
			<li class="active"><a href="javascript::void(0);">交易订单</a></li>
		</ul>
		<form class="well form-search" method="get" action="<?php echo url('order/index'); ?>">
			订单号： 
			<input type="text" name="order_sn" style="width: 200px;" value="<?php echo \think\Request::instance()->get('order_sn'); ?>" placeholder="请输入订单号">
			订单状态： 
			<select name="order_state" style="width:80px;">
				<option value="">请选择</option>
				<option value="10">未付款</option>
				<option value="20">已付款</option>
			</select>
			<input type="submit" class="btn btn-primary" value="搜索" />
			<a class="btn btn-danger" href="<?php echo url('order/index'); ?>">清空</a>
		</form>
		<form class="js-ajax-form" action="" method="post">
			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
						<th width="50">订单号</th>
						<th width="80">买家</th>
						<th width="50">订单总额</th>
						<th width="50">订单状态</th>
						<th width="70">下单时间</th>
						<!-- <th width="50">操作</th> -->
					</tr>
				</thead>
				<tr>
				<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
                    <td><?php echo $vo['order_sn']; ?></td>
                    <td><?php echo $vo['buyer_name']; ?></td>
					<td><?php echo $vo['order_amount']; ?></td>
					<td><?php switch($vo['order_state']): case "10": ?>未付款<?php break; case "20": ?>已付款<?php break; default: ?>已取消
						<?php endswitch; ?>
					</td>
					<td><?php echo date('Y-m-d H:i',$vo['create_time']); ?></td>
					<!-- <td><a href="<?php echo url('order/order_detail',['order_id'=>$vo['order_id']]); ?>">订单详情</a></td> -->
				</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</table>
			<div class="pagination"><?php echo $page; ?></div>
		</form>
	</div>
	<script src="__PUBLIC__/js/common.js"></script>
</body>
</html>