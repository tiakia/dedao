<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"/home/wwwroot/momo/public/../application/admin/view/article/add.html";i:1515374110;s:68:"/home/wwwroot/momo/public/../application/admin/view/open/header.html";i:1510306797;}*/ ?>
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
<style type="text/css">
.pic-list li {
	margin-bottom: 5px;
}
</style>
<script type="text/html" id="photos-item-wrapper">

	<li id="savedimage{id}">
		<input id="photo-{id}" type="hidden" name="photos_url[]" value="{filepath}"> 
		<input id="photo-{id}-name" type="text" name="photos_alt[]" value="{name}" style="width: 160px;" title="图片名称">
		<img id="photo-{id}-preview" src="{preview_url}" style="height:36px;width: 36px;" onclick="parent.image_preview_dialog(this.src);">
		<a href="javascript:upload_one_image('图片上传','#photo-{id}');">替换</a>
		<a href="javascript:(function(){$('#savedimage{id}').remove();})();">移除</a>
	</li>
</script>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo url('course/index'); ?>">课程管理</a></li>
			<li><a href="<?php echo url('article/index'); ?>">文章管理</a></li>
			<li class="active"><a>添加文章</a></li>
		</ul>
		<form action="<?php echo url('article/add_post'); ?>" method="post" class="form-horizontal js-ajax-forms" enctype="multipart/form-data">
			<div class="row-fluid">
				<div class="span9">
					<table class="table table-bordered">
						<tr>
							<th width="80">标题</th>
							<td>
								<input type="text" style="width:400px;" name="title" id="title" required value="" placeholder="请输入标题"/>
								<span class="form-required">*</span>
							</td>
						</tr>
						<tr>
							<th>音频地址</th>
							<td><input type="text" name="audio" id="audio" value="" style="width: 400px" placeholder="请输入音频地址"></td>
						</tr>
						<tr>
							<th>摘要</th>
							<td>
								<textarea name="description" id="description" style="width: 98%; height: 50px;" placeholder="请填写摘要"></textarea>
							</td>
						</tr>
						<tr>
							<th>内容</th>
							<td>
								<script type="text/plain" id="content" name="content"></script>
							</td>
						</tr>
						<!-- <tr>
							<th>相册图集</th>
							<td>
								<ul id="photos" class="pic-list unstyled"></ul>
								<a href="javascript:upload_multi_image('图片上传','#photos','photos-item-wrapper');" class="btn btn-small">选择图片</a>
							</td>
						</tr> -->
					</table>
				</div>
				<!-- <div class="span3">
					<table class="table table-bordered">
						<tr>
							<th><b>缩略图</b></th>
						</tr>
						<tr>
							<td>
								<div style="text-align: center;">
									<input type="hidden" name="thumb" id="thumb" value="">
									<a href="javascript:upload_one_image('图片上传','#thumb');">
										<img src="__PUBLIC__/images/default-thumbnail.png" id="thumb-preview" width="135" style="cursor: hand" />
									</a>
									<input type="button" class="btn btn-small" onclick="$('#thumb-preview').attr('src','__PUBLIC__/images/default-thumbnail.png');$('#thumb').val('');return false;" value="取消图片">
								</div>
							</td>
						</tr>
					</table>
				</div> -->
				
			</div>
			<div class="form-actions">
				<input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
				<button class="btn btn-primary js-ajax-submit" type="submit">提交</button>
				<a class="btn" href="<?php echo url('article/index',['course_id'=>$course_id]); ?>">返回</a>
			</div>
		</form>
	</div>
	<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
	<script type="text/javascript">
		//编辑器路径定义
		var editorURL = GV.WEB_ROOT;
	</script>
	<script type="text/javascript" src="__PUBLIC__/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/ueditor/ueditor.all.min.js"></script>
	<script type="text/javascript">
		$(function() {
			$(".js-ajax-close-btn").on('click', function(e) {
				e.preventDefault();
				Wind.use("artDialog", function() {
					art.dialog({
						id : "question",
						icon : "question",
						fixed : true,
						lock : true,
						background : "#CCCCCC",
						opacity : 0,
						content : "您确定需要关闭当前页面嘛？",
						ok : function() {
							setCookie("refersh_time", 1);
							window.close();
							return true;
						}
					});
				});
			});
			/////---------------------
			Wind.use('validate', 'ajaxForm', 'artDialog', function() {
				//javascript

				//编辑器
				editorcontent = new baidu.editor.ui.Editor();
				editorcontent.render('content');
				try {
					editorcontent.sync();
				} catch (err) {
				}
				//增加编辑器验证规则
				jQuery.validator.addMethod('editorcontent', function() {
					try {
						editorcontent.sync();
					} catch (err) {
					}
					return editorcontent.hasContents();
				});
				var form = $('form.js-ajax-forms');
				//ie处理placeholder提交问题
				if ($.browser && $.browser.msie) {
					form.find('[placeholder]').each(function() {
						var input = $(this);
						if (input.val() == input.attr('placeholder')) {
							input.val('');
						}
					});
				}

				var formloading = false;
				//表单验证开始
				form.validate({
					//是否在获取焦点时验证
					onfocusout : false,
					//是否在敲击键盘时验证
					onkeyup : false,
					//当鼠标掉级时验证
					onclick : false,
					//验证错误
					showErrors : function(errorMap, errorArr) {
						//errorMap {'name':'错误信息'}
						//errorArr [{'message':'错误信息',element:({})}]
						try {
							$(errorArr[0].element).focus();
							art.dialog({
								id : 'error',
								icon : 'error',
								lock : true,
								fixed : true,
								background : "#CCCCCC",
								opacity : 0,
								content : errorArr[0].message,
								cancelVal : '确定',
								cancel : function() {
									$(errorArr[0].element).focus();
								}
							});
						} catch (err) {
						}
					},
					//验证规则
					rules : {
						'title' : {
							required : 1
						},
						'content' : {
							editorcontent : true
						}
					},
					//验证未通过提示消息
					messages : {
						'title' : {
							required : '请输入标题'
						},
						'content' : {
							editorcontent : '内容不能为空'
						}
					},
					//给未通过验证的元素加效果,闪烁等
					highlight : false,
					//是否在获取焦点时验证
					onfocusout : false,
					//验证通过，提交表单
					submitHandler : function(forms) {
						if (formloading)
							return;
						$(forms).ajaxSubmit({
							url : form.attr('action'), //按钮上是否自定义提交地址(多按钮情况)
							dataType : 'json',
							beforeSubmit : function(arr, $form, options) {
								formloading = true;
							},
							success : function(data, statusText, xhr, $form) {
								formloading = false;
								if (data.code == 1) {
									setCookie("refersh_time", 1);
									//添加成功
									Wind.use("artDialog", function() {
										art.dialog({
											id : "succeed",
											icon : "succeed",
											fixed : true,
											lock : true,
											background : "#CCCCCC",
											opacity : 0,
											content : data.msg,
											button : [ {
												name : '继续添加？',
												callback : function() {
													reloadPage(window);
													return true;
												},
												focus : true
											}, {
												name : '返回列表页',
												callback : function() {
													location = "<?php echo url('Article/index',['course_id'=>$course_id]); ?>";
													return true;
												}
											} ]
										});
									});
								} else {
									artdialog_alert(data.msg);
								}
							}
						});
					}
				});
			});
			////-------------------------
		});
	</script>
</body>
</html>