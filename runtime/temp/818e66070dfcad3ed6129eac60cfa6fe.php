<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"F:\XAMPP\htdocs\video\public/../application/admin\view\role\authorize.html";i:1510306796;s:71:"F:\XAMPP\htdocs\video\public/../application/admin\view\open\header.html";i:1510306797;}*/ ?>
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
<style>.expander{margin-left: -20px;}</style>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo url('role/index'); ?>">角色管理</a></li>
			<li><a href="<?php echo url('role/add'); ?>">添加角色</a></li>
			<li class="active"><a href="javascript:;">权限设置</a></li>
		</ul>
		<form class="js-ajax-form" action="<?php echo url('role/authorize_post'); ?>" method="post">
			<div class="table_full">
				<table class="table table-bordered" id="authrule-tree">
					<tbody>
						<?php echo $categorys; ?>
					</tbody>
				</table>
			</div>
			<div class="form-actions">
				<input type="hidden" name="roleid" value="<?php echo $roleid; ?>" />
				<button class="btn btn-primary js-ajax-submit" type="submit">保存</button>
				<a class="btn" href="<?php echo url('role/index'); ?>">返回</a>
			</div>
		</form>
	</div>
	<script type="text/javascript">
	var ajaxForm_list = $('form.js-ajax-form');
	if (ajaxForm_list.length) {
	    Wind.use('ajaxForm', 'artDialog', function () {
	        if ($.browser && $.browser.msie) {
	            //ie8及以下，表单中只有一个可见的input:text时，会整个页面会跳转提交
	            ajaxForm_list.on('submit', function (e) {
	                //表单中只有一个可见的input:text时，enter提交无效
	                e.preventDefault();
	            });
	        }
	
	        $('button.js-ajax-submit').bind('click', function (e) {
	            e.preventDefault();
	            /*var btn = $(this).find('button.js-ajax-submit'),
						form = $(this);*/
	            var btn = $(this),
	                form = btn.parents('form.js-ajax-form');
	
	            //批量操作 判断选项
	            if (btn.data('subcheck')) {
	                btn.parent().find('span').remove();
	                if (form.find('input.js-check:checked').length) {
	                    var msg = btn.data('msg');
	                    if (msg) {
	                        art.dialog({
	                            id: 'warning',
	                            icon: 'warning',
	                            content: btn.data('msg'),
	                            cancelVal: "关闭",
	                            cancel: function () {
	                                btn.data('subcheck', false);
	                                btn.click();
	                            }
	                        });
	                    } else {
	                        btn.data('subcheck', false);
	                        btn.click();
	                    }
	
	                } else {
	                    $('<span class="tips_error">请至少选择一项</span>').appendTo(btn.parent()).fadeIn('fast');
	                }
	                return false;
	            }
	
	            //ie处理placeholder提交问题
	            if ($.browser && $.browser.msie) {
	                form.find('[placeholder]').each(function () {
	                    var input = $(this);
	                    if (input.val() == input.attr('placeholder')) {
	                        input.val('');
	                    }
	                });
	            }
	
	            form.ajaxSubmit({
	                url: btn.data('action') ? btn.data('action') : form.attr('action'),
	                //按钮上是否自定义提交地址(多按钮情况)
	                dataType: 'json',
	                beforeSubmit: function (arr, $form, options) {
	                    var text = btn.text();
	
	                    //按钮文案、状态修改
	                    btn.text(text + '中...').attr('disabled', true).addClass('disabled');
	                },
	                success: function (data, statusText, xhr, $form) {
	                    var text = btn.text();
	
	                    //按钮文案、状态修改
	                    btn.removeClass('disabled').text(text.replace('中...', '')).parent().find('span').remove();
	
	                    if (data.code === 1) {
	                        $('<span class="tips_success">' + data.msg + '</span>').appendTo(btn.parent()).fadeIn('slow').delay(1000).fadeOut(function () {
	                            if (data.url) {
	                                //返回带跳转地址
	                                if (window.parent.art) {
	                                    //iframe弹出页
	                                    window.parent.location.href = data.url;
	                                } else {
	                                    window.location.href = data.url;
	                                }
	                            } else {
	                                if (window.parent.art) {
	                                    reloadPage(window.parent);
	                                } else {
	                                    //刷新当前页
	                                    reloadPage(window);
	                                }
	                            }
	                        });
	                    } else if (data.code === 0) {
	                        $('<span class="tips_error">' + data.msg + '</span>').appendTo(btn.parent()).fadeIn('fast');
	                        btn.removeProp('disabled').removeClass('disabled');
	                    }
	                }
	            });
	        });
	
	    });
	}
	$(document).ready(function () {
		Wind.css('treeTable');
	    Wind.use('treeTable', function () {
	        $("#authrule-tree").treeTable({
	            indent: 20
	        });
	    });
	});
	
	function checknode(obj) {
	    var chk = $("input[type='checkbox']");
	    var count = chk.length;
	    var num = chk.index(obj);
	    var level_top = level_bottom = chk.eq(num).attr('level');
	    for (var i = num; i >= 0; i--) {
	        var le = chk.eq(i).attr('level');
	        if (le <level_top) {
	            chk.eq(i).prop("checked", true);
	            var level_top = level_top - 1;
	        }
	    }
	    for (var j = num + 1; j < count; j++) {
	        var le = chk.eq(j).attr('level');
	        if (chk.eq(num).prop("checked")) {
	            if (le > level_bottom){
	            	chk.eq(j).prop("checked", true);
	            }
	            else if (le == level_bottom){
	            	break;
	            }
	        } else {
	            if (le >level_bottom){
	            	chk.eq(j).prop("checked", false);
	            }else if(le == level_bottom){
	            	break;
	            }
	        }
	    }
	}
	</script>
</body>
</html>